<div class="fields form">
<?php echo $this->Form->create('Field');?>
	<fieldset>
 		<legend><?php __('Přidat obor'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => __('Název',  true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ulož', true));?>
</div>