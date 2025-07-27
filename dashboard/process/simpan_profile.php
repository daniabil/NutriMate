<?php
require_once '../../helper/connection.php';
session_start();


$id_pengguna = $_POST['id_pengguna'] ?? 0;
$email = trim($_POST['email']);
$nama = trim($_POST['nama']);
$telepon = trim($_POST['telepon']);

// Validasi sederhana
if ($id_pengguna && $email && $nama && $telepon) {
  $stmt = $conn->prepare("UPDATE pengguna SET nama = ?, email = ?, telepon = ? WHERE id_pengguna = ?");
  $stmt->bind_param("sssi", $nama, $email, $telepon, $id_pengguna);

  if ($stmt->execute()) {
    $stmt->close();
    header("Location: ../index.php?page=profile&success=edit");
    exit();
  } else {
    header("Location: ../index.php?page=profile&error=gagalUpdate");
    exit();
  }
} else {
  header("Location: ../index.php?error=Data tidak lengkap");
  exit();
}
