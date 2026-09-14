<?php
// ===================== AUTO NOMOR PINJAM =====================
$qkode = mysqli_query(
    $koneksi,
    "SELECT MAX(nopinjam) AS kode
    FROM peminjaman"
);
$dkode = mysqli_fetch_assoc($qkode);
if ($dkode['kode'] == "") {
    $nopinjam = "PJ000001";
} else {
    $no = intval(substr($dkode['kode'], 2)) + 1;
    $nopinjam = "PJ" . sprintf("%06d", $no);
}
// ===================== SIMPAN =====================
if (isset($_POST['btnSimpan'])) {
    $tglpinjam       = $_POST['tglpinjam'];
    $tglharuskembali = $_POST['tglharuskembali'];
    $noanggota       = $_POST['noanggota'];
    $kelas           = $_POST['kelas'];
//CEK ANGGOTA DULU PINJEMANNYA BERAPA------------------------
    // ===================== CEK BATAS MAKSIMAL 3 BUKU =====================
// hitung jumlah buku yang masih dipinjam anggota
    $qcek = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS jumlah
        FROM peminjaman pm
        JOIN pinjam p
        ON pm.nopinjam = p.nopinjam
        LEFT JOIN pengembalian pg
        ON pm.nopinjam = pg.nopinjam
        WHERE pm.noanggota = '$noanggota'
        AND pg.nopinjam IS NULL"
    );
    $dcek = mysqli_fetch_assoc($qcek);
    $jumlahLama = $dcek['jumlah'];
// hitung jumlah buku yang dipilih pada form sekarang
    $jumlahBaru = 0;
    foreach ($_POST['nocopybuku'] as $kdcopy) {
        if ($kdcopy != "") {
            $jumlahBaru++;
        }
    }
// total peminjaman setelah transaksi ini
    $totalPinjam = $jumlahLama + $jumlahBaru;
// jika melebihi 3, batalkan penyimpanan
    if ($totalPinjam > 3) {
        $sisa = 3 - $jumlahLama;
        echo "
        <script>
        alert('Sisa peminjaman anda hanya $sisa buku lagi!');
        history.back();
        </script>
        ";
        exit;
    }
//AKHIR CEK ANGGOTA =====================================
    mysqli_query(
        $koneksi,
        "INSERT INTO peminjaman
        (nopinjam,tglpinjam,tglharuskembali,kelas,noanggota)
        VALUES
        (
            '$nopinjam',
            '$tglpinjam',
            '$tglharuskembali',
            '$kelas',
            '$noanggota'
        )"
    );
    foreach ($_POST['nocopybuku'] as $i => $kdcopy) {
        if ($kdcopy == "") continue;
       // $jlh = $_POST['jlhpinjam'][$i];
        // cek stok
       /* $cek = mysqli_query(
            $koneksi,
            "SELECT jumlah
             FROM copybuku
             WHERE kdcopybuku='$kdcopy'"
        );
        $stok = mysqli_fetch_assoc($cek);
         if ($jlh > $stok['jumlah']) {
            echo "
            <script>
                alert('Stok buku tidak mencukupi!');
                history.back();
            </script>";
            exit;
        }*/
        $jlh = "1";
        mysqli_query(
            $koneksi,
            "INSERT INTO pinjam
            (nopinjam,nocopybuku,jlhpinjam)
            VALUES
            (
                '$nopinjam',
                '$kdcopy',
                '$jlh'
            )"
        );
        /*mysqli_query(
            $koneksi,
            "UPDATE copybuku
             SET jumlah = jumlah - $jlh
             WHERE kdcopybuku='$kdcopy'
         );*/
     }
     echo "
     <script>
     alert('Data peminjaman berhasil disimpan!');
     document.location='index.php?hal=peminjaman';
     </script>";
 }
// ===================== OPTION ANGGOTA =====================
$optAnggota = "";
$qanggota = mysqli_query(
    $koneksi,
    "SELECT *
    FROM anggota
    ORDER BY noanggota"
);
while ($a = mysqli_fetch_assoc($qanggota)) {
    // ==============================
    // JUMLAH BUKU YANG PERNAH DIPINJAM
    // ==============================
    $qPinjam = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS jml
        FROM peminjaman pm
        JOIN pinjam p
        ON pm.nopinjam = p.nopinjam
        WHERE pm.noanggota = '{$a['noanggota']}'"
    );
    $dPinjam = mysqli_fetch_assoc($qPinjam);
    // ==============================
    // JUMLAH BUKU YANG SUDAH DIKEMBALIKAN
    // ==============================
    $qKembali = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS jml
        FROM peminjaman pm
        JOIN pengembalian pg
        ON pm.nopinjam = pg.nopinjam
        WHERE pm.noanggota = '{$a['noanggota']}'"
    );
    $dKembali = mysqli_fetch_assoc($qKembali);
    // ==============================
    // BUKU YANG MASIH DIPINJAM
    // ==============================
    $jumlahPinjam = $dPinjam['jml'] - $dKembali['jml'];

if ($jumlahPinjam < 0) {
    $jumlahPinjam = 0;
}

// ==============================
// TAMPILKAN OPTION
// ==============================

if ($jumlahPinjam >= 3) {

    $optAnggota .= "
    <option
    value='{$a['noanggota']}'
    data-nama='".htmlspecialchars($a['nama'], ENT_QUOTES)."'
    data-kelas=''
    disabled
    >
    {$a['noanggota']} - {$a['nama']} (Sedang pinjam 3 buku)
    </option>";

} else {

    $sisa = 3 - $jumlahPinjam;

    $optAnggota .= "
    <option
    value='{$a['noanggota']}'
    data-nama='".htmlspecialchars($a['nama'], ENT_QUOTES)."'
    data-kelas=''
    >
    {$a['noanggota']} - {$a['nama']} (Masih boleh pinjam {$sisa} buku)
    </option>";
}

}

// ===================== OPTION COPY BUKU =====================

$optCopy = "";

$qcopy = mysqli_query(
    $koneksi,
    "SELECT
    c.kdcopybuku,
    c.jumlah,
    b.judul
    FROM copybuku c
    JOIN buku b
    ON c.kdbuku = b.kdbuku
    ORDER BY c.kdcopybuku"
);

while ($c = mysqli_fetch_assoc($qcopy)) {

    $kdcopy = $c['kdcopybuku'];

    // ==============================
    // HITUNG JUMLAH DIPINJAM
    // ==============================

    $qPinjam = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS jml
        FROM pinjam
        WHERE nocopybuku = '$kdcopy'"
    );

    $dPinjam = mysqli_fetch_assoc($qPinjam);

    // ==============================
    // HITUNG JUMLAH DIKEMBALIKAN
    // ==============================

    $qKembali = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS jml
        FROM pengembalian pg
        JOIN pinjam p
        ON pg.nopinjam = p.nopinjam
        WHERE p.nocopybuku = '$kdcopy'"
    );

    $dKembali = mysqli_fetch_assoc($qKembali);

    $masihDipinjam = ($dPinjam['jml'] > $dKembali['jml']);

    // ==============================
    // BUKU SEDANG DIPINJAM
    // ==============================

    if ($masihDipinjam) {

        $optCopy .= "
        <option
        value='{$kdcopy}'
        data-judul='".htmlspecialchars($c['judul'], ENT_QUOTES)."'
        disabled
        >
        {$kdcopy} - {$c['judul']} (Sedang dipinjam)
        </option>";

    }

    // ==============================
    // STOK HABIS
    // ==============================

    else if ($c['jumlah'] <= 0) {

        $optCopy .= "
        <option
        value='{$kdcopy}'
        data-judul='".htmlspecialchars($c['judul'], ENT_QUOTES)."'
        disabled
        >
        {$kdcopy} - {$c['judul']} (STOK HABIS)
        </option>";

    }

    // ==============================
    // BISA DIPINJAM
    // ==============================

    else {

        $optCopy .= "
        <option
        value='{$kdcopy}'
        data-judul='".htmlspecialchars($c['judul'], ENT_QUOTES)."'
        data-stok='{$c['jumlah']}'>
        {$kdcopy} - {$c['judul']} (tersedia)
        </option>";

    }

}

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Peminjaman
                        </li>
                        <li class="breadcrumb-item active">
                            Tambah
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">

                <div class="card-header">
                    <a href="index.php?hal=peminjaman"
                       class="btn btn-success">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>

                <form method="POST">

                    <div class="card-body">
 <div class="form-group">
                                    <label>
                                No Peminjaman
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    name="nopinjam"
                                    class="form-control"
                                    value="<?= $nopinjam ?>"
                                    readonly>
                            </div>
                        </div>

                       <div class="form-group">
                                    <label>
                                Tanggal Pinjam
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="date"
                                    name="tglpinjam"
                                    class="form-control"
                                    value="<?= date('Y-m-d') ?>"
                                    required>
                            </div>
                        </div>

                       <div class="form-group">
                                    <label>
                                Tanggal Harus Kembali
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="date"
                                    name="tglharuskembali"
                                    class="form-control"
                                    required>
                            </div>
                        </div>

                    <div class="form-group">
                                    <label>
                                No Anggota
                            </label>
                            <div class="col-sm-10">
                                <select
                                    name="noanggota"
                                    id="noanggota"
                                    class="form-control"
                                    required>

                                    <option value="">
                                        -- Pilih Anggota --
                                    </option>

                                    <?= $optAnggota ?>

                                </select>
                            </div>
                        </div>

                <div class="form-group">
                                    <label>
                                Nama Anggota
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    id="namaanggota"
                                    class="form-control"
                                    readonly>
                            </div>
                        </div>
 <div class="form-group">
                                    <label>
                                Kelas
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    name="kelas"
                                    id="kelas"
                                    class="form-control"
                                    required>
                            </div>
                        </div>

                        <hr>

                        <h4>Daftar Buku</h4>

                        <table
                            class="table table-bordered"
                            id="tblPinjam">

                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Copy Buku</th>
                                    <th>Judul Buku</th>
                                    <th width="15%">Jumlah</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>

                                    <td class="nomor">1</td>

                                    <td>
                                        <select
                                            name="nocopybuku[]"
                                            class="form-control copybuku"
                                            required>

                                            <option value="">
                                                -- Pilih Buku --
                                            </option>

                                            <?= $optCopy ?>

                                        </select>
                                    </td>

                                    <td>
                                        <input
                                            type="text"
                                            class="form-control judul"
                                            readonly>
                                    </td>

                                    <td>
                                        <input
                                            type="number"
                                            name="jlhpinjam[]"
                                            class="form-control"
                                            min="1"
                                            disabled
                                            value="1">
                                    </td>

                                    <td align="center">
                                        <button
                                            type="button"
                                            id="tambahBaris"
                                            class="btn btn-success">

                                            <i class="fas fa-plus"></i>

                                        </button>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="card-footer">

                        <button
                            type="submit"
                            name="btnSimpan"
                            class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </section>

</div>

<!-- WAJIB: jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
window.optCopy = `<?= $optCopy ?>`;
</script>

<script>

$(document).ready(function () {

    // ==========================
    // TAMPILKAN NAMA ANGGOTA
    // ==========================

    $("#noanggota").on("change", function () {

        let selected = $(this).find(":selected");
        let nama = selected.data("nama") || "";

        $("#namaanggota").val(nama);

    });

    // ==========================
    // TAMPILKAN JUDUL BUKU
    // ==========================

    $(document).on("change", ".copybuku", function () {

        let selected = $(this).find(":selected");
        let judul = selected.data("judul") || "";

        $(this).closest("tr")
               .find(".judul")
               .val(judul);

    });

    // ==========================
    // TAMBAH BARIS
    // ==========================

    $("#tambahBaris").on("click", function () {

        let nomor = $("#tblPinjam tbody tr").length + 1;

        let baris = `
        <tr>

            <td class="nomor">${nomor}</td>

            <td>
                <select
                    name="nocopybuku[]"
                    class="form-control copybuku"
                    required>

                    <option value="">
                        -- Pilih Buku --
                    </option>

                    ${window.optCopy}

                </select>
            </td>

            <td>
                <input
                    type="text"
                    class="form-control judul"
                    readonly>
            </td>

            <td>
                <input
                    type="number"
                    name="jlhpinjam[]"
                    class="form-control"
                    min="1"
                    value="1"
                    disabled>
            </td>

            <td align="center">
                <button
                    type="button"
                    class="btn btn-danger hapusBaris">

                    <i class="fas fa-trash"></i>

                </button>
            </td>

        </tr>
        `;

        $("#tblPinjam tbody").append(baris);

    });

    // ==========================
    // HAPUS BARIS
    // ==========================

    $(document).on("click", ".hapusBaris", function () {

        $(this).closest("tr").remove();

        $("#tblPinjam tbody tr").each(function (i) {

            $(this)
                .find(".nomor")
                .text(i + 1);

        });

    });

});

</script>