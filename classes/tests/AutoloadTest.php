<?php

include '../Autoloader.php';

class AutoloaderTest {
    
	public function loadTest(){
		$emailBO = new EmailBO();
		echo "Hello Workd!";
    }	
    
}

$a = new AutoloaderTest();
$a->loadTest();


?>