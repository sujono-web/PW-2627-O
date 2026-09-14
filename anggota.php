<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $noanggota = $_GET['noanggota'];

        $cek = mysqli_query(
            $koneksi,
            "SELECT *
            FROM peminjaman
            WHERE noanggota='$noanggota'"
        );

        if (mysqli_num_rows($cek) > 0) {
            ?>
            <script>
                alert('Data anggota tidak dapat dihapus karena masih digunakan pada data peminjaman!');
                document.location='index.php?hal=anggota';
            </script>
            <?php
        } else {
            $hapus = mysqli_query(
                $koneksi,
                "DELETE FROM anggota
                WHERE noanggota='$noanggota'"
            );

            if ($hapus) {
                ?>
                <script>
                    alert('Data anggota berhasil dihapus!');
                    document.location='index.php?hal=anggota';
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Data anggota gagal dihapus!');
                    document.location='index.php?hal=anggota';
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
                    <h1>Data Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Anggota
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
                            <a href="index.php?hal=tambah_anggota"
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
                                <th width="15%">No Anggota</th>
                                <th>Nama Anggota</th>
                                <th width="15%">Jenis Kelamin</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            $sql = mysqli_query(
                                $koneksi,
                                "SELECT *
                                FROM anggota
                                ORDER BY noanggota ASC"
                            );

                            while ($row = mysqli_fetch_object($sql)) {
                                ?>

                                <tr>

                                    <td><?= $no; ?></td>

                                    <td><?= $row->noanggota; ?></td>

                                    <td><?= $row->nama; ?></td>

                                    <td><?= $row->jenkel; ?></td>

                                    <td align="center">

                                        <a class="btn btn-warning btn-sm"
                                        href="index.php?hal=edit_anggota&noanggota=<?= $row->noanggota; ?>">

                                        <i class="fas fa-pencil-alt"></i>

                                    </a>

                                    <a class="btn btn-danger btn-sm"
                                    href="index.php?hal=anggota&action=hapus&noanggota=<?= $row->noanggota; ?>"
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