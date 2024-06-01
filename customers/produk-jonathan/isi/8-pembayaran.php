<?php
// Mulai sesi PHP
session_start();

// Jika pengguna tidak masuk, redirect ke halaman login...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../login-jonathan/isi/');
    exit;
}
// Fungsi untuk menghasilkan string acak
function generateRandomString($length = 10)
{
    $characters = '0123455789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Menggunakan file koneksi.php untuk menghubungkan ke database
require "1-koneksi.php";

// Mengambil ID transaksi dari parameter URL
$id_transaksi = htmlspecialchars($_GET['id_transaksi']);

// Menyiapkan query untuk mengambil data transaksi dari database
$querypembayaran = mysqli_prepare($con, "
SELECT 
        transaksi.ID_TRANSAKSI,
        accounts.username AS Nama_Pengguna,
        accounts.email AS Email,
        accounts.id AS ID,
        produk.NAMA_PRODUK,
        produk.HARGA_PRODUK,
        produk.GAMBAR,
        produk.ID AS ID_PRODUK
    FROM 
        transaksi
    LEFT JOIN 
        accounts ON transaksi.ID_USERS = accounts.id
    LEFT JOIN 
        produk ON transaksi.ID_PRODUK = produk.ID
    WHERE 
        transaksi.ID_TRANSAKSI = ?
");
mysqli_stmt_bind_param($querypembayaran, 's', $id_transaksi);
mysqli_stmt_execute($querypembayaran);
mysqli_stmt_bind_result($querypembayaran, $id_transaksi, $nama_pengguna, $email, $id, $nama_produk, $harga_produk, $gambar, $id_produk);
mysqli_stmt_fetch($querypembayaran);
mysqli_stmt_close($querypembayaran);

// Membuat ID pembayaran baru
$query_max_id_pembayaran = mysqli_query($con, "SELECT MAX(ID_PEMBAYARAN) AS max_id FROM pembayaran");
if ($query_max_id_pembayaran) {
    $row = mysqli_fetch_assoc($query_max_id_pembayaran);
    $max_id = $row['max_id'];

    // Memeriksa apakah max_id null atau tidak (jika tidak ada pembayaran sebelumnya)
    if ($max_id) {
        // Memisahkan bagian numerik dari ID_PEMBAYARAN
        $num_part = (int) substr($max_id, 1);
        // Membuat ID pembayaran baru dengan format P00001
        $id_pembayaran = "P" . str_pad($num_part + 1, 5, "0", STR_PAD_LEFT);
    } else {
        // Jika tidak ada pembayaran sebelumnya, mulai dengan P00001
        $id_pembayaran = "P00001";
    }
}

// Simpan data pembayaran jika formulir dikirim
if (isset($_POST['simpan'])) {
    $alamat = htmlspecialchars($_POST['alamat']);
    $jumlah = intval($_POST['jumlah']); // Konversi menjadi integer
    $telepon = htmlspecialchars($_POST['telepon']); // Nomor telepon

    // Validasi data
    if (empty($alamat) || empty($jumlah) || empty($_FILES["gambar"]["name"]) || empty($telepon)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Upload file gambar jika diperlukan
        $target_dir = "../gambar/pembayaran/";
        $nama_file = basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $image_size = $_FILES['gambar']['size'];
        $random_name = generateRandomString(20);
        $new_name = $random_name . "." . $imageFileType;

        if ($image_size > 5000000) {
            echo '<div class="alert alert-danger" role="alert">File tidak boleh lebih dari 5mb.</div>';
        } elseif (!in_array($imageFileType, array('jpg', 'png', 'gif'))) {
            echo '<div class="alert alert-danger" role="alert">File wajib bertipe jpg, png, atau gif</div>';
        } elseif (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name)) {
            echo '<div class="alert alert-danger" role="alert">Gagal mengunggah file.</div>';
        } else {
            // Simpan data ke database
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date("Y-m-d H:i:s"); // Tanggal dan waktu saat ini

            $query = mysqli_prepare($con, "INSERT INTO pembayaran (ID_PEMBAYARAN, ID_USERS, ID_PRODUK, TANGGGAL, ALAMAT, JUMLAH, BUKTI_PEMBAYARAN, TELEPON) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($query, 'ssssssss', $id_pembayaran, $id, $id_produk, $tanggal, $alamat, $jumlah, $new_name, $telepon);
            $result = mysqli_stmt_execute($query);

            if ($result) {
                // Hapus data transaksi
                $query_delete_transaksi = mysqli_query($con, "DELETE FROM transaksi WHERE ID_TRANSAKSI = '$id_transaksi'");
                if ($query_delete_transaksi) {
                    echo "Data transaksi berhasil dihapus.";
                } else {
                    echo "Gagal menghapus data transaksi: " . mysqli_error($con);
                }

                // Redirect setelah menyimpan data pembayaran dan menghapus data transaksi
                header("Location:../../produk-jonathan/isi/");
                exit(); // Exit untuk menghentikan eksekusi skrip setelah redirect
            } else {
                echo "Gagal menyimpan data pembayaran: " . mysqli_error($con);
            }

            mysqli_stmt_close($query);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/5-styles-pembayaran.css">
</head>

<body>
    <div class="Kotak-luar">
        <div class="judul">
            <h2>DETAIL PEMBAYARAN</h2>
        </div>
        <main>
            <div class="isi-column">
                <div class="isi-1">
                    <h1>ID Transaksi: <?= htmlspecialchars($id_transaksi) ?></h1>
                    <h3>ID Pengguna: <?= htmlspecialchars($id) ?></h3>
                    <h3>Nama Pengguna: <?= htmlspecialchars($nama_pengguna) ?></h3>
                    <h3>Email: <?= htmlspecialchars($email) ?></h3>
                    <h3>Nama Produk: <?= htmlspecialchars($nama_produk) ?></h3>

                    <div class="GAMABAR-gambar">
                        <img src="../gambar/image-produk/<?= htmlspecialchars($gambar) ?>" alt="">
                    </div>
                    <h3>Harga Produk: RP. <?= htmlspecialchars($harga_produk) ?></h3>
                </div>
            </div>
            <div class="isi-column">
                <div class="isi-2">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <label>
                                <h2>Alamat</h2>
                            </label>
                            <textarea name="alamat" autocomplete="off" required></textarea>
                        </div>
                        <div>
                            <label>
                                <h2>Jumlah</h2>
                            </label>
                            <input type="number" name="jumlah" required />
                        </div>
                        <div>
                            <label>
                                <h2>Nomor Telepon</h2>
                            </label>
                            <input type="tel" name="telepon" required />
                        </div>
                        <div class="GAMABAR-gambar">
                            <h2>Barcode Qris</h2>
                            <img src="../gambar/qris.jpeg" alt="">
                        </div>
                        <div>
                            <label>
                                <h2>Bukti Transfer</h2>
                            </label>
                            <input type="file" name="gambar" required />
                        </div>
                        <div class="tombol">
                            <button type="submit" class="klik" name="simpan">SELESAI</button>
                        </div>
                    </form>

                </div>

            </div>

        </main>

    </div>
</body>

</html>