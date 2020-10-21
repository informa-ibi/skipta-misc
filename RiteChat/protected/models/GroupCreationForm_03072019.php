<?php

/*
 * ForgotForm class.
 * ForgotForm is the data structure for requesting a new password
 * It is used by the 'forgot' action of 'UserController'.
 */

class GroupCreationForm extends CFormModel {

    public $GroupName;
    public $ShortDescription;
    public $Description;
    public $UserId;
    public $GroupProfileImage;
    public $Artifacts;
    public $IFrameMode;
    public $IFrameURL;
    public $CreatedOn;
    public $IsPrivate;
    public $AutoFollow;
    public $MigratedGroupId;
    public $GroupMenu;
    public $ConversationVisibility;

    public $AddSocialActions=1;
    public $DisableWebPreview=0;

    public function rules() {
        return array(
            array('IFrameMode', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('IFrameMode', 'compare', 'compareValue'=>"1"),
                ),
                'then' => array(
                             array('IFrameURL, GroupName, Description','required'),
                              array(
                                'IFrameURL',
                                'match', 'pattern' => '/(https|http):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/',
                                'message' => 'URL should start with https://.',
                            ),
                    ),
            ),
            array('IFrameMode', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('IFrameMode', 'compare', 'compareValue'=>"0"),
                ),
                'then' => array(
                             array('GroupName, Description','required')
                    ),
            ),
            array('IFrameMode', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('IFrameMode', 'compare', 'compareValue'=>"2"),
                ),
                'then' => array(
                             array('GroupName, Description,GroupMenu','required')
                    ),
            ),
            array('IFrameMode', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                'if' => array(
                             array('IFrameMode', 'compare', 'compareValue'=>""),
                ),
                'then' => array(
                             array('GroupName,Description,IFrameMode','customRequired'),                                                          
                    ),
            ),

            array('GroupName,Description,IFrameURL,IsPrivate,AutoFollow,GroupMenu,ConversationVisibility,AddSocialActions,DisableWebPreview', 'safe'),

            array(
                            'GroupName',
                            'match', 'not' => true, 'pattern' => "#[^a-z0-9'@\"\s-]#i",
                            'message' => 'Invalid characters in group name',
                      ),
            
        );
    }
    
    public function customRequired($attribute_name,$params){  
        error_log("==CustomRequired==");
        if($attribute_name == "GroupName" && $this->GroupName == "")
            $this->addError('GroupName','GroupName cannot be blank');
        if($attribute_name == "Description" && $this->Description == "")
            $this->addError('Description','Description cannot be blank');
        if($attribute_name == "IFrameMode" && $this->IFrameMode == "")
            $this->addError('IFrameMode','Please choose the Group Mode');
    }


}
