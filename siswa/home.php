<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['login'] == "") {
  header("location: ../index.php");
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
  <link rel="stylesheet" href="css/body.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="icon/css/all.min.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <title>Home</title>
  <link rel="icon" href="../icon/logo.png">

  <style>
    .carousel-quotes {
      background-color: #7b7b7ba8;
      width: fit-content;
      border-radius: 10px;
    }
  </style>
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
            <a class="nav-link me-4 active" aria-current="page" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="#menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="#contact">Contact</a>
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

  <!-- Header -->
  <div id="home">
    <div id="carouselExampleCaptions" class="carousel slide shadow" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="1900">
          <img src="../img/read11.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block carousel-quotes text-center">
            <h2></b> Haii <b><?php echo $_SESSION['username']; ?></b>!!!</h2>
            <h4>Jangan lupa membaca buku yaa.</h4>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="1900">
          <img src="../img/read3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block carousel-quotes">
            <h5>"Hal-hal yang ingin kutahu ada di dalam buku, sahabat terbaik adalah orang yang akan memberikanku </h5>
            <h5>sebuah buku yang belum aku ketahui" - Abraham Lincoln</h5>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="1900">
          <img src="../img/read2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block carousel-quotes mb-4">
            <h5>"Ada kejahatan yang lebih kejam daripada membakar buku. Salah satunya adalah tidak membacanya " </h5>
            <h5>- Joseph Brodsky</h5>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- End Header -->

  <!-- Menu -->
  <section id="menu">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center title-header" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out">
          <h2 class="text-bold"><strong>Menu</strong></h2>
        </div>
      </div>
      <div class="row mt-4 mb-5">
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-delay="300">
          <div class="card border-0 card-hover-shadow mb-4">
            <div class="card-body text-center title-header">
              <img src="../img/book.png" class="img mt-5" width="50%">
              <hr style="height:2px;" class="text-dark">
              <h6 class="card-subtitle mb-3 mt-4 text-bold"><strong>Koleksi Buku</strong>
              </h6>
              <p class="card-text">Coba liat yuk, buku apa aja sih yang ada di R.Perpustakaan?, siapa tau ada yang minat untuk kamu baca
              </p>
              <a href="koleksi_buku.php" class="link-content mb-5">Detail <i class="bi bi-arrow-right-circle-fill"></i></a>
              <br><br>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-delay="300">
          <div class="card border-0 card-hover-shadow mb-4">
            <div class="card-body text-center title-header">
              <img src="../img/bring-book.png" class="img mt-5 mb-3" width="50%">
              <hr style="height:2px;" class="text-dark">
              <h6 class="card-subtitle mb-3 mt-4 text-bold"><strong>Pinjaman Saya</strong>
              </h6>
              <p class="card-text">Buku apa saja ya yang sedang aku pinjam?, dan kapan harus segera dikembalikan?
              </p>
              <a href="#" class="link-content mb-5">Detail <i class="bi bi-arrow-right-circle-fill"></i></a>
              <br><br>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-delay="300">
          <div class="card border-0 card-hover-shadow mb-4">
            <div class="card-body text-center title-header">
              <img src="../img/fav-book.png" class="img mt-5 mb-3" width="70%">
              <hr style="height:2px;" class="text-dark">
              <h6 class="card-subtitle mb-3 mt-4 text-bold"><strong>Favorit Saya</strong>
              </h6>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit necessitatibus.
              </p>
              <a href="#" class="link-content mb-5">Detail <i class="bi bi-arrow-right-circle-fill"></i></a>
              <br><br>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- EndMenu -->

  <!-- Contact -->
  <section id="contact">
    <div class="container mb-5">
      <div class="row">
        <div class="col-md-6">
          <img src="../icon/contact.svg" class="img text-end text-lg-start mb-5" width="90%" data-aos="fade-right" data-aos-duration="600" data-aos-easing="ease-in-out">
        </div>
        <div class="col-md-6 title-header" data-aos="fade-left" data-aos-duration="600" data-aos-easing="ease-in-out" data-aos-delay="600">
          <h2 class="text-bold"><strong>Contact Us</strong></h2>
          <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
            <strong>Terimakasih Yaaa!</strong> Pesan kamu sudah kami terima.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <form name="rperpus-contact-form">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <input type="text" class="form-control input-custom rounded-pill border-0 shadow" placeholder="Full Name" id="name" name="nama" required>
              </div>
              <div class="col-lg-12 mb-4">
                <input type="email" id="email" name="email" class="form-control input-custom rounded-pill border-0 shadow" placeholder="Email" required>
              </div>
              <div class="col-lg-12 mb-4">
                <textarea id="pesan" name="pesan" class="form-control input-custom-textarea rounded border-0 shadow" rows="10" placeholder="Message" required></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-custom rounded-pill border-0 btn-kirim">Submit</button>
            <button class="btn btn-custom rounded-pill border-0 btn-loading d-none" type="button" disabled>
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              Loading...
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end Contact -->

  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6 title-footer">
          <img src="../img/per-light.png" class="img mb-4 mt-5" width="200px" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out">
          <p class="text-white" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque esse dolorem cum maiores,
            sapiente distinctio magni perspiciatis nemo? Sit quas unde harum?
          </p>
          <div class="d-flex mb-5" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out">
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
          <div class="mapouter mb-5" width="200px" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-in-out">
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
  <!-- End Footer -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src=" https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="icon/js/all.min.js"></script>
  <script src="js/onscroll.js"></script>
  <script src="js/all.js"></script>

  <script>
    const scriptURL = 'https://script.google.com/macros/s/AKfycbxL0y7bvzqifz9HPTiFkDmhRHE--Q0tjKh0avJlDXlqU5i4C6JJ2ZWbz91HSX89fprqOw/exec';
    const form = document.forms['rperpus-contact-form'];
    const btnKirim = document.querySelector('.btn-kirim');
    const btnLoading = document.querySelector('.btn-loading');
    const myAlert = document.querySelector('.my-alert');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      //ketika tombol submit diklik
      //tampilkan tombol loading, hilangkan tombol kirim
      btnLoading.classList.toggle('d-none');
      btnKirim.classList.toggle('d-none');
      fetch(scriptURL, {
          method: 'POST',
          body: new FormData(form)
        })
        .then((response) => {
          //tampilkan tombol kirim, hilangkan tombol loading
          btnLoading.classList.toggle('d-none');
          btnKirim.classList.toggle('d-none');
          //tampilkan alert
          myAlert.classList.toggle('d-none');
          //reset formnya
          form.reset();
          console.log('Success!', response);
        })
        .catch((error) => console.error('Error!', error.message));
    });
  </script>

</body>

</html>