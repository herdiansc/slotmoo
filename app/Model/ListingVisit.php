<?php
App::uses('AppModel', 'Model');
/**
 * ListingVisit Model
 *
 * @property Listing $Listing
 */
class ListingVisit extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Listing' => array(
			'className' => 'Listing',
			'foreignKey' => 'listing_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
