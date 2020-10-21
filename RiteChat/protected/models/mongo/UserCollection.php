<?php

/** This is the collection for tiny user where we get the user data to use user data 

 */

class UserCollection extends EMongoDocument {

    public $UserId;
    public $DisplayName;
    public $uniqueHandle;
    public $ProfilePicture;
    public $AboutMe="";
    public $NetworkId;
    public $cookieRandomKey;
    public $profile250x250;
    public $profile70x70;
    public $profile45x45;
    public $Status=0;
   

    public function getCollectionName() {
        return 'TinyUserCollection';
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC,
                ),
            ),
            'index_DisplayName' => array(
                'key' => array(
                    'DisplayName' => EMongoCriteria::SORT_ASC,
                ),
            ),
            'index_uniqueHandle' => array(
                'key' => array(
                    'uniqueHandle' => EMongoCriteria::SORT_ASC,
                ),
            ),
            'index_NetworkId' => array(
                'key' => array(
                    'NetworkId' => EMongoCriteria::SORT_ASC,
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
            'UserId' => 'UserId',
            'DisplayName' => 'DisplayName',
            'uniqueHandle' => 'uniqueHandle',
            'ProfilePicture' => 'ProfilePicture',
            'NetworkId' => 'NetworkId',
            'AboutMe' => 'AboutMe',
            'cookieRandomKey' => 'cookieRandomKey',
            'profile250x250'=>'profile250x250',
            'profile70x70'=>'profile70x70',
            'profile45x45'=>'profile45x45',
            'Status'=>'Status',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
   
    /** 
     
     * this method is used to save the user colletion (tiny user) it accepts the user collection object 
      * if saves to the userCollection it returns the userID 
          */
    public function saveUserCollection($userModel) {
        try {
            $returnValue = 'false';
            $userCollection = new UserCollection();
            $userCollection->UserId=(int)$userModel->UserId;
            $userCollection->DisplayName = $userModel->DisplayName;
            $userCollection->ProfilePicture = Yii::app()->params['ServerURL'] . "/upload/profile/".$userModel->ProfilePicture;
            $userCollection->NetworkId = $userModel->NetworkId;
            $userCollection->AboutMe = $userModel->AboutMe;
            $userCollection->uniqueHandle = $userModel->uniqueHandle;
            $userCollection->Status =isset($userModel->Status)?(int)$userModel->Status:(int)0;
            if($userModel->ProfilePicture=="user_noimage.png"){
                $userCollection->profile250x250 = Yii::app()->params['ServerURL'] . "/upload/profile/".$userModel->ProfilePicture;
                $userCollection->profile70x70 = Yii::app()->params['ServerURL'] . "/upload/profile/".$userModel->ProfilePicture;
                $userCollection->profile45x45 = Yii::app()->params['ServerURL'] . "/upload/profile/".$userModel->ProfilePicture;
            }else{
                $userCollection->profile250x250 = Yii::app()->params['ServerURL'] . "/upload/profile/250x250/".$userModel->ProfilePicture;
                $userCollection->profile70x70 = Yii::app()->params['ServerURL'] . "/upload/profile/70x70/".$userModel->ProfilePicture;
                $userCollection->profile45x45 = Yii::app()->params['ServerURL'] . "/upload/profile/45x45/".$userModel->ProfilePicture;
            }
            $userCollection->insert();
            if (isset($userCollection->_id)) {
                $returnValue = 'true';
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("UserCollection/saveUserCollection====".$exc->getMessage());
        }
    }
   /** This method gets tinyUser collection object from mongo 
    It accepts userId as a paramter and returns faliure string if it didnot find the record and returns 
    * tiny user obj if it finds    */
   public function getTinyUserCollection($userId){
       try {
          $returnValue='failure';
          
            $mongoCriteria = new EMongoCriteria;            
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
            $tinyUserObj = UserCollection::model()->find($mongoCriteria);
            return  $tinyUserObj;
                
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      }

    /**
    * @Author Sagar Pathapelli
    * This method is used get FollowingFollowerUsers
    * @param type $searchKey
    * @param type $followersArray
    * @return type following follower user list
    */
    public function getFollowingFollowerUsers($searchKey,$followersArray) {
        $result = 'failure';
        try {
            $criteria = new EMongoCriteria();
            $criteria->UserId('in',$followersArray);
            $criteria->addCond('Status', '==', (int)1);
                $criteria->DisplayName = new MongoRegex('/'.$searchKey.'.*/i');                
                $tinyUserObj = UserCollection::model()->findAll($criteria);
                if (isset($tinyUserObj)) {
                    $result = $tinyUserObj;
                }
        } catch (Exception $ex) {
            Yii::log("=====getTinyUserById=in=UserCollection======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
    
   /**
    * @Author Sagar Pathapelli
    * This method is used get TinyUserCollectionForNetworkBySearchKey
    * @param type $networkId
    * @param type $searchKey
    * @return type tiny user collection object
    */
   public function getTinyUserCollectionForNetworkBySearchKey($networkId,$searchKey='', $mentionArray=array()){
       try {
          $returnValue='failure';
          
            $mongoCriteria = new EMongoCriteria;    
            //$mongoCriteria->DisplayName = new MongoRegex("/^$searchKey/i");
            if($searchKey!=''){
              $mongoCriteria->addCond('DisplayName', '==', new MongoRegex('/'.$searchKey.'.*/i'));
            }
            $mongoCriteria->addCond('Status','==',(int)1);
            $mongoCriteria->addCond('UserId','notin',$mentionArray);
            $mongoCriteria->addCond('NetworkId', '==',  $networkId);           
            $tinyUserObj = UserCollection::model()->findAll($mongoCriteria);
            $returnValue=$tinyUserObj;
            return  $returnValue;            
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      }
      
   public function getTinyUserObjByNetwork($userId){
       try {
            $returnValue='failure';
          
            $mongoCriteria = new EMongoCriteria;            
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
            //$mongoCriteria->addCond('NetworkId', '==', (int)$networkId);
            $tinyUserObj = UserCollection::model()->find($mongoCriteria);
            if(is_object($tinyUserObj)){
                $returnValue= $tinyUserObj;
            }
            return  $returnValue;
            
           
       } catch (Exception $exc) {
           Yii::log($exc->getMessage()."In user model getTinyUserByNetwork", 'error', 'application');
       }
      }
      
      
      /**
     * @author Praneeth
     * Description: Method to get users list who is following the loggeg user since last login
     * @param type $userFollowersId
     * @return followed users details
     */

    public function getFollowedUserDetailsList($userFollowersId)
    {
        try
        {
            $criteria = new EMongoCriteria();
            $userFollowers=  array_map('intval', $userFollowersId);
            $criteria->UserId('in',$userFollowers);
            $userFollowingObj = UserCollection::model()->findAll($criteria);
            if (isset($userFollowingObj)) {                
                    $returnValue =$userFollowingObj;
                }
        } catch (Exception $ex) {
                 Yii::log("------in exception-------getFollowedUserDetailsList-----------".$ex->getMessage(), 'error', 'application');
        }
        return $returnValue;
    }
    
        /**
     * @author Vamsi Krishna
     * @Description This method is for saving user profile collection by type
     * @params $userId,$type,$value
     * @return  success =>Array failure =>string 
     */
    public function updateProfileDetailsbyType($userId, $type, $value, $imageName='', $absolutePath='') {
        $returnValue = "failure";
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('UserId', '==', (int) $userId);            
            $mongoModifier->addModifier($type, 'set', $value);
            if($type=='ProfilePicture'){
               $mongoModifier->addModifier('profile250x250', 'set', $absolutePath.'/upload/profile/250x250/'.$imageName);
            $mongoModifier->addModifier('profile70x70', 'set', $absolutePath.'/upload/profile/70x70/'.$imageName);
            $mongoModifier->addModifier('profile45x45', 'set', $absolutePath.'/upload/profile/45x45/'.$imageName); 
            }
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            $returnValue ="success";
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("--------", 'error', 'application');
            return $returnValue;
        }
    }
    
      /** 
       * @autho suresh reddy
       * This method gets update users with profile pic     */
   public function updateallUsers(){
       try {
          $returnValue='failure';
          
             $mongoCriteria = new EMongoCriteria;  
               $mongoCriteria->addCond('userId', '==', (int) 1);        
          //   $mongoCriteria->sort(array('userId' => EMongoCriteria::SORT_ASC));
          
            $tinyUserObj = UserCollection::model()->findAll();
            
            foreach ($tinyUserObj as $obj){
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('UserId', '==', (int) $obj->UserId);    
           
            $pic1= str_replace("/profile\/","/profile\/70x70\/",$obj->ProfilePicture);
            $mongoModifier->addModifier('ProfilePicture', 'set', $pic1);
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);  
            }
            
            return  $tinyUserObj;
            
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      }
    
            /** 
       * @autho suresh reddy
       * This method gets update users with profile pic     */
   public function removeGroupsFollowing(){
       try {
          $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
           
            //  $mongoCriteria->sort(array('userId' => EMongoCriteria::SORT_DESC)); 
           $mongoCriteria->addCond('userId', '==', (int) 6);    
            $tinyUserObj = UserProfileCollection::model()->findAll($mongoCriteria);
          
            foreach ($tinyUserObj as $obj){
                echo "********************************".$obj->userId;
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('userId', '==', (int) $obj->userId);    
           
              
            $mongoModifier->addModifier('userVisitedGroupIds', 'set', array());
         $mongoModifier->addModifier('groupsFollowing', 'set', array());
       //     $mongoModifier->addModifier('ProfilePicture', 'set', $pic1);
            UserProfileCollection::model()->updateAll($mongoModifier, $mongoCriteria);  
            
            }
            
            return  $tinyUserObj;
            
    
          
       } catch (Exception $exc) {
           echo "*****************************".$exc->getMessage();
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      }
     
  public function getUserIdbyName($uniqueHandle){
       try {
            $returnValue='failure';
            $uniqueHandlerName = str_replace("%20", ".", $uniqueHandle);
            $mongoCriteria = new EMongoCriteria; 
            $mongoCriteria->setSelect(array('UserId'=>true));
            $mongoCriteria->addCond('uniqueHandle', '==', $uniqueHandlerName);
            //$mongoCriteria->addCond('NetworkId', '==', (int)$networkId);
            $tinyUserObj = UserCollection::model()->find($mongoCriteria);
            if(is_object($tinyUserObj)){
               // error_log("ifffffffffffffffffffff");
                $returnValue= $tinyUserObj->UserId;
            }
            return  $returnValue;
            
           
       } catch (Exception $exc) {
           Yii::log($exc->getMessage()."In user model getTinyUserByNetwork", 'error', 'application');
       }
      }
   public function getAllUsers(){
        $returnValue='failure';
       try {
            $mongoCriteria = new EMongoCriteria;                        
            $tinyUserObj = UserCollection::model()->findAll($mongoCriteria);
            if(is_object($tinyUserObj) || is_array($tinyUserObj)){
                $returnValue =$tinyUserObj;
            }
            
            return  $tinyUserObj;
       } catch (Exception $exc) {
            Yii::log('---'.$exc->getMessage(),'error','application');
           return $returnValue;
       }
      }  
      /*
       * @author Vamsi Krishna
       * This method is used to get all the User Ids for Group Auto Follow
       * 
       */
  public function getAllUsersIds(){
  $returnValue='failure';
  try {
  $mongoCriteria = new EMongoCriteria;    
  $mongoCriteria->setSelect(array('UserId'=>true));
 // $mongoCriteria->addCond('UserId','!=', $userId);
  //$mongoCriteria->limit(20);
  $tinyUserObj = UserCollection::model()->findAll($mongoCriteria);
  if(is_object($tinyUserObj) || is_array($tinyUserObj)){
  $returnValue =$tinyUserObj;
  }

            
  return  $tinyUserObj;
  } catch (Exception $exc) {
  Yii::log('---'.$exc->getMessage(),'error','application');
  return $returnValue;
  }
  } 
  
  public function updateUserStatus($userId,$value){
      $returnValue='failure';
      try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('UserId', '==', (int) $userId);            
            $mongoModifier->addModifier('Status', 'set', (int)$value);
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            $returnValue ="success";
            return $returnValue;
      } catch (Exception $exc) {
          return $returnValue;
          Yii::log($exc->getTraceAsString(),'error','application');
      }
    }
    public function getAllUsersExceptNetworkAdmin($userId)
  {
        $returnValue='failure';
  try {
  $mongoCriteria = new EMongoCriteria;    
  $mongoCriteria->addCond('UserId','!=', $userId);
  $tinyUserObj = UserCollection::model()->findAll($mongoCriteria);
  if(is_object($tinyUserObj) || is_array($tinyUserObj)){
  $returnValue =$tinyUserObj;
  }

            
  return  $tinyUserObj;
  } catch (Exception $exc) {
  Yii::log('---'.$exc->getMessage(),'error','application');
  return $returnValue;
  }
      
  }
  
  public function getTinyUserCollectionWithStatusActive($userId){
       try {
          $returnValue='failure';
          
            $mongoCriteria = new EMongoCriteria;            
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
            $mongoCriteria->addCond('Status', '==', (int)1);
            $mongoCriteria->sort('DisplayName',EMongoCriteria::SORT_ASC);
            //$mongoCriteria->sort('UserId',EMongoCriteria::SORT_DESC);
            $tinyUserObj = UserCollection::model()->find($mongoCriteria);
            return  $tinyUserObj;
                
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      }
      
  public function updateUserCollection($userCollection){
      $returnValue='failure';
      try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('UserId', '==', (int) $userCollection->UserId);            
            $mongoModifier->addModifier('DisplayName', 'set', $userCollection->DisplayName);
            $mongoModifier->addModifier('NetworkId', 'set', $userCollection->NetworkId);
          //  $mongoModifier->addModifier('uniqueHandle', 'set', $userCollection->uniqueHandle);
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            $returnValue ="success";
            return $returnValue;
      } catch (Exception $exc) {
          error_log($exc->getMessage()."==================$$$");
          return $returnValue;
         
      }
    }
    public function getAllUsersByLimit($limitValue){
        $returnValue='failure';
       try {
            $mongoCriteria = new EMongoCriteria; 
            $limitValue=explode(',', $limitValue);
            if(isset($limitValue[1])){
               $limit=$limitValue[1]-$limitValue[0]; 
               $mongoCriteria->limit($limit);
            }
            $offset=$limitValue[0];
            $mongoCriteria->offset($offset);
            $tinyUserObj = UserCollection::model()->findAll($mongoCriteria);
            if(is_object($tinyUserObj) || is_array($tinyUserObj)){
                $returnValue =$tinyUserObj;
            }
            
            return  $tinyUserObj;
       } catch (Exception $exc) {
            Yii::log('---'.$exc->getMessage(),'error','application');
           return $returnValue;
       }
      } 
      public function getTinyUserCollectionWithUserIdList($userIdList){
       try {
          $returnValue='failure';
          
            $mongoCriteria = new EMongoCriteria;  
            $mongoCriteria->addCond('UserId', 'in',$userIdList );
            $tinyUserObjList = UserCollection::model()->findAll($mongoCriteria);
            return  $tinyUserObjList;
                
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      } 
      public function getyUserCollectionCount(){
       try {
          $returnValue='failure';

            $tinyUserCount = UserCollection::model()->count();
            return  $tinyUserCount;
                
       } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
       }
      }
          
   /**
    * @Author Vamsi Krishna
    * This method is used get users for custom badge
    * @param type $searchKey    
    * @return type  user list or String 
    */
    public function getUsersForCustomBadge($searchKey,$followersArray) {
        $result = 'failure';
        try {
            $criteria = new EMongoCriteria();
            $criteria->UserId('notin',$followersArray);
            $criteria->addCond('Status', '==', (int)1);
                $criteria->DisplayName = new MongoRegex('/'.$searchKey.'.*/i');                
                $tinyUserObj = UserCollection::model()->findAll($criteria);
                if (isset($tinyUserObj)) {
                    $result = $tinyUserObj;
                }
        } catch (Exception $ex) {
            Yii::log("=====getTinyUserById=in=UserCollection======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
    
    public function updateStatusAllInactiveUsers($users) {
        try {
            $mongoCriteria = new EMongoCriteria();
            $mongoModifier = new EMongoModifier();
          $mongoCriteria->addCond('UserId', 'in',$users );
            $mongoModifier->addModifier('Status', 'set', (int)3);                
            UserCollection::model()->updateAll($mongoModifier,$mongoCriteria);
              
        } catch (Exception $exc) {
            error_log("********************".$exc->getMessage());
        }
    }

}
