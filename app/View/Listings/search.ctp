    <div class="notes-index-container">
        <center>
            <div style="padding:20px 0px;margin-bottom:10px;">
                <h1>
                    <?php 
                        echo 'Pencarian: ';
                        App::uses('Sanitize','Utility');
                        echo Sanitize::html(@$this->params['url']['string']);
                    ?>
                </h1>
            </div>
        </center>
<!-- BOXES -->
        <div class="index-box-container">
        <center>
        <?php
            $red = 255;
            $green = 255;
            $blue = 255;
        ?>
        <?php foreach($listings as $note){ ?>
        <?php
            $r = mt_rand(100,200);
            $g = mt_rand(100,200);
            $b = mt_rand(100,200);
            $color = "rgb($r,$g,$b)";
        ?>
        <div class="index-box boxes-dynamic" style="background-color:<?php echo $color ?>;line-height:normal;font-size:14px;">
            <div class="box-title">
                <?php
                    echo $this->Html->link($this->Text->truncate($note['Listing']['title'],35),
                        '/'.$note['User']['username'].'/ads/'.$note['Listing']['id'].'/'.$note['Listing']['slug'],
                        array('class'=>'note-title','title'=>$note['Listing']['title'],'style'=>'text-decoration:none;')
                    );
                ?>
            </div>
        </div>
        <?php } ?>
        <div class="clear" style="height:20px;"></div>
        <center>
        </div>
<!-- END OF BOXES -->
    </div>
    <?php echo $this->element('pagination') ?>
    <div style="height:20px;"></div>
