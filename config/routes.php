<?php
/**
 * Routes Configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */

        if($_SERVER['HTTP_HOST'] == http_host('student'))
        {
            //echo 'adsf';
            //$this->Auth->allowedActions = array('*');
            Router::connect('/', array('controller' => 'students'));
            Router::connect('/platba/*', array('controller' => 'students', 'action' => 'pay'));
            Router::connect('/registrace', array('controller' => 'students', 'action' => 'register'));
            Router::connect('/profil', array('controller' => 'students', 'action' => 'profil'));
            Router::connect('/firmy', array('controller' => 'companies', 'action' => 'student_index'));
            Router::connect('/firma/detail/*', array('controller' => 'companies', 'action' => 'student_view'));
            Router::connect('/setkani', array('controller' => 'meetings', 'action' => 'student_index'));
            Router::connect('/treninky', array('controller' => 'trainings', 'action' => 'student_index'));
            Router::connect('/doprovodny_program', array('controller' => 'panel_discussions', 'action' => 'student_index'));
            Router::connect('/heslo', array('controller' => 'students', 'action' => 'password'));
            Router::connect('/zaregistruj_se', array('controller' => 'students', 'action' => 'zaregistruj_se'));
            Router::connect('/priprav_se', array('controller' => 'students', 'action' => 'priprav_se'));
            Router::connect('/prijed', array('controller' => 'students', 'action' => 'prijed'));
            Router::connect('/cisla', array('controller' => 'students', 'action' => 'counter'));
            Router::connect('/agenda', array('controller' => 'students', 'action' => 'agenda'));
            Router::connect('/tisk', array('controller' => 'students', 'action' => 'tisk'));
            Router::connect('/vstupenka', array('controller' => 'students', 'action' => 'vstupenka'));
            //$this->redirect('/students');
        }
        else
        {
            Router::connect('/', array('controller' => 'pages', 'action' => 'admin_welcomme'));
        }
        Router::connect('/sms/recieve', array('controller' => 'smsses', 'action' => 'recieve'));

        Router::connect('/sms', array('controller' => 'smsses', 'action' => 'index'));
        Router::connect('/sms/generate/*', array('controller' => 'smsses', 'action' => 'generate'));
        Router::connect('/sms/index_not_used', array('controller' => 'smsses', 'action' => 'index_not_used'));
        Router::connect('/sms/index_aiesec', array('controller' => 'smsses', 'action' => 'index_aiesec'));
        Router::connect('/sms/index_aiesec_not_used', array('controller' => 'smsses', 'action' => 'index_aiesec_not_used'));


        Router::connect('/artax', array('controller' => 'pages', 'action' => 'artax_welcomme'));
        Router::connect('/firma/uvod', array('controller' => 'pages', 'action' => 'company_welcomme'));

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));


/**
 *  Login and Logout
 */
        Router::connect('/prihlaseni', array('controller' => 'users', 'action' => 'login'));
        Router::connect('/odhlaseni', array('controller' => 'users', 'action' => 'logout'));

/**
 * Firmy
 */
        Router::connect('/firma', array('controller' => 'companies', 'action' => 'own_view'));
        Router::connect('/firma/done', array('controller' => 'companies', 'action' => 'done'));
        Router::connect('/lide', array('controller' => 'employees', 'action' => 'own_view'));
        Router::connect('/setkani/*', array('controller' => 'meetings'));
        Router::connect('/treninky', array('controller' => 'trainings', 'action' => 'company_index'));
        Router::connect('/treninky/registrovat/*', array('controller' => 'trainings', 'action' => 'company_register'));
        Router::connect('/treninky/upravit/*', array('controller' => 'trainings', 'action' => 'company_edit'));
        Router::connect('/treninky/odregistrovat/*', array('controller' => 'trainings', 'action' => 'company_unregister'));
        Router::connect('/panelove_diskuze', array('controller' => 'panel_discussions', 'action' => 'company_register'));

        