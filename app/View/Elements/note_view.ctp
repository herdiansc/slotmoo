<div class="inside-left-box shadow">
    <h1 class="page-header"><?php echo $note['Note']['title'] ?></h1>
    <div class="note-meta" style="color:#999;margin:5px 10px;padding-bottom:10px;">
        <?php
            __('Created by');
            echo ' ';
            echo $html->link($note['User']['username'],array('controller'=>'users','action'=>'view','username'=>$note['User']['username'])).' ('.$this->Time->timeAgoInWords($note['Note']['created'],array('end'=>'+1 day')).') - ';
            echo $this->NoteFormater->visited($note['Note']['_visit']+1,false);
        ?>
    </div>
    <div class="note-content-container">
        <?php echo $note['Note']['content']; ?>
    </div>
    <div class="clear"></div>
    <div class="social-media-wrapper" style="opacity:0.1">
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_plusone_large' displayText='Google +1'></span>
        <span class='st_linkedin_large' displayText='LinkedIn'></span>
        <span class='st_delicious_large' displayText='Delicious'></span>
        <span class='st_wordpress_large' displayText='WordPress'></span>
        <span class='st_myspace_large' displayText='MySpace'></span>
        <span class='st_identi_large' displayText='identi.ca'></span>
        <span class='st_digg_large' displayText='Digg'></span>
        <span class='st_blogger_large' displayText='Blogger'></span>
    </div>
</div>
<script>$(document).ready(function(){Custom.initShareThisStyle();});</script>
<script>$(document).ready(function(){$.post(BASE_URL+'notes/related',{title:$('.page-header').text()},function(data){$('#related').append(data);});});</script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-7f87d5-1cb1-e668-5b8f-4897894c9c2f"}); </script>
