<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
    var $components = array('Auth', 'Session', 'RequestHandler'/*, 'DebugKit.Toolbar'*/);
    var $helpers = array('Html', 'Form', 'Menu', 'Session');

    /**
     * beforeFilter
     *
     * Application hook which runs prior to each controller action
     *
     * @access public
     */
    function beforeFilter(){
        //header("pragma: no-cache");
        //header("Cache-Control: no-cache, must-revalidate");
        //header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        //$this->disableCache();
        if (Configure::read('App.maintenance')) {
            if (/*$this->Auth->user('id') !== 1*/!isset($_GET['debug'])) {
                $this->layout = 'student';
                $message = __('Momentálně pro Vás spouštíme registraci tréniknů a setkání. Zkuste to za chvilku znova!', true);
                $this->cakeError('error', array(
                                array( 'code' => '403',
                                       'name' => __('Aplikace vypnutá z důvodu údržby', true),
                                       'message' => $message,
                                       'title' => __('Údržba', true),
                                       'base' => $this->base,
                                       'url' => $this->here)
                                ));
                exit();
            }
        }
        //pr($_SERVER);
        //Override default fields used by Auth component
        $this->Auth->fields = array('username'=>'username','password'=>'password');
        //Set application wide actions which do not require authentication
        //$this->Auth->allow('display');//IMPORTANT for CakePHP 1.2 final release change this to $this->Auth->allow(array('display'));
        if($_SERVER['HTTP_HOST'] == http_host('student'))
        {
            $this->Auth->logoutRedirect = array('controller' => 'students', 'action' => 'index');
        }
        else
        {
            //Set the default redirect for users who logout
            $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        }
        //Set the default redirect for users who login
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'welcomme');
        //Extend auth component to include authorisation via isAuthorized action
        $this->Auth->authorize = 'controller';
        //Restrict access to only users with an active account
        $this->Auth->userScope = array('User.active = 1');
        //Vypíše při nesprávných přihlašovacích údajích
        $this->Auth->loginError = __('Přihlášení se nezdařilo. Zkontrolujte přihlašovací údaje.', true);
        //Vypíše při pokusu o neautorizovaný přístup
        $this->Auth->authError = __('K této části webu nemáte povolen přístup!', true);
        //Element k AJAX loginu
        //TODO: vyzkoušet a blíže prozkoumat
        $this->Auth->ajaxLogin = 'users/login';
        //Pass auth component data over to view files
        $user = $this->Auth->user();
        //pr($user);
        App::import('Model', 'User');
        $User =& new User();
        //$User->set($user);
        if($_SERVER['HTTP_HOST'] == http_host('student'))
        {
            $user = $User->find('first', array(
                    'conditions' => array('User.id' => $user['User']['id']),
                    'contain' => array('Group', 'Student')
            ));
        }
        elseif($_SERVER['HTTP_HOST'] == http_host('firma'))
        {
            $user = $User->find('first', array(
                'conditions' => array('User.id' => $user['User']['id']),
                'contain' => array('Group', 'Company' => array(
                                                'ma_trenink',
                                                'ma_panelovou_diskuzi',
                                                'ma_individual',
                                                'ma_enterpreneurship_day',
                                                'ma_cb_odborny_clanek',
                                                'ma_cb_odborny_clanek',
                                                'ma_materialy_v_baliccich',
                                                'ma_videospot',
                                                'ma_videospot',
                                                'ma_cb_fixni',
                                                'ma_den_1',
                                                'ma_den_2'
                                            )
                            )
            ));
        }
        else
        {
            $user = $User->find('first', array(
                    'conditions' => array('User.id' => $user['User']['id']),
                    'contain' => array('Group')
            ));
            if($user['Group']['name'] == 'company')
            {
                $user = $User->find('first', array(
                'conditions' => array('User.id' => $user['User']['id']),
                'contain' => array('Group', 'Company' => array(
                                                'ma_trenink',
                                                'ma_panelovou_diskuzi',
                                                'ma_individual',
                                                'ma_enterpreneurship_day',
                                                'ma_cb_odborny_clanek',
                                                'ma_cb_odborny_clanek',
                                                'ma_materialy_v_baliccich',
                                                'ma_videospot',
                                                'ma_videospot',
                                                'ma_cb_fixni',
                                                'ma_den_1',
                                                'ma_den_2'
                                            )
                            )
                ));
            }
        }
        //pr($user);
        $this->set('user',$user);
        $this->fetchSettings();
        //FIXME: přidat hlášku při úspěšném přihlášení a neúšpěšném přihlášení
        //pr($this->params);
        //$this->Auth->allowedActions = array('*');
    }

    function fetchSettings(){
       //Loading model on the fly
       App::import('Model', 'Setting');
       $settings = new Setting();
       //Fetching All params
       $settings_array = $settings->find('all');
       foreach($settings_array as $key=>$value){
          Configure::write("__".$value['Setting']['key'], $value['Setting']['pair']);
       }
    }

    /**
     * beforeRender
     *
     * Application hook which runs after each action but, before the view file is
     * rendered
     *
     * @access public
     */
    function beforeRender(){
        //If we have an authorised user logged then pass over an array of controllers
        //to which they have index action permission
        if($this->Auth->user()){
            $controllerList = Configure::listObjects('controller');
            $permittedControllers = array();
            foreach($controllerList as $controllerItem){
                if($controllerItem <> 'App'){
                    if($this->__permitted($controllerItem,'index')){
                        $permittedControllers[] = $controllerItem;
                    }
                }
            }
        }
        //$user = $this->Session->read('User');
        //$role = $this->Session->read('User.role');
        $this->set(compact('permittedControllers'));
    }
    /**
     * isAuthorized
     *
     * Called by Auth component for establishing whether the current authenticated
     * user has authorization to access the current controller:action
     *
     * @return true if authorised/false if not authorized
     * @access public
     */
    function isAuthorized(){
        return $this->__permitted($this->name,$this->action, $this->params);
    }
    /**
     * __permitted
     *
     * Helper function returns true if the currently authenticated user has permission
     * to access the controller:action specified by $controllerName:$actionName
     * @return
     * @param $controllerName Object
     * @param $actionName Object
     */
    function __permitted($controllerName,$actionName,$actionParams = array()){
        //Ensure checks are all made lower case
        $controllerName = low($controllerName);
        $actionName = low($actionName);
        if(isset($actionParams['id']))
        {
            $actionParam = $actionParams['id'];
        }
        //If permissions have not been cached to session...
       // pr($this->Session->check('Permissions'));
        if(!$this->Session->check('Permissions')){
            $permissions = array();
            //everyone gets permission to logout
            $permissions[]='users:logout';
            $permissions[]='users:login';
            $permissions[]='users:welcomme';
            //Import the User Model so we can build up the permission cache
            App::import('Model', 'User');
            $thisUser =& new User;
            //Now bring in the current users full record along with groups
            $thisGroups = $thisUser->find('first',array(
                    'conditions' => array('User.id' => $this->Auth->user('id')),
                    'contain' => array('Group')
                ));
            //$this->Session->write('User', $thisGroups);
            //pr($thisGroups);
            $thisGroup = $thisGroups['Group'];
            //pr($this->Session->read());
            //foreach($thisGroups as $thisGroup){
                //pr($thisGroup);
                $thisPermissions = $thisUser->Group->find('first',array(
                        'conditions' => array('Group.id'=>$thisGroup['id']),
                        'contain' => array('Permission')
                    ));
                //pr($thisPermissions);
                $thisPermissions = $thisPermissions['Permission'];
                //pr($thisPermissions);
                foreach($thisPermissions as $thisPermission){
                    $permissions[]=$thisPermission['name'];
                }
        //}
        //pr($permissions);
        //write the permissions array to session
        $this->Session->write('Permissions',$permissions);
        }else{
            //...they have been cached already, so retrirmaieve them
            $permissions = $this->Session->read('Permissions');
        }
        //Now iterate through permissions for a positive match
//        pr($controllerName);
//        pr($actionName);
//        pr($permissions);
//        pr($controllerName);
        $success = false;

        foreach($permissions as $permission){
            if($permission == '*'){
                $success = true;//Super Admin Bypass Found
                break;
            }
            if($permission == $controllerName.':*'){
                $success = true;//Controller Wide Bypass Found
                break;
            }
            if($permission == $controllerName.':'.$actionName){
                $success =  true;//Specific permission found
                break;
            }
            if(isset($actionParam) && $permission == $controllerName.':'.$actionName.':'.$actionParam)
            {
                $success =  true;
                break;
            }
        }
        return $success;
    }

}
