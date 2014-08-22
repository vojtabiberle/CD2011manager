<div class="check_in inlineform index">
    <!--<div id="message" class="message error">
            <p>Pokud systém po odeslání formuláře najde daného studenta, okamžitě mu přiřadí návštěvu aktuální den!<br>
                <small>Podku má den zakoupený.</small></p>
        </div>-->
    <fieldset>
        <legend>Check-in studentů</legend>
        
        <div class="threecolumns left">
            <fieldset>
                <legend>Čárový kód</legend>
            <?php
                echo $this->Form->create('CheckIn', array('url' => '/check_in/index'));
                echo $this->Form->input('barcode', array('label' => false));
                echo $this->Form->end(__('Odešli', true));
            ?>
            </fieldset>
        </div>
        <div class="threecolumns left">
            <fieldset>
                <legend>Přihlašovací jméno</legend>
            <?php
                echo $this->Form->create('CheckIn', array('url' => '/check_in/index'));
                echo $this->Form->input('username', array('label' => false));
                echo $this->Form->end(__('Odešli', true));
            ?>
            </fieldset>
        </div>
        <div class="threecolumns left">
            <fieldset>
                <legend>Email</legend>
            <?php
                echo $this->Form->create('CheckIn', array('url' => '/check_in/index'));
                echo $this->Form->input('email', array('label' => false));
                echo $this->Form->end(__('Odešli', true));
            ?>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div>
            <?php
            if(isset($key) && $key[0]['smsses']['kw'] == 'AIESEC')
            {
                echo '<div class="message warning">Tento kód byl vydán zdarma!</div>';
            }
            //pr($key);
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
                    echo '<div class='.$class.'>';
                    echo '<dl>';
                    echo '<dt>Jméno:</dt>';
                        echo '<dd>'.$student['User']['jmeno'].'</dd>';
                    echo '<dt>Příjmení:</dt>';
                        echo '<dd>'.$student['User']['prijmeni'].'</dd>';
                    echo '<dt>email:</dt>';
                        echo '<dd>'.$student['User']['email'].'</dd>';
                    echo '<dt>Zaplaceno dnů:</dt>';
                        echo '<dd>'.$student['Student']['zaplaceno_dnu'].'</dd>';
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