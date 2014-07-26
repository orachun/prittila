<div class="panel-body main-product-panel">
    <div class="row bottom-margin">
        <div class="col-sm-6">
            <div class="dropdown-container">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        หมวดหมู่สินค้า <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">ชื่อ</a></li>
                        <li><a href="#">ราคาต่ำสุด</a></li>
                        <li><a href="#">ราคาสูงสุด</a></li>
                        <li><a href="#">คนซื้อสูงสุด</a></li>
                        <li><a href="#">คนดูสูงสุด</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        เรียงตาม <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">สินค้ามาใหม่</a></li>
                        <li><a href="#">คนซื้อสูงสุด</a></li>
                        <li><a href="#">คนดูสูงสุด</a></li>
                        <li><a href="#">ราคาต่ำสุด</a></li>
                        <li><a href="#">ราคาสูงสุด</a></li>
                        <li><a href="#">ชื่อ</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--search form-->
        <div class="col-xs-10 col-sm-6">
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">
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
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>
    
    
</div>


