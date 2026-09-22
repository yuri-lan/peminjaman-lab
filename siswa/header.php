<?php
session_start();
if (!isset($_SESSION['id_siswa'])) {
    header("Location: ../auth/login_siswa.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Siswa - Peminjaman Lab</title>
    <link rel="stylesheet" href="/peminjaman_lab/assets/style.css">
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <h2>🎓 Area Siswa</h2>
        <nav>
            <a href="/peminjaman_lab/siswa/dashboard.php">Dashboard</a>
            <a href="/peminjaman_lab/siswa/barang.php">Daftar Barang</a>
            <a href="/peminjaman_lab/siswa/pinjam.php">Ajukan Pinjam</a>
            <a href="/peminjaman_lab/siswa/riwayat.php">Riwayat Saya</a>
        </nav>
        <div class="user-info">
            <p>👤 <?= $_SESSION['nama_siswa'] ?></p>
            <p style="font-size:11px; opacity:0.7;"><?= $_SESSION['kelas'] ?> — <?= $_SESSION['nis'] ?></p>
            <a href="/peminjaman_lab/auth/logout_siswa.php" class="btn-logout">Logout</a>
        </div>
    </aside>
    <main class="content">