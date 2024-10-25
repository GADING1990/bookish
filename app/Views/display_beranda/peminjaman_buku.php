<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--css card-->
<style>
    /* responsive card mobile */
    @media (max-width: 767px) {
            .card {
                width: 11rem;
            }
        }

        /* responsive card tab */
        @media (min-width: 768px) and (max-width: 991px) {
            .card {
                width: 12rem; 
            }
        }
    /* Responsive container for mobile */
    @media only screen and (max-width: 767px) {
            .container {
                max-width: 1200px;
                width: 100%;
                margin: auto;
            }
        }
</style>

</head>
<body>
<style>
     .product-image {
      max-width: 100%;
      height: auto;
    }

</style>


             <!-- Link ke file CSS untuk rateyo -->
<link rel="stylesheet" href="<?= base_url() ?>rateyo/jquery.rateyo.min.css" />

<!-- Tambahkan CSS untuk gambar buku -->
<style>
    .product-image {
        width: 100%; /* Mengatur lebar gambar agar mengikuti lebar kontainer */
        max-width: 400px; /* Menetapkan lebar maksimum gambar */
        height: auto; /* Menjaga rasio aspek gambar */
    }
    .card-header {
        background-color: #FFF333; 
        color: #010101;
    }
    .nav-link.active {
        background-color: #FFF333; 
        color: #090909;
    }
    .nav-link {
        background-color: #FFF333;
        color: #010101;
    }
    .form-control[readonly] {
        background-color: #f5f5f5; /* Warna latar belakang untuk input readonly */
    }
</style>

<!-- Link ke file CSS untuk rateyo -->
<link rel="stylesheet" href="<?= base_url() ?>rateyo/jquery.rateyo.min.css" />

<!-- Tambahkan CSS untuk gambar buku -->
<style>
    .product-image {
        width: 100%; /* Mengatur lebar gambar agar mengikuti lebar kontainer */
        max-width: 100%; /* Menetapkan lebar maksimum gambar */
        height: auto; /* Menjaga rasio aspek gambar */
    }
    .card-header {
        background-color: #FFF333; 
        color: #010101;
    }
    .nav-link.active {
        background-color: #FFF333; 
        color: #090909;
    }
    .nav-link {
        background-color: #FFF333;
        color: #010101;
    }
    .form-control[readonly] {
        background-color: #f5f5f5; /* Warna latar belakang untuk input readonly */
    }
    .rating {
        font-size: 1.2rem; /* Ukuran font rating */
    }
    .d-grid {
        display: grid;
    }
    .d-grid > .btn {
        justify-content: center;
    }
</style>

<div class="container content" style="margin-top:110px">
    <div class="card mt-5">
        <div class="card-header text-center">
            Detail Buku
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Gambar Produk di Kiri -->
                <div class="col-md-4 text-center text-md-start">
                    <img src="<?= base_url() ?>buku/<?= $cover ?>" alt="Produk" class="product-image img-fluid">
                    <!-- avg rating -->
                    <div id="avgRating" class="mt-2 mb-2">
                        <!-- avg end -->
                    </div>
                </div>

                <!-- Penjelasan Produk di Kanan -->
                <div class="col-md-8">
                    <table class="table table-bordered table-striped mt-4">
                        <tbody>
                            <tr>
                                <th scope="row">Judul</th>
                                <td><?= $judul ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori</th>
                                <td><?= $nama_kategori ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Penulis</th>
                                <td><?= $penulis ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sinopsis</th>
                                <td><?= $sinopsis ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Penerbit</th>
                                <td><?= $penerbit ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tahun Terbit</th>
                                <td><?= $tahun_terbit ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="ulasan">
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="tab" data-bs-target="#content1">Ulasan & Rating</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#content2">Lihat Ulasan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="content1">
                                <form action="<?= base_url() ?>proses_ulasan" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    <input type="hidden" name="buku_id" value="<?= $buku_id ?>">
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control" style="background-color: #FFF333; color: #010101" placeholder="Leave a comment here" id="floatingTextarea" name="ulasan"></textarea>
                                        <label for="floatingTextarea" class="text-secondary" style="background-color: #FFF333; color: #010101">Berikan Ulasan</label>
                                    </div>
                                    <div id="rateYo" class="mt-2 mb-2" data-rateyo-full-star="true"></div>
                                    <span class="result mt-3">Rating: 0</span>
                                    <input type="hidden" name="rating">
                                    <button class="btn w-100 mt-3" style="background-color: #FFF333; color: #010101;">Kirim</button>
                                </form>
                                <form action="<?= base_url() ?>proses_tambah_koleksi" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    <input type="hidden" name="buku_id" value="<?= $buku_id ?>">
                                    <input type="hidden" name="kategori_id" value="<?= $kategori_id ?>">
                                    <button type="submit" class="btn w-100 mt-4 mb-4" style="background-color: #FFF333; color: #010101;">
                                        <i class="fa-solid fa-bookmark"></i> Tambah Koleksi
                                    </button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="content2">
                                <div class="user-ulasan text-dark mt-2">
                                    <?php if(empty($semua_ulasan)): ?>
                                        <span style="color: #010101">Belum ada ulasan...</span>
                                    <?php endif; ?>
                                    <?php foreach($semua_ulasan as $ulasan): ?>
                                        <div class="profil">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <span><?= $ulasan['tanggal_ulasan'] ?></span>
                                                    <br>
                                                    <i class="fa-solid fa-user"></i>
                                                    <span><?= $ulasan['nama_lengkap'] ?></span>
                                                    <br>
                                                    <span><?= $ulasan['ulasan'] ?></span>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <div class="rating" data-rating="<?= $ulasan['rating'] ?>" id="rating-data<?= $ulasan['user_id'] ?>"></div>
                                                    <span>Rating: <?= $ulasan['rating'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            Form Pinjam Buku
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url() ?>proses_peminjaman_buku">
                <input type="hidden" class="form-control" value="<?= $user_id ?>" name="user_id" readonly>
                <input type="text" class="form-control" value="<?= $buku_id ?>" name="buku_id" readonly>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control" value="<?= $nama_lengkap ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Peminjam</label>
                    <input type="email" class="form-control" value="<?= $email ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control" value="<?= $tanggal_pinjam ?>" id="tanggal_peminjaman" name="tanggal_peminjaman" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Pengembalian <span class="text-danger">* Wajib isi</span></label>
                    <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required onchange="validasiTanggal()">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Total Pinjam</label>
                    <input type="number" class="form-control" name="total_pinjam" required>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn" style="background-color: #FFF333; color: #010101;" type="submit">Pinjam Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>


     <!-- script jquery -->
     <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>
    <!-- script popper -->
    <script src="<?= base_url() ?>popper/popper.js"></script>
    <!-- script bootsrap -->
    <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- script bootsrap -->
    <!-- script sweeetalert -->
    <script src="<?= base_url() ?>sweetalert/alert.js"></script>
    <script>
    function validasiTanggal() {
        var tanggal_peminjaman = new Date(document.getElementById("tanggal_peminjaman").value);
        var tanggalPengembalian = new Date(document.getElementById("tanggal_pengembalian").value);

        // Menghitung selisih hari
        var selisihHari = (tanggalPengembalian - tanggal_peminjaman) / (1000 * 3600 * 24);

        if (tanggal_peminjaman > tanggalPengembalian) {
            alert("Tanggal pengembalian tidak boleh kurang dari tanggal peminjaman.");
            // Atur tanggal pengembalian kembali ke tanggal peminjaman atau ambil tindakan lain sesuai kebutuhan.
            document.getElementById("tanggal_pengembalian").value = "";
        } else if (selisihHari > 7) {
            alert("Peminjaman buku dibatasi hingga 7 hari.");
            // Atur tanggal pengembalian kembali ke tanggal peminjaman atau ambil tindakan lain sesuai kebutuhan.
            document.getElementById("tanggal_pengembalian").value = "";
        }
    }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        var navbar = document.querySelector(".navbar");

        function handleScroll() {
            navbar.classList.toggle("sticky", window.scrollY > 0);
        }

        window.addEventListener("scroll", handleScroll);

        // Initial check for sticky on page load
        handleScroll();
        });
    </script>

<!-- rateyo -->
<script src="<?= base_url() ?>rateyo/jquery.rateyo.min.js"></script>
<script>
  $(function () {
    $("#rateYo").rateYo({
      onChange: function (rating, rateYoInstance) {
        $(this).parent().find('.result').text('Rating: ' + rating);
        $(this).parent().find('input[name=rating]').val(rating);
      }
    });
  });
</script>

<script>
  $(function () {
    <?php foreach ($semua_ulasan as  $ulasan): ?>
    $("#rating-data<?= $ulasan['user_id'] ?>").rateYo({
      rating: <?= $ulasan['rating'] ?>,
      readOnly: true, 
    });
    <?php endforeach; ?>

  });
</script>

<script>
    // Menggunakan nilai rata-rata rating dari controller
    var avgRating = <?php echo $avgRating; ?>;

    // Inisialisasi RateYo dengan nilai rata-rata rating
    $("#avgRating").rateYo({
        rating: avgRating,
        readOnly: true, 
        // Konfigurasi lainnya
    });
</script>
<!-- rateyo end -->

<!-- script sweeetalert -->
<script src="<?= base_url() ?>sweetalert/alert.js"></script>
    <script>
		$(function() {
			<?php if (session()->has("success")) { ?>
				Swal.fire({
					icon: 'success',
					title: 'Berhasil',
					text: '<?= session("success") ?>'
				})
			<?php } ?>
		});
</script>
<script>
		$(function() {
			<?php if (session()->has("info")) { ?>
				Swal.fire({
					icon: 'info',
					title: 'Info',
					text: '<?= session("info") ?>'
				})
			<?php } ?>
		});
	</script>


</body>
</html>