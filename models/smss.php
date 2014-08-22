<?php
class Smss extends AppModel {
	var $name = 'Smss';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Operator' => array(
			'className' => 'Operator',
			'foreignKey' => 'operator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

        var $hasMany = array(
            'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'id_platby',
			'dependent' => false,
			'conditions' => array('typ_platby' => 'sms'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
        );
}
?>