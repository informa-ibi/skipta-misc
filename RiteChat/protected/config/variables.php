<?php

if(DEPLOYMENT_MODE=='DEVELOPMENT'){
defined('DBNAME') || define('DBNAME','SkiptaNeo');
defined('DBNAMEMONGO') || define('DBNAMEMONGO','SkiptaNeo');
defined('DBPASSWORD') || define('DBPASSWORD','techo2');
defined('NAME') || define('NAME','SkiptaNeo');
defined('DBIPMYSQL') || define('DBIPMYSQL','10.10.73.111');
defined('DBIPMONGO') || define('DBIPMONGO','10.10.73.102');
define('SendGrid_UserName','');
define('SendGrid_Password','');
}
if(DEPLOYMENT_MODE=='SANDBOX'){
defined('DBNAME') || define('DBNAME','Trinity');
defined('DBPASSWORD') || define('DBPASSWORD','Trinity');
defined('NAME') || define('NAME','Trinity');
defined('DBIPMYSQL') || define('DBIPMYSQL','localhost');
defined('DBIPMONGO') || define('DBIPMONGO','127.0.0.1');
define('SendGrid_UserName','');
define('SendGrid_Password','');
}
if(DEPLOYMENT_MODE=='PRODUCTION'){
defined('DBNAME') || define('DBNAME','RiteChat');
defined('DBPASSWORD') || define('DBPASSWORD','RiteAid20151015');
defined('DBNAMEMONGO') || define('DBNAMEMONGO','RiteChat');
defined('NAME') || define('NAME','SkiptaNeo');
defined('DBIPMYSQL') || define('DBIPMYSQL','localhost');
defined('DBIPMONGO') || define('DBIPMONGO','127.0.0.1');
define('SendGrid_UserName','skipta');
define('SendGrid_Password','four1234');
}
