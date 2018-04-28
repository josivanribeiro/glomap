<?php

include '../../Autoloader.php';

class UserDAOTest extends PHPUnit_Framework_TestCase {
    
	private $userDAO;
	
	public function setUp() {
        $this->userDAO = new UserDAO();
    }
	
	public function testInsert(){
		$userVO = new UserVO();
		$userVO->setUSER_TYPE('C');
		$userVO->setUSERNAME('admin');
		$userVO->setPWD('admin');
		$userVO->setROLE_ADMIN ('true');
		$userVO->setSTATUS ('true');		
		$result = $this->userDAO->insert ($userVO);
		var_dump ($result);
    }

	/*public function testUpdate(){
		$userVO = new UserVO();
		$userVO->setUSER_ID (2);
		$userVO->setUSER_TYPE('C');
		$userVO->setUSERNAME('admin');
		$userVO->setPWD('12345678');
		$userVO->setROLE_ADMIN (true);
		$userVO->setSTATUS (true);
		
		$result = $this->userDAO->update ($userVO);

		var_dump ($result);
		
        //$this->assertTrue ($result);
    }*/
    
	/*public function testDelete() {
		$userVO = new UserVO();
		$userVO->setUSER_ID (1);
				
		$result = $this->userDAO->delete ($userVO);

		var_dump ($result);
		
        //$this->assertTrue ($result);
    }*/
    
	/*public function testFind() {
		$result = $this->userDAO->find ();

		var_dump ($result);
		
        //$this->assertTrue ($result);
    }*/
    
	/*public function testFindById() {
		$userVO = new UserVO();
		$userVO->setUSER_ID (3);
				
		$result = $this->userDAO->findById ($userVO);

		var_dump ($result);		
    }*/
    
	/*public function testDoLogin() {
		$userVO = new UserVO();
		$userVO->setUSERNAME ("admin");
		$userVO->setPWD ("12345678");		
		$result = $this->userDAO->doLogin ($userVO);
		echo "result: " . $result;
		//var_dump ($result);
    }*/
    
}

?>