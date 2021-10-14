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
$jumlahData = count(query("SELECT * FROM tb_transaksi"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$transaksi = query("SELECT * FROM tb_transaksi WHERE status='pinjam' ORDER BY id_transaksi DESC");

//Tombol cari diklik
if (isset($_POST["cari"])) {
  $transaksi = cariTransaksi($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Data Transaksi</title>
  <link rel="icon" href="../../icon/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bs5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../bs5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../../bs5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="../../bs5/css/style.css" />

  <script src="js/jquery.min.js"></script>
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #000080;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="../home.php">R.Perpustakaan (PETUGAS)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <form action="" method="POST" class="d-flex ms-auto my-3 my-lg-0">
          <div class="input-group">
            <input class="form-control" type="text" name="keyword" id="search" placeholder="Search" aria-label="Search" />
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
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">Transaksi</div>
          </li>
          <li>
            <a href="transaksi.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-arrow-up-right-square"></i></span>
              <span>Pinjaman</span>
            </a>
          </li>
          <li>
            <a href="pengembalian.php" class="nav-link px-3">
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
          <div class="card mt-3 shadow mb-4">
            <div class="card-header bg-primary text-white text-center">
              Daftar Pinjaman
            </div>
            <div class="card-body">
              <a href="tambah.php" class="btn btn-success mb-3" style="margin-top: 8px;"><i class="bi bi-plus-square"></i> Tambah Pinjaman</a>
              <br>
              <!-- NAVIGASI PAGINATION -->
              <!-- <?php if ($halamanAktif > 1) : ?>
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
              <?php endif; ?> -->
              <table class="table table-striped table-bordered table-hover text-center mt-3" id="dataTables-example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th width="12%">Aksi</th>
                  </tr>
                </thead>
                <tbody id="tampil">
                  <?php
                  $a = 1;
                  foreach ($transaksi as $data) : ?>
                    <tr>
                      <td><?php echo $a; ?></td>
                      <td>
                        <?= $data['judul']; ?>
                      </td>
                      <td>
                        <?= $data['username']; ?>
                      </td>
                      <td><?php echo $data['nama'];; ?></td>
                      <td><?php echo $data['tgl_pinjam']; ?></td>
                      <td><?php echo $data['tgl_kembali']; ?></td>
                      <td><?php
                          $tanggal_dateline = $data['tgl_kembali'];
                          $tgl_kembali = date('Y-m-d');
                          $lambat = terlambat($tanggal_dateline, $tgl_kembali);
                          $status = $data["status"];

                          if ($lambat > 0) {
                            echo "<font color='red'>Terlambat </font>";
                          } else {
                            echo "<font color='green'>$status</font>";
                          }

                          ?></td>

                      <td>
                        <a href="perpanjang.php?transaksi&aksi=perpanjang&id=<?php echo $data['id_transaksi']; ?>&judul=<?php echo $data['judul']; ?>&tgl_kembali=<?php echo $data['tgl_kembali'] ?>&lambat=<?php echo $lambat; ?>" class="btn btn-warning" onclick="return confirm('ANDA YAKIN MEMPERPANJANG MASA PINJAMAN BUKU INI?');">Perpanjang</a>
                      </td>
                    </tr>
                    <?php $a++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
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

  <script>
    $(document).ready(function() {
      $("#search").keyup(function() {
        $.ajax({
          type: 'POST',
          url: 'search/searchTransaksi.php',
          data: {
            search: $(this).val()
          },
          cache: false,
          success: function(data) {
            $("#tampil").html(data);
          }
        });
      });
    });
  </script>

</body>

</html>