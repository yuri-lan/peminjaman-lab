<?php
session_start();
include '../config/koneksi.php';

$id_siswa = $_POST['id_siswa'];
$id_admin = $_SESSION['id_admin'];
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'];
$barangs = $_POST['barang'];
$jumlahs = $_POST['jumlah'];

// Simpan peminjaman
mysqli_query($koneksi, "INSERT INTO peminjamans (id_siswa, id_admin, tanggal_pinjam, tanggal_kembali, status) 
                        VALUES ('$id_siswa','$id_admin','$tgl_pinjam','$tgl_kembali','dipinjam')");
$id_pinjam = mysqli_insert_id($koneksi);

// Simpan detail + kurangi stok
for ($i = 0; $i < count($barangs); $i++) {
    if ($barangs[$i] == '') continue;
    $id_barang = $barangs[$i];
    $jumlah = $jumlahs[$i];
    
    mysqli_query($koneksi, "INSERT INTO detail_peminjamans (id_pinjam, id_barang, jumlah) 
                            VALUES ('$id_pinjam','$id_barang','$jumlah')");
    
    mysqli_query($koneksi, "UPDATE barangs SET stok = stok - $jumlah WHERE id_barang='$id_barang'");
}

header("Location: peminjaman.php");