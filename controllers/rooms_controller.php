<?php
class RoomsController extends AppController {

	var $name = 'Rooms';

        function company_asign()
        {
            $this->loadModel('Company');
            if(!empty($this->data))
            {
                //pr($this->data);
                if(empty($this->data['Rooms']['company_day1_id']))
                {
                    $comp = $this->Company->find('first', array(
                        'conditions' => array('room_day_1' => $this->data['Rooms']['id'])
                    ));
                    $this->Company->id = $comp['Company']['id'];
                    $this->Company->saveField('room_day_1', null);
                }
                else
                {
                    $this->Company->id = $this->data['Rooms']['company_day1_id'];
                    $data = array(
                        'Company' => array('room_day_1' => $this->data['Rooms']['id'])
                    );
                    $this->Company->save($data);
                }

                if(empty($this->data['Rooms']['company_day2_id']))
                {
                    $comp = $this->Company->find('first', array(
                        'conditions' => array('room_day_2' => $this->data['Rooms']['id'])
                    ));
                    $this->Company->id = $comp['Company']['id'];
                    $this->Company->saveField('room_day_2', null);
                }
                else
                {
                    $this->Company->id = $this->data['Rooms']['company_day2_id'];
                    $data = array(
                        'Company' => array('room_day_2' => $this->data['Rooms']['id'])
                    );
                    $this->Company->save($data);
                }
            }

            $rooms = $this->Room->find('all');
            
            $com_day1 = $this->Company->find('list', array(
                'conditions' => array('ma_den_1' => '1')
            ));
            $com_day2 = $this->Company->find('list', array(
                'conditions' => array('ma_den_2' => '1')
            ));

            $this->set(compact('rooms', 'com_day1', 'com_day2'));
        }

	function index() {
		$this->Room->recursive = 0;
		$this->set('rooms', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid room', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('room', $this->Room->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Room->create();
			if ($this->Room->save($this->data)) {
				$this->Session->setFlash(__('The room has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The room could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid room', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Room->save($this->data)) {
				$this->Session->setFlash(__('The room has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The room could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Room->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for room', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Room->delete($id)) {
			$this->Session->setFlash(__('Room deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Room was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>