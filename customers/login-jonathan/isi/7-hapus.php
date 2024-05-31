<?php
// Menggunakan file koneksi.php untuk menghubungkan ke database
require "1-koneksi.php";

// Memastikan ID transaksi diberikan sebagai parameter URL
if (isset($_GET['id_transaksi']) && !empty($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Menyiapkan query untuk menghapus transaksi berdasarkan ID
    $queryhapus = mysqli_prepare($koneksi, "DELETE FROM transaksi WHERE ID_TRANSAKSI = ?");
    if ($queryhapus) {
        // Mengikat parameter ID transaksi ke query
        mysqli_stmt_bind_param($queryhapus, 's', $id_transaksi);

        // Menjalankan query
        if (mysqli_stmt_execute($queryhapus)) {
            // Redirect kembali ke halaman profil setelah penghapusan dengan pesan sukses
            header('Location: 5-profil.php');
        } else {
            // Menampilkan pesan kesalahan jika gagal menjalankan query
            echo "Gagal menghapus transaksi: " . mysqli_error($koneksi);
        }

        // Menutup statement
        mysqli_stmt_close($queryhapus);
    } else {
        // Menampilkan pesan kesalahan jika gagal menyiapkan query
        echo "Gagal menyiapkan query: " . mysqli_error($koneksi);
    }
} else {
    // Menampilkan pesan kesalahan jika ID transaksi tidak valid
    echo "ID transaksi tidak valid.";
}

// Menutup koneksi ke database
mysqli_close($koneksi);

// Menghentikan eksekusi script
exit();
?>