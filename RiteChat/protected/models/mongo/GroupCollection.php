<?php

/**
 * This collection is used to create a new group
 * @author Praneeth
 */
class GroupCollection extends EMongoDocument {

    public $_id;
    public $CreatedUserId;
    public $GroupName;
    public $CreatedOn;
    public $GroupBannerImage;
    public $GroupShortDescription;
    public $GroupDescription;
    public $GroupFollowers;
    public $GroupProfileImage;
    public $GroupMembers = array();
    public $LastUpdatedBy;
    public $GroupAdminUsers = array();
    public $PostIds = array();
    public $SubGroups = array();
    public $IsIFrameMode=0;
    public $IFrameURL='';
    public $IsPrivate = 0;
    public $AutoFollow = 0;
    public $MigratedGroupId;
    public $CustomGroup=0;
    public $GroupMenu=1;
    public $IsHybrid=0;
    public $CustomGroupName="";
    public $ConversationVisibility;
    public $AddSocialActions;
    public $DisableWebPreview;
    public $IsDeleted = 0;

    public function getCollectionName() {
        return 'GroupCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_CreatedUserId' => array(
                'key' => array(
                    'CreatedUserId' => EMongoCriteria::SORT_DESC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                    'GroupName' => EMongoCriteria::SORT_ASC,
                ),
            ),
            'index_CreatedOn' => array(
                'key' => array(
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                    'GroupName' => EMongoCriteria::SORT_ASC,
                ),
            ),
            'index_GroupName' => array(
                'key' => array(
                    'GroupName' => EMongoCriteria::SORT_ASC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
            '_id' => '_id',
            'CreatedUserId' => 'CreatedUserId',
            'GroupName' => 'GroupName',
            'CreatedOn' => 'CreatedOn',
            'GroupShortDescription' => 'GroupShortDescription',
            'GroupDescription' => 'GroupDescription',
            'GroupFollowers' => 'GroupFollowers',
            'GroupProfileImage' => 'GroupProfileImage',
            'GroupMembers' => 'GroupMembers',
            'GroupBannerImage' => 'GroupBannerImage',
            'LastUpdatedBy' => 'LastUpdatedBy',
            'GroupAdminUsers' => 'GroupAdminUsers',
            'PostIds' => 'PostIds',
            'SubGroups' => 'SubGroups',
            'IsIFrameMode' => 'IsIFrameMode',
            'IFrameURL' => 'IFrameURL',
            'IsPrivate' => 'IsPrivate',
            'AutoFollow' => 'AutoFollow',
            'MigratedGroupId' => 'MigratedGroupId',
            'IsDeleted' => 'IsDeleted',
            /**********Custom group related fields********/
            'CustomGroup' => 'CustomGroup',
            'GroupMenu' => 'GroupMenu',
            'IsHybrid' => 'IsHybrid',
            'CustomGroupName' => 'CustomGroupName',
            'ConversationVisibility'=>'ConversationVisibility',
            'AddSocialActions'=>'AddSocialActions',
            'DisableWebPreview'=>'DisableWebPreview',
            
        );
    }

    /**
     * @author Praneeth
     * @param type $Groupid
     * @method TO Create a new group
     * @return object type id value
     */
    public function saveNewGroup($groupObj) {
        try {
            $returnValue = 'failure';
            $NewGroupObj = new GroupCollection();
            $NewGroupObj->GroupName = trim($groupObj->GroupName);
            $NewGroupObj->CreatedUserId = (int) $groupObj->UserId;
            if (isset($groupObj->CreatedOn) && !empty($groupObj->CreatedOn)) {
                $NewGroupObj->CreatedOn = new MongoDate(strtotime($groupObj->CreatedOn));
            } else {
                $NewGroupObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            }
            // $NewGroupObj->GroupShortDescription = $groupObj->ShortDescription;
            $NewGroupObj->GroupDescription = $groupObj->Description;
            $NewGroupObj->GroupFollowers = array();
            $NewGroupObj->GroupMembers = array();
            array_push($NewGroupObj->GroupMembers, (int) $groupObj->UserId);
            if (isset(Yii::app()->session['PostAsNetwork']) && (Yii::app()->session['PostAsNetwork'] != 1) && (Yii::app()->session['NetworkAdminUserId'] != $groupObj->UserId) && Yii::app()->params['PostAsNetwork']=='ON') {
                array_push($NewGroupObj->GroupMembers, (int) (Yii::app()->session['NetworkAdminUserId']));
            }
            array_push($NewGroupObj->GroupAdminUsers, (int) $groupObj->UserId);
            array_push($NewGroupObj->GroupAdminUsers, (int) Yii::app()->session['NetworkAdminUserId']);
            $NewGroupObj->GroupAdminUsers=  array_unique(array_values($NewGroupObj->GroupAdminUsers));
            $NewGroupObj->GroupBannerImage = '/images/system/nogroup.png';
            if (isset($groupObj->GroupProfileImage) && !empty($groupObj->CreatedOn)) {
                $NewGroupObj->GroupProfileImage = $groupObj->GroupProfileImage;
            } else {
                $NewGroupObj->GroupProfileImage = '/images/system/toolboxlogo.png';
            }            
            if(isset($groupObj->IFrameMode) &&  $groupObj->IFrameMode == 2){
                $NewGroupObj->IsIFrameMode = (int) 0;
                $NewGroupObj->IsHybrid = (int) 0;
                //$NewGroupObj->ConversationVisibility = (int) 0;
            }else{
//                $NewGroupObj->ConversationVisibility = (int) 1;
                $NewGroupObj->IsIFrameMode = (int) $groupObj->IFrameMode;
            }              
            $NewGroupObj->ConversationVisibility = (int) $groupObj->ConversationVisibility;
            $NewGroupObj->IFrameURL = $groupObj->IFrameURL;
            $NewGroupObj->AutoFollow = (int) $groupObj->AutoFollow;
            $NewGroupObj->IsPrivate = (int) $groupObj->IsPrivate;

            $NewGroupObj->AddSocialActions = (int) $groupObj->AddSocialActions;
            $NewGroupObj->DisableWebPreview = (int) $groupObj->DisableWebPreview;

            $NewGroupObj->MigratedGroupId = isset($groupObj->MigratedGroupId) ? $groupObj->MigratedGroupId : "";
            // Add the Network Admin as the default follower of the group and also hardcoded the groupmember Id as 1. As the 
            //Network Admin will be created first and Jobs will be Run next.
            if (isset($groupObj->MigratedGroupId) && ($groupObj->MigratedGroupId != '')) {
                $admin = User::model()->checkUserExist(YII::app()->params['NetworkAdminEmail']);
                array_push($NewGroupObj->GroupMembers, (int) $admin->UserId);
            }            
            $NewGroupObj->CustomGroup = ($groupObj->IFrameMode   == 2)? (int)1 : (int)0;
            $NewGroupObj->GroupMenu = !empty($groupObj->GroupMenu)?(int)$groupObj->GroupMenu:(int)0;
            //$NewGroupObj->IsDeleted = (int) $groupObj->IsDeleted;
            if ($NewGroupObj->save()) {
                $returnValue = $NewGroupObj->_id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("########Exception Occurred#######".$exc->getMessage());
            Yii::log("-----inside exception ---SaveNewGroup------" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Vamsi Krishna
     * @param type $Groupid
     * @description This method is used to get the groupDetails
     * @return object type MongoId
     */
    public function getGroupDetailsById($groupId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($groupId));
            $groupObj = GroupCollection::model()->find($criteria);
            if (is_object($groupObj)) {
                $returnValue = $groupObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    /**
     * @author Praneeth
     * Description: Method to get the groups in which user is a member
     * @param type $groupIdsArray
     * @return Groupsdetails
     */
    public function userFollowingGroupsList($groupIdsArray) {
        try {
            $groupsFollowingObj = "";
            $resultArray = array();
            $returnValue = 'noGroups';
            $array = array(
                'limit' => 8,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
            $criteria = new EMongoCriteria($array);
            // $criteria->setSelect(array('_id'=>true,'GroupName'=>true));
            $criteria->_id('in', $groupIdsArray);
            $groupsFollowingObj = GroupCollection::model()->findAll($criteria);
        } catch (Exception $ex) {
            Yii::log("-------------inside exception ---userFollowingOfGroups--------------" . $ex->getMessage(), 'error', 'application');
        }

        return $groupsFollowingObj;
    }

    /**
     * @author Praneeth
     * Description: Method to get more groups in which user is a member
     * @param type $groupIdsArray, $startLimit, $pageLength
     * @return Groupsdetails
     */
    public function userMoreFollowingGroupsList($groupIdsArray, $startLimit, $pageLength) {
        try {
            $array = array(
                'limit' => 8,
                'offset' => $startLimit,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
            $criteria = new EMongoCriteria($array);
            $criteria->_id('in', $groupIdsArray);
            $groupsFollowingObj = GroupCollection::model()->findAll($criteria);
            if (isset($groupsFollowingObj)) {
                $returnValue = $groupsFollowingObj;
            }
        } catch (Exception $ex) {
            Yii::log("-------------userMoreFollowingGroupsList---------------------------" . $ex->getMessage(), 'error', 'application');
        }
        return $returnValue;
    }

    /**
     * author Vamsi Krishna 
     *  This method is used to update the Group Details
     * @param type $userId
     * @param type $type
     * @param type $value
     */
    public function updateGroupDetails($userId, $value, $type, $groupId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;

            $mongoModifier->addModifier($type, 'set', $value);
            $mongoModifier->addModifier('LastUpdatedBy', 'set', $userId);
            $mongoCriteria->addCond('_id', '==', new MongoID($groupId));
            GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            $returnValue = "success";
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     */
    public function followOrUnfollowGroup($groupId, $userId, $actionType) {
        try {
            error_log($groupId."---".$userId."----".$actionType);
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if (trim($actionType) == 'Follow') {
                $mongoModifier->addModifier('GroupMembers', 'push', (int) $userId);
                $mongoCriteria->addCond('GroupMembers', '!=', (int) $userId);
            } else if (trim($actionType) == 'UnFollow') {                
                $mongoModifier->addModifier('GroupMembers', 'pull', $userId);
            }

            $mongoCriteria->addCond('_id', '==', new MongoId($groupId));
            $returnValue = GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $ex) {
            Yii::log("-----" . $ex->getMessage(), 'error', 'application');
        }
    }

    public function getUserGroupCount($userId) {
        try {
            $countValue = 'noGroups';
            $criteria = new EMongoCriteria();
            $criteria->_id('in', $groupIdsArray);
            $countValue = GroupCollection::model()->count($criteria);
        } catch (Exception $exc) {
            Yii::log("------" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Vamsi Krishna
     * This method is used to update Group with Array Type
     * @param MongoId $groupId 
     * @param MongoId $value
     * @param MongoId $type
     */
    public function updateGroupCollectionForArrayType($groupId, $value, $type) {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($type == 'PostIds') {
                $mongoModifier->addModifier($type, 'push', new MongoId($value));
            }
            if ($type == 'GroupAdminUsers') {
                $mongoModifier->addModifier($type, 'push', new MongoId($value));
            }
            if ($type == 'SubGroups') {
                $mongoModifier->addModifier($type, 'push', new MongoId($value));
            }
            $mongoCriteria->addCond('_id', '==', new MongoId($groupId));
            $returnValue = GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            Yii::log("----" . $exc->getMessage(), 'error', 'application');
        }
    }

    /* This method checks whether the group exist or not
     */

    public function checkIfGroupExist($model) {
        try {
            $result = 'false';
            $groupName = trim($model->GroupName);
            $groupIsExists = GroupCollection::model()->findByAttributes(array("GroupName" => $groupName, "IsDeleted" => 0));
            if (isset($groupIsExists)) {
                $result = 'true';
            } else {
                $result = 'false';
            }
        } catch (Exception $ex) {
            Yii::log("=====checkIfGroupExist========" . $ex->getMessage(), "error", "application");
        }
        return $result;
    }

    public function getGroupIdByName($groupName) {
        try {
            $returnValue = 'failure';
            $groupName = str_replace("%20", " ", $groupName);
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id' => true));
            $criteria->addCond('GroupName', '==', $groupName);
            $groupObj = GroupCollection::model()->find($criteria);
            if (is_object($groupObj)) {
                $returnValue = $groupObj->_id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function updateGroupCollectionForDelete($obj, $groupId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;

            if ($obj->ActionType == 'Block' || $obj->ActionType == 'Abuse' || $obj->ActionType == 'Delete') {
                $mongoModifier->addModifier('PostIds', 'pop', $obj->PostId);
            } else if ($obj->ActionType == 'Release') {
                $mongoModifier->addModifier('PostIds', 'push', new MongoID($obj->PostId));
            }

            $mongoCriteria->addCond('_id', '==', new MongoID($groupId));
            GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            $returnValue = "success";
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function getGroupObjectByName($groupName) {
        $returnValue = 'failure';
        try {
            $groupName = str_replace("%20", " ", $groupName);
            $criteria = new EMongoCriteria;
            $criteria->addCond('GroupName', '==', $groupName);
            $groupObj = GroupCollection::model()->find($criteria);
            if (is_object($groupObj)) {
                $returnValue = $groupObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    /**
     * @author Karteek V
     * This method is used to fetche the total no. of counts in the Group Collection
     * @return type
     */
    public function getGroupsCount() {
        try {
            return count(GroupCollection::model()->findAllByAttributes(['IsDeleted' => 0]));
            
        } catch (Exception $ex) {
            error_log("#####Exception Occurred in the GetGroupsCount######" . $ex->getMessage());
        }
    }

    /**
     * ---------------------------Purpose: For DataMigration ---------------------
     * @Method:This method is used to get the group id by using group name
     * @param type $groupName
     * @return type object
     *  @author Praneeth
     */
    public function getGroupIdByGroupName($groupName) {
        try {
            $returnValue = 'Nogroup';
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('GroupName', 'equals', $groupName);
            $groupObj = GroupCollection::model()->find($mongoCriteria);
            $returnValue = $groupObj;
            //Yii::log("--------%%%%%%%%%%%------".print_r($returnValue,true), 'error', 'application');
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("--------in exception----------getGroupIdByGroupName------" . $exc->getMessage(), 'error', 'application');
        }
    }

    public function checkIsGroupAdminById($groupostobject) {
        try {

            $returnValue = 'false';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($groupostobject->GroupId));
            $criteria->addCond('GroupAdminUsers', 'equals', $groupostobject->UserId);
            $groupObj = GroupCollection::model()->find($criteria);
            if (is_object($groupObj)) {
                $returnValue = 'true';
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get checkIsGroupAdminById_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function getAllGroupIds() {
        try {
            $returnValue = 'failure';

            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id' => true));
            $criteria->setSelect(array('GroupName' => true));
            $groupObj = GroupCollection::model()->findAll($criteria);
//            if(is_object($groupObj)){
//                $returnValue=$groupObj;
//            }
            return $groupObj;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function findGroupBySubgroupId($subgroupId) {
        try {
            $returnValue = 'failure';

            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id' => true));
            $criteria->addCond('SubGroups', 'in', array(new MongoId($subgroupId)));
            $groupObj = GroupCollection::model()->find($criteria);
//            if(is_object($groupObj)){
//                $returnValue=$groupObj;
//            }
            return $groupObj->_id;
        } catch (Exception $exc) {
            error_log("f Exception indGroupBySubgroupId------------" . $exc->getMessage());
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function getAllAutoFollowGroups() {
        $returnValue = 'failure';
        try {
            $criteria = new EMongoCriteria;
            $mongoCriteria->setSelect(array('_id' => true));
            $criteria->addCond('AutoFollow', '==', (int) 1);
            $groups = GroupCollection::model()->findAll($criteria);
            if (is_array($groups) || is_object($groups)) {
                $returnValue = $groups;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in ___" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function checkUserFollowAgroup($userId, $object) {
        try {
            
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('GroupMembers' => true));
            $criteria->addCond("_id", "==", new MongoId($object->GroupId));
            $groupObj = GroupCollection::model()->find($criteria);
            if (isset($groupObj->GroupMembers)) {
                return in_array($userId, $groupObj->GroupMembers);
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            
        }
    }

    public function getGroupByIds($postId) {
        try {
            $returnArr = array();
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($postId));
            $groupCollectionObj = GroupPostCollection::model()->find($criteria);
//            $criteria = new EMongoCriteria;
//            $criteria->addCond('_id', '==', new MongoID($groupCollectionObj->GroupId));
//            $postObj = GroupCollection::model()->find($criteria);
            if (is_object($groupCollectionObj)) {
                $returnArr['PostId'] = $postId;
                $returnArr['FollowCount'] = count($groupCollectionObj->Followers);
            }
            return $returnArr;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public function getGroupDetailsByMigratedId($groupId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('MigratedGroupId', '==', $groupId);
            $groupObj = GroupCollection::model()->find($criteria);
            if (is_object($groupObj)) {
                $returnValue = $groupObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }

    public function getGroupDetailsWithoutGroupMembersByGroupId($groupId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id' => true, 'GroupName' => true));
            $criteria->addCond('_id', '==', new MongoID($groupId));
            $groupObj = GroupCollection::model()->find($criteria);
            if (is_object($groupObj)) {
                $returnValue = $groupObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("" . $exc->getMessage(), 'error', 'application');
        }
    }
     public function getAllNativeGroupIds() {
        try {
            $returnValue = 'failure';

            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id' => true));
            $criteria->setSelect(array('GroupName' => true));
            $criteria->addCond('IsIFrameMode', '==', (int)0);
            $groupObj = GroupCollection::model()->findAll($criteria);
//            if(is_object($groupObj)){
//                $returnValue=$groupObj;
//            }
            return $groupObj;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______" . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    
     /**
     * @author swathi
     * Description: Method to get the groups in which user is a member
     * @param type $groupIdsArray
     * @return Groupsdetails
     */
    public function userGroupsList($groupIdsArray,$startLimit,$pageLength) {
        try {
            $groupsFollowingObj = "";
            $resultArray = array();
            $returnValue = 'noGroups';
            if($pageLength==0)
            {
                 $array = array(
               
               'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
            }
            else {
                       $array = array(
                            'limit' =>5,
                           'offset' => $startLimit,
                           'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
                       );
            }
            $criteria = new EMongoCriteria($array);
            // $criteria->setSelect(array('_id'=>true,'GroupName'=>true));
            if(count($groupIdsArray)>0)
            $criteria->_id('in', $groupIdsArray);
            $groupsFollowingObj = GroupCollection::model()->findAll($criteria);
        } catch (Exception $ex) {
            Yii::log("-------------inside exception ---userFollowingOfGroups--------------" . $ex->getMessage(), 'error', 'application');
        }

        return $groupsFollowingObj;
    }
    
     /**
     * @author Ankit
     * Description: Method to delete toolbox
     * @param type $groupId
     */
    public function deleteGroup($groupId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;

            $mongoModifier->addModifier('IsDeleted', 'set', 1);
            $mongoCriteria->addCond('_id', '==', new MongoID($groupId));
            GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            $returnValue = "success";
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    

}