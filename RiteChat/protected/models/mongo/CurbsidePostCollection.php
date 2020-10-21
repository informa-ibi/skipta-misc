<?php
/**
 * This collection is used save the curbside post
 * @author Haribabu
 */
class CurbsidePostCollection extends EMongoDocument {
    public $_id;
    public $Type;
    public $UserId;
    public $Priority;
    public $CreatedOn;
    public $Description;
    public $Followers;
    public $Mentions;
    public $Comments;
    public $Resource;
    public $Love;
    public $HashTags;
    public $Invite;
    public $Share;
    public $Subject;
    public $CategoryId;
    public $DisableComments=0;
    
    public $IsAbused=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
    public $AbusedUserId;
    public $IsDeleted=0;
    public $IsPromoted=0;
    public $PromotedUserId;
    public $NetworkId;
    public $AbusedOn;
    public $IsBlockedWordExist=0;
    public $IsFeatured=0;
    public $FeaturedUserId;
    public $FeaturedOn;
    public $IsBlockedWordExistInComment=0;
    public $IsWebSnippetExist = 0;
    public $WebUrls;
    public $Division=0;
    public $District=0;
    public $Region=0;
    public $Store=0;
    public $FbShare=array();
    public $TwitterShare=array();
    public $MigratedPostId='';
    //$postedBy is added by Sagar for PostAsNetwork
    public $PostedBy=0;
    public $PromotedDate;
    public function getCollectionName() {
        return 'CurbsidePostCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
            '_id'=>'_id',
            'Type' => 'Type',
            'UserId' => 'UserId',
            'Priority' => 'Priority',
            'CreatedOn' => 'CreatedOn',
            'Description' => 'Description',
            'Followers' => 'Followers',
            'Mentions'=>'Mentions',            
            'Comments' => 'Comments',            
            'Love' => 'Love',
            'Resource' => 'Resource',
            'HashTags' => 'HashTags',
            'Invite'=>'Invite',
            'Share'=>'Share',
            'Subject'=>'Subject',
            'CategoryId'=>'CategoryId',
            'DisableComments'=>'DisableComments',
            'IsAbused'=>'IsAbused',
            'AbusedUserId'=>'AbusedUserId',
            'IsDeleted'=>'IsDeleted',
            'IsPromoted'=>'IsPromoted',
            'PromotedUserId'=>'PromotedUserId',
            'NetworkId'=>'NetworkId',
            'AbusedOn'=>'AbusedOn',
            'IsBlockedWordExist'=>'IsBlockedWordExist',
            'IsFeatured'=>'IsFeatured',
            'FeaturedUserId'=>'FeaturedUserId',
            'FeaturedOn'=>'FeaturedOn',
            'IsBlockedWordExistInComment'=>'IsBlockedWordExistInComment',
            'IsWebSnippetExist'=>'IsWebSnippetExist',
            'WebUrls'=>'WebUrls',
            'Division'=>'Division',
            'District'=>'District',
            'Region'=>'Region',
            'Store'=>'Store',
            'FbShare'=>'FbShare',
            'TwitterShare'=>'TwitterShare',
            'MigratedPostId'=>'MigratedPostId',
            'PostedBy'=>'PostedBy',
            'PromotedDate'=>'PromotedDate',
        );
    }
/**
     * @author Haribabu
     * @param type $userid
     * @method c save curbsidepost
     * @return object type id value
     */
       public function SaveCurbsidePost($postObj,$hashTagIdArray,$userHirarchy){
        try {
            
            $returnValue='failure';            
            $CurbsidePostObj=new CurbsidePostCollection();
            $CurbsidePostObj->Type=(int)$postObj->Type;
            $CurbsidePostObj->UserId=(int)$postObj->UserId;
            $CurbsidePostObj->PostedBy=(int)$postObj->PostedBy;
            if(isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)){
                 $CurbsidePostObj->CreatedOn=new MongoDate(strtotime(date($postObj->CreatedOn, time())));
             }else{
                 $CurbsidePostObj->CreatedOn=new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
             }
            $CurbsidePostObj->Description=stripslashes($postObj->Description);
            $CurbsidePostObj->Comments=array();            
            $CurbsidePostObj->Love=array();                       
            $CurbsidePostObj->Followers=array();
            array_push($CurbsidePostObj->Followers, $CurbsidePostObj->UserId);
            $CurbsidePostObj->Resource =array();
            $CurbsidePostObj->Mentions=$postObj->Mentions;
            $CurbsidePostObj->HashTags=$hashTagIdArray;
            $CurbsidePostObj->Invite=array();
            $CurbsidePostObj->Share=array();
            $CurbsidePostObj->Subject=$postObj->Subject;
            $CurbsidePostObj->CategoryId=(int)$postObj->Category;
            $CurbsidePostObj->NetworkId=(int)$postObj->NetworkId;            
            if($postObj->IsFeatured==1){
              $CurbsidePostObj->FeaturedUserId=(int)$postObj->UserId;  
              $CurbsidePostObj->FeaturedOn=new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
             }
            $CurbsidePostObj->IsFeatured=$postObj->IsFeatured;
            $CurbsidePostObj->IsBlockedWordExist=(int)$postObj->IsBlockedWordExist;
            
             $CurbsidePostObj->WebUrls=$postObj->WebUrls;
             $CurbsidePostObj->IsWebSnippetExist=(int)$postObj->IsWebSnippetExist;
             $CurbsidePostObj->MigratedPostId = isset($postObj->MigratedPostId)?$postObj->MigratedPostId:'';
              if(isset($userHirarchy)){
                  $CurbsidePostObj->District=(int)$userHirarchy->District;
                  $CurbsidePostObj->Division=(int)$userHirarchy->Division;
                  $CurbsidePostObj->Region=(int)$userHirarchy->Region;
                  $CurbsidePostObj->Store=(int)$userHirarchy->Store;
              }
            if($CurbsidePostObj->save()){
                $returnValue=$CurbsidePostObj->_id;
            }
            return $returnValue;
        } catch (Exception $exc) {  
          
            Yii::log($exc->getMessage(),'error','application');
        }
        }
  
/**
     * @author Haribabu
     * @param type $userid
     * @method update curbsidepost resources
     * @return object type id value
     */
    public function updateCurbsidePostWithArtifacts($postId,$resourceArray){
      try {
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;              
           $mongoModifier->addModifier('Resource', 'push', $resourceArray); 
           $mongoCriteria->addCond('_id', '==', new MongoID($postId));  
           CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
      } catch (Exception $exc) {
          Yii::log($exc->getMessage()."=============updatePostWithArtifactst curbsidepost collection",'error','application');
      }
    } 
    
    /**
     * @author suresh reddy
     * @param $postId postid of curbside post
     * @comments comments of post  which done by user
     */
      public function saveComment($postId,$comments){
      try {
          
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;  
           $mongoModifier->addModifier('Comments', 'push', $comments);
           $mongoCriteria->addCond('_id', '==', new MongoId($postId));
           CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
           
      } catch (Exception $exc) {         
          error_log("CBE");
        Yii::log($exc->getMessage()."In save comment curbside collection",'error','application');
      }
    }
    /**
     * @autho surehsh reddy
     * 
     */
      public function followOrUnfollowPost($postId, $userId, $actionType) {
        try {
            $returnValue = 'failure';
             // throw new Exception('Unable to save love');
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($actionType == 'Follow') {
                $mongoModifier->addModifier('Followers', 'push', (int)$userId);
                $mongoCriteria->addCond('Followers', '!=', (int)$userId);
            } else if($actionType == 'UnFollow'){
                $mongoModifier->addModifier('Followers', 'pop', (int)$userId);
            }

            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            if(CurbsidePostCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
                $returnValue = 'success';
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
             return $returnValue;
        }
    }
    /**
     * @author suresh reddy
     * @param type $postId
     * @return type
     */
        public function getPostById($postId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = CurbsidePostCollection::model()->find($criteria);
            if (is_object($postObj)) {
                $returnValue = $postObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
        
    
    /**
     * @author suresh reddy
     * @param $postId 
     */
    public function getLoveUserIdsByPostId($postId){
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Love'=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $loveObjForPost = CurbsidePostCollection::model()->find($criteria);
            if (isset($loveObjForPost->Love)) {                
                $returnValue =$loveObjForPost->Love;
                          }
            return $returnValue;
        } catch (Exception $exc) {
            echo 'In post collection'.$exc->getMessage();
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    /**
     * @author suresh reddy
     * @param type $postId
     * @param type $userId
     * @return string
     */
        public function loveNormalPost($postId,$userId){
      try {
            $returnValue=FALSE;
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;           
           $mongoModifier->addModifier('Love', 'push', (int)$userId);
           $mongoCriteria->addCond('_id', '==', new MongoId($postId));
           $mongoCriteria->addCond('Love', '!=', (int)$userId);
           if(CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria)){
                $returnValue=TRUE;
           }
           return $returnValue;
           
      } catch (Exception $exc) {
         Yii::log($exc->getMessage(),'error','application');
         return FALSE;
      }
    }
    /**
     * @autho suresh reddy
     * @param type $postId
     * @return type
     */
     public function getPostObjectFollowers($postId){
             
            $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Followers'=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $objFollowers = CurbsidePostCollection::model()->find($criteria);
            if (isset($objFollowers->Followers)) {
                $returnValue =$objFollowers->Followers;
                          }
        } catch (Exception $exc) {
            Yii::log("==getPostObjectFollowers In Post collection==".$exc->getMessage(), 'error', 'application');
        }
        return $returnValue;
       
        }
        /**
         * this method is used for save invites for curbside psot
         * @autho suresh reddy
         * @param type $UserId
         * @param type $PostId
         * @param type $InviteText
         * @param type $Mentions
         * @return string
         */
         public function saveInvites($UserId, $PostId, $InviteText, $Mentions) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $inviteArray = array();
            array_push($inviteArray, (int)$UserId);
            array_push($inviteArray, array_unique($Mentions));
            array_push($inviteArray, $InviteText);
            $mongoModifier->addModifier('Invite', 'push', $inviteArray);
            $mongoCriteria->addCond('_id', '==', new MongoID($PostId));
            $return = CurbsidePostCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $exc) {
            Yii::log($exc->getMessage() . "In event post collection event attende", 'error', 'application');
        }

    }
    
    /**
     * @author karteek.v
     * @param type $postIdsArray
     * @return array
     */
    public function getPostByIds($postIdsArray) {
        try {
            $postIdsArray = array_unique($postIdsArray);
            $returnValue = array();// only one time it will be flushed
            $i =0;
            foreach ($postIdsArray as $rw) {
                $returnArr = array(); // each and every iteration it will be flushed
                $criteria = new EMongoCriteria;
                $criteria->addCond('_id', '==', new MongoID($rw));
                $postObj = CurbsidePostCollection::model()->find($criteria);
                if (is_object($postObj)) {
                        $returnArr['PostId'] = $rw;
                        $returnArr['LoveUserId'] = $postObj->UserId;
                        $returnArr['Description'] = $postObj->Description;
                        $returnArr['LoveCount'] = count($postObj->Love);
                        $returnArr['CommentCount'] = count($postObj->Comments);
                        $returnArr['FollowCount'] = count($postObj->Followers);
                        array_push($returnValue, $returnArr);
                }
            }// updating stream collection
            PostCollection::model()->updateStreamPostCountsFromNodeRequest($returnValue);
//            $this->updateStreamPostCountsFromNodeRequest($returnValue);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar Pathapelli
     * @Description Abuse a post
     * @param type $postId
     * @param string $actionType
     * @param type $userId
     * @return string
     */
    public function abusePost($postId, $actionType, $userId="", $isBlockedPost=0){
        try {
             $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;  
             Yii::log('****************888******'.$actionType,'error','application');
             if($actionType=='Abuse'){
                 $mongoModifier->addModifier('IsAbused', 'set', 1);
                 $mongoModifier->addModifier('AbusedUserId', 'set', (int)$userId);
                 $mongoModifier->addModifier('AbusedOn','set',new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
             }elseif ($actionType=="Block") {
                 if($isBlockedPost==0){
                 $mongoModifier->addModifier('IsAbused', 'set', 2);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 2);
                 }
             }elseif ($actionType=="Release") {
                 if($isBlockedPost==0){
                 $mongoModifier->addModifier('IsAbused', 'set', 0);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 0);
             }
             }
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));  
             $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             return 'success';

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
    }
    /**
     * @author Sagar Pathapelli
     * @Description promote the post
     * @param type $postId
     * @param type $userId
     * @param type $promoteDate
     * @param type $categoryId
     * @param type $networkId
     * @return string
     */
    public function promotePost($postId, $userId, $promoteDate){
        try {          
             $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;           
             $mongoModifier->addModifier('IsPromoted', 'set', 1);
             $mongoModifier->addModifier('PromotedUserId', 'set', (int)$userId);
             $mongoModifier->addModifier('PromotedDate','set',new MongoDate(strtotime($promoteDate)));
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));  
             $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             return 'success';

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
    }
    public function deletePost($postId){
        try {          
             $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;           
             $mongoModifier->addModifier('IsDeleted', 'set', 1);
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));
             $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             return 'success';
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
    }
    /**
     * @author Sagar Pathapelli
     * @Description deleting a post
     * @param type $postId
     * @param type $categoryId
     * @param type $networkId
     * @return string
     */
    public function getAbusedposts() {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('IsAbused', '==', 1);
            $postObj = CurbsidePostCollection::model()->findAll($criteria);
            if (is_object($postObj)) {
                $returnValue = $postObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
     /**
     * @author Vamsi Krishna
     * @Description this method is to get the comments for post
     * @param type $postId
      *@return success=> array failure=>String
     */
    
     public function getPostCommentsByPostId($postId){
    try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
           // $criteria->setSelect(array('Comments='=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = CurbsidePostCollection::model()->find($criteria);
            
            if (isset($postObj->Comments)) {
                $returnValue =$postObj->Comments;
                }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }  
  } 
  /**
   * @author Sagar Pathapelli
   * @param type $postId
   * @return 
   */
  public function getInvitedUsersForPost($postId) {

        $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Invite' => true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $objFollowers = CurbsidePostCollection::model()->find($criteria);
            if (isset($objFollowers->Invite)) {
                $returnValue = $objFollowers->Invite;
            }
        } catch (Exception $exc) {
            Yii::log("==getInvitedUsersForPost In Post collection==" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
        return $returnValue;
    }
    
     /**
   * @author Moin Hussain
   * @param $searchText,$offset,$pageLength
   * @return 
   */
    public function getCurbPostsForSearch($searchText,$offset,$pageLength){
        try {   
        $array = array(
            'conditions' => array(
                'Description' => array('eq' => new MongoRegex('/' . $searchText . '.*/i')),
                'IsDeleted'=>array('!=' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
            ),
             
            'limit' => $pageLength,
            'offset' => $offset,
            'sort' => array('_id' => EMongoCriteria::SORT_DESC),
        );
        
            
            
            $posts = CurbsidePostCollection::model()->findAll($array);
            $postsArray = array();
            foreach($posts as $post){
                 $tagsFreeDescription= strip_tags(($post->Description));
                  $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
                 $postLength =  strlen($tagsFreeDescription);
            if($postLength>240){
                 $post->Description =  CommonUtility::truncateHtml($post->Description, 240,'...',true,true,' <i class="fa fa-ellipsis-h moreicon"></i>'); 
                 $post->Description = $post->Description;
            }
              $user =  UserCollection::model()->getTinyUserCollection($post->UserId);
               array_push($postsArray, array($post,$user->DisplayName,"2"));
}
 } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
           return $postsArray;
         
}
 public function getCurbPostsForHashtag($hashtagId, $offset, $pageLength) {
 try { 
        $array = array(
            'conditions' => array(
                'HashTags' => array('in' => array(new MongoId($hashtagId))),
                'IsDeleted'=>array('!=' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
            ),
            'limit' => $pageLength,
            'offset' => $offset,
            'sort' => array('_id' => EMongoCriteria::SORT_DESC),
        );

        $posts = CurbsidePostCollection::model()->findAll($array);
        $postsArray = array();
        foreach ($posts as $post) {
             $tagsFreeDescription= strip_tags(($post->Description));
             $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
             $postLength =  strlen($tagsFreeDescription);
            if($postLength>240){
                 $post->Description =  CommonUtility::truncateHtml($post->Description, 240); 
                 $post->Description = $post->Description.' <i class="fa fa-ellipsis-h moreicon"></i>';
            }
            $user = UserCollection::model()->getTinyUserCollection($post->UserId);
            array_push($postsArray, array($post, $user->DisplayName, "2"));
        }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $postsArray;
    }
      /**
     * @author Vamsi Krishna
     * @param type $userId
     * @param type $postId
     * @return string
     */
    public function markPostAsFeatured($postId, $userId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('IsFeatured', 'set', (int)1);
            $mongoModifier->addModifier('FeaturedUserId', 'set', (int) $userId);
            $mongoModifier->addModifier('FeturedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            $return = CurbsidePostCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

     public function getCurbPostsCountForHashtag($hashtagId) {

        $array = array(
            'conditions' => array(
                'HashTags' => array('in' => array(new MongoId($hashtagId))),
                'IsDeleted'=>array('!=' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
            ),
           
        );

        $posts = CurbsidePostCollection::model()->findAll($array);
        return count($posts);
    }
   
     /**
     * @author Vamsi Krishna
     * @param type $userId
     * @param type $postId
     * @return string
     */
    public function UnmarkPostAsFeatured($postId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;            
            $mongoModifier->addModifier('IsFeatured', 'set', (int)0);            
            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            $return = CurbsidePostCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    /**
     * @author Sagar Pathapelli
     * This method is used to  update Post When Comment is Abused/Blocked/Released
     * @param type $postId
     * @param string $actionType  (Abuse/Block/Release)
     * @return string
     */
    public function updatePostWhenCommentAbused($postId, $actionType){
        try { 
             $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;           
             if($actionType=='Abuse'){
                 $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 1);
             }elseif ($actionType=="Block") {
                $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 2);
             }elseif ($actionType="Release") {
                $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 0);
             }
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));  
             $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             return 'success';

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
    }
    /**
     * @author Sagar Pathapelli
     * This method is used to Block/Release the post based on action type
     * @param type $postId
     * @param type $commentId
     * @param string $actionType (Block/Release)
     * @return string
     */
    public function blockOrReleaseComment($postId, $commentId, $actionType){
        try {
            $returnValue="failure";
             $mongoCriteria = new EMongoCriteria;
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));  
             $mongoCriteria->Comments->CommentId("==" ,new MongoID($commentId)); 
             $mongoModifier = new EMongoModifier;   
             if ($actionType=="Block") {
                $mongoModifier->addModifier('Comments.$.IsBlockedWordExist', 'set', 2);
             }elseif ($actionType="Release") {
                $mongoModifier->addModifier('Comments.$.IsBlockedWordExist', 'set', 0);
             }
             $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             if($returnValue){
                $criteria = new EMongoCriteria;
                $criteria->addCond('_id', '==', new MongoId($postId));
                $criteria->Comments->IsBlockedWordExist("==" ,1); 
                $obj = CurbsidePostCollection::model()->find($criteria);
                if (!is_object($obj)) {
                    $criteria = new EMongoCriteria;
                    $criteria->addCond('_id', '==', new MongoId($postId));
                    $mongoModifier = new EMongoModifier;  
                    $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 0);
                    $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$criteria);
                    if($returnValue){
                        $returnValue = 'PostReleased';
                    }
                }else{
                    $returnValue = 'CommentReleased';
                }
             }
             return $returnValue;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
           return $returnValue;
        }
    }
    /**
     * @author Sagar
     * @Usage get comment object using post id and comment id
     * @param type $postId
     * @param type $commentId
     * @return type
     */
    public function getCommentById($postId, $commentId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postId));
            $criteria->Comments->CommentId("==" ,new MongoId($commentId)); 
            $criteria->setSelect(array('Comments.$'=>true));
            $postObj = CurbsidePostCollection::model()->find($criteria);
            if (is_object($postObj)) {
                $returnValue = $postObj->Comments[0];
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function getAllPostsHaveBlockedComments() {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('IsBlockedWordExistInComment', '==', 1);
            $postObj = CurbsidePostCollection::model()->findAll($criteria);
            $returnValue = $postObj;
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function getAllBlockedPosts() {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('IsBlockedWordExist', '==', 1);
            $postObj = CurbsidePostCollection::model()->findAll($criteria);
            $returnValue = $postObj;
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function releasePostHaveBlockedComments($postId){
        try{
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoId($postId));
            $mongoModifier = new EMongoModifier;  
            $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 0);
            $returnValue=CurbsidePostCollection::model()->updateAll($mongoModifier,$criteria);
            if($returnValue){
                $returnValue = 'success';
            }
            return $returnValue;
        }catch(Exception $ex){
            return $returnValue;
        }
    }
    public function saveSharedList($postId, $userId, $shareType){
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if($shareType=='FbShare'){
                $mongoModifier->addModifier('FbShare', 'push', (int)$userId);
                $mongoCriteria->addCond('FbShare', '!=', (int)$userId);
            }elseif ($shareType="TwitterShare") {
                $mongoModifier->addModifier('TwitterShare', 'push', (int)$userId);
                $mongoCriteria->addCond('TwitterShare', '!=', (int)$userId);
            }
            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            if(CurbsidePostCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
                $returnValue = 'success';
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("===PostCollection->saveSharedList=========".$exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    /**
     * @author Karteek V
     * This is used to fetch the conversations count in the curbside for analytics...
     * @return type
     */
    public function getConversationCount(){
        try{
            return CurbsidePostCollection::model()->count();            
        } catch (Exception $ex) {
            error_log("#################Exception Occurred############".$ex->getMessage());
        }
    }
    
     public function GetCurbsidePostsBetweenDates($startDate,$endDate,$IsFeatured,$Ispromoted,$NetworkId){
        try {       
             $returnValue='failure';
             $startDate=date('Y-m-d',strtotime($startDate));
            $endDate=date('Y-m-d',strtotime($endDate));
            $criteria = new EMongoCriteria;
             $endDate =$endDate." 23:59:59";
            $startDate =$startDate." 00:00:00";
           
            
            $startDate=date('Y-m-d H:i:s',strtotime($startDate));
            $endDate=date('Y-m-d H:i:s',strtotime($endDate));
            $criteria->addCond('NetworkId', '==', (int)$NetworkId);
             if($IsFeatured=='0' && $Ispromoted=='0'){
                 $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
             }
             if($IsFeatured !='0'){
                
                $criteria->addCond('IsFeatured', '==', (int)$IsFeatured);
                $criteria->FeaturedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
                
            }
            if($Ispromoted !='0'){
               
                $criteria->addCond('IsPromoted', '==', (int)$Ispromoted);
                $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
            }
            $curbsideposts = CurbsidePostCollection::model()->findAll($criteria); 
            if(is_array($curbsideposts)){
                $returnValue=count($curbsideposts);
            }
            return $returnValue;

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
     }
     
   public function getCurbsidePostForDailyDigest($startDate,$endDate){
       $returnValue='failure';
       try {
            $criteria = new EMongoCriteria;
            $criteria->limit(1);
            $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
            $CurbsidePost=CurbsidePostCollection::model()->find($criteria); 
            if(is_array($CurbsidePost)){
                $returnValue=$CurbsidePost;
            }
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
           
       }
       return $returnValue;
      }  
    public function getPostIdByMigratedPostId($PostId) {
        try {
            $postObj = CurbsidePostCollection::model()->findByAttributes(array('MigratedPostId' => $PostId));
            return $postObj;
        } catch (Exception $exc) {
            error_log("getPostIdByMigratedPostId== " . $exc->getTraceAsString());
        }
    }
      public function getCurbsidePostByIds($postId) {
        try {
//            $postIdsArray = array_unique($postIdsArray);
            $returnValue = array();// only one time it will be flushed
            $returnArr = array();
            $i =0;
//            error_log("==post Id===========$postId");
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = CurbsidePostCollection::model()->find($criteria);
            if (is_object($postObj)) {
                        foreach ($postObj->_id as $rw) {
                            $returnArr['PostId'] = $rw;
                        }
                        $returnArr['LoveUserId'] = $postObj->UserId;
                        $returnArr['Description'] = $postObj->Description;
                        $returnArr['LoveCount'] = count($postObj->Love);
                        $count = 0;
                        foreach ($postObj->Comments as $key=>$value) {
                            if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
                                $count++;
                            }
                        }
                        $returnArr['CommentCount'] =$count;
                        $returnArr['FollowCount'] = count($postObj->Followers);
              }
              if(!empty($returnArr))
                PostCollection::model()->updateStreamPostCountsFromNodeRequest($returnArr);
            return $returnArr;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getCurbPostsForCategory($categoryId, $offset, $pageLength) {
    try { 
           $array = array(
               'conditions' => array(                
                   'CategoryId'=>array('=='=>(int)$categoryId),
                   'IsDeleted'=>array('!=' => 1),
                   'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                   'IsAbused'=>array('notIn' => array(1,2)),
               ),
               'limit' => $pageLength,
               'offset' => $offset,
               'sort' => array('_id' => EMongoCriteria::SORT_DESC),
           );

           $posts = CurbsidePostCollection::model()->findAll($array);
           $postsArray = array();
           foreach ($posts as $post) {
                $tagsFreeDescription= strip_tags(($post->Description));
                $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
                $postLength =  strlen($tagsFreeDescription);
               if($postLength>240){
                    $post->Description =  CommonUtility::truncateHtml($post->Description, 240); 
                    $post->Description = $post->Description.' <i class="fa fa-ellipsis-h moreicon"></i>';
               }
               $user = UserCollection::model()->getTinyUserCollection($post->UserId);
               array_push($postsArray, array($post, $user->DisplayName, "2"));
           }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $postsArray;
       }
       
 public function getCurbPostsForHashtagSearch($postIdArray) {
 try { 
         $returnValue = 'failure';
            $postsArray=array();
          
            for($i=0;$i<sizeof($postIdArray);$i++){
               
            $criteria = new EMongoCriteria;
                $criteria->addCond('_id', '==', new MongoID($postIdArray[$i]));
                $postObj = CurbsidePostCollection::model()->findAll($criteria);


                foreach ($postObj as $post) {
                    $tagsFreeDescription = strip_tags(($post->Description));
                    $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
                    $postLength = strlen($tagsFreeDescription);
                    if ($postLength > 240) {
                        $post->Description = CommonUtility::truncateHtml($post->Description, 240);
                        $post->Description = $post->Description . ' <i class="fa fa-ellipsis-h moreicon"></i>';
                    }
                    $user = UserCollection::model()->getTinyUserCollection($post->UserId);
                    array_push($postsArray, array($post, $user->DisplayName, "2"));
                }
            }
            
             return $postsArray;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $postsArray;
    }
    
     /**
     * @author Swathi
     * This is used to fetch the curbside posts by userId
     * @param int $userId UserId
     * @return type
     */
     public function getAllCurbsidePostsByUserId($userId){
        try {       
            $returnValue='failure';
            
            
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('HashTags'=>true));
            $criteria->addCond('UserId', '==', (int)$userId);
            $criteria->addCond('IsDeleted','!=',(int)1);
            $criteria->addCond('IsBlockedWordExist','notin',array(1, 2));
            $criteria->addCond('IsAbused','notin',array(1, 2));
            $allposts = CurbsidePostCollection::model()->findAll($criteria); 
            
           // print_r($allposts);exit;
            return $allposts;

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
     }

}