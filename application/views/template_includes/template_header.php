<script type="text/javascript">
    base_url = "<?php echo base_url(); ?>";
    <?php
    foreach (___config() as $k => $v)
    {
        echo $k . '=' . '"' . $v . '";';
    }
    ?>
</script>  

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