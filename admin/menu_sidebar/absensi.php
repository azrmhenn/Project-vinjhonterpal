<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';

$db = new database(); // Inisialisasi objek class database

// Ambil data absensi dari semua pegawai
$sql = "CALL get_all_absensi()"; // Query untuk mendapatkan semua absensi pegawai
$data_absensi = $db->fetchdata($sql);
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Absensi Pegawai
      <small>Kelola Absensi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>absensi.php">Absensi</a></li>
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
            <form id="form_add_agenda" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
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
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Agenda</th>
                    <th width="10%" style="text-align: center;">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "SELECT * FROM tb_absensi"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td style="text-align: center;"><?php echo $d['tanggal']; ?></td>
                      <td style="text-align: center;"><?php echo $d['agenda'] ?></td>
                      <td>
                        <?php if ($d['agenda'] != 1) { ?>
                          <a href="lihat_absensi.php?id=<?php echo $d['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-file"></i>
                          </a>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_agenda_<?php echo $d['id'] ?> ">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_agenda_<?php echo $d['id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit absensi -->
                        <form id="form_alamat_1" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_agenda_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Absensi</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="width:100%">
                                  <div class="form-group" style="width:100%">
                                    <label>Agenda</label>
                                    <input type="hidden" name="idA" required="required" class="form-control" value="<?php echo $d['id']; ?>">
                                    <input type="text" name="namaA" required="required" class="form-control" value="<?php echo $d['agenda']; ?>" style="width:100%">
                                  </div><br><br>
                                  <div class="form-group">
                                    <label for="tanggal">Tanggal</label><br>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $d['agenda']; ?>">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary" name="edit_pegawai">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form edit absensi -->

                        <!-- form delete absensi -->
                        <div class="modal fade" id="hapus_agenda_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_absensi=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form delete absensi -->

                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- tabel data -->
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>