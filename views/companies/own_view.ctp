<div class="companies own_view form">
<h2><?php __('Údaje o firmě'); ?></h2>
<?php
    //pr($company);
    echo  $this->Form->create('Company', array('action' => 'field'));
    echo  '<fieldset> <legend>'.$company['Company']['name'].'</legend>';
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Adresa',
        'title' => __('Adresa firmy', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['adresa'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Telefon',
        'title' => __('Telefon firmy (ústředna)', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['telefon'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Web',
        'title' => __('Webová prezentace firmy', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['web'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Cinnost',
        'title' => __('Obor činnosti', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['cinnost'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Profil',
        'title' => __('Profil společnosti', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['profil'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Nabizi',
        'title' => __('Nabízíme budoucím zaměstnancům', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['nabizi'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Pozaduje',
        'title' => __('Požadujeme od budoucích zaměstnanců', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['pozaduje'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Prijmaci_Rizeni',
        'title' => __('Průběh příjmacího řízení', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['prijmaci_rizeni'])
        );

    echo '<fieldset> <legend>'.__('Zajímáme se o studijní obory').'</legend>';
        $c_fields = count($fields);
        $half = ceil($c_fields / 2);
        $i = 0;
        function check($key, $company)
        {
            foreach($company['Field'] as $field)
            {
                if($field['id'] == $key)
                    return true;
            }
            return false;
        }
    echo  '<div class="sloupce"><div class="levy" style="width: 40%;">';
    foreach($fields as $key => $field)
    {
        if($i == $half)
            echo '</div><div class="pravy" style="width: 45%;">';
        
        
        //echo $this->Form->checkbox($field, array('value' => $key));
        echo '<input type="checkbox" id="Company.'.$key.'" name="Company.'.$key.'" value="'.$field.'" type="checkbox"';
        if(check($key, $company)) echo 'checked="checked"';
        echo '/>';
        echo '<span id="flash"></span>';
        echo '<label for="Company.'.$key.'">'.$field.'</label>';
        
        $i++;
    }
    echo  '</div></div>';
    echo '</fieldset>';

    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Dalsi',
        'title' => __('Další doplňující informace', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['dalsi'])
        );
    echo  '<div class="sloupce"><div class="levy">';
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Vek-20-30',
        'title' => __('Počet pracovníků ve věku 20 - 30 let', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['vek-20-30'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Vek-30-40',
        'title' => __('Počet pracovníků ve věku 30 - 40 let', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['vek-30-40'])
        );
    echo  '</div><div class="pravy">';
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Vek-40-50',
        'title' => __('Počet pracovníků ve věku 40 - 50 let', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['vek-40-50'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Vek-50-60',
        'title' => __('Počet pracovníků ve věku 50 - 60 let', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['vek-50-60'])
        );
    echo  '</div></div>';
    echo  '<div class="sloupce"><div class="levy">';
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Zamestnanci-1',
        'title' => __('Počet zaměstnanců za minulý rok', true),
        'type' => 'text_edit',
        'data'=> $company['Company']['zamestnanci-1'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Zamestnanci-2',
        'title' => __('Počet zaměstnanců za rok ', true).date('Y', strtotime('-2 year')),
        'type' => 'text_edit',
        'data'=> $company['Company']['zamestnanci-2'])
        );
    echo  '</div><div class="pravy">';
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Zamestnanci-3',
        'title' => __('Počet zaměstnanců za rok ', true).date('Y', strtotime('-3 year')),
        'type' => 'text_edit',
        'data'=> $company['Company']['zamestnanci-3'])
        );
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Zamestnanci-4',
        'title' => __('Počet zaměstnanců za rok ', true).date('Y', strtotime('-4 year')),
        'type' => 'text_edit',
        'data'=> $company['Company']['zamestnanci-4'])
        );
    echo  '</div></div>';
    echo  '<div class="sloupce"><div class="levy">';
    echo  '<fieldset><legend>'.__('Hlavní kontakt', true).'</legend>';
        echo  $this->element('companies/jeditable', array(
            'id' => 'CdKontakt.Jmeno',
            'title' => __('Jméno', true),
            'type' => 'text_edit',
            'data'=> $company['CdKontakt']['jmeno'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CdKontakt.Prijmeni',
            'title' => __('Příjmení', true),
            'type' => 'text_edit',
            'data'=> $company['CdKontakt']['prijmeni'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CdKontakt.Email',
            'title' => __('Email', true),
            'type' => 'text_edit',
            'data'=> $company['CdKontakt']['email'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CdKontakt.Tel',
            'title' => __('Telefon', true),
            'type' => 'text_edit',
            'data'=> $company['CdKontakt']['tel'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CdKontakt.Pozice',
            'title' => __('Pozice', true),
            'type' => 'text_edit',
            'data'=> $company['CdKontakt']['pozice'])
            );
    echo  '</fieldset>';
    echo  '</div><div class="pravy">';
    echo  '<fieldset><legend>'.__('Kontakt pro studentky', true).'</legend>';
        echo  $this->element('companies/jeditable', array(
            'id' => 'StudentKontakt.Jmeno',
            'title' => __('Jméno', true),
            'type' => 'text_edit',
            'data'=> $company['StudentKontakt']['jmeno'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'StudentKontakt.Prijmeni',
            'title' => __('Příjmení', true),
            'type' => 'text_edit',
            'data'=> $company['StudentKontakt']['prijmeni'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'StudentKontakt.Email',
            'title' => __('Email', true),
            'type' => 'text_edit',
            'data'=> $company['StudentKontakt']['email'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'StudentKontakt.Tel',
            'title' => __('Telefon', true),
            'type' => 'text_edit',
            'data'=> $company['StudentKontakt']['tel'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'StudentKontakt.Pozice',
            'title' => __('Pozice', true),
            'type' => 'text_edit',
            'data'=> $company['StudentKontakt']['pozice'])
            );
    echo  '</fieldset>';
    echo  '<fieldset><legend>'.__('Career Brožura kontakt', true).'</legend>';
        echo  $this->element('companies/jeditable', array(
            'id' => 'CbKontakt.Jmeno',
            'title' => __('Jméno', true),
            'type' => 'text_edit',
            'data'=> $company['CbKontakt']['jmeno'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CbKontakt.Prijmeni',
            'title' => __('Příjmení', true),
            'type' => 'text_edit',
            'data'=> $company['CbKontakt']['prijmeni'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CbKontakt.Email',
            'title' => __('Email', true),
            'type' => 'text_edit',
            'data'=> $company['CbKontakt']['email'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CbKontakt.Tel',
            'title' => __('Telefon', true),
            'type' => 'text_edit',
            'data'=> $company['CbKontakt']['tel'])
            );
        echo  $this->element('companies/jeditable', array(
            'id' => 'CbKontakt.Pozice',
            'title' => __('Pozice', true),
            'type' => 'text_edit',
            'data'=> $company['CbKontakt']['pozice'])
            );
    echo  '</fieldset>';
    echo  '</div></div>';
    echo  $this->element('companies/jeditable', array(
        'id' => 'Company.Pozadavky_Od_Cd_Teamu',
        'title' => __('Požadavky od teamu Career Days', true),
        'type' => 'textarea_edit',
        'data'=> $company['Company']['pozadavky_od_cd_teamu'])
        );
    echo  '</fieldset>';
    

    if($company['Company']['schvaleno_firmou'] != 1)
    {
        echo  $this->Form->end(__('Ulož', true));
    $this->Html->script('jwysiwyg/jquery.wysiwyg', array('inline' => false));
    $this->Html->script('jwysiwyg/controls/wysiwyg.colorpicker', array('inline' => false));
    $this->Html->script('jwysiwyg/controls/wysiwyg.image', array('inline' => false));
    $this->Html->script('jwysiwyg/controls/wysiwyg.table', array('inline' => false));
    $this->Html->script('jquery.jeditable', array('inline' => false));
    $this->Html->script('jquery.jeditable.wysiwyg', array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg', null, array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg.modal', null, array('inline' => false));
    $this->Html->script('jquery.checkbox', array('inline' => false));
    }
?>
</div>
<script type="text/javascript">

    function submiterror()
    {
        alert('nepodařilo se uložit');
    }

    $(document).ready(function(){
        $('.text_edit').editable('/companies/save_snipet',{
            placeholder: '<?php __('Upravte kliknutím zde ...');?>',
            onblur: 'ignore',
            submit: 'OK',
            cancel: 'Storno',
            indicator: '<img src="/img/indicator.gif">',
            onerror: submiterror
        });
        $('.textarea_edit').editable('/companies/save_snipet',{
            placeholder: '<?php __('Upravte kliknutím zde ...');?>',
            type: 'wysiwyg',
            onblur: 'ignore',
            submit: 'OK',
            cancel: 'Storno',
            indicator: '<img src="/img/indicator.gif">',
            onerror: submiterror
        });

        $('input[type=checkbox]').checkbox({
            limg: '/img/indicator.gif',
            url: '/companies/obor_zajmu'
        });

        $('input[type=submit]').hide();

    });
</script>