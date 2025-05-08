<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LovByuti || Booking</title>
</head>
<body>
    <!-- form untuk booking -->
    <h2>Booking Online</h2>
    <form action="tambah.php" method="POST">
        <label for="ot">Outlet</label>
        <select id="ot" name="outlet" required="">
            <option value="">Pilih Outlet</option>
            <option value="1">Klinik LovByuti Yogyakarta</option>
            <option value="2">Klinik LovByuti Sleman</option>
            <option value="3">Klinik LovByuti Bantul</option>
            <option value="4">Klinik LovByuti Gunungkidul</option>
            <option value="5">Klinik LovByuti Kulon Progo</option>
        </select><br>
        <label for="tgl">Tanggal</label>
        <input type="date" name="tanggal" id="tgl"><br>
        <label for="jm">Jam</label>
        <input type="time" name="jam" id="jm"><br>
        <label for="">Preferensi Terapis</label><br>
        <input type="radio" name="preferensi" id="wa" value="Wanita">
        <label for="wa">Wanita</label>
        <input type="radio" name="preferensi" id="pr" value="Pria">
        <label for="pr">Pria</label><br>
        <!-- <label for="tm">Tidak Masalah</label>
        <input type="radio" name="preferensi" id="tm" value="Tidak Masalah"> -->
        <label for="kl">Keluhan</label><br>
        <textarea name="keluhan" id="kl"></textarea><br>
        <label for="">Reminder</label><br>
        <input type="checkbox" id="wa" name="reminder[]" value="Ingatkan Saya Melalui WA">
        <label for="wa">Ingatkan Saya Melalui WA</label><br>
        <input type="checkbox" id="em" name="reminder[]" value="Ingatkan Saya Melalui E-mail">
        <label for="em">Ingatkan Saya Melalui E-mail</label><br>
        <button type="submit">Booking now</button>
    </form>
</body>
</html>