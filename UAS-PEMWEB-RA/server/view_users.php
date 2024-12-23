<?php
require 'db_config.php';

// Query untuk mengambil data dari tabel users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Pengguna</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Hobi</th>
                <th>Negara</th>
                <th>Browser</th>
                <th>IP Address</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['gender']) ?></td>
                    <td><?= htmlspecialchars($user['hobbies']) ?></td>
                    <td><?= htmlspecialchars($user['country']) ?></td>
                    <td><?= htmlspecialchars($user['browser']) ?></td>
                    <td><?= htmlspecialchars($user['ip_address']) ?></td>
                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="server/delete_user.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        <button type="submit">Hapus</button>
    </form>

</body>
</html>
