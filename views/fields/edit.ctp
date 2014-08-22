<div class="fields form">
<?php echo $this->Form->create('Field');?>
	<fieldset>
 		<legend><?php __('Edit Field'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>