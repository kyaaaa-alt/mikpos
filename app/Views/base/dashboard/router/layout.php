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

    <!-- SWEET ALERT 2 DARK CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/assets/css/sweetalert2dark.css" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/assets/colors/color1.css" />

</head>

<body class="app sidebar-mini ltr dark-mode">
    <!-- GLOBAL-LOADER -->
    <div id="global-loader" style="background-color:#1a1a3c;">
        <img src="<?php echo base_url() ?>/assets/images/brand/loader-white.gif" class="loader-img" alt="Loader">
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
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold"><?= $_SESSION['uname']; ?></h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item" href="/router/do_unauth">
                                            <i class="dropdown-icon fe fe-alert-circle"></i> Log out
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
                                <a class="side-menu__item" data-bs-toggle="slide" href="list"><i
                                        class="side-menu__icon fe fe-cpu"></i><span
                                        class="side-menu__label">Router List</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="addrouter"><i
                                        class="side-menu__icon fe fe-hard-drive"></i><span
                                        class="side-menu__label">Add Router</span></a>
                            </li>

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
                            <h1 class="page-title"><?= $title; ?></h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->
                    <!-- PAGE-ROWS -->
                    <?php                 
                    echo view($view);
                    ?>
                    <!-- PAGE-ROWS END -->
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>/assets/js/jquery.min.js"></script>
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
    $("form[name='formedit']").submit(function(){
        $("#simpanedit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Process...');
        $("#simpanedit").prop("disabled", true);
        $("form[name='formedit']")[0].submit();
    });
    $('#editModal').on('show.bs.modal', function(e) {
        $('#rname').html($(e.relatedTarget).data('router_name'));
        $('#router_id').val($(e.relatedTarget).data('router_id'));
        $('#router_name').val($(e.relatedTarget).data('router_name'));
        $('#router_dns').val($(e.relatedTarget).data('router_dns'));
        $('#router_host').val($(e.relatedTarget).data('router_host'));
        $('#router_port').val($(e.relatedTarget).data('router_port'));
        $('#router_user').val($(e.relatedTarget).data('router_user'));
        $('#traffic_interface').val($(e.relatedTarget).data('traffic_interface'));
    });
    </script>

</body>

</html>