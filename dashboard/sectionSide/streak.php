<?php
require_once '../helper/connection.php';

$id_pengguna = $_SESSION['login']['id_pengguna'] ?? 0;

?>

<div class="titleStreak d-flex gap-3 align-items-center justify-content-around mb-5">
    <div class="streak d-flex align-items-center">
        <img src="../assets/images/dashboard/exp.png" alt="" width="40px" class="rounded-circle d-block">
        <p class="mb-0  fw-bold fs-6">200M</p>
    </div>
    <div class="streak d-flex align-items-center">
        <img src="../assets/images/dashboard/redFire.png" alt="" width="40px" class="rounded-circle d-block">
        <p class="mb-0  fw-bold fs-6">9</p>
    </div>
    <div class="dropdown">
        <a class="nav-link nav-link-lg nav-link-user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img alt="image" src="../assets/images/avatar/man2.png" width="40px" class="rounded-circle mr-1">
        </a>
        <div class="dropdown-menu dropdown-menu-left">
            <a href="index.php?page=profil" class="dropdown-item has-icon ">Profile </a>
            <a href="../auth/logout.php" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
        <div class="dropdown-menu dropdown-menu-left"></div>
    </div>
</div>