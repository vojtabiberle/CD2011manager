<div class="smsses index_aiesec_not_used">
	<h2><?php __('Registrační kódy');?></h2>
        <?php
            echo $this->element('smss/sms_menu');
            //pr($smsses);
            echo $this->Html->link(__('Export do XLS', true), array('controller' => 'smsses', 'action' => 'export', 'xls'));
        ?>
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th>Tarif</th>
			<th>Registrační kód</th>
			<th>Byl použit</th>
			<th>Nákup</th>

	</tr>
	<?php
	$i = 0;
	foreach ($smsses as $smss):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo substr($smss['Smss']['tarif'], -2); ?>&nbsp;</td>
		<td><?php echo $smss['Smss']['generated_key']; ?>&nbsp;</td>
		<td>
                    <?php
                    if($smss['Smss']['byl_pouzit'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                    ?>
                </td>
		<td><?php echo $smss['Smss']['created']; ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
