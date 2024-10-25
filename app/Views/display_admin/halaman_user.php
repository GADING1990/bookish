

     
<div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Dashboard</h1>
                            <div class="row">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <table id="myTablekategori" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Id user</th>
                                                <th>username</th>
                                                <th>password</th>
                                                <th>email</th>
                                                <th>nama_lengkap</th>
                                                <th>aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; foreach($semua_member as $member): ?>
                                                <tr>
                                                    <td><?= $member['user_id'] ?></td>
                                                    <td><?= $member['username'] ?></td>
                                                    <td><?= $member['password'] ?></td>
                                                    <td><?= $member['email'] ?></td>
                                                    <td><?= $member['nama_lengkap'] ?></td>
                                                    <td>      <button type="button" class="btn btn-success mr-2" id="btn-edit-user"
                                                        data-bs-toggle="modal"  data-bs-target="#editPetugas"
                                                        data-nama_lengkap="<?= $member['nama_lengkap'] ?>"
                                                        data-email="<?= $member['email'] ?>"
                                                        data-alamat="<?= $member['alamat'] ?>"
                                                        data-user_id="<?= $member['user_id'] ?>"
                                                        data-username="<?= $member['username'] ?>"
                                                        data-password="<?= $member['password'] ?>"
                                                        > <i class="fa-solid fa-square-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="hapusPetugas('<?= $member['user_id'] ?>', '<?= $member['nama_lengkap'] ?>')">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                                
                                            </tr>
                                            <?php endforeach; ?>
                                                            
                                            </tbody>
                                        </table>
                                    </div>

                        </div>
                  <!-- script jquery -->
                  <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>
                <!-- script datatables -->
                <script src="<?= base_url() ?>DataTables/datatables.min.js"></script>  
                <script>
                    $(document).ready(function() {
                        $('#myTablekategori').DataTable();
                    });
                </script>
                <!-- script sweetalert -->
                <script src="<?= base_url() ?>sweetalert/alert.js"></script>
                <!-- script edit member -->
                <script>
                    $(document).on('click', '#btn-edit-user', function() {
                        $('.modal-body #user_id').val($(this).data('user_id'));
                        $('.modal-body #nama_lengkap').val($(this).data('nama_lengkap'));
                        $('.modal-body #alamat').val($(this).data('alamat'));
                        $('.modal-body #email').val($(this).data('email'));
                        $('.modal-body #username').val($(this).data('username'));
                        $('.modal-body #password').val($(this).data('password'));
                    })
                </script>
                <!-- script hapus member -->
                <script>
                    function hapusPetugas(id_role, nama_lengkap) {
                        Swal.fire({
                            title: "Apa anda yakin?",
                            text: "Data Member Dengan Nama : " + nama_lengkap + " ini akan terhapus!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ya",
                            cancelButtonText: "Batal" 
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?= base_url() ?>hapus_user/' + id_role;
                            }
                        });
                    }
                    </script>
                     
        <script src="<?= base_url() ?>popper/popper.js"></script>
            <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
        
          <!-- Modal Edit member-->
          <div class="modal fade" id="editPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Member</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= base_url() ?>edit_user">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="mb-3">
                                <label for="input" class="form-label">Id user</label>
                                <input type="email" class="form-control" name="user_id" id="user_id" readonly>
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
                                <label for="input" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username">
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
