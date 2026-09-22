<?php
include '../config/koneksi.php';

$id_pinjam = $_POST['id_pinjam'];
$tgl = $_POST['tanggal_dikembalikan'];
$kondisi = $_POST['kondisi_kembali'];
$denda = $_POST['denda'];

// Simpan pengembalian
mysqli_query($koneksi, "INSERT INTO pengembalians (id_pinjam, tanggal_dikembalikan, kondisi_kembali, denda) 
                        VALUES ('$id_pinjam','$tgl','$kondisi','$denda')");

// Update status peminjaman
mysqli_query($koneksi, "UPDATE peminjamans SET status='dikembalikan' WHERE id_pinjam='$id_pinjam'");

// Kembalikan stok barang
$q = mysqli_query($koneksi, "SELECT * FROM detail_peminjamans WHERE id_pinjam='$id_pinjam'");
while ($d = mysqli_fetch_assoc($q)) {
    mysqli_query($koneksi, "UPDATE barangs SET stok = stok + {$d['jumlah']} WHERE id_barang='{$d['id_barang']}'");
}

header("Location: pengembalian.php");