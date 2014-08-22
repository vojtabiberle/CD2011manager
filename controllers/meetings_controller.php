<?php
class MeetingsController extends AppController {

	var $name = 'Meetings';
        var $components = array('RequestHandler');

        function  beforeFilter()
        {
            $this->Auth->allowedActions = array('student_index', 'student_get_registered');
            parent::beforeFilter();
        }

        function show_students()
        {
            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                'contain' => array()
            ));
            //$this->recursive = 2;
            $this->Meeting->bindModel(array(
                'hasAndBelongsToMany' => array(
                    'StudentsAllInfo' => array(
                        'className' => 'StudentsAllInfo',
                        'joinTable' => 'meetings_students',
			'foreignKey' => 'meeting_id',
			'associationForeignKey' => 'student_id',
                    )
                )
            ));
            $meetings = $this->Meeting->find('all', array(
                'conditions' => array('company_id' => $company['Company']['id']),
                'contain' => array('StudentsAllInfo'),
                'order' => array('den ASC', 'zacatek ASC')
            ));

            $this->set('meetings', $meetings);
        }

        function student_index()
        {
            $this->layout = 'student';
            $companies = $this->Meeting->Company->find('all', array(
                'contain' => array('Meetings', 'RoomDay1', 'RoomDay2'),
                'order' => array('Company.name ASC')
            ));

            $this->set(compact('companies'));
        }

	function index() {
            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                'contain' => array('Meetings')
            ));
            $times = $this->__generateTimes();
            $this->set(compact('times', 'company'));
	}

        function student_get_registered($id = null)
        {
            $this->autoRender = false;
            if($this->RequestHandler->isAjax())
            {
                $this->layout = 'ajax';
                if($id)
                {
                    $mtg = $this->Meeting->find('first', array(
                        'conditions' => array('Meeting.id' => $id)
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

        function __generateTimes()
        {
            $user = $this->Auth->user();
            $this->loadModel('Company');
            $company = $this->Company->find('first',array(
                'conditions' => array('user_id' => $user['User']['id']),
                //'contain' => array('User', 'Emplyee', 'Field')
            ));
            $times = array();
            if($company['Company']['ma_individual'])
            {
                if($company['Company']['ma_den_1'])
                {
                    $times['Den1'] = $this->__dayTimes();
                }
                if($company['Company']['ma_den_2'])
                {
                    $times['Den2'] = $this->__dayTimes();
                }
            }

            return $times;
        }

        function __dayTimes()
        {
            $times = array();
            $start = corectTime(Configure::read('__careerdays_start_time'));
            $end = corectTime(Configure::read('__careerdays_end_time'));
            $short = corectTime('0:'.(Configure::read('__short_meeting_duration')+5));
            $long = corectTime('0:'.(Configure::read('__long_meeting_duration')+10));

            $actual_time = $start;
            //$long_end = corectTime(subTime($end, $long));
            //echo $actual_time.'<br>'.$long_end.'<br>';
            while(compareTime($actual_time, $end) <= 0)
            {
                //$times[] = $actual_time;
                if(!in_array($actual_time, $times))
                {
                    array_push($times, $actual_time);
                }
                $actual_time = corectTime(addTime($actual_time, $long));
            }

            $actual_time = $start;
            //$short_end = corectTime(subTime($end, $short));
            while(compareTime($actual_time, $end) <= 0)
            {
                //$times[] = $actual_time;
                if(!in_array($actual_time, $times))
                {
                    array_push($times, $actual_time);
                }
                $actual_time = corectTime(addTime($actual_time, $short));
            }

            sort($times);

            return $times;
        }

        

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Neplatné setkání', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('meeting', $this->Meeting->read(null, $id));
	}

	function add() {
            $user = $this->Auth->user();
                $this->loadModel('Company');
                $company = $this->Company->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array('Meetings')
                ));
		if (!empty($this->data)) {
			$this->Meeting->create();
                        $this->data['Meeting']['zacatek'] = $this->Session->read('MeetingStart');
                        $this->data['Meeting']['den'] = $this->Session->read('MeetingDay');
                        if($this->data['Meeting']['max_pocet_ucastniku'] > 30)
                        {
                            $this->data['Meeting']['max_pocet_ucastniku'] = 30;
                        }
                        if($this->data['Meeting']['delka'] == '25')
                        {
                            $this->data['Meeting']['konec'] = addTime($this->data['Meeting']['zacatek'],'00:30');
                        }
                        else
                        {
                            $this->data['Meeting']['konec'] = addTime($this->data['Meeting']['zacatek'],'01:00');
                        }
                        $this->data['Meeting']['company_id'] = $company['Company']['id'];
			if ($this->Meeting->save($this->data)) {
				$this->Session->setFlash(__('Váše požadované setkání bylo uloženo.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Setkání se bohužel nepodařilo uložit. Zkuste to později.', true));
                                $this->redirect(array('action' => 'index'));
			}
		}

                

                $this->Session->delete('MeetingDay');
                $this->Session->delete('MeetingStart');
		
                $day = $this->params['named']['day'];
                $start = $this->params['named']['start'];

                $this->Session->write('MeetingDay', $day);
                $this->Session->write('MeetingStart', $start);

		$this->set(compact('company', 'start'));
	}

	function edit($id = null) {
            $user = $this->Auth->user();
                $this->loadModel('Company');
                $company = $this->Company->find('first',array(
                    'conditions' => array('user_id' => $user['User']['id']),
                    'contain' => array('Meetings')
                ));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Neplatné setkání', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                        if($this->data['Meeting']['max_pocet_ucastniku'] > 30)
                        {
                            $this->data['Meeting']['max_pocet_ucastniku'] = 30;
                        }
			if ($this->Meeting->save($this->data)) {
				$this->Session->setFlash(__('Setkání bylo uloženo', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Setkání se bohužel nepodařilo uložit. Zkuste to znovu.', true));
                                $this->redirect(array('action' => 'index'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Meeting->read(null, $id);
		}
		$this->set(compact('company'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Neplatné setkání', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Meeting->delete($id)) {
			$this->Session->setFlash(__('Setkání smazáno', true));
			$this->redirect(array('action'=>'index'));
		}
                else
                {
                    $this->Session->setFlash(__('Setkání se nepodařilo smazat', true));
                    $this->redirect(array('action' => 'index'));
                }
	}
}
?>