<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
  header("location: ../../index.php");
}

require '../functions.php';

// Pagination
// konfigurasi
$jumlahDataPerHalaman = 9;
$jumlahData = count(query("SELECT * FROM tb_buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$buku = query("SELECT * FROM tb_buku ORDER BY id_buku DESC LIMIT $awalData, $jumlahDataPerHalaman");

//Tombol cari diklik
if (isset($_POST["cari"])) {
  $buku = cariBuku($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="icon/css/all.min.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <title>Koleksi Buku</title>
  <link rel="icon" href="../icon/logo.png">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    html,
    body {
      max-width: 100%;
      overflow-x: hidden;
    }

    section {
      padding-top: 5rem;
      position: relative;
    }

    footer {
      background-color: #353535;
      padding-top: 4rem;
      margin-top: 10rem;
    }

    .hr {
      width: 50px;
      height: 5px;
      background-color: #185adb;
      border-radius: 5px;
      margin-top: 30px;
    }

    .dot {
      width: 16px;
      height: 16px;
      background-color: #fff;
      border: 5px solid #185adb;
      border-radius: 16px;
      margin-top: 12px;
    }

    .link-content {
      text-decoration: none;
      color: #185adb;
      transition: 600ms;
    }

    .link-content:hover {
      color: #11409e;
    }

    .title-footer {
      font-weight: lighter;
      color: rgb(160, 159, 159);
    }

    .text-custom {
      color: #185adb !important;
    }

    .bg-custom {
      background-color: #185adb !important;
    }

    .btn-custom {
      background-color: #185adb !important;
      transition: 600ms;
      font-weight: bold;
      color: #fff;
      width: 120px;
      box-shadow: 0px 5px 20px #1859db8e;
    }

    .btn-outline-custom {
      color: #fff;
      border: 2px solid #fff;
      transition: 600ms;
    }

    .btn-outline-custom:hover {
      color: #fff;
      border: 2px solid #185adb;
      background-color: #185adb;
    }

    .btn-custom:hover {
      background-color: #11409e !important;
      color: #fff;
    }

    /* featured */
    .card-backdrop {
      background-color: #185adb;
      border-radius: 16px;
      box-shadow: 0px 3px 10px gray;
    }

    .card-featured {
      transition: 600ms;
      background-color: #f8f8fb;
      border-radius: 16px;
    }

    .card-featured:hover {
      cursor: pointer;
      transform: translateY(-10px);
    }


    /* map */
    #map {
      width: 100%;
      /* The width is the width of the web page */
    }
  </style>

  <script src="js/jquery.min.js"></script>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-light" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="home.php"><img src="../img/per.png" width="200" draggable="false"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="showMenu()">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link me-4 " aria-current="page" href="home.php #home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4 active" href="home.php #menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="home.php #contact">Contact</a>
          </li>
          <div class="collapse navbar-collapse" id="topNavBar">
            <ul class="navbar-nav ms-auto">
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
        </ul>
      </div>
    </div>
  </nav>
  <!-- end Navbar -->


  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center title-header">
          <h2 class="text-bold"><strong>Koleksi Buku</strong></h2>
        </div>
      </div>
      <!-- Featured -->
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 title-header text-center">
            <h4 class="text-bold text-secondary"><strong>R.Perpustakaan</strong></h4>
            <hr>
          </div>
        </div>
      </div>

      <div class="container mb-5">
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
        <form action="" method="POST" class="d-flex ms-auto my-3 my-lg-0">
          <div class="input-group mt-3 mb-3">
            <input class="form-control" id="search" type="search" name="keyword" placeholder="Cari Buku..." aria-label="Search" autocomplete="off" />
            <button class="btn btn-primary" type="submit" name="cari">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
        <div class="row  justify-content-around">
          <?php if (empty($buku)) : ?>
            <div class="text-center fst-italic fw-bold">
              <td colspan="7" align="center">Data buku tidak ditemukan</td>
            </div>
          <?php endif; ?>

          <tbody id="tampil">
            <?php foreach ($buku as $row) : ?>
              <div class="col-md-4">
                <div class="mt-5">
                  <div class="col-md-12">
                    <div class="card-backdrop mb-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out">
                      <div class="card border-0 mb-4 card-featured">
                        <div class="card-body title-header text-center">
                          <div class="text-center">
                            <img src="../img/buku/<?= $row["cover"] ?>" class="img mt-2" width="50%">
                            <h6 class="card-subtitle mb-3 mt-4 text-bold text-custom">
                              <strong><?= $row["judul"]; ?></strong>
                            </h6>
                          </div>
                          <p class="card-text" style="text-transform: capitalize;"><strong>Pengarang</strong> : <?= $row["pengarang"]; ?></p>
                          <p class="card-text"><strong>Penerbit</strong> : <?= $row["penerbit"]; ?></p>
                          <br>
                          <div class="text-center">
                            <a class="btn btn-secondary detail" data-bs-toggle="modal" data-bs-target="#modalDetail" data-judul="<?= $row["judul"]; ?>" data-pengarang="<?= $row["pengarang"]; ?>" data-penerbit="<?= $row["penerbit"]; ?>" data-kode="<?= $row["kode_buku"]; ?>" data-cover="../img/buku/<?= $row["cover"]; ?>">Detail</a>
                            <a href="#" class="btn btn-primary"><i class="bi bi-bookmark-star-fill"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            <?php endforeach; ?>
          </tbody>
        </div>
  </section>

  <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail BUKU</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row mx-3 ">
          <div class="modal-body col-md-6">
            <div class="form-group">
              <label for="judul">
                Judul :
                <input type="text" name="judul" id="judul" class="form-control" readonly>
              </label>
            </div>
            <div class="form-group">
              <label for="pengarang">
                Pengarang :
                <input type="text" name="pengarang" id="pengarang" class="form-control text-capitalize" readonly>
              </label>
            </div>
            <div class="form-group">
              <label for="penerbit">
                Penerbit :
                <input type="text" name="penerbit" id="penerbit" class="form-control" readonly>
              </label>
            </div>
            <div class="form-group">
              <label for="kode_buku">
                Kode Buku :
                <input type="text" name="kode_buku" id="kode_buku" class="form-control" readonly>
              </label>
            </div>
          </div>
          <div class="col-md-6">
            <img src="../img/buku/<?= $row["cover"] ?>" id="cover" width="200px">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6 title-footer">
          <img src="../img/per-light.png" class="img mb-4 mt-5" width="200px">
          <p class="text-white">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque esse dolorem cum maiores,
            sapiente distinctio magni perspiciatis nemo? Sit quas unde harum?
          </p>
          <div class="d-flex mb-5">
            <a href="#" class="btn btn-outline-custom rounded-circle me-3">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="btn btn-outline-custom rounded-circle me-3">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="btn btn-outline-custom rounded-circle me-3">
              <i class="bi bi-youtube"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mapouter mb-5" width="200px">
            <div class="gmap_canvas">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15778.25671245574!2d115.2075884!3d-8.6377691!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f96db3e30ec6ffd!2sSMK%20Negeri%201%20Denpasar!5e0!3m2!1sid!2sid!4v1630033051877!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-created bg-custom p-4">
      <div class="container">
        <div class="d-flex justify-content-lg-between justify-content-center mt-2">
          <h6 class="text-bold text-white">
            Created with <i class="bi bi-suit-heart-fill text-danger"></i> by <a href="https://www.instagram.com/rajamahendra._/" class="text-white fw-bold" target="blank">Raja Mahendra</a>
          </h6>

          <h6 class="text-white d-none d-md-block">
            &copy; copyright2021 RajaMahendra.
          </h6>
        </div>
      </div>
    </div>
  </footer>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src=" https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="icon/js/all.min.js"></script>
  <script src="js/onscroll.js"></script>
  <script src="js/all.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script>
    $('.detail').click(function() {
      $('#modalDetail').modal();
      var judul = $(this).attr('data-judul')
      var pengarang = $(this).attr('data-pengarang')
      var penerbit = $(this).attr('data-penerbit')
      var kode_buku = $(this).attr('data-kode')
      var cover = $(this).attr('data-cover')

      $('#judul').val(judul)
      $('#pengarang').val(pengarang)
      $('#penerbit').val(penerbit)
      $('#kode_buku').val(kode_buku)
      $('#cover').val(cover)
    })
  </script>

</body>

</html>