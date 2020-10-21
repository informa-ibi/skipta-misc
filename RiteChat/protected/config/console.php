<?php
include_once 'variables.php';
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'sourceLanguage' => 'en',
        'language' => 'en_us',
	// autoloading model and component classes
	'import'=>array(	
        'application.models.*',
        'application.components.*',
        'application.models.mongo.*',
        'application.models.beans.*',
        'application.components.*',
        'application.service.*',
        'application.models.mysql.*',
        'application.models.datamigration.*',
        'ext.YiiMongoDbSuite.*',
        'ext.amqp.*',
        'ext.restfullyii.components.*',
         'ext.yii-mail.YiiMailMessage',
         'ext.GoogleAnalytics.*',
            'application.extensions.sftp.*',
            
	),



	// application components
	'components'=>array(
		
            
                    'mail' => array(
              'class' => 'ext.yii-mail.YiiMail',
              'viewPath' => 'application.views.mail',
              'logging' => true,
              'dryRun' => false
              ),

            	'urlManager'=>array(
			'urlFormat'=>'path',
                    'showScriptName'=>false,
			'rules'=>array(
                                                        'api/<controller:\w+>'=>array('<controller>/restList', 'verb'=>'GET'),
        'api/<controller:\w+>/<id:\w*>'=>array('<controller>/restView', 'verb'=>'GET'),
        'api/<controller:\w+>/<id:\w*>/<var:\w*>'=>array('<controller>/restView', 'verb'=>'GET'),
        'api/<controller:\w+>/<id:\w*>/<var:\w*>/<var2:\w*>'=>array('<controller>/restView', 'verb'=>'GET'),

        array('<controller>/restUpdate', 'pattern'=>'api/<controller:\w+>/<id:\w*>', 'verb'=>'PUT'),
        array('<controller>/restUpdate', 'pattern'=>'api/<controller:\w+>/<id:\w*>/<var:\w*>', 'verb'=>'PUT'),
        array('<controller>/restUpdate', 'pattern'=>'api/<controller:\w*>/<id:\w*>/<var:\w*>/<var2:\w*>', 'verb'=>'PUT'),   

        array('<controller>/restDelete', 'pattern'=>'api/<controller:\w+>/<id:\w*>', 'verb'=>'DELETE'),
        array('<controller>/restDelete', 'pattern'=>'api/<controller:\w+>/<id:\w*>/<var:\w*>', 'verb'=>'DELETE'),
        array('<controller>/restDelete', 'pattern'=>'api/<controller:\w+>/<id:\w*>/<var:\w*>/<var2:\w*>', 'verb'=>'DELETE'),

        array('<controller>/restCreate', 'pattern'=>'api/<controller:\w+>', 'verb'=>'POST'),
        array('<controller>/restCreate', 'pattern'=>'api/<controller:\w+>/<id:\w+>', 'verb'=>'POST'),
         
     		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                  
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
		'errorHandler'=>array(
			'errorAction'=>'site/error',
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
                    'logFile' => 'mailError.log' . date('d-m-y'),
                ),

            ),
        ),
           
             /* amqp object creation. 
             */
              'amqp' => array(
            'class' => 'application.extensions.amqp.amqp',
        ),
            'commandMap' => array(
                'node-socket' => 'application.extensions.yii-node-socket.lib.php.NodeSocketCommand'
            ),
            'sendgrid'=>array(
            'class' => 'ext.sendgrid.SendGrid',
            'sg_user'=>  SendGrid_UserName,
            'sg_api_key'=>SendGrid_Password, 
        ),
  

            'testCmd' => array(
              'class' => 'application.nodeTest.Test.Test',  
            ),
            'config'=>array
                (
                        'class'=>'ext.FileConfig',
                        'configFile'=>dirname(__FILE__).'/SkiptaNeoConfig.php',
                ),
            'sftp'=>array(
            'class'=>'SftpComponent',
            'host'=>'ftp.riteaid.com',
            'port'=>22,
            'username'=>'skipta',
            'password'=>'95VtNf1Q',
        ),
                 ),

    'params'=>require(dirname(__FILE__).'/SkiptaNeoConfig.php'),
	
  );  