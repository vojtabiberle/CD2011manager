<div class="trainings student_index">
    <fieldset>
        <legend>Tréninky na Career Days</legend>
        <div class="message error">I když jsou některé tréninky již obsazené, stále ještě máš možnost se zaregistrovat přímo na místě.
Jednoduše přijď několik minut předem, zpravidla se několik míst uvolní. O aktuálních volných místech se dozvíš také z informační tabule.</div>
<?php
//pr($trainings);
echo '<table>';
echo '<tr><th>Název</th><th>Firma</th><th>Místnost</th><th>Den</th><th>Začátek</th><th>Konec</th><th>Maximum</th><th>Registrovaných</th><th>Registrace&nbsp;na&nbsp;místě</th><th></th></tr>';
foreach($trainings as $training)
{
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
    echo '<td>';
        echo $this->Html->image('yes-extra-small.png');
    echo '</td>';
    echo '<td class="action">';

      echo $this->Html->link(__('Detail...', true), array('controller' => 'trainings', 'action' => 'student_view', $training['Training']['id']), array('target' => '_blank'));

    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>
    </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.trainings table tr').each(function(){
        var tid = $(this).attr('id');
        if(tid)
        {
            $.get('/trainings/student_get_registered/'+tid, function(data){

                $('.trainings tr[id='+tid+'] .registered').html(data);

                /*var max = $('.trainings tr[id='+tid+'] .max').html();

                if(data + 5 >= max)
                {
                    $('.trainings tr[id='+mid+']').attr('style', 'background-color: #ffffcc;');
                }
                if(data >= max)
                {
                    $('.trainings tr[id='+mid+']').attr('style', 'background-color: #ffccff;');
                }*/
            });
        }
    });

    $('.trainings a[target=_blank]').fancybox(/*{
        'width': 800,
        'height': 700,
        'autoDimensions': false
    }*/);
});
</script>
