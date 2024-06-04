<?php
session_start();
require_once '1-koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../login-jonathan/isi/');
    exit;
}

// Bersihkan dan validasi input dari URL
$id_transaksi = isset($_GET['id_transaksi']) ? htmlspecialchars($_GET['id_transaksi']) : null;

// Periksa koneksi
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

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

if (!$querypembayaran) {
    die("Query preparation failed: " . mysqli_error($con));
}

mysqli_stmt_bind_param($querypembayaran, 's', $id_transaksi);
mysqli_stmt_execute($querypembayaran);
mysqli_stmt_bind_result($querypembayaran, $id_transaksi, $nama_pengguna, $email, $id, $nama_produk, $harga_produk, $gambar, $id_produk);
mysqli_stmt_fetch($querypembayaran);
mysqli_stmt_close($querypembayaran);

// Setel zona waktu ke Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');

// Buat order ID

$snapToken = '';
if (isset($_POST['simpan'])) {
    require_once '../midtrans-php-master/Midtrans.php';

    Midtrans\Config::$serverKey = 'SB-Mid-server-v2p6YYQYMRx_7y2ClWDQX66o';
    Midtrans\Config::$isProduction = false;
    Midtrans\Config::$isSanitized = true;
    Midtrans\Config::$is3ds = true;
    $order_id = 'ID-ORDER-' . $id . '-' . $id_produk . '-' . $harga_produk * $_POST['jumlah'] . '||' . date("Ymd") . '-' . rand();
    $params = array(
        'transaction_details' => array(
            'order_id' => $order_id,
            'gross_amount' => $harga_produk * $_POST['jumlah'],
        ),
        'customer_details' => array(
            'first_name' => $nama_pengguna,
            'email' => $email,
            'phone' => $_POST['telepon'],
            'billing_address' => array(
                'address' => $_POST['alamat']
            ),

        ),
        'item_details' => array(
            array(
                'id' => $id_produk,
                'name' => $nama_produk,
                'price' => $harga_produk,
                'quantity' => $_POST['jumlah']
            )
        )
    );

    try {
        $snapToken = Midtrans\Snap::getSnapToken($params);
    } catch (Exception $e) {
        error_log($e->getMessage());
        $snapToken = 'Error creating transaction. Please try again.';
    }

    // Jika token berhasil dibuat, simpan data pembayaran ke database
    if (!strpos($snapToken, 'Error')) {
        $tanggal = date("Y-m-d H:i:s"); // Tanggal dan waktu saat ini
        $id_pembayaran = 'PAY-' . $order_id;
        $alamat = $_POST['alamat'];
        $jumlah = $_POST['jumlah'];
        $telepon = $_POST['telepon'];
        $total = $harga_produk * $jumlah;

        $query = mysqli_prepare($con, "INSERT INTO pembayaran (ID_PEMBAYARAN, ID_USERS, ID_PRODUK, TANGGAL, ALAMAT, JUMLAH, TOTAL, TELEPON) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($query, 'ssssssss', $id_pembayaran, $id, $id_produk, $tanggal, $alamat, $jumlah, $total, $telepon);

        if (!mysqli_stmt_execute($query)) {
            error_log('Error: ' . mysqli_stmt_error($query));
            die("Error: " . mysqli_stmt_error($query));
        }

        mysqli_stmt_close($query);

        // Hapus data transaksi dari tabel transaksi setelah pembayaran berhasil
        $queryHapusTransaksi = mysqli_prepare($con, "DELETE FROM transaksi WHERE ID_TRANSAKSI = ?");
        mysqli_stmt_bind_param($queryHapusTransaksi, 's', $id_transaksi);

        if (!mysqli_stmt_execute($queryHapusTransaksi)) {
            error_log('Error saat menghapus data transaksi: ' . mysqli_stmt_error($queryHapusTransaksi));
        }

        mysqli_stmt_close($queryHapusTransaksi);
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
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-L_OIEjkVBtbH0rSC"></script>
</head>

<body>
    <div class="Kotak-luar">
        <div class="judul">
            <h2>DETAIL PEMBAYARAN</h2>
        </div>
        <main>
            <div class="isi-column">
                <div class="isi-1">
                    <a class="close" href="../../login-jonathan/isi/5-profil.php">←</a><!-- Tombol close -->
                    <h1>ID Transaksi: <?= htmlspecialchars($id_transaksi) ?></h1>
                    <h3>ID Pengguna: <?= htmlspecialchars($id) ?></h3>
                    <h3>Nama Pengguna: <?= htmlspecialchars($nama_pengguna) ?></h3>
                    <h3>Email: <?= htmlspecialchars($email) ?></h3>
                    <h3>Nama Produk: <?= htmlspecialchars($nama_produk) ?></h3>
                    <div class="gambar">
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
                            <textarea name="alamat" autocomplete="off"></textarea>
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
                        <div class="tombol">
                            <button id="pay-button" type="submit" class="klik" name="simpan">SELESAI</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <?php if (!empty($snapToken) && strpos($snapToken, 'Error') === false): ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                window.snap.pay('<?= $snapToken ?>');
            });
        </script>
    <?php endif; ?>
</body>

</html>