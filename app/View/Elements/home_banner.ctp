<?php if(!$this->Session->read('Auth.User')) { ?>
    <div class="reg-in-banner">
        <div class="box-header-main">
            <a href="<?php echo Router::url('/',true) ?>" style="text-decoration:none">
                <h1 class="header-logo main">
                    <?php echo $this->NoteFormater->logo('logo_v_2_black.png',array('width'=>150)); ?>
                    <hr />
                </h1>
            </a>
        </div>
        <div class="form-header-main">
            <h4 class="left"><?php echo 'LOGIN' ?></h4>
            <?php echo $this->Html->link('Lupa Password?','/users/reset_password',array('class'=>'right')); ?>
            <div class="clear"></div>
            <?php
                echo $this->Form->create('User',array('url'=>array('admin'=>false,'member'=>false,'plugin'=>'users','controller'=>'users','action'=>'login')));
                echo $this->Form->input('email',array('type'=>'text','label'=>'Email','div'=>array('class'=>'input text inside-label')));
                echo $this->Form->input('password',array('label'=>'Password','div'=>array('class'=>'input password inside-label')));
            ?>
                <div class="input submit complete-login-container-home border-bottom">
                    <input type="submit" class="close button width-auto" value="Login">
                    <span class="short-text">Atau login dengan</span>
                    <div style="float:right;padding-right:10px;">
                        <input type="button" onclick="open_win('<?php echo $fb_login_url ?>');" class="alt-login-btn facebook" value="Facebook" title="<?php echo 'Log in using facebook account.' ?>">
                    </div>
                </div>    
            <?php echo $this->Form->end(); ?>
            <center><span class="span-or short-text"><?php echo 'Atau buat akun '.SITE_NAME ?></span></center>
            <h4><?php echo 'DAFTAR DI SINI' ?></h4>
            <?php
                echo $this->Form->create('User',array('url'=>array('admin'=>false,'member'=>false,'controller'=>'users','action'=>'register')));
                echo $this->Form->hidden('place',array('value'=>Security::hash('/')));
                echo $this->Form->input('username',array('type'=>'text','label'=>'Username','id'=>'UserUsernameReg','div'=>array('class'=>'input text inside-label')));
                echo $this->Form->input('email',array('type'=>'text','label'=>'Email','id'=>'UserEmailReg','div'=>array('class'=>'input text inside-label')));
            ?>
                <div class="input submit">
                    <input type="submit" class="close button width-auto" value="<?php echo 'Lanjut' ?>">
                </div>    
            <?php echo $this->Form->end() ?>
        </div>
    </div>
<?php } ?>
<div class="clear"></div>

<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/lib/jquery.bxslider.css" rel="stylesheet" />

<?php
echo $this->Html->css('../js/bxslider/jquery.bxslider.css');
echo $this->Html->script(array('bxslider/jquery.bxslider.min'));
?>

<script>
$(document).ready(function(){
    $('.inside-label input').bind('focus',function(){
        $(this).parents('.inside-label').find('label').fadeOut();
    }).bind('blur',function(){
        if($(this).val() == '') {
            $(this).parents('.inside-label').find('label').fadeIn();
        }
    });
    $('.slide_content').show().bxSlider({
        mode:'fade',
        auto:true,
        autoHover:true,
        speed:200
    });
});
</script>

	    <script>
	    function open_win(url){
          var left = (screen.width/2)-(400/2);
          var top = (screen.height/2)-(300/2);
          return window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=400, height=300, top='+top+', left='+left);
            //window.open(url,'','width=400,height=400');
        }
	    </script>
