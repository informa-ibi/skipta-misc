<?php
/**
 * @author sureshreddy
 * @copyright 2013 techo2.com
 * @version 3.0
 * @category Stream
 * @package Stream
 */

/**
 * FollowObjectStream
 *
 * Activity object of followers of user, that behaves user activity of system,
 * 
 */
class FollowObjectStream extends EMongoDocument {
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
    public $LoveUserId = array();
    public $StreamNote1;
    public $HashTagPostUserId;
    public $PostFollowers = array();
    public $InviteUsers = array();
    public $InviteMessage = array();
    public $OptionOne;
    public $OptionTwo;
    public $OptionThree;
    public $OptionFour;
    public $OptionOneCount;
    public $OptionTwoCount;
    public $OptionThreeCount;
    public $OptionFourCount;
    public $ExpiryDate;
    public $SurveyTaken = array();
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
    public $HashTagName;
    public $HashTagPostCount;
    public $HashTagFollowers;
    
    public $CurbsideCategoryFollowers=array();
    public $CurbsidePostCount=0;
    public $CurbsideCategoryId=0;
    public $GroupFollowers=array();
    public $IsEngage=0;
    public $IsFeatured=0;
    public $FeaturedUserId=0;
    public $FeaturedOn;
    public $Division=0;
    public $District=0;
    public $Region=0;
    public $Store=0;

    /**
     * hari added with reddy
     */
     public $IsWebSnippetExist = 0;
     public $WebUrls;
     public $IsBlockedWordExist=0;//0 - Default/Release, 1 - Abused, 2 - Blocked
     public $IsBlockedWordExistInComment=0;
     public $FbShare=array();
     public $TwitterShare=array();
     public $SubGroupId=0;
     public $SubGroupFollowers=array();
     
      /*
     * @var type news stream related vars
     */
    public $Title;
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
   public $TopicImage = '';
  public $IsNotifiable=1;
  
  
   public $PlayersCount=array();
   public $GameName;
   public $GameBannerImage;
   public $QuestionsCount=0;
   public $CurrentGameScheduleId=0;
   public $PreviousGameScheduleId=0;
   public $CurrentScheduledPlayers=array();
   public $CurrentScheduleResumePlayers=array();
   public $PreviousSchedulePlayers=array();
   public $PreviousScheduleResumePlayers=array();
   
    
   public $BadgeName;
     public $BadgeLevelValue;
     public $BadgeHasLevel;
   
  
 
    //  public $ppt;
    //  public $docs;
    // public $audio;
    // public $video;
    public function getCollectionName() {

        return 'FollowObjectStream';
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
            '_id' => '_id',
            'UserId' => 'UserId',
            'StreamNote' => 'StreamNote',
            'CreatedOn' => 'CreatedOn',
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
            'Priority'=>'Priority',
            'IsAbused'=>'IsAbused',
            'AbusedUserId'=>'AbusedUserId',
            'IsDeleted'=>'IsDeleted',
            'IsPromoted'=>'IsPromoted',
            'PromotedUserId'=>'PromotedUserId',
            'PostTextLength'=>'PostTextLength',
            'AbusedOn'=>'AbusedOn',
            'GroupId'=>'GroupId',
           
            'HashTagName'=>'HashTagName',
            'HashTagPostCount'=>'HashTagPostCount',
            'HashTagFollowers'=>'HashTagFollowers',
            'CurbsideCategoryFollowers'=>'CurbsideCategoryFollowers',
            'CurbsidePostCount'=>'CurbsidePostCount',
            'CurbsideCategoryId'=>'CurbsideCategoryId',
            'GroupFollowers'=>'GroupFollowers',
            'IsEngage'=>'IsEngage',
            'IsFeatured'=>'IsFeatured',
            'FeaturedUserId'=>'FeaturedUserId',
            'FeaturedOn' => 'FeaturedOn',
            'Division' => 'Division',
            'District' => 'District',
            'Region' => 'Region',
            'Store' => 'Store',
            'IsWebSnippetExist' => 'IsWebSnippetExist',
            'WebUrls' => 'WebUrls',
            'FollowCount' => 'FollowCount',
            'TwitterShare' => 'TwitterShare',
            'FbShare' => 'FbShare',
            'SubGroupId' => 'SubGroupId',
            'SubGroupFollowers' => 'SubGroupFollowers',
            'Title' => 'Title',
            'HtmlFragment' => 'HtmlFragment',
            'PublicationDate' => 'PublicationDate',
            'PublisherSource' => 'PublisherSource',
            'PublisherSourceUrl' => 'PublisherSourceUrl',
            'Editorial' => 'Editorial',
            'Released' => 'Released',
            'TopicId' => 'TopicId',
            'TopicName' => 'TopicName',
            'Alignment' => 'Alignment',
            'PublicationTime' => 'PublicationTime',
            'TopicImage' => 'TopicImage',
            'IsNotifiable'=>'IsNotifiable',
           

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
            'BadgeHasLevel'=>'BadgeHasLevel'
            
        );
    }
    /**
     * 
     * @param type $obj
     */
    
    public function saveFollowObjectStream($obj) {
        try {
            
            $streamObj = new FollowObjectStream();
            $streamObj->UserId = $obj->StreamUserId;
            $streamObj->StreamNote = $obj->StreamNote;
            $streamObj->StreamNote1 = $obj->StreamNote1;
            $streamObj->CreatedOn = $obj->CreatedOn;
            $streamObj->ActionType = $obj->ActionType;
            $streamObj->NetworkId = (int)$obj->NetworkId;

            $streamObj->PostType = $obj->PostType;
            $streamObj->CategoryType = (int)$obj->CategoryType;
            $streamObj->FollowEntity = (int)$obj->FollowEntity;

            $streamObj->RecentActivity = $obj->RecentActivity;
            //echo " grop iddddddddddddddddddd".$obj->GroupId;
            if($obj->CategoryType==3){
                $streamObj->GroupId =  new MongoId($obj->GroupId);
            }
            
             if($obj->CategoryType==7){                                
                //$streamObj->GroupId =  new MongoId($obj->GroupId);
                $streamObj->SubGroupId =  new MongoId($obj->SubGroupId);
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
            if (isset($obj->FbShare) && $obj->FbShare != "" && $obj->FbShare != null) {
                $streamObj->FbShare = array((int)$obj->FbShare) ;
            } else {

                $streamObj->FbShare = array();
            }
            if (isset($obj->TwitterShare) && $obj->TwitterShare != "" && $obj->TwitterShare != null) {
                $streamObj->TwitterShare = array((int)$obj->TwitterShare) ;
            } else {

                $streamObj->TwitterShare = array();
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
                $streamObj->InviteMessage = array($obj->InviteMessage);
            } else {
                $streamObj->InviteUsers = array();
                $streamObj->InviteMessage = array();
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
                 if ($obj->EventAttendes != "" && $obj->EventAttendes != null) {
                $streamObj->EventAttendes = array($obj->EventAttendes);
                 }else{
                    $streamObj->EventAttendes = array();   
                 }
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
            }
            $streamObj->Priority = $obj->Priority;
            //     $utc_str = gmdate("Y-m-d H:i:s", time());
            if(isset($obj->CreatedOn) && !empty($obj->CreatedOn)){
                $streamObj->CreatedOn = $obj->CreatedOn;
            }else{
                $streamObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }
            
            if (isset($streamObj->FollowEntity) && $streamObj->FollowEntity==4) {
            $streamObj->HashTagName = $obj->HashTagName;
            $streamObj->HashTagPostCount = $obj->HashTagPostCount;
            $streamObj->HashTagFollowers = array($obj->HashTagFollowers);
          }
          
               
          if (isset($streamObj->FollowEntity) && $streamObj->FollowEntity==5) {
            $streamObj->CurbsideConsultCategory = $obj->CurbsideConsultCategory;
            $streamObj->CurbsidePostCount = $obj->CurbsidePostCount;
             $streamObj->CurbsideCategoryId = (int)$obj->CurbsideCategoryId;
            $streamObj->CurbsideCategoryFollowers = array($obj->CurbsideCategoryFollowers);
          } 
          
     
             if (isset($streamObj->FollowEntity) && $streamObj->FollowEntity == 2) {
                $streamObj->GroupId = new MongoId($obj->GroupId);
                $streamObj->GroupFollowers = array($obj->GroupFollowers);
            }
            if (isset($streamObj->FollowEntity) && $streamObj->FollowEntity == 6) {
               
                $streamObj->SubGroupId = new MongoId($obj->SubGroupId);
                $streamObj->SubGroupFollowers = array($obj->SubGroupFollowers);
            }

            if ($streamObj->PostType == 5) {
            $streamObj->CurbsideConsultTitle = $obj->CurbsideConsultTitle;
            $streamObj->CurbsideConsultCategory = $obj->CurbsideConsultCategory;
               }
            $streamObj->IsEngage =0; 
            $streamObj->IsFeatured = (int)$obj->IsFeatured;            
            $streamObj->FeaturedUserId = $obj->FeaturedUserId;
            $streamObj->Division= (int)$obj->Division;
            $streamObj->District= (int)$obj->District;
            $streamObj->Region= (int)$obj->Region;
            $streamObj->Store= (int)$obj->Store;
            $streamObj->IsWebSnippetExist = (int) $obj->IsWebSnippetExist;
            $streamObj->WebUrls = $obj->WebUrls;
            $streamObj->IsBlockedWordExist = (int) $obj->IsBlockedWordExist;
            $streamObj->IsBlockedWordExistInComment = (int) $obj->IsBlockedWordExistInComment;
            $streamObj->Title = $obj->Title;
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
            echo '______________in save user derivative collection  __________' . $exc->getMessage();
            //  error::log("In save stream document" . $exc->getTraceAsString());
        }
    }

    /**
     * author: Suresh Reddy
     * @param type $postId
     * @param type $userId
     * @return type stream object
     */

    public function getStreamObjbyPostId($postId,$userId,$followEntity) {
        
        try {
            $criteria = new EMongoCriteria;
            $criteria->UserId = (int)$userId;
            $criteria->PostId = new MongoID($postId);
            $criteria->FollowEntity = (int)$followEntity;
            $streamObj = FollowObjectStream::model()->find($criteria);
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

    public function updateStreamObject($obj, $streamObjectId, $userId,$actionType='Post', $createdDate='') {
        try {             
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            
            if($actionType=="UserFollow"){
              $mongoModifier->addModifier('UserFollowers', 'push', $obj->UserFollowers);    
            }
             if($actionType=="PostFollow"){
              $mongoModifier->addModifier('PostFollowers', 'push', $obj->PostFollowers);    
            }
         
            
             if($actionType=="HashTagFollow"){
                   $mongoModifier->addModifier('HashTagPostCount', 'set', (int) $obj->HashTagPostCount);
                   $mongoModifier->addModifier('HashTagFollowers', 'push', (int) $obj->UserId);
            }
               if($actionType=="GroupFollow"){
                   $mongoModifier->addModifier('GroupFollowers', 'push', (int) $obj->GroupFollowers);
            }
            
               if($actionType=="CurbsideCategoryFollow"){
                 $mongoModifier->addModifier('CurbsideCategoryFollowers', 'push', (int) $obj->CurbsideCategoryFollowers);
                $mongoModifier->addModifier('CurbsidePostCount', 'set', (int) $obj->CurbsidePostCount);
                 }
            
          if($actionType=="EventAttend"){
              $mongoModifier->addModifier('EventAttendes', 'push', (int) $obj->EventAttendes);    
                
            }
           
                 if ($actionType == "Survey") {
                $mongoModifier->addModifier('SurveyTaken', 'push', (int) $obj->SurveyTaken);
                $mongoModifier->addModifier('OptionOneCount', 'set', (int) $obj->OptionOneCount);
                $mongoModifier->addModifier('OptionTwoCount', 'set', (int) $obj->OptionTwoCount);
                $mongoModifier->addModifier('OptionThreeCount', 'set', (int) $obj->OptionThreeCount);
                $mongoModifier->addModifier('OptionFourCount', 'set', (int) $obj->OptionFourCount);
            }

              if($actionType=="Love"){
              $mongoModifier->addModifier('LoveUserId', 'push', $obj->LoveUserId);    
            }
            if($actionType=="FbShare"){
              $mongoModifier->addModifier('FbShare', 'push', $obj->LoveUserId);    
            }
            if($actionType=="TwitterShare"){
              $mongoModifier->addModifier('TwitterShare', 'push', $obj->LoveUserId);    
            }
             if($actionType=="Comment"){
              $mongoModifier->addModifier('CommentUserId', 'push',  $obj->CommentUserId); 
         //     $obj->Comments['CreatedOn'] = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
              
               
                     if(is_int($obj->Comments['CreatedOn']))
                {                    
                     $streamObj->Comments['CreatedOn'] = new MongoDate((int)($obj->Comments['CreatedOn']));
                }
                else if(is_numeric($obj->Comments['CreatedOn']))
                {                 
                     $streamObj->Comments['CreatedOn'] = new MongoDate((int)($obj->Comments['CreatedOn']));
                }
                else
                {
                    $streamObj->Comments['CreatedOn'] =$obj->Comments['CreatedOn'];
                }
              
              
              
              
               $mongoModifier->addModifier('Comments', 'push',  $obj->Comments); 
                if(isset($obj->IsBlockedWordExistInComment) && !empty($obj->IsBlockedWordExistInComment)){
                    $mongoModifier->addModifier('IsBlockedWordExistInComment', 'set', (int) $obj->IsBlockedWordExistInComment);
                }
             }
              
            $mongoModifier->addModifier('ActionType', 'set', $obj->ActionType);
            $mongoModifier->addModifier('StreamNote', 'set', $obj->StreamNote);
            $mongoModifier->addModifier('RecentActivity', 'set', $obj->RecentActivity);
          if($createdDate!=''){
                $mongoModifier->addModifier('CreatedOn', 'set', $createdDate); 
            }else{
                $mongoModifier->addModifier('CreatedOn', 'set', $obj->FollowOn); 
            }
           
             $mongoModifier->addModifier('Priority', 'inc',  $obj->Priority); 
             $mongoModifier->addModifier('LoveCount', 'set',  $obj->LoveCount); 
             $mongoModifier->addModifier('InviteCount', 'set',  $obj->InviteCount); 
             $mongoModifier->addModifier('ShareCount', 'set',  $obj->ShareCount); 
             $mongoModifier->addModifier('FollowCount', 'set',  $obj->FollowCount); 
             $mongoModifier->addModifier('CommentCount', 'set',  $obj->CommentCount);            
            $mongoCriteria->addCond('_id', '==', new MongoId($streamObjectId));
            $mongoCriteria->addCond('UserId', '==', (int) $userId);
            $mongoCriteria->addCond('FollowEntity', '==', (int) $obj->FollowEntity);
            
            $res = FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);


            return $res;
        } catch (Exception $ex) {
         echo $ex->getMessage();   
        }
    }

    
    public function updateStreamSocialActions($obj) {
        try {

            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if (isset($obj->LoveUserId) && $obj->LoveUserId != "") {
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
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoCriteria->addCond('CategoryType', '==', (int) $obj->CategoryType);
            $mongoModifier->addModifier('LoveCount', 'set', $obj->LoveCount);
            $mongoModifier->addModifier('InviteCount', 'set', $obj->InviteCount);
            $mongoModifier->addModifier('ShareCount', 'set', $obj->ShareCount);
            $mongoModifier->addModifier('FollowCount', 'set', $obj->FollowCount);

            $mongoModifier->addModifier('CommentCount', 'set', $obj->CommentCount);
            // $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions Follow Object Stream" . $exc->getMessage();
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
            $mongoModifier->addModifier('PostFollowers', 'push', $obj->UserId);
            // $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social  actions Follow Object Stream followObject()" . $exc->getMessage();
        }

    }

 /**
     * @author suresh reddy
     * @param type $obj
     * @usage update derivateive object priority     
     */
     public function updateDerivateiveObjectPriority($id,$postId,$userId) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
           
            $mongoCriteria->addCond('_id', '==', new MongoID($id));
       //     $mongoCriteria->addCond('PostId', '==', new MongoID($postId));
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
            $mongoModifier->addModifier('Priority', 'set', 0);
            // $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions Follow Object Stream updateDerivateiveObjectPriority()" . $exc->getMessage();
        }

    }
    
     /**
     * @author suresh reddy
     * @param type $obj
     * @usage update derivateive object priority     
     */
     public function updateIsEngage($postId,$userId) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
           
           
       //     $mongoCriteria->addCond('PostId', '==', new MongoID($postId));
            $mongoCriteria->addCond('UserId', '==', (int)$userId);
           $mongoCriteria->addCond('PostId', '==', new MongoId($postId));
            $mongoModifier->addModifier('Priority', 'set', 0);
              $mongoModifier->addModifier('IsEngage', 'set', 1);
            // $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate(strtotime(date('Y-m-d H:i:s', time())))); 
            FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            echo "exception occur while update stream of social actions Follow Object Stream updateIsEngage()" . $exc->getMessage();
        }

    }
    /**
     * 
     * @param type $obj
     * follow object stream abused
     */
    
     public function updatePostManagementActions($obj) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            $mongoCriteria->addCond('PostId', '==', new MongoID($obj->PostId));
            $mongoCriteria->addCond('CategoryType', '==', (int)$obj->CatagoryId);
            $mongoCriteria->addCond('NetworkId', '==', (int)$obj->NetworkId);
            if($obj->ActionType=='Abuse'){
                $mongoModifier->addModifier('IsAbused', 'set', 1);
                $mongoModifier->addModifier('AbusedUserId', 'set', (int)$obj->UserId);
                $mongoModifier->addModifier('AbusedOn','set',new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
            }elseif ($obj->ActionType=="Block") {
                $mongoModifier->addModifier('IsAbused', 'set', 2);
            }elseif ($obj->ActionType=="Release") {
                $mongoModifier->addModifier('IsAbused', 'set', 0);
            }elseif ($obj->ActionType=="Promote") {
                $mongoModifier->addModifier('IsPromoted', 'set', 1);
                $mongoModifier->addModifier('PromotedUserId', 'set', (int)$obj->UserId);
                $mongoModifier->addModifier('CreatedOn','set',new MongoDate(strtotime($obj->PromotedDate)));
                $mongoCriteria->addCond('UserId', '==', 0);
            }elseif ($obj->ActionType=="Delete") {
                $mongoModifier->addModifier('IsDeleted', 'set', 1);
            }
            elseif ($obj->ActionType=="Featured") {
                $mongoModifier->addModifier('FeaturedUserId', 'set', (int)$obj->UserId);
                $mongoModifier->addModifier('IsFeatured', 'set', 1);
            }
            elseif ($obj->ActionType=="NewsNotify") {
                $mongoModifier->addModifier('IsNotifiable', 'set',(int)$obj->IsNotifiable);
            }
            FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);
           
        } catch (Exception $exc) {
            echo "exception occur while update stream of post management actions updatePostManagementActions()" . $exc->getMessage();
        }
    }
    /**
     * @author suresh reddy
     * @usage suspended game 
     * @param type $obj of game object
     */
   public function suspendorReleaseGame($obj) {
        try {
            $returnValue = array();
            $criteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($obj->ActionType == "SuspendGame") {
                
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
            FollowObjectStream::model()->updateAll($mongoModifier, $criteria);
        } catch (Exception $exc) {
            echo 'Exception' . $exc->getMessage();
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
         $mongoModifier->addModifier('IsNotifiable', 'set', (int)1);         
         $criteria->addCond('PostId', '==', new MongoId($obj->PostId));         
         FollowObjectStream::model()->updateAll($mongoModifier,$criteria);
         $result='success';
         return $result;
     } catch (Exception $exc) {         
      
        Yii::log("-----".$exc->getMessage(),'error','application');
        return $result;
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
            $mongoModifier->addModifier('IsNotifiable', 'set', (int)1);
            $mongoModifier->addModifier('CreatedOn', 'set', $obj->CreatedOn);
            $criteria->addCond('PostId', '==', new MongoId($obj->PostId));
            
            FollowObjectStream::model()->updateAll($mongoModifier,$criteria);
        return $returnValue;
        
      } catch (Exception $exc) {          
          echo 'Exception'.$exc->getMessage();
          return $returnValue;
      }
    }
    public function updateFollowObjectForGameDetails($Gameobj){
       $returnValue = 'success'; 
      try {          
         
            $criteria = new EMongoCriteria;
            $modifier = new EMongoModifier();
            $criteria->addCond('PostId', '==', new MongoID($Gameobj->GameId));
            $modifier->addModifier('GameDescription', 'set', $Gameobj->GameDescription);
            $modifier->addModifier('GameName', 'set', $Gameobj->GameName);
            
           
        if(FollowObjectStream::model()->updateAll($modifier,$criteria)){
           
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
}

?>