<?php echo doctype(); ?>
<html>

    <!------------------------------HEADER----------------------------------------->
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico?dummy=dummy"> 
        <script type="text/javascript">
			base_url = "<?php echo base_url(); ?>";
            <?php
            foreach (___config() as $k => $v)
            {
                echo $k . '=' . '"' . $v . '";';
            }
            ?>
        </script>  
        <title>Prittila: pre-order ชุดสไตล์เกาหลีน่ารักๆ - <?php echo $title ?></title>
		<?php echo link_tag(base_url() . 'css/custom-theme/jquery-ui-1.10.3.custom.min.css'); ?>

        <script src="<?php echo base_url(); ?>js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>js/additional-methods.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.pnotify.js"></script>
        <script src="<?php echo base_url(); ?>libs/jquery.waiting/jquery.waiting.js"></script>
        <script src="<?php echo base_url(); ?>js/thumb_slider.js"></script>
        <script src="<?php echo base_url(); ?>libs/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/template.js"></script>
        <script src="<?php echo base_url(); ?>js/upload.js"></script>
        <script src="<?php echo base_url(); ?>js/product_grid_item.js"></script>

		<?php echo link_tag(base_url() . 'css/template.css'); ?>
		<?php echo link_tag(base_url() . 'css/right-tab.css'); ?>
		<?php echo link_tag(base_url() . 'css/form.css'); ?>
		<?php echo link_tag(base_url() . 'css/jquery.pnotify.default.css'); ?>
		<?php echo link_tag(base_url() . 'libs/jquery.waiting/waiting.css'); ?>
		<?php echo link_tag(base_url() . 'css/thumb_slider.css'); ?>


        <script src="<?php echo base_url(); ?>libs/bxslider/jquery.bxslider.min.js"></script>
        <link href="<?php echo base_url(); ?>libs/bxslider/jquery.bxslider.css" rel="stylesheet" />


		<?php
		if (isset($_js)):
			foreach ($_js as $j):
				?>
				<script src="<?php echo base_url() . 'js/' . $j . '.js'; ?>" type="text/javascript"></script>
				<?php
			endforeach;
		endif;
		?>
		<?php
		if (isset($_css)):
			foreach ($_css as $c):
				?>
				<link href="<?php echo base_url() . 'css/' . $c . '.css'; ?>" type="text/css" rel="stylesheet" />
				<?php
			endforeach;
		endif;
		?>



    </head>
    <!------------------------------END HEADER----------------------------------------->

    <body>
        <!-------------------------------BODY------------------------------------------>
		<?php fb_load_js_sdk();?>
        <div id="topbar">
            <div id="logo-container">
                <a href="<?php echo base_url() ?>index.php" title="หน้าแรก">
					*PRITTILA*
                </a>
            </div>
            <div id="search-tools" class="ui-corner-right">
                <select id="product-cat" class="button ui-corner-all">
                    <option value="-1">หมวดหมู่สินค้า</option>
                </select>
                <input id="search-box" class="ui-corner-all" type="text"/><span id="search-btn" class="button ui-corner-all">ค้นหา</span>
                <script type="text/javascript">
					$.get(base_url + 'index.php/product/category_options', function(data) {
						$('#topbar #product-cat').append(data);
						//                    $('#topbar #product-cat').ddslick();
					});
                </script>
				
				<?php like_btn(base_url());?>
            </div>
			
        </div>


        <div id="body">
            <div id="content">
				<?php echo $contents; ?>
            </div>
        </div>
        <div id="footer">
			<?php if (!empty($footer)) echo $footer; ?>
        </div>
        <!-------------------------------END BODY------------------------------------------>


        <!-------------------------------Right Tabs------------------------------------------>
        <?php include dirname(__FILE__).'/template_right_tabs.php';?>
        <!-------------------------------END Right Tabs------------------------------------------>



        <div class="bottom-bar">       
            <?php contact_info();?>
        </div>
    </body>
</html>

