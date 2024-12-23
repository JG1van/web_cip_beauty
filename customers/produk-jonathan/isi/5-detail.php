<?php
// Menggunakan file koneksi.php untuk menghubungkan ke database
require "1-koneksi.php";
// Mengambil nama produk dari parameter URL
$nama = htmlspecialchars($_GET['nama']);
// Melakukan query untuk mengambil data produk dari database
$queryproduk = mysqli_query($con, "SELECT * FROM produk WHERE NAMA_PRODUK='$nama'");
$produk = mysqli_fetch_array($queryproduk);
// Mengambil data produk untuk slide gambar
$querygambar = mysqli_query($con, "SELECT * FROM produk WHERE NAMA_PRODUK != '$nama' ORDER BY RAND()");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUK||DETAIL</title>
    <!-- Menghubungkan dengan CSS Bootstrap -->
    <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/0-styles-navbar.css" />
    <link rel="stylesheet" href="../CSS/4-styles-detail-produk.css" />
    <link rel="stylesheet" href="../CSS/6-styles-slide-gambar-footer.css" />
    <link rel="stylesheet" href="../CSS/7-styles-footer.css" />

</head>

<body>
    <?php require "3-navbar.php"; ?>

    <!-- Konten utama -->
    <div class="Kotak-luar">
        <div class="judul-utama">
            <h1>PRODUK DETAIL</h1>
        </div>
        <main>
            <div class="GAMBAR-column">
                <div class="gambar">
                    <!-- Tampilkan gambar produk dari database -->
                    <img src="../gambar/image-produk/<?php echo htmlspecialchars($produk['GAMBAR']); ?>" alt="...">
                </div>
            </div>

            <div class="DESKRIPSI-column">
                <!-- Judul PRODUK -->
                <div class="judul">
                    <!-- Tampilkan judul produk dari database -->
                    <h1><?php echo htmlspecialchars($produk['NAMA_PRODUK']); ?></h1>
                </div>
                <!-- Isi PRODUK -->
                <div class="DESKRIPSI-isi">
                    <h3>DESKRIPSI</h3>
                    <h4> <?php echo $produk['DESKRIPSI']; ?></h4>
                </div>
                <div class="DESKRIPSI-isi">
                    <!-- Tampilkan harga produk dari database -->
                    <h4> RP. <?php echo htmlspecialchars($produk['HARGA_PRODUK']); ?> </h4>
                </div>
                <!-- Tombol detail -->
                <div class="tombol">
                    <!-- Tautan untuk menambahkan produk ke keranjang -->
                    <a href="6-add-to-cart.php?ID=<?php echo $produk['ID']; ?>" class="klik">PESAN<i
                            class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>

        </main>

    </div>
    <?php require "9-slide-gambar-footer.php"; ?>

    <?php require "7-footer.php"; ?>
    <script src="../JS/slide-gambar-footer.js"></script>
</body>

</html>