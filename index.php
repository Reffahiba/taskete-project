<?php
    session_start();

include "config/controller.php";


$id_user = $_SESSION["id_user"];

if(!isset($id_user)){
    header("Location: login.php");
    exit;
}
$user_info = mysqli_query( $conn, "SELECT * FROM users WHERE id_user = '$id_user'"); 

$result = mysqli_fetch_assoc($user_info);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Taskete Homepage</title>
    <script src="https://kit.fontawesome.com/d931a8b882.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.css" rel="stylesheet">
    <style>
        .fa-user{
            font-size: 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <nav class="navbar bg-body-tertiary navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
        <img src="taskete-logo.png" alt="Logo" width="100%" height="50" class="d-inline-block align-text-top">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        </li>
    </ul>
    
    <span class="nav-item dropdown">
      <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-user"> </i><?= $result["nama_user"]?> 
        </a>
      <ul class="dropdown-menu ">
        <li class="dropdown-item">Foto Profile : </li>
        <li><img class="dropdown-item" src="gambar_user/<?= $result["foto_user"];?>" alt="user profile" width="50%" height="50%"></li>
        <br><br>
        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
      </ul>
    </span>
        
    </div>
        
    </div>
    </nav>


    <div class="container mt-5">


        <table class="table table-hover table-warning" id="table">
            <thead>
                <tr>
                    <th>blabla</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>blba</td>
                </tr>
            </tbody>
        </table>
        
    </div>


    
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script>

<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/sc-2.4.2/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    let table = new DataTable('#table', {

    }   
    );
</script>
</body>
</html>