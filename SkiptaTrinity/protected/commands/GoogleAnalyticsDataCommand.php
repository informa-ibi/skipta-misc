<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Get google analytics data and save that in DB
 *  @version 1.0
 */
class GoogleAnalyticsDataCommand extends CConsoleCommand {

    public function run($args) {
        $this->SaveGooglAnalyticsData();
        $this->SaveGroupWiseGooglAnalyticsData();
        $this->SaveActiveUsers();
        $this->SaveGroupActiveUsers();
        $this->SaveGroupComebackUsers();
    }

     public function SaveGooglAnalyticsData(){
            try{
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->GetGoogleAnalyticsData();
            
            }catch(Exception $e){
                
            }
            
        }
         public function SaveGroupWiseGooglAnalyticsData(){
            
     $GroupAnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->SaveGroupGoogleAnalyticsData();
            
            
            
        }
         public function SaveActiveUsers(){
            
      $ActiveUsersData = ServiceFactory::getSkiptaPostServiceInstance()->SaveActiveUsersBasedonDaterange();
            
            
            
        }
        
          public function SaveGroupActiveUsers() {

        $GroupActiveUsersData = ServiceFactory::getSkiptaPostServiceInstance()->SaveGroupActiveUsersBasedonDaterange();
    }
    
      public function SaveGroupComebackUsers() {

        $GroupComebackUsersData = ServiceFactory::getSkiptaPostServiceInstance()->SaveGroupComebackUsersBasedonDaterange();
    }


}
