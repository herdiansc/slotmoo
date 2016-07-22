<?php
App::uses('AppModel', 'Model');
/**
 * KeywordListing Model
 *
 * @property Keyword $Keyword
 * @property Listing $Listing
 */
class KeywordListing extends AppModel {

    public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'keyword_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Silahkan masukkan setidaknya satu kata kunci',
			),
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Keyword','Listing'
	);
	
    var $virtualFields = array(
        '_keyword_name'=>'SELECT keywords.name FROM keywords WHERE keywords.id = KeywordListing.keyword_id',
        '_keyword_slug'=>'SELECT keywords.slug FROM keywords WHERE keywords.id = KeywordListing.keyword_id'
    );
}
