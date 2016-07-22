<?php
//debug($this->viewVars);
?>
<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header">
            Timeline
            <?php echo $this->element('sorter') ?>
        </h1>
        <?php if(empty($listings)){ ?>
            <center style="margin:20px 0px;font-size:16px;">
                <?php
                if($this->Session->read('Auth.User.id') == $user['info']['User']['id'] ) {
                    $label_name = 'Anda';
                }else {
                    $label_name = $user['info']['User']['username'];
                }
                ?>
                <span style="color:#ddd;"><?php echo $label_name ?> belum punya iklan.</span>
            </center>
        <?php } ?>
        <?php echo $this->element('note_list') ?>
        <div class="clear"></div>
        <?php echo $this->element('pagination') ?>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>
