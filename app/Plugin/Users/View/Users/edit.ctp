<?php
/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users form">
	<?php echo $this->Form->create($model); ?>
		<fieldset>
			<legend><?php echo __d('users', 'My Account'); ?></legend>
			<?php
				echo $this->Form->input('UserDetail.first_name');
				echo $this->Form->input('UserDetail.last_name');
				//echo $this->Form->input('UserDetail.birthday');
				echo $this->Form->input('UserDetail.website');
				echo $this->Form->input('UserDetail.about',array('type'=>'textarea'));
			?>
			<p>
				<?php echo $this->Html->link(__d('users', 'Change your password'), array('action' => 'change_password')); ?>
			</p>
		</fieldset>
	<?php echo $this->Form->end(__d('users', 'Submit')); ?>
</div>
<?php echo $this->element('Users/sidebar'); ?>
