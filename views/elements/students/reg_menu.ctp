<div id="regmenu">
    <ul>
        <?php
        //ty dvě url za sebou NEjsou chyba
        if($this->params['url']['url'] == 'zaregistruj_se' || $this->params['url']['url'] == 'platba/mobil' || 	$this->params['url']['url'] == 'registrace')
        {
            echo '<li>'.$this->Html->link(__('1. Zaregistruj se', true), array('controller' => 'students', 'action' => 'zaregistruj_se'), array('class' => 'active')).'</li>';
        }
        else
        {
            if(!empty($user))
            {
                echo '<li>'.$this->Html->link(__('1. Zaregistruj se', true).' '.$this->Html->image('notification_done-small.png'), '#', array('escape' => false)).'</li>';
            }
            else
            {
                echo '<li>'.$this->Html->link(__('1. Zaregistruj se', true), array('controller' => 'students', 'action' => 'zaregistruj_se')).'</li>';
            }
        }

        if($this->params['url']['url'] == 'priprav_se')
        {
            echo '<li>'.$this->Html->link(__('2. Připrav se', true), array('controller' => 'students', 'action' => 'priprav_se'), array('class' => 'active')).'</li>';
        }
        else
        {
            echo '<li>'.$this->Html->link(__('2. Připrav se', true), array('controller' => 'students', 'action' => 'priprav_se')).'</li>';
        }

        if($this->params['url']['url'] == 'prijed')
        {
            echo '<li>'.$this->Html->link(__('3. Přijeď', true), array('controller' => 'students', 'action' => 'prijed'), array('class' => 'active')).'</li>';
        }
        else
        {
            echo '<li>'.$this->Html->link(__('3. Přijeď', true), array('controller' => 'students', 'action' => 'prijed')).'</li>';
        }
        ?>
    </ul>
</div>