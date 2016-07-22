<div class="one-box-inner-container">
    <div class="featured-ads-widget">
        <h3 class="featured-heading bg-black-glossy" style="display:none;position:absolute;
color: white;
padding: 10px;
font-size: 15px;
top: -5px;left:-5px;z-index: 99999;">Featured Ads</h3>
        <ul class="featured-ads-list slide_content">
            <?php //debug($specials[0]) ?>
            <?php $i=0;foreach($specials as $featured){ ?>
            <?php if($featured['Listing']['is_featured'] == 1) { ?>
            <li <?php if($i>0){echo 'style="display:none"';} ?>>
                <div style="float:left">
                    <img src="<?php echo $featured['Listing']['_image_cdn'].'uploads/'.$featured['Listing']['_image'] ?>" width="250" height="250">
                </div>
                <div class="featured-item">
                    <h1>
                        <?php 
                            echo $this->Html->link($this->Text->truncate($featured['Listing']['title'],55),
                                '/'.$featured['User']['username'].'/ads/'.$featured['Listing']['id'].'/'.$featured['Listing']['slug'],
                                array('title'=>$featured['Listing']['title'],'style'=>'text-decoration:none;')
                            );
                        ?>
                    </h1>
                    <p class="meta">
                        Dipasang pada tanggal <span><?php echo date('d M Y',strtotime($featured['Listing']['created'])) ?></span><br />Pemasang adalah 
                        <span>
                            <?php 
                                $user_display_name = $featured['User']['display_name'] != null ? $featured['User']['display_name'] : $featured['User']['username'] ;
                                echo $user_display_name;  
                            ?>
                        </span>
                    </p>
                    <div class="price">
                        <span class="symbol">Rp. </span><span class="numeric"><?php echo number_format($featured['Listing']['price'],0,',','.') ?>,-</span>
                    </div>
                    <ul class="featured-keywords">
                        <?php foreach($featured['KeywordListing'] as $featured_keyword){ ?>
                        <li><a href="/keywords/view/<?php echo $featured_keyword['_keyword_slug'] ?>"><?php echo $featured_keyword['_keyword_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <?php $i++;} ?>
            <?php } ?>
        </ul>
    </div>
    <div class="hot-ads-widget">
        <h3 class="hot-heading bg-black-glossy" style="
color: white;
padding: 10px;
font-size: 15px;float: left;
margin: -15px 0px 10px -15px;
">Hot Ads</h3>
        <ul class="hot-ads-list" style="clear:both;">
            <?php $i=0;foreach($specials as $hot){ ?>
                <?php
                    if($hot['Listing']['is_hot'] == 1 && $i<9 ) {
                        echo "<li>";
                        echo $this->Html->link($this->Text->truncate($hot['Listing']['title'],50),
                            '/'.$hot['User']['username'].'/ads/'.$hot['Listing']['id'].'/'.$hot['Listing']['slug'],
                            array('class'=>'note-title','title'=>$hot['Listing']['title'],'style'=>'text-decoration:none;')
                        );   
                        echo "</li>";
                        $i++;
                    }
                ?>
            <?php } ?>
        </ul>
    </div>
    <div class="clear"></div>
<style>
.main-keywords {background:white;margin:10px 0px 5px 0px;height:30px;}
.main-keywords-list {
display: block;
float: left;
height: 30px;
width:840px;
overflow-y: hidden;
}
.main-keywords-list li {display:inline;}
.main-keywords-list li a {font-size:14px;padding:10px;line-height:30px;text-decoration:none;}
</style>
    <div class="main-keywords">
        <div class="bg-black-glossy" style="float:left;line-height:30px;font-size:14px;padding:0px 10px;color:white;">Kata Kunci:</div> 
        <ul class="main-keywords-list">
            <?php $i=0;foreach($keywords as $keyword){ ?>
            <li data-r="<?php echo $keyword['Keyword']['rank'] ?>" data-lc="<?php echo $keyword['Keyword']['_listings_count'] ?>"><a title="<?php echo strtolower($keyword['Keyword']['name']) ?>" href="/keywords/view/<?php echo $keyword['Keyword']['slug'] ?>"><?php echo $this->Text->truncate(strtolower($keyword['Keyword']['name']),15) ?></a></li>
            <?php $i++;} ?>
        </ul>
        <div class="clear"></div>
    </div>
    
</div>


<div class="left-box-inner-container">
    <div class="inside-left-box shadow">
        <h1 class="page-header">
            Semua Iklan
            <?php echo $this->element('sorter') ?>
        </h1>
        <?php if(empty($listings)){ ?>
            <center style="margin:20px 0px;font-size:16px;">
                <span style="color:#ddd;">Belum ada iklan.</span>
            </center>
        <?php } ?>
        <?php echo $this->element('note_list') ?>
        <div class="clear"></div>
        <?php echo $this->element('pagination') ?>
    </div>
</div>
<div style="float:right;">
    <?php echo $this->element('sidebar') ?>
</div>


<?php
echo $this->Html->css('../js/bxslider/jquery.bxslider.css');
echo $this->Html->script(array('bxslider/jquery.bxslider.min'));
?>

<script>
$(document).ready(function(){


    $('.featured-ads-widget').bind('mouseover',function(){
        $(this).find('.featured-heading').show();
    }).bind('mouseout',function(){
        $(this).find('.featured-heading').hide();
    });
    
    $('.slide_content').show().bxSlider({
        mode:'fade',
        auto:true,
        autoHover:true,
        speed:200
    });
});
</script>
