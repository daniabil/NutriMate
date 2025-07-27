<?php 
require_once '../helper/connection.php';

$id_pengguna = $_SESSION['login']['id_pengguna'] ?? 0;

// Ambil data pengguna dari DB
$stmt = $conn->prepare("SELECT email, nama, password, telepon, foto, dibuat FROM pengguna WHERE id_pengguna = 1");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();


//TODO: Contoh $data['dibuat'] = '2025-07-09 22:35:12';
$tanggalAsli = $data['dibuat'];

//TODO: Buat objek DateTime
$tanggal = new DateTime($tanggalAsli);

//TODO: Format: 09 Juli 2025
$formatTanggal = $tanggal->format('d F Y');

?>
<div class="card shadow-sm mb-4">
  <div class="card-body text-center">
    <div class="position-relative d-inline-block mb-3">
        <img src="../assets/images/avatar/man2.png" class=" border rounded-circle border-info" alt="Profile Picture" width="100px">
        <button class="btn btn-sm btn-info position-absolute bottom-0 end-0 rounded-circle shadow">
          <i class="bi bi-pencil-fill text-white" id="edit-foto"></i> 
        </button>           
    </div>
    <p class="card-text fs-5">Halo, <strong><?php echo $data['nama']; ?></strong></p>
    <p class="card-text text-muted fst-italic" style="font-size: 14px;">Terdaftar sejak: <strong><?php echo $formatTanggal; ?></strong></p>
    <a href="#" class="btn btn-primary btn-sm rounded-pill px-4">Go somewhere</a>
  </div>
</div>

<div class="statistik mb-4">
    <h5 class="fw-bold mb-3 text-info"><i class="bi bi-graph-up fw-bold"></i> Statistik</h5>
    <div class="d-flex flex-wrap gap-3">
        <div class="card shadow-sm border-0" style="width: 18rem;">
            <div class="card-body d-flex align-items-center gap-3">
                <img src="../assets/images/dashboard/rank.png" alt="Icon" width="50px">
                <div>
                    <div class="h4 text-success fw-bold">3</div>
                    <div class="text-muted small">Posisi 3 Besar</div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0" style="width: 18rem;">
            <div class="card-body d-flex align-items-center gap-3">
                <img src="../assets/images/dashboard/redFire.png" alt="Icon" width="50px">
                <div>
                    <div class="h4 text-success fw-bold">9</div>
                    <div class="text-muted small">9 Streak</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="datadiri mb-4 w-100">
    <h5 class="fw-bold mb-3 text-info"><i class="bi bi-person-lines-fill"></i> Data Diri</h5>
    <form action="process/simpan_profile.php" method="post">
        <div class="card p-3 shadow-sm border-0">
            <input type="hidden" name="id_pengguna" value="<?= $_SESSION['login']['id_pengguna'] ?>">
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($data['email']) ?>">
            </div>
            <div class="mb-2">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($data['nama']) ?>">
            </div>
            <div class="mb-2">
                <label for="nohp" class="form-label">No. HP</label>
                <input type="text" name="telepon" class="form-control" id="nohp" value="<?= htmlspecialchars($data['telepon']) ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        <a href="../auth/logout.php" class="btn btn-outline-danger mt-3"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </form>
</div>

<script>

</script>