<?php
class CdbrochuresController extends AppController {

	var $name = 'Cdbrochures';

	function index() {
		$this->Cdbrochure->recursive = 0;
		$this->set('cdbrochures', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cdbrochure', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cdbrochure', $this->Cdbrochure->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cdbrochure->create();
			if ($this->Cdbrochure->save($this->data)) {
				$this->Session->setFlash(__('The cdbrochure has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cdbrochure could not be saved. Please, try again.', true));
			}
		}
		$fields = $this->Cdbrochure->Field->find('list');
		$this->set(compact('fields'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cdbrochure', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cdbrochure->save($this->data)) {
				$this->Session->setFlash(__('The cdbrochure has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cdbrochure could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cdbrochure->read(null, $id);
		}
		$fields = $this->Cdbrochure->Field->find('list');
		$this->set(compact('fields'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cdbrochure', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cdbrochure->delete($id)) {
			$this->Session->setFlash(__('Cdbrochure deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cdbrochure was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>