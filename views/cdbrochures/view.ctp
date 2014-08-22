<div class="cdbrochures view">
<h2><?php  __('Cdbrochure');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id Kontakt'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['id_kontakt']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cinnost'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['cinnost']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Profil'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['profil']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nabizi'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['nabizi']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pozaduje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['pozaduje']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Prijmaci Rizeni'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['prijmaci_rizeni']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dalsi'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['dalsi']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vek-20-30'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['vek-20-30']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vek-30-40'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['vek-30-40']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vek-40-50'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['vek-40-50']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vek-50-60'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['vek-50-60']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zamestnanci-1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['zamestnanci-1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zamestnanci-2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['zamestnanci-2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zamestnanci-3'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['zamestnanci-3']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Zamestnanci-4'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['zamestnanci-4']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cdbrochure['Cdbrochure']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cdbrochure', true), array('action' => 'edit', $cdbrochure['Cdbrochure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Cdbrochure', true), array('action' => 'delete', $cdbrochure['Cdbrochure']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cdbrochure['Cdbrochure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cdbrochures', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cdbrochure', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fields', true), array('controller' => 'fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Field', true), array('controller' => 'fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Companies');?></h3>
	<?php if (!empty($cdbrochure['Company'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Cinnost'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Cdbrochure Id'); ?></th>
		<th><?php __('Profil'); ?></th>
		<th><?php __('Nabizi'); ?></th>
		<th><?php __('Pozaduje'); ?></th>
		<th><?php __('Prijmaci Rizeni'); ?></th>
		<th><?php __('Dalsi'); ?></th>
		<th><?php __('Vek-20-30'); ?></th>
		<th><?php __('Vek-30-40'); ?></th>
		<th><?php __('Vek-40-50'); ?></th>
		<th><?php __('Vek-50-60'); ?></th>
		<th><?php __('Zamestnanci-1'); ?></th>
		<th><?php __('Zamestnanci-2'); ?></th>
		<th><?php __('Zamestnanci-3'); ?></th>
		<th><?php __('Zamestnanci-4'); ?></th>
		<th><?php __('Cd Kontakt Id'); ?></th>
		<th><?php __('Student Kontakt Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Ma Setkani'); ?></th>
		<th><?php __('Ma Trenink'); ?></th>
		<th><?php __('Pocet Treninku'); ?></th>
		<th><?php __('Ma Panelovou Diskuzi'); ?></th>
		<th><?php __('Ma Individual'); ?></th>
		<th><?php __('Ma Enterpreneurship Day'); ?></th>
		<th><?php __('Ma Cb Odborny Clanek'); ?></th>
		<th><?php __('Ma Materialy V Baliccich'); ?></th>
		<th><?php __('Ma Expopanely'); ?></th>
		<th><?php __('Ma Videospot'); ?></th>
		<th><?php __('Ma Cb Fixni'); ?></th>
		<th><?php __('Ma Cb Kreativni'); ?></th>
		<th><?php __('Web Logo'); ?></th>
		<th><?php __('Hi Logo'); ?></th>
		<th><?php __('Ma Den 1'); ?></th>
		<th><?php __('Ma Den 2'); ?></th>
		<th><?php __('Room Day 1'); ?></th>
		<th><?php __('Room Day 2'); ?></th>
		<th><?php __('Pozadavky Od Cd Teamu'); ?></th>
		<th><?php __('Hostess Id'); ?></th>
		<th><?php __('Aiesec Respo'); ?></th>
		<th><?php __('Oc Respo'); ?></th>
		<th><?php __('Core Oc Notes'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cdbrochure['Company'] as $company):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $company['id'];?></td>
			<td><?php echo $company['name'];?></td>
			<td><?php echo $company['cinnost'];?></td>
			<td><?php echo $company['user_id'];?></td>
			<td><?php echo $company['cdbrochure_id'];?></td>
			<td><?php echo $company['profil'];?></td>
			<td><?php echo $company['nabizi'];?></td>
			<td><?php echo $company['pozaduje'];?></td>
			<td><?php echo $company['prijmaci_rizeni'];?></td>
			<td><?php echo $company['dalsi'];?></td>
			<td><?php echo $company['vek-20-30'];?></td>
			<td><?php echo $company['vek-30-40'];?></td>
			<td><?php echo $company['vek-40-50'];?></td>
			<td><?php echo $company['vek-50-60'];?></td>
			<td><?php echo $company['zamestnanci-1'];?></td>
			<td><?php echo $company['zamestnanci-2'];?></td>
			<td><?php echo $company['zamestnanci-3'];?></td>
			<td><?php echo $company['zamestnanci-4'];?></td>
			<td><?php echo $company['cd_kontakt_id'];?></td>
			<td><?php echo $company['student_kontakt_id'];?></td>
			<td><?php echo $company['created'];?></td>
			<td><?php echo $company['modified'];?></td>
			<td><?php echo $company['ma_setkani'];?></td>
			<td><?php echo $company['ma_trenink'];?></td>
			<td><?php echo $company['pocet_treninku'];?></td>
			<td><?php echo $company['ma_panelovou_diskuzi'];?></td>
			<td><?php echo $company['ma_individual'];?></td>
			<td><?php echo $company['ma_enterpreneurship_day'];?></td>
			<td><?php echo $company['ma_cb_odborny_clanek'];?></td>
			<td><?php echo $company['ma_materialy_v_baliccich'];?></td>
			<td><?php echo $company['ma_expopanely'];?></td>
			<td><?php echo $company['ma_videospot'];?></td>
			<td><?php echo $company['ma_cb_fixni'];?></td>
			<td><?php echo $company['ma_cb_kreativni'];?></td>
			<td><?php echo $company['web_logo'];?></td>
			<td><?php echo $company['hi_logo'];?></td>
			<td><?php echo $company['ma_den_1'];?></td>
			<td><?php echo $company['ma_den_2'];?></td>
			<td><?php echo $company['room_day_1'];?></td>
			<td><?php echo $company['room_day_2'];?></td>
			<td><?php echo $company['pozadavky_od_cd_teamu'];?></td>
			<td><?php echo $company['hostess_id'];?></td>
			<td><?php echo $company['aiesec_respo'];?></td>
			<td><?php echo $company['oc_respo'];?></td>
			<td><?php echo $company['core_oc_notes'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'companies', 'action' => 'view', $company['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'companies', 'action' => 'edit', $company['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'companies', 'action' => 'delete', $company['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $company['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Fields');?></h3>
	<?php if (!empty($cdbrochure['Field'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cdbrochure['Field'] as $field):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $field['id'];?></td>
			<td><?php echo $field['name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'fields', 'action' => 'view', $field['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'fields', 'action' => 'edit', $field['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'fields', 'action' => 'delete', $field['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $field['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Field', true), array('controller' => 'fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
