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
            <td><?= $data['tgl_pinjam'] ?></td>
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
                <?php
                $tanggal_dateline = $data['tgl_kembali'];
                $tgl_kembali = date('Y-m-d');
                $lambat = terlambat($tanggal_dateline, $tgl_kembali);

                if ($lambat > 0) {
                    echo "<font color='red'>$lambat hari </font>";
                } else {
                    echo $lambat . "hari";
                }

                ?>
            </td>

            <td>
                <?php
                $denda = 1000;
                $tanggal_dateline = $data['tgl_kembali'];
                $tgl_kembali = date('Y-m-d');

                $lambat = terlambat($tanggal_dateline, $tgl_kembali);

                $denda1 = $lambat * $denda;

                if ($lambat > 0) {
                    echo "<font color='red'>Rp.$denda1</font>";
                } else {
                    echo "Rp" . $lambat;
                }

                ?>
            </td>

            <td>
                <a href="kembali.php?id=<?= $data['id_transaksi']; ?>&buku=<?php echo $data['id_buku'] ?>" class="btn btn-danger" onclick="return confirm('ANDA YAKIN MENGEMBALIKAN BUKU INI?');">Kembalikan</a>
            </td>
        </tr>
        <?php $no++; ?>
<?php endforeach;
} ?>