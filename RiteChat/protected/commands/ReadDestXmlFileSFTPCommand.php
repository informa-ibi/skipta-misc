<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ReadDestXmlFileSFTPCommand extends CConsoleCommand{
    
    public $xmlfile;
    
    public function actionSetFile($filename){
        try{
            error_log("SetFile to $filename...");           
            $this->xmlfile = $filename;            
        } catch (Exception $ex) {
            error_log("====Exception Occurred while running actionSetFile =====".$ex->getMessage());
        }
    }
    /*
     * 
     */
    public function actionGetFileName(){
        try{
            error_log("File name.....$this->xmlfile");                                 
        } catch (Exception $ex) {
            error_log("====Exception Occurred while running actionGetFileName =====".$ex->getMessage());
        }
    }
    
    public function actionReadFileAndLoad(){
        try{            
            $fileDirctoryPath = $this->findUploadedPath();
            $sftpObj = Yii::app()->sftp; 
            error_log("Connecting to sftp...");
            if($sftpObj->connect()){
                error_log("sftp connected");
            }
            $cur_dir = $sftpObj->getCurrentDir();
            error_log("SFTP CUrrent dierctory $cur_dir");            
            $files = $sftpObj->listFiles($cur_dir);
            print_r($files);
            $remotePath = $cur_dir.'employee.xml';

            error_log("SFTP CUrrent dierctory...$remotePath");
            
            if($sftpObj->getFile("employee.xml",$fileDirctoryPath."/protected/employee.xml")){
             error_log("downloaded successfully....!!!");   
            }
            } catch (Exception $ex) {
            error_log("====Exception Occurred while running actionReadFileAndLoad =====".$ex->getMessage());
        }
    }
    
    function findUploadedPath() {
     
        try {
          $originalPath="";
            $path = dirname(__FILE__);
            $pathArray = explode('/', $path);
            $appendPath = "";
            for ($i = count($pathArray) - 3; $i > 0; $i--) {
                $appendPath = "/" . $pathArray[$i] . $appendPath;
            }
            
            $originalPath = $appendPath;
        } catch (Exception $ex) {
            error_log("#########Exception Occurred########$ex->getMessage()");
        }
        return $originalPath;
 } 
}
