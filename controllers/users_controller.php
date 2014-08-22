<?php
class UsersController extends AppController {

	var $name = 'Users';
        var $scaffold;

        function switch_role()
        {
            //pr($this->data);
            //$this->Session->write('User.role', $this->data['User']['role']);
            //$this->redirect('/');
        }

        function login()
        {
            if($_SERVER['HTTP_HOST'] == http_host('student'))
            {
                $this->layout = 'student';
//                $this->Session->setFlash('Neplatné heslo nebo uživatelské jméno.', 'flash_error');
//                $this->redirect('/');
            }

            $this->set('title_for_layout', __('Přihlášení', true));
            if ($this->Session->read('Auth.User')) {
		$this->Session->setFlash(__('Již jsi přihlášen!', true));
                $this->User->set($this->Auth->user());
                $user = $this->User->read();
                //$this->redirect($user['Group']['after_login_redirect']);
            }
	}

        function welcomme()
        {
            $this->autoRender = false;
            $this->User->set($this->Auth->user());
            $user = $this->User->read();
            //pr($user);
            //exit;
            //pr($this->data);
            $this->redirect($user['Group']['after_login_redirect']);
            exit;
        }

        function logout()
        {
            //$this->Session->delete('User.role');
            $this->Session->delete('Permissions');
            $this->Session->delete('User');
            $this->Session->delete('permissions');
            $this->Session->delete('user');
            
            if(http_host('student') == $_SERVER['HTTP_HOST'])
            {
                $this->Session->setFlash(__('Byl(a) jsi odhlášen(a).', true));
            }
            else
            {

                $this->Session->setFlash(__('Byl(a) jste odhlášen(a).', true));
            }
            $this->redirect($this->Auth->logout());
        }

        /*function __checkCompany($user)
        {
            App::import('Model', 'Company');
            $Company =& new Company();
            $res = $Company->find('first',array(
                'conditions' => array('Company.group_id' => $user['Group']['id']),
                'fields' => array('Company.id')
            ));
            return empty($res);
        }*/
}
?>