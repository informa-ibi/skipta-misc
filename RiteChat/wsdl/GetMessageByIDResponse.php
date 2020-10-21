<?php

class GetMessageByIDResponse
{

  /**
   * 
   * @var SkiptaFriendMessageResponse $GetMessageByIDResult
   * @access public
   */
  public $GetMessageByIDResult;

  /**
   * 
   * @param SkiptaFriendMessageResponse $GetMessageByIDResult
   * @access public
   */
  public function __construct($GetMessageByIDResult)
  {
    $this->GetMessageByIDResult = $GetMessageByIDResult;
  }

}
