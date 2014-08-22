<div class="operators view">
<h2><?php  __('Operator');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $operator['Operator']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $operator['Operator']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Operator', true), array('action' => 'edit', $operator['Operator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Operator', true), array('action' => 'delete', $operator['Operator']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $operator['Operator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Operators', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Operator', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Smsses', true), array('controller' => 'smsses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Smss', true), array('controller' => 'smsses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Smsses');?></h3>
	<?php if (!empty($operator['Smss'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Msgid'); ?></th>
		<th><?php __('Kw'); ?></th>
		<th><?php __('Subkw'); ?></th>
		<th><?php __('Operator Id'); ?></th>
		<th><?php __('Message'); ?></th>
		<th><?php __('Tarif'); ?></th>
		<th><?php __('Clientid'); ?></th>
		<th><?php __('Generated Key'); ?></th>
		<th><?php __('Byl Pouzit'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($operator['Smss'] as $smss):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $smss['id'];?></td>
			<td><?php echo $smss['msgid'];?></td>
			<td><?php echo $smss['kw'];?></td>
			<td><?php echo $smss['subkw'];?></td>
			<td><?php echo $smss['operator_id'];?></td>
			<td><?php echo $smss['message'];?></td>
			<td><?php echo $smss['tarif'];?></td>
			<td><?php echo $smss['clientid'];?></td>
			<td><?php echo $smss['generated_key'];?></td>
			<td><?php echo $smss['byl_pouzit'];?></td>
			<td><?php echo $smss['created'];?></td>
			<td><?php echo $smss['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'smsses', 'action' => 'view', $smss['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'smsses', 'action' => 'edit', $smss['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'smsses', 'action' => 'delete', $smss['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $smss['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Smss', true), array('controller' => 'smsses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
