<?php
class PanelDiscussionsController extends AppController {

	var $name = 'PanelDiscussions';
        
        function  beforeFilter()
        {
            $this->Auth->allowedActions = array('student_index');
            parent::beforeFilter();
            
        }

        function student_index()
        {
            $this->layout = 'student';
            $pds = $this->PanelDiscussion->find('all', array(
                'order' => array('cas_konani asc')
            ));
//            foreach($pds as $key => $pd)
//            {
//                $cas_konani = toCzechDateTime($pd['PanelDiscussion']['cas_konani']);
//                $pds[$key]['PanelDiscussion']['cas_konani'] = $cas_konani;
//                list($datum, $zacatek) = explode(' ', $cas_konani);
//                $pds[$key]['PanelDiscussion']['datum'] = $datum;
//                $pds[$key]['PanelDiscussion']['zacatek'] = $zacatek;
//                //echo Configure::read('__careerdays_first_day_date');
//                //FIXME: Takhle by to určitě bejt nemělo!
//                if($datum == '02.03.2011')
//                {
//                    $pds[$key]['PanelDiscussion']['den'] = 1;
//                }
//                elseif($datum == '03.03.2011')
//                {
//                    $pds[$key]['PanelDiscussion']['den'] = 2;
//                }
//                else
//                {
//                    $pds[$key]['PanelDiscussion']['den'] = 0;
//                }
//            }
            $this->set('panelDiscussions', $pds);
        }

        function company_register($id = null)
        {
            $user = $this->Auth->user();
            $company = $this->PanelDiscussion->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
            ));
            //pr($company);
            if($id != null)
            {
                if(!$company['Company']['ma_panelovou_diskuzi'])
                {
                    $this->Session->setFlash(__('Nemáte povolenu registraci na panelové diskuze.', true));
                }
                else
                {
                    if(timeIsInFuture(Configure::read('__panel_discussion_start_registration_time')))
                    {
                        $this->Session->setFlash(__('Registrace ještě není povolena.', true));
                        //$this->redirect(array('controller' => 'panel_discussions', 'action' => 'company_register'));
                    }
                    elseif(timeIsInPast(Configure::read('__panel_discussion_stop_registration_time')))
                    {
                        $this->Session->setFlash(__('Registrace skončila.', true));
                    }
                    else
                    {

                        if($this->PanelDiscussion->habtmAdd('Company', $id, $company['Company']['id']))
                        {
                            $this->Session->setFlash(__('Jste přihlášeni na panelovou diskuzi.', true));
                        }
                        else
                        {
                            $this->Session->setFlash(__('Přihlášení na panelovou diskuzi se bohužel nezdařilo.', true));
                        }
                    }
                }
            }
            $this->set('com', $company);
            $diskuze = $this->PanelDiscussion->find('all');
            $this->set('panelDiscussions', $diskuze);
        }

        function company_unregister($id = null)
        {
            if(!$id)
            {
                $this->Session->setFlash(__('Neplatná panelová diskuze', true));
                $this->redirect(array('controller' => 'panel_discussions', 'action' => 'company_register'));
            }
            elseif(timeIsInPast(Configure::read('__panel_discussion_stop_registration_time')))
            {
                $this->Session->setFlash(__('Registrace skončila.', true));
            }
            else
            {
                $user = $this->Auth->user();
                $company = $this->PanelDiscussion->Company->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                ));
                if($this->PanelDiscussion->habtmDelete('Company', $id, $company['Company']['id']))
                {
                    $this->Session->setFlash(__('Jste odhlášeni z panelové diskuze.', true));
                }
                else
                {
                    $this->Session->setFlash(__('Odhlášení z panelové diskuze se bohužel nezdařilo.', true));
                }
                
            }
            $this->redirect(array('controller' => 'panel_discussions', 'action' => 'company_register'));
        }

	function index() {
		$this->PanelDiscussion->recursive = 0;
		$this->set('panelDiscussions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid panel discussion', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('panelDiscussion', $this->PanelDiscussion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PanelDiscussion->create();
			if ($this->PanelDiscussion->save($this->data)) {
				$this->Session->setFlash(__('The panel discussion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The panel discussion could not be saved. Please, try again.', true));
			}
		}
		$companies = $this->PanelDiscussion->Company->find('list');
		$this->set(compact('companies'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid panel discussion', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PanelDiscussion->save($this->data)) {
				$this->Session->setFlash(__('The panel discussion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The panel discussion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PanelDiscussion->read(null, $id);
		}
		$companies = $this->PanelDiscussion->Company->find('list');
		$this->set(compact('companies'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for panel discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PanelDiscussion->delete($id)) {
			$this->Session->setFlash(__('Panel discussion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Panel discussion was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>