<?php
if(isset($add) && $add == true)
{
    echo '<div class="sloupce"><div class="levy">';
    echo $this->Form->input('name', array('label' => __('Přesný název firmy', true)));
    echo $this->Form->input('username', array('label' => __('Uživatelské jméno', true)));
    echo $this->Form->input('pass', array('label' => __('Heslo (zobrazuje se)', true)));
    echo '</div><div class="pravy">';
    echo $this->Form->input('adresa', array('label' => __('Adresa firmy', true)));
    echo $this->Form->input('telefon', array('label' => __('Telefon firmy (ústředna)', true)));
    echo $this->Form->input('web', array('label' => __('Webová prezentace firmy', true)));
    echo $this->Form->input('aiesec_respo', array('label' => __('Zodpovědná osoba z MC/LC', true)));
    echo $this->Form->input('oc_respo', array('label' => __('Zodpovědná osoba z CoreOC', true)));
    echo '</div></div>';
}
else
{
    echo '<div class="sloupce"><div class="levy">';
    echo $this->Form->input('name', array('label' => __('Přesný název firmy', true)));
    echo $this->Form->input('adresa', array('label' => __('Adresa firmy', true)));
    echo $this->Form->input('telefon', array('label' => __('Telefon firmy (ústředna)', true)));
    echo '</div><div class="pravy">';
    echo $this->Form->input('web', array('label' => __('Webová prezentace firmy', true)));
    echo $this->Form->input('aiesec_respo', array('label' => __('Zodpovědná osoba z MC/LC', true)));
    echo $this->Form->input('oc_respo', array('label' => __('Zodpovědná osoba z CoreOC', true)));
    echo '</div></div>';
}

echo '<div class="sloupce"><div class="levy">';
echo $this->Form->input('ma_trenink', array('label' => __('Má trénink(y)', true)));
echo $this->Form->input('pocet_treninku', array('label' => __('Počet tréninků', true)));
echo $this->Form->input('ma_panelovou_diskuzi', array('label' => __('Má panelové diskuze', true)));
echo $this->Form->input('ma_individual', array('label' => __('Má individuální setkání (firma zblízka)', true)));
echo $this->Form->input('ma_enterpreneurship_day', array('label' => __('Má Enterpreneurship Day', true)));
echo $this->Form->input('ma_cb_fixni', array('label' => __('Má fixní stranu v CB', true)));
echo $this->Form->input('ma_cb_kreativni', array('label' => __('Má kreativní stranu v CB', true)));
echo '</div><div class="pravy">';
echo $this->Form->input('ma_cb_odborny_clanek', array('label' => __('Má odborný článek v CB', true)));
echo $this->Form->input('ma_materialy_v_baliccich', array('label' => __('Má materiály v balíčcích', true)));
echo $this->Form->input('ma_expopanely', array('label' => __('Má expopanely', true)));
echo $this->Form->input('ma_videospot', array('label' => __('Má videospot', true)));
echo $this->Form->input('ma_den_1', array('label' => __('Účast první den', true)));
echo $this->Form->input('ma_den_2', array('label' => __('Účast druhý den', true)));
echo '</div></div>';

echo $this->Form->input('core_oc_notes', array('label' => __('Poznámka (pro CoreOC)', true), 'class' => 'jwysiwyg'));
echo $this->Form->input('cinnost', array('label' => __('Obor činnosti', true), 'class' => 'jwysiwyg'));
echo $this->Form->input('profil', array('label' => __('Profil společnosti', true), 'class' => 'jwysiwyg'));
echo $this->Form->input('nabizi', array('label' => __('Nabízíme budoucím zaměstnancům', true), 'class' => 'jwysiwyg'));
echo $this->Form->input('pozaduje', array('label' => __('Požadujeme od budoucích zaměstnanců', true), 'class' => 'jwysiwyg'));
echo $this->Form->input('prijmaci_rizeni', array('label' => __('Průběh příjmacího řízení', true), 'class' => 'jwysiwyg'));
echo $this->Form->input('dalsi', array('label' => __('Další doplňující informace', true), 'class' => 'jwysiwyg'));

echo '<fieldset> <legend>'.__('Zajímají se o studijní obory').'</legend>';
        $c_fields = count($fields);
        $half = ceil($c_fields / 2);
        $i = 0;
        function check($key, $company)
        {
            if(isset($company['Field']))
            {
                foreach($company['Field'] as $field)
                {
                    if($field['id'] == $key)
                        return true;
                }
            }
            return false;
        }
    echo  '<div class="sloupce"><div class="levy" style="width: 40%;">';
    foreach($fields as $key => $field)
    {
        if($i == $half)
            echo '</div><div class="pravy" style="width: 45%;">';


        //echo $this->Form->checkbox($field, array('value' => $key));
        echo '<input type="checkbox" id="data[Field]['.$key.']" name="data[Field]['.$key.']" type="checkbox"';
        if(check($key, $this->data))
        {
            echo ' checked="checked" ';
            echo 'value="true" ';
        }
        else
        {
            echo ' value="false" ';
        }
        echo '/>';
        echo '<span id="flash"></span>';
        echo '<label for="data[Field]['.$key.']">'.$field.'</label>';

        $i++;
    }
    echo  '</div></div>';
    echo '</fieldset>';

echo '<div class="sloupce"><div class="levy">';
echo $this->Form->input('vek-20-30', array('label' => __('Počet pracovníků ve věku 20 - 30 let', true)));
echo $this->Form->input('vek-30-40', array('label' => __('Počet pracovníků ve věku 30 - 40 let', true)));
echo '</div><div class="pravy">';
echo $this->Form->input('vek-40-50', array('label' => __('Počet pracovníků ve věku 40 - 50 let', true)));
echo $this->Form->input('vek-50-60', array('label' => __('Počet pracovníků ve věku 50 - 60 let', true)));
echo '</div></div>';

echo '<div class="sloupce"><div class="levy">';
echo $this->Form->input('zamestnanci-1', array('label' => __('Počet zaměstnanců za minulý rok', true)));
echo $this->Form->input('zamestnanci-2', array('label' => __('Počet zaměstnanců za rok ', true).date('Y', strtotime('-2 year'))));
echo '</div><div class="pravy">';
echo $this->Form->input('zamestnanci-3', array('label' => __('Počet zaměstnanců za rok ', true).date('Y', strtotime('-3 year'))));
echo $this->Form->input('zamestnanci-4', array('label' => __('Počet zaměstnanců za rok ', true).date('Y', strtotime('-4 year'))));
echo '</div></div>';

echo '<div class="sloupce"><div class="levy">';
echo $this->element('employees/contact', array('nadpis' => __('Hlavní kontakt', true), 'model' => 'CdKontakt'));
echo '</div><div class="pravy">';
echo $this->element('employees/contact', array('nadpis' => __('Kontakt pro studenty', true), 'model' => 'StudentKontakt'));
echo $this->element('employees/contact', array('nadpis' => __('Career Brožura kontakt', true), 'model' => 'CbKontakt'));
echo '</div></div>';

echo $this->Form->input('pozadavky_od_cd_teamu', array('label' => __('Požadavky od teamu Career Days', true), 'class' => 'jwysiwyg'));

    $this->Html->script('jwysiwyg/jquery.wysiwyg', array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg', null, array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg.modal', null, array('inline' => false));
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.jwysiwyg').wysiwyg({
            initialContent: '',
            autoGrow: true
        });

        $('#CompanyMaTrenink').change(function(){
            if($('#CompanyMaTrenink').is(':checked'))
            {
                $('#CompanyPocetTreninku').parent().show();
            }
            else
            {
                $('#CompanyPocetTreninku').parent().hide();
            }
        });

        if($('#CompanyMaTrenink').is(':checked'))
        {
            $('#CompanyPocetTreninku').parent().show();
        }
        else
        {
            $('#CompanyPocetTreninku').parent().hide();
        }
    });
</script>
