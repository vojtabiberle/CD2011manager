<?php
class SmssesController extends AppController {

	var $name = 'Smsses';
        var $helpers = array('Html', 'Form', 'Menu', 'Session', 'Xml');

        function beforeFilter()
        {
            parent::beforeFilter();
            $this->Auth->allowedActions = array('recieve');
        }

        function recieve()
        {
            $this->layout = 'xml/default';

            if(Configure::read('__alowed_ip_for_sms') != '*')
            {
                if($_SERVER['REMOTE_ADDR'] != Configure::read('__alowed_ip_for_sms'))
                {
                    // Access forbidden:
                    header('HTTP/1.1 403 Forbidden');
                    echo '403 Forbidden';
                    exit;
                }
            }
            if(!isset($this->params['url']['msgid']) ||
               !isset($this->params['url']['clientid']) ||
               !isset($this->params['url']['kw']) ||
               !isset($this->params['url']['subkw']) ||
               !isset($this->params['url']['message']) ||
               !isset($this->params['url']['tarif']) ||
               !isset($this->params['url']['operator'])
              )
            {
                header('HTTP/1.1 400 Bad Request');
                echo '400 Bad Request';
                exit;
            }
            //pr($this->params);
            $msgid = $this->params['url']['msgid'];
            $clientid = $this->params['url']['clientid'];
            $kw = $this->params['url']['kw'];
            $subkw = $this->params['url']['subkw'];
            $message = $this->params['url']['message'];
            $tarif = $this->params['url']['tarif'];
            $operator = $this->params['url']['operator'];
            $generated_key = $this->__rand_chars(5, 36);
            $byl_pouzit = 0;

            $sms = array('Smss' => array(
                'msgid' => $msgid,
                'kw' => $kw,
                'subkw' => $subkw,
                'operator_id' => $operator,
                'message' => $message,
                'tarif' => $tarif,
                'clientid' => $clientid,
                'generated_key' => $generated_key,
                'byl_pouzit' => $byl_pouzit
            ));

            //pr($sms);
            $this->Smss->create();
            if($this->Smss->save($sms))
            {
                $this->set('key', $generated_key);
            }
            else
            {
                header('HTTP/1.1 503 Service Unavailable');
                echo '503 Service Unavailable';
                exit;
            }
        }

        /** Vygenerování náhodného řetězce
        * @param int [$count] délka vráceného řetězce
        * @param int [$chars] použité znaky: <=10 číslice, <=36 +malá písmena, <=62 +velká písmena
        * @return string náhodný řetězec
        * @copyright Jakub Vrána, http://php.vrana.cz
        */
        function __rand_chars($count, $chars)
        {
            $return = "";
            for ($i=0; $i < $count; $i++) {
                $rand = rand(0, $chars - 1);
                $return .= chr($rand + ($rand < 10 ? ord('0') : ($rand < 36 ? ord('a') - 10 : ord('A') - 36)));
            }
            return $return;
        }

	function index() {
		$this->Smss->recursive = 2;
		$this->set('smsses', $this->paginate());
	}

        function index_not_used()
        {
            $this->Smss->recursive = 0;
            $this->paginate = array(
                'conditions' => array('byl_pouzit' => 0)
            );
            $this->set('smsses', $this->paginate());
        }

        function index_aiesec()
        {
            $this->Smss->recursive = 2;
            $this->paginate = array(
                'conditions' => array('kw' => 'AIESEC', 'byl_pouzit' => 1)
            );
            $this->set('smsses', $this->paginate());
        }

        function index_aiesec_not_used()
        {
            $this->Smss->recursive = 2;
            $this->paginate = array(
                'conditions' => array('kw' => 'AIESEC', 'byl_pouzit' => 0)
            );
            $this->set('smsses', $this->paginate());
        }

        function generate($for = 'AIESEC')
        {
            switch($for)
            {
                case 'AIESEC':
                        if(!empty($this->data))
                        {
                            if(is_numeric($this->data['Smss']['kolik']))
                            {
                                for($i = 0; $i < $this->data['Smss']['kolik']; $i++)
                                {
                                    $this->Smss->create();
                                    $data = array(
                                        'Smss' => array(
                                            'msgid' => '',
                                            'kw' => 'AIESEC',
                                            'subkw' => 'AIESEC',
                                            'tarif'=> '9035599',
                                            'generated_key' => $this->__rand_chars(5, 36)
                                        )
                                    );
                                    $this->Smss->save($data);
                                }
                            }
                            else
                            {
                                $this->Session->setFlash(__('Zadej prosím číslo.', true), 'flash_error');
                                $this->redirect($this->referer());
                            }
                        }
                    break;
                default:
                        $this->Session->setFlash(__('Takové kódy generovat neumíme.', true), 'flash_error');
                        $this->redirect($this->referer());
                    break;
            }
        }

        function export($to = 'xls')
        {
            switch($to)
            {
                case 'xls':
                        App::import('vendor', 'psxlsgen');

                        $this->recursive = 0;
                        $regcodes = $this->Smss->find('all', array(
                            'conditions' => array('kw' => 'AIESEC', 'byl_pouzit' => 0),
                            'fields' => array('generated_key'),
                            'contains' => array('Smss')
                        ));

                        $myxls = new PhpSimpleXlsGen();
                        $myxls->totalcol = 1;

                        //$data = array();
                        foreach($regcodes as $regcode)
                        {
                            $myxls->InsertText($regcode['Smss']['generated_key']);
                        }

                        $myxls->SendFile('regcodes');
                        
                    break;
                default:
                        $this->Session->setFlash(__('Takový export neumíme.', true), 'flash_error');
                        $this->redirect($this->referer());
                    break;
            }
        }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid smss', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('smss', $this->Smss->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Smss->create();
			if ($this->Smss->save($this->data)) {
				$this->Session->setFlash(__('The smss has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The smss could not be saved. Please, try again.', true));
			}
		}
		$operators = $this->Smss->Operator->find('list');
		$this->set(compact('operators'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid smss', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Smss->save($this->data)) {
				$this->Session->setFlash(__('The smss has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The smss could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Smss->read(null, $id);
		}
		$operators = $this->Smss->Operator->find('list');
		$this->set(compact('operators'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for smss', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Smss->delete($id)) {
			$this->Session->setFlash(__('Smss deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Smss was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>