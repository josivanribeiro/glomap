<?php
/**
 * UserVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class UserVO {
	
	private $USER_ID;
	private $USER_TYPE;
	private $USERNAME;
	private $PWD;
	private $ROLE_ADMIN;
	private $STATUS;
			
	public function __construct () {}
	
	public function getUSER_ID () {
		return $this->USER_ID;
	}
	public function setUSER_ID ($USER_ID) {
		$this->USER_ID = $USER_ID;
    }
	public function getUSER_TYPE () {
		return $this->USER_TYPE;
	}
	public function setUSER_TYPE ($USER_TYPE) {
		$this->USER_TYPE = $USER_TYPE;
    }
	public function getUSERNAME () {
		return $this->USERNAME;
	}
	public function setUSERNAME ($USERNAME) {
		$this->USERNAME = $USERNAME;
    }
	public function getPWD () {
		return $this->PWD;		
	}
	public function setPWD ($PWD) {
		$this->PWD = $PWD;
    }
	public function getROLE_ADMIN () {
		return $this->ROLE_ADMIN;		
	}
	public function setROLE_ADMIN ($ROLE_ADMIN) {
		$this->ROLE_ADMIN = $ROLE_ADMIN;
    }
	public function getSTATUS () {
		return $this->STATUS;		
	}
	public function setSTATUS ($STATUS) {
		$this->STATUS = $STATUS;
    }
        	
}
?>