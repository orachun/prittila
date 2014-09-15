<style>
    .page-container
    {
        background-color: white;
        margin: 20px;
    }
    
    .page-container .page-header
    {
        font-size: 1.5em;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .page-container .page-footer
    {
        text-align: right;
        font-size: 0.8em;
        font-style: italic;
    }
    
</style>

<div class="page-container ui-corner-all">
    <h1 class="page-header"><?php echo $page['name'];?></h1>
    <div class="page-content">
        <?php echo $page['content'];?>
    </div>
    <div class="page-footer">
        <!-- แก้ไขล่าสุดเมื่อ <?php echo thai_datetime($page['edited_datetime']);?> -->
    </div>
</div>