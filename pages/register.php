<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
    exit;
} else if (isset($_SESSION['id']) == '999') {
    header("Location: dashboard_admin.php");
    exit;
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO users (nama, no_hp, email, password, umur, jenis_kelamin, alamat)
                VALUES ('$nama', '$no_hp', '$email', '$password', '$umur', '$jenis_kelamin', '$alamat')";

    if (mysqli_query($connect, $query)) {
        header("Location: index.php?pesan=sudah");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="../style/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
        <div class="wrapper d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card col-md-7 col-lg-8 ">
            <h4 class="d-flex just justify-content-center mb-3">Pendaftaran Akun</h4>
            <!-- FORM -->
                <form action="register.php" method="POST">
                    <div class="row g-3 ">
                    <!-- USERNAME -->
                    <div class="col-sm-12">
                        <label for="user" class="form-label">Username</label>
                        <input type="text" name="nama" class="form-control" id="firstName" placeholder="" value="" required="">
                    </div>
                    <!-- NO TELP -->
                    <div class="col-12">
                        <label for="nh" class="form-label">No. Telepon</label>
                        <input type="tel" name="no_hp" class="form-control" id="address" placeholder="" required="">
                    </div>
                    <!-- EMAIL -->
                    <div class="col-12">
                        <label for="mail" class="form-label">Email <span class="text-body-secondary"></span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                    </div>
                    <!-- PASSWORD -->
                    <div class="col-12">
                    <label for="pw" class="form-label">Paswword <span class="text-body-secondary"></span></label>
                        <input type="password" name="password" class="form-control" id="pw" placeholder="">
                    </div>
                    <!-- UMUR -->
                <div class="col-md-6">
                    <label for="ur" class="form-label">Umur</label><br>   
                    <input class="form-control" type="number" name="umur" id="ur"><br>
                </div>
                <!-- GENDER -->
                <div class="my-0">
                    <label for="" class="form-label">Gender <span class="text-body-secondary"></span></label>
                    <div class="my-1">
                        <div class="form-check">
                            <input id="pa" name="jenis_kelamin" type="radio" class="form-check-input" required="" value="Laki-Laki">
                            <label class="form-check-label" for="pa">Laki-Laki</label>
                        </div>
                        <div class="form-check mb-3">
                            <input id="pu" name="jenis_kelamin" type="radio" class="form-check-input" required="" value="Perempuan">
                            <label class="form-check-label" for="pu">Perempuan</label>
                        </div>
                </div>
            <!-- ALAMAT -->
                <div class="">
                    <label class="mb-1" for="al" class="">Alamat</label><br>
                    <textarea class="form-control" id="al" placeholder="" required="" name="alamat"></textarea><br>
                </div>
                <div class="d-flex justify-content-end">
                <button class="w-45 btn btn-primary btn-lg tombol" type="submit">Daftar Akun</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>