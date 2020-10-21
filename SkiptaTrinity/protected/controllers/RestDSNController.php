<?php

/*
 * Developer Suresh Reddy
 * on 8 th Jan 2014
 * all users actions need to add here
 */

class RestDSNController extends Controller {

      public function init() {
      
      }
 
public function actionGetDSNUsers(){
    try{
        
        
        if(isset($_REQUEST['NetworkName'])){
            $NetworkName = $_REQUEST['NetworkName'];
            error_log( "actionGetDSNUsers networkName actionGetDSNUsers".$NetworkName);
            $usersList= ServiceFactory::getSkiptaUserServiceInstance()->getAllActiveUserInfoByNetworkName($NetworkName);
            error_log(print_r($usersList,true));
             if(sizeof($usersList)>0)
            { 
                 error_log(print_r($usersList,true));
                $obj = array("status" => "success", "data" => array("Response"=>$usersList));
                    
            }
            else
            {
                $obj = array('status' => 'failure', 'data' => array("Response"=>array()), 'error' => ''); 
            }
        }
        
               
        echo json_encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    
}
public function actionGetDSNCommonNotifications(){
    try{
        
        
        if(isset($_REQUEST['NetworkName'])){
            $NetworkName = $_REQUEST['NetworkName'];
           error_log("GetDSNCommonNotificationsGetDSNCommonNotificationsGetDSNCommonNotifications");
           $commonNotifications=  ServiceFactory::getSkiptaUserServiceInstance()->getDSNCommonNotificationCollectionByCriteria($NetworkName,'');
              error_log(")))))))))))))))))))))00".print_r($commonNotifications,true)); 
                    if(sizeof($commonNotifications)>0)
                    {
                         $obj = array("status" => "success", "data" => array("Response"=>$commonNotifications));
                    }
                     else
                    {
                        $obj = array('status' => 'failure', 'data' => array("Response"=>array()), 'error' => ''); 
                    }
             
        }
        
            
        echo json_encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
    
}

public function actionGetDSNUserNotifications()
{
    try{
        
        
        if(isset($_REQUEST['NetworkName'])){
            $NetworkName = $_REQUEST['NetworkName'];
           $Email=$_REQUEST['Email'];
           $userObj=  User::model()->getUserByType($Email, 'Email');
           if($userObj!='noUser')
           {
               error_log($Email."***********************".$userObj->UserId);
           $userNotifications=  ServiceFactory::getSkiptaUserServiceInstance()->getDSNCommonNotificationCollectionByCriteria($NetworkName,$userObj->UserId);
               error_log(print_r($userNotifications,true));
                    if(sizeof($userNotifications)>0)
                    {
                         $obj = array("status" => "success", "data" => array("Response"=>$userNotifications));
                    }
                     else
                    {
                        $obj = array('status' => 'failure', 'data' => array("Response"=>array()), 'error' => ''); 
                    }
           }
            else
                    {
                        $obj = array('status' => 'failure', 'data' => array("Response"=>array()), 'error' => ''); 
                    }
             
        }
        
            
        echo json_encode($obj);
        
    } catch (Exception $ex) {
        Yii::log("Exception===".$ex->getMessage(),"error","application");
    }
}



}

?>