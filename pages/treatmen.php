<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
$treatments = $connect->query("SELECT * FROM treatmens"); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Treatments</title>
    <link rel="stylesheet" href="../style/treatmen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
<!-- NAVBAR -->
    <!-- NAVBAR -->
    <div class="navdex">
        <input type="checkbox" id="check">
        <label for="check" class="toggle-btn">
        <a href="javascript:history.back()" class="back-btn">
        <i class="fas fa-arrow-left" id="btn"></i>
        </a>
        </label>
        <div class="navbarpage">
        <div class="nav">
            <span class="brand">LOVBYUTI</span>
        </div>
        </div>
    </div>

    <section class="break py-5"></section>

<!-- DATA TREATMENT -->
    <div class="container-fluid ml-5">
        <div class="row">
            <div class="wrapper">
<?php while ($t = $treatments->fetch_assoc()) {
    $id_treatment = $t['id_treatmen'];
    $complaints = $connect->query("
        SELECT sp.nama_problem 
        FROM solutions s
        JOIN skin_problems sp ON sp.id_problem = s.id_problem
        WHERE s.id_treatmen = '$id_treatment'
    ");

    $masalah = [];
    while ($c = $complaints->fetch_assoc()) {
        $masalah[] = $c['nama_problem'];
    }
    $masalah_kulit = implode(", ", $masalah); ?>
                <div class="card-2" style="background: url(../assets/<?= $t['foto'] ?>) center no-repeat; background-size: 100% auto;">
                    <div class="card-content2">
                        <h6 class="card-title"><b><?= $t['nama_treatmen'] ?></b></h6>
                        <span class="card-subtitle"><?= $masalah_kulit ?></span>
                        <?php if($t['oleh_dermatologis'] == 1): ?>
                            <div class="dermatologist-label">Harus ditangani Dermatologist</div>
                        <?php endif; ?>
                        <p class="card-description mt-1"><?= $t['deskripsi'] ?></p>
                        <div class="card-footer">
                            <span class="duration"><i class="fa-regular fa-clock"></i> <?= $t['durasi_menit'] ?> Menit</span>
                            <span class="price"><b>Rp</b> <?= number_format($t['harga']) ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
