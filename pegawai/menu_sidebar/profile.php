<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/pegawai/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';

$db = new database(); // Inisialisasi objek class database
$nama = $_SESSION['nama'];

// Ambil data pegawai berdasarkan nama
$sql = "CALL profile_view('$nama')";
$result = $db->sqlquery($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) { // Mulai perulangan untuk setiap data pegawai
    $id = $row['id_pegawai'];
    $namaP = $row['namaPeg'];
    $namaPos = $row['namaPos'];
    $ds = $row['desa'];
    $kec = $row['kec'];
    $kab = $row['kab'];
    $prov = $row['prov'];
    $telp = $row['no_hp'];

    $query = "SELECT foto FROM user WHERE nama = '$nama'";
    $resultFoto = $db->sqlquery($query);
    $foto = ""; // Inisialisasi variabel foto
    if ($resultFoto->num_rows > 0) {
      while ($rowFoto = $resultFoto->fetch_assoc()) {
        $foto = $rowFoto['foto'];
      }
    }

    // Tentukan URL foto atau gambar default
    $fotoUrl = !empty($foto) ? BASE_URL_IMG_USR . $foto : BASE_URL_IMG_SYS . "user.png";
?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Profil Pegawai
          <small>Informasi Data Pegawai</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Profile</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <!-- Profil Foto dan Data -->
          <section class="col-lg-8 col-lg-offset-2">
            <div class="box box-info">
              <div class="box-body">
                <div class="row">
                  <!-- Foto Pegawai -->
                  <div class="col-md-4 text-center">
                    <img 
                      src="<?php echo $fotoUrl; ?>" 
                      alt="Foto Pegawai" 
                      class="img-thumbnail" 
                      style="width: 100%; max-width: 200px; height: auto;">
                    <h3 class="mt-3"><?php echo $namaP; ?></h3>
                  </div>

                  <!-- Data Diri -->
                  <div class="col-md-8">
                    <table class="table table-bordered">
                      <tr>
                        <th>Nama</th>
                        <td><?php echo $namaP; ?></td>
                      </tr>
                      <tr>
                        <th>Posisi</th>
                        <td><?php echo $namaPos; ?></td>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <td>
                          <?php echo $ds . ", " . $kec . ", " . $kab . ", " . $prov; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Telepon</th>
                        <td><?php echo $telp; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </section>
    </div>

<?php
  } // Tutup while
} else {
  echo "<p class='text-danger text-center'>Data pegawai tidak ditemukan.</p>";
}
?>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>
