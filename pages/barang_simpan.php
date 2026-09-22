<?php
include '../config/koneksi.php';

$id = $_POST['id_barang'];
$kode = $_POST['kode_barang'];
$nama = $_POST['nama_barang'];
$kategori = $_POST['kategori'];
$stok = $_POST['stok'];
$kondisi = $_POST['kondisi'];

if ($id == '') {
    mysqli_query($koneksi, "INSERT INTO barangs (kode_barang, nama_barang, kategori, stok, kondisi) 
                            VALUES ('$kode','$nama','$kategori','$stok','$kondisi')");
} else {
    mysqli_query($koneksi, "UPDATE barangs SET kode_barang='$kode', nama_barang='$nama', 
                            kategori='$kategori', stok='$stok', kondisi='$kondisi' 
                            WHERE id_barang='$id'");
}

header("Location: barang.php");