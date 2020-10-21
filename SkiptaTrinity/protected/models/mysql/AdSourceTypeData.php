<?php
class AdSourceTypeData extends CActiveRecord{
    public $Id;
    public $AdId;
    public $Language;
    public $Type;
    public $Url;
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'AdSourceTypeData';
    }
     
    public function saveAdSourceType($adId, $source) {
        $returnValue = "failure";
        try {
            $languages = "";
            $adId = (int)$adId;
            foreach ($source as $arr) {
                $languages .= ",'".$arr['Language']."'";
                $conditions = array("AdId"=>$adId, "Language"=>$arr['Language']);
                $advertisements = AdSourceTypeData::model()->findByAttributes($conditions);
                if(is_object($advertisements)){
                    $advertisements->Type = $arr['Type'];
                    $advertisements->Url = $arr['Url'];
                    if($advertisements->update()){
                        $returnValue = "success";
                    }
                }else{
                    $adSource = new AdSourceTypeData();
                    $adSource->AdId = $adId;
                    $adSource->Language = $arr['Language'];
                    $adSource->Type = $arr['Type'];
                    $adSource->Url = $arr['Url'];
                    if($adSource->insert()){
                        $returnValue = "success";
                    }
                }
            }
            if($languages!=""){
                $languages = substr($languages, 1);
                $query = "delete from AdSourceTypeData where AdId=$adId and Language not in ($languages)";
                $result =  Yii::app()->db->createCommand($query)->execute();
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("====in model================AdSourceTypeData/saveAdSourceType==================" . $exc->getMessage());
            Yii::log($exc->getTraceAsString(), 'error', 'application');
            return $returnValue;
        }
    }
    public function getAdSourceTypeData($conditions) {
        $returnValue = "failure";
        try {
            $advertisements = AdSourceTypeData::model()->findAllByAttributes($conditions);
             if(is_object($advertisements) || is_array($advertisements)){
                 $returnValue=$advertisements;
             }
             return $returnValue;
        } catch (Exception $exc) {
            error_log("====in model===========AdSourceTypeData/getAdSourceTypeData=======================" . $exc->getMessage());
            Yii::log($exc->getTraceAsString(), 'error', 'application');
            return $returnValue;
        }
    }
    public function getAdSourceTypeObject($conditions) {
        $returnValue = "failure";
        try {
            $advertisements = AdSourceTypeData::model()->findByAttributes($conditions);
             if(is_object($advertisements) || is_array($advertisements)){
                 $returnValue=$advertisements;
             }
             return $returnValue;
        } catch (Exception $exc) {
            error_log("====in model===========AdSourceTypeData/getAdSourceTypeData=======================" . $exc->getMessage());
            Yii::log($exc->getTraceAsString(), 'error', 'application');
            return $returnValue;
        }
    }
    public function saveBanners($adId, $banners) {
        $returnValue = "failure";
        try {
            
            $languages = "";
            $adId = (int)$adId;
            foreach ($banners as $arr) {
                $languages .= ",'".$arr['Language']."'";
                $conditions = array("AdId"=>$adId, "Language"=>$arr['Language'], "BannerTemplate"=>$arr['BannerTemplate'],"BannerOptions"=>$arr['BannerOptions']);
                $advertisements = AdSourceTypeData::model()->findByAttributes($conditions);
                if(is_object($advertisements)){
                    $advertisements->Url = $arr['Url'];
                    $advertisements->BannerTitle = $arr['BannerTitle'];
                    $advertisements->BannerContent = $arr['BannerContent'];
                    if($advertisements->update()){
                        $returnValue = "success";
                    }
                }else{
                    $adSource = new AdSourceTypeData();
                    $adSource->AdId = $adId;
                    $adSource->Language = $arr['Language'];
                    $adSource->BannerTemplate = $arr['BannerTemplate'];
                    $adSource->BannerOptions = $arr['BannerOptions'];
                    $adSource->Url = $arr['Url'];
                    $adSource->BannerTitle = $arr['BannerTitle'];
                    $adSource->BannerContent = $arr['BannerContent'];
                    if($adSource->insert()){
                        $returnValue = "success";
                    }
                }
            }
            if($languages!=""){
                $languages = substr($languages, 1);
                $query = "delete from AdSourceTypeData where AdId=$adId and Language not in ($languages)";
                $result =  Yii::app()->db->createCommand($query)->execute();
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("====in model================AdSourceTypeData/saveAdSourceType==================" . $exc->getMessage());
            Yii::log($exc->getTraceAsString(), 'error', 'application');
            return $returnValue;
        }
    }
}
?>