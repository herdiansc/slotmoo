<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header border-bottom"><?php echo 'Edit Your Profile' ?></h1>
        <?php echo $this->Form->create(null,array('class'=>'note-add-form')); ?>
            <?php echo $this->Form->hidden('_token',array('value'=>$this->Session->read('_spam_guard_token'))); ?>
            <?php //echo $this->Form->input(null,array('label'=>__('Username',true),'class'=>'note-title','autocomplete'=>'off','style'=>'width:90% !important','value'=>$this->data['User']['username'],'disabled'=>true)); ?>
            <?php //echo $this->Form->input(null,array('label'=>__('Email',true),'style'=>'width:90% !important','id'=>'NoteContent','value'=>$this->data['User']['email'],'disabled'=>true)); ?>
            <?php echo $this->Form->input('UserDetail.first_name',array('label'=>'Nama Depan','style'=>'width:90% !important')); ?>
            <?php echo $this->Form->input('UserDetail.last_name',array('label'=>'Nama Belakang','style'=>'width:90% !important','id'=>'NoteContent')); ?>
            
            <?php echo $this->Form->input('UserDetail.about',array('label'=>'Tentang Anda','style'=>'width:90% !important;height:70px !important;','type'=>'textarea')); ?>
            <?php echo $this->Form->input('UserDetail.website',array('label'=>'Website','style'=>'width:90% !important;')); ?>
            <?php echo $this->Form->input('UserDetail.how_to_call',array('label'=>'Cara Menghubungi','style'=>'width:90% !important;height:70px !important;','type'=>'textarea','between'=>'<p style="line-height:20px !important;">Bagaimana cara pengunjung yang berminat menghubungi anda. Silahkan isi sebaik mungkin<br /> supaya pengunjung yang berminat tidak kesulitan menghubungi anda.</p>')); ?>
            <?php echo $this->Form->input('UserDetail.id_ym',array('label'=>'ID Yahoo Mesengger','style'=>'width:90% !important;','between'=>'<p style="line-height:20px !important;">Ini akan sangat berguna jika ada pegunjung yang bermaksud menghubungi anda <br />via yahoo mesengger. ID Yahoo Mesengger adalah email yahoo yang sering anda <br />pakai untuk chatting.</p>','placeholder'=>'Contoh: john.doe@yahoo.com')); ?>
            <input type="submit" class="close button" value="<?php echo __('Submit') ?>"  style="margin-left:20px;">
        <?php echo $this->Form->end(); ?>
        <div class="clear"></div>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>

