<?php
session_start(); // Memulai sesi PHP
require "1-koneksi.php"; // Memuat file koneksi database

// Periksa apakah data dari formulir login telah dikirim
if (!isset($_POST['username'], $_POST['password'])) {
    exit('Silakan isi kolom nama pengguna dan kata sandi!'); // Keluar jika data tidak ada
}

// Menyiapkan dan mengeksekusi pernyataan SQL untuk memeriksa akun berdasarkan username
if ($stmt = $koneksi->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Verifikasi password
        if ($_POST['password'] === $password) {
            // Sukses verifikasi! Pengguna telah login!
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            ?>
            <!-- Pop-up untuk menampilkan pesan keberhasilan login -->
            <div id="popupBox" class="popup">
                <div class="popup-content">
                    <meta http-equiv="refresh" content="2;../../home-nasa/isi/" />
                    <div class="close"><a href="../../home-nasa/isi/">&times;</a></div>
                    <div class="icon-container">
                        <i class="icon fas fa-check-circle"></i> <!-- Mengubah ikon menjadi check-circle -->
                    </div>
                    <p>Anda berhasil login sebagai <?php echo $_POST['username']; ?></p>
                    <!-- Menampilkan nama pengguna yang berhasil login -->
                </div>
            </div>
            <?php
        } else {
            ?>
            <!-- Pop-up untuk menampilkan pesan kesalahan jika nama pengguna atau kata sandi salah -->
            <div id="popupBox" class="popup">
                <div class="popup-content">
                    <meta http-equiv="refresh" content="5; ../isi/" />
                    <div class="close"><a href="../isi/">&times;</a></div>
                    <div class="icon-container">
                        <i class="icon fas fa-circle-xmark"></i>
                    </div>
                    <p>Nama pengguna dan/atau kata sandi salah!</p>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <!-- Pop-up untuk menampilkan pesan kesalahan jika nama pengguna tidak ditemukan -->
        <div id="popupBox" class="popup">
            <div class="popup-content">
                <meta http-equiv="refresh" content="5; ../isi/" />
                <div class="close"><a href="../isi/">&times;</a></div>
                <div class="icon-container">
                    <i class="icon fas fa-circle-xmark"></i>
                </div>
                <p>Incorrect username and/or password!!!</p>
            </div>
        </div>
        <?php
    }

    $stmt->close();
}

$koneksi->close(); // Tutup koneksi database
?>

<!-- Sertakan file CSS -->
<link rel="stylesheet" href="../CSS/4-popup.css">
<link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
<!-- Menyertakan FontAwesome CSS -->
<!-- Sertakan file JavaScript -->
<script src="../JS/popup.js"></script>