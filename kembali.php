<?php

$q = mysqli_query(
    $koneksi,
    "SELECT
        p.nokembali,
        p.tglkembali,
        p.nopinjam,
        a.noanggota,
        a.nama
     FROM pengembalian p
     JOIN peminjaman pm
       ON p.nopinjam = pm.nopinjam
     JOIN anggota a
       ON pm.noanggota = a.noanggota
     ORDER BY p.nokembali DESC"
);

?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Data Pengembalian Buku</h1>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Pengembalian
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <a href="index.php?hal=tambah_kembali"
                       class="btn btn-primary">

                        <i class="fas fa-plus"></i>
                        Tambah Pengembalian

                    </a>

                </div>


                <div class="card-body">

                    <table id="example1"
                           class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th width="5%">No</th>
                                <th>No Pengembalian</th>
                                <th>Tanggal Kembali</th>
                                <th>No Peminjaman</th>
                                <th>Tanggal Harus Kembali</th>
                                <th>Nama Anggota</th>
                                <th>Kelas</th>
                                <th width="15%">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php

                        $no = 1;

                        while ($row = mysqli_fetch_object($q)) {

                        ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><?= $row->nokembali ?></td>

                                <td><?= date('d-m-Y', strtotime($row->tglkembali)) ?></td>

                                <td><?= $row->nopinjam ?></td>

                                <td><?= $row->noanggota ?></td>

                                <td><?= $row->nama ?></td>

                                <td><?= $row->kelas ?></td>

                                <td align="center">

                                    <a href="#"
                                       class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <a href="#"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Apakah data ingin dihapus?')">

                                        <i class="fas fa-trash"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>