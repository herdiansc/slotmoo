<?php
//debug($user);
//die();
?>

<style>
.side-block-head {
font-size: 11pt;
font-weight: bold;
}
.margin-top {margin-top:10px;}
.margin-bottom {margin-bottom:5px;}
.widgets-side {margin-top:10px;padding:0px 5px;}
</style>
<div class="boxes boxes-static">
    <div class="photo-profile">
        <?php
            $photo_profile = $user['info']['User']['photo_profile'];
#            if(!isset($user['info']['User']['photo_profile'])) $photo_profile = @$top['Listing']['_photo_profile'];
            $photo_profile = $photo_profile == null ? DEFAULT_PP : CDN.'files/photo_profiles/customed/'.$photo_profile ;

            if($this->Session->read('Auth.User.id') == $user['info']['User']['id']) {
                echo $this->Html->link($this->Html->image($photo_profile,array('width'=>70,'height'=>70,'alt'=>$user['info']['User']['username'])),
                    '/'.$user['info']['User']['username'].'/photo_profile',
                    array('escape'=>false,'title'=>__('Change photo profile',true))
                );
            }else {
                echo $this->Html->image($photo_profile,array('width'=>70,'height'=>70,'alt'=>$user['info']['User']['username']));
            }
        ?>
        <div class="clear"></div>
    </div>
    <div class="title-profile" style="float:left;padding: 5px 0px 0px 10px;">
        <div class="box-title">
            <h1>
                <?php
#                    $user['info']['User']['display_name'] = 'PT. Walden Global Services';
                    if( $user['info']['User']['display_name'] != null ) {
                        $display = $this->Text->truncate($user['info']['User']['display_name'],15);
                        $title = $user['info']['User']['display_name'].' ('.$user['info']['User']['username'].')';
                    }else {
                        $display = $this->Text->truncate($user['info']['User']['username'],15);
                        $title = @$user['info']['User']['display_name'].' ('.$user['info']['User']['username'].')';
                    }
                    echo $this->Html->link(h($display),
                        '/'.$user['info']['User']['username'],
                        array('style'=>'text-decoration:none;','id'=>'test-dulu','title'=>$title)
                    )
                ?>
            </h1>
        </div>
        <div class="profile-follow-info">
            <span class="following">
                <?php echo $user['info']['User']['ads_count'] .' iklan'; ?>
            </span>
        </div>
    </div>
    <div class="clear"></div>
    <div class="short-bio" style="font-size:10pt;">
        <?php
            $contenteditable = $this->Session->read('Auth.User.id') == $user['info']['User']['id'] ? 'contenteditable="true" title="Click to edit"' : null ;
        ?>
        <?php
            $styleText = null;
            if($this->Session->read('Auth.User.id') == $user['info']['User']['id']) {
                $contenteditable = 'contenteditable="true" title="'.__('Click to edit',true).'"';
                if($user['info']['User']['bio'] == null) {
                    $styleText = 'style="font-style:italic;"';
                    $displayBio = 'Di sini adalah deskripsi profil pendek anda, tambahkan dari bagian profil.';
                }else {
                    $displayBio = $user['info']['User']['bio'];
                }
            }else {
                $contenteditable = null;
                if($user['info']['User']['bio'] == null) {
                    $displayBio = null;
                }else {
                    $displayBio = $user['info']['User']['bio'];
                }
            }
        ?>
        <div class="widgets-side">
            <div <?php echo $styleText ?>class="display" id="bio-display">
                <h3 class="side-block-head">Biografi</h3>
                <?php echo h($displayBio) ?>
            </div>
            <?php if(isset($user['info']['User']['website']) && $user['info']['User']['website'] != null) { ?>
            <div class="display" id="bio-display">
                <h3 class="side-block-head margin-top">Website</h3>
                <?php echo h($user['info']['User']['website']) ?>
            </div>
            <?php } ?>
            <?php if(isset($user['info']['User']['how_to_call'])) { ?>
            <div class="display" id="bio-display">
                <h3 class="side-block-head margin-top">Cara Menghubungi Saya</h3>
                <?php echo h($user['info']['User']['how_to_call']) ?>
            </div>
            <?php } ?>
            <?php if(isset($user['info']['User']['id_ym'])) { ?>
            <div class="display" id="bio-display">
                <h3 class="side-block-head margin-top margin-bottom">Hubungi via YM</h3>
                <?php  
                $id_ym_exploded = explode('@',$user['info']['User']['id_ym']);
                $id_ym = @$id_ym_exploded[1] == 'yahoo.com' ? @$id_ym_exploded[0] : $user['info']['User']['id_ym'] ;
                ?>
                <a target="_blank" href="http://ymgen.com/chat.php?idne=<?php echo h($id_ym) ?>">
                    <img border="0" src="http://opi.yahoo.com/online?u=<?php echo h($id_ym) ?>&m=g&t=2">
                </a>
            </div>
            <?php } ?>
        </div>
    </div>

</div>

<script>
</script>
