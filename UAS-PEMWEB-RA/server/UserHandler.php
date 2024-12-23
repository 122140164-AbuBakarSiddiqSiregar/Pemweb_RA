<?php
class UserHandler
{
    private $conn;

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Metode untuk menyimpan data pengguna
    public function saveUser($name, $gender, $hobbies, $country, $browser, $ip_address)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (name, gender, hobbies, country, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $gender, $hobbies, $country, $browser, $ip_address);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: " . $stmt->error;
        }
    }

    // Metode untuk mendapatkan semua data pengguna
    public function getAllUsers()
    {
        $result = $this->conn->query("SELECT * FROM users");

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function deleteUser($id)
{
    $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}

}
?>
