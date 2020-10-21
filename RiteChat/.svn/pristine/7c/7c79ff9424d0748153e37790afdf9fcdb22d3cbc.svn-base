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
             $query="select *, JobDescription  from Careers order by CreatedDate desc limit $page,$pageLength " ;   
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

}

