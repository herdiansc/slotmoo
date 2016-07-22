<?php
/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<div class="center-box-inner-container">
    <?php echo $this->Form->create('User',array(
        'class'=>'note-add-form',
        'url' => array(
			'admin' => false,
			'action' => 'reset_password')
        )); ?>
        <div class="boxes boxes-dynamic width-95">
            <div class="box-title">
                <h1 style="margin:10px;padding:10px;">PERMINTAAN RESET PASSWORD</h1>
                <p class="form-desc" style="padding:0px 20px;font-size:11pt;">Form ini digunakan untuk mengirimkan permintaan reset password anda, anda harus memasukkan email yang biasa anda gunakan untuk login.</p>
                <?php echo $this->Form->input('email',array('type'=>'text','style'=>'width:90% !important','autofocus'=>true)); ?>
                <div class="input submit" style="margin-bottom:20px;margin-top:40px;">
                    <input type="submit" class="close button" value="Kirim Permintaan"  style="width:auto !important;">
                </div>    
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>
