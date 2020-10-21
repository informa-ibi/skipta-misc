<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CurbsideCategoriesList extends CActiveRecord {

    public $Id;
    public $CurbsideCategory;
    public $Status;
    public $CreatedDate;
    public $ProfileImage;
    public $SegmentId=0;


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'CurbsideCategory';
    }
    
    /*
     * GetCurbsideCategoriesList: which takes 4 arguments and 
     * by default 2 arguments are initialized with default values those are startLimit = 0 and pageLength = 10;
     * and this function returns Users Object.
     */
    public function getCurbsideCategoriesList($filterValue, $searchText, $startLimit=0, $pageLength=10, $segmentId=0) {
        try {
            $criteria = new CDbCriteria();
            if (trim($filterValue) == "all") {
               $criteria = $criteria;
            } else if (trim($filterValue) == "active") {
                $criteria->addSearchCondition('Status', '1');
            } else if (trim($filterValue) == "deleted") {
                $criteria->addSearchCondition('Status', '0');
            }
            
            if (!empty($searchText) && $searchText != "undefined" && $searchText != "null" && $searchText!='search' ) {
                $criteria->addSearchCondition('CurbsideCategory', $searchText, true, "OR", "LIKE");
            }
            if($segmentId!=0){
                $criteria->addSearchCondition('SegmentId', (int)$segmentId);
            }
            $criteria->offset = $startLimit;
            $criteria->limit = $pageLength;
            $criteria->order= 'CurbsideCategory';
            $result = CurbsideCategoriesList::model()->findAll($criteria);
            for($i=0; $i<sizeof($result);$i++){
                $result[$i]->CreatedDate = date("m/d/Y",strtotime($result[$i]->CreatedDate));
            }
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in GetCurbsideCategoriesList--1111111-----==" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    
    /*
     * GetCurbsideCategoryCount: which takes 2 arguments and 
     * returns the total no. of categories.
     */
     public function getCurbsideCategoryCount($filterValue, $searchText, $segmentId=0) {
        try {
            $criteria = new CDbCriteria();
            if (trim($filterValue) == "all") {
                $criteria = $criteria;
            } else if (trim($filterValue) == "active") {
                $criteria->addSearchCondition('Status', '1');
            } else if (trim($filterValue) == "deleted") {
                $criteria->addSearchCondition('Status', '0');
            }
            
            if (!empty($searchText) && $searchText != "undefined" && $searchText != "null" && $searchText!='search') {
                $criteria->addSearchCondition('CurbsideCategory', $searchText, true, "OR", "LIKE");
            }   
            if($segmentId!=0){
                $criteria->addSearchCondition('SegmentId', (int)$segmentId);
            }
            $result = CurbsideCategoriesList::model()->count($criteria);
        } catch (Exception $exc) {
            Yii::log("==Exception Occurred in getUserProfileCount==" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
    
    /*
     * This method checks whether the category exist or not
     */
    public function checkCurbsieCategoryExist($model) {
        try {
            $result = 'success';
                 $CurbsideCategory = CurbsideCategoriesList::model()->findByAttributes(array("CurbsideCategory" => $model->category));
        } catch (Exception $ex) {
            Yii::log("=====checkCurbsie  CategoryExist========" . $ex->getMessage(), "error", "application");
        }
        return $CurbsideCategory;
    }
    
    /**
     * saveNewCurbsidecategory: to save new curbside category
     * @param type $model
     * @return success
     */
    public function saveNewCurbsidecategory($model)
    {
        try{
             $result = 'fail';
             $returnValue = 'false';
             if (isset($model) && empty($model->id)) {
                $categoryObj = new CurbsideCategoriesList();
                $categoryObj->CurbsideCategory = $model['category'];
                $categoryObj->CreatedDate = date('Y-m-d H:i:s', time());
                $categoryObj->Status = '1';
                $categoryObj->ProfileImage = $model['TopicprofileImage'];
                $categoryObj->SegmentId = (int)$model->SegmentId;
                $CurbsideCategory = CurbsideCategoriesList::model()->findByAttributes(array("CurbsideCategory" => $model->category));
                if (count($CurbsideCategory) > 0) {
                    $returnValue = 'false';
                } else {
                    if ($categoryObj->save()) {
                        // $returnValue = 'true';
                        $returnValue = $categoryObj->Id;
                    }
                }
            } else {
                    //for update
                //check category exist
                $CurbsideCategory = CurbsideCategoriesList::model()->findByAttributes(array("Id" => $model->id));
                if ($CurbsideCategory->CurbsideCategory == $model->category) {
                    $result = 'success';
                } else {

                    $CurbsideCategory = CurbsideCategoriesList::model()->findByAttributes(array("CurbsideCategory" => $model->category));
                    if (count($CurbsideCategory) > 0) {
                        $result = 'failure';
                    } else {
                        $result = 'success';
                    }
                }
                 //check if category exist   
                $categoryObj = CurbsideCategoriesList::model()->findByAttributes(array("Id" => $model->id));
                if ($result == 'success') {
                    $categoryObj->CurbsideCategory = $model['category'];
                     $categoryObj->ProfileImage = $model['TopicprofileImage'];
                     $categoryObj->SegmentId = (int)$model->SegmentId;
                    if ($categoryObj->update()) {
                        $returnValue = 'updatetrue';
                    }
                } else {
                    $returnValue = 'false';
                }
            }
            return $returnValue;
        } catch (Exception $ex) {
            Yii::log("=====exception result======saveNewCurbsidecategory======" . $ex->getMessage(), "error", "application");
        }
    }
    
    
    /*
     * updateCurbsideCategoryStatus: which takes 2 arguments 1: userId and 2: value.
     * This is used to update the status of a category.
     */
    public function updateCurbsideCategoryStatus($categoryid, $categoryvalue) {
        try {
            
            $return = "failed";

            $categoryUpdate = CurbsideCategoriesList::model()->findByAttributes(array("Id" => $categoryid));
            if (isset($categoryUpdate)) {
                $categoryUpdate->Status = $categoryvalue;
                if ($categoryUpdate->update()) {
                    $return = "success";
                }
            }
        } catch (Exception $ex) {
            Yii::log("Exception occurred in updateCurbsideCategoryStatus in CurbsideCategoriesList layer=" . $ex->getMessage(), "error", "application");
        }
        return $return;
    }
    
    /**
     * editCurbsideCategoryById:for editing the already existing category
     * @param type $categoryId
     * @return categoryCollectionObject
     */
    public function editCurbsideCategoryById($categoryId)
    {
        try
        {
             $categoryCollectionObject = CurbsideCategoriesList::model()->findByAttributes(array("Id" => $categoryId));
        } catch (Exception $ex) {
                Yii::log("Exception occurred in editCurbsideCategoryById in CurbsideCategoriesList layer" . $ex->getMessage(), "error", "application");
        }
        
        return $categoryCollectionObject;
    }
    /**
     * getAllCurbsideCategories() this method is used to get all categories with status is active
     * @return type categories array
     *  @author Haribabu
     */
    public function getAllCurbsideCategories() {
        try {
            $criteria = new CDbCriteria();
           // $criteria->Status= '1';
            $criteria->addSearchCondition('Status', '1');
            $result = CurbsideCategoriesList::model()->findAll($criteria);
            
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in GetCurbsideCategoriesList--1111111-----==" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }
     public function getCurbsideCategoriesBySegment($segmentId) {
        try {
            $query="select * from CurbsideCategory where SegmentId in (0,$segmentId) and Status=1";    
            $result = Yii::app()->db->createCommand($query)->queryAll(); 
        } catch (Exception $exc) {
            Yii::log("Exception Occurred in GetCurbsideCategoriesList--1111111-----==" . $exc->getMessage(), "error", "application");
        }
        return $result;
    }   
    
}