<?php echo doctype(); ?>
<html>
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8">

        <?php echo link_tag(base_url('template_asset/css/bootstrap.min.css')); ?>
        <?php echo link_tag(base_url('css/template.css')); ?>

        <script src="<?php echo base_url('template_asset/js/jquery.js'); ?>"></script>
        <?php include config_item('base_path') . '/application/views/template_includes/template_header.php'; ?>
        <script src="<?php echo base_url(); ?>libs/pnotify/jquery.pnotify.js"></script>
        <?php echo link_tag(base_url() . 'libs/pnotify/jquery.pnotify.default.css'); ?>
        <script src="<?php echo base_url(); ?>libs/jquery.waiting/jquery.waiting.js"></script>
        <?php echo link_tag(base_url('libs/jquery.waiting/waiting.css')); ?>
        <script src="<?php echo base_url(); ?>libs/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/utils.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/sha256.js"></script>
        <script src="<?php echo base_url(); ?>template_asset/js/facebook.js"></script>


        <script src="<?php echo base_url(); ?>libs/tinymce/tinymce.min.js"></script>


        <style>
            body, #main-panel { padding: 10px;}
            #main-tab-content {padding: 10px;}
        </style>
    </head>
    <body>
        <?php fb_load_js_sdk(true);?>

        <div id="main-panel" class="panel panel-primary">
            <a href="<?php echo base_url(); ?>">Home</a>
            <ul id="main-tabs" class="nav nav-tabs nav-primary" role="tablist">
                <li class="active"><a href="supplier" role="tab" data-toggle="tab">Suppliers</a></li>
                <li><a href="category" role="tab" data-toggle="tab">Category</a></li>
                <li><a href="products" role="tab" data-toggle="tab">Product List</a></li>
                <li><a href="add_product_form" role="tab" data-toggle="tab">Add Product</a></li>
                <li><a href="store_order" role="tab" data-toggle="tab">Store Order</a></li>
                <li><a href="store_order_products" role="tab" data-toggle="tab">Store Order Products</a></li>
                <li><a href="delivering" role="tab" data-toggle="tab">Delivering</a></li>
                <li><a href="payment_checking" role="tab" data-toggle="tab">Customer Orders</a></li>
                <li><a href="slideshow" role="tab" data-toggle="tab">Main Slideshow</a></li>
                <li><a href="page" role="tab" data-toggle="tab">Pages</a></li>
                <li><a href="customer" role="tab" data-toggle="tab">Customers</a></li>
            </ul>

            <!-- Tab panes -->
            <div id="main-tab-content" class="tab-content">
                <div class="tab-pane active" id=""></div>
            </div>
        </div>

        <script type="text/javascript">
            $(function() {
                $('#main-tabs').on('show.bs.tab', function(e) {
                    $('body').waiting();
                    $('#main-tab-content').load(e.target.href, function() {
                        $('body').waiting('done');
                    });
                });

                $('body').waiting();
                $('#main-tab-content').load('supplier', function() {
                    $('body').waiting('done');
                });
                
            });
            
            function initEditor(selector)
            {
                tinymce.init({
                    selector:selector,
                    menubar : false,
                    plugins: [
                        "advlist autolink lists link image charmap preview anchor",
                        "searchreplace code fullscreen",
                        "insertdatetime media table contextmenu paste emoticons"
                    ],
                    toolbar: "undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | link image emoticons | code fullscreen"
                });
            }
        </script>
        <script src="<?php echo base_url(); ?>template_asset/js/bootstrap.min.js"></script>
    </body>
</html>