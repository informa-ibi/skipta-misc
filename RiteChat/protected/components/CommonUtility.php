<?php

/**
 * Developer Name: Suresh Reddy
 * CommonUtility is the customized for common methods.
 * All  common methods need to mention here.
 */
class CommonUtility {

    /**
     * Developer Name: Suresh Reddy & HariBabu
     * this method is used for send a mail using below parameters.
     * 
     * 
     * $view  basic template file
     * $params array ,these array parames will bind with view file.
     * $subject subject of email
     * $toAddress toAddress , sender's email addresses
     * $fromAddress fromAddress of User
     */
    public $tinyObject; // this is local variable, which can accessiable in any function
   public $array = array();
    public function actionSendmail($view, $params, $subject, $recipients) {

        try {
            $fromAddress = Yii::app()->params['SendGridFromEmail'];
            $fromName = Yii::app()->params['NetworkName'];
            if (DEPLOYMENT_MODE == 'PRODUCTION') {
                $controller = new CController('YiiMail');
                if (isset(Yii::app()->controller)) {
                    $controller = Yii::app()->controller;
                }
                $resultantPreparedHtml = $controller->renderInternal(Yii::app()->basePath . '/views/mail/' . $view . '.php', $params, 1);
                $result = Yii::app()->sendgrid->sendMail($recipients, '', '', $subject, $resultantPreparedHtml, '', $fromAddress, '', $fromName, '');
                if ($result['message'] == 'success') {
                    return true;
                } else {
                    return false;
                }
            } else {
                Yii::import('ext.yii-mail.YiiMailMessage');
                Yii::app()->mail->transportOptions = array(
                    'host' => 'smtp.gmail.com',
                    'username' => 'mikeaaron8@gmail.com',
                    'password' => 'test@123',
                    'port' => '465',
                    'encryption' => 'ssl',
                );
                Yii::app()->mail->transportType = "smtp"; // Uncomment these when email is configured in admin section for Template management
                $message = new YiiMailMessage;
                $message->view = $view;
                $message->setBody($params, 'text/html');
                $message->subject = $subject;
                $message->addTo($recipients);
                $message->from = 'mikeaaron8@gmail.com';

                if (Yii::app()->mail->send($message)) {
                    error_log("========Message sent==============");
                    return true;
                } else {
                    error_log("==========Message send failed============");
                    return false;
                }
            }
        } catch (Exception $ex) {
             Yii::log($ex->getMessage(), "error", "application");
            error_log("Send Email Exception" . $ex->getMessage());
        }
    }

    /*
     * it using for given string is md5 format or not
     * $md5 is md5 format string. it's return 0 or 1
     */

    static function isValidMd5($md5 = '') {
        try {
            $md5 = strtolower($md5);
            return !empty($md5) && preg_match('/^[a-f0-9]{32}$/', $md5);
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    static function getDateFormat() {
        try {


            if (Yii::app()->params['DateFormat'] == "mm/dd/yyyy") {
                $dateFormat = "m/d/Y";
            } else if (Yii::app()->params['DateFormat'] == "dd/mm/yyyy") {
                $dateFormat = "d/m/Y";
            } else if (Yii::app()->params['DateFormat'] == "yyyy/mm/dd") {
                $dateFormat = "Y/m/d";
            } else if (Yii::app()->params['DateFormat'] == "yyyy-mm-dd") {
                $dateFormat = "Y-m-d";
            } else if (Yii::app()->params['DateFormat'] == "mm-dd-yyyy") {
                $dateFormat = "m-d-Y";
            } else if (Yii::app()->params['DateFormat'] == "dd-mm-yyyy") {
                $dateFormat = "d-m-Y";
            }
            $dateFormat = Yii::app()->params['PHPDateFormat'];

            return $dateFormat;
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    static function get_highest($arr) {
        foreach ($arr as $key => $val) {

            if (is_array($val))
                $arr[$key] = CommonUtility::get_highest($val);
        }

        sort($arr);

        return array_pop($arr);
    }

    /*     * it's return index of action type
     * 
     * send a context type
     * 
     */

    static function getIndexByActionType($type = '') {
        try {
            $index = 0;
            if ($type == 'Post') {
                $index = 1;
            }
            if ($type == 'Follow') {
                $index = 2;
            }
            if ($type == 'Comment') {
                $index = 3;
            }
            if ($type == 'Like') {
                $index = 3;
            }
            if ($type == 'Share') {
                $index = 4;
            }
            return $index;
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    static function getUserActivityIndexByActionType($type = '') {
        try {
            $index = 0;
            if ($type == 'PostCreated') {
                $index = 2;
            } else if ($type == 'HashTagCreation') {
                $index = 1;
            } else if ($type == 'Love') {
                $index = 1;
            } else if ($type == 'Comment') {
                $index = 1;
            } else if ($type == 'Follow') {
                $index = 1;
            } else if ($type == 'UnFollow') {
                $index = 1;
            } else if ($type == 'Share') {
                $index = 1;
            } else if ($type == 'Invite') {
                $index = 1;
            } else if ($type == 'SurveySubmit') {
                $index = 1;
            } else if ($type == 'Login') {
                $index = 1;
            } else if ($type == 'HashtagUsed') {
                $index = 1;
            } else if ($type == 'MentionUsed') {
                $index = 1;
            } else if ($type == 'ProjectSearch') {
                $index = 1;
            } else if ($type == 'CategoryFilter') {
                $index = 1;
            } else if ($type == 'PostDetailOpen') {
                $index = 1;
            } else if ($type == 'Stream') {
                $index = 1;
            } else if ($type == 'Curbside') {
                $index = 1;
            } else if ($type == 'Group') {
                $index = 1;
            } else if ($type == 'Profile') {
                $index = 1;
            } else if ($type == 'Chat') {
                $index = 1;
            } else if ($type == 'Notification') {
                $index = 1;
            } else if ($type == 'History') {
                $index = 1;
            } else if ($type == 'Settings') {
                $index = 1;
            } else if ($type == 'GroupCreation') {
                $index = 2;
            } else if ($type == 'GroupDetail') {
                $index = 1;
            } else if ($type == 'SubGroupDetail') {
                $index = 1;
            } else if ($type == 'GroupMinPopup') {
                $index = 1;
            } else if ($type == 'SubGroupMinPopup') {
                $index = 1;
            } else if ($type == 'EventAttend') {
                $index = 1;
            } else if ($type == 'Loaded') {
                $index = 1;
            } else if ($type == 'Scroll') {
                $index = 1;
            } else if ($type == 'HashTagMinPopup') {
                $index = 1;
            } else if ($type == 'MentionMinPopup') {
                $index = 1;
            } else if ($type == 'ProfileMinPopup') {
                $index = 1;
            } else if ($type == 'CurbCategoryMinPopup') {
                $index = 1;   //done
            } else if ($type == 'PostDelete') {
                $index = 1;   //done
            } else if ($type == 'PostPromote') {
                $index = 1;   //done
            } else if ($type == 'PostFlagAbuse') {
                $index = 1;   //done
            } else if ($type == 'PostFeatured') {
                $index = 1;   //done
            } else if ($type == 'HashTagSearch') {
                $index = 1;
            }
            else if ($type == 'HashTagUsage') {
                $index = 1;
            }
            return $index;
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    static function getProjectSearchTypeIndex($searchType = '') {
        try {

            $index = 0;

            if ($searchType == 'profile') {
                $index = 1;
            } else if ($searchType == 'group') {
                $index = 2;
            } else if ($searchType == 'subgroup') {
                $index = 3;
            }


            return $index;
        } catch (Exception $ex) {
            
        }
    }

    static function getPageIndex($page = '') {
        try {
            if ($page == 'HomeStream') {
                $index = 1;
            } else if ($page == 'CurbStream') {
                $index = 2;
            } else if ($page == 'GroupStream') {
                $index = 3;
            } else if ($page == 'SubGroupStream') {
                $index = 4;
            } else if ($page == 'ProfileStream') {
                $index = 5;
            } else if ($page == 'Post') {
                $index = 6;
            } else if ($page == 'HashTag') {
                $index = 7;
            } else if ($page == 'Mention') {
                $index = 8;
            } else if ($page == 'ProjectSearch') {
                $index = 9;
            } else if ($page == 'Group') {
                $index = 10;
            } else if ($page == 'SubGroup') {
                $index = 11;
            } else if ($page == 'PostDetail') {
                $index = 13;
            } else if ($page == 'News') {
                $index = 14;
            } else if ($page == 'Game') {
                $index = 15;
            }
            return $index;
        } catch (Exception $ex) {
            
        }
    }

    static function getUserActivityContextIndexByActionType($type = '') {
        try {
            $index = 0;
            if ($type == 'Login') {
                $index = 1;
            } else if ($type == 'PostCreated') {
                $index = 2;   //done
            } else if ($type == 'PostHashTagCreation') {
                $index = 3;   //done
            } else if ($type == 'CurbPostHashTagCreation') {
                $index = 4;
            } else if ($type == 'GroupHashTagCreation') {
                $index = 5;
            } else if ($type == 'CommentHashTagCreation') {
                $index = 6;
            } else if ($type == 'PostHashTagUsed') {
                $index = 7;   //done
            } else if ($type == 'CurbPostHashTagUsed') {
                $index = 8;   ///done
            } else if ($type == 'GroupHashTagUsed') {
                $index = 9;
            } else if ($type == 'CommentHashTagUsed') {
                $index = 10;
            } else if ($type == 'PostMentionUsed') {
                $index = 11;
            } else if ($type == 'CurbPostMentionUsed') {
                $index = 12;
            } else if ($type == 'GroupPostMentionUsed') {
                $index = 13;
            } else if ($type == 'CommentMentionUsed') {
                $index = 14;
            } else if ($type == 'InviteMentionUsed') {
                $index = 15;
            } else if ($type == 'Love') {
                $index = 16;
            } else if ($type == 'Comment') {
                $index = 17;
            } else if ($type == 'Follow') {
                $index = 18;   //done
            } else if ($type == 'UnFollow') {
                $index = 19;   //done
            } else if ($type == 'FBShare') {
                $index = 20;
            } else if ($type == 'TwitterShare') {
                $index = 21;
            } else if ($type == 'Invite') {
                $index = 22;
            } else if ($type == 'ProjectSearch') {
                $index = 23; //done  
            } else if ($type == 'HashTagMinPopup') {
                $index = 24;   //done
            } else if ($type == 'MentionMinPopup') {
                $index = 25;   //done
            } else if ($type == 'HashTagFilter') {
                $index = 26;   //done
            } else if ($type == 'CategoryFilter') {
                $index = 27;   //done
            } else if ($type == 'PostDetailOpen') {
                $index = 28;   //done
            } else if ($type == 'Stream') {
                $index = 29;
            } else if ($type == 'Curbside') {
                $index = 30;
            } else if ($type == 'Group') {
                $index = 31;
            } else if ($type == 'Profile') {
                $index = 32;
            } else if ($type == 'GroupFollow') {
                $index = 33;
            } else if ($type == 'GroupUnFollow') {
                $index = 34;
            } else if ($type == 'CurbsideCategoryFollow') {
                $index = 35;
            } else if ($type == 'CurbsideCategoryUnFollow') {
                $index = 36;
            } else if ($type == 'HashTagFollow') {
                $index = 37;
            } else if ($type == 'HashTagUnFollow') {
                $index = 38;
            } else if ($type == 'UserFollow') {
                $index = 39;
            } else if ($type == 'UserUnFollow') {
                $index = 40;
            } else if ($type == 'StreamScroll') {
                $index = 41;
            } else if ($type == 'CurbsideScroll') {
                $index = 42;
            } else if ($type == 'GroupScroll') {
                $index = 43;
            } else if ($type == 'ProfileScroll') {
                $index = 44;
            } else if ($type == 'Chat') {
                $index = 45;
            } else if ($type == 'Notification') {
                $index = 46;
            } else if ($type == 'History') {
                $index = 47;
            } else if ($type == 'Settings') {
                $index = 48;
            } else if ($type == 'GroupCreation') {
                $index = 49;
            } else if ($type == 'GroupDetail') {
                $index = 50;
            } else if ($type == 'SubGroupDetail') {
                $index = 51;
            } else if ($type == 'GroupStream') {
                $index = 52;
            } else if ($type == 'CurbStream') {
                $index = 53;
            } else if ($type == 'GroupMedia/Resource') {
                $index = 54;
            } else if ($type == 'SubGroupStream') {
                $index = 55;
            } else if ($type == 'SubGroupMedia/Resource') {
                $index = 56;
            } else if ($type == 'GroupMinPopup') {
                $index = 57;
            } else if ($type == 'SubGroupMinPopup') {
                $index = 58;
            } else if ($type == 'SubGroupFollow') {
                $index = 59;   //done
            } else if ($type == 'SubGroupUnFollow') {
                $index = 60;
            } else if ($type == 'EventAttend') {
                $index = 61;
            } else if ($type == 'SurveySubmit') {
                $index = 62;   //done
            } else if ($type == 'Loaded') {
                $index = 63;   //done
            } else if ($type == 'Scroll') {
                $index = 64;   //done
            } else if ($type == 'ProfileMinPopup') {
                $index = 65;   //done
            } else if ($type == 'CurbCategoryMinPopup') {
                $index = 66;   //done
            } else if ($type == 'PostDelete') {
                $index = 67;   //done
            } else if ($type == 'PostPromote') {
                $index = 68;   //done
            } else if ($type == 'PostFlagAbuse') {
                $index = 69;   //done
            } else if ($type == 'PostFeatured') {
                $index = 70;   //done
            } else if ($type == 'HashTagSearch') {
                $index = 71;   //done
            }
            else if ($type == 'HashTagUsage') {
                $index = 72;   //done
            }

            return $index;
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    /*     * it's return index of getIndexBySystemCategoryType 
     * 
     * send a context type
     * 
     */

    static function getIndexBySystemCategoryType($type = '') {
        try {
            $index = 0;
            if ($type == 'Normal') {
                $index = 1;
            }
            if ($type == 'Curbside') {
                $index = 2;
            }
            if ($type == 'Group') {
                $index = 3;
            }

            if ($type == 'User') {
                $index = 4;
            }
            if ($type == 'HashTag') {
                $index = 5;
            }
            if ($type == 'CurbsideCategory') {
                $index = 6;
            }
            if ($type == 'SubGroup') {
                $index = 7;
            }if ($type == 'News') {
                $index = 8;
            }
            if ($type == 'Game') {
                $index = 9;
            }
              if ($type == 'Badge') {
                $index = 10;
            }
              if ($type == 'NetworkInvite') {
                $index = 11;
            }
         
              if ($type == 'CV') {
                $index = 12;
            }

            if ($type == 'Advertisement') {
                $index = 13;
            }

            return $index;
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    /*     * it's return index of getIndexBySystemCategoryType 
     * 
     * send a context type
     * 
     */

    public static function getIndexBySystemFollowingThing($type = '') {
        try {
            $index = 0;
            if ($type == 'Post') {
                $index = 1;
            }
            if ($type == 'Group') {
                $index = 2;
            }
            if ($type == 'User') {
                $index = 3;
            }
            if ($type == 'HashTag') {
                $index = 4;
            }
            if ($type == 'CurbsideCategory') {
                $index = 5;
            }
            if ($type == 'SubGroup') {
                $index = 6;
            }

            return $index;
        } catch (Exception $e) {
            Yii::log("Exception ::: " . $e->getMessage(), "error", "application");
        }
    }

    /*     * return post type of integer 
     * param $type is type post like 'normalpost' ,etc.
     * 
     */

    public static function sendPostType($type) {
        try {

            $returnValue = 0;
            if ($type == 'Normal Post') {
                $returnValue = 1;
            } else if ($type == 'Event') {
                $returnValue = 2;
            } else if ($type == 'Survey') {
                $returnValue = 3;
            } else if ($type == 'Anonymous') {
                $returnValue = 4;
            } else if ($type == 'CurbsidePost') {
                $returnValue = 5;
            } else if ($type == 'User') {
                $returnValue = 6;
            } else if ($type == 'HashTag') {
                $returnValue = 7;
            } else if ($type == 'CurbsideCategory') {
                $returnValue = 8;
            } else if ($type == 'Group') {
                $returnValue = 9;
            } else if ($type == 'SubGroup') {
                $returnValue = 10;
            } else if ($type == 'News') {
                $returnValue = 11;
            } else if ($type == 'Game') {
                $returnValue = 12;
            }
            else if ($type == 'Badge') {
                $returnValue = 13;
            }
            else if ($type == 'NetworkInvite') {
                $returnValue = 14;
            }
             else if ($type == 'CV') {
                $returnValue = 15;
            }

             else if ($type == 'Advertisement') {
                $returnValue = 16;
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("send post type in common utility" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @param type $type
     * @return int
     */
    static function postTypebyIndex($type, $isGroupCategory = 0) {
        try {

            $returnValue = 0;
            if ($type == 1) {
                $returnValue = ' a Post';
            } else if ($type == 2) {
                $returnValue = ' an Event ';
            } else if ($type == 3) {
                $returnValue = 'a Survey ';
            } else if ($type == 4) {
                // Anonymous Post
                $returnValue = ' a Post ';
            } else if ($type == 11) {
                // Anonymous Post
                $returnValue = ' a News';
            } else if ($type == 5) {
                $name = Yii::t('translation', 'CurbsideConsult');
                $returnValue = " a $name";
            } else if ($type == 6) {
                $returnValue = ' a Group ';
            } else if ($type == 7) {
                $returnValue = ' a Sub Group ';
            } else if ($type == 12) {
                $returnValue = ' a Game ';
            }
            else if ($type == 13) {
                $returnValue = ' a Badge ';
            }
            else if ($type == 14) {
                $returnValue = ' Network';
            }
              else if ($type == 16) {
                $returnValue = ' Advertisement';
            }

            
             else if ($type == 15) {
                $returnValue = ' CV ';
            }

            if ($isGroupCategory == 3) {
                if ($type == 1) {
                    $returnValue = ' a Group Post';
                } else if ($type == 2) {
                    $returnValue = ' a Group Event ';
                } else if ($type == 3) {
                    $returnValue = 'a  Group Survey ';
                }
            }
            if ($isGroupCategory == 7) {
                if ($type == 1) {
                    $returnValue = ' a Sub Group Post';
                } else if ($type == 2) {
                    $returnValue = ' a Sub Group Event ';
                } else if ($type == 3) {
                    $returnValue = 'a  Sub Group Survey ';
                }
            }


            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("send post type in common utility" . $exc->getMessage(), 'error', 'application');
        }
    }

    /**
     * 
     * @param type $type
     * @return int
     */
    static function actionTextbyActionType($type) {
        try {
            $returnValue = 0;
            if ($type == 1) {
                //normal post type
                $returnValue = ' made  ';
            } else if ($type == 2) {
                //Event post type
                $returnValue = ' created  ';
            } else if ($type == 3) {
                //survery post type
                $returnValue = ' posted  ';
            } else if ($type == 4) {
                //anonymous post  type
                $returnValue = ' made  ';
            } else if ($type == 5) {
                //curbsidepost type
                $returnValue = '  posted  ';
            } else if ($type == 11) {
                //curbsidepost type
                $returnValue = ' posted ';
            } else if ($type == 12) {
                //game
                $returnValue = ' scheduled ';
            }
            else if ($type == 13) {
                //game
                $returnValue = ' unlocked ';
            }
            else if ($type == 14) {
                //game
                $returnValue = ' Join the ';
            }
            
              else if ($type == 15) {
                //game
                $returnValue = ' updated ';
            }
            
            else if ($type == 'Follow') {
                $returnValue = ' is following ';
            } else if ($type == 'Comment') {
                $returnValue = ' commented on  ';
            } else if ($type == 'UserMention') {
                $returnValue = ' mentioned you in ';
            } else if ($type == 'HashTag') {
                $returnValue = ' on a hashtag  ';
            } else if ($type == 'UserFollow') {
                $returnValue = ' has following   ';
            } else if ($type == 'EventAttend') {
                $returnValue = ' is attending   ';
            } else if ($type == 'Invite') {
                $returnValue = ' has been invited to ';
            } else if ($type == 'Survey') {
                $returnValue = ' has answered   ';
            } else if ($type == 'UserFollow') {
                $returnValue = ' is following  ';
            } else if ($type == 'UserUnFollow') {
                $returnValue = ' is Unfollowing  ';
            } else if ($type == 'GroupFollow') {
                $returnValue = ' is following  ';
            } else if ($type == 'GroupUnFollow') {
                $returnValue = ' is Unfollowing  ';
            } else if ($type == 'HashTagFollow') {
                $returnValue = ' is following  ';
            } else if ($type == 'HashTagUnFollow') {
                $returnValue = ' is Unfollowing  ';
            } else if ($type == 'CurbsideCategoryFollow') {
                $returnValue = ' is following  ';
            } else if ($type == 'CurbsideCategoryUnFollow') {
                $returnValue = ' is Unfollowing  ';
            } else if ($type == 'Love') {
                $returnValue = ' loved ';
            } else if ($type == 'FbShare' || $type == 'TwitterShare') {
                $returnValue = ' shared ';
            } else if ($type == 'SubGroupFollow') {
                $returnValue = ' is following  ';
            } else if ($type == 'SubGroupUnFollow') {
                $returnValue = ' is Unfollowing  ';
            } else if ($type == 'Play') {
                $returnValue = ' has Played  ';
            } else if ($type == 'Resume') {
                $returnValue = ' have Paused ';
            }
            else if ($type == 'Resume') {
                $returnValue = ' are Paused ';
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("send post type in common utility" . $exc->getMessage(), 'error', 'application');
        }
    }

    static function styleDateTime($timestamp, $type = "web") {
        $text = date("d-m-Y h:i:s A", $timestamp);
        $difference = time() - $timestamp;
        $periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
        if ($type == "mobile") {
            $periods = array("s", "m", "h", "d", "w", "mo", "y", "decade");
        }

        $lengths = array("60", "60", "24", "7", "4.35", "12", "10", "100");
        if ($difference >= 0) { // this was in the past time
            $ending = "ago";
            $j = 0;
            for (; $difference >= $lengths[$j]; $j++) {
                $difference /= $lengths[$j];
            }
            $difference = round($difference);
            if ($j < 8) {
                if ($difference != 1 && $type == "web") {
                    $periods[$j].= "s";
                }
                if (($j == 0 && $difference < 5) && $type == "web") {
                    $difference = "few";
                }
                if ($type == "mobile") {

                    $ending = "";
                    $text = "$difference"."$periods[$j] $ending";
                }else{
                    $text = "$difference $periods[$j] $ending";
                }
                
            }
        } else { // this was in the future time
            $ending = "to go";
            $j = 0;
            $difference = abs($difference);
            for (; $difference >= $lengths[$j]; $j++) {
                $difference /= $lengths[$j];
            }
            $difference = round($difference);
            if ($j < 8) {
                if ($difference != 1 && $type == "web") {
                    $periods[$j].= "s";
                }
                if (($j == 0 && $difference < 5) && $type == "web") {
                    $difference = "few";
                }

                 if($type=="mobile"){
                    $ending="";
                    $text = "$difference"."$periods[$j] $ending";
                }else{
                    $text = "$difference $periods[$j] $ending";

                }
            }

            // $text = date(Yii::app()->params['PHPDateFormat'], $timestamp);
        }

        return $text;
    }

    static function prepareHashTagsArray($hashtagString) {
        $hashTagArray = array();
        $explosion = explode("#", strstr($hashtagString, '#'));
        $count = count($explosion);
        $hashtags = "";
        for ($i = 0; $i < $count; $i++) {
            if (strlen($explosion[$i]) > 2) {
                $explosion2 = explode(" ", $explosion[$i]);
                $explosion2 = explode(" ", $explosion2[0]); //it is a special character
                $explosion2 = $explosion2[0];
                $hashtags.="," . $explosion2;
            }
        }
        $hashtags = substr($hashtags, 1);
        if (strlen($hashtags) > 0) {
            $hashTagArray = explode(",", $hashtags);
            $hashTagArray = array_unique($hashTagArray);
        }
        return $hashTagArray;
    }

    static function prepareAtMentionsArray($atMentions) {
        $atMentionArray = array();
        $atMentions = strlen($atMentions) > 0 ? substr($atMentions, 1) : "";
        if (strlen($atMentions) > 0) {
            $atMentionArray = array_unique(array_map('intval', explode(",", $atMentions)));
        }
        return $atMentionArray;
    }

    /**
     * @author Sagar pathepalli 
     * @param type $streamPostData
     * @return array
     * 
     */
    static function prepareStreamData($UserId, $streamPostData, $UserPrivileges, $isHomeStream = 0, $PostAsNetwork = 0, $timezone = '', $previousStreamIdArray=array()) {

        try {
            $streamIdArray = array();
             $zeroRecordArray=array();
             $oneRecordArray=array();
             $currentStreamIdArray = array();
             $totalStreamIdArray = array();
            foreach ($streamPostData as $key=>$data){


                array_push($totalStreamIdArray, (string)$data->PostId);
                 if (in_array("$data->PostId", $currentStreamIdArray)) {                                                    
                               unset($streamPostData[$key]);
                               continue;
                           
                       }
                       
             //Advertisements filtaring start
                if(isset($data->DisplayPage) && $data->AdType!=1){
                    if($isHomeStream==1 && $data->DisplayPage!="Home"){
                      unset($streamPostData[$key]);
                       continue;  
                    }
                    
                    else if($isHomeStream==2 && $data->DisplayPage!="Group"){
                      unset($streamPostData[$key]);
                      continue;   
                    }
                    else if($isHomeStream==3 && $data->DisplayPage!="Curbside"){
                      unset($streamPostData[$key]);
                      continue;   
                    }
        
                   if($data->DisplayPage=="Group"){
                       $reg='/'.$_GET['groupId'].'/';
                       if($data->Groups!="AllGroups" && !preg_match($reg,$data->Groups) ){
                          unset($streamPostData[$key]);
                          continue; 
                       }  
                    }
                    
                }
                //Advertisements filtaring end
                array_push($totalStreamIdArray, (string)$data->PostId);
                if (!in_array((string)$data->PostId, $previousStreamIdArray)) {
                $recentActivityUser2="";
                $isPromoted = isset($data->IsPromoted)?$data->IsPromoted:0;
                $data->IsIFrameMode = 0;
                if ($data->CategoryType == 3) {
                    if (isset($data->GroupId)) {

                        $groupData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        if ($groupData != "failure") {
                            $data->IsFollowingEntity = in_array($UserId, $groupData->GroupMembers);
                            if ($groupData->IsPrivate == 1 && $isHomeStream == 1 && $data->IsFollowingEntity == 0) {

                                unset($streamPostData[$key]);
                                continue;
                            }
                            $isIframeModeValue = (isset($groupData->IsIFrameMode) && $groupData->IsIFrameMode == 1) ? 1 : 0;
                            if ($isIframeModeValue == 1 && in_array($UserId, $groupData->GroupMembers) || ($groupData->CustomGroup == 1 && $groupData->IsHybrid == 0)) {

                                $data->IsIFrameMode = 1;//then it is  a iframe group
                                $data->IsNativeGroup=1; //then it is custom or iframe group
                            }
                            $data->GroupName = $groupData->GroupName;
                            $data->MainGroupId = $groupData->_id;
                            $data->GroupImage = $groupData->GroupProfileImage;
                            $data->IsPrivate = $groupData->IsPrivate;

                            if (in_array($data->OriginalUserId, $groupData->GroupAdminUsers)) {
                                $data->isGroupAdminPost = 'true';
                            }
                            /***** ConversationVisibility settings *****/
                            if($groupData->DisableWebPreview == 1){
                                   $data->DisableWebPreview = 1;
                            }
                            if($groupData->ConversationVisibility == 1){
                                    $data->IsIFrameMode = 1;
                            }
                            if ($data->IsIFrameMode != 1) {
                                $data->GroupImage = $groupData->GroupProfileImage;
                              
                                /* for more */                                
                                $tagsFreeDescription = strip_tags(($groupData->GroupDescription));
                                $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);

                                $descriptionLength = strlen($tagsFreeDescription);
                                
                                /* for more */


                                if ($descriptionLength > 240) {
                                    $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                                    $data->GroupDescription = trim($description) . "  ...";
                                } else {
                                    $data->GroupDescription = $groupData->GroupDescription;
                                }



                                $data->GroupFollowersCount = sizeof($data->PostFollowers);
                                $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);


                                if ($data->isDerivative == 0) {
                                    if ($isHomeStream == 1 && (!($data->IsFollowingEntity) || $isPromoted == 1)) {
                                        unset($streamPostData[$key]);
                                        continue;
                                    }
                                } else {
                                    
                                }
                                }
                                if (isset($groupData->AddSocialActions)) {
                                        $data->AddSocialActions = $groupData->AddSocialActions;
                                    }
                        }
                    }
                }
                if ($data->CategoryType == 7) {
                    if (isset($data->SubGroupId)) {

                        $groupData = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                        $gData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        if ($groupData != "failure") {
                            $data->SubGroupImage = $groupData->SubGroupProfileImage;
                            $data->SubGroupName = $groupData->SubGroupName;
                            $data->GroupName = $gData->GroupName;
                             if($groupData->DisableWebPreview == 1){
                                   $data->DisableWebPreview = 1;
                            }

                            /* for more */
                            $tagsFreeDescription = strip_tags(($groupData->SubGroupDescription));
                            $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);

                            $descriptionLength = strlen($tagsFreeDescription);
                            /* for more */

                            if ($descriptionLength > 240) {
                                $description = CommonUtility::truncateHtml($groupData->SubGroupDescription, 240);
                                $data->SubGroupDescription = trim($description) . "  ...";
                            } else {
                                $data->SubGroupDescription = $groupData->SubGroupDescription;
                            }


                            $data->SubGroupFollowersCount = sizeof($groupData->SubGroupMembers);
                            $data->IsFollowingEntity = in_array($UserId, $groupData->SubGroupMembers);
                            if ($data->isDerivative == 0) {
                                if ($isHomeStream == 1 && (!($data->IsFollowingEntity) || $isPromoted == 1)) {
                                    unset($streamPostData[$key]);
                                    continue;
                                }
                            }
                           if (isset($groupData->AddSocialActions)) {
                                    $data->AddSocialActions = $groupData->AddSocialActions;
                                }
                            }
                    }
                }

                $data->IsPromoted = $isPromoted;

                if ($data->CategoryType == 9) {
                    try {
                        if ($data->UserId == 0) {
                            if (count($oneRecordArray) > 0) {
                                $key_1 = array_search($data->PostId, $oneRecordArray);
                                if (is_int($key_1)) {
                                    unset($streamPostData[$key]);
                                    continue;
                                }
                            }
                            $zeroRecordArray[$key] = $data->PostId;
                        } else {
                            $oneRecordArray[$key] = $data->PostId;
                            if (count($zeroRecordArray) > 0) {
                                $key12 = array_search($data->PostId, $zeroRecordArray);
                                if (is_int($key12)) {
                                    unset($streamPostData[$key12]);
                                    //continue;
                                }
                            }
                        }
                        $sDate = strtotime($data->StartDate);
                        $gameUserStatus = ScheduleGameCollection::model()->findUserGameStatus($UserId, $data->CurrentGameScheduleId, $data->StartDate);
                        $gameScheduls = ScheduleGameCollection::model()->getSchedulesForGame($data->PostId);
                        if (!is_string($gameScheduls)) {
                            $data->SchedulesArray = $gameScheduls;
                        } else {
                            $data->SchedulesArray = 'noschedules';
                        }
                        $data->GameStatus = $gameUserStatus;

                        /** this is logic for Previous Schedules */
                        $previousSchedule = $data->PreviousGameScheduleId;
                        if (isset($previousSchedule) && $previousSchedule != null) {
                            $gameUserStatusForPreviousSchedule = ScheduleGameCollection::model()->findUserGameStatusForPreviousSchedule($UserId, $previousSchedule, $data->StartDate);

                            $data->PreviousGameStatus = $gameUserStatusForPreviousSchedule;
                        }

                        if ($UserId == $data->OriginalUserId) {
                            $data->GameAdminUser = 1;
                        } else {
                            $data->GameAdminUser = 0;
                        }
                    } catch (Exception $exc) {
                        
                    }
                }else {
                    if (sizeof($streamIdArray) > 0) {
                        if (array_key_exists("$data->PostId", $streamIdArray)) {
                            if ($streamIdArray["$data->PostId"] == $isPromoted) {
                                unset($streamPostData[$key]);
                                continue;
                            }
                        }
                    }
                }


                $streamIdArray["$data->PostId"] = $isPromoted;
                $data->SessionUserId = $UserId;
                $data->CanDeletePost = ($data->OriginalUserId == $data->SessionUserId) ? 1 : 0;
                if (is_array($UserPrivileges)) {
                    foreach ($UserPrivileges as $value) {
                        if ($value['Status'] == 1) {
                            if ($value['Action'] == 'Delete') {
                                $data->CanDeletePost = 1;
                            } else if ($value['Action'] == 'Promote_Post') {
                                $data->CanPromotePost = 1;
                            } else if ($value['Action'] == 'Promote_To_Featured_Items') {
                                $data->CanFeaturePost = 1;
                            } else if ($value['Action'] == 'Mark_As_Abuse') {
                                $data->CanMarkAsAbuse = 1;
                            }
                              else if ($value['Action'] == 'Can_Copy_URL') {
                                $data->CanCopyURL=1;
                            }
                            
                        
                        }
                    }
                }

                $createdOn = $data->CreatedOn;
                $originalPostTime = $data->OriginalPostTime;
                if ($isPromoted == 1) {
                    $data->PostOn = CommonUtility::styleDateTime($originalPostTime->sec);
                    $data->PromotedDate = CommonUtility::styleDateTime($createdOn->sec);
                    $currentDate = date('Y-m-d', time());
                    $postPromotedDate = date('Y-m-d', $createdOn->sec);
                    if ($postPromotedDate < $currentDate) {
                        $data->IsPromoted = 0;
                    }
                    if ($data->CanPromotePost == 1) {
                        if ($postPromotedDate > $currentDate) {
                            //   $data->CanPromotePost=0;
                        }
                    }
                } else {

                    $data->PostOn = CommonUtility::styleDateTime($createdOn->sec);

                }
                $data->OriginalPostPostedOn = CommonUtility::styleDateTime($originalPostTime->sec);
                $textWithOutHtml = $data->PostText;

                $textLength = strlen($textWithOutHtml);
                if (isset($data->WebUrls) && !empty($data->WebUrls) && $data->WebUrls != null) {
                    if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') {
                        $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($data->WebUrls[0]);

                        $data->WebUrls = $snippetdata;
                    } else {
                        $data->WebUrls = "";
                    }
                }


                if (isset($data->PostTextLength) && $data->PostTextLength > 240 && $data->PostTextLength < 500) {
                    $appendData = '<span class="seemore tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="See More" onclick="expandpostDiv(' . "'" . $data->_id . "'" . ')"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                } else {

                    $appendData = ' <span class="postdetail tooltiplink" data-id=' . $data->_id . ' data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                }

                $data->PostCompleteText = $data->PostText;
                if ($data->PostTextLength > 240) {
                    $description = CommonUtility::truncateHtml($data->PostText, 240, '...', true, true, $appendData);

                    $text = $description;
                    if($isHomeStream==1 && $data->IsNativeGroup==1)
                         $data->PostText = $data->PostText;
                    else{
                           $data->PostText = $text;
                    }
                }
                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->OriginalUserId);
                $postType = CommonUtility::postTypebyIndex($data->PostType, $data->CategoryType);
                if($data->CategoryType!=13){
                 $data->PostTypeString = $postType;    
                }              
                $createdOn = $data->CreatedOn;
                $originalPostTime = $data->OriginalPostTime;
                $recentActivity1UserId = "";
                $recentActivity2UserId = "";
                if ($data->RecentActivity == "Post") {
                    $recentActivity1UserId = $data->OriginalUserId;
                    $recentActivity2UserId = "";
                }

                elseif ($data->RecentActivity == "UserMention") {
                    $recentActivity1UserId = $data->MentionUserId;
                } elseif ($data->RecentActivity == "Love") {
                    $LoveUserId = array_values(array_unique($data->LoveUserId));
                    if (sizeof($LoveUserId) > 1) {
                        $recentActivity1UserId = $LoveUserId[sizeof($LoveUserId) - 1];
                        $recentActivity2UserId = $LoveUserId[sizeof($LoveUserId) - 2];
                    } elseif (sizeof($LoveUserId) == 1) {
                        $recentActivity1UserId = $LoveUserId[sizeof($LoveUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "Comment") {
                    $CommentUserId =  array_values(array_unique(array_reverse($data->CommentUserId)));
                    $CommentUserId =  array_reverse($CommentUserId);
                    if (sizeof($CommentUserId) > 1) {
                        $recentActivity1UserId = $CommentUserId[sizeof($CommentUserId) - 1];
                        $recentActivity2UserId = $CommentUserId[sizeof($CommentUserId) - 2];
                    } elseif (sizeof($CommentUserId) == 1) {
                        $recentActivity1UserId = $CommentUserId[sizeof($CommentUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "UserFollow") {

                    $FollowUserId = array_values(array_unique($data->UserFollowers));
                    if (count($FollowUserId) > 1) {
                        $recentActivity1UserId = $FollowUserId[sizeof($FollowUserId) - 1];
                        $recentActivity2UserId = $FollowUserId[sizeof($FollowUserId) - 2];
                    } elseif (sizeof($FollowUserId) == 1) {
                        $recentActivity1UserId = $FollowUserId[sizeof($FollowUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "PostFollow") {
                    //  $PostFollow = array_values(array_unique($data->PostFollowers));
                    $PostFollow =  array_values(array_unique(array_reverse($data->PostFollowers)));
                    $PostFollow =  array_reverse($PostFollow);
                    if (count($PostFollow) > 1) {
                        $recentActivity1UserId = $PostFollow[sizeof($PostFollow) - 1];
                        $recentActivity2UserId = $PostFollow[sizeof($PostFollow) - 2];
                    } elseif (sizeof($PostFollow) == 1) {
                        $recentActivity1UserId = $PostFollow[sizeof($PostFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "EventAttend") {
                    $EventAttendes = array_values(array_unique($data->EventAttendes));
                    if (sizeof($EventAttendes) > 1) {
                        $recentActivity1UserId = $EventAttendes[sizeof($EventAttendes) - 1];
                        $recentActivity2UserId = $EventAttendes[sizeof($EventAttendes) - 2];
                    } elseif (sizeof($EventAttendes) == 1) {
                        $recentActivity1UserId = $EventAttendes[sizeof($EventAttendes) - 1];
                    }
                } elseif ($data->RecentActivity == "Invite") {
                    $InviteUsers = array_values(array_unique($data->InviteUsers));
                    if (sizeof($InviteUsers) > 1) {
                        $recentActivity1UserId = $InviteUsers[sizeof($InviteUsers) - 1];
                        $recentActivity2UserId = $InviteUsers[sizeof($InviteUsers) - 2];
                    } elseif (sizeof($InviteUsers) == 1) {
                        $recentActivity1UserId = $InviteUsers[sizeof($InviteUsers) - 1];
                    }
                } elseif ($data->RecentActivity == "Survey") {
                    $SurveyTaken = array_values(array_unique($data->SurveyTaken));
                    if (sizeof($SurveyTaken) > 1) {
                        $recentActivity1UserId = $SurveyTaken[sizeof($SurveyTaken) - 1];
                        $recentActivity2UserId = $SurveyTaken[sizeof($SurveyTaken) - 2];
                    } elseif (sizeof($SurveyTaken) == 1) {
                        $recentActivity1UserId = $SurveyTaken[sizeof($SurveyTaken) - 1];
                    }
                } elseif ($data->RecentActivity == "GroupFollow") {
                    $GroupFollow = array_values(array_unique($data->GroupFollowers));
                    if (sizeof($GroupFollow) > 1) {
                        $recentActivity1UserId = $GroupFollow[sizeof($GroupFollow) - 1];
                        $recentActivity2UserId = $GroupFollow[sizeof($GroupFollow) - 2];
                    } elseif (sizeof($GroupFollow) == 1) {
                        $recentActivity1UserId = $GroupFollow[sizeof($GroupFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "CurbsideCategoryFollow") {
                    $CurbsideFollow = array_values(array_unique($data->CurbsideCategoryFollowers));
                    if (sizeof($CurbsideFollow) > 1) {
                        $recentActivity1UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 1];
                        $recentActivity2UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 2];
                    } elseif (sizeof($CurbsideFollow) == 1) {
                        $recentActivity1UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "HashTagFollow") {
                    $recentActivity1UserId = $data->HashTagPostUserId;
                    $HashTagFollow = array_values(array_unique($data->HashTagFollowers));
                    if (sizeof($HashTagFollow) > 1) {
                        $recentActivity1UserId = $HashTagFollow[sizeof($HashTagFollow) - 1];
                        $recentActivity2UserId = $HashTagFollow[sizeof($HashTagFollow) - 2];
                    } elseif (sizeof($HashTagFollow) == 1) {
                        $recentActivity1UserId = $HashTagFollow[sizeof($HashTagFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "Play") {
                    if (isset($data->CurrentScheduledPlayers)) {
                        // $PlayedUsers = array_values(array_unique($data->CurrentScheduledPlayers));
                    $PlayedUsers =  array_values(array_unique(array_reverse($data->CurrentScheduledPlayers)));
                    $PlayedUsers =  array_reverse($PlayedUsers);
                        if (sizeof($PlayedUsers) > 1) {
                            $recentActivity1UserId = $PlayedUsers[sizeof($PlayedUsers) - 1]['UserId'];
                            $recentActivity2UserId = $PlayedUsers[sizeof($PlayedUsers) - 2]['UserId'];
                        } elseif (sizeof($PlayedUsers) == 1) {
                            $recentActivity1UserId = $PlayedUsers[sizeof($PlayedUsers) - 1]['UserId'];
                        }
                    }
                } elseif ($data->RecentActivity == "Schedule") {
                    $recentActivity2UserId = $data->OriginalUserId;
                }

                $recentActivityUser1 = UserCollection::model()->getTinyUserCollection($recentActivity1UserId);
                if (!empty($recentActivity2UserId)) {
                    $recentActivityUser2 = UserCollection::model()->getTinyUserCollection($recentActivity2UserId);
                }
                $whosePost = "";
                if ($data->ActionType == 'Comment' || $data->ActionType == 'Follow' || $data->ActionType == 'EventAttend' || $data->ActionType == 'Invite') {
                    if ($data->OriginalUserId == $UserId) {
                        $whosePost = "your";
                    } elseif (in_array($data->OriginalUserId, array_unique($data->UserFollowers)) || in_array($data->OriginalUserId, array_unique($data->PostFollowers))) {
                        $whosePost = $tinyOriginalUser['DisplayName'];
                    }
                }
                if($data->CategoryType!=13){
                  $userId1 = $recentActivityUser1['UserId'];
                $userId2 = "";
                $displayName1 = $UserId == $recentActivityUser1['UserId'] ? 'You' : $recentActivityUser1['DisplayName'];
                if ($PostAsNetwork == 1) {
                    $displayName1 = $recentActivityUser1['DisplayName'];
                }
                $displayName2 = "";
                $secondUser = "";
                if (!empty($recentActivityUser2)) {
                    $userId2 = $recentActivityUser2['UserId'];
                    $displayName2 = $UserId == $recentActivityUser2['UserId'] ? 'You' : $recentActivityUser2['DisplayName'];
                    if ($PostAsNetwork == 1) {
                        $displayName2 = $recentActivityUser2['DisplayName'];
                    }
                    if ($displayName2 == "You") {
                        $displayName2 = $displayName1;
                        $displayName1 = "You";
                        $temp = $userId1;
                        $userId1 = $userId2;
                        $userId2 = $temp;
                    }
                    $secondUser = ", <a class='userprofilename' data-id='" . $userId2 . "' style='cursor:pointer'><b>" . $displayName2 . "</b></a>";
                }  
                }if($data->Store!=0 && $data->CategoryType==10){
                    $storeUserDetails=array();
                    $displayName1='#'.$data->Store;
                    $data->IsCustomBadge=1;
                    $storeUsers=  ServiceFactory::getSkiptaUserServiceInstance()->getUsersBYStoreId($data->Store,5);
                    $totalStoreUsers=  ServiceFactory::getSkiptaUserServiceInstance()->getUsersBYStoreId($data->Store);
                    $data->PlayersCount=count($totalStoreUsers)-count($storeUsers);
                    if(count($storeUsers)>0){                        
                        foreach($storeUsers as $user){
                            $userP=array();
                            $userProfileDetails=ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($user['UserId']);
                        $userP['UserId']=$userProfileDetails->UserId;
                        $userP['ProfilePicture']=$userProfileDetails->ProfilePicture;
                        $userP['DisplayName']=$userProfileDetails->DisplayName;
                        array_push($storeUserDetails,$userP);
                        }
                       $data->StoreUsers= $storeUserDetails;
                    }
                    
                }
                
                $data->FirstUserId = $userId1;
                $data->FirstUserDisplayName = $displayName1;
                if($data->CategoryType==13){
                  $data->FirstUserProfilePic=$data->NetworkLogo;  
                }
                else{
                   $data->FirstUserProfilePic = $recentActivityUser1['profile250x250']; 
                }
                                    
                $data->SecondUserData = $secondUser;
                $data->PostBy = $whosePost;
                $data->OriginalUserDisplayName = $tinyOriginalUser['DisplayName'];
                $data->OriginalUserProfilePic = $tinyOriginalUser['profile70x70'];
                $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);
                $data->IsLoved = in_array($UserId, $data->LoveUserId);
                $data->FbShare = isset($data->FbShare) && is_array($data->FbShare) ? in_array($UserId, $data->FbShare) : 0;
                $data->TwitterShare = isset($data->TwitterShare) && is_array($data->TwitterShare) ? in_array($UserId, $data->TwitterShare) : 0;
                $data->IsSurveyTaken = in_array($UserId, $data->SurveyTaken);
                $data->TotalSurveyCount = $data->OptionOneCount + $data->OptionTwoCount + $data->OptionThreeCount + $data->OptionFourCount;
                if (isset($data->OptionFour) && !empty($data->OptionFour))
                    $data->IsOptionDExist = 1;

                $image = "";
               
                if ($data->IsMultiPleResources > 0) {
                    if (isset($data->Resource["ThumbNailImage"])) {
                        $data->ArtifactIcon = $data->Resource["ThumbNailImage"];
                    } else {
                        $data->ArtifactIcon = "";
                    }
                }
                if ($secondUser != "") {
                    if (trim($data->StreamNote) == "is following") {
                        $data->StreamNote = " are following";
                    }
                    if (trim($data->StreamNote) == "is attending") {
                        $data->StreamNote = " are attending";
                    }
                    if (trim($data->StreamNote) == "has answered") {
                        $data->StreamNote = " have answered";
                    }
                    if (trim($data->StreamNote) == "is Played") {
                        $data->StreamNote = " are Played";
                    }
                    if (trim($data->StreamNote) == "has Played") {
                        $data->StreamNote = " have Played ";
                    }
                }
                if ($UserId == $recentActivityUser1['UserId'] && trim($secondUser) == "") {


                    if (trim($data->StreamNote) == "is following") {
                        $data->StreamNote = " are following";
                    }
                    if (trim($data->StreamNote) == "is attending") {
                        $data->StreamNote = " are attending";
                    }
                    if (trim($data->StreamNote) == "has answered") {
                        $data->StreamNote = " have answered";
                    }if (trim($data->StreamNote) == "is Played") {
                        $data->StreamNote = " Played";
                    }
                    if (trim($data->StreamNote) == "has invited to") {
                        $data->StreamNote = " have invited to ";
                    }
                    if (trim($data->StreamNote) == "has Played") {
                        $data->StreamNote = " have Played ";
                    }
                }

                if ($data->PostType == 4) {
                    $data->PostBy = "";
                    if ($data->ActionType == "Post") {
                        $data->PostBy = "";
                        $data->FirstUserDisplayName = "";
                        $data->FirstUserProfilePic = "/images/icons/user_noimage.png";
                        $data->SecondUserData = "";
                        $data->StreamNote = "A new post has been created";
                        $data->PostTypeString = "";
                    }
                }

                if ($data->PostType == 2) {

                    $eventStartDate = CommonUtility::convert_time_zone($data->StartDate->sec, $timezone, '', 'sec');
                    $eventEndDate = CommonUtility::convert_time_zone($data->EndDate->sec, $timezone, '', 'sec');
                    $data->Title = $data->Title;
                    $data->StartDate = date("Y-m-d", $eventStartDate);
                    $data->EndDate = date("Y-m-d", $eventEndDate);
                    $data->EventStartDay = date("d", $eventStartDate);
                    $data->EventStartDayString = date("l", $eventStartDate);
                    $data->EventStartMonth = date("M", $eventStartDate);
                    $data->EventStartYear = date("Y", $eventStartDate);
                    $data->EventEndDay = date("d", $eventEndDate);
                    $data->EventEndDayString = date("l", $eventEndDate);
                    $data->EventEndMonth = date("M", $eventEndDate);
                    $data->EventEndYear = date("Y", $eventEndDate);
                    $data->StartTime = date("h:i A", $eventStartDate);
                    $data->EndTime = date("h:i A", $eventEndDate);
                    if ($eventEndDate <= CommonUtility::currentSpecifictime_timezone($timezone)) {
                        $data->CanPromotePost = 0;
                        $data->IsEventAttend = 1;
                    } else {
                        $data->IsEventAttend = in_array($UserId, $data->EventAttendes);
                    }
                } elseif ($data->PostType == 3) {


                    $surveyExpiryDate = $data->ExpiryDate;
                    $data->Title = $data->Title;
                    if (isset($surveyExpiryDate->sec) && $surveyExpiryDate->sec <= time()) {
                        $data->CanPromotePost = 0;
                        $data->ExpiryDate = date("Y-m-d", $surveyExpiryDate->sec);
                    }
                    $surveyExpiryDate_tz = CommonUtility::convert_date_zone($surveyExpiryDate->sec, $timezone);
                    $currentDate_tz = CommonUtility::currentdate_timezone($timezone);
                    if ($surveyExpiryDate_tz < $currentDate_tz) {
                        $data->IsSurveyTaken = true; //expired
                    }
                }

                $comments = $data->Comments;
                $commentCount = sizeof($comments);
                $data->CommentCount = $data->CommentCount;
                $commentsArray = array();
                if ($commentCount > 0) {
                    $data->IsCommented = in_array((int) $UserId, $data->CommentUserId);
                    $commentsDisplayCount = 0;
                    for ($j = $commentCount; $j > 0; $j--) {
                        $comment = $comments[$j - 1];
                        $isBlockedComment = isset($comment['IsBlockedWordExist']) ? $comment['IsBlockedWordExist'] : 0;
                        if ($isBlockedComment != 1) {
                            $commentsDisplayCount++;
                            $commentedUser = UserCollection::model()->getTinyUserCollection($comment["UserId"]);
                            $comment["CreatedOn"] = $comment["CreatedOn"];
                            $textWithOutHtml = $comment["CommentText"];

                            if (isset($comment['WebUrls']) && !empty($comment['WebUrls']) && $comment['WebUrls'] != null) {

                                if (isset($comment['IsWebSnippetExist']) && $comment['IsWebSnippetExist'] == '1') {
                                    $CommentSnippetdata = WebSnippetCollection::model()->CheckWebUrlExist($comment['WebUrls'][0]);
                                    $comment['WebUrls'] = $CommentSnippetdata;
                                } else {

                                    $comment['WebUrls'] = "";
                                }
                            }
                            if (isset($comment["CommentTextLength"]) && $comment["CommentTextLength"] > 240) {

                                $appendCommentData = ' <span class="postdetail tooltiplink" data-id="' . $data->_id . '"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                                $description = CommonUtility::truncateHtml($comment["CommentText"], 240, '...', true, true, $appendCommentData);
                                $text = $description;

                                $comment["CommentText"] = $text;
                            } else {

                                $comment["CommentText"] = $comment["CommentText"];
                            }
                                
                                                                 
                            $comment["CommentText"] = CommonUtility::findUrlInStringAndMakeLink($comment["CommentText"]);
                                
                            $comment['ProfilePicture'] = $commentedUser['profile70x70'];
                            $commentCreatedOn = $comment["CreatedOn"];
                            $comment["CreatedOn"] = CommonUtility::styleDateTime($commentCreatedOn->sec);
                            $comment["DisplayName"] = $commentedUser['DisplayName'];
                            $image = "";
                            if (sizeof($comment["Artifacts"]) > 0) {
                                if (isset($comment["Artifacts"]['ThumbNailImage'])) {
                                    $image = $comment["Artifacts"]['ThumbNailImage'];
                                } else {
                                    $image = "";
                                }
                            }
                            $comment["ArtifactIcon"] = $image;
                            array_push($commentsArray, $comment);
                            if ($commentsDisplayCount == 2) {
                                break;
                            }
                        }
                    }
                }
                $data->Comments = $commentsArray;
                if ($data->CategoryType == 3) {
                    if (isset($data->GroupId)) {
                        $data->PostTypeString = " " . $data->PostTypeString;
                    }
                }
                if ($data->CategoryType == 7) {
                    if (isset($data->SubGroupId)) {
                        $data->PostTypeString = " " . $data->PostTypeString;
                    }
                }
                if ($data->CategoryType == 11) {
                 if(isset(Yii::app()->params['InviteObjectType']) && Yii::app()->params['InviteObjectType']=="Text") {
                      $data->GroupImage = "";
                 } else{
                   $data->GroupImage = Yii::app()->params['ServerURL']  ."/images/system/invite.png";   
                 }
                   
                }
                /**
                 * follow Object  post type
                 * post type user is 6
                 * post type hashtag 7
                 * post type curbsidecategory 8
                 * post  type group 9
                 */
                if ($data->PostType == 9) {
                    if (isset($data->GroupId)) {
                        $groupData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;
                        $data->GroupName = Yii::app()->params['ServerURL'] . $groupData->GroupName;

                        if (strlen($groupData->GroupDescription) > 240) {
                            $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                            $data->GroupDescription = $description . "  ...";
                        } else {
                            $data->GroupDescription = $groupData->GroupDescription;
                        }
                        $data->GroupFollowersCount = sizeof($groupData->GroupMembers);
                        $data->IsFollowingEntity = in_array($UserId, $groupData->GroupMembers);
                        $data->PostTypeString = " Group ";
                    }
                }

                if ($data->PostType == 10) {
                    if (isset($data->SubGroupId)) {
                        $groupData = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                        $data->SubGroupImage = $groupData->SubGroupProfileImage;
                        $data->SubGroupName = $groupData->SubGroupName;

                        if (strlen($groupData->SubGroupDescription) > 240) {
                            $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                            $data->SubGroupDescription = $description . "  ...";
                        } else {
                            $data->SubGroupDescription = $groupData->SubGroupDescription;
                        }
                        $data->SubGroupFollowersCount = sizeof($groupData->SubGroupMembers);
                        $data->IsFollowingEntity = in_array($UserId, $groupData->SubGroupMembers);
                        $data->PostTypeString = " Sub Group ";
                    }
                }
                if ($data->PostType == 7) {
                    $data->PostTypeString = " #Tag";
                    $data->GroupImage = "/images/icons/hashtag_img.png";
                    $data->HashTagName = $data->HashTagName;
                    $data->GroupDescription = "";
                    $data->HashTagPostCount = count($data->HashTagFollowers);

                    $data->IsFollowingEntity = in_array($UserId, $data->HashTagFollowers);
                    $data->PostTypeString = " " . $data->HashTagName;
                }
                if ($data->PostType == 8) {
                    $name = Yii::t('translation', 'CurbsideConsult');
                    $data->PostTypeString = " $name Category";
                    $data->GroupImage = "/images/icons/curbesidepost_img.png";
                    $data->CurbsideConsultCategory = $data->CurbsideConsultCategory;
                    $data->GroupDescription = "";
                    $data->CurbsidePostCount = sizeof($data->CurbsideCategoryFollowers);
                    $data->IsFollowingEntity = in_array($UserId, $data->CurbsideCategoryFollowers);
                    $data->PostTypeString = " " . $data->PostTypeString;
                }
                if ($data->PostType == 11) {
                    $data->IsNotifiable = (int) $data->IsNotifiable;
                }
                if ($data->PostType == 15) {                       
                    $userObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($data->OriginalUserId);
                    $data->PostCompleteText = "/profile/$userObj->uniqueHandle";
                    $data->PostTypeString = " in".$data->PostTypeString;                    
                    if($displayName1 == "You"){                       
                        $data->StreamNote = "have ".$data->StreamNote." your";
                        
                    }else{
                        $data->StreamNote = $data->StreamNote." their ";
                        
                    }
                    
//                    $data->PostBy = "";
//                    if ($data->ActionType == "Post") {
//                        $data->PostBy = "";
//                        $data->FirstUserDisplayName = "";
//                        $data->FirstUserProfilePic = "/images/icons/user_noimage.png";
//                        $data->SecondUserData = "";
//                        $data->StreamNote = "A new post has been created";
//                        $data->PostTypeString = "";
//                    }
                }
                
                 $data->PostText = CommonUtility::findUrlInStringAndMakeLink($data->PostText);
                      $data->PostCompleteText = CommonUtility::findUrlInStringAndMakeLink($data->PostCompleteText);
                    
                array_push($currentStreamIdArray, (string)$data->PostId);
            }else{
                
                unset($streamPostData[$key]);
                continue;
            }
            }
            //if($isHomeStream == 1){
                                        
                return array('streamPostData'=>$streamPostData, 'streamIdArray'=>$currentStreamIdArray,"totalStreamIdArray"=>$totalStreamIdArray);
//            }else{
//                return $streamPostData;
//            }
        } catch (Exception $ex) {
            error_log("__________exception_________________________________" . $ex->getMessage());
            error_log("__________exception_________________________________" . $ex->getLine());
            Yii::log("********EXCEPTION***************************" . $ex->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar pathepalli 
     * @param type $abusedPostData
     * @return array
     * 
     */
    static function prepareAbusedPostData($userId, $abusedPostData, $categoryType, $displayType = "Abuse") {
        try {
            foreach ($abusedPostData as $data) {

                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->UserId);

                $data->OriginalUserDisplayName = $tinyOriginalUser['DisplayName'];
                $data->OriginalUserProfilePic = $tinyOriginalUser['profile250x250'];
                $data->OriginalUserId = $data->UserId;
                $originalPostTime = $data->CreatedOn;
                $data->OriginalPostPostedOn = CommonUtility::styleDateTime($originalPostTime->sec);
                $data->DisplayType = $displayType;
                if ($displayType == "Abuse" && isset($data->IsAbused) && $data->IsAbused == 1) {//*********Abused posts
                    $tinyAbusedUser = UserCollection::model()->getTinyUserCollection($data->AbusedUserId);
                    $data->AbusedUserProfilePic = $tinyAbusedUser['profile250x250'];
                    $data->AbusedUserDisplayName = ($userId == $data->AbusedUserId) ? "You" : $tinyAbusedUser['DisplayName'];
                    $abusedOn = $data->AbusedOn;
                    $data->AbusedOn = CommonUtility::styleDateTime($abusedOn->sec);
                    $data->IsBlockedWordExist = 0;
                } else {//*********Blocked posts
                    $data->AbusedUserProfilePic = $data->OriginalUserProfilePic;
                    $data->AbusedUserDisplayName = ($userId == $data->OriginalUserId) ? "You" : $data->OriginalUserDisplayName;
                    $data->AbusedUserId = $data->OriginalUserId;
                    $data->AbusedOn = $data->OriginalPostPostedOn;
                    $data->IsBlockedWordExist = 1;
                    $data->IsAbused = 0;
                    $blockedWords = AbuseKeywords::model()->getAllAbuseWords();
                    if (is_array($blockedWords) && sizeof($blockedWords) > 0) {
                        $data->Description = CommonUtility::FindElementAndReplace($data->Description, $blockedWords);
                    }
                }
                $image = "";
                $filetype = "";
                if (sizeof($data->Resource) > 0) {
                    $filetype = isset($data->Resource[sizeof($data->Resource) - 1]["Extension"]) ? $data->Resource[sizeof($data->Resource) - 1]["Extension"] : "";
                    if (isset($data->Resource[sizeof($data->Resource) - 1]["ThumbNailImage"])) {
                        $image = $data->Resource[sizeof($data->Resource) - 1]["ThumbNailImage"];
                    } else {
                        $image = "";
                    }
                }
                $data->Extension = $filetype;
                $data->ArtifactIcon = $image;
                $data->IsMultiPleResources = sizeof($data->Resource) > 2 ? 2 : sizeof($data->Resource);
                if ($data->Type == 2) {
                    $eventStartDate = $data->StartDate;
                    $eventEndDate = $data->EndDate;
                    $data->Title = $data->Title;
                    $data->StartDate = date("Y-m-d", $eventStartDate->sec);
                    $data->EndDate = date("Y-m-d", $eventEndDate->sec);
                    $data->EventStartDay = date("d", $eventStartDate->sec);
                    $data->EventStartDayString = date("l", $eventStartDate->sec);
                    $data->EventStartMonth = date("M", $eventEndDate->sec);
                    $data->EventStartYear = date("Y", $eventEndDate->sec);
                    $data->EventEndDay = date("d", $eventEndDate->sec);
                    $data->EventEndDayString = date("l", $eventEndDate->sec);
                    $data->EventEndMonth = date("M", $eventEndDate->sec);
                    $data->EventEndYear = date("Y", $eventEndDate->sec);
                }
                if ($data->Type == 5) {
                    $curbsideCategory = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($data->CategoryId);
                    $data->CurbsideConsultCategory = "<a style='cursor:pointer' data-id='" . $data->CategoryId . "' class='curbsideCategory'><b>" . isset($curbsideCategory['CategoryName']) ? $curbsideCategory['CategoryName'] : '' . "</b></a>";
                    $data->CurbsideConsultTitle = $data->Subject;
                }
                if ($categoryType == 3 && !is_int($data->SubGroupId)) {
                    $subgroupDetails = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                    if (is_object($subgroupDetails)) {
                        $data->SubGroupName = $subgroupDetails->SubGroupName;
                    }

                    $categoryType = 7;
                }
                if ($categoryType == 3) {
                    $groupDetails = GroupCollection::model()->getGroupDetailsWithoutGroupMembersByGroupId($data->GroupId);
                    if (is_object($groupDetails)) {
                        $data->GroupName = $groupDetails->GroupName;
                    }
                }


                $data->CategoryType = $categoryType;


                $postType = CommonUtility::postTypebyIndex($data->Type, $data->CategoryType);
                $data->PostTypeString = $postType;
                $isPromoted = isset($data->IsPromoted) ? $data->IsPromoted : 0;
                if ($isPromoted == 1) {
                    $currentDate = date('Y-m-d', time());
                    $postPromotedDate = date('Y-m-d', $originalPostTime->sec);
                    if ($postPromotedDate < $currentDate) {
                        $data->IsPromoted = 0;
                    }
                }
                if (isset($data->IsBlockedWordExistInComment) && $data->IsBlockedWordExistInComment == 1) {

                    $comments = $data->Comments;
                    $commentCount = sizeof($comments);
                    //$data->CommentCount = $commentCount;
                    $commentsArray = array();
                    if ($commentCount > 0) {
                        //$maxDisplaySize = $commentCount>2?2:$commentCount;
                        $commentsDisplayCount = 0;
                        for ($j = $commentCount; $j > 0; $j--) {
                            $comment = $comments[$j - 1];
                            $comment["IsBlockedWordExist"] = isset($comment["IsBlockedWordExist"]) ? $comment["IsBlockedWordExist"] : 0;
                            $commentedUser = UserCollection::model()->getTinyUserCollection($comment["UserId"]);
                            $comment["CreatedOn"] = $comment["CreatedOn"];
                            $comment["CommentId"] = $comment["CommentId"];
                            if ($comment["IsBlockedWordExist"] == 1) {
                                $blockedWords = AbuseKeywords::model()->getAllAbuseWords();
                                if (is_array($blockedWords) && sizeof($blockedWords) > 0) {
                                    $comment["CommentText"] = CommonUtility::FindElementAndReplace($comment["CommentText"], $blockedWords);
                                }
                            } else {
                                $comment["CommentText"] = $comment["CommentText"];
                            }
                            $comment['ProfilePicture'] = $commentedUser['profile70x70'];
                            $commentCreatedOn = $comment["CreatedOn"];
                            $comment["CreatedOn"] = CommonUtility::styleDateTime($commentCreatedOn->sec);
                            $comment["DisplayName"] = $commentedUser['DisplayName'];
                            $image = "";
                            $filetype = "";
                            if (sizeof($comment["Artifacts"]) > 0) {
                                $filetype = $comment["Artifacts"][0]['Extension'];
                                if (isset($comment["Artifacts"][0]["ThumbNailImage"])) {
                                    $image = $comment["Artifacts"][0]["ThumbNailImage"];
                                } else {
                                    $image = "";
                                }
                            }
                            $comment["Extension"] = $filetype;
                            $comment["ArtifactIcon"] = $image;
                            array_push($commentsArray, $comment);
                        }
                    }
                    $data->Comments = $commentsArray;
                }
            }

            return $abusedPostData;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Haribabu 
     * @param type post description
     * @return string
     * 
     */
    static function truncateHtml($text, $length, $ending = '...', $exact = true, $considerHtml = true, $customizedHtml = "") {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }
        // add the defined ending to the text
        //$truncate .= $ending;
        if ($considerHtml) {
            // close all unclosed html-tags
            $totalTags = count($open_tags);
            if ($totalTags == 0) {
                $truncate.=$customizedHtml;
            } else {
                $i = 0;
                foreach ($open_tags as $tag) {
                    $i++;
                    if ($i == $totalTags) {
                        $truncate.=$customizedHtml;
                    }
                    $truncate .= '</' . $tag . '>';
                }
            }
        }
        return $truncate;
    }

      static function prepareStreamObject($userId, $actionType, $postId, $categoryId, $followEntity, $commentObj, $createdDate = '') {
        try {
            //echo "Prepare stream object";
            $streamObj = new UserStreamBean();
            $streamObj->IsPromoted=0;
            if ((int) $categoryId == 2) {
                $postObj = CurbsidePostCollection::model()->getPostById($postId);
                $streamObj->IsPromoted=$postObj->IsPromoted;
            } elseif ($categoryId == 3 || $categoryId == 7) {
                $postObj = GroupPostCollection::model()->getGroupPostById($postId);
                $streamObj->IsPromoted=$postObj->IsPromoted;
            } elseif ($categoryId == 8) {
                $postObj = CuratedNewsCollection::model()->getNewsObjectById($postId);
                $streamObj->IsPromoted=$postObj->IsPromoted;
                $streamObj->HtmlFragment = $postObj->HtmlFragment;
                $streamObj->TopicId = $postObj->TopicId;
                $streamObj->Released = $postObj->Released;
                $streamObj->Editorial = $postObj->Editorial;
                $streamObj->PublisherSource = $postObj->PublisherSource;
                $streamObj->PublicationTime = $postObj->PublicationTime;
                $streamObj->PublicationDate = $postObj->PublicationDate;
                $streamObj->PublisherSourceUrl = $postObj->PublisherSourceUrl;
                $streamObj->TopicName = $postObj->TopicName;
                $streamObj->Alignment = $postObj->Alignment;
                $streamObj->Title = $postObj->Title;
                $streamObj->TopicImage = $postObj->TopicImage;
                $streamObj->IsNotifiable = (int) $postObj->IsNotifiable;
            } else if ($categoryId == 9) {
                $postObj = GameCollection::model()->getGameDetailsObject('Id', $postId);
                $streamObj->PostId = (String) $postId;
                $streamObj->GameName = $postObj->GameName;
                $streamObj->GameDescription = $postObj->GameDescription;

                $streamObj->PlayersCount = $postObj->PlayersCount;
                $streamObj->QuestionsCount = $postObj->QuestionsCount;
                $streamObj->GameBannerImage = $postObj->GameBannerImage;
               
                $streamObj->Resource=$postObj->Resources['ThumbNailImage'];
                $scheduleDetails = ScheduleGameCollection::model()->getScheduleGameDetailsObject('Id', $followEntity);
                $streamObj->StartDate = $scheduleDetails->StartDate;
                $streamObj->EndDate = $scheduleDetails->EndDate;

                if ($actionType == 'Comment') {
                    if (isset($postObj->CurrentScheduleId)) {

                        $streamObj->CurrentGameScheduleId = (String) $postObj->CurrentScheduleId;
                    }
                }
                if ($actionType == 'Post') {

                    $streamObj->PreviousGameScheduleId = (String) $commentObj->_id;
                    $streamObj->CurrentGameScheduleId = (String) $postObj->CurrentScheduleId;
                    $streamObj->CurrentScheduledPlayers = array();
                    $streamObj->CurrentScheduleResumePlayers = array();
                    $streamObj->PreviousSchedulePlayers = $commentObj->Players;
                    $streamObj->PreviousScheduleResumePlayers = $commentObj->ResumePlayers;
                    $streamObj->IsNotifiable = 0;
                }

                if ($actionType == "Play") {
                    $streamObj->CurrentScheduledPlayers = $commentObj;
                    $streamObj->CurrentGameScheduleId = (String) $postObj->CurrentScheduleId;
                }
                if ($actionType == "Playing") {
                    $streamObj->CurrentScheduleResumePlayers = $userId;
                }
            }
            elseif($categoryId==10 && $postId!="")
            {//Badging
               
                    $postObj=UserBadgeCollection::model()->getUserBadgeCollectionById($postId);
         
                if($postObj!="failure" && count($postObj)>0)
                {
                  
                    $badgeObj=Badges::model()->getBadgeById($postObj->BadgeId);
                    $streamObj->Title=$badgeObj->hover_text;
                    $streamObj->BadgeName=$badgeObj->badgeName;
                    $streamObj->BadgeLevelValue=$postObj->BadgeLevelValue;
                    $streamObj->BadgeHasLevel=$badgeObj->has_level;
                    $resourceBean=new ResourceCollection();
                    $resourceBean->Extension="png";
                    $resourceBean->Uri=$badgeObj->image_path;
                    $resourceBean->ThumbNailImage=$badgeObj->image_path;;
                    $streamObj->Resource=$resourceBean;
                    $postObj->Description=$badgeObj->description;
                    echo $commentObj.'___store and type_____________________________________________'.$followEntity;
                   if($followEntity=='Console'){
                       /* comment obj is store id which comes from custom badge interceptor */                       
                       $streamObj->Store=$commentObj;
                       $streamObj->CustomBadgeProcessType=$followEntity;
                   }else{
                       $streamObj->CustomBadgeProcessType="System";
                   }
                
                 
                  
                }
                
            }            
            elseif($categoryId==12)
            {//CV
                    $postObj=UserCVPublicationsCollection::model()->getUserCVPCollectionByCriteria($userId);
                    $streamObj->Title=$postObj->Title;
                    $streamObj->PostText=$postObj->Description; 
            }
             elseif($categoryId==11 && $postId!="")
            {//Badging
               
               $postObj=UserNetworkInviteCollection::model()->getUserNetworkInviteCollectionById($postId);
                if($postObj!="failure" && count($postObj)>0)
                {
                    $networkInviteInfo=  NetworkInvites::model()->getNetworkInfoId($postObj->NetworkInviteId);
                    $Oauth2Client=Oauth2Clients::model()->getOauth2ClientDetailsByCriteria("client_id",$postObj->NetworkClientId);
                  
                    $streamObj->NetworkInviteId=$postObj->NetworkInviteId;
                    $streamObj->NetworkLogo=$networkInviteInfo->NetworkLogo;
                    $streamObj->NetworkRedirectUrl=$Oauth2Client->redirect_uri;
                     $streamObj->BadgeName=$networkInviteInfo->NetworkName;
                     $postObj->Description=$networkInviteInfo->Description;
                 
                }
                
            }
            else if($categoryId==13 && $postId!=""){
                $postObj=AdvertisementCollection::model()->getAdvertisementDetailsById($postId);
                
                    $streamObj->Title=$postObj->Title;
                    $streamObj->NetworkLogo= "/images/system/networkbg_logo.png";
                    if($postObj->IsThisExternalParty==1){
                        $streamObj->Title="<b>".$postObj->ExternalPartyName."</b><span> ".$postObj->Title."</span>";
                        $streamObj->NetworkLogo= $postObj->ExternalPartyUrl;
                    }
                    
                    $resourceBean=new ResourceBean();
                    $resourceBean->Extension=$postObj->ExtensionType;
                    $resourceBean->Uri=$postObj->Url;
                    $resourceBean->ThumbNailImage=$postObj->Url;
                    $streamObj->Resource=$resourceBean;
                    $streamObj->RedirectUrl=$postObj->RedirectUrl;
                    $streamObj->StartDate=$postObj->StartDate;
                    $streamObj->ExpiryDate=$postObj->ExpiryDate;
                    $streamObj->IsNotifiable=$postObj->Status;
                    $streamObj->DisplayPage=$postObj->DisplayPage;
                    $streamObj->Groups=$postObj->GroupId;
                    $streamObj->AdvertisementId=$postObj->AdvertisementId;
                    $streamObj->RequestedParams=$postObj->RequestedParams;
                    $streamObj->BannerTemplate=$postObj->BannerTemplate;
                    $streamObj->BannerContent= $postObj->BannerContent;
                    $streamObj->BannerTitle= $postObj->BannerTitle;
                    $streamObj->ImpressionTag= $postObj->ImpressionTag;
                    $streamObj->ClickTag= $postObj->ClickTag;
                    $streamObj->BannerOptions= $postObj->BannerOptions;
                
                    if($postObj->DisplayPage!="Group"){
                         $streamObj->Groups="";
                    }
                    $streamObj->RequestedFields=$postObj->RequestedFields;
                    $streamObj->AdType=$postObj->AdType;
            if($postObj->AdType==3){
                     $streamObj->RequestedFields=$postObj->RequestedFields;
            }
                          
            }
            
            
            else {
                $postObj = PostCollection::model()->getPostById($postId);
                $streamObj->IsPromoted=$postObj->IsPromoted;
            }
            //   error_log("****prepare stream obj after badging". $streamObj->badgeName);
            $user_data = UserCollection::model()->getTinyUserCollection($userId);
            
            $streamObj->UserId = $userId;
            $streamObj->StreamNote = '';
            $streamObj->PostId = (String) $postId;
            $streamObj->CommentUserId = array();
            $streamObj->NetworkId = $user_data->NetworkId;
            $streamObj->PostType = $postObj->Type;
            $streamObj->ActionType = $actionType;
            $streamObj->CategoryType = $categoryId;
            $streamObj->FollowEntity = CommonUtility::getIndexBySystemFollowingThing('');
            $originalPostCreatedDate = $postObj->CreatedOn;
            $streamObj->CreatedOn = $originalPostCreatedDate->sec;
            $streamObj->OriginalPostTime = $originalPostCreatedDate->sec;
            $streamObj->IsBlockedWordExist = isset($postObj->IsBlockedWordExist) ? $postObj->IsBlockedWordExist : 0;
            $streamObj->IsWebSnippetExist = (int) $postObj->IsWebSnippetExist;
            $streamObj->WebUrls = $postObj->WebUrls;
            $streamObj->Division = $postObj->Division;
            $streamObj->District = $postObj->District;
            $streamObj->Region = $postObj->Region;
             if($categoryId!=10){
             $streamObj->Store = $postObj->Store;
             
             }

            if ($categoryId == 10) {
                $streamObj->PostType = 13;
            }
             if ($categoryId == 11) {
                $streamObj->PostType = 14;
            }
            /*  $descriptionLength = strlen(preg_replace('/<.*?>/', '', $postObj->Description)); */
            if ($categoryId == 9) {
                $tagsFreeDescription = strip_tags(($postObj->GameDescription));
                $date = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
                $streamObj->CreatedOn = $date->sec;
            } else {
                $tagsFreeDescription = strip_tags(($postObj->Description));
            }

            $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
            $descriptionLength = strlen($tagsFreeDescription);
            if ($descriptionLength >= '500') {
                $length = '500';
            } else {

                $length = '240';
            }
            if ($categoryId == 9) {
                $description = CommonUtility::truncateHtml($postObj->GameDescription, $length);
            } else {
                $description = CommonUtility::truncateHtml($postObj->Description, $length);
            }
            $streamObj->PostText = trim($description);
            if($categoryId!=10 && $categoryId!=9  &&  $categoryId!=13)
            {
            if (sizeof($postObj->Resource) == 0) {
                $streamObj->Resource = '';
            } else {
                $streamObj->Resource = $postObj->Resource[0];
            }
            }
            
            $streamObj->PostTextLength = $descriptionLength;
            if ($categoryId == 9) {
                $streamObj->PostText = $postObj->GameDescription;
            } else {
                $streamObj->PostText = $postObj->Description;
            }
            
            $streamObj->IsMultiPleResources = sizeof($postObj->Resource);
            $streamObj->OriginalUserId = $postObj->UserId;

            $streamObj->MentionArray = $postObj->Mentions;
            $streamObj->HashTags = $postObj->HashTags;
            if ($postObj->Type == 2) {
                $streamObj->Title = $postObj->Title;
                $streamObj->EventAttendes = $postObj->UserId;
                $streamObj->StartDate = $postObj->StartDate->sec;
                $streamObj->EndDate = $postObj->EndDate->sec;
                $streamObj->StartTime = $postObj->StartTime;
                $streamObj->EndTime = $postObj->EndTime;
                $streamObj->Location = $postObj->Location;
                $streamObj->Title = $postObj->Title;
            }
            if ($postObj->Type == 3) {
                $streamObj->Title = $postObj->Title;
                $streamObj->OptionOne = $postObj->OptionOne;
                $streamObj->OptionTwo = $postObj->OptionTwo;
                $streamObj->OptionThree = $postObj->OptionThree;
                $streamObj->OptionFour = $postObj->OptionFour;
                $streamObj->ExpiryDate = $postObj->ExpiryDate->sec;
                $streamObj->OptionOneCount = (int) $postObj->OptionOneCount;
                $streamObj->OptionTwoCount = (int) $postObj->OptionTwoCount;
                $streamObj->OptionThreeCount = (int) $postObj->OptionThreeCount;
                $streamObj->OptionFourCount = (int) $postObj->OptionFourCount;
                $streamObj->Title = $postObj->Title;
            }

            if ($actionType == "Comment") {
                $streamObj->MentionArray = $commentObj->Mentions;
                /*   $descriptionLength=strlen(preg_replace('/<.*?>/', '', $commentObj->CommentText)); */
                $tagsFreeDescription = strip_tags(($commentObj->CommentText));
                $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
                $descriptionLength = strlen($tagsFreeDescription);
                if ($descriptionLength >= '500') {

                    $length = '500';
                } else {

                    $length = '240';
                }
                $description = CommonUtility::truncateHtml($commentObj->CommentText, $length);
                $streamObj->CreatedOn = $commentObj->CreatedOn;
                $commentObj->CommentText = $description;
                $commentObj->CommentTextLength = $descriptionLength;

                $streamObj->IsBlockedWordExistInComment = isset($postObj->IsBlockedWordExistInComment) ? $postObj->IsBlockedWordExistInComment : 0;
                $streamObj->Comments = $commentObj;
                $streamObj->RecentAcivity = "Comment";
                if ((int) $categoryId != 2) {
                    if (isset($postObj->EventAttendes) && sizeof($postObj->EventAttendes) > 0) {
                        if (in_array((int) $userId, $postObj->EventAttendes)) {
                            $streamObj->EventAttendes = (int) $userId;
                        }
                    }
                    if (isset($postObj->SurveyTaken) && sizeof($postObj->SurveyTaken) > 0) {
                        if (in_array((int) $userId, $postObj->SurveyTaken)) {
                            $streamObj->SurveyTaken = (int) $userId;
                        }
                    }
                }
                if (isset($postObj->Love) && sizeof($postObj->Love) > 0) {
                    if (in_array((int) $userId, $postObj->Love)) {
                        $streamObj->LoveUserId = (int) $userId;
                    }
                }
                if (isset($postObj->Followers) && sizeof($postObj->Followers) > 0) {
                    if (in_array((int) $userId, $postObj->Followers)) {
                        $streamObj->PostFollowers = (int) $userId;
                    }
                }
                if (isset($postObj->FbShare) && sizeof($postObj->FbShare) > 0) {
                    if (in_array((int) $userId, $postObj->FbShare)) {
                        $streamObj->FbShare = (int) $userId;
                    }
                }
                if (isset($postObj->TwitterShare) && sizeof($postObj->TwitterShare) > 0) {
                    if (in_array((int) $userId, $postObj->TwitterShare)) {
                        $streamObj->TwitterShare = (int) $userId;
                    }
                }
            }
            if ($actionType == "EventAttend") {
                $streamObj->EventAttendes = (int) $userId;
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            if ($actionType == "Love") {
                $streamObj->LoveUserId = (int) $userId;
                $streamObj->RecentAcivity = "Love";
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            if ($actionType == "Follow") {
                $streamObj->PostFollowers = (int) $userId;
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            if ($actionType == "UnFollow") {
                $streamObj->PostFollowers = (int) $userId;
            }
            if ($actionType == "Survey") {
                $streamObj->SurveyTaken = (int) $userId;
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            if ($actionType == "Invite") {
                $inviteobj = $postObj->Invite[sizeof($postObj->Invite) - 1];
                $streamObj->InviteUsers = $inviteobj[1];
                $streamObj->InviteMessage = $inviteobj[2];
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            if ($actionType == "FbShare") {
                $streamObj->FbShare = (int) $userId;
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            if ($actionType == "TwitterShare") {
                $streamObj->TwitterShare = (int) $userId;
                $streamObj->CreatedOn = strtotime(date('Y-m-d H:i:s', time()));
                if (!empty($createdDate)) {
                    $streamObj->CreatedOn = strtotime(date($createdDate, time()));
                }
            }
            $streamObj->OriginalUserId = (int) $postObj->UserId;
            $streamObj->LoveCount = (int) count($postObj->Love);
            $count = 0;
            if (count($postObj->Comments) > 0) {
                foreach ($postObj->Comments as $key => $value) {
                    if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist'] == 1)) {
                        $count++;
                    }
                }
            }
            $streamObj->CommentCount = $count;
            $streamObj->FollowCount = (int) count($postObj->Followers);
            $streamObj->InviteCount = (int) count($postObj->Invite);
            $fbCount = 0;
            $twitterCount = 0;
            if (isset($postObj->FbShare) && sizeof($postObj->FbShare) > 0) {
                $fbCount = (int) count($postObj->FbShare);
            }
            if (isset($postObj->TwitterShare) && sizeof($postObj->TwitterShare) > 0) {
                $twitterCount = (int) count($postObj->TwitterShare);
            }
            $streamObj->ShareCount = $fbCount + $twitterCount;
            $streamObj->DisableComments = isset($postObj->DisableComments) ? $postObj->DisableComments : 0;


            if ((int) $categoryId == 3) {
                $streamObj->GroupId = (String) $postObj->GroupId;
                $groupDetails = GroupCollection::model()->getGroupDetailsById($streamObj->GroupId);
                $streamObj->ShowPostInMainStream = 1;
                $streamObj->IsPrivate = $groupDetails->IsPrivate;
            }
            if ((int) $categoryId == 7) {
                $streamObj->GroupId = (String) $postObj->GroupId;
                $streamObj->SubGroupId = (String) $postObj->SubGroupId;
                $subGroupDetails = SubGroupCollection::model()->getSubGroupDetailsById($postObj->SubGroupId);
                if (is_object($subGroupDetails)) {
                    $streamObj->ShowPostInMainStream = $subGroupDetails->ShowPostInMainStream;
                }
            }

            if ((int) $categoryId == 2) {
                if ($postObj->IsFeatured == 1) {
                    $streamObj->IsFeatured = $postObj->IsFeatured;
                    $streamObj->FeaturedUserId = (int) $postObj->UserId;
                    $streamObj->FeaturedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
                }

                $streamObj->CurbsideConsultTitle = $postObj->Subject;
                $curbsideCategoryObj = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId((int) $postObj->CategoryId);
                $streamObj->CurbsideConsultCategory = "<a style='cursor:pointer' data-id='$postObj->CategoryId' class='curbsideCategory'><b>$curbsideCategoryObj->CategoryName</b></a>";
                $streamObj->CurbsideCategoryId = $postObj->CategoryId;
            }
            if ((int) $categoryId == 1) {
                if ($postObj->IsFeatured == 1) {
                    $streamObj->IsFeatured = $postObj->IsFeatured;
                    $streamObj->FeaturedUserId = (int) $postObj->UserId;
                    $streamObj->FeaturedOn = new MongoDate(strtotime(date('Y-m-d H:i:s', time())));
                }
            }
            if ($categoryId == 9) {
                $streamObj->CreatedOn = $createdDate == "" ? $streamObj->CreatedOn : $createdDate;
            }
            if($categoryId==10 || $categoryId==13 )
            {
                    $streamObj->IsMultiPleResources=1;
            }
          
           
            try {
                if(isset( YII::app()->params['NetworkAdminEmail'])){
                    $netwokAdminObj = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType( YII::app()->params['NetworkAdminEmail'], 'Email');
                   if(isset($netwokAdminObj->UserId)){
                    $streamObj->NetworkAdminUserId=(string)($netwokAdminObj->UserId);
                   }else{
                       $streamObj->NetworkAdminUserId=0;
                   }
                }
                Yii::app()->amqp->stream(json_encode($streamObj));
            } catch (Exception $ex) {
                error_log("exceoption----" . $ex->getMessage());
                return FALSE;
            }
           
           
            return TRUE;
        } catch (Exception $exc) {
            error_log("exceoption----" . $exc->getMessage());
            Yii::log($exc->getMessage(), 'error', 'application');
            return FALSE;
        }
    }

    static function registerClientScript($path = '', $js = '') {
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/js/' . $path . $js);
    }

    static function registerClientCss($path = 'simplePagination/', $css = 'simplePagination.css') {
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . '/css/' . $path . $css);
    }

    static function IsArrayElementsExistsInString($input, array $referers) {
        foreach ($referers as $referer) {
            if (preg_match("/\b$referer\b/i", $input)) {
                return true;
            }
        }
        return false;
    }

    static function prepareStreamObjectForFollowEntity($userId, $actionType, $followId, $categoryType, $followEntity, $createdDate = '') {
        try {
            /**
             * category 4 is user profile category, geeting user details from here
             * category 5 hashtag,
             * category 2 is curbside
             * category 3 is group , here no need group detail so we  have get group data
             */
            if ($categoryType == 4) {
                $obj = UserProfileCollection::model()->getUserProfileCollection((int) $userId);
            } else if ($categoryType == 5) {
                $obj = HashTagCollection::model()->getHashTagsById($followId);
            } else if ($categoryType == 6) {
                $obj = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($followId);
            }

            $streamObj = new UserStreamBean();
            $streamObj->UserId = (int) $userId;
            if (isset($createdDate) && !empty($createdDate)) {
                $streamObj->CreatedOn = strtotime(date($createdDate, time()));
            }
            /**
             * as per convinent of stream (already defined) , so we add postcollecton  id into post Id.
             * post type user.
             */
            $user_data = UserCollection::model()->getTinyUserCollection($userId);
            $streamObj->NetworkId = $user_data->NetworkId;
            $streamObj->FollowEntity = $followEntity;
            $streamObj->CategoryType = $categoryType;
            $streamObj->ActionType = $actionType;
            $streamObj->RecentActivity = $actionType;



            /**
             * follow Object  post type
             * post type user is 6
             * post type hashtag 7
             * post type curbsidecategory 8
             * post  type group 9
             * 
             * follow entity id's Post is 1
             * Group 2
             * User 3
             * Hashtag 4
             * Curbside category 5 
             * 
             */
            if ($actionType == "UserFollow" || $actionType == "UserUnFollow") {
                $streamObj->PostType = CommonUtility::sendPostType("User");
                $streamObj->PostId = $obj->_id;
                $streamObj->UserFollowers = (int) $followId;
            }

            if ($actionType == "HashTagFollow" || $actionType == "HashTagUnFollow") {
                $streamObj->PostType = CommonUtility::sendPostType("HashTag");

                $streamObj->PostId = $followId;
                $streamObj->HashTagId = $followId;
                $streamObj->HashTagName = $obj->HashTagName;
                $streamObj->HashTagPostCount = (int) count($obj->Post);
            }
            if ($actionType == "GroupFollow" || $actionType == "GroupUnFollow") {
                $streamObj->PostType = CommonUtility::sendPostType("Group");
                $streamObj->PostId = (string) $followId;
                $streamObj->GroupId = $followId;
                $streamObj->GroupFollowers = (int) $userId;
            }
            if ($actionType == "SubGroupFollow" || $actionType == "SubGroupUnFollow") {
                $streamObj->PostType = CommonUtility::sendPostType("SubGroup");
                $streamObj->PostId = (String) $followId;
                $streamObj->SubGroupId = (String) $followId;
                $streamObj->SubGroupFollowers = (int) $userId;
            }
            if ($actionType == "CurbsideCategoryFollow" || $actionType == "CurbsideCategoryUnFollow") {
                $streamObj->PostType = CommonUtility::sendPostType("CurbsideCategory");
                $streamObj->CurbsideConsultCategory = $obj->CategoryName;
                $streamObj->CurbsidePostCount = count($obj->Post);
                $streamObj->CurbsideCategoryId = $followId;
                $streamObj->PostId = (String) $obj->_id;
                $streamObj->CurbsideCategoryFollowers = (int) $userId;
            }

            try {
                Yii::app()->amqp->stream(json_encode($streamObj));
            } catch (Exception $ex) {
                error_log("exceoption----" . $ex->getMessage());
            }
        } catch (Exception $exc) {
            Yii::log($exc->getMessage(), 'error', 'application');
        }
    }

    public static function getUserPrivilege() {
        try {
            $privileges = Yii::app()->session['UserPrivileges'];
            $privilegeBean = new PrivilegeBean();
            foreach ($privileges as $privilege) {
                if ($privilege['Status'] == 1) {
                    if ($privilege['Action'] == 'Create_Group')
                        $privilegeBean->canCreateGroup = 1;
                    if ($privilege['Action'] == 'Survey')
                        $privilegeBean->canSurvey = 1;
                    if ($privilege['Action'] == 'Event')
                        $privilegeBean->canEvent = 1;
                    if ($privilege['Action'] == 'Delete')
                        $privilegeBean->canDelete = 1;
                    if ($privilege['Action'] == 'Promote_To_Featured_Items')
                        $privilegeBean->canFeature = 1;
                    if ($privilege['Action'] == 'Private_Messaging')
                        $privilegeBean->canMessage = 1;
                    if ($privilege['Action'] == 'Manage_Flagged_Posts')
                        $privilegeBean->canManageFlaggedPost = 1;
                    if ($privilege['Action'] == 'Mark_As_Abuse')
                        $privilegeBean->canAbuse = 1;
                    if ($privilege['Action'] == 'Promote_Post')
                        $privilegeBean->canPromote = 1;
                    if ($privilege['Action'] == 'Manage_Post')
                        $privilegeBean->canManagePost = 1;
                    if ($privilege['Action'] == 'Abuse_Scan')
                        $privilegeBean->canManageAbuseScan = 1;
                    if ($privilege['Action'] == 'Analytics')
                        $privilegeBean->canViewAnalytics = 1;
                    if ($privilege['Action'] == 'Can_Copy_URL')
                        $privilegeBean->canCopyURL = 1;
                    if ($privilege['Action'] == 'Upload_Media')
                        $privilegeBean->canUploadMedia = 1;
                }
                 
            }
            return $privilegeBean;
        } catch (Exception $e) {
            
        }
    }

    /**
     * @author Sagar pathepalli 
     * @param type $streamPostData
     * @return array
     * 
     */
    static function prepareProfileIntractionData($UserId, $streamPostData) {
        try {
            $streamIdArray = array();
            $groupNameObject = "";
            $isGroupPostAdmin = "false";
            foreach ($streamPostData as $key => $data) {
                       
                if (($data->PostType < 7 || $data->PostType == 11 || $data->PostType == 12 || $data->PostType == 13) && $data->RecentActivity != "UnFollow") {
                    $data->SessionUserId = $UserId;
                    $isPromoted = isset($data->IsPromoted) ? $data->IsPromoted : 0;
                    $createdOn = $data->CreatedOn;
                    $originalPostTime = $data->OriginalPostTime;
                    $data->PostOn = CommonUtility::styleDateTime($createdOn->sec);
                    $postType = CommonUtility::postTypebyIndex($data->PostType, $data->CategoryType);
                    $data->PostTypeString = $postType;
                    $createdOn = $data->CreatedOn;
                    if ($data->GroupId != '') {
                        $isGroupPostAdmin = ServiceFactory::getSkiptaPostServiceInstance()->checkIsGroupAdminById($data);
                        $groupNameObject = ServiceFactory::getSkiptaPostServiceInstance()->getGroupNameById($data->GroupId);
                        $data->ConversationVisibility = $groupNameObject->ConversationVisibility;
                        if ($isGroupPostAdmin == 'true' && $groupNameObject->ConversationVisibility == 0) {
                            unset($streamPostData[$key]);
                            continue;
                        }

                        $data->isGroupAdminMember = $isGroupPostAdmin;
                        
                            if ($groupNameObject->GroupMembers != null) {
                            $isFollowingGroup = in_array($UserId, $groupNameObject->GroupMembers);
                        } else {
                            $isFollowing = 0;
                        }
                        
                        if($groupNameObject->IsIFrameMode == 1 || ($groupNameObject->CustomGroup == 1 && $groupNameObject->IsHybrid == 0)){
                            $data->ConversationVisibility = 1;
                        }                        
                        if ($isFollowingGroup == 0) {
                            unset($streamPostData[$key]);
                            continue;
                        }                        
                        //if($data->IsGroupPostVisible == 0){
                            $data->MainGroupName = $groupNameObject->GroupName;
                            $data->MainGroupId = $groupNameObject->_id;
                            $data->GroupProfileImage = $groupNameObject->GroupProfileImage;
                           if (isset($groupNameObject->AddSocialActions)) {
                                        $data->AddSocialActions = $groupNameObject->AddSocialActions;
                                    }
                            $grouptagsFreeDescription = strip_tags(($groupNameObject->GroupDescription));
                            $grouptagsFreeDescription = str_replace("&nbsp;", " ", $grouptagsFreeDescription);

                            $groupdescriptionLength = strlen($grouptagsFreeDescription);
                            if ($groupdescriptionLength > 240) {
                                $groupdescription = CommonUtility::truncateHtml($groupNameObject->GroupDescription, 240);
                                $data->GroupDescription = trim($groupdescription) . "  ...";
                            } else {
                                $data->GroupDescription = $groupNameObject->GroupDescription;
                            }
                            if ($isGroupPostAdmin == 'true') {
                                if ($groupNameObject != 'failure') {
                                    $mainGroupCollection = $groupNameObject;
                                    if ($groupNameObject->IsPrivate == 1) {
                                        $groupsDataArray['groupMembers'] = $groupNameObject->GroupMembers;

                                        if($groupNameObject->GroupMembers != null ){
                                        $isFollowing = in_array($UserId, $groupNameObject->GroupMembers);
                                        }else{
                                           $isFollowing=0; 
                                        }

                                        if ($isFollowing == 1) {
                                            $data->ShowPrivateGroupPost = 1;
                                        } else {
                                            $data->ShowPrivateGroupPost = 0;
                                            unset($streamPostData[$key]);
                                            continue;
                                        }
                                    } else {
                                        $data->ShowPrivateGroupPost = 1;
                                    }
                                }
                            }
                        //}
                        
                    }
                    $recentActivityUser1 = UserCollection::model()->getTinyUserCollection($data->UserId);
                    


                    $textWithOutHtml = $data->PostText;
                    $textLength = strlen($textWithOutHtml);
                    if (isset($data->PostTextLength) && $data->PostTextLength > 240 && $data->PostTextLength < 500) {

                        $appendData = '<span   data-placement="bottom" rel="tooltip"  data-original-title="See More"  onclick="expandpostDiv(' . "'" . $data->_id . "'" . ')"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                    } else {

                        $appendData = ' <span class="postdetail"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-id="' . $data->_id . '" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                    }
                    if (isset($data->PostTextLength) && ($data->PostTextLength == 240 || $data->PostTextLength > 500)) {
                        // $description = CommonUtility::truncateHtml($textWithOutHtml, 240,$appendData);
                        $description = CommonUtility::truncateHtml($textWithOutHtml, 240, '...', true, true, $appendData);
                        $text = $description;
                        $data->PostText = $text;
                    }
                    if (isset($data->OriginalUserId) && $data->OriginalUserId != $data->UserId) {
                        $originalPostTime = $data->OriginalPostTime;
                        $data->OriginalPostPostedOn = CommonUtility::styleDateTime($originalPostTime->sec);
                        $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->OriginalUserId);
                        $data->OriginalUserDisplayName = $tinyOriginalUser['DisplayName'];
                        $data->OriginalUserProfilePic = $tinyOriginalUser['profile250x250'];
                    }
                    $displayName1 = ($UserId == $recentActivityUser1['UserId']) ? 'You' : $recentActivityUser1['DisplayName'];
                    $data->UserDisplayName = $displayName1;
                    $data->UserProfilePic = $recentActivityUser1['profile250x250'];
                    if($data->PostFollowers!=null){
                    $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);
                    }
                    $data->FollowersCount = $data->FollowCount;
                    if($data->LoveUserId!=null){
                    $data->IsLoved = in_array($UserId, $data->LoveUserId);
                    }
                    
                    $data->IsSurveyTaken = $data->RecentActivity == "Survey" ? 1 : 0;
                    $data->TotalSurveyCount = $data->OptionOneCount + $data->OptionTwoCount + $data->OptionThreeCount + $data->OptionFourCount;
                    if ($data->ActionType == 'Comment' && $data->Comments) {
                        $commentsSize = sizeof($data->Comments);
                        $data->CommentMessage = $data->Comments[$commentsSize - 1]['CommentText'];
                    }
                    $commentedUsers = UserStreamCollection::model()->getCommentedUsersForPost($data->PostId, $UserId);
                  
                    if($commentedUsers!=null){
                      $IsUserCommented = in_array((int) $UserId, $commentedUsers);  
                       $data->IsCommented = $IsUserCommented;
                    }
                   
                    
                   
                    $image = "";
                    if ($data->IsMultiPleResources > 0) {
                        if (isset($data->Resource["ThumbNailImage"])) {
                            if (isset($data->Resource['ThumbNailImage'])) {
                                $image = $data->Resource['ThumbNailImage'];
                            } else {
                                $image = "";
                            }
                        }

                        $data->ArtifactIcon = $image;
                        $data->Extension = $data->Resource["Extension"];
                    }

                    if ($data->PostType == 2) {
                        $eventStartDate = $data->StartDate;
                        //error_log("-+++++++++++++end date ate+++++++1++++++++++++++++++++++++".$data->EndDate);
                        $eventEndDate = $data->EndDate;
                        //error_log("-++++++++++++++++++++++++++++2+++++++++++++++".$eventEndDate->sec);
                        $data->Title = $data->Title;
                        $data->StartDate = date("Y-m-d", $eventStartDate->sec);
                        $data->EndDate = date("Y-m-d", $eventEndDate->sec);
                        //error_log("-+++2222++++++++++++++++++++++++3++++++++++++++++".$data->EndDate);
                        $data->EventStartDay = date("d", $eventStartDate->sec);
                        $data->EventStartDayString = date("l", $eventStartDate->sec);
                        $data->EventStartMonth = date("M", $eventStartDate->sec);
                        $data->EventStartYear = date("Y", $eventStartDate->sec);
                        $data->EventEndDay = date("d", $eventEndDate->sec);
                        $data->EventEndDayString = date("l", $eventEndDate->sec);
                        $data->EventEndMonth = date("M", $eventEndDate->sec);
                        $data->EventEndYear = date("Y", $eventEndDate->sec);
                        $data->IsEventAttend = 1;
                        if ($eventEndDate->sec <= time()) {
                            $data->CanPromotePost = 0;
                        }
                    } elseif ($data->PostType == 3) {
                        $surveyExpiryDate = $data->ExpiryDate;
                        $data->Title = $data->Title;
                        if (isset($surveyExpiryDate->sec) && $surveyExpiryDate->sec <= time()) {
                            $data->CanPromotePost = 0;
                            $data->ExpiryDate = date("Y-m-d", $surveyExpiryDate->sec);
                        }
                    }
                    if ($data->SessionUserId == $data->UserId) {
                        if (trim($data->StreamNote) == "is following") {
                            $data->StreamNote = " are following ";
                        }
                        if (trim($data->StreamNote) == "is attending") {
                            $data->StreamNote = " are attending ";
                        }
                        if (trim($data->StreamNote) == "has answered") {
                            $data->StreamNote = " have answered ";
                        }
                        if (trim($data->StreamNote) == "has been invited to") {
                            $data->StreamNote = " have been invited  to ";
                        }
                        if (trim($data->StreamNote) == "has invited to") {
                            if(isset($data->InviteUsers)){
                             $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->InviteUsers);   
                            }                            
                            $InviteUserName=$tinyOriginalUser['DisplayName'];
                            $data->StreamNote = " have invited  <a style='cursor:pointer' data-id='". $data->InviteUsers ."' class='userprofilename'><b>". $InviteUserName." </b></a> to";
                        }
                        if (trim($data->StreamNote) == "has Played") {
                            $data->StreamNote = " have Played ";
                        }
                        if (trim($data->StreamNote) == "has Resume") {
                            $data->StreamNote = " have Resumed ";
                        }
                    }
                } else {
                    unset($streamPostData[$key]);
                }
            }

            return $streamPostData;
        } catch (Exception $ex) {
            Yii::log("********EXCEPTION***************************" . $ex->getMessage(), 'error', 'application');
        }
    }

    static function FindElementAndReplace($input, array $arrayElements) {
        $arrayReplaceElements = array();
        $abuseWords = array();
        for ($i = 0; $i < sizeof($arrayElements); $i++) {
            $abuseWords[$i] = "/\b$arrayElements[$i]\b/i";
            $arrayReplaceElements[$i] = "<span contenteditable='false' class='atmention_error dd-tags'><b>" . $arrayElements[$i] . "</b></span>";
        }
        $output = preg_replace($abuseWords, $arrayReplaceElements, $input);
        return $output;
    }

    static function FindHashTagAndReplace($input, array $arrayElements) {
        $arrayReplaceElements = array();
        $hashtags = array();
        for ($i = 0; $i < sizeof($arrayElements); $i++) {
            $ele = $arrayElements[$i];
            $hashtags[$i] = "/\b#$ele\b/i";
            $arrayReplaceElements[$i] = "<span class=\"dd-tags hashtag\"><b>#$arrayElements[$i]</b></span>";
        }
        $output = preg_replace($hashtags, $arrayReplaceElements, $input);
        return $output;
    }

    public static function reloadUserPrivilegeAndData($userId) {
        $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userId, Yii::app()->session['UserStaticData']->UserTypeId);
        Yii::app()->session['UserPrivileges'] = $userPrivileges;
        Yii::app()->session['UserPrivilegeObject'] = CommonUtility::getUserPrivilege();
        Yii::app()->session['UserStaticData'] = ServiceFactory::getSkiptaUserServiceInstance()->getUserByType(Yii::app()->session['UserStaticData']->Email, 'Email');
        Yii::app()->session['IsAdmin'] = Yii::app()->session['UserStaticData']->UserTypeId;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * 
     * @param type $type
     * @return int
     */
    static function postStringTypebyIndex($type, $isGroupCategory = 0) {
        try {

            $returnValue = 0;
            if ($type == 1) {
                $returnValue = '  Post';
            } else if ($type == 2) {
                $returnValue = '  Event ';
            } else if ($type == 3) {
                $returnValue = ' Survey ';
            } else if ($type == 4) {
                // Anonymous Post
                $returnValue = '  Post ';
            } else if ($type == 5) {
                $name = Yii::t('translation', 'CurbsideConsult');
                $returnValue = "  $name ";
            } else if ($type == 6) {
                $returnValue = '  Group ';
            } else if ($type == 7) {
                $returnValue = '  SubGroup ';
            } else if ($type == 11) {
                $returnValue = ' News ';
            } else if ($type == 12) {
                $returnValue = ' Game ';
            }
            else if ($type == 13) {
                $returnValue = ' Badge ';
            }

            if ($isGroupCategory == 3) {
                if ($type == 1) {
                    $returnValue = '  Group Post';
                } else if ($type == 2) {
                    $returnValue = '  Group Event ';
                } else if ($type == 3) {
                    $returnValue = '  Group Survey ';
                }
            }
            if ($isGroupCategory == 7) {
                if ($type == 1) {
                    $returnValue = '  SubGroup Post';
                } else if ($type == 2) {
                    $returnValue = '  SubGroup Event ';
                } else if ($type == 3) {
                    $returnValue = ' SubGroup Survey ';
                }
            }

            return $returnValue;
        } catch (Exception $exc) {
            Yii::log("send post type in common utility" . $exc->getMessage(), 'error', 'application');
        }
    }

    /** @author Vamsi Krishna 
     * THis method is used to prepare featured items 
     * @param type $userId
     * @param type $abusedPostData
     * @param type $categoryType
     * @return type
     */
    static function prepareFeaturedPostData($userId, $abusedPostData, $categoryType) {
        try {
            foreach ($abusedPostData as $data) {
                if ((int) $data->CategoryType == 2) {
                    $postObj = CurbsidePostCollection::model()->getPostById($data->PostId);
                } else if ((int) $data->CategoryType == 8) {
                    $postObj = CuratedNewsCollection::model()->getPostById($data->PostId);
                } else if ((int) $data->CategoryType == 9) {
                    $postObj = GameCollection::model()->getPostById($data->PostId);
                } else {
                    $postObj = PostCollection::model()->getPostById($data->PostId);
                }

                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($postObj->UserId);
                $data->OriginalUserDisplayName = $tinyOriginalUser['DisplayName'];
                $data->OriginalUserProfilePic = $tinyOriginalUser['profile250x250'];
                $data->OriginalUserId = $data->UserId;
                $originalPostTime = $data->CreatedOn;
                $data->Type = $postObj->Type;
                $data->OriginalPostPostedOn = CommonUtility::styleDateTime($originalPostTime->sec);
                $postType = CommonUtility::postTypebyIndex($data->Type, $data->CategoryType);
                $data->PostTypeString = $postType;
                $image = "";
                $filetype = "";
                if (sizeof($postObj->Resource) > 0) {
                    $filetype = isset($postObj->Resource[sizeof($postObj->Resource) - 1]["Extension"]) ? $postObj->Resource[sizeof($postObj->Resource) - 1]["Extension"] : "";
                    if (isset($postObj->Resource[sizeof($postObj->Resource) - 1]["ThumbNailImage"])) {
                        $image = $postObj->Resource[sizeof($postObj->Resource) - 1]["ThumbNailImage"];
                    } else {
                        $image = "";
                    }
                }
                $data->Extension = $filetype;
                $data->ArtifactIcon = $image;
                $data->IsMultiPleResources = sizeof($postObj->Resource) > 2 ? 2 : sizeof($postObj->Resource);
                if ($postObj->Type == 2) {
                    $eventStartDate = $postObj->StartDate;
                    $eventEndDate = $postObj->EndDate;
                    $data->Title = $postObj->Title;
                    $data->StartDate = date("Y-m-d", $eventStartDate->sec);
                    $data->EndDate = date("Y-m-d", $eventEndDate->sec);

                    $data->EventStartDay = date("d", $eventStartDate->sec);
                    $data->EventStartDayString = date("l", $eventStartDate->sec);

                    $data->EventStartMonth = date("M", $eventEndDate->sec);
                    $data->EventStartYear = date("Y", $eventEndDate->sec);

                    $data->EventEndDay = date("d", $eventEndDate->sec);
                    $data->EventEndDayString = date("l", $eventEndDate->sec);
                    $data->EventEndMonth = date("M", $eventEndDate->sec);
                    $data->EventEndYear = date("Y", $eventEndDate->sec);
                    $data->Location = $postObj->Location;
                    $data->StartTime = $postObj->StartTime;
                    $data->EndTime = $postObj->EndTime;
                }
                if ($postObj->Type == 3) {
                    $data->Title = $postObj->Title;
                    $data->OptionOne = $postObj->OptionOne;
                    $data->OptionTwo = $postObj->OptionTwo;
                    $data->OptionThree = $postObj->OptionThree;
                    $data->OptionFour = $postObj->OptionFour;
                    //$data->ExpiryDate = $postObj->ExpiryDate->sec;
                }
                if ($postObj->Type == 5) {

//                    $curbsideCategory = CurbSideCategoryCollection::model()->getCurbsideCategoriesByCategoryId($data->CategoryType);
//                   
//                    $postObj->CurbsideConsultCategory="<a style='cursor:pointer' data-id='".$data->CategoryType."' class='curbsideCategory'><b>".isset($curbsideCategory['CategoryName'])?$curbsideCategory['CategoryName']:''."</b></a>";
//                   
//                    $postObj->CurbsideConsultTitle=$postObj->Subject;
                }
                $data->CategoryType = $data->CategoryType;
            }

            return $abusedPostData;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'application');
        }
    }

    /**
     * @author Sagar
     * @param type $input
     * @param array $referers
     * @return array of matched eemets
     */
    static function ArrayElementsExistsInString($input, array $referers) {
        $returnArray = array();
        foreach ($referers as $referer) {
            if (preg_match("/\b$referer\b/i", $input)) {
                array_push($returnArray, $referer);
            }
        }
        return $returnArray;
    }

    static function GetNetworkDetailsUtility($urlORname) {
        return ServiceFactory::getSkiptaUserServiceInstance()->getNeworkDetailsService($urlORname);
    }

    static function isValidURL($url) {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }

    static function strip_tags($tags_to_strip, $string) {
        foreach ($tags_to_strip as $tag) {
            $string = preg_replace("/<\/?" . $tag . "(.|\s)*?>/", '', $string);
        }
        return $string;
    }

    static function millisecondsTOdate($mil, $format) {
        $seconds = $mil / 1000;
        return date($format, $seconds);
    }

    /**
     * @author suresh reddy 
     *  by coookie based on  need to reload their primary detail to session 
     * @param type $userObj
     */
    public static function reloadUserPrivilegeAndDataByCookie($userObj) {
        try {
            $tinyUserCollectionObj = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($userObj->UserId);
            $userPrivileges = ServiceFactory::getSkiptaUserServiceInstance()->getUserActionsByUserType($userObj->UserId, $userObj->UserTypeId);
            $userFollowingGroups = ServiceFactory::getSkiptaUserServiceInstance()->groupsUserFollowing($userObj->UserId);

            $userHierarchy = ServiceFactory::getSkiptaUserServiceInstance()->getUserHierarchy($userObj->UserId);
            Yii::app()->session['UserFollowingGroups'] = $userFollowingGroups;
            Yii::app()->session['TinyUserCollectionObj'] = $tinyUserCollectionObj;
            Yii::app()->session['UserPrivileges'] = $userPrivileges;
            Yii::app()->session['UserPrivilegeObject'] = CommonUtility::getUserPrivilege();
            Yii::app()->session['UserStaticData'] = $userObj;
            Yii::app()->session['IsAdmin'] = Yii::app()->session['UserStaticData']->UserTypeId;
            Yii::app()->session['UserHierarchy'] = $userHierarchy;
        } catch (Exception $e) {
            Yii::log("Excepiton ", 'application', 'error');
        }
    }

    /**
     * @author Sagar Pathapelli
     * @usage This method is used to insert the image in xls file.
     * @param type $r //php xls object 
     * @param type $activeSheet
     * @param type $imagePath
     * @param type $coordinates
     * @param type $offSetX
     * @param type $offSetY
     */
    public static function insertImageInExcelSheet($r, $activeSheet, $imagePath, $coordinates, $offSetX, $offSetY) {
        try {
            $objDrawingPType = new PHPExcel_Worksheet_Drawing();
            $objDrawingPType->setWorksheet($r->setActiveSheetIndex($activeSheet));
            $objDrawingPType->setPath($imagePath);
            $objDrawingPType->setCoordinates($coordinates);
            $objDrawingPType->setOffsetX($offSetX);
            $objDrawingPType->setOffsetY($offSetY);
        } catch (Exception $e) {
            Yii::log("Excepiton ", 'application', 'error');
        }
    }

/**
     * @autor Sagar Pathapelli
     * @usage This method is used for rendering the data dynamically in xls file
     * @param type $r
     * @param type $initialRowVal------from which row the data need to be inserted
     * @param type $labelArray---------header array
     * @param type $dataArray----------associative array of data
     */

    public static function insertDataDynamicallyInExcelSheet($r, $initialRowVal, $labelArray, $dataArray) {
        try {
            $alphabetsArray = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
            $objWorksheet = $r->getActiveSheet();
            $rowsWidth = array();
            //-----------inserting headers----------------
            if (count($labelArray) > 0) {
                for ($i = 0; $i < count($labelArray); $i++) {
                    $celval = (string) ($alphabetsArray[$i] . $initialRowVal);
                    $r->getActiveSheet()->setCellValue($celval, $labelArray[$i]);
                    //setting column width
                    $headerLength = strlen($labelArray[$i]) + 4;
                    $headerLength = $headerLength < 8 ? 8 : $headerLength; //--minimum width of column is 8
                    $r->getActiveSheet()->getColumnDimension($alphabetsArray[$i])->setWidth($headerLength);
                    $rowsWidth[$alphabetsArray[$i]] = $headerLength;
                }
            }
            //------------inserting data-----------------
            if (count($dataArray) > 0) {
                $rowVal = $initialRowVal;
                for ($j = 0; $j < count($dataArray); $j++) {
                    $rowVal = $rowVal + 1;
                    $objWorksheet->insertNewRowBefore($rowVal + 1, 1);
                    for ($k = 0; $k < count($dataArray[$j]); $k++) {
                        $celval = (string) ($alphabetsArray[$k] . $rowVal);
                        $r->getActiveSheet()->setCellValue($celval, $dataArray[$j][$k]);

                        $datalength = strlen($dataArray[$j][$k]);
                        $datalength = $datalength + 4;
                        if ($datalength > $rowsWidth[$alphabetsArray[$k]]) {
                            //updating column width
                            $r->getActiveSheet()->getColumnDimension($alphabetsArray[$k])->setWidth($datalength);
                            $rowsWidth[$alphabetsArray[$k]] = $datalength;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Yii::log("Excepiton ", 'application', 'error');
        }
    }

    static function convert_time_zone($sec, $to_tz, $from_tz = "", $type = "") {
        //error_log("---convert_time_zone--".$to_tz);
        // error_log("get dedfault timezone-------".date_default_timezone_get());
        $date_time = date("Y-m-d H:i:s", $sec);
        if ($from_tz == "") {
            $from_tz = date_default_timezone_get();
        }
        $time_object = new DateTime($date_time, new DateTimeZone($from_tz));
        $time_object->setTimezone(new DateTimeZone($to_tz));
        if ($type == "sec") {
            return strtotime($time_object->format('Y-m-d H:i:s'));
        } else {
            return $time_object->format('Y-m-d H:i:s');
        }
    }

    static function convert_date_zone($sec, $to_tz, $from_tz = "", $type = "") {
        
        $date_time = date("Y-m-d H:i:s", $sec);
        if ($from_tz == "") {
            $from_tz = date_default_timezone_get();
        }
        $time_object = new DateTime($date_time, new DateTimeZone($from_tz));
        $time_object->setTimezone(new DateTimeZone($to_tz));
        return strtotime($time_object->format('Y-m-d'));
    }

    static function currentdate_timezone($to_tz) {
        $date = date("Y-m-d");
        $date_object = new DateTime($date, new DateTimeZone(date_default_timezone_get()));
        $date_object->setTimezone(new DateTimeZone($to_tz));
        return strtotime($date_object->format('Y-m-d'));
    }

    static function currenttime_timezone($to_tz) {
        $date = date("Y-m-d H:i:s");
        $date_object = new DateTime($date, new DateTimeZone(date_default_timezone_get()));
        $date_object->setTimezone(new DateTimeZone($to_tz));
        return strtotime($date_object->format('Y-m-d H:i:s'));
    }

    static function currentSpecifictime_timezone($to_tz) {
        $date = date("Y-m-d H:i:s");
        $date_object = new DateTime($date);
        $date_object->setTimezone(new DateTimeZone($to_tz));
        return strtotime($date_object->format('Y-m-d H:i:s'));
    }

    static function generateSecurityToken() {
        $rand = rand(0, 10000);
        $securityToken = Yii::app()->params['phasePhrase'] . "-" . $rand . "-" . time();
        $securityToken = base64_encode($securityToken);
        return $securityToken;
    }

    /**
     * @author suresh Reddy
     * @param type $streamPostData
     * @return array
     * 
     */
    static function prepareStreamDataForMobile($UserId, $streamPostData, $UserPrivileges, $isHomeStream = 0, $PostAsNetwork = 0, $timezone = '', $previousStreamIdArray=array()) {

        try {
            $streamIdArray = array();
            $zeroRecordArray = array();
            $oneRecordArray = array();
            $currentStreamIdArray = array();
            $totalStreamIdArray = array();
            foreach ($streamPostData as $key => $data) {
                array_push($totalStreamIdArray, (string)$data->PostId);
                if (!in_array((string)$data->PostId, $previousStreamIdArray)) {
                $data->IsHomeStream = $isHomeStream;
                $recentActivityUser2 = "";
                $isPromoted = isset($data->IsPromoted) ? $data->IsPromoted : 0;
                $data->IsIFrameMode = 0;
                if ($data->CategoryType == 3) {
                    if (isset($data->GroupId)) {

                        $groupData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        if ($groupData != "failure") {
                            $data->IsFollowingEntity = in_array($UserId, $groupData->GroupMembers);
                            if ($groupData->IsPrivate == 1 && $isHomeStream == 1 && $data->IsFollowingEntity == 0) {

                                unset($streamPostData[$key]);
                                continue;
                            }
                            $isIframeModeValue = (isset($groupData->IsIFrameMode) && $groupData->IsIFrameMode == 1) ? 1 : 0;
                            if ($isIframeModeValue == 1 && in_array($UserId, $groupData->GroupMembers)) {

                                $data->IsIFrameMode = 1;
                            }
                            $data->GroupName = $groupData->GroupName;
                            $data->MainGroupId = $groupData->_id;
                            $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;
                            $data->IsPrivate = $groupData->IsPrivate;

                            if (in_array($data->OriginalUserId, $groupData->GroupAdminUsers)) {
                                $data->isGroupAdminPost = 'true';
                            }
                            if ($data->IsIFrameMode != 1) {
                                $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;

                                /* for more */
                                $tagsFreeDescription = strip_tags(($groupData->GroupDescription));
                                $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);

                                $descriptionLength = strlen($tagsFreeDescription);
                                // error_log("&&&&&&&------group--".$groupData->GroupDescription);
                                /* for more */


                                if ($descriptionLength > 240) {
                                    $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                                    $data->GroupDescription = trim($description) . "  ...";
                                } else {
                                    $data->GroupDescription = $groupData->GroupDescription;
                                }



                                $data->GroupFollowersCount = sizeof($data->PostFollowers);
                                $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);


                                if ($data->isDerivative == 0) {
                                    if ($isHomeStream == 1 && (!($data->IsFollowingEntity) || $isPromoted == 1)) {
                                        unset($streamPostData[$key]);
                                        continue;
                                    }
                                } else {
                                    
                                }
                            }
                        }
                    }
                }
                if ($data->CategoryType == 7) {
                    if (isset($data->SubGroupId)) {

                        $groupData = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                        $gData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        if ($groupData != "failure") {
                            $data->SubGroupImage = Yii::app()->params['ServerURL'] . $groupData->SubGroupProfileImage;
                            $data->SubGroupName = $groupData->SubGroupName;
                            $data->GroupName = $gData->GroupName;

                            /* for more */
                            $tagsFreeDescription = strip_tags(($groupData->SubGroupDescription));
                            $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);

                            $descriptionLength = strlen($tagsFreeDescription);
                            /* for more */

                            if ($descriptionLength > 240) {
                                $description = CommonUtility::truncateHtml($groupData->SubGroupDescription, 240);
                                $data->SubGroupDescription = trim($description) . "  ...";
                            } else {
                                $data->SubGroupDescription = $groupData->SubGroupDescription;
                            }


                            $data->SubGroupFollowersCount = sizeof($groupData->SubGroupMembers);
                            $data->IsFollowingEntity = in_array($UserId, $groupData->SubGroupMembers);
                            if ($data->isDerivative == 0) {
                                if ($isHomeStream == 1 && (!($data->IsFollowingEntity) || $isPromoted == 1)) {
                                    unset($streamPostData[$key]);
                                    continue;
                                }
                            }
                        }
                    }
                }

                $data->IsPromoted = $isPromoted;

                if ($data->CategoryType == 9) {
                    
                } else {
                    if (sizeof($streamIdArray) > 0) {
                        if (array_key_exists("$data->PostId", $streamIdArray)) {
                            if ($streamIdArray["$data->PostId"] == $isPromoted) {
                                unset($streamPostData[$key]);
                                continue;
                            }
//                        elseif($streamIdArray["$data->PostId"]==$isPromoted && $data->UserId!=0){                            
//                            unset($streamPostData[$key]);
//                        }
                        }
                    }
                }


                $streamIdArray["$data->PostId"] = $isPromoted;
                $data->SessionUserId = $UserId;
                $data->CanDeletePost = ($data->OriginalUserId == $data->SessionUserId) ? 1 : 0;
                if (is_array($UserPrivileges)) {
                    foreach ($UserPrivileges as $value) {
                        if ($value['Status'] == 1) {
                            if ($value['Action'] == 'Delete') {
                                $data->CanDeletePost = 1;
                            } else if ($value['Action'] == 'Promote_Post') {
                                $data->CanPromotePost = 1;
                            } else if ($value['Action'] == 'Promote_To_Featured_Items') {
                                $data->CanFeaturePost = 1;
                            } else if ($value['Action'] == 'Mark_As_Abuse') {
                                $data->CanMarkAsAbuse = 1;
                            }
                        }
                    }
                }

                $createdOn = $data->CreatedOn;
                $originalPostTime = $data->OriginalPostTime;
                if ($isPromoted == 1) {
                    $data->PostOn = CommonUtility::styleDateTime($originalPostTime->sec, 'mobile');
                    $data->PromotedDate = CommonUtility::styleDateTime($createdOn->sec);
                    $currentDate = date('Y-m-d', time());
                    $postPromotedDate = date('Y-m-d', $createdOn->sec);
                    if ($postPromotedDate < $currentDate) {
                        $data->IsPromoted = 0;
                    }
                    if ($data->CanPromotePost == 1) {
                        if ($postPromotedDate > $currentDate) {
                            $data->CanPromotePost = 0;
                        }
                    }
                    if ($data->CanDeletePost == 1 && $data->PromotedUserId != $UserId) {
                        $data->CanDeletePost = 0;
                    }
                } else {

                    $data->PostOn = CommonUtility::styleDateTime($createdOn->sec, 'mobile');

//                    if($data->CategoryType==2){
//                        $postDetails=  CurbsidePostCollection::model()->getPostById($data->PostId);
//                        $postCollectionDate=$postDetails->CreatedOn;
//                       $data->PostOn = CommonUtility::styleDateTime($postCollectionDate->sec); 
//                    }else if($data->CategoryType==1) {
//                        $postDetails=  PostCollection::model()->getPostById($data->PostId);
//                        $postCollectionDate=$postDetails->CreatedOn;
//                        $data->PostOn = CommonUtility::styleDateTime($postCollectionDate->sec); 
//                    }else{
//                        $data->PostOn = CommonUtility::styleDateTime($originalPostTime->sec);  
                    //  }
                }
                $data->OriginalPostPostedOn = CommonUtility::styleDateTime($originalPostTime->sec, 'mobile');
                $textWithOutHtml = $data->PostText;

                $textLength = strlen($textWithOutHtml);
                if (isset($data->WebUrls) && !empty($data->WebUrls) && $data->WebUrls != null) {
                    if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') {
                        $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($data->WebUrls[0]);

                        $data->WebUrls = $snippetdata;
                    } else {
                        $data->WebUrls = "";
                    }
                }

//
//                /*for more*/
//                        $tagsFreeDescription= strip_tags(($data->PostText));
//                        $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
//                 
//                        $descriptionLength =  strlen($tagsFreeDescription);
//                       
//                       /*for more*/
                // $textLength=strlen($textWithOutHtml);

                if (isset($data->PostTextLength) && $data->PostTextLength > 240 && $data->PostTextLength < 500) {
                    $appendData = '<span class="seemore tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="See More" onclick="expandpostDiv(' . "'" . $data->_id . "'" . ')"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                } else {

                    $appendData = ' <span class="postdetail tooltiplink" data-id=' . $data->_id . ' data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                }
                // error_log("post length before-------------".$data->PostTextLength);
                // error_log("post text------------".$data->PostText);
                $data->PostCompleteText = $data->PostText;
                if ($data->PostTextLength > 240) {
                    $description = CommonUtility::truncateHtml($data->PostText, 240, '...', true, true, $appendData);

                    //  error_log("post desc------------".$description);
                    $text = $description;
                    $data->PostText = $text;
                }
                // error_log("post text after------------".$data->PostText);
                //  $data->PostText .= ' <span class="postdetail" data-postid="'.$data->PostId.'" data-categoryType="'.$data->CategoryType.'" data-postType="'.$data->PostType.'"> <i class="fa fa-ellipsis-h"></i></span>';
                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->OriginalUserId);
                $postType = CommonUtility::postTypebyIndex($data->PostType, $data->CategoryType);
                $data->PostTypeString = $postType;
                $createdOn = $data->CreatedOn;
                $originalPostTime = $data->OriginalPostTime;
                $recentActivity1UserId = "";
                $recentActivity2UserId = "";
                if ($data->RecentActivity == "Post") {
                    $recentActivity1UserId = $data->OriginalUserId;
                    $recentActivity2UserId = "";
                }
                //elseif ($data->RecentActivity=="HashTagFollow") {
                //   $recentActivity1UserId=$data->HashTagPostUserId;
                //           }
                elseif ($data->RecentActivity == "UserMention") {
                    $recentActivity1UserId = $data->MentionUserId;
                } elseif ($data->RecentActivity == "Love") {
                    $LoveUserId = array_values(array_unique($data->LoveUserId));
                    if (sizeof($LoveUserId) > 1) {
                        $recentActivity1UserId = $LoveUserId[sizeof($LoveUserId) - 1];
                        $recentActivity2UserId = $LoveUserId[sizeof($LoveUserId) - 2];
                    } elseif (sizeof($LoveUserId) == 1) {
                        $recentActivity1UserId = $LoveUserId[sizeof($LoveUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "Comment") {
                    $CommentUserId = array_values(array_unique($data->CommentUserId));
                    if (sizeof($CommentUserId) > 1) {
                        $recentActivity1UserId = $CommentUserId[sizeof($CommentUserId) - 1];
                        $recentActivity2UserId = $CommentUserId[sizeof($CommentUserId) - 2];
                    } elseif (sizeof($CommentUserId) == 1) {
                        $recentActivity1UserId = $CommentUserId[sizeof($CommentUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "UserFollow") {

                    $FollowUserId = array_values(array_unique($data->UserFollowers));
                    if (count($FollowUserId) > 1) {
                        $recentActivity1UserId = $FollowUserId[sizeof($FollowUserId) - 1];
                        $recentActivity2UserId = $FollowUserId[sizeof($FollowUserId) - 2];
                    } elseif (sizeof($FollowUserId) == 1) {
                        $recentActivity1UserId = $FollowUserId[sizeof($FollowUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "PostFollow") {
                    $PostFollow = array_values(array_unique($data->PostFollowers));
                    if (count($PostFollow) > 1) {
                        $recentActivity1UserId = $PostFollow[sizeof($PostFollow) - 1];
                        $recentActivity2UserId = $PostFollow[sizeof($PostFollow) - 2];
                    } elseif (sizeof($PostFollow) == 1) {
                        $recentActivity1UserId = $PostFollow[sizeof($PostFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "EventAttend") {
                    $EventAttendes = array_values(array_unique($data->EventAttendes));
                    if (sizeof($EventAttendes) > 1) {
                        $recentActivity1UserId = $EventAttendes[sizeof($EventAttendes) - 1];
                        $recentActivity2UserId = $EventAttendes[sizeof($EventAttendes) - 2];
                    } elseif (sizeof($EventAttendes) == 1) {
                        $recentActivity1UserId = $EventAttendes[sizeof($EventAttendes) - 1];
                    }
                } elseif ($data->RecentActivity == "Invite") {
                    $InviteUsers = array_values(array_unique($data->InviteUsers));
                    if (sizeof($InviteUsers) > 1) {
                        $recentActivity1UserId = $InviteUsers[sizeof($InviteUsers) - 1];
                        $recentActivity2UserId = $InviteUsers[sizeof($InviteUsers) - 2];
                    } elseif (sizeof($InviteUsers) == 1) {
                        $recentActivity1UserId = $InviteUsers[sizeof($InviteUsers) - 1];
                    }
                } elseif ($data->RecentActivity == "Survey") {
                    $SurveyTaken = array_values(array_unique($data->SurveyTaken));
                    if (sizeof($SurveyTaken) > 1) {
                        $recentActivity1UserId = $SurveyTaken[sizeof($SurveyTaken) - 1];
                        $recentActivity2UserId = $SurveyTaken[sizeof($SurveyTaken) - 2];
                    } elseif (sizeof($SurveyTaken) == 1) {
                        $recentActivity1UserId = $SurveyTaken[sizeof($SurveyTaken) - 1];
                    }
                } elseif ($data->RecentActivity == "GroupFollow") {
                    $GroupFollow = array_values(array_unique($data->GroupFollowers));
                    if (sizeof($GroupFollow) > 1) {
                        $recentActivity1UserId = $GroupFollow[sizeof($GroupFollow) - 1];
                        $recentActivity2UserId = $GroupFollow[sizeof($GroupFollow) - 2];
                    } elseif (sizeof($GroupFollow) == 1) {
                        $recentActivity1UserId = $GroupFollow[sizeof($GroupFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "CurbsideCategoryFollow") {
                    $CurbsideFollow = array_values(array_unique($data->CurbsideCategoryFollowers));
                    if (sizeof($CurbsideFollow) > 1) {
                        $recentActivity1UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 1];
                        $recentActivity2UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 2];
                    } elseif (sizeof($CurbsideFollow) == 1) {
                        $recentActivity1UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "HashTagFollow") {
                    $recentActivity1UserId = $data->HashTagPostUserId;
                    $HashTagFollow = array_values(array_unique($data->HashTagFollowers));
                    if (sizeof($HashTagFollow) > 1) {
                        $recentActivity1UserId = $HashTagFollow[sizeof($HashTagFollow) - 1];
                        $recentActivity2UserId = $HashTagFollow[sizeof($HashTagFollow) - 2];
                    } elseif (sizeof($HashTagFollow) == 1) {
                        $recentActivity1UserId = $HashTagFollow[sizeof($HashTagFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "Play") {
                    if (isset($data->CurrentScheduledPlayers)) {
                        $PlayedUsers = array_values(array_unique($data->CurrentScheduledPlayers));
                        if (sizeof($PlayedUsers) > 1) {
                            $recentActivity1UserId = $PlayedUsers[sizeof($PlayedUsers) - 1]['UserId'];
                            $recentActivity2UserId = $PlayedUsers[sizeof($PlayedUsers) - 2]['UserId'];
                        } elseif (sizeof($PlayedUsers) == 1) {
                            $recentActivity1UserId = $PlayedUsers[sizeof($PlayedUsers) - 1]['UserId'];
                        }
                    }
                } elseif ($data->RecentActivity == "Schedule") {
                    $recentActivity2UserId = $data->OriginalUserId;
                }

                $recentActivityUser1 = UserCollection::model()->getTinyUserCollection($recentActivity1UserId);
                if (!empty($recentActivity2UserId)) {
                    $recentActivityUser2 = UserCollection::model()->getTinyUserCollection($recentActivity2UserId);
                }
                $whosePost = "";
                if ($data->ActionType == 'Comment' || $data->ActionType == 'Follow' || $data->ActionType == 'EventAttend' || $data->ActionType == 'Invite') {
                    if ($data->OriginalUserId == $UserId) {
                        $whosePost = "your";
                    } elseif (in_array($data->OriginalUserId, array_unique($data->UserFollowers)) || in_array($data->OriginalUserId, array_unique($data->PostFollowers))) {
                        $whosePost = $tinyOriginalUser['DisplayName'];
                    }
                }
                $userId1 = $recentActivityUser1['UserId'];
                $userId2 = "";
                $displayName1 = $UserId == $recentActivityUser1['UserId'] ? 'You' : $recentActivityUser1['DisplayName'];
                if ($PostAsNetwork == 1) {
                    $displayName1 = $recentActivityUser1['DisplayName'];
                }
                $displayName2 = "";
                $secondUser = "";
                if (!empty($recentActivityUser2)) {
                    $userId2 = $recentActivityUser2['UserId'];
                    $displayName2 = $UserId == $recentActivityUser2['UserId'] ? 'You' : $recentActivityUser2['DisplayName'];
                    if ($PostAsNetwork == 1) {
                        $displayName2 = $recentActivityUser2['DisplayName'];
                    }
                    if ($displayName2 == "You") {
                        $displayName2 = $displayName1;
                        $displayName1 = "You";
                        $temp = $userId1;
                        $userId1 = $userId2;
                        $userId2 = $temp;
                    }
                    $secondUser = ", <a class='userprofilename' data-id='" . $userId2 . "' style='cursor:pointer'><b>" . $displayName2 . "</b></a>";
                }

                $data->FirstUserId = $userId1;
                $data->FirstUserDisplayName = $displayName1;
                $data->FirstUserProfilePic = $recentActivityUser1['profile250x250'];
                $data->SecondUserData = $secondUser;
                $data->PostBy = $whosePost;
                $data->OriginalUserDisplayName = $tinyOriginalUser['DisplayName'];
                $data->OriginalUserProfilePic = $tinyOriginalUser['profile70x70'];
                $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);
                $data->IsLoved = in_array($UserId, $data->LoveUserId);
                $data->FbShare = isset($data->FbShare) && is_array($data->FbShare) ? in_array($UserId, $data->FbShare) : 0;
                $data->TwitterShare = isset($data->TwitterShare) && is_array($data->TwitterShare) ? in_array($UserId, $data->TwitterShare) : 0;
                $data->IsSurveyTaken = in_array($UserId, $data->SurveyTaken);
                $data->TotalSurveyCount = $data->OptionOneCount + $data->OptionTwoCount + $data->OptionThreeCount + $data->OptionFourCount;
                if (isset($data->OptionFour) && !empty($data->OptionFour))
                    $data->IsOptionDExist = 1;

                $image = "";
                if ($data->IsMultiPleResources > 0) {

                    if (isset($data->Resource["ThumbNailImage"])) {
                        $data->ArtifactIcon = Yii::app()->params['ServerURL'] . "" . $data->Resource["ThumbNailImage"];
                        $data->Resource["Uri"]= Yii::app()->params['ServerURL'] . "" . $data->Resource["Uri"];

                        } else {
                        $data->ArtifactIcon = "";
                    }
                }
                if ($secondUser != "") {
                    if (trim($data->StreamNote) == "is following") {
                        $data->StreamNote = " are following";
                    }
                    if (trim($data->StreamNote) == "is attending") {
                        $data->StreamNote = " are attending";
                    }
                    if (trim($data->StreamNote) == "has answered") {
                        $data->StreamNote = " have answered";
                    }
                    if (trim($data->StreamNote) == "is Played") {
                        $data->StreamNote = " are Played";
                    }
                    if (trim($data->StreamNote) == "has Played") {
                        $data->StreamNote = " have Played ";
                    }
                }
                if ($UserId == $recentActivityUser1['UserId'] && trim($secondUser) == "") {


                    if (trim($data->StreamNote) == "is following") {
                        $data->StreamNote = " are following";
                    }
                    if (trim($data->StreamNote) == "is attending") {
                        $data->StreamNote = " are attending";
                    }
                    if (trim($data->StreamNote) == "has answered") {
                        $data->StreamNote = " have answered";
                    }if (trim($data->StreamNote) == "is Played") {
                        $data->StreamNote = " Played";
                    }
                    if (trim($data->StreamNote) == "has invited to") {
                        $data->StreamNote = " have invited to ";
                    }
                    if (trim($data->StreamNote) == "has Played") {
                        $data->StreamNote = " have Played ";
                    }
                }

                if ($data->PostType == 4) {
                    $data->PostBy = "";
                    if ($data->ActionType == "Post") {
                        $data->PostBy = "";
                        $data->FirstUserDisplayName = "";
                        $data->FirstUserProfilePic = "/images/icons/user_noimage.png";
                        $data->SecondUserData = "";
                        $data->StreamNote = "A new post has been created";
                        $data->PostTypeString = "";
                    }
                }

                if ($data->PostType == 2) {

                    $eventStartDate = CommonUtility::convert_time_zone($data->StartDate->sec, $timezone, '', 'sec');
                    $eventEndDate = CommonUtility::convert_time_zone($data->EndDate->sec, $timezone, '', 'sec');
                    $data->Title = $data->Title;
                    $data->StartDate = date("Y-m-d", $eventStartDate);
                    $data->EndDate = date("Y-m-d", $eventEndDate);
                    $data->EventStartDay = date("d", $eventStartDate);
                    $data->EventStartDayString = date("l", $eventStartDate);
                    $data->EventStartMonth = date("M", $eventStartDate);
                    $data->EventStartYear = date("Y", $eventStartDate);
                    $data->EventEndDay = date("d", $eventEndDate);
                    $data->EventEndDayString = date("l", $eventEndDate);
                    $data->EventEndMonth = date("M", $eventEndDate);
                    $data->EventEndYear = date("Y", $eventEndDate);
                    $data->StartTime = date("h:i A", $eventStartDate);
                    $data->EndTime = date("h:i A", $eventEndDate);
                    if ($eventEndDate <= CommonUtility::currentSpecifictime_timezone($timezone)) {
                        $data->CanPromotePost = 0;
                        $data->IsEventAttend = 1;
                    } else {
                        $data->IsEventAttend = in_array($UserId, $data->EventAttendes);
                    }
                } elseif ($data->PostType == 3) {


                    $surveyExpiryDate = $data->ExpiryDate;
                    $data->Title = $data->Title;
                    if (isset($surveyExpiryDate->sec) && $surveyExpiryDate->sec <= time()) {
                        $data->CanPromotePost = 0;
                        $data->ExpiryDate = date("Y-m-d", $surveyExpiryDate->sec);
                    }
                    $surveyExpiryDate_tz = CommonUtility::convert_date_zone($surveyExpiryDate->sec, $timezone);
                    $currentDate_tz = CommonUtility::currentdate_timezone($timezone);
                    if ($surveyExpiryDate_tz < $currentDate_tz) {
                        //  error_log("survey-------------------------if"); 
                        $data->IsSurveyTaken = true; //expired
                    }
                }

                $comments = $data->Comments;
                $commentCount = sizeof($comments);
                $data->CommentCount = $data->CommentCount;
                $commentsArray = array();
                if ($commentCount > 0) {
                    $data->IsCommented = in_array((int) $UserId, $data->CommentUserId);
                    //$maxDisplaySize = $commentCount>2?2:$commentCount;
                    $commentsDisplayCount = 0;
                    for ($j = $commentCount; $j > 0; $j--) {
                        $comment = $comments[$j - 1];
                        $isBlockedComment = isset($comment['IsBlockedWordExist']) ? $comment['IsBlockedWordExist'] : 0;
                        if ($isBlockedComment != 1) {
                            $commentsDisplayCount++;
                            $commentedUser = UserCollection::model()->getTinyUserCollection($comment["UserId"]);
                            $comment["CreatedOn"] = $comment["CreatedOn"];
                            $textWithOutHtml = $comment["CommentText"];

                            if (isset($comment['WebUrls']) && !empty($comment['WebUrls']) && $comment['WebUrls'] != null) {

                                if (isset($comment['IsWebSnippetExist']) && $comment['IsWebSnippetExist'] == '1') {
                                    $CommentSnippetdata = WebSnippetCollection::model()->CheckWebUrlExist($comment['WebUrls'][0]);
                                    $comment['WebUrls'] = $CommentSnippetdata;
                                } else {

                                    $comment['WebUrls'] = "";
                                }
                            }
                            if (isset($comment["CommentTextLength"]) && $comment["CommentTextLength"] > 240) {

                                $appendCommentData = ' <span class="postdetail tooltiplink" data-id="' . $data->_id . '"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                                // $description = CommonUtility::truncateHtml($comment["CommentText"], 240,$appendCommentData);
                                $description = CommonUtility::truncateHtml($comment["CommentText"], 240, '...', true, true, $appendCommentData);
                                $text = $description;

                                $comment["CommentText"] = str_replace("&nbsp;"," ",$text);
                            } else {

                                $comment["CommentText"] =  str_replace("&nbsp;"," ",$comment["CommentText"]);
                            }
                            $comment['ProfilePicture'] = $commentedUser['profile70x70'];
                            $commentCreatedOn = $comment["CreatedOn"];
                            $comment["CreatedOn"] = CommonUtility::styleDateTime($commentCreatedOn->sec, 'mobile');
                            $comment["DisplayName"] = $commentedUser['DisplayName'];
                            $image = "";
                            if (sizeof($comment["Artifacts"]) > 0) {
                                if (isset($comment["Artifacts"]['ThumbNailImage'])) {
                                    $image = Yii::app()->params['ServerURL'] . "" . $comment["Artifacts"]['ThumbNailImage'];
                                  $ArtifactExtension=$comment["Artifacts"]['Extension'];
                                    $comment["ArtifactExtension"] = strtolower($ArtifactExtension);
                                    
                                } else {
                                    $image = "";
                                    $comment["ArtifactExtension"] ="";
                                }
                            }
                            $comment["ArtifactIcon"] = $image;
                           
                            array_push($commentsArray, $comment);
                            if ($commentsDisplayCount == 2) {
                                break;
                            }
                        }
                    }
                }
                $data->Comments = $commentsArray;
                if ($data->CategoryType == 3) {
                    if (isset($data->GroupId)) {
                        $data->PostTypeString = " " . $data->PostTypeString;
                    }
                }
                if ($data->CategoryType == 7) {
                    if (isset($data->SubGroupId)) {
                        $data->PostTypeString = " " . $data->PostTypeString;
                    }
                }


                /**
                 * follow Object  post type
                 * post type user is 6
                 * post type hashtag 7
                 * post type curbsidecategory 8
                 * post  type group 9
                 */
                if ($data->PostType == 9) {
                    if (isset($data->GroupId)) {
                        $groupData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;
                        $data->GroupName = $groupData->GroupName;

                        if (strlen($groupData->GroupDescription) > 240) {
                            $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                            $data->GroupDescription = $description . "  ...";
                        } else {
                            $data->GroupDescription = $groupData->GroupDescription;
                        }
                        //$data->GroupDescription = $groupData->GroupDescription;
                        $data->GroupFollowersCount = sizeof($groupData->GroupMembers);
                        $data->IsFollowingEntity = in_array($UserId, $groupData->GroupMembers);
                        $data->PostTypeString = " Group ";
                    }
                }

                if ($data->PostType == 10) {
                    if (isset($data->SubGroupId)) {
                        $groupData = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                        $data->SubGroupImage = Yii::app()->params['ServerURL'] . $groupData->SubGroupProfileImage;
                        $data->SubGroupName = $groupData->SubGroupName;

                        if (strlen($groupData->SubGroupDescription) > 240) {
                            $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                            $data->SubGroupDescription = $description . "  ...";
                        } else {
                            $data->SubGroupDescription = $groupData->SubGroupDescription;
                        }
                        //$data->GroupDescription = $groupData->GroupDescription;
                        $data->SubGroupFollowersCount = sizeof($groupData->SubGroupMembers);
                        $data->IsFollowingEntity = in_array($UserId, $groupData->SubGroupMembers);
                        $data->PostTypeString = " Sub Group ";
                    }
                }
                if ($data->PostType == 7) {
                    $data->PostTypeString = " #Tag";
                    $data->GroupImage = Yii::app()->params['ServerURL'] . "/images/icons/hashtag_img.png";
                    $data->HashTagName = $data->HashTagName;
                    $data->GroupDescription = "";
                    $data->HashTagPostCount = count($data->HashTagFollowers);

                    $data->IsFollowingEntity = in_array($UserId, $data->HashTagFollowers);
                    $data->PostTypeString = " " . $data->HashTagName;
                }
                if ($data->PostType == 8) {
                    $name = Yii::t('translation', 'CurbsideConsult');
                    $data->PostTypeString = " $name Category";
                    $data->GroupImage = Yii::app()->params['ServerURL'] . "/images/icons/curbesidepost_img.png";
                    $data->CurbsideConsultCategory = $data->CurbsideConsultCategory;
                    $data->GroupDescription = "";
                    // $data->CurbsidePostCount =  $data->CurbsidePostCount;
                    $data->CurbsidePostCount = sizeof($data->CurbsideCategoryFollowers);
                    $data->IsFollowingEntity = in_array($UserId, $data->CurbsideCategoryFollowers);
                    $data->PostTypeString = " " . $data->PostTypeString;
                }
                if ($data->PostType == 11) {
                  
                  $pattern = '/object/';
                    if(preg_match($pattern, $data->HtmlFragment)){
                        
                        $data->IsVideo = 1;
                    }else{
                         
                         $data->IsVideo = 0;
                        
                    }
                    if($isHomeStream==1){
                        $width="width='100'";
                        $height="height='100'";
                    }else{
                          $width="width='250'";
                        $height="height='250'";
                    }
                    $pattern = '/(width)="[0-9]*"/';
                    $string=$data->HtmlFragment;
                    $string = preg_replace($pattern, $width, $string);
                    $pattern = '/(height)="[0-9]*"/';
                    $string = preg_replace($pattern, $height, $string);

                    $data->HtmlFragment = $string;
                    $data->IsNotifiable = (int) $data->IsNotifiable;
                    $data->PublicationDate = CommonUtility::styleDateTime(strtotime($data->PublicationDate), "mobile");
                    if ($data->Editorial != '') {
                        $editorial = $data->Editorial;
                        if (strlen($data->Editorial) > 240) {
                            $editorial = substr($editorial, 0, 240);
                            $editorial = $editorial . '<a data-placement="bottom" rel="tooltip"  data-original-title="show more" class="showmore postdetail" data-id="' . $data->PostId . '">...</a>';
                        }
                        $data->Editorial = $editorial;
                    }
                }elseif ($data->PostType == 13) {
                    $data->PostTypeString = $data->BadgeName." badge";
                }
                $data->PostId = (String) $data->PostId;
                $data->_id = (String) $data->_id;
                array_push($currentStreamIdArray, (string)$data->PostId);
                }else{
                    
                    unset($streamPostData[$key]);
                    continue;
                }
            }

            //if($isHomeStream == 1){
                
              //  return array('streamPostData'=>$streamPostData, 'streamIdArray'=>$currentStreamIdArray,"totalStreamIdArray"=>$totalStreamIdArray);
//            }else{
               return $streamPostData;
//            }
        } catch (Exception $ex) {
            error_log("__________exception_________________________________" . $ex->getMessage());
            error_log("__________exception_________________________________" . $ex->getLine());
            Yii::log("********EXCEPTION***************************" . $ex->getMessage(), 'error', 'application');
        }
    }
    
      static function prepareStreamDataForMobile_V3($UserId, $streamPostData, $UserPrivileges, $isHomeStream = 0, $PostAsNetwork = 0, $timezone = '', $previousStreamIdArray=array()) {

        try {
            $streamIdArray = array();
            $zeroRecordArray = array();
            $oneRecordArray = array();
            $currentStreamIdArray = array();
            $totalStreamIdArray = array();
            foreach ($streamPostData as $key => $data) {
		//Advertisements filtaring start
                if(isset($data->DisplayPage) && $data->AdType!=1){
                    if($isHomeStream==1 && $data->DisplayPage!="Home"){
                      unset($streamPostData[$key]);
                       continue;  
                    }
                    
                    else if($isHomeStream==2 && $data->DisplayPage!="Group"){
                      unset($streamPostData[$key]);
                      continue;   
                    }
                    else if($isHomeStream==3 && $data->DisplayPage!="Curbside"){
                      unset($streamPostData[$key]);
                      continue;   
                    }
        
                   if($data->DisplayPage=="Group"){
                       $reg='/'.$_GET['groupId'].'/';
                       if($data->Groups!="AllGroups" && !preg_match($reg,$data->Groups) ){
                          unset($streamPostData[$key]);
                          continue; 
                       }  
                    }
                    
                }
                 //Advertisements filtaring end
                array_push($totalStreamIdArray, (string)$data->PostId);
                if (!in_array((string)$data->PostId, $previousStreamIdArray)) {
                $data->IsHomeStream = $isHomeStream;
                $recentActivityUser2 = "";
                $isPromoted = isset($data->IsPromoted) ? $data->IsPromoted : 0;
                $data->IsIFrameMode = 0;
                if ($data->CategoryType == 3) {
                    if (isset($data->GroupId)) {

                        $groupData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        if ($groupData != "failure") {
                            $data->IsFollowingEntity = in_array($UserId, $groupData->GroupMembers);
                            if ($groupData->IsPrivate == 1 && $isHomeStream == 1 && $data->IsFollowingEntity == 0) {

                                unset($streamPostData[$key]);
                                continue;
                            }
                            $isIframeModeValue = (isset($groupData->IsIFrameMode) && $groupData->IsIFrameMode == 1) ? 1 : 0;
                            if ($isIframeModeValue == 1 && in_array($UserId, $groupData->GroupMembers)|| ($groupData->CustomGroup == 1 && $groupData->IsHybrid == 0)) {

                                $data->IsIFrameMode = 1;
 				$data->IsNativeGroup=1;
                            }
                            $data->GroupName = $groupData->GroupName;
                            $data->MainGroupId = $groupData->_id;
                            $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;
                            $data->IsPrivate = $groupData->IsPrivate;                            
                            $data->ConversationVisibility =$groupData->ConversationVisibility;                       
                            if (in_array($data->OriginalUserId, $groupData->GroupAdminUsers)) {
                                $data->isGroupAdminPost = 'true';
                            }
                            if (isset($groupData->AddSocialActions)) {
                                        $data->AddSocialActions = $groupData->AddSocialActions;
                            }
  			   // if($groupData->ConversationVisibility!=1){
                             //  unset($streamPostData[$key]);
                              // continue;
                           //}
 				if($groupData->ConversationVisibility == 1){
                                    $data->IsIFrameMode = 1;
                                 error_log("&&&&&&&------group--");   
                            }
                            if ($data->IsIFrameMode != 1) {
                                $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;

                                /* for more */
                                $tagsFreeDescription = strip_tags(($groupData->GroupDescription));
                                $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);

                                $descriptionLength = strlen($tagsFreeDescription);
                                // error_log("&&&&&&&------group--".$groupData->GroupDescription);
                                /* for more */


                                if ($descriptionLength > 240) {
                                    $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                                    $data->GroupDescription = trim($description) . "  ...";
                                } else {
                                    $data->GroupDescription = $groupData->GroupDescription;
                                }



                                $data->GroupFollowersCount = sizeof($data->PostFollowers);
                                $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);


                                if ($data->isDerivative == 0) {
                                    if ($isHomeStream == 1 && (!($data->IsFollowingEntity) || $isPromoted == 1)) {
                                        unset($streamPostData[$key]);
                                        continue;
                                    }
                                } else {
                                    
                                }
                            }
                        }
                    }
                }
                if ($data->CategoryType == 7) {
                    if (isset($data->SubGroupId)) {

                        $groupData = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                        $gData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        if ($groupData != "failure") {
                            $data->SubGroupImage = Yii::app()->params['ServerURL'] . $groupData->SubGroupProfileImage;
                            $data->SubGroupName = $groupData->SubGroupName;
                            $data->GroupName = $gData->GroupName;

                            /* for more */
                            $tagsFreeDescription = strip_tags(($groupData->SubGroupDescription));
                            $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);

                            $descriptionLength = strlen($tagsFreeDescription);
                            /* for more */

                            if ($descriptionLength > 240) {
                                $description = CommonUtility::truncateHtml($groupData->SubGroupDescription, 240);
                                $data->SubGroupDescription = trim($description) . "  ...";
                            } else {
                                $data->SubGroupDescription = $groupData->SubGroupDescription;
                            }


                            $data->SubGroupFollowersCount = sizeof($groupData->SubGroupMembers);
                            $data->IsFollowingEntity = in_array($UserId, $groupData->SubGroupMembers);
                            if ($data->isDerivative == 0) {
                                if ($isHomeStream == 1 && (!($data->IsFollowingEntity) || $isPromoted == 1)) {
                                    unset($streamPostData[$key]);
                                    continue;
                                }
                            }
                        }
                    }
                }

                $data->IsPromoted = $isPromoted;
                if ($data->CategoryType == 9) {
                  try {
                       error_log($data->PostId."--################!!!!#######$data->PostType----".$data->UserId);     
                    
                        if ($data->UserId == 0) {
                            if (count($oneRecordArray) > 0) {
                                $key_1 = array_search($data->PostId, $oneRecordArray);
                                if (is_int($key_1)) {
                                    unset($streamPostData[$key]);
                                    continue;
                                }
                            }
                            $zeroRecordArray[$key] = $data->PostId;
                } else {
                            $oneRecordArray[$key] = $data->PostId;
                            if (count($zeroRecordArray) > 0) {
                                $key12 = array_search($data->PostId, $zeroRecordArray);
                                if (is_int($key12)) {
                                    unset($streamPostData[$key12]);
                                    //continue;
                                }
                            }
                        }
                          $dateFormat =  CommonUtility::getDateFormat();
                        error_log("date format--------------------".$dateFormat);
                        error_log("###############################startdat---".$data->StartDate);
                        $sDate = strtotime($data->StartDate);
                          
                    error_log("id------------------".$data->_id."-----curettn scheulid--".$data->CurrentGameScheduleId)   ;
                    $gameUserStatus = ScheduleGameCollection::model()->findUserGameStatus($UserId, $data->CurrentGameScheduleId, $data->StartDate);
                        $gameScheduls = ScheduleGameCollection::model()->getSchedulesForGame($data->PostId);
                       $gameSchedules = array();
                      
                       if (!is_string($gameScheduls)) {
                            foreach ($gameScheduls as $value) {
                                  error_log("date startdat--------------------".$value['StartDate']->sec);
                           $value['StartDate'] =  date($dateFormat,CommonUtility::convert_date_zone($value['StartDate']->sec,"Asia/Kolkata",  date_default_timezone_get()));
                    $value['EndDate'] =   date($dateFormat,CommonUtility::convert_date_zone($value['EndDate']->sec,"Asia/Kolkata",  date_default_timezone_get()));
                    error_log("after start date------".$value['StartDate']."----end datre---".$value['EndDate']);
                     array_push($gameSchedules, $value);
                    
                            }
                           // $data->SchedulesArray = $gameSchedules;
                              $data->SchedulesArray = [];//for mobile schudules not 
                        } else {
                            $data->SchedulesArray = 'noschedules';
                        }
                        $data->GameStatus = $gameUserStatus;
                         $data->GameBannerImage = Yii::app()->params['ServerURL'].$data->GameBannerImage;

                        /** this is logic for Previous Schedules */
                        $previousSchedule = $data->PreviousGameScheduleId;
                        if (isset($previousSchedule) && $previousSchedule != null) {
                            $gameUserStatusForPreviousSchedule = ScheduleGameCollection::model()->findUserGameStatusForPreviousSchedule($UserId, $previousSchedule, $data->StartDate);

                            $data->PreviousGameStatus = $gameUserStatusForPreviousSchedule;
                        }

                        if ($UserId == $data->OriginalUserId) {
                            $data->GameAdminUser = 1;
                        } else {
                            $data->GameAdminUser = 0;
                        }
                      
                       $data->StartDate =  date($dateFormat,CommonUtility::convert_date_zone($data->StartDate->sec,"Asia/Kolkata",  date_default_timezone_get()));
                    $data->EndDate =   date($dateFormat,CommonUtility::convert_date_zone($data->EndDate->sec,"Asia/Kolkata",  date_default_timezone_get()));
                    $descriptionLength = strlen($data->GameDescription);
                           if ($descriptionLength > 100) {
                                $description = CommonUtility::truncateHtml($data->GameDescription, 100);
                                $data->GameDescription = trim($description) . "  ...";
                            } 
                      
                        // $data->IsFollowingPost = in_array($UserId, $data->PostFollowers); 
                        
                        
                    } catch (Exception $exc) {
                        error_log("exceptino----------------------");
                    }  
                } else {
                    if (sizeof($streamIdArray) > 0) {
                        if (array_key_exists("$data->PostId", $streamIdArray)) {
                            if ($streamIdArray["$data->PostId"] == $isPromoted) {
                                unset($streamPostData[$key]);
                                continue;
                            }
//                        elseif($streamIdArray["$data->PostId"]==$isPromoted && $data->UserId!=0){                            
//                            unset($streamPostData[$key]);
//                        }
                        }
                    }
                }


                $streamIdArray["$data->PostId"] = $isPromoted;
                $data->SessionUserId = $UserId;
                $data->CanDeletePost = ($data->OriginalUserId == $data->SessionUserId) ? 1 : 0;
                if (is_array($UserPrivileges)) {
                    foreach ($UserPrivileges as $value) {
                        if ($value['Status'] == 1) {
                            if ($value['Action'] == 'Delete') {
                                $data->CanDeletePost = 1;
                            } else if ($value['Action'] == 'Promote_Post') {
                                $data->CanPromotePost = 1;
                            } else if ($value['Action'] == 'Promote_To_Featured_Items') {
                                $data->CanFeaturePost = 1;
                            } else if ($value['Action'] == 'Mark_As_Abuse') {
                                $data->CanMarkAsAbuse = 1;
                            }
                        }
                    }
                }

                $createdOn = $data->CreatedOn;
                $originalPostTime = $data->OriginalPostTime;
                if ($isPromoted == 1) {
                    $data->PostOn = CommonUtility::styleDateTime($originalPostTime->sec, 'mobile');
                    $data->PromotedDate = CommonUtility::styleDateTime($createdOn->sec);
                    $currentDate = date('Y-m-d', time());
                    $postPromotedDate = date('Y-m-d', $createdOn->sec);
                    if ($postPromotedDate < $currentDate) {
                        $data->IsPromoted = 0;
                    }
                    if ($data->CanPromotePost == 1) {
                        if ($postPromotedDate > $currentDate) {
                            $data->CanPromotePost = 0;
                        }
                    }
                    if ($data->CanDeletePost == 1 && $data->PromotedUserId != $UserId) {
                        $data->CanDeletePost = 0;
                    }
                } else {

                    $data->PostOn = CommonUtility::styleDateTime($createdOn->sec, 'mobile');

//                    if($data->CategoryType==2){
//                        $postDetails=  CurbsidePostCollection::model()->getPostById($data->PostId);
//                        $postCollectionDate=$postDetails->CreatedOn;
//                       $data->PostOn = CommonUtility::styleDateTime($postCollectionDate->sec); 
//                    }else if($data->CategoryType==1) {
//                        $postDetails=  PostCollection::model()->getPostById($data->PostId);
//                        $postCollectionDate=$postDetails->CreatedOn;
//                        $data->PostOn = CommonUtility::styleDateTime($postCollectionDate->sec); 
//                    }else{
//                        $data->PostOn = CommonUtility::styleDateTime($originalPostTime->sec);  
                    //  }
                }
                $data->OriginalPostPostedOn = CommonUtility::styleDateTime($originalPostTime->sec, 'mobile');
                $textWithOutHtml = $data->PostText;

                $textLength = strlen($textWithOutHtml);
                if (isset($data->WebUrls) && !empty($data->WebUrls) && $data->WebUrls != null) {
                    if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') {
                        $snippetdata = WebSnippetCollection::model()->CheckWebUrlExist($data->WebUrls[0]);

                        $data->WebUrls = $snippetdata;
                    } else {
                        $data->WebUrls = "";
                    }
                }

//
//                /*for more*/
//                        $tagsFreeDescription= strip_tags(($data->PostText));
//                        $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
//                 
//                        $descriptionLength =  strlen($tagsFreeDescription);
//                       
//                       /*for more*/
                // $textLength=strlen($textWithOutHtml);

                if (isset($data->PostTextLength) && $data->PostTextLength > 240 && $data->PostTextLength < 500) {
                    $appendData = '<span class="seemore tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="See More" onclick="expandpostDiv(' . "'" . $data->_id . "'" . ')"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                } else {

                    $appendData = ' <span class="postdetail tooltiplink" data-id=' . $data->_id . ' data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                }
                // error_log("post length before-------------".$data->PostTextLength);
                // error_log("post text------------".$data->PostText);
               $data->PostText =  CommonUtility::remove_unicode($data->PostText);
                  
                $data->PostCompleteText = $data->PostText;
                if ($data->PostTextLength > 240) {
                    $description = CommonUtility::truncateHtml($data->PostText, 240, '...', true, true, $appendData);

                    //  error_log("post desc------------".$description);
                    $text = $description;
 		if($isHomeStream==1 && $data->IsNativeGroup==1){                  
                $data->PostText = $data->PostText;                
                }
                    else{
                           $data->PostText = $text;                        
                    }                 
                }
                // error_log("post text after------------".$data->PostText);
                //  $data->PostText .= ' <span class="postdetail" data-postid="'.$data->PostId.'" data-categoryType="'.$data->CategoryType.'" data-postType="'.$data->PostType.'"> <i class="fa fa-ellipsis-h"></i></span>';
                $tinyOriginalUser = UserCollection::model()->getTinyUserCollection($data->OriginalUserId);
                $postType = CommonUtility::postTypebyIndex($data->PostType, $data->CategoryType);
                $data->PostTypeString = $postType;
                $createdOn = $data->CreatedOn;
                $originalPostTime = $data->OriginalPostTime;
                $recentActivity1UserId = "";
                $recentActivity2UserId = "";
                if ($data->RecentActivity == "Post") {
                    $recentActivity1UserId = $data->OriginalUserId;
                    $recentActivity2UserId = "";
                }
                //elseif ($data->RecentActivity=="HashTagFollow") {
                //   $recentActivity1UserId=$data->HashTagPostUserId;
                //           }
                elseif ($data->RecentActivity == "UserMention") {
                    $recentActivity1UserId = $data->MentionUserId;
                } elseif ($data->RecentActivity == "Love") {
                    $LoveUserId = array_values(array_unique($data->LoveUserId));
                    if (sizeof($LoveUserId) > 1) {
                        $recentActivity1UserId = $LoveUserId[sizeof($LoveUserId) - 1];
                        $recentActivity2UserId = $LoveUserId[sizeof($LoveUserId) - 2];
                    } elseif (sizeof($LoveUserId) == 1) {
                        $recentActivity1UserId = $LoveUserId[sizeof($LoveUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "Comment") {
                    $CommentUserId = array_values(array_unique($data->CommentUserId));
                    if (sizeof($CommentUserId) > 1) {
                        $recentActivity1UserId = $CommentUserId[sizeof($CommentUserId) - 1];
                        $recentActivity2UserId = $CommentUserId[sizeof($CommentUserId) - 2];
                    } elseif (sizeof($CommentUserId) == 1) {
                        $recentActivity1UserId = $CommentUserId[sizeof($CommentUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "UserFollow") {

                    $FollowUserId = array_values(array_unique($data->UserFollowers));
                    if (count($FollowUserId) > 1) {
                        $recentActivity1UserId = $FollowUserId[sizeof($FollowUserId) - 1];
                        $recentActivity2UserId = $FollowUserId[sizeof($FollowUserId) - 2];
                    } elseif (sizeof($FollowUserId) == 1) {
                        $recentActivity1UserId = $FollowUserId[sizeof($FollowUserId) - 1];
                    }
                } elseif ($data->RecentActivity == "PostFollow") {
                    $PostFollow = array_values(array_unique($data->PostFollowers));
                    if (count($PostFollow) > 1) {
                        $recentActivity1UserId = $PostFollow[sizeof($PostFollow) - 1];
                        $recentActivity2UserId = $PostFollow[sizeof($PostFollow) - 2];
                    } elseif (sizeof($PostFollow) == 1) {
                        $recentActivity1UserId = $PostFollow[sizeof($PostFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "EventAttend") {
                    $EventAttendes = array_values(array_unique($data->EventAttendes));
                    if (sizeof($EventAttendes) > 1) {
                        $recentActivity1UserId = $EventAttendes[sizeof($EventAttendes) - 1];
                        $recentActivity2UserId = $EventAttendes[sizeof($EventAttendes) - 2];
                    } elseif (sizeof($EventAttendes) == 1) {
                        $recentActivity1UserId = $EventAttendes[sizeof($EventAttendes) - 1];
                    }
                } elseif ($data->RecentActivity == "Invite") {
                    $InviteUsers = array_values(array_unique($data->InviteUsers));
                    if (sizeof($InviteUsers) > 1) {
                        $recentActivity1UserId = $InviteUsers[sizeof($InviteUsers) - 1];
                        $recentActivity2UserId = $InviteUsers[sizeof($InviteUsers) - 2];
                    } elseif (sizeof($InviteUsers) == 1) {
                        $recentActivity1UserId = $InviteUsers[sizeof($InviteUsers) - 1];
                    }
                } elseif ($data->RecentActivity == "Survey") {
                    $SurveyTaken = array_values(array_unique($data->SurveyTaken));
                    if (sizeof($SurveyTaken) > 1) {
                        $recentActivity1UserId = $SurveyTaken[sizeof($SurveyTaken) - 1];
                        $recentActivity2UserId = $SurveyTaken[sizeof($SurveyTaken) - 2];
                    } elseif (sizeof($SurveyTaken) == 1) {
                        $recentActivity1UserId = $SurveyTaken[sizeof($SurveyTaken) - 1];
                    }
                } elseif ($data->RecentActivity == "GroupFollow") {
                    $GroupFollow = array_values(array_unique($data->GroupFollowers));
                    if (sizeof($GroupFollow) > 1) {
                        $recentActivity1UserId = $GroupFollow[sizeof($GroupFollow) - 1];
                        $recentActivity2UserId = $GroupFollow[sizeof($GroupFollow) - 2];
                    } elseif (sizeof($GroupFollow) == 1) {
                        $recentActivity1UserId = $GroupFollow[sizeof($GroupFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "CurbsideCategoryFollow") {
                    $CurbsideFollow = array_values(array_unique($data->CurbsideCategoryFollowers));
                    if (sizeof($CurbsideFollow) > 1) {
                        $recentActivity1UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 1];
                        $recentActivity2UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 2];
                    } elseif (sizeof($CurbsideFollow) == 1) {
                        $recentActivity1UserId = $CurbsideFollow[sizeof($CurbsideFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "HashTagFollow") {
                    $recentActivity1UserId = $data->HashTagPostUserId;
                    $HashTagFollow = array_values(array_unique($data->HashTagFollowers));
                    if (sizeof($HashTagFollow) > 1) {
                        $recentActivity1UserId = $HashTagFollow[sizeof($HashTagFollow) - 1];
                        $recentActivity2UserId = $HashTagFollow[sizeof($HashTagFollow) - 2];
                    } elseif (sizeof($HashTagFollow) == 1) {
                        $recentActivity1UserId = $HashTagFollow[sizeof($HashTagFollow) - 1];
                    }
                } elseif ($data->RecentActivity == "Play") {
                    if (isset($data->CurrentScheduledPlayers)) {
                        $PlayedUsers = array_values(array_unique($data->CurrentScheduledPlayers));
                        if (sizeof($PlayedUsers) > 1) {
                            $recentActivity1UserId = $PlayedUsers[sizeof($PlayedUsers) - 1]['UserId'];
                            $recentActivity2UserId = $PlayedUsers[sizeof($PlayedUsers) - 2]['UserId'];
                        } elseif (sizeof($PlayedUsers) == 1) {
                            $recentActivity1UserId = $PlayedUsers[sizeof($PlayedUsers) - 1]['UserId'];
                        }
                    }
                } elseif ($data->RecentActivity == "Schedule") {
                    $recentActivity2UserId = $data->OriginalUserId;
                }

                $recentActivityUser1 = UserCollection::model()->getTinyUserCollection($recentActivity1UserId);
                if (!empty($recentActivity2UserId)) {
                    $recentActivityUser2 = UserCollection::model()->getTinyUserCollection($recentActivity2UserId);
                }
                $whosePost = "";
                if ($data->ActionType == 'Comment' || $data->ActionType == 'Follow' || $data->ActionType == 'EventAttend' || $data->ActionType == 'Invite') {
                    if ($data->OriginalUserId == $UserId) {
                        $whosePost = "your";
                    } elseif (in_array($data->OriginalUserId, array_unique($data->UserFollowers)) || in_array($data->OriginalUserId, array_unique($data->PostFollowers))) {
                        $whosePost = $tinyOriginalUser['DisplayName'];
                    }
                }
                $userId1 = $recentActivityUser1['UserId'];
                $userId2 = "";
                $displayName1 = $UserId == $recentActivityUser1['UserId'] ? 'You' : $recentActivityUser1['DisplayName'];
                if ($PostAsNetwork == 1) {
                    $displayName1 = $recentActivityUser1['DisplayName'];
                }
                $displayName2 = "";
                $secondUser = "";
                if (!empty($recentActivityUser2)) {
                    $userId2 = $recentActivityUser2['UserId'];
                    $displayName2 = $UserId == $recentActivityUser2['UserId'] ? 'You' : $recentActivityUser2['DisplayName'];
                    if ($PostAsNetwork == 1) {
                        $displayName2 = $recentActivityUser2['DisplayName'];
                    }
                    if ($displayName2 == "You") {
                        $displayName2 = $displayName1;
                        $displayName1 = "You";
                        $temp = $userId1;
                        $userId1 = $userId2;
                        $userId2 = $temp;
                    }
                    $secondUser = ", <a class='userprofilename' data-id='" . $userId2 . "' style='cursor:pointer'><b>" . $displayName2 . "</b></a>";
                }

                $data->FirstUserId = $userId1;
                $data->FirstUserDisplayName = $displayName1;
                if ($data->CategoryType == 13) {
                    $data->FirstUserProfilePic =$data->NetworkLogo;
                }
                else{
                    $data->FirstUserProfilePic = $recentActivityUser1['profile250x250'];
                }
                $data->SecondUserData = $secondUser;
                $data->PostBy = $whosePost;
                $data->OriginalUserDisplayName = $tinyOriginalUser['DisplayName'];
                $data->OriginalUserProfilePic = $tinyOriginalUser['profile70x70'];
                $data->IsFollowingPost = in_array($UserId, $data->PostFollowers);
                $data->IsLoved = in_array($UserId, $data->LoveUserId);
                $data->FbShare = isset($data->FbShare) && is_array($data->FbShare) ? in_array($UserId, $data->FbShare) : 0;
                $data->TwitterShare = isset($data->TwitterShare) && is_array($data->TwitterShare) ? in_array($UserId, $data->TwitterShare) : 0;
                $data->IsSurveyTaken = in_array($UserId, $data->SurveyTaken);
                $data->TotalSurveyCount = $data->OptionOneCount + $data->OptionTwoCount + $data->OptionThreeCount + $data->OptionFourCount;
                if (isset($data->OptionFour) && !empty($data->OptionFour))
                    $data->IsOptionDExist = 1;

                $image = "";
                if ($data->IsMultiPleResources > 0) {

                    if (isset($data->Resource["ThumbNailImage"])) {
                        $data->ArtifactIcon = Yii::app()->params['ServerURL'] . "" . $data->Resource["ThumbNailImage"];
                        $data->Resource["Uri"]= Yii::app()->params['ServerURL'] . "" . $data->Resource["Uri"];
                           if(isset($data->Resource["Height"])){
                                if($data->Resource["Height"]!=null && $data->Resource["Height"]!="") {                   
                            $data->Resource["Height"] = (100/$data->Resource["Width"])* $data->Resource["Height"] ;
                            }else{
                                 $data->Resource["Height"]="";
                            }
                           }
                           
                        } else {
                            
                        $data->ArtifactIcon = "";
                    }
                }
                if ($secondUser != "") {
                    if (trim($data->StreamNote) == "is following") {
                        $data->StreamNote = " are following";
                    }
                    if (trim($data->StreamNote) == "is attending") {
                        $data->StreamNote = " are attending";
                    }
                    if (trim($data->StreamNote) == "has answered") {
                        $data->StreamNote = " have answered";
                    }
                    if (trim($data->StreamNote) == "is Played") {
                        $data->StreamNote = " are Played";
                    }
                    if (trim($data->StreamNote) == "has Played") {
                        $data->StreamNote = " have Played ";
                    }
                }
                if ($UserId == $recentActivityUser1['UserId'] && trim($secondUser) == "") {


                    if (trim($data->StreamNote) == "is following") {
                        $data->StreamNote = " are following";
                    }
                    if (trim($data->StreamNote) == "is attending") {
                        $data->StreamNote = " are attending";
                    }
                    if (trim($data->StreamNote) == "has answered") {
                        $data->StreamNote = " have answered";
                    }if (trim($data->StreamNote) == "is Played") {
                        $data->StreamNote = " Played";
                    }
                    if (trim($data->StreamNote) == "has invited to") {
                        $data->StreamNote = " have invited to ";
                    }
                    if (trim($data->StreamNote) == "has Played") {
                        $data->StreamNote = " have Played ";
                    }
                }

                if ($data->PostType == 4) {
                    $data->PostBy = "";
                    if ($data->ActionType == "Post") {
                        $data->PostBy = "";
                        $data->FirstUserDisplayName = "";
                        $data->FirstUserProfilePic = "/images/icons/user_noimage.png";
                        $data->SecondUserData = "";
                        $data->StreamNote= "A new post has been created";
                        $data->PostTypeString = "";
                    }
                }
//                 if($data->UserId == 0 && $data->CategoryType == 1){
//                      $data->StreamNote = " made ";
//                     
//                 }
//                  if($data->UserId == 0 && $data->CategoryType == 2){
//                      $data->StreamNote = " posted ";
//                     
//                 }
                     
                if ($data->PostType == 2) {

                    $eventStartDate = CommonUtility::convert_time_zone($data->StartDate->sec, $timezone, '', 'sec');
                    $eventEndDate = CommonUtility::convert_time_zone($data->EndDate->sec, $timezone, '', 'sec');
                    $data->Title = $data->Title;
                    $data->StartDate = date("Y-m-d", $eventStartDate);
                    $data->EndDate = date("Y-m-d", $eventEndDate);
                    $data->EventStartDay = date("d", $eventStartDate);
                    $data->EventStartDayString = date("l", $eventStartDate);
                    $data->EventStartMonth = date("M", $eventStartDate);
                    $data->EventStartYear = date("Y", $eventStartDate);
                    $data->EventEndDay = date("d", $eventEndDate);
                    $data->EventEndDayString = date("l", $eventEndDate);
                    $data->EventEndMonth = date("M", $eventEndDate);
                    $data->EventEndYear = date("Y", $eventEndDate);
                    $data->StartTime = date("h:i A", $eventStartDate);
                    $data->EndTime = date("h:i A", $eventEndDate);
                    if ($eventEndDate <= CommonUtility::currentSpecifictime_timezone($timezone)) {
                        $data->CanPromotePost = 0;
                        $data->IsEventAttend = 1;
                    } else {
                        $data->IsEventAttend = in_array($UserId, $data->EventAttendes);
                    }
                } elseif ($data->PostType == 3) {


                    $surveyExpiryDate = $data->ExpiryDate;
                    $data->Title = $data->Title;
                    if (isset($surveyExpiryDate->sec) && $surveyExpiryDate->sec <= time()) {
                        $data->CanPromotePost = 0;
                        $data->ExpiryDate = date("Y-m-d", $surveyExpiryDate->sec);
                    }
                    $surveyExpiryDate_tz = CommonUtility::convert_date_zone($surveyExpiryDate->sec, $timezone);
                    $currentDate_tz = CommonUtility::currentdate_timezone($timezone);
                    if ($surveyExpiryDate_tz < $currentDate_tz) {
                        //  error_log("survey-------------------------if"); 
                        $data->IsSurveyTaken = true; //expired
                    }
                }

                $comments = $data->Comments;
                $commentCount = sizeof($comments);
                $data->CommentCount = $data->CommentCount;
                $commentsArray = array();
                if ($commentCount > 0) {
                    $data->IsCommented = in_array((int) $UserId, $data->CommentUserId);
                    //$maxDisplaySize = $commentCount>2?2:$commentCount;
                    $commentsDisplayCount = 0;
                    for ($j = $commentCount; $j > 0; $j--) {
                        $comment = $comments[$j - 1];
                        $isBlockedComment = isset($comment['IsBlockedWordExist']) ? $comment['IsBlockedWordExist'] : 0;
                        if ($isBlockedComment != 1) {
                            $commentsDisplayCount++;
                            $commentedUser = UserCollection::model()->getTinyUserCollection($comment["UserId"]);
                            $comment["CreatedOn"] = $comment["CreatedOn"];
                            $textWithOutHtml = $comment["CommentText"];

                            if (isset($comment['WebUrls']) && !empty($comment['WebUrls']) && $comment['WebUrls'] != null) {

                                if (isset($comment['IsWebSnippetExist']) && $comment['IsWebSnippetExist'] == '1') {
                                    $CommentSnippetdata = WebSnippetCollection::model()->CheckWebUrlExist($comment['WebUrls'][0]);
                                    $comment['WebUrls'] = $CommentSnippetdata;
                                } else {

                                    $comment['WebUrls'] = "";
                                }
                            }
                            if (isset($comment["CommentTextLength"]) && $comment["CommentTextLength"] > 240) {

                                $appendCommentData = ' <span class="postdetail tooltiplink" data-id="' . $data->_id . '"  data-placement="bottom" rel="tooltip"  data-original-title="See More" data-postid="' . $data->PostId . '" data-categoryType="' . $data->CategoryType . '" data-postType="' . $data->PostType . '"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                                // $description = CommonUtility::truncateHtml($comment["CommentText"], 240,$appendCommentData);
                                $description = CommonUtility::truncateHtml($comment["CommentText"], 240, '...', true, true, $appendCommentData);
                                $text = $description;

                                $comment["CommentText"] = str_replace("&nbsp;"," ",$text);
                            } else {

                                $comment["CommentText"] =  str_replace("&nbsp;"," ",$comment["CommentText"]);
                            }
                            $comment['ProfilePicture'] = $commentedUser['profile70x70'];
                            $commentCreatedOn = $comment["CreatedOn"];
                            $comment["CreatedOn"] = CommonUtility::styleDateTime($commentCreatedOn->sec, 'mobile');
                            $comment["DisplayName"] = $commentedUser['DisplayName'];
                            $image = "";
                            $height="";
                            if (sizeof($comment["Artifacts"]) > 0) {
                                if (isset($comment["Artifacts"]['ThumbNailImage'])) {
                                    $image = Yii::app()->params['ServerURL'] . "" . $comment["Artifacts"]['ThumbNailImage'];
                               if(isset($comment["Artifacts"]['Height'])){
                                   $height = $comment["Artifacts"]['Height'];
                                if(isset($comment["Artifacts"]["Height"])&& !empty($comment["Artifacts"]["Height"])){
                               $height = (100/$comment["Artifacts"]["Width"])* $comment["Artifacts"]["Height"];
                                }  
                               }
                                  
                                    $ArtifactExtension=$comment["Artifacts"]['Extension'];
                                    $comment["ArtifactExtension"] = strtolower($ArtifactExtension);
                                    
                                } else {
                                    $image = "";
                                    $height="";
                                    $comment["ArtifactExtension"] = "";
                                }
                            }
                            $comment["ArtifactIcon"] = $image;
                             $comment["Height"] = $height;
                           
                            array_push($commentsArray, $comment);
                            if ($commentsDisplayCount == 2) {
                                break;
                            }
                        }
                    }
                }
                $data->Comments = $commentsArray;
                if ($data->CategoryType == 3) {
                    if (isset($data->GroupId)) {
                        $data->PostTypeString = " " . $data->PostTypeString;
                    }
                }
                if ($data->CategoryType == 7) {
                    if (isset($data->SubGroupId)) {
                        $data->PostTypeString = " " . $data->PostTypeString;
                    }
                }


                /**
                 * follow Object  post type
                 * post type user is 6
                 * post type hashtag 7
                 * post type curbsidecategory 8
                 * post  type group 9
                 */
                if ($data->PostType == 9) {
                    if (isset($data->GroupId)) {
                        $groupData = GroupCollection::model()->getGroupDetailsById($data->GroupId);

                        $data->GroupImage = Yii::app()->params['ServerURL'] . $groupData->GroupProfileImage;
                        $data->GroupName = $groupData->GroupName;

                        if (strlen($groupData->GroupDescription) > 240) {
                            $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                            $data->GroupDescription = $description . "  ...";
                        } else {
                            $data->GroupDescription = $groupData->GroupDescription;
                        }
                        //$data->GroupDescription = $groupData->GroupDescription;
                        $data->GroupFollowersCount = sizeof($groupData->GroupMembers);
                        $data->IsFollowingEntity = in_array($UserId, $groupData->GroupMembers);
                        $data->PostTypeString = " Group ";
                    }
                }

                if ($data->PostType == 10) {
                    if (isset($data->SubGroupId)) {
                        $groupData = SubGroupCollection::model()->getSubGroupDetailsById($data->SubGroupId);
                        $data->SubGroupImage = Yii::app()->params['ServerURL'] . $groupData->SubGroupProfileImage;
                        $data->SubGroupName = $groupData->SubGroupName;

                        if (strlen($groupData->SubGroupDescription) > 240) {
                            $description = CommonUtility::truncateHtml($groupData->GroupDescription, 240);
                            $data->SubGroupDescription = $description . "  ...";
                        } else {
                            $data->SubGroupDescription = $groupData->SubGroupDescription;
                        }
                        //$data->GroupDescription = $groupData->GroupDescription;
                        $data->SubGroupFollowersCount = sizeof($groupData->SubGroupMembers);
                        $data->IsFollowingEntity = in_array($UserId, $groupData->SubGroupMembers);
                        $data->PostTypeString = " Sub Group ";
                    }
                }
                if ($data->PostType == 7) {
                    $data->PostTypeString = " #Tag";
                    $data->GroupImage = Yii::app()->params['ServerURL'] . "/images/icons/hashtag_img.png";
                    $data->HashTagName = $data->HashTagName;
                    $data->GroupDescription = "";
                    $data->HashTagPostCount = count($data->HashTagFollowers);

                    $data->IsFollowingEntity = in_array($UserId, $data->HashTagFollowers);
                    $data->PostTypeString = " " . $data->HashTagName;
                }
                if ($data->PostType == 8) {
                    $name = Yii::t('translation', 'CurbsideConsult');
                    $data->PostTypeString = " $name Category";
                    $data->GroupImage = Yii::app()->params['ServerURL'] . "/images/icons/curbesidepost_img.png";
                    $data->CurbsideConsultCategory = $data->CurbsideConsultCategory;
                    $data->GroupDescription = "";
                    // $data->CurbsidePostCount =  $data->CurbsidePostCount;
                    $data->CurbsidePostCount = sizeof($data->CurbsideCategoryFollowers);
                    $data->IsFollowingEntity = in_array($UserId, $data->CurbsideCategoryFollowers);
                    $data->PostTypeString = " " . $data->PostTypeString;
                }
                if ($data->PostType == 11) {
                  
                  $pattern = '/object/';
                    if(preg_match($pattern, $data->HtmlFragment)){
                        
                        $data->IsVideo = 1;
                    }else{
                         
                         $data->IsVideo = 0;
                        
                    }
                    if($isHomeStream==1){
                        $width="width='100'";
                        $height="height='100'";
                    }else{
                          $width="width='250'";
                        $height="height='250'";
                    }
                    $pattern = '/(width)="[0-9]*"/';
                    $string=$data->HtmlFragment;
                    $string = preg_replace($pattern, $width, $string);
                    $pattern = '/(height)="[0-9]*"/';
                    $string = preg_replace($pattern, $height, $string);

                    $data->HtmlFragment = $string;
                    $data->IsNotifiable = (int) $data->IsNotifiable;
                    $data->PublicationDate = CommonUtility::styleDateTime(strtotime($data->PublicationDate), "mobile");
                    if ($data->Editorial != '') {
                        $editorial = $data->Editorial;
                        if (strlen($data->Editorial) > 240) {
                            $editorial = substr($editorial, 0, 240);
                            $editorial = $editorial . '<a data-placement="bottom" rel="tooltip"  data-original-title="show more" class="showmore postdetail" data-id="' . $data->PostId . '">...</a>';
                        }
                        $data->Editorial = $editorial;
                    }
                }elseif ($data->PostType == 13) {
                    $data->PostTypeString = $data->BadgeName." badge";
                }

if ($data->CategoryType == 13) {
           
    $date = date('Y-m-d');
$sdate = new DateTime($data->StartDate);
$exdate = new DateTime($data->ExpiryDate);
$sdate=$sdate->format('Y-m-d');
$exdate =$exdate->format('Y-m-d');
$redirectUrl=$data->RedirectUrl;
    
if($data->AdType==3){
    
    $requestedFieldsArray=  explode(",", $data->RequestedFields);
    $QueryParms;
    $userobj = UserCollection::model()->getTinyUserCollection($UserId);
    $md5=md5($UserId."_".$data->AdvertisementId);
    foreach($requestedFieldsArray as  $value){
        $customUserId=null;
         $customdisplayName=null;
         if ($data->RequestedParams != "" && $data->RequestedParams != null) {
            $reqParms = explode(',', $data->RequestedParams);
            
            foreach ($reqParms as $param) {
                $paramList = explode(':', $param);
                if (trim($paramList[0]) == "UserId") {
                   $customUserId=$paramList[1];
                }
                if (trim($paramList[0]) == "Display Name") {
                   $customdisplayName=$paramList[1];
                }
            }
        }

        $QueryParms=($QueryParms==""?$QueryParms:$QueryParms."&");
       if($value=="UserId"){
           if($customUserId==null){
              $QueryParms.=trim($value)."=".$md5;   
           }
           else{
               $QueryParms.=trim($customUserId)."=".$md5;
           }
          
       }
       if(trim($value)=="Display Name"){
           if($customdisplayName==null){
             $QueryParms.=trim($value)."=".$userobj->DisplayName;   
           }
           else{
              $QueryParms.=trim($customdisplayName)."=".$userobj->DisplayName;     
           }
            
       }
       if(trim($value)=="Email"){
           $QueryParms.=trim($value)."=".Yii::app()->session['Email'];  
       }
    }
     $QueryParms=str_replace(' ', '', $QueryParms);
    
   if(stristr($redirectUrl,"?")==""){
      $redirectUrl.="?".$QueryParms."&NeoId=".$md5; 
   } else{
      $redirectUrl.="&".$QueryParms."&NeoId=".$md5;  
   } 
  
}

if($data->IsNotifiable==1 && $sdate<=$date && $date<=$exdate){$data->IsNotifiable=1;}else{$data->IsNotifiable=0;}

$data->RedirectUrl=$redirectUrl;



                }
                $data->PostId = (String) $data->PostId;
                $data->_id = (String) $data->_id;
                array_push($currentStreamIdArray, (string)$data->PostId);
                }else{
                    
                    unset($streamPostData[$key]);
                    continue;
                }
            }
            //if($isHomeStream == 1){
                
                return array('streamPostData'=>$streamPostData, 'streamIdArray'=>$currentStreamIdArray,"totalStreamIdArray"=>$totalStreamIdArray);
//            }else{
//                return $streamPostData;
//            }

        } catch (Exception $ex) {
            error_log("__________exception_________________________________" . $ex->getMessage());
            error_log("__________exception_________________________________" . $ex->getLine());
            Yii::log("********EXCEPTION***************************" . $ex->getMessage(), 'error', 'application');
        }
    }

    public static function prepareCommentObject($rs, $commentDisplayCount = 0) {
        try {
            $commentCount = 0;
            $MoreCommentsArray = array();
            foreach ($rs as $key => $value) {
                if (!(isset($value['IsBlockedWordExist']) && $value['IsBlockedWordExist'] == 1)) {
                    $commentUserBean = new CommentUserBean();
                    $userDetails = ServiceFactory::getSkiptaUserServiceInstance()->getTinyUserCollection($value['UserId']);
                    $createdOn = $value['CreatedOn'];
                    $commentUserBean->UserId = $userDetails['UserId'];

                    $postId = (isset($value["PostId"])) ? $value["PostId"] : '';
                    $CategoryType = (isset($value["CategoryType"])) ? $value["CategoryType"] : '';
                    $PostType = (isset($value["PostType"])) ? $value["PostType"] : '';
                    $value["CommentText"] = $value["CommentText"];
                    $commentUserBean->CommentText = str_replace("&nbsp;", " ", $value['CommentText']);
                    if (is_int($createdOn)) {
                        
                        $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn, "mobile");
                    } else if (is_numeric($createdOn)) {
                        
                        $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn, "mobile");
                    } else {
                        
                        $commentUserBean->PostOn = CommonUtility::styleDateTime($createdOn->sec, "mobile");
                    }

                    $commentUserBean->DisplayName = $userDetails['DisplayName'];
                    $commentUserBean->ProfilePic = $userDetails['profile70x70'];
                    $commentUserBean->CateogryType = $CategoryType;
                    $commentUserBean->PostId = $postId;
                    $commentUserBean->Type = $PostType;
                    foreach ($value['Artifacts'] as $key => $artifact) {
                        $value['Artifacts'][$key]['VideoImageExist'] = 1;
                        $filetype = strtolower($artifact["Extension"]);
                        $value['Artifacts'][$key]['Uri'] = Yii::app()->params['ServerURL'] . $artifact['Uri'];
                        if ($filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv') {
                            $filename = "/images/system/video_img.png";
                            if (file_exists($artifact["ThumbNailImage"])) {
                                $filename = $artifact["ThumbNailImage"];
                            }else{
                                $value['Artifacts'][$key]['VideoImageExist'] = 0;
                            }
                            $value['Artifacts'][$key]['ThumbNailImage'] = Yii::app()->params['ServerURL'] . $filename;
                        } else if ($filetype == 'mp3') {
                            $filename = "/images/system/audio_img.png";
                            if (file_exists($artifact["ThumbNailImage"])) {
                                $filename = $artifact["ThumbNailImage"];
                            }else{
                                $value['Artifacts'][$key]['VideoImageExist'] = 0;
                            }
                            $value['Artifacts'][$key]['ThumbNailImage'] = Yii::app()->params['ServerURL'] . $filename;
                        }else{
                            $value['Artifacts'][$key]['ThumbNailImage'] = Yii::app()->params['ServerURL'].$artifact['ThumbNailImage'];
                        }
                    }
                    $commentUserBean->Resource = $value['Artifacts'];
                    $commentUserBean->ResourceCount = count($commentUserBean->Resource);
                    $commentUserBean->ResourceLength = count($value['Artifacts']);
                    //$commenturls=$value['WebUrls'];
                    if (array_key_exists('WebUrls', $value)) {
                        $snippetData = "";
                        if (isset($value['WebUrls']) && is_array($value['WebUrls']) && count($value['WebUrls']) > 0) {
                            $commenturls = $value['WebUrls'];
                            $WeburlObj = ServiceFactory::getSkiptaPostServiceInstance()->CheckWebUrlExist($commenturls[0]);
                            if ($WeburlObj != 'failure') {
                                $snippetData = $WeburlObj;
                            }
                        }
                        $commentUserBean->snippetdata = $snippetData;
                        if (isset($value['IsWebSnippetExist'])) {
                            $commentUserBean->IsWebSnippetExist = $value['IsWebSnippetExist'];
                        } else {
                            $commentUserBean->IsWebSnippetExist = "";
                        }
                    }

                    array_push($MoreCommentsArray, $commentUserBean);
                    $commentCount++;
                    if ($commentDisplayCount != 0 && $commentCount == $commentDisplayCount) {
                        break;
                    }
                }
            }
            return $MoreCommentsArray;
        } catch (Exception $ex) {
            error_log("__________exception__________prepareCommentObject___" . $ex->getLine());
        }
    }

    /**
     * @author Haribabu 
     *  get the intervals bettwo dates
     * @param type array
     */
    public static function GetIntervalsBetweenTwoDates($startDate, $endDate) {
        try {
            $valid_times = array();
            $finalArray = array();
            $dateFrom = new DateTime($startDate);
            $dateTo = new DateTime($endDate);

            $interval = date_diff($dateFrom, $dateTo);
            $diff = $interval->format('%R%a');

            $intervals = ceil($diff / 10);
            if ($diff > 365) {

                $finalArray = CommonUtility::get_years($startDate, $endDate);
            } elseif ($diff > 92 && $diff <= 365) {
                $finalArray = CommonUtility::get_months($startDate, $endDate);
            } elseif ($diff > 31 && $diff <= 92) {
                $finalArray = CommonUtility::get_weeks($startDate, $endDate);
            } elseif ($diff <= 31) {

                $finalArray = CommonUtility::get_dates($startDate, $endDate);
            }

            return $finalArray;
        } catch (Exception $e) {
            Yii::log("Excepiton ", 'application', 'error');
        }
    }

    /**
     * @author Karteek.V
     * @param type $Ndata
     * @return array
     */
    public static function prepareStringToNotification($Ndata,$deviceType="web") {
        try {
            // error_log("----------prepareStringToNotification---------------"); 
            $totalArray = array();
            $totalNotificationTobeShownCount = 0;
            foreach ($Ndata as $data) {
//               error_log(print_r($data,true));
               // if ($totalNotificationTobeShownCount < 10) {
                    $notifications = new NotificationBean();
                    $userName = "";
                    $postText = CommonUtility::postStringTypebyIndex((int) $data->PostType, (int) $data->CategoryType);
                    $custompostText = $postText;
                    //love...
                    if (isset($data->Love) && $data->RecentActivity == "love") {
                        $data->Love=  array_values(array_unique($data->Love));
                        if (sizeof($data->Love) >= 2) {
                            $firstUserId = end($data->Love);
                            $nextUserId = prev($data->Love);
                            if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                                $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }

                            if ($firstUserId != $nextUserId && sizeof($data->Love) > 2) {
                                $userName = "$userName and others love your $postText";
                            } else if ($firstUserId != $nextUserId && sizeof($data->Love) == 2) {
                                $userName = "$userName  love your $postText";
                            } else {
                                $userName = "$userName loves your $postText";
                            }
                        } else if (sizeof($data->Love) > 0) {
                            $firstUserId = end($data->Love);
                            if (isset($firstUserId) && !empty($firstUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;

                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  loves your $postText";
                            }
                        }
                        $createdOn = $data->CreatedOn;
                        $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,$deviceType);
                        $notifications->NotificationString = $userName;
                        $notifications->IsRead = $data->isRead;
                        $notifications->_id = $data->_id;
                        $notifications->PostId = $data->PostId;
                        $notifications->PostType = $data->PostType;
                        $notifications->CategoryType = $data->CategoryType;
                        array_push($totalArray, $notifications);
                    }
                    //comment...
                    if ($data->RecentActivity == "comment" && isset($data->CommentUserId)) {
                        if (sizeof($data->CommentUserId) >= 2) {
                            $firstUserId = end($data->CommentUserId);
                            $nextUserId = prev($data->CommentUserId);
                            if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                                $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if ($firstUserId != $nextUserId && sizeof($data->CommentUserId) > 2) {
                                $userName = "$userName and others commented on your $postText";
                            } else if ($firstUserId != $nextUserId && sizeof($data->CommentUserId) == 2) {
                                $userName = "$userName  commented on your $postText";
                            } else {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "$userName commented on your $postText";
                            }
                        } else if (sizeof($data->CommentUserId) > 0) {
                            $firstUserId = end($data->CommentUserId);
                            if (isset($firstUserId) && !empty($firstUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;

                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  commented on your $postText";
                            }
                        }
                        if (!empty($userName)) {
                            $createdOn = $data->CreatedOn;
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,$deviceType);
                            $notifications->NotificationString = $userName;
                            $notifications->IsRead = $data->isRead;
                            $notifications->_id = $data->_id;
                            $notifications->PostId = $data->PostId;
                            $notifications->PostType = $data->PostType;
                            $notifications->CategoryType = $data->CategoryType;
                            array_push($totalArray, $notifications);
                        }
                    }
                    //follow...
                    if ($data->RecentActivity == "follow" && isset($data->PostFollowers)) {
                        if (sizeof($data->PostFollowers) >= 2) {
                            $firstUserId = end($data->PostFollowers);
                            $nextUserId = prev($data->PostFollowers);
                            if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                                $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if ($firstUserId != $nextUserId && sizeof($data->PostFollowers) > 2) {
                                $userName = "$userName and others are following your $postText";
                            } else if ($firstUserId != $nextUserId && sizeof($data->PostFollowers) == 2) {
                                $userName = "$userName are following your $postText";
                            } else {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "$userName is following your $postText";
                            }
                        } else if (sizeof($data->PostFollowers) > 0) {
                            $firstUserId = end($data->PostFollowers);
                            if (isset($firstUserId) && !empty($firstUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;

                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>  is following your $postText";
                            }
                        }
                        if (!empty($userName)) {
                            $createdOn = $data->CreatedOn;
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,$deviceType);
                            $notifications->NotificationString = $userName;
                            $notifications->IsRead = $data->isRead;
                            $notifications->_id = $data->_id;
                            $notifications->PostId = $data->PostId;
                            $notifications->PostType = $data->PostType;
                            $notifications->CategoryType = $data->CategoryType;
                            array_push($totalArray, $notifications);
                        }
                    }
                    //mentioned...
                    if ($data->RecentActivity == "mention" && isset($data->MentionedUserId)) {
                        if (!empty($data->MentionedUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->MentionedUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> to mentioned you on  $custompostText";
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                        }
                        if (!empty($userName)) {
                            $createdOn = $data->CreatedOn;
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,$deviceType);
                            $notifications->NotificationString = $userName;
                            $notifications->IsRead = $data->isRead;
                            $notifications->_id = $data->_id;
                            $notifications->PostId = $data->PostId;
                            $notifications->PostType = $data->PostType;
                            $notifications->CategoryType = $data->CategoryType;
                            array_push($totalArray, $notifications);
                        }
                    }
                    // invite ...
                    if ($data->RecentActivity == "invite" && isset($data->InviteUserId)) {
                        
                        if (!empty($data->InviteUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->InviteUserId);
                            $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> is inviting you to $custompostText";
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                        }
                        if (!empty($userName)) {
                            
                            $createdOn = $data->CreatedOn;
                            if (is_int($createdOn)) {
                                
                                $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn,$deviceType);
                            } else if (is_numeric($createdOn)) {
                                
                                $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn,$deviceType);
                            } else {
                                
                                $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,$deviceType);
                            }
                            
                            $notifications->NotificationString = $userName;
                            $notifications->IsRead = $data->isRead;
                            $notifications->_id = $data->_id;
                            $notifications->PostId = $data->PostId;
                            $notifications->PostType = $data->PostType;
                            $notifications->CategoryType = $data->CategoryType;
                            array_push($totalArray, $notifications);
                        }
                        
                    }

                    // UserFollow ...
                    if ($data->RecentActivity == "UserFollow" && isset($data->NewFollowers)) {
                        if (sizeof($data->NewFollowers) >= 2) {
                            $firstUserId = end($data->NewFollowers);
                            $nextUserId = prev($data->NewFollowers);
                            if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                                $userName = "$userName,<b class='notification_displayname'>$tinyUserObject->DisplayName</b>";
                            }
                            if ($firstUserId != $nextUserId && sizeof($data->NewFollowers) > 2) {
                                $userName = "$userName and others are following you";
                            } else if ($firstUserId != $nextUserId && sizeof($data->NewFollowers) == 2) {
                                $userName = "$userName are following you";
                            } else {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "$userName is following you";
                            }
                        } else if (sizeof($data->NewFollowers) > 0) {
                            $firstUserId = end($data->NewFollowers);
                            if (isset($firstUserId) && !empty($firstUserId)) {
                                $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;

                                $userName = "<b class='notification_displayname'>$tinyUserObject->DisplayName</b> is following you";
                            }
                        }
                        if (!empty($userName)) {
                            
                            $createdOn = $data->CreatedOn;
                            $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec,$deviceType);
                            $notifications->NotificationString = $userName;
                            $notifications->IsRead = $data->isRead;
                            $notifications->_id = $data->_id;
                            $notifications->PostId = $data->PostId;
                            $notifications->PostType = $data->PostType;
                            $notifications->CategoryType = $data->CategoryType;
                            array_push($totalArray, $notifications);
                        } else {
                            
                        }
                    }

                    // invite

                    $totalNotificationTobeShownCount++;
               // }
            }
            
            return $totalArray;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    public function preparedAllNotificaions($Ndata) {
        try {
            $totalArray = array();
            $totalNotificationTobeShownCount = 0;
            foreach ($Ndata as $data) {
                $notifications = new NotificationBean();
                $userName = "";
                $userFollowName = "";
                $postText = CommonUtility::postStringTypebyIndex((int) $data->PostType);
                $custompostText = $postText;
                //love...
//                if($data->RecentActivity == "love" || $data->RecentActivity == "comment" || $data->RecentActivity == "follow" || $data->RecentActivity == "love"){
//                    
//                }
                //comment...
                if ($data->RecentActivity == "comment" || isset($data->CommentUserId)) {
                    if (sizeof($data->CommentUserId) >= 2) {
                        $firstUserId = end($data->CommentUserId);
                        $nextUserId = prev($data->CommentUserId);
                        if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                        }
                        if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                            $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                        }
                        if ($firstUserId != $nextUserId && sizeof($data->CommentUserId) > 2) {
                            $userName = "$userName and others commented on your $postText";
                        } else if ($firstUserId != $nextUserId && sizeof($data->CommentUserId) == 2) {
                            $userName = "$userName  commented on your $postText";
                        } else {
                            $userName = "$userName commented on your $postText";
                        }
                    } else if (sizeof($data->CommentUserId) > 0) {
                        $firstUserId = end($data->CommentUserId);
                        if (isset($firstUserId) && !empty($firstUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>  commented on your $postText";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>  commented on your $postText";
                            }
                        }
                    }
                }
                // love
                if (isset($data->Love)) {
                    if (sizeof($data->Love) >= 2) {
                        $firstUserId = end($data->Love);
                        $nextUserId = prev($data->Love);
                        if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                        }
                        if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                        }

                        if ($firstUserId != $nextUserId && sizeof($data->Love) > 2) {
                            $userName = "$userName and others love your $postText";
                        } else if ($firstUserId != $nextUserId && sizeof($data->Love) == 2) {
                            $userName = "$userName love your $postText";
                        } else {
                            $userName = "$userName loves your $postText";
                        }
                    } else if (sizeof($data->Love) > 0) {
                        $firstUserId = end($data->Love);
                        if (isset($firstUserId) && !empty($firstUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>  loves your $postText";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> love your $postText";
                            }
                        }
                    }
                }

                //follow...
                if (isset($data->PostFollowers)) {
                    if (sizeof($data->PostFollowers) >= 2) {
                        $firstUserId = end($data->PostFollowers);
                        $nextUserId = prev($data->PostFollowers);
                        if ((isset($firstUserId) && !empty($firstUserId)) || ($firstUserId == $nextUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                        }
                        if (isset($nextUserId) && !empty($nextUserId) && ($firstUserId != $nextUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName,<span class='m_title'>$tinyUserObject->DisplayName</span>";
                            }
                        }
                        if ($firstUserId != $nextUserId && sizeof($data->PostFollowers) > 2) {
                            $userName = "$userName and others are following your $postText";
                        } else if ($firstUserId != $nextUserId && sizeof($data->PostFollowers) == 2) {
                            $userName = "$userName are following your $postText";
                        } else {
                            $userName = "$userName following your $postText";
                        }
                    } else if (sizeof($data->PostFollowers) > 0) {
                        $firstUserId = end($data->PostFollowers);
                        if (isset($firstUserId) && !empty($firstUserId)) {
                            $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);

                            if (empty($userName)) {
                                $notifications->DisplayName = $tinyUserObject->DisplayName;
                                $notifications->ProfilePic = $tinyUserObject->profile70x70;
                                $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>  is following your $postText";
                            } else {
                                $notifications->DisplayName = "";
                                $notifications->ProfilePic = "";
                                $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span>  are following your $postText";
                            }
                        }
                    }
                }
                //mentioned...
                if (isset($data->MentionedUserId)) {
                    if (!empty($data->MentionedUserId)) {
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->MentionedUserId);
                        if (empty($userName)) {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span> to mentioned you on $custompostText";
                        } else {
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> to mentioned you on $custompostText";
                        }
                    }
                }

                // invite ...
                if (isset($data->InviteUserId)) {
                    if (!empty($data->InviteUserId)) {
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($data->InviteUserId);
                        if (empty($userName)) {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $userName = "<span class='m_title'>$tinyUserObject->DisplayName</span>  is inviting  you to $custompostText";
                        } else {
                            $notifications->DisplayName = "";
                            $notifications->ProfilePic = "";
                            $userName = "$userName, <span class='m_title'>$tinyUserObject->DisplayName</span> are inviting  you to $custompostText";
                        }
                    }
                }

                // UserFollow ...
                if (isset($data->NewFollowers)) {
                    if (sizeof($data->NewFollowers) > 0) {
                        $data->NewFollowers = array_values(array_unique($data->NewFollowers));

                        $firstUserId = end($data->NewFollowers);
                        $nextUserId = prev($data->NewFollowers);
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($firstUserId);
                        if (isset($tinyUserObject)) {

                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = $tinyUserObject->profile70x70;
                            $notifications->NotificationType = "userfollow";

                            $userFollowName = "<span class='userprofilename_notification m_title' data-notid='$data->_id' data-id='$tinyUserObject->UserId'>$tinyUserObject->DisplayName</span>";
                        }
                        $tinyUserObject = UserCollection::model()->getTinyUserCollection($nextUserId);
                        if (isset($tinyUserObject)) {
                            $notifications->DisplayName = $tinyUserObject->DisplayName;
                            $notifications->ProfilePic = "";
                            $userFollowName = "$userFollowName, <span class='userprofilename_notification m_title' data-notid='$data->_id' data-id='$tinyUserObject->UserId'>$tinyUserObject->DisplayName</span>";
                        }
                        if (sizeof($data->NewFollowers) > 2) {
                            $userFollowName = "$userFollowName and others are following you";
                        } else if (sizeof($data->NewFollowers) == 2) {
                            $userFollowName = "$userFollowName are following you";
                        } else {
                            $userFollowName = "$userFollowName is following you";
                        }
                    }
                }


                $totalNotificationTobeShownCount++;
                $createdOn = $data->CreatedOn;
                $notifications->CreatedOn = CommonUtility::styleDateTime($createdOn->sec);
                if (!empty($userFollowName)) {
                    $notifications->NotificationString = $userFollowName;
                } else {
                    $notifications->NotificationString = $userName;
                }
                $notifications->IsRead = $data->isRead;
                $notifications->_id = $data->_id;
                $notifications->PostId = $data->PostId;
                $notifications->PostType = $data->PostType;
                $notifications->CategoryType = $data->CategoryType;
                array_push($totalArray, $notifications);
            }
            return $totalArray;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    public static function getNearyestWeekEndDate($date) {

        $time = strtotime($date);
        $found = false;
        while (!$found) {
            $d = date('N', $time);
            if ($d == 7) {
                $found = true;
                $weekend = date('Y-m-d', $time);
            }
            $time += 86400;
        }
        return $weekend;
        // echo("Weekend begins on: $weekend");
    }

    public static function get_months($date1, $date2) {

        $date1 = date('Y-m', strtotime($date1));
        $date2 = date('Y-m', strtotime($date2));

        if ($date1 < $date2) {
            $past = $date1;
            $future = $date2;
        } else {
            $past = $date2;
            $future = $date1;
        }

        $months = array();

        for ($i = $past; $past <= $future; $i++) {
            $timestamp = strtotime($past . '-1');
            $d = date('F Y', $timestamp);
            $m = intval(date('m', $timestamp));
            $months[$m] = $d;
            $past = date('Y-m', strtotime('+1 month', $timestamp));
        }
        return $months;
    }

    public static function get_weeks($startDate, $endDate) {

        $startDateUnix = strtotime($startDate);
        $endDateUnix = strtotime($endDate);

        $currentDateUnix = $startDateUnix;

        $weekNumbers = array();
        $i = 0;
        while ($currentDateUnix < $endDateUnix) {
            
            //  echo $currentDateUnix;
            // echo date('Y-m-d',$currentDateUnix);
            $week = date('W', $currentDateUnix);
            $year = date('Y', $currentDateUnix);
            $date = CommonUtility::getStartAndEndDate($week, $year);
            if ($i == 0) {
                if (strtotime($startDate) == strtotime($date)) {
                    $date = $date;
                } else {
                    // $date=$startDate;
                    $weekNumbers[$week - 1] = $startDate;
                }
            }

            $weekNumbers[$week] = $date;
            $currentDateUnix = strtotime('+1 week', $currentDateUnix);
            $i++;
        }
        
       
        return $weekNumbers;
    }

    public static function get_dates($startdate, $enddate) {

        $dates = array();
        $firstdate = array();
        $arrayone = array();
        $fday = intval(date('d', strtotime($startdate)));
        $dates[] = $startdate;

        while (end($dates) < $enddate) {

            $date = date('Y-m-d', strtotime(end($dates) . ' +1 day'));
            $day = intval(date('d', strtotime($date)));
            $dates[$day] = $date;
        }
        if (!array_key_exists($fday, $dates)) {
            $firstdate[$fday] = $startdate;
            unset($dates[0]);
            $arrayone = $firstdate + $dates;
        } else {
            $arrayone = $dates;
        }


        return $arrayone;
    }

    public static function get_years($stratdate, $enddate) {

        $NoOfIntervals = 'P1Y';
        $year = date('Y', strtotime($stratdate));
        $ydate = date("Y-m-d", mktime(0, 0, 0, 12, 31, $year));
        $dateFrom = new DateTime($stratdate);
        $dateTo = new DateTime($enddate);


        $valid_times[$year] = $year;
        while ($dateFrom <= $dateTo) {
            $dateFrom->add(new DateInterval($NoOfIntervals));
            $y = $dateFrom->format('Y');
            $valid_times[$y] = $y;
            $dateFrom = new DateTime($dateFrom->format('Y-m-d'));
        }

        return $valid_times;
    }

    public static function getAnalyticsData($collection, $match, $modeType, $id) {
        //echo $collection.'  '.$modeType;
        //print_r($match);
        //print_r($id);
        $c = $collection::model()->getCollection(); //$collection = 'GoogleAnalyticsCollection';
//
        //print_r($c);die();
        $results = $c->aggregate(
                array('$match' => $match
                ), array('$group' => array(
                '_id' => $id,
                //"count" => array('$sum' => 1),
            )), array(
            '$sort' => array('_id' => 1)
                )
        );

        return $results['result'];
    }
    
    public static function getUserLoginData($collection, $match, $modeType, $id) {
        //echo $collection.'  '.$modeType;
//        print_r($match);
//        print_r($id);
        $c = $collection::model()->getCollection(); //$collection = 'GoogleAnalyticsCollection';
//  
        //print_r($match);die();
        $results = $c->aggregate(
                array('$match' => $match
                ), array('$group' => array(
                '_id' => $id,
                "count" => array('$sum' => '$Pagevisits'),
            )), array(
            '$sort' => array('_id' => 1)
                )
        );
        //print_r($results['result']);die();
        return $results['result'];
    }    
    

    public static function getStartAndEndDate($week, $year) {
        // Adding leading zeros for weeks 1 - 9.
        $date_string = $year . 'W' . sprintf('%02d', $week);
        $startDate = date('Y-n-j', strtotime($date_string));
        $from = date("Y-m-d", strtotime("{$year}-W{$week}-7"));

        return $from;
    }

    //Badgin -related methods start----------------------
    
    public static function getUserMetaCollectionObjByUserId($UserId)
    {
         $metaObj=  UserMetaCollection::model()->getUserMetaCollectionByUserId($UserId);
         return $metaObj;
    }
    
    
    public static function startBadging($streamObj)
    {
      echo "Start badging called".$streamObj->ActionType;
        $metaObj= CommonUtility::getUserMetaCollectionObjByUserId($streamObj->UserId);
      
        if($streamObj->ActionType == 'UserFollow' ||  $streamObj->ActionType == "UserUnFollow")
        {
             
             $resUser=CommonUtility::prepareAndSaveUserMetaCollection($metaObj,"UserFollowing",$streamObj->UserId,$streamObj->ActionType,'');
             $followerObj= UserMetaCollection::model()->getUserMetaCollectionByUserId($streamObj->UserFollowers);
             $resUserFollowing=CommonUtility::prepareAndSaveUserMetaCollection($followerObj,"Followers",$streamObj->UserFollowers,$streamObj->ActionType,'');
             if($streamObj->ActionType == 'UserFollow')
             {
                 CommonUtility::badgingInterceptor("UserFollow",$streamObj->UserId);
                 CommonUtility::badgingInterceptor("UserFollowers",$streamObj->UserFollowers);
             }
            
        }
        else if($streamObj->ActionType == "Love")
        {
            $resUser=CommonUtility::prepareAndSaveUserMetaCollection($metaObj,"Loves",$streamObj->UserId,$streamObj->ActionType,'');
                    
            CommonUtility::badgingInterceptor("Love",$streamObj->UserId);
        }
        else if($streamObj->ActionType == "Comment")
        {
           
             $resObj=CommonUtility::prepareAndSaveUserMetaCollection($metaObj,"Comments",$streamObj->UserId,$streamObj->ActionType,''); 
            
             $metaObjComments= CommonUtility::getUserMetaCollectionObjByUserId($streamObj->UserId);
            
             if((count($metaObjComments)>0 && $metaObjComments->Comments==1 ))
             {
                // echo "In If conditon of comments";
             CommonUtility::badgingInterceptor("FirstComment",$streamObj->UserId);
             }
              $commentObj= $streamObj->Comments ;
             // echo "PRINT comemtn OBJ".print_r($commentObj);
              if(isset($commentObj) && count($commentObj['HashTags'])>0)
              {
                 $resObjHashTags=CommonUtility::prepareAndSaveUserMetaCollection($metaObjComments,"HashTags",$streamObj->UserId,$streamObj->ActionType,count($commentObj['HashTags'])) ;
                if($metaObjComments->HashTags==0 )
                {
                     CommonUtility::badgingInterceptor("FirstHashTag",$streamObj->UserId);
                }  
              }
              CommonUtility::badgingInterceptor("Comments",$streamObj->UserId);
        }
        else if($streamObj->CategoryType == 1 && $streamObj->PostType!=4 && $streamObj->ActionType=="Post")
        {
             $resObj=CommonUtility::prepareAndSaveUserMetaCollection($metaObj,"Posts",$streamObj->UserId,$streamObj->ActionType,''); 
             $metaObjPosts= CommonUtility::getUserMetaCollectionObjByUserId($streamObj->UserId);
             if((count($metaObjPosts)>0 && $metaObjPosts->Posts==1 ))
             {
              
                 CommonUtility::badgingInterceptor("FirstPost",$streamObj->UserId);
             }
           
             
        }
        
        else if($streamObj->CategoryType == 2 && ($streamObj->PostType==5 ) && $streamObj->ActionType=="Post")
        {
            
             $resObj=CommonUtility::prepareAndSaveUserMetaCollection($metaObj,"CurbsidePosts",$streamObj->UserId,$streamObj->ActionType,''); 
            
             $metaObjCSPosts= CommonUtility::getUserMetaCollectionObjByUserId($streamObj->UserId);
            
             if((count($metaObjCSPosts)>0 && $metaObjCSPosts->CurbsidePosts==1 ))
             {
               
                 CommonUtility::badgingInterceptor("CurbsidePosts",$streamObj->UserId);
             }
             
        }
        
        if($streamObj->ActionType=="Post")
        {
             if(count($streamObj->HashTags)>0)
             { 
                 $metaObjPosts= CommonUtility::getUserMetaCollectionObjByUserId($streamObj->UserId);
                 $resObjHashTags=CommonUtility::prepareAndSaveUserMetaCollection($metaObjPosts,"HashTags",$streamObj->UserId,$streamObj->ActionType,count($streamObj->HashTags)); ;
                if($metaObjPosts->HashTags==0 )
                {
                     CommonUtility::badgingInterceptor("FirstHashTag",$streamObj->UserId);
                }
                //In case of multiple hashtags case of badge just call the badging intercepter here with that context
             }
        }
       
     
       
        
        
    }
    
    public static  function prepareAndSaveUserMetaCollection($metaObj,$action,$userId,$actionType,$HashTagsCount)
    {
         //Here insert data for user following count and also followers count for other user
         
            if($metaObj!="failure" )
            {
                 
                if(count($metaObj)==0 && $actionType!="UserUnFollow" )
                {
                   
                     $prepareMetaObj=array("UserId"=>$userId,"Followers"=> 0,"UserFollowing"=>0,"Loves"=>0,"Comments"=>0,"Posts"=>0,"CurbsidePosts"=>0,"HashTags"=>0);
                     $prepareMetaObj[$action]=1;
                      if($action=="HashTags")
                       $prepareMetaObj[$action]=$HashTagsCount;   
                     $res= UserMetaCollection::model()->saveUserMetaCollection($prepareMetaObj); 
                  
                }
                else if(count($metaObj)>0 )
                {
                    
                     $prepareMetaObj=array("UserId"=>$metaObj->UserId,"Followers"=> 0,"UserFollowing"=>0,"Loves"=>0,"Comments"=>0,"Posts"=>0,"CurbsidePosts"=>0,"HashTags"=>0);
                     $prepareMetaObj[$action]="Yes";  
                      $addValue=1;
                    if($actionType=="UserUnFollow")
                    {
                      
                       if($metaObj->$action>0) 
                             $addValue=-1;
                       else
                           $addValue=0;
                    }
                  
                    if($action=="HashTags")
                        $addValue=$HashTagsCount;   
                    $res= UserMetaCollection::model()->updateUserMetaCollection($metaObj,$prepareMetaObj,$metaObj->UserId,$addValue); 
                }
            }
           // return $res;
            
           
    }
    
   
     public static function badgingInterceptor($context,$userId)
     {
       $badgeCollectionObjSave='';
         if($context=='FirstLogin')
         {
            //check ifuser logins first here
           $isFirstLogin=CommonUtility::checkUserFirstLogin($userId,'web');
         
            if($isFirstLogin)
            {
               $badgeCollectionObjSave= CommonUtility::badgesSavingInterceptor($context,$userId,'');
                 if($badgeCollectionObjSave!='error' && $badgeCollectionObjSave>0);
                  
            }
             
         }
         else if($context=='MobileFirstLogin')
         {
            
              $isFirstLogin=CommonUtility::checkUserFirstLogin($userId,'mobile');
            if($isFirstLogin)
            {
               $badgeCollectionObjSave= CommonUtility::badgesSavingInterceptor($context,$userId,'');
                 if($badgeCollectionObjSave!='error' && $badgeCollectionObjSave>0);
                  
            }
         }
         else if($context=='UserFollow')
         {
            
             CommonUtility::badgesSavingInterceptor($context, $userId,"UserFollowing");// The last parametere is the Metacollection property name of each context
         }
         else if($context=='Love')
         {
             $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"Loves");
         }
         
          else if($context=='UserFollowers')
         {
             
             $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"Followers");
         }
          else if($context=='FirstComment')
         {
             
             $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"Comments");
         }
          else if($context=='Comments')
         {
             
             $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"Comments");
         }
         else if($context=="FirstPost")
         {
              $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"Posts");
         }
         else if($context=="CurbsidePosts")
         {
              $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"CurbsidePosts");
         }
          else if($context=="FirstHashTag")
         {
              $badgeCollectionObjSave=  CommonUtility::badgesSavingInterceptor($context,$userId,"HashTags");
         }
         return $badgeCollectionObjSave;
     }
     
     public static function checkUserFirstLogin($userId,$type)
     {
         $returnValue=false;
         if($type=="web")
         {
            
            $userObj=ServiceFactory::getSkiptaUserServiceInstance()->getUserByType($userId,'UserId');  

            if( $userObj->PreviousLastLoginDate=='' ||$userObj->PreviousLastLoginDate==null)
            {
               $returnValue= true ;
            }
         }
         else
         {
            $isLogin=ServiceFactory::getSkiptaUserServiceInstance()->checkMobileLogin($userId); 
            
             if(!$isLogin)
              $returnValue= true ;
         }
         
         return $returnValue;
        
        
     }
     
     public static function getBadgeInfo($context)
     {
           $badgeInfo=  ServiceFactory::getSkiptaUserServiceInstance()->getBadgeInfoByContextAndBadgeName($context);
           return $badgeInfo;
     }
     
       public static function getBadgeLeveInfo($badgeId,$levelValue)
     {
           $badgeInfo=  ServiceFactory::getSkiptaUserServiceInstance()->getBadgeLevelInfoByBadgeId($badgeId,$levelValue);
           return $badgeInfo;
     }
    
     public static function getUserBadgeCollection($userId,$badgeId,$limit)
     {
           $userBadgeCollection=  ServiceFactory::getSkiptaUserServiceInstance()->getUserBadgeCollectionByCriteria($userId,$badgeId,$limit);
           return $userBadgeCollection;
     }
     
     public static function getBadgesNotShownToUser($userId,$limit)
     {
           $userBadgeCollection=  ServiceFactory::getSkiptaUserServiceInstance()->getBadgesNotShownToUser($userId,$limit);
           return $userBadgeCollection;
     }
    
    
    public static function badgesSavingInterceptor($context,$userId,$MetaObjproperty)
    {
         $categoryId = CommonUtility::getIndexBySystemCategoryType('Badge');
         $postType=  CommonUtility::sendPostType('Badge');
         $badgeCollectionObjSave="";
         try
         {
            $badgeInfo=  CommonUtility::getBadgeInfo($context);
         
             if($badgeInfo!="failure")
             {
              
                 //save badge info
                 $hasLevel=false;
                if($badgeInfo->has_level)
                {
                    if(CommonUtility::checkForSaveBadgeToUser($badgeInfo,$userId,$MetaObjproperty))
                            $hasLevel=true;
                }
                 
                $badgeCollectionObjSave=  CommonUtility::saveBadgeCollection($badgeInfo,$userId,$hasLevel,'');
               
                //prepare stream obj if exists
                if($badgeCollectionObjSave!="")
                {
                    //prepare stream obj and save in the userstream collection obj.
                    $result=ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($postType,$badgeCollectionObjSave, $userId, 'Follow', $categoryId);
                    if($badgeInfo->stream_effect)
                      if (!CommonUtility::prepareStreamObject($userId, "Post", $badgeCollectionObjSave, $categoryId, '', '','')) {
                       // return "failure";
                    }
                }
                
                
             }
             
         } catch (Exception $ex) {
               Yii::log("----in exception -----badgesSavingInterceptor---------------".$ex->getMessage(),'error','application');
         }
         return $badgeCollectionObjSave;
         
        
    }
    
    public static function saveBadgeCollection($badgeInfo,$userId,$hasLevel,$storeId='')
    {
        $userBadgeCollection= CommonUtility::getUserBadgeCollection($userId,$badgeInfo->id,1);
    
        $badgeCollectionObjSave="";
        if($userBadgeCollection!="failure" )
             {
                 if(count($userBadgeCollection)==0)
                 {
                   //create badge if doest not exist
                     if($badgeInfo->has_level && $hasLevel)
                     { //Save the badge only if the criteria is satisfied ($hasLevel==this property will be set to true  only if the user has acheieved the no.units required , then only badge gets saved by setting the level as 1)
                         $prepareObj=CommonUtility::prepareBadgeCollection($badgeInfo,1,$userId,$storeId);
                       $badgeCollectionObjSave=  ServiceFactory::getSkiptaUserServiceInstance()->saveUserBadgeCollection($prepareObj);
                     }
                     else if(!$badgeInfo->has_level)
                     {
                       $prepareObj=CommonUtility::prepareBadgeCollection($badgeInfo,1,$userId,$storeId);
                       $badgeCollectionObjSave=  ServiceFactory::getSkiptaUserServiceInstance()->saveUserBadgeCollection($prepareObj);  
                     }
                 }
                 else
                 {
                    if($hasLevel) //this property will be set to true  only if the user has acheieved the no.units required , then only badge gets saved by increasing the level
                    {
                         
                         $badgeCollectionObjSave=  ServiceFactory::getSkiptaUserServiceInstance()->saveUserBadgeCollection(CommonUtility::prepareBadgeCollection($badgeInfo,$userBadgeCollection->BadgeLevelValue+1,$userId));
                    }
                 }
                

             }
             return $badgeCollectionObjSave;

    }
    
    public static function prepareBadgeCollection($badgeInfo,$unitValue,$userId,$storeId='')
    { 
        $badgeCollectionObj=array("userId"=>$userId,"badgeId"=>$badgeInfo->id,"badgeLevelValue"=>$unitValue,'isBadgeShown'=>0,'Store'=>$storeId);//default value "1" for level 1 or no levels
       return $badgeCollectionObj;
        
    }
    
    public static function checkForSaveBadgeToUser($badgeInfo,$userId,$MetaObjproperty)
    {
           $userBadgeCollection= CommonUtility::getUserBadgeCollection($userId,$badgeInfo->id,1); 
       
           $metaObj= CommonUtility::getUserMetaCollectionObjByUserId($userId);
          
           if($userBadgeCollection!="failure" )
           {
               if(count($userBadgeCollection)==0 )
               {
                 $levelValue=1;  
               }
            else {
               
                $levelValue=(int)($userBadgeCollection->BadgeLevelValue)+1;
            }
           
           }
             $badgeLevelInfo=  CommonUtility::getBadgeLeveInfo($badgeInfo->id,$levelValue);
             //check if followers limit is reached or not
               //if reached return true else false
           
              if(count($badgeLevelInfo)>0 )
              {
                 if( $metaObj->$MetaObjproperty == $badgeLevelInfo[0]->unitValue)
                  return true;
              }
         
          
           return false;
    }

     //Badgin -related methods start
    
     public static function encrypt($data_input) {
        $key = "#";
    $td = mcrypt_module_open('cast-256', '', 'ecb', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $encrypted_data = mcrypt_generic($td, $data_input);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $encoded_64=base64_encode($encrypted_data);
    return $encoded_64; 
    }
    
    public static function decrypt($encoded_64) {
        
       $decoded_64=base64_decode($encoded_64);
    $key = "#";// same as you used to encrypt
    $td = mcrypt_module_open('cast-256', '', 'ecb', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $decrypted_data = mdecrypt_generic($td, $decoded_64);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    return $decrypted_data; 
    }
    
    public static function prepareFeaturedItemsForMobile($providerData){
        $featuredItems = array();
        if (sizeof($providerData) != 0) {
            foreach ($providerData as $data) {
                $featuredDisplayBean = new StreamPostDisplayBean();
                $featuredDisplayBean->_id = (string)$data->_id;
                $featuredDisplayBean->PostId = (string)$data->PostId;
                $appendData = '<span data-posttype="'+$data->Type+'" data-categorytype="'+$data->CategoryType+'" data-postid="'+$data->PostId+'" data-id="'+$data->PostId+'" data-original-title="See More" data-placement="bottom" class="postdetail tooltiplink"> <i class="fa fa-ellipsis-h moreicon moreiconcolor"></i></span>';
                $featuredDisplayBean->PostText = CommonUtility::truncateHtml($data->Description, 240, '...', true, true, $appendData);
                $featuredDisplayBean->PostType = $data->Type;
                $featuredDisplayBean->CategoryType = $data->CategoryType;
                $featuredDisplayBean->IsMultipleArtifact=$data->IsMultipleArtifact;
                if ($data->Resource != '' || !empty($data->Resource)) {
                    if ($data->CategoryType == 9) {
                        $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $data->Resource;
                    } else if (isset($data->Resource["Extension"])) {
                        $filetype = strtolower($data->Resource["Extension"]);
                        if ($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif' || $filetype == 'tiff' || $filetype == 'png') {
                            $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $data->Resource["Uri"];
                        } else if ($filetype == 'mp4' || $filetype == 'mov' || $filetype == 'flv') {
                            $filename = "/images/system/video_img.png";
                            if (file_exists($data->Resource["ThumbNailImage"])) {
                                $filename = $data->Resource["ThumbNailImage"];
                            }
                            $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $filename;
                        } else if ($filetype == 'mp3') {
                            $filename = "/images/system/audio_img.png";
                            if (file_exists($data->Resource["ThumbNailImage"])) {
                                $filename = $data->Resource["ThumbNailImage"];
                            }
                            $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $filename;
                        } else {
                            $tinyUserObj = UserCollection::model()->getTinyUserCollection($data->UserId);
                            $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $tinyUserObj['ProfilePicture'];
                        }
                    }
                } else if ($data->HtmlFragment != '' || !empty($data->HtmlFragment)) {
                    $html = $data->HtmlFragment;
                    $present = stristr($html, 'img');
                    if ($present != '') {
                        $doc = new DOMDocument();
                        $doc->loadHTML($html);
                        $xpath = new DOMXPath($doc);
                        $src = $xpath->evaluate("string(//img/@src)");
                        $featuredDisplayBean->ArtifactIcon = $src;
                    } else {
                        $tinyUserObj = UserCollection::model()->getTinyUserCollection($data->UserId);
                        $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $tinyUserObj['ProfilePicture'];
                    }
                } else {
                    $tinyUserObj = UserCollection::model()->getTinyUserCollection($data->UserId);
                    if ($data['Type'] == 4) {
                        $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . "/upload/profile/user_noimage.png";
                    } else {
                        $featuredDisplayBean->ArtifactIcon = Yii::app()->params['ServerURL'] . $tinyUserObj['ProfilePicture'];
                    }
                }
                array_push($featuredItems, $featuredDisplayBean);
            }
            $returnValue = $featuredItems;
        }
        return $returnValue;
    }
    
    public static function getImageFromURL($imgpath, $todest) {
         
        try {
            $content = file_get_contents($imgpath);
            $retrunvalue=file_put_contents($todest, $content);
            print_r($retrunvalue);
            
        } catch (Exception $e) {
            error_log("**************************Exception risied at  image download" . $e->getMessage());
        }
    }
    public static function remove_unicode($string){
        return  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
    }

    
    public static function prepareSurveyDashboradData($UserId, $surveyObject) {
        try {

            $totalBeansArray = array();
            $i = 0;
            foreach ($surveyObject as $data) {
                $extendedBean = new ScheduleSurveyBean();
                $extendedBean->_id = $data->_id;
                if (strlen($data->SurveyTitle) > 240) {
                    $description = CommonUtility::truncateHtml($data->SurveyTitle, 240);
                    $extendedBean->SurveyTitle = $description . "  ...";
                } else {
                    $extendedBean->SurveyTitle = $data->SurveyTitle;
                }
                if (strlen($data->SurveyDescription) > 240) {
                    $description = CommonUtility::truncateHtml($data->SurveyDescription, 240);
                    $extendedBean->SurveyDescription = $description . "  ...";
                } else {
                    $extendedBean->SurveyDescription = $data->SurveyDescription;
                }

                $extendedBean->QuestionsCount = $data->QuestionsCount;
                $extendedBean->SurveyLogo = $data->SurveyLogo;
                $extendedBean->SurveyRelatedGroupName = $data->SurveyRelatedGroupName;
//                $extendedBean->SurveyTakenCount = $data->SurveyTakenCount;
                $extendedBean->UserId = $data->UserId;
                $extendedBean->Status = $data->Status;
                $extendedBean->IsDeleted = $data->IsDeleted;
                $extendedBean->IsCurrentSchedule = $data->IsCurrentSchedule;
                $extendedBean->CurrentScheduleId = $data->CurrentScheduleId;
                $surveySchedules = ScheduleSurveyCollection::model()->getSchedulesForSurvey($data->_id);
                if (!is_string($surveySchedules)) {                    

                    $extendedBean->SchedulesArray = $surveySchedules;
                } else {
                    $extendedBean->SchedulesArray = 'noschedules';
                }
                $extendedBean->NetworkId = $data->NetworkId;
                array_push($totalBeansArray, $extendedBean);
            }
            return $totalBeansArray;
        } catch (Exception $ex) {
            error_log("#########Exception occurred while preparing the survey dashboard#########" . $ex->getMessage());
        }
    }

    public static function prepateSurveyAnalyticsData($userId, $scheduleId, $groupName = NULL) {
        try {
            $questionType1 = array();
            $questionType2 = array();
            $questionType3 = array();
            $questionType4 = array();
            $questionType5 = array();
            $questionType6 = array();
            $questionType7 = array();


            error_log("prepateSurveyAnalyticsData----" . $userId . "---" . $scheduleId);
            $scheduleObject = ScheduleSurveyCollection::model()->getScheduleSurveyDetailsObject("Id", $scheduleId);
            $userAnswers = $scheduleObject->UserAnswers;
            $surveyObject = ExtendedSurveyCollection::model()->getSurveyDetailsObject("Id", $scheduleObject->SurveyId);


            foreach ($userAnswers as $userAnswer) {
//                error_log("question tupe----" . $userAnswer['QuestionType']);
                if ($userAnswer['QuestionType'] == 1) {
                    array_push($questionType1, $userAnswer);
                } else if ($userAnswer['QuestionType'] == 2) {
                    array_push($questionType2, $userAnswer);
                } else if ($userAnswer['QuestionType'] == 3) {
                    array_push($questionType3, $userAnswer);
                } else if ($userAnswer['QuestionType'] == 4) {
                    array_push($questionType4, $userAnswer);
                } else if ($userAnswer['QuestionType'] == 5) {
                    array_push($questionType5, $userAnswer);
                } else if ($userAnswer['QuestionType'] == 6) {
                    array_push($questionType6, $userAnswer);
                } else if ($userAnswer['QuestionType'] == 7) {
                    array_push($questionType7, $userAnswer);
                }
            }

            $questions = $surveyObject->Questions;
            $newQuestionsArray = array();
            foreach ($questions as $question) {

                if ($question['QuestionType'] == 1 || $question['QuestionType'] == 2) {

                    $optionsArray = $question['Options'];
                    $optionsNewArray = array();
                    foreach ($optionsArray as $option) {
                        $optionsNewArray[$option] = 0;
                    }
                    if ($question['Other'] == 1) {
                        $optionsNewArray[$question['OtherValue']] = 0;
                    }
                    if ($question['QuestionType'] == 1) {
                        $answersArray = $questionType1;
                    } else if ($question['QuestionType'] == 2) {
                        $answersArray = $questionType2;
                    }
                    $totalCount = 0;
                    $userAnnotationArray = array();
                    foreach ($answersArray as $value) {
                        //error_log($question['QuestionId'] . "**------------" . $value["QuestionId"]);
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            // error_log("iffffffffffffffffffffffff");

                            if ($value['Other'] == 1) {
                                $totalCount++;
                                $optionsNewArray[$question['OtherValue']] = $optionsNewArray[$question['OtherValue']] + 1;
                            } else {
                                $selectedOptionArray = $value['SelectedOption'];
                                foreach ($selectedOptionArray as $sop) {
                                    error_log("sop----------------" . $sop);
                                    $sop = $sop - 1;
                                     error_log("sop----------------" . $sop);
                                    if ($userId == $value["UserId"]) {
                                        array_push($userAnnotationArray, $optionsArray[$sop]);
                                    }

                                    if (isset($optionsNewArray[$optionsArray[$sop]])) {
                                        $totalCount++;
                                        //  error_log("iffffffffff-----------" . $optionsArray[$sop]);
                                        $optionsNewArray[$optionsArray[$sop]] = $optionsNewArray[$optionsArray[$sop]] + 1;
                                    } else {
                                        // error_log("else----------------" . $optionsArray[$sop]);
                                        $optionsNewArray[$optionsArray[$sop]] = 1;
                                    }
                                }
                            }
                            // error_log("total count-------------" . $totalCount);
                            $optionsPercentageArray = array();
                            foreach ($optionsNewArray as $key => $value) {
                                $percentTageValue = round(($value * 100) / $totalCount,2);
                                // error_log($value . "-----pecent-------" . $percentTageValue);
                                $optionsPercentageArray[$key] = $percentTageValue;
                            }
                        }
                    }
                    // error_log("options new array---" . print_r($optionsNewArray, true));
                    $question['OptionsNewArray'] = $optionsNewArray;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    $question['UserAnnotationArray'] = $userAnnotationArray;
                    array_push($newQuestionsArray, $question);
                    //  error_log("###--".print_r($question['optionsNewArray'],true));
                }
                if ($question['QuestionType'] == 3 || $question['QuestionType'] == 4) {
                    //$totalCount=0;
                    //error_log("questinj tupe-----333333333333333");
                    $optionsArray = $question['OptionName'];
                    $labelNameArray = $question['LabelName'];
                    if ($question['Other'] == 1) {

                        array_push($labelNameArray, "N/A");
                    }
                    $question['LabelName'] = $labelNameArray;
                    $optionsNewArray = array();
                    foreach ($optionsArray as $option) {
                        $emptyArray = array();
                        for ($i = 0; $i < sizeof($labelNameArray); $i++) {
                            array_push($emptyArray, 0);
                        }

                        $optionsNewArray[$option] = $emptyArray;
                    }

                    //error_log("****--".print_r($optionsNewArray,true));
//                if ($question['Other'] == 1) {
//                    $optionsNewArray[$question['OtherValue']] = [0,0,0];;
//                }

                    if ($question['QuestionType'] == 3) {
                        $answersArray = $questionType3;
                    } else if ($question['QuestionType'] == 4) {
                        $answersArray = $questionType4;
                    }
                    $userSelectedOptionsArray = array();
                    foreach ($answersArray as $value) {
                        //error_log("foreach%%%%%%%%%%%%%%%%%%%%%%");
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            $selectedOptionArray = $value['Options'];
                            $userSelectedOptionsArray[$value['UserId']] = $value['Options'];
                            foreach ($selectedOptionArray as $key => $sop) {
                                //$totalCount++;
                                //  error_log("key----------------" . $key."---sop--".$sop);
                                if (isset($optionsNewArray[$optionsArray[$key]])) {

                                    //  error_log("iffffffffff-----------" . $optionsArray[$key]);
                                    //if($sop == 1){
                                    $val = $optionsNewArray[$optionsArray[$key]][$sop - 1];
                                    $optionsNewArray[$optionsArray[$key]][$sop - 1] = $val + 1;
                                   } else {
                                }
                            }
                            $question['OptionsNewArray'] = $optionsNewArray;
//                            error_log("opions new array---" . print_r($optionsNewArray, true));
                            $optionsPercentageArray = array();
                            foreach ($optionsNewArray as $key => $value) {
//                                error_log("name---" . $key . "---sum---1---" . array_sum($value));
                                $totalValue = array_sum($value);
                                foreach ($value as $k => $v) {
                                    //  error_log("@@@--".$k."----".$v);
                                    // error_log(($v * 100)."-########---".$totalValue);
                                    $percent = round(($v * 100) / $totalValue,2);
                                    // error_log("name---".$k."---percent---".$percent) ;
                                    $value[$k] = $percent;
                                }

                                $optionsPercentageArray[$key] = $value;
                            }
                        }
                    }
                    
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    error_log("==in cypher=userId====$userId");
                    if(!empty($userId))
                        $question['userSelectedOptionsArray'] = $userSelectedOptionsArray[$userId];
                    else
                        $question['userSelectedOptionsArray'] = array();
                    array_push($newQuestionsArray, $question);
                }



                if ($question['QuestionType'] == 5) {

                    $userAnnotationArray = array();
                    $optionsArray = $question['OptionName'];
                    $optionsNewArray = array();
                    foreach ($optionsArray as $option) {
                        $optionsNewArray[$option] = 0;
                    }
                    //error_log("option new array-before----".print_r($optionsNewArray,true));
                    $answersArray = $questionType5;

                    foreach ($answersArray as $value) {
                        //error_log($question['QuestionId'] . "**------------" . $value["QuestionId"]);
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            
                            $selectedOptionArray = $value['DistributionValues'];
                            foreach ($selectedOptionArray as $key => $sop) {
                                if ($userId == $value["UserId"]) {
                                    array_push($userAnnotationArray, $optionsArray[$key]);
                                }
                                if (isset($optionsNewArray[$optionsArray[$key]])) {
                                    $val = $optionsNewArray[$optionsArray[$key]];
                                    $optionsNewArray[$optionsArray[$key]] = $val + $sop;
                                }
                            }

                            //  return;
                        }
                    }
                    // error_log("option new array---after--".print_r($optionsNewArray,true));
                    $optionsPercentageArray = array();
                    $totalValue = array_sum($optionsNewArray);
//                    error_log("total value-----------" . $totalValue);
                    foreach ($optionsNewArray as $key => $value) {
                        $percentTageValue = round(($value * 100) / $totalValue,2);
                        $optionsPercentageArray[$key] = $percentTageValue;
                    }
//                    error_log("options percentage array---" . print_r($optionsPercentageArray, true));
                    $question['OptionsNewArray'] = $optionsNewArray;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    $question['UserAnnotationArray'] = $userAnnotationArray;
                    array_push($newQuestionsArray, $question);
                }


                if ($question['QuestionType'] == 6) {

                    $answersArray = $questionType6;
                    $userAnswersTotalText = "";
                    foreach ($answersArray as $value) {
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            $userAnswer = $value['UserAnswer'];
                            $userAnswersTotalText = $userAnswersTotalText . " " . $userAnswer;
                        }
                    }
                    $words = array_count_values(str_word_count($userAnswersTotalText, 1));
                    arsort($words);
//                    error_log("words before-------" . print_r($words, true));
//                    error_log("total before-----------" . array_sum($words));
                    $words1 = array();
                    $optionsPercentageArray = array();
                    if (sizeof($words) > 5) {
                        $words1 = CommonUtility::filterArrayWithStringLength($words, 6, 5);
                        
                        $totalValue = array_sum($words1);
                        $otherValue = array_sum($words) - array_sum($words1);
                        $question['OptionsNewArray'] = $words1;
                        foreach($words1 as $k=>$v){
                            $percentTageValue = round(($v * 100) / sizeof($words1),2);
                            $optionsPercentageArray[$k] = $percentTageValue;
                            
                        }
                    } else {
                        $otherValue = 0;
                        $question['OptionsNewArray'] = $words;
                        
                        foreach($words as $k=>$v){
                            $percentTageValue = round(($v * 100) / sizeof($words),2);
                            $optionsPercentageArray[$k] = $percentTageValue;
                            
                        }
                    }
                
                    
                    
                    $words1["Other"] = $otherValue;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    array_push($newQuestionsArray, $question);
                }

                if ($question['QuestionType'] == 7) {
                    // error_log("Question tlype777777777777777777777777777");
                    $answersArray = $questionType7;
                    $userAnswersTotalArray = array();
                    foreach ($answersArray as $value) {
//                        error_log("ifffffffffff");
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            $userAnswer = $value['UsergeneratedRankingOptions'];
                            foreach ($userAnswer as $v) {

                                array_push($userAnswersTotalArray, $v);
                            }
                        }
                    }
                    $userAnswersTotalArray = array_map('strtolower', $userAnswersTotalArray);
                    $userAnswersTotalArray = array_map('trim', $userAnswersTotalArray);
                    //error_log("useranaser total array-----".  print_r($userAnswersTotalArray,true));
                    $words = array_count_values($userAnswersTotalArray);
                    //  error_log("count-----".print_r($words,true));


                    arsort($words);
                    //   error_log("words before-------".print_r($words,true));
                    $words = array_slice($words, 0, 5, true);
                    $words1 = array_slice($words, 4);
                    //  error_log("words afer-------".print_r($words,true));
                    //  error_log("words afer-------".print_r($words1,true));
                    $optionsPercentageArray = array();
                    foreach($words as $k=>$v){
                            $percentTageValue = ($v * 100) / sizeof($words);
                            $optionsPercentageArray[$k] = $percentTageValue;
                            
                        }
                    $otherValue = array_sum($words1);
                    //  error_log("other vluae-------".$otherValue);


                    $words["Other"] = $otherValue;
                    $question['OptionsNewArray'] = $words;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    array_push($newQuestionsArray, $question);
                }
            }


            $surveyObject->Questions = $newQuestionsArray;
        } catch (Exception $ex) {
            error_log("exceptino------------" . $ex->getMessage());
        }
        return $surveyObject;
    }

    public static function filterArrayWithStringLength($words, $strLength, $max, $array = []) {
        $return = false;
        foreach ($words as $key => $value) {
            if (strlen($key) >= $strLength) {
                $array[$key] = $value;
                if (sizeof($array) == $max) {

                    $return = true;
                    break;
                }
            }
        }
        if ($return == true) {
            return $array;
        } else {
            if ($max == sizeof($array)) {
                return $array;
            } else {
                $strLength = $strLength - 1;
                if ($strLength > 0) {
                    return CommonUtility::filterArrayWithStringLength($words, $strLength, $max, $array);
                }
            }
        }
    }

    public static function prepateSurveyAnalyticsDataByGroup($userId, $groupName,$surveyId,$timezone) {
        try {
            $questionType1 = array();
            $questionType2 = array();
            $questionType3 = array();
            $questionType4 = array();
            $questionType5 = array();
            $questionType6 = array();
            $questionType7 = array();
            $totalArray = array();            
            $scheduleObjs = ScheduleSurveyCollection::model()->getScheduleSurveyDetailsObjectByGroupName($groupName,$surveyId);            
            $dateTotalArray = array();
            foreach ($scheduleObjs as $obj) {
                $scheduleId = $obj->_id;
                error_log("prepateSurveyAnalyticsData----" . $userId . "---" . $scheduleId);
                $scheduleObject = ScheduleSurveyCollection::model()->getScheduleSurveyDetailsObject("Id", $scheduleId);
                $userAnswers = $scheduleObject->UserAnswers;
                $dateFormat = CommonUtility::getDateFormat();
                $surveyObject = ExtendedSurveyCollection::model()->getSurveyDetailsObject("Id", $scheduleObject->SurveyId);
                $startDate = date($dateFormat,CommonUtility::convert_date_zone($scheduleObject['StartDate']->sec,$timezone,  date_default_timezone_get())) ;
                $endDate = date($dateFormat,CommonUtility::convert_date_zone($scheduleObject['EndDate']->sec,$timezone,  date_default_timezone_get())) ;  
                
                array_push($dateTotalArray,$startDate." to ".$endDate);
                if(sizeof($userAnswers) > 0){
                    
                }
                foreach ($userAnswers as $userAnswer) {
                    error_log("question tupe----" . $userAnswer['QuestionType']);
                    if ($userAnswer['QuestionType'] == 1) {
                        array_push($questionType1, $userAnswer);
                    } else if ($userAnswer['QuestionType'] == 2) {
                        array_push($questionType2, $userAnswer);
                    } else if ($userAnswer['QuestionType'] == 3) {
                        array_push($questionType3, $userAnswer);
                    } else if ($userAnswer['QuestionType'] == 4) {
                        array_push($questionType4, $userAnswer);
                    } else if ($userAnswer['QuestionType'] == 5) {
                        array_push($questionType5, $userAnswer);
                    } else if ($userAnswer['QuestionType'] == 6) {
                        array_push($questionType6, $userAnswer);
                    } else if ($userAnswer['QuestionType'] == 7) {
                        array_push($questionType7, $userAnswer);
                    }
                }

                error_log("question1---" . count($questionType1));
                error_log("question2---" . count($questionType2));
                error_log("question3---" . count($questionType3));
                error_log("question4---" . count($questionType4));
                error_log("question5---" . count($questionType5));
                error_log("question6---" . count($questionType6));
                error_log("question7---" . count($questionType7));

                $questions = $surveyObject->Questions;
                $newQuestionsArray = array();
                foreach ($questions as $question) {
                //  error_log("11111111111111111111111111111111");

                if ($question['QuestionType'] == 1 || $question['QuestionType'] == 2) {

                    $optionsArray = $question['Options'];
                    $optionsNewArray = array();
                    foreach ($optionsArray as $option) {
                        $optionsNewArray[$option] = 0;
                    }
                    if ($question['Other'] == 1) {
                        $optionsNewArray[$question['OtherValue']] = 0;
                    }



                    if ($question['QuestionType'] == 1) {
                        $answersArray = $questionType1;
                    } else if ($question['QuestionType'] == 2) {
                        $answersArray = $questionType2;
                    }
                    $totalCount = 0;
                    $userAnnotationArray = array();
                    foreach ($answersArray as $value) {
                        //error_log($question['QuestionId'] . "**------------" . $value["QuestionId"]);
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            // error_log("iffffffffffffffffffffffff");

                            if ($value['Other'] == 1) {
                                $totalCount++;
                                $optionsNewArray[$question['OtherValue']] = $optionsNewArray[$question['OtherValue']] + 1;
                            } else {
                                $selectedOptionArray = $value['SelectedOption'];
                                foreach ($selectedOptionArray as $sop) {
                                    $sop = $sop - 1;
                                    // error_log("sop----------------" . $sop);
                                    if ($userId == $value["UserId"]) {
                                        array_push($userAnnotationArray, $optionsArray[$sop]);
                                    }

                                    if (isset($optionsNewArray[$optionsArray[$sop]])) {
                                        $totalCount++;
                                        $optionsNewArray[$optionsArray[$sop]] = $optionsNewArray[$optionsArray[$sop]] + 1;
                                    } else {
                                        $optionsNewArray[$optionsArray[$sop]] = 1;
                                    }
                                }
                            }
                            $optionsPercentageArray = array();
                            foreach ($optionsNewArray as $key => $value) {
                                $percentTageValue = round(($value * 100) / $totalCount,2);
                                $optionsPercentageArray[$key] = $percentTageValue;
                            }
                        }
                    }
                  
                    $question['OptionsNewArray'] = $optionsNewArray;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    $question['UserAnnotationArray'] = $userAnnotationArray;
                    array_push($newQuestionsArray, $question);
                }
                if ($question['QuestionType'] == 3 || $question['QuestionType'] == 4) {
                    $optionsArray = $question['OptionName'];
                    $labelNameArray = $question['LabelName'];
                    if ($question['Other'] == 1) {

                        array_push($labelNameArray, "N/A");
                    }
                    $question['LabelName'] = $labelNameArray;
                    $optionsNewArray = array();
                    foreach ($optionsArray as $option) {
                        $emptyArray = array();
                        for ($i = 0; $i < sizeof($labelNameArray); $i++) {
                            array_push($emptyArray, 0);
                        }

                        $optionsNewArray[$option] = $emptyArray;
                    }
                    if ($question['QuestionType'] == 3) {
                        $answersArray = $questionType3;
                    } else if ($question['QuestionType'] == 4) {
                        $answersArray = $questionType4;
                    }
                    $userSelectedOptionsArray = array();
                    foreach ($answersArray as $value) {
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            $selectedOptionArray = $value['Options'];
                            $userSelectedOptionsArray[$value['UserId']] = $value['Options'];
                            foreach ($selectedOptionArray as $key => $sop) {
                                   if (isset($optionsNewArray[$optionsArray[$key]])) {
                                      $val = $optionsNewArray[$optionsArray[$key]][$sop - 1];
                                    $optionsNewArray[$optionsArray[$key]][$sop - 1] = $val + 1;
                                         } else {
                                    
                                }
                            }
                            $question['OptionsNewArray'] = $optionsNewArray;
//                            error_log("opions new array---" . print_r($optionsNewArray, true));
                            $optionsPercentageArray = array();
                            foreach ($optionsNewArray as $key => $value) {
//                                error_log("name---" . $key . "---sum---1---" . array_sum($value));
                                $totalValue = array_sum($value);
                                foreach ($value as $k => $v) {
                                    //  error_log("@@@--".$k."----".$v);
                                    // error_log(($v * 100)."-########---".$totalValue);
                                    $percent = round(($v * 100) / $totalValue,2);
                                    // error_log("name---".$k."---percent---".$percent) ;
                                    $value[$k] = $percent;
                                }

                                $optionsPercentageArray[$key] = $value;
                            }
                        }
                    }

                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    if(!empty($userId))
                        $question['userSelectedOptionsArray'] = $userSelectedOptionsArray[$userId];
                    else
                        $question['userSelectedOptionsArray'] = array();
                    array_push($newQuestionsArray, $question);
                }



                if ($question['QuestionType'] == 5) {

                    $userAnnotationArray = array();
                    $optionsArray = $question['OptionName'];
                    $optionsNewArray = array();
                    foreach ($optionsArray as $option) {
                        $optionsNewArray[$option] = 0;
                    }
                    $answersArray = $questionType5;

                    foreach ($answersArray as $value) {
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            
                            $selectedOptionArray = $value['DistributionValues'];
                            foreach ($selectedOptionArray as $key => $sop) {
                                if ($userId == $value["UserId"]) {
                                    array_push($userAnnotationArray, $optionsArray[$key]);
                                }
                                if (isset($optionsNewArray[$optionsArray[$key]])) {
                                    $val = $optionsNewArray[$optionsArray[$key]];
                                    $optionsNewArray[$optionsArray[$key]] = $val + $sop;
                                }
                            }

                            //  return;
                        }
                    }
                    // error_log("option new array---after--".print_r($optionsNewArray,true));
                    $optionsPercentageArray = array();
                    $totalValue = array_sum($optionsNewArray);
//                    error_log("total value-----------" . $totalValue);
                    foreach ($optionsNewArray as $key => $value) {
                        $percentTageValue = round(($value * 100) / $totalValue,2);
                        $optionsPercentageArray[$key] = $percentTageValue;
                    }
//                    error_log("options percentage array---" . print_r($optionsPercentageArray, true));
                    $question['OptionsNewArray'] = $optionsNewArray;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    $question['UserAnnotationArray'] = $userAnnotationArray;
                    array_push($newQuestionsArray, $question);
                }


                if ($question['QuestionType'] == 6) {

                    $answersArray = $questionType6;
                    $userAnswersTotalText = "";
                    foreach ($answersArray as $value) {
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            $userAnswer = $value['UserAnswer'];
                            $userAnswersTotalText = $userAnswersTotalText . " " . $userAnswer;
                        }
                    }
                    $words = array_count_values(str_word_count($userAnswersTotalText, 1));
                    arsort($words);
                    $words1 = array();
                    $optionsPercentageArray = array();
                    if (sizeof($words) > 5) {
                        $words1 = CommonUtility::filterArrayWithStringLength($words, 6, 5);
                        
                        $totalValue = array_sum($words1);
                        $otherValue = array_sum($words) - array_sum($words1);
                        $question['OptionsNewArray'] = $words1;
                        foreach($words1 as $k=>$v){
                            $percentTageValue = round(($v * 100) / sizeof($words1),2);
                            $optionsPercentageArray[$k] = $percentTageValue;
                            
                        }
                    } else {
                        $otherValue = 0;
                        $question['OptionsNewArray'] = $words;
                        
                        foreach($words as $k=>$v){
                            $percentTageValue = round(($v * 100) / sizeof($words),2);
                            $optionsPercentageArray[$k] = $percentTageValue;
                            
                        }
                    }
                
                    
                    
                    $words1["Other"] = $otherValue;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    array_push($newQuestionsArray, $question);
                }

                if ($question['QuestionType'] == 7) {
                    $answersArray = $questionType7;
                    $userAnswersTotalArray = array();
                    foreach ($answersArray as $value) {
//                        error_log("ifffffffffff");
                        if ($question['QuestionId'] == $value["QuestionId"]) {
                            $userAnswer = $value['UsergeneratedRankingOptions'];
                            foreach ($userAnswer as $v) {

                                array_push($userAnswersTotalArray, $v);
                            }
                        }
                    }
                    $userAnswersTotalArray = array_map('strtolower', $userAnswersTotalArray);
                    $userAnswersTotalArray = array_map('trim', $userAnswersTotalArray);
                    //error_log("useranaser total array-----".  print_r($userAnswersTotalArray,true));
                    $words = array_count_values($userAnswersTotalArray);
                    //  error_log("count-----".print_r($words,true));


                    arsort($words);
                    //   error_log("words before-------".print_r($words,true));
                    $words = array_slice($words, 0, 5, true);
                    $words1 = array_slice($words, 4);
                    //  error_log("words afer-------".print_r($words,true));
                    //  error_log("words afer-------".print_r($words1,true));
                    $optionsPercentageArray = array();
                    foreach($words as $k=>$v){
                            $percentTageValue = ($v * 100) / sizeof($words);
                            $optionsPercentageArray[$k] = $percentTageValue;
                            
                        }
                    $otherValue = array_sum($words1);
                    //  error_log("other vluae-------".$otherValue);


                    $words["Other"] = $otherValue;
                    $question['OptionsNewArray'] = $words;
                    $question['OptionsPercentageArray'] = $optionsPercentageArray;
                    array_push($newQuestionsArray, $question);
                }
            }
            }


            $surveyObject->Questions = $newQuestionsArray;
        } catch (Exception $ex) {
            error_log("exceptino------------" . $ex->getMessage());
        }
        $totalArray[0] = $surveyObject;
        $totalArray[1] = $dateTotalArray;
        return $totalArray;
    }    
    
    public static function resizeImage($filepath,$resizeType,$resizeValue){
        try{
            $img = Yii::app()->simpleImage->load($filepath);
            list($width, $height) = getimagesize($filepath);
            if($resizeType == "both"){
                if ($width > $resizeValue) {
                    $img->resizeToWidth($resizeValue);
                }
                if ( $heigh > $resizeValue) {
                    $img->resizeToHeight($resizeValue);
                }
            } else if($resizeType == "width"){
                if ( $width > $resizeValue) {
                    $img->resizeToWidth($resizeValue);
                }
            } else if($resizeType == "height"){
                if ($heigh > $resizeValue) {
                    $img->resizeToHeight($resizeValue);
                }
            }
           
            $img->save($filepath); 
        } catch (Exception $ex) {

        }
    }
    /*
     * MOin Hussain
     * Sending Push notification for IOS and Droid
     */
     public static function initiatePushNotification($obj,$main) {
        try {
            //error_log("@@@@@ initiatePushNotification @@@@@@@@@@@---".$obj->ActionType."--userId---".$obj->UserId."---orginaluserId----".$obj->OriginalUserId);
           if (isset($obj->ActionType) && $obj->ActionType == 'Comment') {
             if ($obj->IsBlockedWordExist != 1) {
                if ($obj->OriginalUserId != $obj->UserId) {
                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($obj->OriginalUserId);
                    if ($userSettings != "failure") {
                        if ($userSettings->Commented == 1) {
                         
                                error_log("postid--------".$obj->PostId);
                                $notificationObj = Notifications::model()->getNotificationForPostByActionType($obj->PostId,"comment");
                                if($notificationObj!=""){
                                $commentCount = sizeof($notificationObj->CommentUserId);
                                $readStatus = $notificationObj->isRead;
                                error_log("comment count----**--".$commentCount."---commentREadStatus------".$readStatus);
                                if($commentCount == 4){
                                    
                                    if($readStatus == 0){
                                         //send push 
                                        $usercount =  sizeof(array_unique($notificationObj->CommentUserId));
                                        
                                         CommonUtility::sendPushNotification($obj,$usercount);
                                    }else{
                                         error_log("*******comment skipped notification*********** ");
                                    }
                                }else{
                                    $commentCount = $commentCount + 1;
                                    $frequency = CommonUtility::pushNotificationConfigurationByActionType($obj->ActionType);
                                    if($commentCount%$frequency == 0){
                                        if($readStatus == 0){
                                              //send push
                                          $usercount =  sizeof(array_unique($notificationObj->CommentUserId));

                                           CommonUtility::sendPushNotification($obj,$usercount);
                                        }
                                    }else{
                                         error_log("*******comment skipped notification*********** ");
                                    }
                                }
                            }else{
                                         //send push
                                         error_log("sending comment push notification ist");
                                         CommonUtility::sendPushNotification($obj,1);
                            }
                                
                           
                        }
                    }
                }
           }
           
            }
            else if (isset($obj->ActionType) && $obj->ActionType == 'Love') {
                if ($obj->OriginalUserId != $obj->LoveUserId) {
                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($obj->OriginalUserId);
                    if ($userSettings != "failure") {
                        if ($userSettings->Loved == 1) {
                          
                                error_log("postid--------".$obj->PostId);
                                $notificationObj = Notifications::model()->getNotificationForPostByActionType($obj->PostId,"love");
                                if($notificationObj!=""){
                                $loveCount = sizeof($notificationObj->Love);
                                $loveReadStatus = $notificationObj->isRead;
                                error_log("love count----**--".$loveCount."---loveREadStatus------".$loveReadStatus);
                                if($loveCount == 4){
                                    
                                    if($loveReadStatus == 0){
                                         //send push 
                                         $usercount =  sizeof(array_unique($notificationObj->Love));
                                         error_log("usercont--------".$usercount);
                                         CommonUtility::sendPushNotification($obj,$usercount);
                                    }else{
                                         error_log("*******love skipped notification*********** ");
                                    }
                                }else{
                                    $loveCount = $loveCount + 1;
                                    $frequency = CommonUtility::pushNotificationConfigurationByActionType($obj->ActionType);
                                    if($loveCount%$frequency == 0){
                                        if($loveReadStatus == 0){
                                              //send push
                                             $usercount =  sizeof(array_unique($notificationObj->Love));

                                           CommonUtility::sendPushNotification($obj,$usercount);
                                        }
                                    }else{
                                         error_log("*******love skipped notification*********** ");
                                    }
                                }
                            }
                                
                           
                        }
                    }
                }
            }
             else if (isset($obj->ActionType) && $obj->ActionType == 'Follow') {
                if ($obj->OriginalUserId != $obj->UserId) {
                    $userSettings = UserNotificationSettingsCollection::model()->getUserSettings($obj->OriginalUserId);
                    if ($userSettings != "failure") {
                        if ($userSettings->ActivityFollowed == 1) {
                          
                                error_log("postid--------".$obj->PostId);
                                $notificationObj = Notifications::model()->getNotificationForPostByActionType($obj->PostId,"follow");
                                if($notificationObj!=""){
                                $followersCount = sizeof($notificationObj->PostFollowers);
                                $readStatus = $notificationObj->isRead;
                                error_log("followers count----**--".$followersCount."---loveREadStatus------".$readStatus);
                                if($followersCount == 4){
                                    
                                    if($readStatus == 0){
                                         //send push 
                                         $usercount =  sizeof(array_unique($notificationObj->PostFollowers));

                                         CommonUtility::sendPushNotification($obj,$usercount);
                                    }else{
                                         error_log("*******follow skipped notification*********** ");
                                    }
                                }else{
                                    $followersCount = $followersCount + 1;
                                    $frequency = CommonUtility::pushNotificationConfigurationByActionType($obj->ActionType);
                                    if($followersCount%$frequency == 0){
                                        if($readStatus == 0){
                                              //send push
                                          $usercount =  sizeof(array_unique($notificationObj->PostFollowers));
                                           CommonUtility::sendPushNotification($obj,$usercount);
                                        }
                                    }else{
                                         error_log("*******follow skipped notification*********** ");
                                    }
                                }
                            }
                                
                           
                        }
                    }
                }
            }
             else if (isset($obj->ActionType) && $obj->ActionType == 'Chat') {
                   CommonUtility::sendPushNotification($obj,0);
              }
            if($main == false){
               if (isset($obj->ActionType) && $obj->ActionType == 'Mention') {
                   CommonUtility::sendPushNotification($obj,0);
            }
              else  if (isset($obj->ActionType) && $obj->ActionType == 'Invite') {
                    CommonUtility::sendPushNotification($obj,0);
            }  
            }
             
           
        } catch (Exception $exc) {
                       error_log("sendPushNotification-----------".$ex->getMessage());

        }
    }
    public static function pushNotificationConfigurationByActionType($actionType) {
        $frequency = 10;
         if($actionType == "comment"){
              $frequency = 10;
        }
        else if($actionType == "Love"){
              $frequency = 10;
        }
        else if($actionType == "Follow"){
              $frequency = 10;
        }
        return $frequency;
    }
    static function sendPushNotification($obj,$count){
        try{
            error_log("sendPushNotification---------".$obj->OriginalUserId."-----".$obj->UserId);
            $device_tokens = MobileSessions::model()->getDeviceTokensForUser($obj->OriginalUserId);
            $push = 0;
             if($count>1){
                     $count--;
                     if($count == 1){
                         $string = " and ".$count. " other";
                     }else{
                          $string = " and ".$count. " others";
                     }
                     
                 }else{
                   $string = "";
   
                 }
            if($obj->ActionType == "Comment"){
                 $userObj = UserCollection::model()->getTinyUserCollection($obj->UserId);
                
                  $message = $userObj->DisplayName.$string." commented on your post"; 
                 $push = 1;
            }
            else if($obj->ActionType == "Love"){
                 $userObj = UserCollection::model()->getTinyUserCollection($obj->LoveUserId);
                 $message = $userObj->DisplayName.$string." loved your post";
                 $push = 1;
            }
            else if($obj->ActionType == "Follow"){
                 $userObj = UserCollection::model()->getTinyUserCollection($obj->UserId);
                 $message = $userObj->DisplayName.$string." followed your post";
                 $push = 1;
            }
              else if($obj->ActionType == "Mention"){
                 $userObj = UserCollection::model()->getTinyUserCollection($obj->UserId);
                 $message = $userObj->DisplayName." mentioned you on post";
                 $push = 1;
            }
              else if($obj->ActionType == "Invite"){
                 $userObj = UserCollection::model()->getTinyUserCollection($obj->UserId);
                 $message = $userObj->DisplayName." invited you on post";
                 $push = 1;
            }
            else if($obj->ActionType == "Chat"){
                 $userObj = UserCollection::model()->getTinyUserCollection($obj->UserId);
                 $message = $userObj->DisplayName." sent a message for you";
                 $push = 1;
            }
            if($push == 1){
              PushNotificationCollection::model()->savePushNotification($obj->OriginalUserId,$message);
              $count =  PushNotificationCollection::model()->getUnreadMessagesCount($obj->OriginalUserId);
              error_log("coutn--------------".$count);
              CommonUtility::sendIOSPushNotification($message,$count,$device_tokens,$obj->ActionType);
              CommonUtility::sendAndroidPushNotification($message,$count,$device_tokens,$obj->ActionType);
            }
              
        } catch (Exception $ex) {
            error_log("sendPushNotification-----------".$ex->getMessage());
        }
    }
    static function sendIOSPushNotification($message,$badge=1,$device_tokens,$actionType){
        try{
          if (array_key_exists(1,$device_tokens)){
          $iosDevice_tokens = $device_tokens[1];
          error_log("sending IOSPushNotification ------------".$message);
          error_log("ios dev tokens----".print_r($iosDevice_tokens, true));

          $sound = "default";
         // $isDevelopment = true;
          $passphrase = Yii::app()->params['PusNotificationPassPhrase'] ;

          $payload = array();
          $payload['aps'] = array(
              'alert' => $message,
              'badge' => intval($badge),
              'sound' => $sound

          );
          if($actionType == "Chat"){
               $payload['actionType']="chat";
          }else{
              $payload['actionType']="notification";
          }
           error_log("##############paulaod".print_r($payload,true));
          $payload = json_encode($payload);    

          $apns_url = NULL;
          $apns_cert = NULL;
          $apns_port = 2195;
          if(DEPLOYMENT_MODE=='DEVELOPMENT'){
              $apns_url = "gateway.sandbox.push.apple.com";
              $apns_cert = "SkiptaNeo_Dev.pem";

          } else{
              $apns_url = "gateway.push.apple.com";
              $apns_cert = "SkiptaNeoDis.pem";
          }
          error_log("##############".$apns_cert);
          $stream_context = stream_context_create();
          stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);   
          stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
          $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
          if(!$apns){
              error_log("Failed To Connect : $error $error_string");
              return;
          } else{
                error_log('Connection Successful..!');
          }

          foreach ($iosDevice_tokens as $token) {
              $apns_message = chr(0) . chr(0) . chr(32);
              $apns_message .= pack('H*', str_replace(' ', '', $token));
              $apns_message .= chr(0) . chr(strlen($payload)) . $payload; 
              fwrite($apns, $apns_message);
          }

          error_log("Notification Delivered Successfully..!");

          //@socket_close($apns);
          @fclose($apns);
            }
        }catch(Exception $ex){
            error_log("sendIOSPushNotification -------------------------".$ex->getMessage());
       }
    }
     static function sendAndroidPushNotification($message,$badge=1,$device_tokens,$actionType){
         try{
        $apiKey = Yii::app()->params['DroidGMSApiKey'];
        if (array_key_exists(2, $device_tokens)) {
            $registrationIDs = $device_tokens[2];
            $url = 'https://android.googleapis.com/gcm/send';
            $data = array("title"=>Yii::app()->params['NetworkName'],"message" => $message, "msgcnt" => $badge);
           if($actionType == "Chat"){
               $data['actionType']="chat";
          }else{
              $data['actionType']="notification";
          }
            $fields = array(
                'registration_ids' => $registrationIDs,
                'data' => $data,
            );
            $headers = array(
                'Authorization: key=' . $apiKey,
                'Content-Type: application/json'
            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //     curl_setopt($ch, CURLOPT_POST, true);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);

            // Close connection
            curl_close($ch);
            echo $result;
            //print_r($result);
            //var_dump($result);  
        }
       }catch(Exception $ex){
            error_log("sendAndroidPushNotification -------------------------".$ex->getMessage());
       }
    }
    static function findUrlInStringAndMakeLink($htmlString){
        try{
            $htmlString = str_replace("&nbsp;","",$htmlString);
            $url = str_replace("https","",YII::app()->params['ServerURL']);
            $url = str_replace("http","",$url);
            if(stristr($htmlString,$url) != ""){
                $htmlString =  preg_replace("/(((https?)\:\/\/)|(www\.))[A-Za-z0-9][A-Za-z0-9.-]+(:\d+)?(\/[^ ]*)?/",
                            "<a href=\"\\0\" >\\0</a>", 
                            $htmlString);
            }else{
                $htmlString =  preg_replace("/(((https?)\:\/\/)|(www\.))[A-Za-z0-9][A-Za-z0-9.-]+(:\d+)?(\/[^ ]*)?/",
                            "<a href=\"\\0\" target='_blank'>\\0</a>", 
                            $htmlString);
}
            return $htmlString;
        } catch (Exception $ex) {
            error_log("########Exception occurred in findUrlInStringAndMakeLink#######".$ex->getMessage());
        }
    }
        
         public static function customBadgingInterceptor($context,$userId,$badgeId,$type='',$storeId){         
         $badgeCollectionObjSave=  CommonUtility::customBadgesSavingInterceptor($context,$userId,"Custom",$badgeId,$type,$storeId);
     }
     
      public static function customBadgesSavingInterceptor($context,$userId,$MetaObjproperty,$badgeId,$type='',$storeId)
    {
         $categoryId = CommonUtility::getIndexBySystemCategoryType('Badge');
         $postType=  CommonUtility::sendPostType('Badge');
         $badgeCollectionObjSave="";
         $context="";
         try
         { 
            $badgeDetails=Badges::model()->getBadgeById($badgeId);
            if(!is_string($badgeDetails)){
                $context=$badgeDetails->context;
            }
            $badgeInfo=  CommonUtility::getBadgeInfo($context);
         
             if($badgeInfo!="failure")
             {
              
                 //save badge info
                 $hasLevel=false;
                if($badgeInfo->has_level)
                {
                    if(CommonUtility::checkForSaveBadgeToUser($badgeInfo,$userId,$MetaObjproperty))
                            $hasLevel=true;
                }
                 
                $badgeCollectionObjSave=  CommonUtility::saveBadgeCollection($badgeInfo,$userId,$hasLevel,$storeId);
               
                //prepare stream obj if exists
                if($badgeCollectionObjSave!="")
                {
                    //prepare stream obj and save in the userstream collection obj.
                    $result=ServiceFactory::getSkiptaPostServiceInstance()->saveFollowOrUnfollowToPost($postType,$badgeCollectionObjSave, $userId, 'Follow', $categoryId);
                    if($badgeInfo->stream_effect)
                      if (!CommonUtility::prepareStreamObject($userId, "Post", $badgeCollectionObjSave, $categoryId, $type, $storeId,'')) {
                       // return "failure";
                    }
                }
                
                
             }
             
         } catch (Exception $ex) {
             error_log($ex->getLine()."==================customBadgesSavingInterceptor========================".$ex->getMessage());
               Yii::log("----in exception -----badgesSavingInterceptor---------------".$ex->getMessage(),'error','application');
         }
         return $badgeCollectionObjSave;
         
        
    }
}

     
