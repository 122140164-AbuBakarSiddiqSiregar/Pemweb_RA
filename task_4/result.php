<?php
session_start();
if (!isset($_SESSION["data"])) {
    die("Tidak ada data yang ditemukan");
}

$data = $_SESSION["data"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9f2fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            border-left: 8px solid #3b82f6;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #3b82f6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #f9f9f9;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #3b82f6;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e6f4ff;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pendaftaran</h2>
        <table>
            <tr>
                <th>Nama</th>
                <td><?= htmlspecialchars($data["name"]) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($data["email"]) ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?= htmlspecialchars($data["password"]) ?></td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td><?= htmlspecialchars($data["phone"]) ?></td>
            </tr>
            <tr>
                <th>Browser/OS</th>
                <td><?= htmlspecialchars($data["browserInfo"]) ?></td>
            </tr>
        </table>

        <h2>Isi File:</h2>
        <table>
            <tr>
                <th>Baris</th>
                <th>Isi</th>
            </tr>
            <?php foreach ($data["fileContent"] as $index => $line): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($line) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="footer">
            &copy; 2024 Pendaftaran | Hasil Modern
        </div>
    </div>
</body>
</html>
