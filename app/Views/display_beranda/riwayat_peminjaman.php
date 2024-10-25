<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <!-- bootsrap -->
    <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">
    <!-- datatables -->
    <link rel="stylesheet" href="<?= base_url() ?>DataTables/datatables.min.css">
</head>
<body>
                       <!-- Navbar -->
   <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-dark" >
                    <div class="container">
                        <a class="navbar-brand" href="#"
                        ><img id="logo" src="<?= base_url() ?>img/1.png" alt="Logo" draggable="false" width="180"
                        /> <span style="color:#FFC300 ;">BOOKSIH </span><span  style="color:#001B76;"> LIBRARY</span></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li class="nav-item">
                                <a class="nav-link mx-2 active" href="<?= base_url() ?>" style="color:#FF5733;"><i class="fa-solid fa-house active" ></i> Beranda</a>
                            </li>
                        <form class="d-flex" role="search">
                    
                    </form>
                    </div>
                </div>
                </nav>`
                
                
                        <form class="d-flex" role="search">
                    
                    </form>
                    </div>
                </div>
                </nav>
                
    <div class="container-lg mb-5" style="margin-top:200px">
          <div class="row">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Riwayat Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        <table id="tablePeminjaman" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Sampul Buku</th>
                                    <th>Judul</th>
                                    <th>Nama Kategori</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tenggat Pengembalian</th>
                                    <th>Total Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($buku_dipinjam_by_member as $buku_dipinjam): ?>
                                <tr>
                                    <td><img src="<?= base_url() ?>buku/<?= $buku_dipinjam['cover'] ?>" alt="sampul" width="50"></td>
                                    <td><?= $buku_dipinjam['judul'] ?></td>
                                    <td><?= $buku_dipinjam['nama_kategori'] ?></td>
                                    <td><?= $buku_dipinjam['tanggal_peminjaman'] ?></td>
                                    <td><?= $buku_dipinjam['tanggal_pengembalian'] ?></td>
                                    <td><?= $buku_dipinjam['total_pinjam'] ?></td>
                                    <td><?= $buku_dipinjam['status_peminjaman'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          <!-- /.row-->
          
          <!-- /.row-->
    </div>

    <!-- script jquery -->
    <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>
    <!-- script datatables -->
    <script src="<?= base_url() ?>DataTables/datatables.min.js"></script>  
    <script>
      $(document).ready(function() {
          $('#tablePeminjaman').DataTable();
      });
    </script>
    <!-- script popper -->
    <script src="<?= base_url() ?>popper/popper.js"></script>
    <!-- script bootsrap -->
    <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>

</body>
</html>