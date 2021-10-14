<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_perpustakaan");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

// FUNCTIONS SISWA
function tambahSiswa($data)
{
  global $conn;

  $name = stripslashes($data["name"]);
  $username = strtolower(stripslashes($data["username"]));
  $email = stripslashes($data["email"]);
  $password = mysqli_real_escape_string($conn, $data["password"]);


  // Cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM tb_siswa WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "
      <script>
        alert('USERNAME SUDAH TERDAFTAR!');
      </script>
    ";
    return false;
  }

  // Upload Foto
  $foto = uploadSiswa();
  if (!$foto) {
    return false;
  }

  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Tambah user baru ke database
  mysqli_query($conn, "INSERT INTO tb_siswa VALUES('', '$name', '$username', '$email', '$password', '$foto')");

  return mysqli_affected_rows($conn);;
}

function uploadSiswa()
{
  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

  //Cek apakah tidak ada foto yang diupload
  if ($error === 4) {
    echo "<script>
             alert('PILIH Foto TERLEBIH DAHULU!!')
          </script>";
    return false;
  }

  //Cek apakah yang di upload adalah foto?
  $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
  $ekstensiFoto = explode('.', $namaFile);
  $ekstensiFoto = strtolower(end($ekstensiFoto));
  if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
    echo "<script>
            alert('YANG ANDA UPLOAD BUKAN GAMBAR!')
          </script>";
    return false;
  }

  //Cek jika ukurannya terlalu besar
  if ($ukuranFile > 1500000) {
    echo "<script>
            alert('UKURAN GAMBAR TERLALU BESAR!')
          </script>";
    return false;
  }

  //Lolos pengecekan, gambar siap diupload
  //Generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFoto;


  move_uploaded_file($tmpName, '../../img/siswa/' . $namaFileBaru);
  return $namaFileBaru;
}


function hapusSiswa($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_siswa WHERE id_siswa = $id");

  return mysqli_affected_rows($conn);
}

function ubahSiswa($data)
{
  global $conn;

  $id = $data["id"];
  $name = htmlspecialchars($data["name"]);
  $username = htmlspecialchars($data["username"]);
  $email = htmlspecialchars($data["email"]);
  $fotoLama =  htmlspecialchars($data["fotoLama"]);


  //Cek apakah user pilih foto baru atau tidak
  if ($_FILES['foto']['error'] === 4) {
    $foto = $fotoLama;
  } else {
    $foto = uploadSiswa();
  }


  $query = "UPDATE tb_siswa SET
            nama = '$name',
            username = '$username',
            email = '$email',
            foto = '$foto'

           WHERE id_siswa = $id 
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function cariSiswa($keyword)
{
  $query = "SELECT * FROM tb_siswa
            WHERE
            nama LIKE '%$keyword%' OR
            username LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
            ";
  return query($query);
}


// FUNCTIONS PETUGAS
function tambahPetugas($data)
{
  global $conn;

  $nama = stripslashes($data["nama"]);
  $username = strtolower(stripslashes($data["username"]));
  $email = stripslashes($data["email"]);
  $password = mysqli_real_escape_string($conn, $data["password"]);


  // Cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM tb_petugas WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "
      <script>
        alert('USERNAME SUDAH TERDAFTAR!');
      </script>
    ";
    return false;
  }

  // Upload Foto
  $foto = uploadpetugas();
  if (!$foto) {
    return false;
  }

  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Tambah user baru ke database
  mysqli_query($conn, "INSERT INTO tb_petugas VALUES('', '$nama',  '$email', '$username', '$password', '$foto')");

  return mysqli_affected_rows($conn);;
}

function uploadPetugas()
{
  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

  //Cek apakah tidak ada foto yang diupload
  if ($error === 4) {
    echo "<script>
             alert('PILIH Foto TERLEBIH DAHULU!!')
          </script>";
    return false;
  }

  //Cek apakah yang di upload adalah foto?
  $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
  $ekstensiFoto = explode('.', $namaFile);
  $ekstensiFoto = strtolower(end($ekstensiFoto));
  if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
    echo "<script>
            alert('YANG ANDA UPLOAD BUKAN GAMBAR!')
          </script>";
    return false;
  }

  //Cek jika ukurannya terlalu besar
  if ($ukuranFile > 1500000) {
    echo "<script>
            alert('UKURAN GAMBAR TERLALU BESAR!')
          </script>";
    return false;
  }

  //Lolos pengecekan, gambar siap diupload
  //Generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFoto;


  move_uploaded_file($tmpName, '../../img/petugas/' . $namaFileBaru);
  return $namaFileBaru;
}


function hapusPetugas($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_petugas WHERE id_petugas = $id");

  return mysqli_affected_rows($conn);
}

function ubahPetugas($data)
{
  global $conn;

  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $username = htmlspecialchars($data["username"]);
  $email = htmlspecialchars($data["email"]);
  $fotoLama =  htmlspecialchars($data["fotoLama"]);


  //Cek apakah user pilih foto baru atau tidak
  if ($_FILES['foto']['error'] === 4) {
    $foto = $fotoLama;
  } else {
    $foto = uploadPetugas();
  }


  $query = "UPDATE tb_petugas SET
            nama = '$nama',
            email = '$email',
            username = '$username',
            foto = '$foto'

           WHERE id_petugas = $id 
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function cariPetugas($keyword)
{
  $query = "SELECT * FROM tb_petugas
            WHERE
            nama LIKE '%$keyword%' OR
            username LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
            ";
  return query($query);
}


// FUNCTIONS BUKU
function tambahBuku($data)
{
  global $conn;

  $judul = stripslashes($data["judul"]);
  $pengarang = stripslashes($data["pengarang"]);
  $penerbit = stripslashes($data["penerbit"]);
  $kode_buku = stripslashes($data["kode_buku"]);
  $jumlah_buku = $data["jumlah_buku"];

  // Cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT judul FROM tb_buku WHERE judul = '$judul'");

  if (mysqli_fetch_assoc($result)) {
    echo "
      <script>
        alert('BUKU SUDAH TERSEDIA!');
      </script>
    ";
    return false;
  }

  // Upload Cover
  $cover = uploadbuku();
  if (!$cover) {
    return false;
  }

  // Tambah user baru ke database
  mysqli_query($conn, "INSERT INTO tb_buku VALUES('', '$judul',  '$pengarang', '$penerbit', '$kode_buku','$jumlah_buku', '$cover')");

  return mysqli_affected_rows($conn);;
}

function uploadbuku()
{
  $namaFile = $_FILES['cover']['name'];
  $ukuranFile = $_FILES['cover']['size'];
  $error = $_FILES['cover']['error'];
  $tmpName = $_FILES['cover']['tmp_name'];

  //Cek apakah tidak ada Cover yang diupload
  if ($error === 4) {
    echo "<script>
             alert('PILIH COVER TERLEBIH DAHULU!!')
          </script>";
    return false;
  }

  //Cek apakah yang di upload adalah gambar?
  $ekstensiCoverValid = ['jpg', 'jpeg', 'png'];
  $ekstensiCover = explode('.', $namaFile);
  $ekstensiCover = strtolower(end($ekstensiCover));
  if (!in_array($ekstensiCover, $ekstensiCoverValid)) {
    echo "<script>
            alert('YANG ANDA UPLOAD BUKAN GAMBAR!')
          </script>";
    return false;
  }

  //Cek jika ukurannya terlalu besar
  if ($ukuranFile > 1500000) {
    echo "<script>
            alert('UKURAN GAMBAR TERLALU BESAR!')
          </script>";
    return false;
  }

  //Lolos pengecekan, gambar siap diupload
  //Generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiCover;


  move_uploaded_file($tmpName, '../../img/buku/' . $namaFileBaru);
  return $namaFileBaru;
}


function hapusBuku($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_buku WHERE id_buku = $id");

  return mysqli_affected_rows($conn);
}

function ubahBuku($data)
{
  global $conn;

  $id = $data["id"];
  $judul = stripslashes($data["judul"]);
  $pengarang = stripslashes($data["pengarang"]);
  $penerbit = stripslashes($data["penerbit"]);
  $kode_buku = stripslashes($data["kode_buku"]);
  $jumlah = $data["jumlah"];
  $coverLama =  htmlspecialchars($data["coverLama"]);


  //Cek apakah user pilih cover baru atau tidak
  if ($_FILES['cover']['error'] === 4) {
    $cover = $coverLama;
  } else {
    $cover = uploadbuku();
  }


  $query = "UPDATE tb_buku SET
            judul = '$judul',
            pengarang = '$pengarang',
            penerbit = '$penerbit',
            kode_buku = '$kode_buku',
            cover = '$cover',
            jumlah_buku = '$jumlah'

           WHERE id_buku = $id 
          ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function cariBuku($keyword)
{
  $query = "SELECT * FROM tb_buku
            WHERE
            judul LIKE '%$keyword%' OR
            pengarang LIKE '%$keyword%' OR
            penerbit LIKE '%$keyword%' OR
            kode_buku LIKE '%$keyword%'
            ";
  return query($query);
}

function cariTransaksi($keyword)
{
  $query = "SELECT * FROM transaksi
            WHERE
            judul LIKE '%$keyword%' OR
            nis LIKE '%$keyword%' OR
            nama LIKE '%$keyword%' OR
            tgl_pinjam LIKE '%$keyword%' OR
            tgl_kembali LIKE '%$keyword%'
            ";
  return query($query);
}



// FUNCTIONS REGISTRASI
function register($data)
{
  global $conn;

  $name = stripslashes($data["name"]);
  $username = strtolower(stripslashes($data["username"]));
  $email = stripslashes($data["email"]);
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);



  // Cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM tb_siswa WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "
      <script>
        alert('USERNAME SUDAH TERDAFTAR!');
      </script>
    ";
    return false;
  }

  // Cek konfirmasi password
  if ($password !== $password2) {
    echo "
      <script>
        alert('KONFIRMASI PASSWORD TIDAK SESUAI !');
      </script>";

    return false;
  }

  // Upload Foto
  $foto = uploadRegister();
  if (!$foto) {
    return false;
  }

  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Tambah user baru ke database
  mysqli_query($conn, "INSERT INTO tb_siswa VALUES('', '$name', '$username', '$email', '$password', '$foto')");

  return mysqli_affected_rows($conn);
}

function uploadRegister()
{
  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

  //Cek apakah tidak ada foto yang diupload
  if ($error === 4) {
    echo "<script>
             alert('PILIH Foto TERLEBIH DAHULU!!')
          </script>";
    return false;
  }

  //Cek apakah yang di upload adalah foto?
  $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
  $ekstensiFoto = explode('.', $namaFile);
  $ekstensiFoto = strtolower(end($ekstensiFoto));
  if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
    echo "<script>
            alert('YANG ANDA UPLOAD BUKAN GAMBAR!')
          </script>";
    return false;
  }

  //Cek jika ukurannya terlalu besar
  if ($ukuranFile > 1500000) {
    echo "<script>
            alert('UKURAN GAMBAR TERLALU BESAR!')
          </script>";
    return false;
  }

  //Lolos pengecekan, gambar siap diupload
  //Generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiFoto;


  move_uploaded_file($tmpName, 'img/siswa/' . $namaFileBaru);
  return $namaFileBaru;
}

function terlambat($tgl_dateline, $tgl_kembali)
{

  $tgl_dateline_pcs = explode("-", $tgl_dateline);
  $tgl_dateline_pcs = $tgl_dateline_pcs[2] . "-" . $tgl_dateline_pcs[1] . "-" . $tgl_dateline_pcs[0];

  $tgl_kembali_pcs = explode("-", $tgl_kembali);
  $tgl_kembali_pcs = $tgl_kembali_pcs[2] . "-" . $tgl_kembali_pcs[1] . "-" . $tgl_kembali_pcs[0];

  $selisih = strtotime($tgl_kembali_pcs) - strtotime($tgl_dateline_pcs);

  $selisih = $selisih / 86400;

  if ($selisih >= 1) {
    $hasil_tgl = floor($selisih);
  } else {
    $hasil_tgl = 0;
  }
  return $hasil_tgl;
}
