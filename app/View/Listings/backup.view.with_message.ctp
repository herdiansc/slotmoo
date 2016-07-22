<?php
//debug($ids);
?>
<div class="left-box-inner-container">

    <div class="inside-left-box shadow" style="position:relative">
        <h1 class="page-header ad-title playtime-font"><?php echo h($listing['Listing']['title']) ?></h1>
        <h2 class="price-box" style="display:none"><span class="simbol">Rp. </span><span class="number"><?php echo number_format(h($listing['Listing']['price']),0,',','.'); ?></span><span class="simbol">,-</span></h2>
        <div class="note-meta">
            <?php
                echo 'Diiklankan oleh: ';
                echo $this->Html->link(h($listing['User']['username']),
                    '/'.$listing['User']['username']
                ).' ('.$this->Time->timeAgoInWords($listing['Listing']['created'],array('end'=>'+1 day')).') - ';
                echo $this->NoteFormater->visited($listing['Listing']['_visit']+1,false);
            ?>
            <?php
                $size = sizeof($listing['KeywordListing']);
                $topicForRelated = null;
                if($size > 0) {
                    echo '<div style="height:10px;"></div>';
                    echo 'Kata kunci: ';
                    $i=0;
#            debug($ids);                    
                    foreach($listing['KeywordListing'] as $topic) {
                        $comma = $i < $size-2 ? ',' : null ;
                        $comma .= $i == $size-2 ? ' dan' : null ;
                        
                        $topicForRelated .= $topic['_keyword_name'].' ';
                        echo $this->Html->link(h($topic['_keyword_name']),
                            array('member'=>false,'admin'=>false,'controller'=>'keywords','action'=>'view',$topic['_keyword_slug']),
                            array('class'=>'keyword','data-slug'=>$topic['_keyword_slug'])
                        );
                        if(!in_array($topic['keyword_id'],$ids)){
                            $class='blue';
                            $label = 'Follow';
                            $onclick = 'Custom.follow(this);';
                        }else {
                            $class='red';
                            $label = 'Unfollow';
                            $onclick = 'Custom.unfollow(this);';
                        }
                        echo '<div class="follow-buttons" id="'.$topic['_keyword_slug'].'" style="float:left;display:none;">';
                        echo '<a onclick="'.$onclick.'" class="keyword-follow public-btn '.$class.' small" data-id="'.$topic['keyword_id'].'">'.$label.'</a>';
                        echo '</div>';
                        echo $comma.' ';
                        $i++;
                    }
                }
                $topicForRelated .= $listing['Listing']['title'];
                echo '<input type="hidden" name="topics" id="topics_container" value="'.h($topicForRelated).'">';
            ?>
        </div>
        <div class="actions" style="margin:0px 10px 10px;color: #999;">
            Aksi: 
            <a href="<?php echo $this->here ?>#comment">Beri Komentar</a> - 
            <a class="popup" href="/private_messages/add/<?php echo $listing['Listing']['user_id'].'/'.$listing['Listing']['id'] ?>">Kirimi Pesan</a>
        </div>
        <div class="listing-image" style="position:relative">
            <img class="main-display" src="<?php echo $listing['ImageListing'][0]['image_server'].'uploads/'.$listing['ImageListing'][0]['filename'] ?>">
            <ul class="image-thumb-list" style="display:none">
                <?php foreach($listing['ImageListing'] as $image) { ?>
                <li><img data-large-file="<?php echo $image['image_server'].'uploads/'.$image['filename'] ?>" src="<?php echo $image['image_server'].'uploads/'.$image['filename'] ?>"></li>
                <?php } ?>
            </ul>
        </div>
        <div class="note-content-container">
            <h4 class="page-header description">Deskripsi</h4>
            <?php echo nl2br(h($listing['Listing']['description'])); ?>
        </div>
        <div class="clear"></div>
    </div>
    <script>
    $(document).ready(function(){
        $.post(BASE_URL+'pipes/related',{title:$('#topics_container').val()},function(data){
            $('#related').append(data);
        });
    });
    </script>
<!--    
    <script>$(document).ready(function(){Custom.initShareThisStyle();});</script>
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-7f87d5-1cb1-e668-5b8f-4897894c9c2f"}); </script>
-->
    <?php echo $this->element('comment') ?>
    <div id="related"></div>
</div>

<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>

<?php
echo $this->Html->css('magnific-popup');
echo $this->Html->script('jquery.magnific-popup.min');
?>

<script>
$(document).ready(function(){
    $('.inside-left-box').bind('mouseover',function(){
        $(this).find('.price-box').show();
    }).bind('mouseout',function(){
        $(this).find('.price-box').hide();
    });
    
    $('.listing-image').bind('mouseover',function(){
        $(this).find('.image-thumb-list').show();
    }).bind('mouseout',function(){
        $(this).find('.image-thumb-list').hide();
    });
    
    $('.image-thumb-list li').bind('click',function(){
        var large_file = $(this).find('img').attr('data-large-file');
        $('.main-display').attr('src',large_file);
    });
    
    $(".keyword").hovercard({
        width: 200
    });

$('.popup').magnificPopup({
  type: 'ajax'
});

});
</script>
