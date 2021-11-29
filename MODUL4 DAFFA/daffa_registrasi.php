<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi WAD Travel</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./assets/style.css">
</head>


<!-- NAVBAR -->
<body style="background:#fef8e6;">
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
    <a class="navbar-brand mb-0 h1" href="daffa_login.php">WAD Travel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav">
            <a class="nav-link" href="daffa_login.php">Login</a>
                <a class="nav-link active" href="">Register<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

<!-- PHP SECTION -->
<?php
session_start();
include("db_connect.php");

if (isset($_SESSION["is_login"])) {
    header("location: daffa_index.php");
}

$message = "";
if (isset($_POST["register"])) {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $nohp = $_POST["phone"];
    $sandi = $_POST["pass"];
    $confirmsandi = $_POST["confirmsandi"];

    if ($sandi == $confirmsandi) {
        $sandi = password_hash($_POST["pass"], PASSWORD_DEFAULT);
        $confirmsandi = password_hash($_POST["confirmsandi"], PASSWORD_DEFAULT);
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (!$result->num_rows) {
            $query = "INSERT INTO user VALUES (NULL, '$nama', '$email', '$sandi', '$nohp')";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $message = "Registrasi berhasil";
            } else {
                $message = "Registrasi gagal";
            }
        } else {
            $message = "Registrasi gagal: email sudah pernah didaftarkan!";
        }
    } else {
        $message = "Kata sandi dan konfirmasi kata sandi tidak sesuai!";
    }
}

?>
    <?php if ($message) : ?>
            <?php if (strpos($message, "berhasil")) : ?>
                    <div class="alert alert-warning" role="alert">
                        <?= $message ?> Silakan <a class="alert-link" href="daffa_login.php"><strong>Login</strong></a>
                    </div>
                </div>
            <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $message ?>
                    </div>
                </div>
            <?php endif ?>
        <?php endif; ?>

        <!--CONTENT REGISTER-->
        <div class="container mt-3 d-flex justify-content-center">
        <form  method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mt-4 text-center">Register</h1><br>
                            <hr style="height:1px; background-style:#fef8e6;">
                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" placeholder="Masukkan Nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" required size="43px">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" placeholder="Masukkan Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required size="43px">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Handphone</label>
                                <input type="text" placeholder="Masukkan No. Handphone "class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" required size="43px">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kata Sandi</label>
                                <input type="password" placeholder="Masukkan Kata Sandi" class="form-control" id="exampleInputPassword1" name="pass" required size="43px">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Konfirmasi Kata Sandi</label>
                                <input type="password" placeholder="Konfirmasi Kata Sandi"class="form-control" id="exampleInputPassword1" name="confirmsandi" required size="43px">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="register" >Daftar</button> <br><br>
                                <p>Sudah punya akun?<a href="daffa_login.php">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>