<?php

/* This Collection is Used to store all the profile details of the User
 * 
 * 
 * 
 */

class UserBadgeCollection extends EMongoDocument {

    public $BadgeId;
    public $BadgeLevelValue = 1; //This value indicates the level he reached corresponding to that badge.
    public $IsBadgeShown;
    public $_id;
    public $Type;
    public $UserId;
    public $Priority;
    public $CreatedOn;
    public $Description;
    public $Followers = array();
    public $Mentions = array();
    public $Comments = array();
    public $Resource = array();
    public $Love = array();
    public $Invite = array();
    public $Share = array();
    public $Subject;
    public $CategoryId = 10;
    public $DisableComments = 0;
    public $IsAbused = 0; //0 - Default/Release, 1 - Abused, 2 - Blocked
    public $AbusedUserId;
    public $IsDeleted = 0;
    public $IsPromoted = 0;
    public $PromotedUserId;
    public $NetworkId;
    public $AbusedOn;
    public $IsBlockedWordExist = 0;
    public $IsFeatured = 0;
    public $FeaturedUserId;
    public $FeaturedOn;
    public $IsBlockedWordExistInComment = 0;
    public $WebUrls;
    public $Division = 0;
    public $District = 0;
    public $Region = 0;
    public $Store = 0;
    public $FbShare = array();
    public $TwitterShare = array();
    public $MigratedPostId = '';
    //$postedBy is added by Sagar for PostAsNetwork
    public $PostedBy = 0;
    public $PromotedDate;
    public $IsWebSnippetExist;
    public $HashTags;

    public function getCollectionName() {
        return 'UserBadgeCollection';
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
            )
        );
    }
    public function attributeNames() {
        return array(
            '_id' => '_id',
            'Type' => 'Type',
            'UserId' => 'UserId',
            'Priority' => 'Priority',
            'CreatedOn' => 'CreatedOn',
            'Description' => 'Description',
            'Followers' => 'Followers',
            'Mentions' => 'Mentions',
            'Comments' => 'Comments',
            'Love' => 'Love',
            'Resource' => 'Resource',
            'HashTags' => 'HashTags',
            'Invite' => 'Invite',
            'Share' => 'Share',
            'Subject' => 'Subject',
            'CategoryId' => 'CategoryId',
            'DisableComments' => 'DisableComments',
            'IsAbused' => 'IsAbused',
            'AbusedUserId' => 'AbusedUserId',
            'IsDeleted' => 'IsDeleted',
            'IsPromoted' => 'IsPromoted',
            'PromotedUserId' => 'PromotedUserId',
            'NetworkId' => 'NetworkId',
            'AbusedOn' => 'AbusedOn',
            'IsBlockedWordExist' => 'IsBlockedWordExist',
            'IsFeatured' => 'IsFeatured',
            'FeaturedUserId' => 'FeaturedUserId',
            'FeaturedOn' => 'FeaturedOn',
            'IsBlockedWordExistInComment' => 'IsBlockedWordExistInComment',
            'IsWebSnippetExist' => 'IsWebSnippetExist',
            'WebUrls' => 'WebUrls',
            'Division' => 'Division',
            'District' => 'District',
            'Region' => 'Region',
            'Store' => 'Store',
            'FbShare' => 'FbShare',
            'TwitterShare' => 'TwitterShare',
            'MigratedPostId' => 'MigratedPostId',
            'PostedBy' => 'PostedBy',
            'PromotedDate' => 'PromotedDate',
            'BadgeId' => 'BadgeId',
            'BadgeLevelValue' => 'BadgeLevelValue',
            'IsBadgeShown' => 'IsBadgeShown'
        );
    }

    /* This method is used to save into the user badge collection  
     * it accepts the UserBadgeCollectionObject and returns true or false 
     */

    public function saveUserBadgeCollection($badgeCollectionObj) {

        try {
           
            $userBadgeCollection = new UserBadgeCollection();
            $userBadgeCollection->UserId = (int) $badgeCollectionObj['userId'];
            $userBadgeCollection->BadgeId = (int) $badgeCollectionObj['badgeId'];
            $userBadgeCollection->BadgeLevelValue = $badgeCollectionObj['badgeLevelValue'];
            $userBadgeCollection->IsBadgeShown = $badgeCollectionObj['isBadgeShown'];
            $userBadgeCollection->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            
            if(isset($badgeCollectionObj['Store']) && !empty($badgeCollectionObj['Store']))
            {
                $userBadgeCollection->Store = $badgeCollectionObj['Store'];
            }else{
                $userBadgeCollection->Store = 0;
            }            
            $userBadgeCollection->save();
            if (isset($userBadgeCollection->_id)) {
                $returnValue = $userBadgeCollection->_id;
            } else {

                return 'error';
            }
           
            return $returnValue;

//           
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Swathi
     * @Description This method is use to  get User Badges 
     * @return  success =>Array failure =>string 
     */
    public function getUserBadgeCollectionByCriteria($userId, $badgeId, $limit) {
        $returnValue = 'failure';
        try {

            $array = array(
                'conditions' => array(
                    'UserId' => array('==' => (int) $userId),
                    'BadgeId' => array('==' => (int) $badgeId),
                ),
                'limit' => 1,
                'sort' => array('BadgeLevelValue' => EMongoCriteria::SORT_DESC),
            );
         
            return  UserBadgeCollection::model()->find($array);
        } catch (Exception $exc) {
            Yii::log("-----in getUserBadgeCollection", 'error', 'application');
            return $returnValue;
        }
    }

    public function getUserBadgeCollectionById($id) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->_id = new MongoId($id);
            $ubObj = UserBadgeCollection::model()->find($criteria);
           
            if (is_object($ubObj)) {
                $returnValue = $ubObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Swathi
     * @Description This method is use to  get User Badges 
     * @return  success =>Array failure =>string 
     */
    public function getBadgesNotShownToUser($userId, $limit) {
        $returnValue = 'failure';
        try {

            $array = array(
                'conditions' => array(
                    'UserId' => array('==' => (int) $userId),
                    'IsBadgeShown' => array('==' => (int) 0),
                ),
                'limit' => 1,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_ASC),
            );
            $returnValue = UserBadgeCollection::model()->find($array);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("-----in getUserBadgeCollection", 'error', 'application');
            return $returnValue;
        }
    }

    public function followOrUnfollow($postId, $userId, $actionType) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($actionType == 'Follow') {
                $mongoModifier->addModifier('Followers', 'push', $userId);
                $mongoCriteria->addCond('Followers', '!=', (int) $userId);
            } else if ($actionType == 'UnFollow') {
                $mongoModifier->addModifier('Followers', 'pull', $userId);
            }

            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            $returnValue = UserBadgeCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $ex) {
            Yii::log("-----" . $ex->getMessage(), 'error', 'application');
        }
    }

    public function loveBadgePost($postId, $userId) {
        try {
           
            $returnValue = FALSE;
            //throw new Exception('Unable to save love');
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('Love', 'push', (int) $userId);
            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            $mongoCriteria->addCond('Love', '!=', (int) $userId);
            if (UserBadgeCollection::model()->updateAll($mongoModifier, $mongoCriteria)) {
                $returnValue = TRUE;
            }
         
            return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
            return FALSE;
        }
    }

    public function updateBadgeShownToUser($Id) {

        try {

            $returnValue = FALSE;
            //throw new Exception('Unable to save love');
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
       
            $mongoCriteria->addCond('_id', '==', new MongoId($Id));
            $mongoModifier->addModifier('IsBadgeShown', 'set', (int) 1);

            if (UserBadgeCollection::model()->updateAll($mongoModifier, $mongoCriteria)) {
                $returnValue = TRUE;
            }
           
            return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
            return FALSE;
        }
    }

    public function saveComment($postId, $comments) {
        try {

            
            $returnValue = FALSE;
            //throw new Exception('Division by zero.');
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('Comments', 'push', $comments);
            $mongoCriteria->addCond('_id', '==', new MongoId($postId));
            if (UserBadgeCollection::model()->updateAll($mongoModifier, $mongoCriteria)) {
                $returnValue = TRUE;
            } else {
                
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage() . "In save comment badge collection", 'error', 'application');
            return FALSE;
        }
    }

    public function getBadgeObjectFollowers($postId) {
     
        $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('Followers' => true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $objFollowers = UserBadgeCollection::model()->find($criteria);
            if (isset($objFollowers->Followers)) {
                $returnValue = $objFollowers->Followers;
            }
        } catch (Exception $exc) {
            Yii::log("==getPostObjectFollowers In badge collection==" . $exc->getMessage(), 'error', 'application');
        }
        return $returnValue;
    }

    public function getPostCommentsByPostId($postId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
           
            //  $criteria->setSelect(array('Comments='=>true));
            $criteria->addCond('_id', '==', new MongoID($postId));
            $postObj = UserBadgeCollection::model()->find($criteria);
            if (isset($postObj->Comments)) {
                $returnValue = $postObj->Comments;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    public function getUserBadges($userId){
        try{
            $returnValue = 'failure';
            $badgesArray = array();
            $criteria = new EMongoCriteria;
            $criteria->addCond('UserId', '==', (int)$userId);
            $badgeObject = UserBadgeCollection::model()->findAll($criteria);            
            if(sizeof($badgeObject) > 0){
                foreach($badgeObject as $key=>$value){  
                    $result = Badges::model()->getBadgeById($value->BadgeId);
                    if(isset($result) && !empty($result)){
                        $badgesArray[$key]['hovertxt'] = $result->hover_text;
                        $badgesArray[$key]['badgeName'] = $result->badgeName;                        
                        $badgesArray[$key]['imgpath'] = str_replace('85x100 ','38x44',$result->image_path);
                        $badgesArray[$key]['id'] = $result->id;
                        $badgesArray[$key]['isCustom'] = $result->isCustom;
                    }
                }
            }    
            return $badgesArray;
        } catch (Exception $ex) {
            error_log("########Exception Occurred in the GetUserGadges#######".$ex->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    /**
     * @author Swathi
     * @Description This method is use to  get User Badges
     * @return  success =>Array failure =>string
     */
    public function getUserBadgeCollectionByUserId($userId) {
        $returnValue = 'failure';
        try {

            $array = array(
                'conditions' => array(
                    'UserId' => array('==' => (int) $userId),
                 
                ),
                limit=>5,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
        
            return  UserBadgeCollection::model()->findAll($array);
        } catch (Exception $exc) {
            Yii::log("-----in getUserBadgeCollection", 'error', 'application');
            return $returnValue;
        }
    }
  /**
     * @author Vamsi
     * @Description This method is use to  get Users depending and badge id
     * @return  success =>Array failure =>string
    */ 
    public function getUsersWithBadgeId($badgeId) {
        $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $criteria->addCond('BadgeId', '==', (int)$badgeId);
            $criteria->setSelect(array('UserId'=>true));
            $userDetails=UserBadgeCollection::model()->findAll($criteria);
            if(count($userDetails)>0){
                $returnValue=$userDetails;
            }
            return $returnValue;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function checkIfUserAchievedBadge($userId,$badgeId) {
        $returnValue = 'failure';
        try {
            $criteria=new EMongoCriteria;
            $criteria->addCond('BadgeId', '==', (int)$badgeId);
            $criteria->addCond('UserId', '==', (int)$userId);
            $userBadgeDetails=UserBadgeCollection::model()->find($criteria);            
            if(is_object($userBadgeDetails)){
                $returnValue=$userBadgeDetails;
            }
            return $returnValue;
           
            
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }

}
