<?php
/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class updateResourceThumbNailPathCommand extends CConsoleCommand {

    public function run($args) {
        $this->updateResourceThumbNailImage();
    }

     public function updateResourceThumbNailImage(){
            
            $resources= ServiceFactory::getSkiptaPostServiceInstance()->getAllResources();
            foreach ($resources as $key => $resource) {

                if(isset($resource['ThumbNailImage']) && $resource['ThumbNailImage']=="" ){
                   $extension=$resource['Extension'];
                    $url=$resource['Uri'];
                  $resourceId=$resource['_id'];
                  $groupId=$resource['GroupId'];
                  $resourceName=$resource['ResourceName'];
                     $Updateresources= ServiceFactory::getSkiptaPostServiceInstance()->UpdateResourceThumbNailImage($resourceId,$extension,$url,$resourceName);

                }else{

                }
                //exit;
        }
            
            
            
        }
}
