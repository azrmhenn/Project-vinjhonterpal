<?php
include 'class_db.php';
include 'config.php';
$db = new Database();
session_start();


// Action kategori produk
if (isset($_POST['add_KP'])) {
    $nama = $_POST['namaK'];
    $sql = "CALL KP_add('$nama')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        admin("kategori_produk.php");
    }
}

if (isset($_POST['edit_KP'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaK'];
    $sql = "CALL KP_edit('$id', '$nama')";

    if (!$db->sqlquery($sql)) {
        die('Update data gagal: ' . $sql);
    } else {
        admin("kategori_produk.php");
    }
}

if (isset($_GET['del_KP'])) {
    $id = $_GET['del_KP'];
    $sql = "CALL KP_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("kategori_produk.php");
    }
}

// Action kategori pengeluaran
if (isset($_POST['add_KPG'])) {
    $nama = $_POST['namaK'];
    $ket = $_POST['ket'];
    $sql = "CALL KPG_add('$nama', '$ket')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        admin("kategori_pengeluaran.php");
    }
}

if (isset($_POST['edit_KPG'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaK'];
    $ket = $_POST['ket'];
    $sql = "CALL KPG_edit('$id', '$nama', '$ket')";

    if (!$db->sqlquery($sql)) {
        die('Update data gagal: ' . $sql);
    } else {
        admin("kategori_pengeluaran.php");
    }
}

if (isset($_GET['del_KPG'])) {
    $id = $_GET['del_KPG'];
    $sql = "CALL KPG_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("kategori_pengeluaran.php");
    }
}

// Action user
if (isset($_POST['gantiPW'])) {
    $id = $_SESSION['id'];
    $SName = $_SESSION['username'];
    $password = md5($_POST['password']);
    $sql = "CALL PW_edit('$password', '$id')";

    if (!$db->sqlquery($sql)) {
        die('Update password gagal: ' . $sql);
    } else if ($SName == "Administrator") {
        admin("gantipassword.php?alert=sukses");
    } else if ($SName == "Pegawai") {
        pegawai("gantipassword.php?alert=sukses");
    } else if ($SName == "Owner") {
        owner("gantipassword.php?alert=sukses");
    }
}

if (isset($_POST['USER_add'])) {
    $nama = $_POST['nama'];
    $username = $_POST['user'];
    $password = md5($_POST['pass']);
    $level = $_POST['level'];

    $rand = rand();
    $allowed = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['foto']['name'];

    if ($filename == "") {
        $db->sqlquery("call USER_add('$nama', '$username', '$password', '', '$level')");
        admin("user.php");
    } else {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $allowed)) {
            admin("user.php?alert=gagal");
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename);
            $file_gambar = $rand . '_' . $filename;
            $db->sqlquery("call USER_add('$nama', '$username', '$password', '$file_gambar', '$level')");
            admin("user.php");
        }
    }
}

if (isset($_POST['USER_edit'])) {
    $id  = $_POST['id'];
    $nama  = $_POST['nama'];
    $user = $_POST['user'];
    $pwd = $_POST['pass'];
    $pass = md5($_POST['pass']);
    $level = $_POST['level'];

    // cek gambar
    $rand = rand();
    $allowed =  array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['foto']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if ($pwd == "" && $filename == "") {
        $db->sqlquery("call USER_edit_TPF('$id','$nama', '$user', '$level')");
        admin("user.php");
    } elseif ($pwd == "") {
        if (!in_array($ext, $allowed)) {
            admin("user.php");
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'C:/laragon/www/MPSI/Project-vinjhonterpal/gambar/user/' . $rand . '_' . $filename);
            $x = $rand . '_' . $filename;
            $db->sqlquery("call USER_edit_TP('$id','$nama', '$user', '$x', '$level')");
            admin("user.php?alert=berhasil");
        }
    } elseif ($filename == "") {
        $db->sqlquery("call USER_edit_TF('$id','$nama', '$user', '$pass', '$level')");
        admin("user.php?alert=berhasil");
    } else {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'C:/laragon/www//vinjhonterpal/gambar/user/' . $rand . '_' . $filename);
        $x = $rand . '_' . $filename;
        $db->sqlquery("call USER_edit('$id','$nama', '$user', '$pass','$x','$level')");
        admin("user.php?alert=berhasil");
    }
}

if (isset($_GET['USER_del'])) {
    $id  = $_GET['USER_del'];
    $sql = "CALL USER_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("user.php");
    }
}

// Action Pegawai
if (isset($_POST['add_pegawai'])) {
    $nama = $_POST['nama'];
    $posisi = $_POST['posisi'];
    $alamat = $_POST['desa_id'];
    $no = $_POST['nohp'];
    $sql = "CALL pegawai_add('$nama', '$posisi', '$alamat','$no')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        admin("pegawai.php");
    }
}

if (isset($_POST['edit_pegawai'])) {
    $id  = $_POST['idP'];
    $nama = $_POST['namaP'];
    $posisi = $_POST['posisi'];
    $alamat = $_POST['desa_id'];
    $no = $_POST['nohp'];

    if ($alamat == "") {
        $db->sqlquery("CALL pegawai_edit_TA('$nama', '$posisi','$id', '$no')");
        admin("pegawai.php");
    } else {
        $db->sqlquery("CALL pegawai_edit_full('$nama', '$posisi', '$alamat','$id','$no')");
        admin("pegawai.php");
    }
}

if (isset($_GET['del_pegawai'])) {
    $id  = $_GET['del_pegawai'];
    $sql = "CALL pegawai_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("pegawai.php");
    }
}

// Action Posisi
if (isset($_POST['add_posisi'])) {
    $nama = $_POST['namaP'];
    $upahP = $_POST['upahP'];
    $upahL = $_POST['upahL'];
    $sql = "CALL posisi_add('$nama', '$upahP', '$upahL')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        owner("posisi.php");
    }
}

if (isset($_POST['edit_posisi'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaP'];
    $upahP = $_POST['upahjam'];
    $upahL = $_POST['upahlembur'];
    $sql = "CALL posisi_edit('$nama', '$upahP', '$upahL', '$id')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        owner("posisi.php");
    }
}

if (isset($_GET['del_posisi'])) {
    $id  = $_GET['del_posisi'];
    $sql = "CALL posisi_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        owner("posisi.php");
    }
}

// Action pemasok
if (isset($_POST['add_pemasok'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['desa_id'];
    $sql = "CALL pemasok_add('$nama', '$alamat')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        admin("pemasok.php");
    }
}

if (isset($_POST['edit_pemasok'])) {
    $id  = $_POST['idP'];
    $nama = $_POST['namaP'];
    $alamat = $_POST['desa_id'];

    if ($alamat == "") {
        $db->sqlquery("CALL pemasok_edit_TA('$nama', '$id')");
        admin("pemasok.php");
    } else {
        $db->sqlquery("CALL pemasok_edit_full('$nama', '$alamat','$id')");
        admin("pemasok.php");
    }
}

if (isset($_GET['del_pemasok'])) {
    $id  = $_GET['del_pemasok'];
    $sql = "CALL pemasok_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("pemasok.php");
    }
}

// Action bahan
if (isset($_POST['add_bahan'])) {
    $jenis = $_POST['jenis'];
    $warna = $_POST['warna'];
    $p = $_POST['panjang'];
    $l = $_POST['lebar'];
    $pemasok = $_POST['pemasok'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Query untuk memeriksa apakah data sudah ada
    $sql_check = "CALL bahan_cek('$jenis','$warna', '$p', '$l', '$pemasok','$harga')";
    $result = $db->fetchdata($sql_check); // Ambil hasil dari prosedur `bahan_check`

    // Jika data ditemukan, lakukan update
    if (!empty($result)) {
        foreach ($result as $d) {
            $id = $d['id_bahan']; // Ambil ID bahan dari hasil query
            $sql_update = "CALL bahan_edit('$jenis','$warna', '$p', '$l', '$pemasok', '$stok', '$id','$harga')";
            if (!$db->sqlquery($sql_update)) {
                die('Update data gagal: ' . $sql_update);
            }
        }
    } else {
        // Jika data tidak ditemukan, tambahkan data baru
        $sql_insert = "CALL bahan_add('$jenis', '$warna', '$p', '$l', '$pemasok', '$stok','$harga')";
        if (!$db->sqlquery($sql_insert)) {
            die('Insert data gagal: ' . $sql_insert);
        }
    }

    // Redirect ke halaman bahan setelah selesai
    admin("bahan.php");
}

if (isset($_POST['edit_bahan'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaJ'];
    $warna = $_POST['warna'];
    $p = $_POST['panjang'];
    $l = $_POST['lebar'];
    $pemasok = $_POST['pemasok'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $sql = "";

    if (!empty($stok)) {
        $db->sqlquery("CALL bahan_edit('$nama', '$warna', '$p', '$l', '$pemasok', '$stok', '$id','$harga')");
        admin("bahan.php");
    } else {
        $db->sqlquery("CALL bahan_edit_TS('$nama', '$warna', '$p', '$l', '$pemasok', '$id','$harga')");
        admin("bahan.php");
    }
}

if (isset($_GET['del_bahan'])) {
    $id  = $_GET['del_bahan'];
    $sql = "CALL bahan_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("bahan.php");
    }
}

if (isset($_POST['cek'])) {
    // $jenis = $_POST['produk']?:0;
    $panjang = $_POST['idP'];
    // $p = $_POST['panjang'];
    // $l = $_POST['lebar'];
    // $pemasok = $_POST['pemasok'];
    // $stok = $_POST['stok'];
    // $harga = $_POST['harga'];
    // echo $p,$l,$stok;
    echo $panjang;
    // $hargaBahan = $_POST['harga-bahan'];

    // Pastikan nilai yang diterima adalah decimal
    // $hargaBahanDecimal = floatval($hargaBahan);  // Mengonversi menjadi tipe data decimal (float)

    // // Debugging
    // var_dump($panjang);  // Untuk memastikan apa yang dikirim oleh form dan sudah dalam format decimal
}


//Action produk
if (isset($_POST['add_produk'])) {
    $jenis = $_POST['jenis']; // ID kategori
    $bahan = $_POST['bahan'];
    $T = ($jenis == '1' || $jenis == '2') ? $_POST['tinggi'] : 0;
    $P = ($jenis == '2' || $jenis == '3') ? $_POST['panjang'] : 0;
    $L = ($jenis == '2' || $jenis == '3') ? $_POST['lebar'] : 0;
    $D = ($jenis == '1') ? $_POST['diameter'] : 0; // Diameter hanya relevan untuk kolam bulat
    $hargaB = round(floatval($_POST['harga-bahan']), 2);  // Membulatkan harga menjadi 2 desimal
    $stok = $_POST['stok'];


    $luas = 0; // Variabel untuk menyimpan hasil luas

    // Hitung luas berdasarkan jenis kolam
    if ($jenis == '1') { // Kolam bulat
        $radius = $D; // Radius dalam (m²)
        $luas = M_PI * pow($radius, 2); // Hitung luas alas (m²)
        $luas += 2 * M_PI * $radius * $T; // Tambahkan luas dinding (m²)
        $hargaB *= $luas;
    } elseif ($jenis == '2') { // Kolam kotak
        $luas = $P * $L; // Luas alas (m²)
        $luas += 2 * ($P * $T + $L * $T);
        $luas /= 10000; // Tambahkan luas dinding (m²)
        $hargaB *= $luas;
    } elseif ($jenis == '3') { // Lembaran
        $luas = $P * $L; // Luas lembaran (m²)
        $hargaB *= $luas;
    }
    $hargaB = round($hargaB);

    // Simpan data ke database
    $ukuran = ""; // Variabel ukuran seperti sebelumnya
    if ($jenis == '1') { // Kolam bulat
        $ukuran = "D{$D} T{$T}";
    } elseif ($jenis == '2') { // Kolam kotak
        $ukuran = "{$P} x {$L} x {$T}";
    } elseif ($jenis == '3') { // Lembaran
        $ukuran = "{$P} x {$L}";
    }

    // Query untuk memeriksa apakah data sudah ada
    $sql_check = "CALL produk_cek('$jenis', '$bahan', '$ukuran', '$luas', '$stok', '$hargaB')";
    echo "SQL Check Query: $sql_check<br>";
    $result = $db->fetchdata($sql_check); // Ambil hasil dari prosedur `produk_cek`

    // Jika data ditemukan, lakukan update
    if (!empty($result)) {
        foreach ($result as $d) {
            $id = $d['id_produk']; // Ambil ID produk dari hasil query
            $sql_update = "CALL produk_edit('$jenis', '$bahan', '$ukuran', '$luas', '$stok', '$id')";
            if (!$db->sqlquery($sql_update)) {
                die('Update data gagal: ' . $sql_update);
            }
        }
    } else {
        // Jika data tidak ditemukan, tambahkan data baru
        $sql_insert = "CALL produk_add('$jenis', '$bahan', '$ukuran', '$luas', '$stok', '$hargaB')";
        if (!$db->sqlquery($sql_insert)) {
            die('Insert data gagal: ' . $sql_insert);
        }
    }
    admin("produk.php");
}

if (isset($_POST['edit_produk'])) {
    $id = $_POST['id'];
    $jenis = $_POST['jenis2'] ?: 0; // ID kategori
    $stokP = $_POST['stokP'];
    $bahan = $_POST['bahan'];
    $hargaP = $_POST['hargaP'];
    $T = ($jenis == '1' || $jenis == '2') ? $_POST['tinggi'] : 0;
    $P = ($jenis == '2' || $jenis == '3') ? $_POST['panjang'] : 0;
    $L = ($jenis == '2' || $jenis == '3') ? $_POST['lebar'] : 0;
    $D = ($jenis == '1') ? $_POST['diameter'] : 0; // Diameter hanya relevan untuk kolam bulat
    $hargaB = round(floatval($_POST['harga-bahan']), 2);  // Membulatkan harga menjadi 2 desimal
    $stok = $_POST['stok'] ?: 0;

    // Hitung luas berdasarkan jenis kolam
    $luas = 0; // Variabel untuk menyimpan hasil luas

    if ($jenis == '1') { // Kolam bulat
        $radius = $D; // Radius dalam (m²)
        $luas = M_PI * pow($radius, 2); // Hitung luas alas (m²)
        $luas += 2 * M_PI * $radius * $T; // Tambahkan luas dinding (m²)
        $hargaB *= $luas;
    } elseif ($jenis == '2') { // Kolam kotak
        $luas = $P * $L; // Luas alas (m²)
        $luas += 2 * ($P * $T + $L * $T); // Tambahkan luas dinding (m²)
        $luas /= 10000; // Tambahkan luas dinding (m²)
        $hargaB *= $luas;
    } elseif ($jenis == '3') { // Lembaran
        $luas = $P * $L; // Luas lembaran (m²)
        $hargaB *= $luas;
    }

    $hargaB = round($hargaB);

    // Simpan data produk ke database
    $ukuran = "";
    if ($jenis == '1') { // Kolam bulat
        $ukuran = "D{$D} T{$T}";
    } elseif ($jenis == '2') { // Kolam kotak
        $ukuran = "{$P} x {$L} x {$T}";
    } elseif ($jenis == '3') { // Lembaran
        $ukuran = "{$P} x {$L}";
    }

    // Update produk
    if (!empty($stok) && empty($L) && empty($P) && empty($T) && empty($D)) {
        // Update stok saja
        $sql_produk = "CALL produk_edit_stok('$stokP','$stok', '$id')";
        if (!$db->sqlquery($sql_produk)) {
            die('Update stok gagal: ' . $sql_produk);
        }
    } elseif (!empty($hargaP)) {
        // Update harga saja
        $sql_produk = "CALL produk_edit_harga('$hargaP', '$id')";
        if (!$db->sqlquery($sql_produk)) {
            die('Update harga gagal: ' . $sql_produk);
        }
    } elseif (!empty($L) || !empty($P) || !empty($T) || !empty($D)) {
        // Update ukuran, bahan, atau produk lainnya
        $sql_produk = "CALL produk_edit('$jenis', '$bahan', '$ukuran', '$luas', '$stok', '$id')";
        if (!$db->sqlquery($sql_produk)) {
            die('Update produk gagal: ' . $sql_produk);
        }
    } else {
        die('Tidak ada perubahan yang disimpan.');
    }

    // Redirect setelah sukses
    admin("produk.php");
}

if (isset($_GET['del_produk'])) {
    $id  = $_GET['del_produk'];
    $sql = "CALL produk_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("produk.php");
    }
}

//action jenis bahan
if (isset($_POST['add_jenis_bahan'])) {
    $jenis = $_POST['jenis'];
    $merk = $_POST['merk'];

    // Query untuk memeriksa data duplikat
    $checkQuery = "CALL jenis_bahan_cek('$jenis', '$merk')";
    $result = $db->fetchdata($checkQuery);

    if (!empty($result)) {
        // Jika data ditemukan, proses input dibatalkan
        echo "<script>alert('Data jenis dan merk sudah ada!');</script>";
        admin("jenis_bahan.php");
    } else {
        // Jika data belum ada, lakukan insert
        $insertQuery = "CALL jenis_bahan_add('$jenis', '$merk')";

        if (!$db->sqlquery($insertQuery)) {
            die('Insert data gagal: ' . $insertQuery);
        } else {
            admin("jenis_bahan.php");
        }
    }
}

if (isset($_POST['edit_jenis_bahan'])) {
    $id = $_POST['id'];
    $jenis = $_POST['jenis'];
    $merk = $_POST['merk'];

    $sql = "CALL jenis_bahan_edit('$jenis', '$merk', '$id')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        admin("jenis_bahan.php");
    }
}

if (isset($_GET['del_jenis_bahan'])) {
    $id  = $_GET['del_jenis_bahan'];
    $sql = "CALL jenis_bahan_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        admin("jenis_bahan.php");
    }
}

// Menampilkan pesan error jika ada
if (isset($_SESSION['error_message'])) {
    echo "<div id='errorMessage' class='alert alert-danger' style='position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; width: auto;'>
            " . $_SESSION['error_message'] . "
          </div>";

    // JavaScript untuk menyembunyikan alert setelah 5 detik
    echo "<script>
            setTimeout(function() {
                var errorMessage = document.getElementById('errorMessage');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 5000); // 5000ms = 5 detik
          </script>";

    // Menghapus pesan error dari session setelah ditampilkan
    unset($_SESSION['error_message']);
}

//action pengeluaran

if (isset($_POST['add_penjualan'])) {
    // Ambil data inputan
    $produk = $_POST['produk'];
    echo $produk;
    $jml = $_POST['jml'];

    // Validasi input
    if (empty($produk) || empty($jml)) {
        $_SESSION['error_message'] = "Semua field harus diisi!";
        admin("penjualan.php"); // Redirect kembali ke form
        exit();
    }

    // Validasi jumlah stok (contoh validasi, sesuaikan dengan kebutuhan)
    $sql_check_stok = "SELECT stok FROM tb_produk WHERE id_produk = '$produk'";
    $result = $db->datasql($sql_check_stok);

    if ($result) {
        $stok = $result['stok'];
        if ($stok < $jml) {
            $_SESSION['error_message'] = "Stok tidak mencukupi!";
            admin("penjualan.php"); // Redirect ke halaman admin penjualan
            exit();
        } else if ($stok = 0) {
            $_SESSION['error_message'] = "Stok Habis!";
            admin("penjualan.php"); // Redirect ke halaman admin penjualan
            exit();
        }
    } else if ($result['stok'] == '0') {
        $_SESSION['error_message'] = "Stok Habis!";
        admin("penjualan.php"); // Redirect ke halaman admin penjualan
        exit();
    }

    // Query untuk insert data penjualan
    $insertQuery = "CALL penjualan_add('$produk', '$jml')";

    if (!$db->sqlquery($insertQuery)) {
        // Jika insert gagal, tampilkan error
        $_SESSION['error_message'] = "Gagal menyimpan data penjualan!";
        admin("penjualan.php"); // Redirect kembali ke form penjualan
        exit();
    } else {
        // Jika berhasil, redirect ke halaman admin penjualan
        admin("penjualan.php");
        exit();
    }
}

if (isset($_GET['del_log_penjualan'])) {
    $id = $_GET['del_log_penjualan'];
    $jml = $_POST['jml'];

    $insertQuery = "CALL log_penjualan_del('$id')";

    if (!$db->sqlquery($insertQuery)) {
        die('Insert data gagal: ' . $insertQuery);
    } else {
        admin("penjualan.php");
    }
}

//action pengeluaran

if (isset($_POST['add_pengeluaran'])) {
    // Ambil data inputan
    $kategori = $_POST['kategori'];
    $nominal = $_POST['nominal'];

    $insertQuery = "CALL pengeluaran_add('$kategori', '$nominal')";

    if (!$db->sqlquery($insertQuery)) {
        admin("pengeluaran.php"); // Redirect kembali ke form penjualan
        exit();
    } else {
        // Jika berhasil, redirect ke halaman admin penjualan
        admin("pengeluaran.php");
        exit();
    }
}

if (isset($_GET['del_log_pengeluaran'])) {
    $id = $_GET['del_log_pengeluaran'];

    $insertQuery = "CALL log_pengeluaran_del('$id')";

    if (!$db->sqlquery($insertQuery)) {
        die('Insert data gagal: ' . $insertQuery);
    } else {
        admin("pengeluaran.php");
    }
}

// Proses Check-in
if (isset($_POST['checkin'])) {
    $id = $_POST['idP'];
    $id_absensi = $_POST['id_absensi'];

    // Query untuk memasukkan Check-in
    $sql_checkin = "CALL checkin_pegawai('$id', '$id_absensi')";
    if ($db->sqlquery($sql_checkin)) {
        // Jika berhasil, redirect ke halaman absensi
        pegawai("absensi.php");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Check-in gagal!";
    }
}

// Proses Check-out
if (isset($_POST['checkout'])) {
    $id = $_POST['idP'];
    $id_absensi = $_POST['id_absensi'];
    $waktu_checkout = date("H:i:s"); // Waktu Check-out menggunakan waktu server

    // Query untuk memasukkan Check-out
    $sql_checkout = "CALL checkout_pegawai('$id', '$id_absensi', '$waktu_checkout')";
    if ($db->sqlquery($sql_checkout)) {
        // Jika berhasil, redirect ke halaman absensi
        pegawai("absensi.php");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Check-out gagal!";
    }
}

// Proses Add Agenda Absensi
if (isset($_POST['add_agenda'])) {
    $agenda = $_POST['agenda']; // Nama agenda yang diinputkan
    $tanggal = $_POST['tanggal']; // Tanggal untuk agenda absensi

    // Query untuk menambahkan agenda absensi
    $sql_add_agenda = "CALL add_agenda_absensi('$agenda', '$tanggal')";
    if ($db->sqlquery($sql_add_agenda)) {
        // Jika berhasil, redirect ke halaman absensi
        admin("absensi.php");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Agenda absensi gagal ditambahkan!";
    }
}



// Action alamat ajax
if (isset($_POST['jenis'])) {
    $jenis = $_POST['jenis'];

    // $query = "call pegawai()"; // Query menggunakan prosedur
    // $data = $db->fetchdata($query);

    if ($jenis == 'kab') {
        $prop = $_POST['prop'];
        $sql = "SELECT * FROM kabupaten WHERE propinsi_id='$prop' ORDER BY nama_kab";
        $data = $db->fetchdata($sql);
        foreach ($data as $dat) {
            echo "<option value='" . $dat['id'] . "'>" . $dat['nama_kab'] . "</option>";
        }
    }

    if ($jenis == 'kec') {
        $kab = $_POST['kab'];
        $sql = "SELECT * FROM kecamatan WHERE kabupaten_id='$kab' ORDER BY nama_kec";
        $data = $db->fetchdata($sql);
        foreach ($data as $dat) {
            echo "<option value='" . $dat['id'] . "'>" . $dat['nama_kec'] . "</option>";
        }
    }

    if ($jenis == 'desa') {
        $kec = $_POST['kec'];
        $sql = "SELECT * FROM desa WHERE kecamatan_id='$kec' ORDER BY nama_desa";
        $data = $db->fetchdata($sql);
        foreach ($data as $dat) {
            echo "<option value='" . $dat['id'] . "'>" . $dat['nama_desa'] . "</option>";
        }
    }

    // Jenis Kolam Bulat
    if ($jenis == '1') {
        // Mengirim input spesifik untuk kolam bulat
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="diameter">Diameter (m)</label>
        <input type="number" name="diameter" id="diameter" class="form-control" required placeholder="Masukkan diameter" step="0.01">
    </div>
    <div class="form-group">
        <label for="tinggi">Tinggi (m)</label>
        <input type="number" name="tinggi" id="tinggi" class="form-control" required placeholder="Masukkan tinggi" step="0.01">
    </div>';
    }

    // Jenis Kolam Kotak
    if ($jenis == '2') {
        // Mengirim input spesifik untuk kolam kotak
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="panjang">Panjang (cm)</label>
        <input type="number" name="panjang" id="panjang" class="form-control" required placeholder="Masukkan panjang">
    </div>
    <div class="form-group">
        <label for="lebar">Lebar (cm)</label>
        <input type="number" name="lebar" id="lebar" class="form-control" required placeholder="Masukkan lebar">
    </div>
    <div class="form-group">
        <label for="tinggi">Tinggi (cm)</label>
        <input type="number" name="tinggi" id="tinggi" class="form-control" required placeholder="Masukkan tinggi">
    </div>';
    }

    // Jenis Kolam Lembaran
    if ($jenis == '3') {
        // Mengirim input spesifik untuk kolam lembaran
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="panjang">Panjang (m)</label>
        <input type="number" name="panjang" id="panjang" class="form-control" required placeholder="Masukkan panjang" step="0.01">
    </div>
    <div class="form-group">
        <label for="lebar">Lebar (m)</label>
        <input type="number" name="lebar" id="lebar" class="form-control" required placeholder="Masukkan lebar" step="0.01">
    </div>';
    }

    // Jika jenis kolam tidak ditemukan
    if (!in_array($jenis, ['1', '2', '3'])) {
        echo '<p>Jenis kolam tidak valid.</p>';
    }
}

if (isset($_POST['jenis2'])) {
    $jenis = $_POST['jenis2'];

    // Jenis Kolam Bulat
    if ($jenis == '1') {
        // Mengirim input spesifik untuk kolam bulat
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="diameter">Diameter (m)</label><br>
        <input type="number" name="diameter" id="diameter" class="form-control" required placeholder="Masukkan diameter" step="0.01">
    </div><br><br>
    <div class="form-group">
        <label for="tinggi">Tinggi (m)</label><br>
        <input type="number" name="tinggi" id="tinggi" class="form-control" required placeholder="Masukkan tinggi" step="0.01">
    </div><br><br>';
    }

    // Jenis Kolam Kotak
    if ($jenis == '2') {
        // Mengirim input spesifik untuk kolam kotak
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="panjang">Panjang (cm)</label><br>
        <input type="number" name="panjang" id="panjang" class="form-control" required placeholder="Masukkan panjang">
    </div><br><br>
    <div class="form-group">
        <label for="lebar">Lebar (cm)</label><br>
        <input type="number" name="lebar" id="lebar" class="form-control" required placeholder="Masukkan lebar">
    </div><br><br>
    <div class="form-group">
        <label for="tinggi">Tinggi (cm)</label><br>
        <input type="number" name="tinggi" id="tinggi" class="form-control" required placeholder="Masukkan tinggi">
    </div><br><br>';
    }

    // Jenis Kolam Lembaran
    if ($jenis == '3') {
        // Mengirim input spesifik untuk kolam lembaran
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="panjang">Panjang (m)</label><br>
        <input type="number" name="panjang" id="panjang" class="form-control" required placeholder="Masukkan panjang" step="0.01">
    </div><br><br>
    <div class="form-group">
        <label for="lebar">Lebar (m)</label><br>
        <input type="number" name="lebar" id="lebar" class="form-control" required placeholder="Masukkan lebar" step="0.01">
    </div><br><br>';
    }

    // Jika jenis kolam tidak ditemukan
    if (!in_array($jenis, ['1', '2', '3'])) {
        echo '<p>Jenis kolam tidak valid.</p>';
    }
}
