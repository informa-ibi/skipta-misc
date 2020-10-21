<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CareerController extends Controller {
  

public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
    
    public function init() {
    parent::init();
       if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
            $this->whichmenuactive=6;
             $this->sidelayout = 'no';
          } else {
                  $this->redirect('/');
             }
 }
  public function actionIndex(){
      //Careers::model()->testsaveCareers();
        $this->render('index');
 }
 
 public function actionloadJobs() {
        try {
            if (isset($_GET['StreamPostDisplayBean_page'])) {

                $page = $_GET['StreamPostDisplayBean_page'];
                $pageLength = 10;
                if ($page == 1) {
                    $offset = $page - 1;
                    $limit = $pageLength;
                } else {

                    $offset = ($page - 1) * $pageLength;
                    $limit = $page * $pageLength;
                }


                $jobs = ServiceFactory::getSkiptaCareerServiceInstance()->getAllJobs($offset, $limit);
                if (!is_string($jobs)) {
                    $jobsData = $jobs;
                } else {
                    $jobsData = -1;
                }

                $this->renderPartial('loadJobs', array('jobs' => $jobsData));
            }
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }

    public function actionRenderPostDetailForCareer() {
        try {
            $jobId = $_REQUEST['id']; 
                $jobDetails = ServiceFactory::getSkiptaCareerServiceInstance()->getJobdetails($jobId);             
            if (!is_string($jobDetails)) {
                $this->renderPartial('renderCareerDetailPage', array('jobDetails' => $jobDetails));
            }
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }
    public function actionGetJobdetail() {
        try {
            $siteurl= YII::app()->getBaseUrl('true'); 
            $jobId = $_REQUEST['id']; 
            $category=12;
            $postType="";
             $loginUserId =  Yii::app()->session['TinyUserCollectionObj']['UserId'];
             $url="$siteurl"."/common/postdetail?postId=$jobId&categoryType=$category&postType=$postType&trfid=$loginUserId";
            $jobDetails = ServiceFactory::getSkiptaCareerServiceInstance()->getJobdetails($jobId);             
            $imageurl = Yii::app()->params['ServerURL']."/images/system";
            $this->renderPartial('career', array('job' => $jobDetails, 'siteurl' => $siteurl,'url' => $url,'iurl'=>$imageurl));
        } catch (Exception $exc) {
            error_log($exc->getMessage());
        }
    }

}