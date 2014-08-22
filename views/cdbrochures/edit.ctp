<div class="cdbrochures form">
<?php echo $this->Form->create('Cdbrochure');?>
	<fieldset>
 		<legend><?php __('Edit Cdbrochure'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('id_kontakt');
		echo $this->Form->input('cinnost');
		echo $this->Form->input('profil');
		echo $this->Form->input('nabizi');
		echo $this->Form->input('pozaduje');
		echo $this->Form->input('prijmaci_rizeni');
		echo $this->Form->input('dalsi');
		echo $this->Form->input('vek-20-30');
		echo $this->Form->input('vek-30-40');
		echo $this->Form->input('vek-40-50');
		echo $this->Form->input('vek-50-60');
		echo $this->Form->input('zamestnanci-1');
		echo $this->Form->input('zamestnanci-2');
		echo $this->Form->input('zamestnanci-3');
		echo $this->Form->input('zamestnanci-4');
		echo $this->Form->input('Field');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Cdbrochure.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Cdbrochure.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cdbrochures', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fields', true), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field', true), array('controller' => 'fields', 'action' => 'add')); ?> </li>
	</ul>
</div>