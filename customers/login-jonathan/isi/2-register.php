<?php
require "1-koneksi.php"; // Menggunakan file ini untuk menghubungkan ke database.

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Memeriksa apakah metode permintaan adalah POST.

    // Validasi input
    $username = $_POST['username']; // Mengambil username dari data POST.
    $password = $_POST['password']; // Mengambil password dari data POST.
    $email = $_POST['email']; // Mengambil email dari data POST.

    // Validasi format email menggunakan fungsi filter_var().
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Email tidak valid!'); // Keluar dan tampilkan pesan kesalahan jika format email tidak valid.
    }

    // Validasi username menggunakan pola ekspresi reguler.
    if (preg_match('/^[a-zA-Z0-9]+$/', $username) == 0) {
        exit('Username tidak valid!'); // Keluar dan tampilkan pesan kesalahan jika format username tidak valid.
    }

    // Validasi panjang password.
    if (strlen($password) > 30 || strlen($password) < 6) {
        exit('Password harus terdiri dari 6 hingga 30 karakter!'); // Keluar dan tampilkan pesan kesalahan jika panjang password tidak valid.
    }

    // Periksa apakah username sudah ada dalam database untuk memastikan keunikan.
    if ($stmt = $koneksi->prepare('SELECT id FROM accounts WHERE username = ?')) {
        $stmt->bind_param('s', $username); // Mengikat parameter ke pernyataan yang telah disiapkan.
        $stmt->execute(); // Eksekusi pernyataan yang telah disiapkan.
        $stmt->store_result(); // Simpan hasil kueri dari pernyataan yang telah disiapkan.
        if ($stmt->num_rows > 0) {
            exit('Username sudah ada, harap pilih yang lain!'); // Keluar dan tampilkan pesan kesalahan jika username sudah ada dalam database.
        }
        $stmt->close(); // Tutup pernyataan yang telah disiapkan.
    } else {
        exit('Tidak dapat menyiapkan pernyataan!'); // Keluar dan tampilkan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat disiapkan.
    }

    // Generate kode aktivasi unik menggunakan fungsi uniqid().
    $activation_code = uniqid();

    // Masukkan data pengguna ke dalam database menggunakan pernyataan yang telah disiapkan untuk mencegah injeksi SQL.
    if ($stmt = $koneksi->prepare('INSERT INTO accounts (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
        $stmt->bind_param('ssss', $username, $password, $email, $activation_code); // Mengikat parameter ke pernyataan yang telah disiapkan.
        $stmt->execute(); // Eksekusi pernyataan yang telah disiapkan untuk memasukkan data ke dalam database.

        // // Kirim email aktivasi ke pengguna.
        // $from = 'noreply@yourdomain.com'; // Set alamat email pengirim.
        // $subject = 'Account Activation Required'; // Set subjek email.
        // $activate_link = 'http://yourdomain.com/phplogin/activate.php?email=' . $email . '&code=' . $activation_code; // Konstruksi tautan aktivasi.
        // $message = '<p>Silakan klik tautan berikut untuk mengaktifkan akun Anda: <a href="' . $activate_link . '">' . $activate_link . '</a></p>'; // Konstruksi pesan email.
        // $headers = 'From: ' . $from . "\r\n" . // Konstruksi header email.
        //     'Reply-To: ' . $from . "\r\n" .
        //     'X-Mailer: PHP/' . phpversion() . "\r\n" .
        //     'MIME-Version: 1.0' . "\r\n" .
        //     'Content-Type: text/html; charset=UTF-8' . "\r\n";

        ?>
        <!-- Pop-up untuk menampilkan pesan keberhasilan register -->
        <div id="popupBox" class="popup">
            <div class="popup-content">
                <meta http-equiv="refresh" content="5; ../isi/" />
                <div class="close"><a href="../isi/">&times;</a></div>
                <div class="icon-container">
                    <i class="icon fa-solid fa-check"></i>
                </div>
                <p>Pendaftaran Berhasil</p>
            </div>
        </div>
        <?php

        // // Kirim email.
        // if (mail($email, $subject, $message, $headers)) {

        //     echo 'Pendaftaran berhasil! Silakan periksa email Anda untuk mengaktifkan akun Anda!'; // Tampilkan pesan sukses jika email berhasil dikirim.
        // } else {
        //     echo 'Gagal mengirim email aktivasi. Harap hubungi dukungan!'; // Tampilkan pesan kesalahan jika pengiriman email gagal.
        // }
    } else {
        exit('Tidak dapat menyiapkan pernyataan!'); // Keluar dan tampilkan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat disiapkan.
    }
}

$koneksi->close(); // Tutup koneksi database setelah proses selesai.
?>

<!-- Sertakan file CSS -->
<link rel="stylesheet" href="../CSS/4-popup.css">
<link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
<!-- Menyertakan FontAwesome CSS -->
<!-- Sertakan file JavaScript -->
<script src="../JS/popup.js"></script>