<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="border-bottom" style="margin:10px 10px 5px 10px;padding-bottom:5px;">
            <?php echo __('Photo Profile:') ?>
        </h1>
        <?php echo $this->Form->create(null,array('enctype'=>'multipart/form-data' ,'style'=>'float:left')) ?>
            <div style="float:left;margin-left:20px;border:1px solid #eee;padding:3px;">
                <?php
                    $photo_profile = $user['info']['User']['photo_profile'];
                    $photo_profile = $photo_profile == null ? DEFAULT_PP : CDN.'files/photo_profiles/customed/'.$photo_profile.'?time='.time() ;
                    echo $this->Html->image($photo_profile,array('width'=>70,'height'=>70));
                ?>
                <div class="clear"></div>
            </div>
            <div style="float:left;">
                <div style="margin:0px 0px 10px 20px;font-size:10pt;font-family:arial;">
                    <?php echo __('Upload your photo here') ?>
                </div>
                <?php echo $this->Form->input('photo_profile',array('type'=>'file','label'=>false,'style'=>'margin-left:20px;')) ?>
            </div>
            <div class="clear"></div>
            <div style="height:20px;"></div>
        <input type="submit" class="close button" value="<?php echo 'Simpan' ?>"  style="margin-left:20px;">
        <?php echo $this->Form->end() ?>
        <div class="clear"></div>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>
