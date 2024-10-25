
<div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Dashboard</h1>
                            <div class="row">
                                <button type="button" class="btn btn-primary" style="width: 200px"d data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah admin
                                </button>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <table id="myTablekategori" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                <th>Id admin</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No Telpon</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                                            </thead>
                                            <body>
                                            <?php foreach($semua_daftar_admin as $admin): ?>
                                            <tr>
                                                <td><?= $admin['id_role'] ?></td>
                                                <td><?= $admin['nama_lengkap'] ?></td>
                                                <td><?= $admin['email'] ?></td>
                                                <td><?= $admin['alamat'] ?></td>
                                                <td><?= $admin['no_tlp'] ?></td>
                                                <td><?= $admin['password'] ?></td>
                                                <td><?= $admin['role'] ?></td>
                                                <td>
                                                <!-- BUTTON TAMBAH  admin-->
                                                <button type="button" class="btn btn-success mr-2" id="btn-edit-k-buku"
                                                        data-bs-toggle="modal"  data-bs-target="#editAdmin"
                                                        data-id_role ="<?= $admin['id_role'] ?>"
                                                        data-nama_lengkap="<?= $admin['nama_lengkap'] ?>"
                                                        data-email="<?= $admin['email'] ?>"
                                                        data-alamat="<?= $admin['alamat'] ?>"
                                                        data-no_tlp="<?= $admin['no_tlp'] ?>"                                                        
                                                        data-password="<?= $admin['password'] ?>"
                                                        data-role="<?= $admin['role'] ?>"
                                                        > <i class="fa-solid fa-square-pen"></i>
                                                    </button>
                                                    
                                                      <!-- BUTTON  HAPUS admin-->
                                                    <button type="button" class="btn btn-danger" onclick="hapus_admin('<?= $admin['id_role'] ?>', '<?= $admin['nama_lengkap'] ?>')">
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
	    <!-- script edit admin -->
	    <script>
		$(document).on('click', '#btn-edit-k-buku', function() {
		    $('.modal-body #id_role').val($(this).data('id_role'));
		    $('.modal-body #nama_lengkap').val($(this).data('nama_lengkap'));
		    $('.modal-body #email').val($(this).data('email'));
		    $('.modal-body #alamat').val($(this).data('alamat'));
		    $('.modal-body #no_tlp').val($(this).data('no_tlp'));
		    $('.modal-body #password').val($(this).data('password'));
		    $('.modal-body #role').val($(this).data('role'));
		})
	    </script>


	    <!-- script hapus buku -->
	    <script>
		function hapus_admin(id_role, nama_lengkap) {
		    Swal.fire({
		        title: "Apa anda yakin?",
		        text: "Data Nama Admin ini : " + nama_lengkap + " ini akan terhapus!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#3085d6",
		        cancelButtonColor: "#d33",
		        confirmButtonText: "Ya",
		        cancelButtonText: "Batal" 
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '<?= base_url() ?>hapus_petugas/' + id_role;

		        }
		    });
		}
	    </script>

                     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <!-- Modal tambah admin-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="<?= base_url() ?>proses_tambah_Admin">
                <div class="mb-3">
                    <label for="input" class="form-label">Id Petugas</label>
                    <input type="text" class="form-control" name="id_role"value="<?= $kode_admin ?>">
                </div>    
                <div class="mb-3">
                    <label for="input" class="form-label"> Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap">
                </div>
                <div class="mb-3">
                    <label for="input" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="input" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="input" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label for="input" class="form-label">Nomor Telpon</label>
                    <input type="text" class="form-control" name="no_tlp">
                </div>
                <div class="mb-3">
                    <label for="input" class="form-label">Role</label>
                    <input type="text" class="form-control" name="role">
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Tambah</button>
            </form>
            </div>
        
            </div>
        </div>
        </div>

      <!-- Modal Edit Admin-->
<div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url() ?>proses_edit_admin">
                    <input type="hidden" name="id_role" id="id_role">
                    <div class="mb-3">
                        <label for="input" class="form-label">Role</label>
                        <input type="email" class="form-control" name="role" id="role" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                    </div> 
                    <div class="mb-3">
                        <label for="input" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">No Telpon</label>
                        <input type="text" class="form-control" name="no_tlp" id="no_tlp">
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="alamat" name="alamat"></textarea>
                            <label for="floatingTextarea">Alamat</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" id="password">
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
