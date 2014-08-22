<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	//var $helpers = array('Html');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();

        function admin_welcomme()
        {
            $user = $this->Auth->user();
            $this->loadModel('User');
            $this->User->set($this->Auth->user());
            $user = $this->User->read();
            //pr($user);
            if($user['Group']['name'] != 'admin')
            {
                $this->redirect($user['Group']['after_login_redirect']);
            }
        }

        function artax_welcomme()
        {
            $user = $this->Auth->user();
            $this->loadModel('User');
            $this->User->set($this->Auth->user());
            $user = $this->User->read();
            //pr($user);
            if($user['Group']['name'] != 'artax')
            {
                $this->redirect($user['Group']['after_login_redirect']);
            }
        }

        function company_welcomme()
        {
            $user = $this->Auth->user();
            $this->loadModel('User');
            $this->User->set($this->Auth->user());
            $user = $this->User->read();
            //pr($user);
            if($user['Group']['name'] != 'company')
            {
                $this->redirect($user['Group']['after_login_redirect']);
            }
        }

//        function hostess_welcomme()
//        {
//            $user = $this->Auth->user();
//            $this->loadModel('User');
//            $this->User->set($this->Auth->user());
//            $user = $this->User->read();
//            //pr($user);
//            if($user['Group']['name'] != 'hostess')
//            {
//                $this->redirect($user['Group']['after_login_redirect']);
//            }
//        }

//        function checkin_welcomme()
//        {
//            $user = $this->Auth->user();
//            $this->loadModel('User');
//            $this->User->set($this->Auth->user());
//            $user = $this->User->read();
//            //pr($user);
//            if($user['Group']['name'] != 'check-in')
//            {
//                $this->redirect($user['Group']['after_login_redirect']);
//            }
//        }

//        function student_welcomme()
//        {
//            $user = $this->Auth->user();
//            $this->loadModel('User');
//            $this->User->set($this->Auth->user());
//            $user = $this->User->read();
//            //pr($user);
//            if($user['Group']['name'] != 'student')
//            {
//                $this->redirect($user['Group']['after_login_redirect']);
//            }
//        }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));

                //$this->requestAction(array('controller' => 'users', 'action' => 'after_login'));
	}
}
