<?php include 'include/lockNoticesAndDocuments.php';?>
<!DOCTYPE html>
<html>
	<?php include 'include/incHead.php';?>
	<script type="text/javascript"><!--	
 
		$(document).ready(function() {
			renderLastUpdateDateType4 ();
			renderContentsType4 ();			
		});
			
	--></script>		
<body>	
	<?php include 'include/incHeader.php';?>
	<section id="main-page">
		<div id="page-container">
			<article id="institucional">
				<div class="articles-content">				
					<div id="column-content-container">
												
						<p class="top-title">Avisos e Documentos</p>
						<p class="last-update">
							<span>Última atualização: </span><span id="sLastUpdateDate"></span>
						</p>
						<p class="paragraph">																					
							<div id="container-table-contentsType4">							
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
