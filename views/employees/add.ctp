<div class="employees form">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
 		<legend><?php __('Add Employee'); ?></legend>
	<?php
		echo $this->Form->input('company_id');
		echo $this->Form->input('jmeno');
		echo $this->Form->input('prijmeni');
		echo $this->Form->input('email');
		echo $this->Form->input('tel');
		echo $this->Form->input('pozice');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Employees', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>