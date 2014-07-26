<div id="main-slideshow" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php for($i=0,$c=count($slides);$i<$c;$i++): ?>
        <li data-target="#main-slideshow" 
            data-slide-to="<?php echo $i;?>"
            <?php if($i==0) echo ' class="active"';?>>
        </li>
        <?php endfor;?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php 
        for($i=0,$c=count($slides);$i<$c;$i++):
            $s = $slides[$i]; 
        ?>
            <div class="item<?php if($i==0) echo ' active';?>">
                <a href="<?php echo base_url($s['link']); ?>">
                    <img src="<?php echo base_url($s['img']); ?>">
                </a>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#main-slideshow" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#main-slideshow" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>



<!--
<style>
    #main-slide-show-container #bx-viewport{height: 300px;}
</style>
<div id="main-slide-show-container">
    <ul id="mainslideshow">
        <?php foreach ($slides as $s): ?>
            <li>
                <a href="<?php echo base_url() . $s['link']; ?>">
                    <img class="ui-corner-all" height="300" src="<?php echo base_url() . $s['img']; ?>"/>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<script type="text/javascript">
    $('#mainslideshow').bxSlider({
        auto: true
    });
</script>-->