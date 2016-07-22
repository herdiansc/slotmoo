<ul class="linefeed-ul">
    <?php $i=0;foreach($notes as $top){ ?>
    <?php 
        if(!isset($top['User']['username'])) $top['User']['username'] = @$top['Note']['_username'];
        if(!isset($top['User']['id'])) $top['User']['id'] = @$top['Note']['_user_id'];
        if(!isset($top['User']['photo_profile'])) $top['User']['photo_profile'] = @$top['Note']['_photo_profile'];
    ?>
        <li>
            <div class="linefeed" style="">
                <div class="linefeed-photo-profile" style="float:left">
                    <?php
                        $photo_profile = $top['User']['photo_profile'];
                        $photo_profile = $photo_profile == null ? DEFAULT_PP : $photo_profile ;
                        echo $html->image($photo_profile,array('width'=>50,'height'=>50));
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="note-linefeed-content" style="float:left">
                    <div class="linefeed-user">
                        <?php
                            if( $top['User']['display_name'] != null ) {
                                $display = $top['User']['display_name'];
                                $u = $top['User']['username'];
                            }else {
                                $display = $top['User']['username'];
                                $u = '';
                            }
                            echo $html->link($display,
                                array('controller'=>'users','action'=>'view','username'=>$top['User']['username']),
                                array('style'=>'text-decoration:none;font-weight:bold;font-size:14px;','title'=>$top['User']['username'])
                            );
                        ?>
                    </div>
                    <div class="linefeed-content">
                        <div>
                            <?php
                                echo $html->link($this->Text->truncate($top['Note']['title'],70),
                                    array('member'=>false,'admin'=>false,'controller'=>'notes','action'=>'view',$top['Note']['id'],$top['Note']['slug']),
                                    array('class'=>'note-title','title'=>$top['Note']['title'],'style'=>'text-decoration:none;')
                                );
                            ?>
                        </div>
                        <div class="excerpt" style="display:none;" title="<?php __('Excerpt') ?>">
                            <?php 
                                App::import('core','Sanitize');
                                echo $this->Text->truncate(Sanitize::stripTags($top['Note']['content'],'a','p','br','pre','img','strong','span','blockquote'),300);
                            ?>
                        </div>
                    </div>
                    <div class="linefeed-info">
                        <span>
                            <?php
                                if($top['Note']['_commentCount'] > 0){
                                    $linkLabel = sprintf(__n('%d comment','%d comments',$top['Note']['_commentCount'],true),$top['Note']['_commentCount']);
                                }else {
                                    $linkLabel = __('Add a comment',true);
                                }
                                echo $html->link($linkLabel,
                                    array('member'=>false,'admin'=>false,'controller'=>'notes','action'=>'view',$top['Note']['id'],$top['Note']['slug'].'#comment')
                                );
                            ?>
                        </span> - 
                        <?php if($top['Note']['created'] != $top['Note']['modified']){ ?>
                            <span><?php __('Updated') ?> <?php echo $this->Time->timeAgoInWords($top['Note']['modified'],array('format'=>'j/M/Y','end'=>'+1 day')) ?></span>
                        <?php }else { ?>
                            <span><?php __('Created') ?> <?php echo $this->Time->timeAgoInWords($top['Note']['created'],array('format'=>'j/M/Y','end'=>'+1 day')) ?></span>
                        <?php } ?>
                         - <span><?php echo $this->NoteFormater->visited($top['Note']['_visit']) ?></span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </li>
    <?php $i++;} ?>
</ul>

<script>
$(document).ready(function(){
    $('.linefeed').bind('mouseover',function(){
        $(this).find('.excerpt').show();
        $(this).addClass('linefeed-colored');
        $(this).find('.linefeed-action').show();
    }).bind('mouseout',function(){
        $(this).removeClass('linefeed-colored');
        $(this).find('.linefeed-action').hide();
        $(this).find('.excerpt').hide();
    });
});
</script>
