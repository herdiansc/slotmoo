<?php
$sorting_options = array(
    'created_desc'=>'Terbaru',
    'created_asc'=>'Terlama',
    '_visit_desc'=>'Terpopuler',
    'price_desc'=>'Termahal',
    'price_asc'=>'Termurah'
);
?>
<div class="order" style="position:relative;">
    Urutan: 
    <span class="current-sort">
        <?php $current_sort = isset($sorting_options[ @$_GET['o'].'_'.@$_GET['dir'] ]) ? $sorting_options[ @$_GET['o'].'_'.@$_GET['dir'] ] : 'Terbaru' ; ?>
    <?php echo $current_sort ?></span><span class="show-sort">&nbsp;</span>
    <ul class="sorting-options" style="display:none">
        <li><a href="<?php echo '/'.$this->params->url.'?o=created&dir=desc' ?>">Terbaru</a></li>
        <li><a href="<?php echo '/'.$this->params->url.'?o=created&dir=asc' ?>">Terlama</a></li>
        <li><a href="<?php echo '/'.$this->params->url.'?o=_visit&dir=desc' ?>">Terpopuler</a></li>
        <li><a href="<?php echo '/'.$this->params->url.'?o=price&dir=desc' ?>">Termahal</a></li>
        <li><a href="<?php echo '/'.$this->params->url.'?o=price&dir=asc' ?>">Termurah</a></li>
    </ul>    
</div>

<script>
$(document).ready(function(){


    $('.order').bind('mouseover',function(){
        $(this).find('.sorting-options').show();
    }).bind('mouseout',function(){
        $(this).find('.sorting-options').hide();
    });
    
});
</script>
