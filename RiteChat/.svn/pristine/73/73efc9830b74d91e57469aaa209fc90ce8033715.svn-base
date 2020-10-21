<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PostCollection extends EMongoDocument {
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
    public $StartDate;
    public $EndDate;
    public $Location;
    public $EventAttendes;
    
    public $StartTime;
    public $EndTime;
    public $WebUrls;
    public $OptionOneCount;
    public $OptionTwoCount;
    public $OptionThreeCount;
    public $OptionFourCount;
    public $OptionOne;
    public $OptionTwo;
    public $OptionThree;
    public $OptionFour;
    public $IsAbused=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
    public $AbusedUserId;
    public $IsDeleted=0;
    public $IsPromoted=0;
    public $PromotedUserId;
    public $AbusedOn;
    public $NetworkId;
    public $SurveyTaken; 
    public $ExpiryDate;
    public $DisableComments=0;
    public $IsBlockedWordExist=0;
    public $IsFeatured = 0;
    public $FeaturedUserId;
    public $FeaturedOn;
    public $IsBlockedWordExistInComment=0;
    public $IsWebSnippetExist = 0;
    public $Division=0;
    public $District=0;
    public $Region=0;
    public $Store=0;
    public $FbShare;
    public $TwitterShare;
    public $Title;
    public $MigratedPostId='';
    //$postedBy is added by Sagar for PostAsNetwork
    public $PostedBy=0;
     public $PromotedDate;
    public function getCollectionName() {
        return 'PostCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    public function rules()
    {
        return array(
         

    
            array('EventAttendes', 'unique', 'attributeName'=> 'EventAttendes', 'caseSensitive' => 'false'),

          
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
            'StartDate' => 'StartDate',
            'EndDate' => 'EndDate',
            'Location'=>'Location',
            'EventAttendes'=>'EventAttendes',
              'OptionOneCount'=>'OptionOneCount',
            'OptionTwoCount'=>'OptionTwoCount',
              'OptionThreeCount'=>'OptionThreeCount',
             'OptionFourCount'=>'OptionFourCount',
              'WebUrls'=>'WebUrls',
            'StartTime'=>'StartTime',
            'EndTime'=>'EndTime',
            'IsAbused'=>'IsAbused',
            'AbusedUserId'=>'AbusedUserId',
            'IsDeleted'=>'IsDeleted',
            'IsPromoted'=>'IsPromoted',
            'PromotedUserId'=>'PromotedUserId',
            'AbusedOn'=>'AbusedOn',

            'NetworkId'=>'NetworkId',
            'SurveyTaken'=>'SurveyTaken',
            'OptionOne'=>'OptionOne',
            'OptionTwo'=>'OptionTwo',
            'OptionThree'=>'OptionThree',
            'OptionFour'=>'OptionFour',
            'ExpiryDate'=>'ExpiryDate',
            'DisableComments'=>'DisableComments',
            'IsBlockedWordExist'=>'IsBlockedWordExist',
            'IsFeatured' => 'IsFeatured',
            'FeaturedUserId' => 'FeaturedUserId',
            'FeaturedOn' => 'FeaturedOn',
            'IsBlockedWordExistInComment'=>'IsBlockedWordExistInComment',
            'IsWebSnippetExist'=>'IsWebSnippetExist',
            'Division'=>'Division',
            'District'=>'District',
            'Region'=>'Region',
            'Store'=>'Store',
            'FbShare'=>'FbShare',
            'TwitterShare'=>'TwitterShare',
            'Title'=>'Title',
            'MigratedPostId'=>'MigratedPostId',
            'PostedBy'=>'PostedBy',
            'PromotedDate'=>'PromotedDate',
        );
    }
  public function followOrUnfollowPost($postId, $userId, $actionType) {
        try {
            $returnValue = 'failure';
            // throw new Exception('Unable to follow or unfollow');
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($actionType == 'Follow') {
                $mongoModifier->addModifier('Followers', 'push', (int)$userId);
                $mongoCriteria->addCond('Followers', '!=', (int)$userId);
            } else if($actionType == 'UnFollow'){
                $mongoModifier->addModifier('Followers', 'pull', (int)$userId);
            }

            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            if(PostCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
                $returnValue = 'success';
            }
            
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function loveNormalPost($postId,$userId){
      try {          
           $returnValue=FALSE;
           //throw new Exception('Unable to save love');
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;           
           $mongoModifier->addModifier('Love', 'push', (int)$userId);
           $mongoCriteria->addCond('_id', '==', new MongoId($postId));
           $mongoCriteria->addCond('Love', '!=', (int)$userId);         
           if(PostCollection::model()->updateAll($mongoModifier,$mongoCriteria)){
               $returnValue=TRUE;
           }
           
           return $returnValue;
      } catch (Exception $exc) {
          error_log($exc->getMessage());
         Yii::log($exc->getMessage(),'error','application');
         return FALSE;
      }
      
    }
  public function saveComment($postId,$comments){
      try {
           $returnValue = FALSE;
          //throw new Exception('Division by zero.');
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;  
           $mongoModifier->addModifier('Comments', 'push', $comments);
           $mongoCriteria->addCond('_id', '==', new MongoId($postId));
           if(PostCollection::model()->updateAll($mongoModifier,$mongoCriteria)){
               $returnValue = TRUE;
           }else{
           }
             return $returnValue;
      } catch (Exception $exc) {         
        Yii::log($exc->getMessage()."In save comment post collection",'error','application');
        return FALSE;
      }
     
    }
    /**
     * 
     * @param type $postId
     * @param type $resourceArray
     */
  public function updatePostWithArtifacts($postId,$resourceArray){
      try {
         
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;              
           $mongoModifier->addModifier('Resource', 'push', $resourceArray); 
           $mongoCriteria->addCond('_id', '==', new MongoID($postId));           
           PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
      } catch (Exception $exc) {
          Yii::log($exc->getMessage()."=============updatePostWithArtifactst post collection",'error','application');
      }
    }
  public function saveOrRemoveEventAttende($postId,$userId,$actionType){
      try {
          $returnValue='failure';
          $mongoCriteria = new EMongoCriteria;
          $mongoModifier = new EMongoModifier; 
          if($actionType=='Attend'){
           $mongoModifier->addModifier('EventAttendes', 'push', (int)$userId); 
           $mongoCriteria->addCond('EventAttendes', '!=', (int)$userId);
          }else{
              $mongoCriteria->addCond('EventAttendes', '==', (int)$userId); 
           $mongoModifier->addModifier('EventAttendes', 'pop', (int)$userId);    
          }          
          $mongoCriteria->addCond('_id', '==', new MongoID($postId)); 
          $return=PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
           return 'success';
          
      } catch (Exception $exc) {
         Yii::log($exc->getMessage()."In event post collection event attende",'error','application');
      }
    }
   public function getPostObjectFollowers($postId){
             
            $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Followers'=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $objFollowers = PostCollection::model()->find($criteria);
            if (isset($objFollowers->Followers)) {
                $returnValue =$objFollowers->Followers;
                          }
        } catch (Exception $exc) {
            Yii::log("==getPostObjectFollowers In Post collection==".$exc->getMessage(), 'error', 'application');
        }
        return $returnValue;
       
        }
    public function getPostById($postId) {
        try {
            
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = PostCollection::model()->find($criteria);
            if (is_object($postObj)) {
                $returnValue = $postObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function getLoveUserIdsByPostId($postId){
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Love'=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $loveObjForPost = PostCollection::model()->find($criteria);
            if (isset($loveObjForPost->Love)) {                
                $returnValue =$loveObjForPost->Love;
                          }
            return $returnValue;
        } catch (Exception $exc) {
            echo 'In post collection'.$exc->getMessage();
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function saveInvites($UserId, $PostId, $InviteText, $Mentions) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $inviteArray = array();
           // throw new Exception('Division by zero.');
            array_push($inviteArray, (int)$UserId);
            array_push($inviteArray, array_unique($Mentions));
            array_push($inviteArray, $InviteText);
            $mongoModifier->addModifier('Invite', 'push', $inviteArray);
            $mongoCriteria->addCond('_id', '==', new MongoID($PostId));
            if(PostCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
            return 'success';
            }
            else{
                return 'failure'; 
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage() . "In event post collection event attende", 'error', 'application');
            error_log("save invites----exception-------------".$exc->getMessage());
            return 'failure';
            
        }

    }
            
    /**
     * @author karteek.v
     * @param type $postIdsArray
     * @return array
     */
    public function getPostByIds($postId) {
        try {
//            $postIdsArray = array_unique($postIdsArray);
            $returnValue = array();// only one time it will be flushed
            $returnArr = array();
            $i =0;
//            error_log("==post Id===========$postId");
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = PostCollection::model()->find($criteria);
            if (is_object($postObj)) {
                    //echo "==ivalue===$i==$rw";
//                    if (isset($postObj->_id) && !empty($postObj->_id)) {
                        foreach ($postObj->_id as $rw) {
                            $returnArr['PostId'] = $rw;
                        }
                        $returnArr['LoveUserId'] = $postObj->UserId;
                        //$returnArr['Description'] = $postObj->Description;
                        $returnArr['LoveCount'] = count($postObj->Love);
                        $count = 0;
                        foreach ($postObj->Comments as $key=>$value) {
                            if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
                                $count++;
                            }
                        }
                        $returnArr['CommentCount'] =$count;
                        $returnArr['FollowCount'] = count($postObj->Followers);
//                        array_push($returnValue, $returnArr);
//                    }
              }
//            foreach ($postIdsArray as $rw) {
//                
//                $returnArr = array(); // each and every iteration it will be flushed
//                $criteria = new EMongoCriteria;
//                $criteria->addCond('_id', '==', new MongoID($rw));
//                $postObj = PostCollection::model()->find($criteria);
////                echo "==ivalue===$i==$rw";
//                if (is_object($postObj)) {
//                    //echo "==ivalue===$i==$rw";
////                    if (isset($postObj->_id) && !empty($postObj->_id)) {
//                        foreach ($postObj->_id as $rw) {
//                            $returnArr['PostId'] = $rw;
//                        }
//                        $returnArr['LoveUserId'] = $postObj->UserId;
//                        $returnArr['Description'] = $postObj->Description;
//                        $returnArr['LoveCount'] = count($postObj->Love);
//                        $count = 0;
//                        foreach ($postObj->Comments as $key=>$value) {
//                            if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
//                                $count++;
//                            }
//                        }
//                        $returnArr['CommentCount'] =$count;
////                        $returnArr['FollowCount'] = count($postObj->Followers);
//                        array_push($returnValue, $returnArr);
////                    }
//                }
//            }// updating stream collection
              if(!empty($returnArr))
                $this->updateStreamPostCountsFromNodeRequest($returnArr);
            return $returnArr;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Karteek.V
     * @param type $streamCountArray
     * Method is used to update the social actions
     * @return void
     */
    public function updateStreamPostCountsFromNodeRequest($streamCountArray){
        try{
            if(isset($streamCountArray[0])){
                foreach($streamCountArray as $mrow){
                    $userStreamObj = new UserStreamBean();
                    $userStreamObj->LoveUserId = $mrow['LoveUserId'];
                    $userStreamObj->PostId = $mrow['PostId'];
                    $userStreamObj->LoveCount = $mrow['LoveCount'];
                    $userStreamObj->CommentCount = $mrow['CommentCount'];
                    $result = UserStreamCollection::model()->isThereByUserId($userStreamObj);
                    echo $result;
                    if(!$result){                    
                        UserStreamCollection::model()->updateStreamSocialActions($userStreamObj);
                    }                
                }
            }else{
                $userStreamObj = new UserStreamBean();
                $userStreamObj->LoveUserId = $streamCountArray['LoveUserId'];
                $userStreamObj->PostId = $streamCountArray['PostId'];
                $userStreamObj->LoveCount = $streamCountArray['LoveCount'];
                $userStreamObj->CommentCount = $streamCountArray['CommentCount'];
                $result = UserStreamCollection::model()->isThereByUserId($userStreamObj);
                echo $result;
                if(!$result){                    
                    UserStreamCollection::model()->updateStreamSocialActions($userStreamObj);
                }                
            }
            
        } catch (Exception $ex) {
            error_log("Exception Occurred in updateStreamPostCounts==".$ex->getMessage());
        }
    }
    public function submitSurvey($UserId, $PostId, $Option) {
        try {  
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $surveyArray = array();
            $surveyArray['UserId'] = (int)$UserId;
            $surveyArray['UserOption'] = $Option;
            $mongoModifier->addModifier('SurveyTaken', 'push', $surveyArray);
            if($Option=='OptionOne'){
                $mongoModifier->addModifier('OptionOneCount', 'inc', 1);
            }elseif($Option=='OptionTwo'){
                $mongoModifier->addModifier('OptionTwoCount', 'inc', 1);
            }elseif($Option=='OptionThree'){
                $mongoModifier->addModifier('OptionThreeCount', 'inc', 1);
            }elseif($Option=='OptionFour'){
                $mongoModifier->addModifier('OptionFourCount', 'inc', 1);
            }
            $mongoCriteria->addCond('_id', '==', new MongoID($PostId));
            if(PostCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
            return 'success';
            }else{
                 return 'failure';
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage() . "In event post collection event attende", 'error', 'application');
            return 'failure';
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
             }elseif ($actionType="Release") {
                 if($isBlockedPost==0){
                     $mongoModifier->addModifier('IsAbused', 'set', 0);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 0);
                 }
             }
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));  
             $returnValue=PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
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
             $returnValue=PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
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
    public function deletePost($postId){
        try {          
             $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;           
             $mongoModifier->addModifier('IsDeleted', 'set', 1);
             $mongoCriteria->addCond('_id', '==', new MongoId($postId));
             $returnValue=PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             return 'success';
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
    }
     
     /**
     * @author Vamsi Krishna
     * @Description this method is to get the comments for post
     * @param type $postId
     * @return success=> array failure=>String
     */
    
  public function getPostCommentsByPostId($postId){
    try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
          //  $criteria->setSelect(array('Comments='=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = PostCollection::model()->find($criteria);   
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
            $objFollowers = PostCollection::model()->find($criteria);
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
   * @author Praneeth
   * Description: getUserSignedUpEventDetails to get the user attending the events
   * @param type $userEventSignedUpActivities, current login
   * @return 
   */
  public function getUserSignedUpEventDetails($userEventSignedUpActivities,$CurrentLoginDate) {

        $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Invite' => true));
            $criteria->addCond('_id', '==', new MongoID($userEventSignedUpActivities));
            $objFollowers = PostCollection::model()->find($criteria);
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
    public function getPostsForSearch($searchText, $offset, $pageLength) {
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
        
        
        $posts = PostCollection::model()->findAll($array);
        $postsArray = array();
        foreach ($posts as $post) {
             
             $tagsFreeDescription= strip_tags(($post->Description));
             $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
             $postLength =  strlen($tagsFreeDescription);
            
            if($postLength>240){
                 $post->Description =  CommonUtility::truncateHtml($post->Description, 240,'...',true,true,' <i class="fa fa-ellipsis-h moreicon"></i>'); 
                 $post->Description = $post->Description;
            }
           
            if(isset($post->UserId)){
            $user = UserCollection::model()->getTinyUserCollection($post->UserId);
            array_push($postsArray, array($post, $user->DisplayName, "1"));
            }
        }
  }catch (Exception $exc) {
            return $postsArray;
        }
        return $postsArray;
    }
     /**
     * @author Moin Hussain
     * @param $hashtagId, $offset, $pageLength
     * @return 
     */
    public function getPostsForHashtag($hashtagId, $offset, $pageLength) {

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

        $posts = PostCollection::model()->findAll($array);
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
            array_push($postsArray, array($post, $user->DisplayName, "1"));
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
            $mongoModifier->addModifier('IsFeatured', 'set', 1);
            $mongoModifier->addModifier('FeaturedUserId', 'set', (int) $userId);
            $mongoModifier->addModifier('FeturedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            $return = PostCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    /**
     * @author Moin Hussain
     * @param $hashtagId, $offset, $pageLength
     * @return 
     */
    public function getPostsCountForHashtag($hashtagId) {

        $array = array(
            'conditions' => array(
                'HashTags' => array('in' => array(new MongoId($hashtagId))),
                 'IsDeleted'=>array('!=' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
            ),
          
        );

        $posts = PostCollection::model()->findAll($array);
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
            $return = PostCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    /**
     * @author Sagar Pathapelli
     * This method is used to  update Post When Comment is Abused/Blocked/Released
     * @param type $postId
     * @param string $actionType
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
             $returnValue=PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
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
           
             $returnValue=PostCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             if($returnValue){
                 
                $criteria = new EMongoCriteria;
                $criteria->addCond('_id', '==', new MongoId($postId));
                $criteria->Comments->IsBlockedWordExist("==" ,1); 
                $obj = PostCollection::model()->find($criteria);
                if (!is_object($obj)) {
                    
                    $criteria = new EMongoCriteria;
                    $criteria->addCond('_id', '==', new MongoId($postId));
                    $mongoModifier = new EMongoModifier;  
                    $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 0);
                    $returnValue=PostCollection::model()->updateAll($mongoModifier,$criteria);
                    if($returnValue){
                        $returnValue = 'PostReleased';
                    }
                }else{
                    $returnValue = 'CommentReleased';
                }
             }
             
             return $returnValue;
        } catch (Exception $exc) {
            error_log("###########".$exc->getMessage());
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
            $postObj = PostCollection::model()->find($criteria);
            
            if (is_object($postObj)) {
                $returnValue = $postObj->Comments[0];
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("___________get comment____________________________".$exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function getAllPostsHaveBlockedComments() {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('IsBlockedWordExistInComment', '==', 1);
            $postObj = PostCollection::model()->findAll($criteria);
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
            $postObj = PostCollection::model()->findAll($criteria);
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
            $returnValue=PostCollection::model()->updateAll($mongoModifier,$criteria);
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
            if(PostCollection::model()->updateAll($mongoModifier, $mongoCriteria)){
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
     * This is used to fetch the conversations count in the Post for analytics...
     * @return type
     */
    public function getConversationCount(){
        try{
            return PostCollection::model()->count();        
        } catch (Exception $ex) {
            error_log("#################Exception Occurred############".$ex->getMessage());
        }
    }
        
   public function GetPostsBetweenDates($startDate,$endDate,$postType,$IsFeatured,$Ispromoted,$NetworkId){
        try {       
             $returnValue='failure';
            $criteria = new EMongoCriteria;
            $startDate=date('Y-m-d',strtotime($startDate));
            $endDate=date('Y-m-d',strtotime($endDate));
            $endDate =trim($endDate)." 23:59:59";
            $startDate =trim($startDate)." 00:00:00";

           $startDate=date('Y-m-d H:i:s',strtotime($startDate));
           $endDate=date('Y-m-d H:i:s',strtotime($endDate));
            
            $criteria->addCond('NetworkId', '==', (int)$NetworkId);
            if($IsFeatured== '0' && $Ispromoted=='0'){
                $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
                if($postType!=0){
                     $criteria->addCond('Type', '==', (int)$postType);
                }
            }
            if($IsFeatured !='0'){
                $criteria->addCond('IsFeatured', '==', (int)$IsFeatured);
                $criteria->FeaturedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
                
            }
            if($Ispromoted!='0'){
                $criteria->addCond('IsPromoted', '==', (int)$IsFeatured);
                $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
            }
            $allposts = PostCollection::model()->findAll($criteria);  
            
            if(is_array($allposts)){
                 $returnValue=count($allposts);
            }

            return $returnValue;

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
     }
     public function getPostIdByMigratedPostId($PostId) {
        try {
            $postObj = PostCollection::model()->findByAttributes(array('MigratedPostId' => $PostId));
            return $postObj;
        } catch (Exception $exc) {
            error_log("getPostIdByMigratedPostId== " . $exc->getTraceAsString());
        }
    }
      public function GetAllPosts(){
        try {       
            $returnValue='failure';
            
            
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('CreatedOn'=>true));
            $allposts = PostCollection::model()->findAll($criteria); 
            
           // print_r($allposts);exit;
            return $allposts;

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
     }
      public function UpdateAllPostsCreatedDate($postId,$createdDate){
        try {       
           $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoId($postId));
            $mongoModifier = new EMongoModifier;  
            $mongoModifier->addModifier('CreatedDate', 'set', $createdDate);
            $returnValue=PostCollection::model()->updateAll($mongoModifier,$criteria);

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
     }
     
     
      public function getPostHashtagsById($postIdArray) {
        try {
            
            
            $returnValue = 'failure';
            $postsArray=array();
          
            for($i=0;$i<sizeof($postIdArray);$i++){
               
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postIdArray[$i]));
            $postObj = PostCollection::model()->findAll($criteria);
  if (sizeof($postObj) > 0) {
         
        foreach ($postObj as $post) {
            
             $tagsFreeDescription= strip_tags(($post->Description));
             $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
             $postLength =  strlen($tagsFreeDescription);
            
            if($postLength>240){
                 $post->Description =  CommonUtility::truncateHtml($post->Description, 240); 
                 $post->Description = $post->Description.' <i class="fa fa-ellipsis-h moreicon"></i>';
            }
            
            $user = UserCollection::model()->getTinyUserCollection($post->UserId);
            array_push($postsArray, array($post, $user->DisplayName, "1"));
        }
  }
        }
        
        return $postsArray;
            
            
            
            
            
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
     /**
     * @author Swathi
     * This is used to fetch the posts of type 1,2 and 3 except anonymous type(Post Type=4) of posts
     * @return type
     */
     public function getAllStreamTypePostsByUserId($userId){
        try {       
            $returnValue='failure';
            
            
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('HashTags' => true));
            $criteria->addCond('Type', '!=', (int) 4);
            $criteria->addCond('UserId', '==', (int) $userId);
            $criteria->addCond('IsDeleted','!=',(int)1);
            $criteria->addCond('IsBlockedWordExist','notin',array(1, 2));
            $criteria->addCond('IsAbused','notin',array(1, 2));
            $allposts = PostCollection::model()->findAll($criteria); 
            
           // print_r($allposts);exit;
            return $allposts;

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
     }
     
     
     
     
}
