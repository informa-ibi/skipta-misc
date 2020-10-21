<?php
/**
 * HdsUserAnalyticsDataCommand class file.
 *
 * @author Haribabu
 * @usage Hds user analytics data and generate a csv file and send to Admin email address
 *  @version 1.0
 */
class HdsUserAnalyticsDataCommand extends CConsoleCommand {

    public function run($args) {
        $email="";
        $subject="";
        if(isset($args[0])){
            $email=$args[0];
        }
        $files=array();
        $inviedUsers=$this->GetInvitedUsersData();
        $Registeredusers=$this->GetRegisteredUsersData();
        $SetUpUsers=$this->GetSetupUserdata();
        
        $files[$inviedUsers]= Yii::app()->params['WebrootPath']. 'HdsUsers';
        $files[$Registeredusers]=  Yii::app()->params['WebrootPath']. 'HdsUsers';
        $files[$SetUpUsers]=  Yii::app()->params['WebrootPath']. 'HdsUsers';
        $subject=Yii::app()->params['NetworkName']. " Hds Users Analytics Report";
        $this->SendEmail($files,$email,$subject);
    }

    public function GetInvitedUsersData($email="") {
        try {
            $InvitedUsersData = ServiceFactory::getSkiptaUserServiceInstance()->getHdsUsersDataByUsingStatus('Invited');
            //generate csv file
            $filePath=$this->GenarateCSVFile($InvitedUsersData,'Registered Users');
             $subject="Invited Users";
            //send email to admin with attachment of users csv file
              $newfile=array();
            if($email!="" && $filePath!='failure'){
                 $newfile[$filePath]= Yii::app()->params['WebrootPath']. 'HdsUsers';
                 $this->SendEmail($newfile,$email,$subject);
            }else{
                return $filePath;
            }
        } catch (Exception $e) {
             Yii::log("=====Exception in GetInvitedUsersData ---in commands========" . $ex->getMessage(), "error", "application");
        }
    }

    public function GetRegisteredUsersData($email="") {
        try{
             $RegisteredUsersData = ServiceFactory::getSkiptaUserServiceInstance()->getHdsUsersDataByUsingStatus('Registered');
             //generate csv file
             $filePath=$this->GenarateCSVFile($RegisteredUsersData,'Registered Users');
              $subject="Registered Users";
             //send email to admin with attachment of users csv file
               $newfile=array();
             if($email!="" && $filePath!='failure'){
                     $newfile[$filePath]= Yii::app()->params['WebrootPath']. 'HdsUsers';
                  $this->SendEmail($newfile,$email,$subject);
              }else{
                  return $filePath; 
              }
              
        } catch (Exception $ex) {
             Yii::log("=====Exception in GetRegisteredUsersData ---in commands========" . $ex->getMessage(), "error", "application");
        }
       
    }

    public function GetSetupUserdata($email="") {
        try{
            $SetupUsersData = ServiceFactory::getSkiptaUserServiceInstance()->getHdsUsersDataByUsingStatus('Setup'); 
             //generate csv file
             $filePath=$this->GenarateCSVFile($SetupUsersData,'Setup Users');
             $subject="Setup Users";
             //send email to admin with attachment of users csv file
              $newfile=array();
             if($email!="" && $filePath!='failure'){
                     $newfile[$filePath]= Yii::app()->params['WebrootPath']. 'HdsUsers';
                  $this->SendEmail($newfile,$email,$subject);
              }else{
                  return $filePath;
              }
               
        } catch (Exception $ex) {
             Yii::log("=====Exception in GetSetupUserdata ---in commands========" . $ex->getMessage(), "error", "application");
        }
       
    }
    public function SendEmail($files,$email,$subject){
        try{
             $to = $email;
               // $subject = "InvitedUsers";
                $employerName = "Skipta Admin";
                //$employerEmail = "info@skipta.com"; 
                $messageview="";
                $params = "";
                $sendMailToUser=new CommonUtility;
                $mailSentStatus=$sendMailToUser->actionSendmailForHdsUsersAnalytics($messageview,$params, $subject, $to,$files);
        } catch (Exception $ex) {
             Yii::log("=====Exception in SendEmail  GetSetupUserdata ---in commands========" . $ex->getMessage(), "error", "application");
        }
       
        
        
        
    }
    public function GenarateCSVFile($UserData,$type){
        try{
           
            $returnvalue = "failure";
            $data = array();
            $folder = Yii::app()->params['WebrootPath'] . 'HdsUsers/'; // folder for uploaded files
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            // $filename = tempnam(sys_get_temp_dir(), "csv");
            $filename = tempnam($folder, $type);
            $file = fopen($filename, "w");
	      fputcsv($file, array("",$type.' List',"","") );
              fputcsv($file, array('S.No','FirstName','LastName','Email') );
              
            if ($UserData != "failure") {
                foreach ($UserData as $key => $value) {
                    fputcsv($file, $value);
                }
            } else {
                $data[0] = "No Data Found.";
                fputcsv($file, array("","No Data Found.","","") );
                fputcsv($file, $data);
                fwrite($file, "\r\n");
            }
            fclose($file);
//
            $date = strtotime("now");
           
            
            $filenameArray=  explode('/', $filename);
               $fname=end($filenameArray);
            $filedaiplayName = $fname."_".$date.".csv";
                $newFile =Yii::app()->params['WebrootPath']. 'HdsUsers/'.$filedaiplayName;
           if(rename($filename, $newFile)){
               $returnvalue=$filedaiplayName;
           }
            
            return $returnvalue;
        } catch (Exception $ex) {
              Yii::log("=====Exception in GenarateCSVFile  GetSetupUserdata ---in commands========" . $ex->getMessage(), "error", "application");
        }
         
            //fclose($file);
    }
    public function GetInvitedUsersDataDatewise($email, $status, $startDate, $endDate) {
        
    }

}
