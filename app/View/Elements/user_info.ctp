<?php
if( !empty($newestNote) ) {
    $mashUpClass = 'mashup';
}else {
    $mashUpClass = '';
}
?>
<div class="user-info <?php echo $mashUpClass ?>">
    <div class="photo-profile">
        <?php
            $photo_profile = $user['info']['User']['photo_profile'];
            $photo_profile = $photo_profile == null ? DEFAULT_PP : $photo_profile ;
            
            if( $user['info']['User']['_is_login'] > 0 ) {
                $flag = 'Online';
            }else {
                $flag = null;
            }
            
            if($this->Session->read('Auth.User.id') == $user['info']['User']['id']) {
                echo $html->link($html->image($photo_profile,array('width'=>70,'height'=>70,'alt'=>$user['info']['User']['username'],'id'=>'photo'/*,'class'=>$flag,'title'=>'I\'m '.$flag*/)),
                    array('member'=>true,'admin'=>false,'controller'=>'users','action'=>'photo_profile'),
                    array('escape'=>false,'title'=>__('Change photo profile',true))
                );
            }else {
                echo $html->image($photo_profile,array('width'=>70,'height'=>70,'alt'=>$user['info']['User']['username'],'id'=>'photo'/*,'class'=>$flag,'title'=>'I\'m '.$flag*/));
            }
        ?>
        <div class="clear"></div>
    </div>
    <div class="title-profile" style="float:left;padding: 13px 0px 0px 10px;width: 325px;">
        <div class="box-title">
            <h1>
                <?php
#                    $user['info']['User']['display_name'] = 'Test Nama yang Panjang Test Nama yang Panjang';
                    if( $user['info']['User']['display_name'] != null ) {
                        $display = $user['info']['User']['display_name'];
                        $title = $user['info']['User']['display_name'].' ('.$user['info']['User']['username'].')';
                    }else {
                        $display = $user['info']['User']['username'];
                        $title = @$user['info']['User']['display_name'].' ('.$user['info']['User']['username'].')';
                    }
#                    echo $this->Html->image('OnlineFlag.png',array('title'=>'Online'));
                    echo $html->link($display,
                        array('member'=>false,'controller'=>'users','action'=>'view','username'=>$user['info']['User']['username']),
                        array('style'=>'text-decoration:none;text-shadow: 0px 0px 2px white;','id'=>'test-dulu','title'=>$title,'escape'=>false)
                    )
                ?>
            </h1>
        </div>
        <div class="short-bio" style="font-size:10pt;margin-top:5px;">
            <?php
                $contenteditable = $this->Session->read('Auth.User.id') == $user['info']['User']['id'] ? 'contenteditable="true" title="Click to edit"' : null ;
            ?>
            <?php
                $styleText = null;
                if($this->Session->read('Auth.User.id') == $user['info']['User']['id']) {
                    $contenteditable = 'contenteditable="true" title="'.__('Click to edit',true).'"';
                    if($user['info']['User']['bio'] == null) {
                        $styleText = 'style="font-style:italic;"';
                        $displayBio = __('Click to edit short biography',true);
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
            <div <?php echo $contenteditable ?> <?php echo $styleText ?>class="display" id="bio-display" style="line-height:15px;">
                <?php echo $displayBio ?>
            </div>
        </div> 
        <div class="follow-box">
            <span>
                    <?php
                        $followingLabel = sprintf(__n('<strong>%d</strong> following','<strong>%d</strong> followings',$user["info"]["User"]["_following"],true),$user["info"]["User"]["_following"]) ;
                        echo $html->link($followingLabel,
                            array('member'=>false,'admin'=>false,'controller'=>'follows','action'=>'followings','username'=>$user['info']['User']['username']),
                            array('escape'=>false)
                        );
                    ?>
            </span>
            <span>
                    <?php
                        $followerLabel = sprintf(__n('<strong>%d</strong> follower','<strong>%d</strong> followers',$user["info"]["User"]["_follower"],true),$user["info"]["User"]["_follower"]) ;
                        echo $html->link($followerLabel,
                            array('member'=>false,'admin'=>false,'controller'=>'follows','action'=>'followers','username'=>$user['info']['User']['username']),
                            array('escape'=>false)
                        );
                    ?>
            </span>
        </div>   
    </div>
    <div class="profile-follow-btn" style="margin-top:21px;float: right;">
        <?php
            if($this->Session->read('Auth.User.id') != $user['info']['User']['id']) {
                if(!empty($user['info']['isFollowed'])) {
                    if($user['info']['isFollowed']['Follower']['status'] == 0){
                        echo $html->link(__('Waiting confirmation',true),
                            array('member'=>true,'admin'=>false,'controller'=>'users','action'=>'unfollow',$user['info']['User']['username']),
                            array('class'=>'public-btn red waiting-confirmation','data-on-hover'=>__('Cancel follow',true),'data-on-mouseout'=>__('Waiting confirmation',true))
                        );                
                    }else {
                        echo $html->link('Unfollow',
                            array('member'=>true,'admin'=>false,'controller'=>'users','action'=>'unfollow',$user['info']['User']['username']),
                            array('class'=>'public-btn red')
                        );
                    }
                }else {
                    echo $html->link('Follow',
                        array('member'=>true,'admin'=>false,'controller'=>'users','action'=>'follow',$user['info']['User']['username']),
                        array('class'=>'public-btn blue')
                    );
                }
            }else {
                    echo $html->link(__('Change Cover Photo',true),
                        array('member'=>true,'admin'=>false,'controller'=>'users','action'=>'cover_photo','username'=>$this->Session->read('Auth.User.username')),
                        array('class'=>'public-btn')
                    );
            }
        ?>
    </div>
<style>
.user-info-container {
height:200px;
margin-bottom:50px;
}
.user-info {
width: 600px;
}
.user-info.mashup {
margin: -90px 0px 20px 10px;
}
.user-info img {
border: 1px solid #CCC;
padding: 3px;
background: white;
border-image: initial;
}
img#photo.Online {background:lightGreen !important;border-color:green !important;}
.follow-box {
margin-top:5px;
}
.follow-box span {
    font-size:10pt;
    padding:5px 0px;
}
.short-bio-hidden-overflow {
height: 15px;
overflow: hidden;
}

</style>
    <div class="clear"></div>
</div>

<?php //echo $this->Html->script('SocketIO/socket.io.js'); ?>
<script>
//$(document).ready(function(){
///*
// * SocketIO
// *
//**/
//    var socket = io.connect( SOCKET_SERVER );
//    socket.on('announcment', function (data) {
//        $('img#photo').attr('class',data).attr('title','I\'m '+data);
//    }); 
////END: SOcketIO
//});
</script>
