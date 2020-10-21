<?php

class ExSurveyBean{
//    public $_id;
//    public $UserId;
//    public $RadioOption;
//    public $CheckboxOption;
//    public $Questions;
//    public $Question;
//    public $QuestionId;
//    public $SurveyTitle;
//    public $SurveyDescription;
//    public $Other;
//    public $OtherValue;
//    public $WidgetType;
//    public $CreatedBy;
//    public $QuestionsCount;
//    public $CurrentScheduleId;
//    public $Status; 
    public $QuestionId;
    public $Question;
    public $Options = array();
    public $QuestionPosition;
    public $QuestionImage;
    public $QuestionType = 0;
    public $Resources = array();
    public $NoofOptions;
    public $NoofRatings;
    public $LabelName = array();
    public $OptionName = array();
    public $Other;
    public $OtherValue;
    public $TotalValue=0;
    public $NoofChars = 0;
    public $MatrixType;
            
}
