<?php
    session_start();
    
    require_once("dtbase/koneksi.php");

   if(isset($_GET['action'])){
      if($_GET['action']=="keluar"){
        session_destroy();
         echo "<meta http-equiv='refresh' content='0 url=login.php'>";
         exit();
      }
   }
    if(isset($_SESSION['username'])){
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMP IT BAHRUL HUDA</title>

 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="halaman/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="halaman/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="halaman/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="halaman/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="halaman/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="halaman/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="halaman/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->

  <link rel="stylesheet" href="halaman/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="halaman/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="halaman/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="halaman/dist/css/adminlte.min.css">


  <link rel="stylesheet" href="halaman/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="halaman/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

   <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
           <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="halaman/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Peminjaman</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="halaman/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['username']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- MENU MASTER -->
     <?php
    $hal = "";
    if (isset($_GET["hal"])):
      $hal = $_GET["hal"];
    endif;

    // Tambahan agar menu yang aktif tetap terbuka
    $master = array('buku','tambah_buku','edit_buku','copybuku','tambah_copybuku','edit_copybuku','anggota','tambah_anggota','edit_anggota','denda','tambah_denda','edit_denda');
    $transaksi = array('peminjaman','tambah_peminjaman','edit_peminjaman','kembali','tambah_kembali','edit_kembali','sanksidenda','tambah_sanksidenda','edit_sanksidenda');
    $laporan = array('lapkembali');
?>

          <li class="nav-item <?php if(in_array($hal,$master)) echo 'menu-open'; ?>">

<?php 
  if($_SESSION['hak']=="staff"){
?>
<!------------------------------------MENU UNUTK ADMIN------------------------------------------------------------->
            <a href="#" class="nav-link <?php if(in_array($hal,$master)) echo 'active'; ?>">
              <i class="fas fa-table"></i>
              <p>
                MENU MASTER
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=buku" class="nav-link <?php if ($hal=='buku' || $hal=='tambah_buku' || $hal=='edit_buku') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Buku</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?hal=copybuku" class="nav-link <?php if ($hal=='copybuku' || $hal=='tambah_copybuku' || $hal=='edit_copybuku') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Copy Buku</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?hal=denda" class="nav-link <?php if ($hal=='denda' || $hal=='tambah_denda' || $hal=='edit_denda') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Denda</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?hal=anggota" class="nav-link <?php if ($hal=='anggota' || $hal=='tambah_anggota' || $hal=='edit_anggota') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Anggota</p>
                </a>
              </li>

            </li>
          </ul>
         

         <!-- MENU TRANSAKSI -->
         <li class="nav-item <?php if(in_array($hal,$transaksi)) echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if(in_array($hal,$transaksi)) echo 'active'; ?>">
              <i class="fas fa-baby-carriage"></i>
              <p>
                MENU TRANSAKSI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=peminjaman" class="nav-link <?php if ($hal=='peminjaman' || $hal=='tambah_peminjaman' || $hal=='edit_peminjaman') echo 'active'; ?>" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Peminjaman</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?hal=kembali" class="nav-link <?php if ($hal=='kembali' || $hal=='tambah_kembali' || $hal=='edit_kembali') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengembalian</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="index.php?hal=sanksidenda" class="nav-link <?php if ($hal=='sanksidenda' || $hal=='tambah_sanksidenda' || $hal=='edit_sanksidenda') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Sanksi Denda</p>
                </a>
              </li>
            </ul>
          </li>

 <!-- MENU LAPORAN -->

          <li class="nav-item <?php if(in_array($hal,$laporan)) echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if(in_array($hal,$laporan)) echo 'active'; ?>">
              <i class="fas fa-print"></i>
              <p>
                MENU LAPORAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=lapkembali" class="nav-link <?php if ($hal=='lapkembali') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Peminjaman dan Pengembalian Buku</p>
                </a>
              </li>
            </ul>
          </li>
<?php $halaman="anggota.php"; }elseif($_SESSION['hak']=="kepsek"){
    $halaman="lapkembali.php"; ?>
    <li class="nav-item <?php if(in_array($hal,$laporan)) echo 'menu-open'; ?>">
            <a href="#" class="nav-link <?php if(in_array($hal,$laporan)) echo 'active'; ?>">
              <i class="fas fa-print"></i>
              <p>
                MENU LAPORAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=lapkembali" class="nav-link <?php if ($hal=='lapkembali') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Perpustakaan</p>
                </a>
              </li>
            </ul>
          </li>
 <?php }?>          
<!------------------------------------MENU UNUTK ANGGOTA------------------------------------------------------------->
<!-- KELUAR -->
          <li class="nav-item menu-open">
            <a href="index.php?action=keluar" class="nav-link active">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                  KELUAR
               <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
<!-- AKHIR KELUAR -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <?php
    if (isset($_GET["hal"])):
       $hal = $_GET["hal"];
      include($_GET["hal"].".php");
    else:
      include($halaman);
    endif;
  ?>
  <!-- /.content-wrapper -->
  

  <footer class="main-footer">
    <strong>Copyright &copy; 2025-2026 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="halaman/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="halaman/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="halaman/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="halaman/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="halaman/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="halaman/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="halaman/plugins/moment/moment.min.js"></script>
<script src="halaman/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="halaman/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="halaman/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="halaman/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes 
<script src="halaman/dist/js/demo.js"></script>  -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="halaman/dist/js/pages/dashboard.js"></script>

<!-- jQuery -->
<script src="halaman/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="halaman/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="halaman/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="halaman/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="halaman/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="halaman/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="halaman/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="halaman/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="halaman/plugins/jszip/jszip.min.js"></script>
<script src="halaman/plugins/pdfmake/pdfmake.min.js"></script>
<script src="halaman/plugins/pdfmake/vfs_fonts.js"></script>
<script src="halaman/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="halaman/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="halaman/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="halaman/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="halaman/dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>

<?php
  }else{
    echo"<meta http-equiv='refresh' content='0 url =login.php'>";
  }
?>  
  