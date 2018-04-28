<?php

include '../autoloader.php';

class EmailBOTest extends PHPUnit_Framework_TestCase {
    
	private $emailBO;
	
	public function setUp() {
        $this->emailBO = new EmailBO();
    }
	
	public function testSendEmail(){
		$this->emailBO = new EmailBO();
		$result = $this->emailBO->sendEmail (new EmailVO());        
        $this->assertTrue ($result);
    }	
    
}

$n = new EmailBOTest();
$n->testSendEmail();


?>