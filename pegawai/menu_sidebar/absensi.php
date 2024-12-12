<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/pegawai/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';

$db = new database(); // Inisialisasi objek class database
$nama = $_SESSION['nama'];
$sql = "SELECT * FROM tb_pegawai WHERE nama_pegawai = '$nama'";
$result = $db->sqlquery($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id_pegawai'];
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Absensi Pegawai<?php echo $nama; ?>
      <small>Check-in dan Check-out</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Absensi Pegawai</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">
          <div class="box-header">
            <div class="btn-group pull-right">
            </div>
          </div>

          <div class="box-body">
            <!-- Tabel Data Absensi -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Tanggal</th>
                    <th>Agenda</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Ambil data absensi untuk hari ini
                  $query = "SELECT * FROM tb_absensi WHERE tanggal = CURDATE()";
                  $data_absensi = $db->fetchdata($query);

                  $no = 1;
                  foreach ($data_absensi as $d) {
                    $id_absensi = $d['id'];

                    // Query untuk memeriksa status absensi pegawai
                    $query_status = "SELECT * FROM tb_detail_absen WHERE id_absen = '$id_absensi' AND id_pegawai = '$id'";
                    $statuses = $db->fetchdata($query_status);
                    
                    if (!empty($statuses)) {
                        $status = $statuses[0];
                        $is_checkin = isset($status['chekin']) && !empty($status['chekin']);
                        $is_checked_out = isset($status['chekout']) && !empty($status['chekout']);
                    } else {
                        $is_checkin = false;
                        $is_checked_out = false;
                    }
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['tanggal']; ?></td>
                      <td><?php echo $d['agenda']; ?></td>
                      <td>
                        <form method="POST" action="<?php echo BASE_URL_; ?>proc.php">
                          <input type="hidden" name="id_absensi" value="<?php echo $d['id']; ?>">
                          <input type="hidden" name="idP" value="<?php echo $id; ?>">
                          <?php if (!$is_checkin) { ?>
                            <button type="submit" name="checkin" class="btn btn-warning">Check-In</button>
                          <?php } else { ?>
                            <button class="btn btn-success" disabled>Selesai</button>
                          <?php } ?>
                        </form>
                      </td>
                      <td>
                        <form method="POST" action="<?php echo BASE_URL_; ?>proc.php">
                          <input type="hidden" name="id_absensi" value="<?php echo $d['id']; ?>">
                          <input type="hidden" name="idP" value="<?php echo $id; ?>">
                          <?php if (!$is_checked_out) { ?>
                            <button type="submit" name="checkout" class="btn btn-warning">Check-Out</button>
                          <?php } else { ?>
                            <button class="btn btn-success" disabled>Selesai</button>
                          <?php } ?>
                        </form>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- End Tabel Data Absensi -->
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>
