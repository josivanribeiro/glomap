<?php

/**
 * User Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class UserController {
	
	private $userBO;
	
	public function __construct() {
		
	}
	
	/**
	 * Inserts or updates a new user.
	 * 
	 * @return void
	 */
	public function updateUser() {
		$result    = 0;//(-1=duplicatedUsernameError,0=error,1=insertSuccess,2=updateSuccess)
		$id        = $_REQUEST['id'];
		$username  = $_REQUEST['username'];
		$userType  = $_REQUEST['userType'];
		$pwd       = $_REQUEST['pwd'];
		$roleAdmin = $_REQUEST['roleAdmin'];
		$status    = $_REQUEST['status'];		
		$userVO = new UserVO();
		$userVO->setUSER_ID ($id);
		$userVO->setUSERNAME ($username);
		$userVO->setUSER_TYPE ($userType);
		$userVO->setPWD ($pwd);
		$userVO->setROLE_ADMIN ($roleAdmin);
		$userVO->setSTATUS ($status);
		$this->userBO = new UserBO();

		$existingUser = $this->userBO->findDuplicatedUsername ($userVO);
		
		if ($existingUser != null && $existingUser->getUSER_ID() > 0) {
			$result = -1;
		} else if ($id == null) {
			$newUserVO = $this->userBO->insert ($userVO);			
			if ($newUserVO->getUSER_ID () > 0) {
				$result = 1;
			}
		} else {
			$rowCount = $this->userBO->update ($userVO);
			if ($rowCount > 0) {
				$result = 2;
			}
		}
		echo $result;
	}
	
	/**
	 * Updates the user password.
	 * 
	 * @return void
	 */
	public function updateUserPassword() {
		$result     = 0;//(0=error,1=success)
		$loggedUser = Utils::getLoggedUser();		
		$id         = $loggedUser->getUSER_ID();
		$pwd        = $_REQUEST['pwd'];
		$userVO = new UserVO();
		$userVO->setUSER_ID ($id);
		$userVO->setPWD ($pwd);
		$this->userBO = new UserBO();		
		$result = $this->userBO->updatePassword ($userVO);
		echo $result;
	}
	
	/**
	 * Loads an user.
	 * 
	 * @return void
	 */
	public function loadUser() {
		$userId = $_REQUEST['id'];	
		$userVO = new UserVO();
		$userVO->setUSER_ID ($userId);				
		$this->userBO = new UserBO();
		$newUserVO = $this->userBO->findById ($userVO);		
		echo $newUserVO->getUSER_ID ()
			 . "," . $newUserVO->getUSERNAME ()
			 . "," . $newUserVO->getUSER_TYPE ()
			 . "," . $newUserVO->getROLE_ADMIN()
			 . "," . $newUserVO->getSTATUS ();
	}
	
	/**
	 * Deletes an user.
	 * 
	 * @return void
	 */
	public function deleteUser() {
		$userId = $_REQUEST['id'];	
		$userVO = new UserVO();
		$userVO->setUSER_ID ($userId);				
		$this->userBO = new UserBO();
		$countRows = $this->userBO->delete ($userVO);		
		echo $countRows;
	}
	
	/**
	 * Renders the user HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();
		echo "<table id=\"usersTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td>Id</td>";
		echo "			<td>Nome do usuário</td>";
		echo "			<td>Tipo do usuário</td>";
		echo "			<td>Administrador</td>";
		echo "			<td>Status</td>";
		echo "		</tr>";
		echo "	</thead>";
		foreach ($arr as $key => $user) {
			echo "<tr onClick=\"javascript:editUser('" . $user->getUSER_ID() . "');\" onmouseover=\"changeBackgroundColor(this, '#ebf3fb');\" onmouseout=\"changeBackgroundColor(this, '#fff');\" style=\"cursor: pointer;\">";
			echo "	<td>";
			echo "		<div id=\"container-table-item-label\">" . $user->getUSER_ID() . "</div>";
			echo "	</td>";
			echo "	<td>";
			echo "		<div id=\"container-table-item-label\">" . $user->getUSERNAME() . "</div>";
			echo "	</td>";
			echo "	<td>";			
			if ($user->getUSER_TYPE() === "A") {
				$userType = "Todos os Acessos";
			} else if ($user->getUSER_TYPE() === "B") {				
				$userType = "Acesso a Balancetes";
			} else if ($user->getUSER_TYPE() === "C") {
				$userType = "Acesso ao Console";
			}			
			echo "		<div id=\"container-table-item-label\">" . $userType . "</div>";
			echo "	</td>";			
			$roleAdmin = ($user->getROLE_ADMIN() == "1") ? "Sim" : "Não";
			echo "	<td>";
			echo "		<div id=\"container-table-item-label\">" . $roleAdmin . "</div>";         
			echo "	</td>";
			$status = ($user->getSTATUS() == "1") ? "Ativo" : "Inativo";
			echo "	<td>";
			echo "		<div id=\"container-table-item-label\">" . $status . "</div>";         
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	/**
	 * Finds all the users.
	 * 
	 * @return $arr array of users.
	 */
	public function find () {		
		$this->userBO = new UserBO();
		$arr = $this->userBO->find ();
		return $arr;
	}		
		
}

?>