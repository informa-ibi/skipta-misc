<?php

/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class UpdateTimeStampCommand extends CConsoleCommand {

    public function run($args) {
         $mongoCriteria = new EMongoCriteria;
           $data = gmdate('m/d/Y', strtotime("-1 day"));
            $startDate = date('Y-m-d', strtotime($data));
            $endDate = date('Y-m-d');
            $endDate = trim($endDate) . " 23:59:59";
            $startDate = trim($startDate) . " 00:00:00";
         $mongoCriteria->addCond("CreatedOn", "<", new MongoDate(strtotime($startDate)));
       
         $mongoCriteria->sort("CreatedOn", EMongoCriteria::SORT_DESC);
        if ($args[0] == "posts") {
      
       // $mongoCriteria->addCond("_id", "==", new MongoId("545895f39f8ccbca328b458f"));
           $posts = PostCollection::model()->findAll($mongoCriteria);
           $this->updateTimeStamp($posts,'post');
    
        }
         if ($args[0] == "curbside") {
          //   $mongoCriteria->addCond("_id", "==", new MongoId("545895f39f8ccbca328b458f"));
             $posts = CurbsidePostCollection::model()->findAll($mongoCriteria);
             $this->updateTimeStamp($posts,'curbside');
            // $this->updateResource("53e350d2cec9fee5118b45d2");
           // $this->updateStream("545895f39f8ccbca328b458f");
        }
         if ($args[0] == "group") {
             
            // $mongoCriteria->addCond("_id", "==", new MongoId("5458a3159f8ccb0e788b4567"));
             $posts = GroupPostCollection::model()->findAll($mongoCriteria);
             $this->updateTimeStamp($posts,'group');
        }
         if ($args[0] == "all") {
            $posts = PostCollection::model()->findAll($mongoCriteria);
            $this->updateTimeStamp($posts,'post');
            $curbposts = CurbsidePostCollection::model()->findAll($mongoCriteria);
            $this->updateTimeStamp($curbposts,'curbside');
            $groupposts = GroupPostCollection::model()->findAll($mongoCriteria);
            $this->updateTimeStamp($groupposts,'group');
           $newsposts = GroupPostCollection::model()->findAll($mongoCriteria);
            $this->updateTimeStamp($newsposts,'news');
        }
    }

    function updateTimeStamp($posts,$type) {
        
        foreach ($posts as $post) {
         
             $this->updatePost($type,$post->_id,$post->CreatedOn);

    }
    }

    function updatePost($type,$postId,$createdOn) {
        $update=FALSE;
      //  error_log("update Post-------$type-------" . $postId . "-----" . $updateResource . "---" . $updateArtifact);
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;
        $updatedDateInSec=$createdOn->sec + 86400;//adding one day
       
       // $time=$this->timeCalculate();
        
        $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate($updatedDateInSec));

        $mongoCriteria->addCond('_id', '==', new MongoId($postId));
        if($type == "post"){
           $update = PostCollection::model()->updateAll($mongoModifier, $mongoCriteria);
           $db = PostCollection::model()->getDb();  
           $this->updateComment($postId,$db,'PostCollection');
        }
        if($type == "curbside"){
           $update = CurbsidePostCollection::model()->updateAll($mongoModifier, $mongoCriteria); 
           $db = CurbsidePostCollection::model()->getDb();  
           $this->updateComment($postId,$db,'CurbsidePostCollection');
        }
        if($type == "group"){
           $update = GroupPostCollection::model()->updateAll($mongoModifier, $mongoCriteria); 
           $db = GroupPostCollection::model()->getDb();  
           $this->updateComment($postId,$db,'GroupPostCollection');
        }
         if($type == "news"){
           $update = CuratedNewsCollection::model()->updateAll($mongoModifier, $mongoCriteria); 
           $db = CuratedNewsCollection::model()->getDb();  
           $this->updateComment($postId,$db,'CuratedNewsCollection');
        }
    
        
        
        if ($update) {
      
             $this->updateStream($postId,$updatedDateInSec);
        }
    }

    function timeCalculate() {
        rand(10000, 604800);
        
     //  new MongoDate(strtotime(date('Y-m-d H:i:s', time())))
     return strtotime(date('Y-m-d H:i:s', time()-rand(10000, 604800)));
    }
   

    function updateStream($postId,$time) {
        error_log("updateStream----------------" . $postId);
        $mongoCriteria = new EMongoCriteria;
        $mongoCriteria->addCond('PostId', '==', new MongoId($postId));
        //  $mongoCriteria->addCond('_id', '==', new MongoId("5458731a9f8ccb5a4c8b4578")); 
        $stream = UserStreamCollection::model()->find($mongoCriteria);
      
        $mongoModifier=new EMongoModifier();
        if(isset($stream)){
        $mongoModifier->addModifier('CreatedOn', 'set', new MongoDate($time));
        }

        $mongoCriteria->addCond('PostId', '==', new MongoId($postId));
       // $update = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
         $db = UserStreamCollection::model()->getDb();  
                       $this->updateComment($postId,$db,'UserStreamCollection');
        $update = FollowObjectStream::model()->updateAll($mongoModifier, $mongoCriteria);
      //   $db = FollowObjectStream::model()->getDb();  
           $this->updateComment($postId,$db,'FollowObjectStream');
      //  $update = UserActivityCollection::model()->updateAll($mongoModifier, $mongoCriteria);
         $db = UserActivityCollection::model()->getDb();  
           $this->updateComment($postId,$db,'UserActivityCollection');
     //   $update = UserStreamCollection::model()->updateAll($mongoModifier, $mongoCriteria);
    }
    
    function updateComment($postId,$db,$collectionName)
    {
        try{
        $toexec = 'function(postId,collectionName) { return updateSubDocument(postId,collectionName) }';
         $args=array((String)$postId,$collectionName);
         $response=$db->execute($toexec, $args);
          
        
        }catch(Exception $e){
            echo $e->getTraceAsString()."@@@@@@@@@@@@@@@@@@@@@@@@@".$e->getMessage();
            
        }

  
    }
   

}
