<div class="student meeting_register">
<fieldset>
    <legend><?php echo $meeting['Company']['name']; ?></legend>
    <?php
        $cmtg = count($meeting['Student']);
        if($meeting['Meeting']['max_pocet_ucastniku'] <= $cmtg)
        {
            echo '<div class="message error">'
                .'<p>Toto Setkání je již plně obsazeno studenty, ale to vůbec nevadí!
                    Stále máš ještě možnost přijít před začátkem setkání a zeptat se,
                    jestli se některé místo neuvolnilo. Zpravidla se pár míst uvolní.
                    Můžeš také nechat firmě svůj kontakt prostým zatrhnutím "Zanechat kontaktní údaje".</p>'
                .'</div>';
        }
    ?>
    <div class="twocolumns left">
        <fieldset>
            <legend>Začátek</legend>
            <p><?php echo rmSecond($meeting['Meeting']['zacatek']);?></p>
        </fieldset>
    </div>

    <div class="twocolumns right">
        <fieldset>
            <legend>Konec</legend>
            <p><?php echo rmSecond($meeting['Meeting']['konec']);?></p>
        </fieldset>
    </div>

    <fieldset>
        <legend>Popis setkání</legend>
        <?php echo $meeting['Meeting']['popis'];?>
    </fieldset>

    <fieldset>
        <legend>Požadavky na studenta</legend>
        <?php echo $meeting['Meeting']['pozadavky'];?>
    </fieldset>
</fieldset>
    <fieldset>
        <legend>Registrace</legend>
        <?php
            echo $this->Form->create('Student');
            echo $this->Form->input('meeting_id', array('value' => $meeting['Meeting']['id'], 'type' => 'hidden'));
            if($meeting['Meeting']['max_pocet_ucastniku'] <= $cmtg)
            {
                echo $this->Form->input('zanechat_kontakt', array('type' => 'checkbox', 'label' => 'Chci zanechat firmě kontaktní informace'));
            }
            else
            {
                echo $this->Form->input('pozadavky_souhlas', array('type' => 'checkbox', 'label' => 'Souhlasím s požadavky firmy na studenty a závazně se přihlašuji na setkání.'));
            }
            echo $this->Form->end(__('Registruj', true));
        ?>
    </fieldset>
</div>