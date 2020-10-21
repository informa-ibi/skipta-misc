<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Update game resources for thumbnail image.
 *  @version 1.0
 */
class UpdateGameThumbnailimageCommand extends CConsoleCommand {

    public function run($args) {
        $this->UpdategameResourcesForThumbnail();
        
    }

     public function UpdategameResourcesForThumbnail(){
            try{
                $ThumbnailsData = ServiceFactory::getSkiptaGameServiceInstance()->UpdateGamaResourceswithThumbnailImage();
                
                $this->updateGameResoucesInStream();
                
                
            }catch(Exception $e){
                
            }
            
        }
        
         public function updateGameResoucesInStream() {
        try {
     
        
        $posts = GameCollection::model()->findAll();

            foreach ($posts as  $value) {

                if (isset($value->Resources['ThumbNailImage'])) {
                    echo $value->Resources['ThumbNailImage'];
                    $mongoCriteria = new EMongoCriteria;
                    $mongoModifier = new EMongoModifier;

                    $thumbImage = $value->Resources['ThumbNailImage'];
                    $mongoModifier->addModifier('Resource', 'set', trim($thumbImage));
                    $mongoCriteria->addCond('PostId', '==', new MongoId($value->_id));
                    UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
                }
            }

           
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

        
}
