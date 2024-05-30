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
            // echo 'Welcome back, ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . '!';
            echo "<script> alert('Anda sukses login');</script>";
            echo "<script> location ='../../home-nasa/isi/';</script>";

            // header("Location:../../home-nasa/isi/"); // Redirect ke halaman beranda jika login berhasil
            // // header("Location:../../produk-jonathan/isi/"); // Redirect ke halaman beranda jika login berhasil
            exit();
        } else {
            // Password salah
            echo "<script> alert('Nama pengguna dan/atau kata sandi salah!');</script>";
            echo "<script> location ='../isi/';</script>";

        }
    } else {
        // Username tidak ditemukan
        echo "<script> alert('Incorrect username and/or password!');</script>";
        echo "<script> location ='../isi/';</script>";

    }

    $stmt->close();
}

$koneksi->close(); // Tutup koneksi database
?>