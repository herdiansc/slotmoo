<div class="center-box-inner-container">
    <?php echo $this->Form->create('User',array('class'=>'uiForm')); ?>
    <div class="boxes boxes-dynamic width-95">
        <div class="box-title">
            <h1 style="margin:10px;padding:10px;"><?php echo __('REGISTER HERE') ?></h1>
            <?php 
                echo $this->Form->input('username',array('label'=>__('Username *',true),'class'=>'width-90'));
                echo $this->Form->input('email',array('type'=>'text','label'=>__('Email *',true),'class'=>'width-90'));
                echo $this->Form->input('password',array('label'=>__('Password *',true),'type'=>'password','class'=>'width-90'));
                echo $this->Form->input('temppassword',array('label'=>__('Password Confirmation *',true),'type'=>'password','class'=>'width-90')); 

                $termsLink = $this->Html->link(__('Term of Services',true),
                    array('member'=>false,'admin'=>false,'controller'=>'pages','action'=>'display','terms'),
                    array('target'=>'_blank')
                );
                echo $this->Form->input('tos',array('type'=>'checkbox','label'=>array('text'=>__('I have read and agree with',true).' '.$termsLink.' *','style'=>'font-size:10pt;')));
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
