<?php
if (isset($_GET['action'])) {
  if ($_GET['action'] == "hapus") {
    $kdbuku = $_GET['kdbuku'];
    // Cek apakah buku sudah dipakai pada tabel copybuku
    $cek = mysqli_query(
      $koneksi,
      "SELECT *
       FROM copybuku
       WHERE kdbuku='$kdbuku'"
    );
    if (mysqli_num_rows($cek) > 0) {
      ?>
      <script>
        alert('Data buku tidak dapat dihapus karena masih digunakan pada data copy buku!');
        document.location='index.php?hal=buku';
      </script>
      <?php
    } else {
      $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM buku
         WHERE kdbuku='$kdbuku'"
      );
      if ($hapus) {
        ?>
        <script>
          alert('Data buku berhasil dihapus!');
          document.location='index.php?hal=buku';
        </script>
        <?php
      } else {
        ?>
        <script>
          alert('Data buku gagal dihapus!');
          document.location='index.php?hal=buku';
        </script>
        <?php
      }
    }
  }
}
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Buku</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active">
              Buku
            </li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="index.php?hal=tambah_buku"
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
                    <th width="10%">Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tempat Terbit</th>
                    <th>Klasifikasi</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $sql = mysqli_query(
                    $koneksi,
                    "SELECT *
                     FROM buku
                     ORDER BY kdbuku ASC"
                  );
                  while ($row = mysqli_fetch_object($sql)) {
                  ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row->kdbuku; ?></td>
                      <td><?= $row->judul; ?></td>
                      <td><?= $row->pengarang; ?></td>
                      <td><?= $row->penerbit; ?></td>
                      <td><?= $row->tmpterbit; ?></td>
                      <td><?= $row->klasifikasi; ?></td>
                      <td align="center">
                        <a class="btn btn-warning btn-sm"
                           href="index.php?hal=edit_buku&kdbuku=<?= $row->kdbuku; ?>">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm"
                           href="index.php?hal=buku&action=hapus&kdbuku=<?= $row->kdbuku; ?>"
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
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>