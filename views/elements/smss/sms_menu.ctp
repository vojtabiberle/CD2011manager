<fieldset id="submenu">
    <legend>Menu</legend>
    <div>
        <?php
            echo $this->Html->link(__('Výpis kódů', true), array('controller' => 'smsses', 'action' => 'index'));
            echo ' | ';
            echo $this->Html->link(__('Výpis nepoužitých kódů', true), array('controller' => 'smsses', 'action' => 'index_not_used'));
            echo ' | ';
            echo $this->Html->link(__('Generování kódů pro AIESEC', true), array('controller' => 'smsses', 'action' => 'generate', 'AIESEC'));
            echo ' | ';
            echo $this->Html->link(__('Výpis použitých kódů pro AIESEC', true), array('controller' => 'smsses', 'action' => 'index_aiesec'));
            echo ' | ';
            echo $this->Html->link(__('Výpis nepoužitých kódů pro AIESEC', true), array('controller' => 'smsses', 'action' => 'index_aiesec_not_used'));
        ?>
    </div>
</fieldset>

<?php
    $this->Html->script('jquery.form', array('inline' => false));
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#submenu div').hide();
        $('#submenu').mouseover(function(){
            $('#submenu div').show();
        });
        $('#submenu').mouseout(function(){
            $('#submenu div').hide();
        });

    });
</script>