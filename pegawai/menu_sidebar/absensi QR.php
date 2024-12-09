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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Absensi Pegawai
      <small>Check-in dan Check-out menggunakan Kamera</small>
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
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lihatAbsenModal">
                <i class="fa fa-eye"></i> Lihat Absensi
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- Tombol Kamera untuk Check-In / Check-Out -->
            <div class="text-center">
              <button id="startCameraBtn" class="btn btn-warning">Mulai Kamera</button>
            </div>

            <!-- Tampilan Kamera -->
            <div id="cameraContainer" style="display:none;">
              <video id="video" width="320" height="240" autoplay></video>
              <br>
              <button id="captureBtn" class="btn btn-success">Ambil Foto</button>
            </div>

            <!-- Modal untuk Lihat Absensi -->
            <div class="modal fade" id="lihatAbsenModal" tabindex="-1" role="dialog" aria-labelledby="lihatAbsenModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="lihatAbsenModalLabel">Data Absensi Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Agenda</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Tampilkan absensi yang sudah dilakukan
                        $query = "SELECT * FROM tb_absensi";
                        $data_absensi = $db->fetchdata($query);
                        foreach ($data_absensi as $d) {
                          $absenStatus = "Belum Check-In";
                          // Cek apakah pegawai sudah melakukan check-in atau check-out
                          $query_status = "SELECT * FROM tb_detail_absen WHERE id_absen = '{$d['id']}' AND id_pegawai = '$id'";
                          $statuses = $db->fetchdata($query_status);
                          if (!empty($statuses)) {
                            $status = $statuses[0];
                            $is_checkin = isset($status['chekin']) && !empty($status['chekin']);
                            $is_checked_out = isset($status['chekout']) && !empty($status['chekout']);
                            $absenStatus = $is_checkin ? ($is_checked_out ? 'Selesai' : 'Check-In') : 'Belum Check-In';
                          }
                        ?>
                          <tr>
                            <td><?php echo $d['tanggal']; ?></td>
                            <td><?php echo $d['agenda']; ?></td>
                            <td><?php echo $absenStatus; ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Modal -->
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>

<script>
  // Fungsi untuk memulai kamera
  document.getElementById('startCameraBtn').addEventListener('click', function() {
    const video = document.getElementById('video');
    const cameraContainer = document.getElementById('cameraContainer');
    cameraContainer.style.display = 'block'; // Tampilkan tampilan kamera

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({
          video: true
        })
        .then(function(stream) {
          // Menampilkan stream kamera di elemen video
          video.srcObject = stream;
        })
        .catch(function(error) {
          alert("Gagal mengakses kamera. Pastikan kamera terhubung.");
          console.error(error);
        });
    } else {
      alert("Fitur kamera tidak didukung oleh browser ini.");
    }
  });

  // Fungsi untuk mengambil foto (untuk absensi)
  document.getElementById('captureBtn').addEventListener('click', function() {
    const video = document.getElementById('video');
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    // Gambar snapshot dari video
    canvas.getContext('2d').drawImage(video, 0, 0);

    // Ambil data gambar dalam format base64
    const photoData = canvas.toDataURL('image/png');

    // Kirim data foto ke server untuk diproses (Check-In atau Check-Out)
    const formData = new FormData();
    formData.append('photo', photoData);
    formData.append('idP', '<?php echo $id; ?>'); // ID pegawai yang sedang absensi

    fetch('proc.php', { // Ganti dengan file PHP atau endpoint yang sesuai
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Absensi berhasil!');
          location.reload(); // Reload halaman untuk memperbarui status
        } else {
          alert('Gagal absensi');
        }
      })
      .catch(error => {
        alert('Terjadi kesalahan saat mengirim foto');
        console.error(error);
      });
  });
</script>