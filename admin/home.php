<?php
session_start();

require '../functions.php';

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
  header("location: ../index.php");
}

$buku = query("SELECT * FROM tb_buku ORDER BY id_buku DESC LIMIT 3");
$siswa = query("SELECT * FROM tb_siswa ORDER BY id_siswa DESC LIMIT 3");
$petugas = query("SELECT * FROM tb_petugas ORDER BY id_petugas DESC LIMIT 3");

?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard Admin</title>
  <link rel="icon" href="../icon/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bs5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../bs5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../bs5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="../bs5/css/style.css" />

</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow ">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="home.php">R.Perpustakaan (ADMIN)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <ul class="navbar-nav ms-auto align-items-center">
          <h6 class=" text-white" style="margin: 0;"><?php echo $_SESSION['username']; ?></h6>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#"><i class="bi bi-file-person"></i> Profile</a></li>
              <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-door-open-fill"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- top navigation bar -->

  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav bg-dark shadow" tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0 ">
      <nav class="navbar-dark ">
        <ul class="navbar-nav">
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3">CORE</div>
          </li>
          <li>
            <a href="home.php" class="nav-link px-3 active">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">ADD DATA <i class="bi bi-person-plus-fill"></i></div>
          </li>
          <li>
            <a href="add/add_petugas.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
              <span>Petugas</span>
            </a>
          </li>
          <li>
            <a href="add/add_siswa.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-fill"></i></span>
              <span>Siswa</span>
            </a>
          </li>
          <li>
            <a href="add/add_buku.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-book-fill"></i></span>
              <span>Buku</span>
            </a>
          </li>

          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">Transaksi</div>
          </li>
          <li>
            <a href="transaksi/transaksi.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-arrow-up-right-square"></i></span>
              <span>Pinjaman</span>
            </a>
          </li>
          <li>
            <a href="transaksi/pengembalian.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-arrow-down-left-square"></i></span>
              <span>Pengembalian</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-md-12 mb-2 mt-2">
          <h4>Haii Admin, Selamat Bertugas!!</h4>
        </div>
      </div>

      <div class="row justify-content-around">
        <div class="col-md-6 mb-4" id="top3">
          <div class="card shadow mb-4">
            <div class="card-header py-3 text-center bg-primary">
              <h6 class="m-0 font-weight-bold border-0 text-white text-center">DATA SISWA</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <?php foreach ($siswa as $swa) : ?>
                  <div class="col-lg-2 mb-2">
                    <img src="../img/siswa/<?= $swa["foto"] ?>" alt="" width="100%" style="border-radius: 5px;">
                  </div>
                  <div class="col-lg-10">
                    <h5 class="h5 mb-0 text-gray-800"><b><?= $swa["nama"]; ?></b></h5>
                    <h6 class="h6 mb-0 text-gray-800"><?= $swa["username"]; ?></h6>
                    <h6 class="h6 mb-0 text-gray-800 mt-3"><?= $swa["email"]; ?></h6>
                  </div>

                  <div class="col-lg-12 mb-2">
                    <!-- Divider -->
                    <hr class="sidebar-divider ">
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <center>
                    <a href="tables/tb_siswa.php" class="btn btn-primary btn-md mt-4">
                      <i class="bi bi-eye-fill"></i>
                      Lihat semua Siswa
                    </a>
                  </center>
                </div>
              </div>

            </div>
          </div>
        </div>



        <div class="col-md-6 mb-4" id="top3">
          <div class="card shadow mb-4">
            <div class="card-header py-3  bg-success text-center">
              <h6 class="m-0 font-weight-bold border-0 text-white ">DATA BUKU</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <?php foreach ($buku as $bku) : ?>
                  <div class="col-lg-2 mb-1">
                    <img src="../img/buku/<?= $bku["cover"] ?>" alt="" width="100%" style="border-radius: 5px;">
                  </div>
                  <div class="col-lg-10">
                    <h5 class="h5 mb-0 text-gray-800"><b><?= $bku["judul"]; ?></b></h5>
                    <h6 class="h6 mb-0 text-gray-800"><?= $bku["penerbit"]; ?></h6>
                    <h6 class="h6 mb-0 text-gray-800 mt-3"><?= $bku["kode_buku"]; ?></h6>
                  </div>

                  <div class="col-lg-12">
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <center>
                    <a href="tables/tb_buku.php" class="btn btn-success btn-md">
                      <i class="bi bi-eye-fill"></i>
                      Lihat semua Buku
                    </a>
                  </center>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-6 mb-4" id="top3">
          <div class="card shadow mb-4">
            <div class="card-header py-3  bg-warning text-center ">
              <h6 class="m-0 font-weight-bold border-0 text-dark ">DATA PETUGAS</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <?php foreach ($petugas as $pts) : ?>
                  <div class="col-lg-2 mb-2">
                    <img src="../img/petugas/<?= $pts["foto"] ?>" alt="" width="100%" style="border-radius: 5px;">
                  </div>
                  <div class="col-lg-10">
                    <h5 class="h5 mb-0 text-gray-800"><b><?= $pts["nama"]; ?></b></h5>
                    <h6 class="h6 mb-0 text-gray-800"><?= $pts["username"]; ?></h6>
                    <h6 class="h6 mb-0 text-gray-800 mt-3"><?= $pts["email"]; ?></h6>
                  </div>

                  <div class="col-lg-12">
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <center>
                    <a href="tables/tb_petugas.php" class="btn btn-warning btn-md text-dark">
                      <i class="bi bi-eye-fill"></i>
                      Lihat semua Petugas
                    </a>
                  </center>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../bs5/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="../bs5/js/jquery-3.5.1.js"></script>
  <script src="../bs5/js/jquery.dataTables.min.js"></script>
  <script src="../bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="../bs5/js/script.js"></script>
</body>

</html>

</body>

</html>