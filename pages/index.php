<?php
include 'koneksi.php';
$sql1 = mysqli_query($connect, "SELECT * FROM treatmens");
$sql2 = mysqli_query($connect, "SELECT * FROM outlets");

while ($data1 = mysqli_fetch_assoc($sql1)) {
    if ($data1['id_treatmen'] == 11) {
        $t1 = $data1;
    } elseif ($data1['id_treatmen'] == 22) {
        $t2 = $data1;
    } elseif ($data1['id_treatmen'] == 24) {
        $t3 = $data1;
    }
}

while ($data2 = mysqli_fetch_assoc($sql2)) {
    if ($data2['id_outlet'] == 1) {
        $o1 = $data2;
    } elseif ($data2['id_outlet'] == 2) {
        $o2 = $data2;
    } elseif ($data2['id_outlet'] == 3) {
        $o3 = $data2;
    } elseif ($data2['id_outlet'] == 4) {
        $o4 = $data2;
    } elseif ($data2['id_outlet'] == 5) {
        $o5 = $data2;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>  
<!-- NAVBAR -->
    <div class="navdex">
        <div class="navbarpage">
            <header class="d-flex">
                <span class="brand">LOVBYUTI</span>
                <ul class="nav">
                    <li class="nav-item"><a class="listnav" href="#home">Home</a></li>
                    <li class="nav-item"><a class="listnav" href="#treatmen">Treatmen</a></li>
                    <li class="nav-item"><a class="listnav" href="#outlet">Outlet</a></li>
                    <li class="nav-item"><a class="listnav" href="#about_us">About Us</a></li>
                </ul>
            </header>
        </div>
    </div>

    <!-- TEXT IMAGE 1 -->
    <div class="txtimg1" id="home">
        <!-- teks card -->
        <div class="text-overlay">
            <h1>Reveal Your True Glow with LovByuti.</h1>
            <div class="text1">
                <p>Kami percaya bahwa setiap kulit memiliki keunikan dan potensi untuk bersinar lebih cerah.</p>
                <p>Bersama Lovbyuti, temukan perjalanan perawatan kulit yang personal, aman, dan memanjakan.</p>
                <p>Karena Anda layak mendapatkan yang terbaik untuk tampil percaya diri, luar dan dalam.</p>
            </div>
            <div class="mulai">
                <div style="margin-right: 2rem;"><a class="login" href="login.php">Login</a></div>
                <div><a class="regis" href="register.php">Registrasi</a></div>
            </div>
        </div>
        <!-- img -->
        <img class="img1" src="../assets/indedximg1.png" alt="">
    </div>

<!-- TREATMENS -->
<div class="branch-cards-section2" id="treatmen">
    <div class="container">
        <h2 class="section-title2">TOP TREATMENS</h2>
        <p class="section-desc">Top treatmen yang dimiliki klinik LovByuti.</p>
            <div class="branch-cards-row">
                <!-- Card 1 -->
                <div class="branch-card2">
                    <div class="branch-card-body">
                        <h3 class="branch-title2"><?= $t1['nama_treatmen'] ?></h3>
                        <a href="treatmen.php" class="btn-visit2">Lihat Detail</a>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="branch-card2">
                    <div class="branch-card-body">
                        <h3 class="branch-title2"><?= $t2['nama_treatmen'] ?></h3>
                        <a href="treatmen.php" class="btn-visit2">Lihat Detail</a>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="branch-card2">
                    <div class="branch-card-body">
                        <h3 class="branch-title2"><?= $t3['nama_treatmen'] ?></h3>
                        <a href="treatmen.php" class="btn-visit2">Lihat Detail</a>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>

<!-- OUTLET CARDS -->
<div class="branch-cards-section" id="outlet">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/clinic1.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <div class="caption-card">
            <h3><?= $o1['nama'] ?></h3>
            <p class="outlet-address"><?= $o1['alamat'] ?></p>
            <p class="outlet-phone"><?= $o1['no_hp'] ?></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/clinic2.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <div class="caption-card">
            <h3><?= $o2['nama'] ?></h3>
            <p class="outlet-address"><?= $o2['alamat'] ?></p>
            <p class="outlet-phone"><?= $o2['no_hp'] ?></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/clinic3.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <div class="caption-card">
            <h3><?= $o3['nama'] ?></h3>
            <p class="outlet-address"><?= $o3['alamat'] ?></p>
            <p class="outlet-phone"><?= $o3['no_hp'] ?></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/clinic4.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <div class="caption-card">
            <h3><?= $o4['nama'] ?></h3>
            <p class="outlet-address"><?= $o4['alamat'] ?></p>
            <p class="outlet-phone"><?= $o4['no_hp'] ?></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/clinic5.jpeg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <div class="caption-card">
            <h3><?= $o5['nama'] ?></h3>
            <p class="outlet-address"><?= $o5['alamat'] ?></p>
            <p class="outlet-phone"><?= $o5['no_hp'] ?></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<!-- ABOUT US -->
  <div class="container" id="about_us">
        <section class="why-zap-section">
            <h2 class="section-title">KENAPA MEMILIH LOVBYUTI?</h2>
            <p class="section-subtitle">Kami berkomitmen untuk selalu memberikanmu pelayanan terbaik sebak mungkin</p>
            
            <div class="doctors-image">
                <img src="../assets/indeximg2.jpg" alt="Dokter ZAP profesional dalam seragam putih">
            </div>
            
            <div class="features-container">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10S2 17.514 2 12 6.486 2 12 2zm0 18c4.411 0 8-3.589 8-8s-3.589-8-8-8-8 3.589-8 8 3.589 8 8 8zM11 7h2v6h-2zm0 8h2v2h-2z"/>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Berpengalaman</h3>
                        <p>Dengan lebih dari 15 tahun di dunia kecantikan, LOVBYUTI adalah destinasi terpercaya dan terlengkap untuk perawatan kulit di Indonesia.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.35 10.04A7.49 7.49 0 0 0 12 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 0 0 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95A5.469 5.469 0 0 1 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11A2.98 2.98 0 0 1 22 15c0 1.65-1.35 3-3 3z"/>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Pelayanan Ramah</h3>
                        <p>Staf kami selalu mengutamakan pelayanan personal dengan kenyamanan dan keramahan.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.17-5.24l-4.4-4.4L10.59 9.17l4.4 4.4-2.82 2.82z"/>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Teknologi Terkini</h3>
                        <p>LOVBYUTI menggunakan teknologi terbaik yang terbukti efektif, dengan standar medis yang ketat.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Tepat Waktu</h3>
                        <p>Waktumu berharga, dan LOVBYUTI selalu tepat waktu dalam setiap treatment.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Banyak Lokasi</h3>
                        <p>Outlet LOVBYUTI yang tersebar dan terintegrasi siap melayani Anda di seluruh Jogja.</p>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Dokter Bersertifikasi</h3>
                        <p>Dokter  LOVBYUTI berpengalaman, mengutamakan keamanan, dan memberikan solusi efektif dengan penuh perhatian.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- Footer -->
<div class="footer-container"> 
    <div class="container">
        <footer class="py-5"> 
            <div class="row"> 
                <div class="col-6 col-md-2 mb-3"> 
                    <h5>Navigasi</h5><br> 
                    <ul class="nav flex-column"> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Home</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Contact</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">About</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Treatmen</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Booking</a></li> 
                    </ul> 
                </div> 
                <div class="col-6 col-md-2 mb-3">
                    <h5>Layanan</h5><br>
                    <ul class="nav flex-column"> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Laser</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Facial</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Injection</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Skin Peeling</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Intensive Skin Care</a></li> 
                    </ul> 
                </div> 
                <div class="col-6 col-md-2 mb-3">
                    <h5>Kontak</h5><br>
                    <ul class="nav flex-column"> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Instagram</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Facebook</a></li>
                        <li class="nav-item"><a href="#" class="nav-link p-0">WhatsApp</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Email</a></li> 
                        <li class="nav-item"><a href="#" class="nav-link p-0">Lokasi</a></li> 
                    </ul> 
                </div> 
                <div class="col-md-5 offset-md-1 mb-3"> 
                    <form> 
                        <h5>Subscribe to our newsletter</h5> 
                        <p>Dapatkan info promo & berita terbaru dari LovByuti</p> 
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2"> 
                            <label for="newsletter1" class="visually-hidden">Email address</label> 
                            <input id="newsletter1" type="email" class="form-control" placeholder="Email address"> 
                            <button class="btn btn-primary" type="button">Subscribe</button> 
                        </div>
                    </form> 
                </div> 
            </div> 
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 mt-4 border-top"> 
                <p>© 2025 LovByuti Beauty Care. All rights reserved.</p> 
                <ul class="list-unstyled d-flex social-icons"> 
                    <li class="ms-3">
                        <a class="link-body-emphasis" href="#" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                            </svg>
                        </a>
                    </li> 
                    <li class="ms-3">
                        <a class="link-body-emphasis" href="#" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="ms-3">
                        <a class="link-body-emphasis" href="#" aria-label="WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                            </svg>
                        </a>
                    </li>
                </ul> 
            </div> 
        </footer>
    </div>
</div>


<?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "logout") {
            ?>
                <script>
                    alert("Berhasil LogOut");
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

<script>
    setTimeout(() => {
    const url = new URL(window.location);
    url.searchParams.delete('pesan');
    window.history.replaceState({}, document.title, url.pathname);
    }, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>