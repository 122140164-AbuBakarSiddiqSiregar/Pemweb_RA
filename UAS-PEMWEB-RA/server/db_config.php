<?php
$host = 'localhost'; // Host database
$user = 'root'; // Username database
$password = ''; // Password database
$dbname = 'uas_pemweb_ra'; // Nama database

// Buat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
