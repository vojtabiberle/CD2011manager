<div class="meetings index">
	<h2><?php __('Meetings');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('company_id');?></th>
			<th><?php echo $this->Paginator->sort('delka');?></th>
			<th><?php echo $this->Paginator->sort('zacatek');?></th>
			<th><?php echo $this->Paginator->sort('konec');?></th>
			<th><?php echo $this->Paginator->sort('popis');?></th>
			<th><?php echo $this->Paginator->sort('pozadavky');?></th>
			<th><?php echo $this->Paginator->sort('den');?></th>
			<th><?php echo $this->Paginator->sort('max_pocet_ucastniku');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($meetings as $meeting):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $meeting['Meeting']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($meeting['Company']['name'], array('controller' => 'companies', 'action' => 'view', $meeting['Company']['id'])); ?>
		</td>
		<td><?php echo $meeting['Meeting']['delka']; ?>&nbsp;</td>
		<td><?php echo $meeting['Meeting']['zacatek']; ?>&nbsp;</td>
		<td><?php echo $meeting['Meeting']['konec']; ?>&nbsp;</td>
		<td><?php echo $meeting['Meeting']['popis']; ?>&nbsp;</td>
		<td><?php echo $meeting['Meeting']['pozadavky']; ?>&nbsp;</td>
		<td><?php echo $meeting['Meeting']['den']; ?>&nbsp;</td>
		<td><?php echo $meeting['Meeting']['max_pocet_ucastniku']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $meeting['Meeting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $meeting['Meeting']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $meeting['Meeting']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $meeting['Meeting']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Meeting', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>