<div class="events view">
<h2><?php echo __('Event'); ?></h2>
	<dl>
		<dt><?php echo __('Event Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Title'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Date'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Image'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Venue'); ?></dt>
		<dd>
			<?php echo h($event['Event']['venue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rsvp'); ?></dt>
		<dd>
			<?php echo h($event['Event']['rsvp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($event['Event']['created_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event'), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?> </li>
	</ul>
</div>
