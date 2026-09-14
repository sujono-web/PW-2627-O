<?php
$noanggota = $_GET['noanggota'];

$sql = mysqli_query(
    $koneksi,
    "SELECT *
     FROM anggota
     WHERE noanggota='$noanggota'"
);

$row = mysqli_fetch_object($sql);

if (isset($_POST['btnSimpan'])) {
    $nama = $_POST['nama'];
    $jenkel = $_POST['jenkel'];

    $edit = mysqli_query(
        $koneksi,
        "UPDATE anggota
         SET
            nama='$nama',
            jenkel='$jenkel'
         WHERE noanggota='$noanggota'"
    );

    if ($edit) {
        ?>
        <script>
            alert('Data anggota berhasil diubah!');
            document.location='index.php?hal=anggota';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Data anggota gagal diubah!');
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
                    <h1>Edit Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Anggota
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
                                        No Anggota
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-id-card"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="noanggota"
                                                class="form-control"
                                                value="<?= $row->noanggota; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
  <div class="form-group">
                                    <label>
                                        Nama Anggota
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                name="nama"
                                                class="form-control"
                                                maxlength="100"
                                                value="<?= $row->nama; ?>"
                                                required>
                                        </div>
                                    </div>
                                </div>
  <div class="form-group">
                                    <label>
                                        Jenis Kelamin
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-venus-mars"></i>
                                                </span>
                                            </div>
                                            <select
                                                name="jenkel"
                                                class="form-control"
                                                required>

                                                <option
                                                    value="Laki-Laki"
                                                    <?= $row->jenkel == 'Laki-Laki' ? 'selected' : ''; ?>>
                                                    Laki-Laki
                                                </option>

                                                <option
                                                    value="Perempuan"
                                                    <?= $row->jenkel == 'Perempuan' ? 'selected' : ''; ?>>
                                                    Perempuan
                                                </option>

                                            </select>
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

                                <a href="index.php?hal=anggota"
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