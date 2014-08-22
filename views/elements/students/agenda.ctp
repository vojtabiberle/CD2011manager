<?php
function kolikDilu($akce)
{
    $dilu = 0;
    $zacatek = rmSecond($akce['zacatek']);
    $konec = rmSecond($akce['konec']);
    do
    {
        $konec = subTime($konec, '00:30');
        $dilu++;
    }while(compareTime($zacatek, $konec) != 0);
    return $dilu;
}
function vypis($akce)
{
    if($akce['typ'] == 'training')
    {
        echo '<strong>Název:</strong> '.$akce['name'].'<br>';
        echo '<strong>Firma:</strong> '.$akce['company_name'].'<br>';
        echo '<strong>Místnost:</strong> '.$akce['room_name'].'<br>';
        echo '<strong>Trénink</strong>';
    }
    if($akce['typ'] == 'meeting')
    {
        echo '<strong>Firma:</strong> '.$akce['company_name'].'<br>';
        echo '<strong>Místnost:</strong> '.$akce['room_name'].'<br>';
        echo '<strong>Setkání s firmou</strong>';
    }
}

$times = array(
    '0900' => '9:00', '0930' => '',
    '1000' => '10:00', '1030' => '',
    '1100' => '11:00', '1130' => '',
    '1200' => '12:00', '1230' => '',
    '1300' => '13:00', '1330' => '',
    '1400' => '14:00', '1430' => '',
    '1500' => '15:00', '1530' => '',
    '1600' => '16:00', '1630' => '',
    '1700' => '17:00');

echo '<div id="agenda">';
if(!empty($agenda['den1']))
{
    echo '<div id="den1">';
    $vynechat = 0;
    echo '<table>';
    echo '<tr><th colspan="2">První den</th></tr>';
    foreach($times as $class => $time)
    {
        echo '<tr>';
        $akce_ted = array();
        foreach($agenda['den1'] as $akce)
        {
             if(!empty($time) && compareTime(rmSecond($akce['zacatek']), $time) == 0)
             {
                 $akce_ted = $akce;
                 $akce_ted['dilu'] = kolikDilu($akce);
             }
        }
            if(!empty($time))
            {
                echo '<td rowspan="2">'.$time.'</td>';
                if(!empty($akce_ted) && $vynechat == 0)
                {

                    echo '<td rowspan="'.$akce_ted['dilu'].'" class="'.$class.'">';
                        vypis($akce_ted);
                        $vynechat = $akce_ted['dilu'];
                    echo '</td>';
                }
                elseif($vynechat == 0)
                {
                    echo '<td class="'.$class.'">';
                        echo '&nbsp;';
                    echo '</td>';
                }
            }
            else
            {
                if($vynechat == 0)
                {
                    echo '<td class="'.$class.'">&nbsp;</td>';
                }
            }
        echo '</tr>';
        if($vynechat > 0)
        {
            $vynechat--;
        }
    }
    echo '</table>';
    echo '</div>';
}
else
{
    echo '<div id="den1" class="nothing">&nbsp;</div>';
}
if(!empty($agenda['den2']))
{
    echo '<div id="den2">';
    $vynechat = 0;
    echo '<table>';
    echo '<tr><th colspan="2">Druhý den</th></tr>';
    foreach($times as $class => $time)
    {
        echo '<tr>';
        $akce_ted = array();
        foreach($agenda['den2'] as $akce)
        {
             if(!empty($time) && compareTime(rmSecond($akce['zacatek']), $time) == 0)
             {
                 $akce_ted = $akce;
                 $akce_ted['dilu'] = kolikDilu($akce);
             }
        }
            if(!empty($time))
            {
                echo '<td rowspan="2">'.$time.'</td>';
                if(!empty($akce_ted) && $vynechat == 0)
                {

                    echo '<td rowspan="'.$akce_ted['dilu'].'" class="'.$class.'">';
                        vypis($akce_ted);
                        $vynechat = $akce_ted['dilu'];
                    echo '</td>';
                }
                elseif($vynechat == 0)
                {
                    echo '<td class="'.$class.'">';
                        echo '&nbsp;';
                    echo '</td>';
                }
            }
            else
            {
                if($vynechat == 0)
                {
                    echo '<td class="'.$class.'">&nbsp;</td>';
                }
            }
        echo '</tr>';
        if($vynechat > 0)
        {
            $vynechat--;
        }
    }
    echo '</table>';
    echo '</div>';
}
else
{
    echo '<div id="den2" class="nothing">&nbsp;</div>';
}
//pr($agenda);
echo '</div>';
?>