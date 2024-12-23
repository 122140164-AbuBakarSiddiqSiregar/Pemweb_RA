<?php
require 'db_config.php';
require 'UserHandler.php';

$userHandler = new UserHandler($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobby']) && is_array($_POST['hobby']) ? implode(', ', $_POST['hobby']) : '';
    $country = $_POST['country'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    if (empty($name) || empty($gender) || empty($hobbies) || empty($country)) {
        echo "Harap lengkapi semua data!";
        exit;
    }

    $result = $userHandler->saveUser($name, $gender, $hobbies, $country, $browser, $ip_address);

    if ($result === true) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Terjadi kesalahan: " . $result;
    }
} else {
    echo "Metode yang digunakan tidak valid!";
}
?>
