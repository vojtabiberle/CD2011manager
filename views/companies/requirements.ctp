<div class="companies form">
    <h2><?php __('Požadavky od OC teamu'); ?></h2>
<?php echo $this->Form->create('Company');?>
	<fieldset>
 		<legend><?php echo $this->data['Company']['name'] ?></legend>
	<?php
		echo $this->Form->input('pozadavky_od_cd_teamu', array('label' => __('Požadavky od teamu Career Days', true), 'class' => 'jwysiwyg'));

    $this->Html->script('jwysiwyg/jquery.wysiwyg', array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg', null, array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg.modal', null, array('inline' => false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ulož', true));?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.jwysiwyg').wysiwyg({
            initialContent: '',
            autoGrow: true
        });
    });
</script>