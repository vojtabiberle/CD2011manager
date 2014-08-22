<div class="trainings view">
<h2><?php  __('Training');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $training['Training']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $training['Training']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $training['Training']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Room'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($training['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $training['Room']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Company'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($training['Company']['name'], array('controller' => 'companies', 'action' => 'view', $training['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Datetime'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $training['Training']['datetime']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $training['Training']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $training['Training']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Training', true), array('action' => 'edit', $training['Training']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Training', true), array('action' => 'delete', $training['Training']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $training['Training']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trainings', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Training', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('controller' => 'rooms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('controller' => 'rooms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Students');?></h3>
	<?php if (!empty($training['Student'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th><?php __('Typ'); ?></th>
		<th><?php __('Rocnik'); ?></th>
		<th><?php __('Zaplaceno Dnu'); ?></th>
		<th><?php __('Chce Den1'); ?></th>
		<th><?php __('Chce Den2'); ?></th>
		<th><?php __('Byl Den1'); ?></th>
		<th><?php __('Byl Den2'); ?></th>
		<th><?php __('Vraceno'); ?></th>
		<th><?php __('Zivotopis'); ?></th>
		<th><?php __('Chce Hotel'); ?></th>
		<th><?php __('Typ Platby'); ?></th>
		<th><?php __('Id Platby'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($training['Student'] as $student):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $student['id'];?></td>
			<td><?php echo $student['user_id'];?></td>
			<td><?php echo $student['school_id'];?></td>
			<td><?php echo $student['typ'];?></td>
			<td><?php echo $student['rocnik'];?></td>
			<td><?php echo $student['zaplaceno_dnu'];?></td>
			<td><?php echo $student['chce_den1'];?></td>
			<td><?php echo $student['chce_den2'];?></td>
			<td><?php echo $student['byl_den1'];?></td>
			<td><?php echo $student['byl_den2'];?></td>
			<td><?php echo $student['vraceno'];?></td>
			<td><?php echo $student['zivotopis'];?></td>
			<td><?php echo $student['chce_hotel'];?></td>
			<td><?php echo $student['typ_platby'];?></td>
			<td><?php echo $student['id_platby'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'students', 'action' => 'view', $student['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'students', 'action' => 'edit', $student['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'students', 'action' => 'delete', $student['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $student['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
