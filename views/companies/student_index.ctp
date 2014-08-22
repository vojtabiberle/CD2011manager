<div class="companies student_index">
    <fieldset>
    <legend><?php __('Firmy');?></legend>

	<table cellpadding="0" cellspacing="0">
	<tr>
                       
			<th><?php __('Jméno');?></th>
			<th><?php __('První den');?></th>
			<th><?php __('Druhý den');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($companies as $company):
            if($company['Company']['room_day_1'] == null && $company['Company']['room_day_2'] == null)
                continue;
            
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
                
		<td><?php echo $this->Html->link($company['Company']['name'], array('controller' => 'companies', 'action' => 'student_view', $company['Company']['id']), array('target' => '_blank')); ?></td>
		<td><?php
                        if($company['Company']['ma_den_1'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                    ?></td>
		<td><?php
                        if($company['Company']['ma_den_2'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                ?></td>
	</tr>
<?php endforeach; ?>
	</table>
    </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('a[target=_blank]').fancybox(/*{
        'width': 800,
        'height': 800,
        'autoDimensions': false
    }*/);

});
</script>