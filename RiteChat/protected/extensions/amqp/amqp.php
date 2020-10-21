<?php
class amqp extends CApplicationComponent{
    public function init() {
        parent::init();
        $dir = dirname(__FILE__);
        $alias = md5($dir);
        Yii::setPathOfAlias($alias,$dir);
        Yii::import($alias.'.send');
    }
    public function stream($obj){
        return new send($obj);
    }
}
?>
