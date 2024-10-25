
                <div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Dashboard</h1>
                            <div class="row">
                                <button type="button" class="btn btn-primary" style="width: 200px"d data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah kategori buku
                                </button>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <table id="myTablekategori" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kategori</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; foreach($semua_kategori_buku as $k_buku): ?>
                                            <tr>
                                                <td><?= $k_buku['kategori_id'] ?></td>
                                                <td><?= $k_buku['nama_kategori'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success mr-2" id="btn-edit-k-buku"
                                                        data-bs-toggle="modal"  data-bs-target="#editKBuku"
                                                        data-kategori_id ="<?= $k_buku['kategori_id'] ?>"
                                                        data-nama_kategori="<?= $k_buku['nama_kategori'] ?>"
                                                        > <i class="fa-solid fa-square-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="hapusKBuku('<?= $k_buku['kategori_id'] ?>', '<?= $k_buku['nama_kategori'] ?>')">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>

                        </div>
                
             <!-- script jquery -->
	    <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>
	    <script src="<?= base_url() ?>DataTables/datatables.min.js"></script>  
	    <script>
	      $(document).ready(function() {
		  $('#myTablekategori').DataTable();
	      });
	    </script>
	    <script src="<?= base_url() ?>sweetalert/alert.js"></script>
	    <!-- script edit kategori buku -->
	    <script>
		$(document).on('click', '#btn-edit-k-buku', function() {
		    $('.modal-body #kategori_id ').val($(this).data('kategori_id'));
		    $('.modal-body #nama_kategori').val($(this).data('nama_kategori'));
		})
	    </script>


	    <!-- script hapus buku -->
	    <script>
		function hapusKBuku(kategori_id, nama_kategori) {
		    Swal.fire({
		        title: "Apa anda yakin?",
		        text: "Data kategori buku : " + nama_kategori + " ini akan terhapus!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#3085d6",
		        cancelButtonColor: "#d33",
		        confirmButtonText: "Ya",
		        cancelButtonText: "Batal" 
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '<?= base_url() ?>hapus_kategori_buku/' + kategori_id;

		        }
		    });
		}
	    </script>

        <script src="<?= base_url() ?>popper/popper.js"></script>
            <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- Modal tambah kategori buku-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH KATEGORI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="<?= base_url() ?>proses_tambah_kategori_buku">
                <div class="mb-3">
                    <label for="input" class="form-label">Id Kategori</label>
                    <input type="text" class="form-control" name="kategori_id" aria-describedby="nama kategori buku" value="<?=$kode_kategori?>"readonly>
                </div>    
                <div class="mb-3">
                    <label for="input" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori"  aria-describedby="nama kategori buku" placeholder="Nama Kategori Buku">
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Tambah</button>
            </form>
            </div>
        
            </div>
        </div>
        </div>

        <!-- Modal Edit Kategori-->
        <div class="modal fade" id="editKBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= base_url() ?>proses_edit_kategori_buku">
                            <div class="mb-3">
                                <label for="input" class="form-label">Id Kategori</label>
                                <input type="text" class="form-control" name="kategori_id" id="kategori_id" aria-describedby="nama kategori buku" placeholder="Id Kategori Buku" readonly>
                            </div> 
                            <div class="mb-3">
                                <label for="input" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" aria-describedby="nama kategori buku" placeholder="Nama Kategori Buku">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
			<?php if (session()->has("error")) { ?>
				Swal.fire({
					icon: 'error',
					title: 'Gagal',
					text: '<?= session("error") ?>'
				})
			<?php } ?>
		});
	</script>
    
    </body>
</html>
