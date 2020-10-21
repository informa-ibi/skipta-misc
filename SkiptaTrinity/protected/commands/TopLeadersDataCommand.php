<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Save top 10 leaders (hashtags,users,search items) that in DB
 *  @version 1.0
 */
class TopLeadersDataCommand extends CConsoleCommand {

    public function run($args) {
         echo '_________________________';
        $this->SaveTopLeadersData();
        $this->SaveGroupTopLeadersData();
    }

     public function SaveTopLeadersData(){
            
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->SaveTopLeadersOfTheDay();
    print_r($AnalyticsData,true);
            
            
            
        }
        
        public function SaveGroupTopLeadersData(){
            
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->SaveGroupTopLeadersOfTheDay();
            
            
            
        }
}
