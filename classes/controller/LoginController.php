<?php

/**
 * Login Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class LoginController {
	
	private $userBO;
	private $config;
	
	public function __construct() {
			
	}
	
	/**
	 * Performs the balancesheet user login.
	 * 
	 * @return void
	 */
	public function doBalanceSheetLogin () {
		$isLogged = false;
		$username = null;
		$pwd      = null;
						
		$username = $_REQUEST['username'];
		$pwd      = $_REQUEST['pwd'];
				
		$userVO = new UserVO();
		$userVO->setUSERNAME ($username);
		$userVO->setPWD ($pwd);
				
		$this->userBO = new UserBO();
		$isLogged = $this->userBO->doLoginBalanceSheet ($userVO);
		$isLogged = intval ($isLogged);
		if ($isLogged == 1) {
			session_start();
			$loggedBalanceSheetUser = $this->userBO->findByUsername ($userVO);
			$_SESSION['loggedBalanceSheetUser'] = $loggedBalanceSheetUser;
		}
		
		echo $isLogged;	
	}
	
	/**
	 * Performs the normal user login.
	 * 
	 * @return void
	 */
	public function doLogin () {
		$username = null;
		$pwd      = null;
		$isLogged = 0;
		$username = $_REQUEST['username'];
		$pwd      =	$_REQUEST['pwd'];		
		$userVO = new UserVO();
		$userVO->setUSERNAME ($username);
		$userVO->setPWD ($pwd);
		$this->userBO = new UserBO();
		$isLogged = $this->userBO->doLogin ($userVO);		
		$isLogged = intval ($isLogged);
		if ($isLogged == 1) {
			session_start();
			$loggedUserVO = $this->userBO->findByUsername ($userVO);
			$_SESSION['loggedUser'] = $loggedUserVO;
		}
		echo $isLogged;
	}
	
	/**
	 * Checks the notices and documents keyword.
	 * 
	 * @return void
	 */
	public function checkNoticesAndDocumentsKeyword () {
		$isLogged = 0;
		$keyword = $_REQUEST['keyword'];

		$this->config = new Config();
		$validKeyword = $this->config->__get("notices.documents.keyword");
		
		if (strcmp ($validKeyword, $keyword) == 0) {
			session_start();
			$_SESSION['loggedNoticesAndDocumentsUser'] = true;
			$isLogged = 1;
		}		
		echo $isLogged;
	}
	
    /**
	 * Checks the balanceSheetPm keyword.
	 * 
	 * @return void
	 */
	public function checkBalanceSheetPmKeyword () {
		$isLogged = 0;
		$keyword = $_REQUEST['keyword'];

		$this->config = new Config();
		$validKeyword = $this->config->__get("balancesheet.pm.keyword");
		
		if (strcmp ($validKeyword, $keyword) == 0) {
			session_start();
			$_SESSION['loggedBalanceSheetPmUser'] = true;
			$isLogged = 1;
		}
		echo $isLogged;
	}
	
	/**
	 * Checks the notices and documents keyword.
	 * 
	 * @return void
	 */
	public function checkNoticesAndDocumentsKeywordExists () {
		$isLogged = 0;
		session_start();
		if (isset($_SESSION['loggedNoticesAndDocumentsUser'])) {
			$isLogged = 1;	
		}
		echo $isLogged;
	}
	
    /**
	 * Checks the balanceSheetPm keyword.
	 * 
	 * @return void
	 */
	public function checkBalanceSheetPmKeywordExists () {
		$isLogged = 0;
		session_start();
		if (isset($_SESSION['loggedBalanceSheetPmUser'])) {
			$isLogged = 1;	
		}
		echo $isLogged;
	}
	
}

?>