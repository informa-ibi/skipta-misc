<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include Yii::app()->params['WebrootPath'].'wsdl/SkiptaWebService.php';
class getJobsCommand extends CConsoleCommand {
    
    public function run($args) {
        $this->getAllJobsFromSkipta();
}
    public function getAllJobsFromSkipta() {
        try {
            echo "8888888888888";
            $service = new SkiptaWebService();
             $login = new Login("admin@skipta.com", "skipta2012!", 1000);
             $sessionResponse = $service->Login($login)->LoginResult;
             $session = new ClientSkiptaSession('{00000000-0000-0000-0000-000000000000}',$sessionResponse->UserID,$sessionResponse->SessionID,$sessionResponse->Timeout);             
             $lastRecord=Careers::model()->getTimeForTheLastInsertRecord();
             if(!is_string($lastRecord)){
                 $date="2010-01-01 00:00:00";
             }else{
                 $date="2010-01-01 00:00:00";
             }
               echo "7777";
             $getJobs=new GetJobsForAWorld($session,Yii::app()->params['NetworkNameForJobs'],$date);
             $getJobsResult =$service->GetJobsForAWorld($getJobs);  
              echo "cunt---".sizeof($getJobsResult);
             if(sizeof($getJobsResult)>0){
                 foreach($getJobsResult as $value){
                 $jobsDecodeResult= json_decode($value);
                 if(sizeof($jobsDecodeResult)>0){
                         foreach($jobsDecodeResult as $job){
                      //$jobsDecodeResult1= CJSON::decode($job,true);      
                                       
                       $career=new Careers();
                       $career->JobDescription=  $job->JobDescription;
                       $career->JobPosition=$job->JobPosition;
                       $career->Location=$job->Location;
                       $career->ContactInformation=$job->ContactInformation;
                       $career->Industry=$job->Industry;
                       $career->CreatedDate = date('Y-m-d H:i:s');
                       $career->PostedDate=$job->CreatedDate;
                       $career->Category=$job->Category;
                       $career->JobTitle=$job->JobTitle;
                       $career->Status=$job->Status;
                       $career->MigratedId=$job->MigratedId;
                       $userId=User::model()->getUserByMigratedUserId($job->CreatedUserId);
                       
                       if(!is_string($userId)){
                        $career->CreatedUserId=$userId['UserId'];    
                       }else{
                           $career->CreatedUserId=$job->CreatedUserId;
                       }
                       preg_match('/src="([^"]+)"/', $job->JobDescription, $match);
                       if(sizeof($match)>0){
                            $url = $match[1];                            
                       $career->IframeUrl=$url;
                       $snippetArray=$this->GetSnippet($url);                                             
                       if(isset($snippetArray['description'])){
                       $career->SnippetDescription=$snippetArray['description']; 
                       }
                         if(isset($snippetArray['title'])){
                       $career->SnippetTitle=$snippetArray['title'];
                         }
                         
                        if(isset($snippetArray['thumbnail_url'])){
                         $career->SnippetThumbnailUrl=$snippetArray['thumbnail_url'];
                    }else{
                     $career->SnippetThumbnailUrl="";     
                    }
                    //   $career->SnippetThumbnailUrl=$snippetArray['thumbnail_url'];
                       
                       }else{
                        $career->IframeUrl='';   
                        
                       }
                echo "hiiiiiiiiiiiiiiiiiiiii";
                      Careers::model()->saveCareers($career);
                      $CategoryType = CommonUtility::getIndexBySystemCategoryType('Career');
                      $postType = CommonUtility::sendPostType('Jobs');
                      $NetworkId = Yii::app()->params['NetWorkId'];
                      UserInteractionCollection::trackEngagementAction($userId, "Career", 'JobsCreation', $userId, $CategoryType, $postType, $id = '', $NetworkId);
//                       
                   }
                 }
               
                
             }
             }
             
             
                                            
        } catch (Exception $exc) {
            echo '____****_______________'.$exc->getMessage();
            Yii::log("" . $exc->getMessage(), 'error', 'application');
        }
    }
    
   public function GetSnippet($url) {
        try {
            $text = trim($url);
            echo '----'.$url;
             $parsed = parse_url($text);
            // print_r($parsed);
                if (empty($parsed['scheme'])) {
                    $text = 'http://' . ltrim($text, '/');
                }
            
           
            //     $obj = array('status' => 'success', 'snippetdata' => $WeburlObj,'type'=>$type,'CommentId'=>$commentId);
            

              $decode=array();
                 $options = array( 
                    CURLOPT_RETURNTRANSFER => true,     // return web page 
                    CURLOPT_HEADER         => false,    // do not return headers 
                    CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
                    CURLOPT_USERAGENT      => "spider", // who am i 
                    CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
                    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
                    CURLOPT_TIMEOUT        => 120,      // timeout on response 
                    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
                ); 
                $ch      = curl_init( $text ); 
                curl_setopt_array( $ch, $options ); 
                $content = curl_exec( $ch ); 
                $err     = curl_errno( $ch ); 
                $errmsg  = curl_error( $ch ); 
                $header  = curl_getinfo( $ch ); 
                curl_close( $ch ); 

                //var_dump($data);
               if(strlen($content)==0){
                  
                    $decode['provider_url']=$url;
                    $decode['description']="";
                    $decode['title']="";
               }else{
                   // $text=preg_replace('/^(\<p\><a\><\a>(\&nbsp\;|(\s)*)\<\/p\>|\<br(\s\/)?\>)$/', '', $text);
                 // $text = str_replace('</a>', '', $text);
                  $weburl=urlencode ($header['url']);
                // error_log("http%3A%2F%2Fm.nzherald.co.nz%2Fnz%2Fnews%2Farticle.cfm%3Fc_id%3D1%26objectid%3D11169553");
                $url = "https://api.embed.ly/1/oembed?key=a8d760462b7c4e4cbfc9d6cb2b5c3418&url=" . $weburl;
                $details = @file_get_contents($url);
                //error_log(print_r($details,true));
                $decode = CJSON::decode($details);
                
                if(!is_array($decode) && !count($decode)>0){
               echo '_____11111111______';
                    $doc = new DOMDocument();
                    @$doc->loadHTML($content);
                    $nodes = $doc->getElementsByTagName('title');
                     
                      if(sizeof($nodes)>1){
                             //get and display what you need:
                    $title = $nodes->item(0)->nodeValue;
                    $metas = $doc->getElementsByTagName('meta');

                    for ($i = 0; $i < $metas->length; $i++)
                    {
                        $meta = $metas->item($i);
                        if($meta->getAttribute('name') == 'description')
                        $description = $meta->getAttribute('content');
                        
                    }
                     //fetch images
                    $image_regex = '/<img[^>]*'.'src=[\"|\'](.*)[\"|\']/Ui';
                     $a=preg_match_all($image_regex, $html, $img, PREG_PATTERN_ORDER);

                    $images_array = $img[0];
                    
                    if(strstr($images_array[0],'http')) {
                            $image=$images_array[0];

                    }else{
                        $image=$relative_url.$images_array[0];

                    }
                      }else{
                          $title='';
                          $description='';
                          $image='';
                          
                      }
                    $base_url = substr($text,0, strpos($text, "/",8));
                    $relative_url = substr($text,0, strrpos($text, "/")+1);

             
                 



                   
                    
                   $decode['provider_url']=$text; 
                   $decode['description']=$description; 
                   $decode['title']=$title; 
                   $decode['thumbnail_url']=$image; 
                }
                 else{
                     echo '_______22222_________';
                      $decode['provider_url']=$url;
                  //  $decode['description']="";
                   // $decode['title']="";
                    if(isset($image)){
                         $decode['thumbnail_url']=$image;
                    }else{
                     $decode['thumbnail_url']="";     
                    }
                   
                 }
                //$SnippetObj = ServiceFactory::getSkiptaPostServiceInstance()->SaveWebSnippet($text, $decode);
                
            }
            print_r($decode);
            return $decode;
        } catch (Exception $exc) {
            echo '&&&'.$exc->getMessage();
            Yii::log($exc->getTraceAsString(), "error", "application");
        }
    } 
    
    

}
