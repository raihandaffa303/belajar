<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAD TRAVEL</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- FONT AWESOME -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<!--PHP SECTION--> 
<?php
session_start();
include("db_connect.php");

$message = "";
if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    mysqli_query($conn, "DELETE FROM bookings WHERE id=$id");
    $message = "Barang berhasil dibuang dari keranjang";
}

$daftar_tempat = mysqli_query($conn, "SELECT * FROM bookings WHERE user_id=$user_id");

?>

<!-- NAVBAR -->
<body style="background:#fef8e6;">
        <nav class="navbar navbar-expand-sm navbar-dark bg-info">
            <a class="navbar-brand mb-0 h1" href="daffa_index.php">EAD TRAVEL</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="bookings.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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

<!--CONTENT-->
        <div class="container mt-4">
        <?php if ($message) : ?>
            <div class="row justify-content-center">
                <div class="alert alert-warning w-100" role="alert">
                    <?= $message ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Tempat</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Tanggal Perjalanan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0; ?>
                        <?php while ($barang = mysqli_fetch_assoc($daftar_tempat)) : ?>
                            <?php $total += $barang["harga"]; ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $barang["nama_tempat"]; ?></td>
                                <td>Rp<?= number_format($barang["harga"]); ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $barang["id"] ?>">
                                        <button type=" submit" name="delete" class="btn btn-danger" onclick="return confirm('Apa kamu yakin?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="2" class="font-weight-bold">Total</td>
                            <td colspan="4" class="font-weight-bold">Rp<?= number_format($total); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
