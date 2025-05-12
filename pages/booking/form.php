<?php
session_start(); 
include '../koneksi.php';

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

    // 3. Simpan booking
    if ($therapist_id) {
        $sql = "INSERT INTO bookings 
            (id_user, id_outlet, id_treatmen, id_therapist, tanggal, jam, keluhan, reminder) 
            VALUES 
            ('$id_user', '$id_outlet', '$id_treatment', '$therapist_id', '$tanggal', '$jam', '$keluhan_spesifik', '$reminder')";

        if (mysqli_query($connect, $sql)) {
            echo "Booking berhasil disimpan. <a href='../dashboard.php'>kembali ke dashboard</a>";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($connect);
        }
    } else {
        echo "Tidak ada therapist yang bertugas di hari $hariIndo di outlet tersebut.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Booking</title>
</head>
<body>
    <!-- form untuk booking -->
    <h2>Booking Online</h2>
    <form action="form.php" method="POST">
        <label for="ot">Outlet</label>
        <select id="ot" name="outlet" required="">
            <option value="">Pilih Outlet</option>
            <?php
            $cabang = $connect->query("SELECT * FROM outlets");
            while ($c = $cabang->fetch_assoc()) {
                echo "<option value='{$c['id_outlet']}'>{$c['nama']}</option>";
            }
            ?>
        </select><br>
        <label for="tm">Treatmen</label>
        <select id="tm" name="treatmen" required="">
            <option value="">Pilih Treatmen</option>
            <?php
            $perawatan = $connect->query("SELECT * FROM treatmens");
            while ($c = $perawatan->fetch_assoc()) {
                echo "<option value='{$c['id_treatmen']}'>{$c['nama_treatmen']}</option>";
            }
            ?>
        </select><br>
        <label for="kl">Keluhan</label><br>
        <textarea name="keluhan" id="kl"></textarea><br>
        <label for="tgl">Tanggal</label>
        <input type="date" name="tanggal" id="tgl"><br>
        <label for="jm">Jam</label>
        <select id="jm" name="jam" required="">
            <option value="">Pilih Jam</option>
            <?php
            $jamMulai = strtotime("09:00");
            $jamSelesai = strtotime("17:00");
            while ($jamMulai < $jamSelesai) {
                $jamFormatted = date("H:i", $jamMulai);
                echo "<option value='$jamFormatted'>$jamFormatted</option>";
                $jamMulai += 1800;
            }
            ?>
        </select><br>
        <label for="">Reminder</label><br>
        <input type="checkbox" id="wa" name="reminder[]" value="Ingatkan Saya Melalui WA">
        <label for="wa">Ingatkan Saya Melalui WA</label><br>
        <input type="checkbox" id="em" name="reminder[]" value="Ingatkan Saya Melalui E-mail">
        <label for="em">Ingatkan Saya Melalui E-mail</label><br>
        <button type="submit">Booking now</button>
    </form>
</body>
</html>