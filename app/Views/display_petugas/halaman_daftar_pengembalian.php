
<div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <div class="row mt-5">
                                <button type="button" class="btn btn-primary" style="width: 200px"d data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Petugas
                                </button>
                                <div class="card mt-5">
                                    <div class="card-body mt-4">
                                        <table id="myTablekategori" class="table table-bordered table-striped table-hover">
                                        <thead>
                            <tr>
                                    <th>Sampul</th>
                                    <th>Judul Buku</th>
                                    <th>Status</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Total Pengembalian</th>
                                    <th>Hari Keterlambatan</th>
                                    <th>Detail Denda</th>
                                    <th>Detail Member</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($semua_pengembali as $pengembali): ?>
                            <tr>
                                    <td><img src="<?= base_url() ?>buku/<?= $pengembali['cover'] ?>" alt="" width="50"></td>
                                    <td><?= $pengembali['judul'] ?></td>
                                    <td><span class="badge bg-success">di-kembalikan</span></td>
                                    <td><?= $pengembali['nama_lengkap'] ?></td>
                                    <td><?= $pengembali['email'] ?></td>
                                    <td><?= $pengembali['tanggal_pengembalian'] ?></td>
                                    <td><?= $pengembali['total_pengembalian'] ?></td>
                                    <td><?= $pengembali['hari_keterlambatan'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning mr-2" id="btn-detail-denda"
                                            data-bs-toggle="modal"  data-bs-target="#detailDenda"
                                            data-hari_keterlambatan="<?= $pengembali['hari_keterlambatan'] ?>"
                                            data-total_denda="<?= $pengembali['total_denda'] ?>"
                                            data-uang_dibayarkan="<?= $pengembali['uang_dibayarkan'] ?>"
                                            data-uang_kembalian="<?= $pengembali['uang_kembalian'] ?>"
                                            > <i class="fas fa-money-bill-wave"></i> Denda
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success mr-2" id="btn-detail-member"
                                            data-bs-toggle="modal"  data-bs-target="#detailMember"
                                            data-user_id ="<?= $pengembali['user_id'] ?>"
                                            data-nama_lengkap="<?= $pengembali['nama_lengkap'] ?>"
                                            data-email="<?= $pengembali['email'] ?>"
                                            data-alamat="<?= $pengembali['alamat'] ?>"
                                            > <i class="fa-solid fa-address-card mr-2"></i> Member
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                
                                               
                                             
                                            </tbody>
                                        </table>
                                    </div>

                        </div>
                
             <!-- script datatables -->
    <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>
    <script src="<?= base_url() ?>DataTables/datatables.min.js"></script>  
    <script>
      $(document).ready(function() {
          $('#myTable').DataTable();
      });
    </script>

    <!-- script bootsrap -->
    <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
    
    <!-- script edit buku -->
    <script>
        $(document).on('click', '#btn-edit-peminjam', function() {
            $('.modal-body #id_peminjaman').val($(this).data('id_peminjaman'));
            $('.modal-body #status_peminjaman').val($(this).data('status_peminjaman'));
        })
    </script>
    <!-- script hapus peminjam -->
    <script>
        function hapusBuku(id_buku, judul) {
            Swal.fire({
                title: "Apa anda yakin?",
                text: "Data buku dengan judul : " + judul + " ini akan terhapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal" 
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url() ?>hapus_buku/' + id_buku;

                }
            });
        }
    </script>

     
      
        
        <!-- <script src="<?= base_url() ?>popper/popper.js"></script>
            <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script> -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
         <!-- Modal Detail Denda-->
    <div class="modal fade" id="detailDenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Denda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Hari Keterlambatan</label>
                    <input type="text" class="form-control" name="hari_keterlambatan" id="hari_keterlambatan" readonly>
                </div>                
                <div class="mb-3">
                    <label for="nama" class="form-label">Total Denda</label>
                    <input type="text" class="form-control" name="total_denda" id="total_denda" readonly>
                </div>                
                <div class="mb-3">
                    <label for="nama" class="form-label">Uang Dibayarkan</label>
                    <input type="text" class="form-control" name="uang_dibayarkan" id="uang_dibayarkan" readonly>
                </div>                
                <div class="mb-3">
                    <label for="nama" class="form-label">Uang Kembalian</label>
                    <input type="text" class="form-control" name="uang_kembalian" id="uang_kembalian" readonly>
                </div>              
            </div>
            </div>
        </div>
    </div>
    <!-- Modal Detail Member-->
    <div class="modal fade" id="detailMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Member</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" aria-describedby="penerbit buku" readonly>
                </div>                
                <div class="mb-3">
                    <label for="nama" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="penerbit buku" readonly>
                </div>                
                <div class="mb-3">
                    <label for="nama" class="form-label">No Telpon</label>
                    <input type="text" class="form-control" name="no_tlp" id="no_tlp" aria-describedby="penerbit buku" readonly>
                </div>                
                <div class="mb-3">
                    <label for="form-label">Alamat</label>
                    <textarea class="form-control" placeholder="Leave a comment here" id="alamat" readonly></textarea>
                </div>                
            </div>
            </div>
        </div>
    </div>
       
      
    <!-- script detail denda -->
    <script>
        $(document).on('click', '#btn-detail-denda', function() {
            $('.modal-body #hari_keterlambatan').val($(this).data('hari_keterlambatan'));
            $('.modal-body #total_denda').val($(this).data('total_denda'));
            $('.modal-body #uang_dibayarkan').val($(this).data('uang_dibayarkan'));
            $('.modal-body #uang_kembalian').val($(this).data('uang_kembalian'));
        })
    </script>
    <!-- script detail member -->
    <script>
        $(document).on('click', '#btn-detail-member', function() {
            $('.modal-body #id_peminjaman').val($(this).data('id_peminjaman'));
            $('.modal-body #nama_lengkap').val($(this).data('nama_lengkap'));
            $('.modal-body #email').val($(this).data('email'));
            $('.modal-body #no_telpon').val($(this).data('no_telpon'));
            $('.modal-body #alamat').val($(this).data('alamat'));
        })
    </script>
    
    </body>
</html>
