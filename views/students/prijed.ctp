<?php
echo $this->element('students/reg_menu');
echo $this->Html->image('indicator.gif', array('style'=> 'display: none;'));
$cmtg = count($student['Meeting']);
$ctr = count($student['Training']);
$tr = 'tréninků';
switch($ctr)
{
    case 1:
         $tr = 'trénink';
        break;
    case 4:
    case 3:
    case 2:
         $tr = 'tréninky';
        break;

}
//pr($student);
?>
<div class="students reg form prijed">
    <fieldset>
        <legend>Před příjezdem</legend>
        <div id="setkani">
            <?php
            if($cmtg == 0)
            {
                echo '<div><input type="checkbox" disabled="disabled"> Přihlaš se na setkání</div> '.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
                echo '<span class="help"><small>Nezapomeň se přihlásit na setkání s firmami</small></span>';
            }
            else
            {
                echo '<div><input type="checkbox" disabled="disabled" checked="checked"> Přihlaš se na setkání</div> '.$this->Html->image('/img/yes-small.png');
                echo '<span class="help"><small>Jseš přihlášen na '.$cmtg.' setkání.</small></span>';
            }
            ?>
        </div>
        <div id="trenink">
            <?php
            if($ctr == 0)
            {
                echo '<div><input type="checkbox" disabled="disabled"> Přihlaš se na tréninky</div> '.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
                echo '<span class="help"><small>Nezapomeň se přihlásit na tréninky</small></span>';
            }
            else
            {
                echo '<div><input type="checkbox" disabled="disabled" checked="checked"> Přihlaš se na tréninky</div> '.$this->Html->image('/img/yes-small.png');
                echo '<span class="help"><small>Jseš přihlášen na '.$ctr.' na '.$tr.'</small></span>';
            }
            ?>
        </div>
        <div id="zivotopis">
            <?php
            if(empty($student['Student']['zivotopis']))
            {
                echo '<div><input type="checkbox" disabled="disabled"> <a href="/profil">Nahraj</a> svůj životopis</div>'.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
            }
            else
            {
                echo '<div><input type="checkbox" disabled="disabled" checked="checked"> <a href="/profil">Nahraj</a> svůj životopis</div>'.$this->Html->image('/img/yes-small.png');
                echo '<span class="help"><small>Životopis: '.$this->Html->link($student['Student']['zivotopis'], '/files/cv/'.$student['User']['id'].'/'.$student['Student']['zivotopis']).'</small></span>';
            }
            ?>
        </div>
        <div id="zivotopis_tisk">
            <?php
            if($student['RegistrationRequestment']['vytiskni_zivotopis'] != 1)
            {
                echo '<div><input type="checkbox"> Vytiskni svůj životopis</div>'.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
            }
            else
            {
                echo '<div><input type="checkbox" checked="checked"> Vytiskni svůj životopis</div>'.$this->Html->image('/img/yes-small.png');
            }
            ?>
            <span class="help"><small>Doporučujeme životopis vytisknout vícekrát, abys mohl na každém setkání jeden nechat.</small></span>
        </div>
        <div id="vstupenka">
            <?php
            if($student['RegistrationRequestment']['vytiskni_vstupenku'] != 1)
            {
                echo '<div><input type="checkbox"> <a href="/tisk">Vytiskni</a> svoji vstupenku</div>'.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
            }
            else
            {
                echo '<div><input type="checkbox" checked="checked"> <a href="">Vytiskni</a> svoji vstupenku</div>'.$this->Html->image('/img/yes-small.png');
            }
            ?>
            <span class="help"><small>Vstupenku potřebuješ pro bezproblémový vstup na Career Days a zároveň na ni najdeš svoje setkání a tréninky.</small></span>
        </div>
        <div id="obleceni">
            <?php
            if($student['RegistrationRequestment']['priprav_obleceni'] != 1)
            {
                echo '<div><input type="checkbox"> Připrav společenské oblečení</div>'.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
            }
            else
            {
                echo '<div><input type="checkbox" checked="checked"> Připrav společenské oblečení</div>'.$this->Html->image('/img/yes-small.png');
            }
            ?>
        </div>
        <div id="cesta">
            <?php
                if($student['RegistrationRequestment']['cesta'] != 1)
                {
                    echo '<div><input type="checkbox"><a href="http://www.careerdays.cz/?page_id=24">Zjisti jak se na Career Days dostaneš</a></div>'.$this->Html->image('/img/yes-small.png', array('style' => 'display:none;'));
                }
                else
                {
                    echo '<div><input type="checkbox" checked="checked"><a href="http://www.careerdays.cz/?page_id=24">Zjisti jak se na Career Days dostaneš</a></div>'.$this->Html->image('/img/yes-small.png');
                }
            ?>
        </div>
        <div class="clear"></div>
        <div id="btn">
            <?php
            if($cmtg > 0 && $ctr > 0 && !empty($student['Student']['zivotopis']) && $student['RegistrationRequestment']['vytiskni_zivotopis'] == 1 && $student['RegistrationRequestment']['vytiskni_vstupenku'] == 1 && $student['RegistrationRequestment']['priprav_obleceni'] == 1)
            {
                echo $this->Html->image('prijed_green.png');
                echo $this->Html->image('prijed_orange.png', array('style' => 'display:none;'));
                echo '<span class="help" style="display:none;"><small>Doporučujeme ti nevynechat žádný krok, jen tak získáš z Career Days co nejvíce.</small></span>';
            }
            else
            {
                echo $this->Html->image('prijed_orange.png');
                echo $this->Html->image('prijed_green.png', array('style' => 'display:none;'));
                echo '<span class="help"><small>Doporučujeme ti nevynechat žádný krok, jen tak získáš z Career Days co nejvíce.</small></span>';
            }
            ?>
        </div>
        
    </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
    function toggleprijed()
    {
        var setkani = $('#setkani input[type=checkbox]').attr('checked');
        var trenink = $('#trenink input[type=checkbox]').attr('checked');
        var zivotopis = $('#zivotopis input[type=checkbox]').attr('checked');
        var zivotopis_tisk = $('#zivotopis_tisk input[type=checkbox]').attr('checked');
        var vstupenka = $('#vstupenka input[type=checkbox]').attr('checked');
        var obleceni = $('#obleceni input[type=checkbox]').attr('checked');
        var cesta = $('#cesta input[type=checkbox]').attr('checked');
        
        if(setkani && trenink && zivotopis && zivotopis_tisk && vstupenka  && obleceni && cesta)
        {
            $('#btn img').attr('src', '/img/prijed_green.png');
            $('#btn .help').hide();
        }
        else
        {
            $('#btn img').attr('src', '/img/prijed_orange.png');
            $('#btn .help').show();
        }
    }

    $('#zivotopis_tisk input[type=checkbox]').change(function(){
        $('#zivotopis_tisk img').attr('src', '/img/indicator.gif').show();
        $.get('/students/toggle_zivotopis_tisk', function(data){
            if(data == 1)
            {
                $('#zivotopis_tisk img').attr('src', '/img/yes-small.png').show();
            }
            if(data == 0)
            {
                $('#zivotopis_tisk img').attr('src', '/img/yes-small.png').hide();
            }
            toggleprijed();
        });
        
    });

    $('#vstupenka input[type=checkbox]').change(function(){
        $('#vstupenka img').attr('src', '/img/indicator.gif').show();
        $.get('/students/toggle_vstupenka', function(data){
            if(data == 1)
            {
                $('#vstupenka img').attr('src', '/img/yes-small.png').show();
            }
            if(data == 0)
            {
                $('#vstupenka img').attr('src', '/img/yes-small.png').hide();
            }
            toggleprijed();
        });
        
    });

    $('#obleceni input[type=checkbox]').change(function(){
        $('#obleceni img').attr('src', '/img/indicator.gif').show();
        $.get('/students/toggle_obleceni', function(data){
            if(data == 1)
            {
                $('#obleceni img').attr('src', '/img/yes-small.png').show();
            }
            if(data == 0)
            {
                $('#obleceni img').attr('src', '/img/yes-small.png').hide();
            }
            toggleprijed();
        });

        
    });

    $('#cesta input[type=checkbox]').change(function(){
        $('#cesta img').attr('src', '/img/indicator.gif').show();
        $.get('/students/toggle_cesta', function(data){
            if(data == 1)
            {
                $('#cesta img').attr('src', '/img/yes-small.png').show();
            }
            if(data == 0)
            {
                $('#cesta img').attr('src', '/img/yes-small.png').hide();
            }
            toggleprijed();
        });


    });
});
</script>