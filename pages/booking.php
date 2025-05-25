<?php
session_start();
include 'koneksi.php';

// Konversi tanggal ke hari

    $mapHari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    
    
// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['check_doctors'])) {
        // Mode hanya mengecek dokter yang tersedia
        $selected_outlet = $_POST['outlet'];
        $selected_date = $_POST['tanggal'];
        $selected_treatment = $_POST['treatmen'];
    } else {
        // Mode submit booking
        $id_user = $_SESSION['id'];
        $id_outlet = $_POST['outlet'];
        $id_treatment = $_POST['treatmen'];
        $tanggal = $_POST['tanggal'];
        $jam = $_POST['jam'];
        $keluhan_spesifik = $_POST['keluhan'];
        $reminder = isset($_POST['reminder']) ? implode(', ', $_POST['reminder']) : null;

        $dayName = date('l', strtotime($tanggal));
$hariIndo = $mapHari[$dayName] ?? 'Hari tidak valid';

        // Cek apakah hari Minggu
        if ($hariIndo == 'Minggu') {
            $error = "Mohon maaf, semua cabang klinik tutup pada hari Minggu.";
        } else {
            // Cek apakah treatment membutuhkan dermatologist
            $treatmentReq = $connect->query("SELECT oleh_dermatologis FROM treatmens WHERE id_treatmen = '$id_treatment'");
            $requiresDerm = $treatmentReq->fetch_assoc()['oleh_dermatologist'] ?? 0;

            // Query untuk mencari dokter yang tersedia
            $queryTherapist = "SELECT t.id_therapist 
                             FROM therapists t
                             JOIN jadwal_therapist jt ON t.id_therapist = jt.id_therapist
                             WHERE t.id_outlet = '$id_outlet'
                             AND jt.hari = '$hariIndo'
                             AND (t.is_dermatologist = $requiresDerm OR $requiresDerm = 0)
                             AND NOT EXISTS (
                                 SELECT 1 FROM bookings 
                                 WHERE id_therapist = t.id_therapist
                                 AND tanggal = '$tanggal'
                                 AND jam = '$jam'
                             )
                             LIMIT 1";
            
            $result = $connect->query($queryTherapist);
            
            if ($result->num_rows === 0) {
                $error = "Tidak ada dokter yang tersedia pada waktu tersebut. Silakan pilih waktu lain.";
            } else {
                $therapist = $result->fetch_assoc();
                $id_therapist = $therapist['id_therapist'];
                
                // Simpan booking
                $sql = "INSERT INTO bookings 
                        (id_user, id_outlet, id_treatmen, id_therapist, tanggal, jam, keluhan, reminder) 
                        VALUES 
                        ('$id_user', '$id_outlet', '$id_treatment', '$id_therapist', '$tanggal', '$jam', '$keluhan_spesifik', '$reminder')";
                
                if ($connect->query($sql)) {
                    header("Location: dashboard.php?pesan=berhasil_booking");
                    exit;
                } else {
                    $error = "Terjadi kesalahan: " . $connect->error;
                }
            }
        }
    }
}

// Ambil data untuk form
$outlets = $connect->query("SELECT * FROM outlets");
$treatments = $connect->query("SELECT * FROM treatmens");

// Cek jika form sudah diisi sebagian
$selected_outlet = $_POST['outlet'] ?? '';
$selected_date = $_POST['tanggal'] ?? '';
$selected_time = $_POST['jam'] ?? '';
$selected_treatment = $_POST['treatmen'] ?? '';

// Jika ada tanggal dan outlet yang dipilih, tampilkan jadwal dokter
if (($selected_outlet && $selected_date) || isset($_POST['check_doctors'])) {
    $dayName = date('l', strtotime($selected_date));
$hariIndo = $mapHari[$dayName] ?? 'Hari tidak valid';
    // Debugging - tambahkan ini untuk memeriksa
    error_log("Tanggal: $selected_date, Hari: $dayName, Hari Indo: $hariIndo");
    // Cek apakah hari Minggu
    $isSunday = ($hariIndo == 'Minggu');
    
    if (!$isSunday) {
        // Cek apakah treatment membutuhkan dermatologist
        $treatmentReq = $connect->query("SELECT oleh_dermatologis FROM treatmens WHERE id_treatmen = '$selected_treatment'");
        $requiresDerm = $treatmentReq->fetch_assoc()['oleh_dermatologis'] ?? 0;
        
        // Query dokter yang tersedia
        $doctors = $connect->query("
            SELECT t.*, jt.jam_mulai, jt.jam_selesai 
            FROM therapists t
            JOIN jadwal_therapist jt ON t.id_therapist = jt.id_therapist
            WHERE t.id_outlet = '$selected_outlet' 
            AND jt.hari = '$hariIndo'
            AND (t.is_dermatologist = $requiresDerm OR $requiresDerm = 0)
        ");
        
        // Cek ketersediaan per jam
        $available_times = [];
        $jamMulai = strtotime("09:00");
        $jamSelesai = strtotime("17:00");
        
        while ($jamMulai < $jamSelesai) {
            $jamFormatted = date("H:i", $jamMulai);
            $available_times[$jamFormatted] = false;
            
            // Cek apakah ada dokter yang tersedia di jam ini
            $check = $connect->query("
                SELECT 1 FROM therapists t
                JOIN jadwal_therapist jt ON t.id_therapist = jt.id_therapist
                WHERE t.id_outlet = '$selected_outlet'
                AND jt.hari = '$hariIndo'
                AND (t.is_dermatologist = $requiresDerm OR $requiresDerm = 0)
                AND NOT EXISTS (
                    SELECT 1 FROM bookings 
                    WHERE id_therapist = t.id_therapist
                    AND tanggal = '$selected_date'
                    AND jam = '$jamFormatted'
                )
                LIMIT 1
            ");
            
            if ($check->num_rows > 0) {
                $available_times[$jamFormatted] = true;
            }
            
            $jamMulai += 1800; // 30 menit
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Booking</title>
    <link rel="stylesheet" href="../style/booking.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>
    <div class="wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card col-md-8 col-lg-9">
            <h4 class="d-flex justify-content-center mb-3 fs-2">Booking Online</h4>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            
            <form action="booking.php" method="POST" class="needs-validation" novalidate>
                <hr class="mb-3 mt-3">
                
                <!-- Outlet Selection -->
                <div class="mb-3">
                    <label for="ot" class="form-label">Outlet</label>
                    <select id="ot" name="outlet" required class="form-control">
                        <option value="">Pilih Outlet</option>
                        <?php while ($outlet = $outlets->fetch_assoc()): ?>
                            <option value="<?= $outlet['id_outlet'] ?>" <?= $selected_outlet == $outlet['id_outlet'] ? 'selected' : '' ?>>
                                <?= $outlet['nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <!-- Treatment Selection -->
                <div class="mb-3">
                    <label for="tm" class="form-label">Treatmen</label>
                    <select id="tm" name="treatmen" required class="form-control">
                        <option value="">Pilih Treatmen</option>
                        <?php while ($treatment = $treatments->fetch_assoc()): ?>
                            <option value="<?= $treatment['id_treatmen'] ?>" <?= $selected_treatment == $treatment['id_treatmen'] ? 'selected' : '' ?>>
                                <?= $treatment['nama_treatmen'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <!-- Date Selection -->
                <div class="mb-3">
                    <label for="tgl" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tgl" class="form-control" 
                           min="<?= date('Y-m-d') ?>" value="<?= $selected_date ?>" required>
                </div>
                
                <!-- Button untuk cek dokter -->
                <div class="mb-3">
                    <button type="submit" name="check_doctors" class="btn btn-info w-100">Lihat Dokter yang Tersedia</button>
                </div>
                
                <!-- Show Doctor Schedule if outlet and date selected -->
                <?php if (($selected_outlet && $selected_date) || isset($_POST['check_doctors'])): ?>
                    <?php if (isset($isSunday) && $isSunday): ?>
                        <div class="alert alert-warning">
                            Mohon maaf, semua cabang klinik tutup pada hari Minggu. Silakan pilih tanggal lain.
                        </div>
                    <?php elseif ($doctors->num_rows > 0): ?>
                        <div class="schedule-container">
                            <h5>Dokter yang Tersedia pada <?= date('d F Y', strtotime($selected_date)) ?> (<?= $hariIndo ?>):</h5>
                            
                            <?php while ($doctor = $doctors->fetch_assoc()): ?>
                                <div class="doctor-card">
                                    <div class="d-flex align-items-center">
                                        <!-- <?php if (!empty($doctor['foto'])): ?>
                                            <img src="<?= $doctor['foto'] ?>" class="doctor-photo" alt="Foto Dokter">
                                        <?php else: ?> -->
                                            <div class="doctor-photo d-flex align-items-center justify-content-center bg-light">
                                                <span style="font-size: 20px;">
                                                    <?= $doctor['jenis_kelamin'] === 'pria' ? '♂' : '♀' ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div>
                                            <h6><?= $doctor['nama'] ?> 
                                                <span class="badge <?= $doctor['is_dermatologist'] ? 'badge-dermatologist' : 'badge-therapist' ?>">
                                                    <?= $doctor['is_dermatologist'] ? 'Dermatologist' : 'Therapist' ?>
                                                </span>
                                            </h6>
                                            <!-- <p class="text-muted mb-1"><small><?= $doctor['spesialisasi'] ?></small></p> -->
                                            <p class="text-muted mb-0">
                                                <small>
                                                    Jam Praktik: 
                                                    <?= date('H:i', strtotime($doctor['jam_mulai'])) ?> - 
                                                    <?= date('H:i', strtotime($doctor['jam_selesai'])) ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            
                            <div class="alert alert-info">
                                <strong>Perhatian:</strong> Dokter akan ditentukan oleh sistem berdasarkan ketersediaan dan kebutuhan treatment.
                                <?php if ($requiresDerm): ?>
                                    <br><strong>Treatment ini harus ditangani oleh Dermatologist.</strong>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Time Selection -->
                            <div class="mb-3">
                                <label for="jm" class="form-label">Jam</label>
                                <select id="jm" name="jam" required class="form-control">
                                    <option value="">Pilih Jam</option>
                                    <?php foreach ($available_times as $time => $available): ?>
                                        <option value="<?= $time ?>" 
                                            <?= $selected_time == $time ? 'selected' : '' ?>
                                            <?= !$available ? 'disabled class="unavailable"' : 'class="available"' ?>>
                                            <?= $time ?>
                                            <?= !$available ? ' (Penuh)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Complaint -->
                            <div class="mb-3">
                                <label for="kl" class="form-label">Keluhan</label>
                                <textarea name="keluhan" id="kl" class="form-control"><?= $_POST['keluhan'] ?? '' ?></textarea>
                            </div>
                            
                            <!-- Reminder Options -->
                            <div class="mb-3">
                                <label class="form-label">Reminder</label>
                                <div class="form-check">
                                    <input type="checkbox" id="wa" name="reminder[]" class="form-check-input" value="Ingatkan Saya Melalui WA"
                                        <?= isset($_POST['reminder']) && in_array('Ingatkan Saya Melalui WA', $_POST['reminder']) ? 'checked' : '' ?>>
                                    <label for="wa" class="form-check-label">Ingatkan Saya Melalui WA</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="em" name="reminder[]" class="form-check-input" value="Ingatkan Saya Melalui E-mail"
                                        <?= isset($_POST['reminder']) && in_array('Ingatkan Saya Melalui E-mail', $_POST['reminder']) ? 'checked' : '' ?>>
                                    <label for="em" class="form-check-label">Ingatkan Saya Melalui E-mail</label>
                                </div>
                            </div>
                            
                            <hr class="mb-3 mt-4">
                            <div class="row">
                                <div class="col">
                                    <button class="w-100 btn btn-secondary" type="reset">Reset</button>
                                </div>
                                <div class="col">
                                    <button class="w-100 btn btn-primary" type="submit" name="submit_booking">Booking Sekarang</button>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <?php if ($requiresDerm): ?>
                                Tidak ada Dermatologist yang tersedia di outlet ini pada hari <?= $hariIndo ?>.
                            <?php else: ?>
                                Tidak ada Therapist yang tersedia di outlet ini pada hari <?= $hariIndo ?>.
                            <?php endif; ?>
                            Silakan pilih tanggal lain atau outlet lain.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>