<div class="companies student_view">
<h2><?php  __('Firma');?></h2>
	<?php
        //pr($company);
        echo '<table>';
        echo '<tr>';
            echo '<th>'.__('Logo', true).'</th>';
            echo '<td>';
                if(!empty($company['Company']['web_logo']))
                    echo $this->Html->image($company['Company']['web_logo'], array('height' => 65));
            echo '</td>';
        echo'</tr>';
        echo $this->element('companies/table-row', array('label' => __('Jméno firmy', true), 'co' => 'name'));
        echo $this->element('companies/table-row', array('label' => __('Adresa', true), 'co' => 'adresa'));
        echo $this->element('companies/table-row', array('label' => __('Telefon (ústředna)', true), 'co' => 'telefon'));
        echo $this->element('companies/table-row', array('label' => __('Webová prezentace', true), 'co' => 'web'));
        echo $this->element('companies/table-row', array('label' => __('Obor činnosti', true), 'co' => 'cinnost'));
        echo $this->element('companies/table-row', array('label' => __('Profil', true), 'co' => 'profil'));
        echo $this->element('companies/table-row', array('label' => __('Nabízí budoucím zaměstnancům', true), 'co' => 'nabizi'));
        echo $this->element('companies/table-row', array('label' => __('Požaduje od budoucích zaměstnanců', true), 'co' => 'pozaduje'));
        echo $this->element('companies/table-row', array('label' => __('Průběh přijmacího řízení', true), 'co' => 'prijmaci_rizeni'));
        echo $this->element('companies/table-row', array('label' => __('Další informace', true), 'co' => 'dalsi'));
        echo '<tr>';
            echo '<th>'.__('Zajímají se o studijní obory', true).'</th>';
            echo '<td>';
                foreach($company['Field'] as $field)
                {
                    echo $field['name'].'<br />';
                }
            echo '</td>';
        echo'</tr>';
        echo '<tr>';
            echo '<th>'.__('Věk zaměstnanců', true).'</th>';
            echo '<td>';
                echo '20 - 30 let: '.$company['Company']['vek-20-30'].'<br />';
                echo '30 - 40 let: '.$company['Company']['vek-30-40'].'<br />';
                echo '40 - 50 let: '.$company['Company']['vek-40-50'].'<br />';
                echo '60 - 50 let: '.$company['Company']['vek-50-60'].'<br />';
            echo '</td>';
        echo'</tr>';
        echo '<tr>';
            echo '<th>'.__('Počet zaměstnanců', true).'</th>';
            echo '<td>';
                echo 'loňský rok: '.$company['Company']['zamestnanci-1'].'<br />';
                echo 'rok '.date('Y', strtotime('-2 year')).':'.$company['Company']['zamestnanci-2'].'<br />';
                echo 'rok '.date('Y', strtotime('-3 year')).':'.$company['Company']['zamestnanci-3'].'<br />';
                echo 'rok '.date('Y', strtotime('-4 year')).':'.$company['Company']['zamestnanci-4'].'<br />';
            echo '</td>';
        echo'</tr>';
        echo '<tr>';
            echo '<th>'.__('Kontakt pro studenty', true).'</th>';
            echo '<td>';
                echo 'Jméno: '.$company['StudentKontakt']['jmeno'].'<br />';
                echo 'Příjmení: '.$company['StudentKontakt']['prijmeni'].'<br />';
                echo 'Email: '.$company['StudentKontakt']['email'].'<br />';
                echo 'Telefon: '.$company['StudentKontakt']['tel'].'<br />';
                echo 'Pozice: '.$company['StudentKontakt']['pozice'].'<br />';
            echo '</td>';
        echo'</tr>';
        echo '</table>'
        ?>
</div>
