<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header border-bottom"><?php echo 'Ubah Password' ?></h1>
        <?php echo $this->Form->create(null,array('class'=>'note-add-form')); ?>
            <?php echo $this->Form->hidden('_token',array('value'=>$this->Session->read('_spam_guard_token'))); ?>
            <?php echo $this->Form->input('old_password',array('label'=>'Password Lama','type'=>'password','style'=>'width:90% !important')); ?>
            <?php echo $this->Form->input('new_password',array('label'=>'Password Baru','type'=>'password','style'=>'width:90% !important')); ?>
            <?php echo $this->Form->input('confirm_password',array('label'=>'Konfirmasi Password Baru','type'=>'password','style'=>'width:90% !important')); ?>
            <input type="submit" class="close button" value="<?php echo 'Simpan' ?>"  style="margin-left:20px;">
        <?php echo $this->Form->end(); ?>
        <div class="clear"></div>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>

