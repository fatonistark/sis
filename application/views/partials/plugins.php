    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= site_url('assets') ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= site_url('assets') ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= site_url('assets') ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?= site_url('assets') ?>/dist/js/feather.min.js"></script>
    <script src="<?= site_url('assets') ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= site_url('assets') ?>/dist/js/sidebarmenu.js"></script>
    <script src="<?= site_url('assets') ?>/dist/js/custom.min.js"></script>
    <script src="<?= site_url('assets') ?>/dist/js/app-style-switcher.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function notification(title, message) {
            Swal.fire({
                position: 'center',
                icon: title,
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>

    <script type="text/javascript">
        // 1 detik = 1000
        window.setTimeout("waktu()",1000);  
        function waktu() {   
        var tanggal = new Date();  
        setTimeout("waktu()",1000);  
            document.getElementById("jam").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
        }
    </script>

    <script type="text/javascript">
        var tanggallengkap = new String();
        var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
        namahari = namahari.split(" ");
        var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
        namabulan = namabulan.split(" ");
        var tgl = new Date();
        var hari = tgl.getDay();
        var tanggal = tgl.getDate();
        var bulan = tgl.getMonth();
        var tahun = tgl.getFullYear();
        tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;

        $('#hari').html(tanggallengkap);
    </script>
    
    <?php if (!empty($js)) {
        $this->load->view('js/'.$js);
    } ?>

</body>

</html>