<div class="center-box-inner-container">
    <?php echo $this->Form->create('User',array(
        'class'=>'note-add-form',
        'url' => array(
			'action' => 'reset_password',
			$token)
        )); ?>
        <div class="boxes boxes-dynamic width-95">
            <div class="box-title">
                <h1 style="margin:10px;padding:10px;">RESET PASSWORD</h1>
                <p class="form-desc" style="padding:0px 20px;font-size:11pt;">Silahkan masukkan password baru anda di sini.</p>
                <?php echo $this->Form->input('new_password',array('type'=>'password','label'=>'Password Baru','style'=>'width:90% !important','autofocus'=>true)); ?>
                <?php echo $this->Form->input('confirm_password',array('type'=>'password','label'=>'Konfirmasi Password Baru','style'=>'width:90% !important','autofocus'=>true)); ?>
                <div class="input submit" style="margin-bottom:20px;margin-top:40px;">
                    <input type="submit" class="close button" value="Reset Password"  style="width:auto !important;">
                </div>    
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>
