<?php
//debug($this->request->data);
?>
<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header border-bottom"><?php echo 'Ubah Iklan' ?></h1>
        <?php echo $this->Form->create(null,array('type'=>'file','class'=>'note-add-form')); ?>
            <?php echo $this->Form->hidden('id'); ?>
            <?php echo $this->Form->input('title',array('label'=>'Judul Iklan','class'=>'note-title','autocomplete'=>'off','style'=>'width:90% !important','title'=>'Bagian judul tidak boleh kosong')); ?>
            <?php echo $this->Form->input('description',array('label'=>'Isi Iklan','style'=>'width:90% !important','id'=>'NoteContent','between'=>'<p style="line-height:20px !important;">Deskripsi produk berisi penjelasan tentang kondisi dan spesifikasi produk yang anda jual, bagaimana cara membeli produk tersebut, di mana anda bisa dihubungi, dll.</p>')); ?>
            <?php echo $this->Form->input('price',array('type'=>'text','label'=>'Harga','class'=>'note-title','autocomplete'=>'off','style'=>'width:90% !important','between'=>'<p style="line-height:20px !important;">Silahkan isi harga secara bijak. Pengunjung tertarik pada harga "masuk akal" dibandingkan harga seperti Rp. 123,-. Masukkan hanya angka saja.</p>','title'=>'Bagian harga tidak boleh kosong')); ?>
            <div class="input text image-uploader">
                <label>Upload Gambar Barang</label>
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
                            <span data-url="<?php echo Router::url('/').'image_listings/delete_image/'.$image['filename'].'?db=true&listing_id='.$this->request->data['Listing']['id'] ?>" class="del" title="Hapus gambar ini" onclick="Custom.deleteImage(this);" data-filename="<?php echo $image['filename'] ?>">x</span>
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
                <p style="line-height:20px !important;"><?php echo __('Tambahkan kata kunci yang berhubungan dengan iklan ini. Silahkan pilih dari autocomplete atau ketik kata kunci anda sendiri dengan memisahkan tiap kata kunci dengan tanda koma(,).') ?></p>
                <ul class="topics" style="width:97% !important">
                    <?php foreach($this->request->data['KeywordListing'] as $keyword){ ?>
                    <li>
                        <div class="topic-container">
                            <?php
                                $jsoned_keyword = array(
                                    'id'=>$keyword['keyword_id'],
                                    'label'=>$keyword['_label'],
                                    'existed_id'=>$keyword['id']
                                );
                                $jsoned_keyword = json_encode($jsoned_keyword);
                            ?>
                            <input name="keyword[]" type="hidden" value='<?php echo $jsoned_keyword ?>'>
                            <span class="topic-name"><?php echo $keyword['_label'] ?></span>
                            <span class="topic-act" data-id="<?php echo $keyword['id'] ?>" data-listing-id="<?php echo $keyword['listing_id'] ?>" onclick="Custom.deleteKeywordListing(this);" title="Remove this topic">x</span>
                        </div>
                    </li>
                    <?php } ?>
                    <li class="input-holder">
                        <input id="add-topic" type="text" title="<?php __('Add another tag') ?>">
                    </li>
                    <li><div class="clear"></div></li>
                </ul>
            </div>
            <input type="submit" class="close button" value="<?php echo 'Update Iklan' ?>"  style="margin-left:20px;">
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
<script>
$(document).ready(function(){
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
