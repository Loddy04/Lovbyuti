<?php
    include 'koneksi.php';
    $id = $_GET['id_booking'];
    $sql = mysqli_query($connect,"DELETE FROM bookings WHERE id_booking = '$id'");
    header("location: pesanan_admin.php");
?>