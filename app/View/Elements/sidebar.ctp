<?php
#debug($user);
$side_top_topics = array('listings','browse','keywords');

?>
        <ul>
            <?php if(
                isset($user) && !empty($user['info']) && is_array($user) 
                ) { ?>
            <li>
                <div class="right-box-inner-container">
                    <?php echo $this->element('side_profile'); ?>
                </div>
            </li>
            <?php } ?>
            <?php 
#            if( $this->params['controller'] == 'listings' && $this->params['action'] == 'browse' ) { 
            if(in_array($this->params['controller'],$side_top_topics) && in_array($this->params['action'],$side_top_topics)){
            ?>
            <li>
                <div class="right-box-inner-container top-topics">
                    <?php 
#                    if($this->params['controller'] == 'listings' && $this->params['action'] == 'browse') 
                    echo $this->element('side_top_topics'); 
                    ?>
                </div>
            </li>
            <?php } ?>
            <li>
                <div class="right-box-inner-container top-notes">
                    <?php echo $this->element('side_list') ?>
                </div>
            </li>
            <li>
                <div class="right-box-inner-container language">
                    <?php echo $this->element('side_language') ?>
                </div>
            </li>
        </ul>
