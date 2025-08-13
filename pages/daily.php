<!-- SECTION TO-DO LIST -->
<?php 
$id_pengguna = $_SESSION['login']['id_pengguna'] ?? null;

?>

<section class="fade-content show d-flex gap-4" id="main-content">
  <?php include '../sections/sectionDaily.php'; ?> <!-- Konten Daily dipisah ke file terpisah -->
</section>

<script>
  function changeContent(html) {
    const content = document.getElementById("main-content");
    content.classList.remove("show"); // fade-out

    setTimeout(() => {
      content.innerHTML = html; // ganti isi dalam main-content
      content.classList.add("show"); // fade-in
      bindEvents(); // re-bind event
    }, 400);  
  }

  function startWorkout() {
    changeContent(`
    <div>
    <button id="back-btn" class="btn btn-secondary">Kembali</button>
    <h1 class="h4 mb-4 text-center">Mari Mulai Olahraga</h1>

      <!-- Grid 3 kolom di md ke atas -->
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100">
            <img src="https://picsum.photos/600/400?random=1" class="card-img-top" alt="Gambar 1">
            <div class="card-body">
              <h5 class="card-title">Lari</h5>
              <p class="card-text">Deskripsi singkat konten card pertama.</p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <a href="#" class="btn btn-primary w-100">Aksi</a>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card h-100">
            <img src="https://picsum.photos/600/400?random=2" class="card-img-top" alt="Gambar 2">
            <div class="card-body">
              <h5 class="card-title">Jalan</h5>
              <p class="card-text">Deskripsi singkat konten card kedua.</p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <a href="#" class="btn btn-outline-primary w-100">Detail</a>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card h-100">
            <img src="https://picsum.photos/600/400?random=3" class="card-img-top" alt="Gambar 3">
            <div class="card-body">
              <h5 class="card-title">Bersepeda</h5>
              <p class="card-text">Deskripsi singkat konten card ketiga.</p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <div class="d-grid gap-2">
                <a href="#" class="btn btn-primary">Beli</a>
                <a href="#" class="btn btn-light border">Simpan</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    `);
  }

  function backToDaily() {
    // Ambil HTML dari file PHP yang sudah dirender server
    fetch("../sections/sectionDaily.php")
      .then(response => response.text())
      .then(data => {
        changeContent(data);
      });
  }

  function bindEvents() {
    const startBtn = document.getElementById("start-btn");
    if (startBtn) {
      startBtn.addEventListener("click", function(e) {
        e.preventDefault(); // cegah pindah halaman
        startWorkout();
      });
    }

    const backBtn = document.getElementById("back-btn");
    if (backBtn) {
      backBtn.addEventListener("click", backToDaily);
    }
  }

  // Event pertama kali load
  bindEvents();
</script>