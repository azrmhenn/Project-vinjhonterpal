<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php'; 
?>

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
                <i class="fa fa-plus"></i> &nbsp Tambah Pengguna
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- tambah pengguna -->
            <form action="<?php echo BASE_URL_ADM; ?>proc.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Pengguna ..">
                      </div>
                      <div class="form-group">
                        <label>username</label>
                        <input type="text" name="user" required="required" class="form-control" placeholder="Keterangan ..">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="pass" required="required" class="form-control" placeholder="Password ..">
                      </div>
                      <div class="form-group">
                        <label>Level</label>
                        <select class="form-control" name="level" required="required">
                          <option selected> - Pilih Level - </option>
                          <?php
                          $sql = "call level()";
                          $data = $db->fetchdata($sql);
                          foreach ($data as $dat) {
                            echo "<option value='" . $dat['id_level'] . "'>" . $dat['namaL'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="USER_add" value="tambah">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah pengguna -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Level</th>
                    <th style="text-align: center;">Foto</th>
                    <th width="10%" style="text-align: center;">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "call user()"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $no++; ?></td>
                      <td style="text-align: center;"><?php echo $d['nama']; ?></td>
                      <td style="text-align: center;"><?php echo $d['username']; ?></td>
                      <td style="text-align: center;"><?php echo $d['namaL']; ?></td>
                      <td>
                        <center>
                          <?php if($d['foto'] == ""){ ?>
                            <img src="<?php echo BASE_URL_IMG_SYS; ?>user.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="<?php echo BASE_URL_IMG_USR; echo $d['foto'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td style="text-align: center;">
                        <?php if ($d['nama'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pengguna_<?php echo $d['id_user'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_pengguna_<?php echo $d['id_user'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form pengguna edit -->
                        <form action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_pengguna_<?php echo $d['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama</label>
                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_user']; ?>">
                                    <input type="text" name="nama" required="required" class="form-control" value="<?php echo $d['nama']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Username</label>
                                    <input type="text" name="user" required="required" class="form-control" value="<?php echo $d['username']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Password</label><br>
                                    <input type="text" name="pass"  class="form-control" placeholder="Password (kosongkan jika tidak ingin diganti))">
                                  </div>
                                  <div class="form-group" style="width:100%">
                                    <label>Level</label><br>
                                    <select class="form-control" name="level" required="required">
                                      <?php
                                      $sql = "call level()";
                                      $data = $db->fetchdata($sql);
                                      foreach ($data as $dat) {
                                        if ($d['level'] == $dat['id_level'])
                                          $selected = 'selected';
                                        else
                                          $selected = '';
                                        echo "<option value='" . $dat['id_level'] . "'$selected>" . $dat['namaL'] . "
                                            </option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto">
                                    <p>Kosong Jika tidak ingin di ganti</p>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary" name="USER_edit">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form pengguna edit -->

                        <!-- form pengguna delete -->
                        <div class="modal fade" id="hapus_pengguna_<?php echo $d['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?USER_del=<?php echo $d['id_user'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form pengguna delete -->

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