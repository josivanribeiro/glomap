<?php
/**
 * ImageVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ImageVO {
	
	private $IMAGE_ID;
	private $GALLERY_ID;
	private $IMAGE;
	private $IMAGE_HEIGHT;
	private $IMAGE_WIDTH;
	private $IMAGE_SIZE;
	private $IMAGE_THUMB;
	private $IMAGE_THUMB_HEIGHT;
	private $IMAGE_THUMB_WIDTH;
	private $IMAGE_THUMB_SIZE;
	private $NAME;
	private $LEGEND;
	private $COVER_IMAGE;
	private $CREATION_DT;	
			
	public function __construct () {}	
	
	public function getIMAGE_ID () {
		return $this->IMAGE_ID;		
	}
	public function setIMAGE_ID ($IMAGE_ID) {
		$this->IMAGE_ID = $IMAGE_ID;
    }
	public function getGALLERY_ID () {
		return $this->GALLERY_ID;		
	}
	public function setGALLERY_ID ($GALLERY_ID) {
		$this->GALLERY_ID = $GALLERY_ID;
    }
	public function getIMAGE () {
		return $this->IMAGE;
	}
	public function setIMAGE ($IMAGE) {
		$this->IMAGE = $IMAGE;
    }
	public function getIMAGE_HEIGHT () {
		return $this->IMAGE_HEIGHT;
	}
	public function setIMAGE_HEIGHT ($IMAGE_HEIGHT) {
		$this->IMAGE_HEIGHT = $IMAGE_HEIGHT;
    }
	public function getIMAGE_WIDTH () {
		return $this->IMAGE_WIDTH;
	}
	public function setIMAGE_WIDTH ($IMAGE_WIDTH) {
		$this->IMAGE_WIDTH = $IMAGE_WIDTH;
    }
	public function getIMAGE_SIZE () {
		return $this->IMAGE_SIZE;
	}
	public function setIMAGE_SIZE ($IMAGE_SIZE) {
		$this->IMAGE_SIZE = $IMAGE_SIZE;
    }
	public function getIMAGE_THUMB () {
		return $this->IMAGE_THUMB;
	}
	public function setIMAGE_THUMB ($IMAGE_THUMB) {
		$this->IMAGE_THUMB = $IMAGE_THUMB;
    }
	public function getIMAGE_THUMB_HEIGHT () {
		return $this->IMAGE_THUMB_HEIGHT;
	}
	public function setIMAGE_THUMB_HEIGHT ($IMAGE_THUMB_HEIGHT) {
		$this->IMAGE_THUMB_HEIGHT = $IMAGE_THUMB_HEIGHT;
    }
	public function getIMAGE_THUMB_WIDTH () {
		return $this->IMAGE_THUMB_WIDTH;
	}
	public function setIMAGE_THUMB_WIDTH ($IMAGE_THUMB_WIDTH) {
		$this->IMAGE_THUMB_WIDTH = $IMAGE_THUMB_WIDTH;
    }
	public function getIMAGE_THUMB_SIZE () {
		return $this->IMAGE_THUMB_SIZE;
	}
	public function setIMAGE_THUMB_SIZE ($IMAGE_THUMB_SIZE) {
		$this->IMAGE_THUMB_SIZE = $IMAGE_THUMB_SIZE;
    }
	public function getNAME () {
		return $this->NAME;
	}
	public function setNAME ($NAME) {
		$this->NAME = $NAME;
    }
	public function getCOVER_IMAGE () {
		return $this->COVER_IMAGE;
	}
	public function setCOVER_IMAGE ($COVER_IMAGE) {
		$this->COVER_IMAGE = $COVER_IMAGE;
    }
    public function getLEGEND () {
		return $this->LEGEND;
	}
	public function setLEGEND ($LEGEND) {
		$this->LEGEND = $LEGEND;
    }
	public function getCREATION_DT () {
		return $this->CREATION_DT;
	}
	public function setCREATION_DT ($CREATION_DT) {
		$this->CREATION_DT = $CREATION_DT;
    }	
}
?>