<?php

class saveNewUsersCommand extends CConsoleCommand {

    public function run($args) {
        $this->saveNewUser();
    }
    
    
 public function saveNewUser(){
     try {
         echo '----111-----------';
      Yii::import('ext.phpexcel.XPHPExcel');      
       $phpExcel = XPHPExcel::createPHPExcel();
       $objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/ValueDrug.xls");       
       $objWorksheet = $objPHPExcel->getAllSheets();
       $customfields = array();
       for($sheet=0;$sheet<(1);$sheet++)
       {      
         $highestRow = $objWorksheet[$sheet]->getHighestRow(); // e.g. 10         
         for ($row = 1; $row <=$highestRow; ++$row) {                 
            $firstName =$objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue();
            if(isset($firstName) && !empty($firstName)){               
            $UserRegistrationForm = new UserRegistrationForm;
            $UserRegistrationForm->firstName=$objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue();
            $UserRegistrationForm->lastName=$objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue();
            $UserRegistrationForm->email=$objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue();
            $companyName=Yii::app()->params['NetworkName'];
            $UserRegistrationForm->companyName='ValueDrug';
            $UserRegistrationForm->pass=$objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue();
            $UserRegistrationForm->status=1;
            $UserRegistrationForm->country=1;
            $UserRegistrationForm->state="Pennsylvania";
            $UserRegistrationForm->city="Lancaster";            
            $UserRegistrationForm->zip=18916;
            $UserRegistrationForm->segmentId=0;
            
            ServiceFactory::getSkiptaUserServiceInstance()->SaveUserCollection($UserRegistrationForm, $customfields);
            }  
            
         }
       }
  
     } catch (Exception $exc) {
        echo $exc->getLine().'_________Exception___________'.$exc->getMessage();
     }
  }
  
  
}
