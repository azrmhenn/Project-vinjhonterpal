<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-green">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal = date('Y-m-d');
            // Query untuk menghitung total bahan
            $sql = "SELECT COUNT(*) AS total_bahan FROM tb_bahan";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $bahan = $row['total_bahan'] ?: 0;
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;"><?php echo $bahan; ?></h1>
            <p style="text-align: center;">Bahan</p>
          </div>
          <div class="icon">
            <i class="ion ion-md-cart"></i>
          </div>
          <a href="menu_sidebar/bahan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-yellow">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal = date('Y-m-d');
            // Query untuk menghitung total bahan
            $sql = "SELECT COUNT(id_produk) AS total_produk FROM tb_produk";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $bahan = $row['total_produk'] ?: 0;
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;"><?php echo $bahan; ?></h1>
            <p style="text-align: center;">Produk</p>
          </div>
          <div class="icon">
            <i class="fa fa-box"></i>
          </div>
          <a href="menu_sidebar/produk.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-red">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal = date('Y-m-d');
            // Query untuk menghitung total bahan
            $sql = "SELECT COUNT(id_pegawai) AS pegawai FROM tb_pegawai";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pegawai'] ?: 0;
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;"><?php echo $data; ?></h1>
            <p style="text-align: center;">Pegawai</p>
          </div>
          <div class="icon">
            <i class="fa fa-tags"></i>
          </div>
          <a href="menu_sidebar/pegawai.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-blue">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal = date('Y-m-d');
            // Query untuk menghitung total bahan
            $sql = "SELECT COUNT(id_user) AS pengguna FROM user";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pengguna'] ?: 0;
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;"><?php echo $data; ?></h1>
            <p style="text-align: center;">Pengguna</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="menu_sidebar/pengguna.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-blue">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal = date('Y-m-d');
            // Query untuk menghitung total bahan
            $sql = "SELECT SUM(jumlah) AS terjual FROM log_penjualan";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['terjual'] ?: 0;
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;"><?php echo $data; ?></h1>
            <p style="text-align: center;">Produk Terjual</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="menu_sidebar/penjualan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-blue">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal = date('Y-m-d'); // Mendapatkan tanggal hari ini dalam format Y-m-d

            // Query untuk menghitung total pemasukan (total uang) hari ini
            $sql = "SELECT SUM(total) AS pemasukan FROM log_penjualan WHERE tanggal = '$tanggal'";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pemasukan'] ?: 0; // Jika tidak ada data, set nilai 0
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;">Rp <?php echo number_format($data, 0, ',', '.'); ?></h1>
            <p style="text-align: center;">Pemasukan Hari Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-wallet"></i>
          </div>
          <a href="menu_sidebar/penjualan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-blue">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $bulan = date('m');  // Mendapatkan bulan ini (dalam format 2 digit, misalnya 12 untuk Desember)
            $tahun = date('Y');  // Mendapatkan tahun ini (misalnya 2024)

            // Query untuk menghitung total pemasukan (total uang) bulan ini
            $sql = "SELECT SUM(total) AS pemasukan FROM log_penjualan WHERE MONTH(STR_TO_DATE(tanggal, '%Y-%m-%d')) = '$bulan' AND YEAR(STR_TO_DATE(tanggal, '%Y-%m-%d')) = '$tahun'";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pemasukan'] ?: 0; // Jika tidak ada data, set nilai 0
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;">Rp <?php echo number_format($data, 0, ',', '.'); ?></h1>
            <p style="text-align: center;">Pemasukan Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-coins"></i>
          </div>
          <a href="menu_sidebar/penjualan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-blue">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tahun = date('Y');  // Mendapatkan tahun ini (misalnya 2024)

            // Query untuk menghitung total pemasukan (total uang) tahun ini
            $sql = "SELECT SUM(total) AS pemasukan FROM log_penjualan WHERE YEAR(STR_TO_DATE(tanggal, '%Y-%m-%d')) = '$tahun'";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pemasukan'] ?: 0; // Jika tidak ada data, set nilai 0
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;">Rp <?php echo number_format($data, 0, ',', '.'); ?></h1>
            <p style="text-align: center;">Pemasukan Tahun Ini</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="menu_sidebar/penjualan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-red">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tanggal_hari_ini = date('Y-m-d');  // Mendapatkan tanggal hari ini

            // Query untuk menghitung total pengeluaran hari ini
            $sql = "SELECT SUM(total) AS pengeluaran FROM log_pengeluaran WHERE tanggal = '$tanggal_hari_ini'";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pengeluaran'] ?: 0; // Jika tidak ada data, set nilai 0
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;">Rp <?php echo number_format($data, 0, ',', '.'); ?></h1>
            <p style="text-align: center;">Pengeluaran Hari Ini</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="menu_sidebar/pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-red">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $bulan_ini = date('m');  // Mendapatkan bulan ini (format MM)
            $tahun_ini = date('Y');  // Mendapatkan tahun ini (format YYYY)

            // Query untuk menghitung total pengeluaran bulan ini
            $sql = "SELECT SUM(total) AS pengeluaran FROM log_pengeluaran WHERE MONTH(tanggal) = '$bulan_ini' AND YEAR(tanggal) = '$tahun_ini'";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pengeluaran'] ?: 0; // Jika tidak ada data, set nilai 0
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;">Rp <?php echo number_format($data, 0, ',', '.'); ?></h1>
            <p style="text-align: center;">Pengeluaran Bulan Ini</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="menu_sidebar/pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="small-box bg-red">
          <div class="inner" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
            <?php
            $tahun_ini = date('Y');  // Mendapatkan tahun ini (format YYYY)

            // Query untuk menghitung total pengeluaran tahun ini
            $sql = "SELECT SUM(total) AS pengeluaran FROM log_pengeluaran WHERE YEAR(tanggal) = '$tahun_ini'";

            // Eksekusi query
            $result = $db->sqlquery($sql);

            // Cek apakah ada hasil yang ditemukan
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $data = $row['pengeluaran'] ?: 0; // Jika tidak ada data, set nilai 0
            }
            ?>
            <h1 style="font-weight: bolder; text-align: center;">Rp <?php echo number_format($data, 0, ',', '.'); ?></h1>
            <p style="text-align: center;">Pengeluaran Tahun Ini</p>
          </div>
          <div class="icon">
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="menu_sidebar/pengeluaran.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>
  </section>
</div>

<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php';
?>