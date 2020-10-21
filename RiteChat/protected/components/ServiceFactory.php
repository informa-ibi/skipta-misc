<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ServiceFactory 
{
 private static $inst_user_service=null;   
 private static $inst_datamigration_service=null;   
 private static $inst_post_service=null; 
 private static $inst_chat_service=null; 
 private static $inst_group_service=null; 
 private static $inst_game_service=null;
 private static $inst_career_service=null;
 private static $inst_ad_service=null;
 private static $inst_topic_service=null;
 private static $inst_weblink_service=null;
 private static $inst_exsurvey_service=null;
 

 private function __construct() {
    }

 public static function getSkiptaUserServiceInstance() {
	        if(!self::$inst_user_service) {
	            self::$inst_user_service = new SkiptaUserService();
	        }
	        return self::$inst_user_service;
	    }
 

    
 public static function getSkiptaDataMigrationServiceInstance()
    {
        if(!self::$inst_datamigration_service) {
	            self::$inst_datamigration_service = new SkiptaDataMigrationService();
	        }
	        return self::$inst_datamigration_service;
    }
     public static function getSkiptaPostServiceInstance()
    {
        if(!self::$inst_post_service) {
	            self::$inst_post_service = new SkiptaPostService();
	        }
	        return self::$inst_post_service;
    }
     public static function getSkiptaChatServiceInstance()
    {
        if(!self::$inst_chat_service) {
	            self::$inst_chat_service = new SkiptaChatService();
	        }
	        return self::$inst_chat_service;
    }
     public static function getSkiptaGroupServiceInstance()
    {
        if(!self::$inst_group_service) {
	            self::$inst_group_service = new SkiptaGroupService();
	        }
	        return self::$inst_group_service;
    }
     public static function getSkiptaGameServiceInstance()
    {
        if(!self::$inst_group_service) {
	            self::$inst_game_service = new SkiptaGameService();
	        }
	        return self::$inst_game_service;
    }
    public static function getSkiptaCareerServiceInstance()
    {
        if(!self::$inst_career_service) {
	            self::$inst_career_service = new SkiptaCareerService();
	        }
	        return self::$inst_career_service;
    }
    
     public static function getSkiptaAdServiceInstance()
    {
        if(!self::$inst_ad_service) {
	            self::$inst_ad_service = new SkiptaAdService();
	        }
	        return self::$inst_ad_service;
    }
      public static function getSkiptaWebLinkServiceInstance()
    {
        if(!self::$inst_ad_service) {
	            self::$inst_weblink_service = new SkiptaWebLinkService();
	        }
	        return self::$inst_weblink_service;
    }
    
     public static function getSkiptaTopicServiceInstance()
    {
        if(!self::$inst_topic_service) {
	            self::$inst_topic_service = new SkiptaTopicService();
	        }
	        return self::$inst_topic_service;
    }
    public static function getSkiptaExSurveyServiceInstance()
    {
        if(!self::$inst_exsurvey_service) {
	            self::$inst_exsurvey_service = new SkiptaExSurveyService();
	        }
	        return self::$inst_exsurvey_service;
    }
    
 }
