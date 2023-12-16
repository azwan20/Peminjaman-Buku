<?php

include 'koneksi.php';

// session_start();

if (isset($_SESSION['login'])) {
    header("Location: data_peminjaman.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fName = $_POST['nim'];
    $lName = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql6 = "insert into registrasi  (nim, nama, username, password) VALUES ('$fName', '$lName', '$username', '$password')";
    if (mysqli_query($conn, $sql6)) {
        echo "<script>window.location.href='login.php'</script>";
    } else {
        echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">

    <!-- bostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <style>
        .loginCard span{
            margin: 30px auto 50px;
        }
        .loginCard input{
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <div class="d-flex login">
            <div class="loginCard">
                <h1>REGISTRASI</h1>
                <span>
                    <input type="text" name="nim" placeholder="NIM"><br>
                    <input type="text" name="nama" placeholder="Nama"><br>
                    <input type="text" name="username" placeholder="Username"><br>
                    <input type="password" name="password" placeholder="Password">
                    <p>Sudah punya akun?<a href="login.php">Klik disini</a></p>
                </span>
                <button type="submit" name="submit" onclick="">REGISTRASI</button>
            </div>
        </div>
    </form>
    <script>

    </script>
</body>

</html>