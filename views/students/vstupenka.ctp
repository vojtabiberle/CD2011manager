<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
        <meta	http-equiv="Content-Type"	content="charset=utf-8" />
	<title>
		<?php __('Career Days 2011'); ?>
		<?php echo $title_for_layout; ?>
	</title>
    <style type="text/css">
body
{
    font-family: dejavusans;
    font-size: 9px;
}
* {
	margin:0;
	padding:0;
        color: black;
}

/** Tables **/
table {
	background: #fff;
	border-right:0;
	clear: both;
	color: #333;
	margin-bottom: 10px;
	width: 100%;
}
th {
	border:0;
	border-bottom:2px solid #555;
	text-align: left;
	padding:4px;
}
table tr td {
	background: #fff;
	padding: 6px;
	text-align: left;
	vertical-align: top;
	border-bottom:1px solid #ddd;
}
p
{
    text-indent: 30px;
    margin: 0px;
    padding: 2px;
}
    </style>
</head>
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
?>
<body>
    <table>
        <tr>
            <td width="400px">
                <?php echo $this->Html->image('http://'.$_SERVER['HTTP_HOST'].'/img/logo-cd.png');?>
            </td>
            <td>
                <center>
                <h1 style="font-size: 42px;">VSTUPENKA</h1>
                </center>
            </td>
        </tr>
        <tr>
            <td>
<?php 
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

echo '<table><tr>';
if(!empty($agenda['den1']))
{
    echo '<td>';
    $vynechat = 0;
    echo '<table  width="200px">';
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

                    echo '<td rowspan="'.$akce_ted['dilu'].'">';
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
                    echo '<td>&nbsp;</td>';
                }
            }
        echo '</tr>';
        if($vynechat > 0)
        {
            $vynechat--;
        }
    }
    echo '</table>';
    echo '</td>';
}
else
{
    echo '<td>&nbsp;</td>';
}
if(!empty($agenda['den2']))
{
    echo '<td>';
    $vynechat = 0;
    echo '<table width="200px">';
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

                    echo '<td rowspan="'.$akce_ted['dilu'].'">';
                        vypis($akce_ted);
                        $vynechat = $akce_ted['dilu'];
                    echo '</td>';
                }
                elseif($vynechat == 0)
                {
                    echo '<td>';
                        echo '&nbsp;';
                    echo '</td>';
                }
            }
            else
            {
                if($vynechat == 0)
                {
                    echo '<td>&nbsp;</td>';
                }
            }
        echo '</tr>';
        if($vynechat > 0)
        {
            $vynechat--;
        }
    }
    echo '</table>';
    echo '</td>';
}
else
{
    echo '<td>&nbsp;</td>';
}
//pr($agenda);
echo '</table>'; 
?>
            </td>
            <td>
                <?php echo $this->Html->image('http://'.$_SERVER['HTTP_HOST'].'/img/diplomat-planek.png'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Jméno a příjmení:</strong> <?php echo $student['User']['jmeno'].' '.$student['User']['prijmeni'];?><br>
                <strong>Email:</strong> <?php echo $student['User']['email'];?><br>
                <strong>Univerzita:</strong> <?php echo $student['School']['nazev']; ?><br>
                <strong>Zaplaceno dnů:</strong> <?php echo $student['Student']['zaplaceno_dnu'];?><br>
                    <br>
                
                    <p>
                    <barcode code="<?php echo $student['Student']['barcode'];?>" type="C39E" size="1.5" height="1.5"><br>
                            <center>
                            <div style="text-align: center; width: 100%; font-size: 12; font-weight: bold;">
                        <?php echo $student['Student']['barcode'];?>
                            </div>
                            </center>
                    </p>
            </td>
            <td>
                <?php echo $this->Html->image('http://'.$_SERVER['HTTP_HOST'].'/img/mapka.png');?>
                <p>Career Days se konají v hotelu Diplomat, který se nachází 100 metrů od stanice metra Dejvická.
                    Ve stanici vystup směrem k pohyblivým schodům a dej se smerem na ulici Evropská. Přesněji viz mapka.
                </p>
                <p><strong>Sleva Českých Drah:</strong><br>
                    Pro použití slevy stačí říct na kterékoliv pokladně ČD toto: <i>"Zpáteční jízdenku do Prahy, sleva VLAK+ na Career Days"</i>.
                    Dostaneš zpáteční lístek s 50% slevou. Na místě ti pak u infostánku dáme razítko, aby jsi měl(a) cestu zpět opravdu zadarmo!
                    Nezapomeň se tedy u nás zastavit.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>