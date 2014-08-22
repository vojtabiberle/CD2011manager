<div class="cdbrochures index">
	<h2><?php __('Cdbrochures');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('id_kontakt');?></th>
			<th><?php echo $this->Paginator->sort('cinnost');?></th>
			<th><?php echo $this->Paginator->sort('profil');?></th>
			<th><?php echo $this->Paginator->sort('nabizi');?></th>
			<th><?php echo $this->Paginator->sort('pozaduje');?></th>
			<th><?php echo $this->Paginator->sort('prijmaci_rizeni');?></th>
			<th><?php echo $this->Paginator->sort('dalsi');?></th>
			<th><?php echo $this->Paginator->sort('vek-20-30');?></th>
			<th><?php echo $this->Paginator->sort('vek-30-40');?></th>
			<th><?php echo $this->Paginator->sort('vek-40-50');?></th>
			<th><?php echo $this->Paginator->sort('vek-50-60');?></th>
			<th><?php echo $this->Paginator->sort('zamestnanci-1');?></th>
			<th><?php echo $this->Paginator->sort('zamestnanci-2');?></th>
			<th><?php echo $this->Paginator->sort('zamestnanci-3');?></th>
			<th><?php echo $this->Paginator->sort('zamestnanci-4');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cdbrochures as $cdbrochure):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cdbrochure['Cdbrochure']['id']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['name']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['id_kontakt']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['cinnost']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['profil']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['nabizi']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['pozaduje']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['prijmaci_rizeni']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['dalsi']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['vek-20-30']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['vek-30-40']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['vek-40-50']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['vek-50-60']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['zamestnanci-1']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['zamestnanci-2']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['zamestnanci-3']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['zamestnanci-4']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['created']; ?>&nbsp;</td>
		<td><?php echo $cdbrochure['Cdbrochure']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cdbrochure['Cdbrochure']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cdbrochure['Cdbrochure']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cdbrochure['Cdbrochure']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cdbrochure['Cdbrochure']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cdbrochure', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fields', true), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field', true), array('controller' => 'fields', 'action' => 'add')); ?> </li>
	</ul>
</div>