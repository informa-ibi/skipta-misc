<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NewsCollection extends EMongoDocument{
    public $_id;
    public $Type;
    public $UserId;   
    public $CreatedOn;
    public $Description;            
    public $Resource;    
    public $NetworkId;
    public $IsFeatured=0;
    public $FeaturedUserId;
    public $FeaturedOn;
    public $CategoryType;
    public $PostId;
    public $IsAbused=0;
    public $IsDeleted=0;
    public $IsBlockedWordExist = 0;
    public $CreatedDate;
    public $HtmlFragment='';
    public $Title="";
    public $IsMultipleArtifact;
    
    public function getCollectionName() {
        return 'NewsCollection';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function indexes() {
        return array(
            'index_UserId' => array(
                'key' => array(
                    'UserId' => EMongoCriteria::SORT_ASC,
                    'CreatedOn' => EMongoCriteria::SORT_DESC,
                ),
            ),
            'index_PostId' => array(
                'key' => array(
                    'PostId' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsAbused' => array(
                'key' => array(
                    'IsAbused' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsBlockedWordExist' => array(
                'key' => array(
                    'IsBlockedWordExist' => EMongoCriteria::SORT_ASC
                ),
            ),
            'index_IsDeleted' => array(
                'key' => array(
                    'IsDeleted' => EMongoCriteria::SORT_ASC
                ),
            ),
        );
    }
     public function attributeNames() {
        return array(
            '_id'=>'_id',
            'Type' => 'Type',
            'UserId' => 'UserId',            
            'CreatedOn' => 'CreatedOn',
            'Description' => 'Description',            
            'Resource' => 'Resource',
            'NetworkId'=>'NetworkId',            
            'IsFeatured'=>'IsFeatured',
            'FeaturedUserId'=>'FeaturedUserId',
            'FeaturedOn'=>'FeaturedOn',
            'CategoryType'=>'CategoryType',
            'PostId'=>'PostId',
            'IsAbused'=>'IsAbused',
            'IsDeleted'=>'IsDeleted',
            'IsBlockedWordExist'=>'IsBlockedWordExist',
            'CreatedDate'=>'CreatedDate',
            'HtmlFragment'=>'HtmlFragment',
            'Title'=>'Title',
            'IsMultipleArtifact'=>'IsMultipleArtifact',
            



        );
    }
    
    
   public function saveNewsCollection($postObj){
   try {
       $returnValue ='failure'; 
          // throw new Exception('Division by zero.');
            $newsCollection=new NewsCollection();
            $newsCollection->Type=(int)$postObj->Type;
            $newsCollection->Title=$postObj->Title;
            $newsCollection->UserId=(int)$postObj->UserId;
            $newsCollection->CreatedOn=new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
            /*
             * uncomment the below line and comment the above line if we call this method for datamigration purpose
             */
            //$postObj->CreatedOn=new MongoDate(strtotime($postObj->CreatedOn));
            $newsCollection->Description=$postObj->Description;                       
            $newsCollection->Resource =$postObj->Resource;
            $newsCollection->NetworkId=(int)$postObj->NetworkId;                        
            $newsCollection->FeaturedUserId=(int)$postObj->FeaturedUserId;  
            $newsCollection->FeaturedOn=new MongoDate(strtotime(date('Y-m-d H:i:s', time())));             
            $newsCollection->IsFeatured=(int)$postObj->IsFeatured;
            $newsCollection->PostId=new MongoId($postObj->PostId);
            $newsCollection->CategoryType=(int)$postObj->CategoryType;
            $newsCollection->IsBlockedWordExist=(int)$postObj->IsBlockedWordExist;
            $newsCollection->IsMultipleArtifact=$postObj->IsMultipleArtifact;
            $newsCollection->CreatedDate=date('Y-m-d');  
            if($postObj->CategoryType==8)
            {
            $newsCollection->HtmlFragment=$postObj->HtmlFragment;
            }
            if($newsCollection->save()){
                $returnValue=$newsCollection->_id;

            }
       return $returnValue;
   } catch (Exception $exc) {              
      Yii::log('--'.$exc->getMessage(),'error','application');
      error_log("excetion-----saveNewsCollection-------------".$exc->getMessage());
      return 'failure';
   }
   } 
   public function updateNewsCollection($postId,$categoryId,$actionType){
       $returnValue='failure';
       try {
           $mongoCriteria = new EMongoCriteria;
           $mongoModifier = new EMongoModifier;          
           if($actionType=='Abuse'){
            $mongoModifier->addModifier('IsAbused', 'set', (int)1);     
           }
           if($actionType=='Delete'){
            $mongoModifier->addModifier('IsDeleted', 'set', (int)1);        
           }
           if($actionType=='UnFeatured'){
            $mongoModifier->addModifier('IsFeatured', 'set', (int)0);        
           }
           if($actionType=='Release'){
            $mongoModifier->addModifier('IsAbused', 'set', (int)0);             
           }
              if($actionType=='SuspendGame'){
            $mongoModifier->addModifier('IsDeleted', 'set', (int)1);        
           }
           if($actionType=='ReleaseGame'){
            $mongoModifier->addModifier('IsDeleted', 'set', (int)0);        
           }
           $mongoCriteria->addCond('CategoryType', '==', (int)$categoryId); 
           $mongoCriteria->addCond('PostId', '==', new MongoId($postId));  
           NewsCollection::model()->updateAll($mongoModifier,$mongoCriteria);
       } catch (Exception $exc) {
           Yii::log('--'.$exc->getMessage(),'error','application');
      return $returnValue;
       }
      }
    public function getTotalFeaturedItems(){
         $returnValue='failure';
        try {
            $mongoCriteria = new EMongoCriteria;
              
           $mongoCriteria->addCond('IsFeatured', '==', (int)1); 
           $mongoCriteria->addCond('IsAbused', '==',(int)0); 
           $mongoCriteria->addCond('IsDeleted', '==',(int)0); 
           $featuredItemsCount=NewsCollection::model()->count($mongoCriteria);
           $returnValue=$featuredItemsCount;
           return $returnValue;
        } catch (Exception $exc) {
             Yii::log('--'.$exc->getMessage(),'error','application');
            return $returnValue;
        }
        }
      /*
       * @author Vamsi Krishna
       * @Description This is get featured Item for Daily Digest
       */ 
    public function getFeaturedItemForDigest($startDate,$endDate){
          $returnValue='failure';
        try {
           $mongoCriteria = new EMongoCriteria;              
           //$mongoCriteria->addCond('IsFeatured', '==', (int)1); 
          // $mongoCriteria->addCond('IsAbused', '==',(int)0); 
          // $mongoCriteria->addCond('IsDeleted', '==',(int)0); 
          // $mongoCriteria->limit(1);         
         // $mongoCriteria->addCond('CreatedOn', '>',new MongoDate(strtotime($startDate)));
          //$mongoCriteria->addCond('CreatedOn', '<',new MongoDate(strtotime($endDate)));
          // $mongoCriteria->CreatedOn = array('$gt' => new MongoDate(strtotime($startDate)),'$lt' => new MongoDate(strtotime($endDate)));
           $array = array(
            'conditions' => array(                
                 'IsDeleted'=>array('!=' => 1),
                'IsFeatured'=>array('==' => 1),
                'IsBlockedWordExist'=>array('notIn' => array(1,2)),
                'IsAbused'=>array('notIn' => array(1,2)),
               // 'CreatedOn'=>array('>' => array(new MongoDate(strtotime($startDate)))),
               // 'CreatedOn'=>array('<' => array(new MongoDate(strtotime($endDate)))),
            ),
            'limit' => 1,
            
        );

           $featuredItems=NewsCollection::model()->find($array);
           //print_r($featuredItems);
           if(isset($featuredItems) ||  is_object($featuredItems) ){
               $returnValue =$featuredItems;
           }
           return $returnValue; 
        } catch (Exception $exc) {
            Yii::log('--' . $exc->getMessage(), 'error', 'application');
            return $returnValue;
        }
    }
    public function abusePost($postId, $actionType, $userId="", $isBlockedPost=0){
        try { 
             $returnValue='failure';
             $mongoCriteria = new EMongoCriteria;
             $mongoModifier = new EMongoModifier;     
             
             if($actionType=='Abuse'){
                 $mongoModifier->addModifier('IsAbused', 'set', 1);
                 $mongoModifier->addModifier('AbusedUserId', 'set', (int)$userId);
                 $mongoModifier->addModifier('AbusedOn','set',new MongoDate(strtotime(date('Y-m-d H:i:s', time()))));
              }elseif ($actionType=="Block") {
                 if($isBlockedPost==0){
                    $mongoModifier->addModifier('IsAbused', 'set', 2);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 2);
                 }
             }elseif ($actionType="Release") {
                 if($isBlockedPost==0){
                     $mongoModifier->addModifier('IsAbused', 'set', 0);
                 }else{
                     $mongoModifier->addModifier('IsBlockedWordExist', 'set', 0);
                 }
             }
             $mongoCriteria->addCond('PostId', '==', new MongoId($postId));  
             $returnValue=  NewsCollection::model()->updateAll($mongoModifier,$mongoCriteria);
             return 'success';

        } catch (Exception $exc) {
           Yii::log($exc->getMessage(),'error','application');
        }
    }

}