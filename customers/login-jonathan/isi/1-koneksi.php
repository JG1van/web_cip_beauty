<?php
// Sambungkan ke database MySQL
$koneksi = mysqli_connect("localhost", "root", "", "web_cip_data");

// Periksa apakah terhubung ke database
if (mysqli_connect_errno()) {
  echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
  exit();
}
?>