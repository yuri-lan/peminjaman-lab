<?php
include '../config/koneksi.php';

$id = $_POST['id_siswa'];
$nis = $_POST['nis'];
$nama = $_POST['nama_siswa'];
$kelas = $_POST['kelas'];
$hp = $_POST['no_hp'];

if ($id == '') {
    mysqli_query($koneksi, "INSERT INTO siswas (nis, nama_siswa, kelas, no_hp) VALUES ('$nis','$nama','$kelas','$hp')");
} else {
    mysqli_query($koneksi, "UPDATE siswas SET nis='$nis', nama_siswa='$nama', kelas='$kelas', no_hp='$hp' WHERE id_siswa='$id'");
}
header("Location: siswa.php");