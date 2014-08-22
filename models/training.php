<?php
class Training extends AppModel {
	var $name = 'Training';
	var $displayField = 'name';
	var $virtualFields = array(
            'den' => 'date(datetime)',
            'zacatek' => 'time(datetime)',
            'konec' => 'time(addtime(datetime, \'01:30\'))'
        );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'Hostess' => array(
			'className' => 'User',
			'foreignKey' => 'hostess_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Student' => array(
			'className' => 'Student',
			'joinTable' => 'students_trainings',
			'foreignKey' => 'training_id',
			'associationForeignKey' => 'student_id',
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