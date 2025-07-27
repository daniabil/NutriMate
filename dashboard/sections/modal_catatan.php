  <div class="modal fade" id="modalEditCatatan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="process/edit_catatan.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Catatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="edit_id" id="modal-edit-id">
        <div class="mb-3">
          <label for="modal-edit-judul" class="form-label">Judul</label>
          <input type="text" name="judul" id="modal-edit-judul" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="modal-edit-isi" class="form-label">Isi</label>
          <textarea name="isi" id="modal-edit-isi" rows="4" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name = "update" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>
<script>
function isiFormEdit(id, judul, isi) {
  // Isi data ke input modal
  document.getElementById("modal-edit-id").value = id;
  document.getElementById("modal-edit-judul").value = judul;
  document.getElementById("modal-edit-isi").value = isi;

  // Tampilkan modal Bootstrap
  const modal = new bootstrap.Modal(document.getElementById("modalEditCatatan"));
  modal.show();
}
</script>