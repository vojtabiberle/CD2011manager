<div class="panelDiscussions index">
	<h2><?php __('Panel Discussions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('popis');?></th>
			<th><?php echo $this->Paginator->sort('cas_konani');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('max_pocet_ucastniku');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($panelDiscussions as $panelDiscussion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $panelDiscussion['PanelDiscussion']['id']; ?>&nbsp;</td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['name']; ?>&nbsp;</td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['popis']; ?>&nbsp;</td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['cas_konani']; ?>&nbsp;</td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['created']; ?>&nbsp;</td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['modified']; ?>&nbsp;</td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['max_pocet_ucastniku']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $panelDiscussion['PanelDiscussion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $panelDiscussion['PanelDiscussion']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $panelDiscussion['PanelDiscussion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $panelDiscussion['PanelDiscussion']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Panel Discussion', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>