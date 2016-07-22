    <h4 class="popup-header">Kirim Pesan</h4>
    <p>Anda bisa mengirimkan pesan kepada pemilik iklan ataupun kepada sesama anggota <?php echo SITE_NAME ?> dengan menggunakan form ini:</p>
    <?php echo $this->Form->create('PrivateMessage',array('id'=>'send_message_form','class'=>'note-add-form')); ?>
	<?php
	    echo $this->Form->hidden('to_id');
		echo $this->Form->input('title',array('label'=>'Judul Pesan','class'=>'note-title','autocomplete'=>'off','style'=>'width:90% !important','title'=>'Bagian judul tidak boleh kosong'));
		echo $this->Form->input('content',array('label'=>'Isi Pesan','style'=>'width:90% !important','id'=>'NoteContent','title'=>'Bagian isi tidak boleh kosong','between'=>'<p style="line-height:20px !important;">Silahkan masukkan isi pesan anda di sini.</p>'));
	?>
            <div class="input text">
            <input type="submit" class="send-message close button" value="<?php echo 'Kirimkan Pesan' ?>">
            </div>
	<?php echo $this->Form->end(); ?>
    <button title="Tutup (Esc)" type="button" class="mfp-close">×</button>

<script>
$(document).ready(function(){
      $('.keywords_list').slimscroll({
          color: '#333',
          size: '10px',
          //width: '50px',
          height: '308px'                  
      });
      
      $('.send-message').bind('click',function(){
        event.preventDefault();
        $.post($('#send_message_form').attr('action'),$('#send_message_form').serialize(),function(response){
            var obj = $.parseJSON(response);
            if(obj.status == 'success') {
                $.magnificPopup.close();
            }
        }); //$('#send_message_form').
      });
});
</script>
