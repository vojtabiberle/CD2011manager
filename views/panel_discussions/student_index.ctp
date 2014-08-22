<div class="panel_discussions student_index">
    <div class="bigcolumn left">
    <fieldset>
        <legend>Panelové diskuze</legend>
    <?php
    //pr($panelDiscussions);
    function pdcompare($pd1, $pd2)
    {
        //pr($pd1);
        //pr($pd2);
        if($pd1['PanelDiscussion']['den'] == $pd2['PanelDiscussion']['den'] && $pd1['PanelDiscussion']['zacatek'] == $pd2['PanelDiscussion']['zacatek'])
        {
            return 0;
        }
        if($pd1['PanelDiscussion']['den'] == $pd2['PanelDiscussion']['den'])
        {
            return compareTime($pd1['PanelDiscussion']['zacatek'], $pd2['PanelDiscussion']['zacatek']);
        }
        return ($pd1['PanelDiscussion']['den'] < $pd2['PanelDiscussion']['den']) ? -1 : 1;
    }

    uasort($panelDiscussions, 'pdcompare');
    ?>
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php __('Jméno diskuze');?></th>
			<th><?php __('Začátek')?></th>
                        <th><?php __('Firmy');?></th>
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
                <td><?php echo toCzechDateTime($panelDiscussion['PanelDiscussion']['cas_konani']); ?></td>
                <td>
                    <ul>
                        <?php
                            foreach($panelDiscussion['Company'] as $company)
                            {
                                
                                if(!empty($company['CompaniesPanelDiscussion']['description']))
                                {
                                    echo '<li><a id="inline" href="#comp'.$company['id'].'data">'.$company['name'].'</a></li>';
                                    echo '<div style="display:none">';
                                        echo '<div id="comp'.$company['id'].'data">';
                                        echo '<fieldset><legend>Diskutující</legend>';
                                            echo $company['CompaniesPanelDiscussion']['description'];
                                        echo '</fieldset>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                else
                                {
                                    echo '<li>'.$company['name'].'</li>';
                                }
                            }
                        ?>
                    </ul>
                </td>
	</tr>
<?php endforeach; ?>
    </table>
    </fieldset>
    <fieldset>
        <legend>Enterpreneurship day</legend>
        <dl>
            <dt>Mluvčí:</dt>
            <dd>Patrik Tkáč</dd>
            <dt>Kdy:</dt>
            <dd>3.3. 2011 od 14:00</dd>
            <dt>Více na:</dt>
            <dd><a href="http://www.financnici.cz/patrik-tkac">http://www.financnici.cz/patrik-tkac</a></dd>
            <hr>
            <dt>Mluvčí:</dt>
            <dd>HUB Praha</dd>
            <dt>Kdy:</dt>
            <dd>2.3. 2011 od 13:30 do 15:00</dd>
            <dt>Více na:</dt>
            <dd><a href="http://www.prague.the-hub.net">http://www.prague.the-hub.net</a></dd>
        </dl>
        <div class="clear"></div>
    </fieldset>
    </div>

    <div class="smallcolumn right">
        <fieldset>
            <legend>Nápověda</legend>
            <p>Zveme tě k diskusi s předními zástupci jednotlivých společností. 
                Přijď se zeptat na otázky, které tě zajímají, prodiskutovat zajímavá témata a porovnat si pohledy různých firem. 
                Na panelové diskuse není třeba registrace, stačí se stavit v rámci dne - míst bude vždy dost. 
                Jednoduše počítej s vybraným časem ve Tvé agendě :-)</p>
            <p>Přemýšlíš nad založením vlastního byznysu? Právě pro tebe jsme připravili tzv. Entrepreneurship Day!
                Zveme Tě na diskusi s předními podnikateli v ČR a na Slovensku! Zjistíš, co to vlastně obnáší,
                můžeš porovnat podnikání se zaměstnáním a hlavně, nechat se inspirovat úžasnými zážitky,
                které vynesly tyto podnikatele až na samotný vrchol! Vše v rámci programu Career Days 2011. Na diskuse není třeba se registrovat,
                jednoduše počítej s tímto časem ve Tvé agendě :-)</p>
        </fieldset>

    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("a#inline").fancybox({
        'hideOnContentClick': true
    });

});
</script>