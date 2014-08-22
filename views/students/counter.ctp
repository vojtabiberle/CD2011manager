<div class="students counter">
    <fieldset>
        <legend>Registrovaní studenti na Career Days</legend>
        <?php
            //pr($data);
            echo '<table>';
            echo '<tr><th>pobočka</th><th>@ers</th><th>Studentů</th><th>Celkem</th><th>Cíl</th><th>%</th></tr>';
            echo '<tr>';
                echo '<td>Brno</td>';
                echo '<td>'.$data['brno']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['brno']['students'][0]['sum']['count'].'</td>';
                $sum = $data['brno']['aiesecers'][0]['sum']['count']+$data['brno']['students'][0]['sum']['count'];
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
                echo '<td>CZU Praha</td>';
                echo '<td>'.$data['czu']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['czu']['students'][0]['sum']['count'].'</td>';
                $sum = $data['czu']['aiesecers'][0]['sum']['count']+$data['czu']['students'][0]['sum']['count'];
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
                echo '<td>Hradec Králové</td>';
                echo '<td>'.$data['hradec']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['hradec']['students'][0]['sum']['count'].'</td>';
                $sum = $data['hradec']['aiesecers'][0]['sum']['count']+$data['hradec']['students'][0]['sum']['count'];
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
                echo '<td>Karviná</td>';
                echo '<td>'.$data['karvina']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['karvina']['students'][0]['sum']['count'].'</td>';
                $sum = $data['karvina']['aiesecers'][0]['sum']['count']+$data['karvina']['students'][0]['sum']['count'];
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
                echo '<td>Olomouc</td>';
                echo '<td>'.$data['olomouc']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['olomouc']['students'][0]['sum']['count'].'</td>';
                $sum = $data['olomouc']['aiesecers'][0]['sum']['count']+$data['olomouc']['students'][0]['sum']['count'];
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
                echo '<td>Ostrava</td>';
                echo '<td>'.$data['ostrava']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['ostrava']['students'][0]['sum']['count'].'</td>';
                $sum = $data['ostrava']['aiesecers'][0]['sum']['count']+$data['ostrava']['students'][0]['sum']['count'];
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
                echo '<td>Plzeň</td>';
                echo '<td>'.$data['plzen']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['plzen']['students'][0]['sum']['count'].'</td>';
                $sum = $data['plzen']['aiesecers'][0]['sum']['count']+$data['plzen']['students'][0]['sum']['count'];
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
                echo '<td>Praha</td>';
                echo '<td>'.$data['praha']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['praha']['students'][0]['sum']['count'].'</td>';
                $sum = $data['praha']['aiesecers'][0]['sum']['count']+$data['praha']['students'][0]['sum']['count'];
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
                echo '<td>Zlín</td>';
                echo '<td>'.$data['zlin']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['zlin']['students'][0]['sum']['count'].'</td>';
                $sum = $data['zlin']['aiesecers'][0]['sum']['count']+$data['zlin']['students'][0]['sum']['count'];
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
                echo '<td>Bez LC</td>';
                echo '<td>---</td>';
                echo '<td>'.$data['no_lc']['students'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['no_lc']['students'][0]['sum']['count'].'</td>';
                echo '<td>---</td>';
                echo '<td>---</td>';
            echo '</tr>';
            $sum = $data['all']['students'][0]['sum']['count'] + $data['all']['aiesecers'][0]['sum']['count'];
            echo '<tr>';
                echo '<td>Celkem</td>';
                echo '<td>'.$data['all']['aiesecers'][0]['sum']['count'].'</td>';
                echo '<td>'.$data['all']['students'][0]['sum']['count'].'</td>';
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
        ?>
    </fieldset>
</div>