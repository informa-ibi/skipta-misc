<?php
/**
 * @author sureshreddy
 * @copyright 2013 techo2.com
 * @version 3.0
 * @category Stream
 * @package Stream
 */

/**
 * UserStreamCollection
 *
 * Activity object of followers of user, that behaves user activity of system,
 * 
 */
class UserStreamCollection extends EMongoDocument {
  
    public $UserId;
    public $CreatedOn;
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
    public $PostTextLength;
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
    public $InviteMessage=array();
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
    public $DisableComments=0;
    public $Priority;
    public $IsAbused=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
    public $AbusedUserId;
    public $IsDeleted=0;
    public $IsPromoted=0;
    public $PromotedUserId;
    public $AbusedOn;
    public $GroupId='';
    public $CurbsideCategoryId;
    public $HashTags = array();
    public $IsBlockedWordExist=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
    // public $priority;
    //  public $ppt;
    //  public $docs;
    // public $audio;
    // public $video;
    public $IsFeatured=0;
    public $FeaturedUserId=0;
    public $FeaturedOn;
    public $IsBlockedWordExistInComment=0;
     public $IsWebSnippetExist = 0;
     public $WebUrls;
    public $Division=0;
    public $District=0;
    public $Region=0;
    public $Store=0;
    public $Title;
    public $FbShare=array();
    public $TwitterShare=array();
    public $SubGroupId=0;
    public $ShowPostInMainStream=1;
    
    /**
     *
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

   public $PlayersCount=array();

   public $GameName;
   public $GameDescription;
   public $GameFollowers=array();
   public $GameBannerImage;
   public $QuestionsCount=0;
   public $CurrentGameScheduleId=0;
   public $PreviousGameScheduleId=0;
   public $CurrentScheduledPlayers=array();
   public $CurrentScheduleResumePlayers=array();
   public $PreviousSchedulePlayers=array();
   public $PreviousScheduleResumePlayers=array();
   
    
    // public $BadgeHoverText;
   //  public $BadgeDescription;
     public $BadgeName;
     public $BadgeLevelValue;
     public $BadgeHasLevel;
     
     public $NetworkInviteId;
     public $NetworkLogo;
     
     public $NetworkRedirectUrl;
     
     //For Advertisement
     public $RedirectUrl;
     public $DisplayPage;
     public $Groups;
     public $RequestedFields;
     public $AdType;
     public $AdvertisementId;
     public $RequestedParams;
     public $BannerTemplate;
     public $BannerContent;
     public $BannerTitle;
     public $ImpressionTag;
     public $ClickTag;
     public $BannerOptions;
  

   
    public function getCollectionName() {

        return 'UserStreamCollection';
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
            )
        );
    }

    public function attributeNames() {
        return array(
            '_id'=>'_id',
            'UserId' => 'UserId',
            'StreamNote' => 'StreamNote',
            'CreatedOn' => 'CreatedOn',
            'PostType' => 'PostType',
            'CategoryType' => 'CategoryType',
            'ActionType' => 'ActionType',
            'RecentActivity'=>'RecentActivity',
            
            'CommentUserId' => 'CommentUserId',
            'Comments' => 'Comments',
             'FollowUserId' => 'FollowUserId',
              'MentionUserId' => 'MentionUserId',
            'LoveUserId'=>'LoveUserId',
            
              'PostText' => 'PostText',
              'Resource' => 'Resource',
              'IsMultiPleResources' => 'IsMultiPleResources',
              'OriginalUserId' => 'OriginalUserId',
            'OriginalPostTime'=>'OriginalPostTime',
            
              'LoveCount' => 'LoveCount',
              'FollowUserId' => 'FollowUserId',
            'PostId'=>'PostId',
            'NetworkId'=>'NetworkId',
            'CreatedOn'=>'CreatedOn',
           
            'UserFollowers'=>'UserFollowers',
           
            
            'StartDate' => 'StartDate',
            'EndDate' => 'EndDate',
            'EventAttendes' => 'EventAttendes',
            'Location'=>'Location',

            'StreamNote1'=>'StreamNote1',
            'HashTagPostUserId'=>'HashTagPostUserId',
            'PostFollowers'=>'PostFollowers',         

            'CommentCount'=>'CommentCount',
            'InviteUsers'=>'InviteUsers',
            'InviteMessage'=>'InviteMessage',
            
            'OptionOneCount'=>'OptionOneCount',
            'OptionTwoCount'=>'OptionTwoCount',
              'OptionThreeCount'=>'OptionThreeCount',
             'OptionFourCount'=>'OptionFourCount',
            'OptionOne'=>'OptionOne',            
            'OptionTwo'=>'OptionTwo',            
            'OptionThree'=>'OptionThree',            
            'OptionFour'=>'OptionFour',            
            'ExpiryDate' => 'ExpiryDate', 
            'SurveyTaken'=>'SurveyTaken',
            'StartTime'=>'StartTime',
            'EndTime'=>'EndTime',
            'CurbsideConsultTitle'=>'CurbsideConsultTitle',
            'CurbsideConsultCategory'=>'CurbsideConsultCategory',         
            'DisableComments'=>'DisableComments',
            'Priority'=>'Priority',
            'IsAbused'=>'IsAbused',
            'AbusedUserId'=>'AbusedUserId',
            'IsDeleted'=>'IsDeleted',
            'IsPromoted'=>'IsPromoted',
            'PromotedUserId'=>'PromotedUserId',
            'PostTextLength'=>'PostTextLength',
            'AbusedOn'=>'AbusedOn',
            'GroupId'=>'GroupId',
            'CurbsideCategoryId'=>'CurbsideCategoryId',
            'HashTags'=>'HashTags',
            'IsBlockedWordExist'=>'IsBlockedWordExist',
            'IsFeatured'=>'IsFeatured',
            'FeaturedUserId'=>'FeaturedUserId',
            'FeaturedOn'=>'FeaturedOn',
            'IsBlockedWordExistInComment'=>'IsBlockedWordExistInComment',
            'IsWebSnippetExist'=>'IsWebSnippetExist',
            'WebUrls'=>'WebUrls',
            'FollowCount'=>'FollowCount',
             'Division'=>'Division',
            'District'=>'District',
            'Region'=>'Region',
            'Store'=>'Store',
            'Title'=>'Title',
            'ShareCount'=>'ShareCount',
            'FbShare'=>'FbShare',
            'TwitterShare'=>'TwitterShare'  ,
             'SubGroupId'=>'SubGroupId'  ,
            'ShowPostInMainStream'=>'ShowPostInMainStream',
            
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
            'TopicImage'=>'TopicImage',
          
       

            'PlayersCount'=>'PlayersCount',
             'GameDescription'=>'GameDescription',
            'GameName'=>'GameName',
            'GameFollowers'=>'GameFollowers',
            'GameBannerImage'=>'GameBannerImage',
            'QuestionsCount'=>'QuestionsCount',
            
             'CurrentGameScheduleId'=>'CurrentGameScheduleId',
    'PreviousGameScheduleId'=>'PreviousGameScheduleId',
   'CurrentScheduledPlayers'=>'CurrentScheduledPlayers',
   'CurrentScheduleResumePlayers'=>'CurrentScheduleResumePlayers',            
   'PreviousSchedulePlayers'=>'PreviousSchedulePlayers',
   'PreviousScheduleResumePlayers'=>'PreviousScheduleResumePlayers',
           
            'BadgeName'=>'BadgeName',
            'BadgeLevelValue'=>'BadgeLevelValue',
            'BadgeHasLevel'=>'BadgeHasLevel',
            
            'NetworkInviteId' => 'NetworkInviteId',
          
            'NetworkClientId' => 'NetworkClientId',
            'NetworkLogo'=>'NetworkLogo',
            'NetworkRedirectUrl' => 'NetworkRedirectUrl',
            'RedirectUrl' => 'RedirectUrl',
            'DisplayPage' => 'DisplayPage',
            'Groups' => 'Groups',
            'RequestedFields' => 'RequestedFields',
            'AdType' => 'AdType',
            'AdvertisementId' => 'AdvertisementId',
            'RequestedParams' => 'RequestedParams',
            'BannerTemplate' =>'BannerTemplate',
            'BannerContent' =>'BannerContent',
            'BannerTitle' =>'BannerTitle',
            'ImpressionTag' =>'ImpressionTag',
            'ClickTag' =>'ClickTag',
            'BannerOptions' =>'BannerOptions'
            
           
                 
          //  'priority'=>'priority'

            
        );
    }
    /**
     * 
     * @param type $obj
     */
    public function saveUserStream($obj) {
        try {
            echo '__________notifiable_in tsream____________'.$obj->IsNotifiable;
            error_log( '__________notifiable_in tsream____________'.$obj->IsNotifiable);
            $cradddsus = $obj->CreatedOn;
            $streamObj = new UserStreamCollection();
            $streamObj->UserId = $obj->StreamUserId;
            $streamObj->StreamNote = $obj->StreamNote;
            $streamObj->StreamNote1 = $obj->StreamNote1;
            $streamObj->CreatedOn = $obj->CreatedOn;
            $streamObj->ActionType = $obj->ActionType;
            $streamObj->NetworkId = (int)$obj->NetworkId;

            $streamObj->PostType = $obj->PostType;
            $streamObj->CategoryType = $obj->CategoryType;
            $streamObj->FollowEntity = $obj->FollowEntity;
            $streamObj->WebUrls = $obj->WebUrls;

            $streamObj->RecentActivity = $obj->RecentActivity;
            if($obj->CategoryType==3){
                $streamObj->GroupId =  new MongoId($obj->GroupId);
                $streamObj->ShowPostInMainStream=$obj->ShowPostInMainStream;
            }
            if($obj->CategoryType==7){
                $streamObj->GroupId =  new MongoId($obj->GroupId);
                $streamObj->SubGroupId =  new MongoId($obj->SubGroupId);
                $streamObj->ShowPostInMainStream=(int)$obj->ShowPostInMainStream;
            }
             if($obj->CategoryType==9){
                $streamObj->GameName =  $obj->GameName;
                $streamObj->GameDescription =  $obj->GameDescription;
                $streamObj->PostFollowers =  $obj->PostFollowers;
                $streamObj->QuestionsCount =  $obj->QuestionsCount;
                $streamObj->PlayersCount =  $obj->PlayersCount;
                $streamObj->IsNotifiable=$obj->IsNotifiable;

                //$streamObj->CurrentGameScheduleId=new MongoId($obj->CurrentGameScheduleId);
                $streamObj->GameBannerImage=$obj->GameBannerImage;

                $streamObj->StartDate=$obj->StartDate;
                $streamObj->EndDate=$obj->EndDate;
                

                if($obj->ActionType == "Play"){
                    $streamObj->CurrentScheduledPlayers=array($obj->CurrentScheduledPlayers);
                    $streamObj->CurrentGameScheduleId=new MongoId($obj->CurrentGameScheduleId);
                }
                 if($obj->ActionType == "Comment"){
                    $streamObj->CurrentGameScheduleId=new MongoId($obj->CurrentGameScheduleId);
                }

                
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
                $streamObj->MentionUserId = (int) $obj->MentionUserId;
            }
            
            if ($obj->PostFollowers != "" && $obj->PostFollowers != null) {
                $streamObj->PostFollowers = array((int) $obj->PostFollowers);
            } else {

                $streamObj->PostFollowers = array();
            }
      if ($obj->LoveUserId != "" && $obj->LoveUserId != null) {
                $streamObj->LoveUserId = array((int) $obj->LoveUserId);
            } else {

                $streamObj->LoveUserId = array();
            }

            $streamObj->FollowUserId = array();
         



            $streamObj->PostId = new MongoId($obj->PostId);
            $streamObj->PostText = $obj->PostText;
            $streamObj->PostTextLength = $obj->PostTextLength;
            $streamObj->Resource = $obj->Resource;
            $streamObj->IsMultiPleResources = $obj->IsMultiPleResources;
            $streamObj->OriginalUserId = $obj->OriginalUserId;
            $streamObj->OriginalPostTime = new MongoDate($obj->OriginalPostTime);


            // print_r($streamObj->UserFollowers);

            if ($obj->UserFollowers != "" && $obj->UserFollowers != null) {
                $streamObj->UserFollowers = array($obj->UserFollowers);
            } else {
                $streamObj->UserFollowers = array();
            }
            if ($obj->InviteUsers != "" && $obj->InviteUsers != null) {
                $streamObj->InviteUsers = array($obj->InviteUsers);
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
            $streamObj->IsWebSnippetExist=(int)$obj->IsWebSnippetExist;
            if ($streamObj->PostType == 2) {
                
                $streamObj->StartDate = new MongoDate($obj->StartDate);
                $streamObj->EndDate = new MongoDate($obj->EndDate);
                $streamObj->EventAttendes = array($obj->EventAttendes);
                $streamObj->Location = $obj->Location;
                $streamObj->StartTime = $obj->StartTime;
                $streamObj->EndTime = $obj->EndTime;
            }

            if ($streamObj->PostType == 3) {
                $streamObj->ExpiryDate = new MongoDate($obj->ExpiryDate);  

                if ($obj->SurveyTaken != "" && $obj->SurveyTaken != null) {
                    $streamObj->SurveyTaken = array($obj->SurveyTaken);
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
                $streamObj->CurbsideCategoryId = $obj->CurbsideCategoryId;
            }
            $streamObj->Priority = $obj->Priority;
            
             $hashtagArray=array();
            
          
            for($i=0;$i<sizeof($obj->HashTags);$i++){
               $hashtagArray[$i]=new MongoId($obj->HashTags[$i]['$id']);
                             
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
                $streamObj->IsNotifiable= $obj->IsNotifiable;
            }

            $streamObj->HashTags =$hashtagArray;
            $streamObj->DisableComments = $obj->DisableComments;
            $streamObj->IsBlockedWordExist = (int) $obj->IsBlockedWordExist;
            $streamObj->IsFeatured = (int)$obj->IsFeatured;            
            $streamObj->FeaturedUserId = $obj->FeaturedUserId;
            $streamObj->Division= (int)$obj->Division;
            $streamObj->District= (int)$obj->District;
            $streamObj->Region= (int)$obj->Region;
            $streamObj->Store= (int)$obj->Store;            
            $streamObj->Title= $obj->Title;     
            $cradddsus1 = $streamObj->CreatedOn;
          
             if ($obj->CategoryType == 10) {
                if($obj->CustomBadgeProcessType=='Console'){
                     $streamObj->UserId =(int)0;
                }
                $streamObj->PostText = $obj->PostText;
                $streamObj->BadgeName = $obj->BadgeName;
                $streamObj->Title = $obj->Title;
                $streamObj->BadgeLevelValue = $obj->BadgeLevelValue;
                $streamObj->BadgeHasLevel = $obj->BadgeHasLevel;
            }
             if ($obj->CategoryType == 11) {
             
                 $streamObj->NetworkInviteId = $obj->NetworkInviteId;
                 $streamObj->PostText = $obj->PostText;
                 $streamObj->NetworkLogo = $obj->NetworkLogo;
                   $streamObj->BadgeName = $obj->BadgeName;//here this refers to the consumer network name. ex:DSN
                $streamObj->NetworkRedirectUrl=$obj->NetworkRedirectUrl;
             
            }
            if ($obj->CategoryType == 13) {
                 $streamObj->RedirectUrl = $obj->RedirectUrl;
                 $streamObj->StartDate = $obj->StartDate;
                 $streamObj->ExpiryDate = $obj->ExpiryDate;
                 $streamObj->DisplayPage = $obj->DisplayPage;
                 $streamObj->RequestedFields = $obj->RequestedFields;
                 $streamObj->AdType = $obj->AdType;
                 $streamObj->Groups = $obj->Groups; 
                 $streamObj->AdvertisementId = $obj->AdvertisementId;
                 $streamObj->RequestedParams = $obj->RequestedParams;
                 $streamObj->BannerTemplate=(int)$obj->BannerTemplate;
                 $streamObj->BannerTitle= $obj->BannerTitle;
                 $streamObj->BannerContent= $obj->BannerContent;
                 $streamObj->ImpressionTag= $obj->ImpressionTag;
                 $streamObj->ClickTag= $obj->ClickTag;
                 $streamObj->BannerOptions= $obj->BannerOptions;
                 $streamObj->NetworkLogo = $obj->NetworkLogo;

            }
            if ($streamObj->save()) {
                
            }
        } catch (Exception $exc) {
            echo '_________ffffff_____in saveExceptionuser stream collection  __________' . $exc->getLine();
            echo '+++++++++++++++++++++++++++++++++++++++++'.$exc->getMessage();
            //  error::log("In save stream document" . $exc->getTraceAsString());
        }
    }

    /**
     * author: Suresh Reddy
     * @param type $postId
     * @param type $userId
     * @return type stream object
     */

    public function getStreamObjbyPostId($postId,$userId) {

        try {
            $criteria = new EMongoCriteria;
            $criteria->UserId = (int)$userId;
             $criteria->PostId = new MongoID($postId);
            $streamObj = UserStreamCollection::model()->find($criteria);
            return $streamObj;
        } catch (Exception $ex) {
            
        }
    }

     /**
     * author: Suresh Reddy
     * @param type $postId
     * @param type $userId
     * @return type stream object
     */

    public function updateStreamObject($obj, $streamObjectId, $userId,$actionType='Post') {

        try {
            
            echo 'UPDATE STREAM OBJECT ----------'.$obj->CategoryType."=====Title===".$obj->Title;
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
             if($obj->IsPromoted==0){              
                $mongoModifier->addModifier('CreatedOn', 'set', $obj->CreatedOn); 
            }
            if($obj->CategoryType == 12){
                $mongoModifier->addModifier('Title', 'set', $obj->Title);
                $mongoModifier->addModifier('PostText', 'set', $obj->PostText);
            }
            if($actionType=="UserFollow"){
              $mongoModifier->addModifier('UserFollowers', 'push', $obj->UserFollowers);    
            }
            
             if($actionType=="PostFollow"){
                 
              $mongoModifier->addModifier('PostFollowers', 'push', $obj->PostFollowers);    
            }
             
            if($actionType=="UserMention"){
              $mongoModifier->addModifier('MentionUserId', 'set',  (int)$obj->MentionUserId);    
            }
            
             if($actionType=="HashTagFollow"){
              $mongoModifier->addModifier('HashTagPostUserId', 'set', (int) $obj->HashTagPostUserId);    
                
            }
            
          if($actionType=="EventAttend"){
              $mongoModifier->addModifier('EventAttendes', 'push', (int) $obj->EventAttendes);    
                
            }
              if($actionType=="Invite"){
                  if($obj->InviteUsers!=0){
               $mongoModifier->addModifier('InviteUsers', 'push', (int) $obj->InviteUsers);    
               $mongoModifier->addModifier('InviteMessage', 'set',  $obj->InviteMessage);      
                  }
      
                
            }
            if($actionType=="FbShare"){
              $mongoModifier->addModifier('FbShare', 'push', $obj->FbShare);    
                
            }
            if($actionType=="TwitterShare"){
              $mongoModifier->addModifier('TwitterShare', 'push', $obj->TwitterShare);    
                
            }
                 if ($actionType == "Survey") {
                $mongoModifier->addModifier('SurveyTaken', 'push', (int) $obj->SurveyTaken);
                $mongoModifier->addModifier('OptionOneCount', 'set', (int) $obj->OptionOneCount);
                $mongoModifier->addModifier('OptionTwoCount', 'set', (int) $obj->OptionTwoCount);
                $mongoModifier->addModifier('OptionThreeCount', 'set', (int) $obj->OptionThreeCount);
                $mongoModifier->addModifier('OptionFourCount', 'set', (int) $obj->OptionFourCount);
            }
            
            if($actionType=="Comment"){
                echo '================Comment=============';
              //$mongoModifier->addModifier('CommentUserId', 'push',  $obj->CommentUserId); 
               $mongoModifier->addModifier('Comments', 'push',  $obj->Comments); 
                if(isset($obj->IsBlockedWordExistInComment) && !empty($obj->IsBlockedWordExistInComment)){
                    $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', (int) $obj->IsBlockedWordExistInComment);
                }
             }

              
            $mongoModifier->addModifier('ActionType', 'set', $obj->ActionType);
            $mongoModifier->addModifier('StreamNote', 'set', $obj->StreamNote);
            $mongoModifier->addModifier('RecentActivity', 'set', $obj->RecentActivity);
            
            
             $mongoModifier->addModifier('LoveCount', 'set',  $obj->LoveCount); 
             $mongoModifier->addModifier('InviteCount', 'set',  $obj->InviteCount); 
             $mongoModifier->addModifier('ShareCount', 'set',  $obj->ShareCount); 
             $mongoModifier->addModifier('FollowCount', 'set',  $obj->FollowCount); 
             $mongoModifier->addModifier('CommentCount', 'set',  $obj->CommentCount);
             $mongoModifier->addModifier('Priority', 'inc',  (int)$obj->Priority);
             
            
            $mongoCriteria->addCond('_id', '==', new MongoId($streamObjectId));
            $mongoCriteria->addCond('UserId', '==', (int) $userId);
            $res = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);


            return $res;
        } catch (Exception $ex) {
         echo $ex->getMessage();   
        }
    }

   /**
     * author: Suresh Reddy
     * @param type $postId
     * @param type $userId
     * @return type stream object
     */

    public function updateStreamObjectForFollow($obj, $streamObjectId, $userId,$actionType='Post') {

        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            
            if($actionType=="UserFollow"){
              $mongoModifier->addModifier('FollowUserId', 'push', $obj->UserFollowers);   
             
            }
        
            
             $mongoModifier->addModifier('LoveCount', 'set',  $obj->LoveCount); 
             $mongoModifier->addModifier('InviteCount', 'set',  $obj->InviteCount); 
             $mongoModifier->addModifier('ShareCount', 'set',  $obj->ShareCount); 
             $mongoModifier->addModifier('FollowCount', 'set',  $obj->FollowCount); 
             $mongoModifier->addModifier('CommentCount', 'set',  $obj->CommentCount);
             $mongoModifier->addModifier('CreatedOn', 'set', $obj->CreatedOn); 
             $mongoModifier->addModifier('StreamNote', 'set', $obj->StreamNote);
             $mongoModifier->addModifier('RecentActivity', 'set', $obj->RecentActivity);
          
            
            $mongoCriteria->addCond('_id', '==', new MongoId($streamObjectId));
            $mongoCriteria->addCond('UserId', '==', (int) $userId);
            $res = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);

            return $res;
        } catch (Exception $ex) {
           echo $ex->getMessage(); 
        }
    }
    /**
     * author Vamsi Krishna
     * @param type $obj
     * @param type $streamObjectId
     * @param type $userId
     * @param type $actionType
     * @return type
     */
     public function updateStreamObjectForComment($obj, $streamObjectId, $userId,$actionType='Post') {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            
            if($actionType=="UserFollow"){
              $mongoModifier->addModifier('UserFollowers', 'push', $obj->UserFollowers);   
             
            }
             
            if($actionType=="UserMention"){                
              $mongoModifier->addModifier('MentionUserId', 'push',  (int)$obj->MentionUserId);
             
            }
            
             if($actionType=="HashTagFollow"){
              $mongoModifier->addModifier('HashTagsFollowers', 'push',  (int)$obj->HashTagsFollowers);    
               $mongoModifier->addModifier('HashTags', 'push',  $obj->HashTags);
              
            }
              $mongoModifier->addModifier('CommentUserId', 'push',  $obj->CommentUserId); 
             
             $mongoModifier->addModifier('Comments', 'push',  $obj->Comments); 
            
            
             $mongoModifier->addModifier('LoveCount', 'set',  $obj->LoveCount); 
             $mongoModifier->addModifier('InviteCount', 'set',  $obj->InviteCount); 
             $mongoModifier->addModifier('ShareCount', 'set',  $obj->ShareCount); 
             $mongoModifier->addModifier('FollowCount', 'set',  $obj->FollowCount); 
             $mongoModifier->addModifier('CommentCount', 'set',  $obj->CommentCount);
             $mongoModifier->addModifier('CreatedOn', 'set', $obj->CreatedOn); 
             $mongoModifier->addModifier('StreamNote', 'set', $obj->StreamNote);
             $mongoModifier->addModifier('RecentActivity', 'set', $obj->RecentActivity);
          
            
            $mongoCriteria->addCond('_id', '==', new MongoId($streamObjectId));
            //$mongoCriteria->addCond('UserId', '==', (int)$userId);
            
            
            $res = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);


            return $res;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            
        }
    }
    
    public function updateStreamSocialActions($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
         
            if (isset($obj->LoveUserId) && $obj->LoveUserId != "" && $obj->LoveUserId != 0) {
             
                $mongoModifier->addModifier('LoveUserId', 'push', $obj->LoveUserId);
            }
            if ($obj->ActionType == "FbShare") {
                if (isset($obj->FbShare) && $obj->FbShare != "" && $obj->FbShare != 0) {
                    $mongoModifier->addModifier('FbShare', 'push', $obj->FbShare);
                }
            }
            if ($obj->ActionType == "TwitterShare") {
                if (isset($obj->TwitterShare) && $obj->TwitterShare != "" && $obj->TwitterShare != 0) {
                    $mongoModifier->addModifier('TwitterShare', 'push', $obj->TwitterShare);
                }
            }
            if ($obj->ActionType == "Comment") {              
                if (isset($obj->UserId) && $obj->UserId != 0) {                    
                    $mongoModifier->addModifier('CommentUserId', 'push', $obj->UserId);
                }
            }
            
               if ($obj->ActionType == "Play") {              
                                   
                    $mongoModifier->addModifier('CurrentScheduledPlayers', 'push', $obj->CurrentScheduledPlayers);
              
            }
              if ($obj->ActionType == "Playing") {              
                                   
                    $mongoModifier->addModifier('PlayersCount', 'set', $obj->PlayersCount);
                      $mongoModifier->addModifier('CurrentScheduleResumePlayers', 'push',(int)$obj->UserId);
              
            }
          
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoCriteria->addCond('CategoryType', '==', (int) $obj->CategoryType);
            $mongoModifier->addModifier('LoveCount', 'set', $obj->LoveCount);
            $mongoModifier->addModifier('InviteCount', 'set', $obj->InviteCount);
            $mongoModifier->addModifier('ShareCount', 'set', $obj->ShareCount);
            $mongoModifier->addModifier('FollowCount', 'set', $obj->FollowCount);            

            $mongoModifier->addModifier('CommentCount', 'set', $obj->CommentCount);
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions User Stream" . $exc->getMessage();
        }

    }
    /**
     * @author suresh reddy
     * @param type $obj
     */
     public function followObject($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoModifier->addModifier('PostFollowers', 'push', (int)$obj->UserId);
            
            $mongoModifier->addModifier('LoveCount', 'set', $obj->LoveCount);
            $mongoModifier->addModifier('InviteCount', 'set', $obj->InviteCount);
            $mongoModifier->addModifier('ShareCount', 'set', $obj->ShareCount);
            $mongoModifier->addModifier('FollowCount', 'set', $obj->FollowCount);
            $mongoModifier->addModifier('CommentCount', 'set', $obj->CommentCount);
            
            
          //  $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions User Stream" . $exc->getMessage();
        }

    }
    
    
        /**
     * @author suresh reddy
     * @param type $obj
     */
     public function unFollowObject($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoModifier->addModifier('PostFollowers', 'pull', (int)$obj->UserId);
            
            $mongoModifier->addModifier('LoveCount', 'set', $obj->LoveCount);
            $mongoModifier->addModifier('InviteCount', 'set', $obj->InviteCount);
            $mongoModifier->addModifier('ShareCount', 'set', $obj->ShareCount);
            $mongoModifier->addModifier('FollowCount', 'set', $obj->FollowCount);
            $mongoModifier->addModifier('CommentCount', 'set', $obj->CommentCount);
            
            
          //  $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions User Stream" . $exc->getMessage();
        }

    }
    
    
     /**
     * @author suresh reddy
     * @param type $obj
     */
     public function attendEvent($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
         
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoModifier->addModifier('EventAttendes', 'push', $obj->UserId);
          //  $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            $mongoModifier->addModifier('LoveCount', 'set', $obj->LoveCount);
            $mongoModifier->addModifier('InviteCount', 'set', $obj->InviteCount);
            $mongoModifier->addModifier('ShareCount', 'set', $obj->ShareCount);
            $mongoModifier->addModifier('FollowCount', 'set', $obj->FollowCount);
            $mongoModifier->addModifier('CommentCount', 'set', $obj->CommentCount);
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions User Stream" . $exc->getMessage();
        }

    }
    
    
     /**
     * @author suresh reddy
     * @param type $obj
     */
     public function saveSurvey($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoModifier->addModifier('SurveyTaken', 'push', $obj->UserId);
           // $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            $mongoModifier->addModifier('LoveCount', 'set', $obj->LoveCount);
            $mongoModifier->addModifier('InviteCount', 'set', $obj->InviteCount);
            $mongoModifier->addModifier('ShareCount', 'set', $obj->ShareCount);
            $mongoModifier->addModifier('FollowCount', 'set', $obj->FollowCount);
            $mongoModifier->addModifier('CommentCount', 'set', $obj->CommentCount);
            
                $mongoModifier->addModifier('OptionOneCount', 'set', (int) $obj->OptionOneCount);
                $mongoModifier->addModifier('OptionTwoCount', 'set', (int) $obj->OptionTwoCount);
                $mongoModifier->addModifier('OptionThreeCount', 'set', (int) $obj->OptionThreeCount);
                $mongoModifier->addModifier('OptionFourCount', 'set', (int) $obj->OptionFourCount);
            
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions User Stream" . $exc->getMessage();
        }

    }
    

    /**
     * @author Karteek.V
     * @param type $obj
     * this method is used to check whether the object is there or not
     * @return type Boolean
     */
     public function isThereByUserId($obj) {
        try {     
            $return = FALSE;
            $streamObj = UserStreamCollection::model()->findByAttributes(array("PostId"=>new MongoID($obj->PostId),"LoveUserId"=>$obj->LoveUserId));
            if(isset($streamObj)){
                $return = TRUE;
            }
            return $return;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
    public function updatePostManagementActions($obj) {
        try {
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
              
                
                $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime($obj->PromotedDate)));
                if((int)$obj->CatagoryId!=9){
                 $mongoCriteria->addCond('UserId', '==', 0);    
                }
                
            } elseif ($obj->ActionType == "Delete") {                
                $mongoModifier->addModifier('IsDeleted', 'set', 1);
            }
             elseif ($obj->ActionType=="Featured") {
                $mongoModifier->addModifier('FeaturedUserId', 'set', (int)$obj->UserId);
                $mongoModifier->addModifier('IsFeatured', 'set', (int)1);
            }
            elseif ($obj->ActionType=="NewsNotify") {
                $mongoModifier->addModifier('IsNotifiable', 'set',(int)$obj->IsNotifiable);
                $mongoModifier->addModifier('CreatedOn', 'set', $obj->CreatedOn);
            }
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of post management actions" . $exc->getMessage();
        }
    }
    
   public function updateStreamForUnFeatured($postId,$categoryId){
       try {           
           $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;            
            $mongoModifier->addModifier('IsFeatured', 'set', (int)0);                 
            $mongoCriteria->addCond('PostId', '==', new MongoID($postId));             
            $mongoCriteria->addCond('CategoryType', '==', (int)$categoryId);
            
            UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            
       } catch (Exception $exc) {           
          Yii::log("________",'error','application');
       }
      }
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
            $returnValue = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            if($returnValue){
                $criteria = new EMongoCriteria;
                $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
                $criteria->Comments->IsBlockedWordExist("==" ,1); 
                $resobj = UserStreamCollection::model()->findAll($criteria);
                if (!(is_array($resobj) && sizeof($resobj)>0)) {
                    $criteria = new EMongoCriteria;
                    $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
                    $mongoModifier = new EMongoModifier;  
                    $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', 0);
                    if ($obj->ActionType == "CommentRelease") {
                        $mongoModifier->addModifier('CommentCount', 'inc',  1);
                    }
                    $returnValue=UserStreamCollection::model()->updateAll($mongoModifier,$criteria);
                    if($returnValue){
                        $returnValue = 'PostReleased';
                    }
                }else{
                    if ($obj->ActionType == "CommentRelease") {
                        $criteria = new EMongoCriteria;
                        $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
                        $mongoModifier = new EMongoModifier;
                        $mongoModifier->addModifier('CommentCount', 'inc',  1);
                        UserStreamCollection::model()->updateAll($mongoModifier,$criteria);
                    }
                    $returnValue = 'CommentReleased';
                }
             }
        } catch (Exception $exc) {
            echo "exception occur while user activity collection comment management actions" . $exc->getMessage();
        }
    }
    public function getAllBlockedPosts() {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('IsBlockedWordExist', '==', 1);
            $criteria->addCond('UserId', '==', 0);
            $postObj = UserStreamCollection::model()->findAll($criteria);
            $returnValue = $postObj;
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    public function getCommentedUsersForPost($postId, $userId) {
        try {
            $returnValue = array();
            $criteria = new EMongoCriteria;
            //$criteria->setSelect(array('CommentUserId'=>true));
            $criteria->addCond('UserId', '==', (int)$userId);
            $criteria->addCond('PostId', '==', new MongoId($postId))->limit(1);
            $commentedUsers = UserStreamCollection::model()->find($criteria);
            if(is_object($commentedUsers) && count($commentedUsers)>0){
                if (isset($commentedUsers->CommentUserId)) {
                    $returnValue =$commentedUsers->CommentUserId;
                }
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getMessage(), 'error', 'application');
        }
    }
    
  public function updateStreamForGameSchedule($obj){
       $returnValue = 'success'; 
      try {          
            $criteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('CurrentGameScheduleId', 'set', new MongoId($obj->CurrentGameScheduleId));
            $mongoModifier->addModifier('PreviousGameScheduleId', 'set', new MongoId($obj->PreviousGameScheduleId));
            $mongoModifier->addModifier('CurrentScheduledPlayers', 'set', $obj->CurrentScheduledPlayers);
            $mongoModifier->addModifier('CurrentScheduleResumePlayers', 'set', $obj->CurrentScheduleResumePlayers);
            $mongoModifier->addModifier('PreviousSchedulePlayers', 'set', $obj->PreviousSchedulePlayers);
            $mongoModifier->addModifier('PreviousScheduleResumePlayers', 'set', $obj->PreviousScheduleResumePlayers);
            $mongoModifier->addModifier('IsNotifiable', 'set', $obj->IsNotifiable);
            $mongoModifier->addModifier('CreatedOn', 'set', $obj->CreatedOn);
            $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
            
        UserStreamCollection::model()->updateAll($mongoModifier,$criteria);
        return $returnValue;
        
      } catch (Exception $exc) {          
          echo 'Exception'.$exc->getMessage();
          return $returnValue;
      }
    }
    
 public function updatePartialUserStreamForGame($obj){
        $result='failure';
       try {     
         
         $criteria = new EMongoCriteria;
         $mongoModifier = new EMongoModifier;
        // $startDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $obj->StartDate)->format("Y-m-d");
        // $endDate = DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $obj->EndDate)->format("Y-m-d");
         
         $mongoModifier->addModifier('StartDate','set',new MongoDate(strtotime($obj->StartDate)));
         $mongoModifier->addModifier('EndDate','set',new MongoDate(strtotime($obj->EndDate)));                
         $mongoModifier->addModifier('CurrentGameScheduleId', 'set', new MongoId($obj->CurrentGameScheduleId));
       
       
         $mongoModifier->addModifier('CreatedOn','set',$obj->CreatedOn);            
         $mongoModifier->addModifier('IsNotifiable', 'set', $obj->IsNotifiable);               
         $criteria->addCond('PostId', '==', new MongoId($obj->PostId));  
         $result=UserStreamCollection::model()->updateAll($mongoModifier,$criteria);
        //echo $result."************************".$obj->CurrentGameScheduleId;
         $result='success';
         return $result;
     } catch (Exception $exc) {    
        Yii::log("-----".$exc->getMessage(),'error','application');
        return $result;
     }
  }
   public function updateGamedetails($Gameobj){
     try {
         
         $returnValue = 'failure';

          $modifier = new EMongoModifier();
          $criteria = new EMongoCriteria();
          $criteria->addCond('PostId', '==', new MongoID($Gameobj->GameId));
          $modifier->addModifier('GameDescription', 'set', $Gameobj->GameDescription);
          $modifier->addModifier('GameName', 'set', $Gameobj->GameName);
          $modifier->addModifier('GameBannerImage', 'set', $Gameobj->GameBannerImage);
          $tagsFreeDescription= strip_tags(($Gameobj->GameDescription));
          $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
            $descriptionLength =  strlen($tagsFreeDescription);
          if ($descriptionLength >= '500') {
                $length = '500';
            } else {

                $length = '240';
            }
            $description = CommonUtility::truncateHtml($Gameobj->GameDescription, $length);    
          $modifier->addModifier('PostText', 'set', $description);
          $modifier->addModifier('PostTextLength', 'set', $descriptionLength);
         
          
            if(UserStreamCollection::model()->updateAll($modifier, $criteria)){
                
                $returnValue="success";
            }
            return $returnvalue;
   
     } catch (Exception $exc) {
        Yii::log("-----".$exc->getMessage(),'error','application');
     }
  }
    
  
  
  public function suspendorReleaseGame($obj) {
        try {
            $returnValue = array();
            $criteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($obj->ActionType == "SuspendGame") {
                
                echo $obj->RecentActivity."$$$$$$$$$$$$$$$$$$$$$$";
                
                if ($obj->RecentActivity == "PartialUpdate") {
                    if ($obj->CurrentGameScheduleId == "") {
                        $mongoModifier->addModifier('CurrentGameScheduleId', 'set', "");
                    } else {
                        $mongoModifier->addModifier('CurrentGameScheduleId', 'set', '');
                    }

                    $mongoModifier->addModifier('PreviousGameScheduleId', 'set', '');
                    $mongoModifier->addModifier('CurrentScheduledPlayers', 'set', array());
                    $mongoModifier->addModifier('CurrentScheduleResumePlayers', 'set', array());



                    $mongoModifier->addModifier('StartDate', 'set', '');
                    $mongoModifier->addModifier('EndDate', 'set', '');
                } else {

                    if ($obj->CurrentGameScheduleId == "") {
                        $mongoModifier->addModifier('CurrentGameScheduleId', 'set', "");
                    } else {
                        $mongoModifier->addModifier('CurrentGameScheduleId', 'set', new MongoId($obj->CurrentGameScheduleId));
                    }

                    $mongoModifier->addModifier('PreviousGameScheduleId', 'set', "");
                    $mongoModifier->addModifier('CurrentScheduledPlayers', 'set', $obj->CurrentScheduledPlayers);
                    $mongoModifier->addModifier('CurrentScheduleResumePlayers', 'set', $obj->CurrentScheduleResumePlayers);



                    $mongoModifier->addModifier('StartDate', 'set', new MongoDate($obj->StartDate));
                    $mongoModifier->addModifier('EndDate', 'set', new MongoDate($obj->EndDate));
                }


                $mongoModifier->addModifier('IsDeleted', 'set', 1);
            } else if ($obj->ActionType == "ReleaseGame") {
                $mongoModifier->addModifier('IsDeleted', 'set', 0);
            } else if ($obj->ActionType == "CancelScheduleGame") {
                
                   if ($obj->RecentActivity == "PartialUpdate") {
                       
                             if ($obj->CurrentGameScheduleId == "") {
                        $mongoModifier->addModifier('CurrentGameScheduleId', 'set', "");
                    } else {
                        $mongoModifier->addModifier('CurrentGameScheduleId', 'set', '');
                    }

                    $mongoModifier->addModifier('PreviousGameScheduleId', 'set', '');
                    $mongoModifier->addModifier('CurrentScheduledPlayers', 'set', array());
                    $mongoModifier->addModifier('CurrentScheduleResumePlayers', 'set', array());



                    $mongoModifier->addModifier('StartDate', 'set', '');
                    $mongoModifier->addModifier('EndDate', 'set', '');
                       
                   }
                   else{
                
                
                
                if ($obj->CurrentGameScheduleId == "") {
                    $mongoModifier->addModifier('CurrentGameScheduleId', 'set', "");
                } else {
                    $mongoModifier->addModifier('CurrentGameScheduleId', 'set', new MongoId($obj->CurrentGameScheduleId));
                }

                $mongoModifier->addModifier('PreviousGameScheduleId', 'set', "");
                $mongoModifier->addModifier('CurrentScheduledPlayers', 'set', $obj->CurrentScheduledPlayers);
                $mongoModifier->addModifier('CurrentScheduleResumePlayers', 'set', $obj->CurrentScheduleResumePlayers);

                $mongoModifier->addModifier('StartDate', 'set', new MongoDate($obj->StartDate));
                $mongoModifier->addModifier('EndDate', 'set', new MongoDate($obj->EndDate));
                $mongoModifier->addModifier('IsDeleted', 'set', 0);
            }
            }
            $mongoModifier->addModifier('IsNotifiable', 'set', (int) $obj->IsNotifiable);
            $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
            UserStreamCollection::model()->updateAll($mongoModifier, $criteria);
        } catch (Exception $exc) {
            echo 'Exception' . $exc->getMessage();
        }
    }
  
   /**
         * @author Haribabu
         * @param type $userid
         * @method get user total PostsCount
         * @return integer type count value
         */
        public function getPostsCount($userid){
            try{ 
                $postCnt = UserStreamCollection::model()->countByAttributes(array("OriginalUserId"=>(int)$userid,"UserId"=> (int)$userid,"IsDeleted"=>(int)0,"PostType"=>array('$ne' => array(4,11,12))));

            } catch (Exception $ex) {
                Yii::log($ex->getMessage(),'error','application');
            }
            return $postCnt;
        }
        
//     Start Game resource update in UserStream collection   
        
    public function getAllGamePostsCount() {
        try {
            $postCnt = UserStreamCollection::model()->countByAttributes(array("CategoryType"=>(int)9));
        
             for($i=0;$i< $postCnt;$i++){
                 
               $j=$i+1000;
              
               UserStreamCollection::model()->getAllGamePosts($j,$i);
                             
            }
            
            
            return $postCnt;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
        
        
         public function getAllGamePosts($limit,$offect) {
        try {
            echo "incontroller";
            $returnValue = 'failure';
            
            $array = array(
            'conditions' => array(
                'CategoryType' => array('==' => (int)9),
               
            ),
               
             
            'limit' => $limit,
            'offset' =>$offect,
        );
        
        
        $posts = UserStreamCollection::model()->findAll($array);

            foreach ($posts as $key => $value) {

                $Resources = GameCollection::model()->getPostById($value['PostId']);

                if (isset($Resources->Resources['ThumbNailImage'])) {

                    $thumbImage = $Resources->Resources['ThumbNailImage'];
                } else {

                    $thumbImage = $Resources->Resources['0']['ThumbNailImage'];
                }

                $gameDetails = UserStreamCollection::model()->UpdateGameResource($value['PostId'], $thumbImage);
            }

            return $posts;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
     public function UpdateGameResource($gameId,$Resource) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoModifier->addModifier('Resource', 'set', trim($Resource));
            $mongoCriteria->addCond('PostId', '==', new MongoId($gameId));
            $res = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return $res;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
// End Game resource update in UserStream collection
     public function getUserStreamObjByCriteria($categoryType,$userId,$networkInviteId) {
        try {
                echo "incontroller";
                $returnValue = 'failure';

                $array = array(
                'conditions' => array(
                    'CategoryType' => array('==' => (int)$categoryType),
                    'UserId' => array('==' => (int)$userId),
                    'NetworkInviteId'=>array('=='=>(int)$networkInviteId)
                ),
               );
              $userStreamObj = UserStreamCollection::model()->find($array);
              return $userStreamObj;
         }
        catch(Exception $ex)
        {

        }
      }
      
      public function updateStreamForNetworkInvite($userId,$categoryId,$networkInviteId){
       try {   
           
           $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;            
            $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));  
            $mongoModifier->addModifier('IsDeleted', 'set', 0);  
            $mongoCriteria->addCond('UserId', '==', (int)($userId));             
            $mongoCriteria->addCond('CategoryType', '==', (int)$categoryId);
            $mongoCriteria->addCond('IsDeleted', '==', (int) 0);
            $mongoCriteria->addCond('NetworkInviteId', '==', (int) $networkInviteId);

            $update=  UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
           // echo $update;
       } catch (Exception $exc) {   
          
          Yii::log("________",'error','application');
       }
      }
        
        
       public function deleteNetworkStreamInvite($streamId) {
           $returnValue="failure";
        try {

            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
             $mongoModifier->addModifier('IsDeleted', 'set', 1);
            $mongoCriteria->addCond('_id', '==', new MongoId($streamId));


          $update= UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
         
          $returnValue= "success";
            // echo $update;
        } catch (Exception $exc) {

            Yii::log("________", 'error', 'application');
        }
        return $returnValue;
    }
    
    
    public function updateStreamForAdvertisement($categoryId,$postId,$AdvertisementObj){
       try {   
           
           $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier; 
            $mongoCriteria->addCond('CategoryType', '==', (int)$categoryId);
            $mongoCriteria->addCond('PostId', '==', new MongoId($postId));
            $mongoModifier->addModifier('Title', 'set', $AdvertisementObj->Title);
                  $resourceBean=new ResourceBean();
                    $resourceBean->Extension=$postObj->ExtensionType;
                    $resourceBean->Uri=$AdvertisementObj->Url;
                    $resourceBean->ThumbNailImage=$AdvertisementObj->Url;
            $mongoModifier->addModifier('Resource', 'set', $resourceBean);
            $mongoModifier->addModifier('RedirectUrl', 'set', $AdvertisementObj->RedirectUrl);
            $mongoModifier->addModifier('StartDate', 'set', $AdvertisementObj->StartDate);
            $mongoModifier->addModifier('ExpiryDate', 'set',$AdvertisementObj->ExpiryDate);
            $mongoModifier->addModifier('IsNotifiable', 'set',(int)$AdvertisementObj->Status);
            $mongoModifier->addModifier('DisplayPage', 'set',$AdvertisementObj->DisplayPage);
            $mongoModifier->addModifier('Groups', 'set',$AdvertisementObj->GroupId);
            if($AdvertisementObj->DisplayPage!="Group"){
                  $mongoModifier->addModifier('Groups', 'set',"");
             }
            $mongoModifier->addModifier('RequestedFields', 'set', null);
            if($AdvertisementObj->AdTypeId==3){
             $mongoModifier->addModifier('RequestedFields', 'set', $AdvertisementObj->RequestedFields);  
             $mongoModifier->addModifier('RequestedParams', 'set', $AdvertisementObj->RequestedParams);   
            }

            $mongoModifier->addModifier('BannerTemplate', 'set', $AdvertisementObj->BannerTemplate);
            $mongoModifier->addModifier('BannerContent', 'set', $AdvertisementObj->BannerContent);
            $mongoModifier->addModifier('BannerTitle', 'set', $AdvertisementObj->BannerTitle);
            $mongoModifier->addModifier('ImpressionTag', 'set', $AdvertisementObj->ImpressionTag);
            $mongoModifier->addModifier('ClickTag', 'set', $AdvertisementObj->ClickTag);
            $mongoModifier->addModifier('BannerOptions', 'set', $AdvertisementObj->BannerOptions);
            

            if($AdvertisementObj->IsThisExternalParty==1){
               $mongoModifier->addModifier('Title','set',"<b>".$AdvertisementObj->ExternalPartyName."</b><span> ".$AdvertisementObj->Title."</span>");
               $mongoModifier->addModifier('NetworkLogo', 'set', $AdvertisementObj->ExternalPartyUrl);
                    }
                    else{
                      $mongoModifier->addModifier('NetworkLogo', 'set', "/images/system/networkbg_logo.png");
                    }
            

           UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
       } catch (Exception $exc) {   

          Yii::log("________",'error','application');
       }
      }
     
       public function  getStreamForAdvertisementByAdvertisementId($advertisementId) {
        try {
                $returnValue = 'failure';
                $array = array(  
                'conditions' => array(
                    'CategoryType' => array('==' => (int)13),
                    'AdvertisementId' => array('==' => (int)$advertisementId)
                )
               );
              $userStreamObj = UserStreamCollection::model()->find($array);
              
              return $userStreamObj;
         }
        catch(Exception $ex)
        {

        }
      }
           /**
       * @uthor Vamsi Krishna
       * @param type $badgeDetails
       */
      public function updateStreamForCustomBadge($badgeDetails){
          try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            
            $mongoCriteria->addCond('BadgeId', '==', $badgeDetails->id);
            $mongoCriteria->addCond('CategoryType', '==', (int)10);
            
            $mongoModifier->addModifier('PostText', 'set', $badgeDetails->id);
            $mongoModifier->addModifier('Title', 'set',  $badgeDetails->BadgeName);
            $mongoModifier->addModifier("Resources['0']['ThumbNailImage']", 'set', $badgeDetails->BadgeIcon);
          $update= UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
          } catch (Exception $exc) {
              error_log("------updateStreamForCustomBadge--------------".$exc->getMessage());
          }
            }
            
       /**
        * Author Vamsi 
        * This method is to check whether the store is already achieved badge
        * @param type $storeId
        */ 
            public function getStreamObjbyStoreId($storeId,$userId) {
        try {
             $criteria = new EMongoCriteria;
            $criteria->UserId = (int)$userId;
             $criteria->Store =(int)$storeId;
            $streamObj = UserStreamCollection::model()->find($criteria);
            return $streamObj;
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
   
}
        
       
        
        
?>
