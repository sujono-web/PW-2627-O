<?php
$kdbuku = $_GET['kdbuku'];

$sql = mysqli_query(
    $koneksi,
    "SELECT *
     FROM buku
     WHERE kdbuku='$kdbuku'"
);

$row = mysqli_fetch_object($sql);

if (isset($_POST['btnSimpan'])) {
    $judul       = $_POST['judul'];
    $pengarang   = $_POST['pengarang'];
    $penerbit    = $_POST['penerbit'];
    $tmpterbit   = $_POST['tmpterbit'];
    $klasifikasi = $_POST['klasifikasi'];

    $edit = mysqli_query(
        $koneksi,
        "UPDATE buku
         SET
            judul='$judul',
            pengarang='$pengarang',
            penerbit='$penerbit',
            tmpterbit='$tmpterbit',
            klasifikasi='$klasifikasi'
         WHERE kdbuku='$kdbuku'"
    );

    if ($edit) {
        ?>
        <script>
            alert('Data buku berhasil diubah!');
            document.location='index.php?hal=buku';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Data buku gagal diubah!');
        </script>
        <?php
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Buku
                        </li>
                        <li class="breadcrumb-item active">
                            Edit
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
                                        Kode Buku
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-book"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="kdbuku"
                                                class="form-control"
                                                value="<?= $row->kdbuku; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Judul Buku
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-book-open"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="judul"
                                                class="form-control"
                                                maxlength="200"
                                                value="<?= $row->judul; ?>"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label>
                                        Pengarang
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user-edit"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="pengarang"
                                                class="form-control"
                                                maxlength="100"
                                                value="<?= $row->pengarang; ?>">
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label>
                                        Penerbit
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="penerbit"
                                                class="form-control"
                                                maxlength="100"
                                                value="<?= $row->penerbit; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Tempat Terbit
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="tmpterbit"
                                                class="form-control"
                                                maxlength="100"
                                                value="<?= $row->tmpterbit; ?>">
                                        </div>
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label>
                                        Klasifikasi
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-tags"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="klasifikasi"
                                                class="form-control"
                                                maxlength="50"
                                                value="<?= $row->klasifikasi; ?>">
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

                                <a href="index.php?hal=buku"
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
</div>