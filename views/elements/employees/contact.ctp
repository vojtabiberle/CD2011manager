<?php
echo '<fieldset> <legend>'.$nadpis.'</legend>';
echo $this->Form->input($model.'.jmeno');
echo $this->Form->input($model.'.prijmeni');
echo $this->Form->input($model.'.email');
echo $this->Form->input($model.'.tel');
echo $this->Form->input($model.'.pozice');
echo '</fieldset>';
?>