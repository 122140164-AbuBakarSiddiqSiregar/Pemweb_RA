<?php
session_start();

// Periksa jika pengguna sudah login
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh validasi sederhana (diimplementasikan dengan hardcode)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

require 'cookie_manager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['username'] = $username;

        // Simpan cookie untuk login otomatis
        setCookieData('username', $username, 3600); // 1 jam

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

// Periksa cookie untuk login otomatis
if (getCookieData('username')) {
    $_SESSION['username'] = getCookieData('username');
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>