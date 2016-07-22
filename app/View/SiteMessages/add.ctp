<div class="center-box-inner-container">
    <?php echo $this->Form->create('SiteMessage',array('class'=>'uiForm')); ?>
    <div class="boxes boxes-dynamic width-95">
        <div class="box-title">
            <h1 style="margin:10px;padding:10px;">KONTAK KAMI</h1>
            <p class="form-desc" style="padding:0px 20px;font-size:11pt;">Form ini digunakan untuk menghubungi kami berkaitan dengan layanan yang disediakan oleh <?php echo SITE_NAME ?>.</p>
            <?php 
                echo $this->Form->input('subject',array('label'=>'Subjek Pesan *','class'=>'width-90'));
                echo $this->Form->input('content',array('label'=>'Isi Pesan *','class'=>'width-90','type'=>'textarea'));
            ?>
            <div class="input submit">
                <input type="submit" class="close button width-auto" value="Kirim">
            </div>    
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
    
<script type="text/javascript">
$(document).ready(function(){
});
</script>
