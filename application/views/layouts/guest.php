<?php $this->load->view('partials/head'); ?>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <?php $this->load->view('pages/'.$pages); ?>
    

<?php $this->load->view('partials/plugins'); ?>