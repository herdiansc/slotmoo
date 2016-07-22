<div class="inside-left-box shadow" id="comment">
    <h4 class="page-header">Komentar</h1>
    <ul>
        <?php if(empty($comments)){ ?>
        <li>
        <div style="font-size:14px;text-align:center">
            <?php echo 'Belum ada komentar' ?>
       </div>
       </li>
        <?php } ?>
        <?php $i=0; ?>
        <?php foreach($comments as $comment) { ?>
            <li>
                <div class="linefeed" <?php if($i==0) echo 'style="border-top:1px solid #eee;"' ?>>
                    <div class="linefeed-photo-profile" style="float:left">
                        <?php
                            $photo_profile = $comment['Comment']['_photo_profile'];
                            $photo_profile = $photo_profile == null ? DEFAULT_PP : $photo_profile ;
                            echo $this->Html->image($photo_profile,array('width'=>50,'height'=>50,'alt'=>$comment['Comment']['_username']));
                        ?>
                        <div class="clear"></div>
                    </div>
                    <div class="note-linefeed-content" style="float:left">
                        <div class="linefeed-user">
                            <?php
                                echo $this->Html->link(h($comment['Comment']['_username']),
                                    '/'.$comment['Comment']['_username'],
                                    array('style'=>'text-decoration:none;font-weight:bold;font-size:14px;')
                                );
                            ?>
                        </div>
                        <div class="linefeed-content">
                            <?php
                                echo '<div class="note-comment-container">'.nl2br(h($comment['Comment']['content'])).'</div>';
                                if($this->Session->read('Auth.User.id') == $comment['Comment']['user_id'] ) {
                                    echo '<div class="linefeed-action" style="display:none">';
                                    echo $this->Html->link(null,
                                        '/comments/delete/'.$comment['Comment']['id'],
                                        array('confirm'=>'Are you sure?','class'=>'delete-act','escape'=>false,'title'=>'Delete this comment')
                                    );
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        <div class="linefeed-info">
                            <span><?php echo $this->Time->timeAgoInWords($comment['Comment']['created'],array('format'=>'j/M/Y','end'=>'+1 day')) ?></span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
        <?php $i++;} ?>
    </ul>
    <?php echo $this->element('pagination_comment') ?>
    <div class="comment-form-container">
        <?php
            if($this->Session->read('Auth.User.id')){
                echo $this->Form->create('Comment',array('class'=>'comment-form','url'=>'/comments/add'));
                echo $this->Form->hidden('Comment.listing_id',array('value'=>$listing['Listing']['id']));
                echo $this->Form->input('Comment.content',array('label'=>false,'type'=>'textarea'));
                echo '<div style="height:10px;"></div>';
                echo $this->Form->end(array('label'=>'Submit','class'=>'public-btn small'));
            }else {
                echo '<div style="font-size:14px;text-align:center">';
                echo $this->Html->link('Login',
                    array('member'=>false,'admin'=>false,'plugin'=>'users','controller'=>'users','action'=>'after?action=login&redir='.$this->here)
                );
                echo ' ';
                echo 'atau';
                echo ' ';
                echo $this->Html->link('Daftar',
                    array('member'=>false,'admin'=>false,'plugin'=>'users','controller'=>'users','action'=>'after?action=register&redir='.$this->here)
                );
                echo ' ';
                echo 'untuk menulis komentar';
                echo '</div>';
            }
        ?>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.linefeed').bind('mouseover',function(){
        $(this).find('.linefeed-action').show();
    }).bind('mouseout',function(){
        $(this).find('.linefeed-action').hide();
    });
});
</script>
