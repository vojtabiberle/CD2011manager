<div class="students index">
    <?php
        if(!isset($user['User'])):
    ?>
    <fieldset>
        <legend><?php __('Vítáme tě na Career Days 2011');?></legend>
    <p>
        Zde máš možnost se zaregistrovat a zaplatit registrační poplatek na Career Days. V případě, že už jsi tak udělal, můžeš se přihlásit
        a podívat se, jaké firmy, školy a organizace se Career Days zůčastní nebo si můžeš rezervovat místo na Individuálním setkání s firmou,
        případně na některém z tréninků.
    </p>
    <p>
        Registrační poplatek je 79 Kč v případě, že se chceš zůčastnit pouze jednoho dne Career Day a 99 Kč, pokud chceš navštívit oba dva
        dny Career Days. A v případě, že nám na místě konání vyplníš dotazník, jak se ti Career Days líbily a ohodnotíš firmy, vrátíme ti 50 Kč zpět.
    </p>
    <p>
        Dále jsme pro tebe připravili možnost <strong>závazně</strong> si rezervovat ubytování v hotelu <a href="http://www.ubytovani-hotel-krystal.cz/" target="_blank">Krystal</a> za 330 Kč se snídaní.
    </p>
    <div class="buttons">
        <?
            echo $this->Html->link('<span>'.__('Pokračuj', true).'</span>'.$this->Html->image('direction_right.png'), array('action' => 'zaregistruj_se'), array('class' => 'button', 'escape' => false))
        ?>
    </div>
    </fieldset>

<?php
else:
?>
<fieldset>
<legend>Vítej na Career Days</legend>
<p>Career Days představují jedinečnou příležitost k setkání studentů s představiteli významných společností.
    Career Days jsou přirozeným krokem k Vaší úspěšné kariéře.</p>

<p>Career Days jsou určeny všem studentům vysokých škol, kteří nečekají až si je zaměstnavatel najde,
    ale aktivně se zajímají o možnosti svého budoucího uplatnění. Největší přínos mají
    Career Days pro studenty 3.-5. ročníků vysokých škol a pro absolventy bakalářského, magisterského, doktorandského i MBA studia.</p>

<p>
    Nyní zde můžeš dálš vyplňovat a vylepšovat svůj profil, který nakonec můžeš nabídnout ke zobrazení firmám, o které se zajímáš.
    Taky pro tebe máme připravený seznam firem a společností, které se účastní Career Days. Můžeš si prohlédnout jejich profily
    a zjistit o jaké studenty se momentálně zajímají.
</p>
</fieldset>
<?php
endif;
?>
</div>