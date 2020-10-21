<?php


// Store authentication tokens in the session
class SessionTokenStore {
    public $key;
    public $secret;
	// store
    
      public function storeAccessToken($value){
          $this->key=$value;
	}
	
	public function storeSecret($value){
		$this->secret=$value;
	}
	
	
	public function getAccessToken(){
		return $this->key;
	}
	
	public function getSecret(){
		return $this->secret;
	}
	
	
}

?>