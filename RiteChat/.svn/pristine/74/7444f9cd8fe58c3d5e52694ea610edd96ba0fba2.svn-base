<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserCVForm extends CFormModel {

    public $userId;
    public $Education_Ids;
    public $Education;
    public $CollegeName;
    public $Specialization;
    public $YearOfPassing;
    public $Experience;
    public $UserExperience;
    public $Interests;
    public $UserInterests;
    public $Achievements;
    public $UserAchievements;
    public $Publications;
    public $PublicationName;
    public $PublicationTitle;
    public $PublicationAuthors;
    public $PublicationDate;
    public $PublicationLocation;
    public $PublicationLink;
    public $PublicationPdf;
    public $UploadFileORLink;
    public $RecentupdateSection;
    public $Publicationfile;
    public $PublicationFIleType;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('CollegeName', 'validateDynamicFields', 'fieldname' => 'CollegeName' ,'message' => 'School Name'),
            array('Specialization', 'validateDynamicFields', 'fieldname' => 'Specialization'),
            array('YearOfPassing', 'validateYearofpassing', 'fieldname' => 'YearOfPassing','message' => 'Year of Passing'),
            array('UserExperience', 'validateExperience', 'fieldname' => 'UserExperience'),
            array('UserInterests', 'validateInterests', 'fieldname' => 'UserInterests'),
            array('UserAchievements', 'validateAchievements', 'fieldname' => 'UserAchievements'),
            array('PublicationName', 'validateDynamicFields', 'fieldname' => 'PublicationName','message' => 'Name'),
            array('PublicationTitle', 'validateDynamicFields', 'fieldname' => 'PublicationTitle','message' => 'Title'),
            array('PublicationAuthors', 'validateDynamicFields', 'fieldname' => 'PublicationAuthors','message' => 'Authors'),
           array('PublicationDate', 'validateYearofpassing', 'fieldname' => 'PublicationDate','message' => 'Date'),
            array('PublicationLocation', 'validateDynamicFields', 'fieldname' => 'PublicationLocation','message' => 'Venue'),
           // array('PublicationLink', 'validateDynamicFields', 'fieldname' => 'PublicationLink'),
         //   array('Publicationfile', 'validateDynamicFields', 'fieldname' => 'Publicationfile'),
          //  array('PublicationPdf', 'validateDynamicFields', 'fieldname' => 'PublicationPdf'),

               array('Publicationfile', 'validateLink', 'fieldname' => 'Publicationfile'),

            array('PublicationFIleType,Education_Ids,RecentupdateSection,UploadFileORLink,PublicationFile,Education,Specialization,YearOfPassing,Experience,UserExperience,Interests,UserInterests,Achievements,UserAchievements,Publications,PublicationName,PublicationTitle,PublicationAuthors,PublicationDate,PublicationLocation,PublicationLink,PublicationPdf', 'safe'),
        );
    }

    public function validateDynamicFields($attribute, $params) {
        if(sizeof($this->$params['fieldname'])>0){
           foreach ($this->$params['fieldname'] as $key => $order) {

            if (empty($order)) {
                if(isset($params['message']) && $params['message']!=""){
                    $message=$params['message'];
                }else{
                    $message=$params['fieldname'];
                }
                $this->addError($params['fieldname'] . '_' . $key, $message . ' cannot be blank');
                // break;
            }
        }  
        }
       
    }
     public function validateYearofpassing($attribute, $params) {
        if(sizeof($this->$params['fieldname'])>0){
           foreach ($this->$params['fieldname'] as $key => $order) {
                if(isset($params['message']) && $params['message']!=""){
                    $message=$params['message'];
                }else{
                    $message=$params['fieldname'];
                }
            if (empty($order)) {
               
                $this->addError($params['fieldname'] . '_' . $key, $message . ' cannot be blank');
                // break;
            }else{
                $k=preg_match('/^[_~\-!@#\$%\^&*\(\)]+$/',"$order");
               
                if($k==1){
                    $this->addError($params['fieldname'] . '_' . $key, $message . ' is invalid');
                }
                 
            }
        }  
        }
       
    }
    public function validateExperience($attribute, $params) {
        if(sizeof($this->$params['fieldname'])>0){
           foreach ($this->$params['fieldname'] as $key => $order) {
         
            if (empty($order)) {
                if($key==1){
                      $message='Research Experience';
                }else if($key==2){
                      $message='Professional Experience';
                }else if($key==3){
                      $message='Academic Experience';
                }else if($key==4){
                      $message='Volunteer Experience';
                }else if($key==5){
                      $message='Professional Development';
                }
                $this->addError($params['fieldname'] . '_' . $key, $message . ' cannot be blank');
                // break;
            }else{
              
            }
        }  
        }
       
    }
     public function validateInterests($attribute, $params) {
        
        if(sizeof($this->$params['fieldname'])>0){
           foreach ($this->$params['fieldname'] as $key => $order) {
            if (empty($order)) {
                if($key==1){
                      $message='Academic Interests';
                }else if($key==2){
                      $message='Research Interests';
                }else if($key==3){
                      $message='Personal Interests';
                }
                $this->addError($params['fieldname'] . '_' . $key, $message . ' cannot be blank');
                // break;
            }else{
                error_log("ordernot emptyoooooooooooooooooo". $params['fieldname']);
            }
        }  
        }
       
    }
      public function validateAchievements($attribute, $params) {
    
        if(sizeof($this->$params['fieldname'])>0){
           foreach ($this->$params['fieldname'] as $key => $order) {
          
            if (empty($order)) {
                if($key==1){
                      $message='Presentations';
                }else if($key==2){
                      $message='Awards';
                }else if($key==3){
                      $message='Grants';
                }else if($key==4){
                      $message='Memberships';
                }
                 
                $this->addError($params['fieldname'] . '_' . $key, $message . ' cannot be blank');
                // break;
            }else{
            }
        }  
        }
       
    }
    

    public function validateLink($attribute, $params) {


        
        if (sizeof($this->$params['fieldname']) > 0) {
            foreach ($this->$params['fieldname'] as $key => $order) {
                $link = $order;
                if($link!=""){
                    preg_match('/\.[^\.]+$/i', $link, $ext);
                    if (strtolower(trim($ext[0])) == ".pdf" || strtolower(trim($ext[0])) == ".doc"  || strtolower(trim($ext[0])) == ".docx") {

                    } else {

                       // error_log($ext[0]." exttttttttttttttttttttttttttttttttttt".$link.$params['fieldname']);

                        $this->addError($params['fieldname'] . '_' . $key,  ' Link must point to a PDF/DOC file.');
                    }
                }else{
                    if($this->PublicationFIleType[$key]==1){
                        $message=" Link  cannot be blank";
                    }else{
                        $message='Please Upload File';
                    }
                    
                     $this->addError($params['fieldname'] . '_' . $key,  $message);
                }
               
            }
        }
    }

}
