<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
  header("location: ../../index.php");
}

require '../../functions.php';

$pinjam = date("d-m-Y");
$kembali = date("d-m-Y", time() + 60 * 60 * 24 * 5);

$buku = query("SELECT * FROM tb_buku ORDER by id_buku DESC");
$siswa = query("SELECT * FROM tb_siswa ORDER by id_siswa DESC");

if (isset($_POST['simpan'])) {
  $tgl_pinjam    = isset($_POST['pinjam']) ? $_POST['pinjam'] : "";
  $tgl_kembali  = isset($_POST['kembali']) ? $_POST['kembali'] : "";

  $dapat_buku    = isset($_POST['judul']) ? $_POST['judul'] : "";
  $pecah_buku    = explode(".", $dapat_buku);
  $id_buku    = $pecah_buku[0];
  $judul      = $pecah_buku[1];

  $dapat_siswa  = isset($_POST['siswa']) ? $_POST['siswa'] : "";
  $pecah_siswa  = explode(".", $dapat_siswa);
  $id_siswa     = $pecah_siswa[0];
  $siswa      = $pecah_siswa[1];


  $query = query("SELECT * FROM tb_buku WHERE judul = '$judul'");
  foreach ($query as $hasil) {
    $sisa = $hasil['jumlah_buku'];

    //cek apakah ada data yang sama
    $cek = $conn->query("SELECT * FROM tb_transaksi WHERE username=$id_siswa AND id_buku=$id_buku");


    if ($sisa == 0) {
      echo "
      <script>
        alert('Stok bukun telah habis, tidak bisa melakukan transaksi, silahkan tambahkan stok buku segera');
        document.location.href = 'tambah.php';
      </script>";
    } elseif ($sisa != 0) {
      $qt = $conn->query("INSERT INTO tb_transaksi VALUES (null, '$id_buku', '$judul', '$id_siswa', '$siswa', '$tgl_pinjam', '$tgl_kembali', 'Pinjam', null)") or die("Gagal Masuk");
      $qb  = $conn->query("UPDATE tb_buku SET jumlah_buku = (jumlah_buku-1) WHERE id_buku = $id_buku ");

      if ($qt && $qb) {
        echo "
        <script>
          alert('TRANSAKSI BERHASIL');
          document.location.href = 'transaksi.php';
        </script>";
      } else {
        echo "
        <script>
          alert('TRANSAKSI GAGAL');
          document.location.href = 'transaksi.php';
        </script>";
      }
    } else {
      echo "
      <script>
        alert('Anda sudah meminjam buku yang sama');
        document.location.href = 'tambah.php';
      </script>";
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Tambah Data Pinjaman Buku</title>
  <link rel="icon" href="../../icon/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bs5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../bs5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../../bs5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="../../bs5/css/style.css" />
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="../home.php">R.Perpustakaan (ADMIN)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <ul class="navbar-nav ms-auto align-items-center">
          <h6 class="text-white mt-2"><?php echo date('d-M-Y'); ?></h6>
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
  <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
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
            <a href="../add/add_petugas.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
              <span>Petugas</span>
            </a>
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
          <h1 class="text-center">Tambah Data Pinjaman</h1>
        </div>
        <div class="container">
          <div class="card mt-3 shadow">
            <div class="card-header bg-success text-white text-center">
              Form Input Data Pinjam Buku
            </div>
            <div class="card-body">
              <form action="" method="POST" aria-required="true">
                <div class="form-group mb-3">
                  <label class="mb-2"> Judul Buku</label>
                  <select class="form-control" name="judul" required>
                    <option required>== Pilih Buku==</option>
                    <?php
                    foreach ($buku as $bku) {
                      echo "<option value='$bku[id_buku].$bku[judul]'>$bku[judul]</option>";
                    }
                    ?>
                  </select>

                </div>

                <div class="form-group mb-3">
                  <label class="mb-2">Nama Siswa</label>
                  <select class="form-control" name="siswa" required>
                    <option>== Pilih Siswa==</option>
                    <?php
                    foreach ($siswa as $swa) {
                      echo "<option value='$swa[username].$swa[nama]'>$swa[username] - $swa[nama]</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label class="mb-2">Tanggal Pinjam</label>
                  <input class="form-control" type="text" name="pinjam" value="<?php echo $pinjam; ?>" readonly />
                </div>


                <div class="form-group mb-3">
                  <label class="mb-2">Tanggal Kembali</label>
                  <input class="form-control" type="text" name="kembali" value="<?php echo $kembali; ?>" readonly />
                </div>

                <div>
                  <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                  <input type="reset" name="simpan" value="reset" class="btn btn-warning">
                </div>
              </form>
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