<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Lab</title>
    <link rel="stylesheet" href="/peminjaman_lab/assets/style.css">
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <h2>📚 Peminjaman Lab</h2>
        <nav>
            <a href="/peminjaman_lab/pages/dashboard.php">Dashboard</a>
            <a href="/peminjaman_lab/pages/barang.php">Data Barang</a>
            <a href="/peminjaman_lab/pages/siswa.php">Data Siswa</a>
            <a href="/peminjaman_lab/pages/peminjaman.php">Peminjaman</a>
            <a href="/peminjaman_lab/pages/pengembalian.php">Pengembalian</a>
            <a href="/peminjaman_lab/pages/laporan.php">Laporan</a>
        </nav>
        <div class="user-info">
            <p>👤 <?= $_SESSION['nama_admin'] ?></p>
            <a href="/peminjaman_lab/auth/logout.php" class="btn-logout">Logout</a>
        </div>
    </aside>
    <main class="content">