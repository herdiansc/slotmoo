<div class="privateMessages form">
<?php echo $this->Form->create('PrivateMessage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Private Message'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('from_id');
		echo $this->Form->input('to_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PrivateMessage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PrivateMessage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Private Messages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New From'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
