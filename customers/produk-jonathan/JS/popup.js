// Mendapatkan elemen
var popup = document.getElementById("popupBox"); // Mendapatkan elemen popup
var btn = document.getElementById("openPopup"); // Mendapatkan elemen tombol yang membuka popup
var span = document.querySelector(".close"); // Mendapatkan elemen tombol close (X)

// Set timeout untuk menutup popup setelah 3 detik
if (popup) {
  setTimeout(function () {
    popup.style.display = "none"; // Menyembunyikan popup dengan mengubah display menjadi none
  }, 10000);
}

// Ketika pengguna mengklik tombol close (X), tutup popup
if (span) {
  span.addEventListener("click", function () {
    popup.style.display = "none"; // Menyembunyikan popup dengan mengubah display menjadi none
  });
}

// Ketika pengguna mengklik di luar popup, tutup popup
window.addEventListener("click", function (event) {
  if (event.target === popup) {
    // Memeriksa apakah yang diklik adalah popup itu sendiri
    popup.style.display = "none"; // Menyembunyikan popup jika yang diklik adalah di luar popup
  }
});
