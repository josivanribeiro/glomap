<?php 

require '../lib/PHPMailer/PHPMailerAutoload.php';

/**
 * EmailBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class EmailBO {	

	private $config;
	
	public function __construct() {
		$this->config = new Config();
	}	
		
	/**
	 * Sends an email via SMTP.
	 * 
	 * @param EmailVO $emailVO the email.
	 */
	public function sendEmail (EmailVO $emailVO) {
		$sent = false;
		try {						
			$mailer = new PHPMailer (true);						
			$mailer->IsSMTP();
			$mailer->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);			
			$mailer->SMTPDebug  = $this->config->__get("smtp.debug");
			$mailer->SMTPSecure = 'tls';
			$mailer->Port       = 587;
			$mailer->Host       = $this->config->__get("smtp.host");
			$mailer->SMTPAuth   = true;
			$mailer->Username   = $this->config->__get("smtp.username");
			$mailer->Password   = $this->config->__get("smtp.pwd");						
			$mailer->FromName   = $this->config->__get("smtp.from.name");
			$mailer->From       = $this->config->__get("smtp.from");
			$mailer->AddAddress ($this->config->__get("smtp.to"));
			$mailer->Subject    = $this->config->__get("smtp.subject");
			$mailer->CharSet    = 'UTF-8';
			$mailer->Body       = $this->getFormattedEmail ($emailVO);
			$mailer->IsHTML (true);						
			$mailer->ClearAttachments();						
			if(!$mailer->send()) {
			    print_r ('Mailer Error: ' . $mailer->ErrorInfo);			    
			 } else {
			    $sent = true;
			}
		} catch (Exception $e) {
			print_r ('Mailer Error: ' . $e->getMessage()) ;
		}		
		return $sent;
	}
	
	/**
	 * Gets the email formatted as plain text.
	 * 
	 * @param EmailVO $emailVO the email.
	 * @return string the result.
	 */
	private function getFormattedEmail (EmailVO $emailVO) {
		$result = null;
		$result  = "<b>Nome</b>: " . $emailVO->getNAME() . "<br>";
		$result .= "<b>Email</b>: " . $emailVO->getEMAIL() . "<br>";
		$result .= "<b>Assunto</b>: " . $emailVO->getSUBJECT() . "<br>";
		$result .= "<b>Mensagem</b>: " . $emailVO->getMESSAGE() . "<br>";
		return $result; 
	}
		
}

?>