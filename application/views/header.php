<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>PT.PILAR PUTR</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/core-style.css") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css") ?>">
    <link href="<?php echo base_url("assets/css/modstyle.css") ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://colorlib.com/tyche/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=3.4.4">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Responsive CSS -->
    <link href="<?php echo base_url("assets/css/responsive.css") ?>" rel="stylesheet">
</head>

<body>

    <div id="wrapper" class="">

        <!-- ****** Header Area Start ****** -->
        <header class="header_area bg-img background-overlay-white" style="background-image: url(<?php echo base_url("assets/") ?>img/bg-img/bg-1.jpg);">
            <!-- Top Header Area Start -->
            <div class="top_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-end">

                        <div class="col-12 col-lg-7">
                            <div class="top_single_area d-flex align-items-center">
                                <!-- Logo Area -->
                                <div class="top_logo">
                                    <a href="#"><img src="<?php echo base_url("assets/") ?>img/core-img/logo.png" alt=""></a>
                                </div>
                                <!-- Cart & Menu Area -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Top Header Area End -->
            <div class="main_header_area">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-12 d-md-flex justify-content-between">
                        
                            <!-- Menu Area -->
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">
                                	<?php $device = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); 
                                	if($device){?>
                                		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>
                                	<?php } ?>

                                    <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                        <ul class="navbar-nav animated" id="nav">
                                            <li class="nav-item active"><a class="nav-link" href="<?php echo base_url() ?>">Home</a></li>
                                            <?php
                                            if($this->session->userdata('idcus')){?>
                                                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('profil') ?>">Profil</a></li>
                                            <?php }?>
                                            <!-- <li class="nav-item"><a class="nav-link" href="<?php //echo base_url('kontak') ?>">Contact</a></li> -->
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <!-- Help Line -->
	                            <div class="help-line">
	                            	<?php 
	                            		if($this->session->userdata('idcus')){?>
								        	<a href="<?php echo base_url('logout') ?>">Logout</a>
								        <?php }else{ ?>
								        	<a href="<?php echo base_url('login') ?>">Masuk</a>
								        <?php }
	                            	?>
	                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ****** Header Area End ****** -->

        

        
        
        

        

        
        
        
    </div>
    <!-- /.wrapper end -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="<?php echo base_url("assets/") ?>js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url("assets/") ?>js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url("assets/") ?>js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url("assets/") ?>js/plugins.js"></script>
    <script src="<?php echo base_url("assets/") ?>js/active.js"></script>


</body></html>