<div class="inside-left-box shadow welcome-notif-container" style="position:relative;background:#c9ffc9;">
<style>
.welcome-iconized {
    background:url(http://note.me.local/img/doc.png) no-repeat;
    color:#137313;padding:1px 0px 0px 30px;
}
</style>
    <h1 class="page-header welcome-iconized">Welcome to <?php echo SITE_NAME ?></h1>
    <div style="margin:10px;font-size: 11pt;">
        <p>
        Hi <strong><?php echo $this->Session->read('Auth.User.username') ?></strong>! You are new to <?php echo SITE_NAME ?>. Here is <strong>"<?php __('Your Linefeed') ?>"</strong> page, this is a page where notes created by you and by people who are you following will appear.
        </p>
        <p>
            Now you can create your first note from 
            <?php 
                echo $html->link(__('here',true),
                    array('admin'=>false,'member'=>true,'controller'=>'notes','action'=>'add')
                ) 
            ?> or by clicking the <strong>"<?php __('Create new note') ?>"</strong> link above.
        </p>
    </div>
    <div class="hide-notif">
        <a href="javascript:void(0)" title="<?php __('Click to hide this info') ?>"></a>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.hide-notif a').bind('click',function(){
        $.get(BASE_URL+'notifications/remove_welcome_notif',function(data){
            var obj = $.parseJSON(data);
            if(obj.status == 'success'){
                $('.welcome-notif-container').slideUp();
            }
        });
    });
});
</script>
