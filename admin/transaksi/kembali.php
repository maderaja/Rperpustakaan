<?php
require '../../functions.php';

$id = $_GET['id'];
$id_buku = $_GET['buku'];

// $sql = $conn->query("update tb_transaksi set status='kembali' where id = '$id'");
$sql = $conn->query("DELETE FROM tb_transaksi WHERE id_transaksi = '$id'");

$buku = $conn->query("UPDATE  tb_buku SET jumlah_buku = (jumlah_buku+1) WHERE id_buku='$id_buku' ");

if ($sql || $buku) {
?>

  <script type="text/javascript">
    alert("BUKU BERHASIL DIKEMBALIKAN");
    window.location.href = "pengembalian.php";
  </script>
<?php
}

?>