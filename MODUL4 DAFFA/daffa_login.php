<!DOCTYPE html>
<html lang="en">

    <!--php section-->
<?php
session_start();
include("db_connect.php");

if(isset($_SESSION["is_login"])) {
    header("location: daffa_index.php");
}

if(isset($_COOKIE["username"])) {
    header("location: daffa_index.php");
}

$message = "";
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $sandi = $_POST["pass"];
    if(isset($_POST["remember_me"])) {
        $remember_me = TRUE;
    }else{
        $remember_me = FALSE;
    }
    
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows == 0) {
        $message = "Gagal login: user tidak ditemukan!";
    } else {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($sandi, $user["password"])) {
            if($remember_me){
                setcookie("email", $user["email"], strtotime('+1 days'), '/');
            }
            setcookie("navbar", "default", strtotime('+1 days'), '/');
            $_SESSION["is_login"] = TRUE;
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["nama"] = $user["nama"];
            header("location: daffa_index.php");
        }else{
            $message = "Email atau kata sandi salah!";
        }
    }
}
?>

<?php
    if (isset($_GET['alert'])) {
    ?>
        <div class="alert alert-warning" role="alert"> Berhasil Logout! </div>

    <?php } ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!--navbar-->
    <body style="background:#fef8e6">
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
    <a class="navbar-brand mb-0 h1" href="">EAD Travel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav">
            <a class="nav-link active" href="daffa_login.php">Login<span class="sr-only">(current)</span></a>
                <a class="nav-link" href="daffa_registrasi.php">Register</a>
                </li>
            </ul>
        </div>
    </nav>



    <!--konten login-->
    <?php if ($message) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            </div>
        <?php endif; ?>
    <div class="container mt-3 d-flex justify-content-center">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mt-4 text-center">Login</h1><br>
                            <hr style="height:1px; background-color:black">
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required size="43px">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kata Sandi</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required size="43px">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="login">Login</button> <br><br>
                                <p>belum punya akun?<a href="daffa_registrasi.php">Registrasi</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="footer bg-info">
        <h6 style="text-align: center;" class="m-2">©2021 Copyright: <a href="#" class="logo">Daffa_1202190181</a></h6>
      </div>
</body>
<style>
    .footer {
      width: 100%;
      height: 48px;
      background: #8db7f4;
      position: absolute;
      bottom: 0px;
      left: 0;
    }
  </style>

</html>
