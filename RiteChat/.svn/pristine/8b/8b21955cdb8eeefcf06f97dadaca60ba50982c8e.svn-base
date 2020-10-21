<?php

class CuratorCommand extends CConsoleCommand {

public function actionCurable()
    {
      Yii::import("application.extensions.Scoopit.*"); 
      Yii::import("application.extensions.Scoopit.oauth.tokenStore.*");
      $network_data = ServiceFactory::getSkiptaUserServiceInstance()->getCuratorAccessTokenService(Yii::app()->params['ServerURL']);
      $tokenStore = new SessionTokenStore();
      $CuratedDataFromDB = ServiceFactory::getSkiptaPostServiceInstance()->getAllCuratedTopicsService(0,$network_data['NetworkId']);
      $CuratedContentData=''; 
      if($CuratedDataFromDB['Status']!=0)
      {
      $tokenStore->storeAccessToken($network_data['CuratorAccessToken']);
      $tokenStore->storeSecret(Yii::app()->params['Curator_Consumer_Secret']);
      $scoop = new ScoopIt($tokenStore,Yii::app()->params['Curator_Callback_Url'],Yii::app()->params['Curator_Consumer_key'], Yii::app()->params['Curator_Consumer_Secret']);
      
      try
      {
  
      $CuratedNewsCollection = new CuratedNewsCollection();
      $curatedSearchCriteriaData = $CuratedNewsCollection->getSearchCriteriaForCuratedPosts($CuratedDataFromDB['TopicId'],1);
      if(is_object($curatedSearchCriteriaData))
      {
      echo "inside if";
      $PublicationDate  =  date('Y-m-d 00:00:00');
      echo $PublicationDate."***CT**\n";
      date_default_timezone_set('UTC');
      $curatedTime= strtotime('-2 days',strtotime($PublicationDate));
      echo $curatedTime."***2D AgoTime**\n";
      $CuratedContentData[] = $scoop->topic($CuratedDataFromDB['TopicId'],0,500,0,($curatedTime*1000));
      echo sizeof($CuratedContentData)."Size of the syned data\n";

      }
      else
      {
      echo "inside else";
      $CuratedContentData[] = $scoop->topic($CuratedDataFromDB['TopicId'],0,500);
      }
    
      }
      catch(Exception $e)
      { 
          echo $e->getMessage();
         $data =explode(':',stristr($e->getMessage(),'Error'));
         if($data[0]=='error"')
         {
         //ServiceFactory::getSkiptaPostServiceInstance()->updateCuratedTopicService($CuratedDataFromDB['TopicId'],0);    
         }
      }
      if(!empty($CuratedContentData))
      {
     $curablePosts = $CuratedContentData[0]->curablePosts;
       
     foreach($curablePosts as $key){
        $curatedNewCollection  = new CuratedNewsCollection();
        $postId = (float)$key->id;
        $data = $curatedNewCollection->getPostByIdConsole($postId);
        if($data=='')
        {
            $curatedNewCollection->PostId =(float)$key->id;
            $curatedNewCollection->TopicId = $key->topicId;
            $curatedNewCollection->TopicName = $CuratedDataFromDB['TopicName'];
            $curatedNewCollection->TopicImage = $CuratedDataFromDB['ImageUrl'];
            $curatedNewCollection->Title = $key->title;
            if (isset($key->htmlFragment))
            {
               $curatedNewCollection->HtmlFragment=$key->htmlFragment;
            }
            else 
                {
                  if(isset($key->imageSize))
                  {
                    if ($key->imageSize == 'big' && isset($key->largeImageUrl)) {
                       $curatedNewCollection->HtmlFragment="<img src='" . $key->largeImageUrl . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='';
                    }
                    if ($key->imageSize == 'medium' && isset($key->mediumImageUrl)) {
                        $curatedNewCollection->HtmlFragment="<img src='" . $key->mediumImageUrl . "' style='width:auto;display:inline-block'/>";
                        $curatedNewCollection->Alignment='customwidget_left';
                    }
                    if ($key->imageSize == 'small' && isset($key->smallImageUrl)) {
                       $curatedNewCollection->HtmlFragment="<img src='" . $key->smallImageUrl . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='customwidget_left';
                    }
                    if(isset($key->imageUrls))
                       {
                       $curatedNewCollection->HtmlFragment="<img src='" . $key->imageUrls[0] . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='customwidget';
                       }
                    
                  }
                  else {
                       if(isset($key->imageUrls))
                       {
                       $curatedNewCollection->HtmlFragment="<img src='" . $key->imageUrls[0] . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='customwidget';
                       }
                    }
                }
            $curatedNewCollection->Description = CommonUtility::strip_tags(array('blockquote','b','strong','div'),$key->htmlContent);
            $curatedNewCollection->Description = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $curatedNewCollection->Description);
            $curatedNewCollection->Description =  preg_replace("/<p[^>]*><\\/p[^>]*>/", '', $curatedNewCollection->Description); 
            $curatedNewCollection->Description = str_replace('...','',$curatedNewCollection->Description);
            $curatedNewCollection->PublisherSource = parse_url($key->url,PHP_URL_HOST);
            $curatedNewCollection->PublisherSourceUrl=$key->url;
            $curatedNewCollection->PublicationDate = CommonUtility::millisecondsTOdate($key->publicationDate,"F j, Y, g:i A");
            $curatedNewCollection->PublicationTime = "$key->publicationDate";
            $curatedNewCollection->CreatedDate = new MongoDate($curatedNewCollection->PublicationTime/1000);
            $curatedNewCollection->UserId = 0;
            $curatedNewCollection->NetworkId = (Int)$CuratedDataFromDB['NetworkId'];
            $CuratedContentDataPrepared=$curatedNewCollection;
            ServiceFactory::getSkiptaPostServiceInstance()->saveCuratedPost($CuratedContentDataPrepared);
         }
         unset($curatedNewCollection);
        }
      }
       }
      unset($CuratedContentData);
    }
    
    public function actionTopics()
    {
      Yii::import("application.extensions.Scoopit.*"); 
      Yii::import("application.extensions.Scoopit.oauth.tokenStore.*");
      $network_data = ServiceFactory::getSkiptaUserServiceInstance()->getCuratorAccessTokenService(Yii::app()->params['ServerURL']);
      $tokenStore = new SessionTokenStore();
      $tokenStore->storeAccessToken($network_data['CuratorAccessToken']);
      $tokenStore->storeSecret(Yii::app()->params['Curator_Consumer_Secret']);
      $scoop = new ScoopIt($tokenStore,Yii::app()->params['Curator_Callback_Url'],Yii::app()->params['Curator_Consumer_key'], Yii::app()->params['Curator_Consumer_Secret']);
      $CuratedData = $scoop->profile(null)->user->curatedTopics;
      $sql = "INSERT IGNORE INTO CuratedTopic (NetworkId,TopicId,TopicName,ShortName,ImageUrl,Status) VALUES  ";
            $values = '';
            $i = sizeof($CuratedData);
            foreach ($CuratedData as $value) {
                $i--;

                $values .="(";
                $values .="'" . (addslashes($network_data['NetworkId'])) . "',";
                $values .="'" . (addslashes($value->id)) . "',";
                $values .="'" . (addslashes($value->name)) . "',";
                $values .="'" . (addslashes($value->shortName)) . "',";
                $values .="'" . (addslashes($value->imageUrl)) . "',";
                if ($i != 0)
                    $values .="'" . (1) . "'),";
                else
                    $values .="'" . (1) . "');";
                //}
                try {
                    $command = Yii::app()->db->createCommand($sql . $values);
                    $command->execute();
                } catch (Exception $e) {
                    continue;
                }    
  
    }
    }
    
    
    public function actionCurated()
    {
      Yii::import("application.extensions.Scoopit.*"); 
      Yii::import("application.extensions.Scoopit.oauth.tokenStore.*");
      $network_data = ServiceFactory::getSkiptaUserServiceInstance()->getCuratorAccessTokenService(Yii::app()->params['ServerURL']);
      $tokenStore = new SessionTokenStore();
      $CuratedDataFromDB = ServiceFactory::getSkiptaPostServiceInstance()->getAllCuratedTopicsService(0,$network_data['NetworkId']);
      $CuratedContentData=''; 
      if($CuratedDataFromDB['Status']!=0)
      {
      $tokenStore->storeAccessToken($network_data['CuratorAccessToken']);
      $tokenStore->storeSecret(Yii::app()->params['Curator_Consumer_Secret']);
      $scoop = new ScoopIt($tokenStore,Yii::app()->params['Curator_Callback_Url'],Yii::app()->params['Curator_Consumer_key'], Yii::app()->params['Curator_Consumer_Secret']);
      
      try
      {
  
      $CuratedNewsCollection = new CuratedNewsCollection();
      $curatedSearchCriteriaData = $CuratedNewsCollection->getSearchCriteriaForCuratedPosts($CuratedDataFromDB['TopicId'],0);
      if(is_object($curatedSearchCriteriaData))
      {
      echo "inside if";
      $CuratedContentData[] = $scoop->topic($CuratedDataFromDB['TopicId'],0,10, 0, $curatedSearchCriteriaData->PublicationTime)->curatedPosts;
      }
      else
      {
      echo "inside else";
      $CuratedContentData[] = $scoop->topic($CuratedDataFromDB['TopicId'])->curatedPosts;
      }
    
      }
      catch(Exception $e)
      { 
         echo $e->getMessage();
         $data =explode(':',stristr($e->getMessage(),'Error'));
         if($data[0]=='error"')
         {
         ServiceFactory::getSkiptaPostServiceInstance()->updateCuratedTopicService($CuratedDataFromDB['TopicId'],0);    
         }
      }
      
      foreach($CuratedContentData as $key){
        foreach ($key as $data){
     
            $curatedNewCollection  = new CuratedNewsCollection();
            $curatedNewCollection->PostId =(float)$data->id;
            $curatedNewCollection->TopicId = $data->topicId;
            $curatedNewCollection->TopicName = $CuratedDataFromDB['TopicName'];
            $curatedNewCollection->TopicImage = $CuratedDataFromDB['ImageUrl'];
            $curatedNewCollection->Title = $data->title;
            if (isset($data->htmlFragment))
            {
               $curatedNewCollection->HtmlFragment=$data->htmlFragment;
            }
            else 
                {
                  if(isset($data->imageSize))
                  {
                    if ($data->imageSize == 'big' && isset($data->largeImageUrl)) {
                       $curatedNewCollection->HtmlFragment="<img src='" . $data->largeImageUrl . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='';
                    }
                    if ($data->imageSize == 'medium' && isset($data->mediumImageUrl)) {
                        $curatedNewCollection->HtmlFragment="<img src='" . $data->mediumImageUrl . "' style='width:auto;display:inline-block'/>";
                        $curatedNewCollection->Alignment='customwidget_left';
                    }
                    if ($data->imageSize == 'small' && isset($data->smallImageUrl)) {
                       $curatedNewCollection->HtmlFragment="<img src='" . $data->smallImageUrl . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='customwidget_left';
                    }
                     if(isset($data->imageUrls))
                       {
                       $curatedNewCollection->HtmlFragment="<img src='" . $data->imageUrls[0] . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='customwidget';
                       }
                    
                  }
                  else {
                       if(isset($data->imageUrls))
                       {
                       $curatedNewCollection->HtmlFragment="<img src='" . $data->imageUrls[0] . "' style='width:auto;display:inline-block'/>";
                       $curatedNewCollection->Alignment='customwidget';
                       }
                    }
                }
            $curatedNewCollection->Description = CommonUtility::strip_tags(array('blockquote','b','strong','div'),$key->htmlContent);
            $curatedNewCollection->Description = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $curatedNewCollection->Description);
            $curatedNewCollection->Description =  preg_replace("/<p[^>]*><\\/p[^>]*>/", '', $curatedNewCollection->Description); 
            $curatedNewCollection->Description = str_replace('...','',$curatedNewCollection->Description);
            $curatedNewCollection->PublisherSource = parse_url($data->url,PHP_URL_HOST);
            $curatedNewCollection->PublisherSourceUrl=$data->url;
            $curatedNewCollection->PublicationDate = CommonUtility::millisecondsTOdate($data->publicationDate,"F j, Y, g:i A");
            $curatedNewCollection->PublicationTime = "$data->publicationDate";
            $curatedNewCollection->CreatedDate = new MongoDate($curatedNewCollection->PublicationTime/1000);;
            $curatedNewCollection->UserId = 0;
            $curatedNewCollection->NetworkId = (Int)$CuratedDataFromDB['NetworkId'];
            $curatedNewCollection->Curable =0;
            $CuratedContentDataPrepared=$curatedNewCollection;
            ServiceFactory::getSkiptaPostServiceInstance()->saveCuratedPost($CuratedContentDataPrepared);
           }
           
     }
      unset($CuratedContentData);
           }

       }
       
       public function actionConvertPublicationTime2String()
       {
           $data =  CuratedNewsCollection::model()->findAll();
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;         
             date_default_timezone_set('UTC');
           foreach ($data as $obj)
           {
                $mongoCriteria->addCond('_id', '==',$obj->_id);
                $mongoModifier->addModifier('CreatedDate', 'set',new MongoDate(($obj->PublicationTime/1000)));
                CuratedNewsCollection::model()->updateAll($mongoModifier, $mongoCriteria);
           }
       }
       
       public function actionRestoreCreatedDate()
       {
           $data =  CuratedNewsCollection::model()->findAll();
            $mongoCriteria = new EMongoCriteria;
            $mongoModifier = new EMongoModifier;         
             date_default_timezone_set('UTC');
           foreach ($data as $obj)
           {
                $mongoCriteria->addCond('_id', '==',$obj->_id);
                $mongoCriteria->addCond('Released', '==',(int)1);
                $mongoModifier->addModifier('CreatedDate', 'set',new MongoDate(($obj->PublicationTime/1000)));
                CuratedNewsCollection::model()->updateAll($mongoModifier, $mongoCriteria);
           }
       }
    
}
