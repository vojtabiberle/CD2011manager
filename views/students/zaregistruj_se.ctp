<?php
echo $this->element('students/reg_menu');
?>
<div class="students reg zaregistruj_se">
    <div class="twocolumns left">
    <fieldset>
        <legend><?php __('Zaplacení registračního poplatku');?></legend>
        <div class="mobil paybox">
            <?php

                echo $this->Html->link($this->Html->image('mobil.png'),'/platba/mobil', array('escape' => false));
                echo '<span class="link">'.$this->Html->link(__('Mobilním telefonem', true),'/platba/mobil', array('escape' => false)).'</span><br>';
                echo '<div class="form">';
                echo $this->Form->create('Students', array('url' => '/platba/over'));
                echo $this->Form->input('regcod', array('label' => __('Mám registrační kód:', true), 'value' => __('Registrační kód', true)));
                echo $this->Form->end(__('Ověř', true));

                echo '</div>';
                echo '<small>Pro získání registračního kódu klikni na obrázek telefonu nebo na odkaz "Mobilním telefonem".</small>';
            ?>
        </div>
    </fieldset>
    </div>

    <div class="twocolumns right">
        <fieldset>
            <legend><?php __('Nápověda')?></legend>
            <p>
                Aby jsi se mohl zaregistrovat na Setkání s firmami a na Tréninky od firem, je potřeba se zaregistrovat na samotné Career Days.
                Tato registrace stojí 79 Kč na jeden den a 99 Kč na oba dva dny konání Career Days. Ale pokud přijedeš a vyplníš dotazník o tom,
                jak se ti na Career Days líbilo a jak se ti líbily firmy, vrátíme ti 50 Kč zpět.
            </p>
            <p>
                Nyní je možné zaplatit registrační poplatek přes SMS. Pokud jsi ještě neodeslal SMS a nemáš registrační kód, klikni na obrázek mobilu,
                nebo na odkaz "Mobilním telefonem" a dozvíš se, jak poslat registrační SMS.
            </p>
            <p>
                Pokud už máš registrační kód, vepiš jej do políčka a klikni na tlačítko "Ověř". Tím se dostaneš k registračnímu formuláři, který je potřeba
                vyplnit a poté dále k registraci Setkání s firmami a Tréninků.
            </p>
            <p>
                Pokud máš problémy s SMS registrací, nejdříve ověř, že máš tuto službu u svého operátora aktivovanou. SMSku můžeš odeslat případně i od kamaráda. Na Career Days můžeš také zaplatit až na místě - to ale přijdeš o registraci na setkání předem.
            </p>
            <p><strong>
                Pokud už jsi zaregistrovaný, pokračuj přihlášením nahoře.
                </strong>
            </p>
        </fieldset>
    </div>

    <div class="clear"></div>
<script type="text/javascript">
$(document).ready(function(){
    $('#StudentsRegcod').focus(function(){
        var val = $(this).val();
        if(val == 'Registrační kód')
        {
            $(this).val('');
        }
    });

    $('#StudentsRegcod').focusout(function(){
        var val = $(this).val();
        if(val == '')
        {
            $(this).val('Registrační kód');
        }
    });
});
</script>
</div>