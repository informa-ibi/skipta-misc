<?php

/**
 * Developer Name: Swarna Rahul M
 * News Controller will be used for Content Management from Curators API and Release Management.
 * 
 */
class NewsController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function init() {
        parent::init();
        if (isset(Yii::app()->session['TinyUserCollectionObj']) && !empty(Yii::app()->session['TinyUserCollectionObj'])) {
            $this->tinyObject = Yii::app()->session['TinyUserCollectionObj'];
            CommonUtility::reloadUserPrivilegeAndData($this->tinyObject->UserId);
            $this->userPrivileges = Yii::app()->session['UserPrivileges'];
            $this->userPrivilegeObject = Yii::app()->session['UserPrivilegeObject'];
            $this->whichmenuactive = 5;
        } else {
            $this->redirect('/');
        }
        $this->sidelayout = 'no';
    }

    /**
     * suresh reddy here
     */
    public function actionError() {
        $cs = Yii::app()->getClientScript();
        $baseUrl = Yii::app()->baseUrl;
        $cs->registerCssFile($baseUrl . '/css/error.css');
        if ($error = Yii::app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }

    public function actionIndex() {
        try {
            $streamIdArray = array();
            $previousStreamIdArray = array();
            $previousStreamIdString = isset($_POST['previousStreamIds'])?$_POST['previousStreamIds']:"";
            if(!empty($previousStreamIdString)){
                $previousStreamIdArray = explode(",", $previousStreamIdString);
            }
            if (isset($_GET['StreamPostDisplayBean_page'])) {
                           
                if (isset($_GET['filterString'])) {
                    
                } else {
                    $condition = array(
                       'NetworkId' => array('==' => (Int) Yii::app()->params['NetWorkId']),
                       'UserId'=>array('in' => array(0,$this->tinyObject->UserId)),
                       'Released' => array('==' => (Int) 1),
                       'IsDeleted' => array('==' => (Int) 0),
                       'IsAbused' => array('==' => (Int) 0),
                       'CategoryType' => array('==' => (Int) 8),
                    );
                }
                $pageSize = 10;
                $provider = new EMongoDocumentDataProvider('StreamPostDisplayBean', array(
                    'pagination' => array('pageSize' => $pageSize),
                    'criteria' => array(
                        'conditions' => $condition,
                        'sort' => array('CreatedOn' => EMongoCriteria::SORT_DESC,'UserId'=>EMongoCriteria::SORT_DESC),
                    )
                ));
                if ($provider->getTotalItemCount() == 0) {
                    $stream = 0; //No posts
                } else if ($_GET['StreamPostDisplayBean_page'] <= ceil($provider->getTotalItemCount() / $pageSize)) {
                   $UserId =  Yii::app()->session['PostAsNetwork']==1?Yii::app()->session['NetworkAdminUserId']:$this->tinyObject['UserId'];
                   $streamRes = (object) (CommonUtility::prepareStreamData($UserId, $provider->getData(), $this->userPrivileges, 0, Yii::app()->session['PostAsNetwork'],'',$previousStreamIdArray));
                   $streamIdArray=$streamRes->streamIdArray;
                   $totalStreamIdArray=$streamRes->totalStreamIdArray;
                   $totalStreamIdArray = array_values(array_unique($totalStreamIdArray));
                   $streamIdArray = array_values(array_unique($streamIdArray));
                   $stream=(object)($streamRes->streamPostData);
                  
                } else {
                    $stream = -1; //No more posts
                }
                $streamData = $this->renderPartial('stream_view', array('stream' => $stream), true);
                $streamIdString = implode(',', $streamIdArray);
                echo $streamData."[[{{BREAK}}]]".$streamIdString;
            }
            else{
                $this->render('index');
            }
        } catch (Exception $ex) {
            error_log("************EXCEPTION at NEWS STREAMHOME*****************" . $ex->getMessage());
            Yii::log("************EXCEPTION at NEWS STREAMHOME*****************" . $ex->getMessage(), 'error', 'application');
        }
    }
    public function actionRenderNewsDetailedPage(){
        try{
            $id = $_REQUEST['id'];
            $condition = array(
                       '_id' => array('==' => new MongoId($id)),
                    );
            $provider = new EMongoDocumentDataProvider('CuratedNewsCollection', array(
                    'pagination' => FALSE,
                    'criteria' => array(
                       'conditions' => $condition,
                        )
                    
                ));
            if ($provider->getTotalItemCount() == 0) {
                    $stream = 0; //No posts
                } else {
                    $stream = (object) $provider->getData();
                }
            $this->renderPartial('newsDetailedPage', array('stream' => $stream));
        } catch (Exception $ex) {
            error_log("#############Exception Occurred renderNewsDetailedPage###############".$ex->getMessage());
        }
    }
    
    public function actionRenderPostDetailed() {
        try {  
            $postId = $_REQUEST['postId'];
            $categoryType = $_REQUEST['categoryType'];
            $postType = $_REQUEST['postType'];    
            $id = $_REQUEST['id'];
            $mainGroupCollection="";
            $MoreCommentsArray = array();
            $tinyUserProfileObject = array();
            $object = array();
            $object = ServiceFactory::getSkiptaPostServiceInstance()->getNewsObjectById($postId);
            if(isset($object) && !empty($object)){
            $UserId = $object->UserId;
            $tinyUserProfileObject = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($UserId);
            if(isset($object->WebUrls)){
             if(isset($object->IsWebSnippetExist)&& $object->IsWebSnippetExist=='1'){            
                     $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($object->WebUrls[0]);
                     $object->WebUrls=$snippetdata;
                }else{
                     $object->WebUrls="";
                }
            }
         //This code is for get post all comment and prepare comments data with web snippets  
            
             $MinpageSize = 2;
        $page=0;
        $pageSize = ($MinpageSize * $page);
        $categoryType = (int) $categoryType;
        $result = ServiceFactory::getSkiptaPostServiceInstance()->getRecentCommentsforNews($postId);
         $commentDisplayCount = 0;
         if(isset($result) && sizeof($result)>0){
              $rs=array_reverse($result);
        foreach ($rs as $key => $value) {
            if(!(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist']==1)){
                $commentUserBean = new CommentUserBean();
                $userDetails = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($value['UserId']);
                $createdOn = $value['CreatedOn'];
                $commentUserBean->UserId = $userDetails['UserId'];

                $postId = (isset($value["PostId"])) ? $value["PostId"] : '';
                $CategoryType = (isset($value["CategoryType"])) ? $value["CategoryType"] : '';
                $PostType = (isset($value["PostType"])) ? $value["PostType"] : '';
                    $value["CommentText"] = $value["CommentText"];
                $commentUserBean->CommentText = $value['CommentText'];
                if(is_int($createdOn))
                {
                    $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn);
                }
                else if(is_numeric($createdOn))
                {
                    $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn);
                }
                else
                {
                    $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn->sec);
                }

                $commentUserBean->DisplayName = $userDetails['DisplayName'];
                $commentUserBean->ProfilePic = $userDetails['profile70x70'];
                $commentUserBean->CateogryType = $CategoryType;
                $commentUserBean->PostId = $postId;
                $commentUserBean->Type = $PostType;
                $commentUserBean->Resource=$value['Artifacts'];
                $commentUserBean->ResourceLength = count($value['Artifacts']);
                //$commenturls=$value['WebUrls'];
                if (array_key_exists('WebUrls', $value)) {
                 if(isset($value['WebUrls']) && is_array($value['WebUrls']) && count($value['WebUrls'])>0){
                     
                      $commenturls=$value['WebUrls'];
                         $WeburlObj = ServiceFactory::getSkiptaPostServiceInstance()->CheckWebUrlExist($commenturls[0]);
                     
                         if($WeburlObj!='failure'){
                               $snippetData=$WeburlObj;
                          }else{
                              
                              $snippetData="";
                          }
                        }else{
                            
                            $snippetData="";
                        }
                    $commentUserBean->snippetdata = $snippetData;
                     if(isset($value['IsWebSnippetExist'])){
                         $commentUserBean->IsWebSnippetExist = $value['IsWebSnippetExist'];
                    }else{
                         $commentUserBean->IsWebSnippetExist = "";
                    }
                  }

                array_push($MoreCommentsArray, $commentUserBean);
                 $commentDisplayCount++;
                  if($commentDisplayCount==5){
                                break;
                     }
                
            }

        }
         }
        }else{
            $object = 0;            
        }
        $commentedUsers = ServiceFactory::getSkiptaPostServiceInstance()->getCommentedUsersForPost($postId, (int)($this->tinyObject['UserId']));
        $IsUserCommented = in_array((int)($this->tinyObject['UserId']), $commentedUsers);
        $this->renderPartial("newsDetailedPage", array("data" => $object, "tinyObject" => $tinyUserProfileObject, "categoryType" => $categoryType,'commentsdata'=>$MoreCommentsArray,'IsCommented'=>$IsUserCommented));
        $userId = $this->tinyObject['UserId'];  
        //ServiceFactory::getSkiptaPostServiceInstance()->trackEngagementAction($userId,"Post","PostDetailOpen",$postId,$categoryType,$postType);

        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), "error", "application");
        }
    }
    
    public function actionGeteditorial()
    {
        $data = ServiceFactory::getSkiptaPostServiceInstance()->GetEditorialService($_POST['postId']);
        $result = array("code" => 200, "status" => "",'data' => $data);
        echo $this->rendering($result);
    }
      /**
     * @author Moin Hussain
     * This method is used to search posts
     */
    public function actionGetNewsForSearch() {
        $searchText = $_POST['search'];
        $offset = $_POST['offset'];
        $pageLength = $_POST['pageLength'];
        $postSearchResult = ServiceFactory::getSkiptaPostServiceInstance()->getNewsForSearch($searchText, $offset, $pageLength);
        $this->renderPartial('game_search', array('postSearchResult' => $postSearchResult));
        //echo CJSON::encode($result);
    }
    public function actionPostdetail(){
     try{
         $postId = $_REQUEST['postId'];
        $categoryType = $_REQUEST['categoryType'];
        $postType = $_REQUEST['postType'];
        $out = $_REQUEST['outer'];
         $this->render('/post/postdetail',array('postId'=>$postId,'categoryType'=>$categoryType,'postType'=>$postType,'outer'=>$out));
     } catch (Exception $ex) {

     }
 }
    
}
