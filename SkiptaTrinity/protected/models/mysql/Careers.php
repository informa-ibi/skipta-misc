<?php
class Careers extends CActiveRecord {
    
     public $id;
     public $JobDescription;
     public $JobPostion;
     public $JobRole;
     public $Location;
     public $ContactInformation;
     public $Industry;
     public $Category;
     public $JobTitle;
     public $IframeUrl;
     public $CreatedDate;
     public $Status;
     public $MigratedId;
     public $NetworkId;
     public $CreatedUserId;
     public $SnippetDescription;
     public $SnippetTitle;
     public $SnippetThumbnailUrl;
     public $JobId;
     public $EmployerName;
     public $EmployerEmail;
     public $City;
     public $State;
     public $Country;
     public $EAdditionalInfo;
     public $PostedDate;
     public $InternalApplyUrl;
     public $Source;
     public $Zip; 
     public $Latitude;
     public $Longitude;


     public static function model($className=__CLASS__)
    { 
        return parent::model($className);
    }
 
    public function tableName()
    { 
        return 'Careers';
    }
    
    public function saveCareers($obj) {
        try {
            $returnValue = false;
            $carrerObj = new Careers();
            
            $carrerObj->JobDescription = $obj->JobDescription;
            $carrerObj->ContactInformation = $obj->ContactInformation;
            $carrerObj->JobPosition = $obj->JobPosition;            
            $carrerObj->Location = $obj->Location;
            $carrerObj->Industry = $obj->Industry;
            $carrerObj->Category = $obj->Category;
            $carrerObj->JobTitle = $obj->JobTitle;            
            $carrerObj->CreatedDate = $obj->CreatedDate;
            $carrerObj->PostedDate = $obj->PostedDate;
            $carrerObj->Status = $obj->Status;
            $carrerObj->MigratedId = $obj->MigratedId;
            $carrerObj->NetworkId = 1;
            $carrerObj->CreatedUserId = $obj->CreatedUserId;
            if(isset($obj->IframeUrl) && !empty($obj->IframeUrl)){                
             $carrerObj->IframeUrl = $obj->IframeUrl;    
             $carrerObj->SnippetDescription = $obj->SnippetDescription;  
          //   echo '^^^'.$carrerObj->SnippetDescription;
             $carrerObj->SnippetTitle = addslashes($obj->SnippetTitle);    
             $carrerObj->SnippetThumbnailUrl = addslashes($obj->SnippetThumbnailUrl);                
            }
            if ($carrerObj->save()) {
                  error_log("before svae----------------------------****");
                          Yii::app()->amqp->stream(json_encode(array("Obj"=>$carrerObj,"ActionType"=>"GeoLocation","Type"=>"Career")));
            }
        } catch (Exception $exc) {
            $returnValue = false;
            error_log("==========in careers==============" . $exc->getMessage());
        }
    }
    
    public function testsaveCareers() {
        try {
            $returnValue = false;
            $carrerObj = new Careers();
            $carrerObj->JobDescription = 'Test Description 13';
            $carrerObj->ContactInformation = 'Vamsi';
            $carrerObj->JobPosition = 'Development';
            $carrerObj->JobRole = 'Dev';
            $carrerObj->Location ='Hyderabad';
            $carrerObj->Industry = 'software';
            $carrerObj->Category = '10';
            $carrerObj->JobTitle = 'Need PHP Developer with 3 exp';
            $carrerObj->IframeUrl = 'http://www.techo2.com';
            $carrerObj->CreatedDate =  date('Y-m-d H:i:s', time());
            $carrerObj->Status = 1;
            $carrerObj->MigratedId = 1;
            $carrerObj->NetworkId = 1;
            if ($carrerObj->save()) {
                
            }
        } catch (Exception $exc) {
            $returnValue = false;
            error_log("==========in careers==============" . $exc->getMessage());
        }
    }
    
    public function getJobsbyPagination($page,$pageLength){
        $returnValue='failure';
         try {          
//            $query="select *,SUBSTR(JobDescription,1,250) as JobDescription  from Careers order by CreatedDate desc limit $page,$pageLength " ;   
            // $query="select *, JobDescription  from Careers order by PostedDate desc limit $page,$pageLength " ;  
             $query="select *, JobDescription,0 as recommended  from Careers where Status=1 order by PostedDate desc limit $page,$pageLength " ;   
            $jobs = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($jobs)>0){
                $returnValue=$jobs;
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("=================".$exc->getMessage());
        }
        }
        
     public function getJobDetails($jobId){
         $returnValue='failure';
         try {
             $query="select * from Careers where id=".$jobId;             
             $jobDetails = Yii::app()->db->createCommand($query)->queryAll();   
             if(sizeof($jobDetails)){
                 $returnValue=$jobDetails;
             }
             return $returnValue; 
         } catch (Exception $exc) {
             error_log("=================".$exc->getMessage());
             return $returnValue; 
         }
          }
          
    public function getTimeForTheLastInsertRecord(){
        $returnValue='failure';
        try {
            $query="select DATE_ADD(CreatedDate, INTERVAL 1 SECOND) as CreatedDate from Careers where Source is NULL order by CreatedDate desc limit 1";
            $lastRecord = Yii::app()->db->createCommand($query)->queryRow();
            if(sizeof($lastRecord)){
                $returnValue=$lastRecord;
            }
            return $returnValue;
        } catch (Exception $exc) {
             error_log("=================".$exc->getMessage());
             return $returnValue; 
        }
        }  
        public function getCareerPostById($jobId){
        $returnValue='failure';
        try {
           $returnValue = Careers::model()->findByAttributes(array("id"=> $jobId));  
            return $returnValue;
        } catch (Exception $exc) {
             error_log("=================".$exc->getMessage());
             return $returnValue; 
        }
        }
        public function saveJobs($xmlfile){
            try{
                $xmlcont = simplexml_load_file($xmlfile);   
                $i = 0;
                foreach($xmlcont as $value){
                    error_log("Reading line no....$i");
                    $cobj = new Careers();                   
                    $cobj->JobId = str_replace("hec.","",$value->{'job-id'});
                    $tagsFreeDescription = strip_tags(html_entity_decode($value->{'description'}));
                    $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
                    $cobj->JobDescription = $tagsFreeDescription;
                    $cobj->Category = $value->{'category'};
                    $cobj->JobTitle = $value->{'title'};
                    $cobj->PostedDate = $value->{'date-posted'};
                    $cobj->EmployerName = $value->{'employer-name'};
                    $cobj->EmployerEmail = $value->{'employer-email'};
                    $cobj->InternalApplyUrl = $value->{'internal-apply-url'};
                    $cobj->Industry = $value->{'industry'};
                    $cobj->Source = $value->{'managed-by-board'};                                        
                    if($value->{'status-full-time'}){
                        $cobj->JobPosition = "FullTime";
                    }
                    if($value->{'status-part-time'} == "true"){
                        if(!empty($cobj->JobPosition))
                            $cobj->JobPosition = "$cobj->JobPosition | PartTime";
                        else
                            $cobj->JobPosition = "PartTime";
                    }
                    if($value->{'status-permanent'} == "true"){
                        if(!empty($cobj->JobPosition))
                            $cobj->JobPosition = "$cobj->JobPosition | Permanent";
                        else
                            $cobj->JobPosition = "Permanent";
                        
                    }
                    if($value->{'status-temporary'} == "true"){
                        if(!empty($cobj->JobPosition))
                            $cobj->JobPosition = "$cobj->JobPosition | Temporary";
                        else
                            $cobj->JobPosition = "Temporary";                        
                    }
                    if($value->{'status-contract'}  == "true"){
                        if(!empty($cobj->JobPosition))
                            $cobj->JobPosition = "$cobj->JobPosition | Contract";
                        else
                            $cobj->JobPosition = "Contract";                        
                    }                                     
                    
                    $cobj->City = $value->{'location'}->{'city'};
                    $cobj->State = $value->{'location'}->{'state'};
                    $cobj->Country = $value->{'location'}->{'country'};
                    $cobj->Zip = $value->{'location'}->{'zip'};
                    $cobj->EAdditionalInfo = $value->{'employer-additional-info'};
                    $cobj->NetworkId = 1;
                    $cobj->CreatedDate = date('Y-m-d H:i:s');
                    $cobj->Status = 1;
                    if($cobj->save()){  
                      
                         error_log("inserted successfully...$i");
                    }
                    $i++;
                }
                    
                return "success";
            }catch(Exception $ex){
                error_log("######Exception Occurred while saving jobs..###########.");
            }
                       
                
        }
        
        
     public function getJobDetailsbyJobId($jobId) {
        $returnValue = 'failure';
        try {

            $object = Careers::model()->findByAttributes(array("JobId" => $jobId));
            if (isset($object)) {
                $returnValue = $object;
            }
            return $returnValue;
        } catch (Exception $exc) {
            error_log("=================" . $exc->getMessage());
            return $returnValue;
        }
    }

    /**
         * 
         * @param type $xmlfile
         * @return string
         */
        public function saveHecJobs($obj) {
        try {
            // error_log(print_r($obj, true));
            $res = $this->getJobDetailsbyJobId($obj->JobId);
            $object = Careers::model()->findByAttributes(array("JobId" => $obj->JobId));
            if (!isset($object)) {                
                $cobj = new Careers();
                $cobj->JobId = $obj->JobId;
                $cobj->JobDescription = htmlspecialchars_decode($obj->JobDescription);
                $cobj->Category = $obj->Category;
                $cobj->JobTitle = $obj->JobTitle;
                $cobj->PostedDate = $obj->PostedDate;
                $cobj->EmployerName = $obj->EmployerName;
                $cobj->EmployerEmail = $obj->EmployerEmail;
                $cobj->InternalApplyUrl = $obj->InternalApplyUrl;
                $cobj->Industry = $obj->Industry;
                $cobj->Source = $obj->Source;
                $cobj->JobPosition = $obj->JobPosition;
                $cobj->City = $obj->City;
                $cobj->State = $obj->State;
                $cobj->Country = $obj->Country;
                $cobj->Zip = $obj->Zip;
                $cobj->EAdditionalInfo = $obj->EAdditionalInfo;
                $cobj->NetworkId = 1;
                $cobj->CreatedDate = date('Y-m-d H:i:s');
                $cobj->Status = 1;
                if ($cobj->save()) {
                     Yii::app()->amqp->stream(json_encode(array("Obj"=>$cobj,"ActionType"=>"GeoLocation","Type"=>"Career")));
                    error_log("inserted successfully...i");
                }
            }else{
                         $object->JobDescription = htmlspecialchars_decode($obj->JobDescription);
                         $object->PostedDate = $obj->PostedDate;
                         $object->CreatedDate = date('Y-m-d H:i:s');
                         $object->Status = 1;
                if ($object->update()) {
                    $return = "success";
                }
            }
            return "success";
        } catch (Exception $ex) {
            error_log("######Exception Occurred while saving jobs..###########.");
            Yii::log("saveHecJobs" . $ex->getMessage(), "error", "application");
        }
    }
    
  /**
* This moethod is used to update the Jobs status
* @param type string
* @return string
* @Author Haribabu
*/  
 public function updateJobsStatus(){
        $returnValue='failure';
         try {            
            $query="UPDATE Careers SET Status=0 where Source IS  NULL and datediff(curdate(),CreatedDate) >90";
           
            // $jobs = Yii::app()->db->createCommand($query)->queryAll();  
            $jobs= YII::app()->db->createCommand($query)->execute();
            return $jobs;
        } catch (Exception $exc) {
            Yii::log("updateJobsStatus" . $exc->getMessage(), "error", "application");
        }
  }
  /**
* This moethod is used to update the Hec Jobs status
* @param type string
* @return string
* @Author Haribabu
*/  
 public function updateHecJobsStatus(){
        $returnValue='failure';
         try {            
            $query="UPDATE Careers SET Status = 0 where Source='hec' ";
           
             $jobs = Yii::app()->db->createCommand($query)->execute();
              
            if(sizeof($jobs)>0){
                $returnValue=$jobs;
            }
            return $returnValue;
        } catch (Exception $exc) {
           Yii::log("updateHecJobsStatus" . $exc->getMessage(), "error", "application");
        }
  }
 public function getAllCareerJobs(){
     try {
            $returnValue='failure';
            $query="select * from Careers";            
             $users = Yii::app()->db->createCommand($query)->queryAll();
             if(count($users)>0){
                 $returnValue= $users;
             }
             return $returnValue;
        } catch (Exception $exc) {
            Yii::log("error".$exc->getTraceAsString(),'error','application');
        }
 } 
  public function updateCareerJobsLatLongById($lat, $long,$id){
        $returnValue='failure';
         try {            
            $query="UPDATE Careers SET Latitude = $lat,Longitude = $long where id=$id ";
             $jobs= YII::app()->db->createCommand($query)->execute();
             $returnValue="success";
            return $returnValue;
        } catch (Exception $exc) {
           Yii::log("updateCareerJobsLatLongById" . $exc->getMessage(), "error", "application");
        }
  }   

   public function getAllCareersLocation(){
        $returnValue=  array();
         try {            
//            $query="select *,SUBSTR(JobDescription,1,250) as JobDescription  from Careers order by CreatedDate desc limit $page,$pageLength " ;   
            // $query="select *, JobDescription  from Careers order by PostedDate desc limit $page,$pageLength " ;  
             $query="select id,Source,JobTitle,City,State,Country,Zip from Careers where Latitude is  null or Latitude=''" ;   
            $jobs = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($jobs)>0){
                $returnValue=$jobs;
            }
            return $returnValue;
        } catch (Exception $exc) {
             Yii::log("getAllCareersLocation" . $ex->getMessage(), "error", "application");
        }
        }

        public function updateCareerGeoCoordinates($latitude,$longitude,$id){
          try {
            $return = "failed";
            $jobObj = Careers::model()->findByAttributes(array("id" => $id));            
            if (isset($jobObj)) {
                $jobObj->Latitude = $latitude;
                $jobObj->Longitude = $longitude;            
                if ($jobObj->update()) {
                    $return = "success";
}
            }
            return $return;
        } catch (Exception $ex) {
            Yii::log("updateCareerGeoCoordinates" . $ex->getMessage(), "error", "application");
           
        }
     } 
     
         public function getJobsByUserLatAndLongLesserThanRadius($lat,$long,$distance,$page,$pageLength,$subSpecialty){
    try {
        $returnValue=array();
        $query="SELECT  *, JobDescription,1 as recommended, (3959 * acos (cos ( radians($lat) )* cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians($long) )
      + sin ( radians($lat) )* sin( radians( Latitude ) ))) AS distance FROM Careers where Status=1 or JobTitle like '".$subSpecialty."' having distance <= $distance
ORDER BY PostedDate desc limit $page,$pageLength";       
        error_log("--------------**----------------------".$query);
         $jobs = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($jobs)>0){
                $returnValue=$jobs;
            }
            return $returnValue;
        
        
    } catch (Exception $exc) {
        Yii::log("=========".$exc->getMessage(),'error','application');
    }
}  
 public function getJobsByUserLatAndLongGreaterThanRadius($lat,$long,$distance,$page,$pageLength){
    try {
        $returnValue=array();
       $query="SELECT  *, JobDescription,0 as recommended FROM Careers where Status=1 and id not in(select CASE  WHEN (GROUP_CONCAT(a.id) IS NULL) THEN 0 ELSE GROUP_CONCAT(a.id)  end from (SELECT  id,
    3959 * acos (
      cos ( radians($lat) )
      * cos( radians( Latitude ) )
      * cos( radians( Longitude ) - radians($long) )
      + sin ( radians($lat) )
      * sin( radians( Latitude ) )
    )
  AS distance 
FROM Careers having distance <$distance ) as a) 
ORDER BY PostedDate desc limit $page,$pageLength";               
      error_log("++++++++++++++>>>>>+++++++++++".$query);
         $jobs = Yii::app()->db->createCommand($query)->queryAll();           
            if(sizeof($jobs)>0){
                $returnValue=$jobs;
            }
            return $returnValue;
        
        
    } catch (Exception $exc) {
        error_log("______lat and long <______________________".$exc->getMessage());
        Yii::log("=========".$exc->getMessage(),'error','application');
    }
}
    public function getRecommondedJobsCount($lat,$long,$distance,$subSpecialty){
        try {
            $returnValue = 0;
            $query="SELECT  (3959 * acos (cos ( radians($lat) )* cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians($long) )
          + sin ( radians($lat) )* sin( radians( Latitude ) ))) AS distance FROM Careers where Status=1 or JobTitle like '".$subSpecialty."' having distance <= $distance";
            

             $jobs = Yii::app()->db->createCommand($query)->queryAll();           
                if(sizeof($jobs)>0){
                    $returnValue=sizeof($jobs);
                }
            return $returnValue;


        } catch (Exception $exc) {
            error_log("__________________>>>_____________".$exc->getMessage());
            Yii::log("=========".$exc->getMessage(),'error','application');
        }
    }


}

