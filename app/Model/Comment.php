<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Listing $Listing
 * @property User $User
 */
class Comment extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
    var $virtualFields = array(
        '_username'=>'SELECT username FROM users WHERE users.id = Comment.user_id',
        '_photo_profile'=>'SELECT photo_profile FROM users WHERE users.id = Comment.user_id'
    );
}
