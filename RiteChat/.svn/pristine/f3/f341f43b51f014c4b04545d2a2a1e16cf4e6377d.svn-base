<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author Vamsi Krishna
 * This class is used write all the methods for Career Service 
 * 
 */
 class SkiptaCareerService {
     
   public function getAllJobs($page,$pageLength){
         try
        { 
            $jobs= Careers::model()->getJobsbyPagination($page,$pageLength);
            return $jobs;
        
       
      } catch (Exception $exc) {
          error_log("****************".$exc->getMessage());
          Yii::log('In Excpetion gameprofilebox'.$exc->getMessage(),'error','application');
      }
   }
   
   public function getJobdetails($jobId){
       try {
           $jobDetails=Careers::model()->getJobDetails($jobId);
           return $jobDetails;
       } catch (Exception $exc) {
           error_log("****************".$exc->getMessage());
          Yii::log('In Excpetion getJobdetails'.$exc->getMessage(),'error','application');
       }
      }
 }