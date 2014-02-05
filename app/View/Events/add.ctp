<div class="events form">
<?php echo $this->Form->create('Event'); ?>
	<fieldset>
		<legend><?php echo __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('event_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('event_title');
		echo $this->Form->input('event_date');
		echo $this->Form->input('event_image');
		echo $this->Form->input('venue');
		echo $this->Form->input('rsvp');
		echo $this->Form->input('created_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?></li>
	</ul>
</div>
