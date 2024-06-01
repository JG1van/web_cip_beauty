<?php
// Memulai sesi PHP
session_start();
// Memeriksa apakah pengguna telah masuk sebagai admin. Jika tidak, arahkan kembali ke halaman login atau halaman lainnya
if (!isset($_SESSION['loggedin_admin']) || $_SESSION['loggedin_admin'] !== true) {
  header('Location: ../../customers/login-jonathan/isi/');
  exit;
}


require "1-koneksi.php";

$id = $_GET['id'];

$query = mysqli_prepare($con, "SELECT * FROM produk WHERE ID=?");
mysqli_stmt_bind_param($query, 'i', $id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$data = mysqli_fetch_array($result);

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Input-Produk||Detail</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css" />
</head>

<style>
  /* Mengimpor font Spartan dari Google Fonts */
  @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");

  /* Styling default untuk semua elemen */
  * {
    margin: 0;
    /* Menghilangkan margin */
    padding: 0;
    /* Menghilangkan padding */
    box-sizing: border-box;
    /* Mengatur box model menjadi border-box */
  }

  /* Styling untuk bagian dengan padding */
  .section-p1 {
    padding: 40px 80px;
    /* Padding atas-bawah 40px, kiri-kanan 80px */
  }

  /* Styling untuk bagian dengan margin */
  .section-m1 {
    margin: 40px 0;
    /* Margin atas-bawah 40px */
  }

  /* Styling untuk body */
  body {
    width: 100%;
    /* Lebar body 100% */
    font-family: "Spartan", sans-serif;
    /* Menggunakan font Spartan dari Google Fonts */
  }

  /* Header Start */
  #header {
    display: flex;
    /* Menjadikan header sebagai flex container */
    align-items: center;
    /* Menengahkan item secara vertikal */
    justify-content: space-between;
    /* Menyebar item dengan jarak di antara mereka */
    padding: 20px 80px;
    /* Padding atas-bawah 20px, kiri-kanan 80px */
    background: #fed7dd;
    /* Warna latar belakang pink */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
    /* Bayangan dengan blur */
    z-index: 999;
    /* Memastikan header berada di atas elemen lain */
    position: sticky;
    /* Header tetap di atas saat di-scroll */
    top: 0;
    /* Posisi atas 0 */
    left: 0;
    /* Posisi kiri 0 */
  }

  /* Navbar */
  #navbar {
    display: flex;
    /* Menjadikan navbar sebagai flex container */
    align-items: center;
    /* Menengahkan item secara vertikal */
    justify-content: center;
    /* Menengahkan item secara horizontal */
  }

  /* List item di navbar */
  #navbar li {
    list-style: none;
    /* Menghilangkan bullet points */
    padding: 0 20px;
    /* Padding kiri-kanan 20px */
    position: relative;
    /* Untuk positioning pseudo-elemen */
  }

  /* Link di navbar */
  #navbar li a {
    text-decoration: none;
    /* Menghilangkan garis bawah teks */
    font-size: 16px;
    /* Ukuran font 16px */
    font-weight: 600;
    /* Ketebalan font 600 */
    color: #1a1a1a;
    /* Warna teks hitam */
    transition: 0.3s ease;
    /* Transisi halus */
  }

  /* Hover dan active state untuk link di navbar */
  #navbar li a:hover,
  #navbar li a.active {
    color: #1a1a1a;
    /* Warna teks hitam */
  }

  /* Pseudo-elemen setelah link di navbar saat hover atau active */
  #navbar li a.active::after,
  #navbar li a:hover::after {
    content: "";
    /* Konten kosong */
    width: 30%;
    /* Lebar 30% */
    height: 2px;
    /* Tinggi 2px */
    background: #fff;
    /* Warna latar belakang putih */
    position: absolute;
    /* Posisi absolut */
    bottom: -4px;
    /* Jarak 4px dari bawah */
    left: 20px;
    /* Jarak 20px dari kiri */
  }

  /* Styling untuk gambar di header */
  #header img {
    border-radius: 50%;
    /* Membuat gambar menjadi lingkaran */
  }
</style>

<body>
  <section id="header">
    <!-- Tautan dengan logo -->
    <a href="../">
      <!-- Gambar logo dengan lebar dan tinggi 80px -->
      <img src="../logo.png" width="80" height="80" class="Logo" alt="Your Logo" />
    </a>
    <div>
      <!-- Daftar navigasi -->
      <ul id="navbar">
        <!-- Tautan ke halaman Home -->
        <li><a href="../admin-home-nasa">Home</a></li>
        <!-- Tautan ke halaman Produk -->
        <li><a class="active" href="../admin-produk-jonathan/0-Produk-input.php">Produk</a></li>
        <!-- Tautan ke halaman Treatments -->
        <li><a href="../admin-treatments-mersi/">Treatments</a></li>
        <!-- Tautan ke halaman About Us -->
        <li><a href="../admin-about-us-handa/">About Us</a></li>
        <!-- Tautan ke halaman Contact Us -->
        <li><a href="../admin-contact-us/">Contact Us</a></li>
      </ul>
    </div>
  </section>

  <div class="container mt-5 p-5 align-items-center border border-dark rounded-4">
    <h2>DETAIL PRODUK</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
          value="<?php echo htmlspecialchars($data['NAMA_PRODUK']); ?>" required />
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" name="harga"
          value="<?php echo htmlspecialchars($data['HARGA_PRODUK']); ?>" required />
      </div>
      <div class="card p-2 mb-3">
        <div>
          <label for="currentfoto">Foto produk sekarang</label>
        </div>
        <div>
          <img
            src="../../customers/produk-jonathan/gambar/image-produk/<?php echo htmlspecialchars($data['GAMBAR']); ?>"
            alt="" width="300px" />
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar</label>
          <input type="file" name="gambar" id="gambar" class="form-control" />
        </div>
      </div>
      <div class="mb-3">
        <label for="current-slide-gambar">Slide gambar sekarang</label>
        <div>
          <img
            src="../../customers/produk-jonathan/gambar/slide-gambar/<?php echo htmlspecialchars($data['SLIDE-GAMBAR']); ?>"
            alt="" width="300px" />
        </div>

        <label for="slide-gambar" class="form-label">Slide Gambar</label>
        <input type="file" name="slide_gambar[]" id="slide-gambar" class="form-control" multiple />
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"
          class="form-control"><?php echo htmlspecialchars($data['DESKRIPSI']); ?></textarea>
      </div>
      <div class="mb-3 d-flex justify-content-between">
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
      </div>
    </form>
    <script src="../ckeditor/ckeditor.js"></script>
    <script>
      CKEDITOR.replace("deskripsi");
    </script>
    <?php
    if (isset($_POST['simpan'])) {
      $nama = htmlspecialchars($_POST['nama']);
      $harga = htmlspecialchars($_POST['harga']);
      $deskripsi = $_POST['deskripsi'];

      // Bagian Pemrosesan Gambar Utama
      $target_dir = "../../customers/produk-jonathan/gambar/image-produk/";
      $new_name = $data['GAMBAR']; // Default, jika tidak ada perubahan gambar
    
      if (!empty($_FILES['gambar']['name'])) {
        $nama_file = basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $image_size = $_FILES['gambar']['size'];
        $random_name = generateRandomString(20);
        $new_name = $random_name . "." . $imageFileType;

        if ($image_size > 6000000) {
          echo '<div class="alert alert-danger" role="alert">File tidak boleh lebih dari 6mb.</div>';
        } elseif (!in_array($imageFileType, ['jpg', 'png', 'gif'])) {
          echo '<div class="alert alert-danger" role="alert">File wajib bertipe jpg, png, atau gif.</div>';
        } else {
          if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name)) {
            echo '<div class="alert alert-danger" role="alert">Gagal mengunggah gambar utama.</div>';
          }
        }
      }

      // Bagian Pemrosesan Slide Gambar
      $target_dir_slide = "../../customers/produk-jonathan/gambar/slide-gambar/";
      $slide_images = explode(',', $data['SLIDE-GAMBAR']); // Default, jika tidak ada perubahan gambar slide
    
      if (!empty($_FILES['slide_gambar']['name'][0])) {
        $slide_gambar = $_FILES['slide_gambar'];
        $slide_images = [];

        foreach ($slide_gambar['name'] as $key => $slide_name) {
          $slide_tmp_name = $slide_gambar['tmp_name'][$key];
          $slide_size = $slide_gambar['size'][$key];
          $slide_imageFileType = strtolower(pathinfo($slide_name, PATHINFO_EXTENSION));
          $slide_random_name = generateRandomString(20);
          $slide_new_name = $slide_random_name . "." . $slide_imageFileType;

          if ($slide_size > 6000000 || !in_array($slide_imageFileType, ['jpg', 'png', 'gif'])) {
            echo '<div class="alert alert-danger" role="alert">Slide gambar wajib bertipe jpg, png, atau gif dan tidak boleh lebih dari 6mb.</div>';
            $slide_images = explode(',', $data['SLIDE-GAMBAR']); // Kembalikan ke nilai default
            break;
          }

          if (!move_uploaded_file($slide_tmp_name, $target_dir_slide . $slide_new_name)) {
            echo '<div class="alert alert-danger" role="alert">Gagal mengunggah slide gambar.</div>';
            $slide_images = explode(',', $data['SLIDE-GAMBAR']); // Kembalikan ke nilai default
            break;
          }

          $slide_images[] = $slide_new_name;
        }
      }

      $slide_images_str = implode(',', $slide_images);
      $queryupdate = mysqli_prepare($con, "UPDATE produk SET NAMA_PRODUK=?, HARGA_PRODUK=?, GAMBAR=?, DESKRIPSI=?, `SLIDE-GAMBAR`=? WHERE ID=?");
      mysqli_stmt_bind_param($queryupdate, 'sssssi', $nama, $harga, $new_name, $deskripsi, $slide_images_str, $id);

      $result = mysqli_stmt_execute($queryupdate);

      if ($result) {
        echo '<div class="alert alert-success" role="alert">Data berhasil diperbarui.</div>';
        echo '<meta http-equiv="refresh" content="5; url=0-produk-input.php" />';
      } else {
        echo mysqli_error($con);
      }
    }

    if (isset($_POST['hapus'])) {
      $queryhapus = mysqli_prepare($con, "DELETE FROM produk WHERE ID=?");
      mysqli_stmt_bind_param($queryhapus, 'i', $id);
      $result = mysqli_stmt_execute($queryhapus);

      if ($result) {
        echo '<div class="alert alert-success" role="alert">Data berhasil dihapus.</div>';
        echo '<meta http-equiv="refresh" content="5; url=0-produk-input.php" />';
      } else {
        echo mysqli_error($con);
      }
    }
    ?>
  </div>

  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>