<!DOCTYPE html>

<html lang="en" dir="<?php echo e((App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr'); ?>">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="<?php echo e(getSetting('meta_description', 'seo_settings')); ?>">

	<meta name="keywords" content="<?php echo e(getSetting('meta_keywords', 'seo_settings')); ?>">

	 

	<link rel="icon" href="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')); ?>" type="image/x-icon" />

	

	<title><?php echo e(isset($title) ? $title : getSetting('site_title','site_settings')); ?></title>



	<?php echo $__env->yieldContent('header_scripts'); ?>

	<!-- Bootstrap Core CSS -->

    <link href="<?php echo e(themes('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('css/sb-admin.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('front/fonts/proxima-nova/proximanova.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('css/custom-fonts.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('css/materialdesignicons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('css/sweetalert.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('css/')); ?>" rel="stylesheet">
    <link href="<?php echo e(themes('css/')); ?>" rel="stylesheet">

    <link href="<?php echo e(CSS); ?>plugins/morris.css" rel="stylesheet">

    <link href="<?php echo e(FONTAWSOME); ?>font-awesome.min.css" rel="stylesheet" type="text/css">


	
<style>
.active {
    color: red;
}
</style>

</head>




<body class="login-screen" background="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('background_image','site_settings')); ?>" ng-app="academia" >

 <!-- NAVIGATION -->
 <div class="login-nav">
    <nav class="navbar navbar-default st-navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand page-scroll" href="<?php echo e(PREFIX); ?>"><img src="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>"></a>
                <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas">
                    <span class="sr-only">Toggle navigation</span>
                    <span>
                        <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </span>
                </button>
            </div>
            <div class="navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">
                <ul class="nav navbar-nav navbar-right">

                    <li> 
                        <a

                        <?php if($active_class=='home'): ?>
                            class="page-scroll active" 
                        <?php else: ?>
                            class="page-scroll" 
                        <?php endif; ?>

                        href="<?php echo e(PREFIX); ?>">Home</a> 
                    </li>


                     <li> 
                        <a

                        <?php if($active_class=='exams'): ?>
                            class="page-scroll active" 
                        <?php else: ?>
                            class="page-scroll" 
                        <?php endif; ?>

                        href="<?php echo e(URL_FRONTEND_EXAMS_LIST); ?>"><?php echo e(getPhrase('practice_exams')); ?></a> 
                    </li>

                    <li> 
                        <a 
                        <?php if($active_class=='terms-conditions'): ?>
                            class="page-scroll active" 
                        <?php else: ?>
                            class="page-scroll" 
                        <?php endif; ?>

                        href="<?php echo e(SITE_PAGES_TERMS); ?>">Terms and Conditions
                        </a> 
                    </li>
                    <li> 
                        <a 
                        <?php if($active_class=='privacy-policy'): ?>
                            class="page-scroll active" 
                        <?php else: ?>
                            class="page-scroll" 
                        <?php endif; ?>
                        href="<?php echo e(SITE_PAGES_PRIVACY); ?>"
                        >Privacy and Policy
                    </a> </li>
                    <li> 

                    	<a  <?php if($active_class =='login'): ?>
                              class="page-scroll active" 
                          <?php else: ?>
                            class="page-scroll" 
                            <?php endif; ?>
                             href="<?php echo e(URL_USERS_LOGIN); ?>">Login</a>
                              </li>
                    <li> <a 
                         <?php if($active_class=='register'): ?>
                            class="page-scroll active" 
                        <?php else: ?>
                            class="page-scroll" 
                        <?php endif; ?>
                         href="<?php echo e(URL_USERS_REGISTER); ?>">Register</a> 
                     </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
    <!-- /NAVIGATION --> 


	<?php echo $__env->yieldContent('content'); ?>

	



		<!-- /#wrapper -->

		<!-- jQuery -->
        <script src="<?php echo e(themes('js/jquery-1.12.1.min.js')); ?>"></script>
        <script src="<?php echo e(themes('js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(themes('js/main.js')); ?>"></script>
        <script src="<?php echo e(themes('js/sweetalert-dev.js')); ?>"></script>


		<?php echo $__env->make('errors.formMessages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		   <?php echo $__env->yieldContent('footer_scripts'); ?>
		
		<?php echo getSetting('google_analytics', 'seo_settings'); ?>

</body>



</html>