<div class="panel-body main-product-panel">
    <div class="row bottom-margin">
        <div class="col-sm-6">
            <form id="product-grid-args-form">
            <?php
                foreach($args as $k => $v)
                {
                    echo '<input type="hidden" name="'.$k.'" value="'.$v.'"/>';
                }
            ?>
            </form>
            <div class="dropdown-container">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        หมวดหมู่สินค้า <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach($all_cats as $c):?>
                            <li><a class="cat-option" href="#" value="<?php echo $c->product_cat_id;?>"><?php echo $c->name;?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        เรียงตาม <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="order-option" value="added_date,desc" href="#">สินค้ามาใหม่</a></li>
                        <li><a class="order-option" value="views,desc" href="#">คนดูสูงสุด</a></li>
                        <li><a class="order-option" value="unit_price,asc" href="#">ราคาต่ำสุด</a></li>
                        <li><a class="order-option" value="unit_price,desc" href="#">ราคาสูงสุด</a></li>
                        <li><a class="order-option" value="name,asc" href="#">ชื่อ</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--search form-->
        <div class="col-xs-10 col-sm-6">
            <div class="input-group">
                <input id="search-keyword" type="text" class="form-control">
                <span class="input-group-btn">
                    <button id="search-btn" class="btn btn-primary" type="button">
                        &nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;
                    </button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>

    <!--Product Grid-->
    <div class="row bottom-margin">
        <?php
        foreach ($products as $p)
        {
            echo '<div class="col-sm-4 col-xs-6">';
            echo $p;
            echo '</div>';
        }
        ?>
    </div>

    <!--Pagination-->
    <div class="row bottom-margin">
        <div class="col-md-12">
            <ul class="pagination pull-right">
                <li <?php if($args['page'] == 1) echo 'class="disabled"';?>><a href="#">&laquo;</a></li>
                <?php for($i=1;$i<=$total_pages;$i++):?>
                <li <?php if($i==$args['page']) echo 'class="active"';?>>
                    <a href="#"><?php echo $i;?></a>
                </li>
                <?php endfor;?>
                <li <?php if($args['page'] == $total_pages) echo 'class="disabled"';?>><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">

$('.cat-option').click(function(e){
    var catid = $(this).attr('value');
    var url = base_url+'index.php/product/index/'+catid 
            + '/<?php echo $args['sort'];?>'
            + '/<?php echo $args['sort_order'];?>'
            + '/<?php echo $args['keyword'];?>'
            + '/<?php echo $args['page'];?>';
    window.location = url;
});
$('.order-option').click(function(e){
    var value = $(this).attr('value');
    value = value.split(',');
    var sort = order[0];
    var sort_order = order[1];
    
    var url = base_url+'index.php/product/index/'
            + '/<?php echo $args['cat'];?>'
            + '/' + sort
            + '/' + sort_order
            + '/<?php echo $args['keyword'];?>'
            + '/<?php echo $args['page'];?>';
    window.location = url;
});
$('#search-btn').click(function(e){
    var keyword = $('#search-keyword').val();
    var url = base_url+'index.php/product/index/' 
            + '/<?php echo $args['cat'];?>'
            + '/<?php echo $args['sort'];?>'
            + '/<?php echo $args['sort_order'];?>'
            + '/' + keyword
            + '/<?php echo $args['page'];?>';
    window.location = url;
});
</script>
