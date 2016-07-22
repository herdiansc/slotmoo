<?php if(!isset($responses)) { ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $.get(BASE_URL+'pipes/get_top_topics',function(data){
            $('.top-topics').html(data);
        });
    });
    </script>
<?php }else { ?>
    <div class="boxes boxes-static">
        <div class="box-title">
            <h1 class="test side-header"><?php echo 'Kata Kunci Populer'; ?></h1>
        </div>
        <?php //debug($responses) ?>
        <div class="stories">
            <ul>
                <?php $i=1;foreach($responses as $response){ ?>
                    <li>
                        <?php
                        
                            if($response['is_followed'] != 1){
                                $class='blue';
                                $label = 'Follow';
                                $onclick = 'Custom.follow(this);';
                            }else {
                                $class='red';
                                $label = 'Unfollow';
                                $onclick = 'Custom.unfollow(this);';
                            } 
                            
                            echo $i.'. '.$this->Html->link($this->Text->truncate($response['text'],45),
                                $response['link'],
                                array('title'=>$response['html']['title'],'class'=>'top-keyword','data-slug'=>$response['keyword_id'])
                            );
                            
                            echo '<div class="follow-buttons" id="'.$response['keyword_id'].'" style="float:left;display:none;">';
                            echo '<a onclick="'.$onclick.'" class="keyword-follow public-btn '.$class.' small" data-id="'.$response['keyword_id'].'">'.$label.'</a>';
                            echo '</div>';
                        ?>
                    </li>
                <?php $i++;} ?>
            </ul>
        </div>
    </div>
    
<script>
$(document).ready(function(){

    $(".top-keyword").hovercard({
        width: 200
    });
});
</script>
    
<?php } ?>


