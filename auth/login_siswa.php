<?php
session_start();
if (isset($_SESSION['id_siswa'])) {
    header("Location: ../siswa/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Siswa - Peminjaman Lab</title>
    <link rel="stylesheet" href="/peminjaman_lab/assets/style.css">
</head>
<body class="login-body">
    <div class="login-box">
        <h1>🎓 Login Siswa</h1>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert-error">NIS atau password salah!</div>
        <?php endif; ?>
        <form method="POST" action="proses_login_siswa.php">
            <label>NIS</label>
            <input type="text" name="nis" required autofocus>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p style="text-align:center; margin-top:20px; font-size:13px;">
            <a href="pilih_login.php" style="color:#4f6df5;">← Kembali</a>
        </p>
    </div>
</body>
</html>