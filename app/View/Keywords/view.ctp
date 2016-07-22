
    <div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header">
            <?php echo 'Kata Kunci:' ?> 
            <?php echo $KeywordName; ?>
            <?php echo $this->element('sorter') ?>
        </h1>
        <?php if(empty($listings)){ ?>
            <center style="margin:20px 0px;font-size:16px;">
                <span style="color:#ddd;"><?php echo 'Belum ada iklan untuk kata kunci ini' ?>.</span>
            </center>
        <?php } ?>

        <?php echo $this->element('note_list') ?>

    <div style="clear:both;"></div>
    <?php echo $this->element('pagination') ?>
    </div>
    </div>
    <div style="float:right;">
        <?php echo $this->element('sidebar') ?>
    </div>
    
<script type="text/javascript">
$(document).ready(function(){
});
</script>
