<?php

if (isset($_POST['search'])) {
    include "../../functions.php";
    $search = $_POST['search'];
    $buku = mysqli_query($conn, "SELECT * FROM buku WHERE 
                                    judul LIKE '%" . $search . "%' OR 
                                    pengarang LIKE '%" . $search . "%' OR 
                                    penerbit LIKE '%" . $search . "%' 
                                    ");

    foreach ($buku as $row) : ?>
        <div class="col-md-4">
            <div class="mt-5">
                <div class="col-md-12">
                    <div class="card-backdrop mb-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out">
                        <div class="card border-0 mb-4 card-featured">
                            <div class="card-body title-header">
                                <div class="text-center">
                                    <img src="../img/buku/<?= $row["cover"] ?>" class="img mt-5" width="40%">
                                    <h6 class="card-subtitle mb-3 mt-4 text-bold text-custom">
                                        <strong><?= $row["judul"]; ?></strong>
                                    </h6>
                                </div>
                                <p class="card-text" style="text-transform: capitalize;"><strong>Pengarang</strong> : <?= $row["pengarang"]; ?></p>
                                <p class="card-text"><strong>Penerbit</strong> : <?= $row["penerbit"]; ?></p>
                                <br>
                                <div class="text-center">
                                    <a href="#" class="btn btn-secondary">Detail</a>
                                    <a href="#" class="btn btn-primary"><i class="bi bi-bookmark-star-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach;
} ?>