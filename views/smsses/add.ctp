<div class="smsses form">
<?php echo $this->Form->create('Smss');?>
	<fieldset>
 		<legend><?php __('Add Smss'); ?></legend>
	<?php
		echo $this->Form->input('msgid');
		echo $this->Form->input('kw');
		echo $this->Form->input('subkw');
		echo $this->Form->input('operator_id');
		echo $this->Form->input('message');
		echo $this->Form->input('tarif');
		echo $this->Form->input('clientid');
		echo $this->Form->input('generated_key');
		echo $this->Form->input('byl_pouzit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Smsses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Operators', true), array('controller' => 'operators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Operator', true), array('controller' => 'operators', 'action' => 'add')); ?> </li>
	</ul>
</div>