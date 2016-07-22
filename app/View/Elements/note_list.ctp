<?php
#debug(array_keys($listings));
#debug($listings);
?>
<div id="new-post-btn-container" class="next" style="margin-bottom:10px;">
</div>
<ul class="linefeed-ul">
    <?php $i=0;foreach($listings as $top){ ?>
    <?php 
        if(!isset($top['User']) && isset($top['Listing']['User']) ) $top['User'] = $top['Listing']['User']; 
        if(!isset($top['User']['username'])) $top['User']['username'] = @$top['Listing']['_username'];
        if(!isset($top['User']['display_name'])) $top['User']['display_name'] = @$top['Listing']['_display_name'];
        if(!isset($top['User']['id'])) $top['User']['id'] = @$top['Listing']['user_id'];
        if(!isset($top['User']['photo_profile'])) $top['User']['photo_profile'] = @$top['Listing']['_photo_profile'];
    ?>
        <li>
            <div class="linefeed" style="">
                <div class="linefeed-photo-profile" style="float:left">
                    <?php
                        $photo_profile = @$top['User']['photo_profile'];
                        $photo_profile = $photo_profile == null ? DEFAULT_PP : CDN.'files/photo_profiles/customed/'.$photo_profile ;
                        echo $this->Html->image($photo_profile,array('width'=>50,'height'=>50,'alt'=>$top['User']['username']));
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="note-linefeed-content" style="float:left">
                    <div class="linefeed-user">
                        <?php
                            if( @$top['User']['display_name'] != null ) {
                                $display = @$top['User']['display_name'];
                            }else {
                                $display = $top['User']['username'];
                            }
                            echo $this->Html->link(h($display),
                                '/'.$top['User']['username'],
                                array('style'=>'text-decoration:none;font-weight:bold;font-size:14px;','title'=>$top['User']['username'])
                            );
                        ?>
                        <span></span>
                    </div>
                    <div class="linefeed-content">
                        <div class="listing-thumb-image">
<div class="border-img">
<?php
    if(@$top['Listing']['_image'] != null) {
        echo $this->ImageThumbnail->render($top['Listing']['_image'],
            array(
                'width'=>100,
                'height'=>100,
                'folder'=>'uploads',
                'cache'=>true,
                'cdn'=>$top['Listing']['_image_cdn']
            ),
            array('class'=>'pic','alt'=>null,'onerror'=>'$(this).hide();')
        );
    }
?>
</div>
                        </div>
                        <div class="list-text">
                            <?php
                                echo $this->Html->link($this->Text->truncate($top['Listing']['title'],50),
                                    '/'.$top['User']['username'].'/ads/'.$top['Listing']['id'].'/'.$top['Listing']['slug'],
                                    array('class'=>'note-title','title'=>$top['Listing']['title'],'style'=>'text-decoration:none;')
                                );
                            ?>
                            <span class="listing-price">Rp. <span class="listing-price-number"><?php echo number_format($top['Listing']['price'],0,',','.'); ?></span>,-</span>
                            <div class="listing-meta-keywords">
                            <?php
#                            if(isset($top['KeywordListing'])) { 
#                                if($top['Listing']['user_id'] == $this->Session->read('Auth.User.id')){ 
#                                    echo '<span class="listing-meta">Iklan anda</span>';
#                                }else {
                                //debug($top['KeywordListing']);
                                    if(!empty($top['KeywordListing'])) {
                                        $keys = array_keys($top['KeywordListing']);
                                        if(!is_int($keys[0])) {
                                            echo '<span class="listing-meta"><a href="/keywords/view/'.$top['KeywordListing']['_keyword_slug'].'">'.$top['KeywordListing']['_keyword_name'].'</a></span>';
                                        }else {
                                            shuffle($top['KeywordListing']);
                                            foreach($top['KeywordListing'] as $keyword){
                                                echo '<span class="listing-meta"><a href="/keywords/view/'.$keyword['_keyword_slug'].'">'.$keyword['_keyword_name'].'</a></span>';
                                            }
                                        }
                                    }
#                                }
#                            }
                            ?>
                            </div>
                        </div>
                        <?php
                            if($this->Session->read('Auth.User.id') == $top['User']['id'] ) {
                                echo '<div class="linefeed-action" style="display:none;">';
                                echo $this->Html->link(null,
                                    '/listings/delete/'.$top['Listing']['id'],//array('member'=>false,'admin'=>false,'controller'=>'listings','action'=>'delete',$top['Listing']['id']),
                                    array('confirm'=>__('Apakah anda yakin?',true),'class'=>'delete-act','escape'=>false,'title'=>'Hapus iklan ini?')
                                );
                                echo $this->Html->link(null,
                                    '/listings/edit/'.$top['Listing']['id'],//array('member'=>false,'admin'=>false,'controller'=>'listings','action'=>'edit',$top['Listing']['id']),
                                    array('class'=>'edit-act','escape'=>false,'title'=>'Edit iklan ini')
                                );
                                echo '</div>';
                            }
                        ?>
                        <div class="clear"></div>
                    </div>
                    <div class="linefeed-info">
                        <span>
                            <?php
                                if($top['Listing']['_commentCount'] > 0){
                                    $linkLabel = $top['Listing']['_commentCount'].' komentar';
                                }else {
                                    $linkLabel = 'Tambahkan komentar';
                                }
                                echo $this->Html->link($linkLabel,
                                    '/'.$top['User']['username'].'/ads/'.$top['Listing']['id'].'/'.$top['Listing']['slug'].'#comment'
                                );
                            ?>
                        </span> - 
                        <?php if(@$top['Listing']['created'] != @$top['Listing']['modified']){ ?>
                            <span><?php __('Updated') ?> <?php echo $this->Time->timeAgoInWords($top['Listing']['modified'],array('format'=>'j/M/Y','end'=>'+1 day')) ?></span>
                        <?php }else { ?>
                            <span><?php __('Created') ?> <?php echo $this->Time->timeAgoInWords($top['Listing']['created'],array('format'=>'j/M/Y','end'=>'+1 day')) ?></span>
                        <?php } ?>
                        
                         - <span title="Dilihat sebanyak <?php echo $top['Listing']['_visit'] ?> kali"><?php echo $this->NoteFormater->visited($top['Listing']['_visit']) ?></span>
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
        $(this).find('.linefeed-action').show();
    }).bind('mouseout',function(){
        $(this).find('.linefeed-action').hide();
    });
    
    $('.linefeed-content').bind('mouseover',function(){
        $(this).addClass('linefeed-content-shadowed');
    }).bind('mouseout',function(){
        $(this).removeClass('linefeed-content-shadowed');
    });
});
</script>
