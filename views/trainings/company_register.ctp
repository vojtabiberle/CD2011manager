<div class="trainings form">
<?php echo $this->Form->create('Training');?>
	<fieldset>
 		<legend><?php __('Přidat trénink'); ?></legend>
	<?php
        //pr($training);
                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $training['Training']['id']));
		echo $this->Form->input('name', array('label' => 'Název'));
		echo $this->Form->input('description', array('label' => 'Popis'));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Odeslat', true));?>
</div>
