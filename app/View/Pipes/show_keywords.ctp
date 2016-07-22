    <h4 class="popup-header">Follow Kata Kunci</h4>
    <p>Anda bisa mem-follow kata kunci iklan yang anda inginkan. Caranya mudah cukup pilih kata kunci iklan yang ingin anda follow dari daftar kata kunci yang kami sarankan di bawah ini:</p>
    <ul class="keywords_list">
        <?php foreach($responses as $keyword){ ?>
        <li>
            <a class="keyword"><?php echo $keyword['text'] ?></a>
            <?php 
            if($keyword['is_followed'] != 1){
                $class='blue';
                $label = 'Follow';
                $onclick = 'Custom.follow(this);';
            }else {
                $class='red';
                $label = 'Unfollow';
                $onclick = 'Custom.unfollow(this);';
            } 
            ?>
            <a onclick="<?php echo $onclick ?>" class="keyword-follow public-btn <?php echo $class ?> small" data-id="<?php echo $keyword['keyword_id'] ?>"><?php echo $label ?></a>          
            <br class="clear" />
        </li>
        <?php } ?>
    </ul>
    <button title="Tutup (Esc)" type="button" class="mfp-close">×</button>

<script>
$(document).ready(function(){
      $('.keywords_list').slimscroll({
          color: '#333',
          size: '10px',
          //width: '50px',
          height: '308px'                  
      });
});
</script>
