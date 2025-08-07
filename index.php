<!-- LANDING PAGE -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="assets/css/main.css" />
    <title>Healthy Drink Modern testing versi 2</title>
  </head>
  <body>
    <div class="container-main m-3">
      <div class="rounded" style="background-color: #0f2c2f">
        <div class="navbar p-3">
          <div class="logo">
            <h3>NutriMate</h3>
          </div>
          <div class="menubar">
            <ul class="nav justify-content-center">
              <li class="nav-item">
                <a href="#" class="nav-link text-light">About</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-light">Features</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-light">News</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link text-light">Contact</a>
              </li>
            </ul>
          </div>
          <div class="login">
            <a href="#" class="btn btn-outline-light">Sign Up</a>
            <a href="#" class="btn btn-primary">Login</a>
          </div>
        </div>
        <section class="hero">
          <div class="circle-bg"></div>
          <h1 class="hero-title">HEALTHY DRINK</h1>
          <img
            src="assets/images/avatar/Blue_and_White_3D_Avatar_Profession_Group_Project_Presentation__21_x_35_cm_-removebg-preview.png"
            alt="Healthy Drink"
            class="hero-img"
          />
          <!-- Floating fruits -->
          <img src="assets/images/kiwi.png" alt="Kiwi" class="fruit kiwi" />
          <img
            src="assets/images/orange.png"
            alt="Orange"
            class="fruit orange"
          />
          <img src="assets/images/lime.png" alt="Lime" class="fruit lime" />
        </section>
      </div>

      <div class="card-information w-100 d-flex gap-3">
        <div class="card">
          <div class="card-body d-flex gap-4">
            <div class="images">
              <div
                class="circle"
                style="background-color: rgb(226, 29, 160) !important"
              ></div>
              <img
                src="assets/images/landingPage/gemuk.png"
                alt=""
                width="100px"
                class="img"
              />
            </div>
            <div class="card-deskrisi">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body d-flex gap-4">
            <div class="images">
              <div
                class="circle"
                style="background-color: rgb(29, 180, 226) !important"
              ></div>
              <img
                src="assets/images/landingPage/kurus.png"
                alt=""
                width="100px"
                class="img"
              />
            </div>
            <div class="card-deskrisi">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
    <?php include 'sections/about.php' ?>

    <!-- FEATURES -->
    <?php include 'sections/features.php' ?>

    <!-- NEWS -->
    <?php include 'sections/news.php' ?>
    </div>
    <footer class="text-white py-5" style="background-color: #0f2c2f">
      <div class="container">
        <div class="row">
          <!-- Brand & Deskripsi -->
          <div class="col-md-4 mb-4 mb-md-0">
            <h5 class="mb-3">Nutrimate</h5>
            <p class="small">
              Nutrimate adalah teman setia untuk mendukung kamu hidup sehat,
              dengan panduan nutrisi, olahraga, dan edukasi yang terpercaya.
            </p>
          </div>

          <!-- Quick Links -->
          <div class="col-md-4 mb-4 mb-md-0">
            <h5 class="mb-3">Navigasi</h5>
            <ul class="list-unstyled">
              <li>
                <a href="#fitur" class="text-white text-decoration-none"
                  >Fitur</a
                >
              </li>
              <li>
                <a href="#jurnal" class="text-white text-decoration-none"
                  >Jurnal</a
                >
              </li>
              <li>
                <a href="#tentang" class="text-white text-decoration-none"
                  >Tentang Kami</a
                >
              </li>
              <li>
                <a href="#kontak" class="text-white text-decoration-none"
                  >Kontak</a
                >
              </li>
            </ul>
          </div>

          <!-- Kontak & Sosial Media -->
          <div class="col-md-4">
            <h5 class="mb-3">Hubungi Kami</h5>
            <p class="small mb-1">Email: support@nutrimate.com</p>
            <p class="small mb-3">Telepon: +62 812 3456 7890</p>
            <div>
              <a href="#" class="text-white me-3"
                ><i class="bi bi-facebook"></i
              ></a>
              <a href="#" class="text-white me-3"
                ><i class="bi bi-instagram"></i
              ></a>
              <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
            </div>
          </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4">
          <p class="small mb-0">&copy; 2025 Nutrimate. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

