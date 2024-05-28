<?php
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

<body>
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