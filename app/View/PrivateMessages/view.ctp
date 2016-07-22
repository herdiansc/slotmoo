<div class="privateMessages view">
<h2><?php  echo __('Private Message'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($privateMessage['PrivateMessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($privateMessage['PrivateMessage']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($privateMessage['PrivateMessage']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From'); ?></dt>
		<dd>
			<?php echo $this->Html->link($privateMessage['From']['id'], array('controller' => 'users', 'action' => 'view', $privateMessage['From']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To'); ?></dt>
		<dd>
			<?php echo $this->Html->link($privateMessage['To']['id'], array('controller' => 'users', 'action' => 'view', $privateMessage['To']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($privateMessage['PrivateMessage']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Private Message'), array('action' => 'edit', $privateMessage['PrivateMessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Private Message'), array('action' => 'delete', $privateMessage['PrivateMessage']['id']), null, __('Are you sure you want to delete # %s?', $privateMessage['PrivateMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Private Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Private Message'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New From'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
