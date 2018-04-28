<?php
/**
 * GalleryVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class GalleryVO {
	
	private $GALLERY_ID;
	private $USER_ID;
	private $LEGEND;
	private $DESCRIPTION;
	private $CREATION_DT;	
	private $LAST_UPDATE_DT;
	private $STATUS;
	private $IMAGEVO_ARR;
		
	public function __construct () {}
	
	public function getGALLERY_ID () {
		return $this->GALLERY_ID;		
	}
	public function setGALLERY_ID ($GALLERY_ID) {
		$this->GALLERY_ID = $GALLERY_ID;
    }
	public function getUSER_ID () {
		return $this->USER_ID;
	}
	public function setUSER_ID ($USER_ID) {
		$this->USER_ID = $USER_ID;
    }
	public function getLEGEND () {
		return $this->LEGEND;
	}
	public function setLEGEND ($LEGEND) {
		$this->LEGEND = $LEGEND;
    }
	public function getDESCRIPTION () {
		return $this->DESCRIPTION;
	}
	public function setDESCRIPTION ($DESCRIPTION) {
		$this->DESCRIPTION = $DESCRIPTION;
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
	public function getIMAGEVO_ARR () {
		return $this->IMAGEVO_ARR;
	}
	public function setIMAGEVO_ARR ($IMAGEVO_ARR) {
		$this->IMAGEVO_ARR = $IMAGEVO_ARR;
    }
}
?>