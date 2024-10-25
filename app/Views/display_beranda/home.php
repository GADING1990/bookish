            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Home</title>
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">
                <!-- Normalize CSS -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                <!-- Google Fonts -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron|Aldrich">
                <!-- Custom CSS -->
                <link rel="stylesheet" href="./style.css">
                <!-- Prefix Free -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
                <style>
        /* Responsive card mobile */
        @media (max-width: 767px) {
            .card {
                width: 11rem;
            }
        }

        /* Responsive card tablet */
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

        body {
            background-image: url('img/3.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        footer {
            background-color: #f8f9fa;
            padding: 1rem;
            margin-top: 2rem;
        }

        .card-produk {
            position: relative;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .card-produk-img-top {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .img-card-produk {
            max-height: 300px;
        }

        .clock {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: #17fe4d;
            font-size: 60px;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 7px;
        }
    </style>
</head>
<body>

    <div id="MyClockDisplay" class="clock"></div>

    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('MyClockDisplay').textContent = `${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateTime, 1000); // Update every second
        updateTime(); // Initial call to display time immediately
    </script>


                <!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-dark py-2">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img id="logo" src="<?= base_url() ?>img/1.png" alt="Logo" draggable="false" width="120" />
            <span class="navbar-brand-text">BOOKISH LIBRARY</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link mx-2 active" href="<?= base_url() ?>" style="color:#FF5733;">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="<?= base_url() ?>koleksi_buku" style="color:#FFC300;">
                        <i class="fa-solid fa-bookmark"></i> Koleksi Buku
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#FF5733;">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url() ?>riwayat_pinjam" style="color:#FFC300;">Riwayat Peminjaman</a></li>
                        <li><a class="dropdown-item" href="<?= base_url() ?>riwayat_kembali" style="color:#FFC300;">Riwayat Pengembalian</a></li>
                    </ul>
                </li>

                <?php if ($username == null) { ?>
                    <!-- No username available, show login button -->
                    <li class="nav-item">
                        <a href='login' class='btn btn-outline-success btn-sm'>Login</a>
                    </li>
                <?php } else { ?>
                    <!-- Username available, show logout button -->
                    <li class="nav-item">
                        <a class='nav-link active' style="color:#FFC300;" aria-current='page' href='#'><?= $username ?></a>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-3">
                        <form class="d-flex" role="search">
                            <input class="form-control form-control-sm me-2" type="search" name="cari_buku" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
                            <li class="nav-item d-flex align-items-center ms-3">
                        <a href='logout' class='btn btn-outline-success btn-sm'>Logout</a>
                    </li>
                        </form>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>


<!-- CSS -->
<style>
    .navbar-brand img {
        width: 120px; /* Menurunkan ukuran logo */
    }
    .navbar-brand-text {
        font-size: 1rem; /* Mengurangi ukuran font */
        color: #FFF; /* Warna teks navbar-brand */
    }
    .navbar-nav .nav-link {
        font-size: 0.875rem; /* Ukuran font link navbar */
    }
    .navbar-nav .btn {
        font-size: 0.75rem; /* Ukuran font tombol */
        padding: 0.25rem 0.5rem; /* Padding tombol */
    }
    .navbar-nav .form-control {
        font-size: 0.75rem; /* Ukuran font input */
    }
</style>

              

             <!-- banner -->
<div class="container-content" style="margin-top: 400px;"> <!-- Menambahkan margin-top untuk mengatur jarak -->
    <div id="carouselExampleIndicators" class="carousel slide" style="margin: 0 auto;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="max-height: 500px; max-width: 800px; margin: 0 auto;">
            <div class="carousel-item active">
                <img src="<?= base_url() ?>img/sld1.jpeg" class="d-block w-100" alt="Slide 1" style="object-fit: cover; object-position: center;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>img/sld2.jpeg" class="d-block w-100" alt="Slide 2" style="object-fit: cover; object-position: center;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>img/sld3.jpeg" class="d-block w-100" alt="Slide 3" style="object-fit: cover; object-position: center;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mt-3">
    <?php if (empty($semua_daftar_buku)): ?>
        <img src="<?= base_url() ?>buku/buku404.png" class="img buku-404" alt="course">
    <?php else: ?>
        <?php foreach($semua_daftar_buku as $k_buku): ?>
            <!-- Card 1 -->
            <div class="col">
                <div class="card-produk" style="border: none; background: transparent;">
                    <a href="<?= base_url() ?>peminjaman_buku/<?= $k_buku['buku_id']?>">
                        <div class="img-card-produk" style="overflow: hidden;">
                            <img src="<?= base_url() ?>buku/<?= $k_buku['cover']?>" class="card-produk-img-top img-fluid" alt="course">
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<div class="container">
<!-- Footer -->
<footer class="text-center text-lg-start mt-5 shadow" style="background-color: #010101;">
        <div class="container p-4 pb-0">
        <section class="">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3" style="color:#FDFDFD;">
                    <h6 class="text-uppercase mb-4 font-weight-bold" style="color:#FDFDFD;">
                 BOOKSIH LIBRARY
                    </h6>
                    <p>
                    Perpustakaan Digital 24 Jam
                    </p>
                </div>
            <hr class="w-100 clearfix d-md-none" />
            <div class="col mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold" style="color:#FDFDFD;">Kategori</h6>
                <div class="row row-cols-4 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 ">
                    <?php foreach($semua_kategori_buku as $k) : ?>
                    <div class="col">
                        <div class="kategori mt-2">
                            <p>
                            <a href="<?= base_url() ?>ID-<?= $k['kategori_id']?>" class="text"><?= $k['nama_kategori']?></a>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <hr class="w-100 clearfix d-md-none" />
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3" style="color:#FDFDFD;">
                <h6 class="text-uppercase mb-4 font-weight-bold">Info</h6>
                <p><i class="fa-solid fa-location-dot"></i> Bekasi,jln pahlawan ki haji noer ali</p>
                <p><i class="fas fa-envelope mr-3"></i> Bookish_Library@gmail.com</p>
                <p><i class="fas fa-phone mr-3"></i> + 08 210 447 88</p>
            </div>
            </div>
        </section>
        <hr class="my-3">
            <section class="p-3 pt-0">
                <div class="row d-flex align-items-center"style="color:#FDFDFD;">
                <!-- Grid column -->
                <div class="col-md-7 col-lg-8 text-center text-md-start">
                    <!-- Copyright -->
                    <div class="p-3">
                    © 2024 Copyright:
                    <a class="text" href="https://mdbootstrap.com/"
                        >Gading Mahesa</a
                        >
                    </div>
                    <!-- Copyright -->
                </div>
                <!-- Grid column -->
                </div>
            </section>
        </div>
    </footer>
    </div>

                   
    <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>

    <script src="<?= base_url() ?>popper/popper.js"></script>
    <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>sweetalert/alert.js"></script>
    <script>
		$(function() {
			<?php if (session()->has("success")) { ?>
				Swal.fire({
					icon: 'success',
					title: 'Berhasil Login',
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