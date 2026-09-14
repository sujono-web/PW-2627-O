<?php

// ===================== AMBIL DATA UTAMA =====================
$nopinjam = $_GET['nopinjam'];

// ===================== CEK APAKAH SEMUA BUKU SUDAH DIKEMBALIKAN =====================

// jumlah buku yang dipinjam
$qPinjam = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS jml
     FROM pinjam
     WHERE nopinjam = '$nopinjam'"
);

$dPinjam = mysqli_fetch_assoc($qPinjam);

$jumlahPinjam = $dPinjam['jml'];


// jumlah buku yang sudah dikembalikan
$qKembali = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS jml
     FROM pengembalian p
     JOIN kembali k
       ON p.nokembali = k.nokembali
     WHERE p.nopinjam = '$nopinjam'"
);

$dKembali = mysqli_fetch_assoc($qKembali);

$jumlahKembali = $dKembali['jml'];


// jika semua buku sudah dikembalikan
if ($jumlahPinjam > 0 && $jumlahPinjam == $jumlahKembali) {

    echo "
    <script>
        alert('Data peminjaman tidak bisa diupdate karena semua buku sudah dikembalikan!');
        document.location='index.php?hal=peminjaman';
    </script>
    ";

    exit;
}
//AKHIR CEK DATA APAKAH SUDAH DIKEMBALIKAN---------------

$qdata = mysqli_query($koneksi,
"SELECT * FROM peminjaman WHERE nopinjam='$nopinjam'");
$data = mysqli_fetch_assoc($qdata);


// ===================== PROSES UPDATE =====================
if (isset($_POST['btnUpdate'])) {

    $tglpinjam  = $_POST['tglpinjam'];
    $tglkembali = $_POST['tglharuskembali'];

    // =====================
    // CEK MINIMAL 1 BUKU
    // =====================
    $jumlahData = 0;

    foreach ($_POST['kdcopybuku'] as $kdcopy) {

        if ($kdcopy != "") {
            $jumlahData++;
        }
    }

    if ($jumlahData == 0) {

        echo "
        <script>
            alert('Minimal harus ada 1 buku yang dipinjam!');
            history.back();
        </script>";

        exit;
    }


    // =====================
    // UPDATE HEADER
    // =====================
    mysqli_query(
        $koneksi,
        "UPDATE peminjaman SET
            tglpinjam='$tglpinjam',
            tglharuskembali='$tglkembali'
         WHERE nopinjam='$nopinjam'"
    );


    // =====================
    // HAPUS DETAIL YANG BELUM DIKEMBALIKAN SAJA
    // =====================
    mysqli_query(
        $koneksi,
        "DELETE p
         FROM pinjam p
         LEFT JOIN kembali k
           ON p.kdcopybuku = k.kdcopybuku
         LEFT JOIN pengembalian pg
           ON k.nokembali = pg.nokembali
          AND pg.nopinjam = p.nopinjam
         WHERE p.nopinjam = '$nopinjam'
           AND pg.nopinjam IS NULL"
    );


    // =====================
    // INSERT DETAIL BARU
    // =====================
    foreach ($_POST['kdcopybuku'] as $i => $kdcopy) {

        if ($kdcopy == "") {
            continue;
        }

        $jlh = $_POST['jlhpinjam'][$i];

        mysqli_query(
            $koneksi,
            "INSERT INTO pinjam
             (nopinjam,kdcopybuku,jlhpinjam)
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

$qanggota = mysqli_query($koneksi,
"SELECT * FROM anggota ORDER BY noanggota");

while ($a = mysqli_fetch_assoc($qanggota)) {

    $selected = ($a['noanggota'] == $data['noanggota']) ? "selected" : "";

    $optAnggota .= "
    <option value='{$a['noanggota']}'
        data-nama='{$a['nama']}'
        data-kelas='{$a['kelas']}'
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
        b.judulbuku
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
         WHERE kdcopybuku = '$kdcopy'"
    );

    $dPinjam = mysqli_fetch_assoc($qPinjam);


    // ==============================
    // HITUNG JUMLAH DIKEMBALIKAN
    // ==============================
    $qKembali = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS jml
         FROM kembali
         WHERE kdcopybuku = '$kdcopy'"
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
            data-judul='".htmlspecialchars($c['judulbuku'], ENT_QUOTES)."'
            disabled
        >
            {$kdcopy} - {$c['judulbuku']} (Sedang dipinjam)
        </option>";
    }

    // ==============================
    // STOK HABIS
    // ==============================
    else if ($c['jumlah'] <= 0) {

        $optCopy .= "
        <option
            value='{$kdcopy}'
            data-judul='".htmlspecialchars($c['judulbuku'], ENT_QUOTES)."'
            disabled
        >
            {$kdcopy} - {$c['judulbuku']} (STOK HABIS)
        </option>";
    }

    // ==============================
    // BISA DIPINJAM
    // ==============================
    else {

        $optCopy .= "
        <option
            value='{$kdcopy}'
            data-judul='".htmlspecialchars($c['judulbuku'], ENT_QUOTES)."'
            data-stok='{$c['jumlah']}'
        >
            {$kdcopy} - {$c['judulbuku']} (tersedia)
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
        <input type="text" class="form-control"
               value="<?= $data['nopinjam'] ?>" readonly>
    </div>

    <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tglpinjam"
               class="form-control"
               value="<?= $data['tglpinjam'] ?>" required>
    </div>

    <div class="form-group">
        <label>Tanggal Harus Kembali</label>
        <input type="date" name="tglharuskembali"
               class="form-control"
               value="<?= $data['tglharuskembali'] ?>" required>
    </div>

    <div class="form-group">
        <label>No Anggota</label>
        <select name="noanggota" id="noanggota"
                class="form-control" disabled>

            <option value="">-- Pilih Anggota --</option>
            <?= $optAnggota ?>

        </select>
    </div>

    <div class="form-group">
        <label>Nama Anggota</label>
        <input type="text" id="namaanggota"
               class="form-control" readonly>
    </div>

    <div class="form-group">
        <label>Kelas</label>
        <input type="text" id="kelas"
               class="form-control" readonly>
    </div>

    <hr>

    <h4>Daftar Buku</h4>

    <table class="table table-bordered" id="tblPinjam">

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
        p.kdcopybuku,
        p.jlhpinjam,
        b.judulbuku
     FROM pinjam p
     JOIN copybuku c
       ON p.kdcopybuku = c.kdcopybuku
     JOIN buku b
       ON c.kdbuku = b.kdbuku
     LEFT JOIN kembali k
       ON p.kdcopybuku = k.kdcopybuku
     LEFT JOIN pengembalian pg
       ON k.nokembali = pg.nokembali
      AND pg.nopinjam = p.nopinjam
     WHERE p.nopinjam = '$nopinjam'
       AND pg.nopinjam IS NULL"
);

        $no = 1;

        while($d = mysqli_fetch_assoc($qdetail)) {
        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td>
                <select name="kdcopybuku[]"
                        class="form-control copybuku">
                    <option value="<?= $d['kdcopybuku'] ?>">
                        <?= $d['kdcopybuku'] ?>
                    </option>
                    <?= $optCopy ?>
                </select>
            </td>

            <td>
                <input type="text"
                       class="form-control judul"
                       value="<?= $d['judulbuku'] ?>"
                       readonly>
            </td>

            <td>
                <input type="number"
                       name="jlhpinjam[]"
                       class="form-control"
                       value="<?= $d['jlhpinjam'] ?>"
                       min="1">
            </td>

            <td>
                <button type="button"
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
    <button type="submit"
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
        $("#kelas").val(sel.data("kelas"));

    }).trigger("change");


    // buku
    $(document).on("change",".copybuku",function(){

        let sel = $(this).find(":selected");

        $(this).closest("tr")
               .find(".judul")
               .val(sel.data("judul"));

    });


    // hapus baris
    $(document).on("click",".hapusBaris",function(){

        $(this).closest("tr").remove();

    });

});
</script>