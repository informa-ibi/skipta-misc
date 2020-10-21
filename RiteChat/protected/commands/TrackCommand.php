<?php

/**
 * @author Suresh Reddy
 * @class TrackCommand(NodeCommuncation for track the browse details)
 */
class TrackCommand extends CConsoleCommand {

    /**
     * @author Suresh Reddy
     * @method save browse details
     * @param  $obj json format 
     * @return flag 0 or 1
     */
    public function actionIndex($stream, $date) {
        try {
            $streamArr = explode(",", $stream);
            $result = PostCollection::model()->getPostByIds($streamArr);
            echo CJSON::encode($result);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * @author suresh reddy
     * @param type $sessionObj
     */
    public function actionSaveBrowseDetails($sessionObj,$clientIP="") {
        try {

           $sessionObj = json_decode($sessionObj);
           $val = SessionCollection::model()->saveNewSession($sessionObj, $clientIP);


//           if($val==0){
            $latlang = explode(",", $sessionObj->Location);
//
            if (isset($latlang[0]) && isset($latlang[1])) {
                $sessionObj->Address = $this->initcurl(trim($latlang[0]), trim($latlang[1]));
                //   }
                //--------Modified by praneeth for tracking group usability----------
                if ($sessionObj->GroupId != 0) {
                    $isGroupComeback = TrackBrowseDetailsCollection::model()->isGroupComebackUser($sessionObj->GroupId, $sessionObj->SecurityToken);
                    if ($isGroupComeback == 'success') {
                        TrackBrowseDetailsCollection::model()->saveBrowseDetails($sessionObj, $clientIP);
                    }
                } else {
                    TrackBrowseDetailsCollection::model()->saveBrowseDetails($sessionObj, $clientIP);
                }
            }

            //  echo 0;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    public function initcurl($lat, $lang) {

        try {
            $curl = curl_init();
// Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://www.datasciencetoolkit.org/coordinates2politics/' . $lat . '%2c' . $lang,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
// Send the request & save response to $resp
            $result1 = curl_exec($curl);
            $result1 = json_decode($result1, true);
// Close request to clear up some resources
            curl_close($curl);


            $result1 = $result1[0];

            if ($result1['politics'] == null) {
                $x = "undefined,undefined";
                return $x;
            } else {
                $x = '';
                $data = $result1['politics'];
                foreach ($data as $key => $value) {
                    $politic = $data[$key];
                    $name = $politic['name'];
                    $code = $politic['code'];
                    $type = $politic['friendly_type'];
                    $x = $x . "" . $politic['name'] . " ,";
                    //  alert(name+ code+" **$$$***"+type)
                }
                return $x;
            }
        } catch (Exception $e) {
            $x = "undefined,undefined";
        }
    }

}
