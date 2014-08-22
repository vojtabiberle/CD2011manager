<div class="panelDiscussions form">
<?php echo $this->Form->create('PanelDiscussion');?>
	<fieldset>
 		<legend><?php __('Add Panel Discussion'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('popis');
		echo $this->Form->input('cas_konani');
		echo $this->Form->input('max_pocet_ucastniku');
		echo $this->Form->input('Company');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Panel Discussions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>