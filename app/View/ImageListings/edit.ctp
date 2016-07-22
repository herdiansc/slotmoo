<div class="imageListings form">
<?php echo $this->Form->create('ImageListing'); ?>
	<fieldset>
		<legend><?php echo __('Edit Image Listing'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('filename');
		echo $this->Form->input('is_default');
		echo $this->Form->input('listing_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ImageListing.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ImageListing.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Image Listings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Listings'), array('controller' => 'listings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listing'), array('controller' => 'listings', 'action' => 'add')); ?> </li>
	</ul>
</div>
