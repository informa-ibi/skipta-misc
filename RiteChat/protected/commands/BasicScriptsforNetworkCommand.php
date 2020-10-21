    <?php

/**
 * @author karteek.v
 * @class Ncom(NodeCommuncation)
 */
class BasicScriptsforNetworkCommand extends CConsoleCommand {
    
    
     public function run($args) {
        $this->actionSetNetworkConfiguration();
    }
    
    /**
     * @author suresh reddy.V
     * @param type basic network configurations at network instlation time
     * @param type $limit
     * @return type JSON 
     */
    public function actionSetNetworkConfiguration(){
         try{
            $configObj = ServiceFactory::getSkiptaUserServiceInstance()->getConfigurationObject();
            $i = 0;
            foreach($configObj as $rw){
                Yii::app()->config->setValue('"'.$rw->Key.'"', "'".($rw->Value)."',",TRUE); // writing the database data into file.
                $i++;
            }
            if(sizeof($configObj) == $i){
                $status = "Network setting dumped to network configuration file";
            }
            $obj = array("status"=>$status);
            echo CJSON::encode($obj);
        } catch (Exception $ex) {
            error_log("#################==Exception occurred= actionSetUpConfig=###########".$ex->getMessage());
        }
    }
   
}
