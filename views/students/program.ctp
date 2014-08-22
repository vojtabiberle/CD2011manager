<div class="students program">
    <div class="twocolumns left">
    <fieldset>
        <legend>Setkání s firmami</legend>
            <?php
                echo '<table>';
                echo '<tr><th>Firma</th><th>Místnost</th><th>Začátek</th><th>Konec</th><th>Volná místa</th></tr>';
                foreach($meetings as $meeting)
                {
                    echo '<tr>';
                        echo '<td>'.$meeting['Company']['name'].'</td>';
                        if($den == 1)
                        {
                            echo '<td>'.$meeting['Company']['room_day_1_name'];
                        }
                        if($den == 2)
                        {
                            echo '<td>'.$meeting['Company']['room_day_2_name'];
                        }
                        echo '<td>'.rmSecond($meeting['Meeting']['zacatek']).'</td>';
                        echo '<td>'.rmSecond($meeting['Meeting']['konec']).'</td>';
                        $mist = $meeting['Meeting']['max_pocet_ucastniku'] - count($meeting['Student']);
                        echo '<td>'.$mist.'</td>';
                        //echo '<td>'.count($meeting['Student']).'</td>';
                    echo '</tr>';
                }
                echo '</table>';
                
                //pr($meetings);
            ?>
    </fieldset>
    </div>
    <div class="twocolumns right">
    <fieldset>
        <legend>Tréninky</legend>
        <?php
        echo '<table>';
        echo '<tr><th>Trénink</th><th>Místnost</th><th>Firma</th><th>Začátek</th><th>Konec</th><th>Volná místa</th></tr>';
            foreach($trainings as $training)
            {
                if(compareTime(rmSecond($training['Training']['zacatek']), date('H:i')) < 0)
                {
                    continue;
                }
                $datum = date('Y-m-d');
                if($training['Training']['den'] != $datum)
                {
                    continue;
                }
                if($training['Training']['name'] == '')
                {
                    continue;
                }
                echo '<tr>';
                echo '<td>'.$training['Training']['name'].'</td>';
                echo '<td>'.$training['Room']['name'].'</td>';
                echo '<td>'.$training['Company']['name'].'</td>';
                //$datetime = toCzechDateTime($training['Training']['datetime']);
                echo '<td>'.rmSecond($training['Training']['zacatek']).'</td>';
                echo '<td>'.rmSecond($training['Training']['konec']).'</td>';
                $mist2 = 20 - count($training['Student']);
                echo '<td>'.$mist2.'</td>';
                echo '</tr>';
            }
            echo '</table>';
            //pr($trainings);
        ?>
    </fieldset>
    </div>

    <?php
//    <fieldset>
//        <legend>Panelové diskuze</legend>
//
//    </fieldset>
    ?>
</div>
