<?php
$sql = mysqli_query(
    $koneksi,
    "SELECT MAX(kdcopybuku) AS kode
    FROM copybuku"
);

$data = mysqli_fetch_array($sql);

$kode = $data['kode'];

if ($kode == "") {
    $kdcopybuku = "CP00001";
} else {
    $no = (int) substr($kode, 2, 5);
    $no++;
    $kdcopybuku = "CP" . sprintf("%05s", $no);
}
if (isset($_POST['btnSimpan'])) {
    //$kdcopybuku = $_POST['kdcopybuku'];
    $cetakan = $_POST['cetakan'];
    $tahunterbit = $_POST['tahunterbit'];
    $jumlah = $_POST['jumlah'];
    $kdbuku = $_POST['kdbuku'];
    $cek = mysqli_query(
        $koneksi,
        "SELECT *
        FROM copybuku
        WHERE kdcopybuku='$kdcopybuku'"
    );
    if (mysqli_num_rows($cek) > 0) {
        ?>
        <script>
            alert('Kode copy buku sudah ada!');
        </script>
        <?php
    } else {
        $simpan = mysqli_query(
            $koneksi,
            "INSERT INTO copybuku
            (
                kdcopybuku,
                cetakan,
                tahunterbit,
                jumlah,
                kdbuku
                )
            VALUES
            (
                '$kdcopybuku',
                '$cetakan',
                '$tahunterbit',
                '$jumlah',
                '$kdbuku'
            )"
        );
        if ($simpan) {
            ?>
            <script>
                alert('Data copy buku berhasil disimpan!');
                document.location='index.php?hal=copybuku';
            </script>
            <?php
        } else {
            ?>
            <script>
                alert('Data copy buku gagal disimpan!');
            </script>
            <?php
        }
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Copy Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Copy Buku
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>
                                        Kode Copy Buku
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-barcode"></i>
                                                </span>
                                            </div>
                                            <input
                                            type="text"
                                            name="kdcopybuku"
                                            class="form-control"
                                            value="<?= $kdcopybuku; ?>"
                                            readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Cetakan
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-copy"></i>
                                                </span>
                                            </div>
                                            <input
                                            type="text"
                                            name="cetakan"
                                            class="form-control"
                                            maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Tahun Terbit
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input
                                            type="number"
                                            name="tahunterbit"
                                            class="form-control"
                                            min="1900"
                                            max="2100">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Buku
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-book"></i>
                                                </span>
                                            </div>
                                            <select
                                            name="kdbuku"
                                            id="kdbuku"
                                            class="form-control"
                                            onchange="tampilJudul()"
                                            required>

                                            <option value="">
                                                -- Pilih Buku --
                                            </option>

                                            <?php
                                            $sqlbuku = mysqli_query(
                                                $koneksi,
                                                "SELECT *
                                                FROM buku
                                                ORDER BY judul ASC"
                                            );

                                            while ($buku = mysqli_fetch_object($sqlbuku)) {
                                                ?>
                                                <option
                                                value="<?= $buku->kdbuku; ?>"
                                                data-judul="<?= $buku->judul; ?>">
                                                <?= $buku->kdbuku; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                    <label>
                                        Judul
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-sort-numeric-up"></i>
                                        </span>
                                    </div>
                                    <input
                                    type="text"
                                    id="judul"
                                    name="judul"
                                    class="form-control"
                                    readonly
                                    required>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                                    <label>
                                Jumlah
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-sort-numeric-up"></i>
                                        </span>
                                    </div>
                                    <input
                                    type="number"
                                    name="jumlah"
                                    class="form-control"
                                    value="1" required>
                                </div>
                            </div>
                        </div>
                        <button
                        type="submit"
                        name="btnSimpan"
                        class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                    <a href="index.php?hal=copybuku"
                    class="btn btn-default float-right">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>
<script>
function tampilJudul() {
    var combo = document.getElementById('kdbuku');
    var judul = combo.options[combo.selectedIndex].getAttribute('data-judul');

    document.getElementById('judul').value = judul ?? '';
}
</script>
</div>