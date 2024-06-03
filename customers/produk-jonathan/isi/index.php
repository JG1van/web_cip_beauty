<?php
// Menggunakan file koneksi.php untuk menghubungkan ke database
require "1-koneksi.php";

// Mengecek apakah ada parameter pencarian
if (isset($_GET['keyword'])) {
  // Mengambil nilai keyword dari URL
  $keyword = $_GET['keyword'];

  // Mengecek apakah keyword sesuai dengan "Berhasil" atau "Gagal"
  if ($keyword == "Berhasil") {
    // Jika keyword adalah "Berhasil", tampilkan popup pesanan berhasil
    ?>
    <div id="popupBox" class="popup">
      <div class="popup-content">
        <div class="close">&times;</a></div> <!-- Tombol close -->
        <div class="icon-container">
          <i class="ikon fa-solid fa-cart-plus"></i> <!-- Icon keranjang -->
        </div>
        <p>Pesanan Berhasil Masuk Keranjang Anda:</p> <!-- Pesan pesanan berhasil -->
        <div class="tombol">
          <a href="../../login-jonathan/isi/5-profil.php" class="klik"> CEK PROFIL <i
              class="fa-sharp fa-solid fa-user"></i></a>
        </div>
      </div>
    </div>
    <?php
  } elseif ($keyword == "Gagal") {
    // Jika keyword adalah "Gagal", tampilkan popup pesanan gagal
    ?>
    <div id="popupBox" class="popup">
      <div class="popup-content">
        <div class="close">&times;</a></div> <!-- Tombol close -->
        <div class="icon-container">
          <i class="ikon fas fa-circle-xmark"></i> <!-- Icon kesalahan -->
        </div>
        <p>Maaf, terjadi kesalahan saat melakukan checkout. Silakan coba lagi nanti.</p> <!-- Pesan pesanan gagal -->
      </div>
    </div>
    <?php
  }

  // Mengecek apakah keyword tidak kosong dan bukan "Berhasil" atau "Gagal"
  if (!empty($keyword) && $keyword != "Berhasil" && $keyword != "Gagal") {
    // Jika keyword tidak kosong dan bukan "Berhasil" atau "Gagal", lakukan pencarian produk berdasarkan nama produk yang sesuai dengan keyword
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE NAMA_PRODUK LIKE '%$keyword%'");
  } else {
    // Jika keyword kosong atau "Berhasil" atau "Gagal", ambil semua data produk
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
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
  <meta charset="UTF-8" /> <!-- Menentukan set karakter dokumen sebagai UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Menentukan pengaturan tampilan pada perangkat berbasis web -->
  <!-- Judul halaman -->
  <title>PRODUK</title>
  <!-- Style CSS -->
  <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" /> <!-- Menyertakan FontAwesome CSS -->
  <link rel="stylesheet" href="../CSS/0-styles-navbar.css" />
  <link rel="stylesheet" href="../CSS/1-styles-pencarian.css" />
  <link rel="stylesheet" href="../CSS/2-styles-slide-gambar.css" />
  <link rel="stylesheet" href="../CSS/3-styles-produk_II.css" />
  <link rel="stylesheet" href="../CSS/6-styles-footer.css" />
  <link rel="stylesheet" href="../CSS/7-styles-popup.css">

  <!-- Menghubungkan dokumen dengan berkas CSS eksternal -->
</head>

<body>
  <?php require "3-navbar.php"; ?>

  <!-- Kontainer utama -->
  <div class="Kotak-luar">
    <?php require "4-slide-gambar-produk.php"; ?>
    <?php require "2-pencarian.php"; ?>

    <!-- Judul halaman -->
    <div class="judul-utama">
      <h1>PRODUK KAMI</h1>
      <!-- Judul halaman -->
    </div>
    <!-- Bagian utama konten -->
    <main>
      <?php
      if (isset($_GET['keyword']) && empty($keyword)) {
        // Menampilkan pesan jika kotak pencarian kosong
        ?>
        <div class="judul">
          <h1><i class="fa-solid fa-triangle-exclamation"></i>KOTAK PENCARIAN TIDAK BOLEH KOSONG<i
              class="fa-solid fa-triangle-exclamation"></i></h1>
        </div>
        <?php
      } else {
        // Memeriksa apakah ada hasil query
        if ($queryProduk && mysqli_num_rows($queryProduk) > 0) {
          // Mengambil setiap baris data produk dan menampilkannya
          while ($data = mysqli_fetch_array($queryProduk)) { ?>
            <!-- Kolom PRODUK 1 -->
            <div class="PRODUK-column">
              <div class="gambar">
                <img src="../gambar/image-produk/<?php echo htmlspecialchars($data['GAMBAR']); ?>" alt="..." />
              </div>
              <!-- Judul PRODUK -->
              <div class="judul">
                <h2><?php echo $data['NAMA_PRODUK']; ?></h2>
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
                <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>" class="klik">DETAIL<i
                    class="fa-solid fa-magnifying-glass"></i>
                </a>
              </div>
            </div>
          <?php }
        } else {
          // Menampilkan pesan jika tidak ada data ditemukan
          ?>
          <div class="judul">
            <h1><i class="fa-solid fa-triangle-exclamation"></i>DATA TIDAK DITEMUKAN<i
                class="fa-solid fa-triangle-exclamation"></i></h1>
          </div>
          <?php
        }
      }
      ?>
    </main>
  </div>
  <?php require "7-footer.php"; ?>
  <!-- Menghubungkan dengan berkas JavaScript -->
  <script src="../JS/app.js"></script>
  <script src="../JS/popup.js"></script>
</body>

</html>