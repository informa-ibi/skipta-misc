<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AssignCustomBadgeCommand extends CConsoleCommand {
//    public function run($args) {
//       // $this->AssignBadgeByStore();
//    }
    
 public function assignBadgeToUser() {
        try {
            Yii::import('ext.phpexcel.XPHPExcel');      
       $phpExcel = XPHPExcel::createPHPExcel();
       $objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/CustomBadge.xls");       
       $objWorksheet = $objPHPExcel->getAllSheets(); 
            for($sheet=1;$sheet<=(3);$sheet++)
       {      
         $highestRow = $objWorksheet[$sheet]->getHighestRow(); // e.g. 10    
                for ($row = 2; $row <=$highestRow; ++$row) { 
             $storeId=$objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue();
             echo 'STORE ID IS '.$storeId .'--';             
            $usersList=ServiceFactory::getSkiptaUserServiceInstance()->getUsersByRegionId();
            $badgeName;
            if($sheet==1){
             $badgeName="11";
            }else if($sheet==2){
             $badgeName="12";   
            }else if($sheet==3){
               $badgeName="13";      
            }
            
            if(is_object($usersList) || is_array($usersList)){
               foreach($usersList as $user){  
               $userId=$user['UserId'];
               $storeId=$user['Store'];

          $userdetails=  User::model()->getUserByType($userId,'UserId');
           if(!is_string($userdetails)){                     
                     $badgeName=trim($badgeName);
                     if(isset($badgeName)){                         
                         $badgeDetails=ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($badgeName);
                         if(!is_string($badgeDetails)){
                             $badgeId=$badgeDetails->id;
                             $userId=$userdetails->UserId;                             
                             $userBadgeCollection=  ServiceFactory::getSkiptaUserServiceInstance()->checkIfUserAchievedBadge($userId,$badgeId);                             
                             if(is_object($userBadgeCollection)){
                              echo "I have already received the badge".$userId;
                             }else{                                                        
                              CommonUtility::customBadgingInterceptor("Custom",$userId,$badgeId,"Job",$storeId);    
                             }
                             
                         }
                     }
                 }else{
                     echo 'No user ';
                 }  
           }  
            }
      }
       
       
       }
            
            
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
    
    public function actionAssignBadgeByStore($region){
        try {           
             Yii::import('ext.phpexcel.XPHPExcel');      
       $phpExcel = XPHPExcel::createPHPExcel();
       $objPHPExcel = PHPExcel_IOFactory::load(dirname(__FILE__). "/../CustomBadge.xls");       
       $objWorksheet = $objPHPExcel->getAllSheets();
       $sheetCount=$objPHPExcel->getSheetCount();
       echo "%%%%%%%";

       for($sheet = 1; $sheet <= (3); $sheet++) {
                $highestRow = $objWorksheet[$sheet]->getHighestRow(); // e.g. 10       
                echo "***sheet**".$sheet;
                
                $region = $region;
                
                $storeIds = array();
                $badgeName;
                if ($sheet == 1) {
                    $badgeName = "11";
                } else if ($sheet == 2) {
                    $badgeName = "12";
                } else if ($sheet == 3) {
                    $badgeName = "13";
                }
               
                for ($row = 1; $row <=$highestRow ; ++$row) {
                    $regionInSheet = $objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue();
                     echo "region in sheet  ".$regionInSheet;
                    $regionInSheet = (str_replace('=', '', $regionInSheet));
                    $regionInSheet = (str_replace('"', '', $regionInSheet));                  
                    $regionInSheet = (str_replace("'", '', $regionInSheet));                  
                  
                    if (trim($regionInSheet) == $region) {                       
                        $storeId = $objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue();
                        array_push($storeIds, $storeId);
                    }
                }
              echo 'Store Ids are '.count($storeIds);
                if(count($storeIds)>0){
                   $usersList=ServiceFactory::getSkiptaUserServiceInstance()->getUsersByStoreIds($storeIds);
                 if (is_object($usersList) || is_array($usersList)) {
                    foreach ($usersList as $user) {
                        $userId = $user['UserId'];
                        $storeId = $user['Store'];

                        $userdetails = User::model()->getUserByType($userId, 'UserId');
                        if (!is_string($userdetails)) {
                            $badgeName = trim($badgeName);
                            if (isset($badgeName)) {
                                $badgeDetails = ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoById($badgeName);
                                if (!is_string($badgeDetails)) {
                                    $badgeId = $badgeDetails->id;
                                    $userId = $userdetails->UserId;
                                    $userBadgeCollection = ServiceFactory::getSkiptaUserServiceInstance()->checkIfUserAchievedBadge($userId, $badgeId);
                                    if (is_object($userBadgeCollection)) {
                                        echo "I have already received the badge" . $userId;
                                    } else {
                                        CommonUtility::customBadgingInterceptor("Custom", $userId, $badgeId, "Console", $storeId);
                                    }
                                }
                            }
                        } else {
                            echo 'No user ';
                        }
                    }
                }  
                }
                  
            }
        } catch (Exception $exc) {
            echo 'got exception '.$exc->getMessage();
          }
        }

        public function actiontest($region){
            echo 'testtttttttttttttttttttttttttttttttttttttttttt'.$region;
            error_log( 'Iam in test ______________*************************_____________________');
        }
}