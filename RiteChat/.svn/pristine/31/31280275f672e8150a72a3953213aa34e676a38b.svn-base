<?php


/**
 * Developer Name: Suresh Reddy
 * DataMigration class is enable rest calls enable 
 * all RestAPI Call here to migrate data 
 */

class DatamigrationController extends ERestController
{

    
    /**
     * Developer Suresh Reddy & Sagar
     * on 8 th Jan 2014
     * save user Registration 
     * parameter is object of user
     */

    public function actionUser($args=null)
    {
        $message="";
      try {
          
         Yii::log("******************",'error','application');
    
            $userRegistrationInfo =  CJSON::decode($_REQUEST['data'],true);
            Yii::log("------@@@@@@@@@@@@-------userRegistrationInfo-------@@@@@@@@@@@------".$_REQUEST['data'], 'error', 'application');
           //$userRegistrationInfo = $jsonData['userRegistrationInfo'];
            $existingUsers=array();
            $insertedUsersCount=0;
            $existingUsersCount=0;
            $totalUsers=  sizeof($userRegistrationInfo);
            if($totalUsers>0){
                $i=0;
                foreach($userRegistrationInfo as $usrInfo){
                Yii::log($i++.$usrInfo['email']."------@@@@@@@@@@@@-------userRegistrationInfo-------@@@@@@@@@@@------", 'error', 'application');    
                    
                    if(isset($usrInfo['email'])){
                        $userexist = ServiceFactory::getSkiptaUserServiceInstance()->checkUserExist($usrInfo['email']);
                        if (count($userexist) > 0) {
                            $message ="Users already exist with the given Email Please  try with another  Email Address";
                            $existingUsersCount++;
                            array_push($existingUsers, $usrInfo['email']);
                        } else {

                            $uerRegistrationArray = array();
                            $UserRegistrationForm = new UserRegistrationForm();
                            foreach ($UserRegistrationForm->attributes as $key => $value) {
                              
                                if(isset($usrInfo[$key])){
                                    $uerRegistrationArray[$key] = $usrInfo[$key];
                                } 
                            }
                            $uerRegistrationArray["registredDate"] = $usrInfo["registredDate"];
                            $uerRegistrationArray["lastLoginDate"] = $usrInfo["lastLoginDate"];
                            $customfieldsArray = array();
                            $CustomForm = new CustomForm();
                            foreach ($CustomForm->attributes as $key => $value) {
                                if(isset($usrInfo[$key])){
                                    $customfieldsArray[$key] = $usrInfo[$key];
                                } 
                            }
                            $Save_userInUserCollection=ServiceFactory::getSkiptaUserServiceInstance()->SaveUserCollection($uerRegistrationArray, $customfieldsArray);
                            if($Save_userInUserCollection!='error'){
                                 $message ="User Registered Successfully";
                                 $insertedUsersCount++;
                            }else{
                                $message="User registration failed";
                            }
                        }
                    }else{
                        $message="User email not found";
                    }
                } 
            }else{
                $message="Please send atleast one user information";
            }
            if($insertedUsersCount>0){
                $message="Inserted ".$insertedUsersCount." user(s). existing users count  ".$existingUsersCount;
            }
             echo $message;
        } catch (Exception $exc) {
          Yii::log("==in exception====".$exc->getMessage(), 'error', 'application');
        }
        //Yii::log("==in exception====".$message, 'error', 'application');
       
    }
    
   public function actionUserdetails() {
        try {               
            // Initializing variables with default values...
            $result = array();
            $filterValue = 'a';
            $searchText = 'a';
            $startLimit = 1;
            $pageLength = 10;
            $data = ServiceFactory::getSkiptaPostServiceInstance()->getUserProfile($filterValue,$searchText,$startLimit, $pageLength);
            $totalUsers["totalCount"] = ServiceFactory::getSkiptaPostServiceInstance()->getUserProfileCount($filterValue,$searchText);
            // preparing the resultant array for rendering purpose...
            $result = array("data" => $data, "total" => $totalUsers, "status" => 'success');
            echo CJSON::encode($data);
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserManagementDetails==".$ex->getMessage(),"error","application");
        }
    }
    
      /**
     * Developer Suresh Reddy 
     * on 21 th Jan 2014
     * method helpful for  user to user folllowing 
     * parameter is a  object of userEmail , Followers Email's of User
     */
      public function actionUserFollowing() {
        try {
            $message = "";

          //  YII::log($_REQUEST['data'] . "**********000000000000**********", 'error', 'application');

            $userFollowers = CJSON::decode($_REQUEST['data'], true);
            $email = $userFollowers['UserEmail'];


            $UserObj = ServiceFactory::getSkiptaPostServiceInstance()->getUserIdByEmail($email);


            if (isset($UserObj->Email)) {



                $UserIdofUser = $UserObj->UserId;
                $followersEmail = $userFollowers['FollowingEmails'];
                // $folloingEmail = $userFollowers->FollowingsEmails;

               // Yii::log(sizeof($followersEmail) . "gsr===@@@@@@@@@@@@@@@========3========", "error", "application");

                for ($i = 0; $i < sizeof($followersEmail); $i++) {


                   // $followerObj = $this->skiptaUserService->getUserIdByEmail($followersEmail[$i]);

                    $followerObj = ServiceFactory::getSkiptaPostServiceInstance()->getUserIdByEmail($followersEmail[$i]);


                    if (isset($followerObj->UserId)) {

                        $followerId = $followerObj->UserId;
                        ServiceFactory::getSkiptaPostServiceInstance()->followAUser($UserIdofUser, $followerId);
                    }
                    $message = "followers saved successfully";
                }
            } else {
                $message = "User does't exist";
            }

            echo $message;
        } catch (Exception $e) {
            Yii::log("Exception Occurred in actionGetUserManagementDetails==" . $e->getMessage(), "error", "application");
        }
    }

    
    
      /**
     * Developer Praneeth
     * on 28 th Jan 2014
     * method helpful for  user to user folllowing 
     * parameter is a  object of userEmail , hashtags of User
     */
    public function actionUserHashtags()
    {
        try {
            $userHashtags = CJSON::decode($_REQUEST['data'], true);
            $email = $userHashtags['UserEmail'];
            
            $UserObj = $this->skiptaUserService->getUserIdByEmail($email);
            
             if(isset($UserObj->Email)){
                 
                 $UserIdofUser = $UserObj->UserId;
                 $hashtagsByUser = $userHashtags['UserHashtags'];
                 if(sizeof($hashtagsByUser)>0)
                 {
                     for ($i = 0; $i < sizeof($hashtagsByUser); $i++) {
                     $userHashtagObj = $this->skiptaPostService->HashTagSave($hashtagsByUser[$i],$UserIdofUser );
                     if ($userHashtagObj == "success")
                     {
                          $message = "hashtags saved successfully";
                     }
                     else {
                         $message = "hashtags already saved";
                     }
                 }
                 }
                 else
                 {
                     $message = "hashtags doesnt exist";
                 }
             }
           echo $message; 
        } catch (Exception $ex) {
            Yii::log("-------------------Exception Occurred in actionUserHashtags==" . $e->getMessage(), "error", "application");
        }
      
    }
    
    public function actionUserPostSaving()
    {
        try {
                $userPosts = CJSON::decode($_REQUEST['data'], true);
                $email = $userPosts['UserEmail'];
                $hashtagsInPostsByUser = $userPosts['HashTags'];
                $postType = $userPosts['Type'];
                //Yii::log("==========post type====".$postType, "error", "application");
                $userComments = $userPosts['Comments'];
                $postFollowedUsers = $userPosts['Followers'];
                //error_log("userpostssssssssssssssss".print_r($userPosts,true));
               // Yii::log("==========resource===iiiiiiiiii3333333333333iiiiiiiiiiiiii=".$userPosts['Resource'], "error", "application");
                if(is_array($userPosts['Resource']) && count($userPosts['Resource'])>0){
                    $postObj = $userPosts['Resource'][0];
                }else{
                    $postObj = $userPosts['Resource'];
                }
//                Yii::log("==========resource====".sizeof($userPosts['Resource']), "error", "application");
                $UserObj = $this->skiptaUserService->getUserIdByEmail($email);
  //              error_log("after save postttttttt77777777777777777777777+1111111111111");
                if (isset($UserObj->Email)) {
                    $UserIdofUser = $UserObj->UserId;
                    $userPostModel = new NormalPostForm();
                    $userPostModel->Type = $postType;
                    $userPostModel->UserId = $UserIdofUser;
                    $userPostModel->CreatedOn = $userPosts['CreatedOn'];
                    $userPostModel->Description = $userPosts['Description'];
                    if(is_array($userPosts['Resource']) && count($userPosts['Resource'])>0){
                       $userPostModel->Artifacts = array($postObj['Uri']); 
                    }
                    else{
                        $userPostModel->Artifacts = array();
                    }
                    $hashTagArray = array_unique($hashtagsInPostsByUser);
                    $postId = $this->skiptaPostService->savePost($userPostModel, $hashTagArray);
                   
                    // Yii::log("--gsr---------after success-------------------------", "error", "application");
                    if ($postId != '') {
                        $message = "Post saved successfully";
                        if (sizeof($userPosts['Love']) > 0) {
                            foreach ($userPosts['Love'] as $lovedUser) {
                                $lovedUsersObj = $this->skiptaUserService->getUserIdByEmail($lovedUser);
                                if (isset($lovedUsersObj->UserId)) {
                                    $lovedId = $lovedUsersObj->UserId;
                                    $this->skiptaPostService->saveLoveToPost($postType, $postId, $lovedId);
                                }
                                 $message = "loved Ids saved success";
                            }
                           
                        }
                       //  Yii::log("222222222222222g--------" , "error", "application");
                        if (sizeof($postFollowedUsers) > 0) {
                            for ($i = 0; $i < sizeof($postFollowedUsers); $i++) {
                                $postFollowedUsersObj = $this->skiptaUserService->getUserIdByEmail($postFollowedUsers[$i]);
                                if (isset($postFollowedUsersObj->UserId)) {

                                    $postFollowingId = $postFollowedUsersObj->UserId;
                                    $this->skiptaPostService->saveFollowOrUnfollowToPost($postType, $postId, $postFollowingId, 'Follow');
                                }
                                $message = "followers Ids saved success";
                            }
                            
                        }
 //Yii::log("Exception Occurred in actionUserPostSaving--------".sizeof($userComments) , "error", "application");
                        if (sizeof($userComments) > 0) {
                            foreach ($userComments as $userComment) {
                                
                               // Yii::log($userComment['CommentText']."1111111Exception Occurred in actionUserPostSaving--------" , "error", "application");
                                $commentedUser = $userComment['UserEmail'];
                                $commentedUserObj = $this->skiptaUserService->getUserIdByEmail($commentedUser);
                                $commentedUserId = $commentedUserObj->UserId;
                                if (isset($commentedUserObj->UserId)) {
                                    $commentedText = $userComment['CommentText'];
                                    $createdOn = $userComment['CreatedOn'];
                                      // Yii::log($userComment['CommentText']."1111111Exception Occurred in actionUserPostSaving--------" , "error", "application");
                                    $commentbean = new CommentBean();
                                    $commentbean->PostId = $postId;
                                    $commentbean->CreatedOn = $createdOn;
                                    $commentbean->UserId = $commentedUserId;
                                    $commentbean->CommentText = $commentedText;
                                    if($postType="Normal Post"){
                                    $Type=1;}
                                    $commentbean->PostType = $Type;
                                    $commentbean->Artifacts = array();
                                    $postObj = $this->skiptaPostService->saveComment($commentbean);
                                    $commentbean="";
                                }
                                $message = "Comment  saved successfully";
                            }
                        }
                         $message = "Post saved successfully";
                    } else {
                        $message = "Failed to save the post";
                    }
                }
                
                
               // Yii::log("Exception Occurred in actionUserPostSaving--------" , "error", "application");
                echo $message;
        } catch (Exception $ex) {
            Yii::log("Exception Occurred in actionUserPostSaving--------" . $ex->getMessage(), "error", "application");
        }
    }
    
    /**
     * @author:Praneeth
     * @param  $userCategories 
     * Description: Used to save the categories in MySql and MongoDB databases
     * Purpose: for data migration
     */
     public function actionSaveCurbsidePost() {
        try {
            $userCategories = CJSON::decode($_REQUEST['data'], true);
            $categoryModel = new CurbsidecategorycreationForm();
            foreach ($userCategories as $category) {
//                 error_log((print_r($category,true)));
                //error_log("category count++++++++++++++++++++".count($category));
                foreach ($category as $key => $value) {
                    //  error_log($key."6666666666666666666666.$value");
                    $categoryModel->category = $value;
                    $userObj = $this->skiptaUserService->adminCategoryCreationService($categoryModel);
                    $message = "category saved successfully";
                }
            }
            echo $message;
        } catch (Exception $ex) {
            Yii::log("-----exception in actionCurbsideCategorySaving--------" . $ex->getMessage(), "error", "application");
        }
    }
    
    public function actionCreateStore()
    {
Yii::import('ext.phpexcel.XPHPExcel');      
$phpExcel = XPHPExcel::createPHPExcel();
$objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/protected/StoreListPrecise.xls");
$objWorksheet = $objPHPExcel->getActiveSheet();
$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
$values='';
for ($row = 2; $row <= $highestRow; ++$row) {
$values.="(";
for ($col = 0; $col <= 9; ++$col) {
      $values .="'".trim(addslashes($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));
      if($col!=9)
      $values .="',";
      else
      $values .="'";

  }
   if($row!=$highestRow)
   {
     $values.="),";
   }
     else
     {
     $values.=");";
     }
      

}
$sql = 'INSERT INTO Store (Id,DescriptiveName,Address1,Address2,City,State,PostalCode,Division,Region,District) VALUES ' . $values;
$command = Yii::app()->db->createCommand($sql);
$command->execute();

    }
     public function actionCreateUser()
    {
Yii::import('ext.phpexcel.XPHPExcel');      
$phpExcel = XPHPExcel::createPHPExcel();
$objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/protected/Sheet2.xls");
$objWorksheet = $objPHPExcel->getAllSheets();

$userCollectionModel=new UserCollection();
$userProfileCollection = new UserProfileCollection();

// Process complete sheets
for($sheet=0;$sheet<(1);$sheet++)
{
$highestRow = $objWorksheet[$sheet]->getHighestRow(); // e.g. 10

//Process Sheets Data and Persist
for ($row = 2; $row <=$highestRow; ++$row) {
    
$values=$values2='';
$values="INSERT IGNORE INTO User (UserId,FirstName,LastName,Password,Email,NetworkId,Status,RegistredDate,UserTypeId) VALUES  ";
$values2="INSERT IGNORE INTO UserHierarchy (UserId,Division,Region,District,Store,Type) VALUES  ";

  
     $values .="('".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue()))."',";
     
     $name = explode(',',$objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue());
     $values .="'".trim(addslashes($name[0]))."',";
     $values .="'".trim(addslashes($name[1]))."',";
     $values .="'d66ad5b60bcdc4f89efc9c06059ea83e',";
     $values .="'".trim(addslashes(strtolower($name[0]."_".$name[1])))."@riteaid.com',";
     $values .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue()))."',";
     $values .="1,";
     $values .="'".date('Y-m-d')."',";
     $values .="3);";
     
     
    
     $query = "SELECT Division,Region,District,Store,Type FROM `UserHierarchy`  where Store=".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue()))." limit 1";
     $command = Yii::app()->db->createCommand($query);
     $data = $command->queryRow();
     error_log($data['Division']);
     
     if($data['Division']!='')
     {
     
     if($data['Division']!='0000' && $data['Region']!='0000' && $data['District']!='0000' && $data['Store']!='0000')
     {
         $type='Store Employee';
     }
     if($data['Division']!='0000' && $data['Region']!='0000' && $data['District']!='0000' && $data['Store']=='0000')    
     {
         $type='District Leader';
     }
     if($data['Division']!='0000' && $data['Region']!='0000' && $data['District']=='0000' && $data['Store']=='0000')    
     {
         $type='Regional Leader';
     }
     if($data['Division']!='0000' && $data['Region']=='0000' && $data['District']=='0000' && $data['Store']=='0000')    
     {
         $type='Divisional Leader';
     }
     if($data['Division']=='0000' && $data['Region']=='0000' && $data['District']=='0000' && $data['Store']=='0000')    
     {
         $type='Corporate';
     }
     }
     else{
         if(strtolower($name[0])=='eric' || strtolower($name[0])=='kristin')
         {
         $data['Division']='5' ;
         $data['Region']='5001' ;
         $data['District']='50104' ;
         $data['Store']='0000';
         $type='District Leader';
         }
         else{
         $data['Division']='3' ;
         $data['Region']='30032' ;
         $data['District']='33216' ;
         $data['Store']='0000';
         $type='District Leader';
         }
         
     }
     

     
     $values2 .="('".$objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue()."',";
     $values2 .="'".$data['Division']."',";
     $values2 .="'".$data['Region']."',";
     $values2 .="'".$data['District']."',";
     $values2 .="'".$data['Store']."',";
     $values2 .="'".trim(addslashes($type))."');";
     
 
     
      
$sql =$values;
$command = Yii::app()->db->createCommand($sql);
$command->execute();

$sql2 =$values2;
$command2 = Yii::app()->db->createCommand($sql2);
$command2->execute();
//     
     $userCollectionModel->UserId=$objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue();
     $userCollectionModel->NetworkId=(int)$objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue();
     $userCollectionModel->ProfilePicture='/images/icons/user_noimage.png';
     $userCollectionModel->AboutMe='About Me';
  

UserCollection::model()->saveUserCollection($userCollectionModel);  
UserProfileCollection::model()->saveUserProfileCollection('',$userCollectionModel->UserId);
    
 $userCollectionModel->DisplayName=trim($name[0])." ".trim($name[1]);

}

}

    }
    
      public function actionCreateUserTwo()
    {
         ini_set("memory_limit",-1); 
          try{          
Yii::import('ext.phpexcel.XPHPExcel');      
$phpExcel = XPHPExcel::createPHPExcel();
$objPHPExcel = PHPExcel_IOFactory::load("/usr/share/nginx/RiteAid/NewUserList.xls");
$objWorksheet = $objPHPExcel->getAllSheets();
$userCollectionModel=new UserCollection();
$userProfileCollection = new UserProfileCollection();
error_log("===========11111111====================================");
// Process complete sheets
for($sheet=0;$sheet<(1);$sheet++)
{
$highestRow = $objWorksheet[$sheet]->getHighestRow(); // e.g. 10
error_log("==========22222222222222222================================");

//Process Sheets Data and Persist
for ($row = 2; $row <=$highestRow; ++$row) {
$values=$values2='';
error_log("==========333333333333333333333=============================");
$query = "SELECT * from User where UserId=".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue()));
     $command = Yii::app()->db->createCommand($query);
     $data = $command->queryRow();

if(isset($data['UserId'])){
  error_log("==========44444444444444444444===========================");
    $updateQuery="update User set  IsDuplicate=1,Email='".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(7, $row)->getValue()))."' where UserId=".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue()));     
    YII::app()->db->createCommand($updateQuery)->execute();
}else{
   $values="INSERT INTO User (UserId,FirstName,LastName,Password,Email,NetworkId,Status,RegistredDate,UserTypeId,IsDuplicate) VALUES  ";
$values2="INSERT INTO UserHierarchy (UserId,Division,Region,District,Store,Type) VALUES  ";

error_log("=========5555555555555555555======================");
    
     $values .="('".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue()))."',";
     $values .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue()))."',";
     $values .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue()))."',";
     $values .="'d66ad5b60bcdc4f89efc9c06059ea83e',";     
     $values .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(7, $row)->getValue()))."',";
     $values .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()))."',";
     $values .="1,";
     $values .="'".date('Y-m-d')."',";
     $values .="3,";
     $values .="1);";
     
     
      if($objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()!='0000')
     {
         $type='Store Employee';
     }
     
     if($objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()=='0000')
     {
         $type='District Leader';
     }
     if($objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue()=='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()=='0000')
     {
         $type='Regional Leader';
     }
     if($objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue()!='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue()=='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue()=='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()=='0000')
     {
         $type='Divisional Leader';
     }
      if($objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue()=='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue()=='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue()=='0000' && $objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()=='0000')
     {
         $type='Corporate';
     }
     
     $values2 .="('".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue()))."',";
     $values2 .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(3, $row)->getValue()))."',";
     $values2 .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(4, $row)->getValue()))."',";
     $values2 .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(5, $row)->getValue()))."',";
     $values2 .="'".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue()))."',";
     $values2 .="'".trim(addslashes($type))."');";
     
    
 
    
      
$sql =$values;
$command = Yii::app()->db->createCommand($sql);
$command->execute();

$sql2 =$values2;
$command2 = Yii::app()->db->createCommand($sql2);
$command2->execute();


     
     $userCollectionModel->UserId=$objWorksheet[$sheet]->getCellByColumnAndRow(0, $row)->getValue();
     $userCollectionModel->NetworkId=(int)$objWorksheet[$sheet]->getCellByColumnAndRow(6, $row)->getValue();
     $userCollectionModel->ProfilePicture='/images/icons/user_noimage.png';
     $userCollectionModel->AboutMe='About Me';
     $userCollectionModel->DisplayName=trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue()))." ".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue()));
     //$userCollectionModel->uniqueHandle=trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(1, $row)->getValue()))." ".trim(addslashes($objWorksheet[$sheet]->getCellByColumnAndRow(2, $row)->getValue()));

UserCollection::model()->saveUserCollection($userCollectionModel);  
UserProfileCollection::model()->saveUserProfileCollection('',$userCollectionModel->UserId); 
}
     

}





}

}  catch (Exception $e){
    error_log("======8888888888888888888888888888======================".$e->getMessage());
}


    }
       
     public function actionFTPCreateUser()
    {
         $xml = simplexml_load_file("employee.xml");
         
$count =  count($xml);
$i=0;


 $status=1;
    foreach($xml->{'Employee'} as $value)
    {
 $user=new User();
 $userCollectionModel = new UserCollection();

 $values="INSERT IGNORE INTO User (UserId,FirstName,LastName,Password,Email,NetworkId,DisplayName,Status,RegistredDate,UserTypeId) VALUES  ";
 $values2="INSERT IGNORE INTO UserHierarchy (UserId,Division,Region,District,Store,Type) VALUES  ";
 $i++;

     if(trim($value->EmployeeNumber)=='' || preg_match("/^x|X/i", $value->EmployeeNumber) || trim($value->EmailAddress)=='')
     continue;
 
     if($value->EmailAddress!='')
      {
       $userPresent = $user->checkUserExist($value->EmailAddress);
       if(isset($userPresent->Email))
       {
       echo "<br>Email of the User".$userPresent->Email."<br><br>";
       continue;
       }
       else
       echo "<br><br>I am not Present".$value->EmailAddress."<br><br>";
      }

      if($value->EmailAddress=='')
      {
          $status=0;
      }
      
       
      if($value->Division!='0000' && $value->Region!='0000' && $value->District!='0000' && $value->Store!='0000')
     {
      $type='Store Employee';
      $userTypeId=3;
     }
     if($value->Division!='0000' && $value->Region!='0000' && $value->District!='0000' && $value->Store=='0000')    
     {
         $type='District Leader';
         $userTypeId=2;
     }
    if($$value->Division!='0000' && $value->Region!='0000' && $value->District=='0000' && $value->Store=='0000')    
     {
     $type='Regional Leader';
     $userTypeId=2;
     }
     if($value->Division!='0000' && $value->Region=='0000' && $value->District=='0000' && $value->Store=='0000')    
     {
         $type='Divisional Leader';
         $userTypeId=2;
     }
     if($value->Division=='0000' && $value->Region=='0000' && $value->District=='0000' && $value->Store=='0000')    
     {
         $type='Corporate';
         $userTypeId=1;
     }
     
     $values .="('".trim(addslashes($value->EmployeeNumber))."',";
     $values .="'".trim(addslashes($value->FirstName))."',";
     $values .="'".trim(addslashes($value->LastName))."',";
     $values .="'d66ad5b60bcdc4f89efc9c06059ea83e',";
     $values .="'".trim(addslashes($value->EmailAddress))."',";
     $values .="$value->Store,";
     $values .="'".trim(addslashes($value->FirstName))." ".trim(addslashes($value->LastName))."',";
     $values .="$status,";
     $values .="'".date('Y-m-d')."',";
     $values .="$userTypeId);";
     //$values .=$i==$count?";":",";
     
   
     
     $values2 .="('".$value->EmployeeNumber."',";
     $values2 .="'".$value->Division."',";
     $values2 .="'".$value->Region."',";
     $values2 .="'".$value->District."',";
     $values2 .="'".$value->Store."',";
     $values2 .="'".trim(addslashes($type))."');";
     //$values2 .=$i==$count?";":",";

     $sql =$values;
     $command = Yii::app()->db->createCommand($sql);
     $command->execute();
     $sql2 =$values2;
     $command2 = Yii::app()->db->createCommand($sql2);
     $command2->execute();
     
     $users = UserCollection::model()->getTinyUserCollection($value->EmployeeNumber);
     if(empty($users))
    {
    $userCollectionModel->UserId=$value->EmployeeNumber;
    $userCollectionModel->NetworkId=(int)$value['Store'];
    $userCollectionModel->ProfilePicture='user_noimage.png';
    $userCollectionModel->AboutMe='About Me';
    $userCollectionModel->DisplayName=trim(addslashes($value->FirstName))." ".trim(addslashes($value->LastName));
   UserCollection::model()->saveUserCollection($userCollectionModel);  
   UserProfileCollection::model()->saveUserProfileCollection('',$userCollectionModel->UserId);
   UserNotificationSettingsCollection::model()->saveUserSettings($value->EmployeeNumber,$userCollectionModel->NetworkId);
   $displayNameArray = explode(" ", $userCollectionModel->DisplayName);
   echo $userCollectionModel->DisplayName.'______';
   $mongoCriteria = new EMongoCriteria;
   $mongoModifier = new EMongoModifier;
   $handler = $this->generateUniqueHandleForUser($displayNameArray[0], $displayNameArray[1]);
   $mongoCriteria->addCond('UserId', '==', (int) $userCollectionModel->UserId);
   $mongoModifier->addModifier("uniqueHandle", 'set', $handler);
   UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
     }
   unset($user);
   unset($userCollectionModel);
    }
     
  }
  public function actionFTPCreateUserMongo()
    {
   $data = Yii::app()->db->createCommand("select * from User")->queryAll();
        $userCollectionModel=new UserCollection();
    $userProfileCollection = new UserProfileCollection();
foreach ($data as $value)
{

    $userCollectionModel->UserId=$value['UserId'];
    $userCollectionModel->NetworkId=(int)$value['NetworkId'];
    $userCollectionModel->ProfilePicture='/images/icons/user_noimage.png';
    $userCollectionModel->AboutMe='About Me';
    $userCollectionModel->DisplayName=trim(addslashes($value['FirstName']))." ".trim(addslashes($value['LastName']));
   UserCollection::model()->saveUserCollection($userCollectionModel);  
   UserProfileCollection::model()->saveUserProfileCollection('',$userCollectionModel->UserId);
   $displayNameArray = explode(" ", $userCollectionModel->DisplayName);
   echo $userCollectionModel->DisplayName.'______';
   $mongoCriteria = new EMongoCriteria;
   $mongoModifier = new EMongoModifier;
   $handler = $this->generateUniqueHandleForUser($displayNameArray[0], $displayNameArray[1]);
   $mongoCriteria->addCond('UserId', '==', (int) $userCollectionModel->UserId);
   $mongoModifier->addModifier("uniqueHandle", 'set', $handler);
   UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
}

    
  }
  public function ActionSaveSettings() {
        try {
           $object = UserCollection::model()->findAll();
            foreach($object as $rw){
              echo "User Id is ".$rw->UserId;
                $userSettings = new UserNotificationSettingsCollection();
                $userSettings->UserId = $rw->UserId;
                $userSettings->Commented = 1;
                $userSettings->Loved = 0;
                $userSettings->ActivityFollowed = 0;
                $userSettings->Mentioned = 1;
                $userSettings->Invited = 1;
                $userSettings->UserFollowers = 0;
                $userSettings->NetworkId = $rw->NetworkId;
                UserNotificationSettingsCollection::model()->saveUserSettings($rw->UserId,(int)$rw->NetworkId);
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), "error", "application");
        }
  }
  public  function actionUniqueHandler() {
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;
        $users = UserCollection::model()->findAll();
        $mongoCriteria = new EMongoCriteria;
        $mongoModifier = new EMongoModifier;

        foreach ($users as $user) {
            $displayNameArray = explode(" ", $user->DisplayName);
            echo $user->DisplayName.'______';
            $handler = $this->generateUniqueHandleForUser($displayNameArray[0], $displayNameArray[1]);
           $mongoCriteria->addCond('UserId', '==', (int) $user->UserId);
            $mongoModifier->addModifier("uniqueHandle", 'set', $handler);
            
            echo $handler.'UserId is '.$user->UserId;
            
            
            
            UserCollection::model()->updateAll($mongoModifier, $mongoCriteria);
        }
    }
     function generateUniqueHandleForUser($firstName, $lastName) {
        $handle = $firstName . "." . $lastName;
        while ($this->checkHandleExist($handle)) {
            $randomNumber = mt_rand(1, 99999);
            $handle = $firstName . "." . $lastName . $randomNumber;
        }
        return $handle;
    }
     function checkHandleExist($handle) {
        $criteria = new EMongoCriteria();
        $criteria->addCond('uniqueHandle', '==', $handle);
        $result = UserCollection::model()->find($criteria);
        if (is_object($result)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function actionUpdateUserEmail()
    {
        $user=new User();
        $xml = simplexml_load_file("employee.xml");
        foreach($xml->{'Employee'} as $value)
        {
        $userPresent = $user->getEmployeeUserId($value->EmployeeNumber);
        if(empty($userPresent) || $value->EmailAddress=='')
        {
            continue;
        }
        else
        {
            $user->updateUserEmail($value->EmployeeNumber,$value->EmailAddress);
          
        }
        }
    }

}