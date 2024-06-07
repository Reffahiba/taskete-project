<?php
    // Include koneksi ke database
    include 'connection/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $nama_lengkap = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_pass = $_POST["confirm_password"];

        if($password != $confirm_pass){
            echo "
            <script>
              alert('Password dengan confirm password tidak sama');
              document.location.href = 'register.php';
            </script>
          ";
          
          return false;
        }

        $res_double = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

        if(mysqli_fetch_assoc($res_double)){
            echo "
            <script>
              alert('Username Sudah Terdaftar');
              document.location.href = 'register.php';
            </script>
          ";
            return false;          
        }

        $fileName = $_FILES["foto_user"]["name"];
        $fileSize = $_FILES["foto_user"]["size"];
        $tmpName =  $_FILES["foto_user"]["tmp_name"];
    
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        if(!in_array($imageExtension, $validImageExtension)){
          echo "
            <script>
            alert('Gambar harus jpg, jpeg, png');
            document.location.href = 'register.php';
          </script>
          ";
    
          return false;
        }
    
        if($fileSize > 5000000){
          echo "
          <script>
            alert('Gambar tidak boleh lebih dari 5MB');
            document.location.href = 'register.php';
          </script>
        ";
    
        return false;
        }
    
        $newImageName = uniqid();
        $newImageName .= ".".$imageExtension;
    
        move_uploaded_file($tmpName, "gambar_user/".$newImageName );
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Enkripsi password

        // Query untuk memasukkan data ke dalam database
        $query = "INSERT INTO users VALUES (NULL, '$newImageName', '$email', '$username', '$nama_lengkap', '$hashed_password')";

        mysqli_query($conn, $query);
        // Eksekusi query dan cek apakah berhasil
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Akun berhasil dibuat.');
            document.location.href = 'login.php';
            </script>";
            return;
        } else {
            echo "<script>alert('Gagal membuat akun.');</script>";
        }

        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <hr>
        <form  method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon:</label>
                <input type="tel" id="no_telepon" name="no_telepon" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="foto_user" class="form-label">Foto Anda</label>
                <input type="file" id="foto_user" name="foto_user" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
