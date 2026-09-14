<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kdcopybuku = $_GET['kdcopybuku'];
        $cek = mysqli_query(
            $koneksi,
            "SELECT *
             FROM pinjam
             WHERE nocopybuku='$kdcopybuku'"
        );
        if (mysqli_num_rows($cek) > 0) {
            ?>
            <script>
                alert('Data copy buku tidak dapat dihapus karena masih digunakan pada data peminjaman!');
                document.location='index.php?hal=copybuku';
            </script>
            <?php
        } else {
            $hapus = mysqli_query(
                $koneksi,
                "DELETE FROM copybuku
                 WHERE kdcopybuku='$kdcopybuku'"
            );
            if ($hapus) {
                ?>
                <script>
                    alert('Data copy buku berhasil dihapus!');
                    document.location='index.php?hal=copybuku';
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Data copy buku gagal dihapus!');
                    document.location='index.php?hal=copybuku';
                </script>
                <?php
            }
        }
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Copy Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Copy Buku
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
                        <div class="card-header">
                            <a href="index.php?hal=tambah_copybuku"
                               class="btn btn-success">
                                <i class="fas fa-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="example1"
                                   class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Kode Copy Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Cetakan</th>
                                        <th>Tahun Terbit</th>
                                        <th>Jumlah</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = mysqli_query(
                                        $koneksi,
                                        "SELECT *
                                         FROM copybuku,buku
                                         WHERE copybuku.kdbuku=buku.kdbuku
                                         ORDER BY kdcopybuku ASC"
                                    );
                                    while ($row = mysqli_fetch_object($sql)) {
                                        ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row->kdcopybuku; ?></td>
                                            <td><?= $row->judul; ?></td>
                                            <td><?= $row->cetakan; ?></td>
                                            <td><?= $row->tahunterbit; ?></td>
                                            <td><?= $row->jumlah; ?></td>
                                            <td align="center">
                                                <a class="btn btn-warning btn-sm"
                                                   href="index.php?hal=edit_copybuku&kdcopybuku=<?= $row->kdcopybuku; ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                   href="index.php?hal=copybuku&action=hapus&kdcopybuku=<?= $row->kdcopybuku; ?>"
                                                   onclick="return confirm('Hapus data ini?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>