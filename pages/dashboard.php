<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Dashboard</title>
    <link rel="stylesheet" href="../styling/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
    <input type="checkbox" id="check">
        <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
        </label>
        <div class="sidebar">
        <header>Lovbyuti
            <span><hr><p></p><?php echo $_SESSION['nama']; ?></span>
        </header>
        <a href="dashboard.php" class="active">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="profil.php">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
        <a href="treatmen.php">
            <i class="fas fa-spa"></i>
            <span>Treatments</span>
        </a>
        <a href="pesanan_user.php">
            <i class="fas fa-calendar"></i>
            <span>Appointment</span>
        </a>
        <a href="#">
            <i class="far fa-question-circle"></i>
            <span>About Us</span>
        </a>
        <a href="#">
            <i class="far fa-envelope"></i>
            <span>Contact Us</span>
        </a>
        <a href="logout.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        </div>
    <!-- </body> -->
    <!-- <div class="frame">
        
    <p> Responsive </p>
    <h2>SIDE BAR</h2>
    <p>in Pure CSS</p>
    </div>   -->

    <!-- TEXT IMAGE 1 -->
    <div class="txtimg1">
        <!-- teks card -->
        <div class="text-overlay">
            <h1>Selamat datang, <?php echo $_SESSION['nama']; ?>!</h1>
            <div class="text1">
                <!-- <p>Login untuk booking perawatan kecantikanmu.</p> -->
                <p>Kami percaya bahwa setiap kulit memiliki keunikan dan potensi untuk bersinar lebih cerah.</p>
                <p>Bersama Lovbyuti, temukan perjalanan perawatan kulit yang personal, aman, dan memanjakan.</p>
            </div>
            <div class="mulai">
                <div><a class="login" href="form.php">Booking sekarang</a></div>
            </div>
        </div>
        <!-- img -->
        <img class="img1" src="../assets/indedximg1.png" alt="">
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>