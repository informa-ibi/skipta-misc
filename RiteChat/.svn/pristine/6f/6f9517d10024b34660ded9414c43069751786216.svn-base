<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class RestCareersController extends Controller {
    
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
    public function actionloadJobs() {
        try {
            error_log("---------------actionloadJobs----------------------------------");
          
            if (isset($_POST["mobile"]) && $_POST["mobile"] == 1) {
                $_GET['StreamPostDisplayBean_page'] = $_POST['Page'];
            }
            if (isset($_GET['StreamPostDisplayBean_page'])) {

                $page = $_GET['StreamPostDisplayBean_page'];
                $pageLength = Yii::app()->params['MobilePageLength'];
                if ($page == 1) {
                    $offset = $page - 1;
                    $limit = $pageLength;
                } else {

                    $offset = ($page - 1) * $pageLength;
                    $limit = $page * $pageLength;
                }


                $jobs = ServiceFactory::getSkiptaCareerServiceInstance()->getAllJobs($offset, $limit);
               
                if (!is_string($jobs)) {
                        $jobsArray = array();
                   foreach ($jobs as $job) {
                       $job["JobDescription"] = strip_tags($job["JobDescription"]);
                         $job["SnippetDescription"] = $job["SnippetDescription"];
                         
                 $descriptionLength = strlen($job["SnippetDescription"]);
                 error_log("descriptionLength-----------------------".$descriptionLength);
               
                 if ($descriptionLength > 240) {
                    $description = CommonUtility::truncateHtml($job["SnippetDescription"], 240, '...', true, true, '<span> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>');
                    $job["SnippetDescription"] = $description;
                 
                }
                       
                      $job['CreatedDate'] =  CommonUtility::styleDateTime(strtotime($job['CreatedDate']), "mobile");
                       array_push($jobsArray, $job);
                   }
                       $jobsData = $jobsArray;
                } else {
                    if($_GET['StreamPostDisplayBean_page'] == 1){
                        $jobsData = 0;
                    }else{
                        $jobsData = -1;
                    }
                    
                }
                $obj = array("stream"=>$jobsData);
               echo $this->rendering($obj);
               // $this->renderPartial('loadJobs', array('jobs' => $jobsData));
            }
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
        public function actionRenderPostDetailForCareer() {
        try {
            error_log("actionRenderPostDetailForCareer**--");
            $jobId = $_REQUEST['id']; 
                $jobDetails = ServiceFactory::getSkiptaCareerServiceInstance()->getJobdetails($jobId);
                error_log("actionRenderPostDetailForCareer-----".$jobDetails['CreatedDate'] );
                  $jobsArray = array();
                foreach ($jobDetails as $job) {
                      $job['CreatedDate'] = CommonUtility::styleDateTime(strtotime($job['CreatedDate']), "mobile"); 
                    array_push($jobsArray, $job);
                      
                }
             
            if (!is_string($jobDetails)) {
                $obj = array("status"=>"success",'data' => $jobsArray,'error'=>"");
                echo $this->rendering($obj);
            }
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }

}

