<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$password = $_POST['password'];
$umur = $_POST['umur'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];

// Query langsung tanpa prepared statement
$query = "INSERT INTO users (nama, no_hp, email, password, umur, jenis_kelamin, alamat)
            VALUES ('$nama', '$no_hp', '$email', '$password', '$umur', '$jenis_kelamin', '$alamat')";

if (mysqli_query($connect, $query)) {
    header("Location: index.php?pesan=sudah");
} else {
    echo "Error: " . mysqli_error($connect);
}
?>
