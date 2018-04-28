<script type="text/javascript"><!--		

		$(document).ready(function () {	    		    
		    
			renderGalleriesTable(1);
			renderGalleriesPagination(1);

		    $("#btnDeleteGallery").click(function(event) {				  
		    	deleteGallery ();			  
	      	});

		    $( "#fileImageUpload1" ).change(function() {
		    	  var value = $( "#fileImageUpload1" ).val();
		    	  $("#fileImageUploadReadOnly1").val (value);
		    });

		    $( "#fileImageUpload2" ).change(function() {
		    	  var value = $( "#fileImageUpload2" ).val();
		    	  $("#fileImageUploadReadOnly2").val (value);
		    });

		    $( "#fileImageUpload3" ).change(function() {
		    	  var value = $( "#fileImageUpload3" ).val();
		    	  $("#fileImageUploadReadOnly3").val (value);
		    });

		    $( "#fileImageUpload4" ).change(function() {
		    	  var value = $( "#fileImageUpload4" ).val();
		    	  $("#fileImageUploadReadOnly4").val (value);
		    });

		    $( "#fileImageUpload5" ).change(function() {
		    	  var value = $( "#fileImageUpload5" ).val();
		    	  $("#fileImageUploadReadOnly5").val (value);
		    });

		    $( "#fileImageUpload6" ).change(function() {
		    	  var value = $( "#fileImageUpload6" ).val();
		    	  $("#fileImageUploadReadOnly6").val (value);
		    });

		    $( "#fileImageUpload7" ).change(function() {
		    	  var value = $( "#fileImageUpload7" ).val();
		    	  $("#fileImageUploadReadOnly7").val (value);
		    });

		    $( "#fileImageUpload8" ).change(function() {
		    	  var value = $( "#fileImageUpload8" ).val();
		    	  $("#fileImageUploadReadOnly8").val (value);
		    });

		    $( "#fileImageUpload9" ).change(function() {
		    	  var value = $( "#fileImageUpload9" ).val();
		    	  $("#fileImageUploadReadOnly9").val (value);
		    });

		    $( "#fileImageUpload10" ).change(function() {
		    	  var value = $( "#fileImageUpload10" ).val();
		    	  $("#fileImageUploadReadOnly10").val (value);
		    });

		    $(".r-tabs-state-default a").on("click", function(){});

		    $('.window-image .close-image').click(function (e) {
				e.preventDefault();
				
				$('#mask-image').hide();
				$('.window-image').hide();
			});

		    $('#mask-image').click(function () {
				$(this).hide();
				$('.window-image').hide();
			});		 
	
		});

		function showModalImage (elementId) {
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			$('#mask-image').css({'width':maskWidth,'height':maskHeight});
	
			$('#mask-image').fadeIn(1000);
			$('#mask-image').fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			//$("#" + elementId).css('top',  winH/2-$("#" + elementId).height()/2);
			$("#" + elementId).css('top',  "50px");
			$("#" + elementId).css('left', winW/2-$("#" + elementId).width()/2);
		
			$("#" + elementId).fadeIn(2000);

		}				
		
--></script>
<div id="gallery-list-container">
	<div id="container-message-and-button">
		<div id="container-message-table">
			* Clique uma vez no item da tabela para editar ou excluir o registro.
		</div>
		<div id="container-button-table">
			<input type="button" class="button" id="btnAddGallery" name="btnAddGallery" onClick="javascript:changeScreen ('add-gallery-container','gallery-list-container');configGalleryButtons();" value="Adicionar Galeria"/>	
		</div>
	</div>
	<div id="container-table-galleries" class="container-table">							
	</div>
	<div id="container-table-galleries-navigation" class="container-table-navigation">													
	</div>
</div>

<div id="add-gallery-container" style="display:none;">
	<form id="galleryForm" name="galleryForm" enctype="multipart/form-data" action="../classes/controller/FrontController.php" method="post">
		<input type="hidden" name="controller" id="controller" value="GalleryController" />
		<input type="hidden" name="action" id="action" value="updateGallery" />
		<input type="hidden" name="galleryId" id="galleryId" value="" />
		<!-- message container -->
		<div id="message-container-gallery" class="message-container" style="display: none;">
			<p id="message-paragraph-gallery" class="error-message"></p>
		</div>		
	    <div class="container-form-field" title="Nome do usuário">
	       	<label id="lblUsernameGallery" name="lblUsernameGallery" for="txtUsernameGallery">Nome do usuário</label>
	       	<input id="txtUsernameGallery" name="txtUsernameGallery" type="text" maxlength="250" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field" title="Legenda">
	       	<label id="lblLegend" name="lblLegend" for="txtLegend">Legenda</label>
	       	<input id="txtLegend" name="txtLegend" type="text" maxlength="250" style="width:913px;" />								
		</div>
		<div class="container-form-field" title="Legenda">
	       	<label id="lblDescription" name="lblDescription" for="txtDescription">Descrição</label>
	       	<textarea id="txtDescription" name="txtDescription" cols="70" rows="3" style="width:913px;" onKeyDown="limitText (this.form.txtDescription, 400);" onKeyUp="limitText(this.form.txtDescription, 400);"></textarea>	       		       									
		</div>		
		<div id="container-form-fields">
			<?php 
				for ($i = 1; $i <= 10; $i++) {	
					echo "<div class=\"container-form-upload fileUpload\">";
			    	echo "	<input type=\"button\" class=\"button\" id=\"btnImageUpload".$i."\" name=\"btnImageUpload".$i."\" value=\"Upload ".$i."\" style=\"width: 80px;margin-right:10px;\" />";
			    	echo "	<input id=\"fileImageUploadReadOnly".$i."\" name=\"fileImageUploadReadOnly".$i."\" disabled=\"disabled\" placeholder=\"Selecione uma imagem\" type=\"text\" style=\"width:285px;\">";
			    	echo "	<input id=\"txtImageLegend".$i."\" name=\"txtImageLegend".$i."\" placeholder=\"Legenda da imagem\" type=\"text\" style=\"width:285px;margin-left: 10px;\" \">";	
			    	echo "	<input type=\"checkbox\" id=\"chkCoverImage".$i."\" name=\"chkCoverImage".$i."\" value=\"".$i."\" style=\"margin-left:9px;\" onClick=\"javascript:checkCheckedCheckboxes('chkCoverImage');\" >"; 
			       	echo "  <label for=\"rdCoverImage\">Imagem de capa</label>";
			    	echo "	<input id=\"fileImageUpload".$i."\" name=\"fileImageUpload".$i."\" type=\"file\" class=\"upload\" />";
					echo "</div>";
				}
			?>
		</div>		
		<input type="button" class="button" id="btnAddImages" name="btnAddImages" value="Adicionar Mais Imagens" onClick="addMoreImages ();checkCoverImage();" style="width: 152px;margin-bottom: 10px;" />
		<div id="container-uploaded-files">
			
		</div>
		<div class="container-form-field" title="Data de criação">
	       	<label id="lblCreationDate" name="lblCreationDate" for="txtCreationDate">Data de criação</label>
	       	<input id="txtCreationDate" name="txtCreationDate" type="text" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field" title="Data da última atualização">
	       	<label id="lblLastUpdateDate" name="lblLastUpdateDate" for="txtLastUpdateDate">Data da última atualização</label>
	       	<input id="txtLastUpdateDate" name="txtLastUpdateDate" type="text" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field" style="margin-bottom:10px;" title="Status">
			<input type="checkbox" id="chkStatus" name="chkStatus" value="1" checked>
			<label for="chkStatus">Ativo</label>			
		</div>
		<input type="button" class="button" id="btnBack" name="btnBack" value="Voltar" onClick="javascript:changeScreen ('gallery-list-container', 'add-gallery-container');resetGalleryForm ();renderGalleriesTable(1);renderGalleriesPagination(1);configScreen('tab-4', 'height', '500px');" style="width: 80px;" />
		<input type="submit" class="button" id="btnUpdateGallery" name="btnUpdateGallery" value="Adicionar Galeria" style="margin-left:11px;" />	
		<input type="button" class="button" id="btnDeleteGallery" name="btnDeleteGallery" value="Excluir Galeria" style="margin-left:11px;" />
	</form>
</div>
