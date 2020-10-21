<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Get google analytics data and save that in DB
 *  @version 1.0
 */
class GoogleAnalyticsPastDataCommand extends CConsoleCommand {

    public function run($args) {
        $this->SaveGooglAnalyticsPastData();
        
    }

     public function SaveGooglAnalyticsPastData(){
            try{
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->GetGoogleAnalyticsPastData();
            
            }catch(Exception $e){
                
            }
            
        }

}
