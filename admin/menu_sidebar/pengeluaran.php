<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pengeluaran
      <!-- <small>Produk</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo BASE_URL_ADM_MENU; ?>pengelluaran.php">Pengeluaran</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahpenjualan">
                <i class="fa fa-plus"></i> &nbsp Tambah Pengeluaran
              </button>
              <a href="kategori_pengeluaran.php">
                <button type="button" class="btn btn-info btn-sm" style="margin-left: 10px;">
                  &nbsp Kategori
                </button>
              </a>
              <!-- <a href="jenis_bahan.php">
                <button type="button" class="btn btn-info btn-sm" style="margin-left: 10px;">
                  &nbsp Jenis Bahan
                </button>
              </a> -->
            </div>
          </div>

          <div class="box-body">
            <!-- Menampilkan pesan error -->
            <?php
            if (isset($_SESSION['error_message'])) {
              echo "<div class='alert alert-danger'>" . $_SESSION['error_message'] . "</div>";
              unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
            }
            ?>
            <!-- tambah penjualan -->
            <form id="form_alamat_1" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="tambahpenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Produk</label>
                        <select class="form-control" name="kategori" required="required">
                          <option value="">Pilih Kategori Pengeluaran</option>
                          <?php
                          $sql = "call kategori_png()";
                          $data = $db->fetchdata($sql);
                          foreach ($data as $dat) {
                            echo "<option value='" . $dat['id_kategori_pengeluaran'] . "'>" . $dat['namaK'] . " " . $dat['keterangan'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>nominal</label>
                        <div style="display: flex; align-items: center; gap: 5px;">
                          <input type="number" name="nominal" required="required" class="form-control" style="width:35%">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_pengeluaran">Simpan</button>
                      <!-- <button type="submit" class="btn btn-primary" name="cek">Simpan</button> -->
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah penjualan -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Keterangan</th>
                    <th style="text-align: center;">Total</th>
                    <th width="10%" style="text-align: center;">OPSI</th>
                  </tr>

                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "call log_pengeluaran()"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td style="text-align: center;"><?php echo $d['tanggal']; ?></td>
                      <td style="text-align: center;"><?php echo $d['kategori']; ?></td>
                      <td style="text-align: center;"><?php echo $d['keterangan']; ?></td>
                      <td style="text-align: right;"><?php echo "Rp. " . number_format($d['total'], 0, ',', '.'); ?></td>
                      <td>
                        <?php if ($d['kategori'] != 1) { ?>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_log_<?php echo $d['id_log'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form delete log -->
                        <div class="modal fade" id="hapus_log_<?php echo $d['id_log'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_log_pengeluaran=<?php echo $d['id_log'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form delete log -->

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