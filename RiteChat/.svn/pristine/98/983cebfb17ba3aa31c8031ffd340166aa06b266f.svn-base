<?php

class SkiptaPostService {

    /**
     *  This method is used to save the post 
     *   @params postObj and HashTagArray from the controller
     */
    public function savePost($postObj, $hashTagArray) {
        try {
            $postObj->Description = trim(html_entity_decode($postObj->Description));
            $categoryId = CommonUtility::getIndexBySystemCategoryType('Normal');
            $returnValue = 'failure';
            $postType = CommonUtility::sendPostType($postObj->Type);
            if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                $postObj->CreatedOn = $postObj->CreatedOn;
            } else {
                $postObj->CreatedOn = '';
            }
            $hashTagIdArray = $this->saveHashTags((int) $postObj->UserId, $hashTagArray, 'Post', $postType, $categoryId, '', $postObj->CreatedOn);
            $posturls = array();
            $TypeOfPost = "normalpost";
            $posturls[0] = trim($postObj->WebUrls);
            $postObj->WebUrls = $posturls;
            $postObj->Type = $postType;
            $postId = '';
            $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
            $isAbused = CommonUtility::IsArrayElementsExistsInString(strip_tags($postObj->Description), $abuseWords);
            if ($isAbused) {
                $postObj->IsBlockedWordExist = 1;
            }
            /* This logic is to save User Hirarchy */

            $userHirarchy = new UserHierarchyBean();
            $userHirarchyResult = UserHierarchy::model()->getUserHierarchyByUserId($postObj->UserId);


            if ($userHirarchyResult != 'failure') {
                $userHirarchy->District = $userHirarchyResult->District;
                $userHirarchy->Division = $userHirarchyResult->Division;
                $userHirarchy->Region = $userHirarchyResult->Region;
                $userHirarchy->Store = $userHirarchyResult->Store;
            }
            /* End */
            if ($postObj->Type == 1) {
                $postId = NormalPost::model()->SaveNormalPost($postObj, $hashTagIdArray, $userHirarchy);
                /* the below code is used for save the artifacts in resource object */
                if ($postId != 'failure') {
                    $returnValue = "success";

                    $SaveArtifacts = '';
                    if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $postObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                            }
                        }
                    } else {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $this->saveArtifacts($postObj->Artifacts, $postType, $categoryId);
                            $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                        }
                    }
                } else {

                    return 'failure';
                }
            } else if ($postObj->Type == 2) {
                $startdate = $postObj->StartDate;
                $postObj->StartDate =date(Yii::app()->params['PHPDateFormat'],strtotime($postObj->StartDate));
                $enddate = $postObj->EndDate;
                $postObj->EndDate = date(Yii::app()->params['PHPDateFormat'],strtotime($postObj->EndDate));
                $postId = EventPost::model()->SaveEventPost($postObj, $hashTagIdArray, $userHirarchy);
                if ($postId != 'failure') {
                    $returnValue = "success";

                    $SaveArtifacts = '';
                    if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $postObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                            }
                        }
                    } else {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $this->saveArtifacts($postObj->Artifacts, $postType, $categoryId);
                            $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                        }
                    }
                } else {

                    return 'failure';
                }
            } else if ($postObj->Type == 4) {
                /**
                 * Post Type 4 is anonymous post.
                 * 1: normal post
                 * 2: Event post
                 * 3: Survery Post
                 * 4: Anonymous Post
                 * 
                 */
                $postId = AnonymousPost::model()->SaveAnonymousPost($postObj, $hashTagIdArray, $userHirarchy);
                /* the below code is used for save the artifacts in resource object */
                if ($postId != 'failure') {
                    $returnValue = "success";
                    $SaveArtifacts = '';
                    if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $postObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                            }
                        }
                    } else {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $this->saveArtifacts($postObj->Artifacts, $postType, $categoryId);
                            $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                        }
                    }
                } else {

                    return 'failure';
                }
            } else if ($postObj->Type == 3) {
                $postId = SurveyPost::model()->saveSurveyPost($postObj, $userHirarchy);
                if ($postId != 'failure') {
                    $returnValue = "success";
                    $SaveArtifacts = '';
                    if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $postObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                            }
                        }
                    } else {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $this->saveArtifacts($postObj->Artifacts, $postType, $categoryId);
                            $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, $TypeOfPost, $postObj->CreatedOn);
                        }
                    }
                } else {

                    return 'failure';
                }
            }
            if ($postObj->IsFeatured == 1) {
                $categoryId = CommonUtility::getIndexBySystemCategoryType('Normal');
                if (!$this->saveNewsCollection($postId, $categoryId,$postObj->FeaturedTitle)) {
                    return "failure";
                }
            }
            if (isset($hashTagArray)) {
                foreach ($hashTagIdArray as $hashTagId) {
                    HashTagCollection::model()->updateHashTagCollectionWithPostId($postId, $hashTagId, 1);
                }
            }
            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
            if (!CommonUtility::prepareStreamObject($postObj->UserId, "Post", $postId, $categoryId, '', '')) {
                return "failure";
            }
            if ($postObj->Type == 2) {
                if (!CommonUtility::prepareStreamObject((int) $postObj->UserId, "EventAttend", $postId, $categoryId, '', '', $postObj->CreatedOn)) {
                    return "failure";
                }
            }
            if ($isAbused) {
                $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($postObj->Description), $abuseWords);
                AbuseKeywords::model()->PushBlockedPost($matchedElements, $postId, $categoryId, $postObj->NetworkId);
            }
            if ($returnValue != 'failure') {
                if (sizeof($postObj->Mentions) > 0) {
                    foreach ($postObj->Mentions as $value) {
                      
                        $activityIndex = CommonUtility::getUserActivityIndexByActionType("MentionUsed");
                        $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("PostMentionUsed");
                        UserInteractionCollection::model()->saveMentionUsageActivity($categoryId, $postObj->Type, $postObj->UserId, $value, $activityIndex, $activityContextIndex);
                    }
                }
            }
            if (isset($postObj->PostedBy) && !empty($postObj->PostedBy)) {
                $this->saveFollowOrUnfollowToPost($postType, $postId, $postObj->PostedBy, 'Follow', $categoryId);
            }
            if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                $returnValue = $postId;
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("+=========UUUU======================" . $exc->getMessage());

            Yii::log($exc->getMessage(), 'error', 'application');
            return "failure";
        }
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used get getHashTagsBySearchKey
     * @param type $searchKey
     * @return type
     */
    public function getHashTagsBySearchKey($searchKey, $hashtagArray = array()) {
        try {
            $hashtags = HashTagCollection::model()->getHashTagsBySearchKey($searchKey, $hashtagArray);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred while executing getEmployeeCertificateHistoryCount4Admin  in CoactiveService==" . $ex->getMessage(), 'error', 'application');
        }
        return $hashtags;
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used get getFollowingFollowerUsers
     * @param type $searchKey
     * @param type $userId
     * @return type
     */
    public function getFollowingFollowerUsers($searchKey, $userId, $mentionArray = array()) {
        $userDetails = 'failure';
        try {
            if (sizeof($mentionArray) > 0) {
                $mentionArray = array_map('intval', $mentionArray);
            }

            $users = UserProfileCollection::model()->getUserFollowersAndFollowingsById($userId);
            if (sizeof($mentionArray) > 0) {
                $users = array_diff($users, $mentionArray);
            }
            $userDetails = UserCollection::model()->getFollowingFollowerUsers($searchKey, $users);
        } catch (Exception $ex) {
            Yii::log("getFollowingFollowerUsers in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $userDetails;
    }

    /**
     * 
     */
    public function HashTagSave($hashTagName, $userId) {
        try {
            Yii::log("---------------HashTagSave in SkiptaPostService----------" . $hashTagName, 'error', 'application');
            $hashtagObj = HashTagCollection::model()->getHashTags($hashTagName);
            if ($hashtagObj == 'noHashTag') {
                $hashTag = new HashTagCollection();
                $hashTag->HashTagName = $hashTagName;
                $hashTagId = HashTagCollection::model()->saveHashTags($hashTag);
                $returnValue = "success";
            } else {
                $returnValue = "failure";
            }
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("HashTagSave in SkiptaPostService----------" . $ex->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Vamsi & Suresh Reddy
     * @param type $commentObj
     * @return type
     */
    public function saveComment($commentObj, $NetworkId, $CategoryType) {
        try {// throw new Exception('diveision errror');
            $hashTagArray = $commentObj->HashTags;
            if (isset($commentObj->CreatedOn) && !empty($commentObj->CreatedOn)) {
                $commentObj->CreatedOn = $commentObj->CreatedOn;
            } else {
                $commentObj->CreatedOn = '';
            }
            $hashTagIdArray = $this->saveHashTags((int) $commentObj->UserId, $hashTagArray, "Comment", $commentObj->PostType, $CategoryType, $commentObj->CreatedOn);
            error_log("====in save =======11111111111111111111111================");
            $resourcesArray = array();
            $postType = (int) $commentObj->PostType;
            if (count($commentObj->Artifacts) > 0) {
                $SaveArtifacts = '';
                if (isset($commentObj->CreatedOn) && !empty($commentObj->CreatedOn)) {
                    $SaveArtifacts = $commentObj->Artifacts;
                } else {
                    $SaveArtifacts = $this->saveArtifacts($commentObj->Artifacts, $postType, $CategoryType);
                }

                $resourcesArray = $this->saveResourceForComment($SaveArtifacts, $commentObj->PostId, $postType, $CategoryType, $commentObj->CreatedOn);
            }
            $commentBean = new CommentBean();
            error_log("====in save=======2222222222222222222222222================");
            $commentBean->CommentText = $commentObj->CommentText;
            $commentBean->IsBlockedWordExist = 0;
            $commentBean->WebUrls = $commentObj->WebUrls;
            if (count($commentObj->WebUrls) > 0) {

                $parsed = parse_url($commentBean->WebUrls[0]);
                if (empty($parsed['scheme'])) {
                    $commentBean->WebUrls[0] = 'http://' . ltrim($commentBean->WebUrls[0], '/');
                }
                $weburls = explode('&nbsp', $commentBean->WebUrls[0]);
                $commentBean->WebUrls[0] = $weburls[0];
            }
            $commentBean->IsWebSnippetExist = $commentObj->IsWebSnippetExist;

            /* Block word code By Sagar--------------------Start */
            $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
            $isAbused = CommonUtility::IsArrayElementsExistsInString(strip_tags($commentObj->CommentText), $abuseWords);
            if ($isAbused) {
                $commentBean->IsBlockedWordExist = 1;
            }
            error_log("====in save =======33333333333333333333333333================");
            /* Block word code By Sagar--------------------End */
            $commentBean->UserId = $commentObj->UserId;
            /* $descriptionLength=strlen(preg_replace('/<.*?>/', '', $commentObj->CommentText)); */
            $tagsFreeDescription = strip_tags(($commentObj->CommentText));
            $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
            $descriptionLength = strlen($tagsFreeDescription);
            if ($descriptionLength >= '500') {

                $length = '500';
            } else {

                $length = '240';
            }
            //$description=$commentObj->CommentText;
            $commentBean->CommentTextLength = $descriptionLength;
            if (isset($commentObj->CreatedOn) && !empty($commentObj->CreatedOn)) {

                $commentBean->CreatedOn = new MongoDate($commentObj->CreatedOn);
            } else {

                $commentBean->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }
            error_log("====in save =======444444444444444444444444444444================");
            $commentBean->CommentId = new MongoId();
            $commentBean->Artifacts = $resourcesArray;
            $commentBean->NoOfArtifacts = count($resourcesArray);
            $commentBean->HashTags = $commentObj->HashTags;
            $commentBean->Mentions = $commentObj->Mentions;
            $commentBean->PostType = $commentObj->PostType;
            $commentBean->PostId = $commentObj->PostId;
            $commentBean->NetworkId = $NetworkId;

            $commentBean->CategoryType = (int) $CategoryType;
            error_log("====in save =======5555555555555555555========CategoryType========$commentBean->CategoryType");
            if ((int) $CategoryType == 2) {
               
                CurbsidePostCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($isAbused) {
                    CurbsidePostCollection::model()->updatePostWhenCommentAbused($commentObj->PostId, "Abuse");
                }
                if (isset($hashTagArray)) {
                    foreach ($hashTagIdArray as $hashTagId) {
                        HashTagCollection::model()->updateHashTagCollectionWithPostId($commentObj->PostId, $hashTagId, 2);
                    }
                }
            } elseif ($CategoryType == 3 || $CategoryType == 7) {

                GroupPostCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($isAbused) {
                    GroupPostCollection::model()->updatePostWhenCommentAbused($commentObj->PostId, "Abuse");
                }
                if (isset($hashTagArray)) {
                    foreach ($hashTagIdArray as $hashTagId) {
                        HashTagCollection::model()->updateHashTagCollectionWithPostId($commentObj->PostId, $hashTagId, 3);
                    }
                }
            } else if ($CategoryType == 8) {
                CuratedNewsCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($isAbused) {
                    CuratedNewsCollection::model()->updatePostWhenCommentAbused($commentObj->PostId, "Abuse");
                }
                if (isset($hashTagArray)) {
                    foreach ($hashTagIdArray as $hashTagId) {
                        HashTagCollection::model()->updateHashTagCollectionWithPostId($commentObj->PostId, $hashTagId, 3);
                    }
                   
                }
            } elseif ($CategoryType == 9) {

                GameCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($isAbused) {
                    GameCollection::model()->updatePostWhenCommentAbused($commentObj->PostId, "Abuse");
                }
                if (isset($hashTagArray)) {
                    foreach ($hashTagIdArray as $hashTagId) {
                        HashTagCollection::model()->updateHashTagCollectionWithPostId($commentObj->PostId, $hashTagId, 9);
                    }
                }
            }
            elseif ($CategoryType == 10) {
              
                $resultValue= UserBadgeCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($resultValue == FALSE) {
                   
                    return FALSE;
                }
              
            }elseif ($CategoryType == 12) {
              error_log("====in save =======6666666666666666666666666=========== 12================");
                $resultValue= UserCVPublicationsCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($resultValue == FALSE) {
                   
                    return FALSE;
                }
              
            }
            else {
                $resultValue = PostCollection::model()->saveComment($commentObj->PostId, $commentBean);
                if ($resultValue == FALSE) {
                   
                    return FALSE;
                }
                if ($isAbused) {
                    PostCollection::model()->updatePostWhenCommentAbused($commentObj->PostId, "Abuse");
                }
                if (isset($hashTagArray)) {
                    foreach ($hashTagIdArray as $hashTagId) {
                        HashTagCollection::model()->updateHashTagCollectionWithPostId($commentObj->PostId, $hashTagId, 1);
                    }
                }
            }
            if (count($resourcesArray) > 0) {
                $commentBean->Artifacts = $resourcesArray[0];
            }
            $commentBean->CommentId = (String) $commentBean->CommentId;
            $commentCreatedOn = $commentBean->CreatedOn;
            $commentBean->CreatedOn = $commentCreatedOn->sec;
            $commentBean->PostId = (String) $commentBean->PostId;
            $commentBean->CreatedOn = (String) $commentBean->CreatedOn;
            if (count($commentBean->Mentions) > 0) {
                foreach ($commentBean->Mentions as $value) {
                    $activityIndex = CommonUtility::getUserActivityIndexByActionType("MentionUsed");
                    $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CommentMentionUsed");
                    UserInteractionCollection::model()->saveMentionUsageActivity($CategoryType, $commentObj->PostType, $commentObj->UserId, $value, $activityIndex, $activityContextIndex);
                }
            }
            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
            CommonUtility::prepareStreamObject($commentObj->UserId, "Comment", $commentObj->PostId, $CategoryType, '', $commentBean);
            if ($isAbused) {
                $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($commentObj->CommentText), $abuseWords);
                AbuseKeywords::model()->PushBlockedComment($matchedElements, $commentBean->PostId, $commentBean->CommentId, $CategoryType, $NetworkId);
                return "blocked";
            } else {
//     $activityIndex = CommonUtility::getUserActivityIndexByActionType("Comment");
//     $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("Comment");            
//     UserInteractionCollection::model()->savePostActionActivity($CategoryType,$commentObj->PostType,$commentObj->UserId,$activityIndex,$activityContextIndex);   
             
                $resourcesArray['CommentId']=(string)($commentBean->CommentId);
                return $resourcesArray;
            }
        } catch (Exception $exc) {
            error_log("^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^" . $exc->getMessage());
            return "Exception";
        }
    }

    /**
     * autho suresh reddy 
     * Stream distribute logic purpose
     */
    public function getFollowersOfUser($userId) {
        $userDetails = 'failure';
        try {
            $users = UserProfileCollection::model()->getUserFollowersById($userId);
        } catch (Exception $ex) {
            Yii::log("getFollowersOfUser in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $users;
    }

    /**
     * autho suresh reddy 
     * Stream distribute logic purpose
     */
    public function getObjectFollowers($postId, $postType, $categoryType) {
        $userDetails = 'failure';

        try {
            //$postType=CommonUtility::sendPostType($postType);
            if ((int) $categoryType == 1) {

                $objectFollowers = PostCollection::model()->getPostObjectFollowers($postId);
            }
            if ((int) $categoryType == 2) {
                $objectFollowers = CurbsidePostCollection::model()->getPostObjectFollowers($postId);
            }
            if ((int) $categoryType == 3 || (int) $categoryType == 7) {
                $objectFollowers = GroupPostCollection::model()->getGroupPostObjectFollowers($postId);
            }

            if ((int) $categoryType == 8) {
                $objectFollowers = CuratedNewsCollection::model()->getPostObjectFollowers($postId);
            }
            if ((int) $categoryType == 9) {
                $objectFollowers = GameCollection::model()->getGamePostObjectFollowers($postId);
            }
             if ((int) $categoryType == 10) {
                $objectFollowers =UserBadgeCollection::model()->getBadgeObjectFollowers($postId);
            }
            if ((int) $categoryType == 12) {
                $objectFollowers =  UserCVPublicationsCollection::model()->getCVObjectFollowers($postId);
            }
        } catch (Exception $ex) {

            return array();
        }

        return $objectFollowers;
    }

    /**
     * @author Vamsi & suresh reddy 
     * @param type $postType
     * @param type $postId
     * @param type $userId
     * @param type $categoryType
     * @return string
     */
    public function saveLoveToPost($postType, $postId, $userId, $categoryType, $createdDate = '') {

        try {
          
            $returnValue = FALSE;
            if ((int) $categoryType == 1) {
                //public post love
                $returnValue = PostCollection::model()->loveNormalPost($postId, $userId);
            } else if ((int) $categoryType == 2) {
                //for curbside post love
                $returnValue = CurbsidePostCollection::model()->loveNormalPost($postId, $userId);
            } else if ((int) $categoryType == 8) {
                //for curbside post love
                $returnValue = CuratedNewsCollection::model()->loveNormalPost($postId, $userId);
            } else if ((int) $categoryType == 9) {
                //for curbside post love
                $returnValue = GameCollection::model()->loveGame($postId, $userId);
            }  else if ((int) $categoryType == 10) {
                $returnValue = UserBadgeCollection::model()->loveBadgePost($postId, $userId);
            }  else if ((int) $categoryType == 12) {
                error_log("====in love servic===1111111111111111111");
                $returnValue = UserCVPublicationsCollection::model()->loveCVPost($postId, $userId);
            }else {
                $returnValue = GroupPostCollection::model()->loveGroupPost($postId, $userId);
            }
            if ($returnValue == FALSE) {
                return FALSE;
            }
            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
          error_log("====in love servic===$categoryType");
            CommonUtility::prepareStreamObject($userId, "Love", $postId, (int) $categoryType, '', '', $createdDate);
//            if($returnValue!=FALSE){
//             $activityIndex = CommonUtility::getUserActivityIndexByActionType("Love");
//              $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("Love");
//              UserInteractionCollection::model()->savePostActionActivity($categoryType,$postType,$userId,$activityIndex,$activityContextIndex);   
//                        
//            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("excepiton in service -------------" . $exc->getMessage());
            Yii::log("in save love service" . $exc->getMessage(), 'error', 'application');
            return FALSE;
        }
    }

    /**
     * 
     * @autho : Vamsi & suresh reddy & Sagar (modified by suresh)
     * @param type $postType
     * @param type $postId
     * @param type $userId
     * @param type $actionType
     * @param type $categoryType
     * @return type
     */
    public function saveFollowOrUnfollowToPost($postType, $postId, $userId, $actionType, $categoryType, $createdDate = '') {
        try {
            $returnValue = 'failure';
            if ((int) $categoryType == 2) {
                $returnValue = CurbsidePostCollection::model()->followOrUnfollowPost($postId, $userId, $actionType);
            } elseif ((int) $categoryType == 3 || (int) $categoryType == 7) {
                $returnValue = GroupPostCollection::model()->followOrUnfollowPost($postId, $userId, $actionType);
            } else if ((int) $categoryType == 8) {
                $returnValue = CuratedNewsCollection::model()->followOrUnfollowNewsPost($postId, $userId, $actionType);
            } else if ((int) $categoryType == 9) {
                $returnValue = GameCollection::model()->followOrUnfollowGame($postId, $userId, $actionType);
            } else if ((int) $categoryType == 10) {
                $returnValue = UserBadgeCollection::model()->followOrUnfollow($postId, $userId, $actionType);
            } else if ((int) $categoryType == 12) {
                error_log("============categoryType======$categoryType");
                $returnValue = UserCVPublicationsCollection::model()->followOrUnfollow($postId, $userId, $actionType);
            }else {
                $returnValue = PostCollection::model()->followOrUnfollowPost($postId, $userId, $actionType);
            }            
            if ($returnValue == "success") {
                    if (!CommonUtility::prepareStreamObject($userId, $actionType, $postId, (int) $categoryType, '', '', $createdDate)) {
                        $returnValue = "failure";
                    }
                }


            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("in follow  service" . $exc->getMessage(), 'error', 'application');
            return "failure";
        }
    }

    /**
     * 
     * @autho : Vamsi 
     * @param type $Artifacts
     * @param type $postId
     * @param type $postType 
     * @return type
     */
    public function saveResourceForPost($Artifacts, $postId, $postType, $post, $createdDate = '') {
        try {
            error_log("saveResourceForPost-------------");
            $returnValue = 'failure';
            $toSaveintoPostCollection = array();
            $res = new ResourceBean;
            if ($Artifacts > 0) {
                foreach ($Artifacts as $key => $artifact) {
                    if($artifact!=""){
                  //  error_log("artifacts---------".$artifact);
                    $ResourceCollectionModel = new ResourceCollection();
                    $extension = substr(strrchr($artifact, '.'), 1);
                    $extension = strtolower($extension);
                    if ($extension == 'mp4' || $extension == 'mp3' || $extension == 'avi') {
                        $ext = "video";
                        $path = 'video/' . $artifact;
                    } else if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'tiff' || $extension == 'png') {
                        $path = 'images/' . $artifact;
                    } else {
                        $path = 'other/' . $artifact;
                        // $extension="../upload/"+responseJSON['filename'];
                    }
                   // error_log("path---------".$path);

                    $ResourceCollectionModel->ResourceName = $artifact;
                    $postType = (int) $postType;
                    if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4 || $postType == 5) {
                        $path = '/upload/public/' . $path;
                    } else {
                        $path = '/upload/public/' . $path;
                    }
                    $thumbNailpath = '/upload/public/';
                    $ArtifactClassName = $this->getArtifactClassName($artifact, $path, $thumbNailpath, $createdDate);
                    if ($extension == 'ppt' || $extension == 'pptx') {
                        $ThumbnailImage = "/images/system/PPT-File-icon.png";
                    } else if ($extension == 'pdf') {
                        $ThumbnailImage = "/images/system/pdf.png";
                    } else if ($extension == 'doc' || $extension == 'docx' || $extension == 'avi') {
                        $ThumbnailImage = "/images/system/MS-Word-2-icon.png";
                    } else if ($extension == 'exe' || $extension == 'xls' || $extension == 'ini' || $extension == 'xlsx') {
                        $ThumbnailImage = "/images/system/Excel-icon.png";
                    } else if ($extension == 'mp3') {
                        $ThumbnailImage = "/images/system/audio_img.png";
                    } else if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {

                        $info = pathinfo($artifact);
                        $image_name = basename($artifact, '.' . $info['extension']);
                        $image_name = $image_name . '.' . 'jpg';
                        $folder = Yii::getPathOfAlias('webroot') . '/upload/public/thumbnails/' . $image_name;
                        $uploadfile = Yii::getPathOfAlias('webroot') . $path;
                    //    exec("ffmpeg -itsoffset -0 -i $uploadfile -vcodec mjpeg -vframes 1 -an -f rawvideo  scale=320:-1 $folder");
                        exec("ffmpeg -i $uploadfile -vf scale=320:-1 $folder");
                        $ThumbnailImage = '/upload/public/thumbnails/' . $image_name;
                    } else if ($extension == 'txt') {
                        $ThumbnailImage = "/images/system/notepad-icon.png";
                    } else {
                        $ThumbnailImage = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    }
                    $ResourceCollectionModel->StyleClass = trim($ArtifactClassName['fileclass']);
                    $ResourceCollectionModel->Uri = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    $ResourceCollectionModel->Extension = $extension;
                    $ResourceCollectionModel->ThumbNailImage = $ThumbnailImage;
                    $ResourceCollectionModel->PostId = $postId;
                     $image_info = getimagesize(Yii::getPathOfAlias('webroot').$ResourceCollectionModel->ThumbNailImage);
            $image_width = $image_info[0];
            $image_height = $image_info[1];
            $ResourceCollectionModel->Width=$image_info[0];
            $ResourceCollectionModel->Height=$image_info[1];
                        error_log("image height----****###".$image_height."----image width***--##-".$image_width);

                    $res->attributes = $ResourceCollectionModel->attributes;

                    $returnValue = ResourceCollection::model()->SaveResourceCollection($ResourceCollectionModel, $postId, $createdDate);
                    if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4) {
                        PostCollection::model()->updatePostWithArtifacts($postId, $ResourceCollectionModel->attributes);
                    } else if ($postType == 5) {
                        CurbsidePostCollection::model()->updateCurbsidePostWithArtifacts($postId, $res->attributes);
                    }
                }
                }
            }
            return $ResourceCollectionModel;
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @autho : Vamsi 
     * @param type $Artifacts
     * @param type $postId
     * @param type $postType 
     * @return type
     */
    public function saveResourceForComment($Artifacts, $postId, $postType, $CategoryType, $createdDate = '') {
        $resourcesArray = array();
        try {
            error_log("===========saveResourceForComment======================0000000000000000");
            $res = new ResourceBean;
            if (count($Artifacts) > 0) {
                foreach ($Artifacts as $key => $artifact) {
                    error_log("===========saveResourceForComment======================1111111111111111111");
                    $ResourceCollectionModel = new ResourceCollection();
                    $extension = substr(strrchr($artifact, '.'), 1);
                    $extension = strtolower($extension);
                    if ($extension == 'mp4' || $extension == 'mp3' || $extension == 'avi') {
                        $ext = "video";
                        $path = 'video/' . $artifact;
                    } else if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'tiff' || $extension == 'png') {
                        $path = 'images/' . $artifact;
                    } else {
                        $path = 'other/' . $artifact;
                        // $extension="../upload/"+responseJSON['filename'];
                    }
                    error_log("===========saveResourceForComment=====cateogryType=====$CategoryType=====PostType====$postType=====122123112=======000011111111011111=");
                    $ResourceCollectionModel->ResourceName = $artifact;
                    if ($CategoryType == 1 || $CategoryType == 2 || $CategoryType == 8 || $CategoryType == 9 || $CategoryType==10 || $CategoryType==12) {
                        if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4 || $postType == 5 || $postType == 11 || $postType == 12 || $postType == 13|| $postType == 15) {
                            $path = '/upload/public/' . $path;
                            error_log("===========saveResourceForComment=====path=================000011111111011111=$path");
                        }
                    } else if ($CategoryType == 3 || $CategoryType == 7) {
                        if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4 || $postType == 5) {
                            $path = '/upload/group/' . $path;
                        }
                    }
                    
                    $thumbNailpath = '/upload/public/';
                    error_log("===========saveResourceForComment======================222222222222222222222====$thumbNailpath");
                    $ArtifactClassName = $this->getArtifactClassName($artifact, $path, $thumbNailpath, $createdDate);
                    if ($extension == 'ppt' || $extension == 'pptx') {
                        $ThumbnailImage = "/images/system/PPT-File-icon.png";
                    } else if ($extension == 'pdf') {
                        $ThumbnailImage = "/images/system/pdf.png";
                    } else if ($extension == 'doc' || $extension == 'docx' || $extension == 'avi') {
                        $ThumbnailImage = "/images/system/MS-Word-2-icon.png";
                    } else if ($extension == 'exe' || $extension == 'xls' || $extension == 'ini' || $extension == 'xlsx') {
                        $ThumbnailImage = "/images/system/Excel-icon.png";
                    } else if ($extension == 'mp3') {
                        $ThumbnailImage = "/images/system/audio_img.png";
                    } else if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                        $info = pathinfo($artifact);
                        $image_name = basename($artifact, '.' . $info['extension']);
                        $image_name = $image_name . '.' . 'jpg';
                        $folder = Yii::getPathOfAlias('webroot') . '/upload/public/thumbnails/' . $image_name;
                        $uploadfile = Yii::getPathOfAlias('webroot') . $path;

                      //  exec("ffmpeg -itsoffset -0 -i $uploadfile -vcodec mjpeg -vframes 1 -an -f rawvideo scale=320:-1 $folder");
                        exec("ffmpeg -i $uploadfile -vf scale=320:-1 $folder");
                        error_log("===========saveResourceForComment======================333333333333333333");
                        $ThumbnailImage = '/upload/public/thumbnails/' . $image_name;
                    } else if ($extension == 'txt') {
                        $ThumbnailImage = "/images/system/notepad-icon.png";
                    } else {
                        $ThumbnailImage = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    }
                    $ResourceCollectionModel->ThumbNailImage = $ThumbnailImage;
                    $ResourceCollectionModel->StyleClass = trim($ArtifactClassName['fileclass']);
                    $ResourceCollectionModel->ResourceName = $artifact;
                    $ResourceCollectionModel->Uri = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    $ResourceCollectionModel->Extension = $extension;
                     $image_info = getimagesize(Yii::getPathOfAlias('webroot').$ResourceCollectionModel->ThumbNailImage);
            $image_width = $image_info[0];
            $image_height = $image_info[1];
            $ResourceCollectionModel->Width=$image_info[0];
            $ResourceCollectionModel->Height=$image_info[1];
                    $res->attributes = $ResourceCollectionModel->attributes;
                    $ResourceCollectionModel->PostId = $postId;
                    ResourceCollection::model()->SaveResourceCollection($ResourceCollectionModel, $postId, $createdDate);
                    error_log("===========saveResourceForComment======================444444444444444444444");
                    /**
                     * This is not used, due to the comment artifacts are also saved into the post artifacts
                     */
                    array_push($resourcesArray, $res->attributes);
                }
            }
        } catch (Exception $exc) {
            Yii::log("in save Resource  service" . $exc->getMessage(), 'error', 'application');
        }
        return $resourcesArray;
    }

    /**
     * 
     * @autho : Vamsi and modified by Vamsi on march-04-14 updated by suresh reddy return type in exception block-7/3/2014
     * @param type $Artifacts
     * @param type $postId
     * @param type $postType 
     * @return type
     */
    public function saveOrRemoveEventAttende($postId, $userId, $actionType, $categoryType, $createdDate = '') {
        try {
            if ((int) $categoryType == 3 || (int) $categoryType == 7) {
                $result = GroupPostCollection::model()->saveOrRemoveEventAttende($postId, $userId, $actionType);
            } else {
                $result = PostCollection::model()->saveOrRemoveEventAttende($postId, $userId, $actionType);
            }
            if ($actionType == 'Attend') {
                $categoryId = (int) $categoryType;
                CommonUtility::prepareStreamObject((int) $userId, "EventAttend", $postId, $categoryId, '', '', $createdDate);
            }
            return $result;
        } catch (Exception $exc) {
            Yii::log("in save Event Attende" . $exc->getMessage(), 'error', 'application');
            return 'failure';
        }
    }

    /**
     * 
     * @autho : Vamsi 
     * @param type $Artifacts
     * @param type $postId
     * @param type $postType 
     * @return type
     */
    public function getHashTagFollowers($hashTagId) {
        try {

            $hashTagObj = HashTagCollection::model()->getHashTagFollowers($hashTagId);
            return $hashTagObj;
        } catch (Exception $exc) {
            Yii::log("getHashTagFollowers" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * This method is used to get all categories for display in curbside post view  dropdownlist
     * @return type
     * @author Haribabu
     */
    public function getCurbsideCategories() {
        try {

            $categories = CurbsideCategoriesList::model()->getAllCurbsideCategories();
            return $categories;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }

    /**
     * This method is used to get all categories with post count for display in curbside post view
     * @return type
     * @author Haribabu
     */
    public function getCurbsideCategoriesFromMongo() {
        try {

            $categories = CurbSideCategoryCollection::model()->getCategories();
            return $categories;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }

    /**
     * This method is used to get all hashtags with post count for display in curbside post view
     * @return type
     * @author Haribabu
     */
    public function getHashtagsForCurbsidePost() {
        try {

            $hashtags = HashTagCollection::model()->getAllHashTags();
            //$hashtags=HashTagCollection::model()->updateHashTagCollectionWithPostId('52e8e727c95dbb1a688b457f','52e8e727c95dbb1a688b457e','curbsidepost');

            return $hashtags;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }

    /**
     * This method is used to save the curbside post
     * @param type $postObj
     * @param type $hashTagArray
     * @return type string
     * @author Haribabu
     */
    public function saveCurbidePost($postObj, $hashTagArray) {
        try {
            $returnValue = 'failure';
            $postObj->Description = html_entity_decode($postObj->Description);
            if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                $postObj->CreatedOn = $postObj->CreatedOn;
            } else {
                $postObj->CreatedOn = '';
            }
            $categoryId = CommonUtility::getIndexBySystemCategoryType('Curbside');
            $postType = CommonUtility::sendPostType($postObj->Type);
            $hashTagIdArray = array();
            if (isset($hashTagArray)) {
                foreach ($hashTagArray as $hashTagName) {
                    $hashtagObj = HashTagCollection::model()->getHashTags($hashTagName);
                    if ($hashtagObj == 'noHashTag') {
                        $hashTag = new HashTagCollection();
                        $hashTag->HashTagName = $hashTagName;
                        $hashTag->CreatedUserId = $postObj->UserId;
                        $hashTagId = HashTagCollection::model()->saveHashTags($hashTag);

                        $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashTagCreation");
                        $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CurbPostHashTagCreation");
                        UserInteractionCollection::model()->saveHashTagCreationActivity("", $categoryId, $postType, $postObj->UserId, $hashTagId, $hashTagName, $activityIndex, $activityContextIndex, "", $postObj->CreatedOn);

                        array_push($hashTagIdArray, $hashTagId);
                    } else {

                        foreach ($hashtagObj as $hash) {
                            $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashtagUsed");
                            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CurbPostHashTagUsed");
                            UserInteractionCollection::model()->saveHashTagCreationActivity("", $categoryId, $postType, $postObj->UserId, $hash->_id, $hash->HashTagName, $activityIndex, $activityContextIndex, "", $postObj->CreatedOn);
                            array_push($hashTagIdArray, $hash->_id);
                        }
                    }
                }
            }
            $postId = '';
            $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
            $isAbused = CommonUtility::IsArrayElementsExistsInString(strip_tags($postObj->Description), $abuseWords);
            if ($isAbused) {
                $postObj->IsBlockedWordExist = 1;
            }
            $posturls = array();
            $posturls[0] = trim($postObj->WebUrls);
            $postObj->WebUrls = $posturls;

            $postObj->Type = $postType;
            $postType = $postObj->Type;
            /* This logic is to save User Hirarchy */

            $userHirarchy = new UserHierarchy();
            $userHirarchyResult = UserHierarchy::model()->getUserHierarchyByUserId($postObj->UserId);


            if ($userHirarchyResult != 'failure') {
                $userHirarchy->District = $userHirarchyResult->District;
                $userHirarchy->Division = $userHirarchyResult->Division;
                $userHirarchy->Region = $userHirarchyResult->Region;
                $userHirarchy->Store = $userHirarchyResult->Store;
            }

            /* End */
          
            $postId = CurbsidePostCollection::model()->SaveCurbsidePost($postObj, $hashTagIdArray, $userHirarchy);
            if ($postId != 'failure') {
                if (is_array($postObj->Mentions)) {
                    foreach ($postObj->Mentions as $value) {
                     
                        $activityIndex = CommonUtility::getUserActivityIndexByActionType("MentionUsed");
                        $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CurbPostMentionUsed");
                        UserInteractionCollection::model()->saveMentionUsageActivity($categoryId, $postObj->Type, $postObj->UserId, $value, $activityIndex, $activityContextIndex);
                    }
                }
                $returnValue = $postId;
                if (count($postObj->Artifacts) > 0) {
                    $SaveArtifacts = '';
                    if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                        $SaveArtifacts = $postObj->Artifacts;
                        if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                            $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, '', $postObj->CreatedOn);
                        }
                    } else {
                        if (count($postObj->Artifacts) > 0) {
                            $SaveArtifacts = $this->saveArtifacts($postObj->Artifacts, $postType, $categoryId);
                            $returnValue = $this->saveResourceForPost($SaveArtifacts, $postId, $postType, '', $postObj->CreatedOn);
                        }
                    }
                }
                $curbsideCategory = CurbSideCategoryCollection::model()->updateCurbsideCategoriesWithCategoryId($postId, $postObj->Category);
            }


            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
            if ($postObj->IsFeatured == 1) {
                $categoryId = CommonUtility::getIndexBySystemCategoryType('Curbside');
                $this->saveNewsCollection($postId, $categoryId,$postObj->FeaturedTitle);
            }


            CommonUtility::prepareStreamObject($postObj->UserId, "Post", $postId, $categoryId, '', '', $postObj->CreatedOn);

            if (isset($hashTagArray)) {
                foreach ($hashTagIdArray as $hashTagId) {
                    HashTagCollection::model()->updateHashTagCollectionWithPostId($postId, $hashTagId, 2);
                }
            }
            if ($isAbused) {
                $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($postObj->Description), $abuseWords);
                AbuseKeywords::model()->PushBlockedPost($matchedElements, $postId, $categoryId, $postObj->NetworkId);
            }
            if (isset($postObj->PostedBy) && !empty($postObj->PostedBy)) {
                $this->saveFollowOrUnfollowToPost($postType, $postId, $postObj->PostedBy, 'Follow', $categoryId);
            }
            if (isset($postObj->CreatedOn) && !empty($postObj->CreatedOn)) {
                $returnValue = $postId;
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $returnValue;
    }

    public function getHashTagProfile($hashTagName, $userId) {
        try {
           
            $hashtagObj = HashTagCollection::model()->getHashTags($hashTagName);
            $hashtagProfile = new HashTagProfileBean();
            foreach ($hashtagObj as $hash) {
                $hashtagProfile->HashTagId = $hash->_id;
                $hashtagProfile->HashTagName = $hash->HashTagName;
                $hashtagProfile->IsUserFollowing = in_array($userId, $hash->HashTagFollowers) ? true : false;
                $hashtagProfile->NumberOfPosts = sizeof($hash->Post) + sizeof($hash->CurbsidePostId) + sizeof($hash->GroupPostId);
                $hashtagProfile->FollowersCount = sizeof($hash->HashTagFollowers);
                break;
            }
            return $hashtagProfile;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
            return "failure";
        }
    }

    public function trackMinHashTagWindowOpen($hashTagName, $userId, $NetworkId) {
        try {
          
            $hashtagObj = HashTagCollection::model()->getHashTags($hashTagName);
            $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashtagUsed");
            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("HashTagMinPopup");
            foreach ($hashtagObj as $hash) {
                UserInteractionCollection::model()->trackMinHashTagWindowOpen($userId, $hash->_id, $hash->HashTagName, $activityIndex, $activityContextIndex, $NetworkId);
            }
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
            return "failure";
        }
    }

    /**
     * This method is used to update the user follow/unfollow on hashtag
     * @param type $actionType (Follow/Unfollow)
     * @param type $userId
     * @author Sagar Pathapelli
     */
    public function followOrUnfollowHashTag($hashTagId, $userId, $actionType) {
        try {
         
            $result = HashTagCollection::model()->followOrUnfollowHashTag($hashTagId, $userId, $actionType);

            if ($result == "success") {
                UserProfileCollection::model()->followUnFollowHashTag($hashTagId, $userId, $actionType);
                if ($actionType == 'follow' || $actionType == 'Follow') {
                    $actionType = "HashTagFollow";
                } else {
                    $actionType = "HashTagUnFollow";
                }
                $CategoryType = CommonUtility::getIndexBySystemCategoryType('HashTag');
                $FollowEntity = CommonUtility::getIndexBySystemFollowingThing('HashTag');
                CommonUtility::prepareStreamObjectForFollowEntity($userId, $actionType, $hashTagId, (int) $CategoryType, $FollowEntity);
            }

            return $result;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return 'failure';
        }
    }

    /**
     * This method is used to create new group
     * @param type $groupObj
     * @return type string
     * @author Praneeth
     */
    public function createNewGroup($groupObj, $UserId, $NetworkId) {
        try {

            $userObj = $this->checkIfGroupExist($groupObj);
            $userIds = array();
            $returnValue = 'failure';
            if ($userObj != 'true') {

                $groupId = GroupCollection::model()->saveNewGroup($groupObj);
                if ($groupId != 'failure') {
                    if ($groupObj->AutoFollow == 1) {
                        $userStreamBean = new UserStreamBean();
                        $userStreamBean->ActionType = 'GroupAutoFollow';
                        $userStreamBean->GroupId = (String) $groupId;
                        $userStreamBean->UserId = $UserId;
                        Yii::app()->amqp->stream(json_encode($userStreamBean));
                    } else {
                        $returnValue = UserProfileCollection::model()->followOrUnfollowGroup($groupId, $UserId, "Follow");
                        if (isset(Yii::app()->session['PostAsNetwork']) && (Yii::app()->session['PostAsNetwork'] != 1)  && (Yii::app()->session['NetworkAdminUserId'] != $UserId) && Yii::app()->params['PostAsNetwork']=='ON') {
                            UserProfileCollection::model()->followOrUnfollowGroup($groupId, (int) Yii::app()->session['NetworkAdminUserId'], "Follow");
                        }
                        if (isset($groupObj->MigratedGroupId) && ($groupObj->MigratedGroupId != '')) {
                            $admin = User::model()->checkUserExist(YII::app()->params['NetworkAdminEmail']);
                            UserProfileCollection::model()->followOrUnfollowGroup($groupId, (int) $admin->UserId, "Follow");
                        }
                    }

                    $returnValue = $groupId;

                    $activityIndex = CommonUtility::getUserActivityIndexByActionType('GroupCreation');
                    $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType('GroupCreation');
                    if (isset($groupObj->CreatedOn) && !empty($groupObj->CreatedOn)) {
                        UserInteractionCollection::model()->trackNewGroupCreation($UserId, $groupId, $activityIndex, $activityContextIndex, $groupObj->CreatedOn, $NetworkId);
                    }
                } else {
                    $returnValue = 'failure';
                }
            } else {
                $returnValue = 'groupexists';
            }

            return $returnValue;
        } catch (Exception $ex) {
            error_log("creatNewGroup---exception----------------------------" . $ex->getMessage());
            Yii::log("----------in exception createNewGroup -------------" . $ex->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @autho : Vamsi 
     * @param type $userID
     * @param type $groupId
     * @param type $postType 
     * @return type
     */
    public function saveFollowOrUnfollowToGroup($groupId, $userId, $actionType, $createddate = '') {
        try {
            $returnValue = 'failure';
            $returnValue = GroupCollection::model()->followOrUnfollowGroup($groupId, $userId, $actionType);
            if ($returnValue == "success") {
                $returnValueUserProfileCollection = UserProfileCollection::model()->followOrUnfollowGroup($groupId, $userId, $actionType);

                if ($actionType == 'Follow') {
                    $actionType = "GroupFollow";
                } else {
                    if ($returnValueUserProfileCollection == 'success') {
                        SubGroupCollection::model()->removeOrAddUserInAllSubGroupsByGroupId($groupId, $userId, $actionType);
                    }
                    $actionType = "GroupUnFollow";
                }

                $CategoryType = CommonUtility::getIndexBySystemCategoryType('Group');
                $FollowEntity = CommonUtility::getIndexBySystemFollowingThing('Group');
                $groupDetails = GroupCollection::model()->getGroupDetailsById($groupId);
                if (!is_string($groupDetails)) {
                    if ($groupDetails->IsPrivate == 0) {
                        CommonUtility::prepareStreamObjectForFollowEntity($userId, $actionType, $groupId, (int) $CategoryType, $FollowEntity, $createddate);
                    }
                }
            }
        

            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("----------in exception --saveFollowOrUnfollowToGroup-------------" . $ex->getMessage(), 'error', 'application');
            return "failure";
        }
    }

    /**
     * @author Sagar Pathapelli
     * @param postId
     * @param inviteText
     * @param mentions=array()  
     */
    public function saveInvites($UserId, $PostId, $InviteText, $Mentions, $NetworkId, $CategoryType) {

        try {
            $returnValue = 'failure';
            if ((int) $CategoryType == 2) {
                $returnValue = CurbsidePostCollection::model()->saveInvites($UserId, $PostId, $InviteText, $Mentions);
            } elseif ((int) $CategoryType == 3 || (int) $CategoryType == 7) {
                $returnValue = GroupPostCollection::model()->saveInvites($UserId, $PostId, $InviteText, $Mentions);
            } elseif ((int) $CategoryType == 8) {
                $returnValue = CuratedNewsCollection::model()->saveInvites($UserId, $PostId, $InviteText, $Mentions);
            } elseif ((int) $CategoryType == 9) {
                $returnValue = GameCollection::model()->saveInvites($UserId, $PostId, $InviteText, $Mentions);
            } elseif ((int) $CategoryType == 12) {
                $returnValue = UserCVPublicationsCollection::model()->saveInvites($UserId, $PostId, $InviteText, $Mentions);
            } else {
                $returnValue = PostCollection::model()->saveInvites($UserId, $PostId, $InviteText, $Mentions);
            }

            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
            if ($returnValue == "success") {
                if ((int) $CategoryType == 2) {
                    $postObj = CurbsidePostCollection::model()->getPostById($PostId);
                } elseif ($CategoryType == 3 || $CategoryType == 7) {
                    $postObj = GroupPostCollection::model()->getGroupPostById($PostId);
                } elseif ($CategoryType == 8) {
                    $postObj = CuratedNewsCollection::model()->getNewsObjectById($PostId);
                } elseif ($CategoryType == 9) {
                    $postObj = GameCollection::model()->getGameDetailsObject('Id', $PostId);
                }elseif ($CategoryType == 12) {
                    $postObj = UserCVPublicationsCollection::model()->getPostById('Id', $PostId);
                } else {
                    $postObj = PostCollection::model()->getPostById($PostId);
                }
                foreach ($Mentions as $value) {
                  
                    $activityIndex = CommonUtility::getUserActivityIndexByActionType("MentionUsed");
                    $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("InviteMentionUsed");
                    UserInteractionCollection::model()->saveMentionUsageActivity($CategoryType, $postObj->Type, $UserId, $value, $activityIndex, $activityContextIndex);
                }
                if (!CommonUtility::prepareStreamObject($UserId, "Invite", $PostId, (int) $CategoryType, '', '')) {
                  
                    $returnValue = "failure";
                }
            }
          
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("----------in exception SkiptaPostservice/saveInvites -------------" . $ex->getMessage(), 'error', 'application');
            return "failure";
        }
    }

    public function saveGroupDetails($userId, $groupDescription, $type, $groupId, $category) {
        try {
            $returnValue = 'failure';
            if ($category == 'SubGroup') {
                $returnValue = SubGroupCollection::model()->updateGroupDetails($userId, $groupDescription, $type, $groupId);
            } else {
                $returnValue = GroupCollection::model()->updateGroupDetails($userId, $groupDescription, $type, $groupId);
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @autho : Vamsi 
     * @param type $groupId
     * @param type $puserId 
     * @return type
     */
    public function getGroupStatistics($groupId, $userId) {
        try {
            $returnValue = 'failure';
            $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
            if (is_object($groupObj)) {
                $groupBean = new GroupBean();
                $groupBean->GroupId = $groupObj->_id;
                $groupBean->GroupName = $groupObj->GroupName;
                $groupBean->GroupShortDescription = $groupObj->GroupDescription;
                $groupBean->GroupDescription = $groupObj->GroupDescription;
                $groupBean->GroupIcon = $groupObj->GroupProfileImage;
                $groupBean->GroupBannerImage = $groupObj->GroupBannerImage;
                $groupBean->GroupPostsCount = Count($groupObj->PostIds);
                $groupBean->GroupMembers = $groupObj->GroupMembers;
                $groupBean->IsGroupAdmin = in_array($userId, $groupObj->GroupAdminUsers);
                $groupBean->IsFollowing = in_array($userId, $groupObj->GroupMembers);
                $groupBean->SubgroupsCount = count($groupObj->SubGroups);
                $groupBean->IsPrivate = $groupObj->IsPrivate;
                $groupBean->DisableWebPreview=$groupObj->DisableWebPreview;
               
                $groupArtifacts = ResourceCollection::model()->getGroupResources($groupObj->_id, 'Group');


                if ($groupArtifacts != 'failure') {

                    // media Extensions "jpg","jpeg","gif","mov","mp4",,"avi","png","tiff"
                    //Doc Extensions  "txt","doc","pdf","ppt","xls"
                    $GroupImagesAndVideos = ResourceCollection::model()->getGroupImagesAndVideo($groupObj->_id, 'Image', 'Group');
                    $GroupDocs = ResourceCollection::model()->getGroupArtifacts($groupObj->_id, 'Artifacts', 'Group');
                    $GroupImagesAndVideosCount = ResourceCollection::model()->getGroupImagesAndVideo($groupObj->_id, 'Count', 'Group');
                    $GroupArtifactsCount = ResourceCollection::model()->getGroupArtifacts($groupObj->_id, 'Count', 'Group');
                    if ($GroupImagesAndVideosCount == 'failure') {
                        $groupBean->GroupImagesAndVideosCount = 0;
                    } else {
                        $groupBean->GroupImagesAndVideosCount = $GroupImagesAndVideosCount;
                    }
                    if ($GroupImagesAndVideos != 'failure') {
                        foreach ($GroupImagesAndVideos as $artifacts) {
                            if (strtolower($artifacts['Extension']) == 'jpg' || strtolower($artifacts['Extension']) == 'jpeg' || strtolower($artifacts['Extension']) == 'png' || strtolower($artifacts['Extension']) == 'tiff') {
                                array_push($groupBean->GroupImagesAndVideos, $artifacts['Uri']);
                            } else {
                                array_push($groupBean->GroupImagesAndVideos, '/images/system/video_img.png');
                            }
                        }
                    }


                    if ($GroupArtifactsCount == 'failure') {
                        $groupBean->GroupArtifactsCount = 0;
                    } else {
                        $groupBean->GroupArtifactsCount = $GroupArtifactsCount;
                    }

                    if ($GroupDocs != 'failure') {

                        foreach ($GroupDocs as $artifacts) {
                            array_push($groupBean->GroupArtifacts, $artifacts['ThumbNailImage']);
                        }
                    }
                } else {
                    $groupBean->GroupImagesAndVideosCount = 0;
                    $groupBean->GroupArtifactsCount = 0;
                }
                // this logic is to get the group members profile
                $groupBean->GroupMembersCount = count($groupObj->GroupMembers);
                if (count($groupObj->GroupMembers) > 0) {
                    $i = 0;
                    foreach ($groupObj->GroupMembers as $members) {
                        if ($i <= 8) {
                            $tinyUserObj = UserCollection::model()->getTinyUserObjByNetwork($members);
                            if (is_object($tinyUserObj)) {
                                array_push($groupBean->GroupMembersProfilePictures, $tinyUserObj->profile70x70);
                            }
                        } else {
                            break;
                        }
                        $i++;
                    }
                }

                if (count($groupObj->SubGroups) > 0) {
                    foreach ($groupObj->SubGroups as $subGroup) {
                        $subGroupObj = SubGroupCollection::model()->getSubGroupDetailsById($subGroup);
                        if (is_object($subGroupObj)) {
                            array_push($groupBean->SubGroupLogo, $subGroupObj->SubGroupProfileImage);
                        }
                    }
                }
                $returnValue = $groupBean;
            } else {
                
            }

            return $returnValue;
        } catch (Exception $exc) {
            error_log("----------------------------------------------" . $exc->getMessage());
            Yii::log($exc->getMessage() . "in post service ", 'error', 'application');
        }
    }

    /**
     * @author Sagar Pathapelli
     * @param $UserId
     * @param $PostId
     * @param mentions=array()  
     */
    public function submitSurvey($UserId, $PostId, $Option, $NetworkId, $CategoryType, $createdDate = '') {
        try {

            $returnValue = 'failure';
            if ((int) $CategoryType == 2) {
                
            } elseif ((int) $CategoryType == 3 || (int) $CategoryType == 7) {
                $returnValue = GroupPostCollection::model()->submitSurvey($UserId, $PostId, $Option);
            } else {
                $returnValue = PostCollection::model()->submitSurvey($UserId, $PostId, $Option);
            }

            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
            if ($returnValue == "success") {
                if (!CommonUtility::prepareStreamObject($UserId, "Survey", $PostId, $CategoryType, '', '', $createdDate)) {
                    $returnValue = "failure";
                }
            }



            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("----------in exception SkiptaPostservice/saveInvites -------------" . $ex->getMessage(), 'error', 'application');
            return "failure";
        }
    }

    /**
     * @autho haribabu  
     * @usage for group post saving
     * @param type $groupPostObj
     * @param type $hashTagArray
     * @return type
     */
    public function saveGroupPost($groupPostObj, $hashTagArray) {
        try {
            $returnValue = 'failure';
            $categoryId = 0;
            if (isset($groupPostObj->CreatedOn) && !empty($groupPostObj->CreatedOn)) {
                $groupPostObj->CreatedOn = $groupPostObj->CreatedOn;
            } else {
                $groupPostObj->CreatedOn = '';
            }
            $groupPostObj->Description = html_entity_decode($groupPostObj->Description);
            if ($groupPostObj->SubGroupId != 0) {
                $categoryId = CommonUtility::getIndexBySystemCategoryType('SubGroup');
                $groupType = "SubGroup";
                $id = $groupPostObj->SubGroupId;
            } else {
                $categoryId = CommonUtility::getIndexBySystemCategoryType('Group');
                $groupPostObj->SubGroupId = 0;
                $groupType = "Group";
                $id = $groupPostObj->GroupId;
            }

            $hashTagIdArray = $this->saveHashTags((int) $groupPostObj->UserId, $hashTagArray, $groupType, $groupPostObj->Type, $categoryId, $id, $groupPostObj->CreatedOn);
            /**
             * for  rite aid specific -reddy blockwords

              $postId='';
              $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
              $isAbused = CommonUtility::IsArrayElementsExistsInString($groupPostObj->Description,$abuseWords);
              if($isAbused){
              $groupPostObj->IsBlockedWordExist=1;
              } */
            $TypeOfPost = "grouppost";
            $posturls = array();
            $posturls[0] = trim($groupPostObj->WebUrls);
            $groupPostObj->WebUrls = $posturls;

            $postType = CommonUtility::sendPostType($groupPostObj->Type);
            $groupPostObj->Type = $postType;
            $postId = '';
            $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
            $isAbused = CommonUtility::IsArrayElementsExistsInString(strip_tags($groupPostObj->Description), $abuseWords);
            if ($isAbused) {
                $groupPostObj->IsBlockedWordExist = 1;
            }
            /* This logic is to save User Hirarchy */

            $userHirarchy = new UserHierarchy();
            $userHirarchyResult = UserHierarchy::model()->getUserHierarchyByUserId($groupPostObj->UserId);

            if ($userHirarchyResult != 'failure') {
                $userHirarchy->District = $userHirarchyResult->District;
                $userHirarchy->Division = $userHirarchyResult->Division;
                $userHirarchy->Region = $userHirarchyResult->Region;
                $userHirarchy->Store = $userHirarchyResult->Store;
            }
            /* End */
            if ($groupPostObj->Type == 1) {
                $postId = GroupNormalPost::model()->SaveGroupNormalPost($groupPostObj, $hashTagIdArray, $userHirarchy);
                /* the below code is used for save the artifacts in resource object */
                if ($postId != 'failure') {
                    $returnValue = "success";
                    if (count($groupPostObj->Artifacts) > 0) {
                        $SaveArtifacts = '';
                        if (isset($groupPostObj->CreatedOn) && !empty($groupPostObj->CreatedOn)) {
                            $SaveArtifacts = $groupPostObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForGroupPost($SaveArtifacts, $postId, $postType, $groupPostObj->GroupId, $groupPostObj->Artifacts, $groupPostObj->SubGroupId, $groupPostObj->CreatedOn);
                            }
                        } else {
                            if (count($groupPostObj->Artifacts) > 0) {
                                $SaveArtifacts = $this->saveArtifacts($groupPostObj->Artifacts, $postType, $categoryId);
                                $returnValue = $this->saveResourceForGroupPost($SaveArtifacts, $postId, $postType, $groupPostObj->GroupId, $groupPostObj->Artifacts, $groupPostObj->SubGroupId);
                            }
                        }
                    } else {
                        
                    }
                }
            } else if ($groupPostObj->Type == 2) {
                $startdate = $groupPostObj->StartDate;
                $groupPostObj->StartDate =date(Yii::app()->params['PHPDateFormat'],strtotime($groupPostObj->StartDate));
                $enddate = $groupPostObj->EndDate;
                $groupPostObj->EndDate = date(Yii::app()->params['PHPDateFormat'],strtotime($groupPostObj->EndDate));
                $postId = GroupEventPost::model()->SaveGroupEventPost($groupPostObj, $hashTagIdArray, $userHirarchy);
                if ($postId != 'failure') {
                    if (count($groupPostObj->Artifacts) > 0) {
                        $SaveArtifacts = '';
                        if (isset($groupPostObj->CreatedOn) && !empty($groupPostObj->CreatedOn)) {
                            $SaveArtifacts = $groupPostObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForGroupPost($SaveArtifacts, $postId, $postType, $groupPostObj->GroupId, $groupPostObj->Artifacts, $groupPostObj->SubGroupId, $groupPostObj->CreatedOn);
                            }
                        } else {
                            if (count($groupPostObj->Artifacts) > 0) {
                                $SaveArtifacts = $this->saveArtifacts($groupPostObj->Artifacts, $postType, $categoryId);
                                $returnValue = $this->saveResourceForGroupPost($SaveArtifacts, $postId, $postType, $groupPostObj->GroupId, $groupPostObj->Artifacts, $groupPostObj->SubGroupId);
                            }
                        }
                    }
                }
            } else if ($groupPostObj->Type == 3) {
                $postId = GroupSurveyPost::model()->saveGroupSurveyPost($groupPostObj, $hashTagIdArray, $userHirarchy);
                if ($postId != 'failure') {
                    $returnValue = "success";
                    if (count($groupPostObj->Artifacts) > 0) {
                        $SaveArtifacts = '';
                        if (isset($groupPostObj->CreatedOn) && !empty($groupPostObj->CreatedOn)) {
                            $SaveArtifacts = $groupPostObj->Artifacts;
                            if ($SaveArtifacts != '' && !empty($SaveArtifacts)) {
                                $returnValue = $this->saveResourceForGroupPost($SaveArtifacts, $postId, $postType, $groupPostObj->GroupId, $groupPostObj->Artifacts, $groupPostObj->SubGroupId, $groupPostObj->CreatedOn);
                            }
                        } else {
                            if (count($groupPostObj->Artifacts) > 0) {
                                $SaveArtifacts = $this->saveArtifacts($groupPostObj->Artifacts, $postType, $categoryId);
                                $returnValue = $this->saveResourceForGroupPost($SaveArtifacts, $postId, $postType, $groupPostObj->GroupId, $groupPostObj->Artifacts, $groupPostObj->SubGroupId);
                            }
                        }
                    }
                }
            }
            //logic for saving postId in GroupCollection
            if ($categoryId == 3) {
                ServiceFactory::getSkiptaGroupServiceInstance()->updateGroupForGroupPost($postId, $groupPostObj->GroupId, $categoryId);
            } else {
                ServiceFactory::getSkiptaGroupServiceInstance()->updateGroupForGroupPost($postId, $groupPostObj->SubGroupId, $categoryId);
            }



            /**
             * @param 1post type, 2)postid 3)posttype,4)category type,follow entity, comment object
             */
            CommonUtility::prepareStreamObject($groupPostObj->UserId, "Post", $postId, $categoryId, '', '');
            if ($groupPostObj->Type == 2) {
                CommonUtility::prepareStreamObject((int) $groupPostObj->UserId, "EventAttend", $postId, $categoryId, '', '', $groupPostObj->CreatedOn);
            }
            if (isset($hashTagArray)) {
                foreach ($hashTagIdArray as $hashTagId) {
                    HashTagCollection::model()->updateHashTagCollectionWithPostId($postId, $hashTagId, 3);
                }
            }
            if ($isAbused) {
                $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($groupPostObj->Description), $abuseWords);
                AbuseKeywords::model()->PushBlockedPost($matchedElements, $postId, $categoryId, $groupPostObj->NetworkId);
            }
            if ($returnValue != 'failure') {
                foreach ($groupPostObj->Mentions as $value) {
                    $activityIndex = CommonUtility::getUserActivityIndexByActionType("MentionUsed");
                    $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("GroupPostMentionUsed");
                    UserInteractionCollection::model()->saveMentionUsageActivity($categoryId, $groupPostObj->Type, $groupPostObj->UserId, $value, $activityIndex, $activityContextIndex);
                }
            }
            if (isset($groupPostObj->PostedBy) && !empty($groupPostObj->PostedBy)) {
                $this->saveFollowOrUnfollowToPost($postType, $postId, $groupPostObj->PostedBy, 'Follow', $categoryId);
            }
            return $postId;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage() . "###############################################", 'error', 'application');
            return 'failure';
        }
        //return 'success';
    }

    public function saveResourceForGroupPost($Artifacts, $postId, $postType, $groupId, $originalArtifacts, $subGroupId, $createdDate = '') {
        try {
            $returnValue = 'failure';
            $toSaveintoPostCollection = array();
            $res = new ResourceBean;
            if ($Artifacts > 0) {
                foreach ($Artifacts as $key => $artifact) {
                    $ResourceCollectionModel = new ResourceCollection();
                    $extension = substr(strrchr($artifact, '.'), 1);
                    $extension = strtolower($extension);
                    if ($extension == 'mp4' || $extension == 'mp3' || $extension == 'avi') {
                        $ext = "video";
                        $path = 'video/' . $artifact;
                    } else if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'tiff' || $extension == 'png') {
                        $ext = "images";
                        $path = 'images/' . $artifact;
                    } else {
                        $ext = "other";
                        $path = "other/" . $artifact;
                        // $extension="../upload/"+responseJSON['filename'];
                    }



                    $ResourceCollectionModel->ResourceName = $originalArtifacts[$key];

                    if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4) {
                        $path = '/upload/group/' . $path;
                    }
                    $thumbNailpath = '/upload/group/';
                    $ArtifactClassName = $this->getArtifactClassName($artifact, $path, $thumbNailpath, $createdDate);
                    if ($extension == 'ppt' || $extension == 'pptx') {
                        $ThumbnailImage = "/images/system/PPT-File-icon.png";
                    } else if ($extension == 'pdf') {
                        $ThumbnailImage = "/images/system/pdf.png";
                    } else if ($extension == 'doc' || $extension == 'docx') {
                        $ThumbnailImage = "/images/system/MS-Word-2-icon.png";
                    } else if ($extension == 'exe' || $extension == 'xls' || $extension == 'ini' || $extension == 'xlsx') {
                        $ThumbnailImage = "/images/system/Excel-icon.png";
                    } else if ($extension == 'mp3') {
                        $ThumbnailImage = "/images/system/audio_img.png";
                    } else if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov' || $extension == 'avi') {
                        $info = pathinfo($artifact);
                        $image_name = basename($artifact, '.' . $info['extension']);
                        $image_name = $image_name . '.' . 'jpg';
                        $folder = Yii::getPathOfAlias('webroot') . '/upload/public/thumbnails/' . $image_name;
                        $uploadfile = Yii::getPathOfAlias('webroot') . $path;

                          exec("ffmpeg -i $uploadfile -vf scale=320:-1 $folder");

                        $ThumbnailImage = '/upload/public/thumbnails/' . $image_name;
                    } else if ($extension == 'txt') {
                        $ThumbnailImage = "/images/system/notepad-icon.png";
                    } else {
                        $ThumbnailImage = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    }
                    $ResourceCollectionModel->ThumbNailImage = $ThumbnailImage;
                    $ResourceCollectionModel->StyleClass = trim($ArtifactClassName['fileclass']);
                    $ResourceCollectionModel->Uri = str_replace(" ", "", stripslashes(trim($ArtifactClassName['filepath'])));
                    $ResourceCollectionModel->Extension = $extension;
                     $image_info = getimagesize(Yii::getPathOfAlias('webroot').$ResourceCollectionModel->ThumbNailImage);
                     $image_width = $image_info[0];
                      $image_height = $image_info[1];
                       $ResourceCollectionModel->Width=$image_info[0];
                          $ResourceCollectionModel->Height=$image_info[1];
                    
                    $res->attributes = $ResourceCollectionModel->attributes;
                    $ResourceCollectionModel->PostId = $postId;
                    $ResourceCollectionModel->GroupId = $groupId;
                    $ResourceCollectionModel->SubGroupId = $subGroupId;
                    
                    $returnValue = ResourceCollection::model()->SaveResourceCollection($ResourceCollectionModel, $postId, $createdDate);
                    if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4) {
                        GroupPostCollection::model()->updatePostWithArtifacts($postId, $res->attributes);
                    }
                }
            }
            return $ResourceCollectionModel;
        } catch (Exception $exc) {
            error_log("---------------------------------------------------------" . $exc->getMessage());
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * This method is used to get categoryObject  with post count for display in curbside post view
     * @param categoryid
     * @param userid
     * @return type
     * @author Haribabu
     */
    public function getCurbsideCategoryMiniProfile($curbsideCategoryId, $userId) {
        try {

            $categoryObject = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($curbsideCategoryId);
            return $categoryObject;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }

    /**
     * This method is used to update the user follow/unfollow on curbside category
     * @param type $actionType (Follow/Unfollow)
     * @param type $userId
     * @author suresh
     * updated Vamsi Krishna added stream object for user activity collection 
     */
    public function followOrUnfollowCurbsideCategory($categoryId, $userId, $actionType) {
        try {
            $result = 'failure';
            $result = CurbSideCategoryCollection::model()->followOrUnfollowCurbsideCategory($categoryId, $userId, $actionType);

            if ($result == "success") {
                UserProfileCollection::model()->followOrUnfollowCurbsideCategory($categoryId, $userId, $actionType);

                if ($actionType == 'follow' || $actionType == "Follow") {
                    $actionType = "CurbsideCategoryFollow";
                } else {
                    $actionType = "CurbsideCategoryUnFollow";
                }

                $CategoryType = CommonUtility::getIndexBySystemCategoryType('CurbsideCategory');
                $FollowEntity = CommonUtility::getIndexBySystemFollowingThing('CurbsideCategory');
                CommonUtility::prepareStreamObjectForFollowEntity($userId, $actionType, $categoryId, (int) $CategoryType, $FollowEntity);
            }


            error_log("followOrUnfollowCurbsideCategory---" . $result);
            return $result;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return 'failure';
        }
    }

    /**
     *  Author Vamsi Krishna
     *  @param type Get Group Followers in group Home Page
     *  @param type $groupId
     */
    public function getGroupFollowers($groupId, $offset, $pageSize, $category = '') {
        try {
            $returnValue = 'failure';
            $groupFollowersArray = array();
            if ($category == "Group") {
                $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
                $groupMemebers = array_slice($groupObj->GroupMembers, $offset, $pageSize);
                if (count($groupMemebers) > 0) {
                    foreach ($groupMemebers as $members) {
                        $tinyUserObj = UserCollection::model()->getTinyUserObjByNetwork($members);
                        if (is_object($tinyUserObj)) {
                            array_push($groupFollowersArray, $tinyUserObj);
                        }
                    }

                    $returnValue = array_slice($groupFollowersArray, $offset, $pageSize);
                }
            } else {
                $groupObj = SubGroupCollection::model()->getSubGroupDetailsById($groupId);
                $groupMemebers = array_slice($groupObj->SubGroupMembers, $offset, $pageSize);
                if (count($groupMemebers) > 0) {
                    foreach ($groupMemebers as $members) {
                        $tinyUserObj = UserCollection::model()->getTinyUserObjByNetwork($members);
                        if (is_object($tinyUserObj)) {
                            array_push($groupFollowersArray, $tinyUserObj);
                        }
                    }
                }
            }

            return $groupFollowersArray;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * Author Vamsi Krishna 
     * @param MongoId $groupId
     * @return type array if success and string if fails to get the data
     *     
     */
    public function getImageAndVideoForGroups($groupId, $limit, $offset) {
        try {

            $returnValue = 'failure';
            $GroupImagesAndVideos = ResourceCollection::model()->getGroupImagesAndVideoForDetails($groupId);
            if (is_array($GroupImagesAndVideos)) {
                $returnValue = $GroupImagesAndVideos;
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function getArtifactClassName($artifact, $path, $thumbNailpath, $createdDate = '') {
        try {
            $className = "";
            $className = "img_small_250";
            $new_filepath = $path;
            $result = array();
            // $extension = end(explode(".", strtolower($artifact)));
            $imageExtension = explode(".", strtolower($artifact));
            $extension = end($imageExtension);
            if ($createdDate == '') {
                
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'tiff' || $extension == 'png') {
                    $filepath = Yii::getPathOfAlias('webroot') . $path;                    
                    list($width, $height) = getimagesize($filepath);                    
                    $newfolder = Yii::getPathOfAlias('webroot') . $thumbNailpath . 'thumbnails/'; // folder for uploaded files
                    if (!file_exists($newfolder)) {
                        mkdir($newfolder, 0755, true);
                    }
                    if ($width >= 250) {                        
                        $img = Yii::app()->simpleImage->load($filepath);
                        $img->resizeToWidth(250);
                        $img->save($newfolder . $artifact);
                        $className = "img_big_250";
                        $new_filepath = $thumbNailpath . 'thumbnails/' . $artifact;
                    } else {                        
                        $destination = $newfolder . $artifact;
                        copy($filepath, $destination);
                        $className = "img_small_250";
                        $new_filepath = $thumbNailpath . 'thumbnails/' . $artifact;
                    }
                }
            }
            $result['filepath'] = $new_filepath;
            $result['fileclass'] = $className;            
            return $result;
        } catch (Exception $exc) {
            error_log("====++ExceptionOccurred========".$exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar Pathapelli
     * @Description Abuse/Block/Release the post pased on action type
     * @param type $postId
     * @param type $actionType (Abuse/Block/Release)
     * @param type $categoryId
     * @param type $networkId
     * @param type $userId
     * @return string
     */
    public function abusePost($postId, $actionType, $categoryId, $networkId, $userId, $isBlockedPost = 0) {
        try {
            $returnValue = "failure";
            $description = "";
            if ((int) $categoryId == 2) {
                $returnValue = CurbsidePostCollection::model()->abusePost($postId, $actionType, $userId, $isBlockedPost);
                if ($isBlockedPost != 0 && $actionType != 'Abuse') {
                    $postdata = CurbsidePostCollection::model()->getPostById($postId);
                    $description = $postdata->Description;
                }
            } elseif ((int) $categoryId == 3 || (int) $categoryId == 7) {
                $returnValue = GroupPostCollection::model()->abusePost($postId, $actionType, $userId, $isBlockedPost);
                if ($isBlockedPost != 0 && $actionType != 'Abuse') {
                    $postdata = GroupPostCollection::model()->getGroupPostById($postId);
                    $description = $postdata->Description;
                }
            } else {
                $returnValue = PostCollection::model()->abusePost($postId, $actionType, $userId, $isBlockedPost);
                if ($isBlockedPost != 0 && $actionType != 'Abuse') {
                    $postdata = PostCollection::model()->getPostById($postId);
                    $description = $postdata->Description;
                }
            }
            try {
                if ($isBlockedPost != 0 && $actionType != 'Abuse') {
                    $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
                    $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($description), $abuseWords);
                    foreach ($matchedElements as $blockWord) {
                        AbuseKeywords::model()->PopBlockedPost($blockWord, $postId, $categoryId, $networkId);
                    }
                }
                $abuseBean = new PostManagementActionBean();
                $abuseBean->PostId = $postId;
                $abuseBean->ActionType = $actionType;
                $abuseBean->CatagoryId = $categoryId;
                $abuseBean->NetworkId = $networkId;
                $abuseBean->UserId = $userId;
                $abuseBean->IsBlockedWordExist = $isBlockedPost;
                Yii::app()->amqp->stream(json_encode($abuseBean));
            } catch (Exception $ex) {
                Yii::log("in abuse service stream" . $ex->getMessage(), 'error', 'application');
                $returnValue = 'success';
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
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
    public function promotePost($postId, $userId, $promoteDate, $categoryId, $networkId) {
        try {
            $returnValue = "failure";
            $promoteDate = strtotime(DateTime::createFromFormat(Yii::app()->params['PHPDateFormat'], $promoteDate)->format("d-m-Y") . "+1 days") - 1;
            $promoteDate = date('Y-m-d H:i:s', $promoteDate);            
            //$promoteDate = CommonUtility::convert_time_zone(strtotime($promoteDate), date_default_timezone_get(), Yii::app()->session['timezone']);            
            if ((int) $categoryId == 2) {
                $returnValue = CurbsidePostCollection::model()->promotePost($postId, $userId, $promoteDate);
            } elseif ((int) $categoryId == 3 || (int) $categoryId == 7) {
                $returnValue = GroupPostCollection::model()->promotePost($postId, $userId, $promoteDate);
            } elseif ((int) $categoryId == 9) {
                $returnValue = GameCollection::model()->promoteGame($postId, $userId, $promoteDate);
            } else {
                $returnValue = PostCollection::model()->promotePost($postId, $userId, $promoteDate);
            }
            try {
                $promoteBean = new PostManagementActionBean();
                $promoteBean->PostId = $postId;
                $promoteBean->ActionType = 'Promote';
                $promoteBean->CatagoryId = $categoryId;
                $promoteBean->NetworkId = $networkId;
                $promoteBean->UserId = $userId;
                $promoteBean->PromotedDate = $promoteDate;

                Yii::app()->amqp->stream(json_encode($promoteBean));
            } catch (Exception $ex) {
                Yii::log("in promote service stream" . $ex->getMessage(), 'error', 'application');
                $returnValue = 'success';
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
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
    public function deletePost($postId, $categoryId, $networkId) {
        try {
            $returnValue = "failure";
            if ((int) $categoryId == 2) {
                $returnValue = CurbsidePostCollection::model()->deletePost($postId);
            } elseif ((int) $categoryId == 3 || (int) $categoryId == 7) {
                $returnValue = GroupPostCollection::model()->deletePost($postId);
            } elseif ((int) $categoryId == 9) {
                $returnValue = GameCollection::model()->deletePost($postId);
            } else {
                $returnValue = PostCollection::model()->deletePost($postId);
            }
            if ((int) $categoryId == 2) {
                $postObj = CurbsidePostCollection::model()->getPostById($postId);
                if ($postObj->IsFeatured == 1) {
                    NewsCollection::model()->updateNewsCollection($postId, $categoryId, 'Delete');
                }
            } else if ((int) $categoryId == 1) {
                $postObj = PostCollection::model()->getPostById($postId);
                if ($postObj->IsFeatured == 1) {
                    NewsCollection::model()->updateNewsCollection($postId, $categoryId, 'Delete');
                }
            } else if ((int) $categoryId == 9) {
                $postObj = GameCollection::model()->getGameDetailsObject('Id', $postId);
                if ($postObj->IsFeatured == 1) {
                    NewsCollection::model()->updateNewsCollection($postId, $categoryId, 'Delete');
                }
            }
            try {
                $deleteBean = new PostManagementActionBean();
                $deleteBean->PostId = $postId;
                $deleteBean->ActionType = 'Delete';
                $deleteBean->CatagoryId = $categoryId;
                $deleteBean->NetworkId = $networkId;
                Yii::app()->amqp->stream(json_encode($deleteBean));
            } catch (Exception $ex) {
                Yii::log("in delete service stream" . $ex->getMessage(), 'error', 'application');
                $returnValue = 'success';
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Karteek V
     * @param type $postId
     * @return type
     */
    public function getPostObjectById($postId) {
        try {
            $object = PostCollection::model()->getPostById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    /**
     * @author Vamsi Krishna
     * @Description This method is used to get the Group Members count in GroupDetail page
     * @param type $postId
     * @param type $resource
     * @param type $userId     
     * @return  success =>Array failure =>string 
     */
    public function getGroupMembersCount($groupId, $category) {
        try {
            $returnValue = 0;
            if ($category == 'Group') {
                $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
                if (count($groupObj->GroupMembers) > 0) {
                    $returnValue = count($groupObj->GroupMembers);
                }
            } else {
                $groupObj = SubGroupCollection::model()->getSubGroupDetailsById($groupId);
                if (count($groupObj->SubGroupMembers) > 0) {
                    $returnValue = count($groupObj->SubGroupMembers);
                }
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function getImagesAndArtifacts($groupId, $pageSize, $page, $type, $category = '') {
        try {
            if ($type == 'Image') {
                $artifacts = array("jpg", "jpeg", "gif", "mov", "mp4", "avi", "flv", "mp3", "png");
            } else {
                $artifacts = array("txt", "doc", "pdf", "ppt", "xls", "docx", "pptx", "xlsx", "DOCX", "PPTX", "XLS", "PDF", "DOC", "DOCX", "PDF", "TXT", "XLSX");
            }
            if ($category == 'Group') {
                $provider = new EMongoDocumentDataProvider('ResourceCollection', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => array('GroupId' => array('==' => new MongoID($groupId)), 'Extension' => array('in' => $artifacts), 'IsDeleted' => array('==' => 0), 'SubGroupId' => array('==' => 0),),
                        'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                    )
                ));
            } else {
                $provider = new EMongoDocumentDataProvider('ResourceCollection', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => array('SubGroupId' => array('==' => new MongoID($groupId)), 'Extension' => array('in' => $artifacts), 'IsDeleted' => array('==' => 0)),
                        'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC)
                    )
                ));
            }


            if ($provider->getTotalItemCount() == 0) {
                $stream = 0; //No posts
            } else if ($page <= ceil($provider->getTotalItemCount() / $pageSize)) {
                $stream = (object) ($provider->getData());
            } else {
                $stream = -1; //No more posts
            }

            return $stream;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Vamsi Krishna
     * @Description This method is used to get the ArtifactDetails in group detail page
     * @param type $postId
     * @param type $resource
     * @param type $userId     
     * @return  success =>Array failure =>string 
     */
    public function getArtifactDetails($postId, $resource, $userId) {
        try {
            $postDetails = GroupPostCollection::model()->getGroupPostById($postId);

            $postDetailBean = new PostDetailBean();
            $postDetailBean->PostDescription = $postDetails->Description;
            $postDetailBean->PostCreatedUserId = $postDetails->UserId;
            CommonUtility::styleDateTime($postDetails->CreatedOn->sec);
            $postDetailBean->CreatedOn = CommonUtility::styleDateTime($postDetails->CreatedOn->sec);
            $postDetailBean->PostId = $postDetails->_id;
            $userDetails = UserCollection::model()->getTinyUserCollection($postDetails->UserId);
            $postDetailBean->DisplayName = $userDetails->DisplayName;
            $postDetailBean->ProfilePicture = $userDetails->ProfilePicture;
            $postDetailBean->profile250x250 = $userDetails->profile250x250;
            $postDetailBean->profile70x70 = $userDetails->profile70x70;
            $postDetailBean->profile45x45 = $userDetails->profile45x45;
            $postDetailBean->UniqueHandle = $userDetails->uniqueHandle;
            $postDetailBean->NetworkId = $userDetails->NetworkId;

            $postDetailBean->PostType = $postDetails->Type;
            $postDetailBean->CommentCount = count($postDetails->Comments);
            $postDetailBean->FollowCount = count($postDetails->Followers);
            $PostTextLength = strlen($postDetails->Description);


            if (is_int($postDetails->SubGroupId)) {
                $postDetailBean->CategoryType = CommonUtility::getIndexBySystemCategoryType('Group');
            } else {
                $postDetailBean->CategoryType = CommonUtility::getIndexBySystemCategoryType('SubGroup');
            }
            if (isset($PostTextLength) && $PostTextLength > 240) {
                $appendData = ' <span class="postdetail tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $postId . '" data-categoryType="' . $postDetailBean->CategoryType . '" data-postType="' . $postDetails->Type . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
            }
            if (isset($PostTextLength) && ($PostTextLength > 240)) {
                $description = CommonUtility::truncateHtml($postDetails->Description, 240);
                $text = $description . $appendData;
                $postDetailBean->PostDescription = $text;
            } else {

                $postDetailBean->PostDescription = $postDetails->Description;
            }

            $comments = $postDetails->Comments;
            $extension = substr(strrchr($resource, '.'), 1);
            $extension = strtolower($extension);
            if ($extension == 'pdf') {
                $postDetailBean->Resource = '/images/system/pdf.png';
                $postDetailBean->ResourceUri = $resource;
            } else if ($extension == 'doc' || $extension == 'docx') {
                $postDetailBean->Resource = '/images/system/MS-Word-2-icon.png';
                $postDetailBean->ResourceUri = $resource;
            } else if ($extension == 'ppt' || $extension == 'pptx') {
                $postDetailBean->Resource = '/images/system/PPT-File-icon.png';
                $postDetailBean->ResourceUri = $resource;
            } else if ($extension == 'xls' || $extension == 'xlsx') {
                $postDetailBean->Resource = '/images/system/Excel-icon.png';
                $postDetailBean->ResourceUri = $resource;
            } else if ($extension == 'mov' || $extension == 'mp4' || $extension == 'flv') {
                $postDetailBean->Resource = '/images/system/video_img.png';
                $postDetailBean->ResourceUri = $resource;
            } else if ($extension == 'mp3') {
                $postDetailBean->Resource = '/images/system/audio_img.png';
                $postDetailBean->ResourceUri = $resource;
            } else if ($extension == 'txt') {
                $postDetailBean->Resource = '/images/system/notepad-icon.png';
                $postDetailBean->ResourceUri = $resource;
            } else {
                $postDetailBean->Resource = $resource;
                $postDetailBean->ResourceUri = $resource;
            }

            $postDetailBean->Extension = $extension;
            $commentCount = count($comments);
            $commentsArray = array();

            if ($commentCount > 0) {
                $maxDisplaySize = $commentCount > 2 ? 2 : $commentCount;
                for ($j = $commentCount; $j > $commentCount - $maxDisplaySize; $j--) {
                    $comment = $comments[$j - 1];
                    $commentedUser = UserCollection::model()->getTinyUserCollection($comment["UserId"]);
                    $comment["CreatedOn"] = $comment["CreatedOn"];
                    $textWithOutHtml = strip_tags($comment["CommentText"]);


                    if (isset($comment["CommentTextLength"]) && $comment["CommentTextLength"] > 240) {

                        $appendData = ' <span class="postdetail"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $postId . '" data-categoryType="' . $postDetailBean->CategoryType . '" data-postType="' . $postDetailBean->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                    }
                    if (isset($comment["CommentTextLength"]) && ($comment["CommentTextLength"] == 240 || $comment["CommentTextLength"] > 240)) {
                        $description = CommonUtility::truncateHtml($comment["CommentText"], 240);
                        // $text = $description. $appendData;
                        // $comment["CommentText"]= $text.$appendData;
                        $comment["CommentText"] = $comment["CommentText"] . $appendData;
                    }
                    $comment['ProfilePicture'] = $commentedUser['ProfilePicture'];
                    $commentCreatedOn = $comment["CreatedOn"];
                    $comment["CreatedOn"] = CommonUtility::styleDateTime($commentCreatedOn->sec);
                    $comment["DisplayName"] = $commentedUser['DisplayName'];
                    $image = "";
                    $comment['resourceLength'] = 0;
                    if (sizeof($comment["Artifacts"]) > 0) {
                        $comment['resourceLength'] = count($comment["Artifacts"]);
                        foreach ($comment["Artifacts"] as $artifact)
                            $image = $artifact["ThumbNailImage"];
                    }
                    $comment["ArtifactIcon"] = $image;
                    array_push($commentsArray, $comment);
                }
            }

            $postDetailBean->CommentsArray = $commentsArray;
            $postDetailBean->LoveCount = count($postDetails->Love);
            $postDetailBean->IsFollowingPost = in_array($userId, $postDetails->Followers);
            $postDetailBean->IsLoved = in_array($userId, $postDetails->Love);
            $postDetailBean->DisableComments = $postDetails->DisableComments;
            $commentedUsers = $this->getCommentedUsersForPost($postId, $userId);
            $IsUserCommented = in_array((int) $userId, $commentedUsers);
            $postDetailBean->IsCommented = $IsUserCommented;
            $groupDetails = GroupCollection::model()->getGroupDetailsById($postDetails->GroupId);

            $postDetailBean->IsPrivate = $groupDetails->IsPrivate;
            $postDetailBean->GroupId = $postDetails->GroupId;
            return $postDetailBean;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Vamsi Krishna
     * @Description This method is used to get the comments for each post with page size and also by vategory Type
     * @param type $postId
     * @param type $pageSize
     * @param type $page
     * @param type $categoryType     
     * @return  success =>Array failure =>string 
     */
    public function getCommentsforPost($pageSize, $page, $postId, $categoryType) {
        try {
            $returnValue = 'failure';
            $resultarray = array();
            if ($categoryType == 1) {
                $comments = PostCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 2) {
                $comments = CurbsidePostCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 3 || $categoryType == 7) {
                $comments = GroupPostCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 8) {
                $comments = CuratedNewsCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 9) {
                $comments = GameCollection::model()->getGameCommentsByPostId($postId);
            }
            else if ($categoryType == 10) {
                $comments = UserBadgeCollection::model()->getPostCommentsByPostId($postId);
            }else if ($categoryType == 12) {
                $comments = UserCVPublicationsCollection::model()->getPostCommentsByPostId($postId);
            }
            if (is_array($comments)) {
                $resultarray = array_reverse($comments);
                $returnValue = array_slice($resultarray, $pageSize, $page);
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Karteek V
     * @param type $postId
     * @return type
     */
    public function getCurbsidePostObjectById($postId) {
        try {
            $object = CurbsidePostCollection::model()->getPostById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    /**
     * @author Karteek V
     * @param type $postId
     * @return type
     */
    public function getGroupPostObjectById($postId) {
        try {
            $object = GroupPostCollection::model()->getGroupPostById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    /**
     * @author karteek v
     * @param $postId,$CategoryType
     * @return type
     */
    public function getCommentObject($postId, $CategoryType) {
        try {
            if ((int) $CategoryType == 2) {
                $object = CurbsidePostCollection::model()->getGroupPostById($postId);
            } elseif ($CategoryType == 3 || $CategoryType == 7) {
                $object = GroupPostCollection::model()->getPostById($postId);
            } else {
                $object = PostCollection::model()->getPostById($postId);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    /**
     * @author Vamsi Krishna
     * @description this method is used to save User Activity for comment to any post
     * @param 
     */
    public function saveUserActivityForComment($commentObj, $NetworkId, $CategoryType, $commentBean, $postObj) {
        try {

            $streamObj = new UserStreamBean();
            $streamObj->UserId = $commentObj->UserId;
            $streamObj->StreamNote = 'commented';
            $streamObj->RecentActivity = 'comment';
            $streamObj->PostId = (String) $commentObj->PostId;
            $streamObj->CommentUserId = (int) $commentObj->UserId;
            $streamObj->NetworkId = (int) $NetworkId;
            $streamObj->Comments = $commentBean;
            $streamObj->PostType = (int) $commentObj->PostType;
            ;
            $streamObj->ActionType = "Comment";
            $streamObj->CategoryType = (int) $CategoryType;
            $streamObj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('');

            //$streamObj->OriginalPostTime=strtotime(date('Y-m-d H:i:s',  $postObj->CreatedOn->sec));

            $streamObj->PostText = $postObj->Description;
            $streamObj->PostType = $postObj->Type;

            $streamObj->IsMultiPleResources = count($postObj->Resource);
            if (sizeof($postObj->Resource) != 0) {
                $streamObj->Resource = $postObj->Resource[0];
            }
            $streamObj->OriginalUserId = (int) $postObj->UserId;
            $streamObj->LoveCount = (int) count($postObj->Love);
            $streamObj->CommentCount = (int) count($postObj->Comments);
            $streamObj->FollowCount = (int) count($postObj->Followers);
            $streamObj->InviteCount = (int) count($postObj->Invite);
            $streamObj->ShareCount = (int) count($postObj->Share);
            if ($CategoryType == 3 || $CategoryType == 7) {
                $groupPostDetails = GroupPostCollection::model()->getGroupPostById($commentObj->PostId);
                if ($CategoryType == 7) {
                    $streamObj->SubGroupId = $groupPostDetails->SubGroupId;
                }
                $streamObj->GroupId = $groupPostDetails->GroupId;
            }
            if ($CategoryType == 2) {
                $curbsidePostDetails = CurbsidePostCollection::model()->getPostById($commentObj->PostId);
                $streamObj->CurbsideConsultCategory = $curbsidePostDetails->CategoryId;
            }
            if ((int) $postObj->Type == 2) {
                $streamObj->EventAttendes = $postObj->UserId;
                $streamObj->StartDate = $postObj->StartDate;
                $streamObj->EndDate = $postObj->EndDate;
                $streamObj->StartTime = $postObj->StartTime;
                $streamObj->EndTime = $postObj->EndTime;
                $streamObj->Location = $postObj->Location;
            }
            if ((int) $postObj->Type == 3) {
                $streamObj->OptionOne = $postObj->OptionOne;
                $streamObj->OptionTwo = $postObj->OptionTwo;
                $streamObj->OptionThree = $postObj->OptionThree;
                $streamObj->OptionFour = $postObj->OptionFour;
                $streamObj->ExpiryDate = $postObj->ExpiryDate;
                $streamObj->OptionOneCount = $postObj->OptionOneCount;
                $streamObj->OptionTwoCount = $postObj->OptionOneCount;
                $streamObj->OptionThreeCount = $postObj->OptionOneCount;
                $streamObj->OptionFourCount = $postObj->OptionOneCount;
            }

            try {
                Yii::app()->amqp->stream(json_encode($streamObj));
            } catch (Exception $ex) {
                Yii::log("exception occur while in savign comment" . $ex->getMessage(), 'error', 'application');
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * @author suresh reddy updated by suresh add id fiedls
     * @param type $id
     * @param type $postId
     * @param type $categoryType
     * @return type
     */
    public function updateDerivateObjectPriority($id, $postId, $userId) {
        try {
            $returnValue = 'failure';
            FollowObjectStream::model()->updateDerivateiveObjectPriority($id, $postId, $userId);
            return 1;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return 0;
        }
    }

    /**
     * @Author Sagar Pathapelli
     * This method is used get getFollowingFollowerUsersForInvie
     * @param type $searchKey
     * @param type $userId
     * @return type
     */
    public function getFollowingFollowerUsersForInvite($searchKey, $userId, $postId, $categoryType, $mentionArray = array()) {
        $userDetails = 'failure';
        try {
            if (sizeof($mentionArray) > 0) {
                $mentionArray = array_map('intval', $mentionArray);
            }
            $users = UserProfileCollection::model()->getUserFollowersAndFollowingsById($userId);
            if (sizeof($mentionArray) > 0) {
                $users = array_diff($users, $mentionArray);
            }
            $invitedUsers = $this->getInvitedUsersForPost($postId, $categoryType);
            if (is_array($invitedUsers) && sizeof($invitedUsers) > 0) {
                $users = array_diff($users, $invitedUsers);
            }
            array_unique($users);
            $pos = array_search($userId, $users);
            if (is_int($pos) && $pos >= 0) {
                unset($users[$pos]);
            }
            $userDetails = UserCollection::model()->getFollowingFollowerUsers($searchKey, $users);
        } catch (Exception $ex) {
            Yii::log("getFollowingFollowerUsers in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $userDetails;
    }

    public function getInvitedUsersForPost($postId, $categoryType) {
        $invitedUsers = array();
        try {
            $users = array();
            if ($categoryType == 2) {
                $users = CurbsidePostCollection::model()->getInvitedUsersForPost($postId);
            } elseif ($categoryType == 3) {
                $users = GroupPostCollection::model()->getInvitedUsersForPost($postId);
            } elseif ($categoryType == 8) {
                $users = CuratedNewsCollection::model()->getInvitedUsersForPost($postId);
            } elseif ($categoryType == 9) {
                $users = GameCollection::model()->getInvitedUsersForPost($postId);
            } elseif ($categoryType == 12) {
                $users = UserCVPublicationsCollection::model()->getInvitedUsersForPost($postId);
            }  else {
                $users = PostCollection::model()->getInvitedUsersForPost($postId);
            }
            if (is_array($users) && sizeof($users) > 0) {
                foreach ($users as $key => $user) {
                    $intArray = array_map('intval', $user[1]);
                    $invitedUsers = array_merge($invitedUsers, $intArray);
                }
            }
        } catch (Exception $ex) {
            Yii::log("getInvitedUsersForPost in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
            return "failure";
        }
        return $invitedUsers;
    }

    /**
     * @author Sagar Pathapelli
     * @param type $storeId (it is a networkId)
     * @param type $type (Region / Division / District)
     * @return type
     */
    public function getStoresByType($storeId, $type) {
        try {
            $returnValue = 'failure';
            $stores = array();
            if ($type == "Region") {
                $regionId = Store::model()->getRegionByStore($storeId);
                if (is_int($regionId)) {
                    $stores = Store::model()->getStoresByRegion($regionId);
                }
            } elseif ($type == "Division") {
                $divisionId = Store::model()->getDivisionByStore($storeId);
                if (is_int($divisionId)) {
                    $stores = Store::model()->getStoresByDivision($divisionId);
                }
            } elseif ($type == 'District') {
                $districtId = Store::model()->getDistrictByStore($storeId);
                if (is_int($districtId)) {
                    $stores = Store::model()->getStoresByDistrict($districtId);
                }
            }
            $returnValue = $stores;
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author karteek v
     * @param $notificationId
     * @return type string
     */
    public function updateNotificationAsRead($notificationId) {
        try {
            $result = Notifications::model()->updateNotificationAsRead($notificationId);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
        }
        return $result;
    }

    /**
     * @author Karteek V
     * @param type $userId
     * @return type string
     */
    public function updateAllNotificationsByUserId($userId) {
        try {
            $result = Notifications::model()->updateAllNotificationsByUserId($userId);
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
        }
        return $result;
    }

    /**
     * @author suresh reddyg  
     * @usage generic hashtag save and follow who is created by
     * @param type $userId
     * @return type string
     */
    public function saveHashTags($userId, $hashTagArray, $from = '', $postType = '', $category = '', $id = "", $createdon = '') {
        try {
           
            $hashTagIdArray = array();
            if (isset($hashTagArray)) {
                foreach ($hashTagArray as $hashTagName) {
                    $hashtagObj = HashTagCollection::model()->getHashTags($hashTagName);
                    if ($hashtagObj == 'noHashTag') {
                        $hashTag = new HashTagCollection();
                        $hashTag->HashTagName = $hashTagName;
                        $hashTag->CreatedUserId = (int) $userId;
                        $hashTagId = HashTagCollection::model()->saveHashTags($hashTag);
                        if ($from == "Post") {
                            $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashTagCreation");
                            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("PostHashTagCreation");
                            UserInteractionCollection::model()->saveHashTagCreationActivity($from, $category, $postType, $userId, $hashTagId, $hashTagName, $activityIndex, $activityContextIndex, $id, $createdon);
                        }
                        if ($from == "Group" || $from == "SubGroup") {
                          
                            $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashTagCreation");
                            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("GroupHashTagCreation");
                            UserInteractionCollection::model()->saveHashTagCreationActivity($from, $category, $postType, $userId, $hashTagId, $hashTagName, $activityIndex, $activityContextIndex, $id, $createdon);
                        }
                        if ($from == "Comment") {
                            $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashTagCreation");
                            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CommentHashTagCreation");
                            UserInteractionCollection::model()->saveHashTagCreationActivity($from, $category, $postType, $userId, $hashTagId, $hashTagName, $activityIndex, $activityContextIndex, $id, $createdon);
                        }
                        UserProfileCollection::model()->followUnFollowHashTag($hashTagId, $userId, "Follow");
                        $CategoryType = CommonUtility::getIndexBySystemCategoryType('HashTag');
                        $FollowEntity = CommonUtility::getIndexBySystemFollowingThing('HashTag');
                        CommonUtility::prepareStreamObjectForFollowEntity($userId, "Follow", $hashTagId, (int) $CategoryType, $FollowEntity, $createdDate);
                        array_push($hashTagIdArray, $hashTagId);
                    } else {

                        foreach ($hashtagObj as $hash) {
                            if ($from == "Post") {
                                $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashtagUsed");
                                $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("PostHashTagUsed");
                                UserInteractionCollection::model()->saveHashTagCreationActivity($from, $category, $postType, $userId, $hash->_id, $hash->HashTagName, $activityIndex, $activityContextIndex, $id, $createdon);
                            }
                            if ($from == "Group" || $from == "SubGroup") {
                                $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashtagUsed");
                                $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("GroupHashTagUsed");
                                UserInteractionCollection::model()->saveHashTagCreationActivity($from, $category, $postType, $userId, $hash->_id, $hash->HashTagName, $activityIndex, $activityContextIndex, $id, $createdon);
                            }
                            if ($from == "Comment") {
                                $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashtagUsed");
                                $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CommentHashTagUsed");
                                UserInteractionCollection::model()->saveHashTagCreationActivity($from, $category, $postType, $userId, $hash->_id, $hash->HashTagName, $activityIndex, $activityContextIndex, $id, $createdon);
                            }
                            array_push($hashTagIdArray, $hash->_id);
                        }
                    }
                }
            }
            return $hashTagIdArray;
        } catch (Exception $ex) {
            error_log($ex->getMessage() . "----------error", 'error', 'application');
            return array();
        }
    }

    /**
     * @author Moin Hussain
     * @param $searchText,$offset,$pageLength
     * @return type PostCollections
     */
    public function getPostsForSearch($searchText, $offset, $pageLength) {
        return PostCollection::model()->getPostsForSearch($searchText, $offset, $pageLength);
    }

    /**
     * @author Moin Hussain
     * @param $searchText,$offset,$pageLength
     * @return type CurbsidePostCollections
     */
    public function getCurbPostsForSearch($searchText, $offset, $pageLength) {
        return CurbsidePostCollection::model()->getCurbPostsForSearch($searchText, $offset, $pageLength);
    }

    /**
     * @author Moin Hussain
     * @param $searchText,$offset,$pageLength
     * @return type Posts with hash tags
     */
    public function getPostsForHashtag($hashtagId, $offset, $pageLength, $userId) {
        $posts = PostCollection::model()->getPostsForHashtag($hashtagId, $offset, $pageLength);
        $curbPosts = CurbsidePostCollection::model()->getCurbPostsForHashtag($hashtagId, $offset, $pageLength);
        $GroupPosts = GroupPostCollection::model()->getGroupPostsForHashtag($hashtagId, $offset, $pageLength, $userId);
        return array_merge($posts, $curbPosts, $GroupPosts);
    }

    /**
     * @author Vamsi Krishna
     * description This method is used to mark post as featured
     * @param postID Mongo Id
     * @param catetogyType 
     * 
     */
    public function updatePostAsFeatured($userId, $postId, $categoryId, $networkId,$title) {
        try {
            $returnValue = 'failure';
            if ($categoryId == 1) {
                $returnValue = PostCollection::model()->markPostAsFeatured($postId, $userId);
            }
            if ($categoryId == 2) {
                $returnValue = CurbsidePostCollection::model()->markPostAsFeatured($postId, $userId);
            }

            if ($categoryId == 8) {
                $returnValue = CuratedNewsCollection::model()->markPostAsFeatured($postId, $userId);
            }
            if ($categoryId == 9) {
                $returnValue = GameCollection::model()->markGameAsFeatured($postId, $userId);
            }
            $this->saveNewsCollection($postId, $categoryId,$title);
            $streamBean = new PostManagementActionBean();
            $streamBean->PostId = $postId;
            $streamBean->ActionType = 'Featured';
            $streamBean->CatagoryId = $categoryId;
            $streamBean->NetworkId = $networkId;
            $streamBean->IsFeatured = 1;
            $streamBean->UserId = $userId;
            Yii::app()->amqp->stream(json_encode($streamBean));
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    /**
     * @author Vamsi krishna     
     * This method gets the featured posts
     * 
     */
    public function getFeaturedPosts() {
        $returnValue = 'failure';

        $featuredItems = array();
        try {
            $featuredItemsCount = NewsCollection::model()->getTotalFeaturedItems();
            $provider = new EMongoDocumentDataProvider('NewsCollection', array(
                'pagination' => array('pageSize' => $featuredItemsCount),
                'criteria' => array(
                    'conditions' => array('IsFeatured' => array('==' => 1), 'IsAbused' => array('==' => (int) 0), 'IsDeleted' => array('==' => (int) 0), 'IsBlockedWordExist' => array('==' => (int) 0)),
                    'sort' => array('FeaturedOn' => EMongoCriteria::SORT_DESC)
                ),
            ));
            if ($provider->getTotalItemCount() != 0) {
                foreach ($provider->getData() as $data) {
                    $featuredDisplayBean = new StreamPostDisplayBean();
                    $featuredDisplayBean->PostId = $data->PostId;
                    $featuredDisplayBean->PostText = $data->Description;
                    $featuredDisplayBean->PostType = $data->Type;
                    $featuredDisplayBean->CategoryType = $data->CategoryType;
                    $featuredDisplayBean->FirstUserDisplayName = $data->Title;
                    $featuredDisplayBean->Type = $data->IsMultipleArtifact;
                    if ($data->Resource != '' || !empty($data->Resource)) {
                        if ($data->CategoryType == 9) {
                            $featuredDisplayBean->ArtifactIcon = $data->Resource;
                        } else if (isset($data->Resource["Extension"])) {
                            $filetype = strtolower($data->Resource["Extension"]);
                            if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png') {
                                $featuredDisplayBean->ArtifactIcon = $data->Resource["Uri"];
                            } else if ($filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv') {
                                $featuredDisplayBean->ArtifactIcon = "/images/system/video_img.png";
                            } else if ($filetype == 'mp3') {
                                $featuredDisplayBean->ArtifactIcon = "/images/system/audio_img.png";
                            } else {
                                $tinyUserObj = UserCollection::model()->getTinyUserCollection($data->UserId);
                                $featuredDisplayBean->ArtifactIcon = $tinyUserObj['ProfilePicture'];
                            }
                        }
                    } else if ($data->HtmlFragment != '' || !empty($data->HtmlFragment)) {
                        $html = $data->HtmlFragment;
                        $present = stristr($html, 'img');
                           if ($present != '') {
                           preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', $html, $image);
                            $data = parse_url(substr($image['src'], 0, strpos($image['src'], "'")));
                            $img= $data['scheme'] . "://" . $data['host'] . $data['path'];
                            $supported_image = array('gif', 'jpg', 'jpeg', 'png', 'tiff');
                            $src_file_name = $img;
                            $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
                            if (in_array($ext, $supported_image)) {
                               $featuredDisplayBean->ArtifactIcon = $data['scheme'] . "://" . $data['host'] . $data['path']; 
                            } else {
                                $featuredDisplayBean->ArtifactIcon = $data['scheme'] . "://" . $data['host'] . $data['path'] . "?" . $data['query'];
                            }
                        } else {
                            $tinyUserObj = UserCollection::model()->getTinyUserCollection($data->UserId);
                            $featuredDisplayBean->ArtifactIcon = $tinyUserObj['ProfilePicture'];
                        }
                    } else {
                        $tinyUserObj = UserCollection::model()->getTinyUserCollection($data->UserId);
                        if ($data['Type'] == 4) {
                            $featuredDisplayBean->ArtifactIcon = Yii::app()->params['SYSTEM_URL'] . "/upload/profile/user_noimage.png";
                        } else {
                            $featuredDisplayBean->ArtifactIcon = $tinyUserObj['ProfilePicture'];
                        }
                    }
                    array_push($featuredItems, $featuredDisplayBean);
                }
                $returnValue = $featuredItems;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function saveNewsCollection($postId, $categoryId,$title="") {
        try {

            if ((int) $categoryId == 2) {
                $postObj = CurbsidePostCollection::model()->getPostById($postId);
            } else if ((int) $categoryId == 8) {
                $postObj = CuratedNewsCollection::model()->getPostById($postId);
            } else if ((int) $categoryId == 9) {
                $postObj = GameCollection::model()->getPostById($postId);
            } else {
                $postObj = PostCollection::model()->getPostById($postId);
            }

            $newsCollection = new NewsCollection();
            $newsCollection->UserId = $postObj->UserId;
            $newsCollection->PostId = $postId;
            $newsCollection->Title = $title;
            $newsCollection->Type = $postObj->Type;
            $newsCollection->CategoryType = $categoryId;
            $newsCollection->IsFeatured = $postObj->IsFeatured;
            $newsCollection->NetworkId = $postObj->NetworkId;
            $newsCollection->IsBlockedWordExist = $postObj->IsBlockedWordExist;
            if ($categoryId == 9) {
                $descriptionLength = strlen(preg_replace('/<.*?>/', '', $postObj->GameDescription));
            } else {
                $descriptionLength = strlen(preg_replace('/<.*?>/', '', $postObj->Description));
            }

            if ($descriptionLength <= '500') {

                $length = '500';
            } else {

                $length = '240';
            }
            // $description=$this->truncateHtml($postObj->Description,$length);
            if ($categoryId == 9) {
                $description = CommonUtility::truncateHtml($postObj->GameDescription, $length);
            } else {
                $description = CommonUtility::truncateHtml($postObj->Description, $length);
            }

            if ((int) $categoryId == 8) {
                $newsCollection->HtmlFragment = $postObj->HtmlFragment;
            }
            $newsCollection->Description = $description;
            $newsCollection->FeaturedOn = $postObj->FeaturedOn;
            $newsCollection->FeaturedUserId = $postObj->FeaturedUserId;
            if ((int) $categoryId == 9) {
                $newsCollection->Resource = $postObj->GameBannerImage;
            } else {
                if (sizeof($postObj->Resource) == 0) {
                    $newsCollection->Resource = '';
                } else {
                    $newsCollection->Resource = $postObj->Resource[0];
                }
            }

            $newsCollection->IsMultipleArtifact=sizeof($postObj->Resource);

            $returnValue = NewsCollection::model()->saveNewsCollection($newsCollection);
            if ($returnValue == "failure") {
                return FALSE;
            } else {
                return TRUE;
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return FALSE;
        }
    }

    public function saveArtifacts($Artifacts, $postType, $category) {
        try {
            $returnValue = 'failure';
            $folder=Yii::app()->params['WebrootPath'];
            $returnarry = array();
            if ($Artifacts > 0) {
                foreach ($Artifacts as $key => $artifact) {            
if($artifact!=""){    
                    $imgArr = explode(".", $artifact);
                   
                    $date = strtotime("now");
                     if($imgArr[0]==end($imgArr)){
                        
                          $finalImg_name = $imgArr[0] . '.jpg';
                       $finalImage = trim($imgArr[0]) . '.jpg';
                         $fileNameTosave = $folder . '/temp/' .$artifact;
                         $extension = "jpg";
                    }else{
                       
                         $finalImg_name = $imgArr[0] . '.' . end($imgArr);
                    $finalImage = trim($imgArr[0]) . '.' . end($imgArr); 
                       $fileNameTosave = $folder . '/temp/' . $imgArr[0] . '.' . end($imgArr);
                         $extension = substr(strrchr($artifact, '.'), 1);
                    $extension = strtolower($extension);
                    }
                  
                   
                    $sourceArtifact = $folder . '/temp/' . $artifact;
                    rename($sourceArtifact, $fileNameTosave);
                    //  $filename=$result['filename'];
                    if ($extension == 'mp4' || $extension == 'mp3' || $extension == 'avi') {
                        $ext = "video";
                        $path = 'video';
                    } else if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'tiff' || $extension == 'png') {
                        $path = 'images';
                    } else {
                        $path = 'other';
                    }
                    
                    $postType = (int) $postType;
                    $category = (int) $category;
if ($category == 1 || $category == 2 || $category == 8 || $category == 9 || $category==10 || $category==12) {
                        if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4 || $postType == 5 || $postType == 11 || $postType == 12 ||$postType == 13 ||$postType == 15) {
                            $path = '/upload/public/' . $path;
                        }
                    } else if ($category == 3 || $category == 7) {
                        if ($postType == 1 || $postType == 2 || $postType == 3 || $postType == 4 || $postType == 5) {
                            $path = '/upload/group/' . $path;
                        }
                    }
                    if (!file_exists($folder . '/' . $path)) {                        
                        mkdir($folder . '/' . $path, 0755, true);                        
                    }
                    $sourcepath = $fileNameTosave;
                    $destination = $folder . $path . '/' . $finalImage;
                    if (file_exists($sourcepath)) {
                        if (copy($sourcepath, $destination)) {                            
                             if($imgArr[0]==end($imgArr)){
                                $newfile = trim($imgArr[0]) . '_' . $date . '.jpg' ;  
                             }else{
                                 $newfile = trim($imgArr[0]) . '_' . $date . '.' . end($imgArr); 
                             }
                           // $newfile = trim($imgArr[0]) . '_' . $date . '.' . end($imgArr);
                            //  $newfile=trim($imgArr[0]) .'.' . $imgArr[1];
                            $finalSaveImage = $folder . $path . '/' . $newfile;
                                rename($destination, $finalSaveImage);
                            // unlink($sourcepath);

                            array_push($returnarry, $newfile);
                            $returnValue = "success";
                        } else {
                            error_log("=========error===copying a file=============");
                        }
                    }
                }
                }
            }
            return $returnarry;
        } catch (Exception $exc) {
            Yii::log("in save Resource for post service____________________" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar Pathapelli
     * This method is used to get the invited user list for a post
     */
    public function getInvitedUsersObjectForPost($postId, $categoryType) {
        $invitedUserObject = array();
        try {
            $invitedUsers = $this->getInvitedUsersForPost($postId, $categoryType);
            if (is_array($invitedUsers) && sizeof($invitedUsers) > 0) {
                foreach ($invitedUsers as $userId) {
                    $userDetails = UserCollection::model()->getTinyUserCollection($userId);
                    $invitedUserObject[$userDetails->UserId] = $userDetails->DisplayName;
                }
            } else {
                $invitedUserObject = 'failure';
            }
        } catch (Exception $ex) {
            Yii::log("getInvitedUsersObjectForPost in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
            return "failure";
        }
        return $invitedUserObject;
    }

    /**
     * @author Vamsi Krishna
     * Description: TO get all featured Items     * 
     */
    public function getAllFeaturedItems($page, $userId) {
        $returnValue = 'failure';
        $featuredItems = 0;
        $categoryType = 1;

        try {
            if (isset($page)) {
                $pageSize = 10;
                $provider = new EMongoDocumentDataProvider('FeaturedItemsBean', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => array(
                            'IsFeatured' => array('==' => (int) 1)
                        ),
                        'sort' => array('FeaturedOn' => EMongoCriteria::SORT_DESC)
                    )
                ));
                if ($provider->getTotalItemCount() == 0) {
                    $featuredItems = 0; //No posts
                } else if ($page <= ceil($provider->getTotalItemCount() / $pageSize)) {

                    $featuredItems = (object) (CommonUtility::prepareFeaturedPostData($userId, $provider->getData(), $categoryType));
                } else {
                    $featuredItems = -1; //No more posts
                }

                $returnValue = $featuredItems;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("__" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    /**
     * @author Vamsi Krishna
     * description This method is used to mark post as featured
     * @param postID Mongo Id
     * @param catetogyType 
     * 
     */
    public function updatePostAsUnFeatured($userId, $postId, $categoryId, $networkId) {
        try {
            $returnValue = 'failure';
            UserStreamCollection::model()->updateStreamForUnFeatured($postId, $categoryId);
            //update News collection
            NewsCollection::model()->updateNewsCollection($postId, $categoryId, 'UnFeatured');
            //update post collection 
            if ($categoryId == 1) {
                $returnValue = PostCollection::model()->UnmarkPostAsFeatured($postId);
            }
            if ($categoryId == 2) {
                $returnValue = CurbsidePostCollection::model()->UnmarkPostAsFeatured($postId);
            }
            if ($categoryId == 8) {
                $returnValue = CuratedNewsCollection::model()->UnmarkPostAsFeatured($postId);
            }
            // update UserStreamCollection

            return 'success';
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    /**
     * @author Haribabu
     * description This method is used to get recent 2 comments of the post
     * @param postID Mongo Id
     * @param catetogyType 
     * 
     */
    public function getRecentCommentsforPost($pageSize, $page, $postId, $categoryType) {
        try {
           
            $returnValue = 'failure';
            if ($categoryType == 1) {
                $comments = PostCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 2) {
                $comments = CurbsidePostCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 3 || $categoryType == 7) {
                $comments = GroupPostCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 8) {
                $comments = CuratedNewsCollection::model()->getPostCommentsByPostId($postId);
            } else if ($categoryType == 9) {
                $comments = GameCollection::model()->getGameCommentsByPostId($postId);
            }
            else if ($categoryType == 10) {
                $comments = UserBadgeCollection::model()->getPostCommentsByPostId($postId);
            }else if ($categoryType == 12) {                
                $comments = UserCVPublicationsCollection::model()->getPostCommentsByPostId($postId);
            }
            if (is_array($comments)) {
                $returnValue = $comments;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @author:Praneeth
     * @param type $model
     * @return $result
     * Checks whether the group exists or not
     */
    public function checkIfGroupExist($model) {
        try {
            $result = "";
            $result = GroupCollection::model()->checkIfGroupExist($model);
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfGroupExist exception===@@@@@@=======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

    public function getGroupIdByName($groupName) {
        try {
            $result = "";
            $result = GroupCollection::model()->getGroupIdByName($groupName);
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside checkIfGroupExist exception===@@@@@@=======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

    /**
     * @author Sagar
     * @usage blockOrReleaseComment
     * @param type $postId
     * @param type $commentId
     * @param type $categoryType
     * @param type $actionType
     * @param type $networkId
     * @return type
     */
    public function blockOrReleaseComment($postId, $commentId, $categoryType, $actionType, $networkId) {
        try {
            $returnValue = 'failure';
            $description = "";
            if ($categoryType == 1) {

                $returnValue = PostCollection::model()->blockOrReleaseComment($postId, $commentId, $actionType);
                $postdata = PostCollection::model()->getCommentById($postId, $commentId);
                $description = isset($postdata['CommentText']) ? $postdata['CommentText'] : "";
            } else if ($categoryType == 2) {
                $returnValue = CurbsidePostCollection::model()->blockOrReleaseComment($postId, $commentId, $actionType);
                $postdata = CurbsidePostCollection::model()->getCommentById($postId, $commentId);
                $description = isset($postdata['CommentText']) ? $postdata['CommentText'] : "";
            } else if ($categoryType == 3) {
                $returnValue = GroupPostCollection::model()->blockOrReleaseComment($postId, $commentId, $actionType);
                $postdata = GroupPostCollection::model()->getCommentById($postId, $commentId);
                $description = isset($postdata['CommentText']) ? $postdata['CommentText'] : "";
            }
            if ($description != "") {
                $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
                $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($description), $abuseWords);
                if (count($matchedElements) > 0) {
                    foreach ($matchedElements as $blockWord) {
                        AbuseKeywords::model()->PopBlockedComment($blockWord, $postId, $commentId, $categoryType, $networkId);
                    }
                }
                $commentBean = new CommentManagementActionBean();
                $commentBean->PostId = $postId;
                $commentBean->CommentId = $commentId;
                $commentBean->ActionType = "Comment" . $actionType;
                $commentBean->CatagoryId = $categoryType;
                $commentBean->NetworkId = $networkId;
                Yii::app()->amqp->stream(json_encode($commentBean));
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("________________________________________________" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    //}
    /**
     * @author Sagar
     * @usage Get Abuse Words With Weightage
     * @return array
     */
    public function getAbuseWordsWithWeightage() {
        try {
            $abuseWordsWithWeightage = array();
            $abuseWordCollection = AbuseKeywords::model()->getAbuseWordCollection();

            foreach ($abuseWordCollection as $abuseWordObj) {
                $abuseWordWeightage = array();
                $abuseWordWeightage['AbuseWord'] = $abuseWordObj->AbuseWord;
                $postBlockedByPost = array();
                if (isset($abuseWordObj->BlockedPosts) && count($abuseWordObj->BlockedPosts) > 0) {
                    foreach ($abuseWordObj->BlockedPosts as $blockedPost) {
                        array_push($postBlockedByPost, $blockedPost['PostId']);
                    }
                    $postBlockedByPost = array_unique($postBlockedByPost);
                }

                $postBlockedByComment = array();
                if (isset($abuseWordObj->BlockedComments) && count($abuseWordObj->BlockedComments) > 0) {
                    foreach ($abuseWordObj->BlockedComments as $blockedComment) {
                        array_push($postBlockedByComment, $blockedComment['PostId']);
                    }
                    $postBlockedByComment = array_unique($postBlockedByComment);
                }
                $blockedPostArray = array_unique(array_merge($postBlockedByPost, $postBlockedByComment));
                $abuseWordWeightage['Weightage'] = count($blockedPostArray);
                array_push($abuseWordsWithWeightage, $abuseWordWeightage);
            }
            $result = $abuseWordsWithWeightage;
            return $result;
        } catch (Exception $ex) {
            Yii::log("===@@@@@==inside getAbuseWordsWithTagCloud exception==skipta post service=@@@@@@=======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

    /**
     * @author Sagar
     * @usage Used to add and delete abuse words
     * @param array $blockwordsArray
     * @return string
     */
    public function manageBlockWords($blockwordsArray) {
        try {
            $returnValue = "failure";
            if (is_array($blockwordsArray) && count($blockwordsArray) > 0) {
                $blockwordsArray = array_unique($blockwordsArray);
                foreach ($blockwordsArray as $key => $val) {
                    $blockwordsArray[$key] = trim($val);
                }
            } else {
                $blockwordsArray = array();
            }
            $AbuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
            if (count($AbuseWords) > 0) {
                $deletedWords = array();
                $newWords = array();
                $deletedWords = array_unique(array_diff($AbuseWords, $blockwordsArray));
                $newWords = array_unique(array_diff($blockwordsArray, $AbuseWords));
                if (count($newWords) > 0) {
                    $this->saveBlockWords($newWords);
                }
                if (count($deletedWords) > 0) {
                    foreach ($deletedWords as $abuseWord) {
                        $abuseWordObj = $this->getAbuseWordObjByName($abuseWord);
                        $BlockedPosts = $abuseWordObj->BlockedPosts;
                        if (count($BlockedPosts) > 0) {
                            foreach ($BlockedPosts as $BlockedPost) {
                                $description = "";
                                $categoryType = $BlockedPost['CategoryId'];
                                $postId = (string) $BlockedPost['PostId'];
                                if ($categoryType == 1) {
                                    $postdata = PostCollection::model()->getPostById($postId);
                                    $description = isset($postdata->Description) ? $postdata->Description : "";
                                } else if ($categoryType == 2) {
                                    $postdata = CurbsidePostCollection::model()->getPostById($postId);
                                    $description = isset($postdata->Description) ? $postdata->Description : "";
                                } else if ($categoryType == 3) {
                                    $postdata = GroupPostCollection::model()->getPostById($postId);
                                    $description = isset($postdata->Description) ? $postdata->Description : "";
                                }
                                if ($description != "") {
                                    $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
                                    $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($description), $abuseWords);
                                    if (count($matchedElements) == 1) {
                                        $this->abusePost((string) $BlockedPost['PostId'], "Release", $BlockedPost['CategoryId'], $BlockedPost['NetworkId'], "", 1);
                                    }
                                }
                            }
                        }
                        $BlockedComments = $abuseWordObj->BlockedComments;
                        if (count($BlockedComments) > 0) {
                            foreach ($BlockedComments as $BlockedComment) {
                                $description = "";
                                $categoryType = $BlockedComment['CategoryId'];
                                $postId = (string) $BlockedComment['PostId'];
                                $commentId = (string) $BlockedComment['CommentId'];
                                if ($categoryType == 1) {
                                    $postdata = PostCollection::model()->getCommentById($postId, $commentId);
                                    $description = isset($postdata['CommentText']) ? $postdata['CommentText'] : "";
                                } else if ($categoryType == 2) {
                                    $postdata = CurbsidePostCollection::model()->getCommentById($postId, $commentId);
                                    $description = isset($postdata['CommentText']) ? $postdata['CommentText'] : "";
                                } else if ($categoryType == 3) {
                                    $postdata = GroupPostCollection::model()->getCommentById($postId, $commentId);
                                    $description = isset($postdata['CommentText']) ? $postdata['CommentText'] : "";
                                }
                                if ($description != "") {
                                    $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
                                    $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($description), $abuseWords);
                                    if (count($matchedElements) == 1) {
                                        $this->blockOrReleaseComment((string) $BlockedComment['PostId'], (string) $BlockedComment['CommentId'], $BlockedComment['CategoryId'], "Release", $BlockedComment['NetworkId']);
                                    }
                                }
                            }
                        }
                    }
                    $this->deleteBlockWords($deletedWords);
                }
                $returnValue = "success";
            } else {
                $this->saveBlockWords($blockwordsArray);
                $returnValue = "success";
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log($exc->getMessage() . "))))))))))))))))))))))))))", 'error', 'application');
            return 'exception';
        }
    }

    /**
     * @author Sagar
     * @usage Used to save abuse words
     * @param array $blockwordsArray
     * @return string
     */
    public function saveBlockWords($blockwordsArray) {
        try {
            $returnValue = "failure";
            $returnValue = AbuseKeywords::model()->saveBlockWords($blockwordsArray);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return 'exception';
        }
    }

    /**
     * @author Sagar
     * @usage Used to delete abuse words
     * @param array $blockwordsArray
     * @return string
     */
    public function deleteBlockWords($blockwordsArray) {
        try {
            $returnValue = "failure";
            $returnValue = AbuseKeywords::model()->deleteBlockWords($blockwordsArray);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return 'exception';
        }
    }

    /**
     * @author Sagar
     * @usage Used to get abuse word object by abuse word
     * @param string $abuseWord
     * @return string
     */
    public function getAbuseWordObjByName($abuseWord) {
        try {
            $returnValue = "failure";
            $returnValue = AbuseKeywords::model()->getAbuseWordObjByName($abuseWord);
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return 'exception';
        }
    }

    /**
     * @author Haribabu
     * @param type snippet object
     * @method TO Save  a new  websnippet
     * @return object type id value
     */
    public function SaveWebSnippet($weburlurl, $details, $createdDate = '') {
        $returnValue = 'failure';
        $SnippetId = WebSnippetCollection::model()->saveNewWebSnippet($weburlurl, $details, $createdDate);
        if (is_object($SnippetId)) {
            $SnippetDetails = WebSnippetCollection::model()->getWebSnippetDetailsById($SnippetId);
            if (is_object($SnippetDetails)) {
                $returnValue = $SnippetDetails;
            }
        } else {
            $returnValue = 'failure';
        }
        return $returnValue;
    }

    /**
     * @author Haribabu
     * @param type snippet object
     * @method TO get websnippet details and check web url exist or not
     * @return object type id value
     */
    public function CheckWebUrlExist($weburlurl) {
        $returnValue = 'failure';
        $SnippetId = WebSnippetCollection::model()->CheckWebUrlExist($weburlurl);
        if ($SnippetId != 'failure') {
            $returnValue = $SnippetId;
        } else {
            $returnValue = 'failure';
        }

        return $returnValue;
    }

    /**
     * @author Sagar
     * @usage This is used to update the counts to match with the counts of older posts(Abuse Scan)
     * @return string
     */
    public function manageExistingBlockedPosts() {
        try {
            $returnVal = "failure";
            $abuseWords = ServiceFactory::getSkiptaUserServiceInstance()->getAllAbuseWords();
            $blockedPosts = PostCollection::model()->getAllBlockedPosts();
            if (count($blockedPosts) > 0) {
                foreach ($blockedPosts as $blockedPost) {
                    $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($blockedPost->Description), $abuseWords);
                    if (count($matchedElements) > 0) {
                        foreach ($matchedElements as $blockWord) {
                            AbuseKeywords::model()->PopBlockedPost($blockWord, $blockedPost->_id, 1, $blockedPost->NetworkId);
                        }
                        AbuseKeywords::model()->PushBlockedPost($matchedElements, $blockedPost->_id, 1, $blockedPost->NetworkId);
                    } else {
                        $this->abusePost($blockedPost->_id, "Release", 1, $blockedPost->NetworkId, "", 1);
                    }
                    $returnVal = 'success';
                }
            }
            $blockedCurbsidePosts = CurbsidePostCollection::model()->getAllBlockedPosts();
            if (count($blockedCurbsidePosts) > 0) {
                foreach ($blockedCurbsidePosts as $blockedPost) {
                    $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($blockedPost->Description), $abuseWords);
                    if (count($matchedElements) > 0) {
                        foreach ($matchedElements as $blockWord) {
                            AbuseKeywords::model()->PopBlockedPost($blockWord, $blockedPost->_id, 1, $blockedPost->NetworkId);
                        }
                        AbuseKeywords::model()->PushBlockedPost($matchedElements, $blockedPost->_id, 1, $blockedPost->NetworkId);
                    } else {
                        $this->abusePost($blockedPost->_id, "Release", 1, $blockedPost->NetworkId, "", 1);
                    }
                    $returnVal = 'success';
                }
            }
            $blockedGroupPosts = GroupPostCollection::model()->getAllBlockedPosts();
            if (count($blockedGroupPosts) > 0) {
                foreach ($blockedGroupPosts as $blockedPost) {
                    $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($blockedPost->Description), $abuseWords);
                    if (count($matchedElements) > 0) {
                        foreach ($matchedElements as $blockWord) {
                            AbuseKeywords::model()->PopBlockedPost($blockWord, $blockedPost->_id, 1, $blockedPost->NetworkId);
                        }
                        AbuseKeywords::model()->PushBlockedPost($matchedElements, $blockedPost->_id, 1, $blockedPost->NetworkId);
                    } else {
                        $this->abusePost($blockedPost->_id, "Release", 1, $blockedPost->NetworkId, "", 1);
                    }
                    $returnVal = 'success';
                }
            }
            $postsHaveBlockedComments = PostCollection::model()->getAllPostsHaveBlockedComments();
            if (count($postsHaveBlockedComments) > 0) {
                try {
                    foreach ($postsHaveBlockedComments as $blockedPost) {
                       
                        if (count($blockedPost->Comments) > 0) {
                            $commentId = "";
                            $savedCommentId = "";
                            foreach ($blockedPost->Comments as $comment) {

                                $commentId = (string) $comment['CommentId'];
                                $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($comment['CommentText']), $abuseWords);
                                if (count($matchedElements) > 0) {
                                    $savedCommentId = (string) $comment['CommentId'];
                                    foreach ($matchedElements as $blockWord) {
                                        AbuseKeywords::model()->PopBlockedComment($blockWord, $blockedPost->_id, $comment['CommentId'], 1, $blockedPost->NetworkId);
                                    }


                                    AbuseKeywords::model()->PushBlockedComment($matchedElements, $blockedPost->_id, $comment['CommentId'], 1, $blockedPost->NetworkId);
                                } else {
                                    $this->blockOrReleaseComment((string) $blockedPost->_id, (string) $comment['CommentId'], 1, "Release", $blockedPost->NetworkId);
                                }
                                $returnVal = 'success';
                            }
                            if ($savedCommentId == "") {
                                PostCollection::model()->releasePostHaveBlockedComments((string) $blockedPost->_id);
                                $commentBean = new CommentManagementActionBean();
                                $commentBean->PostId = (string) $blockedPost->_id;
                                $commentBean->CommentId = $commentId;
                                $commentBean->ActionType = "CommentRelease";
                                $commentBean->CatagoryId = 1;
                                $commentBean->NetworkId = $blockedPost->NetworkId;
                                Yii::app()->amqp->stream(json_encode($commentBean));
                            }
                        }
                    }
                } catch (Exception $exc) {
                    error_log("____________________in exception___comment________________" . $exc->getMessage());
                }
            }
            $postsHaveBlockedComments = CurbsidePostCollection::model()->getAllPostsHaveBlockedComments();

            if (count($postsHaveBlockedComments) > 0) {
                foreach ($postsHaveBlockedComments as $blockedPost) {
                    if (count($blockedPost->Comments) > 0) {
                        $commentId = "";
                        $savedCommentId = "";
                        foreach ($blockedPost->Comments as $comment) {
                            $commentId = (string) $comment['CommentId'];
                            $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($comment['CommentText']), $abuseWords);
                            if (count($matchedElements) > 0) {
                                $savedCommentId = (string) $comment['CommentId'];
                                foreach ($matchedElements as $blockWord) {
                                    AbuseKeywords::model()->PopBlockedComment($blockWord, $blockedPost->_id, $comment['CommentId'], 2, $blockedPost->NetworkId);
                                }
                                AbuseKeywords::model()->PushBlockedComment($matchedElements, $blockedPost->_id, $comment['CommentId'], 2, $blockedPost->NetworkId);
                            } else {
                                $this->blockOrReleaseComment((string) $blockedPost->_id, (string) $comment['CommentId'], 2, "Release", $blockedPost->NetworkId);
                            }
                            $returnVal = 'success';
                        }
                        if ($savedCommentId == "") {
                            CurbsidePostCollection::model()->releasePostHaveBlockedComments((string) $blockedPost->_id);
                            $commentBean = new CommentManagementActionBean();
                            $commentBean->PostId = (string) $blockedPost->_id;
                            $commentBean->CommentId = $commentId;
                            $commentBean->ActionType = "CommentRelease";
                            $commentBean->CatagoryId = 2;
                            $commentBean->NetworkId = $blockedPost->NetworkId;
                            Yii::app()->amqp->stream(json_encode($commentBean));
                        }
                    }
                }
            }
            $postsHaveBlockedComments = GroupPostCollection::model()->getAllPostsHaveBlockedComments();

            if (count($postsHaveBlockedComments) > 0) {
                foreach ($postsHaveBlockedComments as $blockedPost) {
                    if (count($blockedPost->Comments) > 0) {
                        $commentId = "";
                        $savedCommentId = "";
                        foreach ($blockedPost->Comments as $comment) {
                            $commentId = (string) $comment['CommentId'];
                            $matchedElements = CommonUtility::ArrayElementsExistsInString(strip_tags($comment['CommentText']), $abuseWords);
                            if (count($matchedElements) > 0) {
                                $savedCommentId = (string) $comment['CommentId'];
                                foreach ($matchedElements as $blockWord) {
                                    AbuseKeywords::model()->PopBlockedComment($blockWord, $blockedPost->_id, $comment['CommentId'], 3, $blockedPost->NetworkId);
                                }
                                AbuseKeywords::model()->PushBlockedComment($matchedElements, $blockedPost->_id, $comment['CommentId'], 3, $blockedPost->NetworkId);
                            } else {
                                $this->blockOrReleaseComment((string) $blockedPost->_id, (string) $comment['CommentId'], 3, "Release", $blockedPost->NetworkId);
                            }
                            $returnVal = 'success';
                        }
                        if ($savedCommentId != "") {
                            GroupPostCollection::model()->releasePostHaveBlockedComments((string) $blockedPost->_id);
                            $commentBean = new CommentManagementActionBean();
                            $commentBean->PostId = (string) $blockedPost->_id;
                            $commentBean->CommentId = $commentId;
                            $commentBean->ActionType = "CommentRelease";
                            $commentBean->CatagoryId = 3;
                            $commentBean->NetworkId = $blockedPost->NetworkId;
                            Yii::app()->amqp->stream(json_encode($commentBean));
                        }
                    }
                }
            }
            return $returnVal;
        } catch (Exception $ex) {
            error_log("===@@@@@==inside manageExistingBlockedPosts exception==skipta post service=@@@@@@=======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

    public function getAllResources() {
        try {
            $returnValue = 'failure';
            $ResourceObj = ResourceCollection::model()->getAllResources();
            if (is_array($ResourceObj)) {
                $returnValue = $ResourceObj;
            }


            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function UpdateResourceThumbNailImage($resourceId, $extension, $url, $resourceName) {

        try {
            $returnValue = 'failure';

            $extension = strtolower($extension);


            if ($extension == 'ppt' || $extension == 'pptx') {
                $ThumbnailImage = "/images/system/PPT-File-icon.png";
            } else if ($extension == 'pdf') {
                $ThumbnailImage = "/images/system/pdf.png";
            } else if ($extension == 'doc' || $extension == 'docx' || $extension == 'avi') {
                $ThumbnailImage = "/images/system/MS-Word-2-icon.png";
            } else if ($extension == 'exe' || $extension == 'xls' || $extension == 'ini') {
                $ThumbnailImage = "/images/system/Excel-icon.png";
            } else if ($extension == 'mp3') {
                $ThumbnailImage = "/images/system/audio_img.png";
            } else if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {

                $imgArr = explode(".", $resourceName);
                $date = strtotime("now");

                $newfile = trim($imgArr[0]) . '.' . 'jpg';

                $folder = Yii::getPathOfAlias('webroot') . '/upload/public/thumbnails/' . $newfile;
                $uploadfile = Yii::getPathOfAlias('webroot') . $url;
                if (file_exists($uploadfile)) {
                    exec("ffmpeg -itsoffset -0 -i $uploadfile -vcodec mjpeg -vframes 1 -an -f rawvideo scale=320:-1 $folder");

                    $ThumbnailImage = '/upload/public/thumbnails/' . $newfile;
                } else {
                    $ThumbnailImage = "/images/system/audio_img.png";
                }
            } else if ($extension == 'txt') {
                $ThumbnailImage = "/images/system/notepad-icon.png";
            } else {
                $ThumbnailImage = str_replace(" ", "", stripslashes(trim($url)));
            }

            $ResourceObj = ResourceCollection::model()->UpdateResourceThumbNailImage($ThumbnailImage, $resourceId);

            $returnValue = $ResourceObj;



            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function saveSharedList($postId, $userId, $categoryType, $shareType) {
        try {
            $returnValue = 'failure';
            $categoryType = (int) $categoryType;
            if ($categoryType == 1) {
                $returnValue = PostCollection::model()->saveSharedList($postId, $userId, $shareType);
            } elseif ($categoryType == 2) {
                $returnValue = CurbsidePostCollection::model()->saveSharedList($postId, $userId, $shareType);
            }
           
            if ($returnValue == 'failure') {
                return $returnValue;
            }
           
            CommonUtility::prepareStreamObject($userId, $shareType, $postId, $categoryType, '', '');
           
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function GetGoogleAnalyticsData() {
        try {
            Yii::import("ext.GoogleAnalytics.gapi");

            $email = Yii::app()->params['ga_email'];
            $pasword = Yii::app()->params['ga_password'];
            $profileId = Yii::app()->params['ga_profile_id'];

            $ga = new gapi($email, $pasword);

            $startdate = date('Y-m-d', strtotime('-1 day'));
            $enddate = date('Y-m-d');
            $ga->requestReportData($profileId, array('browser', 'networkLocation', 'pagePath', 'date', 'hour'), array('exits', 'entrances', 'SessionDuration', 'avgTimeOnSite', 'pageviews', 'visits'), array('date'), null, $startdate, $enddate);
            $DayOfHour = 0;
            $visits = 0;

            foreach ($ga->getResults() as $result) {
                $result->getpagePath();
                if ($visits < $result->getVisits()) {
                    if ($result->getVisits() > 0) {
                        $visits = $result->getVisits();
                        $DayOfHour = $result->gethour();
                    }
                }
            }

            $pageviews = $ga->getPageviews();

            $pagevisits = $ga->getVisits();
            $AvgTimeOnSite = gmdate("H:i:s", $ga->getavgTimeOnSite());

            $returnValue = 'failure';
            $checkData = GoogleAnalyticsCollection::model()->CheckGoogleAnalyticsDataExistByDate();
            if (count($checkData) > 0) {
                $returnValue = GoogleAnalyticsCollection::model()->updateGoogleAnalyticsDataExistByDate($startdate, $pageviews, $pagevisits, $AvgTimeOnSite, $DayOfHour);
            } else {
                $returnValue = GoogleAnalyticsCollection::model()->saveGoogleAnalyticsData($startdate, $pageviews, $pagevisits, $AvgTimeOnSite, $DayOfHour);
            }
            return $returnValue;
        } catch (Exception $exc) {

            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function trackFilterByHashtag($userId, $hashtagId, $NetworkId) {
        try {
           
            $hashtagObj = HashTagCollection::model()->getHashTagsById($hashtagId);
            $activityIndex = CommonUtility::getUserActivityIndexByActionType("HashtagUsed");
            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("HashTagFilter");
            UserInteractionCollection::model()->trackMinHashTagWindowOpen($userId, $hashtagId, $hashtagObj->HashTagName, $activityIndex, $activityContextIndex, $NetworkId);
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
            return "failure";
        }
    }

    public function trackFilterByCategory($userId, $categoryId, $NetworkId) {
        try {
           
            $categoryObj = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($categoryId);
            $activityIndex = CommonUtility::getUserActivityIndexByActionType("CategoryFilter");
            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("CategoryFilter");
            UserInteractionCollection::model()->trackFilterByCategory($userId, $categoryId, $categoryObj->CategoryName, $activityIndex, $activityContextIndex, $NetworkId);
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
            return "failure";
        }
    }

    public function trackPostDetailsOpenActivity($userId, $categoryType, $postId, $postType, $NetworkId) {
        try {
           
            $activityIndex = CommonUtility::getUserActivityIndexByActionType("PostDetailOpen");
            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType("PostDetailOpen");
            UserInteractionCollection::model()->trackPostDetailsOpenActivity($userId, $categoryType, $postType, $postId, $activityIndex, $activityContextIndex, $NetworkId);
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
            return "failure";
        }
    }

    public function trackPostDetailAction($from, $userId, $postId, $categoryType, $postType, $NetworkId) {
        try {
          
            $activityIndex = CommonUtility::getUserActivityIndexByActionType("PostDetailOpen");

            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType($from);
            UserInteractionCollection::model()->trackPostDetailsOpenActivity($userId, $categoryType, $postType, $postId, $activityIndex, $activityContextIndex, $NetworkId);
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
            return "failure";
        }
    }

    public function getGroupObjectByName($groupName) {
        $result = "failure";
        try {
            $result = GroupCollection::model()->getGroupObjectByName($groupName);
        } catch (Exception $ex) {
            error_log("===@@@@@==inside getGroupObjectByName exception===@@@@@@=======" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

    public function trackPageLoad($userId, $from, $dataId, $NetworkId) {
        return;
        $result = "failure";
        try {

            if ($from == "Stream") {
                $index = "Stream";
                $context = "Stream";
            } else if ($from == "StreamScroll") {
                $index = "Stream";
                $context = "StreamScroll";
            } else if ($from == "Curbside") {
                $index = "Curbside";
                $context = "Curbside";
            } else if ($from == "CurbsideScroll") {
                $index = "Curbside";
                $context = "CurbsideScroll";
            } else if ($from == "Group") {
                $index = "Group";
                $context = "Group";
            } else if ($from == "GroupScroll") {
                $index = "Group";
                $context = "GroupScroll";
            } else if ($from == "Profile") {
                $index = "Profile";
                $context = "Profile";
            } else if ($from == "ProfileScroll") {
                $index = "Profile";
                $context = "ProfileScroll";
            } else if ($from == "Chat") {
                $index = "Chat";
                $context = "Chat";
            } else if ($from == "Notification") {
                $index = "Notification";
                $context = "Notification";
            } else if ($from == "History") {
                $index = "History";
                $context = "History";
            } else if ($from == "Settings") {
                $index = "Settings";
                $context = "Settings";
            } else if ($from == "GroupDetail") {
                $index = "GroupDetail";
                $context = "GroupDetail";
            } else if ($from == "SubGroupDetail") {
                $index = "SubGroupDetail";
                $context = "SubGroupDetail";
            } else if ($from == "SubGroupDetail") {
                $index = "SubGroupDetail";
                $context = "SubGroupDetail";
            } else if ($from == "GroupMinPopup") {
                $index = "GroupMinPopup";
                $context = "GroupMinPopup";
            } else if ($from == "SubGroupMinPopup") {
                $index = "SubGroupMinPopup";
                $context = "SubGroupMinPopup";
            }
            $activityIndex = CommonUtility::getUserActivityIndexByActionType($index);
            $activityContextIndex = CommonUtility::getUserActivityContextIndexByActionType($context);
            $result = UserInteractionCollection::model()->trackPageLoad($from, $dataId, $userId, $activityIndex, $activityContextIndex, $NetworkId);
        } catch (Exception $ex) {
             Yii::log($ex->getMessage(), "error", "application");
        }
        return $result;
    }

    public function GetPostsBasedonDateRangeAndType($startDate, $endDate, $type, $NetworkId, $GameAvailable, $NewsAvailable) {

        try {
            $postType = 0;
            $IsFeatured = 0;
            $Ispromoted = 0;
            $modeType = "";
            $datemode = "";
            $finalArray = array();
            $resArray = array();
            $dateFormat = CommonUtility::getDateFormat();


            $finalArray = array();
            // $startDate=date('Y-m-d',strtotime($startDate));
            // $endDate=date('Y-m-d',strtotime($endDate));
            $timezone = Yii::app()->session['timezone'];
           // $startDate = CommonUtility::convert_time_zone(strtotime($startDate), "UTC", $timezone);
           // $endDate = CommonUtility::convert_time_zone(strtotime($endDate), "UTC", $timezone);
            $startDate1 = date('Y-m-d', strtotime($startDate));
            $endDate1 = date('Y-m-d', strtotime($endDate));
            $dateFrom = new DateTime($startDate1);
            $dateTo = new DateTime($endDate1);
            $interval = date_diff($dateFrom, $dateTo);
            $diff = $interval->format('%R%a');
            $valid_times = CommonUtility::GetIntervalsBetweenTwoDates($startDate1, $endDate1);

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
//------------------normal Posts Start-------------------------------------------------------------------------//

            $match = array("pageIndex" => array('$in' => array(6)),
                "userActivityIndex" => array('$in' => array(2)),
                "CategoryType" => array('$in' => array(1, 3)),
                "PostType" => array('$in' => array(1, 2, 3)),
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate)
            );
            $collection = "UserInteractionCollection";
            $nresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($nresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $existingArray[0] = $value['count'];
                    $finalArray[$value['_id']['week']] = $existingArray;
                } else {

                    $finalArray[$value['_id']['week']] = array($value['count'], 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                }
            }

/////---------------------------End----------------------------------         
//---------------------------------Curbside Posts=---------------------------------------------------------------------//                       


            $match = array("pageIndex" => (int) 6, "CategoryType" => (int) 2, "PostType" => (int) 5, "NetworkId" => (int) $NetworkId,
               "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "UserInteractionCollection";
            $cresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($cresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArrayd[1] = $value['count'];
                    $finalArray[$value['_id']['week']][1] = $value['count'];
                }
            }

            //-------------end-------
//------------------Event posts--------------------------------------------------------------------------------------                

            $match = array("pageIndex" => (int) 6, "userActivityContext" => (int) 61, "CategoryType" => array('$in' => array(1, 3)), "PostType" => (int) 2, "NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "UserInteractionCollection";
            $eresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($eresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[2] = $value['count'];
                    $finalArray[$value['_id']['week']][2] = $value['count'];
                }
            }

///------------------------Survey posts--------------------------------------------------------------------------------------//             

            $match = array("pageIndex" => (int) 6, "CategoryType" => array('$in' => array(1, 3)), "PostType" => (int) 3, "NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "UserInteractionCollection";
            $sesults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($sesults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[3] = $value['count'];
                    $finalArray[$value['_id']['week']][3] = $value['count'];
                }
            }

            //------------------------------ Featured Posts-------------------------------------------------------------------------------------------//       

            $match = array("IsFeatured" => (int) 1,"NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "NewsCollection";
            $Fresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);

            foreach ($Fresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[4] = $value['count'];
                    $finalArray[$value['_id']['week']][4] = $value['count'];
                } else {

                    $finalArray[$value['_id']['week']] = array(0, 0, 0, 0, $value['count'], 0, 0, 0, 0, 0, 0);
                }
            }

            //-----------------------------Promoted posts----------------------------------------------------------------------------------//

            $match = array("userActivityContext" => (int) 68, "pageIndex" => array('$in' => array(1)), "NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "UserInteractionCollection";
            $Presults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($Presults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[5] = $value['count'];
                    $finalArray[$value['_id']['week']][5] = $value['count'];
                } else {

                    $finalArray[$value['_id']['week']] = array(0, 0, 0, 0, 0, $value['count'], 0, 0, 0, 0, 0);
                }
            }


            //--------------------------------ActiveUsers-------------------------------------------------------------------------------------------//


            $match = array("Users" => array('$ne' => (int) 0), "Is_Group" => (int) 0,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "ActiveUsersCollection";
            $Aresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($Aresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[6] = $value['count'];
                    $finalArray[$value['_id']['week']][6] = $value['count'];
                } else {

                    $finalArray[$value['_id']['week']] = array(0, 0, 0, 0, 0, 0, $value['count'], 0, 0, 0, 0);
                }
            }


////---------------------------Comeback Users---------------------------------------------------------------------------------//

            $match = array("IsComebackUser" => 1, "NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "UserInteractionCollection";
            $combackresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($combackresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[7] = $value['count'];
                    $finalArray[$value['_id']['week']][7] = $value['count'];
                }
            }

            //---------------------------------Registrations-----------------------------------------------------------------------------------------------------------//                

            $Registrations = User::model()->getAllRegistrationsBetweenDates($startDate, $endDate, $NetworkId, $datemode);

            foreach ($Registrations as $value) {

                //$value['CreatedDate'] = date('m/d/Y', strtotime($value['CreatedDate']));
                if ($datemode == 'DATE') {
                    $value['CreatedDate'] = intval(date('d', strtotime($value['CreatedDate'])));
                }
                if (array_key_exists($value['CreatedDate'], $finalArray)) {
                    //$existingArray = $finalArray[$value['CreatedDate']];
                    $existingArray[8] = (int) $value['count'];
                    $finalArray[$value['CreatedDate']][8] = (int) $value['count'];
                }
            }


            //--------------------------------------News -----------------------------------------------------------------//


            $match = array("Released" => (int) 1, "NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "CuratedNewsCollection";
            $Newsresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($Newsresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[9] = $value['count'];
                    $finalArray[$value['_id']['week']][9] = $value['count'];
                }
            }


            //-------------------------------------------Games----------------------------------------------------------------//     

            $match = array("CategoryType" => (int) 9, "userActivityContext" => (int) 2, "NetworkId" => (int) $NetworkId,
                "CreatedOn" => array('$gte' => new MongoDate(strtotime($startDate)), '$lte' => new MongoDate(strtotime($endDate)))
            );
            $collection = "UserInteractionCollection";
            $gameresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($gameresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {
                    $existingArray[10] = $value['count'];
                    $finalArray[$value['_id']['week']][10] = $value['count'];
                }
            }

            if ($GameAvailable == 'ON' && $NewsAvailable == 'ON') {
                $removeKeys = array();
            } else if ($GameAvailable == 'ON' && $NewsAvailable == 'OFF') {
                $removeKeys = array('9');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'ON') {
                $removeKeys = array('10');
            } else if ($GameAvailable == 'OFF' && $NewsAvailable == 'OFF') {
                $removeKeys = array('9', '10');
            }

            foreach ($valid_times as $key => $value) {
                $startDate = date('Y-m-d', strtotime($valid_times["$key"]));
                $startDate_tz = CommonUtility::convert_date_zone(strtotime($startDate . " 18:29:00"), date_default_timezone_get(), "UTC");
                $dateArray = array();
                if (is_array($finalArray[$key])) {

                    for ($k = 0; $k < 11; $k++) {
                        if (!array_key_exists($k, $finalArray[$key])) {

                            $finalArray[$key][$k] = 0;
                        }
                    }
                } else {

                    for ($k = 0; $k < 11; $k++) {

                        $finalArray[$key][$k] = 0;
                    }
                }

                ksort($finalArray[$key]);


                if (count($removeKeys) > 0) {
                    foreach ($removeKeys as $ke) {

                        unset($finalArray[$key][$ke]);
                    }
                }

                if ($type == 'report') {

                    //  $resArr[date($dateFormat, $startDate_tz)] = $dateArray;
                    if ($diff > 365) {

                        $resArray["" . $value . ""] = $finalArray[$key];
                    } elseif ($diff > 92 && $diff <= 365) {
                        $resArray["" . date('M Y', $startDate_tz) . ""] = $finalArray[$key];
                    } elseif ($diff > 31 && $diff <= 92) {
                        $resArray["" . date($dateFormat, $startDate_tz) . ""] = $finalArray[$key];
                    } elseif ($diff <= 31) {
                        $resArray["" . date($dateFormat, $startDate_tz) . ""] = $finalArray[$key];
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
        } catch (Exception $e) {
            error_log("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@final arary" . $e->getMessage());
            Yii::log("Exceptoin " . $e->getMessage());
        }
    }

    /**
     * @author Haribabu
     * @usage This is used to get Analytics repots
     * @return string
     */
    public function GetAnalyticsReportsBasedonDateRange($startDate, $endDate, $groupId, $IsGroup, $type) {


        try {
            $finalArray = GoogleAnalyticsCollection::model()->GetAnalyticsReportsBasedonDateRange($startDate, $endDate, $groupId, $IsGroup, $type);

            return $finalArray;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
        }
    }

    /**
     * @author Praneeth
     * @param type $groupPostobject
     * @return type
     */
    public function checkIsGroupAdminById($groupPostobject) {
        try {
            $returnValue = 'false';
            $returnValue = GroupCollection::model()->checkIsGroupAdminById($groupPostobject);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $returnValue;
    }

    /**
     * @author Praneeth
     * @param type $groupId
     * @return type
     */
    public function getGroupNameById($groupId) {
        try {
            $groupObj = 'failure';
            $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $groupObj;
    }

    public function getEngagementAnalytics($startDate, $endDate, $type, $NetworkId, $GameAvailable, $NewsAvailable) {

        return UserInteractionCollection::model()->getStreamEngagement($startDate, $endDate, $type, $NetworkId, $GameAvailable, $NewsAvailable);
    }

    public function getGroupEngagementAnalytics($groupId, $startDate, $endDate, $type, $NetworkId) {

        return UserInteractionCollection::model()->getGroupEngagement($groupId, $startDate, $endDate, $type, $NetworkId);
    }

    public function trackEngagementAction($userId, $page, $action, $dataId, $categoryType, $postType, $NetworkId, $id = "") {
        try {
            $result = UserInteractionCollection::model()->trackEngagementAction($userId, $page, $action, $dataId, $categoryType, $postType, $id, $NetworkId);
            if ($action == "PostDelete") {
                UserInteractionCollection::model()->trackEngagementAction($userId, "Post", $action, $dataId, $categoryType, $postType, $id, $NetworkId);
            } else if ($action == "PostPromote") {
                UserInteractionCollection::model()->trackEngagementAction($userId, "Post", $action, $dataId, $categoryType, $postType, $id, $NetworkId);
            } else if ($action == "PostFlagAbuse") {
                UserInteractionCollection::model()->trackEngagementAction($userId, "Post", $action, $dataId, $categoryType, $postType, $id, $NetworkId);
            } else if ($action == "PostFeatured") {
                UserInteractionCollection::model()->trackEngagementAction($userId, "Post", $action, $dataId, $categoryType, $postType, $id, $NetworkId);
            } else if ($action == "HashTagMinPopup") {
                UserInteractionCollection::model()->trackEngagementAction($userId, "HashTag", $action, $dataId, $categoryType, $postType, $id, $NetworkId);
            }
        } catch (Exception $ex) {
            
        }
    }

    public function trackSearchEngagementAction($userId, $page, $action, $dataId, $searchText, $searchType, $NetworkId) {
        try {

            UserInteractionCollection::model()->trackSearchEngagementAction($userId, $page, $action, $dataId, $searchText, $searchType, $NetworkId);
        } catch (Exception $ex) {
           Yii::log($exc->getMessage(), "error", "application");  
        }
    }

    /*
     * @author Vamsi Krishna
     * This is to get featured Item for Daily Digest
     */

    public function getFeaturedItemForDailyDigest() {
        $returnValue = 'failure';
        try {
            $data = gmdate('m/d/Y', strtotime("-1 days"));
            $startDate = date('Y-m-d', strtotime($data));
            $endDate = date('Y-m-d', strtotime($data));
            $endDate = trim($endDate) . " 23:59:59";
            $startDate = trim($startDate) . " 00:00:00";

            $featuredItem = NewsCollection::model()->getFeaturedItemForDigest($startDate, $endDate);
        } catch (Exception $exc) {
            error_log("+++++" . $exc->getMessage());
             Yii::log($exc->getMessage(), "error", "application");
            $returnValue = 'failure';
        }
        return $featuredItem;
    }

    public function getCurbsidePostForDailyDigest() {
        $returnValue = 'failure';
        try {
            $data = gmdate('m/d/Y', strtotime("-1 days"));
            $startDate = date('Y-m-d', strtotime($data));
            $endDate = date('Y-m-d', strtotime($data));
            $endDate = trim($endDate) . " 23:59:59";
            $startDate = trim($startDate) . " 00:00:00";
            $curbsidePost = CurbsidePostCollection::model()->getCurbsidePostForDailyDigest($startDate, $endDate);
            return $curbsidePost;
        } catch (Exception $exc) {
            error_log("+++++" . $exc->getMessage());
             Yii::log($exc->getMessage(), "error", "application");
            $returnValue = 'failure';
        }
    }

    function getCommentedUsersForPost($postId, $userId) {
        try {
            return UserStreamCollection::model()->getCommentedUsersForPost($postId, $userId);
        } catch (Exception $ex) {
             Yii::log($exc->getMessage(), "error", "application");
            error_log($ex->getMessage());
        }
    }

    public function getCuratedTopicsService($userId, $networkId) {
        return CuratedTopic::model()->getCuratedTopics($userId, $networkId);
    }

    public function getAllCuratedTopicsService($userId, $networkId) {
        return CuratedTopic::model()->getAllCuratedTopics($userId, $networkId);
    }

    public function saveCuratedPost($curatedObject) {
        $return = CuratedNewsCollection::model()->getPostByIdConsole($curatedObject->PostId);
        if ($return == '') {
            $curatedObject->save();
            return $returnvalue = $curatedObject->_id;
        } else {
            return;
        }
    }

    public function getCuratedTopicDetailsByTopicIdService($TopicId) {
        return CuratedTopic::model()->getCuratedTopicDetailsByTopicId($TopicId);
    }

    public function updateCuratedTopicService($TopicId, $status) {
        return CuratedTopic::model()->updateCuratedTopic($TopicId, $status);
    }

    public function saveEditorialService($postId, $text) {
        return CuratedNewsCollection::model()->saveEditorial($postId, $text);
    }

    public function manageCuratedPostService($postId, $release, $userId) {
        $data = CuratedNewsCollection::model()->manageCuratedPost($postId, $release, $userId);
        return $data;
    }

    /**
     * @author Haribabu
     * @usage This is used to save the top users and top searchitems and top hashtags of day
     * @return string
     */
    public function SaveTopLeadersOfTheDay() {
        try {

            $returnValue = 'failure';
            //$startdate = date('Y-m-d',strtotime('-1 day'));
            $startdate = date('Y-m-d');
            $TopUsers = UserInteractionCollection::model()->getTopUserOfDay($startdate);
            $TopHashtags = UserInteractionCollection::model()->getTopHashtagsOfDay($startdate);
            $TopSearchitems = UserInteractionCollection::model()->getTopSearchItemsOfDay($startdate);
            $TopNews = UserInteractionCollection::model()->getTopNewsOfDay($startdate);
            $saveTopLeaders = TopLeadersCollection::model()->saveTopLeadersData($startdate, $TopUsers, $TopHashtags, $TopSearchitems, $TopNews);
            if ($saveTopLeaders != "failure") {
                $returnValue = $saveTopLeaders;
            }
            return $returnValue;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
        }
    }

    /**
     * @author Haribabu
     * @usage This is used to get the top users and top searchitems and top hashtags of day
     * @return string
     */
    public function GetTopLeadersOfTheDay() {
        try {

            $returnValue = array();
            $startdate = date('Y-m-d');
           // $startdate = date('Y-m-d', strtotime('-1 day'));
            $TopUsers = array();
            $TopNews = array();
            $TopLeaders = TopLeadersCollection::model()->getTopLeadersData($startdate);
            if ($TopLeaders != "failure") {
                foreach ($TopLeaders as $key => $value) {

                    $Users = $value->TopUsers;
                    $TopHashtags = $value->TopHashtags;
                    $TopSearchItems = $value->TopSearchItems;
                    $News = $value->TopNews;
                }
                if (count($Users) > 0) {
                    for ($i = 0; $i < count($Users); $i++) {
                        // $Userdetails = User::model()->getUserProfileByUserId($Users[$i]);
                        $Userdetails = UserCollection::model()->getTinyUserCollection($Users[$i]);

                        $TopUsers[$i]['DisplayName'] = $Userdetails['DisplayName'];
                        $TopUsers[$i]['ProfilePicture'] = $Userdetails['ProfilePicture'];
                        //array_push($TopUsers, $Userdetails['DisplayName']);
                    }
                }

                if (count($News) > 0) {

                    for ($j = 0; $j < count($News); $j++) {

                        $Newsdetails = CuratedNewsCollection::model()->getNewsObjectById($News[$j]);
                        if (count($Newsdetails) > 0) {
                            $TopNews[$j]['Source'] = $Newsdetails->PublisherSource;
                            $TopNews[$j]['Url'] = $Newsdetails->PublisherSourceUrl;
                        }
                    }
                }

                $returnValue['Topusers'] = $TopUsers;
                $returnValue['TopHashtags'] = $TopHashtags;
                $returnValue['TopSearchItems'] = $TopSearchItems;
                $returnValue['TopNews'] = $TopNews;
            } else {
                $returnValue = "failure";
            }
            return $returnValue;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
        }
    }

    /**
     * @author Haribabu
     * @usage This is used to save the  group Analytics of day
     * @return string
     */
    public function getGroupDetailForAnalytics($groupId) {
        try {


            $result = array();
            $TopUsers = array();
            //$startdate = date('Y-m-d', strtotime('-1 day'));
            $startdate = date('Y-m-d');
            $groupDetails = GroupCollection::model()->getGroupDetailsById($groupId);

            if ($groupDetails != "failure") {

                $result['GroupMembers'] = count($groupDetails->GroupMembers);

                $result['Conversations'] = count($groupDetails->PostIds);
                $result['subgroups'] = count($groupDetails->SubGroups);
            } else {
                $result = 'failure';
            }

            $TopLeaders = TopLeadersCollection::model()->getGroupTopLeadersData($groupId, $startdate);

            foreach ($TopLeaders as $key => $value) {

                $result['TopHashtags'] = $value->TopHashtags;
                $result['TopSearchItems'] = $value->TopSearchItems;
                $Users = $value->TopUsers;
            }



            for ($i = 0; $i < count($Users); $i++) {
                // $Userdetails = User::model()->getUserProfileByUserId($Users[$i]);
                $Userdetails = UserCollection::model()->getTinyUserCollection($Users[$i]);

                $TopUsers[$i]['DisplayName'] = $Userdetails['DisplayName'];
                $TopUsers[$i]['ProfilePicture'] = $Userdetails['ProfilePicture'];
                //array_push($TopUsers, $Userdetails['DisplayName']);
            }

            $result['Topusers'] = $TopUsers;

            return $result;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
        }
    }

    /**
     * @author Haribabu
     * @usage This is used to save group the top users and top searchitems and top hashtags of day
     * @return string
     */
    public function SaveGroupTopLeadersOfTheDay() {
        try {

            $returnValue = 'failure';
            $startdate = date('Y-m-d');
            $groupDetailObj = GroupCollection::model()->getAllGroupIds();

            foreach ($groupDetailObj as $key => $group) {

                $groupId = $group->_id;


                $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
                $subgroups = array();
                if (count($groupObj->SubGroups) > 0) {

                    foreach ($groupObj->SubGroups as $key => $value) {

                        array_push($subgroups, $value);
                    }
                }


                $TopUsers = UserInteractionCollection::model()->getGroupTopUserOfDay($groupId, $subgroups, $startdate);

                $TopHashtags = UserInteractionCollection::model()->getGroupTopHashtagsOfDay($groupId, $subgroups, $startdate);
                $TopSearchitems = UserInteractionCollection::model()->getGroupTopSearchItemsOfDay($groupId, $subgroups, $startdate);




                $saveTopLeaders = TopLeadersCollection::model()->saveGroupTopLeadersData($groupId, $startdate, $TopUsers, $TopHashtags, $TopSearchitems);
            }

            if ($saveTopLeaders != "failure") {
                $returnValue = $saveTopLeaders;
            }
            return $returnValue;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error');
        }
    }

    /**
     * 
     * @param type $postId
     * @
     * @return type boolean 
     */
    public function releaseNewsObjectToStream($postId, $userId) {
        try {
            $return = CommonUtility::prepareStreamObject($userId, "Post", $postId, 8, '', '');
            if ($return == false) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            Yii::log("Exception occured while relase news object" . $ex->getMessage());
        }
    }

    public function GetEditorialService($postId) {
        try {
            return CuratedNewsCollection::model()->GetEditorial($postId);
        } catch (Exception $ex) {
            Yii::log("Exception occured while relase news object" . $ex->getMessage());
        }
    }

    /**
     * @author karteek.v
     * @param type $newsId
     * @return type
     */
    public function getNewsObjectById($newsId) {
        try {
            $object = CuratedNewsCollection::model()->getNewsObjectById($newsId);
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    /**
     * @author karteek v
     * @param type $pageSize
     * @param type $page
     * @param type $newsId
     * @param type $categoryType
     * @return type
     */
    public function getRecentCommentsforNews($newsId) {
        try {
            $returnValue = 'failure';
            $comments = CuratedNewsCollection::model()->getRecentCommentsforNews($newsId);
            if (is_array($comments)) {
                $returnValue = $comments;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function SaveGroupGoogleAnalyticsData() {
        try {
            Yii::import("ext.GoogleAnalytics.gapi");

            $email = Yii::app()->params['ga_email'];
            $pasword = Yii::app()->params['ga_password'];
            $profileId = Yii::app()->params['ga_profile_id'];

            $groupDetailObj = GroupCollection::model()->getAllGroupIds();

            foreach ($groupDetailObj as $key => $group) {

                $groupId = $group->_id;
                $groupName = $group->GroupName;
                $filter = 'pagePath =@ ' . $groupName;
                $ga = new gapi($email, $pasword);

                // $startdate = date('Y-m-d');
                $startdate = date('Y-m-d', strtotime('-1 day'));
                $enddate = date('Y-m-d');
                //$filter = 'country == India && visits > 30';
                $ga->requestReportData($profileId, array('browser', 'networkLocation', 'pagePath', 'date', 'hour'), array('exits', 'entrances', 'SessionDuration', 'avgTimeOnSite', 'pageviews', 'visits'), array('date'), $filter, $startdate, $enddate);
                $DayOfHour = 0;
                $visits = 0;

                foreach ($ga->getResults() as $result) {

                    if ($visits < $result->getVisits()) {

                        $DayOfHour = $result->gethour();
                    }
                }

                $pageviews = $ga->getPageviews();

                $pagevisits = $ga->getVisits();
                $AvgTimeOnSite = gmdate("H:i:s", $ga->getavgTimeOnSite());


                $returnValue = GoogleAnalyticsCollection::model()->saveGroupWiseGoogleAnalyticsData($startdate, $pageviews, $pagevisits, $AvgTimeOnSite, $DayOfHour, $groupId);
            }




            return $returnValue;
        } catch (Exception $exc) {

            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function getCurbsideCategoryIdByCategoryName($name) {
        return CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryName($name);
    }

    function GetGdata($startDate, $endDate) {


        GoogleAnalyticsCollection::model()->getTrafficGoogleAnalyticsdata($startDate, $endDate);
    }

    public function GetGroupActivityPostsBasedonDateRangeAndType($groupId, $startDate, $endDate, $NetworkId, $type) {

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
            //  $valid_times = CommonUtility::GetIntervalsBetweenTwoDates($startDate, $endDate);
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

////---------------------------------- GroupNormalPosts -------------------------------------------------------------    

            $match = array("GroupId" => new MongoId($groupId),
                "Type" => array('$in' => array(1)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "GroupPostCollection";
            $GPresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);
            foreach ($GPresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $finalArray[$value['_id']['week']][0] = $value['count'];
                }
            }

//-------------------------------Group Event Posts------------------------------------------------------------------------------               

            $match = array("GroupId" => new MongoId($groupId),
                "Type" => array('$in' => array(1)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "GroupPostCollection";
            $GEresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GEresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $finalArray[$value['_id']['week']][1] = $value['count'];
                }
            }

//----------------------Group Survey Posts-------------------------------------------------------------------------------               


            $match = array("GroupId" => new MongoId($groupId),
                "Type" => array('$in' => array(3)),
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "GroupPostCollection";
            $GSresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GSresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $finalArray[$value['_id']['week']][2] = $value['count'];
                }
            }

//--------------  Group Follows--------------------------------------------------------------------------------------

            $match = array("GroupId" => new MongoId($groupId), "userActivityIndex" => (int) 1,
                "ActionType" => "GroupFollow",
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "UserInteractionCollection";
            $GFresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GFresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $finalArray[$value['_id']['week']][3] = $value['count'];
                }
            }

            //--------------------------Group ActiveUSers--------------------------------------------------------------------            


            $match = array("GroupId" => new MongoId($groupId),
                "Is_Group" => (int) 1, "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "ActiveUsersCollection";
            $GAresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GAresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $finalArray[$value['_id']['week']][4] = $value['count'];
                }
            }


//-----------------------------------Group ComeBackUsers------------------------------------------------------------------------------            

            $match = array("GroupId" => new MongoId($groupId),
                "Is_Group" => (int) 2,
                "NetworkId" => (int) $NetworkId,
                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate));
            $collection = "ActiveUsersCollection";
            $GCresults = CommonUtility::getAnalyticsData($collection, $match, $modeType, $Resultsid);


            foreach ($GCresults as $value) {
                if (array_key_exists($value['_id']['week'], $valid_times)) {

                    $finalArray[$value['_id']['week']][5] = $value['count'];
                }
            }

            foreach ($valid_times as $key => $value) {
                $startDate = date('Y-m-d', strtotime($valid_times["$key"]));
                $startDate_tz = CommonUtility::convert_date_zone(strtotime($startDate . " 18:29:00"), date_default_timezone_get(), "UTC");
                $dateArray = array();
                if (is_array($finalArray[$key])) {

                    for ($k = 0; $k < 6; $k++) {
                        if (!array_key_exists($k, $finalArray[$key])) {

                            $finalArray[$key][$k] = 0;
                        }
                    }
                } else {

                    for ($k = 0; $k < 6; $k++) {

                        $finalArray[$key][$k] = 0;
                    }
                }

                ksort($finalArray[$key]);

                if ($type == 'report') {

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
        } catch (Exception $ex) {
            error_log("========in exception=================" . $ex->getMessage());
        }
    }

    public function SaveActiveUsersBasedonDaterange() {

        try {
            $activeusers = 0;
            $endDate = date('Y-m-d');
            $startDate = date('Y-m-d', strtotime("-7 days"));
            $finalArray = array();
            $ReportDate = date('Y-m-d');
            $c = UserInteractionCollection::model()->getCollection();


            $results = $c->aggregate(
                    array('$match' => array("userActivityIndex" => (int) 1, "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate))), array('$group' => array(
                    '_id' => '$UserId',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );


            foreach ($results['result'] as $key => $value) {

                array_push($finalArray, $value['_id']);
            }

            if (is_array($finalArray) && count($finalArray) > 0) {
                $activeusers = count($finalArray);
            }

            $check = ActiveUsersCollection::model()->CheckActiveUsersDataExistByDate($ReportDate);
            if ($check != "failure") {

                $result = ActiveUsersCollection::model()->updateActiveUsersDataExistByDate($ReportDate, $activeusers);
            } else {

                $result = ActiveUsersCollection::model()->saveActiveUsersData($ReportDate, $activeusers);
            }


            if ($result != "failure") {
                $this->SaveTodayActiveUsersBasedonDaterange();
            }
        } catch (Exception $ex) {
            error_log("========in exception=================" . $ex->getMessage());
        }
    }

    public function SaveTodayActiveUsersBasedonDaterange() {

        try {
            $activeusers = 0;
            $endDate = date('Y-m-d', strtotime("+1 day"));
            $startDate = date('Y-m-d', strtotime('-7 day' . $endDate));

            $ReportDate = date('Y-m-d', strtotime("+1 day"));
            $c = UserInteractionCollection::model()->getCollection();
            $results = $c->aggregate(
                    array('$match' => array("userActivityIndex" => (int) 1, "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate))), array('$group' => array(
                    '_id' => '$UserId',
                    "number" => array('$sum' => 1),
                )), array(
                '$sort' => array('number' => -1)
                    ), array('$limit' => 10)
            );


            foreach ($results['result'] as $key => $value) {

                array_push($finalArray, $value['_id']);
            }

            if (is_array($finalArray) && count($finalArray) > 0) {
                $activeusers = count($finalArray);
            }

            $check = ActiveUsersCollection::model()->CheckActiveUsersDataExistByDate($ReportDate);
            if ($check != "failure") {

                $result = ActiveUsersCollection::model()->updateActiveUsersDataExistByDate($ReportDate, $activeusers);
            } else {

                $result = ActiveUsersCollection::model()->saveActiveUsersData($ReportDate, $activeusers);
            }
        } catch (Exception $ex) {
            error_log("========in exception=================" . $ex->getMessage());
        }
    }

    public function SaveGroupActiveUsersBasedonDaterange() {
        try {

            $groupDetailObj = GroupCollection::model()->getAllGroupIds();
            $activeusers = 0;

            foreach ($groupDetailObj as $key => $group) {

                $groupId = $group->_id;

                $endDate = date('Y-m-d', strtotime("-1 day"));
                $startDate = date('Y-m-d', strtotime('-7 day' . $endDate));

                $ReportDate = date('Y-m-d', strtotime("-1 day"));
                $c = UserInteractionCollection::model()->getCollection();
                $keys = array("CreatedDate" => 1, "GroupId" => 1, "UserId" => 1);
                $initial = array("count" => 0);
                $reduce = "function (obj, prev) { prev.count++; }";
                $finalArray = array();
                $condition = array('condition' => array("GroupId" => $groupId, "userActivityIndex" => (int) 1, "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate)));
                $g = $c->group($keys, $initial, $reduce, $condition);
                $arr = $g['retval'];

                foreach ($arr as $value) {
                    if (!in_array($value['UserId'], $finalArray)) {
                        array_push($finalArray, $value['UserId']);
                    }
                }

                if (is_array($finalArray) && count($finalArray) > 0) {
                    $activeusers = count($finalArray);
                }

                $result = ActiveUsersCollection::model()->saveGroupWiseActiveUsersAnalyticsData($ReportDate, $activeusers, $groupId);
            }
        } catch (Exception $exc) {

            Yii::log("--------in exception SaveGroupActiveUsersBasedonDaterange--------------------" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @Author Vamsi KRishna
     * This method is used get getFollowingFollowerUsers
     * @param type $searchKey
     * @param type $userId
     * @return type
     */
    public function getGroupMembersForMentionsForPrivateGroup($searchKey, $groupId, $mentionArray = array()) {
        $userDetails = 'failure';
        $users = array();
        try {
            if (sizeof($mentionArray) > 0) {
                $mentionArray = array_map('intval', $mentionArray);
            }

            $groupDetails = GroupCollection::model()->getGroupDetailsById($groupId);

            if (sizeof($mentionArray) > 0) {
                $users = array_diff($groupDetails->GroupMembers, $mentionArray);
            } else {
                $users = $groupDetails->GroupMembers;
            }

            $userDetails = UserCollection::model()->getFollowingFollowerUsers($searchKey, $users);
        } catch (Exception $ex) {
            Yii::log("getFollowingFollowerUsers in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $userDetails;
    }

    public function SaveGroupComebackUsersBasedonDaterange() {
        try {

            $groupDetailObj = GroupCollection::model()->getAllGroupIds();
            $activeusers = 0;
            $combackusers = 0;

            foreach ($groupDetailObj as $key => $group) {

                $groupId = $group->_id;

                $endDate = date('Y-m-d', strtotime("-1 day"));
                $startDate = date('Y-m-d', strtotime('-1 day' . $endDate));

                $ReportDate = date('Y-m-d', strtotime("-1 day"));
                $c = UserInteractionCollection::model()->getCollection();
                $keys = array("CreatedDate" => 1, "GroupId" => 1, "UserId" => 1);
                $initial = array("count" => 0);
                $reduce = "function (obj, prev) { prev.count++; }";
                $finalArray = array();
                $condition = array('condition' => array("GroupId" => $groupId, "userActivityIndex" => (int) 1, "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate)));
                $g = $c->group($keys, $initial, $reduce, $condition);
                $arr = $g['retval'];

                foreach ($arr as $value) {

                    if (!in_array($value['UserId'], $finalArray)) {
                        array_push($finalArray, $value['UserId']);
                    }
                }

                $endDate2 = date('Y-m-d', strtotime("-1 day"));
                $startDate2 = date('Y-m-d', strtotime('-21 days' . $endDate2));

                $Comback_ReportDate = date('Y-m-d', strtotime("-1 day"));
                $c = UserInteractionCollection::model()->getCollection();
                $keys = array("CreatedDate" => 1, "GroupId" => 1, "UserId" => 1);
                $initial = array("count" => 0);
                $reduce = "function (obj, prev) { prev.count++; }";
                $comebackfinalArray = array();

                $condition = array('condition' => array("GroupId" => $groupId, "userActivityIndex" => (int) 1, "UserId" => array('$in' => $finalArray), "CreatedDate" => array('$gte' => $startDate2, '$lte' => $endDate2)));

                $g = $c->group($keys, $initial, $reduce, $condition);
                $arr = $g['retval'];

                foreach ($arr as $value) {
                    if (!in_array($value['UserId'], $comebackfinalArray)) {
                        array_push($comebackfinalArray, $value['UserId']);
                    }
                }

                if (is_array($comebackfinalArray) && count($comebackfinalArray) > 0) {
                    $combackusers = count($comebackfinalArray);
                }

                $result = ActiveUsersCollection::model()->saveGroupWiseCombackUsersAnalyticsData($ReportDate, $combackusers, $groupId);
            }
        } catch (Exception $exc) {

            Yii::log("--------in exception SaveGroupComebackUsersBasedonDaterange--------------------" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @param type $postId
     * @return type
     */
    public function getNewsPostObjectById($postId) {
        try {
            $object = CuratedNewsCollection::model()->getPostById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    public function getPostByIdService($postId) {
        try {
            $object = CuratedNewsCollection::model()->getPostById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    public function NotifyStreamOfPostedNewsService($postDetails, $IsNotifiable, $postId) {
        try {
            $object = CuratedNewsCollection::model()->NotifyStreamOfPostedNews($IsNotifiable, $postId);
            if ($object) {
                $streamBean = new PostManagementActionBean();
                $streamBean->PostId = $postId;
                $streamBean->ActionType = 'NewsNotify';
                $streamBean->CatagoryId = $postDetails->CategoryType;
                $streamBean->NetworkId = $postDetails->NetworkId;
                $streamBean->IsNotifiable = $IsNotifiable;
                $streamBean->UserId = $postDetails->UserId;
                Yii::app()->amqp->stream(json_encode($streamBean));
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    public function getPostIdByMigratedPostId($CategoryType, $PostId) {
        try {
            $postObj = 'failure';
            if ((int) $CategoryType == 2) {
                $postObj = CurbsidePostCollection::model()->getPostIdByMigratedPostId($PostId);
            } elseif ($CategoryType == 3) {
                $postObj = GroupPostCollection::model()->getPostIdByMigratedPostId($PostId);
            } else {
                $postObj = PostCollection::model()->getPostIdByMigratedPostId($PostId);
            }

            return $postObj;
        } catch (Exception $exe) {
            Yii::log($exe->getMessage(), 'error', 'application');
        }
    }

    public function PullBackNewsService($postDetails, $IsAbused, $postId) {
        try {
            $object = CuratedNewsCollection::model()->PullBackNews($IsAbused, $postId);
            $object_news = NewsCollection::model()->abusePost($postId, 'Abuse', $postDetails->UserId);
            if ($object && $object_news) {
                $streamBean = new PostManagementActionBean();
                $streamBean->PostId = $postId;
                $streamBean->ActionType = 'PullbackNews';
                $streamBean->CatagoryId = $postDetails->CategoryType;
                $streamBean->NetworkId = $postDetails->NetworkId;
                $streamBean->IsAbused = $IsAbused;
                $streamBean->UserId = $postDetails->UserId;
                Yii::app()->amqp->stream(json_encode($streamBean));
            } else {
                return 0;
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

    public function UpdateAllWebSnippetdata() {
        $returnValue = 'failure';
        $SnippetDetails = WebSnippetCollection::model()->getAllWebSnippets();


        foreach ($SnippetDetails as $key => $value) {


            $decode = array();
            $options = array(
                CURLOPT_RETURNTRANSFER => true, // return web page 
                CURLOPT_HEADER => false, // do not return headers 
                CURLOPT_FOLLOWLOCATION => true, // follow redirects 
                CURLOPT_USERAGENT => "spider", // who am i 
                CURLOPT_AUTOREFERER => true, // set referer on redirect 
                CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect 
                CURLOPT_TIMEOUT => 120, // timeout on response 
                CURLOPT_MAXREDIRS => 10, // stop after 10 redirects 
            );
            $ch = curl_init($value->Weburl);
            curl_setopt_array($ch, $options);
            $content = curl_exec($ch);
            $err = curl_errno($ch);
            $errmsg = curl_error($ch);
            $header = curl_getinfo($ch);
            curl_close($ch);

            //var_dump($data);
            if (strlen($content) == 0) {

                $decode['provider_url'] = $parsed['host'];
                $decode['description'] = "";
                $decode['title'] = "";
            } else {
                $text = preg_replace('/^(\<p\><a\><\a>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $value->Weburl);
                $text = str_replace('</a>', '', $value->Weburl);
                $weburl = urlencode($header['url']);
                $url = "https://api.embed.ly/1/oembed?key=a8d760462b7c4e4cbfc9d6cb2b5c3418&url=" . $weburl;
                $details = file_get_contents($url);
                $decode = CJSON::decode($details);
            }


//           $url = "https://api.embed.ly/1/oembed?key=96677167dd4e4dd494564433fe259ff9&url=" . $value->Weburl;

            if (is_array($decode) && count($decode) > 0 && $decode['provider_url'] != "") {

                $SnippetDetails = WebSnippetCollection::model()->updateWebSnippetDetails($value->_id, $decode);
            }
        }
        if ($SnippetId != 'failure') {
            $returnValue = $SnippetId;
        } else {
            $returnValue = 'failure';
        }

        return $returnValue;
    }

    public function DeleteTempDirectoryFiles() {

// Specify the target directory and add forward slash
        $dir = Yii::app()->params['ArtifactSavePath'];

        $dh = opendir($dir);
        if ($dh) {
            while ($file = readdir($dh)) {
                if (!in_array($file, array('.', '..'))) {
                    if (is_file($dir . $file)) {
                        unlink($dir . $file);
                    } else if (is_dir($dir . $file)) {
                        rmdir_files($dir . $file);
                    }
                }
            }
            // rmdir($dir);
        }
    }

    /**
     * @author Moin Hussain
     * @param $searchText,$offset,$pageLength
     * @return type PostCollections
     */
    public function getNewsForSearch($searchText, $offset, $pageLength) {
        return CuratedNewsCollection::model()->getNewsForSearch($searchText, $offset, $pageLength);
    } 
   
      /**
      * @author Suresh Reddy
      * Description: Method used to get the groups for which the user is a member with selected fields
      * @param type $UserId
      * @return $groupsCollectionUserFollowing
      */
    public function getUserFollowingGroupsIDs($UserId) {
        try {
            $groupsCollectionUserFollowing = 'failure';
            $userFollowingGroups = UserProfileCollection::model()->getUserFollowingGroups($UserId);
        } catch (Exception $ex) {
            Yii::log("----in exception -----groupsUserFollowing---------------" . $ex->getMessage(), 'error', 'application');
        }

        return $userFollowingGroups;
    }

    /**
     * @author Haribabu 
     * Description: Update  the track browserDetails created on date .
     * @param type $PostId
     * @return true
     */
    public function UpdateTrackBrowserDetailsPosts() {
        try {
            $returnValue = 'failure';


            $allposts = TrackBrowseDetailsCollection::model()->GetAllPosts();

            foreach ($allposts as $key => $value) {
//  
                $this->UpdateAllTrackBrowserPostsCreatedDate($value['_id'], $value['TimeStamp']);
                //  ServiceFactory::getSkiptaPostServiceInstance()->UpdateAllPostsCreatedDate($value['_id'],$value['TimeStamp']);
            }
            return $allposts;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function UpdateAllTrackBrowserPostsCreatedDate($postId, $createdDate) {
        try {
            $returnValue = 'failure';


            $allposts = TrackBrowseDetailsCollection::model()->UpdateAllPostsCreatedDate($postId, $createdDate);


            return $allposts;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
   }

 /**
    * @Author Swathi
    * This method is used get joyrideInfoData
    * @param type $searchKey
    * @return type
    */
    public function getJoyrideDetailsByModule($module) {
        try {
            $joyrideInfo = JoyrideInfo::model()->getJoyrideDetailsByModule($module);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred while executing getJoyrideDetailsByModule  in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $joyrideInfo;
    }
    
     public function getJoyrideDetails() {
        try {
            $joyrideInfo = JoyrideInfo::model()->getJoyrideDetails();
        } catch (Exception $ex) {
            Yii::log("Exception Occurred while executing getJoyrideDetailsByModule  in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $joyrideInfo;
    }
    
     public function enableOrDisableJoyRide($action,$userId) {
        try {
          
            $joyrideInfo = User::model()->enableOrDisableJoyRide($action,$userId);
        } catch (Exception $ex) {
            Yii::log("Exception Occurred while executing enableOrDisableJoyRide  in SkiptaPostService==" . $ex->getMessage(), 'error', 'application');
        }
        return $joyrideInfo;
    }
    
       public function  getPostDetailsByStreamId($postId){
        try {       
            $returnValue='failure';
            //echo "inservice";
            $Postdetails = UserStreamCollection::model()->getStreamObjbyStreamId($postId,$createdDate); 
            
           
            return $Postdetails;

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
       
     }
      /**
     * 
     * @param type $postId
     * @return type
     */
    public function getCareerPostObjectById($postId) {
        try {
            $object = Careers::model()->getCareerPostById($postId);
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }
    
    public function getCurbsidePostsByCategory($categoryId, $offset, $pageLength, $userId) {
        $posts = CurbsidePostCollection::model()->getCurbPostsForCategory($categoryId, $offset, $pageLength);
        return $posts;
    }
    
    
     public function getPostsForHashtagSearch($hashtagId, $offset, $pageLength) {
         
         $hashtagArray = HashTagCollection::model()->getHashTagsById($hashtagId);


        $PostIdsArray = array_slice($hashtagArray->Post, $offset, $pageLength);
        $CurbPostsIdsArray = array_slice($hashtagArray->CurbsidePostId, $offset, $pageLength);
        $GroupPostIdsArray = array_slice($hashtagArray->GroupPostId, $offset, $pageLength);


        $posts = PostCollection::model()->getPostHashtagsById($PostIdsArray);


        $curbPosts = CurbsidePostCollection::model()->getCurbPostsForHashtagSearch($CurbPostsIdsArray);
        $GroupPosts = GroupPostCollection::model()->getGroupPostsForHashtagSearch($GroupPostIdsArray);
        $GamePosts = GameCollection::model()->getGamePostHashtagsById($PostIdsArray);
        return array_merge($posts, $curbPosts, $GroupPosts,$GamePosts);
    }
    public function getUserBadgeCollectionById($Id) {
        try {
            $object = UserBadgeCollection::model()->getUserBadgeCollectionById($Id);
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }
     public function getBadgeById($Id) {
        try {
            $object = Badges::model()->getBadgeById($Id);
        } catch (Exception $exc) {
            error_log("##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }

        public function getGroupDisableWebPreviewByGroupId($groupId, $category) {
        try {
            $returnValue = 0;
            if ($category == 'Group') {
                $groupObj = GroupCollection::model()->getGroupDetailsById($groupId);
                $returnValue =$groupObj->DisableWebPreview ;
            } else {
                $groupObj = SubGroupCollection::model()->getSubGroupDetailsById($groupId);
                $returnValue =$groupObj->DisableWebPreview ;
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
  }

?>
