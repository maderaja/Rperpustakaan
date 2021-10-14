<?php

if (isset($_POST['search'])) {
    include "../../../functions.php";
    $search = $_POST['search'];
    $transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE 
                                    judul LIKE '%" . $search . "%' OR 
                                    username LIKE '%" . $search . "%' OR 
                                    nama LIKE '%" . $search . "%' OR 
                                    tgl_pinjam LIKE '%" . $search . "%' OR 
                                    tgl_kembali LIKE '%" . $search . "%'
                                    ");


    $no = 1;
    foreach ($transaksi as $data) : ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td>
                <?= $data['judul']; ?>
            </td>
            <td>
                <?= $data['username']; ?>
            </td>
            <td><?php echo $data['nama'];; ?></td>
            <td><?php echo $data['tgl_pinjam']; ?></td>
            <td><?php echo $data['tgl_kembali']; ?></td>
            <td><?php echo $data['status']; ?></td>
            <!-- <td><?php
                        $tanggal_dateline = $data['tgl_kembali'];
                        $tgl_kembali = date('Y-m-d');
                        $lambat = terlambat($tanggal_dateline, $tgl_kembali);
                        $status = $data["status"];

                        if ($lambat > 0) {
                            echo "<font color='red'>Terlambat </font>";
                        } else {
                            echo "<font color='green'>$status</font>";
                        }

                        ?></td> -->

            <td>
                <a href="perpanjang.php?transaksi&aksi=perpanjang&id=<?php echo $data['id_transaksi']; ?>&judul=<?php echo $data['judul']; ?>&tgl_kembali=<?php echo $data['tgl_kembali'] ?>&lambat=<?php echo $lambat; ?>" class="btn btn-warning" onclick="return confirm('ANDA YAKIN MEMPERPANJANG MASA PINJAMAN BUKU INI?');">Perpanjang</a>
            </td>
        </tr>
        <?php $no++; ?>
<?php endforeach;
} ?>