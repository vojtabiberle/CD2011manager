<?php
class MenuHelper extends AppHelper
{
    var $helpers = array('Html');

    function show($user)
    {
        $out = '<h3>'.__('Menu', true).'</h3>';
        //pr($user);
        $out .= '<ul>';
        if(empty($user))
        {
            return '<ul></ul>';
        }
        switch($user['Group']['name'])
        {
            case 'admin':
                    $out .= $this->link(__('Studenti', true), array('controller' => 'students', 'action' => 'index'));
                    $out .= $this->link(__('Firmy', true), array('controller' => 'companies', 'action' => 'index'));
                    $out .= $this->link(__('Panelové diskuze', true), array('controller' => 'panel_discussions', 'action' => 'index'));
                    $out .= $this->link(__('Tréninky', true), array('controller' => 'trainings', 'action' => 'index'));
                    $out .= $this->link(__('Real čísla', true), array('controller' => 'students', 'action' => 'realcounter'));
                    $out .= $this->hr();
                    $out .= $this->link(__('Uživatelé', true), array('controller' => 'users', 'action' => 'index'));
                    $out .= $this->link(__('Skupiny', true), array('controller' => 'groups', 'action' => 'index'));
                    $out .= $this->link(__('Generování kodů', true), array('controller' => 'sms', 'action' => 'generate', 'AIESEC'));
                    $out .= $this->link(__('Místnosti', true), array('controller' => 'rooms', 'action' => 'index'));
                    $out .= $this->link(__('Přířazení místností a firem', true), array('controller' => 'rooms', 'action' => 'company_asign'));
                    $out .= $this->link(__('Práva', true), array('controller' => 'permissions', 'action' => 'index'));
                    $out .= $this->link(__('Stránky', true), array('controller' => 'pages', 'action' => 'index'));
                    $out .= $this->link(__('Nastavení', true), array('controller' => 'settings', 'action' => 'index'));
                    $out .= $this->hr();
                    $out .= $this->link(__('Chat', true), array('controller' => 'chat', 'action' => 'index'));
                break;
            case 'hostess':
                    $out .= $this->link(__('Změna místa', true), array('controller' => 'hostess', 'action' => 'index'));
                    $out .= $this->link(__('Firma', true), array('controller' => 'hostess', 'action' => 'firma'));
                    $out .= $this->link(__('Setkání/Tréninky', true), array('controller' => 'hostess', 'action' => 'setkani'));
                    //$out .= $this->link(__('Vyhledat studenta', true), array('controller' => 'hostess', 'action' => 'search'));
                    $out .= $this->hr();
                    $out .= $this->link(__('Chat', true), array('controller' => 'chat', 'action' => 'index'));
                break;
            case 'check-in':
                    $out .= $this->link(__('Check-In', true), array('controller' => 'check_in', 'action' => 'index'));
                    $out .= $this->link(__('Dokoupit den', true), array('controller' => 'check_in', 'action' => 'dokoupit'));
                    $out .= $this->link(__('Registrace s SMS', true), array('controller' => 'check_in', 'action' => 'smsreg'));
                    $out .= $this->link(__('Koupit lístek', true), array('controller' => 'check_in', 'action' => 'koupit'));
                    $out .= $this->link(__('Najdi studenta', true), array('controller' => 'check_in', 'action' => 'search'));
                    $out .= $this->hr();
                    $out .= $this->link(__('Chat', true), array('controller' => 'chat', 'action' => 'index'));
                break;
            case 'artax':
                    $out .= $this->link(__('Firmy', true), array('controller' => 'companies', 'action' => 'artax'));
                break;
            case 'student':
                    $out .= $this->link(__('Úvod', true), array('controller' => 'students', 'action' => 'index'));
                    $out .= $this->link(__('Tvůj profil', true), array('controller' => 'students', 'action' => 'profil'));
                    $out .= $this->link(__('Firmy', true), array('controller' => 'companies', 'action' => 'student_index'));
                break;
            case 'company':
                    $out .= $this->link(__('Úvod', true), array('controller' => 'pages', 'action' => 'display', 'company_welcomme'));
                    $out .= $this->link(__('Údaje o firmě', true), array('controller' => 'companies', 'action' => 'own_view'));
                    $out .= $this->link(__('Loga firmy', true), array('controller' => 'companies', 'action' => 'upload_logo'));
                    $out .= $this->link(__('Schválit údaje', true), array('controller' => 'companies', 'action'=> 'done'));
                    $out .= $this->link(__('Požadavky od CD týmu', true), array('controller' => 'companies', 'action' => 'requirements'));
                    if(isset($user['Company']) && $user['Company'][0]['ma_panelovou_diskuzi'])
                    {
                        $out .= $this->link(__('Panelové diskuze', true), array('controller' => 'panel_discussions', 'action' => 'company_register'));
                    }
                   /* $out .= $this->link(__('Career Days Brožura', true), array('controller' => 'cdbrochures', 'action' => 'own_view'));
                    $out .= $this->link(__('Lidé ve firmě', true), array('controller' => 'employees', 'action' => 'own_view'));*/
                    if(isset($user['Company']) && ($user['Company'][0]['ma_individual'] || $user['Company'][0]['ma_den_1'] || $user['Company'][0]['ma_den_2']))
                    {
                        $out .= $this->link(__('Setkání se studenty', true), array('controller' => 'meetings', 'action' => 'index'));
                        $out .= $this->link(__('Studenti na setkáních', true), array('controller' => 'meetings', 'action' => 'show_students'));
                    }
                    if(isset($user['Company']) && $user['Company'][0]['ma_trenink'])
                        $out .= $this->link(__('Tréninky', true), array('controller' => 'trainings', 'action' => 'company_index'));
                break;
        }
        $out .= $this->hr();
        $out .= $this->link(__('Odhlásit se', true), array('controller' => 'users', 'action' => 'logout'), array(), __('Opravdu se chcete odhlásit?',true));
        $out .= '</ul>';
        return $out;
    }

    function link($name, $url, $options = array(), $confirmMessage = false)
    {
        return '<li>'.$this->Html->link($name, $url, $options, $confirmMessage).'</li>';
    }

    function hr()
    {
        return '<li><hr /></li>';
    }

}
?>