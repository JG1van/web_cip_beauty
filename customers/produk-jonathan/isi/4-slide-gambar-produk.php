<body>
    <div class="slider">
        <div class="list">
            <?php while ($data = mysqli_fetch_array($querygambar)) { ?>
                <div class="item">
                    <!-- Tampilkan gambar dari database -->
                    <img src="../gambar/slide-gambar/<?php echo htmlspecialchars($data['SLIDE-GAMBAR']); ?>" alt="">
                    <div class="content">
                        <!-- Tampilkan nama produk -->
                        <div class="title"><?php echo $data['NAMA_PRODUK']; ?></div>
                        <!-- Tampilkan harga produk -->
                        <div class="type">RP. <?php echo $data['HARGA_PRODUK']; ?></div>
                        <div class="button">
                            <!-- Tautan untuk melihat detail produk -->
                            <button><a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>">LIHAT <i
                                        class="fa-solid fa-magnifying-glass-plus"></i></a></button>
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
                    <img src="../gambar/slide-gambar/<?php echo htmlspecialchars($data['SLIDE-GAMBAR']); ?>" alt="">
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