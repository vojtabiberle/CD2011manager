<div class="students profil">
    <div class="left twocolumns">
<fieldset>
<legend>Úprava profilu</legend>
<dl>
<dt>Jméno a přijmení:</dt>
<dd><?php echo $student['User']['jmeno'].' '.$student['User']['prijmeni']; ?></dd>
<dt>Email:</dt>
<dd><?php echo $student['User']['email']; ?></dd>
<dt>Univerzita:</dt>
<dd><?php echo $student['School']['nazev'];?></dd>
<dt>Studijní obor:</dt>
<dd><?php echo $student['School']['nazev_studijniho_oboru']; ?></dd>
<dt>Zaplaceno dnů:</dt>
<dd><?php echo $student['Student']['zaplaceno_dnu'];?></dd>
<dt>Životopis:</dt>
<dd id="zivotopis">
<?php
if(empty($student['Student']['zivotopis']))
{
    echo 'Životopis nenahrán.';
}
else
{
    echo $this->Html->link($student['Student']['zivotopis'], '/files/cv/'.$student['User']['id'].'/'.$student['Student']['zivotopis']);
}
?>
</dd>
</dl>
<fieldset class="inside" id="password">
<legend><a href="">Heslo</a></legend>
<small>Pro změnu hesla klikni na popisek.</small>
<?php
    echo $this->Form->create('Student', array('url' => '/heslo', 'id' => 'StudentPasswordForm'));
    echo '<div id="passwordMessage"></div>';
    echo $this->Form->input('oldPassword', array('label' => 'Staré heslo:', 'type' => 'password'));
    echo $this->Form->input('newPassword', array('label' => 'Nové heslo:', 'type' => 'password'));
    echo $this->Form->input('newPasswordCheck', array('label' => 'Nové heslo znovu:', 'type' => 'password'));
    echo $this->Form->end('Změň');
?>
</fieldset>

<fieldset class="inside" id="cv">
<legend><a href="">Životopis</a></legend>
<small>Pro nahrání životopisu klikni na popisek.</small>
<?php
    echo $this->Form->create('Student', array('type' => 'file', 'url' => 'upload_cv', 'id' => 'StudentCvForm'));
    echo '<div id="cvMessage"></div>';
    echo $this->Form->file('cv', array('label' => 'Životopis:'));
    echo '<small>Pokud nahraješ nový životopis, starý se automaticky smaže.</small>';
    echo $this->Form->end('Nahraj');
?>
</fieldset>

</fieldset>
    </div>
    <div class="right twocolumns">
        <fieldset>
            <legend>Tvůj program na Career Days</legend>
            <?php echo $this->element('students/agenda'); ?>
        </fieldset>
    </div>

<?php
    $this->Html->script('jquery.form', array('inline' => false));
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#StudentPasswordForm').hide();
        $('#password legend a').click(function(){
            $('#StudentPasswordForm').toggle();
            $('#password>small').toggle();
            return false;
        });

        $('#StudentCvForm').hide();
        $('#cv legend a').click(function(){
            $('#StudentCvForm').toggle();
            $('#cv>small').toggle();
            return false;
        });

        $('#passwordMessage').hide();
        $('#StudentPasswordForm').ajaxForm({
            target: '#passwordMessage',
            success: function()
            {
                $('#passwordMessage').fadeIn().fadeOut(3000);
                $('#StudentPasswordForm input[type="password"]').attr('value','');
            }
        });

        $('#cvMessage').hide();
        $('#StudentCvForm').ajaxForm({
            target: '#cvMessage',
            success: function()
            {
                $('#cvMessage').fadeIn().fadeOut(3000);
                $.get('/students/get_cv',function(data){
                    $('#zivotopis').html('<a href="/files/cv/<?php echo $student['User']['id']?>/' + data + '">' + data + '</a>');
                });
            }
        });

    });
</script>
</div>