<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    die();
}
require '../koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>KasKita | Home</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-auto">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <h3 class="brand-text font-weight-bold">KasKita</h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo ucwords($_SESSION['username']); ?></a>
        </div>
      </div>
      <!--side-->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="home.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="masuk.php" class="nav-link">
              <i class="fa fa-institution"></i>
              <p>
                PEMASUKAN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="keluar.php" class="nav-link">
              <i class="fa fa-cart-arrow-down"></i>
              <p>
                PENGELUARAN
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="rekap.php" class="nav-link">
              <i class="fa fa-pie-chart"></i>
              <p>
                RAKAPITULASI DANA
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="fa fa-sign-out"></i>
              <p>
                LOGOUT
              </p>
            </a>
          </li>  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php 
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$sql = mysqli_query($koneksi, "SELECT * FROM kas");
while($data=mysqli_fetch_assoc($sql)) {

    $jml = $data['masuk'];
    $total_masuk = $total_masuk+$jml;

    $jml_keluar = $data['keluar'];
    $total_keluar = $total_keluar+$jml_keluar;

    $total = $total_masuk-$total_keluar;
}
?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-shopping-bag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pemasukan</span>
                <span class="info-box-number"><?php echo "Rp. " . number_format($total_masuk); ?>,-</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengeluaran</span>
                <span class="info-box-number"><?php echo "Rp. " . number_format($total_keluar); ?>,-</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-pie-chart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number"><?php echo "Rp. " . number_format($total); ?>,-</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Petunjuk Penggunaan</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <dl>
                      <dt>FUNGSI</dt>
                          <dd>
                            Aplikasi ini memiliki beberpa fungsi, antara lain:
                            <ol>
                              <li>input data pemasukan dan pengeluaran dana</li>
                              <li>list data pemasukan dan pengeluaran dana</li>
                              <li>rekapitulasi dana</li>
                            </ol>
                          <dt>catatan Penggunaan</dt>
                          <dd>
                            Untuk menginput data jumlah dana yang dimasukan atau di keluarkan, tidak menggunakan tanda "." (titik) dan tidak menggunakan Rp. (contoh: "100000")<br>
                            Aplikasi ini bersifat open source, bebas dipergunakan dan bebas untuk dikembangkan lagi<br>dilarang untuk diperjual belikan, tetapi boleh mengambil keuntungan dari proses instalasi
                          <dt>Info</dt>
                          <dd>
                            <ol>
                              <li>PHP V.7.x</li>
                              <li>Theme By: AdminLte v.3 + sweetalert2</li> 
                              <li>Update: 17 november 2020</li>
                            </ol>
                            Info lebih lanjut mengenai aplikasi:
                              <ul>
                                  <li><a href="https://api.whatsapp.com/send?phone=62895611025559" target="blank"><i class="fa fa-whatsapp"></i> : 0895611024559</a></li>
                                  <li><a href="mailto:fajarrivaldi2015@gmail.com"><i class="fa fa-envelope-o"></i> : fajarrivaldi2015@gmail.com</a></li>
                              </ul>
                              <p style="text-align: center">~<i> Fajar Rivaldi Chan </i><i class="fa fa-smile-o"></i>  ~</p>
                          </dd>
                      </dl>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
      </div>
    </div>    
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <a href="http://chanofficial.my.id">chanofficial</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 KasKita.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
