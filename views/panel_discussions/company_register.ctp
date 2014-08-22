<?php
function is_registered($user, $discussion)
{
    $registered = false;
    foreach($discussion['Company'] as $company)
    {
        if($user['User']['id'] == $company['user_id'])
            $registered = true;
    }
    return $registered;
}
?>

<div class="panel_discussions company_registration form">
    <h2>Registrace na panelové diskuze.</h2>
    <p>Registrace na panelové diskuze je povolena od: <strong><?php echo Configure::read('__panel_discussion_start_registration_time');?></strong></p>
    <p>Konec registrací panelových diskuzí bude: <strong><?php echo Configure::read('__panel_discussion_stop_registration_time');?></strong></p>
    <p>Firmy mají povolenou registraci současně a registrace probíhá stisknutím tlačítka "Přihlaš".
        Odhlásit se můžete tlačítkem "Odhlaš", které se objeví u diskuzí, na které jste registrováni.
    U každé panelové diskuze je uveden její název, začátek a počet volných míst.
    Každá panelová diskuze je limitována časem 45 minut.
    Kliknutím na název panelové diskuze se zobrazí podrobnější popis diskuze.
    Každá firma se na panelovou diskuzi může přihlásit pouze jednou, ale může se přihlásit na více panelových diskuzí.
    Pokud jste klikni na tlačítko "Přihlaš" a systém Vaši firmu odmítl registrovat, může to být z důvodu,
    že zatímco jste si četli informace o panelové diskuzi, zaregistroval se na ni maximální možný počet účastníků.</p>
    <?php
        foreach($panelDiscussions as $key => $panelDiscussion)
        {
            $count = count($panelDiscussion['Company']);
            $panelDiscussions[$key]['PanelDiscussion']['zbyva'] = $panelDiscussion['PanelDiscussion']['max_pocet_ucastniku'] - $count;
        }
        //pr($user);
        //pr($panelDiscussions);
    ?>

    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php __('Jméno diskuze');?></th>
			<th><?php __('Začátek')?></th>
                        <th><?php __('Firmy');?></th>
			<th><?php __('Volných míst')?></th>
			<th class="actions"><?php __('Akce');?></th>
	</tr>
        <?php
	$i = 0;
	foreach ($panelDiscussions as $panelDiscussion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
                    <?php
                        //echo $this->Html->link($panelDiscussion['PanelDiscussion']['name'], array('action' => 'view', $panelDiscussion['PanelDiscussion']['id']));
                        echo $panelDiscussion['PanelDiscussion']['name'];
                        //pr($panelDiscussions);
                    ?>
                &nbsp;</td>
                <td><?php echo toCzechDateTime($panelDiscussion['PanelDiscussion']['cas_konani']); ?>&nbsp;</td>
                <td>
                    <ul>
                        <?php
                            foreach($panelDiscussion['Company'] as $company)
                            {
                                echo '<li>'.$company['name'].'</li>';
                            }
                        ?>
                    </ul>
                </td>
		<td><?php echo $panelDiscussion['PanelDiscussion']['zbyva']; ?>&nbsp;</td>
		<td class="actions">
                    <?php
                    //pr($com);
                    if($com['Company']['ma_panelovou_diskuzi'])
                    {
                        if(is_registered($user, $panelDiscussion))
                        {
                            echo $this->Html->link(__('Odhlaš', true), array('action' => 'company_unregister', $panelDiscussion['PanelDiscussion']['id']));
                        }
                        elseif($panelDiscussion['PanelDiscussion']['zbyva'] != 0)
                        {
                            echo $this->Html->link(__('Přihlaš', true), array('action' => 'company_register', $panelDiscussion['PanelDiscussion']['id']));
                        }
                    }
                    ?>
		</td>
	</tr>
<?php endforeach; ?>
    </table>
</div>