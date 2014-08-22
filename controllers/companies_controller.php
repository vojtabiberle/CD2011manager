<?php
class CompaniesController extends AppController {

	var $name = 'Companies';
        var $components = array('RequestHandler');

        var $paginate = array(
                        'limit' => 50,
                        'order' => array(
                            'Company.name' => 'asc'
                        )
        );

        function  beforeFilter()
        {
            $this->Auth->allowedActions = array('student_index', 'student_view');
            parent::beforeFilter();
        }

        function requirements()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));
            if(!empty($this->data))
            {//uložení
                if($this->Company->save($this->data))
                {
                    $this->Session->setFlash(__('Požadavky byly uloženy', true));
                    $company['Company']['pozadavky_od_cd_teamu'] = $this->data['Company']['pozadavky_od_cd_teamu'];
                }
                else
                {
                    $this->Session->setFlash(__('Požadavky se bohužel nepodařilo uložit', true));
                }
            }

            $this->data = $company;
        }

        function student_index()
        {
            $this->layout = 'student';
            $companies = $this->Company->find('all',array(
                        'conditions' => array('OR' =>
                            array('ma_den_1' => 1, 'ma_den_2' => 1),
                        ),
                        'order' => array(
                            'Company.name' => 'asc'
                        )
                    )
                );
            $this->set('companies', $companies);
            $this->set('title_for_layout', __('Firmy', true));
            $this->set('zobraz_menu', true);
        }

        function student_view($id = null)
        {
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
            }
            else
            {
                $this->layout = 'student';
            }
            if (!$id) {
                    $this->Session->setFlash(__('Neexistující firma', true));
                    $this->redirect(array('action' => 'index'));
            }
            $this->set('company', $this->Company->read(null, $id));
            $this->set('title_for_layout', __('Firma', true));
            $this->set('zobraz_menu', true);
        }

        function own_view()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));

            if (empty($this->data)) {
			$this->data = $this->Company->read(null, $company['Company']['id']);
		}
            //$Cdkontakt = $this->Company->Employee->find('list');
            //$Studentkontakt = $this->Company->Employee->find('list');
                $fields = $this->Company->Field->find('list');
                
            $this->set(compact('company', 'fields'));
        }

        function done($status = false)
        {
            if($status == true)
            {
                $user = $this->Auth->user();
                $company = $this->Company->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
                ));
                $this->Company->id = $company['Company']['id'];
                $this->Company->saveField('schvaleno_firmou', '1');
                $this->Session->setFlash(__('Údaje schváleny', true));
                $this->redirect(array('controller' => 'companies', 'action' => 'own_view'));
            }
        }

        function obor_zajmu()
        {
            $this->layout = 'ajax';

            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));

            //return pr($this->params);

            foreach($this->params['form'] as $key => $val)
            {
                list($model, $key) = explode('_',$key);
            }

            echo $val;

            if($val == 'true')
            {
                $this->loadModel('CompaniesField');
                //$this->CompaniesField->create();
                //$this->CompaniesField->save(array('CompaniesField' => array('company_id' => $company['Company']['id'], 'field_id' => $key)));
                $this->CompaniesField->query('insert into companies_fields (company_id, field_id) values('.$company['Company']['id'].','.$key.')');
            }
            elseif($val == 'false')
            {
                //pr($company);
                $this->loadModel('CompaniesField');
                //$this->CompaniesField()->deleteAll(array('company_id' => $company['Company']['id'], 'field_id' => $key));
                $this->CompaniesField->query('delete from companies_fields where company_id = '.$company['Company']['id'].' and field_id = '.$key);
            }
            return array('success' => true);
            
        }

        function save_snipet()
        {
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
                $this->autoRender = false;
                $user = $this->Auth->user();
                $company = $this->Company->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    //'contain' => array('User', 'Emplyee', 'Field')
                ));
    //            [form] => Array
    //            (
    //                [value] => dsafasdfasfd
    //                [id] => Company.ZamestnanciRizeni
    //            )
                //pr($this->params);
                //App::import('Core', 'sanitize');
                //$value = Sanitize::clean($this->params['form']['value']);
                $value = $this->params['form']['value'];
                list($model, $field) = explode('.', $this->params['form']['id']);
                //pr($this->params);
                $field = strtolower($field);
                switch($model)
                {
                    case 'Company':
                            $this->Company->id = $company['Company']['id'];
                            $this->Company->saveField($field, $value);
                            return $value;
                        break;
                    case 'CdKontakt':
                            if($company['Company']['cd_kontakt_id'] == null)
                            { //není kontakt, uděláme
                                $this->LoadModel('Employee');
                                $this->Employee->create();
                                $this->Employee->saveField($field, $value);
                                $this->Company->saveField('cd_kontakt_id', $this->Employee->getLastInsertId());
                                return $value;
                            }
                            else
                            { //je kontakt, upravíme
                                $this->LoadModel('Employee');
                                $this->Employee->id = $company['Company']['cd_kontakt_id'];
                                $this->Employee->saveField($field, $value);
                                return $value;
                            }
                        break;
                    case 'StudentKontakt':
                            if($company['Company']['student_kontakt_id'] == null)
                            { //není kontakt, uděláme
                                $this->LoadModel('Employee');
                                $this->Employee->create();
                                $this->Employee->saveField($field, $value);
                                $this->Company->saveField('student_kontakt_id', $this->Employee->getLastInsertId());
                                return $value;
                            }
                            else
                            { //je kontakt, upravíme
                                $this->LoadModel('Employee');
                                $this->Employee->id = $company['Company']['student_kontakt_id'];
                                $this->Employee->saveField($field, $value);
                                return $value;
                            }
                        break;
                    case 'CbKontakt':
                            if($company['Company']['cb_kontakt_id'] == null)
                            { //není kontakt, uděláme
                                $this->LoadModel('Employee');
                                $this->Employee->create();
                                $this->Employee->saveField($field, $value);
                                $this->Company->saveField('cb_kontakt_id', $this->Employee->getLastInsertId());
                                return $value;
                            }
                            else
                            { //je kontakt, upravíme
                                $this->LoadModel('Employee');
                                $this->Employee->id = $company['Company']['cb_kontakt_id'];
                                $this->Employee->saveField($field, $value);
                                return $value;
                            }
                        break;
                }

                //TODO:log error a nějakou lepší hlášku
                //pr($this->params);
                return 'Error.';
            }
        }

        function upload_logo()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));

            if(isset($_GET['file_upload']))
            {
                $this->layout = 'ajax';
                $this->autoRender = false;

                App::import('vendor', 'fileuploader');
                if(isset($_GET['web_image']))
                {
                    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
                    // max file size in bytes
                    $sizeLimit = 7 * 1024 * 1024;

                    $path = WWW_ROOT.'img'.DS.'uploads'.DS.'companies'.DS.$company['Company']['id'].DS;

                    if(!is_dir($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                    $result = $uploader->handleUpload($path);

                    if($company['Company']['web_logo'] != null)
                    { // uklízíme po sobě
                        unlink(WWW_ROOT.$company['Company']['web_logo']);
                    }

                    $this->Company->id = $company['Company']['id'];
                    $this->Company->saveField('web_logo', DS.str_replace(WWW_ROOT,'',$result['full_path']));
                    // to pass data through iframe you will need to encode all html tags
                    return htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                }
                if(isset($_GET['hi_image']))
                {
                    $allowedExtensions = array();
                    // max file size in bytes
                    $sizeLimit = 7 * 1024 * 1024;

                    $path = WWW_ROOT.'img'.DS.'uploads'.DS.'companies'.DS.$company['Company']['id'].DS;

                    if(!is_dir($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                    $result = $uploader->handleUpload($path);

                    if($company['Company']['hi_logo'] != null)
                    { // uklízíme po sobě
                        unlink(WWW_ROOT.$company['Company']['hi_logo']);
                    }

                    $this->Company->id = $company['Company']['id'];
                    $this->Company->saveField('hi_logo', DS.str_replace(WWW_ROOT,'',$result['full_path']));
                    // to pass data through iframe you will need to encode all html tags
                    return htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                }
            }
            
            $this->set(compact('company'));
        }

        function get_web_image()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $this->layout = 'ajax';
            $this->set('image', $company['Company']['web_logo']);
        }

        function del_web_image()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $this->Company->id = $company['Company']['id'];
            $this->Company->saveField('web_logo', null);
            if($company['Company']['web_logo'] != null)
                { // uklízíme po sobě
                    unlink(WWW_ROOT.$company['Company']['web_logo']);
                }
            $this->layout = 'ajax';
        }

        
        function get_hi_image()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $this->layout = 'ajax';
            $this->set('image', $company['Company']['hi_logo']);
        }

        function del_hi_image()
        {
            $user = $this->Auth->user();
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $this->Company->id = $company['Company']['id'];
            $this->Company->saveField('hi_logo', null);
            if($company['Company']['hi_logo'] != null)
                { // uklízíme po sobě
                    unlink(WWW_ROOT.$company['Company']['hi_logo']);
                }
            $this->layout = 'ajax';
        }

        function artax()
        {
            $this->Company->recursive = 0;
            $this->paginate = array(
                        'conditions' => array('OR' =>
                            array('ma_cb_fixni' => 1, 'ma_cb_kreativni' => 1),
                        ),
                        'limit' => 50,
                        'order' => array(
                            'Company.name' => 'asc'
                        )
            );
            $this->set('companies', $this->paginate());
        }

        function artax_view($id = null)
        {
            if (!$id) {
                    $this->Session->setFlash(__('Neexistující firma', true));
                    $this->redirect(array('action' => 'index'));
            }
            $this->set('company', $this->Company->read(null, $id));
        }

        function allow_edit($id = null)
        {
            $this->autoRender = false;
            if(!$id)
            {
                $this->Session->setFlash(__('Neexistující firma', true));
                $this->redirect($this->referer());
            }
            $this->Company->id = $this->Company->read('id', $id);
            $this->Company->saveField('schvaleno_firmou', 0);
            $this->redirect($this->referer());
        }

        function deny_edit($id = null)
        {
            $this->autoRender = false;
            if(!$id)
            {
                $this->Session->setFlash(__('Neexistující firma', true));
                $this->redirect($this->referer());
            }
            $this->Company->id = $this->Company->read('id', $id);
            $this->Company->saveField('schvaleno_firmou', 1);
            $this->redirect($this->referer());
        }

	function index() {
		$this->Company->recursive = 0;
		$this->set('companies', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Neexistující firma', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('company', $this->Company->read(null, $id));
	}

	function add() {
            //pr($this->data);
		if (!empty($this->data)) {
                    $this->data['User']['username'] = $this->data['Company']['username'];
                    $this->data['User']['password'] = $this->Auth->password($this->data['Company']['pass']);
                    //FIXME: napevno napsána skupina pro firmy
                    $this->data['User']['group_id'] = 5;
			$this->Company->create();
			if ($this->Company->saveAll($this->data)) {
				$this->Session->setFlash(__('Firma byla uložena', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Firmu se nepodařilo uložit. Zkuste to znovu.', true));
			}
		}
		//$groups = $this->Company->Group->find('list');
		//$cdbrochures = $this->Company->Cdbrochure->find('list');
                //$users = $this->Company->Users->find('list');
		//$companyEmployees = $this->Company->CompanyEmployee->find('list');
		$fields = $this->Company->Field->find('list');
		$this->set(compact('fields'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Neexistující firma', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                    $this->data['Company']['id'] = $id;

                    $this->loadModel('CompaniesField');
                    $this->CompaniesField->deleteAll(array('company_id' => $id), false);
                    foreach($this->data['Field'] as $key => $field)
                    {
                        //echo $key;
                        $this->CompaniesField->query('insert into companies_fields (company_id, field_id) values('.$id.','.$key.')');
                    }
                    unset($this->data['Field']); //zpracováno jinak a kdyby to tu zástalo, tak mi to CakePHP smaže
                        //pr($this->data); exit;
			if ($this->Company->saveAll($this->data)) {
				$this->Session->setFlash(__('Firma byla uložena', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Firmu se bohužel nepodařilo uložit, zkuste to znova', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Company->read(null, $id);
		}
		//$groups = $this->Company->Group->find('list');
		//$cdbrochures = $this->Company->Cdbrochure->find('list');
		//$companyEmployees = $this->Company->CompanyEmployee->find('list');
		$fields = $this->Company->Field->find('list');
		$this->set(compact('groups', 'cdbrochures', 'companyEmployees', 'fields'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Neplatné označení firmy', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Company->delete($id)) {
			$this->Session->setFlash(__('Firma byla smazána', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Firmu se nepodařilo smazat', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>