<?php
session_start();
include 'koneksi.php';

$id_user = $_SESSION['id']; 

$query = "SELECT b.*, t.nama_treatmen, o.nama, th.nama AS nama_therapist
          FROM bookings b
          JOIN therapists th ON b.id_therapist = th.id_therapist
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
    <link rel="stylesheet" href="../style/pesanan_user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
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

    <!-- RIWAYAT BOOKING USER-->
    <div class="container-fluid">
        <div class="card shadow m-auto p-auto">
            <div class="card-body judul">
                <div class="row">
                    <div class="col"></div>
                        <div class="col">
                            <pre style="color: floralwhite; font-size: 2rem;"><center><b>MY APPOINTMENT</b></center></pre>
                        </div>
                    <div class="col"></div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Outlet</th>
                        <th>Treatment</th>
                        <th>Therapist</th>
                        <th>Keluhan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </thead>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tbody>
                        <td><?=$no?></td>
                        <td><?=$row['nama']?></td>
                        <td><?=$row['nama_treatmen']?></td>
                        <td><?=$row['nama_therapist']?></td>
                        <td><?=$row['keluhan']?></td>
                        <td><?=$row['tanggal']?></td>
                        <td><?=$row['jam']?></td>
                        <td>
        <?php
        // Calculate if the appointment is within 1 day
        $appointmentDate = new DateTime($row['tanggal']);
        $today = new DateTime();
        $interval = $today->diff($appointmentDate);
        $daysDifference = $interval->days;
        $isUpcoming = ($appointmentDate > $today);
        $canChange = ($daysDifference > 1 && $isUpcoming);
        ?>
        
        <button class="change-schedule-btn" 
                <?= $canChange ? '' : 'disabled' ?>
                onclick="showContactAdmin('<?= $row['id_booking'] ?>')">
            Ubah Jadwal
        </button>
        
        <?php if(!$canChange && $isUpcoming): ?>
            <div class="schedule-warning">
                *Harap hubungi admin minimal H-1 sebelum jadwal
            </div>
        <?php elseif(!$isUpcoming): ?>
            <div class="schedule-warning">
                *Appointment sudah lewat
            </div>
        <?php endif; ?>
    </td>
                    </tbody>
                    <?php
                    $no++; }
                    ?>

                </table>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col"></div>
                    <div class="col">
                    </div>
                <div class="col"></div>
            </div>

        </div>
    </div>

<script>
    function showContactAdmin(bookingId) {
        // Replace with your actual admin contact method
        const whatsappNumber = "6281234567890"; // Example WhatsApp number
        const message = `Halo admin LovByuti, saya ingin mengubah jadwal booking ID: ${bookingId}. Mohon bantuannya.`;
        
        // Open WhatsApp chat
        window.open(`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`, '_blank');
        
        // Alternative: Show contact info in alert
        // alert("Silakan hubungi admin via WhatsApp: 081234567890\nAtau email: admin@lovbyuti.com");
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
