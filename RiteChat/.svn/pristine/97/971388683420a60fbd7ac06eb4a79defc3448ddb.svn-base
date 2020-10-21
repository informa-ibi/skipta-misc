<?php
/**
 * DocCommand class file.
 *
 * @author Suresh Reddy
 * @usage CurrentScheduleCommand in TinyUserCollection server version
 *  @version 1.0
 */
class CurrentScheduleCommand extends CConsoleCommand {

    public function run($args) {
        $this->removeCurrentScheduleByEndDate();
        $this->updateCurrentSchedule();
    }
    function removeCurrentScheduleByEndDate() {
        try {
        $mongoModifier = new EMongoModifier;
        $mongoCriteria = new EMongoCriteria;      
        $mongoCriteria->addCond('EndDate', '<=',  new MongoDate(strtotime(Date("Y-m-d", time()))-1));
        $mongoCriteria->addCond('IsCurrentSchedule','==',(int)1);
        $isGameExists = ScheduleGameCollection::model()->find($mongoCriteria);        
        if(is_object($isGameExists)){                
            $mongoCriteria = new EMongoCriteria;
            $mongoCriteria->addCond('_id','==',$isGameExists->GameId);
            $mongoModifier->addModifier('IsCurrentSchedule', 'set', (int)0);
            GameCollection::model()->updateAll($mongoModifier, $mongoCriteria);
            
            
            $mongoCriteria = new EMongoCriteria;
            
            $mongoCriteria->addCond('_id','==',$isGameExists->_id);
            $mongoModifier->addModifier('IsCurrentSchedule', 'set', (int)0);
            ScheduleGameCollection::model()->updateAll($mongoModifier, $mongoCriteria);

        }
        } catch (Exception $exc) {
            error_log("------------" . $exc->getMessage());
        }
    }

    function updateCurrentSchedule() {
        try {
        $mongoCriteria = new EMongoCriteria;
        $modifier = new EMongoModifier;
        $criteria = new EMongoCriteria;
        
         $mongoCriteria->addCond('StartDate', '>=',  new MongoDate(strtotime(Date("Y-m-d", time()) . " -1 day")));
         $mongoCriteria->addCond('StartDate', '<',  new MongoDate(strtotime(date("Y-m-d", time()))));
          $modifier->addModifier('IsCurrentSchedule', 'set', (int)0);

        $isGameExists = ScheduleGameCollection::model()->find($mongoCriteria);
        if (is_object($isGameExists) || is_array($isGameExists)) {
           
        


            $modifier->addModifier('IsCurrentSchedule', 'set', 0);
            ScheduleGameCollection::model()->updateAll($modifier, $criteria);

            $criteria->addCond('_id', '==', $isGameExists->_id);
            $modifier->addModifier('IsCurrentSchedule', 'set', 1);
            ScheduleGameCollection::model()->updateAll($modifier, $criteria);


            $modifier1 = new EMongoModifier;
            $criteria1 = new EMongoCriteria;

            $modifier1->addModifier('IsCurrentSchedule', 'set', 0);
            GameCollection::model()->updateAll($modifier1, $criteria1);
            
            $criteria1->addCond('_id', '==', $isGameExists->GameId);
            $modifier1->addModifier('IsCurrentSchedule', 'set', 1);
            GameCollection::model()->updateAll($modifier1, $criteria1);

            $categoryId = CommonUtility::getIndexBySystemCategoryType('Game');
            $gameDetails = GameCollection::model()->getGameDetailsByType('Id', $isGameExists->GameId);


              
            $stream = ServiceFactory::getSkiptaGameServiceInstance()->checkStreamExistsForGame($isGameExists->GameId, $isGameExists->StartDate, $isGameExists->EndDate);
          $newScheduleGame=$isGameExists;
       if ($stream == 'streamPartialUpdate') {          
                $userStreamBean = new UserStreamBean();
                $userStreamBean->ActionType='GameSchedule';
                $userStreamBean->StartDate=$newScheduleGame->StartDate;
                $userStreamBean->EndDate=$newScheduleGame->EndDate;
                $userStreamBean->PostId=$newScheduleGame->GameId;
                $userStreamBean->RecentActivity=$stream;                
                $userStreamBean->CurrentGameScheduleId=(string)$newScheduleGame->_id;
                $userStreamBean->IsNotifiable = 1;
                $userStreamBean->CreatedOn = time();
                Yii::app()->amqp->stream(json_encode($userStreamBean));
                
            } else if ($stream == 'streamTotalUpdate') {
                $pastSchedule = ScheduleGameCollection::model()->getPreviousOrFutureGameSchedule($newScheduleGame->GameId, $newScheduleGame->StartDate, $newScheduleGame->EndDate, "past");
                $userStreamBean = new UserStreamBean();
                if($pastSchedule!="failure"){
                $userStreamBean->PreviousGameScheduleId = $pastSchedule->_id;
                $userStreamBean->PreviousSchedulePlayers = $pastSchedule->Players;
                $userStreamBean->PreviousScheduleResumePlayers = $pastSchedule->ResumePlayers;
                }
                $userStreamBean->CurrentGameScheduleId = (string)$newScheduleGame->_id;
                $userStreamBean->CurrentScheduledPlayers = array();
                $userStreamBean->CurrentScheduleResumePlayers = array();
                $userStreamBean->IsNotifiable = 1;
                $userStreamBean->ActionType='GameSchedule';
                $userStreamBean->PostId=$newScheduleGame->GameId;                
                $userStreamBean->RecentActivity=$stream;
                $userStreamBean->CreatedOn = time();
                Yii::app()->amqp->stream(json_encode($userStreamBean));
                $returnValue='success';
            }
                
                
        } else {
            echo "not exist";
            $returnValue = 'false';
        }
        return '';
        } catch (Exception $exc) {
            echo $exc->getMessage();    
        }

       
    }

}
