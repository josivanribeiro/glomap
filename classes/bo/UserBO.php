<?php 

/**
 * UserBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class UserBO {
	
	private $userDAO;
	
	public function __construct() {
		$this->userDAO = new UserDAO();
	}	
		
	public function insert (UserVO $userVO) {
		$userVO  = $this->userDAO->insert ($userVO);
		return $userVO;
	}
		
	public function update (UserVO $userVO) {
		$updatedRows = null;
		$updatedRows = $this->userDAO->update ($userVO);
		return $updatedRows;
	}
	
	public function updatePassword (UserVO $userVO) {
		$updatedRows = null;
		$updatedRows = $this->userDAO->updatePassword ($userVO);
		return $updatedRows;
	}
	
	public function delete (UserVO $userVO) {
		$updatedRows = null;
		$updatedRows = $this->userDAO->delete ($userVO);
		return $updatedRows;
	}
	
	public function find () {
		return $this->userDAO->find ();
	}
	
	public function findById (UserVO $userVO) {
		return $this->userDAO->findById ($userVO);
	}
	
	public function findByUsername (UserVO $userVO) {
		$this->userDAO = new UserDAO();
		return $this->userDAO->findByUsername ($userVO);
	}
	
	public function findDuplicatedUsername (UserVO $userVO) {
		$this->userDAO = new UserDAO();
		return $this->userDAO->findDuplicatedUsername ($userVO);
	}
		
	public function doLogin (UserVO $userVO) {
		$rowCount = null;
		$rowCount = $this->userDAO->doLogin ($userVO);
		return $rowCount;
	}
	
	/**
	 * Performs the user balancesheet login.
	 * 
	 * @param UserVO $userVO the user.
	 */
	public function doLoginBalanceSheet (UserVO $userVO) {
		$rowCount = null;
		$rowCount = $this->userDAO->doLoginBalanceSheet ($userVO);
		return $rowCount;		
	}
		
}
?>