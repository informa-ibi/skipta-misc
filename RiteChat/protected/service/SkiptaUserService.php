<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SkiptaUserService{
    /** this method is used to save the user collection 
     */
    public function saveToUserCollection() {
        try {
            $userCollectionModel = new UserCollection();
            $userCollectionModel->DisplayName = 'Skipta';
            $userCollectionModel->Network = 'India';
            $userCollectionModel->ProfilePicture = '';
            $userId = UserCollection::model()->saveUserCollection($userCollectionModel);
            if (isset($userId) && $userId != 'error') {

                $this->saveUserProfile($userId);
               $groups=ServiceFactory::getSkiptaGroupServiceInstance()->getAllAutoFollowGroups();               
               if(!is_string($groups)){
                   foreach($groups as $group){
                    ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToGroup($group->_id,$userId,'Follow', $createddate='');           
                   }
                
               }
               
            }
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }
  /* This Method is used for check the user exist or not */    
     public function checkUserExist($email) {
         try {
              $result = User::model()->checkUserExist($email);
        return $result;
         } catch (Exception $exe) {
             Yii::log($exe->getMessage(), 'error', 'application');
         }
        
    }
    

    
 /* This Method is used for Save the user profile in both mysql and mongo 
      it accepts userprofileForm obj and customForm Obj
  *   */     
    public function SaveUserCollection($userProfileform,$customForm){
     try {
         $userCollectionModel=new UserCollection();
         
         if(isset($userProfileform['country']))
         {
          $NetworkId= Network::model()->getNeworkId($userProfileform['country']);
           (isset($NetworkId) && $NetworkId!='error')?'':$NetworkId=1;               
           $userProfileform['network']=$NetworkId;
         }
         $userId=User::model()->saveUser($userProfileform);  
        if(isset($userId) && $userId!='error'){ 
         $userCollectionModel->UserId=$userId;
          $userCollectionModel->Status=isset($userProfileform['status'])?$userProfileform['status']:0;
         $userCollectionModel->DisplayName=$userProfileform['firstName']." ".$userProfileform['lastName'];
         $userCollectionModel->NetworkId=(int)$NetworkId;
         //$userCollectionModel->NetworkId=(int)1;
         if (CommonUtility::isValidMd5($userProfileform['pass'])) {
            $userCollectionModel->ProfilePicture=$userProfileform['profilePicture'];
         }else{
             $userCollectionModel->ProfilePicture='user_noimage.png';
         }
         $displayName = trim($userCollectionModel->DisplayName);
         $uniqueHandle="";
         if(strlen($displayName)>0){
            $uniqueHandle = $this->generateUniqueHandleForUser($userProfileform['firstName'],$userProfileform['lastName']);
         }else{
             $emailPref = explode("@", $userProfileform['email']);
             $displayName = $emailPref[0];
             $uniqueHandle = $this->generateUniqueHandleForUser($displayName,"");
         }
         $userCollectionModel->uniqueHandle=$uniqueHandle;
         if(isset($userProfileform['aboutMe'])){
             $userCollectionModel->AboutMe=$userProfileform['aboutMe'];
         }
           UserHierarchy::model()->SaveUserHierarchy($userId);
           UserCollection::model()->saveUserCollection($userCollectionModel);  
           $customfieldId=CustomField::model()->saveCustomField($userProfileform,$userId);
           $userprofileid=UserProfileCollection::model()->saveUserProfileCollection($userProfileform,$userId);
           UserNotificationSettingsCollection::model()->saveUserSettings($userId,(int)$NetworkId);
         }
         //$emailCredentials = $this->getEmailCredentialsByTitle('Registration');
         if(isset($userprofileid) && $userprofileid!='error'){
            if (!CommonUtility::isValidMd5($userProfileform['pass'])) {
                $to = $userProfileform['email'];
                $subject = "Your ".Yii::app()->params['NetworkName']." Registration";
                $employerName = "Skipta Admin";
                //$employerEmail = "info@skipta.com"; 
                $messageview="UserRegistrationMail";
                $params = array('myMail' => $userProfileform['firstName'].' '.$userProfileform['lastName']);
                $sendMailToUser=new CommonUtility;
                $mailSentStatus=$sendMailToUser->actionSendmail($messageview,$params, $subject, $to);
            }
            return $userprofileid;
         }else{
             
             return 'error';
         }
         
     } catch (Exception $exe) {
         error_log("SkiptaUserService/SaveUserCollection===".$exe->getMessage());
     }
  }
    
    
    
    /* This Method is used for get the countries */ 
    
     public function GetCountries(){
      try {
      
         // $country=new Countries();
          $countries=Countries::model()->GetCountries();
          return $countries;
                    
      } catch (Exception $exe) {
           Yii::log($exe->getMessage(), 'error', 'application');
      }
    }



    /* This Method is used for User Authentication before login
     *    it returns string as a result
     *  */

    public function userAuthentication($model) {
        
        try {   
            $returnValue='false';
            if (get_class($model) == 'LoginForm') {                
                $email=$model->email;
                $password=$model->pword;      
                $encrypted_salt = Yii::app()->params['ENCRYPTION_SALT'];
error_log(md5($encrypted_salt.$password)."rahul");
                $userMessage = User::model()->userAuthentication($email,md5($encrypted_salt.$password));                
                if($userMessage=='success'){
                                       $userObj= User::model()->getUserByType($model->email, "Email");
                        if(isset($userObj)){
                             CommonUtility::badgingInterceptor("FirstLogin",$userObj->UserId);
                        }
                   
                   User::model()->updateUserForLoginTime($email);
                }
                
                $returnValue=$userMessage;
                
          
            } else {
                $returnValue = 'false';
            }
            error_log("************".$returnValue);
            return $returnValue;
        } catch (Exception $exe) {            
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }

 

    /*
     * GetUserProfile: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns Users Object.
     */
    public function getUserProfile($filterValue, $searchText, $startLimit, $pageLength) {
        try {// method calling...                 
            $userProfileCollectionJSONObject = User::model()->getUserProfile($filterValue, $searchText, $startLimit, $pageLength);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfile==" . $exc->getMessage(), "error", "application");
        }
        return $userProfileCollectionJSONObject;
    }

     /*
     * GetUserProfileCount: which takes 2 arguments and 
     * returns the total no. of users.
     */
    public function getUserProfileCount($filterValue, $searchText) {
        try {// method calling...            
            $userProfileCount = User::model()->getUserProfileCount($filterValue, $searchText);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getUserProfileCount in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
        }
        return $userProfileCount;
    }

    /*
     * userForgotService: which takes 1 argument and 
     * returns whether the user with that email exist or not
     * and if exists then will updated the column PasswordResetToken with userID(converted to md5)
     * and current password request date(encrypted) which are appended with '_'
     * and will send a password recovery mail to user
     */
    public function userForgotService($model) {       
        try {            
            $returnValue='failure';
            
            $userObj = $this->checkIfUserExist($model);            
            // error_log(print_r($userObj,true));
            if ($userObj == 'failure') {
//                UserProfileCollection::model()->updatePassword
               
            } else {                    
                $resetPasswordString=$userObj['UserId'];
                $encodeCurrentDate = base64_encode(date('Y-m-d h:i:s'));
                $resetPasswordToken=md5($resetPasswordString).'_'.$encodeCurrentDate;    
               User::model()->updateUserByFieldByUserId($userObj['UserId'],$resetPasswordToken,'PasswordResetToken');
               //$emailCredentials = $this->getEmailCredentialsByTitle('ForgotPassword');//add this line to get the eemail cong details to send mail(Praneeth)
                        $to = $userObj['Email'];
                        $name = $userObj['FirstName'] . ' ' . $userObj['LastName'];
                        $userId = $userObj['UserId'];
                        $userEmail = $userObj['Email'];
                        $subject = "Reset Your ".Yii::app()->params['NetworkName']." Account Password ";
                        $templateType = "forgotmail";
                        $companyLogo = "";
                        $employerName = "Skipta Admin";
                        //$employerEmail = "info@skipta.com"; 
                        $messageview="ForgotPasswordMail";
                        $params = array('myMail' => $name, 'userId' => $userId, 'code' => $resetPasswordToken,'email'=>$userEmail);
                        $sendMailToUser=new CommonUtility;
                        $mailSentStatus=$sendMailToUser->actionSendmail($messageview,$params, $subject, $to);  
                        if($mailSentStatus == false)
                        {
                          $userObj == 'mailsentfailure'; 
                        }
            }
        } catch (Exception $ex) {
            Yii::log("=====inside forgot service exception==========". $ex->getMessage(),"error","application");
        }        
        return $userObj;
    }

    /*
     * checks whether the user exist or not
     */
    public function checkIfUserExist($model) {       
        try {
            $result = User::model()->checkUserEmailExist($model);
            
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfUserExist exception===@@@@@@=======". $ex->getMessage(),"error","application");
        }
        return $result;
    }
   
    /*
     * userResetPasswodService:used to update the new password with old password 
     */
    public function userResetPasswodService($model)
    {
        try{
            $result = User::model()->resetPassword($model);
      
        }catch(Exception $ex){
             Yii::log("inside userResetPasswodService exception". $ex->getMessage(),"error","application");
          }
        return $result;
    }


    /*
     * GetUserProfileByUserId: which takes 1 argument i.e userid
     * and returns an User Object.
     */
    public function getUserProfileByUserId($userid) {
        try {
            $userProfileObject = User::model()->getUserProfileByUserId($userid);
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getUserProfileByUserId in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $userProfileObject;
    }

    /*
     * UpdateUserStatus: which takes 2 arguments 1: userId and 2: value.
     * This is used to update the status of an user.
     */
    public function updateUserStatus($userid, $value) {
        try {
            $result = User::model()->updateUserStatus($userid, $value);
            UserCollection::model()->updateUserStatus($userid, $value);
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateUserStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
    /*
     * FollowAction: takes 2 arguments; 1:$followerId and 2:$followingId
     *  and it performs the follow to a user
     */
    public function followAUser($userId,$followId, $createdDate=''){
        try{
            $result = UserProfileCollection::model()->followAction($userId,$followId);
       
                   $CategoryType = CommonUtility::getIndexBySystemCategoryType('User');
                   
                   $FollowEntity = CommonUtility::getIndexBySystemFollowingThing('User');    
                 CommonUtility::prepareStreamObjectForFollowEntity($userId,"UserFollow",$followId,(int)$CategoryType,$FollowEntity, $createdDate);
                   
              
              
            
            
        } catch (Exception $ex) {
            Yii::log("Exception occurred in followAUser in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
     /*
     * suresh reddy
     * getUserIdByEmail: takes 1 arguments; 1:Email address of user
     *   it's use geting a userid of user by Email
     */

    public function getUserIdByEmail($email){
        try{
            $result = User::model()->checkIfUserExist($email,'Email');
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getUserIdByEmail in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
    /*
     * UnFollowAction: takes 2 arguments; 1:userId and 2:followId
     *  and it performs the unfollow a user
     */
    public function unFollowAUser($userId,$followId){
        try{
            $result = UserProfileCollection::model()->unFollowAction($userId,$followId);
       
            
            
            $CategoryType = CommonUtility::getIndexBySystemCategoryType('User');
            $FollowEntity = CommonUtility::getIndexBySystemFollowingThing('User');
            CommonUtility::prepareStreamObjectForFollowEntity($userId, "UserUnFollow", $followId, (int) $CategoryType, $FollowEntity);
        } catch (Exception $ex) {
            Yii::log("Exception occurred in UnFollowAUser in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
    /**
     * 
     * @param type $userid
     * @return type
     */
    public function getUserPrivileges($userid){
        try{
            
            $userObj = UserPrivileges::model()->getUserPrivileges($userid);
           
        } catch (Exception $ex) {
            Yii::log("Exception occurred in getUserPrivileges of Skiptauserservice","error","application");
        }
        return $userObj;
            
    }
    
    /**
     * 
     * @param type $privilegesids
     * @return type
     */
    public function updateUserPrivileges($userId,$privilegesids){
        try{
            $result = UserPrivileges::model()->updateUserPrivileges($userId,$privilegesids);
        } catch (Exception $ex) {
            Yii::log("Exception occurred in saveUserPrivileges of Skiptauserservice","error","application");
        }
        return $result;
    }
/** 
 * 
 * @param type $value : this is the value of type
 * @param type $type this parameter is the column name to get
 * @return type
 */
    public function getUserByType($value,$type){
        try {
            $returnValue='failure';
           $userObj= User::model()->getUserByType($value, $type);
           if(isset($userObj)){
               $returnValue= $userObj;
           }
           return $returnValue;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
        }
     /** 
      * This method is used get the tiny user collection 
      * @param type $userId
      * @return type
      */
     public function getTinyUserCollection($userId){
         try {
        
             $tinyUserCollection=UserCollection::model()->getTinyUserCollection($userId);             
             return $tinyUserCollection;
         } catch (Exception $exc) {
             Yii::log($exc->getMessage(),'error','application');
         }
          }

          
    /**
     * @author: karteek
     * @functionName:getUserMiniProfile
     * @param type $userid
     * @returnType: user object
     */      
    public function getUserMiniProfile($userid,$loggedUserId){
        try{
            $miniProfileObjectsArray = array();            
            $userProfileCollectionObj = UserProfileCollection::model()->getUserCollectionByUserId($userid,$loggedUserId);            
            $tinyUserCollectionObj = UserCollection::model()->getTinyUserCollection($userid);            
            $postCollectionObj = UserStreamCollection::model()->getPostsCount($userid);            
            $badgeCollectionObj = UserBadgeCollection::model()->getUserBadgeCollectionByUserId($userid);
            $badgeObjsForDisplay=array();
            if(count($badgeCollectionObj)>0)
            {  
                 $badgeCollectionObj=(array)$badgeCollectionObj;
                 foreach ($badgeCollectionObj as $badgeCObj )
                 {  
                    $badgeArray=array();
                    $badgeArray['_id']=(string) $badgeCObj['_id'];
                    $badgesObj=Badges::model()->getBadgeById($badgeCObj['BadgeId']);
                    if($badgesObj->isCustom==1){ 
                                        $image= $badgesObj->image_path;                                        
                                        $i=explode('.', strrev($image));
                                        $ext=strrev($i[0]);
                                        $name=strrev($i[1])."_38x44.".$ext;                                          
                                 $badgeArray['badgeName']=   $name;        
                    } else{
                      $badgeArray['badgeName']=  $badgesObj->badgeName;    
                    }       
                    $badgeArray['isCustom']=$badgesObj->isCustom;
                    $badgeArray['hoverText']=  $badgesObj->hover_text;
                    array_push($badgeObjsForDisplay,$badgeArray);
                 }
            }  
            $miniProfileObjectsArray['userProfileCollection'] = $userProfileCollectionObj;
            $miniProfileObjectsArray['tinyUserCollection'] = $tinyUserCollectionObj;
            $miniProfileObjectsArray['postCollectionCount'] = $postCollectionObj;
            $miniProfileObjectsArray['userBadgeCollection'] = $badgeObjsForDisplay;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(),'error','application');
        }
        return $miniProfileObjectsArray;
    }      
   



           /*
     * GetCurbsideCategoriesList: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns curbsideCategoryCollectionJSONObject.
     */
    public function getCurbsideCategoriesList($filterValue, $searchText, $startLimit, $pageLength) {
        try {// method calling...                 
            $curbsideCategoryCollectionJSONObject = CurbsideCategoriesList::model()->getCurbsideCategoriesList($filterValue, $searchText, $startLimit, $pageLength);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getCurbsideCategoriesList==" . $exc->getMessage(), "error", "application");
        }
        return $curbsideCategoryCollectionJSONObject;
    }
    
    /*
     * GetCurbsideCategoriesCount: which takes 2 arguments and 
     * returns the total no. of Categories.
     */
    public function getCurbsideCategoriesCount($filterValue, $searchText) {
        try {// method calling...            
            $curbsideCategoryCount = CurbsideCategoriesList::model()->getCurbsideCategoryCount($filterValue, $searchText);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in curbsideCategoryCount in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
        }
        return $curbsideCategoryCount;
    }
          
    /*
     * adminCategoryCreationService: which takes 1 argument and 
     * returns whether the Category  exist or not
     * and if exists acknowledge already exists
     * and if  does not exists will create a new category
     */
    public function adminCategoryCreationService($model) {
        try {
            $returnValue = 'failure';
                $userObj = $this->checkIfCategoryExist($model);
            if ($userObj != 'failure')
                {
                 $SaveArtifacts = $this->saveTopicArtifacts($model['TopicprofileImage']);
                $model['TopicprofileImage']=$SaveArtifacts['ThumbNailImage'];
                
                
                $categoryId = CurbsideCategoriesList::model()->saveNewCurbsidecategory($model);
                if($categoryId !='false' && $categoryId !='updatetrue' )
                {
                        /**
                         * The below code is used to save the category in mongo curbsidecategories collection
                         * Haribabu
                         */
                      $result = CurbSideCategoryCollection::model()->saveCategories($categoryId,$model);
                      if($result!='failure'){
                            $returnValue = 'success';
                        }
                   
                    }
                elseif ($categoryId =='updatetrue') {
                    /**
                     * The below code is used to update the category in mongo curbsidecategories collection
                     * Haribabu
                     */
                    $result = CurbSideCategoryCollection::model()->updateCurbsideCategoriesDetails($model);
                    $returnValue = 'updatesuccess';  
                }
                else
                {
                    $returnValue = 'failure';
                }
            }
            else
            {}
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside adminCategoryCreationService===@@@@@@=======". $ex->getMessage(),"error","application");
          
        }
        return  $returnValue;
    }

    /**
     * 
     * @author:Praneeth
     * @param type $model
     * @return $result
     * Checks whether the category exists or not
     */
    public function checkIfCategoryExist($model) {       
        try {
            
            $result = CurbsideCategoriesList::model()->checkCurbsieCategoryExist($model);
            
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfCategoryExist exception===@@@@@@=======". $ex->getMessage(),"error","application");
        }
       
        return $result;
    }

    /**
     * @author:Praneeth
     * @param type $categoryid, $categoryvalue
     * @return $result
     * This is used to update the status of a category.
     */
    public function updateCurbsideCategoryStatus($categoryid, $categoryvalue) {
        try {
            $result = CurbsideCategoriesList::model()->updateCurbsideCategoryStatus($categoryid, $categoryvalue);
            $resultMongo = CurbSideCategoryCollection::model()->updateCurbsideCategoryStatusInMongo($categoryid, $categoryvalue);
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateCurbsideCategoryStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }
    
    /**
     * @author:Praneeth
     * @param type $categoryid
     * @return $result
     * This is used to edit the category based on the category id
    */
     public function editCurbsideCategoryById($categoryId) {
         try{
             return CurbsideCategoriesList::model()->editCurbsideCategoryById($categoryId);
         } catch (Exception $ex) {
              Yii::log("Exception occurred in editCurbsideCategoryById in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
         }
        
    }
     /**
      * @Author Sagar Pathapelli
      * This method is used get the tiny user collection for network
      * @param type $networkId
      * @return type
      */
     public function getTinyUserCollectionForNetworkBySearchKey($networkId,$searchKey, $mentionArray=array()){
         try {
             if(sizeof($mentionArray)>0){
                $mentionArray = array_map('intval', $mentionArray);    
               }
             $tinyUserCollection=UserCollection::model()->getTinyUserCollectionForNetworkBySearchKey($networkId,$searchKey, $mentionArray);             
             return $tinyUserCollection;
         } catch (Exception $exc) {
             Yii::log($exc->getMessage(),'error','application');
         }
     }

     /**
      * @Author Sagar Pathapelli
      * This method is used save the User OAuth details
      * @param type $userOAuthBean 
      * @return type
      */
     public function saveUserOAuth($userOAuthBean){
         try {
             $returnValue="failure";
             $returnValue= UserOAuth::model()->saveUserOAuth($userOAuthBean);             
             return $returnValue;
         } catch (Exception $exc) {
             Yii::log($exc->getMessage(),'error','application');
         }
     }
        
      /**
      * @author Praneeth
      * Description: Method used to get the groups for which the user is a member
      * @param type $UserId
      * @return $groupsCollectionUserFollowing
      */
     public function groupsUserFollowing($UserId)
     {
         try         
         { 
             $groupsCollectionUserFollowing='failure';
             $userFollowingGroups = UserProfileCollection::model()->getUserFollowingGroups($UserId);             
             $groupsCollectionUserFollowing = GroupCollection::model()->userFollowingGroupsList($userFollowingGroups);
         } catch (Exception $ex) {
            Yii::log("----in exception -----groupsUserFollowing---------------".$ex->getMessage(),'error','application');
         }
         
         return $groupsCollectionUserFollowing;
     }
     
        public function getUserFollowingGroups($UserId)
     {
         try
         {
             $groupsCollectionUserFollowing='failure';
             $userGroups = UserProfileCollection::model()->getUserFollowingGroups($UserId);             
            
         } catch (Exception $ex) {
            Yii::log("----in exception -----groupsUserFollowing---------------".$ex->getMessage(),'error','application');
         }
         
         return $userGroups;
     }
     
     /**
      * @author Praneeth
      * Description: Method used to get the groups for which the user is not a member
      * @param type $UserId
      * @return $groupsCollectionUserNotFollowing
      */
     public function groupsUserNotFollowing($UserId)
     {
         try
         {
             $groupsCollectionUserNotFollowing='failure';
             $userFollowingInGroups = UserProfileCollection::model()->getUserFollowingGroups($UserId);
            //$groupsCollectionUserNotFollowing = GroupCollection::model()->userNotFollowingGroupsList($userFollowingInGroups);
         } catch (Exception $ex) {
                Yii::log("----in exception -----groupsNotAMember---------------".$ex->getMessage(),'error','application');
         }
         return $userFollowingInGroups;
     }
     
     
     public function getMoreFollowingGroups($UserId, $startLimit, $pageLength)
     {
         try
         {
             $moreGroupsCollectionUserFollowing='failure';
             $userFollowingGroups = UserProfileCollection::model()->getUserFollowingGroups($UserId); 
             $moreGroupsCollectionUserFollowing = GroupCollection::model()->userMoreFollowingGroupsList($userFollowingGroups, $startLimit, $pageLength); 
         } catch (Exception $ex) {
            Yii::log("----in exception -----getMoreFollowingGroups---------------".$ex->getMessage(),'error','application');
         }
         return $moreGroupsCollectionUserFollowing;
         
     }
        /**
      * @author Sagar Pathapelli
      * @Description getting abused users from post collection
      * @return 
      */
    public function getAbusedPosts() {
        try {
             $returnValue="failure";
             $returnValue=  PostCollection::model()->getAbusedposts();
             return $returnValue;             
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

     
            /*
     * getHelpIconsList: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns curbsideCategoryCollectionJSONObject.
     */
    public function getHelpIconsDescriptionList($filterValue, $searchText, $startLimit, $pageLength) {
        try {// method calling...                 
            $helpIconCollectionJSONObject = UserHelpManagement::model()->getHelpIconsDescriptionList($filterValue, $searchText, $startLimit, $pageLength);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getHelpIconsDescriptionList==" . $exc->getMessage(), "error", "application");
        }
        return $helpIconCollectionJSONObject;
    }
    
       /*
     * getHelpIconsDescriptionListCount: which takes 2 arguments and 
     * returns the total no. of help icon.
     */
    public function getHelpIconsDescriptionListCount($filterValue, $searchText) {
        try {// method calling...            
            $helpIconsDescriptionListCount = UserHelpManagement::model()->getHelpIconsDescriptionListCount($filterValue, $searchText);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getHelpIconsDescriptionListCount in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
        }
        return $helpIconsDescriptionListCount;
    }
    
     /*
     * adminCreateHelpIconService: which takes 1 argument and 
     * returns whether the help icon  exist or not
     * and if exists acknowledge already exists
     * and if  does not exists will create a new help icon
     */
    public function adminCreateHelpIconService($model) {
        try {
            $returnValue = 'failure';
                $userObj = $this->checkIfHelpIconExist($model);
                if(isset($userObj))
                {
                     if(isset($model->id) && !empty($model->id) )
                        {
                            //update
                            if($userObj->Id == $model->id)
                            {
                                //allow
                               $helpIconId = UserHelpManagement::model()->updateHelpIcon($model); 
                               if ($helpIconId =='updatetrue') {
                                       $returnValue = 'updatesuccess';
                               }
                            }
                            else
                            {
                               //not allow
                               $returnValue = 'helpexists';
                            }
                        }
                            else
                            {
                                //not allow
                                 $returnValue = 'helpexists';
                            }
                }
                else
                {
                    //insert
                    $helpIconId = UserHelpManagement::model()->saveNewHelpIcon($model);
                    if($helpIconId !='false' && $helpIconId !='updatetrue' )
                    {
                         $returnValue = 'success'; 
                    }
                }
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside adminCreateHelpIconService===@@@@@@=======". $ex->getMessage(),"error","application");
          
        }
        Yii::log("----------------return--------------------------".$returnValue,"error","application");
        return  $returnValue;
    }
    
     /**
     * @author:Praneeth
     * @param type iconNameId
     * @return $result
     * This is used to edit the icon details based on the iconName id
    */
     public function editHelpIconDetails($iconNameId) {
         try{
             return UserHelpManagement::model()->editHelpIconDetails($iconNameId);
         } catch (Exception $ex) {
              Yii::log("Exception occurred in editHelpIconDetails in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
         }
    }
    
    public function getHelpDescription($helpIconId)
    {
        try
        {
             $helpDetailsObject=UserHelpManagement::model()->getHelpDescriptionById($helpIconId);
          return $helpDetailsObject;
                    
        } catch (Exception $ex) {
            Yii::log("----------Exception occurred in getHelpDescription in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
    }
    
     /**
     * 
     * @author:Praneeth
     * @param type $model
     * @return $result
     * Checks whether the Icon exists or not
     */
    public function checkIfHelpIconExist($model) {       
        try {
            $result="";
            $result = UserHelpManagement::model()->checkIfHelpIconExist($model);
            
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfCategoryExist exception===@@@@@@=======". $ex->getMessage(),"error","application");
        }
        return $result;
    }
    
     /**
     * @author:Praneeth
     * @param type $helpIconid, $helpIconStatus
     * @return $result
     * This is used to update the status of a helpIcon.
     */
    public function updateHelpIconStatus($helpIconid, $helpIconStatus) {
        try {
            $result = UserHelpManagement::model()->updateHelpIconStatus($helpIconid,$helpIconStatus);
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateHelpIconStatus in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

     /**
     * @author:Praneeth
     * @param type $userid, $LastLoginDate
     * @return $result
     * This is used to list of user who have followed since the last login.
     */
    public function getNewFollowersListByDate($userid,$LastLoginDate)
    {
        try
        {  
            $returnValue='failure';
            $result = UserActivityCollection::model()->getNewUserFollowingMembers($userid, $LastLoginDate);
           
            $userFollowersId = array();
            if(isset($result)){
                 $userFollowingList = UserProfileCollection::model()->getUserFollowingById($userid);
              foreach ($result as $userFollower) {  
                  
                  $isavail = in_array($userFollower['UserId'],$userFollowingList);
                  if($isavail !=1)
                  {
                      array_push($userFollowersId, $userFollower['UserId']);
                  }
                
            }
            $returnValue =UserCollection::model()->getFollowedUserDetailsList($userFollowersId);
            }
        } catch (Exception $ex) {
                Yii::log("Exception occurred in getNewFollowersListByDate in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
        }
        return $returnValue;
    }
    
       
    /**
     * @author Vamsi Krishna
     * @Description This method is used to get the Group recent Activity for RightWidget
     * @param type userId           
     * @return  success =>Array failure =>string 
     * Modified by Praneeth for group activity on right side widget
     */    
    
    public function getUserGroupActivityForRightWidget($userId) {
        try {
            $returnValue='failure';
            $groupIdsWithActivities=array();
            $groupDetailsWithActivity=array();
            
            $userGroupActivities=UserProfileCollection::model()->getUserGroupActivity($userId);
            if(is_array($userGroupActivities)){
                $userProfile=$this->getUserProfileByUserId($userId);
                $PreviousLastLoginDate = strtotime(date($userProfile['PreviousLastLoginDate'], time()));
                $i=0;
                foreach($userGroupActivities as $groupId){
                    if($i<5){
                        $return=GroupPostCollection::model()->getUserRecentGroupActivity($groupId,$PreviousLastLoginDate);
                    if($return=='success'){
                        array_push($groupIdsWithActivities,$groupId);
                       } 
                    }else{
                        break;
                    }
                   
                  $i++;
                }
                if(count($groupIdsWithActivities>0)){
                     
                    foreach($groupIdsWithActivities as $group){
                        $groupBean=new GroupBean();
                        $groupDetails=GroupCollection::model()->getGroupDetailsById($group);                       
                        $groupBean->GroupIcon=$groupDetails->GroupProfileImage;
                        $groupBean->GroupName=$groupDetails->GroupName;
                        $groupBean->GroupShortDescription=$groupDetails->GroupDescription;
                        $groupBean->GroupId=$groupDetails->_id;
                        array_push($groupDetailsWithActivity,$groupBean);
                    }
                    $returnValue=$groupDetailsWithActivity;
                }
            }
            return $returnValue;
            
        } catch (Exception $exc) {
            Yii::log("-hhh---".$exc->getMessage(),'error','application');
        }
    }
     /**
     * @author Vamsi Krishna
     * @Description This method is used to update the user profile for group activity 
     * @param type userId 
     * @param type groupId
     * @return  success =>Array failure =>string 
     */    
    
    public function updateUserProfileForGroupActivity($userId,$groupId) {
        try {
            UserProfileCollection::model()->updateUserProfileForGroupActivity($userId,$groupId);
        } catch (Exception $exc) {
            Yii::log('In exception update user profile group activity' . $exc->getMessage(), 'error', 'application');
        }
    }
    
  /**
     * @author Vamsi Krishna
     * @Description This method is used to get the user profile for profile page
     * @param type userId      
     * @return  success =>Array failure =>string 
     */    
    
  public function getUserProfileDetails($userId,$loggedInUserId){
      try {   
          $returnValue='failure';
          $userProfileCollection=UserProfileCollection::model()->getUserProfileCollection($userId);
          $tinyUserCollection=UserCollection::model()->getTinyUserCollection($userId);
          $userDetailsfromMysql=User::model()->getUserProfileByUserId($userId);
          $userPersonalInformation=ProfessionalInformation::model()->getProfessionalInformationByUserId($userId);  
          $userProfile=new UserProfileBean();    
          $userProfile->UserId=$userDetailsfromMysql['UserId'];
          $userProfile->FirstName=$userDetailsfromMysql['FirstName'];
          $userProfile->LastName=$userDetailsfromMysql['LastName'];
          $userProfile->Company=$userDetailsfromMysql['Company'];
          $userProfile->Network=$userDetailsfromMysql['NetworkId'];
          $userProfile->ContactNumber=$userDetailsfromMysql['Phone'];
          $userProfile->Zip=$userDetailsfromMysql['Zip'];
          //$userProfile->Designation=$userDetailsfromMysql['Designation'];
         //-----------Added if condition because null is displayed for AboutMe as old data is migrated with null --------Praneeth
          if($tinyUserCollection->AboutMe == null || $tinyUserCollection->AboutMe =="null"){
            $userProfile->AboutMe="";
          }
          else{
               $userProfile->AboutMe=$tinyUserCollection->AboutMe;
          }
          $userProfile->DisplayName=$tinyUserCollection->DisplayName;
          $userProfile->ProfilePicture=$tinyUserCollection->ProfilePicture;
          $userProfile->profile250x250=$tinyUserCollection->profile250x250;
          $userProfile->profile70x70=$tinyUserCollection->profile70x70;
          $userProfile->profile45x45=$tinyUserCollection->profile45x45;
          
          $userFollowers = $userProfileCollection->userFollowers;
          
       
          $pos = array_search(0, $userFollowers);
          if(is_int($pos) && $pos>=0){
            unset($userFollowers[$pos]);
          }
          $userFollowing = $userProfileCollection->userFollowing;
          $pos = array_search(0, $userFollowing);
          if(is_int($pos) && $pos>=0){
            unset($userFollowing[$pos]);
          }
          $userProfile->UserFollowersCount=count(array_unique($userFollowers));
          $userProfile->UserFollowingCount=count(array_unique($userFollowing));
          $userProfile->UserFollowers=$userFollowers;
          $userProfile->UserFollowing=$userFollowing;
          
          $userProfile->GroupsFollowing=count($userProfileCollection->groupsFollowing);
          if(is_object($userPersonalInformation)){              
              $userProfile->School=$userPersonalInformation['School'];
              $userProfile->Speciality=$userPersonalInformation['Speciality'];
              $userProfile->Years_Experience=$userPersonalInformation['Years_Experience'];
              $userProfile->Degree=$userPersonalInformation['Degree'];
              $userProfile->Position=$userPersonalInformation['Position'];
              $userProfile->Highest_Education=$userPersonalInformation['Highest_Education'];            
          }else{
              $userProfile->School='';
              $userProfile->Speciality='';
              $userProfile->Years_Experience='';
              $userProfile->Degree='';
              $userProfile->Position='';
              $userProfile->Highest_Education='';   
          }
          $userFollowed=in_array($loggedInUserId,$userProfileCollection->userFollowers);
          if($userFollowed==1){
              $userProfile->IsFollowed =1;
          }else{
              $userProfile->IsFollowed =0;
          }
          //$userProfile->IsFollowed = in_array($loggedInUserId,$userProfileCollection->userFollowers);
       
        return  $userProfile;
      } catch (Exception $exc) {          
            Yii::log('---get user profile' . $exc->getMessage(), 'error', 'application');
            return 'failure';
      }
    }
  /**
     * @author Vamsi Krishna
     * @Description This method is used to update the profile 
     * @param type userId      
     * @return  success =>Array failure =>string 
     */   

    public function updateUserProfileDetails($userId, $type, $value) {
        try {
            if($type=='AboutMe' || $type=='ProfilePicture'){
                UserCollection::model()->updateProfileDetailsbyType($userId,$type,$value);                
            }
            if($type=='DisplayName'){
                UserCollection::model()->updateProfileDetailsbyType($userId,$type,$value); 
                User::model()->updateUserByFieldByUserId($userId, $value, "DisplayName");
            }if($type=='Designation' ||$type=='Company' ){
                 User::model()->updateUserByFieldByUserId($userId, $value,$type);
            }
            if($type=='ProfilePicture'){
                 UserCollection::model()->updateProfileDetailsbyType($userId,$type,$value); 
            }
            
        } catch (Exception $exc) {
            Yii::log('--upate user profile' . $exc->getMessage(), 'error', 'application');
             return $returnValue;
        }
    }
    
    /**
     * @author Vamsi Krishna
     * @Description This method is used to Insert Personal Information for the user 
     * @param type userId      
     * @return  success =>Array failure =>string 
     */  
  
    public function saveOrUpdateUserProfessionalInformation($userId,$professionalInformationForm){
        try {
             $professionalInformation = ProfessionalInformation::model()->getProfessionalInformationByUserId($userId);            
            if($professionalInformation!='failure'){
                ProfessionalInformation::model()->updateProfessionalInformation($professionalInformationForm,$professionalInformation); 
            }else{               
               ProfessionalInformation::model()->saveProfessionalInformation($professionalInformationForm,$userId);    
            }
            
        } catch (Exception $exc) {
            Yii::log('-------' . $exc->getMessage(), 'error', 'application');
        }
            
    }
    
      public function saveProfileNameDetails($UserId, $value, $type) {
        try {
            $returnValue = User::model()->updateUserByFieldByUserId($UserId, $value, $type);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    
    public function saveProfileDetailsUserCollection($UserId, $type, $value,$imageName, $absolutePath) {
        try {
            $returnValue = UserCollection::model()->updateProfileDetailsbyType($UserId, $type, $value, $imageName, $absolutePath);
            if( $type == 'ProfilePicture')
            {
                $ArtifactClassName=$this->getArtifactProfileImage($value,$imageName);
            }
            if($returnValue =="success")
            {
                $returnValue = $imageName;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
     public function getArtifactProfileImage($artifact,$imageName) {
        try {
             // $className="";
              $img="";
              $className="img_small_250";
              $new_filepath="";
              $result=array();
              $path = $artifact;
              $thumbNailpath='/upload/profile/';
              $extension=explode(".", strtolower($artifact));
              $extension = end($extension);
              if($extension=='jpg' || $extension=='jpeg' || $extension=='gif' || $extension=='tiff'|| $extension=='png'){
                  $filepath=Yii::getPathOfAlias('webroot').$path;
                     list($width, $height) = getimagesize($filepath);
                     //For images with 250x250 size
                        $newfolderBig=Yii::getPathOfAlias('webroot').$thumbNailpath.'250x250/';// folder for uploaded files
                       if (!file_exists($newfolderBig) ) {
                              mkdir ($newfolderBig, 0755,true);
                             }
                            
                        $img = Yii::app()->simpleImage->load($filepath);
                        if($img->getWidth()>=250){
                           $img-> resizeToWidth(250);
                        }
                        $img->save($newfolderBig.$imageName); 
                        $className="img_big_250";
                        $new_filepath=$thumbNailpath.'250x250/' . $imageName;
                        //For images with 70x70 size
                       $newfolderMedium=Yii::getPathOfAlias('webroot').$thumbNailpath.'70x70/';// folder for uploaded files
                       if (!file_exists($newfolderMedium) ) {
                              mkdir ($newfolderMedium, 0755,true);;
                             }
                        $img1 = Yii::app()->simpleImage->load($filepath);
                        if($img1->getWidth()>=70){
                           $img1-> resizeToWidth(70);
                        }
                        $img1->save($newfolderMedium.$imageName); 
                        $className="img_big_250";
                        $new_filepath=$thumbNailpath.'70x70/' . $imageName;
                        //For images with 45x45 size
                       $newfolderSmall=Yii::getPathOfAlias('webroot').$thumbNailpath.'45x45/';// folder for uploaded files
                       if (!file_exists($newfolderSmall) ) {
                              mkdir ($newfolderSmall, 0755,true);;
                             }
                        $img2 = Yii::app()->simpleImage->load($filepath);
                        if($img2->getWidth()>=45){
                           $img2-> resizeToWidth(45);
                        }
                        $img2->save($newfolderSmall.$imageName); 
                        $className="img_big_250";
                        $new_filepath=$thumbNailpath.'45x45/' . $imageName;
                  
            }
//            $result['filepath']=$new_filepath;
//            $result['fileclass']=$className;
            
             return $result;
             
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
 
     public function saveAbuseWordService($model) {
        try {
            $returnValue = 'failure';
            $returnValue = AbuseKeywords::model()->saveAbuseWord($model);
            return  $returnValue;
        } catch (Exception $ex) {
            Yii::log("===@@@@@==in userservice saveAbuseWordService===@@@@@@=======". $ex->getMessage(),"error","application");
          return  $returnValue;
        }
    }
    /**
     * @author Sagar
     * @return type
     */
    public function getAllAbuseWords() {
        try {
            $returnValue = 'failure';
            $returnValue = AbuseKeywords::model()->getAllAbuseWords();
            return  $returnValue;
        } catch (Exception $ex) {
            Yii::log("===@@@@@==in userservice getAllAbuseWords===@@@@@@=======". $ex->getMessage(),"error","application");
          return  $returnValue;
        }
    }

    /**
     * @author Karteek.V
     * @param type $userId
     * @return type
     */
    
    public function getUserSettings($userId){
        try{
            $result = UserNotificationSettingsCollection::model()->getUserSettings($userId);
        } catch (Exception $ex) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $result;
    }
    /**
     * @author Karteek.V
     * @param type $userId
     * @param type $settingIds
     * @return type
     */
    public function updateUserSettings($userId,$settingIds,$isDevice=0){
        try{
            $result = UserNotificationSettingsCollection::model()->updateUserSettings($userId,$settingIds,$isDevice);
        } catch (Exception $ex) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $result;
    }
    
            
    /**
     * @author Praneeth
     * @Description This method is used to get the user attending for RightWidget
     * @param type userId           
     * @return  success =>Array failure =>string 
     * 
     */    
    
    public function getUserEventsAttendingForRightWidget($userId,$CurrentLoginDate) {
        try {
            $returnValue = 'failure';       
            $userEventAttendingActivities=  UserInteractionCollection::model()->getUserEventsAttendingActivity($userId,$CurrentLoginDate);
                if(count($userEventAttendingActivities)>0){
                  $returnValue = $userEventAttendingActivities;   
                }
            return $returnValue; 
            
        }catch (Exception $exc) {
            Yii::log("-----------in exception--------getUserEventsAttendingForRightWidget------------".$exc->getMessage(),'error','application');
        }
    }

 public function saveCookieRandomKeyForUser($userId,$randomKey){
     UserCookie::model()->saveCookieRandomKeyForUser($userId,$randomKey);
 }
  public function checkCookieValidityForUser($userId,$randomKey){
     return UserCookie::model()->checkCookieValidityForUser($userId,$randomKey);
 }
   public function deleteCookieRandomKeyForUser($userId,$randomKey){
      UserCookie::model()->deleteCookieRandomKeyForUser($userId,$randomKey);
 }  

    public function getUserFollowingHashtagsData($userId){
        try{
            $hashTags=array();
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollection($userId);
            if(isset($userProfileCollection->hashtagsFollowing) && is_array($userProfileCollection->hashtagsFollowing)){
                $hashtagsFollowing = array_unique($userProfileCollection->hashtagsFollowing);
                foreach ($hashtagsFollowing as $hashtag) {
                    $hashTagData = HashTagCollection::model()->getHashTagsById($hashtag);
                    if(is_object($hashTagData) && sizeof($hashTagData)>0){
                        $hashTagArray = array();
                        $hashTagArray['id'] = $hashTagData->_id;
                        $hashTagArray['name'] = $hashTagData->HashTagName;
                        array_push($hashTags, $hashTagArray);
                    }
                }
            }
            return $hashTags;
        }catch(Exception $ex){
            return array();
        }
    }
    public function getUserFollowingGroupsData($userId,$loggedInUserId){
        try{
            $groups=array();
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollection($userId);
            if(isset($userProfileCollection->groupsFollowing) && is_array($userProfileCollection->groupsFollowing)){
                $groupsFollowing = array_unique($userProfileCollection->groupsFollowing);
                foreach ($groupsFollowing as $groupId) {
                    $groupsData = GroupCollection::model()->getGroupDetailsById($groupId);
                    if(is_object($groupsData) && sizeof($groupsData)>0){
                        $groupsDataArray = array();
                        $groupsDataArray['id'] = $groupsData->_id;
                        $groupsDataArray['name'] = $groupsData->GroupName;
                        $groupsDataArray['groupProfileImage'] = $groupsData->GroupProfileImage;
                        
                        if($groupsData->IsPrivate==1){
                            $groupsDataArray['groupMembers']=$groupsData->GroupMembers;
                           $isFollowing=in_array($loggedInUserId,$groupsData->GroupMembers);                           
                           if($isFollowing==1){
                              $groupsDataArray['showIntroPopup']=1;  
                           }else{
                               $groupsDataArray['showIntroPopup']=0;  
                           }
                        }else{
                            $groupsDataArray['showIntroPopup']=1;  
                        }
                        array_push($groups, $groupsDataArray);
                    }
            }
            }
            return $groups;
        }catch(Exception $ex){
            Yii::log($ex->getMessage(),'error', 'application');            
            return array();
        }
    }
    public function getUserFollowingCurbsideCategoriesData($userId){
        try{
            $categories=array();
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollection($userId);
            if(isset($userProfileCollection->curbsideFollowing) && is_array($userProfileCollection->curbsideFollowing)){
                $categoriesFollowing = array_unique($userProfileCollection->curbsideFollowing);
                foreach ($categoriesFollowing as $categoryId) {
                    $curbsideCategoryData = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($categoryId);
                    if(is_object($curbsideCategoryData) && sizeof($curbsideCategoryData)>0){
                        $curbsideCategoryArray = array();
                        $curbsideCategoryArray['id'] = $curbsideCategoryData->CategoryId;
                        $curbsideCategoryArray['name'] = $curbsideCategoryData->CategoryName;
                        array_push($categories, $curbsideCategoryArray);
                    }
                }
            }
            return $categories;
        }catch(Exception $ex){
            return array();
        }
    }
     public function getRoles(){
       $returnValue='failure';
       try {
           $userTypes=UserType::model()->getUserTypes();
           if($userTypes!='failure'){
              $returnValue=$userTypes; 
           }           
           return $returnValue;
       } catch (Exception $exc) {
          Yii::log("----".$exc->getMessage(),'error','application');
          return $returnValue;
       }
      }

   public function getRolesBySelectedUserType($selectedRole){
        $returnValue='failure';
       try {           
          $roleBasedActions= RoleBasedAction::model()->getRoleBasedActions($selectedRole);

          if($roleBasedActions!='failure'){
              $returnValue=$roleBasedActions; 
}
          return $returnValue;

       } catch (Exception $exc) {
          Yii::log("----".$exc->getMessage(),'error','application');
          return $returnValue;
}
      }
      
   public function updateRoleBasedActions($selectedRole,$actionIds){
        $returnValue='failure';
       try {
           $returnValue=RoleBasedAction::model()->updateRoleBasedActions($selectedRole,$actionIds);
           return $returnValue;
       } catch (Exception $exc) {
           Yii::log("----".$exc->getMessage(),'error','application');
           return $returnValue;
       }
      }  

   /**
    * @author VamsiKrishna
    * @param type $userId
    * @return string if faliure and array if success
    */   
    public function getUserFollowersForProfile($userId,$loginUserId,$pageSize,$page) {
        $returnValue = 'failure';
        $userProfileBean=new UserProfileBean();
        $userFollowersArray=array();
         $isPresent=0;
        try {

            $userFollowers_chunck = UserProfileCollection::model()->getUserFollowersSliceById($userId,$page,$pageSize);
            if ($userFollowers_chunck != 'failure' || $userFollowers_chunck!=0) {
                $userFollowers = array_unique($userFollowers_chunck);
                //$userFollowers_chunck = array_slice($userFollowers,$pageSize,$page);
                foreach ($userFollowers_chunck as $user){  
                    if($user!=0){
                         $userProfileBean=new UserProfileBean();
                   $userToUserFollowers=  UserProfileCollection::model()->getUserFollowersById($user);                  
                   if($userToUserFollowers!='failure'){
                       $isPresent=in_array($loginUserId, $userToUserFollowers);
                       if($isPresent==0){
                          $userProfileBean->IsFollowed=0;    
                       }else{
                          $userProfileBean->IsFollowed=1;     
                       }
                       
                   }else{
                       $userProfileBean->IsFollowed=0;
                   }
                   $tinyUserCollection=UserCollection::model()->getTinyUserCollection($user);
                   $userProfileBean->UserId=$tinyUserCollection->UserId;
                   $userProfileBean->ProfilePicture=$tinyUserCollection->profile70x70;
                   $userProfileBean->DisplayName=$tinyUserCollection->DisplayName;
                   $userProfileBean->uniqueHandle=$tinyUserCollection->uniqueHandle;
                     array_push($userFollowersArray,$userProfileBean);
                    }
                   
                }
              
                $returnValue=$userFollowersArray;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("----" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
     /**
    * @author VamsiKrishna
    * @param type $userId
    * @return string if faliure and array if success
    */ 
    public function getUserFollowingForProfile($userId,$loginUserId,$pageSize,$page) {
        $returnValue = 'failure';
        $userProfileBean=new UserProfileBean();
        $userFollowingArray=array();
        $isPresent=0;
        try { 
        
            $userFollowing = UserProfileCollection::model()->getUserFollowingSliceById($userId,$page,$pageSize);
     
    //  $userFollowing_chunck = array_slice($userFollowing,$pageSize,$page);
            if ($userFollowing_chunck != 'failure' ||  $userFollowers_chunck!=0) {
                foreach ($userFollowing as $user){
                   if($user!=0){
                        $userProfileBean=new UserProfileBean();
                   $userToUserFollowing=  UserProfileCollection::model()->getUserFollowersById($user);
                   if($userToUserFollowing!='failure'){                  
                    $isPresent=in_array($loginUserId, $userToUserFollowing);                  
                    if($isPresent==0){
                      $userProfileBean->IsFollowed=0;    
                        }else{
                        $userProfileBean->IsFollowed=1;     
                        }
                       
                   }else{
                       $userProfileBean->IsFollowed=0;
                   }
                   $tinyUserCollection=UserCollection::model()->getTinyUserCollection($user);
                   $userProfileBean->UserId=$tinyUserCollection->UserId;
                  $userProfileBean->ProfilePicture=$tinyUserCollection->profile70x70;
                   $userProfileBean->DisplayName=$tinyUserCollection->DisplayName;
                   $userProfileBean->uniqueHandle=$tinyUserCollection->uniqueHandle;
                   array_push($userFollowingArray,$userProfileBean);
                    }
                    
                }
              
                $returnValue=$userFollowingArray;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("----" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
 /**
     * @author Sagar Pathapelli
     * This is used to get User Actions By UserType / RoleId (for Rite Aid)
     * @param type $userId
     * @param type $userTypeId
     * @return string
     */
      public function getUserActionsByUserType($userId, $userTypeId) {
        $returnValue = 'failure';
        try {
            $returnValue = RoleBasedAction::model()->getUserActionsByUserType($userId, $userTypeId);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("----" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    /**
     * @author Sagar Pathapelli
     * This method is used to update the UserPrivileges and it is for RiteAid
     * @param type $userId
     * @param type $actionIds
     * @return string
     */
     public function updateRoleBasedUserPrivileges($userId,$checkedActionIds, $allActionIds) {
        $returnValue = 'failure';
        try {
            $returnValue = UserPrivileges::model()->updateRoleBasedUserPrivileges($userId,$checkedActionIds, $allActionIds);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("----" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    public function saveRole($role){
        try{
            $result = "failure";
            $isRoleExists = UserType::model()->isRoleExist($role);
            if($isRoleExists=='false'){
                $result = UserType::model()->saveRole($role);
            }else{
                $result = 'RoleExist';
            }
            return $result;
        } catch (Exception $ex) {
            Yii::log("Exception occurred in saveRole of Skiptauserservice","error","application");
        }
        
    }
    
          
      /*
     * getPostCountForCategory: which takes 1 arguments and 
     * returns the total no. of post.
     */
    public function getPostCountForCategory($categoryId) {
        try {
           
            $postCountsForCategory = "";
                // method calling...            
            $postCountsForCategory = CurbSideCategoryCollection::model()->getPostCountForCategory($categoryId);
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in curbsideCategoryCount in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
        }
        return $postCountsForCategory;
    }
    public function resetUserPrivileges($userId) {
        try {
            $UserPrivileges = "failure";        
            $UserPrivileges = UserPrivileges::model()->resetUserPrivileges($userId);
            return $UserPrivileges;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in resetUserPrivileges in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
            return "failure";
        }
        
    }
    public function updateUserType($userId, $userTypeId) {
        try {
            $UserType = "failure";        
            $UserType = User::model()->updateUserType($userId, $userTypeId);
            return $UserType;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in updateUserType in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
            return "failure";
        }
    }
    public function changeUserRole($userId,$roleId) {
        try {
            $returnVal = "failure";        
            $updateType = $this->updateUserType($userId, $roleId);
            if($updateType=="success"){
                $returnVal = $this->resetUserPrivileges($userId);
            }
            return $returnVal;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in updateUserType in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
            return "failure";
        }
    }
//    
//    public function updateCategoryStatusinMongoCollection($categoryid, $categoryvalue)
//    {
//        try
//        {
//            $resultCurbsidePostCollection = CurbsidePostCollection::model()->updateCurbsideCategoryStatusInMongo($categoryid, $categoryvalue);
//            
//        } catch (Exception $ex) {
//            Yii::log("Exception in updateCategoryStatusinMongoCollection in SkiptaUserService layer=".$ex->getMessage(), "error", "application");
//        }
//    }
    
    public function getUserIdbyName($uniqueHandle){
       return UserCollection::model()->getUserIdbyName($uniqueHandle); 
    }
   function generateUniqueHandleForUser($firstName, $lastName) {
        $handle = $firstName . "." . $lastName;
        $handle = str_replace(" ", "", $handle);
        while ($this->checkHandleExist($handle)) {
            $randomNumber = mt_rand(1, 99999);
            $handle = $handle.$randomNumber;
        }
        return $handle;
    }
    public function checkHandleExist($handle){
          $criteria = new EMongoCriteria();
          $criteria->addCond('uniqueHandle', '==', $handle);
          $result = UserCollection::model()->find($criteria);
          if(is_object($result)){
              return true;
          }else{
              return false;
          }
    }

     public function getUserHierarchy($userId){
       return UserHierarchy::model()->getUserHierarchyByUserId($userId);
    }
    public function getUserDetailsByUserId($userId){
       return User::model()->getUserDetailsByUserId($userId);
    }

    /**
     * @author Praneeth
     * This method is used to get UserFollowingSubGroupsData
     * @param type $userId
     * @param type $actionIds
     * @return string
     */
    public function getUserFollowingSubGroupsData($userId,$loggedInUserId){
        try{
             $SubGroups=array();
            $userSubGroupsCollection=array();
            $userSubGroupsCollection =  SubGroupCollection::model()->getUserFollowingSubGroups($userId);
            if($userSubGroupsCollection !="failure"){
                foreach ($userSubGroupsCollection as $subGroups) {
                    
                    $groupsData = GroupCollection::model()->getGroupDetailsById($subGroups->GroupId);
                    if(is_object($groupsData) && sizeof($groupsData)>0){
                        $groupsDataArray = array();
                        $groupsDataArray['_id'] = $subGroups->_id;
                        $groupsDataArray['SubGroupName'] = $subGroups->SubGroupName;
                        $groupsDataArray['SubGroupProfileImage'] = $subGroups->SubGroupProfileImage;
                        
                        if($groupsData->IsPrivate==1){
                            $groupsDataArray['groupMembers']=$groupsData->GroupMembers;
                           $isFollowing=in_array($loggedInUserId,$groupsData->GroupMembers);                           
                           if($isFollowing==1){
                              $groupsDataArray['showSubIntroPopup']=1;  
                           }else{
                               $groupsDataArray['showSubIntroPopup']=0;  
                           }
                        }else{
                            $groupsDataArray['showSubIntroPopup']=1;  
                        }
                        array_push($SubGroups, $groupsDataArray);
                    }
            }
                return $SubGroups;
            }
        }catch(Exception $ex){
            Yii::log($ex->getMessage(),'error', 'application');            
            return array();
        }
    }
     /**
      * @author Karteek V
      * This is used to fetch a Network configuration object based.
      * @return type
      */
     public function getConfigurationObject(){
         try{
             return NetworkConfiguration::model()->getNetworkConfiguration();
         } catch (Exception $ex) {
            Yii::log($ex->getMessage(),'error', 'application');                        
         }
     }
     /**
      * @author Karteek V
      * @param type $model
      * @return type
      */
     public function addNewConfigParamter($model){
         try{
             return NetworkConfiguration::model()->saveModel($model);
         } catch (Exception $ex) {
            Yii::log($ex->getMessage(),'error', 'application');        
            error_log("=====Exception Occurred in addNewConfigParamter =-=====".$ex->getMessage());
         }
     }
     
     public function editNetworkParamter($id){
         try{
             return NetworkConfiguration::model()->getModelById($id);
         } catch (Exception $ex) {
            Yii::log($ex->getMessage(),'error', 'application');        
            error_log("=====Exception Occurred in editNetworkParamter =-=====".$ex->getMessage());
         }
     }

    
       /**
      * @author Praneeth
      * Description: Method used to get the groups for which the user is a member
      * @param type $UserId
      * @return $groupsCollectionUserFollowing
      */
     public function SubGroupsUserFollowing($UserId,$groupId)
     {
         try         
         { 
             $groupsCollectionUserFollowing='failure';
             $userFollowingGroups = UserProfileCollection::model()->getUserFollowingSubGroups($UserId,$groupId);             
             $subGroupIds=array();
             if($userFollowingGroups!="failure"){
                 foreach($userFollowingGroups as $subgroup){                         
                 if($groupId==$subgroup['GroupId']){
                   array_push($subGroupIds,$subgroup['SubGroupId']);       
                 }                 
                 
             }
             $groupsCollectionUserFollowing = SubGroupCollection::model()->userFollowingGroupsList($subGroupIds,$groupId);    
             }
             
             
             
         } catch (Exception $ex) { 
            Yii::log("----in exception -----groupsUserFollowing---------------".$ex->getMessage(),'error','application');
         }
         
         return $groupsCollectionUserFollowing;
     }

     public function saveUserLoginActivity($userId){
         try{
             $activityIndex = CommonUtility::getUserActivityIndexByActionType("Login");
              $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("Login");
              UserInteractionCollection::model()->saveUserLoginActivity($userId,$activityIndex,$activityContextIndex); 
        }catch(Exception $ex){
            Yii::log($ex->getMessage(),'error', 'application');            
            return array();
        } 
     }

      public function getUserFollowingSubGroups($UserId,$groupId)
     {
         try
         {
             $groupsCollectionUserFollowing='failure';
              $subGroupIds=array();
             $userGroups = UserProfileCollection::model()->getUserFollowingSubGroups($UserId,$groupId);   
             if($userGroups!="failure"){
                 foreach($userGroups as $subgroup){                         
                 if($groupId==$subgroup['GroupId']){
                   array_push($subGroupIds,$subgroup['SubGroupId']);       
                 } 
             }
             }
         } catch (Exception $ex) {
            Yii::log("----in exception -----groupsUserFollowing---------------".$ex->getMessage(),'error','application');
         }
         
         return $subGroupIds;
     }
      public function getMoreFollowingSubGroups($UserId, $startLimit, $pageLength,$groupId)
     {
         try
         {
             $moreGroupsCollectionUserFollowing='failure';
             $subGroupIds=array();
             $userFollowingGroups = UserProfileCollection::model()->getUserFollowingSubGroups($UserId,$groupId); 
             if($userFollowingGroups!="failure"){
                 foreach($userFollowingGroups as $subgroup){                         
                 if($groupId==$subgroup['GroupId']){
                   array_push($subGroupIds,$subgroup['SubGroupId']);       
                 } 
             }
             
             $moreGroupsCollectionUserFollowing = SubGroupCollection::model()->userMoreFollowingGroupsList($subGroupIds, $startLimit, $pageLength);              
                 }
             
         } catch (Exception $ex) {
            Yii::log("----in exception -----getMoreFollowingGroups---------------".$ex->getMessage(),'error','application');
         }
         return $moreGroupsCollectionUserFollowing;
         
     }
      /**
      * @author Vamsi Krishna
      * Description: Method used to get the groups for which the user is not a member
      * @param type $UserId
      * @return $groupsCollectionUserNotFollowing
      */
     public function SubGroupsUserNotFollowing($UserId,$groupId)
     {
         try
         {
             $groupsCollectionUserNotFollowing='failure';
             $userFollowingInGroups = UserProfileCollection::model()->getUserFollowingSubGroups($UserId,$groupId);             
             $subGroupIds=array();
             if($userFollowingInGroups!='failure'){
              foreach($userFollowingInGroups as $subgroup){             
                  array_push($subGroupIds,$subgroup['SubGroupId']);                 
             }    
             }
             
           
            //$groupsCollectionUserNotFollowing = GroupCollection::model()->userNotFollowingGroupsList($userFollowingInGroups);
         } catch (Exception $ex) {
                Yii::log("----in exception -----groupsNotAMember---------------".$ex->getMessage(),'error','application');
         }
         return $subGroupIds;
     }

     public function trackMinMentionWindowOpen($loginUserId,$mentionUserId,$NetworkId){
         try {    
         
        
          $activityIndex = CommonUtility::getUserActivityIndexByActionType("MentionUsed");
          $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("MentionMinPopup");
          UserInteractionCollection::model()->trackMinMentionWindowOpen($loginUserId,$mentionUserId,$activityIndex,$activityContextIndex,$NetworkId);
  
       
      } catch (Exception $exe) {
           Yii::log($exe->getMessage(), 'error');
           return "failure";
      } 
     }

     /*
      * @author Praneeth
     * getAllEmailConfigurationDetails:
     * this function returns $emailConfigurationDetailsJSONObject.
     */
    public function getAllEmailConfigurationDetails() {
        try {// method calling...   
            $emailConfigurationDetailsJSONObject="";
            $emailConfigurationDetailsJSONObject = EmailCredentials::model()->getEmailConfigurationDetails();
            return $emailConfigurationDetailsJSONObject;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getEmailConfigurationDetails==" . $exc->getMessage(), "error", "application");
        }
    }
    
     /*
      * @author Praneeth
     * getEmailConfigurationDetailsCount
     * returns the total no. of email configured.
     */
    public function getEmailConfigurationDetailsCount() {
        try {// method calling...            
            $emailConfigurationDetailsCount = EmailCredentials::model()->getEmailConfigurationDetailsCount();
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getEmailConfigurationDetailsCount in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
        }
        return $emailConfigurationDetailsCount;
    }
    
     /*
      * @author Praneeth
     * adminCreateEmailConfigurationService: which takes 1 argument and 
     * returns whether the email  exist or not
     * and if exists acknowledge already exists
     * and if  does not exists will create a new email config details
     */
    public function adminCreateEmailConfigurationService($model) {
        try {
            $returnValue = 'failure';
                $userObj = $this->checkIfConfigurationEmailExist($model);
                if(isset($userObj))
                {
                     if(isset($model->id) && !empty($model->id) )
                        {
                            //update
                            if($userObj->id == $model->id)
                            {
                                //allow
                               $emailConfigDetailsId = EmailCredentials::model()->updateEmailConfigurationDetails($model); 
                               if ($emailConfigDetailsId =='updatetrue') {
                                       $returnValue = 'updatesuccess';
                               }
                            }
                            else
                            {
                               //not allow
                               $returnValue = 'emailexists';
                            }
                        }
                            else
                            {
                                //not allow
                                 $returnValue = 'emailexists';
                            }
                }
                else
                {
                    //insert
                    $emailConfigDetailsId = EmailCredentials::model()->saveNewEmailConfigurationDetails($model);
                    if($emailConfigDetailsId !='false' && $emailConfigDetailsId !='updatetrue' )
                    {
                         $returnValue = 'success'; 
                    }
                }
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside adminCreateHelpIconService===@@@@@@=======". $ex->getMessage(),"error","application");
          
        }
        return  $returnValue;
    }
    
    /**
     * 
     * @author:Praneeth
     * @param type $model
     * @return $result
     * Checks whether the Email configuration exists or not
     */
    public function checkIfConfigurationEmailExist($model) {       
        try {
            $result="";
            $result = EmailCredentials::model()->checkIfConfigurationEmailExist($model);
            
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfConfigurationEmailExist exception===@@@@@@=======". $ex->getMessage(),"error","application");
        }
        return $result;
    }
     /**
     * @author:Praneeth
     * @param type configEmailId
     * @return $result
     * This is used to edit the icon details based on the iconName id
    */
     public function editEmailConfigurationDetails($configEmailId) {
         try{
             return EmailCredentials::model()->editEmailConfigurationDetails($configEmailId);
         } catch (Exception $ex) {
              Yii::log("Exception occurred in editEmailConfigurationDetails in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
         }
    }
    
        /*
     * getAllEmailConfigurationDetails: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns $emailConfigurationDetailsJSONObject.
     */
    public function getAllTemplateConfigurationDetails() {
        try {// method calling...   
            $templateConfigurationDetailsJSONObject=array();
            $templateConfigurationDetailsJSONObject = TemplateManagement::model()->getTemplateConfigurationDetails();
            return $templateConfigurationDetailsJSONObject;
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getTemplateConfigurationDetails==" . $exc->getMessage(), "error", "application");
        }
    }
    
     /*
     * getEmailConfigurationDetailsCount
     * returns the total no. of email configured.
     */
    public function getTemplateConfigurationDetailsCount() {
        $templateConfigurationDetailsCount=0;
        try {// method calling...            
            $templateConfigurationDetailsCount = TemplateManagement::model()->getTemplateConfigurationDetailsCount();
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in getTemplateConfigurationDetailsCount in SkiptaUserService layer=" . $exc->getMessage(), "error", "application");
        }
        return $templateConfigurationDetailsCount;
    }
    
    /*
     * adminCreateTemplteConfigurationService: which takes 1 argument and 
     * returns whether the email  exist or not
     * and if exists acknowledge already exists
     * and if  does not exists will create a new email config details
     */
    public function adminCreateTemplateConfigurationService($model) {
        try {
            
            $returnValue = 'failure';
                $userObj = $this->checkIfTemplateTitleExist($model);
                if(isset($userObj))
                {
                     if(isset($model->id) && !empty($model->id) )
                        {
                            //update
                            if($userObj->id == $model->id)
                            {
                                //allow
                               $templateConfigDetailsId = TemplateManagement::model()->updateTemplateConfigurationDetails($model); 
                               if ($templateConfigDetailsId =='updatetrue') {
                                       $returnValue = 'updatesuccess';
                               }
                            }
                            else
                            {
                               //not allow
                               $returnValue = 'emailexists';
                            }
                        }
                            else
                            {
                                //not allow
                                 $returnValue = 'emailexists';
                            }
                }
                else
                {
                    //insert
                    $templateConfigDetailsId = TemplateManagement::model()->saveNewTemplateConfigurationDetails($model);
                    if($templateConfigDetailsId !='false' && $templateConfigDetailsId !='updatetrue' )
                    {
                         $returnValue = 'success'; 
                    }
                }
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside adminCreateTemplteConfigurationService===@@@@@@=======". $ex->getMessage(),"error","application");
          
        }
        return  $returnValue;
    }
    
      /**
     * 
     * @author:Praneeth
     * @param type $model
     * @return $result
     * Checks whether the Email configuration exists or not
     */
    public function checkIfTemplateTitleExist($model) {       
        try {
            $result="";
            $result = TemplateManagement::model()->checkIfTemplateTitleExist($model);
            
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfConfigurationEmailExist exception===@@@@@@=======". $ex->getMessage(),"error","application");
        }
        return $result;
    }
    
         /**
     * @author:Praneeth
     * @param type $configTemplateId
     * @return $result
     * This is used to edit the icon details based on the template id
    */
     public function editTemplateConfigurationDetails($configTemplateId) {
         try{
             return TemplateManagement::model()->editTemplateConfigurationDetails($configTemplateId);
         } catch (Exception $ex) {
              Yii::log("Exception occurred in editTemplateConfigurationDetails in SkiptaUserService layer=" . $ex->getMessage(), "error", "application");
         }
    }
    
     /*
     * checks whether the title exist or not
     */
    public function getEmailCredentialsByTitle($titleType) {       
        try {
                $result = TemplateManagement::model()->getEmailBasesOnTitle($titleType);
                $emailCredentials = EmailCredentials::model()->getEmailCredentialsBasedOnEmail($result->EmailConfigured);
            
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfUserExist exception===@@@@@@=======". $ex->getMessage(),"error","application");
        }
        return $emailCredentials;
    }
     /**
      * @author Karteek V
      * This method is used to fetch the analytics stats
      * @return type array
      */
     public function getAnalyticsStats()
     {
         try
         {
             $totalObjectArray = array();
             $registeredUsers = User::model()->getRegisteredUsersCount();
             $groups = GroupCollection::model()->getGroupsCount();
             $totalCurbsideCount = CurbsidePostCollection::model()->getConversationCount();
             $totalPostConvCount = PostCollection::model()->getConversationCount();
             $totalGroupPostCount = GroupPostCollection::model()->getConversationCount();
             $totalObjectArray['conversationsCount'] = $totalCurbsideCount+$totalPostConvCount+$totalGroupPostCount;
             $totalObjectArray['registeredUsers'] = $registeredUsers;
             $totalObjectArray['groups'] = $groups;
            
         } catch (Exception $ex) {
            Yii::log("----in exception -----groupsUserFollowing---------------".$ex->getMessage(),'error','application');
         }
         
         return $totalObjectArray;
     }
   
      /**
      * -----------------------Purpose: For Data Migration only--------------------
      * @author Praneeth
      * Description: Method used to get the group id based on group name
      * @param type $categoryName
      * @return $moreGroupsCollectionUserFollowing
      */
     public function getGroupIdByGroupName($groupName)
     {
         try
         {
              //Yii::log("--------getGroupIdByGroupName-----------".$groupName, "error", "application");
             $result = GroupCollection::model()->getGroupIdByGroupName($groupName);
         } catch (Exception $ex) {
            //Yii::log("----in exception -----getGroupIdByGroupName---------------".$ex->getMessage(),'error','application');
         }
         return $result;
     }
    
     public function saveCuratorAccessTokenService($userId, $accessToken)
     {
         User::model()->saveCuratorAccessToken($userId, $accessToken);
     }
      public function getCuratorAccessTokenService($userId)
     {
         return User::model()->getCuratorAccessToken($userId);
     }
     public function getNeworkDetailsService($urlORname)
     {
         return Network::model()->getNeworkDetails($urlORname);
     }
     
      
       /**
      * @author Praneeth
      * Description: Method used to get the analytics data
      * @param type start date , end date
      * @return $deviceUsabilityCollection
      */
     public function GetDeviceUsabilityBasedOnDateRangeAndType($startDate,$endDate,$type){
         return TrackBrowseDetailsCollection::model()->GetAnalyticsReportsBasedonDateRange($startDate,$endDate,$type);
    }
    
      /**
      * @author Praneeth
      * Description: Method used to get the group id based on group name
      * @param type $categoryName
      * @return $moreGroupsCollectionUserFollowing
      */
    public function GetBrowserUsabilityBasedOnDateRangeAndType($startDate,$endDate,$type){
  
         return TrackBrowseDetailsCollection::model()->GetBrowserUsabilityBasedOnDateRangeAndType($startDate,$endDate,$type);
                }
            
     public function GetDeviceUsabilityPieChartBasedOnDateRangeAndType($startDate,$endDate){
  
         return TrackBrowseDetailsCollection::model()->GetDevicePieChartUsabilityBasedOnDateRangeAndType($startDate,$endDate);
    }
    
    public function GetBrowserUsabilityPieChartBasedOnDateRangeAndType($startDate,$endDate,$type){
  
         return TrackBrowseDetailsCollection::model()->GetBrowserUsabilityPieChartBasedOnDateRangeAndType($startDate,$endDate);
    }
    
     public function GetLocationPieChartBasedOnDateRangeAndType($startDate,$endDate,$type){
  
         return TrackBrowseDetailsCollection::model()->GetLocationPieChartUsabilityBasedOnDateRangeAndType($startDate,$endDate);
    }

    
        /**
      * @author Praneeth
      * Description: Method used to get the group id based on group name
      * @param type $categoryName
      * @return $moreGroupsCollectionUserFollowing
      */
     public function GetLocationUsabilityBasedOnDateRangeAndType($startDate,$endDate,$type){
         
         return TrackBrowseDetailsCollection::model()->GetLocationLineGraphReportsBasedonDateRange($startDate,$endDate,$type);
         
    }
     
    
          
       /**
      * @author Praneeth
      * Description: Method used to get the group usability analytics
      * @param type $categoryName
      * @return $deviceUsabilityCollection
      */
     public function GetGroupUsabilityLineChartBasedOnDateRangeAndType($groupId,$startDate,$endDate,$usabilityType,$type){
         try{
            if($usabilityType == 'GroupDeviceUsability') 
            {
                return TrackBrowseDetailsCollection::model()->GetGroupDeviceUsabilityAnalyticsReportsBasedonDateRange($groupId,$startDate,$endDate,$type);
            }
            if($usabilityType =='GroupLocationUsability')
             {
                return TrackBrowseDetailsCollection::model()->GetGroupLocationUsabilityAnalyticsReportsBasedonDateRange($groupId,$startDate,$endDate,$type);
             }
             if($usabilityType =='GroupBrowserUsability')
             {
                return TrackBrowseDetailsCollection::model()->GetGroupBrowserUsabilityAnalyticsReportsBasedonDateRange($groupId,$startDate,$endDate,$type);
             }
         } catch (Exception $ex) {
             Yii::log("----in exception -----GetGroupUsabilityLineChartBasedOnDateRangeAndType---------------".$ex->getMessage(),'error','application');
         }
         
    }
    
     public function GetGroupUsabilityPieChartBasedOnDateRangeAndType($groupId,$startDate,$endDate,$type){
         try {
             if($type =='GroupDeviceUsability')
             {
                return TrackBrowseDetailsCollection::model()->GetGroupDevicePieChartUsabilityBasedOnDateRangeAndType($groupId,$startDate,$endDate); 
             }
             if($type =='GroupLocationUsability')
             {
                return TrackBrowseDetailsCollection::model()->GetGroupLocationPieChartUsabilityBasedOnDateRangeAndType($groupId,$startDate,$endDate); 
             }
             if($type =='GroupBrowserUsability')
             {
                return TrackBrowseDetailsCollection::model()->GetGroupBrowserPieChartUsabilityBasedOnDateRangeAndType($groupId,$startDate,$endDate);  
             }
             
             
         } catch (Exception $ex) {
              Yii::log("----in exception -----GetGroupUsabilityPieChartBasedOnDateRangeAndType---------------".$ex->getMessage(),'error','application');
         }
  
         
    }


    public function getColumnNames(){
        try{
            return CustomField::model()->getColumnNames();
        }catch(Exception $ex){
            
        }
    }
     public function getAllUsers(){
        try {
            $users=UserCollection::model()->getAllUsersIds();
            return $users;
        } catch (Exception $exc) {
            error_log("+++++++++++++".$exc->getMessage());
        }
    }
 public function saveMobileSession($userId,$sessionId,$deviceInfo,$pushToken){
     return MobileSessions::model()->saveMobileSession($userId,$sessionId,$deviceInfo,$pushToken);
         
 }
 public function saveMobileSession_V6($userId,$deviceInfo,$pushToken){
     return MobileSessions::model()->saveMobileSession_V6($userId,$deviceInfo,$pushToken);
         
 }
   
     public function checkAutoLogin($sessionId,$userId) {
         try {
              $result = MobileSessions::model()->checkAutoLogin($sessionId,$userId);
              return $result;
         } catch (Exception $exe) {
             Yii::log($exe->getMessage(), 'error', 'application');
         }
        
    }
      public function logout($sessionId,$userId) {
         try {
              $result = MobileSessions::model()->logout($sessionId,$userId);
              return $result;
         } catch (Exception $exe) {
             Yii::log($exe->getMessage(), 'error', 'application');
         }
        
    }
 public function getAdvertisements(){
      try {
          $advertisements=Advertisements::model()->loadAllAdvertisements();
          return $advertisements;
      } catch (Exception $exc) {
          error_log("+++++ADvertisements++++++++".$exc->getMessage());
      }
    }
    
  public function saveAdvertisements(){
      try {
          $advertisementsObj=new AdvertisementsCollection();
             $advertisementsObj->Name=$obj->Name;
             $advertisementsObj->Type=$obj->Type;
             $advertisementsObj->Url=$obj->Url;
             $advertisementsObj->DisplayPage=$obj->DisplayPage;
             $advertisementsObj->DisplayPosition=$obj->DisplayPosition;
             $advertisementsObj->Status=$obj->Status;
             $advertisementsObj->CreatedUserId=$obj->CreatedUserId;
             $advertisementsObj->TimeInterval=$obj->TimeInterval;
             $advertisementsObj->ExpiryDate=$obj->ExpiryDate;
             $advertisementsObj->Priority=$obj->Priority;
             $advertisementsObj->GroupId=$obj->GroupId;
             $advertisementsObj->CreatedOn=$obj->CreatedOn;
          AdvertisementsCollection::model()->saveAdvertisements($advertisementsObj);
      } catch (Exception $exc) {
          Yii::log("**".$exc->getMessage(),'error','application');
      }
    }  
    public function getAllUserExceptNetworkAdminService($userId)
    {
         try {
            $users=UserCollection::model()->getAllUsersExceptNetworkAdmin($userId);
            return $users;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }

    
   public function getBadgeInfo()
    {
         try {
            $badges=Badges::model()->getBadgeDetails();
            return $badges;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
     public function getBadgeInfoById($BadgeId)
    {
         try {
            $badges=Badges::model()->getBadgeById($BadgeId);
            $badges->image_path = Yii::app()->params['ServerURL'].$badges->image_path;
            return $badges;
        } catch (Exception $exc) {
            error_log("____________________________________". $exc->getMessage());
        }
        
    }
    
     public function getBadgeLevelInfoByBadgeId($badgeId,$levelValue)
    {
         try {
            $badges=BadgesLevel::model()->getBadgeDetailsByBadgeId($badgeId,$levelValue);
            return $badges;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
    public function getBadgeInfoByContextAndBadgeName($context)
    {
         try {
            $badgeInfo=Badges::model()->getBadgeDetailsByCriteria($context);
            return $badgeInfo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
   public function getUserBadgeCollectionByCriteria($userId,$badgeId,$limit)
    {
         try {
          
            $badgeInfo=  UserBadgeCollection::model()->getUserBadgeCollectionByCriteria($userId,$badgeId,$limit);
          
            return $badgeInfo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
    public function saveUserBadgeCollection($badgeCollectionObj)
    {
         try {
         
            $badgeInfo=  UserBadgeCollection::model()->saveUserBadgeCollection($badgeCollectionObj);
            return $badgeInfo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
    public function checkMobileLogin($userId) {
          try {
            $isLogin= MobileSessions::model()->checkMobileLogin($userId);
            return $isLogin;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
      public function getBadgesNotShownToUser($userId,$limit)
    {
         try {
            $badgeInfo=  UserBadgeCollection::model()->getBadgesNotShownToUser($userId,$limit);
            return $badgeInfo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
    public function updateBadgeShownToUser($badgeCollectionId)
    {
          try {
            $badgeCollectionResult=  UserBadgeCollection::model()->updateBadgeShownToUser($badgeCollectionId);
            return $badgeInfo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    
     /**
      * @author Haribabu
      * Description: Method used to save the referral details
      * @param type $linkId
      * @return $linkId
      */
    public function SaveReferralLink($userId,$message){
         try {
            $returnValue = 'failure';
            $LinkId = ReferralLinks::model()->saveUserReferrerDetails($userId, $message);
            if ($LinkId != 'failure') {
                $returnValue = $LinkId;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("**" . $exc->getMessage(), 'error', 'application');
        }
    }
    /**
      * @author Haribabu
      * Description: Method used to save the referral link details
      * @param type $linkId
      * @return $linkId
      */
    public function SaveReferralLinkDetails($linkId, $userId, $email){
         try {
             
            $returnValue = 'failure';
            $LinkDetails = UserLinks::model()->saveUserLinkDetails($linkId, $userId, $email);
            if ($LinkDetails) {
                $returnValue = "success";
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("**" . $exc->getMessage(), 'error', 'application');
        }
    }
  /**
      * @author Haribabu
      * Description: Method used to check refered user exist or not 
      * @param type $userId
      * @return $user object
      */  
  public function checkRecipientEmailExist($email,$linkId){
     try {
      $returnValue = 'failure';
            $UserDetails = UserLinks::model()->checkRecipientEmailExist($email, $linkId);
            if ($UserDetails == 'success') {
                $returnValue = "success";
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("**" . $exc->getMessage(), 'error', 'application');
        }
    }
  /**
    * @author Haribabu
    * Description: Method used to get the referrer details
    * @param type $userId
    * @return $user object
    */ 
  public function getReferralDetails($email,$linkId){
      try {
            $returnValue = 'failure';
            $UserDetails = UserLinks::model()->getUserReferralDetails($email, $linkId);
            if ($UserDetails) {
                $returnValue = $UserDetails;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("**" . $exc->getMessage(), 'error', 'application');
        }
    }
  /**
    * @author Haribabu
    * Description: Method used to check refered user is valid user or not
    * @param type $userId
    * @return $user object
    */ 
  public function GetReferralMessagedetails($linkId){
      
      try {
            $returnValue = 'failure';
            $LinkIdDetails = ReferralLinks::model()->getUserReferralDetails($linkId);
            if ($LinkId != 'failure') {
                $returnValue = $LinkIdDetails;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("**" . $exc->getMessage(), 'error', 'application');
        }
    }
    
   public function getUserProfileDetailsForReferral($userId){
      try {   
          $returnValue='failure';
          //$userProfileCollection=UserProfileCollection::model()->getUserProfileCollection($userId);
          $tinyUserCollection=UserCollection::model()->getTinyUserCollection($userId);
          $userDetailsfromMysql=User::model()->getUserProfileByUserId($userId);
          $userPersonalInformation=ProfessionalInformation::model()->getProfessionalInformationByUserId($userId);  
          $userProfile=new UserProfileBean();    
          $userProfile->UserId=$userDetailsfromMysql['UserId'];
          $userProfile->FirstName=$userDetailsfromMysql['FirstName'];
          $userProfile->LastName=$userDetailsfromMysql['LastName'];
          $userProfile->Company=$userDetailsfromMysql['Company'];
          $userProfile->Network=$userDetailsfromMysql['NetworkId'];
          $userProfile->ContactNumber=$userDetailsfromMysql['Phone'];
          $userProfile->Zip=$userDetailsfromMysql['Zip'];
          //$userProfile->Designation=$userDetailsfromMysql['Designation'];
         //-----------Added if condition because null is displayed for AboutMe as old data is migrated with null --------Praneeth
          if($tinyUserCollection->AboutMe == null || $tinyUserCollection->AboutMe =="null"){
            $userProfile->AboutMe="";
          }
          else{
               $userProfile->AboutMe=$tinyUserCollection->AboutMe;
          }
          $userProfile->DisplayName=$tinyUserCollection->DisplayName;
          $userProfile->ProfilePicture=$tinyUserCollection->ProfilePicture;
          $userProfile->profile250x250=$tinyUserCollection->profile250x250;
          $userProfile->profile70x70=$tinyUserCollection->profile70x70;
          $userProfile->profile45x45=$tinyUserCollection->profile45x45;
          
         
          //$userProfile->IsFollowed = in_array($loggedInUserId,$userProfileCollection->userFollowers);
       
        return  $userProfile;
      } catch (Exception $exc) {          
            Yii::log('---get user profile' . $exc->getMessage(), 'error', 'application');
            return 'failure';
      }
    }
    
    public function getOpinionDetails($userId){
        try{
            $result = UserOpinion::model()->isUserAlreadyDoneSurvey($userId);            
            return Opinion::model()->getOpinionDetails($userId);
            
        } catch (Exception $ex) {
            error_log("########Exception Occurred in getOpinion#########".$ex->getMessage());
        }
    }
    public function saveOpinionDetails($userId,$opinionId,$optionValue){
        try{
            return UserOpinion::model()->saveOpinionDetails($userId,$opinionId,$optionValue);
        } catch (Exception $ex) {
            error_log("########Exception Occurred in saveOpinionDetails#########".$ex->getMessage());
        }
    }
    public function getSurveyResults($opId){
        try{
            return Opinion::model()->getSurveyResults($opId);
        } catch (Exception $ex) {

        }
    }
    
    public function checkPTCMember($email){
        try{
            return OtsukaPTCMembers::model()->checkPTCMember($email);
        } catch (Exception $ex) {

        }
    }
    
    public function getSurveyQuestions(){
        try{
            return SurveyMonkeyOptions::model()->getSurveyQuestions();
        } catch (Exception $ex) {
            error_log("====Exception occurred in the Service==".$ex->getMessage());
        }
    }
    
    public function saveSurveyOpinions($userId,$optionId,$questionId,$others,$rating){
        try{            
            error_log("===saveSurveyOpinions====$userId,$optionId,$questionId,$others,$rating");
            SurveyMonkeyResults::model()->saveSurveyOpinions($userId,$optionId,$questionId,$others,$rating);
        } catch (Exception $ex) {
            error_log("=====Exception Occurred in the service ====".$ex->getMessage());
        }
    }
    public function getSurveyOpinionsRes($userId){
        try{
           return SurveyMonkeyResults::model()->getSurveyOpinionsRes($userId); 
        } catch (Exception $ex) {

        }
    }
    function saveTopicArtifacts($Artifacts) {

     try {
           
         $returnValue = 'failure';
            $Resource = array();
            $folder = Yii::app()->params['WebrootPath'];
            $returnarry = array();
            if ($Artifacts != "") {
                $ExistArtifact = $folder . $Artifacts;

                if (!file_exists($ExistArtifact)) {
                    $imgArr = explode(".", $Artifacts);
                    $date = strtotime("now");
                    $finalImg_name = $imgArr[0] . '.' . end($imgArr);
                    $finalImage = trim($imgArr[0]) . '.' . end($imgArr);

                    $fileNameTosave = $folder . '/temp/' . $imgArr[0] . '.' . end($imgArr);
                    $sourceArtifact = $folder . '/temp/' . $Artifacts;
                    rename($sourceArtifact, $fileNameTosave);
                    //  $filename=$result['filename'];
                    $extension = substr(strrchr($Artifacts, '.'), 1);
                    $extension = strtolower($extension);

                    $path = 'Profile';

                    $path = '/upload/Topic/' . $path;
                    if (!file_exists($folder . '/' . $path)) {

                        mkdir($folder . '/' . $path, 0755, true);
                    }
                    $sourcepath = $fileNameTosave;
                    $destination = $folder . $path . '/' . $finalImage;
                    if (file_exists($sourcepath)) {
                        if (copy($sourcepath, $destination)) {
                            $newfile = trim($imgArr[0]) . '_' . $date . '.' . end($imgArr);
                            //  $newfile=trim($imgArr[0]) .'.' . $imgArr[1];
                            $finalSaveImage = $folder . $path . '/' . $newfile;
                            rename($destination, $finalSaveImage);
                            $UploadedImage = $path . '/' . $newfile;
                            $img = Yii::app()->simpleImage->load($folder.$UploadedImage);
                            $img->resizeToWidth(50);
                            $img->save($folder.$UploadedImage);
                            $Resource['ResourceName'] = $artifact;
                            $Resource['Uri'] = $UploadedImage;
                            $Resource['Extension'] = $extension;
                            $Resource['ThumbNailImage'] = $UploadedImage;

                            // unlink($sourcepath);
                            $returnValue = "success";
                        }
                    } else {
                        $UploadedImage = $path . '/' . $Artifacts;
                    }
                } else {
                    $UploadedImage = $Artifacts;
                    $Resource['ResourceName'] = "";
                    $Resource['Uri'] = "";
                    $Resource['Extension'] = "";
                    $Resource['ThumbNailImage'] = $UploadedImage;
                }
            }
            return $Resource;
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        }  

    
    }
    
    /**
     * @author Karteek V
     * @useful This is used to get UserBadgesData by Profile Id.
     * @param type $userId = profileId
     * @return object
     */
    public function getUserBadgesData($userId){
        try{
            return UserBadgeCollection::model()->getUserBadges($userId);
        } catch (Exception $ex) {
            error_log("##########Exception Occurred#############".$ex->getMessage());
        }
    }

    public function getOauthProviderDetailsByType($type,$value)
    {
         try {
            $providersData=OauthProviderNetworks::model()->getOauthProviderDetailsByType($type,$value);
            return $providersData;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    } 
      public function getAllOauthProviderDetails()
    {
         try {
            $providersData=OauthProviderNetworks::model()->getAllOauthProviderDetails();
            return $providersData;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
     /**
     * @author swathi
     * @param type $postId
     * @return type
     */
    public function getUserBadgeObjectById($postId) {
        try {
           $postObj=UserBadgeCollection::model()->getUserBadgeCollectionById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $postObj;
    }


/**
 * all the below methods are used to get the data for new profile 
 */    

   public function getEducations() {
        try {
           
            $object = Education::model()->getAllEducations();
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }
     public function getInterests() {
        try {
         
            $object = Interests::model()->getAllInterests();
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    
  /* This Method is used for update the user profile in both mysql and mongo 
      it accepts userprofileForm obj and customForm Obj
  *   */     
    public function UpdateUserCollection($userProfileform,$oldUserObj){
     try {
         $userCollectionModel=new UserCollection();
         
         if(isset($userProfileform['country']) && $oldUserObj['country']!=$userProfileform['country'])
         {
          $NetworkId= Network::model()->getNeworkId($userProfileform['country']);
           (isset($NetworkId) && $NetworkId!='error')?'':$NetworkId=1;               
           $userProfileform['network']=$NetworkId;
         }
         $result=User::model()->updateUser($userProfileform,$oldUserObj["UserId"]);  
         
         if($result=='success'){ 
         $userId= $oldUserObj["UserId"];
         $userCollectionModel->UserId=$userId;
         $userCollectionModel->DisplayName=$userProfileform['firstName']." ".$userProfileform['lastName'];
         $userCollectionModel->NetworkId=(int)$NetworkId;
         $displayName = trim($userCollectionModel->DisplayName);
         $uniqueHandle="";
         if(strlen($displayName)>0){
            $uniqueHandle = $this->generateUniqueHandleForUser($userProfileform['firstName'],$userProfileform['lastName']);
         }else{
             $emailPref = explode("@", $userProfileform['email']);
             $displayName = $emailPref[0];
             $uniqueHandle = $this->generateUniqueHandleForUser($displayName,"");
         }
         $userCollectionModel->uniqueHandle=$uniqueHandle;
     
           UserCollection::model()->updateUserCollection($userCollectionModel); 
         }
         
     } catch (Exception $exe) {
         error_log("SkiptaUserService/SaveUserCollection===".$exe->getMessage());
     }
  } 
  
  /*
     * userupdatePasswodService:used to update the new password with old password 
     */
    public function userUpdatePasswodService($userId,$model)
    { 
        $result ='1';
        
        try{
            $result = User::model()->updateUserPassword($userId,$model);
            if ($result == '0') {
                $user = User::model()->findByAttributes(array("UserId" => $userId));
                $to = $user->Email;
                $subject = $user->FirstName . ", your password was successfully reset.";

                $messageview = "UpdatePasswordMail";
                $params = array('myMail' => $user->FirstName);
                $sendMailToUser = new CommonUtility;
                $mailSentStatus = $sendMailToUser->actionSendmail($messageview, $params, $subject, $to);
            }
        }catch(Exception $ex){
             Yii::log("inside userResetPasswodService exception". $ex->getMessage(),"error","application");
          }
        return $result;
    }


     public function getExperience() {
        try {
           
            $object = Experience::model()->getAllExperiences();
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }
    public function getAchievements(){
        try {
           
            $object = Achievements::model()->getAllAchievements();
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    } 

    public function getDropdownsListForCVEdit($id,$category) {
        try {
            if($category=="Education"){
                $object = Education::model()->getEducationsForCVEdit($id);
            }else if($category=="Experience"){
                 $object = Experience::model()->getExperienceForCVEdit($id);
            }else if($category=="Interests"){
                 $object = Interests::model()->getExperienceForCVEdit($id);
            }else if($category=="Achievements"){
                 $object = Achievements::model()->getExperienceForCVEdit($id);
            }
            
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }
  
  public function saveUserCV($CVPostData,$UserId,$recent){
      $educationDetails = UserEducation::model()->saveUserCVEducationDetails($CVPostData, $UserId);
       $experienceDetails = UserExperience::model()->saveUserCVExperienceDetails($CVPostData, $UserId);
        $InterestsDetails = UserInterests::model()->saveUserCVInterestsDetails($CVPostData, $UserId);
       $AchievementDetails= UserAchievements::model()->saveUserCVAchievementDetails($CVPostData, $UserId);
        $PublicationsDetails = UserPublications::model()->saveUserPublicationDetails($CVPostData, $UserId);

        $this->saveUserCVPublicationCollection($UserId,$recent);
        return $educationDetails;
    }
    public function UpdateUserCV($CVPostData,$UserId,$recent){

        $educationDetails = UserEducation::model()->updateUserCVEducationDetails($CVPostData, $UserId);
        $experienceDetails = UserExperience::model()->updateUserCVExperienceDetails($CVPostData, $UserId);
       $InterestsDetails = UserInterests::model()->updateUserCVInterestsDetails($CVPostData, $UserId);
        $AchievementDetails= UserAchievements::model()->updateUserCVAchievementDetails($CVPostData, $UserId);
       $this->saveUserCVPublicationCollection($UserId,$recent);
        $PublicationsDetails = UserPublications::model()->updateUserPublicationDetails($CVPostData, $UserId);
        
        return $educationDetails;
    }
    public function getUserCVDetails($UserId){
                try{
             $returnvalue = 'failure';
            $resultArray=array();
            $educationDetails = UserEducation::model()->getUserCVEducationDetails($UserId);
            $experienceDetails = UserExperience::model()->getUserCVExperienceDetails($UserId);
            $InterestsDetails = UserInterests::model()->getUserCVInterestsDetails($UserId);
            $AchievementDetails= UserAchievements::model()->getUserCVAchievementsDetails($UserId);
            $PublicationsDetails = UserPublications::model()->getUserCVpublicationDetails($UserId);
        
            $resultArray['education']=$educationDetails;
            $resultArray['experience']=$experienceDetails;
            $resultArray['interests']=$InterestsDetails;
            $resultArray['achievements']=$AchievementDetails;
            $resultArray['publications']=$PublicationsDetails;
            $returnvalue=$resultArray;
        } catch (Exception $ex) {
            Yii::log('--in get usercv detailsssssssssssssssssss'.$ex->getMessage(),'error','application');
        }
       return $returnvalue;
       
    }
    
    public function getUserCVDropdownDetails($educationIds,$interestIds,$experienceIds,$achievementIds){
                try{
             $returnvalue = 'failure';
            $resultArray=array();
           $educationId=  implode(',', $educationIds);
           $interestId=  implode(',', $interestIds);
            $experienceId=  implode(',', $experienceIds);
            $achievementId=  implode(',', $achievementIds);
            $educations= Education::model()->getEducationsForCVEdit($educationId);
            $experiences= Experience::model()->getExperienceForCVEdit($experienceId);
            $Interests = Interests::model()->getExperienceForCVEdit($interestId);
            $Achievements= Achievements::model()->getExperienceForCVEdit($achievementId);
          
            $resultArray['education']=$educations;
            $resultArray['experience']=$experiences;
            $resultArray['interests']=$Interests;
            $resultArray['achievements']=$Achievements;
           
            $returnvalue=$resultArray;
        } catch (Exception $ex) {
            Yii::log('--in get usercv detailsssssssssssssssssss'.$ex->getMessage(),'error','application');
        }
       return $returnvalue;
       
    }  
    

    

    public function  getUserFollowingHashtagsDataForProfile($userId){
        try {
             $hashTags=array();
             $hashTagList=array();
             $totalHashTagCount=0;
             $type=array('hashtagsFollowing'=>true);
             $limit=5;
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollectionByType($userId,$type,$limit);
            if(isset($userProfileCollection->hashtagsFollowing) && is_array($userProfileCollection->hashtagsFollowing)){
                $hashtagsFollowing = array_unique($userProfileCollection->hashtagsFollowing);
                $totalHashTagCount=count($hashtagsFollowing);
                $i=0;
                foreach ($hashtagsFollowing as $hashtag) {
                    if($i<5){
                        $hashTagData = HashTagCollection::model()->getHashTagsById($hashtag);
                    if(is_object($hashTagData) && sizeof($hashTagData)>0){
                        $hashTagArray = array();
                        $hashTagArray['id'] = $hashTagData->_id;
                        $hashTagArray['name'] = $hashTagData->HashTagName;
                        array_push($hashTags, $hashTagArray);
                        $i++;
                    } 
                  
                }else{
                    break;
                }
                   
                }
            }
            $hashTagList['hashtags']=$hashTags;
            $hashTagList['totalHashTagCount']=$totalHashTagCount;
            return $hashTagList;
        } catch (Exception $exc) {
           Yii::log('--'.$exc->getMessage(),'error','application');
        }
        }
        
   public function getUserFollowingGroupsDataForProfile($userId){
       try {
            try{
            $groups=array();
            $groupsList=array();
            $totalGroupsCount=0;
             $type=array('groupsFollowing'=>true);
             
             $limit=5;
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollectionByType($userId,$type,$limit);
            
            if(isset($userProfileCollection->groupsFollowing) && is_array($userProfileCollection->groupsFollowing)){
                $groupsFollowing = array_unique($userProfileCollection->groupsFollowing);                
              $totalGroupsCount=count($groupsFollowing);
                $i=0;
                foreach ($groupsFollowing as $groupId) {
                    if($i<5){
                         $groupsData = GroupCollection::model()->getGroupDetailsById($groupId);
                    if(is_object($groupsData) && sizeof($groupsData)>0){
                        $groupsDataArray = array();
                        $groupsDataArray['id'] = $groupsData->_id;
                        $groupsDataArray['name'] = $groupsData->GroupName;
                        $groupsDataArray['groupProfileImage'] = $groupsData->GroupProfileImage;
                        
                        if($groupsData->IsPrivate==1){
                            $groupsDataArray['groupMembers']=$groupsData->GroupMembers;
                           $isFollowing=in_array($loggedInUserId,$groupsData->GroupMembers);                           
                           if($isFollowing==1){
                              $groupsDataArray['showIntroPopup']=1;  
                           }else{
                               $groupsDataArray['showIntroPopup']=0;  
                           }
                        }else{
                            $groupsDataArray['showIntroPopup']=1;  
                        }
                        array_push($groups, $groupsDataArray);
                       }
                       $i++;
                    }else{
                        break;
                    }
                   
            }
            
            $groupsList['groupsList']=$groups;
            $groupsList['totalGroupsCount']=$totalGroupsCount;
            
            }
            return $groupsList;
        }catch(Exception $ex){
            Yii::log($ex->getMessage(),'error', 'application');            
            return array();
        }
       } catch (Exception $exc) {
           Yii::log('--'.$exc->getMessage(),'error','application');
       }
      }
      
       public function getUserFollowingCurbsideCategoriesDataForProfile($userId){
         
         $categories=array();
         $totalCategoriesCount=0;
         $categoriesList=array();
           try{
            
             $type=array('curbsideFollowing'=>true);
             $limit=5;
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollectionByType($userId,$type,$limit);
            
            if(isset($userProfileCollection->curbsideFollowing) && is_array($userProfileCollection->curbsideFollowing)){
                $categoriesFollowing = array_unique($userProfileCollection->curbsideFollowing);
                $totalCategoriesCount=count($categoriesFollowing);
                $i=0;
                foreach ($categoriesFollowing as $categoryId) {
                    if($i<5){
                    $curbsideCategoryData = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($categoryId);
                    if(is_object($curbsideCategoryData) && sizeof($curbsideCategoryData)>0){
                        $curbsideCategoryArray = array();
                        $curbsideCategoryArray['id'] = $curbsideCategoryData->CategoryId;
                        $curbsideCategoryArray['name'] = $curbsideCategoryData->CategoryName;
                        array_push($categories, $curbsideCategoryArray);
                      }
                      $i++;
                    }else{
                        break;
                    }
                   
                }
            }
            
            $categoriesList['categories']=$categories;
            $categoriesList['totalCategoriesCount']=$totalCategoriesCount;
            return $categoriesList;
        }catch(Exception $exc){
            Yii::log('--'.$exc->getMessage(),'error','application');
            return $categories;
        }
    }
  public function getFollowersAndFollowing($userId,$FAndF){
      try {
          $type=array($FAndF=>true);
             $limit=5;
             $userFollowingAndFollowers=array();
            $userProfileCollection=UserProfileCollection::model()->getUserProfileCollectionByType($userId,$type,$limit);
             $i=0;
           if(count($userProfileCollection->$FAndF)>0){
             foreach($userProfileCollection->$FAndF as $userF){
                    if($i<9){
                        $userDetails=UserCollection::model()->getTinyUserCollection($userF);
                 array_push($userFollowingAndFollowers,$userDetails->ProfilePicture);
                   $i++;
                    }else{
                        break;
                    }
                 
                 
             }             
           }           
           return $userFollowingAndFollowers;
      } catch (Exception $exc) {
          Yii::log("--------".$exc->getMessage(),'error','application');
      }
    }
    
   public function updatePersonalInformationByType($value,$type,$userId){
       try {
           $pDetails=ProfessionalInformation::model()->getProfessionalInformationByUserId($userId);          
           if(is_object($pDetails)){           
            $returnValue=ProfessionalInformation::model()->updatePersonalInformationByType($value,$type,$userId);    
           }else{               
               $proInfo=new ProfessionalInformation();
               $proInfo->Degree='';
               $proInfo->Highest_Education='';
               $proInfo->School='';
               $proInfo->Years_Experience='';
               $proInfo->UserId=$userId;
               if($type=='Position'){
               $proInfo->Position=$value;                   
               }
               if($type=='Speciality'){
               $proInfo->Speciality=$value;                   
               }
               ProfessionalInformation::model()->saveProfessionalInformation($proInfo,$userId);
           }
           
           
           
           return 'success';
       } catch (Exception $exc) {
          Yii::log("____________________",'error','application');
       }

      }

public function getUserInteractionsCount($userId){
    try {
        $returnValue=UserInteractionCollection::model()->getUserInteractionsCount($userId);
        return $returnValue;
    } catch (Exception $exc) {
      Yii::log("____________________",'error','application');
    }
}

    public function saveUserCVPublicationCollection($userId,$recent){
        try{
            $recentArr = array();
            $recentArr = explode(",",$recent);
            if(isset($recentArr[0]) && !empty($recentArr[0])){
                
                $CVPostData = ucfirst($recentArr[0]);    
                $categoryId = CommonUtility::getIndexBySystemCategoryType('CV');
                $postType=  CommonUtility::sendPostType('CV');
                $obj = $uobj = array();            
    //            $CVPostData->RecentUpdated="Publications";
                if($CVPostData == "Publications"){
                    $uobj = UserPublications::model()->getUserCVpublicationDetails($userId);
                }else if($CVPostData == "Education"){
                    $uobj = UserEducation::model()->getUserCVEducationDetails($userId);
                }else if($CVPostData == "Experience"){
                    $uobj = UserExperience::model()->getUserCVExperienceDetails($userId);
                }else if($CVPostData == "Interests"){
                    $uobj = UserInterests::model()->getUserCVInterestsDetails($userId);
                } if($CVPostData == "Achievements"){                
                    $uobj = UserAchievements::model()->getUserCVAchievementsDetails($userId);
                } 
                $obj['Title'] = $CVPostData;
                if($uobj!="failure"){
                if($CVPostData == "Publications"){
                    $obj['Description'] = "Publication Name as ".$uobj[0]['Name']." and Date of Published as ".$uobj[0]['PublicationDate'];
                }elseif($CVPostData == "Interests"){                    
                    $interestString = "Academic Interests";
                    if($uobj[0]['InterestId'] == 2){
                        $interestString = "Research Interests";
                    }else if($uobj[0]['InterestId'] == 3){
                        $interestString = "Personal Interests";
                    }
                    $obj['Description'] = "$interestString as ".$uobj[0]['Tags'];                    
                }elseif($CVPostData == "Experience"){
                    $string = "Research Experience";
                    if($uobj[0]['ExperienceId'] == 2){
                        $string = "Professional Experience";
                    }else if($uobj[0]['ExperienceId'] == 3){
                        $string = "Academic Experience";
                    }else if($uobj[0]['ExperienceId'] == 4){
                        $string = "Volunteer Experience";
                    }else if($uobj[0]['ExperienceId'] == 5){
                        $string = "Professional Development";
                    }
                    $obj['Description'] = "$string as ".$uobj[0]['Description'];
                }elseif($CVPostData == "Achievements"){
                    $string = "Presentations";
                    if($uobj[0]['AchievementId'] == 2){
                        $string = "Awards";
                    }else if($uobj[0]['AchievementId'] == 3){
                        $string = "Grants";
                    }else if($uobj[0]['AchievementId'] == 4){
                        $string = "Memberships";
                    }
                    $obj['Description'] = "$string as ".$uobj[0]['Description'];
                }elseif($CVPostData == "Education"){
                    $string = "Graduation";
                    if($uobj[0]['EducationId'] == 1){
                        $string = "Doctorate";
                    }else if($uobj[0]['EducationId'] == 2){
                        $string = "Under Graduation";
                    }else if($uobj[0]['EducationId'] == 3){
                        $string = "Graduation";
                    }else if($uobj[0]['EducationId'] == 4){
                        $string = "Post Graduation";
                    }else if($uobj[0]['EducationId'] == 5){
                        $string = "Other";
                    }
                    $obj['Description'] = "$string as ".$uobj[0]['Specialization']." and Graduation Year is ".$uobj[0]['YearOfPassing'];
                }            
                $obj['UserId']=$userId;           
                $obj['CategoryType'] = $categoryId;
                $obj['PostType'] = $postType;
                $returnValue= UserCVPublicationsCollection::model()->saveUserCVPublicationsCollection($obj);
                if($returnValue!='error')
                {
                     $ret = explode("_",$returnValue);
                     if(trim($ret[1]) == "saved"){
                             ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($postType, $ret[0], $userId, 'Follow', (int) $categoryId);
                          }
                    if (!CommonUtility::prepareStreamObject($userId, 'Post', $ret[0], (int) $categoryId, '', '', $createdDate)) {

                    }
                }
            }
                //return $ret[0];
        
            }
        } catch (Exception $ex) {

        }
        
        
        

    }
    
    
       public function updateUserCVStatusBySection($Category,$sectionId,$userId,$orgid) {
        try {
             if(trim($Category)=="Education"){
              UserEducation::model()->updateSectionStatus($orgid,$userId);
            }else if(trim($Category)=="Experience"){
                UserExperience::model()->updateSectionStatus($sectionId,$userId);
            }else if(trim($Category)=="Interests"){
                UserInterests::model()->updateSectionStatus($sectionId,$userId);
            }else if(trim($Category)=="Achievements"){
                UserAchievements::model()->updateSectionStatus($sectionId,$userId);
            }
            else if(trim($Category)=="Publications"){
                UserPublications::model()->updateSectionStatus($sectionId,$userId);
            }
            
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return "success";
    }
  public function updatePushNotification($userId){
      error_log("--------updatePushNotification-----------");
      try{
       return PushNotificationCollection::model()->updatePushNotificationAsRead($userId);

      } catch (Exception $ex) {
     Yii::log($exc->getMessage(), 'error', 'application');
      }
      
  }
  public function saveUserLoginFailureActivity($userId){
         try{
              UserInteractionCollection::model()->saveUserLoginFailureActivity($userId,0,0); 
        }catch(Exception $ex){
            Yii::log($ex->getMessage(),'error', 'application');            
            return array();
        } 
     }
      /* 
   * all the below methods are used for custom badges
   */
  public function getAllCustomBadges(){
      try {
          $customBadges=Badges::model()->getCustomBadges();
          return $customBadges;
      } catch (Exception $exc) {
          Yii::log($exc->getMessage(), 'error', 'application');
      }
    }
    
  public function getAllUsersForCustomBadge($searchKey,  $badgeId,  $mentionArray){
       $userDetails = 'failure';
        $users = array();
        $receivedUsersList=array();
        try {          
            if (sizeof($mentionArray) > 0) {
                $mentionArray = array_map('intval', $mentionArray);
            }         
            $userDetails = UserBadgeCollection::model()->getUsersWithBadgeId($badgeId);            
        if(!is_string($userDetails)){
        foreach($userDetails as $userD){
            array_push($receivedUsersList,$userD->UserId);
        }
        }
            if (count($mentionArray) > 0) {
                $users = $mentionArray;
            }            
            if (count($receivedUsersList) > 0) {
                $users = array_merge($users,$receivedUsersList);
            }
            if(count($users)>0){
                array_unique($users);
            }           
        $userDetails = UserCollection::model()->getUsersForCustomBadge($searchKey, $users);        
        
            } catch (Exception $exc) {
           Yii::log($exc->getMessage(), 'error', 'application');
      }
        return $userDetails;
    }  
  public function saveCustomBadgeToUser($badgeId,$atMentions){
      try {
          
          foreach($atMentions as $user){
              //  $badgeDetails=Badges::model()->getBadgeById($badgeId);            
           CommonUtility::customBadgingInterceptor("Custom",$user,$badgeId,'System',''); 
          }
          
      } catch (Exception $exc) {          
          Yii::log($exc->getMessage(), 'error', 'application');
      }
    }
    
 public function editCustomBadge($badgeId){
     try {
         $badgeDetails=Badges::model()->getBadgeById($badgeId);
         return $badgeDetails;
         
     } catch (Exception $exc) {
         error_log("--------in editCustomBadge -----".$exc->getMessage());
     }
  }   
    
 public function saveCustomBadgeDetails($customBadgeForm){
     try {
       $badgeId=$customBadgeForm->id;
       $badggeName=$customBadgeForm->BadgeName;
       $badggeDescription=$customBadgeForm->BadgeDescription;
       $badggeIcon=$customBadgeForm->BadgeIcon;
       $result=Badges::model()->updateCustomBadgeDetails($customBadgeForm);
       $this->updateStreamObjectsForCustomBadge($customBadgeForm);
       return $result;
     } catch (Exception $exc) {
         error_log("---in saveCustomBadgeDetails-service-".$exc->getMessage());
     }
  }
  
  public function updateStreamObjectsForCustomBadge($badgeDetails){
      try {
          UserStreamCollection::model()->updateStreamForCustomBadge($badgeDetails);
          UserActivityCollection::model()->updateStreamForCustomBadge($badgeDetails);
          UserInteractionCollection::model()->updateStreamForCustomBadge($badgeDetails);
          //UserStreamCollection::model()->updateStreamForCustomBadge($badgeDetails);
      } catch (Exception $exc) {
          error_log("---in saveCustomBadgeDetails-service-".$exc->getMessage());
      }
    }
    
  public function getBadgeByName($badgeName){
      try {
          $badgeDetails=Badges::model()->getBadgeDetailsByName($badgeName);
          return $badgeDetails;
      } catch (Exception $exc) {
          error_log($exc->getMessage());
      }
    }
    
  public function checkIfUserAchievedBadge($userId,$badgeId){
      try {
          $userBadgeExists=UserBadgeCollection::model()->checkIfUserAchievedBadge($userId,$badgeId);
          return $userBadgeExists;
      } catch (Exception $exc) {
          error_log($exc->getMessage());
      }
    }
    
 public function getUsersByStoreId($storeId,$limit=''){
     try {
         $users=UserHierarchy::model()->getUsersBYStoreId($storeId,$limit);
         return $users;
     } catch (Exception $exc) {
         error_log($exc->getMessage());
     }
  }
  
 public function updateUserStatusForInactive(){
     try {
         $userList=array();
         $userToexclude=array("3","4","5","7","12");
         $users=User::model()->getAllUsersForInactive();
        
         if(count($users)>0){
              foreach($users as $user){                  
             array_push($userList,$user['UserId']);
         }
         $userList=array_diff($userList,$userToexclude);         
             User::model()->updateStatusAllInactiveUsers($userList);
             UserCollection::model()->updateStatusAllInactiveUsers($userList);
         }
     } catch (Exception $exc) {
         error_log($exc->getMessage());
     }
  } 
    
  public function getUsersByRegionId($regionId){
     try {
         $users=UserHierarchy::model()->getUsersBYRegionId($regionId);
         return $users;
     } catch (Exception $exc) {
         error_log($exc->getMessage());
     }
  }
  public function getUsersBYStoreIds($storeIds){
     try {
         $users=UserHierarchy::model()->getUsersBYStoreIds($storeIds);
         return $users;
     } catch (Exception $exc) {
         error_log($exc->getMessage());
     }
  }
  
  public function getSoreUsersByPagination($storeId,$limit,$offset){
      try {
          $usersList=UserHierarchy::model()->getUsersByStoreIdWithPagination($storeId,$limit,$offset);          
          $usersArray = array();
          if (count($usersList) > 0) {
                    foreach ($usersList as $user) {
                        $tinyUserObj = UserCollection::model()->getTinyUserObjByNetwork($user['UserId']);
                        if (is_object($tinyUserObj)) {
                            array_push($usersArray, $tinyUserObj);
                        }
                    }                 
                }          
          return $usersArray;
      } catch (Exception $exc) {
         error_log($exc->getMessage());
      }
    }
  /** Custom badges end**/  
  
   }


    