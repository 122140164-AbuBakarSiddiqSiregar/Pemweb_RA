# README - Ujian Pemrograman Web

## **Proyek Ujian Pemrograman Web**
Proyek ini mencakup pengembangan aplikasi web sederhana yang mencakup aspek client-side dan server-side programming, pengelolaan database, serta state management. Berikut adalah penjelasan untuk setiap bagian berdasarkan kriteria penilaian.

---

## **Bagian 1: Client-side Programming**

### **1.1 Manipulasi DOM dengan JavaScript**
#### **Form Input dengan 4 Elemen**
- Form dibuat dengan elemen berikut:
  - Input teks untuk nama pengguna.
  - Radio button untuk memilih jenis kelamin.
  - Checkbox untuk memilih hobi.
  - Dropdown untuk memilih negara.

#### **Kode Form HTML**
```html
<form id="dataForm" action="server/process.php" method="POST">
  <label for="name">Nama:</label>
  <input type="text" id="name" name="name" required><br><br>

  <label for="gender">Jenis Kelamin:</label>
  <input type="radio" id="male" name="gender" value="Male">
  <label for="male">Laki-laki</label>
  <input type="radio" id="female" name="gender" value="Female">
  <label for="female">Perempuan</label><br><br>

  <label for="hobby">Hobi:</label>
  <input type="checkbox" id="hobby1" name="hobby[]" value="Membaca">
  <label for="hobby1">Membaca</label>
  <input type="checkbox" id="hobby2" name="hobby[]" value="Olahraga">
  <label for="hobby2">Olahraga</label><br><br>

  <label for="country">Negara:</label>
  <select id="country" name="country">
    <option value="Indonesia">Indonesia</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Singapore">Singapore</option>
  </select><br><br>

  <button type="submit" id="submitButton">Submit</button>
</form>
```

#### **Tabel HTML**
```html
<table id="dataTable">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Hobi</th>
      <th>Negara</th>
    </tr>
  </thead>
  <tbody>
    <!-- Data akan dimasukkan di sini -->
  </tbody>
</table>
```

#### **Kode JavaScript**
```javascript
// Fungsi untuk memuat data dari server
function loadUserData() {
    fetch('server/view_user.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('dataTable').querySelector('tbody');
            tableBody.innerHTML = ''; // Hapus isi tabel sebelumnya

            data.forEach(user => {
                const newRow = tableBody.insertRow();
                newRow.innerHTML = `
                    <td>${user.name}</td>
                    <td>${user.gender}</td>
                    <td>${user.hobbies}</td>
                    <td>${user.country}</td>
                `;
            });
        })
        .catch(error => console.error('Error:', error));
}

// Tambahkan event listener ke form
const form = document.getElementById('dataForm');
form.addEventListener('submit', function (e) {
    e.preventDefault(); // Mencegah pengiriman form default

    const formData = new FormData(form);

    fetch('server/process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert(result); // Tampilkan pesan sukses atau error
        form.reset(); // Reset form
        loadUserData(); // Perbarui tabel dengan data baru
    })
    .catch(error => console.error('Error:', error));
});

// Muat data pengguna saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadUserData);
```

---

## **Bagian 2: Server-side Programming**

### **2.1 Pengelolaan Data dengan PHP**
- Data dari form dikirim ke server menggunakan metode POST.
- Server memvalidasi data untuk memastikan tidak ada field yang kosong.
- Data yang valid disimpan ke dalam tabel `users` di database.

#### **Kode PHP (process.php)**
```php
<?php
require 'db_config.php';

// Ambil data dari POST
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$hobbies = isset($_POST['hobby']) && is_array($_POST['hobby']) ? implode(', ', $_POST['hobby']) : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';

if (empty($name) || empty($gender) || empty($hobbies) || empty($country)) {
    echo "Harap lengkapi semua data!";
    exit;
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO users (name, gender, hobbies, country) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $gender, $hobbies, $country);

if ($stmt->execute()) {
    echo "Data berhasil disimpan!";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
```

### **2.2 Objek PHP Berbasis OOP**
- Class `UserHandler` dibuat untuk mengelola data pengguna, mencakup:
  1. **Metode `saveUser`**:
     - Menyimpan data pengguna ke database.
  2. **Metode `getAllUsers`**:
     - Mengambil semua data dari tabel `users` dalam bentuk array asosiatif.

#### **Kode Class PHP (UserHandler.php)**
```php
<?php
class UserHandler {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function saveUser($name, $gender, $hobbies, $country) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, gender, hobbies, country) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $gender, $hobbies, $country);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function getAllUsers() {
        $result = $this->conn->query("SELECT * FROM users");

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}
?>
```

---

## **Bagian 3: Database Management**

### **3.1 Pembuatan Tabel Database**
- Tabel `users` dibuat menggunakan SQL berikut:
  ```sql
  CREATE TABLE users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(100) NOT NULL,
      gender VARCHAR(10) NOT NULL,
      hobbies TEXT NOT NULL,
      country VARCHAR(50) NOT NULL,
      browser TEXT NOT NULL,
      ip_address VARCHAR(45) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  ```

### **3.2 Konfigurasi Koneksi Database**
- Koneksi ke database diatur di file `db_config.php`.

#### **Kode Koneksi Database (db_config.php)**
```php
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'uas_pemweb_ra';

// Buat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
```

---

## **Bagian 4: State Management**

### **4.1 State Management dengan Session**
#### **Kode Login (login.php)**
```php
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['username'] =
