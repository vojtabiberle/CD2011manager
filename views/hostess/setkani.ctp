<div class="hostess setkani">
<?php
if(isset($meetings))
{
    echo '<fieldset>';
        echo '<legend>'.$company['Company']['name'].'</legend>';
        //pr($company);
        $i=0;
        foreach($meetings as $meeting)
        {
            $count = count($meeting['Student']);
            if($count < $meeting['Meeting']['max_pocet_ucastniku'])
            {
                $class = 'bgsoftgreen';
            }
            else
            {
                $class = 'bgsoftred';
            }
            
            echo '<fieldset id="meeting'.$meeting['Meeting']['id'].'"><legend>Setkání</legend>';
            echo '<table class="meetinghead '.$class.'">';
            echo '<tr>';
                echo '<th>Začátek</th><th>Konec</th><th>počet</th><th>maximum</th><th>den</th>';
                echo '<th rowspan="2">';
                    if($count < $meeting['Meeting']['max_pocet_ucastniku'])
                    {
                        echo $this->Html->link($this->Html->image('add.png').'Přidej', array('controller' => 'hostess', 'action' => 'pridej', 'meeting:'.$meeting['Meeting']['id']), array('escape' => false));
                    }
                    else
                    {

                    }
                echo '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>';
                echo rmSecond($meeting['Meeting']['zacatek']);
                echo '</th>';
                echo '<th>';
                echo rmSecond($meeting['Meeting']['konec']);
                echo '</th>';
                echo '<th>';
                echo $count;
                echo '</th>';
                echo '<th>';
                echo $meeting['Meeting']['max_pocet_ucastniku'];
                echo '</th>';
                echo '<th>'.$meeting['Meeting']['den'].'</th>';
                
            echo '</tr>';
            echo '</table>';
            echo '<table>';
            echo '<tr><th>Jméno</th><th>Příjmení</th><th>Barcod</th><th>email</th><th></th></tr>';
            foreach($meeting['Student'] as $student)
            {
                echo '<tr>';
                    echo '<td>';
                    //print_r($student);
                    echo $student['User']['jmeno'].'</td>';
                    echo '<td>'.$student['User']['prijmeni'].'</td>';
                    echo '<td>'.$student['barcode'].'</td>';
                    echo '<td>'.$student['User']['email'].'</td>';
                    echo '<td>';
                    //pr($student);
                    if($student['MeetingsStudent']['potvrzeno'] == 0)
                    {
                        echo $this->Html->link($this->Html->image('yes-extra-small.png').'Přišel', array('controller' => 'hostess', 'action' => 'potvrzeni', 'meeting:'.$meeting['Meeting']['id'].'/student:'.$student['id']), array('escape' => false), 'Student opravdu přišel?');
                        echo '<br>';
                        echo $this->Html->link($this->Html->image('rem.gif').'Odeber', array('controller' => 'hostess', 'action' => 'odeber', 'meeting:'.$meeting['Meeting']['id'].'/student:'.$student['id']), array('escape' => false), 'Opravdu smazat studenta?');
                    }
                    if($student['MeetingsStudent']['potvrzeno'] == 1)
                    {
                        echo $this->Html->image('yes-extra-small.png');
                    }
                    echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</fieldset>';
            $i++;

            echo '<div style="display:none">';
                echo '<div id="meeting'.$meeting['Meeting']['id'].'">';
                
                echo '</div>';
            echo '</div>';
        }
    echo '</fieldset>';
}
//pr($meetings);
if(isset($trainings))
{
    echo '<fieldset>';
        echo '<legend>Tréninky</legend>';
        //pr($company);
        $i=0;
        foreach($trainings as $training)
        {
            $datum = date('Y-m-d');
            if($training['Training']['den'] != $datum)
            {
                continue;
            }
            $count = count($training['Student']);
            if($count < 20)
            {
                $class = 'bgsoftgreen';
            }
            else
            {
                $class = 'bgsoftred';
            }
            
            echo '<fieldset id="training'.$training['Training']['id'].'"><legend>'.$training['Training']['name'].'</legend>';
            echo '<table class="meetinghead '.$class.'">';
            echo '<tr>';
                echo '<th>Začátek</th><th>Konec</th><th>počet</th><th>maximum</th><th>den</th>';
                echo '<th rowspan="2">';
                    if($count < 20)
                    {
                        echo $this->Html->link($this->Html->image('add.png').'Přidej', array('controller' => 'hostess', 'action' => 'pridej', 'training:'.$training['Training']['id']), array('escape' => false));
                    }
                    else
                    {

                    }
                echo '</th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>';
                echo rmSecond($training['Training']['zacatek']);
                echo '</th>';
                echo '<th>';
                echo rmSecond($training['Training']['konec']);
                echo '</th>';
                echo '<th>';
                echo $count;
                echo '</th>';
                echo '<th>';
                echo 20;
                echo '</th>';
                echo '<th>'.$training['Training']['den'].'</th>';

            echo '</tr>';
            echo '</table>';
            echo '<table>';
            echo '<tr><th>Jméno</th><th>Příjmení</th><th>Barcod</th><th>email</th><th></th></tr>';
            foreach($training['Student'] as $student)
            {
                echo '<tr>';
                    echo '<td>';
                    //print_r($student);
                    echo $student['User']['jmeno'].'</td>';
                    echo '<td>'.$student['User']['prijmeni'].'</td>';
                    echo '<td>'.$student['barcode'].'</td>';
                    echo '<td>'.$student['User']['email'].'</td>';
                    echo '<td>';
                    //pr($student);
                    if($student['StudentsTraining']['potvrzeno'] == 0)
                    {
                        echo $this->Html->link($this->Html->image('yes-extra-small.png').'Přišel', array('controller' => 'hostess', 'action' => 'potvrzeni', 'training:'.$training['Training']['id'].'/student:'.$student['id']), array('escape' => false), 'Student opravdu přišel?');
                        echo '<br>';
                        echo $this->Html->link($this->Html->image('rem.gif').'Odeber', array('controller' => 'hostess', 'action' => 'odeber', 'training:'.$training['Training']['id'].'/student:'.$student['id']), array('escape' => false), 'Opravdu smazat studenta?');
                    }
                    if($student['StudentsTraining']['potvrzeno'] == 1)
                    {
                        echo $this->Html->image('yes-extra-small.png');
                    }
                    echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</fieldset>';
            $i++;

            echo '<div style="display:none">';
                echo '<div id="meeting'.$training['Training']['id'].'">';

                echo '</div>';
            echo '</div>';
        }
    echo '</fieldset>';
    //pr($trainings);
}
?>
</div>