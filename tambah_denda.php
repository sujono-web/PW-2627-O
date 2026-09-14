<?php
$sql = mysqli_query(
    $koneksi,
    "SELECT MAX(nodenda) AS kode
    FROM denda"
);

$data = mysqli_fetch_array($sql);
$kode = $data['kode'];

if ($kode == "") {
    $nodenda = "DN00001";
} else {
    $no = (int) substr($kode, 2, 5);
    $no++;
    $nodenda = "DN" . sprintf("%05s", $no);
}

if (isset($_POST['btnSimpan'])) {
    $nodenda = $_POST['nodenda'];
    $namadenda = $_POST['namadenda'];
    $besardenda = $_POST['besardenda'];

    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO denda
        (
            nodenda,
            namadenda,
            besardenda
            )
        VALUES
        (
            '$nodenda',
            '$namadenda',
            '$besardenda'
        )"
    );

    if ($simpan) {
        ?>
        <script>
            alert('Data denda berhasil disimpan!');
            document.location='index.php?hal=denda';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Data denda gagal disimpan!');
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
                    <h1>Tambah Denda</h1>
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
                                        value="<?= $nodenda; ?>"
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

                            <a href="index.php?hal=denda"
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