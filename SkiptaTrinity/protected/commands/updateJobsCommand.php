<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class updateJobsCommand extends CConsoleCommand {
    
    public function run($args) {
        $this->UpdateJobsStatus();
        
    }

     public function UpdateJobsStatus(){
            try{
                $JobsData = ServiceFactory::getSkiptaCareerServiceInstance()->UpdateJobsStatus();
                
                
            
            }catch(Exception $e){
                
            }
        }
}
