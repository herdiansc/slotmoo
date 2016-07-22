<div class="imageListings view">
<h2><?php  echo __('Image Listing'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($imageListing['ImageListing']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($imageListing['ImageListing']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Default'); ?></dt>
		<dd>
			<?php echo h($imageListing['ImageListing']['is_default']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Listing'); ?></dt>
		<dd>
			<?php echo $this->Html->link($imageListing['Listing']['title'], array('controller' => 'listings', 'action' => 'view', $imageListing['Listing']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Image Listing'), array('action' => 'edit', $imageListing['ImageListing']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Image Listing'), array('action' => 'delete', $imageListing['ImageListing']['id']), null, __('Are you sure you want to delete # %s?', $imageListing['ImageListing']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Image Listings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image Listing'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listings'), array('controller' => 'listings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listing'), array('controller' => 'listings', 'action' => 'add')); ?> </li>
	</ul>
</div>
