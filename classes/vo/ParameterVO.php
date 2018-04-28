<?php
/**
 * ParameterVO value object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ParameterVO {
	
	private $PARAMETER_ID;
	private $KEY;
	private $VALUE;
				
	public function __construct () {}
	
	public function getPARAMETER_ID () {
		return $this->PARAMETER_ID;
	}
	public function setPARAMETER_ID ($PARAMETER_ID) {
		$this->PARAMETER_ID = $PARAMETER_ID;
    }
	public function getKEY () {
		return $this->KEY;
	}
	public function setKEY ($KEY) {
		$this->KEY = $KEY;
    }
	public function getVALUE () {
		return $this->VALUE;
	}
	public function setVALUE ($VALUE) {
		$this->VALUE = $VALUE;
    }        	
}
?>