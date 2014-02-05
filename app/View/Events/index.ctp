<div class="events index">
	<h2><?php echo __('Events'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('event_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('event_title'); ?></th>
			<th><?php echo $this->Paginator->sort('event_date'); ?></th>
			<th><?php echo $this->Paginator->sort('event_image'); ?></th>
			<th><?php echo $this->Paginator->sort('venue'); ?></th>
			<th><?php echo $this->Paginator->sort('rsvp'); ?></th>
			<th><?php echo $this->Paginator->sort('created_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?php echo h($event['Event']['event_id']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['event_title']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['event_date']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['event_image']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['venue']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['rsvp']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['created_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $event['Event']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?></li>
	</ul>
</div>
