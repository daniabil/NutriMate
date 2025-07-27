<?php
require '../../helper/connection.php'; // ✅ BENAR
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil dan validasi input
  $isi_tugas    = trim($_POST['isi_tugas'] ?? '');
  $dedline      = $_POST['dedline'] ?? '';
  $id_pengguna  = $_POST['id_pengguna'] ?? '';
  $tugas_dibuat = date('Y-m-d');

  if (!$isi_tugas || !$dedline || !$id_pengguna) {
    echo "Data tidak lengkap!";
    exit;
  }

  // Simpan ke database
  $stmt = $conn->prepare("INSERT INTO tugas (isi_tugas, dedline, tugas_dibuat, id_pengguna) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sssi", $isi_tugas, $dedline, $tugas_dibuat, $id_pengguna);

  if ($stmt->execute()) {
    $stmt->close();
    header("Location: ../index.php?page=tugas&success=add");
    exit;
  } else {
    echo "Gagal menyimpan: " . $stmt->error;
    exit;
  }
}
