<?php 

include_once 'variables.php';
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => NAME,
    'defaultController' => 'redirect',
    'sourceLanguage' => 'en',
     'preload'=>array('log'),
    'language' => 'en_us',
    // autoloading model and component classes
    'import' => array(
        'ext.YiiMongoDbSuite.*',
        'ext.restfullyii.components.*',
        'ext.YiiConditionalValidator.*',
        'application.models.*',
        'application.components.*',
        'application.models.mongo.*',
        'application.components.*',
        'application.service.*',
        'application.models.mysql.*',
        'application.models.datamigration.*',
        'ext.yii-mail.YiiMailMessage',
        'application.renderscript.*',
        'application.models.mysql.*',
        'application.models.beans.*',
        'application.extensions.EAjaxUpload.*',
        'application.extensions.YiiTagCloud',
        'application.extensions.oauth.*',
        'ext.GoogleAnalytics.*',
        'application.vendors.*',
        'application.vendors.phpexcel.PHPExcel',
        'application.vendors.phpexcel.MPDF56',
        'ext.yiiexcel.*',
        'ext.yiireport.*',
    ),
    'modules' => array(
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'site' => array('/site/index', 'caseSensitive' => false),
                'stream' => array('post', 'caseSensitive' => false),
                'curbsideConsult' => array('curbsidePost', 'caseSensitive' => false),
                'groups' => array('group', 'caseSensitive' => false),
                'users' => array('admin/userManagement', 'caseSensitive' => false),
                'curbsideCategories' => array('/admin/newCurbsideCategory', 'caseSensitive' => false),
                'roleManagement' => array('/admin/GetRoleBasedMgmt', 'caseSensitive' => false),
                'postManagement' => array('/admin/PostManagement', 'caseSensitive' => false),
                'abuseScan' => array('/admin/abusescan', 'caseSensitive' => false),
                'helpManagement' => array('/admin/helpManagement', 'caseSensitive' => false),
                'advertisements' => array('/advertisements/index', 'caseSensitive' => false),
                'quicklinks' => array('/weblink/index', 'caseSensitive' => false),
                'communications' => array('/admin/templateManagement', 'caseSensitive' => false),
                'analytics' => array('analytics', 'caseSensitive' => false),
                'postdetail' => array('/common/postdetail', 'caseSensitive' => false),
                'news' => array('/news/index', 'caseSensitive' => false),
                'survey' => array('/extendedSurvey/index', 'caseSensitive' => false),
                'surveywall' => array('/extendedSurvey/surveyDashboard', 'caseSensitive' => false),
                'userview' => array('/outside/index', 'caseSensitive' => false),
                'profile/<var:[^\/]*>' => array('/common/profileDetails', 'caseSensitive' => false),
                 '<controller:[^\/]+>/managesurvey/[a-zA-Z0-9_]*/' => array('/extendedSurvey/manageSurvey'),
                'userCVView/<var:[^\/]*>' => array('/user/userCV', 'caseSensitive' => false),
                'interaction/<var:[^\/]*>' => array('/user/profileInteractions', 'caseSensitive' => false),
                'profileCV/<var:[^\/]*>' => array('/user/publications', 'caseSensitive' => false),
				'managetoolbox' => array('group/managetoolbox', 'caseSensitive' => false),
                
                'userview' => array('/outside/index', 'caseSensitive' => false),
                '<controller:[^\/]+>/managesurvey/[a-zA-Z0-9_]*/' => array('/extendedSurvey/manageSurvey'),
                '<controller:[^\/]+>/userCVView' => array('/user/userCV'),
                '<controller:[^\/]+>/profile' => array('common/profileDetails'),
                '<controller:[^\/]+>/interaction' => array('user/profileInteractions'),
                '<controller:[^\/]+>/profileCV' => array('/user/publications/'),
                 '<controller:[^\/]+>/edit/[a-zA-Z0-9_]*/' => array('game/newgame'),
                 '<controller:[^\/]+>/[a-zA-Z0-9_]*/[a-zA-Z0-9_]*/game' => array('game/gameDetails'),
                '<controller:[^\/]+>/analytics' => array('group/groupAnalytics'),
                '<controller:[^\/]+>/sg/<var:[^\/]*>' => array('group/subGroupDetail'),
                '<controller:[^\/]+>/' => array('group/groupdetail'),
                '<controller:[^\/]+>/cgz' => array('group/groupdetail'),
                'api/<controller:\w+>' => array('<controller>/restList', 'verb' => 'GET'),
                'api/<controller:\w+>/<id:\w*>' => array('<controller>/restView', 'verb' => 'GET'),
                'api/<controller:\w+>/<id:\w*>/<var:\w*>' => array('<controller>/restView', 'verb' => 'GET'),
                'api/<controller:\w+>/<id:\w*>/<var:\w*>/<var2:\w*>' => array('<controller>/restView', 'verb' => 'GET'),
                array('<controller>/restUpdate', 'pattern' => 'api/<controller:\w+>/<id:\w*>', 'verb' => 'PUT'),
                array('<controller>/restUpdate', 'pattern' => 'api/<controller:\w+>/<id:\w*>/<var:\w*>', 'verb' => 'PUT'),
                array('<controller>/restUpdate', 'pattern' => 'api/<controller:\w*>/<id:\w*>/<var:\w*>/<var2:\w*>', 'verb' => 'PUT'),
                array('<controller>/restDelete', 'pattern' => 'api/<controller:\w+>/<id:\w*>', 'verb' => 'DELETE'),
                array('<controller>/restDelete', 'pattern' => 'api/<controller:\w+>/<id:\w*>/<var:\w*>', 'verb' => 'DELETE'),
                array('<controller>/restDelete', 'pattern' => 'api/<controller:\w+>/<id:\w*>/<var:\w*>/<var2:\w*>', 'verb' => 'DELETE'),
                array('<controller>/restCreate', 'pattern' => 'api/<controller:\w+>', 'verb' => 'POST'),
                array('<controller>/restCreate', 'pattern' => 'api/<controller:\w+>/<id:\w+>', 'verb' => 'POST'),
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'mongodb' => array(
            'class' => 'EMongoDB',

            'connectionString' => 'mongodb://'.DBIPMONGO.':27017',
            'dbName' => DBNAMEMONGO,

            'fsyncFlag' => true,
            'safeFlag' => true,
            'useCursor' => false
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host='.DBIPMYSQL.';dbname='.DBNAME,
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => DBPASSWORD,
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
         
            'errorAction' => 'common/error',
        ),
        'log' => array(
    'class' => 'CLogRouter',
    'routes' => array(
        array(
            'class' => 'CFileLogRoute',
                    'levels' => 'error',
                    'categories' => 'system.*',
        ),
        array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error,warning',
                    'categories' => "application",
                    'logFile' => 'error.log' . date('d-m-y'),
        ),
//         array(
//                    'class'=>'ext.LogDb',
//                    'autoCreateLogTable'=>true,
//                    'connectionID'=>'db',
//                    'enabled'=>true,
//                    'levels'=>'error',//You can replace trace,info,warning,error
//                ),
    ),
),
        /*
         * amqp object creation. 
         */
        'amqp' => array(
            'class' => 'application.extensions.amqp.amqp',
        ),
        'simpleImage' => array(
            'class' => 'application.extensions.simpleImage.CSimpleImage',
        ),
        'config' => array
            (
            'class' => 'ext.FileConfig',
            'configFile' => dirname(__FILE__) . '/SkiptaNeoConfig.php',
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                  'orientation' => 'P', // landscape or portrait orientation
                  'format'      => 'A4', // format A4, A5, ...
                  'language'    => 'en', // language: fr, en, it ...
                  'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                  'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                  'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                  ) */
                )
            ),
        ),'sendgrid'=>array(
            'class' => 'ext.sendgrid.SendGrid',
            'sg_user'=>  SendGrid_UserName,
            'sg_api_key'=>SendGrid_Password, 
        ),
    ),
    'params' => require(dirname(__FILE__) . '/SkiptaNeoConfig.php'),
);
