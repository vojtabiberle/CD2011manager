<div class="meetings show_students">
    <fieldset>
        <legend>Studenti na Vašich setkáních</legend>
        <table>
            <tr>
                <th>Den</th>
                <th>Začátek</th>
                <th colspan="3">Studenti</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th>Jméno a Příjmení</th>
                <th>email</th>
                <th>životopis</th>
            </tr>
            <?php
            foreach($meetings as $meeting)
            {
                echo '<tr>';

                    if(!empty($meeting['StudentsAllInfo']))
                    {
                        $cnt = count($meeting['StudentsAllInfo']);
                        $i = 0;
                        echo '<td rowspan="'.$cnt.'">'.$meeting['Meeting']['den'].'</td>';
                        echo '<td rowspan="'.$cnt.'">'.rmSecond($meeting['Meeting']['zacatek']).'</td>';
                        foreach($meeting['StudentsAllInfo'] as $student)
                        {
                            if($i > 0)
                                echo '<tr>';
                            echo '<td>'.$student['jmeno'].' '.$student['prijmeni'].'</td>';
                            echo '<td>'.$student['email'].'</td>';
                            if(!empty($student['zivotopis']))
                            {
                                echo '<td>'.$this->Html->link($student['zivotopis'],'/files/cv/'.$student['user_id'].'/'.$student['zivotopis']).'</td>';
                            }
                            else
                            {
                                echo '<td>&nbsp;</td>';
                            }
                            if($i > 0)
                                echo '</tr>';
                            $i++;
                        }
                    }
                    else
                    {
                        echo '<td>'.$meeting['Meeting']['den'].'</td>';
                        echo '<td>'.rmSecond($meeting['Meeting']['zacatek']).'</td>';
                        echo '<td colspan="3">&nbsp;</td>';
                    }
                echo '</tr>';
            }
            ?>
        </table>
<?php
//pr($meetings);
?>
    </fieldset>
</div>