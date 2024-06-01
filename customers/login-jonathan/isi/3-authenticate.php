<?php
session_start(); // Memulai sesi PHP
require "1-koneksi.php"; // Memuat file koneksi database

// Periksa apakah data dari formulir login telah dikirim
if (!isset($_POST['username'], $_POST['password'])) {
    exit('Silakan isi kolom nama pengguna dan kata sandi!'); // Keluar jika data tidak ada
}

// Memeriksa apakah pengguna ada di tabel customers
$queryCustomer = $koneksi->prepare('SELECT id, password FROM accounts WHERE username = ?');
$queryCustomer->bind_param('s', $_POST['username']);
$queryCustomer->execute();
$queryCustomer->store_result();

if ($queryCustomer->num_rows > 0) {
    $queryCustomer->bind_result($id, $password);
    $queryCustomer->fetch();
    // Verifikasi password untuk akun customer
    if ($_POST['password'] === $password) {
        // Sukses verifikasi! Pengguna telah login sebagai customer!
        session_regenerate_id();
        $_SESSION['loggedin_admin'] = FALSE; // Tidak login sebagai admin
        $_SESSION['loggedin'] = TRUE; // Untuk customer
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        ?>
        <!-- Pop-up untuk menampilkan pesan keberhasilan login sebagai customer -->
        <div id="popupBox" class="popup">
            <div class="popup-content">
                <meta http-equiv="refresh" content="2;../../home-nasa/isi/" />
                <div class="close"><a href="../../home-nasa/isi/">&times;</a></div>
                <div class="icon-container">
                    <i class="icon fas fa-check-circle"></i>
                </div>
                <p>Anda berhasil login sebagai : <?php echo $_POST['username']; ?></p>
            </div>
        </div>
        <?php
    } else {
        ?>
        <!-- Pop-up untuk menampilkan pesan kesalahan jika kata sandi salah untuk customer -->
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
    // Memeriksa apakah pengguna ada di tabel admin
    $queryAdmin = $koneksi->prepare('SELECT id, password FROM accounts_admin WHERE username = ?');
    $queryAdmin->bind_param('s', $_POST['username']);
    $queryAdmin->execute();
    $queryAdmin->store_result();

    if ($queryAdmin->num_rows > 0) {
        $queryAdmin->bind_result($id, $password);
        $queryAdmin->fetch();
        // Verifikasi password untuk akun admin
        if ($_POST['password'] === $password) {
            // Sukses verifikasi! Pengguna telah login sebagai admin!
            session_regenerate_id();
            $_SESSION['loggedin_admin'] = TRUE; // Untuk admin
            $_SESSION['loggedin'] = FALSE; // Tidak login sebagai customer
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            // Redirect ke halaman admin setelah login berhasil
            ?>
            <!-- Pop-up untuk menampilkan pesan keberhasilan login sebagai admin -->
            <div id="popupBox" class="popup">
                <div class="popup-content">
                    <meta http-equiv="refresh" content="2;../../../admin/" />
                    <div class="close"><a href="../../../admin/">&times;</a></div>
                    <div class="icon-container">
                        <i class="icon fas fa-check-circle"></i>
                    </div>
                    <p>Anda berhasil login sebagai : <?php echo $_POST['username']; ?> </p>
                </div>
            </div>
            <?php
        } else {
            ?>
            <!-- Pop-up untuk menampilkan pesan kesalahan jika kata sandi salah untuk admin -->
            <div id="popupBox" class="popup">
                <div class="popup-content">
                    <meta http-equiv="refresh" content="5;../../../admin/" />
                    <div class="close"><a href="../../../admin/">&times;</a></div>
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
                <p>Nama pengguna(<?php echo $_POST['username']; ?>) dan/atau kata sandi (<?php echo $_POST['password']; ?>)
                    tidak ada ! </p>
            </div>
        </div>
        <?php
    }

    // Tutup queryAdmin jika sudah didefinisikan
    if (isset($queryAdmin)) {
        $queryAdmin->close();
    }
}

// Tutup queryCustomer
$queryCustomer->close();
$koneksi->close(); // Tutup koneksi database
?>

<!-- Sertakan file CSS -->
<link rel="stylesheet" href="../CSS/4-popup.css">
<link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
<!-- Menyertakan FontAwesome CSS -->
<!-- Sertakan file JavaScript -->
<script src="../JS/popup.js"></script>