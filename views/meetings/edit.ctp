<div class="meetings form">
<?php echo $this->Form->create('Meeting');?>
	<fieldset>
 		<legend><?php __('Úprava setkání se studenty'); ?></legend>
	<?php
        if(count($company['Meetings']) != 0)
        {
            foreach($company['Meetings'] as $meeting)
            {
                echo '<textarea style="display:none;" id="'.$meeting['id'].'-popis">'.$meeting['popis'].'</textarea>';
                echo '<textarea style="display:none;" id="'.$meeting['id'].'-pozadavky">'.$meeting['pozadavky'].'</textarea>';
                echo '<input type="hidden" id="'.$meeting['id'].'-studentu" value="'.$meeting['max_pocet_ucastniku'].'">';
            }
            echo '<input type="button" id="kopirovac" value="Kopírovat"> údaje ze setkání začínajícího v ';
            echo '<select id="pomahac">';
                foreach($company['Meetings'] as $meeting)
                {
                    echo '<option value="'.$meeting['id'].'">'.rmSecond($meeting['zacatek']).'</option>';
                }
            echo '</select>';
            echo ' <small>Stávající údaje budou z formuláře smazány.</small>';
        }
		echo $this->Form->input('id');
		
		echo $this->Form->input('popis', array('label' => __('Popis setkání pro studenty', true), 'class' => 'jwysiwyg'));
		echo $this->Form->input('pozadavky', array('label' => __('Popis studentů, jaké si na setkání přejete', true), 'class' => 'jwysiwyg'));

		echo $this->Form->input('max_pocet_ucastniku', array('label' => __('Maximální počet studentů na setkání (max. 30)', true)));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Ulož', true));
$this->Html->script('jwysiwyg/jquery.wysiwyg', array('inline' => false));
$this->Html->css('jwysiwyg/jquery.wysiwyg', null, array('inline' => false));
    $this->Html->css('jwysiwyg/jquery.wysiwyg.modal', null, array('inline' => false));
?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.jwysiwyg').wysiwyg({
            initialContent: '',
            autoGrow: true
        });

        $('#kopirovac').click(function(){
            var id = $('#pomahac').val();
            var popis = $('#'+id+'-popis').val();
            var pozadavky = $('#'+id+'-pozadavky').val();
            var studentu = $('#'+id+'-studentu').val();

            $('#MeetingPopis.jwysiwyg').wysiwyg('clear');
            $('#MeetingPopis.jwysiwyg').wysiwyg('insertHtml', popis);
            $('#MeetingPopis').val(popis);

            $('#MeetingPozadavky.jwysiwyg').wysiwyg('clear');
            $('#MeetingPozadavky.jwysiwyg').wysiwyg('insertHtml', pozadavky);
            $('#MeetingPozadavky').val(pozadavky);

            $('#MeetingMaxPocetUcastniku').val(studentu);
        });
    });
</script>