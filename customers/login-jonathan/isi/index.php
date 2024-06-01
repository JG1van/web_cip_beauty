<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8" />
  <!-- Menentukan set karakter sebagai UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Memastikan tampilan responsif -->
  <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css" />
  <!-- Menyertakan FontAwesome CSS -->
  <link rel="stylesheet" href="../CSS/1-styles-login.css" />
  <!-- Menyertakan CSS untuk halaman login -->
  <!-- Sertakan file CSS -->
  <link rel="stylesheet" href="4-popup.css">
  <!-- Sertakan file JavaScript -->
  <script src="../JS/popup.js"></script>
</head>

<body>
  <div class="section">
    <!-- Membungkus seluruh konten halaman -->
    <div class="full-height">
      <!-- Mengatur konten agar penuh tinggi halaman dan rata tengah -->
      <div class="text-center">
        <!-- Mengatur teks agar rata tengah -->
        <div class="section">
          <!-- Membungkus konten bagian dalam -->
          <h3 class="slide">
            <span>SIGN-IN </span><span>SING-UP</span>
            <!-- Tombol Log In dan Sign Up -->
          </h3>
          <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
          <!-- Checkbox untuk mengubah tampilan antara login dan sign up -->
          <label for="reg-log"></label>
          <!-- Label untuk checkbox -->

          <div class="card-3d-wrap">
            <!-- Membungkus kartu 3D -->
            <div class="card-3d-wrapper">
              <!-- Pembungkus lapisan kartu 3D -->

              <div class="card-front">
                <!-- Bagian depan kartu (Login) -->
                <div class="center-wrap">
                  <!-- Pembungkus konten tengah -->
                  <div class="login">
                    <h1>Login</h1>
                    <!-- Judul bagian login -->
                    <form action="3-authenticate.php" method="post">
                      <!-- Form untuk login -->
                      <!-- Label dan input untuk username -->
                      <label for="username">
                        <i class="fa-solid fa-user"></i>
                        <!-- Ikon pengguna -->
                      </label>
                      <input type="text" name="username" placeholder="Username" required />
                      <!-- Input username -->

                      <!-- Label dan input untuk password -->
                      <label for="password">
                        <i class="fa-solid fa-lock"></i>
                        <!-- Ikon kunci -->
                      </label>
                      <input type="password" name="password" placeholder="Password" required />
                      <!-- Input password -->

                      <!-- Tombol untuk mengirimkan data login -->
                      <input type="submit" value="SING IN" />
                    </form>
                  </div>
                </div>
              </div>

              <div class="card-back">
                <!-- Bagian belakang kartu (Sign Up) -->
                <div class="center-wrap">
                  <!-- Pembungkus konten tengah -->
                  <div class="login">
                    <h1>Sign Up</h1>
                    <!-- Judul bagian sign up -->
                    <form action="2-register.php" method="post">
                      <!-- Form untuk sign up -->

                      <!-- Label dan input untuk username -->
                      <label for="username">
                        <i class="fa-solid fa-user"></i>
                        <!-- Ikon pengguna -->
                      </label>
                      <input type="text" name="username" placeholder="Your Name" id="username" required />
                      <!-- Input username -->

                      <!-- Label dan input untuk email -->
                      <label for="email">
                        <i class="fa-solid fa-envelope"></i>
                        <!-- Ikon email -->
                      </label>
                      <input type="text" name="email" placeholder="Your Email" id="email" required />
                      <!-- Input email -->

                      <!-- Label dan input untuk password -->
                      <label for="password">
                        <i class="fa-solid fa-lock"></i>
                        <!-- Ikon kunci -->
                      </label>
                      <input type="password" name="password" placeholder="Your Password" id="password" required />
                      <!-- Input password -->

                      <!-- Tombol untuk mengirimkan data sign up -->
                      <input type="submit" value="SIGN UP" />
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>