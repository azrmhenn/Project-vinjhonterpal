<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pegawai
      <small>posisi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>pegawai.php">Pegawai</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>posisi.php">Posisi</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Posisi
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- tambah kategori posisi -->
            <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Posisi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Posisi</label>
                        <input type="text" name="namaP" required="required" class="form-control" placeholder="Nama Posisi ..">
                      </div>
                      <div class="form-group">
                        <label>Upah Perjam</label>
                        <input type="text" name="upahP" required="required" class="form-control" placeholder="Upah Perjam ..">
                      </div>
                      <div class="form-group">
                        <label>Upah Lembur Perjam</label>
                        <input type="text" name="upahL" required="required" class="form-control" placeholder="Upah Lembur Perjam ..">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_posisi">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah kategori posisi -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%" >NO</th>
                    <th>Nama</th>
                    <th>Upah Perjam</th>
                    <th>Upah Lembur Perjam</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "CALL posisi();"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_posisi']; ?></td>
                      <td><?php echo $d['upah_perjam']; ?></td>
                      <td><?php echo $d['upah_lembur']; ?></td>
                      <td>
                        <?php if ($d['nama_posisi'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_posisi_<?php echo $d['id_posisi'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_posisi_<?php echo $d['id_posisi'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit posisi -->
                        <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
                          <div class="modal fade" id="edit_posisi_<?php echo $d['id_posisi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Posisi</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama posisi</label>
                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_posisi']; ?>">
                                    <input type="text" name="namaP" required="required" class="form-control" value="<?php echo $d['nama_posisi']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Upah Perjam</label>
                                    <input type="text" name="upahjam" required="required" class="form-control" value="<?php echo $d['upah_perjam']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Upah Lembur Perjam</label>
                                    <input type="text" name="upahlembur" required="required" class="form-control" value="<?php echo $d['upah_lembur']; ?>" style="width:100%">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary" name="edit_posisi">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form edit posisi -->
                          
                        <!-- form delete posisi -->
                        <div class="modal fade" id="hapus_posisi_<?php echo $d['id_posisi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_posisi=<?php echo $d['id_posisi'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div><div>
                            
                          </div>
                        </div>
                        <!-- form delete posisi -->

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
