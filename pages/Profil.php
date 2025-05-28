<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];
$query = mysqli_query($connect, "SELECT * FROM users WHERE id_user = '$id'");
$data = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['id'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE users SET 
                nama = '$nama',
                no_hp = '$no_hp',
                umur = '$umur',
                jenis_kelamin = '$jenis_kelamin',
                alamat = '$alamat'
              WHERE id_user = '$id'";

    if (mysqli_query($connect, $query)) {
        header("Location: profil.php?pesan=berhasil_update");
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Profil Pengguna</title>
    <link rel="stylesheet" href="../style/profil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
    <div class="navdex">
        <input type="checkbox" id="check">
        <label for="check" class="toggle-btn">
        <a href="javascript:history.back()" class="back-btn">
        <i class="fas fa-arrow-left" id="btn"></i>
        </a>
        </label>
        <div class="navbarpage">
        <div class="nav">
            <span class="brand">LOVBYUTI</span>
        </div>
        </div>
    </div>

    <!-- DATA USER + EDIT -->
    <div class="container-fluid">
        <div class="card shadow m-auto p-auto">
            <div class="card-body" style="background-color: rgb(226, 40, 130);">
                <div class="row">
                    <div class="col"></div>
                        <div class="col">
                            <pre style="color: floralwhite; font-size: 2rem;"><b>Profil Anda</b></pre>
                        </div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="card-body">
                <form action="profil.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
                    <!-- USERNAME -->
                    <div class="col-sm-12">
                        <label for="user" class="form-label">Username</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                    </div>

                    <!-- NO TELP -->
                    <div class="col-12">
                        <label class="form-label">No. Telepon</label>
                        <input type="tel" name="no_hp" class="form-control" value="<?= $data['no_hp']; ?>" required>
                    </div>

                    <!-- UMUR -->
                    <div class="col-12">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" class="form-control" value="<?= $data['umur']; ?>" required>
                    </div>

                    <!-- GENDER -->
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="Laki-Laki" <?= $data['jenis_kelamin'] == 'Laki-Laki' ? 'checked' : '' ?>>
                            <label class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="jenis_kelamin" class="form-check-input" value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
                    </div>
            </div>

            <div class="card-body" style="background-color: rgb(226, 40, 130);">
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <!-- SUBMIT -->
                            <div class="d-flex justify-content-end mt-3 mb-3">
                                <button class="btn" style="background-color: rgb(255, 226, 254); border: none; color: rgb(226, 40, 130);" type="submit">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
        if (isset ($_GET['pesan'])) {
            if ($_GET['pesan'] =="berhasil_update")
            ?>
                <script>
                    alert("Data Profil Berhasil Diperbarui ^^");
                </script>
            <?php
        }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
