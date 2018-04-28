<div id="tabs-container">
    <ul>        
        <?php			
			if (isset($_SESSION['loggedUser'])) {								
				$loggedUser = Utils::castToClass ('UserVO', $_SESSION['loggedUser']);										
			}
		?>
        <?php if ($loggedUser->getROLE_ADMIN() == "1") { ?>
        	<li><a id="tab-1-link" href="#tab-1"> Usuários </a></li>
        	<li><a id="tab-2-link" href="#tab-2"> Parâmetros </a></li>
        <?php } ?>
        <li><a id="tab-3-link" href="#tab-3"> Conteúdos </a></li>
        <li><a id="tab-4-link" href="#tab-4"> Galerias </a></li>        
    </ul>	
    <?php if ($loggedUser->getROLE_ADMIN() == "1") { ?>
	    <div id="tab-1">
	    	<?php include 'incUsers.php';?>	    	
	    </div>
	    <div id="tab-2">
	    	<?php include 'incParameters.php';?>	    	
	    </div>
    <?php } ?>
    <div id="tab-3">
    	<?php include 'incContents.php';?>
    </div>
    <div id="tab-4">
    	<?php include 'incGalleries.php';?>
    </div>   
</div>