<div class="meetings index">
	<h2><?php __('Setkání se studenty');?></h2>
        <p>Zde vidíte přehled Vámi definovaných individuálních setkání se studenty. Můžete zde vytvářet nová setkání a nastavovat jejich parametry.
        U každého setkání máte možnost nastavit jeho začátek a délku trvání. Délky trvání jsou stanoveny na 25 minut a 50 minut čistého času.
        Studentům se budou zobrazovat jako 30 minutové a 60 minutové individuální setkání, ale dodržujte prosím 25 minut a 50 minut.
        Studenti musí mezi individuálními setkáními změnit místnost a chceme se tímto opatřením vyhnout pozdním příchodům studentů na setkání
        a zvýšit tak spokojenost Vaší i studentů.
        </p>
        <p>
            Registrace individuálních setkání začne: <strong><?php echo Configure::read('__meetings_start_registration_time');?></strong>.
        </p>
        <p>
            Registrace individuálních setkání bude ukončena: <strong><?php echo Configure::read('__meetings_end_registration_time');?></strong>.
        </p>
        <div class="clear"></div>
        <?php
        //pr($times);
        //pr($company);
            if(timeBetween(Configure::read('__meetings_start_registration_time'), Configure::read('__meetings_end_registration_time')))
            {
        ?>
        <div id="meetingy">
            <div id="den1">
                <?php
                    if(!isset($times['Den1']))
                    {
                        echo '<div class="message">Nemáte povoleny individuální setkání na první den.</div>';
                    }
                    else
                    {
                        echo '<h3>První den</h3>';
                        echo '<table>';
                            $nextoff=false;
                            foreach($times['Den1'] as $cas)
                            {
                                echo '<tr>';
                                    echo '<th>'.$cas.'</th>';
                                if($nextoff == true)
                                {
                                    $nextoff = false;
                                    continue;
                                }
                                //pr($company);
                                $box_used = false;
                                foreach($company['Meetings'] as $meeting)
                                {
                                    if(rmSecond($meeting['zacatek']) == $cas && $meeting['den'] == 1)
                                    {
                                        if($meeting['delka'] == 50)
                                        {
                                            $nextoff = true;
                                            echo '<td class="setkani" rowspan="2">';
                                        }
                                        elseif($meeting['delka'] == 25)
                                        {
                                            echo '<td class="setkani">';
                                        }
                                        echo $this->Html->link(__('Uprav setkání',true), array('action' => 'edit', $meeting['id'])).' '.$this->Html->link(__('Smaž', true), array('action' => 'delete', $meeting['id']), null, __('Opravdu smazat setkání?', true));
                                        //pr($meeting);
                                        echo '</td>';
                                        
                                        $box_used = true;
                                    }
                                    
                                }
                                if($box_used == false)
                                {
                                    echo '<td>';
                                    if($cas != Configure::read('__careerdays_end_time'))
                                    {
                                        echo $this->Html->link(__('Vytvořit setkání', true),array('controller' => 'meetings', 'action' => 'add', 'day:1/start:'.$cas));
                                    }
                                    //pr($meeting);
                                    echo '</td>';
                                    $box_used = true;

                                }
//                                if(empty($company['Meetings']))
//                                {
//                                    if($cas != Configure::read('__careerdays_end_time'))
//                                    {
//                                        echo $this->Html->link(__('Vytvořit setkání', true),array('controller' => 'meetings', 'action' => 'add', 'day:1/start:'.$cas));
//                                    }
//                                }
                                echo '</tr>';
                                
                            }
                        echo '</table>';
                    }
                ?>
            </div>

            <div id="den2">
                <?php
                    if(!isset($times['Den2']))
                    {
                        echo '<div class="message">Nemáte povoleny individuální setkání na druhý den.</div>';
                    }
                    else
                    {
                        echo '<h3>Druhý den</h3>';
                        echo '<table>';
                        $nextoff=false;
                            foreach($times['Den2'] as $cas)
                            {
                                echo '<tr>';
                                    echo '<th>'.$cas.'</th>';
                                if($nextoff == true)
                                {
                                    $nextoff = false;
                                    continue;
                                }
                                //pr($company);
                                $box_used = false;
                                foreach($company['Meetings'] as $meeting)
                                {
                                    if(rmSecond($meeting['zacatek']) == $cas && $meeting['den'] == 2)
                                    {
                                        if($meeting['delka'] == 50)
                                        {
                                            $nextoff = true;
                                            echo '<td class="setkani" rowspan="2">';
                                        }
                                        elseif($meeting['delka'] == 25)
                                        {
                                            echo '<td class="setkani">';
                                        }
                                        else
                                        {
                                            echo '<td>';
                                        }
                                        echo $this->Html->link(__('Uprav setkání',true), array('action' => 'edit', $meeting['id'])).' '.$this->Html->link(__('Smaž', true), array('action' => 'delete', $meeting['id']), null, __('Opravdu smazat setkání?', true));
                                        //pr($meeting);
                                        echo '</td>';
                                        
                                        $box_used = true;
                                    }

                                }
                                if($box_used == false)
                                {
                                    echo '<td>';
                                    if($cas != Configure::read('__careerdays_end_time'))
                                    {
                                        echo $this->Html->link(__('Vytvořit setkání', true),array('controller' => 'meetings', 'action' => 'add', 'day:2/start:'.$cas));
                                    }
                                    //pr($meeting);
                                    echo '</td>';
                                    $box_used = true;

                                }
//                                if(empty($company['Meetings']))
//                                {
//                                    if($cas != Configure::read('__careerdays_end_time'))
//                                    {
//                                        echo $this->Html->link(__('Vytvořit setkání', true),array('controller' => 'meetings', 'action' => 'add', 'day:2/start:'.$cas));
//                                    }
//                                }
                                echo '</tr>';

                            }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>
        <?php
            }
            else
            {
                echo '<div class="message">Registrace setkání není povolena.</div>';
            }
        ?>
</div>