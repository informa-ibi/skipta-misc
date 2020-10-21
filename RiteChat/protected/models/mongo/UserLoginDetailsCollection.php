<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
*@Author: Ankit
*@Functionality: Get login logs  
 */
class UserLoginDetailsCollection extends EMongoDocument {
    public $_id;
    public $UserId=0;
    public $LastLoginDate;
    public $CreatedOn;
    public $CreatedDate;
    public $Pagevisits=0;
    
    
    public function getCollectionName() {
        return 'UserLoginDetailsCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

   
    public function attributeNames() {
        return array(
            '_id' => '_id',
            'UserId' => 'UserId',
            'LastLoginDate'=>'LastLoginDate',
            'CreatedOn' => 'CreatedOn',
            'CreatedDate'=>'CreatedDate',
            'Pagevisits'=>'Pagevisits',
            
        );
    }


    public function saveUserLoginData($userId) {
        try {
            $returnValue = 'failure';
            $lastLoginDate = date('Y-m-d');
            $LoginDataObj = new UserLoginDetailsCollection();
            $LoginDataObj->UserId = $userId;
            $LoginDataObj->LastLoginDate=$lastLoginDate;
            $LoginDataObj->CreatedDate=$lastLoginDate;
            $LoginDataObj->Pagevisits=1;
            $LoginDataObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            

            if ($LoginDataObj->insert()) {
                $returnValue = $LoginDataObj->_id;
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getMessage() . "In save user login data collection", 'error', 'application');
        }
    }

     public function GetUserLoginData($startDate,$endDate,$type){
         $returnValue='failure';
              $dateFormat =  CommonUtility::getDateFormat();
        try {
//            
            $resArray = array();
        $dateFormat = CommonUtility::getDateFormat();
        $finalArray = array();
        // $startDate=date('Y-m-d',strtotime($startDate));
        // $endDate=date('Y-m-d',strtotime($endDate));
        $timezone = Yii::app()->session['timezone'];
//        $startDate = CommonUtility::convert_time_zone(strtotime($startDate), "UTC", $timezone);
//        $endDate = CommonUtility::convert_time_zone(strtotime($endDate), "UTC", $timezone);
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));
        $dateFrom = new DateTime($startDate1);
        $dateTo = new DateTime($endDate1);
        $interval = date_diff($dateFrom, $dateTo);
        $diff = $interval->format('%R%a');
        $valid_times = CommonUtility::GetIntervalsBetweenTwoDates($startDate, $endDate);


//        if ($diff > 365) {
//
//            $modeType = '$year';
//            $datemode = 'YEAR';
//        } elseif ($diff > 92 && $diff <= 365) {
//
//            $modeType = '$month';
//            $datemode = 'MONTH';
//        } elseif ($diff > 31 && $diff <= 92) {
//            $modeType = '$week';
//            $datemode = 'WEEK';
//        } elseif ($diff <= 31) {
//
//            $modeType = '$dayOfMonth';
//            $datemode = 'DATE';
//        }
        $modeType = '$month';
        $dayMode = '$dayOfMonth';
        $UserId = '$UserId';
        $datemode = 'MONTH';
        $Resultsid = array(
            'Userid' => "$UserId",
            'month' => array("$modeType" => '$CreatedOn'),   
            'day' => array("$dayMode" => '$CreatedOn'),

        );

//        if ($groupId == 0) {
//
//            $match = array("Pageviews" => array('$ne' => (int) 0), "Pagevisits" => array('$ne' => (int) 0), "Is_Group" => (int) $isGroup,
//                "CreatedDate" => array('$gte' => $startDate, '$lte' => $endDate)
//            );
//        } else {

            $match = array("LastLoginDate" => array('$gte' => $startDate, '$lte' => $endDate));
//        }


            $collection = "UserLoginDetailsCollection";
            $nresults = CommonUtility::getUserLoginData($collection, $match, $modeType, $Resultsid);

          
           
        
        $mainArray = array();
        $mainArray1 = array();
        $test = array();
        
       
        foreach ($nresults as  $value){
           $count=0;
            $mainArray['_id']['month'] = $value['_id']['month'];
            foreach($nresults as $value_1){
                if($mainArray['_id']['month'] == $value_1['_id']['month']){
                    $count++;
                }
            }    
            $mainArray['count'] = $count;
             //$mainArray['count'] = 1;
//            foreach($nresults as $value_1){
//                if($value_1['_id']['month'] == $value['_id']['month']){
//                    $count++;
//                }else{
//                    $count = 1;
//                }
//            }
//            if(array_key_exists($value['_id']['month'], $mainArray))
//               $count = $mainArray[$value['_id']['month']]++;
//             else
//               $count = $mainArray[$value['_id']['month']] = 1;
//             
          
         
//         $mainArray1['_id']['month'] =  $value['_id']['month'];
//         $mainArray1['count'] =  $count;
         $test[] = $mainArray;
        } 
      
        //echo $count;    
         //print_r($test);
           // die();      
        foreach ($test as $value) {
            $existingArray = array();

            if (array_key_exists($value['_id']['month'], $valid_times)) {
                
                
                //$existingArray[0] = $value['_id']['Pagevisits']['Pagevisits'];
                //$existingArray[1] = $value['_id']['LastLoginDate']['LastLoginDate'];
                $existingArray[0] = $value['count'];
                $finalArray[$value['_id']['month']] = $existingArray;
            }
        }
        //print_r($finalArray);die;
        foreach ($valid_times as $key => $value) {
            $startDate = date('Y-m-d', strtotime($valid_times["$key"]));
            $startDate_tz = CommonUtility::convert_date_zone(strtotime($startDate . " 18:29:00"), date_default_timezone_get(), "UTC");
            $dateArray = array();
            if (is_array($finalArray[$key])) {

                for ($k = 0; $k < 2; $k++) {
                    if (!array_key_exists(0, $finalArray[$key])) {

                        $finalArray[$key][0] = 0;
                    }
                }
            } else {

                for ($k = 0; $k < 2; $k++) {

                    $finalArray[$key][0] = 0;
                }
            }

            ksort($finalArray[$key]);
            
            if ($type == 'report') {

                //  $resArr[date($dateFormat, $startDate_tz)] = $dateArray;
                if ($diff > 365) {
                    $resArray["" . $key . ""] = $finalArray[$key];
                } elseif ($diff > 92 && $diff <= 365) {
                    $resArray["" . date('M Y', $startDate_tz) . ""] = $finalArray[$key];
                } elseif ($diff > 31 && $diff <= 92) {
                    $resArray["" . date($dateFormat, $startDate_tz) . ""] = $finalArray[$key];
                } elseif ($diff <= 31) {
                    //$resArray["" . date($dateFormat, $startDate_tz) . ""] = $finalArray[$key];
                    $resArray["" . date('M Y', $startDate_tz) . ""] = $finalArray[$key];
                }
            }else {

                if ($diff > 365) {
                    $resArray["'" . $key . "'"] = $finalArray[$key];
                } elseif ($diff > 92 && $diff <= 365) {
                    $resArray["'" . date('M Y', $startDate_tz) . "'"] = $finalArray[$key];
                } elseif ($diff > 31 && $diff <= 92) {
                    $resArray["'" . date($dateFormat, $startDate_tz) . "'"] = $finalArray[$key];
                } elseif ($diff <= 31) {
                    //$resArray["'" . date($dateFormat, $startDate_tz) . "'"] = $finalArray[$key];
                    $resArray["'" . date('M Y', $startDate_tz) . "'"] = $finalArray[$key];
                   
                }
            }
            
        }
        
        return $resArray;
          
            
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
            
    }

    
    

}
