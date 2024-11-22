<?php require_once 'C:/laragon/www/vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/vinjhonterpal/class_db.php';
// $sql = "call pegawai()";
// $d = $db->datasql($sql);
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pegawai
      <small>Data Pegawai</small>
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
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahpegawai">
                <i class="fa fa-plus"></i> &nbsp Tambah Pegawai
              </button>
            </div>
          </div>

          <div class="box-body">
            <!-- tambah pegawai -->
            <form action="http://localhost/vinjhonterpal/admin/proc.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="tambahpegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" name="namaK" required="required" class="form-control" placeholder="Nama Kategori ..">
                      </div>
                      <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi" required="required">
                          <option selected> - Pilih Posisi - </option>
                          <?php
                          $sql = "call posisi()";
                          $data = $db->fetchdata($sql);
                          foreach ($data as $dat) {
                            echo "<option value='" . $dat['id_posisi'] . "'>" . $dat['nama_posisi'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <form name="addForm" method="post" action="">
                          <select name="propinsi_id" id="propinsi_id" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            <?php
                            $sql = "call provinsi()";
                            $data = $db->fetchdata($sql);
                            foreach ($data as $dat) {
                              echo "<option value='" . $dat['id'] . "'>" . $dat['nama_prop'] . "</option>";
                            }
                            ?>
                          </select><br>
                          <select name="kabupaten_id" id="kabupaten_id" class="form-control">
                            <option value="">Pilih Kota/Kab</option>
                          </select><br>
                          <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                            <option value="">Pilih Kecamatan</option>
                          </select><br>
                          <select name="desa_id" id="desa_id" class="form-control">
                            <option value="">Pilih Desa</option>
                          </select><br>
                        </form>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" name="add_pegawai">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- tambah pegawai -->


            <!-- tabel data -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Alamat</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Menggunakan class database untuk koneksi dan query
                  $db = new database(); // Inisialisasi objek class database
                  $no = 1;
                  $query = "call pegawai()"; // Query menggunakan prosedur
                  $data = $db->fetchdata($query);

                  foreach ($data as $d) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama_pegawai']; ?></td>
                      <td><?php echo $d['nama_posisi']; ?></td>
                      <td><?php echo "Ds. " . $d['nama_desa'] . ", Kec. " . $d['nama_kec'] . ", Kab. " . $d['nama_kab'] . ", Prov. " . $d['nama_prop']; ?></td>
                      <td>
                        <?php if ($d['nama_pegawai'] != 1) { ?>
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pegawai_<?php echo $d['id_pegawai'] ?>">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_pegawai_<?php echo $d['id_pegawai'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
                        <!-- form edit pegawai -->
                        <form action="http://localhost/vinjhonterpal/admin/proc.php" method="post">
                          <div class="modal fade" id="edit_pegawai_<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama Pegawai</label>
                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['id_pegawai']; ?>">
                                    <input type="text" name="nama_pegawai" required="required" class="form-control" value="<?php echo $d['nama_pegawai']; ?>" style="width:100%">
                                  </div>
                                  <div class="form-group">
                                    <label>Posisi</label>
                                    <select class="form-control" name="posisi" required="required">
                                      <option selected> - Pilih Posisi - </option>
                                      <?php
                                      $sql = "call posisi()";
                                      $data = $db->fetchdata($sql);
                                      foreach ($data as $dat) {
                                        if ($d['id_posisi'] == $dat['id_posisi'])
                                          $selected = 'selected';
                                        else
                                          $selected = '';
                                        echo "<option value='" . $dat['id_posisi'] . "'$selected>" . $dat['nama_posisi'] . "
                                            </option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Alamat</label>
                                    <form name="addForm" method="post" action="">
                                      <select name="propinsi_id" id="propinsi_id" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        <?php
                                        $sql = "call provinsi()";
                                        $data = $db->fetchdata($sql);
                                        foreach ($data as $dat) {
                                          if ($d['id_'] == $dat['id_posisi'])
                                            $selected = 'selected';
                                          else
                                            $selected = '';
                                          echo "<option value='" . $dat['id'] . "'>" . $dat['nama_prop'] . "</option>";
                                        }
                                        ?>
                                      </select><br>
                                      <select name="kabupaten_id" id="kabupaten_id" class="form-control">
                                        <option value="">Pilih Kota/Kab</option>
                                      </select><br>
                                      <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                                        <option value="">Pilih Kecamatan</option>
                                      </select><br>
                                      <select name="desa_id" id="desa_id" class="form-control">
                                        <option value="">Pilih Desa</option>
                                      </select><br>
                                    </form>
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
                                <a href="http://localhost/vinjhonterpal/admin/proc.php?del_KPG=<?php echo $d['id_kategori_pengeluaran'] ?>" class="btn btn-primary">Hapus</a>
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

<!-- script ajax alamat -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#propinsi_id').change(function() {
      var prop = $('#propinsi_id').val();
      $.ajax({
        type: "POST",
        url: "../proc.php",
        data: {
          jenis: 'kab',
          prop: prop
        },
        success: function(res) {
          $('#kabupaten_id').html('<option value="">Pilih Kota/Kab</option>' + res);
          $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
          $('#desa_id').html('<option value="">Pilih Desa</option>');
        }
      });
    });

    $('#kabupaten_id').change(function() {
      var kab = $('#kabupaten_id').val();
      $.ajax({
        type: "POST",
        url: "../proc.php",
        data: {
          jenis: 'kec',
          kab: kab
        },
        success: function(res) {
          $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>' + res);
          $('#desa_id').html('<option value="">Pilih Desa</option>');
        }
      });
    });

    $('#kecamatan_id').change(function() {
      var kec = $('#kecamatan_id').val();
      $.ajax({
        type: "POST",
        url: "../proc.php",
        data: {
          jenis: 'desa',
          kec: kec
        },
        success: function(res) {
          $('#desa_id').html('<option value="">Pilih Desa</option>' + res);
        }
      });
    });
  });
</script>
<!-- script ajax alamat -->

<?php include 'C:/laragon/www/vinjhonterpal/admin/footer.php'; ?>