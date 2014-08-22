<?php
class Company extends AppModel {
	var $name = 'Company';
	var $validate = array(
		'cdbrochure_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cdbrochure' => array(
			'className' => 'Cdbrochure',
			'foreignKey' => 'cdbrochure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'CdKontakt' => array(
			'className' => 'Employee',
			'foreignKey' => 'cd_kontakt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'StudentKontakt' => array(
			'className' => 'Employee',
			'foreignKey' => 'student_kontakt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'CbKontakt' => array(
			'className' => 'Employee',
			'foreignKey' => 'cb_kontakt_id',
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
		),
                'RoomDay1' => array
                (
                        'className' => 'Room',
			'foreignKey' => 'room_day_1',
			'conditions' => '',
			'fields' => '',
			'order' => ''
                ),
                'RoomDay2' => array
                (
                        'className' => 'Room',
			'foreignKey' => 'room_day_2',
			'conditions' => '',
			'fields' => '',
			'order' => ''
                )
	);


	var $hasAndBelongsToMany = array(
		'Field' => array(
			'className' => 'Field',
			'joinTable' => 'companies_fields',
			'foreignKey' => 'company_id',
			'associationForeignKey' => 'field_id',
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

        var $hasMany = array(
            'Meetings' => array(
                'className' => 'Meeting',
                'foreignKey' => 'company_id'
            ),
            'Trainings' => array(
                'className' => 'Training',
                'foreignKey' => 'company_id'
            )
        );

}
?>