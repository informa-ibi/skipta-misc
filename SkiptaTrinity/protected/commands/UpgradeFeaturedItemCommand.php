<?php
/**
 * DocCommand class file.
 *
 * @author Haribabu
 * @usage Save top 10 leaders (hashtags,users,search items) that in DB
 *  @version 1.0
 */
class UpgradeFeaturedItemCommand extends CConsoleCommand {

   

    public function actionUpgradeFeaturedCollectionWithTitle() {
        try {
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('Description', '!=', "");
            $featuredItemst = NewsCollection::model()->findAll($mongoCriteria);
            foreach ($featuredItemst as $obj) {
                if (!isset($obj->Title) || $obj->Title == '') {
                    $mongoModifier = new EMongoModifier();
                    $titleText = CommonUtility::truncateHtml($obj->Description, 100);
                    $mongoModifier->addModifier('Title', 'set', $titleText);

                    $mongoModifier->addModifier('IsMultipleArtifact', 'set', 1);

                    $mongoCriteria->addCond('PostId', '==', $obj->PostId);
                    NewsCollection::model()->updateAll($mongoModifier, $mongoCriteria);
                }
            }
        } catch (Exception $exc) {
            error_log('--' . $exc->getMessage());
        }
    }
        
  
}
