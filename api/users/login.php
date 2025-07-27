<?php
session_start();
require_once '../helper/connection.php';

// Menyimpan pesan error jika login gagal. Default-nya false (tidak ada error).
$error = false;

// Mengecek apakah form dikirimkan dengan metode POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Pastikan field email dan password terisi
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM pengguna WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        // Verifikasi password tanpa hash
        if ($password === $row['password']) {
          $_SESSION['login'] = $row;
          header('Location: ../dashboard/index.php');
          exit;
        } else {
          $error = "Password salah!";
        }
      } else {
        $error = "Email tidak ditemukan!";
      }

      mysqli_stmt_close($stmt);
    } else {
      $error = "Gagal menyiapkan statement!";
    }
  } else {
    $error = "Email dan password wajib diisi!";
  }
}
?>
