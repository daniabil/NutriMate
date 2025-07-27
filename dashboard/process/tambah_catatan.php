<?php
require_once '../../helper/connection.php';
session_start();
$id_pengguna = $_SESSION['login']['id_pengguna'] ?? 0;
$tanggal = date('Y-m-d');

// Proses tambah catatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['judul'], $_POST['isi'])) {
  $judul = trim($_POST['judul']);
  $isi = trim($_POST['isi']);

  $stmt = $conn->prepare("INSERT INTO catatan (id_pengguna, judul, isi, catatan_dibuat) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isss", $id_pengguna, $judul, $isi, $tanggal);
  $stmt->execute();
  $stmt->close();

  header("Location: ../index.php?page=catatan&success=add");
  exit;
}

?>
