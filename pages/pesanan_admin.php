<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
        <table border="1">
        <tr>
            <td>id booking</td>
            <td>nama</td>
            <td>outlet</td>
            <td>treatment</td>
            <td>therapist</td>
            <td>keluhan</td>
            <td>tanggal</td>
            <td>jam</td>
            <td>reminder</td>
        </tr>

        <?php 
            include "koneksi.php";
            $query = mysqli_query($connect, "SELECT * FROM bookings");
            while ($data = mysqli_fetch_array($query)) {
        ?>

        <tr>
            <td><?= $data['id_booking']?></td>
            <td><?= $data['id_user']?></td>
            <td><?= $data['id_outlet']?></td>
            <td><?= $data['id_treatmen']?></td>
            <td><?= $data['id_therapist']?></td>
            <td><?= $data['keluhan']?></td>
            <td><?= $data['tanggal']?></td>
            <td><?= $data['jam']?></td>
            <td><?= $data['reminder']?></td>
            <td>
                <a href="form_edit.php?id_booking=<?php echo $data['id_booking'];?>">Edit</a>
            </td>
            <td>
                <div class="p-2 border btn btn-danger text-center me-4" id="navreg"><a onclick="return confirm('Apakah anda yakin ingin hapus akun?')" href="pesanan_hapus.php?id_booking=<?= $data['id_booking']; ?>" style="color: black">Hapus Akun</a></div>
            </td>
        </tr>

        <?php
        }
        ?>
    </table>
    <body>
</html>