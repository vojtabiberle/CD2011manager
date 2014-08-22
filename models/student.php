<?php
class Student extends AppModel {
	var $name = 'Student';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'RegistrationRequestment' => array(
                    'className' => 'RegistrationRequestment',
                    'foreignKey' => 'registration_requestment_id'
                )
	);

	var $hasAndBelongsToMany = array(
		'Meeting' => array(
			'className' => 'Meeting',
			'joinTable' => 'meetings_students',
			'foreignKey' => 'student_id',
			'associationForeignKey' => 'meeting_id',
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
		'Training' => array(
			'className' => 'Training',
			'joinTable' => 'students_trainings',
			'foreignKey' => 'student_id',
			'associationForeignKey' => 'training_id',
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