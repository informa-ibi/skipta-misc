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
        $this->SaveTopLeadersData();
        $this->SaveGroupTopLeadersData();
    }

     public function SaveTopLeadersData(){
            
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->SaveTopLeadersOfTheDay();
            
            
            
        }
        
        public function SaveGroupTopLeadersData(){
            
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->SaveGroupTopLeadersOfTheDay();
            
            
            
        }
}
