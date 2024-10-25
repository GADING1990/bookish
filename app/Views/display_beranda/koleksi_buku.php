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
                </nav>
                

    <div class="container-lg" style="margin-top:300px">
          <div class="row">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Koleksi Buku</h5>
                    </div>
                    <div class="card-body">
                        <table id="tablePeminjaman" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>   
                                    <th>Sampul Buku</th>
                                    <th>Judul</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($semua_koleksi_by_member as $koleksi): ?>
                                <tr>
                                    <td><img src="<?= base_url() ?>buku/<?= $koleksi['cover'] ?>" alt="sampul" width="50"></td>
                                    <td><?= $koleksi['judul'] ?></td>
                                    <td><?= $koleksi['nama_kategori'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>peminjaman_buku/<?= $koleksi['buku_id']?>" class="btn btn-success">Detail Buku</a>
                                        <button type="button" class="btn btn-danger" onclick="hapus_koleksi_buku('<?= $koleksi['buku_id'] ?>', '<?= $koleksi['judul'] ?>')">
                                        Hapus
                                    </button>
                                    </td>
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

    <script src="<?= base_url() ?>sweetalert/alert.js"></script>
    <!-- script hapus koleksi sweetalert -->
    <script>
        function hapus_koleksi_buku(buku_id, judul) {
            Swal.fire({
                title: "Apa anda yakin?",
                text: "Data koleksi dengan judul : " + judul + " ini akan terhapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal" 
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url() ?>hapus_koleksi_buku/' + buku_id;

                }
            });
        }
    </script>
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

</body>
</html>