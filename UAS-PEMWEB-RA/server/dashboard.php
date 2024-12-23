<?php
session_start();

// Periksa jika pengguna belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil informasi pengguna
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, <?= htmlspecialchars($username) ?>!</h1>
    <p>Anda telah login ke sistem.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
