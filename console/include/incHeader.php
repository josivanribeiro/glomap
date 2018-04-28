<!-- start header -->
<div id="header-container">
	<div id="logo-container">
		<img src="/console/resources/images/cms_logo.png"/>
	</div>	
	<p>JSD CMS | Sistema Gerenciador de Conteúdo</p>
	<div id="logout-container">
		<?php			
			include '../classes/vo/UserVO.php';
			include '../classes/util/Utils.php';
						
			if (isset($_SESSION['loggedUser'])) {
								
				$loggedUser = Utils::castToClass ('UserVO', $_SESSION['loggedUser']);
				
				echo $loggedUser->getUSERNAME();
								
			}
		?> | <a href="#dialog" name="modal">Alterar Senha</a> | <a href="logout.php">Logout</a>
	</div>	
	
</div>
<!-- end header -->