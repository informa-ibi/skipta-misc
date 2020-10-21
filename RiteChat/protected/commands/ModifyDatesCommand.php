
<?php
/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class ModifyDatesCommand extends CConsoleCommand {

    public function run($args) {
        $this->modifyGroupCollectionDate();
    }
       public function modifyGroupCollectionDate(){
            //  $criteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
         $criteria = new EMongoCriteria;  
          $modifier = new EMongoModifier;
          //$criteria->UserId = (int)1;
       // $criteria->addCond('pageIndex','in',array((int)9));
         $allposts = GroupPostCollection::model()->findAll($criteria);  
         error_log("- modifyDate ------------------".count($allposts));
        // $criteria = new EMongoCriteria;  
         foreach ($allposts as $value) {
           // error_log("value------".date('Y-m-d', $value['CreatedOn']->sec) );
            // $modifier->addModifier('CreatedOn', 'set', new MongoDate(time()));
         $modifier->addModifier('CreatedDate', 'set', date('Y-m-d', $value['CreatedOn']->sec));
        $criteria->addCond('_id', '==', $value['_id']);
         $value->updateAll($modifier,$criteria);  
         }
        
        
    }


}
