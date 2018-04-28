<?php
/**
 * EmailVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class EmailVO {
	
	private $NAME;
	private $EMAIL;
	private $SUBJECT;
	private $MESSAGE;	
		
	public function __construct () {}
	
	public function getNAME () {
		return $this->NAME;		
	}
	public function setNAME ($NAME) {
		$this->NAME = $NAME;
    }
	public function getEMAIL () {
		return $this->EMAIL;		
	}
	public function setEMAIL ($EMAIL) {
		$this->EMAIL = $EMAIL;
    }
	public function getSUBJECT () {
		return $this->SUBJECT;
	}
	public function setSUBJECT ($SUBJECT) {
		$this->SUBJECT = $SUBJECT;
    }
	public function getMESSAGE () {
		return $this->MESSAGE;		
	}
	public function setMESSAGE ($MESSAGE) {
		$this->MESSAGE = $MESSAGE;
    }
    	
}
?>