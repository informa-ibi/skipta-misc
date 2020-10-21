<?php

/* @author Swathi
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BadgeTranslations extends CActiveRecord {

    public $id;
    public $badgeId;
    public $language;
    public $description;
  

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'BadgeTranslations';
    }

    public function getBadgeTranslation($id, $language) {
        $returnValue = 'failure';
        try {
            
            $badgesData =  BadgeTranslations::model()->findByAttributes(array("badgeId" => (int)$id, 'language'=>$language));
            if(isset($badgesData) && (is_object($badgesData) || is_array($badgesData)) ){
                $returnValue=$badgesData;
            }
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
    public function saveBadgeTranslation($id, $language, $description) {
        $returnValue = 'failure';
        try {
            $translationObj = new BadgeTranslations();
            $translationObj->badgeId = (int)$id;
            $translationObj->language = $language;
            $translationObj->description = $description;
            
            if($translationObj->save()){
                $returnValue="success";
            }
       
            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("rol", 'error', 'application');
            $returnValue = 'failure';
        }
    }
}
