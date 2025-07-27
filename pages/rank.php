<?php
//TODO: PAGE SCOREBOARD DASHBOARD




$host = "localhost";
$user = "root";
$pass = "";
$db = "todolist";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "
  SELECT 
    p.id_rank,
    u.nama,
    p.liga,
    p.emoji,
    p.exp
  FROM 
    peringkat p
  JOIN 
    pengguna u ON p.id_pengguna = u.id_pengguna
  ORDER BY 
    p.exp DESC
  LIMIT 10
";
$result = $conn->query($sql);

?>
<div class="classContainer d-flex gap-4">
<div class="score" style="width: 70%;">
<div class="text-center mb-4">
    <img src="../assets/images/dashboard/gold.png" alt="Liga Emas" width="60" height="60" class="mb-2">
    <h3 class="fw-bold">LIGA EMAS</h3>
    <p class="mb-3">Selesaikan satu aktivitas untuk bergabung di papan skor minggu ini</p>
    <button class="btn btn-warning btn-sm">Mulai Aktivitas</button>
  </div>

   <div class="">
    <div class="list-group">
      <?php if ($result->num_rows > 0): ?>
        <?php $rank = 1; ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <?php if ($rank == 1): ?>
                <img src="../assets/images/dashboard/juara1.png" alt="1" width="24" height="24" class="me-2">
              <?php elseif ($rank == 2): ?>
                <img src="../assets/images/dashboard/juara2.png" alt="2" width="24" height="24" class="me-2">
              <?php elseif ($rank == 3): ?>
                <img src="../assets/images/dashboard/juara3.png" alt="3" width="24" height="24" class="me-2">
              <?php else: ?>
                <span class="badge bg-secondary me-2"><?= $rank ?></span>
              <?php endif; ?>
              <span class="fw-medium"><?= htmlspecialchars($row['nama']) ?></span>
            </div>
            <span class="fw-bold"><?= $row['exp'] ?> XP</span>
          </div>
          <?php $rank++; ?>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center">Belum ada peserta.</p>
      <?php endif; ?>
    </div>
  </div>

</div>
  
  <div class="sideSection" style="width: 30%;">
    <?php include 'sectionSide/streak.php'; ?>
    <?php include "sectionSide/cardTugas.php" ?>
  </div>
</div>
