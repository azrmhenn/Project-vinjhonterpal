<?php
ob_start(); // Mulai buffering output
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
require_once 'phpqrcode/qrlib.php';

$db = new database(); // Inisialisasi objek class database

// Folder untuk menyimpan QR Code
$qrcodeFolder = 'qrcodes/';
if (!file_exists($qrcodeFolder)) {
    mkdir($qrcodeFolder, 0777, true);
}

// Tambah agenda jika ada form yang dikirim
if (isset($_POST['add_agenda'])) {
    $agenda = $_POST['agenda'];
    $tanggal = $_POST['tanggal'];

    $query = "INSERT INTO tb_absensi (tanggal, agenda) VALUES ('$tanggal', '$agenda')";
    $db->sqlquery($query);
    header('Location: absensi.php'); // Redirect setelah menambah agenda
    exit();
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Absensi Pegawai <small>Kelola Absensi Pegawai</small></h1>
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
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#inputAbsensiModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Agenda Absensi
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- Modal Input Absensi -->
            <form id="form_add_agenda" action="absensi.php" method="post">
              <div class="modal fade" id="inputAbsensiModal" tabindex="-1" role="dialog" aria-labelledby="inputAbsensiModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="inputAbsensiModalLabel">Tambah Agenda Absensi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="agenda">Agenda Absensi</label>
                        <input type="text" class="form-control" id="agenda" name="agenda" placeholder="Masukkan agenda" required>
                      </div>
                      <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_agenda">Tambah Agenda</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- End Modal Input Absensi -->

            <!-- Tabel Data Absensi -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Tanggal</th>
                    <th>Agenda</th>
                    <th>QR Check-In</th>
                    <th>QR Check-Out</th>
                    <th>Aksi</th> <!-- Tambah kolom untuk tombol cetak -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM tb_absensi";
                  $data = $db->fetchdata($query);
                  $no = 1;

                  foreach ($data as $d) {
                      $id_absen = $d['id'];
                      $tanggal = $d['tanggal'];
                      $agenda = $d['agenda'];

                      // Generate QR Code
                      $checkinQRCodePath = $qrcodeFolder . "checkin_$id_absen.png";
                      $checkoutQRCodePath = $qrcodeFolder . "checkout_$id_absen.png";
                      $checkinData = "CheckIn|ID_ABSEN:$id_absen|AGENDA:$agenda|TANGGAL:$tanggal";
                      $checkoutData = "CheckOut|ID_ABSEN:$id_absen|AGENDA:$agenda|TANGGAL:$tanggal";

                      if (!file_exists($checkinQRCodePath)) {
                          QRcode::png($checkinData, $checkinQRCodePath, QR_ECLEVEL_L, 10);
                      }
                      if (!file_exists($checkoutQRCodePath)) {
                          QRcode::png($checkoutData, $checkoutQRCodePath, QR_ECLEVEL_L, 10);
                      }
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $tanggal; ?></td>
                      <td><?php echo $agenda; ?></td>
                      <td><img src="qrcodes/checkin_<?php echo $id_absen; ?>.png" width="100" alt="QR Code Check-In"></td>
                      <td><img src="qrcodes/checkout_<?php echo $id_absen; ?>.png" width="100" alt="QR Code Check-Out"></td>
                      <td>
                        <!-- Tombol Print -->
                        <button class="btn btn-success btn-sm" onclick="printQRCode('<?php echo $checkinQRCodePath; ?>', '<?php echo $checkoutQRCodePath; ?>')">Cetak QR Code</button>
                      </td>
                    </tr>
                  <?php } ?>
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

<script type="text/javascript">
  function printQRCode(checkinPath, checkoutPath) {
    var printWindow = window.open('', '', 'width=800, height=600');
    printWindow.document.write('<html><head><title>Cetak QR Code</title></head><body>');
    printWindow.document.write('<h3>QR Code Check-In</h3>');
    printWindow.document.write('<img src="' + checkinPath + '" width="200" alt="QR Code Check-In"><br><br>');
    printWindow.document.write('<h3>QR Code Check-Out</h3>');
    printWindow.document.write('<img src="' + checkoutPath + '" width="200" alt="QR Code Check-Out"><br><br>');
    printWindow.document.write('<button onclick="window.print()">Print</button>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
  }
</script>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; 
ob_end_flush(); // Akhiri buffering output dan kirim ke browser?> 
