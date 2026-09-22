<?php
session_start();
include '../config/koneksi.php';

$nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
$password = md5($_POST['password']);

$query = "SELECT * FROM siswas WHERE nis='$nis' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $siswa = mysqli_fetch_assoc($result);
    $_SESSION['id_siswa']   = $siswa['id_siswa'];
    $_SESSION['nis']        = $siswa['nis'];
    $_SESSION['nama_siswa'] = $siswa['nama_siswa'];
    $_SESSION['kelas']      = $siswa['kelas'];
    header("Location: ../siswa/dashboard.php");
    exit;
} else {
    header("Location: login_siswa.php?error=1");
    exit;
}