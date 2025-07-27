<!-- SECTION TO-DO LIST -->
<?php 
$id_pengguna = $_SESSION['login']['id_pengguna'] ?? null;

// ✅ Tangani aksi tombol hapus / selesai
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['hapus_id'])) {
    $hapus_id = $_POST['hapus_id'];
    $stmt = $conn->prepare("DELETE FROM tugas WHERE id_tugas = ? AND id_pengguna = ?");
    $stmt->bind_param("ii", $hapus_id, $id_pengguna);
    if ($stmt->execute()) {
      $stmt->close();
      header("Location: index.php?page=tugas&success=hapus");
      exit;
    } else {
      echo "Gagal menyimpan: " . $stmt->error;
      exit;
    }
  }

  if (isset($_POST['selesai_id'])) {
    $selesai_id = $_POST['selesai_id'];
    $stmt = $conn->prepare("UPDATE tugas SET status = 'selesai' WHERE id_tugas = ? AND id_pengguna = ?");
    $stmt->bind_param("ii", $selesai_id, $id_pengguna);
    if ($stmt->execute()) {
      $stmt->close();
      header("Location: index.php?page=tugas&success=selesai");
      exit;
    } else {
      echo "Gagal menyimpan: " . $stmt->error;
      exit;
    }
  }
}

$tugas = [];

if ($id_pengguna) {
  $query = $conn->prepare("SELECT * FROM tugas WHERE id_pengguna = ? ORDER BY 
  CASE 
    WHEN status = 'pending' THEN 0 
    WHEN status = 'selesai' THEN 1 
    ELSE 2 
  END,
  dedline ASC");
  $query->bind_param("i", $id_pengguna);
  $query->execute();
  $result = $query->get_result();

  while ($row = $result->fetch_assoc()) {
    $tugas[] = $row;
  }
}
?>

<section class="todo-section d-flex gap-4">
  <div class="todo-container " style="width: 70%;" >
    <!-- Form Tambah Tugas -->
    <form id="todo-form" action="process/tambah_tugas.php" method="POST">
      <div class="input-group bg-dark align-items-center gap-2 position-relative">
        <i class="bi bi-plus text-warning fw-bolder" style="font-size: 2rem"></i>

        <input
          type="text"
          name="isi_tugas"
          id="todo-input"
          class="border-0 bg-dark form-control text-white"
          placeholder="Tambah Aktivitas"
          required
        />

        <i class="bi bi-calendar3 text-warning" id="calendar-icon" style="font-size: 1.5rem; cursor: pointer;"></i>

        <!-- Input dedline (disembunyikan) -->
        <input
          type="date"
          name="dedline"
          id="deadline-input"
          style="position: absolute; opacity: 0; pointer-events: none; left: 0;"
          required
        />

        <!-- Ambil dari session -->
        <input type="hidden" name="id_pengguna" value="<?= htmlspecialchars($id_pengguna) ?>">

        <button class="btn btn-outline-warning fw-bold" type="submit">Tambah</button>
      </div>
    </form>

    <!-- Daftar Tugas -->
    <ul id="todo-list" class="list-group mt-3">
      <?php if (empty($tugas)) : ?>
        <li class="list-group-item text-muted">Belum ada Aktivitas.</li>
      <?php else : ?>
        <?php foreach ($tugas as $t) : ?>
          <?php
            $today = new DateTime();
            $deadline = new DateTime($t['dedline']);
            $interval = $today->diff($deadline);
            $daysLeft = (int)$interval->format('%r%a'); // + untuk sisa, - untuk lewat
            $isNearDeadline = $daysLeft >= 0 && $daysLeft <= 2;
            $isOverdue = $daysLeft < 0;
          ?>

          <li class="list-group-item d-flex justify-content-between align-items-center
              <?= $t['status'] === 'selesai' ? 'bg-success-subtle' : ($isOverdue ? 'bg-danger-subtle' : '') ?>">
            
            <div>
              <strong><?= htmlspecialchars($t['isi_tugas']) ?></strong><br>
              <small class="text-muted">Deadline: <?= htmlspecialchars($t['dedline']) ?></small>

              <?php if ($t['status'] === 'selesai') : ?>
                <span class="badge bg-success ms-2">Selesai</span>
              <?php elseif ($isNearDeadline) : ?>
                <span class="badge bg-warning text-dark ms-2">⚠️ Segera dikerjakan!</span>
              <?php elseif ($isOverdue) : ?>
                <span class="badge bg-danger ms-2">❌ Terlewat!</span>
              <?php endif; ?>
            </div>

            <div class="d-flex gap-2">
              <?php if ($t['status'] !== 'selesai') : ?>
                <form method="POST">
                  <input type="hidden" name="selesai_id" value="<?= $t['id_tugas'] ?>">
                  <button class="btn btn-sm btn-success"><i class="bi bi-check-lg fw-bold"></i></button>
                </form>
              <?php endif; ?>

              <form method="POST" onsubmit="return confirm('Yakin hapus tugas ini?')">
                <input type="hidden" name="hapus_id" value="<?= $t['id_tugas'] ?>">
                <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
              </form>
            </div>
          </li>
        <?php endforeach; ?>

      <?php endif; ?>
    </ul>
  </div>
  <div class="sideSection" style="width: 30%;">
    <?php include 'sectionSide/streak.php'; ?>
    <a href="../pages/maps.php" class="btn btn-success p-3 mb-3 " style="width: 18rem;">Mulai untuk olahraga</a>
    <div class="character" style="width:18rem">
      <div class="card mb-3">
        <img src="../assets/images/dashboard/character.png" alt="" width="300px">
        <div class="description align-items-center text-center mt-2">
          <p class="fw-bold">Ach. Dani Abil Abidi Zein</p>
          <p>Tinggi Badan: 170 cm</p>
          <p>Berat Badan: 90 kg</p>
        </div>
      </div>
    </div>
    <?php include "sectionSide/cardTugas.php" ?>
  </div>
</section>

<!-- JS untuk menampilkan date picker -->
<script>
  document.getElementById("calendar-icon").addEventListener("click", function () {
    document.getElementById("deadline-input").showPicker();
  });
</script>
