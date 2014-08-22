<div class="rooms view">
<h2><?php  __('Room');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $room['Room']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Room', true), array('action' => 'edit', $room['Room']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Room', true), array('action' => 'delete', $room['Room']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $room['Room']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rooms', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Trainings', true), array('controller' => 'trainings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Training', true), array('controller' => 'trainings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Room Day1', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Trainings');?></h3>
	<?php if (!empty($room['Training'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Room Id'); ?></th>
		<th><?php __('Company Id'); ?></th>
		<th><?php __('Datetime'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($room['Training'] as $training):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $training['id'];?></td>
			<td><?php echo $training['name'];?></td>
			<td><?php echo $training['description'];?></td>
			<td><?php echo $training['room_id'];?></td>
			<td><?php echo $training['company_id'];?></td>
			<td><?php echo $training['datetime'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'trainings', 'action' => 'view', $training['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'trainings', 'action' => 'edit', $training['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'trainings', 'action' => 'delete', $training['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $training['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Training', true), array('controller' => 'trainings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Companies');?></h3>
	<?php if (!empty($room['RoomDay1'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Adresa'); ?></th>
		<th><?php __('Telefon'); ?></th>
		<th><?php __('Web'); ?></th>
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
		<th><?php __('Cb Kontakt Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
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
		<th><?php __('Schvaleno Firmou'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($room['RoomDay1'] as $roomDay1):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $roomDay1['id'];?></td>
			<td><?php echo $roomDay1['name'];?></td>
			<td><?php echo $roomDay1['adresa'];?></td>
			<td><?php echo $roomDay1['telefon'];?></td>
			<td><?php echo $roomDay1['web'];?></td>
			<td><?php echo $roomDay1['cinnost'];?></td>
			<td><?php echo $roomDay1['user_id'];?></td>
			<td><?php echo $roomDay1['cdbrochure_id'];?></td>
			<td><?php echo $roomDay1['profil'];?></td>
			<td><?php echo $roomDay1['nabizi'];?></td>
			<td><?php echo $roomDay1['pozaduje'];?></td>
			<td><?php echo $roomDay1['prijmaci_rizeni'];?></td>
			<td><?php echo $roomDay1['dalsi'];?></td>
			<td><?php echo $roomDay1['vek-20-30'];?></td>
			<td><?php echo $roomDay1['vek-30-40'];?></td>
			<td><?php echo $roomDay1['vek-40-50'];?></td>
			<td><?php echo $roomDay1['vek-50-60'];?></td>
			<td><?php echo $roomDay1['zamestnanci-1'];?></td>
			<td><?php echo $roomDay1['zamestnanci-2'];?></td>
			<td><?php echo $roomDay1['zamestnanci-3'];?></td>
			<td><?php echo $roomDay1['zamestnanci-4'];?></td>
			<td><?php echo $roomDay1['cd_kontakt_id'];?></td>
			<td><?php echo $roomDay1['student_kontakt_id'];?></td>
			<td><?php echo $roomDay1['cb_kontakt_id'];?></td>
			<td><?php echo $roomDay1['created'];?></td>
			<td><?php echo $roomDay1['modified'];?></td>
			<td><?php echo $roomDay1['ma_trenink'];?></td>
			<td><?php echo $roomDay1['pocet_treninku'];?></td>
			<td><?php echo $roomDay1['ma_panelovou_diskuzi'];?></td>
			<td><?php echo $roomDay1['ma_individual'];?></td>
			<td><?php echo $roomDay1['ma_enterpreneurship_day'];?></td>
			<td><?php echo $roomDay1['ma_cb_odborny_clanek'];?></td>
			<td><?php echo $roomDay1['ma_materialy_v_baliccich'];?></td>
			<td><?php echo $roomDay1['ma_expopanely'];?></td>
			<td><?php echo $roomDay1['ma_videospot'];?></td>
			<td><?php echo $roomDay1['ma_cb_fixni'];?></td>
			<td><?php echo $roomDay1['ma_cb_kreativni'];?></td>
			<td><?php echo $roomDay1['web_logo'];?></td>
			<td><?php echo $roomDay1['hi_logo'];?></td>
			<td><?php echo $roomDay1['ma_den_1'];?></td>
			<td><?php echo $roomDay1['ma_den_2'];?></td>
			<td><?php echo $roomDay1['room_day_1'];?></td>
			<td><?php echo $roomDay1['room_day_2'];?></td>
			<td><?php echo $roomDay1['pozadavky_od_cd_teamu'];?></td>
			<td><?php echo $roomDay1['hostess_id'];?></td>
			<td><?php echo $roomDay1['aiesec_respo'];?></td>
			<td><?php echo $roomDay1['oc_respo'];?></td>
			<td><?php echo $roomDay1['core_oc_notes'];?></td>
			<td><?php echo $roomDay1['schvaleno_firmou'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'companies', 'action' => 'view', $roomDay1['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'companies', 'action' => 'edit', $roomDay1['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'companies', 'action' => 'delete', $roomDay1['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $roomDay1['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Room Day1', true), array('controller' => 'companies', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Companies');?></h3>
	<?php if (!empty($room['RoomDay2'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Adresa'); ?></th>
		<th><?php __('Telefon'); ?></th>
		<th><?php __('Web'); ?></th>
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
		<th><?php __('Cb Kontakt Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
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
		<th><?php __('Schvaleno Firmou'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($room['RoomDay2'] as $roomDay2):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $roomDay2['id'];?></td>
			<td><?php echo $roomDay2['name'];?></td>
			<td><?php echo $roomDay2['adresa'];?></td>
			<td><?php echo $roomDay2['telefon'];?></td>
			<td><?php echo $roomDay2['web'];?></td>
			<td><?php echo $roomDay2['cinnost'];?></td>
			<td><?php echo $roomDay2['user_id'];?></td>
			<td><?php echo $roomDay2['cdbrochure_id'];?></td>
			<td><?php echo $roomDay2['profil'];?></td>
			<td><?php echo $roomDay2['nabizi'];?></td>
			<td><?php echo $roomDay2['pozaduje'];?></td>
			<td><?php echo $roomDay2['prijmaci_rizeni'];?></td>
			<td><?php echo $roomDay2['dalsi'];?></td>
			<td><?php echo $roomDay2['vek-20-30'];?></td>
			<td><?php echo $roomDay2['vek-30-40'];?></td>
			<td><?php echo $roomDay2['vek-40-50'];?></td>
			<td><?php echo $roomDay2['vek-50-60'];?></td>
			<td><?php echo $roomDay2['zamestnanci-1'];?></td>
			<td><?php echo $roomDay2['zamestnanci-2'];?></td>
			<td><?php echo $roomDay2['zamestnanci-3'];?></td>
			<td><?php echo $roomDay2['zamestnanci-4'];?></td>
			<td><?php echo $roomDay2['cd_kontakt_id'];?></td>
			<td><?php echo $roomDay2['student_kontakt_id'];?></td>
			<td><?php echo $roomDay2['cb_kontakt_id'];?></td>
			<td><?php echo $roomDay2['created'];?></td>
			<td><?php echo $roomDay2['modified'];?></td>
			<td><?php echo $roomDay2['ma_trenink'];?></td>
			<td><?php echo $roomDay2['pocet_treninku'];?></td>
			<td><?php echo $roomDay2['ma_panelovou_diskuzi'];?></td>
			<td><?php echo $roomDay2['ma_individual'];?></td>
			<td><?php echo $roomDay2['ma_enterpreneurship_day'];?></td>
			<td><?php echo $roomDay2['ma_cb_odborny_clanek'];?></td>
			<td><?php echo $roomDay2['ma_materialy_v_baliccich'];?></td>
			<td><?php echo $roomDay2['ma_expopanely'];?></td>
			<td><?php echo $roomDay2['ma_videospot'];?></td>
			<td><?php echo $roomDay2['ma_cb_fixni'];?></td>
			<td><?php echo $roomDay2['ma_cb_kreativni'];?></td>
			<td><?php echo $roomDay2['web_logo'];?></td>
			<td><?php echo $roomDay2['hi_logo'];?></td>
			<td><?php echo $roomDay2['ma_den_1'];?></td>
			<td><?php echo $roomDay2['ma_den_2'];?></td>
			<td><?php echo $roomDay2['room_day_1'];?></td>
			<td><?php echo $roomDay2['room_day_2'];?></td>
			<td><?php echo $roomDay2['pozadavky_od_cd_teamu'];?></td>
			<td><?php echo $roomDay2['hostess_id'];?></td>
			<td><?php echo $roomDay2['aiesec_respo'];?></td>
			<td><?php echo $roomDay2['oc_respo'];?></td>
			<td><?php echo $roomDay2['core_oc_notes'];?></td>
			<td><?php echo $roomDay2['schvaleno_firmou'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'companies', 'action' => 'view', $roomDay2['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'companies', 'action' => 'edit', $roomDay2['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'companies', 'action' => 'delete', $roomDay2['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $roomDay2['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Room Day2', true), array('controller' => 'companies', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
