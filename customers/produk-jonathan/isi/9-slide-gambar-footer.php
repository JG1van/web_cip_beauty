<div class="luar">
    <h1>PRODUK TERKAIT</h1>
    <div class="container scroll-1">
        <!-- Ini adalah container untuk semua kartu -->
        <?php while ($data = mysqli_fetch_array($querygambar)) { ?>
            <!-- Mulai loop untuk menampilkan data produk -->
            <div class="card">
                <!-- Kartu satu per satu -->
                <div class="card__image"
                    style="background-image: url('../gambar/slide-gambar/<?php echo htmlspecialchars($data['SLIDE-GAMBAR']); ?>');">
                    <!-- Gambar produk -->
                </div>
                <div class="card__content">
                    <div class="card__wave"></div>
                    <!-- Isi konten kartu -->
                    <span class="card__title">
                        <h1><?php echo htmlspecialchars($data['NAMA_PRODUK']); ?></h1>
                        <!-- Nama produk -->
                    </span>
                    <p class="card__describe">
                        RP. <?php echo htmlspecialchars($data['HARGA_PRODUK']); ?>
                        <!-- Harga produk -->
                    </p>
                    <div class="show-more">
                        <!-- Ikon "Show More" -->
                        <a href="5-detail.php?nama=<?php echo urlencode($data['NAMA_PRODUK']); ?>"><i
                                class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>