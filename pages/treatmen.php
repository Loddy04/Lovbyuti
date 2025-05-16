<?php
include 'koneksi.php';
session_start();
$treatments = $connect->query("SELECT * FROM treatmens");
while ($t = $treatments->fetch_assoc()) {
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
    $masalah_kulit = implode(", ", $masalah);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Treatments</title>
    <link rel="stylesheet" href="../style/treatmen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>
    <div class="flex-row">
        <div class="card-2">
            <div class="card-content2">
                <h6 class="card-title"><b><?= $t['nama_treatmen'] ?></b></h6>
                <span class="card-subtitle"><?= $masalah_kulit ?></span>
                <p class="card-description mt-1"><?= $t['deskripsi'] ?></p>
                <div class="card-footer">
                    <span class="duration"><i class="fa-regular fa-clock"></i> <?= $t['durasi_menit'] ?> Menit</span>
                    <span class="price"><b>Rp</b> <?= number_format($t['harga']) ?></span>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>
