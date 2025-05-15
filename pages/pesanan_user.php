<?php
session_start();
include 'koneksi.php';

$id_user = $_SESSION['id']; 

$query = "SELECT b.*, t.nama_treatmen, o.nama
          FROM bookings b
          LEFT JOIN treatmens t ON b.id_treatmen = t.id_treatmen
          LEFT JOIN outlets o ON b.id_outlet = o.id_outlet
          WHERE b.id_user = '$id_user'
          ORDER BY b.tanggal DESC, b.jam DESC";

$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Your Appoinment</title>
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

    <h3>Bookinng Saya</h3>
    <table border='2' colspan="1">
    <tr>
        <th>No</th>
        <th>Outlet</th>
        <th>Treatment</th>
        <th>Keluhan</th>
        <th>Tanggal</th>
        <th>Jam</th>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?=$no?></td>
        <td><?=$row['nama']?></td>
        <td><?=$row['nama_treatmen']?></td>
        <td><?=$row['keluhan']?></td>
        <td><?=$row['tanggal']?></td>
        <td><?=$row['jam']?></td>
    </tr>
    <?php
    $no++; }
    ?>
    </table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
