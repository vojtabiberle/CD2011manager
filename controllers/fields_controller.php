<?php
class FieldsController extends AppController {

	var $name = 'Fields';

	function index() {
		$this->Field->recursive = 0;
		$this->set('fields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('field', $this->Field->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Field->create();
			if ($this->Field->save($this->data)) {
				$this->Session->setFlash(__('The field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field could not be saved. Please, try again.', true));
			}
		}
		$cdbrochures = $this->Field->Cdbrochure->find('list');
		$companies = $this->Field->Company->find('list');
		$this->set(compact('cdbrochures', 'companies'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Field->save($this->data)) {
				$this->Session->setFlash(__('The field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Field->read(null, $id);
		}
		$cdbrochures = $this->Field->Cdbrochure->find('list');
		$companies = $this->Field->Company->find('list');
		$this->set(compact('cdbrochures', 'companies'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Field->delete($id)) {
			$this->Session->setFlash(__('Field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>