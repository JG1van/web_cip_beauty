<?php
// Mulai sesi PHP
session_start();

// Jika pengguna tidak masuk, redirect ke halaman login...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../isi');
    exit;
}

require "1-koneksi.php"; // Memuat file koneksi database

// Persiapkan query untuk mendapatkan data profil pengguna
$queryprofil = mysqli_prepare($koneksi, "SELECT * FROM accounts WHERE id = ?");
mysqli_stmt_bind_param($queryprofil, 'i', $_SESSION['id']);
mysqli_stmt_execute($queryprofil);
mysqli_stmt_bind_result($queryprofil, $id, $username, $password, $email, $activation_code); // Mengikat kolom hasil ke variabel
mysqli_stmt_fetch($queryprofil); // Mengambil hasil query
mysqli_stmt_close($queryprofil);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/2-styles-profile.css">
    <link rel="stylesheet" href="../CSS/0-styles-navbar.css" />
    <link rel="stylesheet" href="../CSS/3-styles-footer.css" />
</head>

<body>
    <?php require "4-navbar.php"; ?>

    <div class="container">
        <div class="judul">
            <!-- Menampilkan judul "PROFILE" dengan tebal -->
            <h2>PROFILE</h2>
        </div>
        <main>
            <div class="isi-column">
                <div class="isi-1">
                    <p class="card-text">ID: <?= htmlspecialchars($id, ENT_QUOTES) ?></p>
                    <p class="card-text">Username: <?= htmlspecialchars($username, ENT_QUOTES) ?></p>
                    <p class="card-text">Password: <?= htmlspecialchars($password, ENT_QUOTES) ?></p>
                    <p class="card-text">Email: <?= htmlspecialchars($email, ENT_QUOTES) ?></p>
                </div>
            </div>

            <div class="isi-column">
                <?php
                // Dapatkan ID pengguna dari sesi (pastikan untuk membersihkan data input)
                $user_id = $_SESSION['id'];

                // Siapkan query untuk mendapatkan data transaksi berserta nama pengguna dan nama produk
                $query_transaksi = "
                SELECT 
                    t.ID_TRANSAKSI,
                    p.ID AS id_produk,
                    p.NAMA_PRODUK,
                    p.HARGA_PRODUK
                FROM 
                    transaksi t
                JOIN 
                    accounts a ON t.ID_USERS = a.id
                JOIN 
                    produk p ON t.ID_PRODUK = p.ID
                WHERE 
                    t.ID_USERS = ?
                ";
                $stmt_transaksi = mysqli_prepare($koneksi, $query_transaksi);

                // Eksekusi prepared statement untuk mendapatkan data transaksi
                if ($stmt_transaksi) {
                    // Binding parameter
                    mysqli_stmt_bind_param($stmt_transaksi, "i", $user_id);

                    // Eksekusi statement
                    if (mysqli_stmt_execute($stmt_transaksi)) {
                        // Dapatkan hasil query
                        $result = mysqli_stmt_get_result($stmt_transaksi);

                        // Periksa apakah ada transaksi
                        if (mysqli_num_rows($result) > 0) {
                            ?>
                            <h1><i class="fa-solid fa-cart-shopping"></i> Keranjang Anda:</h1>
                            <div class='isi-2'>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>ID Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Pembayaran</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['ID_TRANSAKSI']) ?></td>
                                                <td><?= htmlspecialchars($row['id_produk']) ?></td>
                                                <td><?= htmlspecialchars($row['NAMA_PRODUK']) ?></td>
                                                <td><?= htmlspecialchars($row['HARGA_PRODUK']) ?></td>
                                                <td>
                                                    <a href="../../produk-jonathan/isi/8-pembayaran.php?id_transaksi=<?php echo $row['ID_TRANSAKSI']; ?>"
                                                        class="klik"><i class="fa-solid fa-circle-dollar-to-slot"></i></a>

                                                </td>
                                                <td>
                                                    <a href="7-hapus.php?id_transaksi=<?= htmlspecialchars($row['ID_TRANSAKSI']) ?>"
                                                        class="klik"><i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            echo "Belum ada transaksi.";
                        }
                    } else {
                        // Jika terjadi kesalahan saat eksekusi pernyataan prepared, tampilkan pesan kesalahan yang spesifik
                        echo "Maaf, terjadi kesalahan saat mengambil data transaksi: " . mysqli_error($koneksi);
                    }

                    // Tutup statement
                    mysqli_stmt_close($stmt_transaksi);
                } else {
                    // Jika gagal menyiapkan pernyataan, tampilkan pesan kesalahan yang spesifik
                    echo "Maaf, terjadi kesalahansaat memproses data transaksi.";
                }
                ?>
            </div>
            <div class=" isi-column">
                <?php
                // Persiapkan query untuk mendapatkan data pembayaran
                $query_pembayaran = "
                SELECT 
                pb.ID_PEMBAYARAN,
                pb.TANGGGAL,
                pb.ALAMAT,
                pb.JUMLAH,
                pb.TELEPON,
                pb.BUKTI_PEMBAYARAN,
                p.NAMA_PRODUK,
                p.HARGA_PRODUK
            FROM 
                pembayaran pb
            JOIN 
                produk p ON pb.ID_PRODUK = p.ID
            WHERE 
                pb.ID_USERS = ?
            ";

                $stmt_pembayaran = mysqli_prepare($koneksi, $query_pembayaran);

                // Eksekusi prepared statement untuk mendapatkan data pembayaran
                if ($stmt_pembayaran) {
                    // Binding parameter
                    mysqli_stmt_bind_param($stmt_pembayaran, "i", $user_id);

                    // Eksekusi statement
                    if (mysqli_stmt_execute($stmt_pembayaran)) {
                        // Dapatkan hasil query
                        $result_pembayaran = mysqli_stmt_get_result($stmt_pembayaran);

                        // Periksa apakah ada pembayaran
                        if (mysqli_num_rows($result_pembayaran) > 0) {
                            ?>
                            <h1><i class="fa-solid fa-money-bill-wave"></i> Data Pembayaran:</h1>
                            <div class='isi-2'>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Alamat</th>
                                            <th>Jumlah</th>
                                            <th>Telepon</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while (
                                            $row_pembayaran = mysqli_fetch_assoc
                                            ($result_pembayaran)
                                        ) {
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row_pembayaran['ID_PEMBAYARAN']) ?></td>
                                                <td><?= htmlspecialchars($row_pembayaran['TANGGGAL']) ?></td>
                                                <td><?= htmlspecialchars($row_pembayaran['ALAMAT']) ?></td>
                                                <td><?= htmlspecialchars($row_pembayaran['JUMLAH']) ?></td>
                                                <td><?= htmlspecialchars($row_pembayaran['TELEPON']) ?></td>
                                                <td><?= htmlspecialchars($row_pembayaran['NAMA_PRODUK']) ?></td>
                                                <td><?= htmlspecialchars($row_pembayaran['HARGA_PRODUK']) ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            echo "Belum ada data pembayaran.";
                        }
                    } else {
                        // Jika terjadi kesalahan saat eksekusi pernyataan prepared, tampilkan pesan kesalahan yang spesifik
                        echo "Maaf, terjadi kesalahan saat mengambil data pembayaran: " . mysqli_error($koneksi);
                    }

                    // Tutup statement
                    mysqli_stmt_close($stmt_pembayaran);
                } else {
                    // Jika gagal menyiapkan pernyataan, tampilkan pesan kesalahan yang spesifik
                    echo "Maaf, terjadi kesalahan saat memproses data pembayaran.";
                }

                // Tutup koneksi
                mysqli_close($koneksi);
                ?>
            </div>

            <div class="tombol">
                <a href="../../login-jonathan/isi/6-logout.php" class="klik">LOGOUT <i
                        class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </main>
    </div>
    <?php require "8-footer.php"; ?>
</body>

</html>