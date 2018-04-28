<!DOCTYPE html>
<html>	
	<?php include 'include/incHead.php';?>
<body>
	<?php include 'include/incKeyword.php';?>
	<?php include 'include/incHeader.php';?>
	<section id="main-page">
		<div id="page-container">
			<article id="home">
				<div>
					<div id="home-container" class="home1-container">									
						<div class="news-container">
							<div class="news-container-title">
								<div class="news-container-title-icon">
									<img src="/resources/images/news_icon.png" border="0" />
								</div>
								 <div class="news-container-title-label">
								 	Notícias
								 </div>				
							</div>
							<div id="news-container-lines" style="height:332px;">
							
							</div>
							
							<div class="notices-documents-container-title">
								<div class="notices-documents-container-title-icon">
									<img src="/resources/images/notification_icon.png" border="0" />
								</div>
								 <div class="notices-documents-container-title-label">
								 	Avisos e Documentos
								 </div>				
							</div>
							
							<div id="notices-documents-container-lines">
								
							</div>							
										
						</div>
						<div class="intro-container">
							<div class="intro-container-content">
								<div class="intro-container-content-picture">
									<img src="/resources/images/grao_mestre_picture.png" border="0" />
								</div>
								<div class="intro-container-content-text">									
									<div class="intro-container-title" style="margin-top: 10px;">
										<div class="intro-container-title-icon">
											<img src="/resources/images/comment_icon.png" border="0" />
										</div>
										<div id="cnt_Intro_PalavraGraoMestre" class="intro-container-title-label">
											
										</div>
										<p style="margin-bottom: 10px; margin-left: 12px;">
											<a id="lnk_Intro_PalavraGraoMestre" href="#"></a>
										</p>
									</div>									
									<div class="intro-container-title" style="margin-top: 20px;">
										<div class="intro-container-title-icon">
											<img src="/resources/images/comment_icon.png" border="0" />
										</div>
										<div id="cnt_Intro_ArtigosIrmaos" class="intro-container-title-label">
										
										</div>
										<p style=" margin-left: 12px;">
											<a id="lnk_Intro_ArtigosIrmaos" href="#"></a>
										</p>
									</div>																											
								</div>																
							</div>							
						</div>											
					</div>										
					<div class="galleries-container">					
						<form id="galleryHomeForm" name="galleryHomeForm">
							<input type="hidden" name="imageName1_1" id="imageName1_1" value="1" />
							<input type="hidden" name="imageName1_2" id="imageName1_2" value="" />
							<input type="hidden" name="imageName1_3" id="imageName1_3" value="" />
							<input type="hidden" name="galleryLegend1" id="galleryLegend1" value="" />
							<input type="hidden" name="galleryId1" id="galleryId1" value="" />
							<input type="hidden" name="imageName2_1" id="imageName2_1" value="" />
							<input type="hidden" name="imageName2_2" id="imageName2_2" value="" />
							<input type="hidden" name="imageName2_3" id="imageName2_3" value="" />
							<input type="hidden" name="galleryLegend2" id="galleryLegend2" value="" />
							<input type="hidden" name="galleryId2" id="galleryId2" value="" />							
							<input type="hidden" name="imageName3_1" id="imageName3_1" value="" />
							<input type="hidden" name="imageName3_2" id="imageName3_2" value="" />
							<input type="hidden" name="imageName3_3" id="imageName3_3" value="" />
							<input type="hidden" name="galleryLegend3" id="galleryLegend3" value="" />
							<input type="hidden" name="galleryId3" id="galleryId3" value="" />		
						</form>						
						<div class="galleries-container-background">
							
							<div class="galleries-container-images">								
								<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
									<tr>
										<td style="text-align: center;"><a id="galleries-container-image-1-link" href="gallery.php?id="><img id="galleries-container-image-1" src="/resources/images/px_transparent.png" border="0" /></a></td>
										<td style="text-align: center;"><a id="galleries-container-image-2-link" href="gallery.php?id="><img id="galleries-container-image-2" src="/resources/images/px_transparent.png" border="0" /></a></td>
										<td style="text-align: center;"><a id="galleries-container-image-3-link" href="gallery.php?id="><img id="galleries-container-image-3" src="/resources/images/px_transparent.png" border="0" /></a></td>
									</tr>
								</table>								
							</div>					
							
							<div class="galleries-container-title">
								<div class="galleries-container-title-icon">
									<img src="/resources/images/gallery_icon.png" border="0" />
								</div>
								<div class="galleries-container-title-label">
									Galeria de Eventos <span id="galleries-separator" style="display:none;">|</span> <a id="galleries-container-title-label-link" href="gallery.php?id="></a>
								</div>
								<div class="galleries-container-numbers">
									<div id="galleries-container-number-3" class="galleries-container-numbers-3"><a href="javascript:goToGalleryHome(3);">3</a></div>
									<div id="galleries-container-number-2" class="galleries-container-numbers-2"><a href="javascript:goToGalleryHome(2);">2</a></div>
									<div id="galleries-container-number-1" class="galleries-container-numbers-1"><a href="javascript:goToGalleryHome(1);">1</a></div>
								</div>		
							</div>						
						</div>					
													
					</div>			
					<?php include 'include/incFooter.php';?>										
				</div>
			</article>
			
		</div>						
	</section>	
</body>
</html> 
