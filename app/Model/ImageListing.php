<?php
App::uses('AppModel', 'Model');
/**
 * ImageListing Model
 *
 * @property Listing $Listing
 */
class ImageListing extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Listing'
	);
}
