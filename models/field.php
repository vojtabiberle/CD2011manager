<?php
class Field extends AppModel {
	var $name = 'Field';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Cdbrochure' => array(
			'className' => 'Cdbrochure',
			'joinTable' => 'cdbrochures_fields',
			'foreignKey' => 'field_id',
			'associationForeignKey' => 'cdbrochure_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Company' => array(
			'className' => 'Company',
			'joinTable' => 'companies_fields',
			'foreignKey' => 'field_id',
			'associationForeignKey' => 'company_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>