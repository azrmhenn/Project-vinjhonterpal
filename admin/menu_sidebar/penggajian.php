<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';

$db = new database(); // Inisialisasi koneksi

// Proses pengambilan data berdasarkan filter tanggal
if (isset($_POST['filter'])) {
  $tanggalMulai = $_POST['tanggal_mulai'];
  $tanggalAkhir = $_POST['tanggal_akhir'];

  // Panggil prosedur untuk menghitung gaji
  $query = "CALL SP_TotalGajiPegawai('$tanggalMulai', '$tanggalAkhir')";
  $db->fetchdata($query);

  // Ambil data penggajian yang sudah dihitung
  $query = "SELECT tpg.id_pengambilan,tpos.nama_posisi,tp.nama_pegawai, tpg.tanggal_pengambilan, 
                     FLOOR(total_jam_kerja / 9) AS total_hari_kerja, 
                     tpg.total_jam_lembur, 
                     tpg.total_gaji, tp.id_pegawai
              FROM tb_pengambilan_gaji tpg
              JOIN tb_pegawai tp
                ON tp.id_pegawai = tpg.id_pegawai
              JOIN tb_posisi tpos
                ON tpos.id_posisi = tp.id_posisi
              WHERE tanggal_pengambilan BETWEEN '$tanggalMulai' AND '$tanggalAkhir'";
  $data = $db->fetchdata($query);
} else {
  // Default tanpa filter
  $data = [];
}
?>

<!-- Konten Halaman -->
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Penggajian
      <small>Data Pengambilan Gaji</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="">Penggajian</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <form method="POST" action="">
              <label>Tanggal:</label>
              <input type="date" name="tanggal_mulai" required>
              <input type="date" name="tanggal_akhir" required>
              <button type="submit" name="filter" class="btn btn-primary btn-sm">
                Hitung gaji
              </button>
            </form>
          </div>


          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pengambilan</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Total Hari Kerja</th>
                    <th>Total Jam Lembur</th>
                    <th>Total Gaji</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($data)) {
                    $no = 1;
                    foreach ($data as $d) { ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['tanggal_pengambilan']; ?></td>
                        <td><?php echo $d['nama_pegawai']; ?></td>
                        <td><?php echo $d['nama_posisi']; ?></td>
                        <td><?php echo $d['total_hari_kerja'] > 0 ? $d['total_hari_kerja'] . " hari" : "-"; ?></td>
                        <td>
                          <?php
                          if ($d['total_jam_lembur'] > 0) {
                            echo strpos($d['total_jam_lembur'], '.') === false
                              ? $d['total_jam_lembur'] . " jam"
                              : number_format($d['total_jam_lembur'], 2) . " jam";
                          } else {
                            echo "-";
                          }
                          ?>
                        </td>

                        <td>Rp <?php echo number_format($d['total_gaji'], 0, ',', '.'); ?></td>
                        <td>
                          <?php if ($d['nama_pegawai'] != 1) { ?>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_penggajian_<?php echo $d['id_pengambilan'] ?>">
                              <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_penggajian_<?php echo $d['id_pengambilan'] ?>">
                              <i class="fa fa-trash"></i>
                            </button>
                            <a href="slip_gaji_pdf.php?id_pegawai=<?php echo $d['id_pegawai']; ?>&tanggal_dari=<?php echo $tanggalMulai; ?>&tanggal_sampai=<?php echo $tanggalAkhir; ?>"
                              class="btn btn-primary btn-sm" target="_blank">
                              <i class="fa fa-print"></i>
                            </a>
                          <?php } ?>
                          <!-- form edit gaji -->
                          <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
                            <div class="modal fade" id="edit_penggajian_<?php echo $d['id_pengambilan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Gaji Pegawai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group" style="width:100%">
                                      <label>Nama</label>
                                      <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_pengambilan']; ?>">
                                      <input type="text" class="form-control" value="<?php echo $d['nama_pegawai']; ?>" style="width:100%" readonly>
                                    </div>
                                    <div class="form-group" style="width:100%">
                                      <label>Posisi</label>
                                      <input type="text" class="form-control" value="<?php echo $d['nama_posisi']; ?>" style="width:100%" readonly>
                                    </div>
                                    <div class="form-group" style="width:100%">
                                      <label>Jumlah Hari</label>
                                      <input type="number" name="hari" class="form-control" value="<?php echo $d['total_hari_kerja']; ?>" style="width:100%">
                                    </div>
                                    <div class="form-group" style="width:100%">
                                      <label>Jumlah Jam Lembur</label>
                                      <input type="number" name="hari" class="form-control" value="<?php echo $d['total_jam_lembur']; ?>" style="width:100%">
                                    </div>
                                    <div class="form-group" style="width:100%">
                                      <label>Total Gaji</label>
                                      <input type="number" name="hari" class="form-control" value="<?php echo $d['total_gaji']; ?>" style="width:100%">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="edit_KPG">Simpan</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                          <!-- form edit gaji -->

                          <!-- form delete kategori pengeluaran -->
                          <div class="modal fade" id="hapus_penggajian_<?php echo $d['id_pengambilan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Yakin ingin menghapus data ini ?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <a href="<?php echo BASE_URL_; ?>proc.php?del_KPG=<?php echo $d['id_pengambilan'] ?>" class="btn btn-primary">Hapus</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- form delete kategori pengeluaran -->

                        </td>
                      </tr>
                    <?php }
                  } else { ?>
                    <tr>
                      <td colspan="6" style="text-align: center;">Data tidak ditemukan</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>
</div>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>