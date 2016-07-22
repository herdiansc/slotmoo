<?php if(!isset($response)) { ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $.get(BASE_URL+'pipes/get_tops',function(data){
            $('.top-notes').html(data);
        });
    });
    </script>
<?php }else { ?>
<?php //debug($response); ?>
    <div class="boxes boxes-static">
        <div class="box-title">
            <h1 class="test side-header"><?php echo 'Iklan Populer'; ?></h1>
        </div>
        <div class="stories">
            <ul>
                <?php foreach($response['content'] as $top){ ?>
                    <li>
                        <?php
                            echo $this->Html->link($this->Text->truncate($top['Listing']['title'],45),
#                                array('member'=>false,'admin'=>false,'controller'=>'notes','action'=>'view','username'=>$top['Note']['_username'],'id'=>$top['Note']['id'],'slug'=>$top['Note']['slug']),
                                '/'.$top['Listing']['_username'].'/ads/'.$top['Listing']['id'].'/'.$top['Listing']['slug'],
                                array('title'=>$top['Listing']['title'])
                            );
                        ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>
