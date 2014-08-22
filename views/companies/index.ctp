<div class="companies index">
	<h2><?php __('Firmy');?></h2>
        <?php
            //pr($companies);
        ?>
        <div id="page-menu">
            <ul>
                <li><?php echo $this->Html->link(__('Přidat firmu', true), array('controller' => 'companies', 'action' => 'add'));?></li>
                <fieldset>
                    <legend><?php __('Obory');?></legend>
                        <li><?php echo $this->Html->link(__('Přidat obor', true), array('controller' => 'fields', 'action' => 'add'));?></li>
                        <li><?php echo $this->Html->link(__('Zobrazit obory', true), array('controller' => 'fields', 'action' => 'index'));?></li>
                </fieldset>
            </ul>
        </div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort(__('Jméno', true), 'name');?></th>
			<th><?php echo $this->Paginator->sort(__('Setkání', true),'ma_setkani');?></th>
			<th><?php echo $this->Paginator->sort(__('Trénink', true),'ma_trenink');?></th>
			<th><?php echo $this->Paginator->sort(__('Panelová diskuze', true), 'ma_panelovou_diskuzi');?></th>
                        <th><?php echo $this->Paginator->sort(__('První den', true),'ma_den_1');?></th>
			<th><?php echo $this->Paginator->sort(__('Druhý den', true), 'ma_den_2');?></th>
			<th><?php echo $this->Paginator->sort(__('Místnost 1.den', true), 'room_day_1');?></th>
			<th><?php echo $this->Paginator->sort(__('Místnost 2.den', true), 'room_day_2');?></th>
                        <th><?php echo $this->Paginator->sort(__('Schváleno firmou', true), 'schvaleno_firmou');?></th>
			<th class="actions"><?php __('Akce');?></th>
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
		<td><?php echo $this->Html->link($company['Company']['name'], array('controller' => 'companies', 'action' => 'edit', $company['Company']['id'])); ?>&nbsp;</td>
		<td><?php
                        if($company['Company']['ma_individual'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                    ?></td>
		<td><?php
                        if($company['Company']['ma_trenink'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                    ?></td>
		<td><?php
                        if($company['Company']['ma_panelovou_diskuzi'] == 1)
                        {
                            echo $this->Html->image('yes.png');
                        }
                        else
                        {
                            echo $this->Html->image('no.png');
                        }
                    ?></td>
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
		<td><?php
                        if(!empty($company['RoomDay1']['name']))
                        {
                            echo $company['RoomDay1']['name'];
                        }
                    ?>
                </td>
		<td><?php
                        if(!empty($company['RoomDay2']['name']))
                        {
                            echo $company['RoomDay2']['name'];
                        }
                    ?>
                </td>
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
		<td class="actions">
                    <?php
                        if($company['Company']['schvaleno_firmou'] == 1)
                        {
                            echo $this->Html->link(__('<abbr title="Povolí editaci profilu firmě, která už odklikla odsouhlasení údajů.">Povolit editaci</abbr>', true), array('action' => 'allow_edit', $company['Company']['id']), array('escape' => false));
                        }
                        else
                        {
                            echo $this->Html->link(__('<abbr title="Zakáže editaci profilu firmě.">Zakázat editaci</abbr>', true), array('action' => 'deny_edit', $company['Company']['id']), array('escape' => false));
                        }
                        
			echo $this->Html->link(__('Upravit', true), array('action' => 'edit', $company['Company']['id']));
			echo $this->Html->link(__('Smazat', true), array('action' => 'delete', $company['Company']['id']), null, sprintf(__('Opravdu chcete smazat firmu: %s?', true), $company['Company']['name']));
                       ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Stránka %page% z %pages%, zobrazuji %current% z celkem %count%, začínám na záznamu %start%, končím na %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('předchozí', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('další', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>