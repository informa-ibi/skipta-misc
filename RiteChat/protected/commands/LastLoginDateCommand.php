<?php

Yii::import('application.service.*'); 
Yii::import('application.models.*'); 
Yii::import('application.components.*');

class LastLoginDateCommand extends CConsoleCommand {

	public function run(){
    
    $LastloginData = Yii::app()->db->createCommand("SELECT * from User WHERE date(LastLoginDate) <='2019-07-08' AND LastLoginDate is not null and LastLoginDate <> '' ")->queryAll();
    
    
    if(!empty($LastloginData)){
      $i = 0;
      foreach($LastloginData as $data){
        $data = (object)$data;
        $lastLoginDate = $data->LastLoginDate;
        $userId = $data->UserId;
        
        $LoginDataObj = new UserLoginDetailsCollection();
        $LoginDataObj->CreatedDate=$lastLoginDate;
        $LoginDataObj->Pagevisits=1;
        $LoginDataObj->UserId = $userId;
        $LoginDataObj->LastLoginDate=$lastLoginDate;
        $LoginDataObj->CreatedDate=$lastLoginDate;
        $LoginDataObj->Pagevisits=1;
        $LoginDataObj->CreatedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));


        if ($LoginDataObj->insert()) {
            $i++;
            echo "$i\n";
        }
        
        
      }
      
    }
    
  }
}

?>