<?php
App::uses('AppModel', 'Model');
/**
 * Listing Model
 *
 * @property User $User
 * @property Category $Category
 */
class Listing extends AppModel {

    public $actsAs = array(
        'Containable',
        'Utils.Sluggable' => array(
			'label' => 'title',
			'method' => 'multibyteSlug',
			'separator'=>'-'
        )
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bagian judul tidak boleh kosong',
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bagian deskripsi tidak boleh kosong',
			),
		),
		'price' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bagian harga tidak boleh kosong',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Silahkan masukkan hanya angka saja.',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
		)
	);
	
	public $hasMany = array(
		'ImageListing'=>array(
	        'className'=>'ImageListing',
	        'dependent'=>true
	    ),
	    'Comment'=>array(
	        'className'=>'Comment',
	        'dependent'=>true
	    ),
	    'ListingVisit'=>array(
	        'className'=>'ListingVisit',
	        'dependent'=>true
	    ),
	    'KeywordListing'=>array(
	        'className'=>'KeywordListing',
	        'dependent'=>true
	    ),
	);
	
	public $virtualFields = array(
		'_image'=>'SELECT filename FROM image_listings WHERE listing_id = Listing.id LIMIT 1',
		'_image_cdn'=>'SELECT image_server FROM image_listings WHERE listing_id = Listing.id LIMIT 1',
	    '_visit'=>'SELECT COUNT(*) FROM listing_visits WHERE listing_visits.listing_id = Listing.id',
	    '_commentCount'=>'SELECT COUNT(*) FROM comments WHERE comments.listing_id = Listing.id'
#	    '_privacyDescription'=>'SELECT description FROM privacies WHERE privacies.id = Note.privacy_id',
	);
	

/**
 * Get most popular note by using a score formula.
 *
 * @return array note sorted from popular to less
 * @access public
 */
    function top() {
        //Optimalize query, by removing unused virtualField.
        unset($this->virtualFields['_visit']);
        //Create a virtualField named score to sort the most popular note.
        //Here is the formula. score = views_last_a_day/(now-first_time_created)
        $this->virtualFields['_score'] = '(SELECT COUNT(*) FROM listing_visits WHERE listing_visits.listing_id = Listing.id AND listing_visits.created >= "'.date('Y-m-d',strtotime('-1 day')).'")/(NOW()-(SELECT MIN(created) FROM listing_visits WHERE listing_visits.listing_id = Listing.id AND listing_visits.created >= "'.date('Y-m-d',strtotime('-1 day')).'"))';
        $this->virtualFields['_username'] = 'SELECT username FROM users WHERE users.id = Listing.user_id';
        $data = $this->find('all',array(
            'conditions'=>array('Listing.created BETWEEN '),
            'order'=>'Listing._score DESC',
            'limit'=>10,
            'recursive'=>-1
        ));
        return $data;
    }
}
