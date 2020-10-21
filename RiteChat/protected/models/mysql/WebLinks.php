<?php

class WebLinks extends CActiveRecord{
    
    public $id;
    public $WebUrl;
    public $Description;
    public $Status;
    public $WebSnippetUrl;
    public $WebImage;
    public $WebDescription;
    public $WebTitle;
    public $CreatedUserId;
    public $CreatedOn;
    public $Xcol;
    public $Ycol;
    public $Divcol;
    public $LinkGroup;
    public $OtherValue;
    public $Title;
    public $LinkGroupId;
     public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'WebLinks';
    }
    
    public function saveNewWebLink($webLinksObj, $type) {
        $returnValue = 'failure';
        try {
            if($webLinksObj->LinkGroup == "other")
                $linkGroupId = LinkGroup::model()->saveNewGroupName($webLinksObj->OtherValue);
            else{
                $linkGroupId = $webLinksObj->LinkGroup;
            }
            
            if ($type == 'new') {    
                
                    $webLinksObj->LinkGroupId = $linkGroupId;
                if ($webLinksObj->save()) {
                    $webLinkId = (int) $webLinksObj->id;
                    $this->updateYcol($webLinkId,$webLinksObj->Xcol);
                    $returnValue = 'success';
                }
            } else {
                $webLinks = WebLinks::model()->findByAttributes(array('id' => $webLinksObj->id));
                $webLinks->WebUrl = $webLinksObj->WebUrl;
                $webLinks->Description = $webLinksObj->Description;
                $webLinks->WebDescription = $webLinksObj->WebDescription;
                $webLinks->WebImage = $webLinksObj->WebImage;
                $webLinks->WebSnippetUrl = $webLinksObj->WebSnippetUrl;
                $webLinks->WebTitle = $webLinksObj->WebTitle;
                $webLinks->Status = $webLinksObj->Status;                
                $webLinks->LinkGroupId = $linkGroupId;
                $webLinks->Title = $webLinksObj->Title;
                if ($webLinks->update()) {
                    $returnValue = 'success';
                }
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(), 'error', 'application');
            return $returnValue;
        }
    }

    public function getWebLinks($limit, $offset,$isAdmin){
       $returnValue='failure';
       try {
          if($isAdmin ==1){

            $query="SELECT LG.LinkGroupName,WL.id,WL.Description,WL.WebUrl,WL.Description,WL.Status,WL.WebSnippetUrl,WL.CreatedOn,WL.CreatedUserId,WL.Title,WL.LinkGroupId,WL.WebImage,WL.WebTitle,WL.DivCol FROM WebLinks WL  join LinkGroup LG  ON  WL.LinkGroupId = LG.Id 
     ORDER BY FIND_IN_SET(LinkGroupId,(select Group_CONCAT(LinkGroupId) as LinkGroupId from (SELECT LinkGroupId,max(CreatedOn) as CON FROM WebLinks Group by LinkGroupId  order by CON desc
 ) as T)) , CreatedOn desc limit $limit offset  $offset";               
           }else{
             $query="SELECT LG.LinkGroupName,WL.id,WL.Description,WL.WebUrl,WL.Description,WL.Status,WL.WebSnippetUrl,WL.CreatedOn,WL.CreatedUserId,WL.Title,WL.LinkGroupId,WL.WebImage,WL.WebTitle,WL.DivCol FROM WebLinks WL  join LinkGroup LG  ON  WL.LinkGroupId = LG.Id  where WL.Status=1
     ORDER BY FIND_IN_SET(LinkGroupId,(select Group_CONCAT(LinkGroupId) as LinkGroupId from (SELECT LinkGroupId,max(CreatedOn) as CON FROM WebLinks Group by LinkGroupId  order by CON desc
 ) as T)) , CreatedOn desc limit $limit offset  $offset";             
           }  
           error_log("----------------------------------------------".$query);
            $webLinks = Yii::app()->db->createCommand($query)->queryAll();             
            if(count($webLinks)>0){
                $returnValue =$webLinks;
            }
            return $returnValue;
       } catch (Exception $exc) {
            Yii::log($exc->getTraceAsString(),'error','application');
            return $returnValue;
       }
      }
  public function getWebLinksById($WebLinkId){
      $returnValue='failure';
      try {
          $query="select * from WebLinks where id=".$WebLinkId;
          
          $webLinks = Yii::app()->db->createCommand($query)->queryRow();      
          if(is_array($webLinks)){
              $returnValue=$webLinks;
          }
          return $returnValue;
      } catch (Exception $exc) {    
           Yii::log($exc->getTraceAsString(),'error','application');
            return $returnValue;
      }
    }
    
 public function updateYcol($webLinkId,$xcol){
     try {
        // $queryForYcol="update WebLinks set Ycol=max(Ycol)+1 where Xcol=$xcol and id=$webLinkId";
         
         $queryForYcol="update WebLinks join (select CASE WHEN max(Ycol) is null THEN 1 ELSE max(Ycol)+1  END as count FROM WebLinks where Xcol=$xcol ) B set Ycol=B.count where id=$webLinkId";
         
        error_log("-------".$queryForYcol);
          YII::app()->db->createCommand($queryForYcol)->execute();
         $queryForDivcol=  "update WebLinks set DivCol=concat(Xcol,'_',Ycol) where  id=$webLinkId";
         
         YII::app()->db->createCommand($queryForDivcol)->execute();
     } catch (Exception $exc) {
         Yii::log($exc->getTraceAsString(),'error','application');
            return $returnValue;
     }
  }
 
 public function  buildDragData($dragdataa){
 try {
      
        $dragdata = explode('#',$dragdataa);      
        
        for ($x = 1; $x <= sizeof($dragdata)-1; $x++){            
            $xindex = $x - 1;
            $comdata = explode(",", $dragdata[$xindex]);           
            for ($y = 1; $y <= sizeof($comdata); $y++){                 
                $yindex = $y - 1;
                $queryTogetWebLink="select id from WebLinks where DivCol='" . $comdata[$yindex] . "'";
                $webLink = Yii::app()->db->createCommand($queryTogetWebLink)->queryRow();
                $query = "update WebLinks set xcol=" . $x . ",ycol=" . $y . "  where id=".$webLink['id'];
                
                 YII::app()->db->createCommand($query)->execute();
               // $queryForDivcol=  "update WebLinks set DivCol=concat(Xcol,'_',Ycol) where id=".$webLink['id'];
               // error_log("-------".$queryForDivcol);
               // YII::app()->db->createCommand($queryForDivcol)->execute();
               
                
            }
        }
        
 } catch (Exception $exc) {
      Yii::log($exc->getTraceAsString(),'error','application');
            return $returnValue;
 }
 } 
}
