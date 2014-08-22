<div class="students realcounter">
    <?php
        echo '<table>';
            echo '<tr><th>LC</th><th>První den</th><th>Druhý den</th><th>Celkem</th><th>Plán</th><th>%</th></tr>';

            echo '<tr>';
                echo '<th>Brno</th>';
                echo '<td>'.$data['brno'][1][0]['cnt']['brno_prisli_den1'].'</td>';
                echo '<td>'.$data['brno'][2][0]['cnt']['brno_prisli_den2'].'</td>';
                $sum = $data['brno'][1][0]['cnt']['brno_prisli_den1']+$data['brno'][2][0]['cnt']['brno_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['brno']['goal'].'</td>';

                $procento = $data['brno']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>CZU Praha</th>';
                echo '<td>'.$data['czu'][1][0]['cnt']['czu_prisli_den1'].'</td>';
                echo '<td>'.$data['czu'][2][0]['cnt']['czu_prisli_den2'].'</td>';
                $sum = $data['czu'][1][0]['cnt']['czu_prisli_den1']+$data['czu'][2][0]['cnt']['czu_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['czu']['goal'].'</td>';
                $procento = $data['czu']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Hradec Králové</th>';
                echo '<td>'.$data['hradec'][1][0]['cnt']['hradec_prisli_den1'].'</td>';
                echo '<td>'.$data['hradec'][2][0]['cnt']['hradec_prisli_den2'].'</td>';
                $sum = $data['hradec'][1][0]['cnt']['hradec_prisli_den1']+$data['hradec'][2][0]['cnt']['hradec_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['hradec']['goal'].'</td>';
                $procento = $data['hradec']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = '.bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Karviná</th>';
                echo '<td>'.$data['karvina'][1][0]['cnt']['karvina_prisli_den1'].'</td>';
                echo '<td>'.$data['karvina'][2][0]['cnt']['karvina_prisli_den2'].'</td>';
                $sum = $data['karvina'][1][0]['cnt']['karvina_prisli_den1']+$data['karvina'][2][0]['cnt']['karvina_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['karvina']['goal'].'</td>';
                $procento = $data['karvina']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Olomouc</th>';
                echo '<td>'.$data['olomouc'][1][0]['cnt']['olomouc_prisli_den1'].'</td>';
                echo '<td>'.$data['olomouc'][2][0]['cnt']['olomouc_prisli_den2'].'</td>';
                $sum = $data['olomouc'][1][0]['cnt']['olomouc_prisli_den1']+$data['olomouc'][2][0]['cnt']['olomouc_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['olomouc']['goal'].'</td>';
                $procento = $data['olomouc']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Ostrava</th>';
                echo '<td>'.$data['ostrava'][1][0]['cnt']['ostrava_prisli_den1'].'</td>';
                echo '<td>'.$data['ostrava'][2][0]['cnt']['ostrava_prisli_den2'].'</td>';
                $sum = $data['ostrava'][1][0]['cnt']['ostrava_prisli_den1']+$data['ostrava'][2][0]['cnt']['ostrava_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['ostrava']['goal'].'</td>';
                $procento = $data['ostrava']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Plzeň</th>';
                echo '<td>'.$data['plzen'][1][0]['cnt']['plzen_prisli_den1'].'</td>';
                echo '<td>'.$data['plzen'][2][0]['cnt']['plzen_prisli_den2'].'</td>';
                $sum = $data['plzen'][1][0]['cnt']['plzen_prisli_den1']+$data['plzen'][2][0]['cnt']['plzen_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['plzen']['goal'].'</td>';
                $procento = $data['plzen']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Praha</th>';
                echo '<td>'.$data['praha'][1][0]['cnt']['praha_prisli_den1'].'</td>';
                echo '<td>'.$data['praha'][2][0]['cnt']['praha_prisli_den2'].'</td>';
                $sum = $data['praha'][1][0]['cnt']['praha_prisli_den1']+$data['praha'][2][0]['cnt']['praha_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['praha']['goal'].'</td>';
                $procento = $data['praha']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = '.bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Zlín</th>';
                echo '<td>'.$data['zlin'][1][0]['cnt']['zlin_prisli_den1'].'</td>';
                echo '<td>'.$data['zlin'][2][0]['cnt']['zlin_prisli_den2'].'</td>';
                $sum = $data['zlin'][1][0]['cnt']['zlin_prisli_den1']+$data['zlin'][2][0]['cnt']['zlin_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['zlin']['goal'].'</td>';
                $procento = $data['zlin']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Randomáci</th>';
                echo '<td>'.$data['nolc'][1][0]['cnt']['nolc_prisli_den1'].'</td>';
                echo '<td>'.$data['nolc'][2][0]['cnt']['nolc_prisli_den2'].'</td>';
                $sum = $data['nolc'][1][0]['cnt']['nolc_prisli_den1']+$data['nolc'][2][0]['cnt']['nolc_prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>---</td>';
                echo '<td>---</td>';
            echo '</tr>';

            echo '<tr>';
                echo '<th>Celkem</th>';
                echo '<td>'.$data['all'][1][0]['cnt']['prisli_den1'].'</td>';
                echo '<td>'.$data['all'][2][0]['cnt']['prisli_den2'].'</td>';
                $sum = $data['all'][1][0]['cnt']['prisli_den1']+$data['all'][2][0]['cnt']['prisli_den2'];
                echo '<td>'.$sum.'</td>';
                echo '<td>'.$data['all']['goal'].'</td>';
                $procento = $data['all']['goal'] / 100;
                $pprocent = round($sum / $procento, 2);
                if($pprocent <= 50)
                {
                    $class = 'bgredc';
                }
                elseif($pprocent <= 75)
                {
                    $class = 'bgorange';
                }
                elseif($pprocent <= 90)
                {
                    $class = 'bgyellow';
                }
                elseif($pprocent <= 100)
                {
                    $class = 'bggreen';
                }
                else
                {
                    $class = 'bgpink';
                }
                echo '<td class="'.$class.'">'.$pprocent.' %</td>';
            echo '</tr>';

        echo '</table>';
     //pr($data);
    ?>
</div>