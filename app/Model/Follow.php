<?php
App::uses('AppModel', 'Model');
/**
 * Follow Model
 *
 * @property Keyword $Keyword
 * @property User $User
 */
class Follow extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Keyword' => array(
			'className' => 'Keyword',
			'foreignKey' => 'keyword_id',
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
	
	
	function follow_keyword($keyword_id=null,$user_id=null) {
	    $check = $this->field('id',array(
            'Follow.keyword_id'=>$keyword_id,
            'Follow.user_id'=>$user_id
	    ));
	    
	    if($check == null) {
	        $data = array(
	            'keyword_id'=>$keyword_id,
	            'user_id'=>$user_id
	        );
	        return $this->save($data);
	    }else {
	        return false;
	    }
	}
}
