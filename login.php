<?php
    // Include koneksi ke database
    session_start();

    include 'connection/connection.php';
    
    if(isset($_SESSION["id_user"])){
        header("Location: index.php");
        exit;
    }
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        // Eksekusi query dan cek apakah berhasil
        if (mysqli_num_rows($result) == 1) {
            $res_user = mysqli_fetch_assoc($result);
            if(password_verify($password, $res_user["password_user"] )){
                $_SESSION["id_user"] = $res_user['id_user'];
                header('Location: index.php');
            }
        } else {
            echo "<script>alert('User atau Password salah');</script>";
        }

        // mysqli_close($conn);
    }


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">

</head>
<body>
    <div class="container ">

            <h1>Login</h1>
            <hr>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button><br><br>
                <a href="register.php" class="mt-3">Sign Up</a>
            </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
