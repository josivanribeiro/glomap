<!DOCTYPE html>
<html>	
	<?php include 'include/incHead.php';?>
	<script type="text/javascript"><!--	
 
		$(document).ready(function() {
			loadContent ();
			loadOtherContents ();			
		});

		/**
		 * Loads the content by its id.
		 */
		function loadContent () {
			var contentId = getUrlVars()['id'];
			if (contentId != null) {
				loadContentById (contentId);
			}
		}
	
	--></script>
<body>	
	<?php include 'include/incHeader.php';?>
	<section id="main-page">
		<div id="page-container">
			<article id="institucional">
				<div class="articles-content">					
					<div id="column-content-container">
						<form id="contentPageForm" name="contentPageForm">	
							<input type="hidden" name="contentId" id="contentId" value="" />												
						</form>										
						<p id="pTitle" class="top-title"></p>
						<p class="last-update">
							<span>Última atualização: </span><span id="sLastUpdateDate"></span>
						</p>
						<div id="container-content">
						</div>
						
						<div class="other-texts-container" style="display:none;">
							<span id="other-texts-container-label"></span>
						</div>
						<div class="other-texts-bullets" style="display:none;">
						</div>
						
					</div>
					
					<?php include 'include/incFooter.php';?>
					
				</div>
			</article>
		</div>						
	</section>	
</body>
</html> 
