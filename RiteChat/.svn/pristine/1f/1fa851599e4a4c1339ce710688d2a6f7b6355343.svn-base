<?php

class CustomBadgeForm extends CFormModel{
    public $id;
    public $BadgeName;
    public $BadgeDescription;
    public $BadgeIcon;
    
    public function rules() {
        return array(
    array('BadgeName,BadgeDescription', 'required'),
            array('id,BadgeName,BadgeDescription,BadgeIcon','safe'),
            
            );                
    }
}