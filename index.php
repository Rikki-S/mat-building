<?php
require 'connection.php';
// include 'login.php';
$sql = "SELECT namaBarang, stock, hargaOnline, gambar FROM barang";
$stmt = $pdo->query($sql);
$barangs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Mat Bilding</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link rel="icon" src="images/logomat.jpeg">
  <!-- <link rel="apple-touch-icon" src="images/logomat.jpeg" > -->

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css?v=<?php echo filemtime('assets/css/main.css'); ?>" rel="stylesheet">
  <link href="assets/css/custom.css?v=<?php echo filemtime('assets/css/custom.css'); ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Impact
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Updated: May 31 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<header id="header" class="header fixed-top mb-5">
  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <h1 class="sitename">Mat Bilding</h1>
        <span>.</span>
      </a>

      <!-- Navmenu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#services">Home</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- Notifikasi -->
      <div class="notification-container">
        <div class="notification-icon" onclick="toggleNotification()">
          <i class="bi bi-bell"></i> <!-- Ikon bell dari Bootstrap Icons -->
          <span class="notification-count">3</span> <!-- Jumlah notifikasi -->
        </div>

<!-- Kotak Notifikasi -->
<div class="notification-box" id="notificationBox">
  <div class="notification-header">
    <h5>Notifikasi</h5>
    <button onclick="markAllAsRead()">Tandai Sudah Dibaca</button>
  </div>
  <div class="notification-list">
    <!-- Notifikasi akan dimuat di sini oleh JavaScript -->
  </div>
</div>
      </div>
    </div>
  </div>
</header>
<main class="container" style="margin-top: 5.5em;">
  <h1 class="mt-5 mb-3">Daftar Barang</h1>
  <div class="container">
    <div class="row">
        <?php
        if (count($barangs) > 0) {
            // Output data dari setiap row
            foreach ($barangs as $row) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<img src='content/uploads/". htmlspecialchars($row['gambar'], ENT_QUOTES, 'UTF-8') . "' class='card-img-top img-fluid' alt='" . htmlspecialchars($row['namaBarang'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($row['namaBarang'], ENT_QUOTES, 'UTF-8') . "</h5>";
                echo "<p class='card-text'>Stock: " . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='card-text'>Harga Online: " . htmlspecialchars($row['hargaOnline'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='col-12'><p class='text-center'>Tidak ada data</p></div>";
        }
        ?>
    </div>
</div>

</main>
  <footer id="footer" class="footer">

  <style>
  .footer-top {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .row {
    width: 100%;
    display: flex;
    justify-content: center;
  }

  .footer-about {
    text-align: center; /* Memastikan teks di dalam footer-about berada di tengah */
  }

  .social-links {
    justify-content: center; /* Memastikan ikon media sosial berada di tengah */
  }
</style>

<style>
  .footer-about {
    display: flex;
    flex-direction: column; /* Mengatur tata letak secara vertikal */
    align-items: center; /* Memusatkan konten secara horizontal */
    text-align: center; /* Memastikan teks berada di tengah */
  }

  .social-links {
    display: flex;
    justify-content: center; /* Memusatkan ikon social link */
    gap: 10px; /* Memberikan jarak antara ikon */
    margin-top: 10px; /* Jarak antara tulisan "MAT BILDING" dan social link */
  }
</style>

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-about">
      <a href="index.html" class="logo">
        <span class="sitename">MAT BILDING</span>
      </a>
      <div class="social-links mt-4">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div>
</div>
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">PT Rajawali Bahan Bangunan</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/"> Me</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
<!-- Script lainnya -->
<script>
  // Fungsi untuk menampilkan/sembunyikan kotak notifikasi
  function toggleNotification() {
    const notificationBox = document.getElementById('notificationBox');
    if (notificationBox.style.display === 'block') {
      notificationBox.style.display = 'none';
    } else {
      notificationBox.style.display = 'block';
    }
  }

  // Fungsi untuk menandai semua notifikasi sebagai sudah dibaca
  function markAllAsRead() {
    const notificationCount = document.querySelector('.notification-count');
    notificationCount.textContent = '0';
    notificationCount.style.display = 'none'; // Sembunyikan badge notifikasi
    alert('Semua notifikasi telah ditandai sebagai sudah dibaca.');
  }

  // Tutup kotak notifikasi saat mengklik di luar kotak
  document.addEventListener('click', function(event) {
    const notificationBox = document.getElementById('notificationBox');
    const notificationIcon = document.querySelector('.notification-icon');
    if (!notificationBox.contains(event.target) && !notificationIcon.contains(event.target)) {
      notificationBox.style.display = 'none';
    }
  });

  // Ambil data notifikasi dari server
  function fetchNotifications() {
    fetch('get_notifications.php') // Ganti dengan endpoint Anda
      .then(response => response.json())
      .then(data => {
        const notificationList = document.querySelector('.notification-list');
        const notificationCount = document.querySelector('.notification-count');

        // Kosongkan daftar notifikasi
        notificationList.innerHTML = '';

        // Jika tidak ada notifikasi
        if (data.length === 0) {
          notificationList.innerHTML = '<div class="notification-item"><p>Tidak ada notifikasi.</p></div>';
          notificationCount.style.display = 'none'; // Sembunyikan badge notifikasi
          return;
        }

        // Tampilkan notifikasi
        data.forEach(notification => {
          const item = document.createElement('div');
          item.className = 'notification-item';
          item.innerHTML = `
            <p>Stok <strong>${notification.namaBarang}</strong> hampir habis (${notification.stock} unit).</p>
            <small>ID Barang: ${notification.id_barang}</small>
          `;
          notificationList.appendChild(item);
        });

        // Update jumlah notifikasi
        notificationCount.textContent = data.length;
        notificationCount.style.display = 'block'; // Tampilkan badge notifikasi
      })
      .catch(error => console.error('Error fetching notifications:', error));
  }

  // Panggil fungsi fetchNotifications saat halaman dimuat
  document.addEventListener('DOMContentLoaded', fetchNotifications);
</script>
</body>

</html>