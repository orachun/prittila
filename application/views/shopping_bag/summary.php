<?php
foreach ($this->cart->contents() as $items):
    $options = $this->cart->product_options($items['rowid']);
    ?>

    <div class="media ordered-item selected-item" rowid="<?php echo $items['rowid'] ?>">
        <span class="pull-left" href="#">
            <img class="media-object thumb" src="<?php echo base_url('images/products/' . $options['pid'] . '/thumb.jpg'); ?>" alt="...">
        </span>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?php echo base_url('index.php/product/detail/' . $options['pid']); ?>" target="_blank"><?php echo $options['name']; ?></a>
                <button type="button" class="btn btn-danger btn-sm del-btn" data-toggle="tooltip" data-placement="right" title="ลบ">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </h4>
            <strong>สี</strong> <?php //echo th_color($options['color']); 
            echo $options['color'];?>
            <strong>ขนาด</strong> <?php echo $options['size']; ?> <br/>
            <strong>ราคา</strong> <?php echo $this->cart->format_number($items['price']); ?> บาท
            <div class="row">
                <div class="col-md-12">
                    <strong>จำนวน</strong> <span class="qty"><?php echo $items['qty']; ?></span> ชิ้น
                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-toggle="tooltip" data-placement="right" title="แก้จำนวน">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm save-btn" data-toggle="tooltip" data-placement="right" title="แก้จำนวน">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


<?php endforeach; ?>