<?php
 $id_pengguna = $_SESSION['login']['id_pengguna'] ?? 0;
  $catatan = [];
  $stmt = $conn->prepare("SELECT * FROM catatan WHERE id_pengguna = ? ORDER BY catatan_dibuat DESC");
  $stmt->bind_param("i", $id_pengguna);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
  $catatan[] = $row;
}
?>

<div class="catatan-section d-flex gap-3 w-100">
  <div class="mainContent" style="width: 70%;">
    <form method="POST" class="p-4 rounded-4 shadow-sm text-white" style="background-color:rgb(235, 41, 102);" action="process/tambah_catatan.php">
      <h5 class="text-center mb-4 fw-bold">
        <i class="bi bi-pencil-square me-2"></i>
        Tambah Catatan Baru
        <i class="bi bi-stars ms-2"></i>
      </h5>
      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text bg-white border-0">
            <i class="bi bi-bookmark-heart-fill text-danger"></i>
          </span>
          <input type="text" name="judul" 
            class="form-control border-0 rounded-end-pill ps-3" 
            placeholder="Judul Catatan"
            required>
        </div>
      </div>
  
      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text bg-white border-0">
            <i class="bi bi-chat-text-fill text-primary"></i>
          </span>
          <textarea name="isi" 
            class="form-control border-0 rounded-end-4 ps-3"
            rows="4"
            placeholder="Tulis isi catatanmu di sini..."
            required></textarea>
        </div>
      </div>
  
      <button type="submit" 
        class="btn btn-light w-100 fw-bold rounded-pill shadow">
        <i class="bi bi-plus-circle-fill me-2"></i>
        Tambah Catatan
      </button>
    </form>
  
  
    <!-- Daftar Catatan -->
    <?php foreach ($catatan as $c) : ?>
    <div class="card mb-4 shadow-sm border-0 rounded-2 mt-5" style="background-color: #fdfbfb ;">
      <div class="card-header d-flex justify-content-between align-items-center rounded-top-4" style="background-color: #a8edea ;">
        <div class="judul">
          <strong class="text-primary">
            <i class="bi bi-bookmark-heart-fill me-1"></i>
            <?= htmlspecialchars($c['judul']) ?>
          </strong><br>
          <small class="text-muted">
            <i class="bi bi-calendar-event me-1"></i>
            <?= date('d M Y H:i', strtotime($c['catatan_dibuat'])) ?>
          </small>
        </div>
        <div class="button d-flex gap-2">
          <!-- Tombol Edit -->
          <div class="btn btn-outline-info btn-sm rounded-pill px-3 shadow" style="cursor:pointer"
            onclick="isiFormEdit(
              '<?= $c['id_catatan'] ?>',
              '<?= htmlspecialchars($c['judul'], ENT_QUOTES) ?>',
              `<?= htmlspecialchars($c['isi'], ENT_QUOTES) ?>`
            )">
            <i class="bi bi-pencil-square"></i> Edit
          </div>
  
          <!-- Tombol Hapus -->
          <form method="POST" action="process/edit_catatan.php" onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
            <input type="hidden" name="id_catatan" value="<?= $c['id_catatan'] ?>">
            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow">
              <i class="bi bi-trash"></i> Hapus
            </button>
          </form>
        </div>
      </div>
      <div class="card-body">
        <p class="mb-0"><?= nl2br(htmlspecialchars($c['isi'])) ?></p>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
  <div class="sideSection d-flex flex-column align-items-end " style="width: 30%;">
    <?php include "sectionSide/cardTugas.php" ?>
    <?php include "sectionSide/cardTugas.php" ?>
  </div>
</div>