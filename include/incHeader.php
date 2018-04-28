<!-- start header -->
<div id="header-container">
	<div class="header-container-content">
		<div class="logo-nav-container">		
			<?php 
			  	if (isset($_SESSION['loggedBalanceSheetUser'])) {					 				
					$displayValue   = "block";
					$marginTopValue = "29px";				
			   	} else {
			   		$displayValue = "none";
			   		$marginTopValue = "64px";
			   	}
			 ?>
			<div id="logout-container" style="display:<?php echo $displayValue; ?>;">
				
			<?php			
				include 'classes/vo/UserVO.php';
				include 'classes/util/Utils.php';
					
				if (isset($_SESSION['loggedBalanceSheetUser'])) {
									
					$loggedBalanceSheetUser = Utils::castToClass ('UserVO', $_SESSION['loggedBalanceSheetUser']);
					
					echo $loggedBalanceSheetUser->getUSERNAME();
									
				}
			?> | <a href="#dialog" name="modal">Alterar Senha</a> | <a href="logout.php">Logout</a>				
								  
			</div
			<h1 class="logo-container">
				<a class="logo" href="home.php" title="GLOMAP"> <img src="/resources/images/glomap_logo.png" border="0"></img></a>
			</h1>			
			<div class="title-nav-container" style="margin-top:<?php echo $marginTopValue; ?>;">
				<div class="title-container">GRANDE LOJA MAÇÔNICA DO AMAPÁ | GLOMAP</div>
								
				<nav id="nav">
					<ul id="navigation">
						<li><a id="mn_Home" href="#" class="first"></a></li>
						<li><a id="mn_Institucional" href="#"></a>
							<ul>
								<li><a id="mn_Institucional_PalavraGraoMestre" href="#"></a></li>
								<li><a id="mn_Institucional_Historico" href="#"></a></li>
								<li><a id="mn_Institucional_Administracao" href="#"></a></li>
								<li><a id="mn_Institucional_Balancetes" href="#"></a></li>
								<li><a id="mn_Institucional_PlanoEstrategico" href="#"></a></li>
								<li><a id="mn_Institucional_GaleriaGraoMestres" href="#"></a></li>
								<li><a id="mn_Institucional_Noticias" href="#"></a></li>								
							</ul>
						</li>
						<li><a id="mn_Lojas" href="#"></a>
							<ul>
								<li><a id="mn_Lojas_LojasJurisdicionadas" href="#"></a></li>
								<li><a id="mn_Lojas_ArtigosIrmaos" href="#"></a></li>
								<li><a id="mn_Lojas_AvisosDocumentos" href="#"></a></li>							
							</ul>
						</li>
						<li><a id="mn_Paramaconicas" href="#"></a>
							<ul>
								<li><a id="mn_Paramaconicas_ASSAP" href="#"></a></li>
								<li><a id="mn_Paramaconicas_CCDC" href="#"></a></li>
								<li><a id="mn_Paramaconicas_Balancete" href="#"></a></li>								
							</ul>
						</li>
						<li><a id="mn_LinksMaconicos" href="#"></a>
							<ul>
								<li><a id="mn_LinksMaconicos_CMSB" href="#"></a></li>
								<li><a id="mn_LinksMaconicos_XLVCMSB2016" href="#"></a></li>
								<li><a id="mn_LinksMaconicos_CorrupcaoNuncaMais" href="#"></a></li>
								<li><a id="mn_LinksMaconicos_SupremoConselhoGrau33" href="#"></a></li>
								<li><a id="mn_LinksMaconicos_RealArcoBrasil" href="#"></a></li>
								<li><a id="mn_LinksMaconicos_OrdemDeMolay" href="#"></a></li>
							</ul>
						</li>
						<li><a id="mn_GLOMAPWEB" href="#"></a></li>
						<li><a id="mn_Webmail" href="#"></a></li>
						<li><a id="mn_Contato" href="#" class="last"></a></li>
					</ul>
				</nav>
				
			</div>		
		</div>
	</div>
</div>
<!-- end header -->