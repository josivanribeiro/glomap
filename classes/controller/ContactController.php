<?php

/**
 * Contact Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContactController {
	
	private $emailBO;
	
	public function __construct() {
				
	}	
		
	/**
	 * Sends the contact form via email.
	 * 
	 * @return void
	 */
	public function sendEmail () {
		$success = false;
		$name    = null;
		$email   = null;
		$subject = null;
		$message = null;
				
		$name    = $_REQUEST['name'];
		$email   = $_REQUEST['email'];
		$subject = $_REQUEST['subject'];
		$message = $_REQUEST['message'];	 	
		
		$emailVO = new EmailVO();
		$emailVO->setNAME ($name);
		$emailVO->setEMAIL ($email);
		$emailVO->setSUBJECT ($subject);
		$emailVO->setMESSAGE ($message);
		
		$this->emailBO = new EmailBO();
		$success = $this->emailBO->sendEmail ($emailVO);
		
		echo $success;
	}
		
}

?>