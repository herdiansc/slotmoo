<div class="categories view">
<h2><?php  echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($category['Category']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($category['Category']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listings'), array('controller' => 'listings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listing'), array('controller' => 'listings', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Listings'); ?></h3>
	<?php if (!empty($category['Listing'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['Listing'] as $listing): ?>
		<tr>
			<td><?php echo $listing['id']; ?></td>
			<td><?php echo $listing['title']; ?></td>
			<td><?php echo $listing['description']; ?></td>
			<td><?php echo $listing['user_id']; ?></td>
			<td><?php echo $listing['price']; ?></td>
			<td><?php echo $listing['category_id']; ?></td>
			<td><?php echo $listing['slug']; ?></td>
			<td><?php echo $listing['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'listings', 'action' => 'view', $listing['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'listings', 'action' => 'edit', $listing['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'listings', 'action' => 'delete', $listing['id']), null, __('Are you sure you want to delete # %s?', $listing['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Listing'), array('controller' => 'listings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
