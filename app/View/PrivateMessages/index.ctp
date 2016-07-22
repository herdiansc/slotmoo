<div class="privateMessages index">
	<h2><?php echo __('Private Messages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('from_id'); ?></th>
			<th><?php echo $this->Paginator->sort('to_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($privateMessages as $privateMessage): ?>
	<tr>
		<td><?php echo h($privateMessage['PrivateMessage']['id']); ?>&nbsp;</td>
		<td><?php echo h($privateMessage['PrivateMessage']['title']); ?>&nbsp;</td>
		<td><?php echo h($privateMessage['PrivateMessage']['content']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($privateMessage['From']['id'], array('controller' => 'users', 'action' => 'view', $privateMessage['From']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($privateMessage['To']['id'], array('controller' => 'users', 'action' => 'view', $privateMessage['To']['id'])); ?>
		</td>
		<td><?php echo h($privateMessage['PrivateMessage']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $privateMessage['PrivateMessage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $privateMessage['PrivateMessage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $privateMessage['PrivateMessage']['id']), null, __('Are you sure you want to delete # %s?', $privateMessage['PrivateMessage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Private Message'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New From'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
