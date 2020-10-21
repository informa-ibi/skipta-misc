<?php


 /**
   * @author Swathi
   * This class is used to assign badges for the existing user in the app
   */
class BadgingCommand extends CConsoleCommand {

    public function run($args) {
        echo "Badging Command started";
        $this->assignBadgesToExistingUsers();
    }

   /**
     * @author Swathi
     * This is used to assign badge for each user
     */
    public function assignBadgesToExistingUsers() {
        try {


            $users = User::model()->getAllActiveUsers();
            foreach ($users as $user) {
                echo '---UserId is  ' . $user['UserId'];
                $this->assignBadgeToUser($user['UserId']);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }
    
    
    /**
     * @author Swathi
     * This is used to assign badge to  user for each badge context
     */

    public function assignBadgeToUser($userId) {
        try {

            $badgeDetails = Badges::model()->getBadgeDetails();
            foreach ($badgeDetails as $badge) {
                $this->assignBadgeToUserBasedOnContext($badge, $userId);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }
    
    /**
     * @author Swathi
     * This is used to assign badge to user based on the context
     * @param Object  $badge Badges object
     * @param int  $userId userId 
     */

    public function assignBadgeToUserBasedOnContext($badge, $userId) {
        try {

            $postType = CommonUtility::sendPostType('Badge');
            $categoryId = CommonUtility::getIndexBySystemCategoryType('Badge');
             $metaObj= CommonUtility::getUserMetaCollectionObjByUserId($userId);
            
            if (!$badge->has_level) {
                
                /* If the badge has no levels */
                $badgeCollectionObjSave = "";
                if ($badge->context == "FirstLogin") {
                    $badgeCollectionObjSave = CommonUtility::badgesSavingInterceptor($badge->context, $userId, '');
                } else if ($badge->context == "MobileFirstLogin") {
                    $isLogin = ServiceFactory::getSkiptaUserServiceInstance()->checkMobileLogin($userId);
                    if ($isLogin)
                        $badgeCollectionObjSave = CommonUtility::badgesSavingInterceptor($badge->context, $userId, '');
                }
                else if ($badge->context == "FirstComment") {
                    $userInteractionCollection = UserInteractionCollection::model()->getUserActionsByUserId($userId, "Comment");
                    $compareCount = count($userInteractionCollection);
                    if ($compareCount >= 1) {
                        $this->saveUserMetaCollection($userId, "Comments", $compareCount);
                        $badgeCollectionObjSave = CommonUtility::badgesSavingInterceptor($badge->context, $userId, '');
                    }
                } else if ($badge->context == "FirstPost") {
                    $userPostCollection = PostCollection::model()->getAllStreamTypePostsByUserId($userId);
                    $compareCount = count($userPostCollection);
                    if ($compareCount >= 1) {
                        $this->saveUserMetaCollection($userId, "Posts", $compareCount);
                        $badgeCollectionObjSave = CommonUtility::badgesSavingInterceptor($badge->context, $userId, '');
                    }
                } else if ($badge->context == "CurbsidePosts") {
                    $userCPostCollection = CurbsidePostCollection::model()->getAllCurbsidePostsByUserId($userId);
                    $compareCount = count($userCPostCollection);
                    if ($compareCount >= 1) {
                        $this->saveUserMetaCollection($userId, "CurbsidePosts", $compareCount);
                        $badgeCollectionObjSave = CommonUtility::badgesSavingInterceptor($badge->context, $userId, '');
                    }
                } else if ($badge->context == "FirstHashTag") {
                    $compareCount = $this->calculateHashTagsUsageByUserId($userId);
                    if ($compareCount >= 1) {
                        $this->saveUserMetaCollection($userId, "HashTags", $compareCount);
                        $badgeCollectionObjSave = CommonUtility::badgesSavingInterceptor($badge->context, $userId, '');
                    }
                }
//                if ($badge->stream_effect && $badgeCollectionObjSave != "") {
//                    //prepare stream obj and save in the userstream collection obj.
//                    $result = ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($postType, $badgeCollectionObjSave, $userId, 'Follow', $categoryId);
//                    if (!CommonUtility::prepareStreamObject($userId, "Post", $badgeCollectionObjSave, CommonUtility::getIndexBySystemCategoryType('Badge'), '', '')) {
//                        // return "failure";
//                    }
//                }
                if($badgeCollectionObjSave!="")
                    {
                         UserBadgeCollection::model()->updateBadgeShownToUser($badgeCollectionObjSave);
                    }
            } else {
                
                 /* If the badge has levels */
                
                $compareCount = 0;

                if ($badge->context == "UserFollow") {

                    $userProfileColelction = UserProfileCollection::model()->getUserFollowersFollowingsByUserId($userId);

                    if ($userProfileColelction != "failure" && count($userProfileColelction->userFollowing) > 0) {
                        //Save in userMetaCollection
                        $compareCount = count($userProfileColelction->userFollowing);

                        $this->saveUserMetaCollection($userId, "UserFollowing", $compareCount);
                       
                    }
                } else if ($badge->context == "Love") {

                    $userInteractionCollection = UserInteractionCollection::model()->getUserActionsByUserId($userId, "Love");
                    $compareCount = count($userInteractionCollection);
                     //Save in userMetaCollection
                    $this->saveUserMetaCollection($userId, "Loves", $compareCount);
                } else if ($badge->context == "UserFollowers") {
                    $userProfileColelction = UserProfileCollection::model()->getUserFollowersFollowingsByUserId($userId);

                    if ($userProfileColelction != "failure" && count($userProfileColelction->userFollowers) > 0) {
                        //Save in userMetaCollection
                        $compareCount = count($userProfileColelction->userFollowers);
                        $this->saveUserMetaCollection($userId, "Followers", $compareCount);
                    }
                } else if ($badge->context == "Comments") {
                    $userInteractionCollection = UserInteractionCollection::model()->getUserActionsByUserId($userId, "Comment");
                    $compareCount = count($userInteractionCollection);
                    $this->saveUserMetaCollection($userId, "Comments", $compareCount);
                }
                
                /* save badges for each level based on the no.of units for each level */
                if ($compareCount > 0)
                    $this->insertBadgesForEachLevel($badge, $userId, $compareCount);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }

     /**
     * @author Swathi
     * This is used to assign badge to user based on the context  for each level
     * @param Object  $badgeInfo Badges object
     * @param int  $userId userId 
     * @param int  $countCompareValue count to be compared with the badge-level unit value 
     */

    
    public function insertBadgesForEachLevel($badgeInfo, $userId, $countCompareValue) {
        try {
            $userBadgeLevel = 0;
            $userBadgeCollection = CommonUtility::getUserBadgeCollection($userId, $badgeInfo->id, 1);
            if (count($userBadgeCollection) > 0)
                $userBadgeLevel = $userBadgeCollection->BadgeLevelValue;
            $postType = CommonUtility::sendPostType('Badge');
            $categoryId = CommonUtility::getIndexBySystemCategoryType('Badge');
            /* if we need to insert multi level using bg job at new definition
             * of level.
             */
            // $userBadgeLevel=2;
            $userBadgeLevel > 0 ? $userBadgeLevel++ : $userBadgeLevel;
            $badgeLevelsCount = BadgesLevel::model()->getBadgeDetailsCountByBadgeId($badgeInfo->id);
            $badgeLevels = BadgesLevel::model()->getBadgeDetailsByBadgeId($badgeInfo->id, '', 0, $badgeLevelsCount);



            $badgeLevels = BadgesLevel::model()->getBadgeDetailsByBadgeId($badgeInfo->id, '', $userBadgeLevel, count($badgeLevels));

            if (count($badgeLevels) > 0) {
                foreach ($badgeLevels as $badgeLevel) {

                    if ($countCompareValue >= $badgeLevel->unitValue) {
                        $badgeCollectionObjSave = CommonUtility::saveBadgeCollection($badgeInfo, $userId, $badgeInfo->has_level);
                        if ($badgeCollectionObjSave != "") {
                            $countCompareValue = $countCompareValue - $badgeLevel->unitValue;
                            if ( $badgeCollectionObjSave != "") {
                                UserBadgeCollection::model()->updateBadgeShownToUser($badgeCollectionObjSave);
                                //prepare stream obj and save in the userstream collection obj for each level object saved.
                                $result = ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($postType, $badgeCollectionObjSave, $userId, 'Follow', $categoryId);
                                if($badgeInfo->stream_effect)
                                {if (!CommonUtility::prepareStreamObject($userId, "Post", $badgeCollectionObjSave, $categoryId, '', '')) {
                                    // return "failure";
                                 }
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception $exc) {
            
        }
    }
    
     /**
     * @author Swathi
     * This is used to save data in the user meta collection
     * @param Object  $badgeInfo Badges object
     * @param int  $userId userId 
     * @param int  $countCompareValue count to be saved against the badge context
     */


    public function saveUserMetaCollection($userId, $context, $countValue) {
        $metaObj = CommonUtility::getUserMetaCollectionObjByUserId($userId);
        if ($metaObj != "failure") {
            $prepareMetaObj = array("UserId" => $userId, "Followers" => 0, "UserFollowing" => 0, "Loves" => 0, "Comments" => 0, "Posts" => 0, "CurbsidePosts" => 0, "HashTags" => 0);

            if (count($metaObj) == 0) {
                $prepareMetaObj[$context] = $countValue;
                $res = UserMetaCollection::model()->saveUserMetaCollection($prepareMetaObj);
            } else if (count($metaObj) > 0) {

                $res = UserMetaCollection::model()->updateUserMetaCollectionByProperty($metaObj, $countValue, $userId, $context);
            }
        }
    }

    /**
     * @author Swathi
     * This is used to calculate all the hashtags used in the posts
     * @param int $userId Description 
     * @return type
     */
    public function calculateHashTagsUsageByUserId($userId) {
        $hashTagsCount = 0;
        try {
            $userPostCollectionHashTags = PostCollection::model()->getAllStreamTypePostsByUserId($userId);
            foreach ($userPostCollectionHashTags as $post) {
                if (count($post->HashTags) > 0)
                    $hashTagsCount+=count($post->HashTags);
            }
            $userCPostCollectionHashTags = CurbsidePostCollection::model()->getAllCurbsidePostsByUserId($userId);
            foreach ($userCPostCollectionHashTags as $post) {
                if (count($post->HashTags) > 0)
                    $hashTagsCount+=count($post->HashTags);
            }
            $userGPostCollectionHashTags = GroupPostCollection::model()->getAllGroupPostsByUserId($userId);
            foreach ($userGPostCollectionHashTags as $post) {
                if (count($post->HashTags) > 0)
                    $hashTagsCount+=count($post->HashTags);
            }
            return $hashTagsCount;
        } catch (Exception $ex) {
            
        }
    }

}
