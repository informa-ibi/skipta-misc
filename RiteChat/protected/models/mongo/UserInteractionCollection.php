<?php

/**
 * @author sureshreddy
 * @copyright 2013 techo2.com
 * @version 3.0
 * @category Stream
 * @package Stream
 */

/**
 * UserActivityCollection
 *
 * Activity object of user, that behaves user activity of system,
 * 
 */

class UserInteractionCollection extends EMongoDocument {

 
    public $UserId;
    public $CreatedOn;
      public $CreatedDate;
    public $_id;    
    public $StreamNote;
    //1- comment , 2-followers, 3-mentions
    public $RecentActivity;
    public $ActionType;
    public $CategoryType;
    public $PostType;
    public $FollowEntity;
    public $NetworkId;
    public $CommentUserId=array();
    public $Comments=array();
    public $FollowUserId=array();
    public $MentionUserId;
    public $PostId;
    public $PostText;
    public $Resource;
    public $IsMultiPleResources;
    public $OriginalUserId;
    public $OriginalPostTime;    
    public $LoveCount=0;
    public $CommentCount=0;
    public $FollowCount=0;
    public $ShareCount=0;
    public $InviteCount=0;
    public $UserFollowers;
    public $StartDate;
    public $EndDate;
    public $EventAttendes = array();
    public $Location;
    public $LoveUserId=array();
    public $StreamNote1;
    public $HashTagPostUserId;
    public $PostFollowers=array();
    public $InviteUsers=array();
    public $InviteMessage;
    public $OptionOne;
    public $OptionTwo;
    public $OptionThree;
    public $OptionFour;
    public $OptionOneCount;
    public $OptionTwoCount;
    public $OptionThreeCount;
    public $OptionFourCount;
    public $ExpiryDate;
    public $SurveyTaken=array();
    public $StartTime;
    public $EndTime;
    public $CurbsideConsultTitle;
    public $CurbsideConsultCategory;
    public $Priority;
    public $IsAbused=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
    public $AbusedUserId;
    public $IsDeleted=0;
    public $IsPromoted=0;
    public $PromotedUserId;
    public $AbusedOn;
    public $GroupId='';
    public $FollowOn;
    public $HashTagId;
    public $HashTagName;
    public $HashTagPostCount;
    public $CurbsideCategoryId;
    public $CurbsideCategoryName;
    public $PostTextLength;
    public $CurbsidePostCount=0;
    public $IsBlockedWordExist=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
    public $IsBlockedWordExistInComment=0;
    public $DisableComments=0;
    public $Division=0;
    public $District=0;
    public $Region=0;
    public $Store=0;
    public $Title;
    public $FbShare;
    public $TwitterShare;
    public $SubGroupId=0;
    // public $priority;

    //  public $ppt;
    //  public $docs;
    // public $audio;
    // public $video;
     /*Analytics Start*/
    public $ProfileId;
    public $projectSearchText;
    public $projectSearchType;
    public $userActivityIndex;
    public $userActivityContext;

    public $pageIndex;

    public $IsComebackUser=0;

    
      /*
     * @var type news stream related vars
     */
    public $HtmlFragment;
    public $PublisherSource = '';
    public $PublisherSourceUrl = '';
    public $Editorial = '';
    public $Released = 0;
    public $TopicId = 0;
    public $TopicName = '';
    public $Alignment = '';
    public $PublicationTime;
   public $PublicationDate = '';
   public $TopicImage='';
   public $IsNotifiable=1;
   public $GameName;
   public $GameDescription;
   public $GameBannerImage;
   public $CurrentGameScheduleId;
   public $PlayersCount;
public $PlayedUsers;


   
   public $BadgeName;
    public $BadgeLevelValue;
     public $BadgeHasLevel;
   /*Analytics End*/
    
    public function getCollectionName() {

        return 'UserInteractionCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_CategoryType' => array(
                'key' => array(
                    'CategoryType' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_PostType' => array(
                'key' => array(
                    'PostType' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_GroupId' => array(
                'key' => array(
                    'GroupId' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsDeleted' => array(
                'key' => array(
                    'IsDeleted' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsBlockedWordExist' => array(
                'key' => array(
                    'IsBlockedWordExist' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsAbused' => array(
                'key' => array(
                    'IsAbused' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsNotifiable' => array(
                'key' => array(
                    'IsNotifiable' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_PostId' => array(
                'key' => array(
                    'PostId' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_userActivityIndex' => array(
                'key' => array(
                    'userActivityIndex' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_userActivityContext' => array(
                'key' => array(
                    'userActivityContext' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_pageIndex' => array(
                'key' => array(
                    'pageIndex' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsComebackUser' => array(
                'key' => array(
                    'IsComebackUser' => EMongoCriteria::SORT_ASC
                ),
            )
        );
    }
    public function attributeNames() {
        return array(
            '_id' => '_id',
            'UserId' => 'UserId',
            'StreamNote' => 'StreamNote',
            'CreatedOn' => 'CreatedOn',
            'CreatedDate' => 'CreatedDate',
            'FollowOn' =>'FollowOn',
            'PostType' => 'PostType',
            'CategoryType' => 'CategoryType',
            'ActionType' => 'ActionType',
            'RecentActivity' => 'RecentActivity',
            'CommentUserId' => 'CommentUserId',
            'Comments' => 'Comments',
            'FollowUserId' => 'FollowUserId',
            'MentionUserId' => 'MentionUserId',
            'LoveUserId' => 'LoveUserId',
            'PostText' => 'PostText',
            'Resource' => 'Resource',
            'IsMultiPleResources' => 'IsMultiPleResources',
            'OriginalUserId' => 'OriginalUserId',
            'OriginalPostTime' => 'OriginalPostTime',
            'LoveCount' => 'LoveCount',
            'FollowUserId' => 'FollowUserId',
            'PostId' => 'PostId',
            'NetworkId' => 'NetworkId',
            'CreatedOn' => 'CreatedOn',
            'UserFollowers' => 'UserFollowers',
            'StartDate' => 'StartDate',
            'EndDate' => 'EndDate',
            'EventAttendes' => 'EventAttendes',
            'Location' => 'Location',
            'StreamNote1' => 'StreamNote1',
            'HashTagPostUserId' => 'HashTagPostUserId',
            'PostFollowers' => 'PostFollowers',
            'CommentCount' => 'CommentCount',
            'InviteUsers' => 'InviteUsers',
            'InviteMessage' => 'InviteMessage',
            'OptionOneCount' => 'OptionOneCount',
            'OptionTwoCount' => 'OptionTwoCount',
            'OptionThreeCount' => 'OptionThreeCount',
            'OptionFourCount' => 'OptionFourCount',
            'OptionOne' => 'OptionOne',
            'OptionTwo' => 'OptionTwo',
            'OptionThree' => 'OptionThree',
            'OptionFour' => 'OptionFour',
            'ExpiryDate' => 'ExpiryDate',
            'SurveyTaken' => 'SurveyTaken',
            'StartTime' => 'StartTime',
            'EndTime' => 'EndTime',
            'CurbsideConsultTitle' => 'CurbsideConsultTitle',
            'CurbsideConsultCategory' => 'CurbsideConsultCategory',
            'Priority' => 'Priority',
            'IsAbused' => 'IsAbused',
            'AbusedUserId' => 'AbusedUserId',
            'IsDeleted' => 'IsDeleted',
            'IsPromoted' => 'IsPromoted',
            'PromotedUserId' => 'PromotedUserId',
            'AbusedOn' => 'AbusedOn',
            'GroupId' => 'GroupId',           
            'PostTextLength'=>'PostTextLength',
            'CurbsidePostCount'=>'CurbsidePostCount',
            'CurbsideCategoryId'=>'CurbsideCategoryId',
            'IsBlockedWordExist'=>'IsBlockedWordExist',
            'IsBlockedWordExistInComment'=>'IsBlockedWordExistInComment',
            'DisableComments'=>'DisableComments',
               'Division'=>'Division',
            'District'=>'District',
            'Region'=>'Region',
             'Store'=>'Store',
             'Title'=>'Title',
            'ShareCount'=>'ShareCount',
            'FbShare'=>'FbShare',
             'ProfileId' => 'ProfileId',
            'TwitterShare'=>'TwitterShare',
             'SubGroupId'=>'SubGroupId',
            'userActivityIndex'=>'userActivityIndex',

            'userActivityContext'=>'userActivityContext',
             'pageIndex'=>'pageIndex',
             'IsComebackUser'=>'IsComebackUser',
            
             
              'HtmlFragment' => 'HtmlFragment',
            'PublicationDate'=>'PublicationDate',
            'PublisherSource'=>'PublisherSource',
            'PublisherSourceUrl'=>'PublisherSourceUrl',
            'Editorial'=>'Editorial',
            'Released'=>'Released',
            'TopicId'=>'TopicId',
            'TopicName'=>'TopicName',
            'Alignment'=>'Alignment',
            'PublicationTime'=>'PublicationTime',
            'TopicImage'=>'TopicImage',
            'IsNotifiable'=>'IsNotifiable',
            'GameName'=>'GameName',
             'GameDescription'=>'GameDescription',
             'GameBannerImage'=>'GameBannerImage',
            'CurrentGameScheduleId' =>'CurrentGameScheduleId',
            'PlayersCount' =>'PlayersCount',
             'PlayedUsers' => 'PlayedUsers',
            
            'BadgeName'=>'BadgeName',
             'BadgeLevelValue'=>'BadgeLevelValue',
            'BadgeHasLevel'=>'BadgeHasLevel'
   
            );
    }
    /**
     * 
     * @param type $obj
     */
    
    public function saveUserActivityForPost($obj) {
        try {
            $streamObj = new UserInteractionCollection();
            $streamObj->UserId = (int)$obj->UserId;
            $streamObj->StreamNote = $obj->StreamNote;
            $streamObj->StreamNote1 = $obj->StreamNote1;
            $streamObj->CreatedOn =  $obj->CreatedOn;
            $createdOn = $obj->CreatedOn;
            $streamObj->CreatedDate = date('Y-m-d', $createdOn->sec); 
            $streamObj->ActionType = $obj->ActionType;
            $streamObj->NetworkId = (int)$obj->NetworkId;
            $obj->PostType=(int)$obj->PostType;
            $streamObj->PostType = (int)$obj->PostType;
             $streamObj->CategoryType = (int)$obj->CategoryType;
            $streamObj->FollowEntity = (int)$obj->FollowEntity;

            $streamObj->RecentActivity = $obj->RecentActivity;
            //echo " grop iddddddddddddddddddd".$obj->GroupId;
            if($obj->CategoryType==3){
                $streamObj->GroupId =  new MongoId($obj->GroupId);
            }
            if($obj->CategoryType==7){
                $streamObj->GroupId =  new MongoId($obj->GroupId);
                $streamObj->SubGroupId =  new MongoId($obj->SubGroupId);
            }
            if(isset($obj->FollowOn) && !empty($obj->FollowOn)){
                $obj->FollowOn = $obj->FollowOn;
            }else{
                $obj->FollowOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time()))); 
            }
            if (isset($obj->Comments['CommentId'])) {
                $obj->Comments['CommentId'] = new MongoId($obj->Comments['CommentId']);
                $streamObj->Comments = array($obj->Comments);
                $streamObj->CommentUserId = array((int) $obj->CommentUserId);
            } else {
                $streamObj->Comments = array();
                $streamObj->CommentUserId = array();
            }


            $streamObj->FollowUserId = array();

            if ($obj->MentionUserId != "" && $obj->MentionUserId != null) {
                $streamObj->MentionUserId = (int) $obj->UserId;
            }

            if ($obj->PostFollowers != "" && $obj->PostFollowers != null) {
                $streamObj->PostFollowers = array((int)$obj->UserId) ;
            } else {

                $streamObj->PostFollowers = array();
            }
            if (isset($obj->FbShare) && $obj->FbShare != "" && $obj->FbShare != null) {
                $streamObj->FbShare = array((int)$obj->UserId) ;
            } else {

                $streamObj->FbShare = array();
            }
            if (isset($obj->TwitterShare) && $obj->TwitterShare != "" && $obj->TwitterShare != null) {
                $streamObj->TwitterShare = array((int)$obj->UserId) ;
            } else {

                $streamObj->TwitterShare = array();
            }

            $streamObj->FollowUserId = array();
           if ($obj->LoveUserId != "" && $obj->LoveUserId != null) {
                $streamObj->LoveUserId = array((int) $obj->UserId);
            } else {

                $streamObj->LoveUserId = array();
            }


            $streamObj->PostId = new MongoId($obj->PostId);
            $streamObj->PostText = $obj->PostText;
            $streamObj->PostTextLength = $obj->PostTextLength;
            $streamObj->Resource = $obj->Resource;
            $streamObj->IsMultiPleResources = $obj->IsMultiPleResources;
            $streamObj->OriginalUserId = $obj->OriginalUserId;
            $streamObj->OriginalPostTime = new MongoDate($obj->OriginalPostTime);


           

            if ($obj->UserFollowers != "" && $obj->UserFollowers != null) {
                $streamObj->UserFollowers = array($obj->UserFollowers);
            } else {
                $streamObj->UserFollowers = array();
            }
            if ($obj->InviteUsers != "" && $obj->InviteUsers != null) {
                $streamObj->InviteUsers =$obj->InviteUsers;
                $streamObj->InviteMessage = $obj->InviteMessage;
            } else {
                $streamObj->InviteUsers = array();
                $streamObj->InviteMessage = "";
            }
            $streamObj->HashTagPostUserId = $obj->HashTagPostUserId;

            $streamObj->LoveCount = (int) $obj->LoveCount;
            $streamObj->CommentCount = (int) $obj->CommentCount;
            $streamObj->FollowCount = (int) $obj->FollowCount;
            $streamObj->InviteCount = (int) $obj->InviteCount;
            $streamObj->ShareCount = (int) $obj->ShareCount;

            if ($streamObj->PostType == 2) {
                
                $streamObj->StartDate = new MongoDate($obj->StartDate);
                $streamObj->EndDate = new MongoDate($obj->EndDate);
                $streamObj->EventAttendes = (int)$obj->UserId;
                $streamObj->Location = $obj->Location;
                $streamObj->StartTime = $obj->StartTime;
                $streamObj->EndTime = $obj->EndTime;
            }

            if ($streamObj->PostType == 3) {
                $streamObj->ExpiryDate = new MongoDate($obj->ExpiryDate);  

                if ($obj->SurveyTaken != "" && $obj->SurveyTaken != null) {
                    $streamObj->SurveyTaken = (int)$obj->UserId;
                } else {
                    $streamObj->SurveyTaken = array();
                }
                $streamObj->OptionOne = $obj->OptionOne;
                $streamObj->OptionTwo = $obj->OptionTwo;
                $streamObj->OptionThree = $obj->OptionThree;
                $streamObj->OptionFour = $obj->OptionFour;
                $streamObj->OptionOneCount = $obj->OptionOneCount;
                $streamObj->OptionTwoCount = $obj->OptionTwoCount;
                $streamObj->OptionThreeCount = $obj->OptionThreeCount;
                $streamObj->OptionFourCount = $obj->OptionFourCount;
            }
            if ($streamObj->PostType == 5) {
                $streamObj->CurbsideConsultTitle = $obj->CurbsideConsultTitle;
                $streamObj->CurbsideConsultCategory = $obj->CurbsideConsultCategory;
                $streamObj->CurbsideCategoryId = (int)$obj->CurbsideCategoryId;
                $streamObj->CurbsidePostCount = $obj->CurbsidePostCount;
            }
            $streamObj->Priority = $obj->Priority;
            //     $utc_str = gmdate("Y-m-d H:i:s", time());
            $streamObj->IsBlockedWordExist = (int) $obj->IsBlockedWordExist;
            if(isset($obj->IsBlockedWordExistInComment) && !empty($obj->IsBlockedWordExistInComment)){
                $streamObj->IsBlockedWordExistInComment = $obj->IsBlockedWordExistInComment;
            }
            $streamObj->DisableComments = $obj->DisableComments;
            $streamObj->Division=(int) $obj->Division;
            $streamObj->District= (int)$obj->District;
            $streamObj->Region= (int)$obj->Region;
            $streamObj->Store= (int)$obj->Store;
            $streamObj->Title= $obj->Title;
           // $streamObj->Title= $obj->Title;
            if($obj->ActionType=="Post"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("PostCreated");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("PostCreated");
                $streamObj->pageIndex = CommonUtility::getPageIndex("Post");
            }
            if($obj->ActionType=="EventAttend"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("EventAttend");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("EventAttend");
               $streamObj->pageIndex = CommonUtility::getPageIndex("Post");
            }
            if($obj->ActionType=="Survey"){
                   error_log("---------------------in svuery--------------");
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("SurveySubmit");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("SurveySubmit");
                $streamObj->pageIndex = CommonUtility::getPageIndex("Post");
            }
             if($obj->ActionType=="Love"){
                 
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Love");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("Love");
               $streamObj->pageIndex = CommonUtility::getPageIndex("Post");

            }
             if($obj->ActionType=="HashTagUsage"){
                 
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("HashTagUsage");
                $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("HashTagUsage");
               $streamObj->pageIndex = CommonUtility::getPageIndex("Post");

            }
              if($obj->ActionType=="Comment"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Comment");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("Comment");
               $streamObj->pageIndex = CommonUtility::getPageIndex("Post");
            }
             if($obj->ActionType=="Follow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Follow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("Follow");
               $streamObj->pageIndex = CommonUtility::getPageIndex("Post");
            }
            if($obj->ActionType=="UnFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("UnFollow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("UnFollow");
             $streamObj->pageIndex = CommonUtility::getPageIndex("Post");
            }
            if($obj->ActionType=="GroupFollow"){
                error_log("---------------------groupfollow--------------");
                $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Follow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("GroupFollow");
                $streamObj->pageIndex = CommonUtility::getPageIndex("Group");
            }
            if($obj->ActionType=="GroupUnFollow"){
                  error_log("---------------------groupunfollow--------------");
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("UnFollow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("GroupUnFollow");
                 $streamObj->pageIndex = CommonUtility::getPageIndex("Group");
            } if($obj->ActionType=="SubGroupFollow"){
                error_log("---------------------SubGroupFollow--------------");
                $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Follow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("SubGroupFollow");
               $streamObj->pageIndex = CommonUtility::getPageIndex("SubGroup");
            }
            if($obj->ActionType=="SubGroupUnFollow"){
                  error_log("---------------------SubGroupUnFollow--------------");
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("UnFollow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("SubGroupUnFollow");
    $streamObj->pageIndex = CommonUtility::getPageIndex("SubGroup");
            }
            if($obj->ActionType=="CurbsideCategoryFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Follow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("CurbsideCategoryFollow");
$streamObj->pageIndex = CommonUtility::getPageIndex("CurbStream");
            }
            if($obj->ActionType=="CurbsideCategoryUnFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("UnFollow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("CurbsideCategoryUnFollow");
$streamObj->pageIndex = CommonUtility::getPageIndex("CurbStream");
            }
             if($obj->ActionType=="HashTagFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Follow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("HashTagFollow");

            }
            if($obj->ActionType=="HashTagUnFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("UnFollow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("HashTagUnFollow");

            }
            if($obj->ActionType=="UserFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Follow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("UserFollow");

            }
            if($obj->ActionType=="UserUnFollow"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("UnFollow");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("UserUnFollow");

            }
             if($obj->ActionType=="FbShare"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Share");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("FBShare");

            }
             if($obj->ActionType=="TwitterShare"){
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Share");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("TwitterShare");

            }
            error_log("invire-----------------".$obj->ActionType);
            if($obj->ActionType=="Invite"){
                error_log("ooooooooooooooooooo");
                 $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Invite");
               $streamObj->userActivityContext = CommonUtility::getUserActivityContextIndexByActionType("Invite");
               $streamObj->pageIndex = CommonUtility::getPageIndex("Post");

            }
            
              if ($obj->CategoryType == 8) {
                $streamObj->HtmlFragment = $obj->HtmlFragment;
                $streamObj->TopicId = $obj->TopicId;
                $streamObj->Released = $obj->Released;
                $streamObj->Editorial = $obj->Editorial;
                $streamObj->PublisherSource = $obj->PublisherSource;
                $streamObj->PublicationTime = $obj->PublicationTime;
                $streamObj->PublicationDate = $obj->PublicationDate;
                $streamObj->PublisherSourceUrl = $obj->PublisherSourceUrl;
                $streamObj->TopicName = $obj->TopicName;
                $streamObj->Alignment = $obj->Alignment;
                $streamObj->Title = $obj->Title;
                $streamObj->TopicImage = $obj->TopicImage;
                $streamObj->IsNotifiable = $obj->IsNotifiable;
            }

              if($obj->CategoryType==9){
                $streamObj->pageIndex = CommonUtility::getPageIndex("Game");
                $streamObj->userActivityIndex = CommonUtility::getUserActivityIndexByActionType("Share");
                $streamObj->GameName =  $obj->GameName;
                $streamObj->GameDescription =  $obj->GameDescription;
                $streamObj->PostFollowers =  $obj->PostFollowers;
               // $streamObj->QuestionsCount =  $obj->QuestionsCount;
                $streamObj->PlayersCount =  $obj->PlayersCount;
                error_log("--------------".$obj->CurrentGameScheduleId);
//                $streamObj->CurrentGameScheduleId=new MongoId($obj->CurrentGameScheduleId);
                $streamObj->GameBannerImage=$obj->GameBannerImage;

                $streamObj->StartDate=$obj->StartDate;
                $streamObj->EndDate=$obj->EndDate;
                

                if($obj->ActionType == "Play"){
                    $streamObj->PlayedUsers=array($obj->CurrentScheduledPlayers);
                }

                
            }
         
              if ($obj->CategoryType == 10) {

                $streamObj->PostText = $obj->PostText;
                $streamObj->BadgeName = $obj->BadgeName;
                $streamObj->Title = $obj->Title;
                $streamObj->BadgeLevelValue = $obj->BadgeLevelValue;
                $streamObj->BadgeHasLevel = $obj->BadgeHasLevel;
            }


            if ($streamObj->save()) {
                
            }
            

        } catch (Exception $exc) {
            //echo '______________in save user activitity  __________' . $exc->getMessage();
             echo $exc->getLine().'______________in save user activitity  __________' . $exc->getTraceAsString();
        }
    }
    /**
    * @Author Praneeth
    * This method is used to get Events the user is attending
    * @param type $userId,$date
    * @return type tiny user collection object
    */
    public function getUserEventsAttendingActivity($userId,$CurrentLoginDate)
    {       
        try
        {   
             if(empty($CurrentLoginDate)){
                $date_C = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }else{
                $date_C = new MongoDate($CurrentLoginDate);
            }           
            $criteria = new EMongoCriteria;  
            $criteria->addCond('UserId', '==', (int)$userId);
            $criteria->addCond('PostType', '==',(int)2);
            $criteria->addCond('EndDate', '>=', $date_C);
            $criteria->addCond('ActionType', '==', "EventAttend");
            $criteria->addCond('CategoryType', '!=', 7);
            $criteria->addCond('IsBlockedWordExistInComment', 'notin', array(1,2));
            $criteria->addCond('IsBlockedWordExist', 'notin', array(1,2));
            $criteria->addCond('IsDeleted', '!=', 1);
            $criteria->addCond('IsAbused', 'notin', array(1,2));
            $objFollowers=  UserInteractionCollection::model()->findAll($criteria);
            return $objFollowers;
        } catch (Exception $ex) {
                Yii::log("-----in exception--------followOrUnfollowGroup---------inUserProfileCollection-----------".$ex->getMessage(), 'error', 'application');
        }
    }
    /**
     * @author sagar
     * @usage update  post management action like delete, abuse 
     * 
     */
    
     public function updatePostManagementActions($obj) {
        try {
//        echo "****in user interaction*****".$obj->PostId;
//        echo "****$obj->ActionType*****";
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoCriteria->addCond('CategoryType', '==', (int)$obj->CatagoryId);
            $mongoCriteria->addCond('NetworkId', '==', (int)$obj->NetworkId);
           if ($obj->ActionType == 'Abuse') {
                $mongoModifier->addModifier('IsAbused', 'set', 1);
                $mongoModifier->addModifier('AbusedUserId', 'set', (int) $obj->UserId);
                $mongoModifier->addModifier('AbusedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
            } elseif ($obj->ActionType == "Block") {
                if($obj->IsBlockedWordExist==0){
                    $mongoModifier->addModifier('IsAbused', 'set', 2);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 2);
                 }
            } elseif ($obj->ActionType == "Release") {
                if($obj->IsBlockedWordExist==0){
                    $mongoModifier->addModifier('IsAbused', 'set', 0);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 0);
                 }
            } elseif ($obj->ActionType == "Promote") {
                $mongoModifier->addModifier('IsPromoted', 'set', 1);
                $mongoModifier->addModifier('PromotedUserId', 'set', (int) $obj->UserId);
                $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime("+1 day", strtotime($obj->PromotedDate))));
                $mongoCriteria->addCond('UserId', '==', 0);
            } elseif ($obj->ActionType == "Delete") {
                $mongoModifier->addModifier('IsDeleted', 'set', 1);
            }
             elseif ($obj->ActionType=="Featured") {
                $mongoModifier->addModifier('FeaturedUserId', 'set', (int)$obj->UserId);
                $mongoModifier->addModifier('IsFeatured', 'set', (int)1);
            }
            elseif ($obj->ActionType=="NewsNotify") {
                $mongoModifier->addModifier('IsNotifiable', 'set',(int)$obj->IsNotifiable);
                $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
            }
            UserInteractionCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur user interaction collection of post management actions" . $exc->getMessage();
        }
    }
    /**
     * @author sagar
     * @usage update comment management action like  block / release  
     */
    
       public function updateCommentManagementActions($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoCriteria->Comments->CommentId("==" ,new MongoID($obj->CommentId));
            $mongoCriteria->addCond('CategoryType', '==', (int)$obj->CatagoryId);
           if ($obj->ActionType == "CommentBlock") {
                $mongoModifier->addModifier('Comments.$.IsBlockedWordExist', 'set', 2);
            } elseif ($obj->ActionType == "CommentRelease") {
                $mongoModifier->addModifier('Comments.$.IsBlockedWordExist', 'set', 0);
            }
            $returnValue = UserInteractionCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            if($returnValue){
                $criteria = new EMongoCriteria;
                $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
                $criteria->Comments->IsBlockedWordExist("==" ,1); 
                $resobj = UserInteractionCollection::model()->findAll($criteria);
                if (!is_array($resobj) && sizeof($resobj)>0) {
                    $criteria = new EMongoCriteria;
                    $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
                    $mongoModifier = new EMongoModifier;  
                    $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 0);
                    if ($obj->ActionType == "CommentRelease") {
                        $mongoModifier->addModifier('CommentCount', 'inc',  1);
                    }
                    $returnValue=UserInteractionCollection::model()->updateAll($mongoModifier,$criteria);
                    if($returnValue){
                        $returnValue = 'PostReleased';
                    }
                }else{
                    if ($obj->ActionType == "CommentRelease") {
                        $criteria = new EMongoCriteria;
                        $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
                        $mongoModifier = new EMongoModifier;
                        $mongoModifier->addModifier('CommentCount', 'inc',  1);
                        UserInteractionCollection::model()->updateAll($mongoModifier,$criteria);
                    }
                    $returnValue = 'CommentReleased';
                }
             }
        } catch (Exception $exc) {
            echo "exception occur while user activity collection comment management actions" . $exc->getMessage();
        }
    }

    
    public function saveUserLoginActivity($userId,$activityIndex,$activityContextIndex){
        try{
              $activityObj = new UserInteractionCollection();
            if($this->checkForComebackUser($userId)){
                $activityObj->IsComebackUser = (int)1; 
            }
         $activityObj->UserId = (int)$userId;
         $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
          $activityObj->CreatedDate =date("Y-m-d");
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }  
        } catch (Exception $ex) {
         return "failure"; 
        }
        
    }
    public function checkForComebackUser($userId){
          try{
              $criteria = new EMongoCriteria;
             $today =  date('Y-m-d H:i:s');
             $beforeDate =  date('Y-m-d', strtotime('-21 days'));
             $beforeDate = $beforeDate." 00:00:00";
             $criteria->UserId = (int)$userId;
             $criteria->CreatedOn = array('$gte' => new MongoDate(strtotime($beforeDate)),'$lte' => new MongoDate(strtotime($today)));
             $row = UserInteractionCollection::model()->find($criteria); 
             
             if($row==null){
               return true;
                
             }else{
                return false;  
             }
          } catch (Exception $ex) {

          }
    }
    public function saveHashTagCreationActivity($from,$categoryId,$postType,$userId,$hashTagId,$hashTag,$activityIndex,$activityContextIndex,$id,$createddate=''){
        try{
           $activityObj = new UserInteractionCollection();
         $activityObj->UserId = (int)$userId;
           $activityObj->CategoryType = (int)$categoryId;
           $activityObj->PostType = (int)$postType;
          $activityObj->HashTagId = new MongoId($hashTagId);
           $activityObj->HashTagName = $hashTag;
         $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
           $pageIndex = CommonUtility::getPageIndex("HashTag");
 if($from=="Group"){
      $activityObj->GroupId = new MongoId($id);
 }
 if($from=="SubGroup"){
      $activityObj->SubGroupId = new MongoId($id);
 }
          $activityObj->pageIndex =(int)$pageIndex;
            if(isset($createddate) && !empty($createddate)){
                $activityObj->CreatedOn = new MongoDate(strtotime(date($createddate, time())));
                $activityObj->CreatedDate =date('Y-m-d', strtotime(date($createddate, time())));
            }else{
                $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
                $activityObj->CreatedDate =date('Y-m-d');
            }
           
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }  
        } catch (Exception $ex) {
             error_log("saveHashTagCreationActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        } 
    }
    function saveMentionUsageActivity($categoryId,$type,$userId,$mentionUserId,$activityIndex,$activityContextIndex){
        try{
           $activityObj = new UserInteractionCollection();
         $activityObj->UserId = (int)$userId;
          $activityObj->CategoryType = (int)$categoryId;
           $activityObj->PostType = (int)$type;
            $activityObj->MentionUserId = (int)$mentionUserId;
             error_log("saveMentionUsageActivity--------------------------------------1");
         $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $pageIndex = CommonUtility::getPageIndex("Mention");
            $activityObj->pageIndex = (int)$pageIndex;
            error_log("saveMentionUsageActivity--------------------------------------2");
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
            error_log("saveMentionUsageActivity--------------------------------------3");
         if($activityObj->save()){
               error_log("saveMentionUsageActivity-------------------------------save-------");
            return "success"; 
         }else{
               error_log("saveMentionUsageActivity-------------------fail-------------------");
            return "failure";  
         }  
        } catch (Exception $ex) {
             error_log("saveMentionUsageActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }  
    }
    function savePostActionActivity($categoryId,$type,$userId,$activityIndex,$activityContextIndex){
       try{
           $activityObj = new UserInteractionCollection();
         $activityObj->UserId = (int)$userId;
          $activityObj->CategoryType = (int)$categoryId;
           $activityObj->PostType = (int)$type;
         $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }  
        } catch (Exception $ex) {
             error_log("saveMentionUsageActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }    
    }
    function saveSearchActivity($searchText,$loginUserId,$activityIndex,$activityContextIndex,$NetworkId){
        try{
            error_log("saveSearchActivity-------------------".$loginUserId);
           $activityObj = new UserInteractionCollection();
          $activityObj->UserId = (int)$loginUserId;
          error_log("1111111111111111111111");
          $activityObj->projectSearchText = $searchText;
         $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
             error_log("222222222222222222222");
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
           $activityObj->CreatedDate =date('Y-m-d');
            $activityObj->NetworkId =(int)$NetworkId;
           error_log("saveSearchActivity-----------------bsave--");
         if($activityObj->save()){
             error_log("asvddddddddddddddddddddddddddddd");
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("saveMentionUsageActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }
    }
    function trackMinHashTagWindowOpen($userId,$hashtagId,$hashTagName,$activityIndex,$activityContextIndex,$NetworkId){
         try{
           $activityObj = new UserInteractionCollection();
          $activityObj->UserId = (int)$userId;
          $activityObj->HashTagId = new MongoId($hashtagId);
         $activityObj->HashTagName = $hashTagName;
          $pageIndex = CommonUtility::getPageIndex("CurbStream");
          $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
           $activityObj->pageIndex = (int)$pageIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
             $activityObj->NetworkId =(int)$NetworkId;
          
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("saveMentionUsageActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }
    }
    function trackMinMentionWindowOpen($loginUserId,$mentionUserId,$activityIndex,$activityContextIndex,$NetworkId){
         try{
           $activityObj = new UserInteractionCollection();
          $activityObj->UserId = (int)$loginUserId;
          $activityObj->MentionUserId = (int)$mentionUserId;
          $activityObj->userActivityIndex = (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
             $activityObj->NetworkId = (int) $NetworkId;
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("saveMentionUsageActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }
    }
    function trackFilterByCategory($userId,$categoryId,$categoryName,$activityIndex,$activityContextIndex,$NetworkId){
        try{
            $activityObj = new UserInteractionCollection();
            $activityObj->UserId = (int) $userId;
            $activityObj->CurbsideCategoryId = (int) $categoryId;
            $activityObj->CurbsideCategoryName = $categoryName;
            $activityObj->userActivityIndex = (int) $activityIndex;
            $activityObj->userActivityContext = (int) $activityContextIndex;
            $pageIndex = CommonUtility::getPageIndex("CurbStream");
            $activityObj->pageIndex = (int) $pageIndex;
            $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate = date('Y-m-d');
            $activityObj->NetworkId = (int) $NetworkId;

            if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("saveMentionUsageActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        } 
    }
    function trackPostDetailsOpenActivity($userId,$categoryType,$postType,$postId,$activityIndex,$activityContextIndex,$NetworkId){
        try{
          $activityObj = new UserInteractionCollection();
          $activityObj->UserId = (int)$userId;
          $activityObj->CategoryType = (int)$categoryType;
          $activityObj->PostType = (int)$postType;
          $activityObj->PostId = (int)$postId;
          $activityObj->userActivityIndex= (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
             $activityObj->NetworkId = (int) $NetworkId;
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("trackPostDetailsOpenActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }  
    }
  function trackPageLoad($from,$dataId,$userId,$activityIndex,$activityContextIndex, $NetworkId){
    try{
        error_log("trackPageLoad-------------------------------".$dataId);
          $activityObj = new UserInteractionCollection();
          $activityObj->UserId = (int)$userId;
          $activityObj->userActivityIndex= (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
             $activityObj->NetworkId = (int) $NetworkId;
          
           if($from == "GroupDetail" || $from == "GroupMinPopup"){
            $activityObj->GroupId = new MongoId($dataId);
           }
            if($from == "SubGroupDetail" || $from == "SubGroupMinPopup"){
            $activityObj->SubGroupId =new MongoId($dataId);
           }
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("trackPostDetailsOpenActivity-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }  
  }
  function trackNewGroupCreation($UserId,$groupId,$activityIndex,$activityContextIndex,$NetworkId){
     try{
         error_log("trackNewGroupCreation@@@@@@@@@@@@".$UserId."---".$groupId."---".$activityIndex."---".$activityContextIndex);
          $activityObj = new UserInteractionCollection();
          $activityObj->UserId = (int)$UserId;
           $activityObj->GroupId = new MongoId($groupId);
            error_log("trackNewGroupCreation@@@@@@@@@@@@111");
          $activityObj->userActivityIndex= (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
           error_log("trackNewGroupCreation@@@@@@@@@@@@22");
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            $activityObj->CreatedDate =date('Y-m-d');
            $activityObj->NetworkId=(int)$NetworkId;
         if($activityObj->save()){
              error_log("trackNewGroupCreation@@@@@@@@@@@@333");
            return "success"; 
         }else{
              error_log("trackNewGroupCreation@@@@@@@@@@@@44");
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("trackNewGroupCreation-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }   
  }

    
    
    public function getActiveUsersBetweenDates($startDate,$endDate,$NetworkId)
    {       
        try
        {   
            $returnvalue="failure";
            $startDate=date('Y-m-d',strtotime($startDate));
            $endDate=date('Y-m-d',strtotime($endDate));
            $criteria = new EMongoCriteria;  
            $endDate =$endDate." 23:59:59";
             $startDate =$startDate." 00:00:00";
            
            
            $startDate=date('Y-m-d H:i:s',strtotime($startDate));
            $endDate=date('Y-m-d H:i:s',strtotime($endDate));
            $criteria->addCond('NetworkId', '==', (int)$NetworkId);
            $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
            //$criteria->CreatedOn = array('$lt' => new MongoDate(strtotime($endDate)));
            
            $ActiveUsers=  UserInteractionCollection::model()->findAll($criteria);
            if(is_array($ActiveUsers)){
               $returnvalue=count($ActiveUsers); 
            }
            return $returnvalue;
        } catch (Exception $ex) {
                Yii::log("-----in exception--------followOrUnfollowGroup---------inUserProfileCollection-----------".$ex->getMessage(), 'error', 'application');
        }
    }
      public function getCombackUsersBetweenDates($startDate,$endDate,$NetworkId)
    {       
        try
        {   
            $returnvalue="failure";
            $startDate=date('Y-m-d',strtotime($startDate));
            $endDate=date('Y-m-d',strtotime($endDate));
            $criteria = new EMongoCriteria;  
            $endDate =$startDate." 23:59:59";
            $startDate =$startDate." 00:00:00";
            $startDate=date('Y-m-d H:i:s',strtotime($startDate));
            $endDate=date('Y-m-d H:i:s',strtotime($endDate));
            
            $criteria->addCond('IsComebackUser', '==', (int) 1);
            $criteria->addCond('UserId', '==', (int) $value->UserId);
            $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
            $ComebackUsers=  UserInteractionCollection::model()->findAll($criteria);
            $comebackuserCount=count($ComebackUsers);
//             $comebackUserstartDate= gmdate('Y-m-d', strtotime ("-21 days",strtotime ($startDate)));
//            $comebackUserstartDate= date('Y-m-d H:i:s',strtotime($comebackUserstartDate));
//           $comebackUserEndDate= $comebackUserstartDate." 23:59:59";
//            $comebackUserEndDate=date('Y-m-d H:i:s',strtotime($startDate));
//            $comebackuserCount=0;
//            $activeUsers=array();
//            foreach ($ActiveUsers as $key => $value) {
//               
//               // 
//                if(!in_array($value->UserId, $activeUsers)){
//
//                    $criteria->addCond('UserId', '==', (int) $value->UserId);
//                    $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($comebackUserstartDate)));
//                    $criteria->CreatedOn = array('$lt' => new MongoDate(strtotime($comebackUserEndDate)));
//                    $ComebackUsers=  UserInteractionCollection::model()->findAll($criteria);
//                    if(is_array($ComebackUsers)){
//                        if(count($ComebackUsers)>0){
//                            $comebackuserCount=$comebackuserCount;
//                        }else{
//                            $comebackuserCount=$comebackuserCount+1;
//                        }
//
//                    }
//                    array_push($activeUsers, $value->UserId);
//                }
//                
//
//            }
           
            return $comebackuserCount;
        } catch (Exception $ex) {
                Yii::log("-----in exception--------followOrUnfollowGroup---------inUserProfileCollection-----------".$ex->getMessage(), 'error', 'application');
        }
    }
    
function trackEngagementAction($userId,$page,$action,$dataId,$categoryType,$postType,$id='',$NetworkId){
    try{
        error_log("trackEngagementAction------$userId-----$page------------$action--------".$dataId);
          $activityObj = new UserInteractionCollection();
         
          
          
          $pageIndex = CommonUtility::getPageIndex($page);
          $activityIndex = CommonUtility::getUserActivityIndexByActionType($action);
          $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType($action);
          //if($page=="GroupStream" && ($action == "GroupDetail" || $action == "Loaded" || $action == "Scroll")){
          if($page=="GroupStream"){
            if($id!=''){
              $activityObj->GroupId = new MongoId($id);   
            }else{
                $activityObj->GroupId = new MongoId($dataId); 
            }
              
          }
          if($page=="SubGroup" || $page=="SubGroupStream"){
             // $activityObj->SubGroupId = new MongoId($dataId); 
              
               if($id!=''){
                  $activityObj->GroupId =  GroupCollection::model()->findGroupBySubgroupId($id);
              $activityObj->SubGroupId = new MongoId($id);   
            }else{
                  $activityObj->GroupId =  GroupCollection::model()->findGroupBySubgroupId($dataId);
                $activityObj->SubGroupId = new MongoId($dataId); 
            }
          }
          if($page=="ProfileStream"){
              $activityObj->ProfileId = (int)$dataId; 
          }
           if($action=="GroupMinPopup"){
              $activityObj->GroupId = new MongoId($dataId); 
          }
           if($action=="SubGroupMinPopup"){
                 $activityObj->GroupId =  GroupCollection::model()->findGroupBySubgroupId($dataId);
              $activityObj->SubGroupId = new MongoId($dataId);  
          }
          if($page == "PostDetail" || $action == "PostDetailOpen" || $action == "PostDetailOpen" || $action == "PostFeatured" || $action=="SurveySubmit" || $action=="EventAttend" || $action == "PostDelete" || $action == "PostPromote" || $action == "PostFlagAbuse" || $page == "News"){
              $activityObj->PostId = new MongoId($dataId);
              
          }
          if($action == "HashTagMinPopup" || $action == "HashTagSearch"){
             $hashtagObj = HashTagCollection::model()->getHashTags($dataId); 
              foreach ($hashtagObj as $hash) {
              $activityObj->HashTagId = new MongoId($hash->_id);
             $activityObj->HashTagName = $hash->HashTagName;
           }
           }
            if($action == "MentionMinPopup"){
              $activityObj->MentionUserId =(int)$dataId;
           }
            if($action == "ProfileMinPopup"){
              $activityObj->ProfileId =(int)$dataId;
           }
            if($action == "CurbCategoryMinPopup"){
              $activityObj->CurbsideCategoryId =(int)$dataId;
           }
            if($action == "ProjectSearch"){
              $activityObj->projectSearchText =$dataId;
           }
             
          
          $activityObj->UserId = (int)$userId;
          $activityObj->pageIndex = (int)$pageIndex;
          if($categoryType!=""){
               $activityObj->CategoryType = (int)$categoryType;
          }
         if($postType != ""){
           $activityObj->PostType = (int)$postType;  
         }
          
          
          $activityObj->userActivityIndex= (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
          // $activityObj->CreatedDate =date('Y-m-d', time());
           $activityObj->CreatedDate=date('Y-m-d');
           
           $activityObj->NetworkId=(int)$NetworkId;
           $activityObj->ActionType=$action;
          
//           if($from == "GroupDetail" || $from == "GroupMinPopup"){
//            $activityObj->GroupId = (int)$dataId;
//           }
//            if($from == "SubGroupDetail" || $from == "SubGroupMinPopup"){
//            $activityObj->SubGroupId = (int)$dataId;
//           }
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("trackEngagementAction-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }  
  }
  
  
  function trackSearchEngagementAction($userId,$page,$action,$dataId,$searchText,$searchType,$NetworkId){
    try{
        error_log("trackSearchEngagementAction------$userId-----$page------------$action--------".$dataId."-----".$searchType);
          $activityObj = new UserInteractionCollection();
          
          $pageIndex = CommonUtility::getPageIndex($page);
          $activityIndex = CommonUtility::getUserActivityIndexByActionType($action);
          $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType($action);
          if($searchType=="group"){
              $activityObj->GroupId = new MongoId($dataId); 
          }
          if($searchType=="subgroup"){
             
              $activityObj->SubGroupId = new MongoId($dataId); 
          }
          if($searchType=="profile"){
              $activityObj->ProfileId = (int)$dataId; 
          }
          if($searchType == "hashtag"){
              $activityObj->HashTagId = new MongoId($dataId);
              
          }
          if($action == "ProjectSearch"){
              $activityObj->projectSearchText =$searchText;
              $activityObj->projectSearchType = (int)CommonUtility::getProjectSearchTypeIndex($searchType);
           }
             
          
          $activityObj->UserId = (int)$userId;
          $activityObj->pageIndex = (int)$pageIndex;
                  
          
          $activityObj->userActivityIndex= (int)$activityIndex;
          $activityObj->userActivityContext = (int)$activityContextIndex;
          $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
          // $activityObj->CreatedDate =date('Y-m-d', time());
            $activityObj->CreatedDate=date('Y-m-d');
             $activityObj->NetworkId=(int)$NetworkId;

//           if($from == "GroupDetail" || $from == "GroupMinPopup"){
//            $activityObj->GroupId = (int)$dataId;
//           }
//            if($from == "SubGroupDetail" || $from == "SubGroupMinPopup"){
//            $activityObj->SubGroupId = (int)$dataId;
//           }
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }    
        } catch (Exception $ex) {
         error_log("trackEngagementAction-------------------exception-------------------".$ex->getMessage());
         return "failure"; 
        }  
  }

  public function getStreamEngagement($startDate,$endDate,$type,$NetworkId,$GameAvailable,$NewsAvailable){
      try { 
          $dateFormat = CommonUtility::getDateFormat();

            $finalArray = array();
            $timezone = Yii::app()->session['timezone'];
//            $startDate = CommonUtility::convert_time_zone(strtotime($startDate), "UTC", $timezone);
//            $endDate = CommonUtility::convert_time_zone(strtotime($endDate), "UTC", $timezone);
            $startDate = date('Y-m-d', strtotime($startDate));
            $endDate = date('Y-m-d', strtotime($endDate));
            $dateFrom = new DateTime($startDate);
            $dateTo = new DateTime($endDate);
            $interval = date_diff($dateFrom, $dateTo);
            $diff = $interval->format('%R%a');
            // $valid_times = CommonUtility::GetIntervalsBetweenTwoDates($startDate, $endDate);


            $valid_times = CommonUtility::GetIntervalsBetweenTwoDates($startDate, $endDate);

            if ($diff > 365) {

                $modeType = '$year';
                $datemode = 'YEAR';
            } elseif ($diff > 92 && $diff <= 365) {

                $modeType = '$month';
                $datemode = 'MONTH';
            } elseif ($diff > 31 && $diff <= 92) {
                $modeType = '$week';
                $datemode = 'WEEK';
            } elseif ($diff <= 31) {

                $modeType = '$dayOfMonth';
                $datemode = 'DATE';
            }
            $Resultsid = array(
                'week' => array("$modeType" => '$CreatedOn'),
            );


//------------------- Stream----------------------------------------------------------------------------------------------

            $match = array("pageIndex" => array('$in' => array(1, 2, 3, 4, 5)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $nresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($nresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $existingArray[0] = $value['count'];
                    $finalArray[$value['_id']['week']][0] = $value['count'];
                }
            }


//---------------------------------------Posts-------------------------------------------------------------------------------------------------


            $match = array("pageIndex" => array('$in' => array(6)),
                "NetworkId" => (int) $NetworkId,
                "CategoryType" => array('$in' => array(1)),
                "PostType" => array('$in' => array(1)),
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $presults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);

            foreach ($presults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][1] = $value['count'];
                }
            }

//---------------------------------Curbside Posts------------------------------------------------------------------------------

            $match = array("pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(2)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Cresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Cresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][2] = $value['count'];
                }
            }

//----------------------------Event posts------------------------------------------------------------------------------------         

            $match = array("pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(1, 3, 7)),
                "PostType" => array('$in' => array(2)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Eresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Eresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][3] = $value['count'];
                }
            }

//----------------Survey Posts--------------------------------------------------------------------------------------------------------------

            $match = array("pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(1, 3, 7)),
                "PostType" => array('$in' => array(3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Sresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Sresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][4] = $value['count'];
                }
            }


            //---------------------------------------------------------------Groups--------------------------------------------------------- 

            $match = array("pageIndex" => array('$in' => array(3, 11)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Sresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Sresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][5] = $value['count'];
                }
            }

            //-----------------------------Hashtags---------------------------------------------------------------------------------  

            $match = array("pageIndex" => array('$in' => array(7)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Sresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Sresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][6] = $value['count'];
                }
            }

            //------------------------------News--------------------------------------------------------------------------

            $match = array("pageIndex" => (int) 14,
                "CategoryType" => (int) 8,
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Sresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Sresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][7] = $value['count'];
                }
            }

//---------------------------------Games---------------------------------------------------------------------------------------

            $match = array("pageIndex" => (int) 15,
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Sresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Sresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][8] = $value['count'];
                }
            }


            if ($GameAvailable == 'ON' && $NewsAvailable == 'ON') {
                $removeKeys = array();
            } else if ($GameAvailable == 'ON' && $NewsAvailable == 'OFF') {
                $removeKeys = array('8');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'ON') {
                $removeKeys = array('7');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'OFF') {
                $removeKeys = array('7', '8');
            }

            foreach ($valid_times as $key => $value) {
                $startDate = date('Y-m-d', strtotime($valid_times["$key"]));
                $startDate_tz = CommonUtility::convert_date_zone(strtotime($startDate . " 18:29:00"), date_default_timezone_get(), "UTC");
                $dateArray = array();
                if (is_array($finalArray[$key])) {

                    for ($k = 0; $k < 9; $k++) {
                        if (!array_key_exists($k, $finalArray[$key])) {

                            $finalArray[$key][$k] = 0;
                        }
                    }
                } else {

                    for ($k = 0; $k < 9; $k++) {

                        $finalArray[$key][$k] = 0;
                    }
                }

                ksort($finalArray[$key]);


                if (count($removeKeys) > 0) {
                    foreach ($removeKeys as $ke) {

                        unset($finalArray[$key][$ke]);
                    }
                }


                if ($type == 'xls') {

                    //  $resArr[date($dateFormat, $startDate_tz)] = $dateArray;
                    if ($diff > 365) {
                        $resArray["" . $key . ""] = $finalArray[$key];
                    } elseif ($diff > 92 && $diff <= 365) {
                        $resArray["" . date('M Y', $startDate_tz) . ""] = $finalArray[$key];
                    } elseif ($diff > 31 && $diff <= 92) {
                        $resArray["" . date('m/d/Y', $startDate_tz) . ""] = $finalArray[$key];
                    } elseif ($diff <= 31) {
                        $resArray["" . date('m/d/Y', $startDate_tz) . ""] = $finalArray[$key];
                    }
                } else {

                    if ($diff > 365) {
                        $resArray["'" . $key . "'"] = $finalArray[$key];
                    } elseif ($diff > 92 && $diff <= 365) {
                        $resArray["'" . date('M Y', $startDate_tz) . "'"] = $finalArray[$key];
                    } elseif ($diff > 31 && $diff <= 92) {
                        $resArray["'" . date('m/d/Y', $startDate_tz) . "'"] = $finalArray[$key];
                    } elseif ($diff <= 31) {
                        $resArray["'" . date('m/d/Y', $startDate_tz) . "'"] = $finalArray[$key];
                    }
                }
            }
            if ($diff < 31) {
                ksort($resArray);
            }

            return $resArray;
        } catch (Exception $exc) {
            error_log("excpetion--------------".$exc->getMessage());
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
 
 

   public function getGroupEngagement($groupId,$startDate,$endDate,$type,$NetworkId){
      try {    
           $dateFormat = CommonUtility::getDateFormat();
            // error_log("getGroupEngagement-------$groupId------".$startDate."----".$endDate);
            $finalArray = array();
            $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
            $timezone = Yii::app()->session['timezone'];
//            $startDate = CommonUtility::convert_time_zone(strtotime($startDate), "UTC", $timezone);
//            $endDate = CommonUtility::convert_time_zone(strtotime($endDate), "UTC", $timezone);
            $startDate = date('Y-m-d', strtotime($startDate));
            $endDate = date('Y-m-d', strtotime($endDate));
            $dateFrom = new DateTime($startDate);
            $dateTo = new DateTime($endDate);
            $interval = date_diff($dateFrom, $dateTo);
            $diff = $interval->format('%R%a');


            $valid_times = CommonUtility::GetIntervalsBetweenTwoDates($startDate, $endDate);

            if ($diff > 365) {

                $modeType = '$year';
                $datemode = 'YEAR';
            } elseif ($diff > 92 && $diff <= 365) {

                $modeType = '$month';
                $datemode = 'MONTH';
            } elseif ($diff > 31 && $diff <= 92) {
                $modeType = '$week';
                $datemode = 'WEEK';
            } elseif ($diff <= 31) {

                $modeType = '$dayOfMonth';
                $datemode = 'DATE';
            }

            $Resultsid = array(
                'week' => array("$modeType" => '$CreatedOn'),
            );

//-------------------------------------Group Stream--------------------------------------------------------------------------           

            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $GSresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GSresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][0] = $value['count'];
                }
            }


//-------------------------------Group Normal Posts------------------------------------------------------------------------------------        

            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(3)),
                "PostType" => array('$in' => array(1)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $GNPresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GNPresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][1] = $value['count'];
                }
            }


//---------------------------SubGroups-------------------------------------------------------------------------------------               


            $match = array("SubGroupId" => array('$in' => $groupObj->SubGroups),
                "pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(7)),
                "PostType" => array('$in' => array(1, 2, 3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $SGresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($SGresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][2] = $value['count'];
                }
            }

//----------------------------------Event Posts-----------------------------------------------------------------------------

            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(3)),
                "PostType" => array('$in' => array(2)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Eresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Eresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][3] = $value['count'];
                }
            }

//---------------------------------------Survey Posts-------------------------------------------------------------------------------                


            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(6)),
                "CategoryType" => array('$in' => array(3)),
                "PostType" => array('$in' => array(3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $SPresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($SPresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][4] = $value['count'];
                }
            }

//---------------------------------Serach Items-----------------------------------------------------------------------------------------

            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(9)),
                "projectSearchType" => array('$in' => array(2, 3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $Sresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($Sresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][5] = $value['count'];
                }
            }

//--------------------------------------Hashtags--------------------------------------------------------------------------                

            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(3, 4)),
                "userActivityContext" => array('$in' => array(5, 9, 24, 26, 37, 38, 71)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $results1 = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            $match = array("GroupId" => new MongoId($groupId),
                "pageIndex" => array('$in' => array(7)),
                "CategoryType" => array('$in' => array(3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $results2 = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            $match = array("SubGroupId" => array('$in' => $groupObj->SubGroups),
                "pageIndex" => array('$in' => array(7)),
                "CategoryType" => array('$in' => array(7)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $results3 = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);

            $arr = array_merge($results1, $results2, $results3);

            foreach ($arr as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $finalArray[$value['_id']['week']][6] = $value['count'];
                }
            }

            foreach ($valid_times as $key => $value) {
                $startDate = date('Y-m-d', strtotime($valid_times["$key"]));
                $startDate_tz = CommonUtility::convert_date_zone(strtotime($startDate . " 18:29:00"), date_default_timezone_get(), "UTC");
                $dateArray = array();
                if (is_array($finalArray[$key])) {

                    for ($k = 0; $k < 7; $k++) {
                        if (!array_key_exists($k, $finalArray[$key])) {

                            $finalArray[$key][$k] = 0;
                        }
                    }
                } else {

                    for ($k = 0; $k < 7; $k++) {

                        $finalArray[$key][$k] = 0;
                    }
                }

                ksort($finalArray[$key]);

                if ($type == 'xls') {

                    //  $resArr[date($dateFormat, $startDate_tz)] = $dateArray;
                    if ($diff > 365) {
                        $resArray["" . $key . ""] = $finalArray[$key];
                    } elseif ($diff > 92 && $diff <= 365) {
                        $resArray["" . date('M Y', $startDate_tz) . ""] = $finalArray[$key];
                    } elseif ($diff > 31 && $diff <= 92) {
                        $resArray["" . date('m/d/Y', $startDate_tz) . ""] = $finalArray[$key];
                    } elseif ($diff <= 31) {
                        $resArray["" . date('m/d/Y', $startDate_tz) . ""] = $finalArray[$key];
                    }
                } else {

                    if ($diff > 365) {
                        $resArray["'" . $key . "'"] = $finalArray[$key];
                    } elseif ($diff > 92 && $diff <= 365) {
                        $resArray["'" . date('M Y', $startDate_tz) . "'"] = $finalArray[$key];
                    } elseif ($diff > 31 && $diff <= 92) {
                        $resArray["'" . date('m/d/Y', $startDate_tz) . "'"] = $finalArray[$key];
                    } elseif ($diff <= 31) {
                        $resArray["'" . date('m/d/Y', $startDate_tz) . "'"] = $finalArray[$key];
                    }
                }
            }
            if ($diff < 31) {
                ksort($resArray);
            }

            return $resArray;
        } catch (Exception $exc) {
            error_log("excepoitn------------".$exc->getMessage());
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }

    public function getTopUserOfDay($startDate){
      try {    
          
          $finalArray = array();
            $TopusersOftheDay = array();
            $c = UserInteractionCollection::model()->getCollection();
//            $keys = array("UserId" => 1);
//            $initial = array("count" => 0);
//            $reduce = "function (obj, prev) { prev.count++; }";
//            $condition = array('condition' => array("CreatedDate"=>array('$lte' => $startDate)));

           // $g = $c->group($keys, $initial, $reduce, $condition);
            
           $results = $c->aggregate(
                    array('$match' => array("CreatedDate" => array('$lte' => $startDate),"UserId" => array('$ne' => (int)0))), array('$group' => array(
                    '_id' => '$UserId',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );

            foreach ($results['result'] as $key => $value) {
                
                 if(!in_array($value['_id'], $finalArray)){
                    array_push($finalArray, $value['_id']); 
                }
            }

            return $finalArray;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
  
    public function getTopHashtagsOfDay($startDate){
      try {    
          
          $finalArray = array();
            $TopHashtagsOftheDay = array();

            $c = UserInteractionCollection::model()->getCollection();
//            $keys = array("HashTagName" => 1);
//            $initial = array("count" => 0);
//            $reduce = "function (obj, prev) { prev.count++; }";
//            $condition = array('condition' => array("userActivityContext" => array('$in' => array(3, 4, 5, 6, 7, 8, 9, 10, 24, 26, 37, 38, 71))));
//
//            $g = $c->group($keys, $initial, $reduce, $condition);
//            
//            
             $results = $c->aggregate(
                    array('$match' => array("HashTagName" => array('$ne' =>null),"UserId" => array('$ne' => (int)0),"userActivityContext" => array('$in' => array(3, 4, 5, 6, 7, 8, 9, 10, 24, 26, 37, 38, 71)),"CreatedDate" => array('$lte' => $startDate))), array('$group' => array(
                    '_id' => '$HashTagName',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );


            foreach ($results['result'] as $key => $value) {

                if(!in_array($value['_id'], $finalArray)){
                    array_push($finalArray, $value['_id']); 
                }
            }

            return $finalArray;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
     public function getTopSearchItemsOfDay($startDate){
      try {    
          
          $finalArray = array();
            $TopSearchItemsOftheDay = array();
            $c = UserInteractionCollection::model()->getCollection();
//            $keys = array("projectSearchText" => 1);
//            $initial = array("count" => 0);
//            $reduce = "function (obj, prev) { prev.count++; }";
//            $condition = array('condition' => array("projectSearchText" => array('$ne' => null)));
//            $g = $c->group($keys, $initial, $reduce, $condition);
//            $searchArray = $g['retval'];
//            foreach ($searchArray as $key => $value) {
//                $TopSearchItemsOftheDay[$value['projectSearchText']] = $value['count'];
//            }
//
//            arsort($TopSearchItemsOftheDay);
//            foreach ($TopSearchItemsOftheDay as $key => $value) {
//
//                array_push($finalArray, $key);
//            }
//            
             $results = $c->aggregate(
                    array('$match' => array("projectSearchText" => array('$ne' =>null),"UserId" => array('$ne' => (int)0),"CreatedDate" => array('$lte' => $startDate))), array('$group' => array(
                    '_id' => '$projectSearchText',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );


            foreach ($results['result'] as $key => $value) {

               if(!in_array($value['_id'], $finalArray)){
                    array_push($finalArray, $value['_id']); 
                }
            }
            return $finalArray;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
  
  
  public function getGroupTopUserOfDay($groupId,$subgroups,$startDate){
      try {    
          
          $finalArray = array();
            $TopusersOftheDay = array();
            $c = UserInteractionCollection::model()->getCollection();
            
             $results = $c->aggregate(
                    array('$match' => array("GroupId" => new MongoID($groupId))), array('$group' => array(
                    '_id' => '$UserId',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );
            
            $usersArray =$results['result'];

            foreach ($usersArray as $key => $value) {
      
                 if(!in_array($value['_id'],$TopusersOftheDay)){
                    $TopusersOftheDay[$key] = $value['_id'];
                    
                }
              
            }
          
            
            if (count($subgroups) > 0) {
                $c = UserInteractionCollection::model()->getCollection();
                  $Subgroupresults = $c->aggregate(
                    array('$match' => array("SubGroupId" => new MongoID($groupId))), array('$group' => array(
                    '_id' => '$UserId',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
                );
                
                
                $SubusersArray = $Subgroupresults['result'];


                if (count($SubusersArray) > 0) {
                    foreach ($SubusersArray as $key => $value) {
                        if(!in_array($value['_id'],$TopusersOftheDay)){
                             array_push($TopusersOftheDay,$value['_id']);
                        }
                       
                    }
                }
            }
            
            if(count($TopusersOftheDay)>10){
               $finalArray= array_slice($TopusersOftheDay,0,10);   
            }else{
                  $finalArray= $TopusersOftheDay;
            }
            
            return $finalArray;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
  
    public function getGroupTopHashtagsOfDay($groupId,$subgroups,$startDate){
      try {    
          
          $finalArray = array();
            $TopHashtagsOftheDay = array();
            
             $c = UserInteractionCollection::model()->getCollection();
            
             $results = $c->aggregate(
                      array('$match' => array("GroupId" => new MongoID($groupId),"HashTagName" => array('$ne' =>null),"UserId" => array('$ne' => (int)0),"userActivityContext" => array('$in' => array(3, 4, 5, 6, 7, 8, 9, 10, 24, 26, 37, 38, 71)))), array('$group' => array(
                    '_id' => '$HashTagName',
                    "number" => array('$sum' => 1),
                   
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );
            $hashtagArray =$results['result'];

            foreach ($hashtagArray as $key => $value) {
                if(!in_array($value['_id'],$TopHashtagsOftheDay)){
                    $TopHashtagsOftheDay[$key] = $value['_id'];
                }
               
            }
            
            if (count($subgroups) > 0) {
                $c = UserInteractionCollection::model()->getCollection();
                  $Subgroupresults = $c->aggregate(
                           array('$match' => array("SubGroupId" => new MongoID($groupId),"HashTagName" => array('$ne' =>null),"UserId" => array('$ne' => (int)0),"userActivityContext" => array('$in' => array(3, 4, 5, 6, 7, 8, 9, 10, 24, 26, 37, 38, 71)))), array('$group' => array(
                    '_id' => '$HashTagName',
                    "number" => array('$sum' => 1),
                   
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
                );
                
                
                $SubGrouphashTagArray = $Subgroupresults['result'];


                if (count($SubGrouphashTagArray) > 0) {
                    foreach ($SubGrouphashTagArray as $key => $value) {
                        if(!in_array($value['_id'],$TopHashtagsOftheDay)){
                             array_push($TopHashtagsOftheDay,$value['_id']);
                        }
                       
                    }
                }
            }
            
            
            if(count($TopHashtagsOftheDay)>10){
               $finalArray= array_slice($TopHashtagsOftheDay,0,10);   
            }else{
                  $finalArray= $TopHashtagsOftheDay;
            }
           
            return $TopHashtagsOftheDay;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
     public function getGroupTopSearchItemsOfDay($groupId,$subgroups,$startDate){
      try {    
          
          $finalArray = array();
            $TopSearchItemsOftheDay = array();
            $c = UserInteractionCollection::model()->getCollection();
            
             $results = $c->aggregate(
                    array('$match' => array("GroupId" =>new MongoID($groupId),"projectSearchText" => array('$ne' =>null),"UserId" => array('$ne' => (int)0))), array('$group' => array(
                    '_id' => '$projectSearchText',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );
            
            $searchArray =$results['result'];

            foreach ($searchArray as $key => $value) {
                if(!in_array($value['_id'],$TopSearchItemsOftheDay)){
                    $TopSearchItemsOftheDay[$key] = $value['_id'];
                }
               
            }
            
            
             if (count($subgroups) > 0) {
               $c = UserInteractionCollection::model()->getCollection();
               $SubgroupSearchresults = $c->aggregate(
                    array('$match' => array("SubGroupId" =>new MongoID($groupId),"projectSearchText" => array('$ne' =>null),"UserId" => array('$ne' => (int)0))), array('$group' => array(
                    '_id' => '$projectSearchText',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );
               
                $SubGroupsearchArray = $SubgroupSearchresults['result'];
               
               if (count($SubGroupsearchArray) > 0) {

                   foreach ($SubGroupsearchArray as $key => $value) {
                       if(!in_array($value['_id'],$TopSearchItemsOftheDay)){
                             array_push($TopSearchItemsOftheDay,$value['_id']);
                        }
                    }
                }
           }
           
           if(count($TopSearchItemsOftheDay)>10){
               $finalArray= array_slice($TopSearchItemsOftheDay,0,10);   
            }else{
                  $finalArray= $TopSearchItemsOftheDay;
            }
           
            return $finalArray;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
  
  
   public function getTopNewsOfDay($startDate){
      try {    
          
          $finalArray = array();
            $TopHashtagsOftheDay = array();
            $newsArray=array();
            $resultArray=array();

            $c = UserInteractionCollection::model()->getCollection();
//            $keys = array("PostId" => 1);
//            $initial = array("count" => 0);
//            $reduce = "function (obj, prev) { prev.count++; }";
//            $condition = array('condition' => array("CategoryType" => (int)8, "pageIndex"=>(int)14));
//
//            $g = $c->group($keys, $initial, $reduce, $condition);
//
//            $newsArray = $g['retval'];
//            foreach ($newsArray as $key => $value) {
//
//                array_push($finalArray, $value['PostId']);
//            }
//
//           //print_r($finalArray);exit;
//            if(count($finalArray)>10){
//                $resultArray=array_slice($finalArray,0,10);
//            }else{
//                $resultArray=array_slice($finalArray,0,count($finalArray));
//            }
            
            $results = $c->aggregate(
                    array('$match' => array("CategoryType" => (int)8, "pageIndex"=>(int)14, "UserId" => array('$ne' => (int)0),"CreatedDate" => array('$lte' => $startDate))), array('$group' => array(
                    '_id' => '$PostId',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );


            foreach ($results['result'] as $key => $value) {

               if(!in_array($value['_id'], $finalArray)){
                    array_push($finalArray, $value['_id']); 
                }
            }

            return $finalArray;
        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
      
  }
  
   /**
     * @author Swathi
     * This is used to fetch the user interactions by userId
     * @param  $userId,$type(Type refers to action type)
     * @return type
     */
  
   public function getUserActionsByUserId($userId,$type) {
      
        $returnValue = 'failure';
        try {            
            $criteria = new EMongoCriteria;
            $criteria->addCond('UserId', '==', (int)$userId);
             $criteria->addCond('ActionType', '==', $type);
             $criteria->addCond('pageIndex', '==', 6);
            $userActions = UserInteractionCollection::model()->findAll($criteria);
            if (isset($userActions)) {
              $returnValue= $userActions;
            }
        } catch (Exception $exc) {
            error_log("==getUserFollowersAndFollowingsById in UserProfileCollection==".$exc->getMessage());
        }
        return $returnValue;
    }
   
   public function updateUserInteractionForGameDetails($Gameobj){
       $returnValue = 'success'; 
      try {          
         
            $criteria = new EMongoCriteria;
            $modifier = new EMongoModifier();
            $criteria->addCond('PostId', '==', new MongoID($Gameobj->GameId));
            $modifier->addModifier('GameDescription', 'set', $Gameobj->GameDescription);
            $modifier->addModifier('GameName', 'set', $Gameobj->GameName);
            
           
        if(UserInteractionCollection::model()->updateAll($modifier,$criteria)){
           
             $returnValue = 'success'; 
        }else{
            $returnValue = 'failure'; 
        }
       
        return $returnValue;
        
      } catch (Exception $exc) {          
          echo 'Exception'.$exc->getMessage();
          return $returnValue;
      }
    }
   
   public function getUserInteractionsCount($userId){
       $returnValue='failure';
       try {
          $provider = new EMongoDocumentDataProvider('ProfileIntractionDisplayBean',
                   
           array(
               
                'criteria' => array( 
                   'conditions'=>array(
                            'UserId'=>array('==' => (int)$userId),
                            'IsDeleted'=>array('!=' => 1),
                            'IsAbused'=>array('notIn' => array(1,2)),
                            'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                            'IsNotifiable'=>array('==' => 1),
                             'CategoryType'=>array('!=' => 7),
//                            'PostType'=>array('>' => 0),
                            // 'PostType'=>array('!=' => null),
                  
                            'PostType'=>array('notIn' => array(6,7,8,9,10,15,0,null,'null')),
                            
                       ),
                   'sort'=>array('CreatedOn'=>EMongoCriteria::SORT_DESC)
                 )
               ));
          
          return $provider->getTotalItemCount();
       } catch (Exception $exc) {           
         Yii::log($exc->getTraceAsString(),'error','application');
         return $returnvalue;
       }
      } 
      public function getAggregateCommonListByCategoryType($categoryTypeArray) {
        try {
            $finalArray = array();
            $c = UserInteractionCollection::model()->getCollection();
            $conditions = array("CategoryType" => array('$in' => $categoryTypeArray), 'IsDeleted' => (int) 0, 'CreatedOn' => array('$gt' => new MongoDate(strtotime('-1 day'))));
            $c = UserInteractionCollection::model()->getCollection();

            $results = $c->aggregate(
                    array('$match' => $conditions
                    ), array('$group' => array(
                    '_id' => array('PostId' => '$PostId'),
                    "count" => array('$sum' => 1),
                )), array(
                '$sort' => array('count' => -1)
                    )
            );
//        error_log(print_r($results, true));

            $finalArray = isset($results['result']) ? $results['result'] : $finalArray;
            return $finalArray;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
 public function getDistinctUserFollowersListByCategoryType($userId) {
        try {
            $finalArray = array();
            $c = UserInteractionCollection::model()->getCollection();
//error_log($userId."========$####");
           $conditions = array(
               'UserFollowers'=>array('$in'=>array($userId)),"ActionType" => "UserFollow","CategoryType" => 4, 'IsDeleted' => 0, 'CreatedOn' => array('$gt' => new MongoDate(strtotime('-1 day')))
               
            );
            $crr = $c->distinct("UserId", $conditions);
//  error_log(print_r($crr, true));           
            return sizeof($crr)>0?$crr:$finalArray;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
    
     public function getDistinctUserIdListByPostId($postId,$OrginalUserId,$userId) {
        try {
            $finalArray = array();
            $c = UserInteractionCollection::model()->getCollection();
            $conditions = array('PostId'=> new MongoId($postId),'UserId'=>array('$nin'=>array($OrginalUserId,$userId)));
            $crr = $c->distinct("UserId", $conditions);   
            error_log(print_r($crr,true));
            return sizeof($crr)>0?$crr:$finalArray;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
    public function saveUserLoginFailureActivity($userId,$activityIndex,$activityContextIndex){
        try{
         $activityObj = new UserInteractionCollection();
         $activityObj->UserId = (int)$userId;
         $activityObj->userActivityIndex = (int)$activityIndex;
         $activityObj->ActionType='Login Failure';
         $activityObj->userActivityContext = (int)$activityContextIndex;
         $activityObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
         $activityObj->CreatedDate =date("Y-m-d");
         if($activityObj->save()){
            return "success"; 
         }else{
            return "failure";  
         }  
        } catch (Exception $ex) {
         return "failure"; 
        }
        
    }
}

?>