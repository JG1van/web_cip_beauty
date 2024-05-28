<?php
// Membuat koneksi ke server MySQL
$con = mysqli_connect("localhost", "root", "", "web_cip_data");

// Memeriksa apakah koneksi berhasil
if (mysqli_connect_errno()) {
  // Menampilkan pesan kesalahan jika koneksi gagal
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  // Menghentikan eksekusi skrip PHP
  exit();
}
?>