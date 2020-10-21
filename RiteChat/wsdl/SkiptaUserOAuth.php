<?php

class SkiptaUserOAuth
{

  /**
   * 
   * @var guid $UserOAuthId
   * @access public
   */
  public $UserOAuthId;

  /**
   * 
   * @var guid $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var string $Service
   * @access public
   */
  public $Service;

  /**
   * 
   * @var string $RequestToken
   * @access public
   */
  public $RequestToken;

  /**
   * 
   * @var string $RequestTokenSecret
   * @access public
   */
  public $RequestTokenSecret;

  /**
   * 
   * @var string $AccessToken
   * @access public
   */
  public $AccessToken;

  /**
   * 
   * @var string $AccessTokenSecret
   * @access public
   */
  public $AccessTokenSecret;

  /**
   * 
   * @param guid $UserOAuthId
   * @param guid $UserId
   * @param string $Service
   * @param string $RequestToken
   * @param string $RequestTokenSecret
   * @param string $AccessToken
   * @param string $AccessTokenSecret
   * @access public
   */
  public function __construct($UserOAuthId, $UserId, $Service, $RequestToken, $RequestTokenSecret, $AccessToken, $AccessTokenSecret)
  {
    $this->UserOAuthId = $UserOAuthId;
    $this->UserId = $UserId;
    $this->Service = $Service;
    $this->RequestToken = $RequestToken;
    $this->RequestTokenSecret = $RequestTokenSecret;
    $this->AccessToken = $AccessToken;
    $this->AccessTokenSecret = $AccessTokenSecret;
  }

}
