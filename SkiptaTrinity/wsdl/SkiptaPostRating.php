<?php

class SkiptaPostRating
{

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var guid $WorldId
   * @access public
   */
  public $WorldId;

  /**
   * 
   * @var guid $PostOrCommentId
   * @access public
   */
  public $PostOrCommentId;

  /**
   * 
   * @var boolean $IsComment
   * @access public
   */
  public $IsComment;

  /**
   * 
   * @var SkiptaPostRatingOption $SkiptaPostRatingOption
   * @access public
   */
  public $SkiptaPostRatingOption;

  /**
   * 
   * @var boolean $Like
   * @access public
   */
  public $Like;

  /**
   * 
   * @var boolean $IsFriendPost
   * @access public
   */
  public $IsFriendPost;

  /**
   * 
   * @var string $CommaDelimitedUserIds
   * @access public
   */
  public $CommaDelimitedUserIds;

  /**
   * 
   * @param guid $UserId
   * @param guid $WorldId
   * @param guid $PostOrCommentId
   * @param boolean $IsComment
   * @param SkiptaPostRatingOption $SkiptaPostRatingOption
   * @param boolean $Like
   * @param boolean $IsFriendPost
   * @param string $CommaDelimitedUserIds
   * @access public
   */
  public function __construct($UserId, $WorldId, $PostOrCommentId, $IsComment, $SkiptaPostRatingOption, $Like, $IsFriendPost, $CommaDelimitedUserIds)
  {
    $this->UserId = $UserId;
    $this->WorldId = $WorldId;
    $this->PostOrCommentId = $PostOrCommentId;
    $this->IsComment = $IsComment;
    $this->SkiptaPostRatingOption = $SkiptaPostRatingOption;
    $this->Like = $Like;
    $this->IsFriendPost = $IsFriendPost;
    $this->CommaDelimitedUserIds = $CommaDelimitedUserIds;
  }

}
