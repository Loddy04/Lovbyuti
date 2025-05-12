<?php

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
            <td>tanggal</td>
            <td>jam</td>
            <td>preferensi</td>
            <td>keluhan</td>
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
            <td><?= $data['tanggal']?></td>
            <td><?= $data['jam']?></td>
            <td><?= $data['preferensi']?></td>
            <td><?= $data['keluhan']?></td>
            <td><?= $data['reminder']?></td>
            <td>
                <a href="form_edit.php?id_booking=<?php echo $data['id_booking'];?>">Edit</a>
            </td>
        </tr>

        <?php
        }
        ?>
    </table>
    
</html>