<?php
// require_once '../helper/auth.php';
require_once '../helper/connection.php';
// isLogin();

// Tangkap parameter ?page, default ke 'daily'
$page = isset($_GET['page']) ? $_GET['page'] : 'daily';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../assets/avatar/avatar.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link rel="stylesheet" href="../assets/css/scoreboard.css">
  <!-- FullCalendar JS -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
  <title>Dashboard ZetsuDoList testing</title>
</head>
<body>
  
<!-- Loader -->
<div id="loader-wrapper">
  <div class="spinner-border text-warning" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<div class="d-flex h-100 w-100">
  <!-- SIDEBAR -->
  <div class="sidebar-menu position-fixed h-100 " style="background-color: #3498DB;">
    <div class="title d-flex justify-content-center align-items-center m-3 pe-3 border-bottom pb-3">
      <img src="../assets/images/avatar/Blue_and_White_3D_Avatar_Profession_Group_Project_Presentation__21_x_35_cm_-removebg-preview.png" alt="" width="60px">
      <h4 class="text-white text-center"><span style="color: yellow;">N</span>utri<span style="color: rgb(235, 41, 102);">M</span>ate</h4>
    </div>
    <ul class="list-unstyled m-2 ">
      <li class="<?= $page === 'daily' ? 'active' : '' ?> pt-2 pb-2">
        <img src="../assets/images/dashboard/daily.png" alt="" width="40px">
        <a href="?page=daily" class="w-100">daily</a>
      </li>
      <li class="<?= $page === 'chat' ? 'active' : '' ?> pt-2 pb-2">
        <img src="../assets/images/dashboard/chatBot.png" alt="" width="40px">
        <a href="?page=chat" class="w-100">chat bot</a>
      </li>
      <li class="<?= $page === 'jurnal' ? 'active' : '' ?> pt-2 pb-2">
        <img src="../assets/images/dashboard/jurnal.png" alt="" width="40px">
        <a href="?page=jurnal" class="w-100">jurnal</a>
      </li>
      <li class="<?= $page === 'rank' ? 'active' : '' ?> pt-2 pb-2">
        <img src="../assets/images/dashboard/rank.png" alt="" width="40px">
        <a href="?page=rank" class="w-100">Scoreboard</a>
      </li>
      <li class="<?= $page === 'profil' ? 'active' : '' ?> pt-2 pb-2">
        <img src="../assets/images/dashboard/profile.png" alt="" width="40px">
        <a href="?page=profil" class="w-100">Profil</a>
      </li>
    </ul>
  </div>

  <!-- KONTEN UTAMA -->
  <div class="content">
    <?php
      switch ($page) {
        case 'daily':
          include '../pages/daily.php';
          break;

        case 'statistik':
          echo '<div id="statistik" class="section active d-flex gap-3">';

          // Calendar container
          echo '<div id="calendar" class="text-dark flex-grow-1"></div>';

          // Sidebar card daily (akan tampil di samping calendar)
          echo '<div class="card-daily">';
          include 'sectionSide/cardTugas.php';
          echo '</div>';

          echo '</div>';
          break;


        case 'chat':
          include '../pages/chat.php';
          break;

        case 'jurnal':
          include '../pages/jurnal.php';
          break;

        case 'rank':
          include '../pages/rank.php';
          break;

        case 'profil':
          include '../pages/profile.php';
          break;

        default:
          echo '<p>Halaman tidak ditemukan</p>';
          break;
      }
    ?>
  </div>
</div>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>



<!-- ALERT -->
<?php if (isset($_GET['success'])): ?>
<script>

  //? INI ADALAH ALERT SELESAI, EDIT, DAN HAPUS

  document.addEventListener("DOMContentLoaded", function () {
    <?php if ($_GET['success'] === 'edit'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Diedit! ✏️',
        text: 'Datamu sudah diperbarui dengan manis!',
        background: '#fffbe6',
        iconColor: '#ffc107',
        confirmButtonColor: '#ffc107'
      });
    <?php elseif ($_GET['success'] === 'selesai'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Tugasmu Sudah Selesai! 🎉',
        text: 'Selamat, kamu sudah menyelesaikan daily ini!',
        background: '#a7ddfa',
        iconColor: '#03a5fc',
        confirmButtonColor: '#03a5fc'
      });
    <?php elseif ($_GET['success'] === 'hapus'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Data Berhasil Dihapus! <i class="bi bi-trash"></i>',
        text: 'Datamu sudah pergi untuk selamanya...',
        background: '#fff0f0',
        iconColor: '#dc3545',
        confirmButtonColor: '#dc3545'
      });
    <?php elseif ($_GET['success'] === 'add'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Data Berhasil Ditambahkan! 📒',
        text: 'Data baru sudah tersimpan dengan rapi!',
        background: '#e9fce9',
        iconColor: '#28a745',
        confirmButtonColor: '#28a745'
      });
    <?php endif; ?>
  });
</script>
<?php endif; ?>


<script>

  //? INI ADALAH LOADER

  window.addEventListener("load", function () {
    const loader = document.getElementById("loader-wrapper");
    loader.style.display = "none";
  });
</script>

</body>
</html>
