<div class="center-box-inner-container">
    <?php echo $this->Form->create('User',array('class'=>'uiForm')); ?>
        <div class="boxes boxes-dynamic width-95">
            <div class="box-title">
                <h1 style="margin:10px;padding:10px;"><?php echo 'LOGIN DI SINI' ?></h1>
                <?php echo $this->Form->input('email',array('label'=>'Email','type'=>'text','class'=>'width-90','autofocus'=>true)); ?>
                <?php echo $this->Form->input('password',array('label'=>'Password','type'=>'password','class'=>'width-90')); ?>
                <div class="input submit complete-login-container">
                    <input type="submit" class="close button  main-login" value="Login">
                    <span style="padding-left: 92px;"><?php echo 'ATAU' ?></span>
                    <div style="float:right;">
	                    <?php 
	                        echo $this->Html->link('<img src="/img/facebook-login-button.png" style="height:45px;margin-top: -9px;margin-right: 31px;">',
	                            '#',
	                            array('escape'=>false,'onclick'=>"open_win('".$fb_login_url."');")
	                        ); 
	                    ?>
                    </div>
                </div>    
                <?php
                    echo $this->Html->link('Lupa password?',
                        '/users/reset_password',
                        array('class'=>'fogot-pwd')
                    )
                ?>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>

	    <script>
	    function open_win(url){
          var left = (screen.width/2)-(400/2);
          var top = (screen.height/2)-(300/2);
          return window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=400, height=300, top='+top+', left='+left);
            //window.open(url,'','width=400,height=400');
        }
	    </script>
