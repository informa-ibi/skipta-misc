    <?php

/**
 * @author Sagar Pathapelli
 * @class 
 */
class NetworkAdminCommand extends CConsoleCommand {
    
    /**
     * @author Sagar
     * @return 
     */
    public function actionIndex($stream,$date){
        try{
            
        } catch (Exception $ex) {
           error_log($ex->getMessage());
        }
    }
    
    public function actionAutoFollowAdmin() {
        try {echo "====***";
            $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType( YII::app()->params['NetworkAdminEmail'], 'Email');
            $userId = (int)($netwokAdminObj->UserId);
            $users = ServiceFactory::getSkiptaUserServiceInstance()->getAllUserExceptNetworkAdminService($userId);  
            $i=0;
            if (!is_string($users)) {
                foreach ($users as $user) {
                    $result = ServiceFactory::getSkiptaUserServiceInstance()->followAUser($user->UserId, $userId);
                    $i++;
                }
            }
            echo $i." users followed";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
