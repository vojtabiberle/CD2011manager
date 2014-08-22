<div class="trainings index">
	<h2><?php __('Trainings');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('room_id');?></th>
			<th><?php echo $this->Paginator->sort('company_id');?></th>
			<th><?php echo $this->Paginator->sort('datetime');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($trainings as $training):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $training['Training']['id']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['name']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['description']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($training['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $training['Room']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($training['Company']['name'], array('controller' => 'companies', 'action' => 'view', $training['Company']['id'])); ?>
		</td>
		<td><?php echo $training['Training']['datetime']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['created']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $training['Training']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $training['Training']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $training['Training']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $training['Training']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Training', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>