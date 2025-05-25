<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/pesanan_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<!-- NAVBAR -->
    <div class="navdex">
        <div class="navbarpage">
            <header class="d-flex">
                <span class="brand">LOVBYUTI</span>
                <ul class="nav">
                    <li class="nav-item"><a class="listnav" href="dashboard_admin.php">Home</a></li>
                    <li class="nav-item"><a class="listnav" href="#treatmen">Treatmen</a></li>
                    <li class="nav-item"><a class="listnav" href="#outlet">Outlet</a></li>
                    <li class="nav-item"><a class="listnav" href="#about_us">About Us</a></li>
                </ul>
            </header>
        </div>
    </div>

    
<!-- RIWAYAT BOOKING USER-->
    <div class="container-fluid">
        <div class="card shadow m-auto p-auto">
            <div class="card-body judul">
                <div class="row">
                    <div class="col"></div>
                        <div class="col">
                            <pre style="color: floralwhite; font-size: 2rem;"><b>PESANAN USER</b></pre>
                        </div>
                    <div class="col"></div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Outlet</th>
                            <th>Treatment</th>
                            <th>Therapist</th>
                            <th>Keluhan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Reminder</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    
                    $no = 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>  
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['nama_user']?></td>
                            <td><?= $data['outlet']?></td>
                            <td><?= $data['nama_treatmen']?></td>
                            <td><?= $data['nama_therapist']?></td>
                            <td><?= $data['keluhan']?></td>
                            <td><?= $data['tanggal']?></td>
                            <td><?= $data['jam']?></td>
                            <td><?= $data['reminder']?></td>
                            <td>
                                <a href="pesanan_edit.php?id_booking=<?php echo $data['id_booking'];?>"><button class="btn btn-info">Edit</button></a>
                                |
                                <a onclick="return confirm('Apakah anda yakin ingin hapus akun?')" href="pesanan_hapus.php?id_booking=<?= $data['id_booking']; ?>"><button class="btn btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col"></div>
                    <div class="col">
                    </div>
                <div class="col"></div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>