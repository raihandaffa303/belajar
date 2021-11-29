<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- FONT AWESOME -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="css/datepicker.css">

    <!-- Datepicker JS-->
    <script src="js/datepicker.js"></script>

    <title>EAD TRAVEL</title>
</head>

<!--PHP SECTION-->
<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION["is_login"])) {
    header("location: daffa_login.php");
}
$message = "";
if (isset($_POST["add"])) {
    $nama_tempat = $_POST["nama_tempat"];
    $user_id = $_SESSION["user_id"];
    $lokasi = $_POST["lokasi"];
    $harga = $_POST["harga"];
    $date = $_POST["eventdate"];

    $query = "INSERT INTO bookings VALUES ('', '$user_id', '$nama_tempat', '$lokasi', '$harga', '$date')";
    $result = mysqli_query($conn, $query);
    $message = "Barang berhasil ditambahkan ke keranjang";
}

?>

<!-- NAVBAR -->
<body style="background:#fef8e6;">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info">
            <a class="navbar-brand mb-0 h1" href="index.php">EAD TRAVEL</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="daffa_booking.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text text-light">Selamat Datang, </span>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION["nama"] ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="daffa_logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


<!--ISI CONTENT-->
<div class="container mt-3">
        <?php if ($message) : ?>
                <div class="alert alert-warning" role="alert">
                    <?= $message ?>
                </div>
            </div>
        <?php endif; ?>

    <table class="table">
        <thead class="bg-info text-center">
                <tr>
                    <th colspan="3">
                        <h3>EAD TRAVEL</h3>
                        <p>Booking Travel Masa Kini</p>
                    </th>
                </tr>
            </thead>
            <tbody class="text-dark">
                <tr>
                    <td>
                        <div class="card">
                            <form method="POST">
                                <img class="card-img-top" src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2021/06/15/3957308288.jpeg" height="270px">
                                <div class="card-body">
                                    <h3 class="card-title">Kelingking Beach, Bali</h3>
                                    <p class="card-text">Kelingking Beach merupakan salah satu pantai terindah yang ada di Nusa Penida. Tebing pantai ini mUntuk bisa sampai ke pantainya, Anda harus turun melewati tebing yang berbentuk jari kelingking tersebut. Namun jangan khawatir, di tebing tersebut ada tangga yang bisa Anda gunakan untuk turun sampai ke pantai.</p>
                                    <hr>
                                    Rp169.000
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="nama_tempat" value="Kelingking Beach">
                                    <input type="hidden" name="lokasi" value="Bali">
                                    <input type="hidden" name="harga" value=169000>
                                    <button type="button" data-target="#modalDate" data-toggle="modal" class="btn btn-info btn-block">Tambahkan ke Keranjang</button>
                                </div>
                                <div class="modal fade" id="modalDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Pilih Tanggal Perjalanan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">Event Date
                                                <input type="date" class="form-control" name="eventdate"></input>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="hidden" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="add1" class="btn btn-primary">Tambahkan</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <form method="POST">
                                <img class="card-img-top" src="https://img.okezone.com/content/2020/11/13/408/2309009/pulau-kenawa-surga-tersembunyi-yang-pesonanya-gak-kalah-dari-bunaken-bJ3QBb3Y6x.JPG" height="270px">
                                <div class="card-body">
                                    <h3 class="card-title">Kenawa Island, NTB</h3>
                                    <p class="card-text">Panorama alam yang ada di Nusa Tenggara Barat (NTB) selalu saja memikat wisatawan untuk berkunjung. Tak hanya Lombok, NTB juga memiliki Sumbawa. Bahkan, di bagian Sumbawa Barat terdapat pulau kecil tidak berpenghuni. Pulau tersebut bernama Kenawa. 
                                        Sebagian besar area pulau ini ditumbuhi Ilalang dan rumput hijau. Diapit oleh Pulau Karang, Gili Balu, Pulau Paserang dan Gili Bedil. Pulau seluas 13,8 hektare ini menawarkan keindahan yang luar biasa.</p>
                                    <hr>
                                    Rp180.000
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="nama_tempat" value="Kenawa Island">
                                    <input type="hidden" name="lokasi" value="Nusa Tenggara Barat">
                                    <input type="hidden" name="harga" value=180000>
                                    <button type="button" data-target="#modalDate" data-toggle="modal" class="btn btn-info btn-block">Tambahkan ke Keranjang</button>
                                </div>
                            </form>
                        </div>
                    </td>
                    <td>

                        <div class="card">
                            <form method="POST">
                                <img class="card-img-top" src="https://tripsumba.com/wp-content/uploads/2020/07/Bukit-Tanarara-Sumba.jpg" height="270px">
                                <div class="card-body">
                                    <h3 class="card-title">Bukit Tanarara, NTT</h3>
                                    <p class="card-text">Bukit Tanarara Sumba adalah padang Savana yang terletak di dataran tinggi. Jika musim penghujan rumput dan pepohonan tumbuh dengan subur. Warna hijaunya membuat mata yang memandangnya terasa asri dan rimbun.
                                        Contour tanah perbukitan yang berundak juga menjadi pesona tersendiri. Apalagi di bagian spot-nya terdapat jalur jalan setapak yang berkelok menuju ke puncak bukit.</p>
                                    <hr>
                                    Rp108.000
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="nama_tempat" value="Bukit Tanarara">
                                    <input type="hidden" name="lokasi" value="Nusa Tenggara Timur">
                                    <input type="hidden" name="harga" value=108000>
                                    <button type="button" data-target="#modalDate" data-toggle="modal" class="btn btn-info btn-block">Tambahkan ke Keranjang</button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                </form>
            </tbody>
        </table>
</div>

</body>

        <!--Footer-->
    <footer>
    <div class="footer bg-info">
        <h6 style="text-align: center;" class="m-2">©2021 Copyright: <a type="button" data-bs-toggle="modal" data-bs-target="#mymodal">Daffa_1202190181</a></h6>
      </div>

    <!-- Modal CREATED BY -->
    
        </footer>
        <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Created By</h4>
      </div>
      <div class="modal-body text-align">
        <p>Nama</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
        <style>
    .footer {
      width: 100%;
      height: 48px;
      background: #8db7f4;
      position: bottom;
      bottom: 0px;
      left: 0;
    }
  </style>

</html>