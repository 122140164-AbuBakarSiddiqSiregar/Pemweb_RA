<?php
require 'db_config.php';
require 'UserHandler.php';

$userHandler = new UserHandler($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($userHandler->deleteUser($id) === true) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Terjadi kesalahan saat menghapus data.";
    }
} else {
    echo "Metode yang digunakan tidak valid!";
}
?>
