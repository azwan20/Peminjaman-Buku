<?php

include 'koneksi.php';

session_start();

if (isset($_SESSION['login'])) {
    header("Location: data_peminjaman.php");
    exit;
}

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION["login"] = true;
        $_SESSION["id"] = $row['id'];
?>
        <script>
            location.reload();
        </script>
<?php
        exit;
    } else {
        $error = true;
    }
}
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
</head>

<body>
    <form action="" method="post">
        <div class="d-flex login">
            <div class="loginCard">
                <h1 style="color: #163E71;">LOGIN ADMIN</h1>
                <span>
                    <input type="text" name="username" placeholder="Username"><br>
                    <input type="password" name="password" placeholder="Password">
                    <section>
                        <a href="login.php" style="color: red; text-decoration:none;">Login sebagai Mahasiswa</a>
                    </section>
                </span>
                <button type="submit" name="submit">LOGIN</button>
                <?php if (isset($error)) { ?>
                    <p style="color: red; text-align: center;">Login gagal. Periksa kembali username dan password.</p>
                <?php } ?>
            </div>
        </div>
    </form>
    <script>

    </script>
</body>

</html>