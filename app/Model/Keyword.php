<?php
App::uses('AppModel', 'Model');
/**
 * Keyword Model
 *
 * @property KeywordListing $KeywordListing
 */
class Keyword extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'KeywordListing','Follow'
	);
	
    function getSuggestions($term=null) {
        $topics = $this->find('all',array(
            'conditions'=>array('Keyword.name LIKE '=>'%'.$term.'%'),
            'limit'=>10,
            'recursive'=>-1
        ));
        $suggestions = array();
        foreach($topics as $topic) {
            $suggestions[] = array('label'=>$topic['Keyword']['name'],'id'=>$topic['Keyword']['id']);
        }
        return json_encode($suggestions);
    }
    
/**
 * Get most popular note by using a score formula.
 *
 * @return array note sorted from popular to less
 * @access public
 */
    function top() {
        $this->KeywordListing->virtualFields['_today_visit'] = 'SELECT COUNT(*) FROM listing_visits WHERE listing_visits.listing_id = KeywordListing.listing_id AND listing_visits.created >= "'.date('Y-m-d',strtotime('-1 day')).'"';    
        $data = $this->KeywordListing->find('all',array(
            'conditions'=>array(
                'KeywordListing._today_visit != '=>0
            ),
            'recursive'=>-1
        ));
        return $data;
    }
    
    
    function show_suggestion_list($user_id=null) {
        $data = $this->top();
        $followed = $this->Follow->find('list',array(
            'conditions'=>array('Follow.user_id'=>$user_id),
            'fields'=>array('Follow.keyword_id'),
            'recursive'=>-1
        ));
#        debug($data);
#        debug($followed);
       
        foreach($data as $k=>$v) {
            if(in_array($data[$k]['KeywordListing']['keyword_id'],$followed)) {
                $data[$k]['KeywordListing']['is_followed'] = 1;
            }else {
                $data[$k]['KeywordListing']['is_followed'] = 0;
            }
        }
        return $data;
    }

}
