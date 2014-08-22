<div class="companies form">
    <h2><?php __('Údaje o firmě'); ?></h2>
<?php echo $this->Form->create('Company');?>
	<fieldset>
 		<legend><?php echo $this->data['Company']['name'] ?></legend>
	<?php 
		echo $this->element('companies/edit-add');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ulož', true));?>
</div>
