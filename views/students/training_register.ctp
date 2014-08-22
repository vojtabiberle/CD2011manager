<div class="students training_register">
    <fieldset>
        <!--<legend><?php echo $training['Training']['name'];?></legend>-->
        <h2><?php echo $training['Training']['name'];?></h2>
        <?php
        $ctr = count($training['Student']);
        if(20 <= $ctr)
        {
            echo '<div class="message error">'
                .'<p>Tento trénink je již plně obsazen studenty, ale to vůbec nevadí!
                    Stále máš ještě možnost přijít před začátkem tréninku a zeptat se,
                    jestli se některé místo neuvolnilo. Zpravidla se pár míst uvolní.</p>'
                .'</div>';
        }
        list($date, $time) = explode(' ', toCzechDateTime($training['Training']['datetime']));
    ?>
    <div class="twocolumns left">
        <fieldset>
            <legend>Začátek</legend>
            <p><?php echo $time;?></p>
        </fieldset>
    </div>

    <div class="twocolumns right">
        <fieldset>
            <legend>Konec</legend>
            <p><?php echo addTime($time, '01:30');?></p>
        </fieldset>
    </div>

    <fieldset>
        <legend>Popis tréninku</legend>
        <div style="height: 31%; width: 98%; overflow: auto; margin: 0px; padding: 0px">
        <?php echo $training['Training']['description'];?>
        </div>
    </fieldset>

    </fieldset>
    <fieldset>
        <legend>Registrace</legend>
        <?php
            echo $this->Form->create('Student');
            echo $this->Form->input('training_id', array('value' => $training['Training']['id'], 'type' => 'hidden'));
            echo $this->Form->end(__('Registruj', true));
        ?>
    </fieldset>

</div>