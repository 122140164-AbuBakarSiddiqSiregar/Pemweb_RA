<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $phone = trim($_POST["phone"]);
    $file = $_FILES["file"];

    // Validate data
    if (empty($name) || strlen($name) < 3) {
        die("Nama harus minimal 3 karakter");
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid");
    }

    if (empty($password) || strlen($password) < 6) {
        die("Password harus minimal 6 karakter");
    }

    if (empty($phone) || !is_numeric($phone)) {
        die("Nomor telepon tidak valid");
    }

    if (empty($file["name"])) {
        die("File harus diupload");
    }

    $allowedExtensions = ["txt"];
    $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);

    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Hanya file .txt yang diizinkan");
    }

    if ($file["size"] > 1024 * 1024) {
        die("Ukuran file maksimal 1MB");
    }

    // Read file content
    $fileContent = file_get_contents($file["tmp_name"]);
    $fileLines = explode("\n", $fileContent);

    // Get browser info
    $browserInfo = $_SERVER["HTTP_USER_AGENT"];

    session_start();
    $_SESSION["data"] = [
        "name" => $name,
        "email" => $email,
        "password" => $password,
        "phone" => $phone,
        "fileContent" => $fileLines,
        "browserInfo" => $browserInfo,
    ];

    header("Location: result.php");
}
?>
