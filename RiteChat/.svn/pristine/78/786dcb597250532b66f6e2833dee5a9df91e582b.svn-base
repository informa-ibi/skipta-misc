<?php

require_once(__DIR__ . '/lib/php-amqplib/amqp.inc');
class send {

function __construct($obj) {
$this->streams($obj);
}
function streams($obj){
        $connection = new AMQPConnection(Yii::app()->params['AMQPSTREAMIP'], 5672, Yii::app()->params['AMQPSTREAMUNAME'], Yii::app()->params['AMQPSTREAMPASSWORD']);
        $channel = $connection->channel();
        $channel->queue_declare(Yii::app()->params['AMQPSTREAM'], false, false, false, false);
        $msg = new AMQPMessage($obj);
        $channel->basic_publish($msg, '', Yii::app()->params['AMQPSTREAM']);
        $channel->close();
        $connection->close();
}

}


?>
