<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/pegawai/header_sidebar.php';
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
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="bank.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="bank.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="bank.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <!-- <i class="ion ion-stats-bars"></i> -->
          </div>
          <a href="bank.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php';
?>
