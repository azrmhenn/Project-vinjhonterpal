<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM tb_absensi where id = '$id'";
$result = $db->sqlquery($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $agenda = $row['agenda'];
    $tgl = $row['tanggal'];
  }
}
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Data
      <small>Absensi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>absensi.php">Absensi</a></li>
      <li class="active"><a href="">Lihat Absensi</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <div class="btn-group pull-right">
              <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Kategori Pengeluaran
              </button> -->
            </div>
            <h3>Agenda <?php echo $agenda ?></h3><br><span>Tanggal : <?php echo $tgl?></span>
          </div>

          <div class="box-body">
            <!-- tambah absensi -->
            <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Pengeluaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="namaK" required="required" class="form-control" placeholder="Nama Kategori ..">
                      </div>
                      <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="ket" required="required" class="form-control" placeholder="Keterangan ..">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_KPG">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah absensi -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Waktu Check-IN</th>
                    <th>Waktu Check-OUT</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "CALL lihat_absen('$id');"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['namaP']; ?></td>
                      <td><?php echo $d['namaPos']; ?></td>
                      <td><?php echo $d['chekin']; ?></td>
                      <td><?php echo $d['chekout']; ?></td>
                      <td>
                        <?php if ($d['namaP'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_absen_<?php echo $d['id_pegawai'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_<?php echo $d['id_pegawai'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit kategori pengeluaran -->
                        <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
                          <div class="modal fade" id="edit_absen_<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Absensi</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama</label>
                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_pegawai']; ?>">
                                    <input type="text" name="namaP" required="required" class="form-control" value="<?php echo $d['namaP']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Check-IN</label>
                                    <input type="time" name="ket" required="required" class="form-control" value="<?php echo $d['chekin']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Check-OUT</label>
                                    <input type="time" name="ket" required="required" class="form-control" value="<?php echo $d['chekout']; ?>" style="width:100%">
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
                        <!-- form edit kategori pengeluaran -->

                        <!-- form delete kategori pengeluaran -->
                        <div class="modal fade" id="hapus_kategori_<?php echo $d['id_kategori_pengeluaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_KPG=<?php echo $d['id_kategori_pengeluaran'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form delete kategori pengeluaran -->

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