<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Dashboard</title>
    <link rel="stylesheet" href="../style/dashboard_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<!-- NAVBAR -->
    <div class="navdex">
        <div class="navbarpage">
            <header class="d-flex">
                <span class="brand">LOVBYUTI</span>
                <ul class="nav">
                    <li class="nav-item"><a class="listnav" href="#home">Home</a></li>
                    <li class="nav-item"><a class="listnav" href="#treatmen">Treatmen</a></li>
                    <li class="nav-item"><a class="listnav" href="#outlet">Outlet</a></li>
                    <li class="nav-item"><a class="listnav" href="#about_us">About Us</a></li>
                </ul>
            </header>
        </div>
    </div>

    <!-- TEXT IMAGE 1 -->
    <div class="txtimg1" id="home">
        <!-- teks card -->
        <div class="text-overlay">
            <h1>SELAMAT DATANG, <?=$_SESSION['nama']?></h1>
            <br><br>
            <div class="mulai">
                <div style="margin-right: 2rem;"><a class="login" href="pesanan_admin.php">Pesanan</a></div>
                <div><a class="regis" href="logout.php">LogOut</a></div>
            </div>
        </div>
        <!-- img -->
        <img class="img1" src="../assets/indedximg1.png" alt="">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>