<div class="operators form">
<?php echo $this->Form->create('Operator');?>
	<fieldset>
 		<legend><?php __('Edit Operator'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Operator.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Operator.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Operators', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Smsses', true), array('controller' => 'smsses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Smss', true), array('controller' => 'smsses', 'action' => 'add')); ?> </li>
	</ul>
</div>