<?php
session_start();
unset($_SESSION['id_siswa']);
unset($_SESSION['nis']);
unset($_SESSION['nama_siswa']);
unset($_SESSION['kelas']);
session_destroy();
header("Location: login_siswa.php");