<?php

class SkiptaFriendBroadcastComment
{

  /**
   * 
   * @var guid $BroadcasterCommentId
   * @access public
   */
  public $BroadcasterCommentId;

  /**
   * 
   * @var guid $BroadcasterPostId
   * @access public
   */
  public $BroadcasterPostId;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var guid $WorldPosted
   * @access public
   */
  public $WorldPosted;

  /**
   * 
   * @var string $Link
   * @access public
   */
  public $Link;

  /**
   * 
   * @var string $Comment
   * @access public
   */
  public $Comment;

  /**
   * 
   * @var string $Message
   * @access public
   */
  public $Message;

  /**
   * 
   * @var dateTime $CreatedDate
   * @access public
   */
  public $CreatedDate;

  /**
   * 
   * @var string $Firstname
   * @access public
   */
  public $Firstname;

  /**
   * 
   * @var string $Lastname
   * @access public
   */
  public $Lastname;

  /**
   * 
   * @var int $Likes
   * @access public
   */
  public $Likes;

  /**
   * 
   * @var int $DisLikes
   * @access public
   */
  public $DisLikes;

  /**
   * 
   * @var string $UserRated
   * @access public
   */
  public $UserRated;

  /**
   * 
   * @var boolean $EnableUserRating
   * @access public
   */
  public $EnableUserRating;

  /**
   * 
   * @param guid $BroadcasterCommentId
   * @param guid $BroadcasterPostId
   * @param guid $UserId
   * @param guid $WorldPosted
   * @param string $Link
   * @param string $Comment
   * @param string $Message
   * @param dateTime $CreatedDate
   * @param string $Firstname
   * @param string $Lastname
   * @param int $Likes
   * @param int $DisLikes
   * @param string $UserRated
   * @param boolean $EnableUserRating
   * @access public
   */
  public function __construct($BroadcasterCommentId, $BroadcasterPostId, $UserId, $WorldPosted, $Link, $Comment, $Message, $CreatedDate, $Firstname, $Lastname, $Likes, $DisLikes, $UserRated, $EnableUserRating)
  {
    $this->BroadcasterCommentId = $BroadcasterCommentId;
    $this->BroadcasterPostId = $BroadcasterPostId;
    $this->UserId = $UserId;
    $this->WorldPosted = $WorldPosted;
    $this->Link = $Link;
    $this->Comment = $Comment;
    $this->Message = $Message;
    $this->CreatedDate = $CreatedDate;
    $this->Firstname = $Firstname;
    $this->Lastname = $Lastname;
    $this->Likes = $Likes;
    $this->DisLikes = $DisLikes;
    $this->UserRated = $UserRated;
    $this->EnableUserRating = $EnableUserRating;
  }

}
