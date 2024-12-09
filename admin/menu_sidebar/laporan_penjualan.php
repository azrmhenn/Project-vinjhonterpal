<?php 
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Laporan 
      <small>Penjualan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan Penjualan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Masukkan rentang tanggal</h3>
          </div>

          <div class="box-body">
            <form action="<?php echo BASE_URL_ADM_MENU; ?>laporan_pdf_penjualan.php" method="GET" target="_blank" class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-2">
                  <input type="date" name="tanggal_dari" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Akhir</label>
                <div class="col-sm-2">
                  <input type="date" name="tanggal_sampai" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-print"></i> Cetak Laporan
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<?php require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php'; ?>
