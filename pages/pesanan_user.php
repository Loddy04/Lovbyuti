<?php
session_start(); // Tambahkan ini untuk akses $_SESSION
include '../koneksi.php';

// Ambil ID user dari session login
$id_user = $_SESSION['id']; // Asumsikan 'id' adalah id_user yang disimpan saat login

$outlet = $_POST['outlet'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$preferensi = $_POST['preferensi'];
$keluhan = $_POST['keluhan'];
$reminder = isset($_POST['reminder']) ? implode(', ', $_POST['reminder']) : null;

// Query INSERT dengan menyertakan id_user
$query = "INSERT INTO bookings (id_user, id_outlet, tanggal, jam, preferensi, keluhan, reminder)
            VALUES ('$id_user', '$outlet', '$tanggal', '$jam', '$preferensi', '$keluhan', '$reminder')";

if (mysqli_query($connect, $query)) {
    echo "Booking berhasil disimpan. <a href='../dashboard.php'>kembali ke dashboard</a>";
} else {
    echo "Error: " . mysqli_error($connect);
}
?>
