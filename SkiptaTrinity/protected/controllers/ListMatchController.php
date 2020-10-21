<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ListMatchController extends Controller{
    
    public function init() {
       // parent::init();
        
//            if(isset(Yii::app()->session['TinyUserCollectionObj'])){
//                 $this->tinyObject=Yii::app()->session['TinyUserCollectionObj'];
//                  $this->userPrivileges=Yii::app()->session['UserPrivileges'];
//                $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
//                $this->whichmenuactive=8;
//                if(Yii::app()->session['IsAdmin']=='1')
//                {   
//                    //$this->redirect('/');
//                }else{
//                    if($this->userPrivilegeObject->canManageFlaggedPost==1 || $this->userPrivilegeObject->canManageAbuseScan==1 ){
//                        
//                    }else{
//                       $this->redirect('/'); 
//                    }
//                }
//             }else{
//                  $this->redirect('/');
//        }
     //   CommonUtility::registerClientScript('simplePagination/','jquery.simplePagination.js');
        CommonUtility::registerClientScript('adminOperations.js');
        CommonUtility::registerClientCss();
    }

    public function actionIndex(){
       $normalPostModel = new ListMatchForm();
      
        $this->render('listmatch', array('listmatchForm' => $normalPostModel));   
    }
    /**
     * ActionUserManagement: 
     * called for the time and get with Users Object and then render to a view.
     */
    // first time it will called...
    public function actionListmatch(){
         $normalPostModel = new ListMatchForm();
      
        $this->render('listmatch', array('listmatchForm' => $normalPostModel));
      
    }
    
    /**
     * @author Reddy
     *  This  method is used for  upload the artifacts and save different folders based on type of file uploaded.
     */
    public function actionUpload() {
        try {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            //  $folder=Yii::getPathOfAlias('webroot').'/temp/';// folder for uploaded files
            $folder = Yii::app()->params['ArtifactSavePath'];
            $webroot = Yii::app()->params['WebrootPath'];
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedExtensions = array("csv"); //array("jpg","jpeg","gif","exe","mov" and etc...
            //$sizeLimit = 30 * 1024 * 1024; // maximum file size in bytes
             $sizeLimit= Yii::app()->params['UploadMaxFilSize'];
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            
            if(isset($result['filename'])){
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
             $result["filepath"]= Yii::app()->getBaseUrl(true).'/temp/'.$fileName;
             $result["fileremovedpath"]= $folder.$fileName; 
            }else{
              $result['success']=false;  
            }

            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return; // it's array
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    }
   
   
    
    
}