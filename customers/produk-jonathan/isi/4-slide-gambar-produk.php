<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Produk</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/your/style.css">
    <script src="path/to/your/script.js" defer></script>
</head>

<body>
    <div class="slider">
        <div class="list">
            <?php while ($data = mysqli_fetch_array($querygambar)) { ?>
                <div class="item">
                    <!-- Tampilkan gambar dari database sebagai tautan -->
                    <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>">
                        <img src="../gambar/slide-gambar/<?php echo htmlspecialchars($data['SLIDE-GAMBAR']); ?>" alt="">
                    </a>
                    <div class="content">
                        <!-- Tampilkan nama produk sebagai tautan -->
                        <div class="title">
                            <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>">
                                <?php echo htmlspecialchars($data['NAMA_PRODUK']); ?>
                            </a>
                        </div>
                        <!-- Tampilkan harga produk -->
                        <div class="type">RP. <?php echo htmlspecialchars($data['HARGA_PRODUK']); ?></div>
                        <div class="button">
                            <!-- Tautan untuk melihat detail produk -->
                            <button>
                                <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>">
                                    LIHAT <i class="fa fa-magnifying-glass-plus"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Thumbnail untuk slider -->
        <div class="thumbnail">
            <?php
            // Reset pointer untuk mengambil data gambar lagi untuk thumbnail
            mysqli_data_seek($querygambar, 0);
            while ($data = mysqli_fetch_array($querygambar)) { ?>
                <div class="item">
                    <!-- Tampilkan thumbnail gambar dari database -->
                    <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>">
                        <img src="../gambar/slide-gambar/<?php echo htmlspecialchars($data['SLIDE-GAMBAR']); ?>" alt="">
                    </a>
                </div>
            <?php } ?>
        </div>

        <!-- Tombol next dan previous -->
        <div class="nextPrevArrows">
            <button class="prev">&lt;</button>
            <button class="next">&gt;</button>
        </div>
    </div>
</body>

</html>