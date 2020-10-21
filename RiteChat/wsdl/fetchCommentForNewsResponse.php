<?php

class fetchCommentForNewsResponse
{

  /**
   * 
   * @var SkiptaUserRatingResponse $fetchCommentForNewsResult
   * @access public
   */
  public $fetchCommentForNewsResult;

  /**
   * 
   * @param SkiptaUserRatingResponse $fetchCommentForNewsResult
   * @access public
   */
  public function __construct($fetchCommentForNewsResult)
  {
    $this->fetchCommentForNewsResult = $fetchCommentForNewsResult;
  }

}
