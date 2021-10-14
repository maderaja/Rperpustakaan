<?php

require 'functions.php';

if (isset($_POST["register"])) {
  if (register($_POST) > 0) {
    echo "<script>
              alert('REGISTRASI BERHASIL !!');
              window.location = 'index.php';
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="bs5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="icon/css/all.min.css" />

  <!-- Self css -->
  <link rel="stylesheet" href="css/form.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/checkbox.css" />
  <link rel="stylesheet" href="css/responsive.css" />

  <link rel="icon" href="icon/logo.png">
  <title>Register</title>

  <style>
    body {
      background-color: #d3dde2;
    }

    .cover {
      z-index: 999;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }

    .bg-cover2 {
      background-color: #207ba5;
    }

    .judul {
      color: #fff;
    }

    .desc {
      font-size: 18px;
      font-weight: 400;
      color: #fff;
      margin-top: 24px;
      background-color: rgba(51, 51, 51, 0.822);
    }

    .text-bold {
      font-weight: bold;
    }

    .link {
      text-decoration: underline;
      color: #fff;
      font-weight: bold;
    }

    .link:hover {
      color: rgb(186, 185, 185);
      font-weight: bold;
    }

    .btn-purple {
      background-color: #9e005d;
      color: #fff;
      transition: 300ms;
      width: 100%;
      padding: 16px;
    }

    .btn-purple:hover {
      background-color: #770046;
      color: #fff;
    }

    .circle-icon {
      height: 100%;
      background-color: #9e005d;
    }
  </style>

</head>

<body>
  <div class="container-fluid">
    <!-- Form Login -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-10 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <!-- cover -->
              <div class="col-sm-5 d-none d-lg-block position-relative cover" style="background: url('img/bgc1.jpg'); background-size: cover">
                <center class="mt-4">
                  <img src="icon/logo.png" width="50%" />
                </center>
                <div class="text-center" style="margin-top: 150px;">
                  <p class="desc">"Ilmu itu ada di mana-mana, pengetahuan di mana-mana tersebar, kalau kita bersedia membaca, dan bersedia mendengar." - Felix Siauw</p>
                </div>
              </div>
              <!-- form control -->
              <div class="col-sm-7 bg-cover2 position-relative rounded">

                <div class="position-relative">

                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-center mt-3">
                      <div class="text-center mt-5">
                        <h1 class="h2 judul text-bold">Daftar Sebagai Siswa</h1>
                      </div>

                      <div class="col-lg-10 col-md-8 mt-5">
                        <div class="input-container">
                          <i class="far fa-user icon"></i>
                          <input class="input-field" type="text" placeholder="Full Name" name="name" id="name" required autocomplete="off" />
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="far fa-user icon"></i>
                          <input class="input-field" type="text" placeholder="Username (NIS)" name="username" id="username" required autocomplete="off" />
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="far fa-envelope icon"></i>
                          <input class="input-field" type="email" placeholder="Email" name="email" id="email" required autocomplete="off" />
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="fas fa-lock icon"></i>
                          <input class="input-field" type="password" placeholder="Password" name="password" id="password" required />
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="fas fa-lock icon"></i>
                          <input class="input-field" type="password" placeholder="Confirm Password" name="password2" id="password2" required />
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <div class="input-container">
                          <i class="fas fa-image icon"></i>
                          <input type="file" name="foto" id="foto" autocomplete="off" class="input-field">
                        </div>
                      </div>

                      <div class="col-lg-10 col-md-8">
                        <button type="submit" name="register" class="btn btn-purple rounded-pill shadow mb-4"><i class="fas fa-paper-plane"></i> REGISTER</button>
                      </div>

                      <div class="col-lg-12 mb-5">
                        <div class="d-flex justify-content-center"><span class="me-2 text-white">Sudah memiliki akun?</span><a href="index.php" class="link">Login</a></div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>