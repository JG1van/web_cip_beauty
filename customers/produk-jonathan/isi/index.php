<?php
// Menggunakan file koneksi.php untuk menghubungkan ke database
require "1-koneksi.php";

// Melakukan query untuk mengambil data produk dari database
if (isset($_GET['keyword'])) {
  // Jika ada parameter pencarian, lakukan pencarian berdasarkan nama produk
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE NAMA_PRODUK LIKE '%$_GET[keyword]%'");
  // Memeriksa apakah data ditemukan
  if (mysqli_num_rows($queryProduk) > 0) { ?>
    <!-- Menampilkan pesan sukses jika data ditemukan -->
    <div class="alert alert-primary text-center" role="alert">data ditemukan</div>
    <?php
  } else {
    ?>
    <!-- Menampilkan pesan error jika data tidak ditemukan -->
    <div class="alert alert alert-dark text-center" role="alert">
      data tidak ditemukan
    </div>
    <?php
  }
} else {
  // Jika tidak ada parameter pencarian, ambil semua data produk
  $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}
// Mengambil data produk untuk slide gambar
$querygambar = mysqli_query($con, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Set informasi meta -->
  <meta charset="UTF-8" />
  <!-- Menentukan set karakter dokumen sebagai UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Menentukan pengaturan tampilan pada perangkat berbasis web -->
  <!-- Judul halaman -->
  <title>PRODUK</title>
  <!-- Style CSS -->
  <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" /> <!-- Menyertakan FontAwesome CSS -->
  <link rel="stylesheet" href="../CSS/0-styles-navbar.css" />
  <link rel="stylesheet" href="../CSS/1-styles-pencarian.css" />
  <link rel="stylesheet" href="../CSS/2-styles-slide-gambar.css" />
  <link rel="stylesheet" href="../CSS/3-stles.css" />
  <link rel="stylesheet" href="../CSS/6-styles-footer.css" />
  <!-- Menghubungkan dokumen dengan berkas CSS eksternal -->
</head>

<body>
  <?php require "3-navbar.php"; ?>
  <?php require "4-slide-gambar-produk.php"; ?>
  <!-- Kontainer utama -->
  <div class="container">
    <?php require "2-pencarian.php"; ?>

    <!-- Judul halaman -->
    <div class="judul-utama">
      <h1>PRODUK KAMI</h1>
      <!-- Judul halaman -->
    </div>
    <!-- Bagian utama konten -->
    <main>
      <?php
      // Mengambil setiap baris data produk dan menampilkannya
      while ($data = mysqli_fetch_array($queryProduk)) { ?>
        <!-- Kolom PRODUK 1 -->
        <div class="PRODUK-column">
          <!-- Judul PRODUK -->
          <div class="judul">
            <h2><?php echo $data['NAMA_PRODUK']; ?></h2>
          </div>
          <div class="GAMABAR-gambar">
            <img src="../gambar/image-produk/<?php echo htmlspecialchars($data['GAMBAR']); ?>" alt="..." />
          </div>
          <!-- Isi PRODUK -->
          <div class="isi">
            <h3>
              RP.
              <?php echo $data['HARGA_PRODUK']; ?>
            </h3>
          </div>
          <!-- Tombol detail -->
          <div class="tombol">
            <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>" class="klik">
              DETAIL <i class="fa-solid fa-magnifying-glass"></i>
            </a>
          </div>

        </div>
      <?php } ?>
    </main>
  </div>
  <?php require "7-footer.php"; ?>
  <script src="../JS/app.js"></script>
</body>

</html>