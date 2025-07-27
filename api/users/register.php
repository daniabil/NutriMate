<?php
session_start();
require_once '../helper/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil dan validasi input
  $nama    = ($_POST['nama'] ?? '');
  $email      = $_POST['email'] ?? '';
  $password  = $_POST['password'] ?? '';

  if (!$nama || !$email || !$password) {
    echo "Data tidak lengkap!";
    exit;
  }

  // Simpan ke database
  $stmt = $conn->prepare("INSERT INTO pengguna(nama, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nama, $email, $password);

  if ($stmt->execute()) {
    $stmt->close();
    header("Location: ../index.html");
    exit;
  } else {
    echo "Gagal menyimpan: " . $stmt->error;
    exit;
  }
}
?>
