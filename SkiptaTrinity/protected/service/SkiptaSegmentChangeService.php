<?php

class SkiptaSegmentChangeService {

    /**
     *  This method is used to save the post 
     *   @params postObj and HashTagArray from the controller
     */
    public function changeSegmentProcessByUserId($tinyUserObject) {
        try {
            $userId = $tinyUserObject->UserId;
            $segmentId = $tinyUserObject->SegmentId;
            $networkId = $tinyUserObject->NetworkId;
            $userClassification = $this->tinyObject->UserClassification;
            //update normal posts
//            PostCollection::model()->updateSegmentIdNetworkIdByUserId($userId, $networkId, $segmentId);
//            CurbsidePostCollection::model()->updateSegmentIdNetworkIdByUserId($userId, $networkId, $segmentId);
//            UserStreamCollection::model()->updateSegmentIdNetworkIdByUserId($userId, $networkId, $segmentId);
//            FollowObjectStream::model()->updateSegmentIdNetworkIdByUserId($userId, $networkId, $segmentId);
//            UserActivityCollection::model()->updateSegmentIdNetworkIdByUserId($userId, $networkId, $segmentId);
//            UserInteractionCollection::model()->updateSegmentIdNetworkIdByUserId($userId, $networkId, $segmentId);
            /** unfollow Groups * */
            GroupCollection::model()->userUnfollowAllGroups($userId);
            /**
             * added below peace for save networkid, segmentid, language of original
             * @developer reddy
             */
            $groups = ServiceFactory::getSkiptaGroupServiceInstance()->getAllAutoFollowGroups($networkId, $segmentId);
            if (!is_string($groups)) {
                foreach ($groups as $group) {
                    ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToGroup($group->_id, $userId, 'Follow', '',$userClassification);
                }
            }
        } catch (Exception $exc) {
            error_log($exc->getTraceAsString() . "##########Exception Occurred###############" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
        }
        return $object;
    }
    
    public function updateSegmentforAdmin($userId, $segmentId){
        
        UserCollection::model()->updateSegmentByUserId($userId, $segmentId);
    }

}

?>
