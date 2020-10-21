<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage update the websnippet data in DB
 *  @version 1.0
 */
class WebsnippetDataCommand extends CConsoleCommand {

    public function run($args) {
        $this->UpdateAllWebSnippetdata();
        $this->DeleteTempDirectoryFiles();
       
    }

     public function UpdateAllWebSnippetdata(){
            try{
     $AnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->UpdateAllWebSnippetdata();
            
            }catch(Exception $e){
                
            }
            
        }
         public function DeleteTempDirectoryFiles(){
            
         $GroupAnalyticsData = ServiceFactory::getSkiptaPostServiceInstance()->DeleteTempDirectoryFiles();
                       
            
        }


}
