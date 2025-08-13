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
        <h2>Sesi Olahraga Dimulai!</h2>
        <p>Selamat berolahraga 🎯</p>
        <button id="back-btn" class="btn btn-secondary">Kembali</button>
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