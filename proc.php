<?php
include 'class_db.php';
include 'config.php';
$db = new Database();

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
    session_start();
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
    $sql = "CALL pegawai_add('$nama', '$posisi', '$alamat')";

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

    if ($alamat == "") {
        $db->sqlquery("CALL pegawai_edit_TA('$nama', '$posisi', '$id')");
        admin("pegawai.php");
    } else {
        $db->sqlquery("CALL pegawai_edit_full('$nama', '$posisi', '$alamat','$id')");
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
    $nama = $_POST['namaJ'];
    $warna = $_POST['warna'];
    $p = $_POST['panjang'];
    $l = $_POST['lebar'];
    $pemasok = $_POST['pemasok'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Query untuk memeriksa apakah data sudah ada
    $sql_check = "CALL bahan_cek('$nama', '$warna', '$p', '$l', '$pemasok')";
    $result = $db->fetchdata($sql_check); // Ambil hasil dari prosedur `bahan_check`

    // Jika data ditemukan, lakukan update
    if (!empty($result)) {
        foreach ($result as $d) {
            $id = $d['id_bahan']; // Ambil ID bahan dari hasil query
            $sql_update = "CALL bahan_edit('$nama', '$warna', '$p', '$l', '$pemasok', '$stok', '$id','$harga')";
            if (!$db->sqlquery($sql_update)) {
                die('Update data gagal: ' . $sql_update);
            }
        }
    } else {
        // Jika data tidak ditemukan, tambahkan data baru
        $sql_insert = "CALL bahan_add('$nama', '$warna', '$p', '$l', '$pemasok', '$stok','$harga')";
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
    if ($jenis == 'Kolam Bulat') {
        // Mengirim input spesifik untuk kolam bulat
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="diameter">Diameter (m)</label>
        <input type="number" name="diameter" id="diameter" class="form-control" required placeholder="Masukkan diameter">
    </div>
    <div class="form-group">
        <label for="tinggi">Tinggi (m)</label>
        <input type="number" name="tinggi" id="tinggi" class="form-control" required placeholder="Masukkan tinggi">
    </div>';
    }

    // Jenis Kolam Kotak
    if ($jenis == 'Kolam Kotak') {
        // Mengirim input spesifik untuk kolam kotak
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="panjang">Panjang (m)</label>
        <input type="number" name="panjang" id="panjang" class="form-control" required placeholder="Masukkan panjang">
    </div>
    <div class="form-group">
        <label for="lebar">Lebar (m)</label>
        <input type="number" name="lebar" id="lebar" class="form-control" required placeholder="Masukkan lebar">
    </div>
    <div class="form-group">
        <label for="tinggi">Tinggi (m)</label>
        <input type="number" name="tinggi" id="tinggi" class="form-control" required placeholder="Masukkan tinggi">
    </div>';
    }

    // Jenis Kolam Lembaran
    if ($jenis == 'Lembaran') {
        // Mengirim input spesifik untuk kolam lembaran
        echo '
    <div class="form-group">
        <label>Ukuran</label><br><br>
        <label for="panjang">Panjang (m)</label>
        <input type="number" name="panjang" id="panjang" class="form-control" required placeholder="Masukkan panjang">
    </div>
    <div class="form-group">
        <label for="lebar">Lebar (m)</label>
        <input type="number" name="lebar" id="lebar" class="form-control" required placeholder="Masukkan lebar">
    </div>';
    }

    // Jika jenis kolam tidak ditemukan
    if (!in_array($jenis, ['Kolam Bulat', 'Kolam Kotak', 'Lembaran'])) {
        echo '<p>Jenis kolam tidak valid.</p>';
    }
}
