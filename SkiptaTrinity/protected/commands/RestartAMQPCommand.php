<?php

/**
 * DocCommand class file.
 *
 * @author Moin Hussain
 * @usage Updating User Handler in TinyUserCollection server version
 *  @version 1.0
 */
class RestartAMQPCommand extends CConsoleCommand {

    public function run($args) {
        $this->restartAMQP();
        $this->restartProxyNode();
    }

    function restartAMQP() {

        $networkName = Yii::app()->params['WebrootPath'];
        $project = Yii::app()->params['Project'];
        $networkName = explode("/", $networkName);
        $networkName = $networkName[5];
        $ququeName = substr($networkName, 1);
        $firstChar = substr($networkName, 0, 1);
        $ququeName = "[" . $firstChar . "]" . $ququeName;
        $x = exec("ps aux | grep '$ququeName/protected/yiic.php amqp' | awk '{print $2}' ");
        if (trim($x) == "") {
            echo " AMWP Not Running";
            $logname = date("Y-m-d-H-i");
            $f1 = "/data/logs/amqp/" . $networkName;
            if (!file_exists($f1)) {
                mkdir($f1, 0755, true);
            }

            shell_exec("touch /data/logs/amqp/".$networkName."/".$logname.".log");
            chdir('/usr/share/nginx/www/' . $networkName . '/protected');
            if($project=="Trinity"){
            echo shell_exec("nohup php /usr/share/nginx/www/" . $networkName . "/protected/yiic.php  amqp    > /data/logs/amqp/".$networkName."/" .$logname.".log &");    
            }else{
             echo shell_exec("nohup php /usr/share/nginx/www/" . $networkName . "/protected/yiicVD.php  amqp    > /data/logs/amqp/".$networkName."/" .$logname.".log &");    
            }
            
            
        }
        else{
            echo "AMQP Running";
        }
            }

    function restartProxyNode() {

        $networkName = Yii::app()->params['WebrootPath'];
        $networkName = explode("/", $networkName);
        $networkName = $networkName[5];
        echo $networkName."\n";
        $ququeName = substr($networkName, 1);
        $firstChar = substr($networkName, 0, 1);
        $ququeName = "[" . $firstChar . "]" . $ququeName;
        $x = exec("ps aux | grep '/opt/softwares/node/$ququeName/proxyNode.js' | awk '{print $2}' ");
        if (trim($x) == "") {
            echo "Proxy Node Not Running";
            $date = date("Y-m-d-H-i");;
            
            shell_exec("touch /data/logs/node/".$networkName."/ProxyNode/".$date . ".log");
            chdir('/opt/softwares/node/' . $networkName . '/');
            echo shell_exec("nohup /usr/local/bin/node /opt/softwares/node/" . $networkName . "/proxyNode.js  > /data/logs/node/" . $networkName . "/ProxyNode/" . $date . ".log &");
        }
        else{
            echo "Proxy Node Running";
        }
    }
    
    
    
    

}
