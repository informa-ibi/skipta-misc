<?php

// change the following paths if necessary
defined('DEPLOYMENT_MODE') || define('DEPLOYMENT_MODE','PRODUCTION');
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$hName='trinity';
error_log("---iiii------------------http host--------------------".$_SERVER['HTTP_HOST']);
/*if($_SERVER['HTTP_HOST']=="skiptatrinity.com" || $_SERVER['HTTP_HOST']=="www.skiptatrinity.com"){    
error_log("---66--".$_SERVER['HTTP_HOST']);
$config=dirname(__FILE__).'/protected/config/main.php';
}*/
/*else if($_SERVER['HTTP_HOST']=="trinity.valuedrugco.com" || $_SERVER['HTTP_HOST']=="www.trinity.valuedrugco.com"){    
error_log("---66--".$_SERVER['HTTP_HOST']);
$config=dirname(__FILE__).'/protected/vd_config/maindump.php';
}*/
/*else{    
error_log("---66-else-".$_SERVER['HTTP_HOST']);
    $config=dirname(__FILE__).'/protected/vd_config/main.php';
}*/
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
require_once($yii);
    //do not run app before register YiiExcel autoload
    $app = Yii::createWebApplication($config);
defined('serverRequest') || define('serverRequest','variables.php');    


    Yii::import('ext.yiiexcel.YiiExcel', true);
    Yii::registerAutoloader(array('YiiExcel', 'autoload'), true);
 
    // Optional:
    //  As we always try to run the autoloader before anything else, we can use it to do a few
    //      simple checks and initialisations
    PHPExcel_Shared_ZipStreamWrapper::register();
 
    if (ini_get('mbstring.func_overload') & 2) {
        throw new Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');
    }
    PHPExcel_Shared_String::buildCharacterSets();
 
    //Now you can run application
    $app->run();
