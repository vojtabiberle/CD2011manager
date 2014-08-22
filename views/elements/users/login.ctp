<?php
echo '<fieldset> <legend>'.__('Přihlášení', true).'</legend>';
$this->Session->flash('auth');
echo $this->Form->create('User', array('action' => 'login'));
/*echo $this->Form->inputs(array(
'legend' => __('Přihlášení', true),
'email',
'password'
));*/

echo $this->Form->input('username', array('label' => __('Jméno', true)));
echo $this->Form->input('password', array('label' => __('Heslo', true)));

echo $this->Form->end(__('Přihlaš', true));
echo '</fieldset>';
?>