<div class="groups view">
<h2><?php  __('Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('After Login Redirect'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['after_login_redirect']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group', true), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Group', true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies', true), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company', true), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Permissions', true), array('controller' => 'permissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Permission', true), array('controller' => 'permissions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Companies');?></h3>
	<?php if (!empty($group['Company'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Cinnost'); ?></th>
		<th><?php __('Group Id'); ?></th>
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
		<th><?php __('Ma Panelovou Diskuzi'); ?></th>
		<th><?php __('Web Logo'); ?></th>
		<th><?php __('Hi Logo'); ?></th>
		<th><?php __('Room Day 1'); ?></th>
		<th><?php __('Room Day 2'); ?></th>
		<th><?php __('Pozadavky Od Cd Teamu'); ?></th>
		<th><?php __('Hostess Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['Company'] as $company):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $company['id'];?></td>
			<td><?php echo $company['name'];?></td>
			<td><?php echo $company['cinnost'];?></td>
			<td><?php echo $company['group_id'];?></td>
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
			<td><?php echo $company['ma_panelovou_diskuzi'];?></td>
			<td><?php echo $company['web_logo'];?></td>
			<td><?php echo $company['hi_logo'];?></td>
			<td><?php echo $company['room_day_1'];?></td>
			<td><?php echo $company['room_day_2'];?></td>
			<td><?php echo $company['pozadavky_od_cd_teamu'];?></td>
			<td><?php echo $company['hostess_id'];?></td>
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
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($group['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Jmeno'); ?></th>
		<th><?php __('Prijmeni'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Active'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['jmeno'];?></td>
			<td><?php echo $user['prijmeni'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td><?php echo $user['active'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Permissions');?></h3>
	<?php if (!empty($group['Permission'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['Permission'] as $permission):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $permission['id'];?></td>
			<td><?php echo $permission['name'];?></td>
			<td><?php echo $permission['created'];?></td>
			<td><?php echo $permission['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'permissions', 'action' => 'view', $permission['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'permissions', 'action' => 'edit', $permission['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'permissions', 'action' => 'delete', $permission['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $permission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Permission', true), array('controller' => 'permissions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
