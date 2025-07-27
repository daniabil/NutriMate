<?php
require '../../helper/connection.php';
session_start();

$id_pengguna = $_SESSION['login']['id_pengguna'] ?? 0;

$query = $conn->prepare("SELECT id_jadwal, judul, tanggal, warna FROM jadwal WHERE id_pengguna = ?");
$query->bind_param("i", $id_pengguna);
$query->execute();
$result = $query->get_result();

//TODO : Fungsi untuk mendapatkan warna kontras 
function getContrastColor($hexColor) {
    // Hapus tanda #
    $hex = ltrim($hexColor, '#');

    // Pecah menjadi RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Hitung luminance
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b);

    // Jika gelap, return putih, jika terang return hitam
    return ($luminance > 186) ? '#000000' : '#ffffff';
}


//TODO : untuk mengedit events dari kalender 
$events = [];
while ($row = $result->fetch_assoc()) {
  $events[] = [
    'id' => $row['id_jadwal'],            // ✅ Tambahkan ini
    'title' => $row['judul'],
    'start' => $row['tanggal'],
    'color' => $row['warna'],
    'textColor' => getContrastColor($row['warna']),
  ];
}

header('Content-Type: application/json');
echo json_encode($events);
