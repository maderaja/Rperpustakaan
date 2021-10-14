<?php
require '../../functions.php';

$id = $_GET['id'];
$judul = $_GET['judul'];
$tgl_kembali = $_GET['tgl_kembali'];
$lambat = $_GET['lambat'];


if ($lambat > 2) {
?>
	<script type="text/javascript">
		alert("BUKU YANG DI PINJAM TIDAK DAPAT DIPERPANJANG, KARENA TELAH MELEWATI BATAS WAKTU PENGEMBALIAN ");
		window.location.href = "transaksi.php";
	</script>
	<?php
} else {

	$pecah			= explode("-", $tgl_kembali);
	$next_2_hari	= mktime(0, 0, 0, $pecah[1], $pecah[0] + 2, $pecah[2]);
	$hari_next		= date("d-m-Y", $next_2_hari);

	$update = $conn->query("UPDATE tb_transaksi SET tgl_kembali='$hari_next' where id_transaksi='$id'");

	if ($update) {
	?>
		<script type="text/javascript">
			alert("BERHASIL DI PERPANJANG");
			window.location.href = "transaksi.php";
		</script>
	<?php
	} else {
	?>
		<script type="text/javascript">
			alert("Gagal Diperpanjang");
			window.location.href = "transaksi.php";
		</script>
<?php
	}
}

?>