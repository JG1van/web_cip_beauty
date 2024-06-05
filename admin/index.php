<?php
// Memulai sesi PHP
session_start();

// Memeriksa apakah pengguna telah masuk sebagai admin. Jika tidak, arahkan kembali ke halaman login atau halaman lainnya
if (!isset($_SESSION['loggedin_admin']) || $_SESSION['loggedin_admin'] !== true) {
  header('Location: ../customers/login-jonathan/isi/');
  exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    /* Mengimpor font Spartan dari Google Fonts */
    @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");

    /* Styling default untuk semua elemen */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Styling untuk bagian dengan padding */
    .section-p1 {
      padding: 40px 80px;
    }

    /* Styling untuk bagian dengan margin */
    .section-m1 {
      margin: 40px 0;
    }

    /* Styling untuk body */
    body {
      width: 100%;
      font-family: "Spartan", sans-serif;
    }

    /* Header Start */
    #header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 80px;
      background: #fed7dd;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
      z-index: 999;
      position: sticky;
      top: 0;
      left: 0;
    }

    /* Navbar */
    #navbar {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* List item di navbar */
    #navbar li {
      list-style: none;
      padding: 0 20px;
      position: relative;
    }

    /* Link di navbar */
    #navbar li a {
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
      transition: 0.3s ease;
    }

    /* Hover dan active state untuk link di navbar */
    #navbar li a:hover,
    #navbar li a.active {
      color: #1a1a1a;
    }

    /* Pseudo-elemen setelah link di navbar saat hover atau active */
    #navbar li a.active::after,
    #navbar li a:hover::after {
      content: "";
      width: 30%;
      height: 2px;
      background: #fff;
      position: absolute;
      bottom: -4px;
      left: 20px;
    }

    /* Styling untuk gambar di header */
    #header img {
      border-radius: 50%;
    }

    /* Styling untuk bagian main */
    main {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #fed7dd;
    }

    /* Styling untuk gambar di main */
    main img {
      height: 500px;
      width: 500px;
      max-width: 100%;
      max-height: 100%;
      border-radius: 50%;
    }
  </style>
</head>

<body>
  <!-- Bagian header -->
  <section id="header">
    <!-- Tautan dengan logo -->
    <a href="../admin">
      <!-- Gambar logo dengan lebar dan tinggi 80px -->
      <img src="logo.png" width="80" height="80" class="Logo" alt="Your Logo" />
    </a>
    <div>
      <!-- Daftar navigasi -->
      <ul id="navbar">
        <!-- Tautan ke halaman Home -->
        <li><a href="admin-home-nasa/">Home</a></li>
        <!-- Tautan ke halaman Shop  -->
        <li><a href="admin-produk-jonathan/0-Produk-input.php">Produk</a></li>
        <!-- Tautan ke halaman Treatments -->
        <li><a href="admin-treatments-mersi/">Treatments</a></li>
        <!-- Tautan ke halaman About Us -->
        <li><a href="admin-about-us-nasa/">About Us</a></li>
        <!-- Tautan ke halaman Promotion -->
        <li><a href="admin-Promotion-nasa/">Promotion</a></li>
      </ul>
    </div>
  </section>
  <!-- Bagian main -->
  <main>
    <!-- Gambar logo dengan lebar dan tinggi tertentu -->
    <img src="logo.png" alt="">
  </main>
</body>

</html>