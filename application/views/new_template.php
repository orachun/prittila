<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico?dummy=dummy"> 
        <title>Prittila: pre-order ชุดสไตล์เกาหลีน่ารักๆ - <?php echo $title ?></title>

        <?php echo link_tag(base_url('template_asset/css/bootstrap.min.css')); ?>
        <?php echo link_tag(base_url('css/template.css')); ?>
        <script src="<?php echo base_url(); ?>template_asset/js/jquery.js"></script>
        
        <script src="<?php echo base_url(); ?>template_asset/js/template.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/modals/shopping_bag.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/modals/user.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/modals/paymentinform.js"></script>
        <?php include config_item('base_path').'/application/views/template_includes/template_header.php';?>
        
        
        
        <script src="<?php echo base_url(); ?>libs/pnotify/jquery.pnotify.js"></script>
		<?php echo link_tag(base_url() . 'libs/pnotify/jquery.pnotify.default.css'); ?>
        
        
        <script src="<?php echo base_url(); ?>libs/jquery.waiting/jquery.waiting.js"></script>
		<?php echo link_tag(base_url('libs/jquery.waiting/waiting.css')); ?>
        
        
        <script src="<?php echo base_url(); ?>template_asset/js/utils.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/sha256.js"></script>
        
        <!-- Add fancyBox -->
        <link rel="stylesheet" href="<?php echo base_url();?>libs/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url();?>libs/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>

        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <link rel="stylesheet" href="<?php echo base_url();?>libs/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url();?>libs/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

    </head>
    <body>
        <?php fb_load_js_sdk();?>
        <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="navbar-brand main-logo"><a href="<?php echo base_url();?>">*PRITTILA*</a></span>
                    
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-left">
                        <li class="fb-btn-container">
                                <?php like_btn(base_url());?>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li data-toggle="tooltip" data-placement="bottom" title="บัญชีลูกค้า">
                            <a href="#" data-toggle="modal" data-target="#account-modal"><span class="glyphicon glyphicon-user"></span> Account</a>
                        </li>
                        <li data-toggle="tooltip" data-placement="bottom" title="สินค้าที่เลือก">
                            <a href="#" data-toggle="modal" data-target="#shopping-bag-modal"><span class="glyphicon glyphicon-shopping-cart"></span> Order <span class="badge" id="order-count">0</span></a>
                        </li>
                        <li class="dropdown"  data-toggle="tooltip" data-placement="bottom" title="วิธีการสั่งซื้อและชำระเงิน">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign"></span> Buy Info <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('index.php/page/content/conditions');?>">ข้อตกลงและเงื่อนไขการสั่งซื้อ</a></li>
                                <li><a href="#">วิธีการสั่งซื้อและชำระเงิน</a></li>
                                <li><a href="#">รายละเอียดการชำระเงิน</a></li>
                            </ul>
                        </li>
                        <li data-toggle="tooltip" data-placement="bottom" title="แจ้งชำระเงิน"><a href="#" data-toggle="modal" data-target="#payment-inform-modal"><span class="glyphicon glyphicon-usd"></span> Payment</a></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="ติดต่อเรา"><a href="#" data-toggle="modal" data-target="#contact-modal"><span class="glyphicon glyphicon-comment"></span> Contact Us</a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        

        <div class="container">
            <?php if($custom_contents):?>
                <div id="custom-content-panel" class="panel panel-primary">
                <?php echo $contents;?>
                </div>
            <?php else:?>
                <?php echo $slideshow; ?>
            <div class="row bottom-margin">&nbsp;</div>
            <div class="row bottom-margin">
                <div class="col-md-9 col-sm-12">
                    <div class="panel panel-primary">
                        <?php echo $contents; ?>
                    </div>
                </div>
                
                <!--Best Sellers-->
                <div class="col-md-3 col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">สินค้าขายดี </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row bottom-margin">
                                <?php 
                                foreach($best_seller as $p)
                                {
                                    echo '<div class="col-md-12 col-sm-4 col-xs-4">';
                                    echo $p;
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Other products-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">สินค้าอื่นๆที่น่าสนใจ</h3>
                        </div>
                        <div class="panel-body">
                            <?php 
                            foreach($most_viewed as $p)
                            {
                                echo '<div class="col-xs-2">';
                                echo $p;
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
        </div>
        <div id="footer">
			<?php if (!empty($footer)) echo $footer; ?>
        </div>
        
        <!-- Footer -->
        <div class="container navbar-default navbar">
            <br/>	
            <div class="row bottom-margin">
                <div class="col-sm-4">
                    <strong>Information</strong><br/>
                </div>
                <div class="col-sm-4">
                    <strong>My Account</strong><br/>
                </div>
                <div class="col-sm-4">
                    <strong>Contact Us</strong><br/>
                    Tel.0812345678<br/>
                    Email.prittila.shopping@gmail.com<br/>
                    Line.___aaa<br/>
                    Fanpage.https://www.facebook.com/prittila<br/>
                </div>
            </div>
        </div>
        <!-- End Footer -->









        <!----------------------------------------------------------- Modals -------------------------------------------------->
        <?php
        include config_item('base_path').'/application/views/template_includes/modals/account.php';
        include config_item('base_path').'/application/views/template_includes/modals/shoppingbag.php';
        include config_item('base_path').'/application/views/template_includes/modals/paymentinform.php';
        include config_item('base_path').'/application/views/template_includes/modals/contactus.php';
        include config_item('base_path').'/application/views/template_includes/modals/product.php';
        include config_item('base_path').'/application/views/template_includes/modals/checkout.php';
        ?>
        <!-- End of modals -->



        <script src="<?php echo base_url(); ?>template_asset/js/bootstrap.min.js"></script>
        <script>
            $('*[data-toggle="tooltip"]').tooltip();
        </script>
    </body>
</html>