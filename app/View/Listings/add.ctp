<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header border-bottom"><?php echo 'Buat Iklan Baru' ?></h1>

        <?php echo $this->Form->create(null,array('type'=>'file','class'=>'note-add-form')); ?>
            <?php echo $this->Form->input('title',array('label'=>'Judul Iklan','class'=>'note-title','autocomplete'=>'off','style'=>'width:90% !important','title'=>'Bagian judul tidak boleh kosong')); ?>
            <?php echo $this->Form->input('description',array('label'=>'Isi Iklan','style'=>'width:90% !important','id'=>'NoteContent','title'=>'Bagian deskripsi tidak boleh kosong','between'=>'<p style="line-height:20px !important;">Deskripsi produk berisi penjelasan tentang kondisi dan spesifikasi produk yang anda jual, bagaimana cara membeli produk tersebut, di mana anda bisa dihubungi, dll.</p>')); ?>
            <?php echo $this->Form->input('price',array('type'=>'text','label'=>'Harga','class'=>'note-title','autocomplete'=>'off','style'=>'width:90% !important','between'=>'<p style="line-height:20px !important;">Silahkan isi harga secara bijak. Pengunjung tertarik pada harga "masuk akal" dibandingkan harga seperti Rp. 123,-. Masukkan hanya angka saja.</p>','title'=>'Bagian harga tidak boleh kosong')); ?>
            <div class="input text image-uploader">
                <label>Upload Gambar Produk</label>
                <p style="line-height:20px !important;">Anda bisa menambahkan gambar produk anda maksimal 4 gambar. TIPS: Gunakan gambar yang persegi supaya tampilan lebih bagus, contohnya: 500px x 500px, 400px x 400px, dll.</p>
                <ul class="image-list">
                <?php 
                $images = $this->Session->read('AdImages');
                if(sizeof($images) < IMAGES_ALLOWED) {
                    $empties = array();
                    for($i=0;$i<IMAGES_ALLOWED-sizeof($images);$i++) $empties[] = ''; 
                    $images = array_merge((array) $images,$empties);
                }
                foreach((array)$images as $image){ ?>
                    <li>
                        <?php if(isset($image['filename'])){ ?>
                        <div class="image-thumb">
                            <span data-url="<?php echo Router::url('/').'image_listings/delete_image/'.$image['filename'] ?>" class="del" title="Hapus gambar ini" onclick="Custom.deleteImage(this);" data-filename="<?php echo $image['filename'] ?>">x</span>
                            <img src="<?php echo $image['CDN'].'uploads/'.$image['filename'] ?>" />
                        </div>
                        <input type="file" name="listing_image" value="tambah gambar" class="file add-image" style="display:none"/>
                        <?php }else { ?>
                            <div class="image-thumb"></div>
                            <input type="file" name="listing_image" value="tambah gambar" class="file add-image"/>
                        <?php } ?>
                    </li>
                <?php } ?>
                </ul>
                <div style="clear:both"></div>
            </div>
            <div class="input text">
                <label for="add-topic" class="border-bottom" style="padding-bottom:10px;"><?php echo __('Kata Kunci') ?></label>
                <p style="line-height:20px !important;"><?php echo 'Kata kunci boleh lebih dari satu dan harus dipisahkan tanda koma. Contohnya: Mobil Murah, Mobil, Pakaian, atau yang lainnya. Kata kunci yang tepat akan membantu iklan bisa dilihat orang yang tepat.' ?></p>
                <ul class="topics" style="width:97% !important">
                    <li class="input-holder">
                        <input id="add-topic" type="text" title="<?php echo 'Tambahkan kata kunci' ?>">
                    </li>
                    <li><div class="clear"></div></li>
                </ul>
            </div>
            <?php 
            //echo $this->Form->input('privacy_id',array('label'=>false,'div'=>false,'class'=>'note-title','options'=>$privacies,'default'=>$lastPrivacy,'autocomplete'=>'off','style'=>'width:auto;margin-left:20px;')); 
            ?>
            <div class="input text">
            <p style="line-height:20px !important;">Dengan menekan tombol simpan bearti anda setuju terhadap <a href="/pages/terms" target="_blank">syarat dan ketentuan</a> yang berlaku di <?php echo SITE_NAME ?>.</p>
            <input type="submit" class="close button" value="<?php echo 'Simpan dan Tampilkan Iklan' ?>">
            </div>
        <?php echo $this->Form->end(); ?>
        <div class="clear"></div>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>

<?php
echo $this->Html->script('jquery.ajaxfileupload');
?>
<?php $timestamp = time();?>
<?php $session_id = session_id(); ?>
<script>

$(document).ready(function(){
    //Custom.editorInit();
    Custom.initTopicAutocomplete('#add-topic',BASE_URL+'keywords/get_suggestions');
    
    
    

    
    $('input[type="file"]').ajaxfileupload({
      'action': BASE_URL+'image_listings/uploadify',
      'params': {
        'extra': 'info'
      },
      'onComplete': function(obj) {
        if(obj.status == 'success') {
            var html = ''+
            '<span data-url="'+BASE_URL+'image_listings/delete_image/'+obj.filename+'" class="del" title="Hapus gambar ini" onclick="Custom.deleteImage(this);" data-filename="'+obj.filename+'">x</span>'+
            '<img src="'+CDN+'uploads/'+obj.filename+'">';
            $(this).parent().find('.image-thumb').html(html).show();
            $(this).hide();
            
            $(this).attr('disabled',false);   
            var notif_class = 'success-floating-notif';
        }else {
            var notif_class = 'error-floating-notif';
        }
        Custom.hideNotif(obj.message,notif_class);
      },      
      'onStart': function() {
        $( ".ajax-loading" ).show();
      },
      'onCancel': function() {
        console.log('no file selected');
      }
    });
});
</script>
