<div class="companies form">
<?php echo $this->Form->create('Company');?>
	<fieldset>
 		<legend><?php __('Přidat firmu'); ?></legend>
	<?php
		echo $this->element('companies/edit-add', array('add'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ulož', true));?>
</div>