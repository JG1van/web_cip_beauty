<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>
<style>
  /* Mengimpor font Spartan dari Google Fonts */
  @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");

  /* Styling default untuk semua elemen */
  * {
    margin: 0;
    /* Menghilangkan margin */
    padding: 0;
    /* Menghilangkan padding */
    box-sizing: border-box;
    /* Mengatur box model menjadi border-box */
  }

  /* Styling untuk bagian dengan padding */
  .section-p1 {
    padding: 40px 80px;
    /* Padding atas-bawah 40px, kiri-kanan 80px */
  }

  /* Styling untuk bagian dengan margin */
  .section-m1 {
    margin: 40px 0;
    /* Margin atas-bawah 40px */
  }

  /* Styling untuk body */
  body {
    width: 100%;
    /* Lebar body 100% */
    font-family: "Spartan", sans-serif;
    /* Menggunakan font Spartan dari Google Fonts */
  }

  /* Header Start */
  #header {
    display: flex;
    /* Menjadikan header sebagai flex container */
    align-items: center;
    /* Menengahkan item secara vertikal */
    justify-content: space-between;
    /* Menyebar item dengan jarak di antara mereka */
    padding: 20px 80px;
    /* Padding atas-bawah 20px, kiri-kanan 80px */
    background: #fed7dd;
    /* Warna latar belakang pink */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
    /* Bayangan dengan blur */
    z-index: 999;
    /* Memastikan header berada di atas elemen lain */
    position: sticky;
    /* Header tetap di atas saat di-scroll */
    top: 0;
    /* Posisi atas 0 */
    left: 0;
    /* Posisi kiri 0 */
  }

  /* Navbar */
  #navbar {
    display: flex;
    /* Menjadikan navbar sebagai flex container */
    align-items: center;
    /* Menengahkan item secara vertikal */
    justify-content: center;
    /* Menengahkan item secara horizontal */
  }

  /* List item di navbar */
  #navbar li {
    list-style: none;
    /* Menghilangkan bullet points */
    padding: 0 20px;
    /* Padding kiri-kanan 20px */
    position: relative;
    /* Untuk positioning pseudo-elemen */
  }

  /* Link di navbar */
  #navbar li a {
    text-decoration: none;
    /* Menghilangkan garis bawah teks */
    font-size: 16px;
    /* Ukuran font 16px */
    font-weight: 600;
    /* Ketebalan font 600 */
    color: #1a1a1a;
    /* Warna teks hitam */
    transition: 0.3s ease;
    /* Transisi halus */
  }

  /* Hover dan active state untuk link di navbar */
  #navbar li a:hover,
  #navbar li a.active {
    color: #1a1a1a;
    /* Warna teks hitam */
  }

  /* Pseudo-elemen setelah link di navbar saat hover atau active */
  #navbar li a.active::after,
  #navbar li a:hover::after {
    content: "";
    /* Konten kosong */
    width: 30%;
    /* Lebar 30% */
    height: 2px;
    /* Tinggi 2px */
    background: #fff;
    /* Warna latar belakang putih */
    position: absolute;
    /* Posisi absolut */
    bottom: -4px;
    /* Jarak 4px dari bawah */
    left: 20px;
    /* Jarak 20px dari kiri */
  }

  /* Styling untuk gambar di header */
  #header img {
    border-radius: 50%;
    /* Membuat gambar menjadi lingkaran */
  }

  /* Styling untuk bagian main */
  main {
    height: 100vh;
    /* Menetapkan tinggi main sesuai dengan tinggi viewport */
    display: flex;
    /* Mengatur main sebagai flex container */
    justify-content: center;
    /* Menengahkan konten secara horizontal */
    align-items: center;
    /* Menengahkan konten secara vertikal */
    background-color: #fed7dd;
    /* Warna latar belakang pink */
  }

  /* Styling untuk gambar di main */
  main img {
    height: 500px;
    /*  tinggi gambar  */
    width: 500px;
    /*  lebar gambar  */
    max-width: 100%;
    /* Mengatur lebar gambar agar sesuai dengan lebar layar */
    max-height: 100%;
    /* Mengatur tinggi gambar agar sesuai dengan tinggi layar */
    border-radius: 50%;
    /* Membuat gambar menjadi lingkaran */
  }
</style>

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
        <li><a href="admin-about-us-handa/">About Us</a></li>
        <!-- Tautan ke halaman Contact Us -->
        <li><a href="admin-Promotion-fikrah/">Contact Us</a></li>
      </ul>
    </div>
  </section>
  <!-- Bagian main -->
  <main>
    <!-- Gambar logo dengan lebar dan tinggi tertentu -->
    <img src="logo.png" alt="">
  </main>
</body>

</html