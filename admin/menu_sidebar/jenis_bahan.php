<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
// $sql = "call pegawai()";
// $d = $db->datasql($sql);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Bahan
      <small>Jenis</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>bahan.php">Bahan</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>jenis_bahan.php">Jenis Bahan</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahpegawai">
                <i class="fa fa-plus"></i> &nbsp Tambah Jenis Bahan
              </button>
              <a href="bahan.php">
                <button type="button" class="btn btn-info btn-sm" style="margin-left: 10px;">
                  &nbsp Kembali
                </button>
              </a>
            </div>
          </div>

          <div class="box-body">
            <!-- tambah jenis bahan -->
            <form id="form_jenis" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="tambahpegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" name="jenis" required="required" class="form-control" placeholder="Nama Jenis ..">
                      </div>
                      <div class="form-group">
                        <label>Merk</label>
                        <select class="form-control" name="merk" required="required">
                          <option selected> - Pilih Merk - </option>
                          <?php
                          $sql = "call merk_only()";
                          $data = $db->fetchdata($sql);
                          foreach ($data as $dat) {
                            echo "<option value='" . $dat['id'] . "'>" . $dat['nama_merk'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_jenis_bahan">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah jenis bahan -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Nama</th>
                    <th>Merk</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "call jenis_bahan()"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['namaJ']; ?></td>
                      <td><?php echo $d['nama_merk']; ?></td>
                      <td>
                        <?php if ($d['namaJ'] && $d['nama_merk'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_jenis_<?php echo $d['id'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_jenis_<?php echo $d['id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit jenis bahan -->
                        <form id="form_jenis_bahan" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_jenis_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Pemasok</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width:100%">
                                    <label>Jenis</label><br>
                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id']; ?>">
                                    <input type="text" name="jenis" class="form-control" placeholder="Nama Jenis .." value=<?php echo $d['namaJ'] ?>>
                                  </div><br><br>
                                  <div class="form-group" style="width:100%">
                                    <label>Merk</label><br>
                                    <select class="form-control" name="merk" style="width:100%">
                                      <?php
                                      $sql = "call merk_only()";
                                      $data = $db->fetchdata($sql);
                                      foreach ($data as $dat) {
                                        if ($d['idM'] == $dat['id'])
                                          $selected = 'selected';
                                        else
                                          $selected = '';
                                        echo "<option value='" . $dat['id'] . "'$selected>" . $dat['nama_merk'] . "</option>";
                                      }
                                      ?>
                                    </select>
                                  </div><br><br>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary" name="edit_jenis_bahan">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form edit jenis bahan -->

                        <!-- form delete jenis bahan -->
                        <div class="modal fade" id="hapus_jenis_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_jenis_bahan=<?php echo $d['id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form delete jenis bahan -->

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