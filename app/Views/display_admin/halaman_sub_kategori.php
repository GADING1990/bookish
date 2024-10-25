
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <div class="row">
                        <button type="button" class="btn btn-primary" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah sub kategori buku
                            </button>

                            <div class="card mt-4">
                                <div class="card-body">
                                    <table id="myTablekategori" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama sub kategori</th>
                                                <th>asal Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach($semua_sub_kategori as $sub_k): ?>
                                            <tr>
                                                <td><?= $sub_k['id_sub_kategori'] ?></td>
                                                <td><?= $sub_k['nama_sub_kategori'] ?></td>
                                                <td><?= $sub_k['nama_kategori'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success mr-2" id="btn-edit-sub-k"
                                                        data-bs-toggle="modal"  data-bs-target="#editSBuku"
                                                        data-id_sub_kategori="<?= $sub_k['id_sub_kategori'] ?>"
                                                        data-kategori_id="<?= $sub_k['kategori_id'] ?>"
                                                        data-nama_sub_kategori="<?= $sub_k['nama_sub_kategori'] ?>"
                                                        data-nama_kategori="<?= $sub_k['nama_kategori'] ?>"
                                                        > <i class="fa-solid fa-square-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="hapusKBuku('<?= $sub_k['id_sub_kategori'] ?>', '<?= $sub_k['nama_sub_kategori'] ?>')">
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
	    <!-- <script>
	      $(document).ready(function() {
		  $('#myTablekategori').DataTable();
	      });
          
	    </script> -->
	    <script src="<?= base_url() ?>sweetalert/alert.js"></script>
	    <!-- script edit kategori buku -->
        <script>
		$(document).on('click', '#btn-edit-sub-k', function() {
		    $('.modal-body #kategori_id ').val($(this).data('kategori_id'));
		    $('.modal-body #id_sub_kategori ').val($(this).data('id_sub_kategori'));
		    $('.modal-body #nama_sub_kategori').val($(this).data('nama_sub_kategori'));
		})
	    </script>

	    <!-- script hapus sub buku -->
	    <script>
		function hapusKBuku(kategori_id, nama_sub_kategori) {
		    Swal.fire({
		        title: "Apa anda yakin?",
		        text: "Data Sub kategori buku : " + nama_sub_kategori + " ini akan terhapus!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#3085d6",
		        cancelButtonColor: "#d33",
		        confirmButtonText: "Ya",
		        cancelButtonText: "Batal" 
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '<?= base_url() ?>hapus_sub_kategori/' + kategori_id;

		        }
		    });
		}
	    </script>


<script src="<?= base_url() ?>popper/popper.js"></script>
            <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
                     
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script> -->
       <!-- Modal Tambah  sub-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH SUB KATEGORI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url() ?>proses_tambah_sub_kategori">
                    <div class="mb-3">
                        <label for="input" class="form-label">Id Sub Kategori</label>
                        <input type="text" class="form-control" name="id_sub_kategori"  aria-describedby="nama sub kategori buku"  value="<?=$kode_sub_kategori?>"readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Nama Sub Kategori</label>
                        <input type="text" class="form-control" name="nama_sub_kategori"  aria-describedby="nama sub kategori buku" placeholder="Nama Sub Kategori">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Dari Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="form-select" placeholder="id_kategori_buku">
                            <?php foreach($semua_kategori_buku as $k_buku ): ?>
                                <option value="<?= $k_buku['kategori_id']?>"><?= $k_buku['nama_kategori']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit sub -->
<div class="modal fade" id="editSBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url() ?>proses_edit_sub_kategori">
                    <div class="mb-3">
                        <label for="input" class="form-label">Id Sub Kategori</label>
                        <input type="text" class="form-control" name="id_sub_kategori" id="id_sub_kategori" aria-describedby="id_sub_kategori" placeholder="id_sub_kategori" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Sub Kategori</label>
                        <input type="text" class="form-control" name="nama_sub_kategori" id="nama_sub_kategori" aria-describedby="nama kategori buku" placeholder="Nama Kategori Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Dari Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="form-select" placeholder="id_kategori_buku">
                            <?php foreach($semua_kategori_buku as $k_buku ): ?>
                                <option value="<?= $k_buku['kategori_id']?>"><?= $k_buku['nama_kategori']?></option>
                            <?php endforeach; ?>
                        </select>
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
