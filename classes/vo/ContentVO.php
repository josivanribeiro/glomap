<?php
/**
 * ContentVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentVO {
	
	private $CONTENT_ID;
	private $USER_ID;
	private $CONTENT_TYPE;
	private $COMPONENT_ID;
	private $URL;	
	private $TITLE;
	private $CONTENT;
	private $MANAGEMENT;
	private $PERIOD_START_MONTH;
	private $PERIOD_START_YEAR;
	private $PERIOD_END_MONTH;
	private $PERIOD_END_YEAR;	
	private $CREATION_DT;
	private $LAST_UPDATE_DT;
	private $STATUS;
	private $STATE; //(A=Active,R=Removed)
			
	public function __construct () {}
	
	public function getCONTENT_ID () {
		return $this->CONTENT_ID;		
	}
	public function setCONTENT_ID ($CONTENT_ID) {
		$this->CONTENT_ID = $CONTENT_ID;
    }
	public function getUSER_ID () {
		return $this->USER_ID;
	}
	public function setUSER_ID ($USER_ID) {
		$this->USER_ID = $USER_ID;
    }
	public function getCONTENT_TYPE () {
		return $this->CONTENT_TYPE;
	}
	public function setCONTENT_TYPE ($CONTENT_TYPE) {
		$this->CONTENT_TYPE = $CONTENT_TYPE;
    }
	public function getCOMPONENT_ID () {
		return $this->COMPONENT_ID;
	}
	public function setCOMPONENT_ID ($COMPONENT_ID) {
		$this->COMPONENT_ID = $COMPONENT_ID;
    }
	public function getURL () {
		return $this->URL;
	}
	public function setURL ($URL) {
		$this->URL = $URL;
    }
	public function getTITLE () {
		return $this->TITLE;
	}
	public function setTITLE ($TITLE) {
		$this->TITLE = $TITLE;
    }
	public function getCONTENT () {
		return $this->CONTENT;
	}
	public function setCONTENT ($CONTENT) {
		$this->CONTENT = $CONTENT;
    }
	public function getMANAGEMENT () {
		return $this->MANAGEMENT;
	}
	public function setMANAGEMENT ($MANAGEMENT) {
		$this->MANAGEMENT = $MANAGEMENT;
    }
    public function getPERIOD_START_MONTH () {
		return $this->PERIOD_START_MONTH;
	}
	public function setPERIOD_START_MONTH ($PERIOD_START_MONTH) {
		$this->PERIOD_START_MONTH = $PERIOD_START_MONTH;
    }
	public function getPERIOD_START_YEAR () {
		return $this->PERIOD_START_YEAR;
	}
	public function setPERIOD_START_YEAR ($PERIOD_START_YEAR) {
		$this->PERIOD_START_YEAR = $PERIOD_START_YEAR;
    }
    public function getPERIOD_END_MONTH () {
		return $this->PERIOD_END_MONTH;
	}
	public function setPERIOD_END_MONTH ($PERIOD_END_MONTH) {
		$this->PERIOD_END_MONTH = $PERIOD_END_MONTH;
    }
	public function getPERIOD_END_YEAR () {
		return $this->PERIOD_END_YEAR;
	}
	public function setPERIOD_END_YEAR ($PERIOD_END_YEAR) {
		$this->PERIOD_END_YEAR = $PERIOD_END_YEAR;
    }
    public function getCREATION_DT () {
		return $this->CREATION_DT;
	}
	public function setCREATION_DT ($CREATION_DT) {
		$this->CREATION_DT = $CREATION_DT;
    }
	public function getLAST_UPDATE_DT () {
		return $this->LAST_UPDATE_DT;
	}
	public function setLAST_UPDATE_DT ($LAST_UPDATE_DT) {
		$this->LAST_UPDATE_DT = $LAST_UPDATE_DT;
    }
	public function getSTATUS () {
		return $this->STATUS;
	}
	public function setSTATUS ($STATUS) {
		$this->STATUS = $STATUS;
    }
	public function getSTATE () {
		return $this->STATE;
	}
	public function setSTATE ($STATE) {
		$this->STATE = $STATE;
    }	
}
?>