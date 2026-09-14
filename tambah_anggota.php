<?php
$sql = mysqli_query(
    $koneksi,
    "SELECT MAX(noanggota) AS kode
     FROM anggota"
);

$data = mysqli_fetch_array($sql);
$kode = $data['kode'];

if ($kode == "") {
    $noanggota = "AG00001";
} else {
    $no = (int) substr($kode, 2, 5);
    $no++;
    $noanggota = "AG" . sprintf("%05s", $no);
}

if (isset($_POST['btnSimpan'])) {
    $noanggota = $_POST['noanggota'];
    $nama = $_POST['nama'];
    $jenkel = $_POST['jenkel'];

    $simpan = mysqli_query(
        $koneksi,
        "INSERT INTO anggota
        (
            noanggota,
            nama,
            jenkel
        )
        VALUES
        (
            '$noanggota',
            '$nama',
            '$jenkel'
        )"
    );

    if ($simpan) {
        ?>
        <script>
            alert('Data anggota berhasil disimpan!');
            document.location='index.php?hal=anggota';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Data anggota gagal disimpan!');
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
                    <h1>Tambah Anggota</h1>
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
                                                value="<?= $noanggota; ?>"
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

                                                <option value="">
                                                    -- Pilih Jenis Kelamin --
                                                </option>

                                                <option value="Laki-Laki">
                                                    Laki-Laki
                                                </option>

                                                <option value="Perempuan">
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