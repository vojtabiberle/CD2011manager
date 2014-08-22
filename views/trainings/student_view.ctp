<div class="students training_register">
    <fieldset>
        <!--<legend><?php echo $training['Training']['name'];?></legend>-->
        <h2><?php echo $training['Training']['name'];?></h2>
        <?php
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

</div>