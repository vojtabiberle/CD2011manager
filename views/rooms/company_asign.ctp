<div class="rooms form company_asign">
<?php
    //$com_day1[0] = __('Žádná firma', true);
    //$com_day2[0] = __('Žádná firma', true);
    ksort($com_day1);
    ksort($com_day2);
    //pr($rooms);
    //pr($com_day1);
    //pr($com_day2);
?>
    <fieldset>
        <legend><?php __('Přiřazení místností a firem');?></legend>
        <table>
            <tr>
                <th>Místnos</th>
                <th>První den</th>
                <th>Druhý den</th>
                <th>Akce</th>
            </tr>
        <?php
        foreach($rooms as $room)
        {
            if(true)
            {
                echo '<tr>';
                echo $this->Form->create('Rooms');
                    echo '<td>';
                    
                    echo $room['Room']['name'];
                    echo $this->Form->input('id', array('value' => $room['Room']['id'], 'type' => 'hidden'));
                    echo '</td>';

                    echo '<td>';
                        if(isset($room['RoomDay1'][0]['id']) && ($room['Room']['id'] == $room['RoomDay1'][0]['room_day_1']) )
                        {
                            echo $this->Form->select('company_day1_id', $com_day1, array('selected' => $room['RoomDay1'][0]['id']));
                            //echo '<br>';
                            //echo $room['RoomDay1'][0]['name'];
                        }
                        else
                        {
                            echo $this->Form->select('company_day1_id', $com_day1, array('selected' => 0));
                        }
                    echo '</td>';

                    echo '<td>';
                        if(isset($room['RoomDay2'][0]['id']) && ($room['Room']['id'] == $room['RoomDay2'][0]['room_day_2']) )
                        {
                            echo $this->Form->select('company_day2_id', $com_day2, array('selected' => $room['RoomDay2'][0]['id']));
                            //echo '<br>';
                            //echo $room['RoomDay2'][0]['name'];
                        }
                        else
                        {
                            echo $this->Form->select('company_day2_id', $com_day2, array('selected' => 0));
                        }
                    echo '</td>';

                    echo '<td>';
                        echo '<input type="submit" value="'.__('Ulož', true).'"/>';
                    echo '</td>';
                echo '</form>';
                echo '</tr>';
            }
        }
        ?>
        </table>
    </fieldset>
</div>