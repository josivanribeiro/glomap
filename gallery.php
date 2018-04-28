<!DOCTYPE html>
<html>	
	<?php include 'include/incHead.php';?>
	<script type="text/javascript"><!--	
 
		$(document).ready(function() {

			loadGallery ();
			loadOtherGalleries ();

			$('.window-image-page .close-image-page').click(function (e) {
				//e.preventDefault();				
				$('#mask-image-page').hide();
				$('.window-image-page').hide();
			});

		    $('#mask-image-page').click(function () {
				$(this).hide();
				$('.window-image-page').hide();
			});
						
		});

		/**
		 * Loads the gallery by its id.
		 */
		function loadGallery () {
			var galleryId = getUrlVars()['id'];
			if (galleryId != null) {
				loadGalleryById (galleryId);
			}
		}
	
	--></script>
<body>	
	<?php include 'include/incHeader.php';?>
	<?php include 'include/incShowImage.php';?>
	<section id="main-page">
		<div id="page-container">
			<article id="institucional">
				<div class="articles-content">					
					<div id="column-content-container">
						<form id="galleryPageForm" name="galleryPageForm">	
							<input type="hidden" name="galleryId" id="galleryId" value="" />												
						</form>										
						<p id="pLegend" class="top-title"></p>
						<p class="last-update"><span>Última atualização: </span><span id="sLastUpdateDate"></span></p>
						<p id="pDescription" class="paragraph"></p>
						
						<div id="container-uploaded-files">							
						</div>		
						
						<div class="other-texts-container">
							<span>Outras galerias de eventos</span>
						</div>
						<div class="other-texts-bullets">						
						</div>						
					</div>					
					<?php include 'include/incFooter.php';?>					
				</div>
			</article>
		</div>						
	</section>	
</body>
</html> 
