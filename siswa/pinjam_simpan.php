<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['id_siswa'])) {
    header("Location: ../auth/login_siswa.php");
    exit;
}

$id_siswa    = $_SESSION['id_siswa'];
$tgl_pinjam  = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'];
$barangs     = $_POST['barang'];
$jumlahs     = $_POST['jumlah'];

// Admin default id=1 (karena sistem otomatis)
$id_admin = 1;

mysqli_query($koneksi, "INSERT INTO peminjamans (id_siswa, id_admin, tanggal_pinjam, tanggal_kembali, status) 
                        VALUES ('$id_siswa','$id_admin','$tgl_pinjam','$tgl_kembali','dipinjam')");
$id_pinjam = mysqli_insert_id($koneksi);

for ($i = 0; $i < count($barangs); $i++) {
    if ($barangs[$i] == '') continue;
    $id_barang = $barangs[$i];
    $jumlah    = $jumlahs[$i];

    mysqli_query($koneksi, "INSERT INTO detail_peminjamans (id_pinjam, id_barang, jumlah) 
                            VALUES ('$id_pinjam','$id_barang','$jumlah')");

    mysqli_query($koneksi, "UPDATE barangs SET stok = stok - $jumlah WHERE id_barang='$id_barang'");
}

header("Location: riwayat.php");