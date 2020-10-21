<?php

/**
 * UserActions is model file
 * Fields: $Id,$Action,$Active,$CreatedDate
 * user table name: UserActionPrivileges
 * author karteek.vemula 
 * copyright 2008-2014 Techo2 India Pvt Ltd.
 * license http://techo2.com  
 * 
 */

class UserActions extends CActiveRecord {

    public $Id;
    public $Action;
    public $Active;
    public $CreatedDate;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'UserActions';
    }
    
    
 

}
