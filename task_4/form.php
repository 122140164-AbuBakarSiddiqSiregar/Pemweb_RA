<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9f2fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            border-left: 8px solid #3b82f6;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #3b82f6;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input, form button {
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        form input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.4);
        }

        form button {
            background-color: #3b82f6;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #1d4ed8;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
    <script>
        function validateForm() {
            const name = document.forms["registerForm"]["name"].value;
            const email = document.forms["registerForm"]["email"].value;
            const password = document.forms["registerForm"]["password"].value;
            const phone = document.forms["registerForm"]["phone"].value;
            const file = document.forms["registerForm"]["file"].files[0];

            if (!name || name.length < 3) {
                alert("Nama harus diisi minimal 3 karakter");
                return false;
            }

            if (!email || !email.includes("@")) {
                alert("Email tidak valid");
                return false;
            }

            if (!password || password.length < 6) {
                alert("Password harus minimal 6 karakter");
                return false;
            }

            if (!phone || isNaN(phone)) {
                alert("Nomor telepon harus angka");
                return false;
            }

            if (!file) {
                alert("File harus diupload");
                return false;
            }

            const allowedExtensions = ["txt"];
            const fileExtension = file.name.split(".").pop().toLowerCase();
            const maxFileSize = 1024 * 1024; // 1MB

            if (!allowedExtensions.includes(fileExtension)) {
                alert("Hanya file .txt yang diizinkan");
                return false;
            }

            if (file.size > maxFileSize) {
                alert("Ukuran file maksimal 1MB");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Form Pendaftaran</h2>
        <form name="registerForm" action="process.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="phone">Nomor Telepon:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="file">Upload File (.txt):</label>
            <input type="file" name="file" id="file" accept=".txt" required>

            <button type="submit">Submit</button>
        </form>
        <div class="footer">
            &copy; 2024 Pendaftaran | Desain Modern
        </div>
    </div>
</body>
</html>
