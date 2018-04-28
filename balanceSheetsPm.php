<?php include 'include/lockBalanceSheetsPm.php';?>
<!DOCTYPE html>
<html>
	<?php include 'include/incHead.php';?>
	<script type="text/javascript"><!--	
 
		$(document).ready(function() {
			renderLastUpdateDateType5 ();
			renderContentsType5 ();
		});
			
	--></script>		
<body>	
	<?php include 'include/incHeader.php';?>
	<section id="main-page">
		<div id="page-container">
			<article id="institucional">
				<div class="articles-content">				
					<div id="column-content-container">
												
						<p class="top-title">Balancetes</p>
						<p class="last-update">
							<span>Última atualização: </span><span id="sLastUpdateDate"></span>
						</p>						
						<p class="paragraph">
							Clube Campestre Duque de Caxias
						</p>
						<p class="paragraph">							
							<b>Prestação de Contas</b>
						</p>						
						<p class="paragraph">																					
							<div id="container-table-contentsType5">							
							</div>											
						</p>
						<br>
					
					</div>
					
					<?php include 'include/incFooter.php';?>
					
				</div>
			</article>
		</div>						
	</section>	
</body>
</html> 
