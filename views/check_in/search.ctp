<div class="check_in inlineform index">
    <!--<div id="message" class="message error">
            <p>Pokud systém po odeslání formuláře najde daného studenta, okamžitě mu přiřadí návštěvu aktuální den!<br>
                <small>Podku má den zakoupený.</small></p>
        </div>-->
    <fieldset>
        <legend>Hledání studentů</legend>

        <div class="threecolumns left">
            <fieldset>
                <legend>Čárový kód</legend>
            <?php
                echo $this->Form->create('CheckIn', array('url' => '/check_in/search'));
                echo $this->Form->input('barcode', array('label' => false));
                echo $this->Form->end(__('Odešli', true));
            ?>
            </fieldset>
        </div>
        <div class="threecolumns left">
            <fieldset>
                <legend>Přihlašovací jméno</legend>
            <?php
                echo $this->Form->create('CheckIn', array('url' => '/check_in/search'));
                echo $this->Form->input('username', array('label' => false));
                echo $this->Form->end(__('Odešli', true));
            ?>
            </fieldset>
        </div>
        <div class="threecolumns left">
            <fieldset>
                <legend>Email</legend>
            <?php
                echo $this->Form->create('CheckIn', array('url' => '/check_in/search'));
                echo $this->Form->input('email', array('label' => false));
                echo $this->Form->end(__('Odešli', true));
            ?>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div>
            <?php
                if(isset($student))
                {
                    if(isset($error) && $error == 'true')
                    {
                        $class = 'bgred';
                    }
                    else
                    {
                        $class = 'bggreen';
                    }
                    echo '<div>';
                    echo '<dl>';
                    echo '<dt>Jméno:</dt>';
                        echo '<dd>'.$student['User']['jmeno'].'</dd>';
                    echo '<dt>Příjmení:</dt>';
                        echo '<dd>'.$student['User']['prijmeni'].'</dd>';
                    echo '<dt>email:</dt>';
                        echo '<dd>'.$student['User']['email'].'</dd>';
                    echo '<dt>Zaplaceno dnů:</dt>';
                        echo '<dd>'.$student['Student']['zaplaceno_dnu'].'</dd>';
                    echo '<dt>První den:</dt>';
                        if($student['Student']['chce_den1'] == 1)
                        {
                            echo '<dd>';
                            echo $this->Html->image('yes.png');
                            echo '</dd>';
                        }
                        else
                        {
                            echo '<dd>';
                            echo $this->Html->image('no.png');
                            echo $this->Form->create('CheckIn', array('url' => '/check_in/dokoupit'));
                            echo $this->Form->hidden('student_id', array('value' => $student['Student']['id']));
                            echo $this->Form->hidden('prvni_den', array('value' => 1));
                            echo $this->Form->end('Koupit první den');
                            echo '</dd>';
                        }
                    echo '<dt>Druhý den:</dt>';
                        if($student['Student']['chce_den2'] == 1)
                        {
                            echo '<dd>';
                            echo $this->Html->image('yes.png');
                            echo '</dd>';
                        }
                        else
                        {
                            echo '<dd>';
                            echo $this->Html->image('no.png');
                            echo $this->Form->create('CheckIn', array('url' => '/check_in/dokoupit'));
                            echo $this->Form->hidden('student_id', array('value' => $student['Student']['id']));
                            echo $this->Form->hidden('druhy_den', array('value' => 1));
                            echo $this->Form->end('Koupit druhý den');
                            echo '</dd>';
                        }
                    echo '<dt>Byl první den:</dt>';
                        if($student['Student']['byl_den1'] == 1)
                        {
                            echo '<dd>';
                            echo $this->Html->image('yes.png');
                            echo '</dd>';
                        }
                        else
                        {
                            echo '<dd>';
                            echo $this->Html->image('no.png');
                            echo '</dd>';
                        }
                    echo '<dt>Byl druhý den:</dt>';
                        if($student['Student']['byl_den2'] == 1)
                        {
                            echo '<dd>';
                            echo $this->Html->image('yes.png');
                            echo '</dd>';
                        }
                        else
                        {
                            echo '<dd>';
                            echo $this->Html->image('no.png');
                            echo '</dd>';
                        }
                    echo '</dl>';
                    echo $this->Html->link('Tiskni', array('controller' => 'check_in', 'action' => 'tisk', $student['Student']['id']));
                    echo ' vstupenku.';
                    echo '</div>';
                }
            ?>
        </div>
    </fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#CheckInBarcode').focus();
});
</script>