<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <!-- FAVICON --> 
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/images/brand/logo-1.png" />

    <!-- TITLE -->
    <title><?= $title ?> | <?= SITE_NAME; ?></title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/dark-style.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/transparent-style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url() ?>/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/assets/colors/color1.css" />
</head>

<body class="dark-mode">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?php echo base_url() ?>/assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="<?php echo base_url() ?>/assets/images/brand/logo-white.png" class="header-brand-img" alt="">
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form method="post" action="<?php echo base_url('do_auth'); ?>" class="login100-form validate-form">
                            <span class="login100-form-title pb-5">
                                Login
                            </span>
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading ">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <!-- <ul class="nav panel-tabs">
                                            <li class="mx-0"><a href="#tab5" class="active" data-bs-toggle="tab">Email</a></li>
                                            <li class="mx-0"><a href="#tab6" data-bs-toggle="tab">Mobile</a></li>
                                        </ul> -->
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body p-0 pt-5">

                                    <?php 
                                    $session = session();
                                    $errors = $session->getFlashdata('errors');
                                    if($errors != null): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                            <i class="fa fa-frown-o me-2" aria-hidden="true"></i>
                                            <?php foreach($errors as $err){ echo $err; } ?>
                                        </div>
                                    <?php endif ?>
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <div class="wrap-input100 validate-input input-group" data-bs-validate="">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-face text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0 text-white" type="text" name="username" placeholder="Username">
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0 text-white" type="password" name="password" placeholder="Password">
                                            </div>
                                            <!-- <div class="text-end pt-4">
                                                <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a></p>
                                            </div> -->
                                            <div class="container-login100-form-btn">
                                                <button type="submit" href="index.html" class="login100-form-btn btn-primary">
                                                        Login
                                                </button>
                                            </div>
                                            <!-- <div class="text-center pt-3">
                                                <p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ms-1">Sign UP</a></p>
                                            </div>
                                            <label class="login-social-icon"><span>Login with Social</span></label>
                                            <div class="d-flex justify-content-center">
                                                <a href="javascript:void(0)">
                                                    <div class="social-login me-4 text-center">
                                                        <i class="fa fa-google"></i>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="social-login me-4 text-center">
                                                        <i class="fa fa-facebook"></i>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="social-login text-center">
                                                        <i class="fa fa-twitter"></i>
                                                    </div>
                                                </a>
                                            </div> -->
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <div id="mobile-num" class="wrap-input100 validate-input input-group mb-4">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <span>+91</span>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0">
                                            </div>
                                            <div id="login-otp" class="justify-content-around mb-5">
                                                <input class="form-control text-center w-15" id="txt1" maxlength="1">
                                                <input class="form-control text-center w-15" id="txt2" maxlength="1">
                                                <input class="form-control text-center w-15" id="txt3" maxlength="1">
                                                <input class="form-control text-center w-15" id="txt4" maxlength="1">
                                            </div>
                                            <span>Note : Login with registered mobile number to generate OTP.</span>
                                            <div class="container-login100-form-btn ">
                                                <a href="javascript:void(0)" class="login100-form-btn btn-primary" id="generate-otp">
                                                    Proceed
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="<?php echo base_url() ?>/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url() ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="<?php echo base_url() ?>/assets/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="<?php echo base_url() ?>/assets/js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="<?php echo base_url() ?>/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="<?php echo base_url() ?>/assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="<?php echo base_url() ?>/assets/js/custom1.js"></script>

</body>

</html>