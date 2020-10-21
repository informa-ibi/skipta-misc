<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Update categories lowerCategoryName
 *  @version 1.0
 */
class UpdateCategoryNameCommand extends CConsoleCommand {

    public function run($args) {
        $this->UpdateCategoryName();
        
    }

     public function UpdateCategoryName(){
            try{
                $categoryData = ServiceFactory::getSkiptaTopicServiceInstance()->UpdateCategoriesLowerCategoryName();
                
            }catch(Exception $e){
                
            }
            
        }

}
