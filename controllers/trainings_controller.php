<?php
class TrainingsController extends AppController {

	var $name = 'Trainings';

        function  beforeFilter()
        {
            $this->Auth->allowedActions = array('student_index', 'student_view', 'student_get_registered');
            parent::beforeFilter();

        }

        function student_index()
        {
            $this->layout = 'student';
             $trainings = $this->Training->find('all', array(
                        'conditions' => array('company_id <>' => 0),
                        'order' => array('Training.datetime ASC')
                    ));

            $this->set(compact('trainings'));
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
            
            if(!$id)
            {
                $this->Session->setFlash(__('Neznámý trénink.', true));
                $this->redirect('/priprav_se');
            }

            $tr = $this->Training->find('first', array(
                'conditions' => array('Training.id' => $id),
                'contain' => array('Student')
            ));

            $this->set('training', $tr);
        }

        function company_index()
        {
            $trainings['Day1'] = $this->Training->find('all',array(
                'conditions' => array('date(datetime)' => toEngDate(Configure::read('__careerdays_first_day_date')))
            ));
            $trainings['Day2'] = $this->Training->find('all',array(
                'conditions' => array('date(datetime)' => toEngDate(Configure::read('__careerdays_second_day_date')))
            ));

            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('Meetings')
            ));

            $this->set('company', $company);
            $this->set('trainings', $trainings);
        }

        function company_register()
        {
            if(!empty($this->data))
            {
                $this->Training->id = $this->data['Training']['id'];
                if ($this->Training->save($this->data)) {
				$this->Session->setFlash(__('Trénink byl uložen.', true));
				$this->redirect(array('action' => 'company_index'));
			} else {
				$this->Session->setFlash(__('Trénink bohužel nebyl uložen.', true));
                                $this->redirect(array('action' => 'company_index'));
			}
            }

            //pr($this->params);
            $day = $this->params['named']['day'];
            $time = $this->params['named']['time'];
            $room = $this->params['named']['room'];

            if($time == '9:00')
            {
                $time = '09:00';
            }

            if($day == 1)
            {
                $date = toEngDate(Configure::read('__careerdays_first_day_date'));
            }
            elseif($day == 2)
            {
                $date = toEngDate(Configure::read('__careerdays_second_day_date'));
            }
            else
            {
                echo 'Neplatný den';
                exit;
            }

            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('Meetings')
            ));
            //pr($company);
            if(count($company['Trainings']) == $company['Company']['pocet_treninku'])
            {
                $this->Session->setFlash('Máte objednáno pouze '.$company['Company']['pocet_treninku'].'. Více registrovat nemůžete.');
                $this->redirect(array('controller' => 'trainings', 'action' => 'company_index'));
            }
            else
            {
                $this->loadModel('Room');
                $room = $this->Room->find('first', array(
                    'conditions' => array('name' => $room)
                ));
                //pr($room);
                $training = $this->Training->find('first', array(
                    'conditions' => array(
                        'room_id' => $room['Room']['id'],
                        'date(datetime)' => $date,
                        'time(datetime)' => $time.':00'
                    )
                ));
                //pr($training);
                $this->Training->id = $training['Training']['id'];
                $this->Training->saveField('company_id', $company['Company']['id']);

                $this->set('company', $company);
                $this->set('training', $training);
            }

            
        }

        function company_edit($id = null)
        {
            if(!$id && empty($this->data))
            {
                $this->Session->setFlash(__('Zadejte prosím ID tréninku.', true));
                $this->redirect(array('controller' => 'trainings', 'action' => 'company_index'));
            }
            if(!empty($this->data))
            {
                $id = $this->data['Training']['id'];
            }
            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('Meetings')
            ));

            $trenink = $this->Training->find('first', array(
                'conditions' => array('Training.id' => $id)
            ));

            if($trenink['Training']['company_id'] != $company['Company']['id'])
            {
                $this->Session->setFlash(__('Nepokoušejte se prosím editovat cizí tréninky.', true));
                $this->redirect(array('controller' => 'trainings', 'action' => 'company_index'));
            }
            if(!empty($this->data))
            {
                $this->Training->id = $this->data['Training']['id'];
                if ($this->Training->save($this->data)) {
				$this->Session->setFlash(__('Trénink byl uložen.', true));
				$this->redirect(array('action' => 'company_index'));
			} else {
				$this->Session->setFlash(__('Trénink bohužel nebyl uložen.', true));
                                $this->redirect(array('action' => 'company_index'));
			}
            }

            $this->set('company', $company);
            $this->set('training', $trenink);
        }

        function company_unregister($id = null)
        {
            if(!$id)
            {
                $this->Session->setFlash(__('Zadejte prosím ID tréninku.', true));
                $this->redirect(array('controller' => 'trainings', 'action' => 'company_index'));
            }

            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('Meetings')
            ));

            $trenink = $this->Training->find('first', array(
                'conditions' => array('Training.id' => $id)
            ));
            //pr($trenink);
            //exit;

            if($trenink['Training']['company_id'] != $company['Company']['id'])
            {
                $this->Session->setFlash(__('Nepokoušejte se prosím odregistrovat cizí tréninky.', true));
                $this->redirect(array('controller' => 'trainings', 'action' => 'company_index'));
            }
            else
            {
                $this->Training->id = $trenink['Training']['id'];
                $data = array(
                    'Training' => array(
                        'id' => $trenink['Training']['id'],
                        'name' => '',
                        'description' => '',
                        'company_id' => 0
                    )
                );
                if ($this->Training->save($data)) {
				$this->Session->setFlash(__('Byli jste odregistrování z tréninku.', true));
				$this->redirect(array('action' => 'company_index'));
			} else {
				$this->Session->setFlash(__('Bohužel se Vás nepodařilo odregistrovat z tréninku.', true));
                                $this->redirect(array('action' => 'company_index'));
			}
            }
        }

        function student_get_registered($id = null)
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
                if($id)
                {
                    $mtg = $this->Training->find('first', array(
                        'conditions' => array('Training.id' => $id)
                    ));

                    $cmtg = count($mtg['Student']);
                    //pr($mtg);

                    return $cmtg;
                }
                else
                {
                    return 0;
                }
            }
            return 0;
        }

	function index() {
		$this->Training->recursive = 0;
		$this->set('trainings', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid training', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('training', $this->Training->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Training->create();
			if ($this->Training->save($this->data)) {
				$this->Session->setFlash(__('The training has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.', true));
			}
		}
		$rooms = $this->Training->Room->find('list');
//		$companies = $this->Training->Company->find('list');
//		$students = $this->Training->Student->find('list');
		$this->set(compact('rooms', 'companies', 'students'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid training', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Training->save($this->data)) {
				$this->Session->setFlash(__('The training has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Training->read(null, $id);
		}
		$rooms = $this->Training->Room->find('list');
		$companies = $this->Training->Company->find('list');
		$students = $this->Training->Student->find('list');
		$this->set(compact('rooms', 'companies', 'students'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for training', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Training->delete($id)) {
			$this->Session->setFlash(__('Training deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Training was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>