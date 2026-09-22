<?php
include '../config/koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM barangs WHERE id_barang='$id'");
header("Location: barang.php");