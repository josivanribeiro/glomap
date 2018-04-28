<?php
/**
 * UserDAO Data Access Object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class UserDAO extends AbstractDAO {
	
	public function __construct() {		
		parent::__construct();		
	}
		
	public function insert (UserVO $userVO) {
		$sql = "INSERT INTO USER (USER_TYPE, USERNAME, PWD, ROLE_ADMIN, STATUS) 
				VALUES ('".$userVO->getUSER_TYPE()."', '".$userVO->getUSERNAME()."',MD5('".$userVO->getPWD()."'),'".$userVO->getROLE_ADMIN()."','".$userVO->getSTATUS()."')";
		$userId = $this->insertDb ($sql);
		$userVO->setUSER_ID ($userId);
		return $userVO;
    }   
    
	public function update (UserVO $userVO) {
		$sql = "UPDATE USER SET USER_TYPE='".$userVO->getUSER_TYPE()."', USERNAME='".$userVO->getUSERNAME()."',PWD=MD5('".$userVO->getPWD()."'), ROLE_ADMIN=".$userVO->getROLE_ADMIN().", STATUS=".$userVO->getSTATUS()." WHERE USER_ID = ".$userVO->getUSER_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }

	public function updatePassword (UserVO $userVO) {
		$sql = "UPDATE USER SET PWD=MD5('".$userVO->getPWD()."') WHERE USER_ID = ".$userVO->getUSER_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }
    
	public function delete (UserVO $userVO) {
		$sql = "DELETE FROM USER WHERE USER_ID = ".$userVO->getUSER_ID();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }
	public function find () {
		$sql = "SELECT USER_ID, USER_TYPE, USERNAME, ROLE_ADMIN, STATUS FROM USER ORDER BY USER_ID";			
		return $this->selectDB ($sql, 'UserVO');
	}
	
	public function findById (UserVO $userVO) {
		$sql = "SELECT USER_ID, USER_TYPE, USERNAME, ROLE_ADMIN, STATUS FROM USER WHERE USER_ID = " . $userVO->getUSER_ID();
		$arr = $this->selectDB ($sql, 'UserVO');
		$newUser = $arr[0]; 
		return $newUser;
	}
	
	public function findByUsername (UserVO $userVO) {
		$sql = "SELECT USER_ID, USERNAME, ROLE_ADMIN, STATUS FROM USER WHERE USERNAME = '".$userVO->getUSERNAME()."'";
		$arr = $this->selectDB ($sql, 'UserVO');
		$newUser = $arr[0];
		return $newUser;
	}
	
	public function findDuplicatedUsername (UserVO $userVO) {
		$whereClause = "";
		if ($userVO->getUSER_ID() > 0) {
			$whereClause = " AND USER_ID <> " . $userVO->getUSER_ID();
		}		
		$sql = "SELECT USER_ID FROM USER WHERE USERNAME = '".$userVO->getUSERNAME()."'" . $whereClause;
		$arr = $this->selectDB ($sql, 'UserVO');
		$newUser = $arr[0];
		return $newUser;
	}
	
	public function doLogin (UserVO $userVO) {
		$sql = "SELECT COUNT(*) FROM USER WHERE USERNAME = '". $userVO->getUSERNAME() ."' AND PWD = MD5('". $userVO->getPWD() ."') AND (USER_TYPE IN ('A','C') OR ROLE_ADMIN = 1) AND STATUS = 1";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function doLoginBalanceSheet (UserVO $userVO) {
		$sql = "SELECT COUNT(*) FROM USER WHERE USERNAME = '". $userVO->getUSERNAME() ."' AND PWD = MD5('". $userVO->getPWD() ."') AND (USER_TYPE IN ('A','B') OR ROLE_ADMIN = 1) AND STATUS = 1";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
    
}
?>