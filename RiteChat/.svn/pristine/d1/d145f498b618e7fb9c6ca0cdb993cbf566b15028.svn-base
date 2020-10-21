<?php

class saveAdvertisementsCommand extends CConsoleCommand {

    public function run($args) {
        $this->saveAdvertisements();
    }
    
    
 public function saveAdvertisements(){
     try {
         echo '----111-----------';
      Yii::import('ext.phpexcel.XPHPExcel');      
       $phpExcel = XPHPExcel::createPHPExcel();
       $objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/DoctorUnite.xls");       
       $objWorksheet = $objPHPExcel->getAllSheets();
       for($sheet=0;$sheet<(1);$sheet++)
       {      
         $highestRow = $objWorksheet[$sheet]->getHighestRow(); // e.g. 10         
         for ($row = 1; $row <=$highestRow; ++$row) {      
             $advertisementForm=new Advertisements();
             
             $advertisementForm->Name=$name= $objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue();
             $advertisementForm->Type =$type= $objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue();
             $advertisementForm->Url =$url= $objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue();
             $advertisementForm->RedirectUrl=$redirectUrl =$objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue();
             $advertisementForm->DisplayPage =$displayPage= $objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue();
             $advertisementForm->DisplayPosition= $displayPosition= $objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue();
             $advertisementForm->Status =$status= 1;
             $advertisementForm->TimeInterval =$timeInterval= $objWorksheet[$sheet]->getCellByColumnAndRow(9, $row)->getValue();
             $advertisementForm->ExpiryDate =$expiryDate= date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));
             $networkAdminEmail=Yii::app()->params['NetworkAdminEmail'];
             $userDetails=User::model()->checkUserExist($networkAdminEmail);
             if(isset($userDetails)){
              $advertisementForm->CreatedUserId = $createdUserId= $userDetails->UserId;   
             }else{
              $advertisementForm->CreatedUserId= 0;      
             }
             $groupName = $objWorksheet[$sheet]->getCellByColumnAndRow(12, $row)->getValue();             
             if($advertisementForm->DisplayPage=="Group"){
                $groupDetails= GroupCollection::model()->getGroupIdByName($groupName);
                $advertisementForm->GroupId=$groupId=$groupDetails->GroupId;
             } else{
                 $advertisementForm->GroupId=$groupId=0;
             }            
             $advertisementForm->CreatedOn= date('Y-m-d H:i:s', time()); 
             $advertisementForm->SourceType='Upload';             
             $advertisementForm->save();             
            
         }
       }
  
     } catch (Exception $exc) {
        echo $exc->getLine().'_________Exception___________'.$exc->getMessage();
     }
  }
  
  
}
