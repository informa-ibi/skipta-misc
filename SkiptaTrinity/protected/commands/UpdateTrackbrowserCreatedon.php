<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Update the Track browser detials created on date  for Analytics.
 *  @version 1.0
 */
class UpdateTrackbrowserCreatedon extends CConsoleCommand {

    public function run($args) {
        $this->UpdatetrackBrowserDetailsCreatedOnData();
      
    }

     public function UpdatetrackBrowserDetailsCreatedOnData(){
            
     $TrackbrowsersData = ServiceFactory::getSkiptaPostServiceInstance()-> UpdateTrackBrowserDetailsPosts();
   }
        
}
