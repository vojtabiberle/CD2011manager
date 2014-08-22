<div class="hostess pridej">
    <fieldset>
        <legend>Vyhledávání</legend>
        <?php
            echo $this->Form->create('Student', array('url' => '/hostess/pridej'));
            if(isset($meeting_id))
            {
                echo $this->Form->hidden('meeting_id', array('value' => $meeting_id));
            }
            if(isset($training_id))
            {
                echo $this->Form->hidden('training_id', array('value' => $training_id));
            }
            echo $this->Form->input('search', array('label' => 'Hledej:'));
            echo $this->Form->end('Odeslat');
        ?>
        <fieldset>
            <?php
            if(isset($students))
            {
                echo '<table>';
                echo '<tr><th>Jméno</th><th>Příjmení</th><th>Uživatelské</th><th>email</th><th>Barcode</th><th></th></tr>';
                foreach($students as $student)
                {
                    echo '<tr>';
                    echo '<td>'.$student['students_all_info']['jmeno'].'</td>';
                    echo '<td>'.$student['students_all_info']['prijmeni'].'</td>';
                    echo '<td>'.$student['students_all_info']['username'].'</td>';
                    echo '<td>'.$student['students_all_info']['email'].'</td>';
                    echo '<td>'.$student['students_all_info']['barcode'].'</td>';
                    echo '<td>';
                        if(isset($meeting_id))
                        {
                            echo $this->Html->link('Přidej', array('controller' => 'hostess', 'action' => 'pridej', 'meeting:'.$meeting_id.'/student:'.$student['students_all_info']['id']));
                        }
                        if(isset($training_id))
                        {
                            echo $this->Html->link('Přidej', array('controller' => 'hostess', 'action' => 'pridej', 'training:'.$training_id.'/student:'.$student['students_all_info']['id']));
                        }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                //pr($students);
            }
            ?>
        </fieldset>

    </fieldset>
</div>