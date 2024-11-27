<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
// $sql = "call pegawai()";
// $d = $db->datasql($sql);
?>

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
            <form id="form_alamat_1" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Kategori ..">
                      </div>
                      <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi" required="required">
                          <option value="">Pilih Posisi</option>
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
                      <td><?php echo $d['nama_posisi'] ? $d['nama_posisi'] : '-'; ?></td>
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
                        <form id="form_alamat_2" action="<?php echo BASE_URL_; ?>proc.php" method="post" enctype="multipart/form-data">
                          <div class="modal fade" id="edit_pegawai_<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="width:100%">
                                  <div class="form-group" style="width:100%">
                                    <label>Nama Pegawai</label>
                                    <input type="hidden" name="idP" required="required" class="form-control" value="<?php echo $d['id_pegawai']; ?>">
                                    <input type="text" name="namaP" required="required" class="form-control" value="<?php echo $d['nama_pegawai']; ?>" style="width:100%">
                                  </div><br><br>
                                  <div class="form-group" style="width:100%">
                                    <label>Posisi</label><br>
                                    <select class="form-control" name="posisi" required="required" style="width:100%">
                                      <option value=""> - Pilih Posisi - </option>
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
                                  <button type="submit" class="btn btn-primary" name="edit_pegawai">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- form edit pegawawi -->

                        <!-- form delete pegawai -->
                        <div class="modal fade" id="hapus_pegawai_<?php echo $d['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="<?php echo BASE_URL_; ?>proc.php?del_pegawai=<?php echo $d['id_pegawai'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- form delete pegawai -->

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
<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('#form_alamat_1 #propinsi_id').change(function() {
      var prop = $('#form_alamat_1 #propinsi_id').val();
      $.ajax({
        type: "POST",
        url: "proc.php",
        data: {
          jenis: 'kab',
          prop: prop
        },
        success: function(res) {
          $('#form_alamat_1 #kabupaten_id').html('<option value="">Pilih Kota/Kab</option>' + res);
          $('#form_alamat_1 #kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
          $('#form_alamat_1 #desa_id').html('<option value="">Pilih Desa</option>');
        }
      });
    });

    $('#form_alamat_1 #kabupaten_id').change(function() {
      var kab = $('#form_alamat_1 #kabupaten_id').val();
      $.ajax({
        type: "POST",
        url: "proc.php",
        data: {
          jenis: 'kec',
          kab: kab
        },
        success: function(res) {
          $('#form_alamat_1 #kecamatan_id').html('<option value="">Pilih Kecamatan</option>' + res);
          $('#form_alamat_1 #desa_id').html('<option value="">Pilih Desa</option>');
        }
      });
    });

    $('#form_alamat_1 #kecamatan_id').change(function() {
      var kec = $('#form_alamat_1 #kecamatan_id').val();
      $.ajax({
        type: "POST",
        url: "proc.php",
        data: {
          jenis: 'desa',
          kec: kec
        },
        success: function(res) {
          $('#form_alamat_1 #desa_id').html('<option value="">Pilih Desa</option>' + res);
        }
      });
    });

    $('#form_alamat_2 #propinsi_id').change(function() {
      var prop = $('#form_alamat_2 #propinsi_id').val();
      $.ajax({
        type: "POST",
        url: "proc.php",
        data: {
          jenis: 'kab',
          prop: prop
        },
        success: function(res) {
          $('#form_alamat_2 #kabupaten_id').html('<option value="">Pilih Kota/Kab</option>' + res);
          $('#form_alamat_2 #kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
          $('#form_alamat_2 #desa_id').html('<option value="">Pilih Desa</option>');
        }
      });
    });

    $('#form_alamat_2 #kabupaten_id').change(function() {
      var kab = $('#form_alamat_2 #kabupaten_id').val();
      $.ajax({
        type: "POST",
        url: "proc.php",
        data: {
          jenis: 'kec',
          kab: kab
        },
        success: function(res) {
          $('#form_alamat_2 #kecamatan_id').html('<option value="">Pilih Kecamatan</option>' + res);
          $('#form_alamat_2 #desa_id').html('<option value="">Pilih Desa</option>');
        }
      });
    });

    $('#form_alamat_2 #kecamatan_id').change(function() {
      var kec = $('#form_alamat_2 #kecamatan_id').val();
      $.ajax({
        type: "POST",
        url: "proc.php",
        data: {
          jenis: 'desa',
          kec: kec
        },
        success: function(res) {
          $('#form_alamat_2 #desa_id').html('<option value="">Pilih Desa</option>' + res);
        }
      });
    });
  });
</script> -->
<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>