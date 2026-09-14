<?php

// ===================== AMBIL DATA UTAMA =====================
$nopinjam = $_GET['nopinjam'];

// ===================== CEK APAKAH SUDAH DIKEMBALIKAN =====================

$qKembali = mysqli_query(
    $koneksi,
    "SELECT *
    FROM pengembalian
    WHERE nopinjam='$nopinjam'"
);

if (mysqli_num_rows($qKembali) > 0) {

    echo "
    <script>
        alert('Data peminjaman tidak bisa diupdate karena sudah dikembalikan!');
        document.location='index.php?hal=peminjaman';
    </script>
    ";

    exit;
}

// ===================== AMBIL DATA HEADER =====================

$qdata = mysqli_query(
    $koneksi,
    "SELECT *
    FROM peminjaman
    WHERE nopinjam='$nopinjam'"
);

$data = mysqli_fetch_assoc($qdata);


// ===================== PROSES UPDATE =====================

if (isset($_POST['btnUpdate'])) {

    $tglpinjam = $_POST['tglpinjam'];
    $tglkembali = $_POST['tglharuskembali'];
    $kelas = $_POST['kelas'];

    // =====================
    // CEK MINIMAL 1 BUKU
    // =====================

    $jumlahData = 0;

    foreach ($_POST['nocopybuku'] as $kdcopy) {

        if ($kdcopy != "") {
            $jumlahData++;
        }

    }

    if ($jumlahData == 0) {

        echo "
        <script>
            alert('Minimal harus ada 1 buku yang dipinjam!');
            history.back();
        </script>
        ";

        exit;

    }

    // =====================
    // UPDATE HEADER
    // =====================

    mysqli_query(
        $koneksi,
        "UPDATE peminjaman SET
            tglpinjam='$tglpinjam',
            tglharuskembali='$tglkembali',
            kelas='$kelas'
        WHERE nopinjam='$nopinjam'"
    );

    // =====================
    // HAPUS DETAIL LAMA
    // =====================

    mysqli_query(
        $koneksi,
        "DELETE FROM pinjam
        WHERE nopinjam='$nopinjam'"
    );

    // =====================
    // INSERT DETAIL BARU
    // =====================

    foreach ($_POST['nocopybuku'] as $i => $kdcopy) {

        if ($kdcopy == "") {
            continue;
        }

        $jlh = 1;

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

    }

    echo "
    <script>
        alert('Data peminjaman berhasil diupdate!');
        document.location='index.php?hal=peminjaman';
    </script>";

}


// ===================== DATA ANGGOTA =====================

$optAnggota = "";

$qanggota = mysqli_query(
    $koneksi,
"SELECT *
FROM anggota
ORDER BY noanggota"
);

while ($a = mysqli_fetch_assoc($qanggota)) {

    $selected = ($a['noanggota'] == $data['noanggota'])
        ? "selected"
        : "";

    $optAnggota .= "
    <option
        value='{$a['noanggota']}'
        data-nama='".htmlspecialchars($a['nama'], ENT_QUOTES)."'
        $selected>
        {$a['noanggota']} - {$a['nama']}
    </option>";
}


// ===================== DATA COPY BUKU =====================

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
    data-stok='{$c['jumlah']}'
>
    {$kdcopy} - {$c['judul']} (tersedia)
</option>";
    }
}

?>

<div class="content-wrapper">

<section class="content">
<div class="container-fluid">

<div class="card">

<div class="card-header">
    <a href="index.php?hal=peminjaman" class="btn btn-success">
        Kembali
    </a>
</div>

<form method="POST">

<div class="card-body">

    <div class="form-group">
        <label>No Peminjaman</label>
        <input type="text"
               class="form-control"
               value="<?= $data['nopinjam'] ?>"
               readonly>
    </div>

    <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="date"
               name="tglpinjam"
               class="form-control"
               value="<?= $data['tglpinjam'] ?>"
               required>
    </div>

    <div class="form-group">
        <label>Tanggal Harus Kembali</label>
        <input type="date"
               name="tglharuskembali"
               class="form-control"
               value="<?= $data['tglharuskembali'] ?>"
               required>
    </div>

    <div class="form-group">
        <label>No Anggota</label>
        <select name="noanggota"
                id="noanggota"
                class="form-control"
                disabled>

            <option value="">
                -- Pilih Anggota --
            </option>

            <?= $optAnggota ?>

        </select>
    </div>

    <div class="form-group">
        <label>Nama Anggota</label>
        <input type="text"
               id="namaanggota"
               class="form-control"
               readonly>
    </div>

    <div class="form-group">
        <label>Kelas</label>
        <input type="text"
               name="kelas"
               id="kelas"
               class="form-control"
               value="<?= $data['kelas'] ?>"
               required>
    </div>

    <hr>

    <h4>Daftar Buku</h4>

    <table class="table table-bordered"
           id="tblPinjam">

        <thead>
        <tr>
            <th>No</th>
            <th>Copy Buku</th>
            <th>Judul</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>

        <?php

        $qdetail = mysqli_query(
            $koneksi,
            "SELECT
                p.nocopybuku,
                p.jlhpinjam,
                b.judul
            FROM pinjam p
            JOIN copybuku c
                ON p.nocopybuku = c.kdcopybuku
            JOIN buku b
                ON c.kdbuku = b.kdbuku
            WHERE p.nopinjam = '$nopinjam'"
        );

        $no = 1;

        while ($d = mysqli_fetch_assoc($qdetail)) {

        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td>
                <select
                    name="nocopybuku[]"
                    class="form-control copybuku">

                    <option
                        value="<?= $d['nocopybuku'] ?>"
                        selected>

                        <?= $d['nocopybuku'] ?>

                    </option>

                    <?= $optCopy ?>

                </select>
            </td>

            <td>
                <input
                    type="text"
                    class="form-control judul"
                    value="<?= $d['judul'] ?>"
                    readonly>
            </td>

            <td>
                <input
                    type="number"
                    name="jlhpinjam[]"
                    class="form-control"
                    value="1"
                    min="1"
                    disabled>
            </td>

            <td>
                <button
                    type="button"
                    class="btn btn-danger hapusBaris">

                    Hapus

                </button>
            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<div class="card-footer">

    <button
        type="submit"
        name="btnUpdate"
        class="btn btn-primary">

        Update

    </button>

</div>

</form>

</div>
</div>
</section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    // anggota
    $("#noanggota").change(function(){

        let sel = $(this).find(":selected");

        $("#namaanggota").val(sel.data("nama"));

    }).trigger("change");


    // buku
    $(document).on("change", ".copybuku", function(){

        let sel = $(this).find(":selected");

        $(this)
            .closest("tr")
            .find(".judul")
            .val(sel.data("judul"));

    });


    // hapus baris
    $(document).on("click", ".hapusBaris", function(){

        $(this).closest("tr").remove();

    });

});

</script>