<?php
require '../../helper/connection.php';
session_start();

$id_pengguna = $_POST['id_pengguna'];
$judul = trim($_POST['judul']);
$tanggal = $_POST['tanggal'];
$warna = $_POST['warna'];

if (!empty($judul) && !empty($tanggal) && !empty($id_pengguna) && !empty($warna)) {
  $stmt = $conn->prepare("INSERT INTO jadwal (id_pengguna, judul, tanggal, warna) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isss", $id_pengguna, $judul, $tanggal, $warna);
  $stmt->execute();
  $stmt->close();
}

header("Location: ../index.php?page=jadwal&success=add"); // Sesuaikan path halaman kamu
exit;
