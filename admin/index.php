<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/admin/header_sidebar.php';
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/class_db.php';

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <?php
    // Mengambil data untuk setiap box dashboard
    $bahan = $db->getQueryResult($db, "CALL total_bahan()", 'total_bahan');
    $produk = $db->getQueryResult($db, "CALL total_produk()", 'total_produk');
    $pegawai = $db->getQueryResult($db, "CALL total_pegawai()", 'pegawai');
    $pengguna = $db->getQueryResult($db, "CALL total_user()", 'pengguna');
    $produk_terjual = $db->getQueryResult($db, "CALL total_penjualan()", 'terjual');
    $tanggal = date('Y-m-d');
    $bulan = date('m');
    $tahun = date('Y');
    $pemasukan_hari = $db->getQueryResult($db, "CALL total_pemasukan_hari('$tanggal')", 'pemasukan');
    $pemasukan_bulanan = $db->getQueryResult($db, "CALL total_pemasukan_bulan('$bulan','$tahun')", 'pemasukan');
    $pemasukan_tahunan = $db->getQueryResult($db, "CALL total_pemasukan_tahun('$tahun')", 'pemasukan');
    $pengeluaran_hari = $db->getQueryResult($db, "CALL total_pengeluaran_hari('$tanggal')", 'pengeluaran');
    $pengeluaran_bulanan = $db->getQueryResult($db, "CALL total_pengeluaran_bulan('$bulan','$tahun')", 'pengeluaran');
    $pengeluaran_tahunan = $db->getQueryResult($db, "CALL total_pengeluaran_tahun('$tahun')", 'pengeluaran');
    // Menampilkan data dashboard dalam bentuk kotak
    echo "<div class='row'>";

    // Menampilkan box untuk data bahan
    $db->createDashboardBox('green', 'ion ion-md-cart', 'Bahan', $bahan, 'menu_sidebar/bahan.php');
    // Menampilkan box untuk data produk
    $db->createDashboardBox('yellow', 'fa fa-box', 'Produk', $produk, 'menu_sidebar/produk.php');
    // Menampilkan box untuk data pegawai
    $db->createDashboardBox('red', 'fa fa-tags', 'Pegawai', $pegawai, 'menu_sidebar/pegawai.php');
    // Menampilkan box untuk data pengguna
    $db->createDashboardBox('gray', 'fa fa-users', 'Pengguna', $pengguna, 'menu_sidebar/pengguna.php');
    // Menampilkan box untuk data terjual
    $db->createDashboardBox('purple', 'fa fa-bag', 'Produk Terjual', $produk_terjual, 'menu_sidebar/penjualan.php');

    echo "</div>";
    echo "<div class='row'>";

    // Menampilkan box untuk data pemasukkan harian, bulanan, tahunan
    $db->createDashboardBoxMoney('blue', 'fa fa-bag', 'Pemasukan hari ini', $pemasukan_hari, 'menu_sidebar/penjualan.php');
    $db->createDashboardBoxMoney('blue', 'fa fa-bag', 'Pemasukan Bulan ini', $pemasukan_bulanan, 'menu_sidebar/penjualan.php');
    $db->createDashboardBoxMoney('blue', 'fa fa-bag', 'Pemasukan Tahun ini', $pemasukan_tahunan, 'menu_sidebar/penjualan.php');

    echo "</div>";

    echo "<div class='row'>";
    // Menampilkan box untuk data pengeluaran harian, bulanan, tahunan
    $db->createDashboardBoxMoney('blue', 'fa fa-bag', 'Pengeluaran hari ini', $pengeluaran_hari, 'menu_sidebar/penjualan.php');
    $db->createDashboardBoxMoney('blue', 'fa fa-bag', 'Pengeluaran Bulan ini', $pengeluaran_bulanan, 'menu_sidebar/penjualan.php');
    $db->createDashboardBoxMoney('blue', 'fa fa-bag', 'Pengeluaran Tahun ini', $pengeluaran_tahunan, 'menu_sidebar/penjualan.php');
    echo "</div>";
    ?>
  </section>
</div>
<?php
require_once 'C:/laragon/www/MPSI/Project-vinjhonterpal/footer.php';
?>