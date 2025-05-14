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
        <!-- <form action="">
            <label for="pilih outlet" class="form-label">Pilih Outlet</label>
            <select class="form-select" id="weapon" name="outlet">
                <option value="" selected disabled>Pilih Outlet</option>
                <option value="yk">Klinik LovByuti Yogyakarta</option>
                <option value="sl">Klinik LovByuti Sleman</option>
                <option value="bt">Klinik LovByuti Bantul</option>
                <option value="gk">Klinik LovByuti Gunungkidul</option>
                <option value="kp">Klinik LovByuti Kulon Progo</option>
            </select>
        </form>
        <br> -->
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
            $query = mysqli_query($connect, "SELECT 
                                    b.id_booking,
                                    u.nama AS nama_user,
                                    o.nama AS outlet,
                                    t.nama_treatmen,
                                    th.nama AS nama_therapist,
                                    b.keluhan,
                                    b.tanggal,
                                    b.jam,
                                    b.reminder
                                FROM 
                                    bookings AS b
                                JOIN 
                                    users AS u ON b.id_user = u.id_user
                                JOIN 
                                    outlets AS o ON b.id_outlet = o.id_outlet
                                JOIN 
                                    treatmens AS t ON b.id_treatmen = t.id_treatmen
                                JOIN 
                                    therapists AS th ON b.id_therapist = th.id_therapist");
                                            while ($data = mysqli_fetch_array($query)) {
        ?>

        <tr>
            <td><?= $data['id_booking']?></td>
            <td><?= $data['nama_user']?></td>
            <td><?= $data['outlet']?></td>
            <td><?= $data['nama_treatmen']?></td>
            <td><?= $data['nama_therapist']?></td>
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