<div class="operators form">
<?php echo $this->Form->create('Operator');?>
	<fieldset>
 		<legend><?php __('Add Operator'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Operators', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Smsses', true), array('controller' => 'smsses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Smss', true), array('controller' => 'smsses', 'action' => 'add')); ?> </li>
	</ul>
</div>