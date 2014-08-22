<div class="trainings index">
	<h2><?php __('Tréninky pro studenty');?></h2>
        <p>Zde vidíte přehled tréninků pro studenty. Můžete zde registrovat svůj trénink na určitý čas.
            Každý trénink má celkovou délku trvání 120 minut. Z toho je 90 minut rezervováno na samotný trénink a 30 minut na přípravu.
            Dále je sestavená tabulka možných časů konání a místností, kde se trénink bude konat. Pokud trénink není rezervovaný jinou firmou,
            klikněte na "Registrovat". Tím se trénink zarezervuje pro Vás a můžete definovat jeho název a popis, jak dlouho chcete.</p>
        <p>
            Registrace tréninků začne: <strong><?php echo Configure::read('__trainings_start_registration_time');?></strong>.
        </p>
        <p>
            Registrace tréninků bude ukončena: <strong><?php echo Configure::read('__trainings_end_registration_time');?></strong>.
        </p>
        <div class="clear"></div>
        <?php
        $times = array('9:00', '11:00', '13:00', '15:00');
        //pr($trainings);
            if(timeBetween(Configure::read('__trainings_start_registration_time'), Configure::read('__trainings_end_registration_time')))
            {
                if($company['Company']['ma_trenink'] == 1)
                {
                echo '<fieldset>';
                echo '<legend>První den</legend>';
                echo '<table>';
                echo '<tr><th>čas</th><th>Rome</th><th>Berlin</th></tr>';
               
                    foreach($times as $time)
                    {
                        
                        echo '<tr>';
                        echo '<th>';
                        echo $time;
                        echo '</th>';


                        foreach($trainings['Day1'] as $day1)
                        {
                            list($datum, $cas) = explode(' ',$day1['Training']['datetime']);
                            if($time == '9:00')
                            {
                                $time = '09:00';
                            }
                            
                            if($day1['Training']['room_id'] == 12 && $datum == toEngDate(Configure::read('__careerdays_first_day_date')) && $cas == $time.':00')
                            {
                                //echo 'datum:'.$datum.' ';
                                //echo toEngDate(Configure::read('__careerdays_first_day_date')).'<br>';
                                
                                //echo 'cas: '.$cas.' '.$time.':00<br>';
                                
                                if($day1['Training']['company_id'] != 0)
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day1['Training']['room_id'].'<br>';
                                    echo 'Už je registrován.<br>';
                                    echo $day1['Company']['name'].' - '.$day1['Training']['name'];
                                    if($company['Company']['id'] == $day1['Company']['id'])
                                    {
                                        echo '<br>';
                                        echo $this->Html->link(__('Upravit', true), array('controller' => 'trainings', 'action' => 'company_edit', $day1['Training']['id']));
                                        echo ' ';
                                        echo $this->Html->link(__('Odregistrovat', true), array('controller' => 'trainings', 'action' => 'company_unregister', $day1['Training']['id']));
                                    }
                                    //pr($day1['Training']);
                                    echo '</td>';
                                }
                                else
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day1['Training']['room_id'].'<br>';
                                    echo $this->Html->link(__('Registrovat', true), array('controller' => 'trainings', 'action' => 'company_register', 'day:1/time:'.$time.'/room:Rome/'));
                                    //pr($day1['Training']);
                                    echo '</td>';
                                }
                                
                            }

                            if($day1['Training']['room_id'] == 13 && $datum == toEngDate(Configure::read('__careerdays_first_day_date')) && $cas == $time.':00')
                            {
                                //echo 'datum:'.$datum.' ';
                                //echo toEngDate(Configure::read('__careerdays_first_day_date')).'<br>';

                                //echo 'cas: '.$cas.' '.$time.':00<br>';

                                if($day1['Training']['company_id'] != 0)
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day1['Training']['room_id'].'<br>';
                                    echo 'Už je registrován.<br>';
                                    echo $day1['Company']['name'].' - '.$day1['Training']['name'];
                                    if($company['Company']['id'] == $day1['Company']['id'])
                                    {
                                        echo '<br>';
                                        echo $this->Html->link(__('Upravit', true), array('controller' => 'trainings', 'action' => 'company_edit', $day1['Training']['id']));
                                        echo ' ';
                                        echo $this->Html->link(__('Odregistrovat', true), array('controller' => 'trainings', 'action' => 'company_unregister', $day1['Training']['id']));
                                    }
                                    //pr($day1['Training']);
                                    echo '</td>';
                                }
                                else
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day1['Training']['room_id'].'<br>';
                                    echo $this->Html->link(__('Registrovat', true), array('controller' => 'trainings', 'action' => 'company_register', 'day:1/time:'.$time.'/room:Berlin/'));
                                    //pr($day1['Training']);
                                    echo '</td>';
                                }

                            }

                            if($day1['Training']['room_id'] == 14 && $datum == toEngDate(Configure::read('__careerdays_first_day_date')) && $cas == $time.':00')
                            {
                                //echo 'datum:'.$datum.' ';
                                //echo toEngDate(Configure::read('__careerdays_first_day_date')).'<br>';

                                //echo 'cas: '.$cas.' '.$time.':00<br>';

                                if($day1['Training']['company_id'] != 0)
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day1['Training']['room_id'].'<br>';
                                    echo 'Už je registrován.<br>';
                                    echo $day1['Company']['name'].' - '.$day1['Training']['name'];
                                    if($company['Company']['id'] == $day1['Company']['id'])
                                    {
                                        echo '<br>';
                                        echo $this->Html->link(__('Upravit', true), array('controller' => 'trainings', 'action' => 'company_edit', $day1['Training']['id']));
                                        echo ' ';
                                        echo $this->Html->link(__('Odregistrovat', true), array('controller' => 'trainings', 'action' => 'company_unregister', $day1['Training']['id']));
                                    }
                                    //pr($day1['Training']);
                                    echo '</td>';
                                }
                                else
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day1['Training']['room_id'].'<br>';
                                    echo $this->Html->link(__('Registrovat', true), array('controller' => 'trainings', 'action' => 'company_register', 'day:1/time:'.$time.'/room:London/'));
                                    //pr($day1['Training']);
                                    echo '</td>';
                                }

                            }
                        }
                        
                    }//konec foreach $times
                
                echo '</table>';
                echo '</fieldset>';

                echo '<fieldset>';
                echo '<legend>Druhý den</legend>';
                echo '<table>';
                echo '<tr><th>čas</th><th>Rome</th><th>Berlin</th><th>London</th></tr>';

                    foreach($times as $time)
                    {
                        echo '<tr>';
                        echo '<th>';
                        echo $time;
                        echo '</th>';


                        foreach($trainings['Day2'] as $day2)
                        {
                            list($datum, $cas) = explode(' ',$day2['Training']['datetime']);
                            if($time == '9:00')
                            {
                                $time = '09:00';
                            }

                            if($day2['Training']['room_id'] == 12 && $datum == toEngDate(Configure::read('__careerdays_second_day_date')) && $cas == $time.':00')
                            {
                                //echo 'datum:'.$datum.' ';
                                //echo toEngDate(Configure::read('__careerdays_first_day_date')).'<br>';

                                //echo 'cas: '.$cas.' '.$time.':00<br>';

                                if($day2['Training']['company_id'] != 0)
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day2['Training']['room_id'].'<br>';
                                    echo 'Už je registrován.<br>';
                                    echo $day2['Company']['name'].' - '.$day1['Training']['name'];
                                    if($company['Company']['id'] == $day2['Company']['id'])
                                    {
                                        echo '<br>';
                                        echo $this->Html->link(__('Upravit', true), array('controller' => 'trainings', 'action' => 'company_edit', $day2['Training']['id']));
                                        echo ' ';
                                        echo $this->Html->link(__('Odregistrovat', true), array('controller' => 'trainings', 'action' => 'company_unregister', $day2['Training']['id']));
                                    }
                                    //pr($day2['Training']);
                                    echo '</td>';
                                }
                                else
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day2['Training']['room_id'].'<br>';
                                    echo $this->Html->link(__('Registrovat', true), array('controller' => 'trainings', 'action' => 'company_register', 'day:2/time:'.$time.'/room:Rome/'));
                                    //pr($day2['Training']);
                                    echo '</td>';
                                }

                            }

                            if($day2['Training']['room_id'] == 13 && $datum == toEngDate(Configure::read('__careerdays_second_day_date')) && $cas == $time.':00')
                            {
                                //echo 'datum:'.$datum.' ';
                                //echo toEngDate(Configure::read('__careerdays_first_day_date')).'<br>';

                                //echo 'cas: '.$cas.' '.$time.':00<br>';

                                if($day2['Training']['company_id'] != 0)
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day2['Training']['room_id'].'<br>';
                                    echo 'Už je registrován.<br>';
                                    echo $day2['Company']['name'].' - '.$day1['Training']['name'];
                                    if($company['Company']['id'] == $day2['Company']['id'])
                                    {
                                        echo '<br>';
                                        echo $this->Html->link(__('Upravit', true), array('controller' => 'trainings', 'action' => 'company_edit', $day2['Training']['id']));
                                        echo ' ';
                                        echo $this->Html->link(__('Odregistrovat', true), array('controller' => 'trainings', 'action' => 'company_unregister', $day2['Training']['id']));
                                    }
                                    //pr($day2['Training']);
                                    echo '</td>';
                                }
                                else
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day2['Training']['room_id'].'<br>';
                                    echo $this->Html->link(__('Registrovat', true), array('controller' => 'trainings', 'action' => 'company_register', 'day:2/time:'.$time.'/room:Berlin/'));
                                    //pr($day2['Training']);
                                    echo '</td>';
                                }

                            }

                            if($day2['Training']['room_id'] == 14 && $datum == toEngDate(Configure::read('__careerdays_second_day_date')) && $cas == $time.':00')
                            {
                                //echo 'datum:'.$datum.' ';
                                //echo toEngDate(Configure::read('__careerdays_first_day_date')).'<br>';

                                //echo 'cas: '.$cas.' '.$time.':00<br>';

                                if($day2['Training']['company_id'] != 0)
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day2['Training']['room_id'].'<br>';
                                    echo 'Už je registrován.<br>';
                                    echo $day2['Company']['name'].' - '.$day1['Training']['name'];
                                    if($company['Company']['id'] == $day2['Company']['id'])
                                    {
                                        echo '<br>';
                                        echo $this->Html->link(__('Upravit', true), array('controller' => 'trainings', 'action' => 'company_edit', $day2['Training']['id']));
                                        echo ' ';
                                        echo $this->Html->link(__('Odregistrovat', true), array('controller' => 'trainings', 'action' => 'company_unregister', $day2['Training']['id']));
                                    }
                                    //pr($day2['Training']);
                                    echo '</td>';
                                }
                                else
                                {
                                    echo '<td>';
                                    //echo $cas.' '.$datum.' '.$day2['Training']['room_id'].'<br>';
                                    echo $this->Html->link(__('Registrovat', true), array('controller' => 'trainings', 'action' => 'company_register', 'day:2/time:'.$time.'/room:London/'));
                                    //pr($day2['Training']);
                                    echo '</td>';
                                }

                            }
                        }
                    }

                echo '</table>';
                echo '</fieldset>';
                }
                else
                {
                    echo '<div class="message">Nemáte povolenu registraci tréninků.</div>';
                }
            }
            else
            {
                echo '<div class="message">Registrace tréninků není povolena.</div>';
            }
        ?>
</div>