<?php
require_once '../../helper/connection.php';
session_start();

$id = $_POST['id'];
$id_pengguna = $_SESSION['login']['id_pengguna'];

if (isset($_POST['update'])) {
  $judul = trim($_POST['judul']);
  $tanggal = $_POST['tanggal'];

  $stmt = $conn->prepare("UPDATE jadwal SET judul = ?, tanggal = ? WHERE id_jadwal = ? AND id_pengguna = ?");
  $stmt->bind_param("ssii", $judul, $tanggal, $id, $id_pengguna);
  $stmt->execute();
  $stmt->close();
  header("Location: ../index.php?page=jadwal&success=edit");
}


if (isset($_POST['delete'])) {
  $stmt = $conn->prepare("DELETE FROM jadwal WHERE id_jadwal = ? AND id_pengguna = ?");
  $stmt->bind_param("ii", $id, $id_pengguna);
  $stmt->execute();
  $stmt->close();
  header("Location: ../index.php?page=jadwal&success=hapus");
}

exit;
