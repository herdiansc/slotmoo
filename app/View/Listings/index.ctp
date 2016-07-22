
<?php
echo $this->Html->css('magnific-popup');
echo $this->Html->script('jquery.magnific-popup.min');
?>

<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header">
            Beranda
            <?php echo $this->element('sorter') ?>
        </h1>
        <?php if(empty($listings)){ ?>
<style>

</style>
            <div class="welcome-options">
                <div class="header-text">
                    <h4>Selamat datang di <?php echo SITE_NAME ?></h4>
                    <p><?php echo SITE_SLOGAN ?></p>
                </div>
                <div class="column advertiser">
                    <h4>Anda mau beriklan?</h4>
                    <p>Silahkan pakai form pembuatan iklan dengan mengakses menu <a href="/ads/new?ref=plain-text">pasang iklan</a> di atas atau dengan:<br /><br /><a href="/ads/new?ref=blue-btn" class="public-btn blue small">tombol ini</a></p>
                </div>
                <div class="column finder">
                    <h4>Anda sekedar melihat-lihat?</h4>
                    <p>Anda bisa melihat-lihat iklan yang ada si <?php echo SITE_NAME ?> dengan follow kata kunci iklan yang anda inginkan:<br /><br /><a href="/pipes/show_keywords" class="popup public-btn blue small">Lihat kata kunci</a></p>
                </div>
            </div>
        <?php } ?>
        <?php echo $this->element('note_list') ?>
        <div class="clear"></div>
        <?php echo $this->element('pagination') ?>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>

<script>
$(document).ready(function(){
$('.popup').magnificPopup({
  type: 'ajax'
});
});

</script>
