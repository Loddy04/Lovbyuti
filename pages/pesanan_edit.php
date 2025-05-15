<?php
session_start(); 
include 'koneksi.php';

$id = $_GET['id_booking'];
$query = mysqli_query($connect, "SELECT b.*, o.nama as nama_outlet, t.nama_treatmen 
                               FROM bookings b
                               JOIN outlets o ON b.id_outlet = o.id_outlet
                               JOIN treatmens t ON b.id_treatmen = t.id_treatmen
                               WHERE b.id_booking=$id");
$data = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['id'];
    $id_outlet = $_POST['outlet'];
    $id_treatment = $_POST['treatmen'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $keluhan_spesifik = $_POST['keluhan'];
    $reminder = isset($_POST['reminder']) ? implode(', ', $_POST['reminder']) : null;

    // 1. Ubah tanggal ke hari
    $hari = date('l', strtotime($tanggal));
    $mapHari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    $hariIndo = $mapHari[$hari];

    // 2. Cek terapis yang bertugas di cabang itu dan hari itu
    $queryTerapist = mysqli_query($connect, "
        SELECT t.id_therapist 
        FROM therapists t
        JOIN jadwal_therapist jt ON t.id_therapist = jt.id_therapist
        WHERE t.id_outlet = '$id_outlet'
        AND jt.hari = '$hariIndo'
        LIMIT 1
    ");

    $dataTerapist = mysqli_fetch_assoc($queryTerapist);
    $therapist_id = $dataTerapist['id_therapist'] ?? null;

    // 3. Update booking
    if ($therapist_id) {
        $sql = "UPDATE bookings SET 
                id_outlet = '$id_outlet', 
                id_treatmen = '$id_treatment', 
                id_therapist = '$therapist_id', 
                tanggal = '$tanggal', 
                jam = '$jam', 
                keluhan = '$keluhan_spesifik', 
                reminder = '$reminder'
                WHERE id_booking = $id";

        if (mysqli_query($connect, $sql)) {
            echo "<script>
                    alert('Booking berhasil diperbarui');
                    window.location.href = 'pesanan_admin.php';
                  </script>";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($connect);
        }
    } else { 
        echo "<script>
                alert('Mohon maaf semua cabang Klinik Lovbyuti tutup di hari $hariIndo');
                window.location.href = 'pesanan_edit.php?id_booking=$id';
            </script>";
            exit;
    }
}

// Mendapatkan reminder yang sudah dipilih sebelumnya
$reminderArray = $data['reminder'] ? explode(', ', $data['reminder']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Edit Booking</title>
    <link rel="stylesheet" href="../style/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card col-md-7 col-lg-8 ">
            <h4 class="d-flex just justify-content-center mb-3 fs-2">Edit Booking</h4>
            <!-- FORM -->
            <form action="pesanan_edit.php?id_booking=<?= $id ?>" method="POST" class="needs-validation" novalidate="">
                <hr class="mb-3 mt-3">
                <label for="ot" class="form-label">Outlet</label>
                <select id="ot" name="outlet" required="" class="form-control">
                    <?php
                    $cabang = $connect->query("SELECT * FROM outlets");
                    while ($c = $cabang->fetch_assoc()) {
                        $selected = ($c['id_outlet'] == $data['id_outlet']) ? 'selected' : '';
                        echo "<option value='{$c['id_outlet']}' $selected>{$c['nama']}</option>";
                    }
                    ?>
                </select><br>
                <label for="tm" class="form-label">Treatmen</label>
                <select id="tm" name="treatmen" required="" class="form-control">
                    <?php
                    $perawatan = $connect->query("SELECT * FROM treatmens");
                    while ($c = $perawatan->fetch_assoc()) {
                        $selected = ($c['id_treatmen'] == $data['id_treatmen']) ? 'selected' : '';
                        echo "<option value='{$c['id_treatmen']}' $selected>{$c['nama_treatmen']}</option>";
                    }
                    ?>
                </select><br>
                <label for="kl" class="form-label">Keluhan</label><br>
                <textarea name="keluhan" id="kl" class="form-control"><?= $data['keluhan'] ?></textarea><br>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="tgl" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tgl" class="form-control" value="<?= $data['tanggal'] ?>"><br>
                    </div>
                    <div class="col-sm-6">
                        <label for="jm" class="form-label">Jam</label>
                        <select id="jm" name="jam" required="" class="form-control">
                            <?php
                            $jamMulai = strtotime("09:00");
                            $jamSelesai = strtotime("17:00");
                            while ($jamMulai < $jamSelesai) {
                                $jamFormatted = date("H:i", $jamMulai);
                                $selected = ($jamFormatted == $data['jam']) ? 'selected' : '';
                                echo "<option value='$jamFormatted' $selected>$jamFormatted</option>";
                                $jamMulai += 1800;
                            }
                            ?>
                        </select><br>
                    </div>
                </div>
                <label class="form-label">Reminder</label><br>
                <div class="form-check">
                    <?php 
                        $waChecked = in_array('Ingatkan Saya Melalui WA', $reminderArray) ? 'checked' : '';
                        $emailChecked = in_array('Ingatkan Saya Melalui E-mail', $reminderArray) ? 'checked' : '';
                    ?>
                    <input type="checkbox" id="wa" name="reminder[]" class="form-check-input" value="Ingatkan Saya Melalui WA" <?= $waChecked ?>>
                    <label for="wa" class="form-check-label">Ingatkan Saya Melalui WA</label><br>
                    <input type="checkbox" id="em" name="reminder[]" class="form-check-input" value="Ingatkan Saya Melalui E-mail" <?= $emailChecked ?>>
                    <label for="em" class="form-check-label">Ingatkan Saya Melalui E-mail</label><br>
                </div>
                <hr class="mb-3 mt-4">
                <div class="row">
                    <div class="col">
                        <a href="pesanan_admin.php" class="w-100 btn btn-secondary">Kembali</a>
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col">
                        <button class="w-100 btn btn-primary" type="submit">Update Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>