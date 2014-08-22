<div class="rooms form">
<?php echo $this->Form->create('Room');?>
	<fieldset>
 		<legend><?php __('Add Room'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rooms', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Trainings', true), array('controller' => 'trainings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Training', true), array('controller' => 'trainings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room Day1', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>