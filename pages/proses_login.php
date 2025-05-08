<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Ambil data user berdasarkan email
$query = "SELECT * FROM users WHERE email= '$email' AND password='$password'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php?pesan=gagal");
}
?>
