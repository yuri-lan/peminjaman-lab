<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Login - Peminjaman Lab</title>
    <link rel="stylesheet" href="/peminjaman_lab/assets/style.css">
</head>
<body class="login-body">
    <div class="login-box" style="max-width: 500px;">
        <h1>📚 Peminjaman Lab</h1>
        <p style="text-align:center; color:#718096; margin-bottom: 30px;">Pilih tipe pengguna</p>

        <a href="login.php" class="btn-role">
            <div class="role-icon">👨‍💼</div>
            <div>
                <b>Login Admin</b>
                <p>Kelola data, peminjaman, laporan</p>
            </div>
        </a>

        <a href="login_siswa.php" class="btn-role">
            <div class="role-icon">🎓</div>
            <div>
                <b>Login Siswa</b>
                <p>Pinjam barang, lihat riwayat</p>
            </div>
        </a>
    </div>
</body>
</html>