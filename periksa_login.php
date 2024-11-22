<?php
session_start();
include 'class_db.php';

$db = new database();

$username = $_POST['username'];
$password = md5($_POST['password']); 

$sql = "call user_cek('$username','$password')";

$result = $db->sqlquery($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $_SESSION['id'] = $row['id_user'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['namaL'];

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
    header("location:index.php?alert=gagal"); 
}