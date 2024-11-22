<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator - Sistem Informasi Keuangan</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="http://localhost/vinjhonterpal/assets/style.css">

  <?php
  include 'C:/laragon/www/vinjhonterpal/class_db.php';
  $db = new database();
  session_start();
  if ($_SESSION['status'] != "administrator_logedin") {
    header("location:http://localhost/vinjhonterpal/index.php?alert=belum_login");
  }
  ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <style>
    #table-datatable {
      width: 100% !important;
    }

    #table-datatable .sorting_disabled {
      border: 1px solid #f4f4f4;
    }
  </style>
  <div class="wrapper">
    <!-- header -->
      <header class="main-header">
        <a href="http://localhost/vinjhonterpal/admin/index.php" class="logo">
          <span class="logo-lg"><b><img src="http://localhost/vinjhonterpal/gambar/sistem/LOGO UMKM.png" style="width: 30px;height: auto"> Vin Jhon Terpal</b></span>
        </a>
        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php
                  $id_user = $_SESSION['id'];

                  // Use the database class to fetch user profile
                  $sql = "SELECT * FROM user WHERE id_user='$id_user'";
                  $result = $db->sqlquery($sql);

                  if ($result->num_rows > 0) {
                    $profil = $result->fetch_assoc();

                    // Construct the image URL based on the profile picture filename
                    $profile_picture_url = "http://localhost/vinjhonterpal/gambar/user/" . $profil['foto'];
                  ?>
                    <img src="<?php echo $profile_picture_url; ?>" class="user-image">
                  <?php } else { ?>
                    <img src="http://localhost/vinjhonterpal/gambar/sistem/user.png" class="user-image">
                  <?php } ?>
                  <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - <?php echo $_SESSION['level']; ?></span>
                </a>
              </li>
              <li>
                <a href="http://localhost/vinjhonterpal/admin/logout.php" onclick="return confirm('Apakah Anda yakin untuk logout?')">
                  <i class="fa fa-sign-out"></i> LOGOUT
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    <!-- header -->

    <!-- sidebar -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <?php
              $id_user = $_SESSION['id'];

              // Use the database class to fetch user profile
              $sql = "SELECT * FROM user WHERE id_user='$id_user'";
              $result = $db->sqlquery($sql);

              if ($result->num_rows > 0) {
                $profil = $result->fetch_assoc();

                // Construct the image URL based on the profile picture filename
                $profile_picture_url = "http://localhost/vinjhonterpal/gambar/user/" . $profil['foto'];
              ?>
                <img src="<?php echo $profile_picture_url; ?>" class="img-circle" style="max-height:45px">
              <?php } else { ?>
                <img src="http://localhost/vinjhonterpal/gambar/sistem/user.png" class="img-circle" style="max-height:45px">
              <?php } ?>
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nama']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div> 1
          </div>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li>
              <a href="kategori.php">
                <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
              </a>
            </li>

            <li>
              <a href="http://localhost/vinjhonterpal/admin/menu_sidebar/produk.php">
                <i class="fa fa-folder"></i> <span>PRODUK</span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>KATEGORI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php"><i class="fa fa-circle-o"></i> Data Kategori Produk</a></li>
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_pengeluaran.php"><i class="fa fa-circle-o"></i> Data Kategori Pengeluaran</a></li>
              </ul>
            </li>

            <li>
              <a href="transaksi.php">
                <i class="fa fa-folder"></i> <span>BAHAN</span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file"></i> <span>PEGAWAI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/pegawai.php"><i class="fa fa-circle-o"></i> Data Pegawai</a></li>
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php"><i class="fa fa-circle-o"></i> Data Absensi</a></li>
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php"><i class="fa fa-circle-o"></i> Data Posisi</a></li>
              </ul>
            </li>

            <li>
              <a href="transaksi.php">
                <i class="fa fa-folder"></i> <span>PEMASOK</span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file"></i> <span>LAPORAN</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php.php"><i class="fa fa-circle-o"></i> Keluar</a></li>
                <li><a href="http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php.php"><i class="fa fa-circle-o"></i> Masuk</a></li>
              </ul>
            </li>

            <li>
              <a href="http://localhost/vinjhonterpal/admin/menu_sidebar/user.php">
                <i class="fa fa-users"></i> <span>DATA PENGGUNA</span>
              </a>
            </li>

            <li>
              <a href="http://localhost/vinjhonterpal/admin/menu_sidebar/gantipassword.php">
                <i class="fa fa-lock"></i> <span>GANTI PASSWORD</span>
              </a>
            </li>

          </ul>
        </section>
      </aside>
    <!-- /.sidebar -->