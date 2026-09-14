<?php
$nodenda = $_GET['nodenda'];

$sql = mysqli_query(
    $koneksi,
    "SELECT *
     FROM denda
     WHERE nodenda='$nodenda'"
);

$row = mysqli_fetch_object($sql);

if (isset($_POST['btnSimpan'])) {
    $namadenda = $_POST['namadenda'];
    $besardenda = $_POST['besardenda'];

    $edit = mysqli_query(
        $koneksi,
        "UPDATE denda
         SET
            namadenda='$namadenda',
            besardenda='$besardenda'
         WHERE nodenda='$nodenda'"
    );

    if ($edit) {
        ?>
        <script>
            alert('Data denda berhasil diubah!');
            document.location='index.php?hal=denda';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Data denda gagal diubah!');
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
                    <h1>Edit Denda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Denda
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
                                        No Denda
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-hashtag"></i>
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            name="nodenda"
                                            class="form-control"
                                            value="<?= $row->nodenda; ?>"
                                            readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Nama Denda
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </span>
                                        </div>
                                        <input
                                            type="text"
                                            name="namadenda"
                                            class="form-control"
                                            maxlength="100"
                                            value="<?= $row->namadenda; ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Besar Denda
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Rp
                                            </span>
                                        </div>
                                        <input
                                            type="number"
                                            name="besardenda"
                                            class="form-control"
                                            min="0"
                                            step="0.01"
                                            value="<?= $row->besardenda; ?>"
                                            required>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    name="btnSimpan"
                                    class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Simpan
                                </button>

                                <a
                                    href="index.php?hal=denda"
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