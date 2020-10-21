<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RestWeblinkController extends Controller {
    
      public function init() {
          error_log("init-------------------");
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            CommonUtility::reloadUserPrivilegeAndData($this->tinyObject->UserId);
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
        } else {
            
        }
    }
       public function actionLoadWebLinks() {
        try {
            error_log("actionLoadWebLinks----". $_POST['Page']."--**".$_REQUEST['WLPage']);
          
            if (isset($_POST['Page'])) {
                $page=$_POST['Page'];
                $WLPage=$_REQUEST['WLPage'];                 
                $page=$page-1;
                $limit=10;
                $offset = ($limit * $page);     
                $isAdmin=Yii::app()->session['IsAdmin']; 
                error_log("limit---".$limit."----offset--".$offset);
                $webLinks=ServiceFactory::getSkiptaWebLinkServiceInstance()->loadWebLinkWall($limit,$offset,$isAdmin);
                error_log("wegblinks cont---------------".count($webLinks));
                if(is_array($webLinks)){
                    $streamData = $webLinks;    
                }else{
                      if($_POST['Page'] == 1){
                           $streamData = 0;
                      }else{
                           $streamData = -1;
                      }
                   
                }
                 
               
               $obj = array("stream"=>$streamData);
               echo $this->rendering($obj); 
            } 
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
        }
    }
}
