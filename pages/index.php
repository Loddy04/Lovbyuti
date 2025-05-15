<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Landing Page</title>
    <link rel="stylesheet" href="../style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>  

<div class="navdex">
    <div class="navbarpage">
        <header class="d-flex">
            <span class="brand">LOVBYUTI</span>
            <ul class="nav">
                <li class="nav-item"><a class="listnav" href="#">Home</a></li>
                <li class="nav-item"><a class="listnav" href="#">About Us</a></li>
                <li class="nav-item"><a class="listnav" href="#">Contact Us</a></li>
            </ul>
        </header>
    </div>
</div>

<!-- 
    <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3">
    <a class="navbar-brand" href="#">LOVBYUTI</a>
    <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link" href="#scrollspyHeading1">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#scrollspyHeading2">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#scrollspyHeading3">Contact Us</a></li>
    </ul>
    </nav>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
        <h4 id="scrollspyHeading1">First heading</h4>
        <p>...</p>
        <h4 id="scrollspyHeading2">Second heading</h4>
        <p>...</p>
        <h4 id="scrollspyHeading3">Third heading</h4>
        <p>...</p>
        <h4 id="scrollspyHeading4">Fourth heading</h4>
        <p>...</p>
        <h4 id="scrollspyHeading5">Fifth heading</h4>
        <p>...</p>
    </div> -->

    <!-- TEXT IMAGE 1 -->
    <div class="txtimg1">
        <!-- teks card -->
        <div class="text-overlay">
            <h1>Reveal Your True Glow with LovByuti.</h1>
            <div class="text1">
                <!-- <p>Login untuk booking perawatan kecantikanmu.</p> -->
                <p>Kami percaya bahwa setiap kulit memiliki keunikan dan potensi untuk bersinar lebih cerah.</p>
                <p>Bersama Lovbyuti, temukan perjalanan perawatan kulit yang personal, aman, dan memanjakan.</p>
                <p>Karena Anda layak mendapatkan yang terbaik untuk tampil percaya diri, luar dan dalam.</p>
            </div>
            <div class="mulai">
                <div><a class="login" href="login.php">Login</a></div>
                <div><a class="regis" href="register.php">Registrasi</a></div>
            </div>
        </div>
        <!-- img -->
        <img class="img1" src="../assets/indedximg1.png" alt="">
    </div>
        <img class="img1" src="../assets/indedximg1.png" alt="">
    <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "logout") {
                ?>
                <script>
                    alert("Berhasil Log Out");
                </script>
            <?php
            } elseif ($_GET['pesan'] == "sudah") {
                ?>
                <script>
                    alert("Berhasil Registrasi");
                </script>
            <?php
            }
        }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>