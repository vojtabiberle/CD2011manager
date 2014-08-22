<?php
echo $this->element('students/reg_menu');
?>
<div class="students reg pay">
    <?php
    if($how == false)
    {//nevybral metody platby
        ?>
        <fieldset>
        <legend><?php __('Zaplacení registračního poplatku');?></legend>
        <div class="mobil paybox">
            <?php

                echo $this->Html->link($this->Html->image('mobil.png'),'/platba/mobil', array('escape' => false));
                echo '<span class="link">'.$this->Html->link(__('Mobilním telefonem', true),'/platba/mobil', array('escape' => false)).'</span>';
            ?>
        </div>
    </fieldset>
    <?php
    }
    else
    {
        switch($how)
        {
            case 'mobil':
                ?>
    <fieldset>
        <legend>Platba mobilem</legend>
        <p>Jeden den - pošli SMS ve tvaru CAREER DAYS na číslo 903 55 79 - Cena SMS je 79 Kč*</p>
        <p>Dva dny - pošli SMS ve tvaru CAREER DAYS na číslo 903 55 99 - Cena SMS je 99 Kč*</p>
        
        <p>Po odeslání SMS ti obratem přijde potvrzovací SMS s registračním kódem, který zadáš v následujícím formuláři:</p>
        <div class="students form register">
            <?php
                echo $this->Form->create('Students', array('url' => '/platba/over'));
                echo $this->Form->input('regcod', array('label' => __('Registrační kód:', true)));
                echo $this->Form->end(__('Ověř', true));
            ?>
        </div>
        <small>* cena je včetně vratné zálohy 50 Kč, kterou ti vrátíme přímo na Career Days po vyplnění dotazníku</small>
    </fieldset>
                <?php
            break;
            default:
                echo '<div id="message"><h2>Nepodporovaný způsob platby</h2><p>Takhle nám zaplatit nemůžeš!</p></div>';
            break;
        }
    }
    ?>
    <div class="clear"></div>
</div>