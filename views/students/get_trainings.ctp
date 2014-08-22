<div class="student get_trainings">
<?php

//echo '<!--';
//    pr($student);
//echo '-->';
echo '<table>';
echo '<tr><th>Název</th><th>Firma</th><th>Místnost</th><th>Den</th><th>Začátek</th><th>Konec</th><th>Maximum</th><th>Registrovaných</th><th></th></tr>';
foreach($trainings as $training)
{
    $jeNaTreninku = false;
    
    foreach($training['Student'] as $st)
    {
        if($st['id'] == $student['Student']['id'])
            $jeNaTreninku = true;
    }
    list($date, $time) = explode(' ', toCzechDateTime($training['Training']['datetime']));
    echo '<tr id='.$training['Training']['id'].'>';
    echo '<td class="name">'.$training['Training']['name'].'</td>';
    echo '<td class="company">'.$training['Company']['name'].'</td>';
    echo '<td class="room">'.$training['Room']['name'].'</td>';
    echo '<td class="day">';
        if($date == '02.03.2011')
        {
            echo '1';
        }
        if($date == '03.03.2011')
        {
            echo '2';
        }
    echo '</td>';
    echo '<td class="begin">'.$time.'</td>';
    echo '<td class="end">'.addTime($time, '01:30').'</td>';
    echo '<td class="max">20</td>';
    echo '<td class="registered">';
    echo $this->Html->image('indicator_arrows.gif');
    echo '</td>';
    echo '<td class="action">';
    if(!($student['Student']['zaplaceno_dnu'] == 1 && ($student['Student']['chce_den1'] == null || $student['Student']['chce_den2'] == null)))
    {
        if($jeNaTreninku)
        {
            echo $this->Html->link(__('Odhlaš', true), array('controller' => 'students', 'action' => 'training_unregister', $training['Training']['id']), null, 'Opravdu se chceš odhlásit?');
        }
        else
        {
            echo $this->Html->link(__('Přihlaš', true), array('controller' => 'students', 'action' => 'training_register', $training['Training']['id']), array('target' => '_blank'));
        }
    }
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#treninky table tr').each(function(){
        var tid = $(this).attr('id');
        if(tid)
        {
            $.get('/trainings/student_get_registered/'+tid, function(data){

                $('#treninky tr[id='+tid+'] .registered').html(data);

                /*var max = $('#treninky tr[id='+tid+'] .max').html();

                if(data + 5 >= max)
                {
                    $('#treninky tr[id='+mid+']').attr('style', 'background-color: #ffffcc;');
                }
                if(data >= max)
                {
                    $('#treninky tr[id='+mid+']').attr('style', 'background-color: #ffccff;');
                }*/
            });
        }
    });

    $('#treninky a[target=_blank]').fancybox(/*{
        'width': 800,
        'height': 700,
        'autoDimensions': false
    }*/);
});
</script>
