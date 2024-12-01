<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
// $sql = "call pegawai()";
// $d = $db->datasql($sql);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Produk
      <small>Stok</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>produk.php">Produk</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahbahan">
                <i class="fa fa-plus"></i> &nbsp Tambah Stok Produk
              </button>
              <!-- <a href="kategori_produk.php">
                <button type="button" class="btn btn-info btn-sm" style="margin-left: 10px;">
                  &nbsp Kategori Produk
                </button>
              </a> -->
            </div>
          </div>


          <div class="box-body">
            <!-- tambah produk -->
            <form id="form-kolam-1" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="tambahbahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="jenis" id="jenis-kolam" required="required">
                          <option value="">Pilih Kategori</option>
                          <?php
                          $sql = "call kategori_produk()";
                          $data = $db->fetchdata($sql);
                          foreach ($data as $dat) {
                            echo "<option value='" . $dat['id'] . "'>" . $dat['namaK'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Bahan</label>
                        <select class="form-control" name="bahan" id="bahan" required="required">
                          <option value="">Pilih Jenis</option>
                          <?php
                          $sql = "call bahan_only()";
                          $data = $db->fetchdata($sql);
                          foreach ($data as $dat) {
                            $Harga = $dat['harga'];
                            echo "<option value='" . $dat['id_bahan'] . "' data-harga='" . $Harga . "''>" . $dat['namaJ'] . " " . $dat['nama_merk'] . " " . $dat['namaW'] .  "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <input type="hidden" name="harga-bahan" id="harga-bahan" value="">
                      <div id="input-dinamis">
                        <!-- Input tambahan akan dimuat di sini -->
                      </div>
                      <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" required="required" class="form-control" placeholder="Stok..." style="width:20%">
                      </div>
                      <!-- <div class="form-group">
                        <label>Harga/m²</label>
                        <input type="number" name="harga" required="required" class="form-control" placeholder="Harga..." style="width:40%">
                      </div> -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_produk">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah produk -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Kategori</th>
                    <th>Bahan</th>
                    <th>Ukuran</th>
                    <th>Harga Satuan</th>
                    <th>Stok</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "call produk()"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['namaK']; ?></td>
                      <td><?php echo $d['namaJ'] . " " . $d['nama_merk'] . " " . $d['namaW']; ?></td>
                      <td><?php echo $d['ukuran']; ?></td>
                      <td><?php echo "Rp. " . number_format($d['harga'], 0, ',', '.'); ?></td>
                      <td><?php echo $d['stok']?></td>
                      <td>
                        <?php if ($d['namaK'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_produk_<?php echo $d['id_produk'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_produk_<?php echo $d['id_produk'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit produk -->
                        <form id="form-kolam-2" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_produk_<?php echo $d['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Pemasok</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width: 100%;">
                                    <label>Kategori</label><br>
                                    <select class="form-control" name="jenis2" id="jenis-kolam" style="width: 100%;">
                                      <option value="">Pilih Kategori</option>
                                      <?php
                                      $sql = "call kategori_produk()";
                                      $data = $db->fetchdata($sql);
                                      foreach ($data as $dat) {
                                        echo "<option value='" . $dat['id'] . "'>" . $dat['namaK'] . "</option>";
                                      }
                                      ?>
                                    </select>

                                  </div><br><br>
                                  <div class="form-group" style="width: 100%;">
                                    <label>Bahan</label><br>
                                    <select class="form-control" name="bahan" id="bahan" required="required" style="width: 100%;">
                                      <?php
                                      $sql = "call bahan_only()";
                                      $data = $db->fetchdata($sql);
                                      foreach ($data as $dat) {
                                        if ($d['id_bahan'] == $dat['id_bahan'])
                                          $selected = 'selected';
                                        else
                                          $selected = '';
                                        echo "<option value='" . $dat['id_bahan'] . "'$selected>" . $dat['namaJ'] . " " . $dat['nama_merk'] . " " . $dat['namaW'] .  "</option>";
                                      }
                                      ?>
                                    </select>
                                  </div><br><br>
                                  <input type="hidden" name="harga-bahan" id="harga-bahan" value="">
                                  <div id="input-dinamis">
                                    <!-- Input tambahan akan dimuat di sini -->
                                  </div>
                                  <div class="form-group">
                                    <label>Stok</label><br>
                                    <input type="number" name="stok" class="form-control" placeholder="Stok..." style="width:70%">
                                  </div><br><br>
                                </div><br><br>
                                <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_produk']; ?>">
                                <input type="hidden" name="bahan_produk" required="required" class="form-control" value="<?php echo $d['bahan_produk']; ?>">
                                <input type="hidden" name="id_kategori" required="required" class="form-control" value="<?php echo $d['id_kategori_produk']; ?>">
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary" name="edit_produk">Simpan</button>
                                  <!-- <button type="submit" class="btn btn-primary" name="cek">Simpan</button> -->
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form edit produk -->

                        <!-- form delete behan -->
                        <div class="modal fade" id="hapus_produk_<?php echo $d['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_produk=<?php echo $d['id_produk'] ?>" class="btn btn-primary">Hapus</a>
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

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>