<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="border-bottom" style="margin:10px 10px 5px 10px;padding-bottom:5px;">
            <?php echo 'Profil Anda' ?>
        </h1>
        <div style="margin:10px;">
            <div class="row">
                <div class="cell-left"><?php echo 'Username' ?></div>
                <div class="cell-right" style="float:left"><?php echo h($user['info']['User']['username']) ?></div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="cell-left"><?php echo 'Email' ?></div>
                <div class="cell-right"><?php echo h($user['info']['User']['email']) ?></div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="cell-left"><?php echo 'Nama' ?></div>
                <div class="cell-right"><?php echo h(@$user['info']['User']['display_name']) ?></div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="cell-left"><?php echo 'About' ?></div>
                <div class="cell-right"><?php echo h($user['info']['User']['bio']) ?></div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="cell-left"><?php echo 'Website' ?></div>
                <div class="cell-right"><?php echo $this->Text->autoLinkUrls($user['info']['User']['website']) ?></div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="cell-left"><?php echo 'Cara Menghubungi Saya' ?></div>
                <div class="cell-right"><?php echo $this->Text->autoLinkUrls($user['info']['User']['how_to_call']) ?></div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="cell-left"><?php echo 'ID Yahoo Mesengger' ?></div>
                <div class="cell-right"><?php echo $this->Text->autoLinkUrls($user['info']['User']['id_ym']) ?></div>
                <div class="clear"></div>
            </div>
                        
            <div class="row border-bottom" style="padding-bottom:10px;">
                <div class="cell-left"></div>
                <div class="cell-right">
                    <?php 
                        echo $this->Html->link('Update',
                            '/'.$user['info']['User']['username'].'/edit',
                            array('class'=>'public-btn plain','style'=>'float:right;margin:3px 10px 0 0 !important;')
                        );
                    ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="row border-bottom" style="padding-bottom:5px;">
                <div class="cell-left"><?php echo 'Password' ?></div>
                <div class="cell-right">
                    <?php 
                        echo $this->Html->link('Ubah password',
                            '/'.$user['info']['User']['username'].'/change_password',
                            array('class'=>'public-btn plain','style'=>'float:right;margin:3px 10px 0 0 !important;')
                        );
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    
    
    <div class="inside-left-box shadow">
        <h1 class="border-bottom" style="margin:10px 10px 5px 10px;padding-bottom:5px;">
            <?php echo 'Photo Profile:' ?>
        </h1>
        <?php echo $this->Form->create(null,array('url'=>'/'.$user['info']['User']['username'].'/photo_profile','enctype'=>'multipart/form-data' ,'style'=>'float:left')) ?>
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
                    <?php echo 'Upload photo anda di sini' ?>
                </div>
                <?php echo $this->Form->input('photo_profile',array('type'=>'file','label'=>false,'style'=>'margin-left:20px;')) ?>
            </div>
            <div class="clear"></div>
            <div style="height:20px;"></div>
        <input type="submit" class="close button" value="<?php echo 'Upload dan Simpan' ?>"  style="margin-left:20px;">
        <?php echo $this->Form->end() ?>
        <div class="clear"></div>
    </div>
    
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>
