<div class="actions">
<style>

</style>
<?php
//if( isset($_GET['db']) && $_GET['db'] == 1 ) {
//    Configure::write('debug',2);
//    debug($user);
    if(is_array($user) && @$user['UserDetail']['User']['about'] != null) {
//    echo "a";
        echo '<div class="about-me">';
        if(isset($user['UserDetail']['User']['website']) && $user['UserDetail']['User']['website'] != null ){
            if (preg_match("#https?://#", $user['UserDetail']['User']['website']) === 0) {
                $user['UserDetail']['User']['website'] = 'http://'.$user['UserDetail']['User']['website'];
            }
            echo '<h2><a href="'.$user['UserDetail']['User']['website'].'" class="name-with-url">'.@$name.'</a></h2>';
        }else {
            echo '<h2>'.@$name.'</h2>';
        }
        echo $this->Text->autoLinkUrls($user['UserDetail']['User']['about']);
        echo '</div>';
    }
//}
?>
	<ul>
		    <li>
		        <?php
		        $link = !$this->Session->read('Auth.User.id') ? '/' : '/home' ;
		        echo $this->Html->link(__('Home'), $link,array('class'=>'button green')); 
		        ?>
		    </li>
		    <li>
		        <?php
		        echo $this->Html->link(__('Browse'),
		        array('admin'=>false,'plugin'=>false,'controller'=>'information','action'=>'index'),
		        array('class'=>'button green')); 
		        ?>
		    </li>
		<?php if (!$this->Session->read('Auth.User.id')) : ?>
			<li><?php echo $this->Html->link(__d('users', 'Login'), array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'login'),array('class'=>'button green')); ?></li>
            <?php //if (!empty($allowRegistration) && $allowRegistration)  : ?>
			<li><?php echo $this->Html->link(__d('users', 'Register'), array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'add'),array('class'=>'button green')); ?></li>
            <?php //endif; ?>
		<?php else : ?>
			<li><?php echo $this->Html->link(__d('users', 'My Account'), array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'edit'),array('class'=>'button green')); ?></li>
			<!--<li><?php echo $this->Html->link(__d('users', 'Change password'), array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'change_password')); ?></li>-->
			<li>&nbsp;</li>
			<li><?php echo $this->Html->link(__d('users', 'Logout'), array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'logout'),array('class'=>'button red')); ?></li>
		<?php endif ?>
		<?php if($this->Session->read('Auth.User.is_admin')) : ?>
            <li>&nbsp;</li>
            <li><?php echo $this->Html->link(__d('users', 'List Users'), array('admin'=>false,'plugin'=>'users','controller'=>'users','action'=>'index'),array('class'=>'button green'));?></li>
        <?php endif; ?>
	</ul>
</div>
