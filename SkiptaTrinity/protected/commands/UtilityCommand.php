<?php

/**
 * @author reddy
 * @class Utility( for temp use)
 */
class UtilityCommand extends CConsoleCommand {
 
    
     public function run($args) {
       //  error_log("args----".print_r($args,1));
         if($args[0]=="UserGeo"){
             echo "User GEO STARt";
           $this->updateAllUsersLatLongs();  
         }
         else if($args[0]=="CareersGeo"){
                 echo "Career  GEO STARt";
           $this->updateAllCarrerJobsLatLongs();  
         }else if($args[0]=="MakeGroupAdmin"){
            $this->makeGroupAdmin(); 
         }
         else if($args[0]=="LocationRecommendations" || $args[0]=="ClassificationRecommendations" ||$args[0]=="InterestRecommendations" ){
          echo "LocationRecommendations classfication interest";
             $this->runLocationRecommendations(); 
            $this->runClassificationRecommendations(); 
            $this->runInterestRecommendations(); 
         }
         
      
}
    
public function makeGroupAdmin() {
        try {

            //  $criteria->GroupName = new MongoRegex('/' . $searchKey . '.*/i');
            $data = GroupCollection::model()->findAll();

            foreach ($data as $obj) {

                echo $obj->GroupName . '______';


                $mongoCriteria = new EMongoCriteria;
                $mongoModifier = new EMongoModifier;
                if (isset(YII::app()->params['NetworkAdminEmail'])) {
                    $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(YII::app()->params['NetworkAdminEmail'], 'Email');
                    $mongoModifier->addModifier('GroupAdminUsers', 'push', (int) $netwokAdminObj->UserId);
                    $mongoCriteria->addCond('GroupAdminUsers', '!=', (int) $netwokAdminObj->UserId);
                    $mongoModifier->addModifier('CreatedUserId', 'set', (int) $netwokAdminObj->UserId);
                }
                $mongoCriteria->addCond('_id', '==', $obj->_id);

                $return = GroupCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            }
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage() . $exc->getLine();
        } catch (Exception $exc) {
            echo '_________Exception______________________' . $exc->getMessage();
        }
    }
    
     public function updateAllUsersLatLongs() {
        echo "GEO Start";
        $returnValue = 'failure';
        try {
            $allUsers = User::model()->getAllUsersLocation();

            foreach ($allUsers as $value) {
                $addressArray = array("Zip" => $value['Zip'], "City" => $value['City'], "State" => $value['State'], "Country" => $value['Country'], "Address1" => $value['Address1'], "Address2" => $value['Address2']);
                $geocode = CommonUtility::getGeocodes($addressArray);
                // error_log("--geocode-----" . print_r($geocode, 1));
                if ($geocode["Status"] == 200) {
                    ServiceFactory::getSkiptaUserServiceInstance()->updateUserGeoCoordinates($geocode["Latitude"], $geocode["Longitude"], $value['UserId']);
                } else {
                    echo "not available geo code";
                }
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            $returnValue = "failure";
        }

        return $returnValue;
    }

    public function updateAllCarrerJobsLatLongs() {
        $returnValue = 'failure';
        try {
            $allcareers = Careers::model()->getAllCareersLocation();
            foreach ($allcareers as $value) {
                if ($value["Source"] != "hec") {
                    $jobTitle = $value['JobTitle'];
                    $jobTitleArray = explode("-", $jobTitle);
                    if (count($jobTitleArray) > 2) {
                        $location = end($jobTitleArray);
                        $locationArray = explode(",", $location);
                        if (count($locationArray) > 0) {
                            if (count($locationArray) > 1) {
                                $value['City'] = $locationArray[0];
                                $value['State'] = $locationArray[1];
                            } else {
                                $value['State'] = $locationArray[0];
                            }
                        }
                    }
                }
                $addressArray = array("Zip" => $value['Zip'], "City" => $value['City'], "State" => $value['State'], "Country" => $value['Country'], "Address1" => "", "Address2" => "");
                $geocode = CommonUtility::getGeocodes($addressArray);
                // error_log("--geocode-----" . print_r($geocode, 1));
                if ($geocode["Status"] == 200) {
                    ServiceFactory::getSkiptaCareerServiceInstance()->updateCareerGeoCoordinates($geocode["Latitude"], $geocode["Longitude"], $value['id']);
                } else {
                    error_log("--geocode---is not available--");
                }
            }
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            $returnValue = "failure";
        }

        return $returnValue;
    }
   
    
    public function runLocationRecommendations(){
        $users = User::model()->getAllActiveUserObjects();
        $radius = Yii::app()->params['RecomendedJobsRadius'];
        if(count($users)>0){
        foreach ($users as $user) {
        $userFollowingArray = UserProfileCollection::model()->getUserFollowingById($user["UserId"]);
        if($userFollowingArray == "failure"){
            $userFollowingArray = array();
        }
        $userId = $user["UserId"];
        $latitude = $user["Latitude"];
        $longitude = $user["Longitude"];
        $myNearUsers =  User::model()->getMyLocationRecommendations($userId,$latitude,$longitude,$radius);
        if(count($myNearUsers)>0){
        foreach ($myNearUsers as $nearUser) {
            if(!in_array($nearUser["UserId"], $userFollowingArray)){
               CommonUtility::pushToRecommendation($user["UserId"],$nearUser["UserId"],preg_replace('/\t/', '',(trim($user["City"])."-".trim($user["State"]))),"Location"); 
            }
            
        }
        }
        
        }
        }
    }
      public function runClassificationRecommendations(){
        $users = User::model()->getAllUserClassfication();
     if(count($users)>0){
        foreach ($users as $user) {
        $userFollowingArray = UserProfileCollection::model()->getUserFollowingById($user["UserId"]);
        if($userFollowingArray == "failure"){
            $userFollowingArray = array();
        }
        $userId = $user["UserId"];
        $userClassification = $user["UserClassification"];
        if(isset($user["PrimaryAffiliation"]) && !empty($user["PrimaryAffiliation"])){
        $primaryAffiliation = $user["PrimaryAffiliation"];
        $otherAffiliation = $user["OtherAffiliation"];
        
        if(isset($otherAffiliation) && $otherAffiliation!=""){
           $recommendationItem  =  $userClassification."-".$primaryAffiliation."-".$otherAffiliation;
        }else{
           $recommendationItem  =  $userClassification."-".$primaryAffiliation;  
        }
        
        
        $myClassficationUsers =  User::model()->getMyClassficationRecommendations($userId,$userClassification,$primaryAffiliation,$otherAffiliation);
        if(count($myClassficationUsers)>0){
        foreach ($myClassficationUsers as $classificationUser) {
          
            if(!in_array($classificationUser["UserId"], $userFollowingArray)){
               CommonUtility::pushToRecommendation($user["UserId"],$classificationUser["UserId"],$recommendationItem,"Classification"); 
            }
            
        }
        }
        }
      }
        }

    }
    public function runInterestRecommendations(){
           $users = User::model()->getAllUserInterests();
           
     if(count($users)>0){
        foreach ($users as $user) {
        $userFollowingArray = UserProfileCollection::model()->getUserFollowingById($user["UserId"]);
        if($userFollowingArray == "failure"){
            $userFollowingArray = array();
        }
        $userId = $user["UserId"];
        $tags = $user["Interests"];
        $interestsArray =  explode(",", $tags);
        if(count($interestsArray)>0){
        foreach ($interestsArray as $interest) {
        
            if(trim($interest)!=""){
            $myInterestUsers =  User::model()->getMyInterestRecommendations($userId,$interest);
              if(count($myInterestUsers)>0){
            foreach ($myInterestUsers as $interestUser) {
                if(!in_array($interestUser["UserId"], $userFollowingArray)){
                   CommonUtility::pushToRecommendation($user["UserId"],$interestUser["UserId"],$interest,"Interest"); 
                }

            }
            }
        }
        }
        }

        
        }
        }
    }

}

?>