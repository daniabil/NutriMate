<?php
require_once '../../helper/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil ID catatan dari input edit atau delete
  $id = $_POST['edit_id'] ?? $_POST['id_catatan'] ?? null;

  if (!$id) {
    echo "ID tidak ditemukan!";
    exit;
  }

  // ==== PROSES EDIT ====
  if (isset($_POST['update'])) {
    $judul = trim($_POST['judul']);
    $isi = trim($_POST['isi']);

    if (!empty($judul) && !empty($isi)) {
      $stmt = $conn->prepare("UPDATE catatan SET judul = ?, isi = ? WHERE id_catatan = ?");
      $stmt->bind_param("ssi", $judul, $isi, $id);

      if ($stmt->execute()) {
        header("Location: ../index.php?page=catatan&success=edit");
        exit();
      } else {
        echo "Gagal mengupdate catatan: " . $stmt->error;
      }
    } else {
      echo "Data tidak lengkap!";
    }

  // ==== PROSES DELETE ====
  } elseif (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM catatan WHERE id_catatan = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      header("Location: ../index.php?page=catatan&success=hapus");
      exit();
    } else {
      echo "Gagal menghapus catatan: " . $stmt->error;
    }

  } else {
    echo "Aksi tidak dikenali.";
  }

} else {
  echo "Metode tidak diizinkan.";
}
