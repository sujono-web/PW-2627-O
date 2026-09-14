<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "hapus") {
        $nopinjam = $_GET['nopinjam'];
        $cek = mysqli_query(
            $koneksi,
            "SELECT *
            FROM pengembalian
            WHERE nopinjam='$nopinjam'"
        );
        if (mysqli_num_rows($cek) > 0) {
            ?>
            <script>
                alert('Data peminjaman tidak dapat dihapus karena sudah ada pengembalian!');
                document.location='index.php?hal=peminjaman';
            </script>
            <?php
        } else {
            $detail = mysqli_query(
                $koneksi,
                "SELECT *
                FROM pinjam
                WHERE nopinjam='$nopinjam'"
            );
            while ($d = mysqli_fetch_object($detail)) {
                mysqli_query(
                    $koneksi,
                    "UPDATE copybuku
                    SET jumlah=jumlah+$d->jlhpinjam
                    WHERE kdcopybuku='$d->nocopybuku'"
                );
            }
            mysqli_query(
                $koneksi,
                "DELETE FROM pinjam
                WHERE nopinjam='$nopinjam'"
            );
            mysqli_query(
                $koneksi,
                "DELETE FROM peminjaman
                WHERE nopinjam='$nopinjam'"
            );
            ?>
            <script>
                alert('Data peminjaman berhasil dihapus!');
                document.location='index.php?hal=peminjaman';
            </script>
            <?php
        }
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Peminjaman
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
                            <a href="index.php?hal=tambah_peminjaman"
                            class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            Tambah Peminjaman
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="example1"
                        class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">No Pinjam</th>
                                <th width="12%">Tanggal Pinjam</th>
                                <th width="12%">Harus Kembali</th>
                                <th>Anggota</th>
                                <th width="15%">Kelas</th>
                                <th width="18%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query(
                                $koneksi,
                                "SELECT p.*,
                                a.nama,
                                COUNT(pi.nocopybuku) AS jml_buku
                                FROM peminjaman p
                                LEFT JOIN anggota a
                                ON p.noanggota=a.noanggota
                                LEFT JOIN pinjam pi
                                ON p.nopinjam=pi.nopinjam
                                GROUP BY p.nopinjam
                                ORDER BY p.nopinjam DESC"
                            );
                            while ($row = mysqli_fetch_object($sql)) {
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->nopinjam ?></td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($row->tglpinjam)) ?>
                                    </td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($row->tglharuskembali)) ?>
                                    </td>
                                    <td>
                                        <?= $row->noanggota ?>
                                        -
                                        <?= $row->nama ?>
                                    </td>
                                    <td align="center">
                                        <?= $row->kelas ?>
                                    </td>
                                    <td align="center">
                                        <a href="index.php?hal=edit_peminjaman&nopinjam=<?= $row->nopinjam ?>"
                                         class="btn btn-info btn-sm">
                                         <i class="fas fa-pencil-alt"></i>
                                     </a>
                                     <a href="index.php?hal=peminjaman&aksi=hapus&nopinjam=<?= $row->nopinjam ?>"
                                         class="btn btn-danger btn-sm"
                                         onclick="return confirm('Apakah data ingin dihapus?')">
                                         <i class="fas fa-trash"></i>
                                     </a>
                                     <a href="cetak_pinjam.php?nopinjam=<?= $row->nopinjam ?>"
                                         class="btn btn-success btn-sm"
                                         target="_blank">
                                         CETAK
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