<?php
require_once '../helper/connection.php';

$id_pengguna = $_SESSION['login']['id_pengguna'] ?? 0;
$tugas = [];

if ($id_pengguna) {
  $query = $conn->prepare("SELECT id_tugas, isi_tugas FROM tugas WHERE id_pengguna = ? AND status = 'pending'");
  $query->bind_param("i", $id_pengguna);
  $query->execute();
  $result = $query->get_result();

  while ($row = $result->fetch_assoc()) {
    $tugas[] = $row;
  }
}
?>

<div class="task">
  <h4>Aktivitas</h4>
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <form id="formTugas" action="proses_selesai.php" method="POST">
        <ul class="list-group mt-3">
          <?php if (empty($tugas)) : ?>
            <li class="list-group-item text-muted">Aktivitas kosong.</li>
          <?php else : ?>
            <?php foreach ($tugas as $t) : ?>
              <li class="list-group-item">
                <input class="form-check-input me-1 radio-task"
                       type="radio"
                       name="task_id"
                       value="<?= $t['id_tugas'] ?>"
                       id="task<?= $t['id_tugas'] ?>">
                <label class="form-check-label" style="font-size: 12px" for="task<?= $t['id_tugas'] ?>">
                  <?= htmlspecialchars($t['isi_tugas']) ?>
                </label>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </form>
    </div>
  </div>
</div>

<script>
// Radio klik → submit form otomatis
document.querySelectorAll('.radio-task').forEach(radio => {
  radio.addEventListener('change', function() {
    document.getElementById('formTugas').submit();
  });
});
</script>
