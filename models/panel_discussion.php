<?php
class PanelDiscussion extends AppModel {
	var $name = 'PanelDiscussion';
	var $displayField = 'name';
        var $virtualFields = array(
            'den' => 'date(cas_konani)',
            'zacatek' => 'time(cas_konani)',
        );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Company' => array(
			'className' => 'Company',
			'joinTable' => 'companies_panel_discussions',
			'foreignKey' => 'panel_discussion_id',
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