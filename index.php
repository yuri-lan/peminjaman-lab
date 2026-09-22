<?php
session_start();

if (isset($_SESSION['id_admin'])) {
    header("Location: pages/dashboard.php");
    exit;
}
if (isset($_SESSION['id_siswa'])) {
    header("Location: siswa/dashboard.php");
    exit;
}

header("Location: auth/pilih_login.php");