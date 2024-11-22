<?php
session_start(); // Pastikan session dimulai di bagian atas

include 'class_db.php'; // Pastikan class db sudah di-include

$db = new database(); // Membuat objek database

// Mendapatkan input dari form login
$username = $_POST['username'];
$password = md5($_POST['password']); // Pastikan password di-hash dengan md5

// Menjalankan prosedur SQL untuk cek username dan password
$sql = "call user_cek('$username', '$password')";

// Eksekusi query
$result = $db->sqlquery($sql);

// Cek apakah ada hasil yang ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Menyimpan data dalam session jika login berhasil
    $_SESSION['id'] = $row['id_user'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['namaL'];

    // Cek level pengguna dan arahkan sesuai dengan level
    if ($row['namaL'] == "Administrator") {
        $_SESSION['status'] = "administrator_logedin";
        header("location:admin/");
    } elseif ($row['level'] == "2") {
        $_SESSION['status'] = "manajemen_logedin";
        header("location:manajemen/");
    } else {
        header("location:index.php?alert=gagal");
    }
} else {
    header("location:index.php?alert=gagal"); // Jika login gagal
}
?>
