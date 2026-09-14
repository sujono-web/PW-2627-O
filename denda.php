<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $nodenda = $_GET['nodenda'];

        $cek = mysqli_query(
            $koneksi,
            "SELECT *
             FROM detaidenda
             WHERE nodenda='$nodenda'"
        );

        if (mysqli_num_rows($cek) > 0) {
            ?>
            <script>
                alert('Data denda tidak dapat dihapus karena masih digunakan pada data detail denda!');
                document.location='index.php?hal=denda';
            </script>
            <?php
        } else {
            $hapus = mysqli_query(
                $koneksi,
                "DELETE FROM denda
                 WHERE nodenda='$nodenda'"
            );

            if ($hapus) {
                ?>
                <script>
                    alert('Data denda berhasil dihapus!');
                    document.location='index.php?hal=denda';
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Data denda gagal dihapus!');
                    document.location='index.php?hal=denda';
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
                    <h1>Data Denda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Denda
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
                            <a href="index.php?hal=tambah_denda"
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
                                        <th width="15%">No Denda</th>
                                        <th>Nama Denda</th>
                                        <th width="20%">Besar Denda</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $no = 1;

                                    $sql = mysqli_query(
                                        $koneksi,
                                        "SELECT *
                                         FROM denda
                                         ORDER BY nodenda ASC"
                                    );

                                    while ($row = mysqli_fetch_object($sql)) {
                                        ?>

                                        <tr>

                                            <td><?= $no; ?></td>

                                            <td><?= $row->nodenda; ?></td>

                                            <td><?= $row->namadenda; ?></td>

                                            <td align="right">
                                                <?= number_format($row->besardenda, 2, ',', '.'); ?>
                                            </td>

                                            <td align="center">

                                                <a class="btn btn-warning btn-sm"
                                                   href="index.php?hal=edit_denda&nodenda=<?= $row->nodenda; ?>">

                                                    <i class="fas fa-pencil-alt"></i>

                                                </a>

                                                <a class="btn btn-danger btn-sm"
                                                   href="index.php?hal=denda&action=hapus&nodenda=<?= $row->nodenda; ?>"
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