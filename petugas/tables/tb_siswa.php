<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
  header("location: ../../index.php");
}

require '../../functions.php';

// Pagination
// konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM tb_siswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$siswa = query("SELECT * FROM tb_siswa ORDER BY id_siswa DESC LIMIT $awalData, $jumlahDataPerHalaman");

//Tombol cari diklik
if (isset($_POST["cari"])) {
  $siswa = cariSiswa($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table Siswa</title>
  <link rel="icon" href="../../icon/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bs5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../bs5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../../bs5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="../../bs5/css/style.css" />
  <style>
    .container .card .text-white {
      font-weight: bold;
    }

    .search {
      display: inline;
    }

    .search_tambah {
      display: flex;
      justify-content: space-between;
    }
  </style>
</head>

<body style="background-color: #cccccc;">
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #000080;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="../home.php">R.Perpustakaan (Petugas)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <form action="" method="POST" class="d-flex ms-auto my-3 my-lg-0">
          <div class="input-group">
            <input class="form-control" type="search" name="keyword" placeholder="Search" aria-label="Search" />
            <button class="btn btn-primary" type="submit" name="cari">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- top navigation bar -->

  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar" style="background-color: #000080;">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3">CORE</div>
          </li>
          <li>
            <a href="../home.php" class="nav-link px-3 active">
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
            <a href="../add/add_siswa.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-fill"></i></span>
              <span>Siswa</span>
            </a>
          </li>
          <li>
            <a href="../add/add_buku.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-book-fill"></i></span>
              <span>Buku</span>
            </a>
          </li>

          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">TRANSAKSI</div>
          </li>
          <li>
            <a href="../transaksi/transaksi.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-arrow-up-right-square"></i></span>
              <span>Pinjaman</span>
            </a>
          </li>
          <li>
            <a href="../transaksi/pengembalian.php" class="nav-link px-3">
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
      <div class="row">
        <div class="col-md-12">


          <!-- TABEL DATA -->
          <div class="card mt-3">
            <div class="card-header bg-primary text-white text-center">
              Daftar Siswa
            </div>
            <div class="card-body">
              <!-- NAVIGASI PAGINATION -->
              <?php if ($halamanAktif > 1) : ?>
                <a href="?halaman=<?= $halamanAktif - 1; ?>"> &laquo;</a>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                  <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: black;" class="btn btn-warning"><?= $i; ?></a>
                <?php else : ?>
                  <a href="?halaman=<?= $i; ?>" class="btn btn-primary"><?= $i; ?></a>
                <?php endif; ?>
              <?php endfor; ?>

              <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <a href="?halaman=<?= $halamanAktif + 1; ?>"> &raquo;</a>
              <?php endif; ?>

              <table class="table table-bordered table-striped text-center mt-3">
                <tr>
                  <th>No.</th>
                  <th>Aksi</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                </tr>
                <?php if (empty($siswa)) : ?>
                  <div class="text-center fst-italic fw-bold">
                    <td colspan="7" align="center">Data buku tidak ditemukan</td>
                  </div>
                <?php endif; ?>

                <?php $a = 1 ?>
                <?php $i = $a + $awalData; ?>
                <?php foreach ($siswa as $row) : ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td>
                      <a href="../ubah/ubah_siswa.php?id=<?= $row["id_siswa"]; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i> ubah</a>
                      <a href="../hapus/hapus_siswa.php?id=<?= $row["id_siswa"]; ?>" onclick="return confirm('anda yakin akan menghapus data ini?');" class="btn btn-danger"><i class="bi bi-trash-fill"></i> hapus</a>
                    </td>
                    <td><img src="../../img/siswa/<?= $row["foto"] ?>" width="70"></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["username"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
  </main>
  <script src="../../bs5/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="../../bs5/js/jquery-3.5.1.js"></script>
  <script src="../../bs5/js/jquery.dataTables.min.js"></script>
  <script src="../../bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="../../bs5/js/script.js"></script>

</body>

</html>