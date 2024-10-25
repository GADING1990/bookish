
<div id="layoutSidenav_content">
                <main>
                <div class="container text-center mt-5 PY-5">
                <div class="row row-cols-4 row-cols-lg-5 g-2 g-lg-3">
                    <div class="col">
                        <div class="card bg-success text-white mt-5">
                        <div> 
                        <?php
                        // Mendapatkan indeks bulan saat ini
                        $bulan_sekarang = date('n'); 
                        // Mendapatkan nama bulan saat ini 
                        $namaBulanSaatIni = $nm_bulan[$bulan_sekarang]; //$nm_bulan dari controller
                        ?>
                        <h5>Total Peminjam Bulan <?= $namaBulanSaatIni ?></h5></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="fs-4 fw-semibold"><?= $total_peminjaman->total_peminjaman?></div>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-warning text-white mt-5">
                        <div> 
                        <?php
                        // Mendapatkan indeks bulan saat ini
                        $bulan_sekarang = date('n'); 
                        // Mendapatkan nama bulan saat ini 
                        $namaBulanSaatIni = $nm_bulan[$bulan_sekarang]; //$nm_bulan dari controller
                        ?>
                        <h5>Total Peminjam Bulan <?= $namaBulanSaatIni ?></h5></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="fs-4 fw-semibold"><?= $total_peminjaman->total_peminjaman?></div>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                                    
                                            <!-- script jquery -->
                <script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
