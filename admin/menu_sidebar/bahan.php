<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
// $sql = "call pegawai()";
// $d = $db->datasql($sql);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Bahan
      <small>Stok</small>
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
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahbahan">
                <i class="fa fa-plus"></i> &nbsp Tambah Stok Bahan
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- tambah bahan -->
            <form id="form_alamat_1" action="<?php echo BASE_URL_ADM; ?>proc.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="tambahbahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Bahan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Jenis</label>
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Pemasok ..">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <form name="addForm" method="post" action="">
                          <select name="propinsi_id" id="propinsi_id" class="form-control" required="required">
                            <option value="">Pilih Provinsi</option>
                            <?php
                            $sql = "call provinsi()";
                            $data = $db->fetchdata($sql);
                            foreach ($data as $dat) {
                              echo "<option value='" . $dat['id'] . "'>" . $dat['nama_prop'] . "</option>";
                            }
                            ?>
                          </select><br>
                          <select name="kabupaten_id" id="kabupaten_id" class="form-control" required="required">
                            <option value="">Pilih Kota/Kab</option>
                          </select><br>
                          <select name="kecamatan_id" id="kecamatan_id" class="form-control" required="required">
                            <option value="">Pilih Kecamatan</option>
                          </select><br>
                          <select name="desa_id" id="desa_id" class="form-control" required="required">
                            <option value="">Pilih Desa</option>
                          </select><br>
                        </form>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_pemasok">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah bahan -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Nama</th>
                    <th>Warna</th>
                    <th>Ukuran</th>
                    <th>Pemasok</th>
                    <th>Stok</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "call bahan()"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {                 
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['namaJ']; ?></td>
                      <td><?php echo $d['namaW']; ?></td>
                      <td><?php echo $d['lebar'] . "x" . $d['panjang']; ?></td>
                      <td><?php echo $d['nama'] ; ?></td>
                      <td><?php echo $d['stok'] ; ?></td>
                      <td>
                        <?php if ($d['nama'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pemasok_<?php echo $d['id_bahan'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_pemasok_<?php echo $d['id_bahan'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit behan -->
                        <form id="form_alamat_2" action="<?php echo BASE_URL_ADM; ?>proc.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_pemasok_<?php echo $d['id_pemasok'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Pemasok</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="width:100%">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama Pemasok</label>
                                    <input type="hidden" name="idP" required="required" class="form-control" value="<?php echo $d['id_pemasok']; ?>">
                                    <input type="text" name="namaP" required="required" class="form-control" value="<?php echo $d['nama']; ?>" style="width:100%">
                                  </div><br><br>
                                  <div class="form-group" style="width:100%">
                                    <label>Alamat</label><br>
                                    <form name="addForm" method="post" action="">
                                      <select name="propinsi_id" id="propinsi_id" class="form-control" style="width:100%">
                                        <option value="">Pilih Provinsi</option>
                                        <?php
                                        $sql = "call provinsi()";
                                        $data = $db->fetchdata($sql);
                                        foreach ($data as $dat) {
                                          echo "<option value='" . $dat['id'] . "'>" . $dat['nama_prop'] . "</option>";
                                        }
                                        ?>
                                      </select><br><br>
                                      <select name="kabupaten_id" id="kabupaten_id" class="form-control" style="width:100%">
                                        <option value="">Pilih Kota/Kab</option>
                                        <?php
                                        if ($d['id_k'] == $dat['id_posisi'])
                                          $selected = 'selected';
                                        else
                                          $selected = '';
                                        ?>
                                      </select><br><br>
                                      <select name="kecamatan_id" id="kecamatan_id" class="form-control" style="width:100%">
                                        <option value="">Pilih Kecamatan</option>
                                      </select><br><br>
                                      <select name="desa_id" id="desa_id" class="form-control" style="width:100%">
                                        <option value="">Pilih Desa</option>
                                      </select><br><br>
                                    </form>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary" name="edit_pemasok">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form edit behan -->

                        <!-- form delete behan -->
                        <div class="modal fade" id="hapus_pemasok_<?php echo $d['id_pemasok'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_ADM; ?>proc.php?del_pemasok=<?php echo $d['id_pemasok'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form delete behan -->

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

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/footer.php'; ?>