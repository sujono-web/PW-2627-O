<?php
$kdcopybuku = $_GET['kdcopybuku'];

$sql = mysqli_query(
    $koneksi,
    "SELECT *
     FROM copybuku
     WHERE kdcopybuku='$kdcopybuku'"
);

$row = mysqli_fetch_object($sql);

if (isset($_POST['btnSimpan'])) {
    $cetakan = $_POST['cetakan'];
    $tahunterbit = $_POST['tahunterbit'];
    $jumlah = $_POST['jumlah'];
    $kdbuku = $_POST['kdbuku'];

    $edit = mysqli_query(
        $koneksi,
        "UPDATE copybuku
         SET
            cetakan='$cetakan',
            tahunterbit='$tahunterbit',
            jumlah='$jumlah',
            kdbuku='$kdbuku'
         WHERE kdcopybuku='$kdcopybuku'"
    );

    if ($edit) {
        ?>
        <script>
            alert('Data copy buku berhasil diubah!');
            document.location='index.php?hal=copybuku';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Data copy buku gagal diubah!');
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
                    <h1>Edit Copy Buku</h1>
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
                                                value="<?= $row->kdcopybuku; ?>"
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
                                                maxlength="50"
                                                value="<?= $row->cetakan; ?>">
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
                                                max="2100"
                                                value="<?= $row->tahunterbit; ?>">
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
                                                    $selected = "";

                                                    if ($buku->kdbuku == $row->kdbuku) {
                                                        $selected = "selected";
                                                    }
                                                    ?>
                                                    <option
                                                        value="<?= $buku->kdbuku; ?>"
                                                        data-judul="<?= $buku->judul; ?>"
                                                        <?= $selected; ?>>
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
                                                    <i class="fas fa-book-open"></i>
                                                </span>
                                            </div>
                                            <input
                                                type="text"
                                                id="judul"
                                                class="form-control"
                                                readonly>
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
                                                value="<?= $row->jumlah; ?>"
                                                required>
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
</div>

<script>
function tampilJudul() {
    var combo = document.getElementById('kdbuku');
    var judul = combo.options[combo.selectedIndex].getAttribute('data-judul');

    document.getElementById('judul').value = judul ?? '';
}

tampilJudul();
</script>