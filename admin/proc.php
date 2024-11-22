<?php
include 'C:/laragon/www/vinjhonterpal/class_db.php';
$db = new Database();

// Fungsi untuk mengalihkan halaman
function redirect($url)
{
    header("Location: $url");
    exit();
}

// Action kategori produk
if (isset($_POST['add_KP'])) {
    $nama = $_POST['namaK'];
    $sql = "CALL KP_add('$nama')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php");
    }
}

if (isset($_POST['edit_KP'])) {
    $id = $_POST['id'];
    $nama = $_POST['namaK'];
    $sql = "CALL KP_edit('$id', '$nama')";

    if (!$db->sqlquery($sql)) {
        die('Update data gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php");
    }
}

if (isset($_GET['del_KP'])) {
    $id = $_GET['del_KP'];
    $sql = "CALL KP_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_produk.php");
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
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_pengeluaran.php");
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
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_pengeluaran.php");
    }
}

if (isset($_GET['del_KPG'])) {
    $id = $_GET['del_KPG'];
    $sql = "CALL KPG_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_pengeluaran.php");
    }
}

// Action user
if (isset($_POST['gantiPW'])) {
    session_start();
    $id = $_SESSION['id'];
    $password = md5($_POST['password']);
    $sql = "CALL PW_edit('$password', '$id')";

    if (!$db->sqlquery($sql)) {
        die('Update password gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/gantipassword.php?alert=sukses");
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
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php");
    } else {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $allowed)) {
            redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php?alert=gagal");
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename);
            $file_gambar = $rand . '_' . $filename;
            $db->sqlquery("call USER_add('$nama', '$username', '$password', '$file_gambar', '$level')");
            redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php");
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
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php");
    } elseif ($pwd == "") {
        if (!in_array($ext, $allowed)) {
            redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php");
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'C:/laragon/www//vinjhonterpal/gambar/user/' . $rand . '_' . $filename);
            $x = $rand . '_' . $filename;
            $db->sqlquery("call USER_edit_TP('$id','$nama', '$user', '$x', '$level')");
            redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php?alert=berhasil");
        }
    } elseif ($filename == "") {
        $db->sqlquery("call USER_edit_TF('$id','$nama', '$user', '$pass', '$level')");
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php?alert=berhasil");
    } else {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'C:/laragon/www//vinjhonterpal/gambar/user/' . $rand . '_' . $filename);
        $x = $rand . '_' . $filename;
        $db->sqlquery("call USER_edit('$id','$nama', '$user', '$pass','$x','$level')");
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php?alert=berhasil");
    }
}

if (isset($_GET['USER_del'])) {
    session_start();
    $id  = $_GET['USER_del'];
    $sql = "CALL USER_del('$id')";

    if (!$db->sqlquery($sql)) {
        die('Delete data gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/user.php");
    }
}

// Action Pegawai
if (isset($_POST['add_pegawai'])) {
    $nama = $_POST['nama'];
    $ket = $_POST['ke'];
    $sql = "CALL KPG_add('$nama', '$ket')";

    if (!$db->sqlquery($sql)) {
        die('Insert data gagal: ' . $sql);
    } else {
        redirect("http://localhost/vinjhonterpal/admin/menu_sidebar/kategori_pengeluaran.php");
    }
}

// Action alamat ajax
if (isset($_POST['jenis'])) {
    $jenis = $_POST['jenis'];

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
}
