<div class="center-box-inner-container">
    <?php echo $this->Form->create('User',array('class'=>'uiForm')); ?>
    <div class="boxes boxes-dynamic width-95">
        <div class="box-title">
            <h1 style="margin:10px;padding:10px;"><?php echo 'DAFTAR DI SINI' ?></h1>
            <?php 
                echo $this->Form->input('username',array('label'=>'Username *','class'=>'width-90'));
                echo $this->Form->input('email',array('type'=>'text','label'=>'Email *','class'=>'width-90'));
                echo $this->Form->input('password',array('label'=>'Password *','type'=>'password','class'=>'width-90'));
                echo $this->Form->input('temppassword',array('label'=>'Konfirmasi Password *','type'=>'password','class'=>'width-90')); 
                echo $this->Recaptcha->display();

                $termsLink = $this->Html->link('Syarat dan Ketentuan',
                    '/pages/terms',
                    array('target'=>'_blank')
                );
                echo $this->Form->input('tos',array('type'=>'checkbox','label'=>array('text'=>'Saya sudah membaca dan setuju terhadap '.$termsLink.' *','style'=>'font-size:10pt;')));
            ?>
            <div class="input submit">
                <input type="submit" class="close button width-auto" value="<?php echo 'Daftar' ?>">
            </div>    
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
    
<script type="text/javascript">
$(document).ready(function(){
});
</script>
