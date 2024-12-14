<!DOCTYPE html>
<html>
<?php
include 'C:/laragon/www/MPSI/Project-vinjhonterpal/config.php';
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator - Sistem Informasi Keuangan</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Menggunakan BASE_URL_BOWER_COMPONENT untuk file dari bower_components -->
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_DIST; ?>css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_DIST; ?>css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>morris.js/morris.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_BOWER_COMPONENT; ?>bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_PLUGIN; ?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@6.0.0/dist/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="<?php echo BASE_URL_; ?>assets/style.css">

  <?php
  include 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
  $db = new database();
  session_start();
  $id = $_SESSION['id'];
  if ($_SESSION['status'] != "administrator_logedin") {
    header("redirect:index.php?alert=belum_login");
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
      <a href="<?php echo BASE_URL_ADM; ?>index.php" class="logo">
        <span class="logo-lg"><b><img src="<?php echo BASE_URL_IMG_SYS; ?>LOGO UMKM.png" style="width: 30px;height: auto"> Vin Jhon Terpal</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- foto user header -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                // $id = $_SESSION['id'];

                // Use the database class to fetch user profile
                $sql = "SELECT * FROM user WHERE id_user='$id'";
                $result = $db->sqlquery($sql);

                if ($result->num_rows > 0) {
                  $profil = $result->fetch_assoc();

                  // Construct the image URL based on the profile picture filename
                  $profile_picture_url = BASE_URL_IMG_USR . $profil['foto'];
                ?>
                  <img src="<?php echo $profile_picture_url; ?>" class="user-image">
                <?php } else { ?>
                  <img src="<?php echo BASE_URL_IMG_SYS; ?>user.png" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo $_SESSION['nama']; ?> - <?php echo $_SESSION['level']; ?></span>
              </a>
            </li>
            <li>
              <a href="<?php echo BASE_URL_; ?>admin/logout.php" onclick="return confirm('Apakah Anda yakin untuk logout?')">
                <i class="fa fa-sign-out"></i> LOGOUT
              </a>
            </li>
          </ul>
        </div>
        <!-- foto user header -->

      </nav>
    </header>
    <!-- header -->

    <!-- sidebar -->
    <aside class="main-sidebar">
      <section class="sidebar">

        <!-- foto user sidebar -->
        <div class="user-panel">
          <div class="pull-left image">
            <?php


            // Use the database class to fetch user profile
            $sql = "SELECT * FROM user WHERE id_user='$id'";
            $result = $db->sqlquery($sql);

            if ($result->num_rows > 0) {
              $profil = $result->fetch_assoc();

              // Construct the image URL based on the profile picture filename
              $profile_picture_url = BASE_URL_ . "gambar/user/" . $profil['foto'];
            ?>
              <img src="<?php echo $profile_picture_url; ?>" class="img-circle" style="max-height:45px">
            <?php } else { ?>
              <img src="<?php echo BASE_URL_; ?>gambar/sistem/user.png" class="img-circle" style="max-height:45px">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['nama']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- foto user sidebar -->

        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="<?php echo BASE_URL_ADM; ?>index.php">
              <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>produk.php">
              <i class="fa fa-cube"></i> <span>PRODUK</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>bahan.php">
              <i class="fa fa-archive"></i> <span>BAHAN</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>pegawai.php">
              <i class="fa fa-users"></i> <span>PEGAWAI</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>absensi.php">
              <i class="fa fa-calendar-check-o"></i> <span>ABSENSI</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>penjualan.php">
              <i class="fa fa-shopping-cart"></i> <span>PENJUALAN</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>pengeluaran.php">
              <i class="fa fa-money"></i> <span>PENGELUARAN</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>user.php">
              <i class="fa fa-users"></i> <span>PENGGUNA</span>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU; ?>penggajian.php">
              <i class="fa fa-dollar"></i> <span>PENGGAJIAN</span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-file"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo BASE_URL_ADM_MENU; ?>laporan_penjualan.php"><i class="fa fa-file-pdf-o"></i> Laporan Penjualan</a></li>
              <li><a href="<?php echo BASE_URL_ADM_MENU; ?>laporan_pengeluaran.php"><i class="fa fa-file-pdf-o"></i> Laporan Pengeluaran</a></li>
            </ul>
          </li>

          <li>
            <a href="<?php echo BASE_URL_ADM_MENU;; ?>gantipassword.php">
              <i class="fa fa-lock"></i> <span>GANTI PASSWORD</span>
            </a>
          </li>
        </ul>
        <!-- sidebar menu -->

      </section>
    </aside>
    <!-- /.sidebar -->