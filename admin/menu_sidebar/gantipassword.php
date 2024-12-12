<?php include '../header_sidebar.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Password
      <small>Ganti Password</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo BASE_URL_ADM; ?>index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="">Ganti Password</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-5">

        <?php 
        if(isset($_GET['alert'])){
          if($_GET['alert'] == "sukses"){
            echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
          }
        }
        ?>

        <div class="box box-info">

          <div class="box-header">
            <!-- <h3 class="box-title">Ganti Password</h3> -->
          </div>
          <div class="box-body">
            <form action="<?php echo BASE_URL_; ?>proc.php" method="post">
              <div class="form-group">
                <label>Masukkan Password Baru</label>
                <input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="password" required="required" min="5">
              </div>
              <div class="form-group">
                <input type="submit" name="gantipass" class="btn btn-sm btn-primary" value="Simpan">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include '../footer.php'; ?>