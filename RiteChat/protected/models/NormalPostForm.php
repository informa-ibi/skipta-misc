<?php

/* 
 * NormalPostForm class.
 * NormalPostForm is the data structure for saving the stream
 * It is used by the 'index' action of 'PostController'.
 */
class NormalPostForm extends CFormModel
{
    public $Type;
    public $UserId;
    public $Description;
    public $Artifacts;
    public $HashTags;
    public $Mentions;
    public $StartDate;
    public $EndDate;
    public $Location;
    public $OptionOne;
    public $OptionTwo;
    public $OptionThree;
    public $OptionFour;
    public $ExpiryDate;
    public $Status;
    public $StartTime;
    public $EndTime;
    public $WebUrls;
    public $DisableComments=0;
    public $NetworkId;
    public $IsFeatured=0;
    public $IsBlockedWordExist=0;
    public $IsBlockedWordExistInComment=0;
    public $IsWebSnippetExist=0;
    public $Title;
    public $CreatedOn;
    public $MigratedPostId='';
    public $FeaturedTitle;
    //$PostedBy is added by Sagar for PostAsNetwork
    public $PostedBy=0;
    public function rules() {
        return array(
             array('Description,Artifacts,HashTags,Mentions,StartDate,EndDate,Location,Type,OptionOne,OptionTwo,OptionThree,OptionFour,ExpiryDate,Status,StartTime,EndTime,WebUrls,DisableComments,IsBlockedWordExist,IsFeatured,IsWebSnippetExist,Title,MigratedPostId,PostedBy,FeaturedTitle', 'safe'),
            array('Type', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                        'if' => array(
                             array('Type', 'compare', 'compareValue'=>"Normal Post"),
                        ),
                        'then' => array(
                             array('Description','required', 'message'=>'Description cannot be blank'),
                        ),
                 ),
            array('Type', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                        'if' => array(
                             array('Type', 'compare', 'compareValue'=>"Survey"),
                        ),
                        'then' => array(
                              array('Description','required', 'message'=>'Survey Question cannot be blank'),
                            array('Title,OptionOne,OptionTwo,OptionThree,ExpiryDate', 'required'),
                        ),
                 ),
            array('Type', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                        'if' => array(
                             array('Type', 'compare', 'compareValue'=>"Normal Post"),
                        ),
                        'then' => array(
                             array('Description','required', 'message'=>'Description cannot be blank'),
                        ),
                
                         'if' => array(
                             array('Type', 'compare', 'compareValue'=>"Event"),
                        ),
                        'then' => array(
                             array('Description','required', 'message'=>'Event Description cannot be blank'),
                        ),

                 ),
             array('Type', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                        'if' => array(
                             array('Type', 'compare', 'compareValue'=>"Event"),
                        ),
                        'then' => array(
                          //   array('Description','required', 'message'=>'Survey Question cannot be blank'),
                           
                            array('Title,StartDate,EndDate,Location', 'required'),
                        ),
                 ),
              array('Type', 'ext.YiiConditionalValidator.YiiConditionalValidator',
                        'if' => array(
                             array('Type', 'compare', 'compareValue'=>"Anonymous"),
                        ),
                        'then' => array(
                          //   array('Description','required', 'message'=>'Survey Question cannot be blank'),
                            array('Description','required', 'message'=>'Anonymous Description cannot be blank'),
                        ),
                 ),
            /* here setting the max length of all options */
            array('OptionOne','length','max'=>'50'),
            array('OptionTwo','length','max'=>'50'),
            array('OptionThree','length','max'=>'50'),
            array('OptionFour','length','max'=>'50'),
            
           
            );
    }
    
}