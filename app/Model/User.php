<?php
App::uses('AppModel', 'Model');
class User extends AppModel {

    public $hasMany = array('Follow');
    public $actsAs = array('Containable');

    public $virtualFields = array(
        'display_name'=>'SELECT group_concat(value separator " ") FROM user_details where field in("User.first_name","User.last_name") and user_id = User.id',
        'bio'=>'SELECT value FROM `user_details` where field in("User.about") and user_id = User.id',
        'website'=>'SELECT value FROM `user_details` where field in("User.website") and user_id = User.id',
        'how_to_call'=>'SELECT value FROM `user_details` where field in("User.how_to_call") and user_id = User.id',
        'id_ym'=>'SELECT value FROM `user_details` where field in("User.id_ym") and user_id = User.id',
    );
    
    function findSummary($userId=null) {
        $this->virtualFields['ads_count'] = 'SELECT count(*) FROM listings WHERE listings.user_id = User.id';
        return $this->findById($userId);
    }
    
	function getAnotherUserProfile($id=null,$AuthUserId=null) {
        $user = $this->find('first',
            array(
                'conditions'=>array(
                    'User.id'=>$id
                 ),
                 'recursive'=>-1
            )
        );

#        $isFollowed = 0;
#        $isFollowed = $this->Follower->find('first',array(
#            'conditions'=>array(
#                'Follower.followed_id'=>$id,
#                'Follower.follower_id'=>$AuthUserId
#            ),
#            'recursive'=>-1
#        ));
        $return['info'] = $user;
#        if(!empty($isFollowed)) {
#            $return['info']['isFollowed'] = $isFollowed;
#        }else {
#            $return['info']['isFollowed'] = null;
#        }
#        $requests = 0;
#        if($id == $AuthUserId) {
#            $requests = $this->Follower->find('count',array(
#                'conditions'=>array(
#                    'Follower.followed_id'=>$AuthUserId,
#                    'Follower.status'=>0
#                ),
#                'recursive'=>-1
#            ));
#        }
#        $return['info']['requests'] = $requests;
        return $return;
	}
}
?>
