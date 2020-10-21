<?php

/* @author Sagar
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Language extends CActiveRecord {

    public $Id;
    public $Name;
    public $Language;
    public $SourceLanguage;
  

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'Language';
    }

    public function getAllLanguages() {
        $returnValue = array();
        try {
            $languages = Language::model()->findAll();
            if(isset($languages) && !empty($languages)){
                $returnValue=$languages;
            }
        } catch (Exception $exc) {
            $returnValue = 'failure';
        }
        return $returnValue;
    }
    public function getLanguageByAttributes($attributeArray) {
        $returnValue = 'failure';
        try {
            $languageObj = Language::model()->findByAttributes($attributeArray);
            if (isset($languageObj)) {
                $returnValue = $languageObj;
            }
        } catch (Exception $exc) {
            $returnValue = 'failure';
        }
        return $returnValue;
    }

}
?>