// Mendapatkan elemen
var popup = document.getElementById("popupBox"); // Mendapatkan elemen popup
var btn = document.getElementById("openPopup"); // Mendapatkan elemen tombol yang membuka popup
var span = document.querySelector(".close"); // Mendapatkan elemen tombol close (X)

// Ketika pengguna mengklik tombol, buka popup
btn.addEventListener("click", function () {
  popup.style.display = "block"; // Menampilkan popup dengan mengubah display menjadi block
});

// Ketika pengguna mengklik tombol close (X), tutup popup
span.addEventListener("click", function () {
  popup.style.display = "none"; // Menyembunyikan popup dengan mengubah display menjadi none
});

// Ketika pengguna mengklik di luar popup, tutup popup
window.addEventListener("click", function (event) {
  if (event.target === popup) {
    // Memeriksa apakah yang diklik adalah popup itu sendiri
    popup.style.display = "none"; // Menyembunyikan popup jika yang diklik adalah di luar popup
  }
});
