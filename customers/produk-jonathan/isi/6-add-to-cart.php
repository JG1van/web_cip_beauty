<?php
// Memulai sesi PHP
session_start();

// Memeriksa apakah pengguna telah masuk. Jika tidak, arahkan kembali ke halaman login atau halaman lainnya
if (!isset($_SESSION['loggedin'])) {
    header('Location:../../login-jonathan/isi/');
    exit;
}

// Memeriksa apakah ID produk dikirimkan melalui parameter URL dan apakah nilainya valid
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    // Jika tidak ada ID produk yang valid, kembalikan pengguna ke halaman sebelumnya atau halaman utama
    // Tampilkan pesan kesalahan
    echo "Invalid product ID.";
    exit;
}

// Mengimpor file koneksi.php untuk menghubungkan ke database
require_once "1-koneksi.php";

$produk_id = htmlspecialchars($_GET['ID']);

// Mendapatkan ID pengguna dari sesi
$user_id = $_SESSION['id'];

// Memeriksa ID transaksi terakhir dari tabel transaksi
$query_max_id_transaksi = mysqli_query($con, "SELECT MAX(ID_TRANSAKSI) AS max_id FROM transaksi");
if ($query_max_id_transaksi) {
    $row = mysqli_fetch_assoc($query_max_id_transaksi);
    $max_id = $row['max_id'];

    // Memeriksa apakah max_id null atau tidak (jika tidak ada transaksi sebelumnya)
    if ($max_id) {
        // Memisahkan bagian numerik dari ID_TRANSAKSI
        $num_part = (int) substr($max_id, 1);
        // Membuat ID transaksi baru dengan format T00001
        $id_transaksi = "T" . str_pad($num_part + 1, 5, "0", STR_PAD_LEFT);
    } else {
        // Jika tidak ada transaksi sebelumnya, mulai dengan T00001
        $id_transaksi = "T00001";
    }

    // Menyiapkan query untuk memasukkan transaksi baru ke dalam tabel transaksi menggunakan prepared statement
    $query_insert_transaksi = "INSERT INTO transaksi (ID_TRANSAKSI, ID_USERS, ID_PRODUK) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query_insert_transaksi);

    // Mengeksekusi prepared statement untuk memasukkan transaksi baru
    if ($stmt) {
        // Membinding parameter
        mysqli_stmt_bind_param($stmt, "sii", $id_transaksi, $user_id, $produk_id);

        // Mengeksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            // Mengalihkan pengguna kembali ke halaman utama setelah checkout berhasil
            header('Location: index.php');
            exit;
        } else {
            // Jika terjadi kesalahan saat mengeksekusi pernyataan prepared, tampilkan pesan kesalahan
            echo "Maaf, terjadi kesalahan saat melakukan checkout. Silakan coba lagi nanti.";
        }
    } else {
        // Jika gagal menyiapkan pernyataan, tampilkan pesan kesalahan
        echo "Maaf, terjadi kesalahan saat memproses checkout. Silakan coba lagi nanti.";
    }

    // Menutup statement
    mysqli_stmt_close($stmt);
} else {
    // Jika gagal mendapatkan jumlah transaksi, tampilkan pesan kesalahan
    echo "Maaf, terjadi kesalahan saat memproses checkout. Silakan coba lagi nanti.";
}

// Menutup koneksi database
mysqli_close($con);
?>