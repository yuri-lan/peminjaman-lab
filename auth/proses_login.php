<?php
session_start();
include '../config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']);

$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);
    $_SESSION['id_admin'] = $admin['id_admin'];
    $_SESSION['username'] = $admin['username'];
    $_SESSION['nama_admin'] = $admin['nama_admin'];
    header("Location: ../pages/dashboard.php");
} else {
    header("Location: login.php?error=1");
}