<?php
    session_start();
    include 'koneksi.php';

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
        $data = mysqli_query($connect, $query);


        if (mysqli_num_rows($data) > 0) {
            $user = mysqli_fetch_array($data);
            $_SESSION['user'] = $data;
            $_SESSION['id'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            
            if ($user['email'] == 'admin123@gmail.com' && $user['password'] == 'admin123') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard.php");
            
        }
        exit;
        } else {
            header("Location: login.php?pesan=gagal");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Login</title>
    <link rel="stylesheet" href="../styling/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

    <div class="wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card col-md-7 col-lg-8 ">
            <h4 class="d-flex just justify-content-center mb-3 fs-2">Login Account</h4>
            <!-- FORM -->
            <form action="login.php" method="POST" class="needs-validation" novalidate="">
                <hr class="mb-3 mt-3">
                <!-- EMAIL  -->
                <div class="col-12 mb-3">
                    <label for="mail" class="form-label">Email </label>
                    <input type="email" class="form-control" name="email" id="mail" placeholder="">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                <!-- PASSWORD -->
                <div class="col-12">
                    <label for="pw" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="pw" placeholder="">
                    <div class="invalid-feedback">
                        lease enter a valid email address for shipping updates.
                    </div>
                </div>
                <hr class="mb-3 mt-4">
                <div class="tombol">
                    <div class="mt-2"><a href="register.php" id="register">Buat Akun</a></div>
                    <button class="btn btn-primary btn-lg" type="submit" name="login">Masuk</button>
                </div>
            </form>
        </div>
    </div>

    <?php
        if (isset ($_GET['pesan'])) {
            if ($_GET['pesan'] =="gagal")
            ?>
                <script>
                    alert("Login Gagal, Coba Lagi");
                </script>
            <?php
        }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>