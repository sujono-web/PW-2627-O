<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "hapus") {
        $nosanksi = $_GET['nosanksi'];
        $cek = mysqli_query(
            $koneksi,
            "SELECT *
            FROM detaidenda
            WHERE nosanksi='$nosanksi'"
        );
        if (mysqli_num_rows($cek) > 0) {
            ?>
            <script>
                alert('Data sanksi tidak dapat dihapus karena masih digunakan pada detail denda!');
                document.location='index.php?hal=sanksidenda';
            </script>
            <?php
        } else {
            $hapus = mysqli_query(
                $koneksi,
                "DELETE FROM sanksidenda
                WHERE nosanksi='$nosanksi'"
            );
            if ($hapus) {
                ?>
                <script>
                    alert('Data sanksi denda berhasil dihapus!');
                    document.location='index.php?hal=sanksidenda';
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Data sanksi denda gagal dihapus!');
                    document.location='index.php?hal=sanksidenda';
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
                    <h1>Data Sanksi Denda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Sanksi Denda
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
                            <a
                            href="index.php?hal=tambah_sanksidenda"
                            class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            Tambah
                        </a>
                    </div>
                    <div class="card-body">
                        <table
                        id="example1"
                        class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nomor Sanksi</th>
                                <th>Tanggal Sanksi</th>
                                <th>Nomor Kembali</th>
                                <th>Tanggal Kembali</th>
                                <th>Nomor Pinjam</th>
                                <th>Tanggal Harus Kembali</th>
                                <th>Nama Anggota</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query(
                                $koneksi,
                                "SELECT
                                s.nosanksi,
                                s.tglsanksi,
                                pg.nokembali,
                                pg.tglkembali,
                                pm.nopinjam,
                                pm.tglharuskembali,
                                a.nama
                                FROM sanksidenda s
                                JOIN pengembalian pg
                                ON s.nokembali = pg.nokembali
                                JOIN peminjaman pm
                                ON pg.nopinjam = pm.nopinjam
                                JOIN anggota a
                                ON pm.noanggota = a.noanggota
                                ORDER BY s.nosanksi DESC"
                            );
                            while ($row = mysqli_fetch_object($sql)) {
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row->nosanksi; ?></td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($row->tglsanksi)); ?>
                                    </td>
                                    <td><?= $row->nokembali; ?></td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($row->tglkembali)); ?>
                                    </td>
                                    <td><?= $row->nopinjam; ?></td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($row->tglharuskembali)); ?>
                                    </td>
                                    <td><?= $row->nama; ?></td>
                                    <td align="center">
                                        <a
                                        href="index.php?hal=edit_sanksidenda&nosanksi=<?= $row->nosanksi; ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a
                                    href="index.php?hal=sanksidenda&aksi=hapus&nosanksi=<?= $row->nosanksi; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">
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