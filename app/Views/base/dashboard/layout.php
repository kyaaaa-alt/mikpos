<!doctype html>
<html lang="en">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/images/brand/logo-1.png" />

    <!-- TITLE -->
    <title><?= $title; ?> | <?= SITE_NAME; ?></title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/dark-style.css" rel="stylesheet" />
    
    <!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url() ?>/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/assets/colors/color1.css" />

    <!-- SWEET ALERT 2 DARK CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/assets/css/sweetalert2dark.css" />

    <!-- CUSTOM CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/assets/css/custom.css" />

</head>

<body class="app sidebar-mini ltr dark-mode">
    <!-- GLOBAL-LOADER -->
    <div id="global-loader" style="background-color:#1a1a3c;">
        <img src="<?php echo base_url() ?>/assets/images/brand/loader-white.gif" class="loader-img" alt="Loader">
        <span style="margin-top: 3rem !important;" class="loader-img text-white warningloader">
            Loading...<br/>
            Proses pengambilan data dari mikrotik...<br/>
        </span>
    </div>
    <!-- /GLOBAL-LOADER -->
    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="">
                            <img src="<?php echo base_url() ?>/assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="<?php echo base_url() ?>/assets/images/brand/logo-3.png" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                        
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            
                            <div class="d-flex country">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <img src="<?php echo base_url() ?>/assets/images/users/1.jpg" alt="profile-user"
                                        class="avatar  profile-user brround cover-image">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                         <div class="text-center">
                                            <?php 
                                            foreach ($router as $row) {
                                                $router_name = $row->router_name;
                                            }
                                            ?>
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold"><?= $_SESSION['uname'] ?></h5>
                                            <small class="text-muted"><?= $router_name ?></small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                       
                                        <a class="dropdown-item" href="">
                                            <i class="dropdown-icon fe fe-user"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="do_unauth_router">
                                            <i class="dropdown-icon fe fe-alert-circle"></i> Log out router
                                        </a>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="">
                            <img src="<?php echo base_url() ?>/assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="<?php echo base_url() ?>/assets/images/brand/logo-1.png" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="<?php echo base_url() ?>/assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                            <img src="<?php echo base_url() ?>/assets/images/brand/logo-3.png" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="dashboard"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>

                            <li class="sub-category" style="margin-top:15px">
                                <h3><i class="fe fe-server"></i> PPPoE</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="pppprofiles"><i
                                            class="side-menu__icon fe fe-layers"></i><span
                                            class="side-menu__label">PPPoE Profiles</span></a>
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="pppsecrets"><i
                                        class="side-menu__icon fe fe-shield"></i><span
                                        class="side-menu__label">PPPoE Secrets</span></a>
                            </li>

                            <li class="sub-category"  style="margin-top:15px">
                                <h3><i class="fe fe-wifi"></i> Hotspot</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="userprofiles"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Hotspot Profiles</span></a>
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="userlist"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Hotspot Users</span></a>
                                <!-- <a class="side-menu__item" data-bs-toggle="slide" href="extendexpire"><i
                                        class="side-menu__icon fe fe-clock"></i><span
                                        class="side-menu__label">Perpanjang User</span></a>        
                                <a class="side-menu__item" data-bs-toggle="slide" href="adduser"><i
                                        class="side-menu__icon fe fe-user-plus"></i><span
                                        class="side-menu__label">Add User</span></a>
                                <a class="side-menu__item" data-bs-toggle="slide" href="generateusers"><i
                                        class="side-menu__icon fe fe-user-plus"></i><span
                                        class="side-menu__label">Generate</span></a>         -->
                            </li>

                            <li class="sub-category" style="margin-top:15px">
                                <h3><i class="fe fe-credit-card"></i> Pembayaran</h3>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="paymentsettings"><i
                                        class="side-menu__icon fe fe-settings"></i><span
                                        class="side-menu__label">Payment Settings</span></a>
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="paymentpage"><i
                                        class="side-menu__icon fe fe-bookmark"></i><span
                                        class="side-menu__label">Payment Page</span></a>        
                                <a class="side-menu__item" style="margin-bottom:-15px" data-bs-toggle="slide" href="paymentreport"><i
                                        class="side-menu__icon fe fe-activity"></i><span
                                        class="side-menu__label">Payment Report</span></a>
                            </li>
                            <br>
                            <small style="padding: 12px 30px 2px 20px;">v1.0 beta</small>
<!-- 
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href=""><i
                                        class="side-menu__icon fe fe-list"></i><span
                                        class="side-menu__label">Hotspot Report</span></a>
                            </li> -->

                            <!-- <li class="sub-category">
                                <h3><i class="fa fa-gear"></i> Settings</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href=""><i
                                            class="side-menu__icon fa fa-gear"></i><span
                                            class="side-menu__label">Payment</span></a>

                                <a class="side-menu__item" data-bs-toggle="slide" href=""><i
                                            class="side-menu__icon fa fa-gear"></i><span
                                            class="side-menu__label">Template Voucher</span></a>

                                <a class="side-menu__item" data-bs-toggle="slide" href=""><i
                                            class="side-menu__icon fa fa-gear"></i><span
                                            class="side-menu__label">Router</span></a>

                                <a class="side-menu__item" data-bs-toggle="slide" href=""><i
                                            class="side-menu__icon fa fa-gear"></i><span
                                            class="side-menu__label">Telegram Bot</span></a>
                            </li> -->

                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </div>
                <!--/APP-SIDEBAR-->
            </div>
        
            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title"><?= $icon; ?> <?= $title; ?></h1>

                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->
                    <!-- PAGE-ROWS -->
                    <!-- JQUERY JS -->
                    <script src="<?php echo base_url() ?>/assets/js/jquery.min.js"></script>
                    <?php
                    function formatBytes($size, $precision = 2)
                    {
                        if ($size == '0') {
                            return $size;
                        } else {
                        $base = log($size, 1024);
                        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   
                    
                        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
                        }
                    }
                    function formatDTM($dtm){
                    if(substr($dtm, 1,1) == "d" || substr($dtm, 2,1) == "d"){
                        $day = explode("d",$dtm)[0]."d";
                        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
                        $dtm = explode("d",$dtm)[1];
                    }elseif(substr($dtm, 1,1) == "w" && substr($dtm, 3,1) == "d" || substr($dtm, 2,1) == "w" && substr($dtm, 4,1) == "d"){
                        $day = explode("d",$dtm)[0]."d";
                        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
                        $dtm = explode("d",$dtm)[1];
                    }elseif (substr($dtm, 1,1) == "w" || substr($dtm, 2,1) == "w" ) {
                        $day = explode("w",$dtm)[0]."w";
                        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
                        $dtm = explode("w",$dtm)[1];
                    }

                    // secs
                    if(strlen($dtm) == "2" && substr($dtm, -1) == "s"){
                        $format = $day." 00:00:0".substr($dtm, 0,-1);
                    }elseif(strlen($dtm) == "3" && substr($dtm, -1) == "s"){
                        $format = $day." 00:00:".substr($dtm, 0,-1);
                    //minutes
                    }elseif(strlen($dtm) == "2" && substr($dtm, -1) == "m"){
                        $format = $day." 00:0".substr($dtm, 0,-1).":00";
                    }elseif(strlen($dtm) == "3" && substr($dtm, -1) == "m"){
                        $format = $day." 00:".substr($dtm, 0,-1).":00";
                    //hours
                    }elseif(strlen($dtm) == "2" && substr($dtm, -1) == "h"){
                        $format = $day." 0".substr($dtm, 0,-1).":00:00";
                    }elseif(strlen($dtm) == "3" && substr($dtm, -1) == "h"){
                        $format = $day." ".substr($dtm, 0,-1).":00:00";
                    
                    //minutes -secs
                    }elseif(strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm,1,-2) == "m"){
                        $format = $day." "."00:0".substr($dtm, 0,1).":0".substr($dtm, 2,-1);
                    }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,1,-3) == "m"){
                        $format = $day." "."00:0".substr($dtm, 0,1).":".substr($dtm, 2,-1);
                    }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,2,-2) == "m"){
                        $format = $day." "."00:".substr($dtm, 0,2).":0".substr($dtm, 3,-1);
                    }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm,2,-3) == "m"){
                        $format = $day." "."00:".substr($dtm, 0,2).":".substr($dtm, 3,-1);

                    //hours -secs
                    }elseif(strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm,1,-2) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":00:0".substr($dtm, 2,-1);
                    }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,1,-3) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":00:".substr($dtm, 2,-1);
                    }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm,2,-2) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":00:0".substr($dtm, 3,-1);
                    }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm,2,-3) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":00:".substr($dtm, 3,-1);

                    //hours -secs
                    }elseif(strlen($dtm) == "4" && substr($dtm, -1) == "m" && substr($dtm,1,-2) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":0".substr($dtm, 2,-1).":00";
                    }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm,1,-3) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":".substr($dtm, 2,-1).":00";
                    }elseif(strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm,2,-2) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":0".substr($dtm, 3,-1).":00";
                    }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "m" && substr($dtm,2,-3) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":".substr($dtm, 3,-1).":00";

                    //hours minutes secs
                    }elseif(strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm,3,-2) == "m" && substr($dtm,1,-4) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":0".substr($dtm, 2,-3).":0".substr($dtm, 4,-1);
                    }elseif(strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm,3,-3) == "m" && substr($dtm,1,-5) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":0".substr($dtm, 2,-4).":".substr($dtm, 4,-1);
                    }elseif(strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm,4,-2) == "m" && substr($dtm,1,-5) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":".substr($dtm, 2,-3).":0".substr($dtm, 5,-1);
                    }elseif(strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm,4,-3) == "m" && substr($dtm,1,-6) == "h"){
                        $format = $day." 0".substr($dtm, 0,1).":".substr($dtm, 2,-4).":".substr($dtm, 5,-1);
                    }elseif(strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm,4,-2) == "m" && substr($dtm,2,-4) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":0".substr($dtm, 3,-3).":0".substr($dtm, 5,-1);
                    }elseif(strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm,4,-3) == "m" && substr($dtm,2,-5) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":0".substr($dtm, 3,-4).":".substr($dtm, 5,-1);
                    }elseif(strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm,5,-2) == "m" && substr($dtm,2,-5) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":".substr($dtm, 3,-3).":0".substr($dtm, 6,-1);
                    }elseif(strlen($dtm) == "9" && substr($dtm, -1) == "s" && substr($dtm,5,-3) == "m" && substr($dtm,2,-6) == "h"){
                        $format = $day." ".substr($dtm, 0,2).":".substr($dtm, 3,-4).":".substr($dtm, 6,-1);

                    }else{
                        $format = $dtm;
                    }
                    return $format;
                    }
                    function rupiah($angka) {
                        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                        return $hasil_rupiah;        
                    }
                    echo view($view);
                    ?>
                    <!-- PAGE-ROWS END -->
                </div>
            </div>
        </div>
    </div>
    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url() ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Sticky js -->
    <script src="<?php echo base_url() ?>/assets/js/sticky.js"></script>

    <!-- SIDEBAR JS -->
    <script src="<?php echo base_url() ?>/assets/plugins/sidebar/sidebar.js"></script>

    <!-- SWEET ALERT 2 JS -->
    <script src="<?php echo base_url() ?>/assets/js/sweetalert2.min.js"></script>

    <!-- DATA TABLE JS-->
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/table-data.js"></script>

    
    <!-- SIDE-MENU JS-->
    <script src="<?php echo base_url() ?>/assets/plugins/sidemenu/sidemenu.js"></script>
    
    <!-- CUSTOM JS -->
    <script src="<?php echo base_url() ?>/assets/js/custom1.js"></script>

    <script>
        $("#warningloader").delay(500).show(200);
        setTimeout("$('#notifikasi').fadeOut(1000);", 8000);
    </script>

</body>

</html>