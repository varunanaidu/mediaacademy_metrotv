<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');?>
<?php
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$link_array = explode('/',$link);
$lastpage = explode('?', end($link_array), 2);
$last = $lastpage[0];
$last = ($last == "") ? '' : ' - '.ucfirst(str_replace('-',' ',$last));
$isLogin = $this->session->userdata('fc_recruitment');
if (isset($fc_alert)) {
    $type = $fc_alert['type'];
    $msg = $fc_alert['msg'];
}else{
    $type = '';
    $msg = '';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Training dan Sertifikasi Profesi diperuntukkan bagi kalangan internal Media Group, baik News, Food Industries maupun Hospitality.">
    <meta name="keywords" content="training, sertifikasi profesi, media group, media academy, metro tv">
    <title>Media Academy</title>
    <link rel="icon" href="<?php echo base_url()?>media/backend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet/less" href="<?php echo base_url(); ?>assets/css/main.less">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/owlcarousel/assets/owl.theme.default.min.css">

<!-- Css Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template/style.css" type="text/css">
<!-- Css Styles -->

    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/lightbox2-2.11.1/dist/css/lightbox.css"> -->
    <script src="<?php echo base_url(); ?>assets/js/vendor/jquery-3.4.1.min.js"></script>
    <!--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <style type="text/css">body{height:auto;}</style>
</head>
<body>
    <div class="header">
        <div class="frame">
            <div class="wrap">
                <ul class="info_head">
                    <li class="info_list info_call">
                        <span><i class="fa fa-phone"></i>+6221 - 5830 0077</span>
                    </li>
                    <li class="info_list info_call">
                        <span><i class="fa fa-phone"></i>+62 811-1300-1548</span>
                    </li>
                    <li class="info_list info_mail">
                        <span><i class="fa fa-envelope"></i>mail@media-academy.id</span>
                    </li>
                </ul>
                <div class="block_menu">
                    <!-- MENU SLIDE -->
                    <div class="btm" id="bar">
                        <span class="fa fa-bars"></span>
                    </div>
                    <div class="sliders" id="sld">
                        <ul class="sl">
                            <li><a href="#" id="back"><span class="fa fa-arrow-left fa-lg"></span></a></li>
                            <li <?= (end($lastpage) == 'home' || end($lastpage) == 'index' ) ? 'class="act"' : '' ?>><a href="<?php echo site_url('home')?>" title="HOME">HOME</a></li>
                            <li <?= (end($lastpage) == 'tentang') ? 'class="act"' : '' ?>><a href="<?php echo site_url('tentang')?>" title="Tentang">TENTANG</a></li>            
                            <li <?= (end($lastpage) == 'akreditasi') ? 'class="act"' : '' ?>><a href="<?php echo site_url('akreditasi')?>" title="Akreditasi">AKREDITASI</a></li>
                            <li <?= (end($lastpage) == 'program') ? 'class="act"' : '' ?>><a href="<?php echo site_url('program')?>" title="Program">PROGRAM</a></li>        
                            <li <?= (end($lastpage) == 'aktivitas') ? 'class="act"' : '' ?>><a href="<?php echo site_url('aktivitas')?>" title="Aktivitas">AKTIVITAS</a></li>   
                            <?php
                            if ($isLogin) {
                                ?>
                                <!-- Notifications -->
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle metro-link" data-toggle="dropdown" role="button">
                                        <img src="<?php echo base_url(); ?>assets/images/main/man-user.png" class="userlogin">
                                        <span class=""><?=$this->session->userdata('fc_member')->log_email?></span>
                                    </a>      
                                    <ul class="sl">
                                        <li>
                                            <a href="<?=base_url('myaccount')?>" class="btn btn-link fc_nav_link">
                                                <span>My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('site/change_password')?>" class="btn btn-link fc_nav_link">
                                                <span>Change Password</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('site/logout')?>" class="btn btn-link fc_nav_link">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php 
                            }  else{
                               ?>
                               <li class="register"><a href="#" title="register">REGISTER</a></li>
                               <li class="login"><a href="#" title="login">LOGIN</a></li>
                               <?php 
                           }
                           ?>
                       </ul>
                   </div>
                   <!-- MENU SLIDE -->
                   <a class="logo_header" href="<?php echo site_url('#home')?>" title="Media Academy">
                    <img src="<?php echo base_url(); ?>assets/images/main/logo_mainma.png" alt="Media Academy"/>
                </a>
                <ul class="m1 menu ">
                    <li data-id="home"><a name="aMenu" href="<?php echo site_url('#home')?>" class="scroll" title="HOME">HOME</a></li>
                    <li data-id="tentang"><a name="aMenu" href="<?php echo site_url('#tentang')?>" class="scroll" title="Tentang">TENTANG</a></li>
                    <li data-id="akreditasi"><a name="aMenu" href="<?php echo site_url('#akreditasi')?>" class="scroll" title="Akreditasi">AKREDITASI</a></li>
                    <li data-id="program"><a name="aMenu" href="<?php echo site_url('#program')?>" class="scroll" title="Program">PROGRAM</a></li>
                    <li data-id="aktivitas"><a name="aMenu" href="<?php echo site_url('#aktivitas')?>" class="scroll" title="Aktivitas">AKTIVITAS</a></li>

                    <?php
                    if ($isLogin) {
                        ?>
                        <!-- Notifications -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle metro-link" data-toggle="dropdown" role="button">
                                <img src="<?php echo base_url(); ?>assets/images/main/man-user.png" class="userlogin">
                                <span class=""><?=$this->session->userdata('fc_member')->log_email?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <a href="<?=base_url('myaccount')?>" class="btn btn-link fc_nav_link">
                                        <span>My Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('site/change_password')?>" class="btn btn-link fc_nav_link">
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('site/logout')?>" class="btn btn-link fc_nav_link">
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- #END# Notifications -->
                        <?php 
                    }  else{
                       ?>
                       <li class="acc_log register">
                        <a href="#" title="register"><img class="ic_acc" src="<?php echo base_url(); ?>assets/images/main/ic_register.png" alt="register" style="margin: -5px 5px 0 0; float: left; padding: 7px; border-radius: 50%; background-color: #1C75BC; "/>REGISTER</a>
                    </li>
                    <li class="acc_log login">
                        <a href="#" title="login"><img class="ic_acc" src="<?php echo base_url(); ?>assets/images/main/ic_login.png" alt="login" style="margin: -5px 5px 0 0; float: left; padding: 7px; border-radius: 50%; background-color: #fe8b0c; "/>LOGIN</a>
                    </li>
                    <?php 
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</div>
