<?php
include '../config/koneksi.php';
mysqli_query($koneksi, "DELETE FROM siswas WHERE id_siswa='{$_GET['id']}'");
header("Location: siswa.php");