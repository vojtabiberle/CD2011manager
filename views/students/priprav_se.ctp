<?php
echo $this->element('students/reg_menu');
?>
<div class="students reg zaregistruj_se">
    <?php
        if($student['Student']['zaplaceno_dnu'] == 1 && ($student['Student']['chce_den1'] == null || $student['Student']['chce_den2'] == null))
        {
            echo '<div class="message notice">';
            echo '<p>Máš zaplacený jen jeden den na Career Days. Je potřeba se rozhodnout, na který den přijdeš!</p>';
            echo '<div class="clear"></div>';
            echo '<div class="buttons">';
            echo $this->Html->link(__('První den', true), array('controller' => 'students', 'action' => 'first_day'));
            echo $this->Html->link(__('Druhý den', true), array('controller' => 'students', 'action' => 'second_day'));
            echo '</div>';
            echo '<div class="clear"></div>';
            echo '</div>';
        }
    ?>
    <div class="bigcolumn left">
        <fieldset>
            <legend><?php __('Setkání s firmami');?></legend>
            <div id="firmy">
                <?php
                    echo $this->Html->image('indicator.gif');
                ?>
            </div>
        </fieldset>

        <fieldset>
            <legend><?php __('Tréninky');?></legend>
            <div id="treninky">
                <?php
                    echo $this->Html->image('indicator.gif');
                ?>
            </div>
        </fieldset>
    </div>

    <div class="smallcolumn right">
        <fieldset>
            <legend><?php __('Nápověda');?></legend>
            <p>
                Některá setkání ještě nemusí být ze strany firem připravena, proto se na ně ještě nelze registrovat.
                Nezapomeň se tedy do registračního systému později vrátit, aby jsi registraci stihl(a).
            </p>
            <p>
                Svůj vlastní program na Career Days najdeš v profilu nebo můžeš <?php echo $this->Html->link(__('kliknout zde', true), array('controller' => 'students', 'action' => 'agenda'), array('target' => '_blank'));?>.
            </p>
            <p>
                Nezapomeň si vytisknout svoji vstupenku - klikni na <?php echo $this->Html->link(__('Přijeď', true), array('controller' => 'students', 'action' => 'prijed'));?>.
            </p>
        </fieldset>
    </div>

    <div class="clear"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $.get('/students/get_companies', function(data){
        $('#firmy').html(data);
    });

    $.get('/students/get_trainings', function(data){
        $('#treninky').html(data);
    });

    $('a[target=_blank]').fancybox();
});
</script>