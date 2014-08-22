<div class="companies index">
	<h2><?php __('Firmy');?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort(__('Jméno', true), 'name');?></th>
			<th><?php echo $this->Paginator->sort(__('Fixní strana CB', true), 'ma_cb_fixni');?></th>
			<th><?php echo $this->Paginator->sort(__('Kreativní strana CB', true), 'ma_cb_kreativni');?></th>
                        <th><?php echo $this->Paginator->sort(__('Schváleno firmou', true), 'schvaleno_firmou');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($companies as $company):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($company['Company']['name'], array('controller' => 'companies', 'action' => 'artax_view', $company['Company']['id'])); ?>&nbsp;</td>
		<td><?php
                        if($company['Company']['ma_cb_fixni'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                    ?></td>
		<td><?php
                        if($company['Company']['ma_cb_kreativni'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                ?></td>
                <td><?php
                        if($company['Company']['schvaleno_firmou'] == 1)
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