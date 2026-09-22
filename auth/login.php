<?php
session_start();
if (isset($_SESSION['id_admin'])) {
    header("Location: ../pages/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Peminjaman Lab</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="login-body">
    <div class="login-box">
        <h1>📚 Peminjaman Lab</h1>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert-error">Username atau password salah!</div>
        <?php endif; ?>
        <form method="POST" action="proses_login.php">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>