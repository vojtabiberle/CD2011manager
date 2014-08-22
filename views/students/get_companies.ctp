<div class="student get_companies">
<?php
function meetingsort($m1, $m2)
{
    if($m1['den'] == $m2['den'] && $m1['zacatek'] == $m2['zacatek'])
    {
        return 0;
    }
    if($m1['den'] == $m2['den'])
    {
        return compareTime(rmSecond($m1['zacatek']), rmSecond($m2['zacatek']));
    }
    return ($m1['den'] < $m2['den']) ? -1 : 1;
}
//echo '<!--';
//pr($companies);
//echo '-->';
//pr($student);
echo $this->Html->image('/img/ico-minus-big.png', array('style' => 'display: none;'));
foreach($companies as $company)
{
    if($company['Company']['room_day_1'] == null && $company['Company']['room_day_2'] == null)
        continue;
    $cmeetings = count($company['Meetings']);
    echo '<div id="'.$company['Company']['id'].'" class="company">';
    echo '<div class="info">';
    if($cmeetings > 0)
    {
        echo '<div class="img">';
        echo $this->Html->image('ico-plus-big.png');
        echo '</div>';
        echo '<div class="name">';
        echo $this->Html->link($company['Company']['name'], array('controller' => 'trainings', 'action' => 'student_view', $company['Company']['id']));
        echo '</div>';
    }
    else
    {
        echo '<div class="img">';
        echo '</div>';
        echo '<div class="name">'.$company['Company']['name'].'</div>';
    }
    
    
    echo '<div class="days">';
    if($company['Company']['ma_den_1'] || $company['Company']['ma_den_2'])
    {
        //echo 'Oba dny na Career Days';
    }
    elseif($company['Company']['ma_den_1'])
    {
        //echo 'První den na Career Days';
    }
    elseif($company['Company']['ma_den_2'])
    {
        //echo 'Druhý den na Career Days';
    }
    echo '</div>';
    
    echo '<div class="detail">';
    echo $this->Html->link(__('Detail ...', true), array('controller' => 'companies', 'action' => 'student_view', $company['Company']['id']), array('target' => '_blank'));
    echo '</div>';
    
    echo '</div>';

    if($cmeetings > 0)
    {
        $i = 0;
        echo '<div class="meetings">';
        //echo '<table>';
        //echo '<tr><th>Den setkání</th><th>Začátek</th><th>Konec</th><th>Maximum účastníků</th><th>Registrovaných</th><th></th></tr>';
        echo '<div class="header">';
        echo '<div class="den">Den</div>'
            .'<div class="zacatek">Začátek</div>'
            .'<div class="konec">Konec</div>'
            .'<div class="mistnost">Místnost</div>'
            .'<div class="max">Max.</div>'
            .'<div class="registrovanych">Nyní</div>'
            .'<div class="akce"></div>';
        echo '</div>';
        uasort($company['Meetings'], 'meetingsort');
        foreach($company['Meetings'] as $meeting)
        {
            
            $jeNaSetkani = false;
            foreach($student['Meeting'] as $mtg)
            {
                if($mtg['id'] == $meeting['id'])
                    $jeNaSetkani = true;
            }

            if($student['Student']['zaplaceno_dnu'] == 1)
            {
                if($student['Student']['chce_den1'] == 1 && $meeting['den'] != 1)
                {
                    continue;
                }

                if($student['Student']['chce_den2'] == 1 && $meeting['den'] != 2)
                {
                    continue;
                }
            }

            if($i%2==0)
            {
                echo '<div id="'.$meeting['id'].'" class="meeting even">';
            }
            else
            {
                echo '<div id="'.$meeting['id'].'" class="meeting odd">';
            }
            
                echo '<div class="den">';
                    echo $meeting['den'];
                echo '</div>';
                echo '<div class="zacatek">';
                    echo rmSecond($meeting['zacatek']);
                echo '</div>';
                echo '<div class="konec">';
                    echo rmSecond($meeting['konec']);
                echo '</div>';
                echo '<div class="mistnost">';
                    echo $company['RoomDay'.$meeting['den']]['name'];
                echo '</div>';
                echo '<div class="max">';
                    echo $meeting['max_pocet_ucastniku'];
                echo '</div>';
                echo '<div class="registrovanych">';
                    echo $this->Html->image('indicator_arrows.gif');
                echo '</div>';
                echo '<div class="akce">';
                if(!($student['Student']['zaplaceno_dnu'] == 1 && ($student['Student']['chce_den1'] == null || $student['Student']['chce_den2'] == null)))
                {
                    if($jeNaSetkani)
                    {
                        echo $this->Html->link(__('Odhlaš', true), array('controller' => 'students', 'action' => 'meeting_unregister', $meeting['id']), null, 'Opravdu se chceš odhlásit?');
                    }
                    else
                    {
                        echo $this->Html->link(__('Přihlaš', true), array('controller' => 'students', 'action' => 'meeting_register', $meeting['id']), array('target' => '_blank'));
                    }
                }
                echo '</div>';
            echo '</div>';
            $i++;
        }
        //echo '</table>';
        echo '</div>';
    }

    echo '</div>';
}

?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    function toggleimg(img)
    {
        if($(img).attr('src') == '/img/ico-plus-big.png')
        {
            $(img).attr('src', '/img/ico-minus-big.png');
        }
        else
        {
            $(img).attr('src', '/img/ico-plus-big.png');
        }
    }

    function reloadreg(cid)
    {
        $('#firmy .company[id='+cid+'] .meetings .meeting').each(function(){
            var mid = $(this).attr('id');
            $.get('/meetings/student_get_registered/'+mid, function(data){
            
                $('#firmy .meeting[id='+mid+'] .registrovanych').html(data);

                /*var max = $('#firmy .meeting[id='+mid+'] .max').html();
                
                if(data + 5 >= max)
                {
                    $('#firmy .meeting[id='+mid+']').attr('style', 'background-color: #ffffcc;');
                }
                if(data >= max)
                {
                    $('#firmy .meeting[id='+mid+']').attr('style', 'background-color: #ffccff;');
                }*/
                
            });
        });
    }

    $('#firmy .info img').click(function(){
        var compid = $(this).parent().parent().parent().attr('id');
        $('#firmy .company[id='+compid+'] .meetings').toggle();
        toggleimg($('#firmy .company[id='+compid+'] .img img'));
        reloadreg(compid);
    });

    $('#firmy .info .name a').click(function(){
        var compid = $(this).parent().parent().parent().attr('id');
        $('#firmy .company[id='+compid+'] .meetings').toggle();
        toggleimg($('#firmy .company[id='+compid+'] .img img'));
        reloadreg(compid);
        return false;
    });

    $('#firmy a[target=_blank]').fancybox(/*{
        'width': 800,
        'height': 800,
        'autoDimensions': false
    }*/);

});
</script>
