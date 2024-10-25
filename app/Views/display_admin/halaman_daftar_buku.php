
<div id="layoutSidenav_content">
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Dashboard</h1>
                            <div class="row">
                                <button type="button" class="btn btn-primary" style="width: 200px"d data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah buku
                                </button>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <table id="myTablekategori" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                  
                                                    <th>Id Buku</th>
                                                    <th>Sampul</th>
                                                    <th>Judul</th>
                                                    <th>Nama Kategori</th>
                                                    <th>Nama Sub Kategori</th>
                                                    <th>Penulis</th>
                                                    <th>sinopsis</th>
                                                    <th>Penerbit</th>
                                                    <th>Tahun Terbit</th>
                                                    <th>Stok</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; foreach($semua_daftar_buku as $k_buku): ?>
                                            <tr>
                                           
                                                <td><?= $k_buku['buku_id'] ?></td>
                                                <td><img src="<?= base_url() ?>buku/<?= $k_buku['cover'] ?>" alt="" width="50"></td>

                                                <td><?= $k_buku['judul'] ?></td>
                                                <td><?= $k_buku['nama_kategori'] ?></td>
                                                <td><?= $k_buku['nama_sub_kategori'] ?></td>
                                                <td><?= $k_buku['penulis'] ?></td>
                                                <td><?= $k_buku['sinopsis'] ?></td>
                                                <td><?= $k_buku['penerbit'] ?></td>
                                                <td><?= $k_buku['tahun_terbit'] ?></td>
                                                <td><?= $k_buku['stok'] ?></td>
                                                <td>

                                                <!-- BUTTON TAMBAH DAFTAR BUKU -->
                                                <button type="button" class="btn btn-success mr-2" id="btn-edit-k-buku"
                                                        data-bs-toggle="modal"  data-bs-target="#editKBuku"
                                                        data-buku_id ="<?= $k_buku['buku_id'] ?>"
                                                        data-judul="<?= $k_buku['judul'] ?>"
                                                        data-penulis="<?= $k_buku['penulis'] ?>"
                                                        data-sinopsis="<?= $k_buku['sinopsis'] ?>"
                                                        data-tahun_terbit="<?= $k_buku['tahun_terbit'] ?>"
                                                        data-stok="<?= $k_buku['stok'] ?>"
                                                        data-penerbit="<?= $k_buku['penerbit'] ?>"
                                                        > <i class="fa-solid fa-square-pen"></i>
                                                    </button>
                                                    
                                                      <!-- BUTTON  HAPUS BUKU-->
                                                    <button type="button" class="btn btn-danger" onclick="hapusKBuku('<?= $k_buku['buku_id'] ?>', '<?= $k_buku['judul'] ?>')">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                             
                                                    <!-- BUTTON EDIT KATEGORI DAN SUB BUKU -->
                                                </button>
                                                    <button type="button" class="btn btn-success mt-3" id="btn-edit-buku-sub-k"
                                                        data-bs-toggle="modal"  data-bs-target="#editSubKatBuku"
                                                        data-buku_id="<?= $k_buku['buku_id'] ?>"
                                                        data-judul="<?= $k_buku['judul'] ?>"
                                                        data-kategori_id="<?= $k_buku['kategori_id'] ?>"
                                                        data-id_sub_kategori="<?= $k_buku['id_sub_kategori'] ?>"
                                                        data-nama_kategori="<?= $k_buku['nama_kategori'] ?>"
                                                        data-nama_sub_kategori="<?= $k_buku['nama_sub_kategori'] ?>"
                                                      
                                                        >
                                                        Edit 
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
            
<script>
    $(function () {
        $("#kategori_id").change(function () {
            
        var selectedKategori = $(this).val();

        if (selectedKategori !== 'null') {
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>/admin/getDataByKategori',
                data: {
                    kategori_id: selectedKategori
                },
                cache: false,
                success: function(response) {
                    // Handle response datas
                    $("#loadSubKategori").html(response);
                }
            });

        } else {
            $("#loadSubKategori").html('');
        }
        });
    });
    $(function () {
        $("#id_kategori_buku_edit").change(function () {

        var selectedKategori = $(this).val();

        if (selectedKategori !== 'null') {
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>admin/getDataByKategori',
                data: {
                    kategori_id: selectedKategori
                },
                cache: false,
                success: function(response) {
                    // Handle response datas
                    $("#loadSubKategoriEdit").html(response);
                }
            });

        } else {
            $("#loadSubKategoriEdit").html('');
        }
        });
    });
</script>
	    <script src="<?= base_url() ?>DataTables/datatables.min.js"></script>  
	    <script>
	      $(document).ready(function() {
		  $('#myTablekategori').DataTable();
	      });
	    </script>
	    <script src="<?= base_url() ?>sweetalert/alert.js"></script>

	    <!-- script edit daftar buku -->
	    <script>
		$(document).on('click', '#btn-edit-k-buku', function() {
            $('.modal-body #kategori_id').val($(this).data('kategori_id'));
            $('.modal-body #id_sub_kategori').val($(this).data('id_sub_kategori'));
            $('.modal-body #buku_id').val($(this).data('buku_id'));
            $('.modal-body #judul').val($(this).data('judul'));
		    $('.modal-body #nama_kategori ').val($(this).data('nama_kategori'));
		    $('.modal-body #nama_sub_kategori').val($(this).data('nama_sub_kategori'));
            $('.modal-body #penulis').val($(this).data('penulis'));
            $('.modal-body #penerbit').val($(this).data('penerbit'));
            $('.modal-body #tahun_terbit').val($(this).data('tahun_terbit'));
            $('.modal-body #stok').val($(this).data('stok'));
            $('.modal-body #cover').file($(this).data('cover'));
		})
	    </script>


	    <!-- script hapus buku -->
	    <script>
		function hapusKBuku(buku_id, judul) {
		    Swal.fire({
		        title: "Apa anda yakin?",
		        text: "Data Daftar buku : " + judul + " ini akan terhapus!",
		        icon: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#3085d6",
		        cancelButtonColor: "#d33",
		        confirmButtonText: "Ya",
		        cancelButtonText: "Batal" 
		    }).then((result) => {
		        if (result.isConfirmed) {
		            window.location.href = '<?= base_url() ?>hapus_daftar_buku/' + buku_id;

		        }
		    });
		}
	    </script>

  <!-- script Edit buku -->
            <script>
                $(document).on('click', '#btn-edit-buku-sub-k', function() {
                    $('.modal-body #kategori_id').val($(this).data('kategori_id'));
                    $('.modal-body #id_sub_kategori').val($(this).data('id_sub_kategori'));
                    $('.modal-body #buku_id').val($(this).data('buku_id'));
                    $('.modal-body #judul').val($(this).data('judul'));
                    $('.modal-body #penulis').val($(this).data('penulis'));
                    $('.modal-body #penerbit').val($(this).data('penerbit'));
                    $('.modal-body #tahun_terbit').val($(this).data('tahun_terbit'));
                    $('.modal-body #stok').val($(this).data('stok'));
                    $('.modal-body #sinopsis').val($(this).data('sinopsis'));
                    $('.modal-body #nama_kategori').val($(this).data('nama_kategori'));
                    $('.modal-body #nama_sub_kategori').val($(this).data('nama_sub_kategori'));
                })
            </script>

<!-- Modal Edit Kategori dan sub kategori Buku-->
<div class="modal fade" id="editSubKatBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url() ?>proses_edit_kategori_sub_buku" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="input" class="form-label">Id Buku</label>
                        <input type="text" class="form-control"  id="buku_id" name="buku_id" id="id_sub_kategori" aria-describedby="judul buku" placeholder="Judul Buku" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Judul</label>
                        <input type="text" class="form-control" value="" id="judul" name="judul"  aria-describedby="judul buku" placeholder="Judul Buku" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Nama Kategori Lama</label>
                        <input type="text" class="form-control" value="" id="nama_kategori" name="kategori_id" id="id_sub_kategori" aria-describedby="judul buku" placeholder="Belum Ada Kategori" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Nama Sub Kategori Lama</label>
                        <input type="text" class="form-control" name="nama_sub_kategori" id="nama_sub_kategori" aria-describedby="judul buku" placeholder="Belum Ada Sub Kategori" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Nama Kategori Baru</label>
                        <select  id="id_kategori_buku_edit" name="kategori_id" class="form-select" placeholder="kategori_id">
                            <option value="null">--Pilih Kategori--</option>
                            <?php foreach($semua_kategori_buku as $k_buku ): ?>
                            <option value="<?= $k_buku['kategori_id']?>"><?= $k_buku['nama_kategori']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 " id="loadSubKategoriEdit" >
                            
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                </form>
                 </div>
             </div>
         </div>
    </div>
 </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <!-- Modal tambah  buku-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH BUKU</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="<?= base_url() ?>proses_tambah_buku" enctype="multipart/form-data">           
                    <div class="mb-3">
                        <label for="input" class="form-label">Id Buku</label>
                        <input type="text" class="form-control" name="buku_id"  aria-describedby="judul buku" placeholder="Judul Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul"  aria-describedby="judul buku" placeholder="Judul Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="penulis"  aria-describedby="penulis buku" placeholder="Penulis Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Sinopsis</label>
                        <input type="text" class="form-control" name="sinopsis"  aria-describedby="sinopsis" placeholder="sinopsis">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit"  aria-describedby="penerbit buku" placeholder="Penerbit Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit"  aria-describedby="Tahun Terbit buku" placeholder="Tahun Terbit Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok"  aria-describedby="Tahun Terbit buku" placeholder="Stok Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Kategori Buku</label>
                        <select  id="kategori_id" name="kategori_id" class="form-select" placeholder="kategori_id">
                            <option value="null">--Pilih Kategori--</option>
                            <?php foreach($semua_kategori_buku as $k_buku ): ?>
                            <option value="<?= $k_buku['kategori_id']?>"><?= $k_buku['nama_kategori']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 " id="loadSubKategori" >
                            
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">cover</label>
                        <input type="file" class="form-control" name="cover"aria-describedby="sampul buku" placeholder="Sampul Buku" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                </form>
            </div>
        
            </div>
        </div>
        </div>

        <!-- Modal Edit Buku-->
    <div class="modal fade" id="editKBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url() ?>proses_edit_buku" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="buku_id" id="buku_id" aria-describedby="id judul buku" placeholder="Judul Buku">
                    <div class="mb-3">
                        <label for="input" class="form-label">Id Buku</label>
                        <input type="text" class="form-control" id="buku_id" name="buku_id" aria-describedby="judul buku" placeholder="Judul Buku" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" aria-describedby="judul buku" placeholder="Judul Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" aria-describedby="penulis buku" placeholder="Penulis Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Sinopsis</label>
                        <input type="text" class="form-control" name="sinopsis"  aria-describedby="sinopsis" placeholder="sinopsis">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" aria-describedby="penerbit buku" placeholder="Penerbit Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit" id="tahun_terbit" aria-describedby="Tahun Terbit buku" placeholder="Tahun Terbit Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok" aria-describedby="Tahun Terbit buku" placeholder="Stok Buku">
                    </div>
                    <div class="mb-3">
                        <label for="input" class="form-label">Sampul</label>
                        <input type="file" class="form-control" name="cover" id="cover" aria-describedby="sampul buku" placeholder="Sampul Buku">
                        <?= csrf_field() ?>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                </form>
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
