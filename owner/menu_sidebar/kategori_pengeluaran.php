<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
      require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Kategori
      <small>Pengeluaran</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Kategori Pengeluaran
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- tambah kategori pengeluaran -->
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
            <!-- tambah kategori pengeluaran -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "CALL kategori_png();"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['namaK']; ?></td>
                      <td><?php echo $d['keterangan']; ?></td>
                      <td>
                        <?php if ($d['namaK'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_kategori_<?php echo $d['id_kategori_pengeluaran'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_<?php echo $d['id_kategori_pengeluaran'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit kategori pengeluaran -->
                        <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
                          <div class="modal fade" id="edit_kategori_<?php echo $d['id_kategori_pengeluaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Pengeluaran</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama Kategori</label>
                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_kategori_pengeluaran']; ?>">
                                    <input type="text" name="namaK" required="required" class="form-control" value="<?php echo $d['namaK']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>keterangan</label>
                                    <input type="text" name="ket" required="required" class="form-control" value="<?php echo $d['keterangan']; ?>" style="width:100%">
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
