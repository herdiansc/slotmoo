<div class="inside-left-box shadow stories">
<h4 class="page-header">Iklan Terkait</h4>
<?php if(empty($relateds)) { ?>
    <center class="" style="margin:10px;padding-bottom:15px;">Belum ada iklan terkait</center>
<?php } ?>
<ul style="margin:10px;">
<?php foreach((array) $relateds as $related){ ?>
    <li>  
    <?php
        echo $this->Html->link($related['Listing']['title'],
            '/'.$related['Listing']['_username'].'/ads/'.$related['Listing']['id'].'/'.$related['Listing']['slug'],
            array('data-score'=>$related[0]['score'])
        );
    ?>
    </li>
<?php } ?>
</ul>
</div>
