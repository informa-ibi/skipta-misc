<?php
/**
 * This collection is used to create a new group
 * @author Praneeth
 */
class SubGroupCollection extends EMongoDocument {

    public $_id;    
    public $CreatedUserId;
    public $SubGroupName;
    public $CreatedOn;
    public $GroupId;
    public $SubGroupBannerImage;  
    public $SubGroupDescription;
    public $SubGroupFollowers;
    public $SubGroupProfileImage;
    public $SubGroupMembers=array();
    public $LastUpdatedBy;
    public $SubGroupAdminUsers=array();
    public $PostIds=array();
    public $Status;
    public $ShowPostInMainStream=0;
    public $AddSocialActions;
    public $DisableWebPreview;

    


    

    public function getCollectionName() {
        return 'SubGroupCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_CreatedUserId' => array(
                'key' => array(
                    'CreatedUserId' => EMongoCriteria::SORT_ASC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                    'SubGroupName' => EMongoCriteria::SORT_ASC,
                ),
            ),
            'index_SubGroupName' => array(
                'key' => array(
                    'SubGroupName' => EMongoCriteria::SORT_ASC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                ),
            ),
        );
    }
    public function attributeNames() {
        return array(
            '_id'=>'_id',            
            'CreatedUserId' => 'CreatedUserId',
            'SubGroupName' => 'SubGroupName',
            'CreatedOn' => 'CreatedOn',
            'SubGroupDescription' => 'SubGroupDescription',
            'SubGroupFollowers'=>'SubGroupFollowers',            
            'SubGroupProfileImage' => 'SubGroupProfileImage',  
            'SubGroupMembers'=>'SubGroupMembers',
            'SubGroupBannerImage'=>'SubGroupBannerImage',
            'LastUpdatedBy'=>'LastUpdatedBy',
            'SubGroupAdminUsers'=>'SubGroupAdminUsers',
            'PostIds'=>'PostIds',
            'GroupId'=>'GroupId',
            'ShowPostInMainStream'=>'ShowPostInMainStream',
            'AddSocialActions'=>'AddSocialActions',
             'DisableWebPreview'=>'DisableWebPreview',

        );
    }
/**
     * @author Vamsi Krishna
     * @param type SubGroupObj
     * @method TO Create a new Subgroup
     * @return object type MongoId value
     */
public function saveSubGroup($groupObj) {
        try {
            $returnValue = 'failure';
            $NewGroupObj = new SubGroupCollection();
            $NewGroupObj->SubGroupName = trim($groupObj->SubGroupName);
            $NewGroupObj->CreatedUserId = (int)$groupObj->UserId;
            $NewGroupObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));           
            $NewGroupObj->SubGroupDescription = $groupObj->SubGroupDescription;
            $NewGroupObj->GroupId=new MongoId($groupObj->GroupId);
            $NewGroupObj->SubGroupFollowers = array();
            $NewGroupObj->SubGroupMembers = array();
            array_push($NewGroupObj->SubGroupMembers,(int)$groupObj->UserId);
            if(Yii::app()->session['PostAsNetwork']!=1){
                array_push($NewGroupObj->SubGroupMembers,(int)(Yii::app()->session['NetworkAdminUserId']));
            }
            array_push($NewGroupObj->SubGroupAdminUsers,(int)$groupObj->UserId);
            $NewGroupObj->SubGroupBannerImage='/images/system/nogroup.png';
            $NewGroupObj->SubGroupProfileImage='/images/system/grouplogo.png';
            $NewGroupObj->ShowPostInMainStream=(int)$groupObj->ShowPostInMainStream;

            $NewGroupObj->AddSocialActions=(int)$groupObj->AddSocialActions;
            $NewGroupObj->DisableWebPreview=(int)$groupObj->DisableWebPreview;
            
            if ($NewGroupObj->save()) {
                $returnValue = $NewGroupObj->_id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("-----inside exception ---SaveNewGroup------".$exc->getMessage(), 'error', 'application');
        }
    }
    
    /**
     * @author Praneeth
     * Description: Method to get the groups in which user is a member
     * @param type $groupIdsArray
     * @return Groupsdetails
     */
    public function userFollowingGroupsList($groupIdsArray,$groupId)
    {
        try
        {
            $groupsFollowingObj="";
            $resultArray= array();
            $returnValue = 'noGroups';
            $array = array(
                'limit' => 8,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
            $criteria = new EMongoCriteria($array);
            $criteria->_id('in',$groupIdsArray);
            $groupsFollowingObj = SubGroupCollection::model()->findAll($criteria);
        
        } catch (Exception $ex) {           
            Yii::log("-------------inside exception ---userFollowingOfGroups--------------".$ex->getMessage(), 'error', 'application');
        }
       
        return $groupsFollowingObj;
    }
    
    /**
     * @author Praneeth
     * Description: Method to get more groups in which user is a member
     * @param type $groupIdsArray, $startLimit, $pageLength
     * @return Groupsdetails
     */

    public function userMoreFollowingGroupsList($SubGroupIdsArray, $startLimit, $pageLength)
    {
        try
        {
            $array = array(
                'limit' => 8,
                'offset' => $startLimit,
                'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC),
            );
            $criteria = new EMongoCriteria($array);
            $criteria->_id('in',$SubGroupIdsArray);
            $groupsFollowingObj = SubGroupCollection::model()->findAll($criteria);
            if (isset($groupsFollowingObj)) {
                    $returnValue =$groupsFollowingObj;
                }
        } catch (Exception $ex) {
            
                 Yii::log("-------------userMoreFollowingGroupsList---------------------------".$ex->getMessage(), 'error', 'application');
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
    public function updateGroupDetails($userId,$value,$type,$groupId) {
        try {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
             if($type=='GroupProfileImage'){
                 $type='SubGroupProfileImage';
             }else if($type=='GroupBannerImage'){
                 $type="SubGroupBannerImage";
             }
             else if($type=='GroupDescription'){
                 $type="SubGroupDescription";
             }
             else if($type=='ShowPostInMainStream'){
                 $type="ShowPostInMainStream";
             }
            $mongoModifier->addModifier($type, 'set', $value); 
            $mongoModifier->addModifier('LastUpdatedBy', 'set', $userId); 
            $mongoCriteria->addCond('_id', '==',  new MongoID($groupId)); 
           SubGroupCollection::model()->updateAll($mongoModifier,$mongoCriteria);
           $returnValue ="success";
           return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }


    
    /**
     * 
     */
    public function followOrUnfollowSubGroup($subGroupId, $userId, $actionType)
    {
        try
        {
            $returnValue = 'failure';
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if ($actionType == 'Follow') {
                $mongoModifier->addModifier('SubGroupMembers', 'push', $userId);
            } else if($actionType == 'UnFollow'){
                $mongoModifier->addModifier('SubGroupMembers', 'pull', $userId);
            }

            $mongoCriteria->addCond('_id', '==', new MongoId($subGroupId));
            $returnValue = SubGroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            return 'success';
        } catch (Exception $ex) {
                Yii::log("-----".$ex->getMessage(), 'error', 'application');
        }
    }
    
    public function getUserGroupCount($userId) {
        try {
            $countValue = 'noGroups';
            $criteria = new EMongoCriteria();
            $criteria->_id('in', $groupIdsArray);
            $countValue = SubGroupCollection::model()->count($criteria);
        } catch (Exception $exc) {
            Yii::log("------".$exc->getMessage(), 'error', 'application');
        }
    }
       /**
 * @author Vamsi Krishna
 * This method is used to update Group with Array Type
 * @param MongoId $groupId 
 * @param MongoId $value
 * @param MongoId $type
 */
    public function updateGroupCollectionForArrayType($groupId,$value,$type){
        try {
            
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            if($type=='PostIds'){
              $mongoModifier->addModifier($type, 'push', new MongoId($value));    
            }
            if($type=='SubGroupAdminUsers'){
              $mongoModifier->addModifier($type, 'push', new MongoId($value));    
            }           
            $mongoCriteria->addCond('_id', '==', new MongoId($groupId));
            $returnValue = SubGroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        } catch (Exception $exc) {
            Yii::log("----".$exc->getMessage(), 'error', 'application');
        }
        }
        
         /* This method checks whether the group exist or not
     */

    public function checkIfGroupExist($model) {
        try {
            $result = 'false';
            $groupName = trim($model->SubGroupName);
              $mongoCriteria = new EMongoCriteria;
              
             $mongoCriteria->addCond('SubGroupName', '==', $groupName);
             $mongoCriteria->addCond('GroupId', '==', new MongoId($model->GroupId));            
            $groupIsExists = SubGroupCollection::model()->find($mongoCriteria);
            
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
   
     public function getSubGroupIdByName($subgroupName,$groupId) {
        try {
            $returnValue = 'failure';
            $subgroupName = str_replace("%20", " ", $subgroupName);
            $criteria = new EMongoCriteria;
             $criteria->setSelect(array('_id'=>true));
            $criteria->addCond('SubGroupName', '==', $subgroupName);
            $criteria->addCond('GroupId', '==', new MongoId($groupId)); 
            $groupObj=SubGroupCollection::model()->find($criteria);
            if(is_object($groupObj)){
                $returnValue=$groupObj->_id;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______".$exc->getMessage(),'error','application');
            return $returnValue;
        }
    }

    
    public function updateGroupCollectionForDelete($obj,$groupId) {
        try {
            $returnValue = 'failure';            
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;
            
               if($obj->ActionType=='Block' || $obj->ActionType=='Abuse' || $obj->ActionType=='Delete' ){
           $mongoModifier->addModifier('PostIds', 'pop', $obj->PostId);  
           
           }else if($obj->ActionType=='Release'){
             $mongoModifier->addModifier('PostIds', 'push', new MongoID($obj->PostId));      
           }  
            
           $mongoCriteria->addCond('_id', '==',  new MongoID($groupId)); 
           SubGroupCollection::model()->updateAll($mongoModifier,$mongoCriteria);
           $returnValue ="success";
           return $returnValue; 
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }
    
    
 /**
     * @author Vamsi Krishna
     * @param type $userId
     * @description This method is used to user following sub groups
     * @return object type groupsList array
     */
 public function getUserFollowingSubGroups($userId)
    {
     $returnValue="failure";
        try
        {
            
            $groupsFollowingObj="";
            $groupsFollowingObj = SubGroupCollection::model()->findAllByAttributes(array("SubGroupMembers"=>$userId));
            if (isset($groupsFollowingObj)) {
                    $returnValue =$groupsFollowingObj;
                }
        } catch (Exception $ex) {
            return $returnValue;
                 Yii::log("-------------userMoreFollowingGroupsList---------------------------".$ex->getMessage(), 'error', 'application');
        }
        return $returnValue;
    }
    
     /**
     * @authorPraneeth
     * @param type $SubGroupid
     * @description This method is used to get the subgroupDetails
     * @return object type MongoId
     */
    public function getSubGroupDetailsById($subgroupId) {
        try {
            $returnValue = 'failure';
            $criteria = new EMongoCriteria;
            $criteria->addCond('_id', '==', new MongoID($subgroupId));
            $subgroupObj=SubGroupCollection::model()->find($criteria);
            if(is_object($subgroupObj)){
                $returnValue=$subgroupObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("______in get subgroups Statistics_______".$exc->getMessage(),'error','application');
            return $returnValue;
        }
    }
    /**
     * @author Vamsi Krishna
     * @param $groupId ,$userId,$actiontype
     * @description This method is used to remove or add user in all the subGroups for a particular Group
     * 
     */
    public function removeOrAddUserInAllSubGroupsByGroupId($groupId,$userId,$actionType){
        try {
            $returnValue = 'failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;
              if($actionType=='UnFollow' ){
           $mongoModifier->addModifier('SubGroupMembers', 'pull', $userId);             
           }
            if($actionType=='Follow' ){
           $mongoModifier->addModifier('SubGroupMembers', 'push', $userId);  
           
           }
            
           $mongoCriteria->addCond('GroupId', '==',  new MongoID($groupId)); 
           SubGroupCollection::model()->updateAll($mongoModifier,$mongoCriteria);
           $returnValue ="success";
           return $returnValue; 
            
        } catch (Exception $exc) {
            Yii::log("______in get subgroups Statistics_______".$exc->getMessage(),'error','application');
            return $returnValue;
        }
        }
    

    public function getAllSubGroupIds() {
        try {
            $returnValue = 'failure';
            
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id'=>true,'GroupId'=>true));
            $SubgroupObj=SubGroupCollection::model()->findAll($criteria);

            return $SubgroupObj;
        } catch (Exception $exc) {
            Yii::log("______in get groups Statistics_______".$exc->getMessage(),'error','application');
            return $returnValue;
        }
    }    
    
    public function checkUserFollowAgroup($userId,$object){
        try{
           
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('SubGroupMembers'=>true));
            $criteria->addCond("_id","==", new MongoId($object->SubGroupId));
            $SubgroupObj=SubGroupCollection::model()->find($criteria);
           
            if(isset($SubgroupObj->SubGroupMembers)){
                return in_array($userId, $SubgroupObj->SubGroupMembers);
            }else{
                return 0;
            }            
        } catch (Exception $ex) {

        }
    }
    
 public function getSubGroupDetailsWithoutGroupMembersByGroupId($subgroupId){
        try {
            $returnValue = 'failure';            
            $criteria = new EMongoCriteria;
            $criteria->setSelect(array('_id'=>true,'SubGroupName'=>true));
            $criteria->addCond('_id', '==', new MongoID($subgroupId));
            $groupObj=SubGroupCollection::model()->find($criteria);
            if(is_object($groupObj)){
                $returnValue=$groupObj;
            }
            return $returnValue;
        } catch (Exception $exc) {
           Yii::log("".$exc->getMessage(),'error','application');
        }

        
    }        
        
        
}
