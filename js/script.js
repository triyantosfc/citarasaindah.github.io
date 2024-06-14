// Toggle Class Aktiv
const navbarNav = document.querySelector(".navbar-nav");

// Toggle ketika humberger menu di klik
document.querySelector("#humberger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};
// klik di luar sidebar untuk menghilangkan nav
const humberger = document.querySelector("#humberger-menu");

document.addEventListener("click", function (e) {
  if (!humberger.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

function checkLogin(event) {
  // Cek apakah pengguna sudah login atau belum (misalnya, cek kondisi login di server atau menggunakan session)
  var isLoggedIn = false; // Ganti dengan kondisi login sesuai kebutuhan Anda

  if (!isLoggedIn) {
    // Pengguna belum login, tampilkan pesan peringatan
    event.preventDefault(); // Mencegah pengarahan ke halaman daftar.php

    var alertDiv = document.getElementById("loginAlert");
    alertDiv.style.display = "block";

    // Sembunyikan pesan peringatan setelah beberapa detik
    setTimeout(function () {
      alertDiv.style.display = "none";
    }, 3000); // 3000 milidetik (3 detik)

    // Anda juga dapat mengarahkan pengguna ke halaman login di sini
    // window.location.href = 'login.php';
  }
}
