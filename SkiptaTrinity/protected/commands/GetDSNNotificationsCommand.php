<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author Swathi
 * This class is used to assign badges for the existing user in the app
 */
class GetDSNNotificationsCommand extends CConsoleCommand {

    public function actionGetDSNNotifications($networkInviteId) {

        try {

            $networkInvites = NetworkInvites::model()->getNetworkInfoId($networkInviteId);
            $providerLink = "";
            $networkName="";
            if ($networkInvites != "failure" && sizeof($networkInvites) > 0) {
                $providerLink = $networkInvites->Url;
                $networkName=$networkInvites->NetworkName;
            }
            if ($providerLink != "") {
                $url = $providerLink . "/RestDSN/getDSNUsers?NetworkName=" . Yii::app()->params["NetworkName"] . "";
                //echo $url;
                $data = file_get_contents($url);
                $jsonarray = json_decode($data);
                //echo print_r($jsonarray,true);
                $restResponse = $jsonarray->data;


                if ($jsonarray->status == "success") {
                    $usersList = $restResponse->Response;
                    $url = $providerLink . "/RestDSN/getDSNCommonNotifications?NetworkName=" . Yii::app()->params["NetworkName"];
                    $commonNotificationResult = file_get_contents($url);
                    $jsonarray = json_decode($commonNotificationResult);
                    $commonNotificationData = $jsonarray->data;


                    foreach ($usersList as $user) {
                        $resultantPreparedHtml1 = "";
                        $resultantPreparedHtml2 = "";
                        $resultantPreparedHtml3 = "";
                        $resultantPreparedHtml4 = "";
                        $userObj = User::model()->getUserByType($user->Email, 'Email');
                        //echo "in for loop".print_r($userObj,true);
                        if ($userObj != "noUser") {
                            //echo "Before notifications data";

                            $commonNotificationResponse = $commonNotificationData->Response;
                           // echo print_r($commonNotificationResponse, true);
                            if ($commonNotificationResponse != "failure" && sizeof($commonNotificationResponse) > 0) {
                                foreach ($commonNotificationResponse as $notification) {
                                    $controller = new CController('post');
                                    if ($notification->NotificationType == 1) {
                                        //trending topic
                                        $resultantPreparedHtml1 = $controller->renderInternal(Yii::app()->basePath . '/views/dsnUpdates/trendingTopic.php', array("notification" => $notification), 1);
                                        //echo $resultantPreparedHtml1;
                                    }
                                    if ($notification->NotificationType == 2) {
                                        $resultantPreparedHtml2 = $controller->renderInternal(Yii::app()->basePath . '/views/dsnUpdates/newTopic.php', array("notification" => $notification), 1);
                                       // echo $resultantPreparedHtml2;
                                    }
                                    if ($notification->NotificationType == 4) {
                                        $resultantPreparedHtml3 = $controller->renderInternal(Yii::app()->basePath . '/views/dsnUpdates/newGame.php', array("notification" => $notification), 1);
                                       // echo $resultantPreparedHtml3;
                                    }
                                }
                            }
                            $url = $providerLink . "/RestDSN/getDSNUserNotifications?NetworkName=" . Yii::app()->params["NetworkName"] . "&Email=" . $user->Email;

                            $userNotificationResult = file_get_contents($url);
                            $jsonarray = json_decode($userNotificationResult);
                            $userNotificationData = $jsonarray->data;
                            // echo "Notifications Data". print_r($jsonarray,true);
                            $userNotificationResponse = $userNotificationData->Response;
                            if ($userNotificationResponse != "failure" && sizeof($userNotificationResponse)) {
                                foreach ($userNotificationResponse as $notification) {

                                    $resultantPreparedHtml4 = $controller->renderInternal(Yii::app()->basePath . '/views/dsnUpdates/newPost.php', array("notification" => $notification), 1);
                                    echo $resultantPreparedHtml4;
                                }
                            }


                           // $networkInviteInfo = NetworkInvites::model()->getNetworkInfoByType('NetworkName', 'SkiptaDiabetes');
                            $Oauth2Client = Oauth2Clients::model()->getOauth2ClientDetailsByCriteria("client_id", $networkInvites->ClientId);
                            $oauthLinkInfo = array();
                            $oauthLinkInfo['NetworkInviteId'] = $networkInvites->id;
                            $oauthLinkInfo['NetworkLogo'] = $networkInvites->NetworkLogo;
                            $oauthLinkInfo['NetworkRedirectUrl'] = $Oauth2Client->redirect_uri;
                            $oauthLinkInfo['NetworkName'] = str_replace(' ', '', Yii::app()->params['NetworkName']);
                            ;
                            $oauthLink = "<div class='pull-right paddingR5  '><a  class='btn' onclick='loginOauthOnProvider(" . '"' . $oauthLinkInfo['NetworkName'] . '",' . '"' . Yii::app()->params['ServerURL'] . '",' . '"' . $oauthLinkInfo['NetworkRedirectUrl'] . '",' . '"' . '"' . ")'> Go to ".$networkName."</a> </div>"; 
                            $description = " <div onclick='loginOauthOnProvider(" . '"' . $oauthLinkInfo['NetworkName'] . '",' . '"' . Yii::app()->params['ServerURL'] . '",' . '"' . $oauthLinkInfo['NetworkRedirectUrl'] . '",' . '"' . '"' . ")' style=' padding:5px'> <div class='dsn_notifications_div'>  <div class='clearboth'></div>";
                            $description.=$resultantPreparedHtml1 . " " . $resultantPreparedHtml2 . " " . $resultantPreparedHtml3 . " " . $resultantPreparedHtml4;

                            // $oauthLink=$controller->renderInternal(Yii::app()->basePath.'/views/dsnUpdates/oauthLink.php',array("oauthLinkInfo"=>$oauthLinkInfo),1);

                            $description = $description . " " . "</div>  </div> " . $oauthLink;
                            //echo $oauthLink;
                            if ($resultantPreparedHtml1 != "" || $resultantPreparedHtml2 != "" || $resultantPreparedHtml3 != "" || $resultantPreparedHtml4 != "")
                                CommonUtility::prepareDSNStreamObject($userObj->UserId, "Post", new MongoId(), 14, $networkName, $description, $oauthLinkInfo['NetworkLogo']);
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo "Exception _______________" . $ex->getMessage();
        }
    }

}
