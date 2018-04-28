
  /**
   * Renders the pagination.
  */
  function renderGalleriesPagination (pageNum) {
   		var controllerValue = "GalleryController";
		var actionValue     = "renderPagination";
        $.post ("../classes/controller/FrontController.php", { 
        	  		controller: controllerValue,
        	  		action:     actionValue,
        	  		pageNumber: pageNum
		        }, function (data) {
					$('#container-table-galleries-navigation').html (data);						
				}
         );
   }
   
	/**
	* Renders the galleries as an HTML table.
	*/
   function renderGalleriesTable (pageNum) {
   	  var controllerValue = "GalleryController";
   	  var actionValue     = "renderTable";
	  $.post ("../classes/controller/FrontController.php",
	        { 
    	  		controller: controllerValue,
    	  		action:     actionValue,
    	  		pageNumber: pageNum
	        }, function (data) {
				$('#container-table-galleries').html (data);
			}
      );
    }   

	/**
	 * Checks if the form is fulfilled or not.
	 * 
	 * @returns {boolean} boolean containing the operation result.
	 */
	function isValidGalleryForm () {
			var isValid = true;
			var legend  = $("#txtLegend").val();
			if (isEmpty (legend)) {
				isValid = false;
				showMessage (2, "Preencha todos os campos corretamente.");
			}
			return isValid;
	}

	/**
	 * Resets the form to default values.
	*/
	function resetGalleryForm () {
	   $("#galleryId").val('');   
	   $("#txtLegend").val('');
	   $("#txtDescription").val('');
	   document.getElementById ("chkStatus").checked = true;
	}

	/**
	 * Edits or delete the gallery given its id.
	*/
	function editGallery (galleryId) {
		$("#galleryId").val(galleryId);
		loadGallery ();
		configGalleryButtons();
		changeScreen ('add-gallery-container','gallery-list-container');	
	}

	/**
	* Loads a gallery if when its id is set.
	*/
	function loadGallery () {
		var galleryId = $("#galleryId").val();
		if (!isEmpty(galleryId)) {
			loadGalleryById (galleryId);
		}	
	}

	/**
	* Loads a gallery by its id.
	*/
	function loadGalleryById (galleryId) {
		var controllerValue = "GalleryController";
		var actionValue     = "loadGallery";
		$.post ("../classes/controller/FrontController.php", { 
			controller: controllerValue,
	    	action:     actionValue,
	    	id:         galleryId
		}, function (data) {
			var result = data; 
			var valueArr = result.split("|");
			if (valueArr != null && valueArr.length > 0) {
				var galleryId        = valueArr [0];
				var userId           = valueArr [1];
				var legend           = valueArr [2];
				var description      = valueArr [3];
				var imageGalleryHtml = valueArr [4];
				var creationDate     = valueArr [5];
				var lastUpdateDate   = valueArr [6];
				var status           = valueArr [7];
				$("#galleryId").val (galleryId);
				$("#txtUsernameGallery").val (userId);
				$("#txtLegend").val (legend);
				$("#txtDescription").val (description);
				$("#container-uploaded-files").html (imageGalleryHtml);
				$("#container-uploaded-files").show;
				$("#txtCreationDate").val (creationDate);
				$("#txtLastUpdateDate").val (lastUpdateDate);
				
				if (status == 1) {
					document.getElementById ("chkStatus").checked = true;
				} else {
					document.getElementById ("chkStatus").checked = false;
				}
			}
		  }
	    );
	}
	
	/**
	* Loads an image by its id.
	*/
	function loadImageById (imageId) {
		var controllerValue = "GalleryController";
		var actionValue     = "loadImage";
		$.post ("../classes/controller/FrontController.php", { 
				controller: controllerValue,
				action:     actionValue,
				id:         imageId
			   }, function (data) {						
				   $('#container-image').html (data);
			   }
	    );
	}

	/**
	* Deletes the gallery.
	*/
	function deleteGallery () {
		var controllerValue = "GalleryController";
		var actionValue     = "deleteGallery";
		var galleryIdValue  = $("#galleryId").val (); 
		var result          = confirm ("Confirma exclusão?"); 
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		id:         galleryIdValue
			        }, function (data) {
						var countRows = parseInt (data);
						if (countRows == 1) {
							scrollBodyTop();
							showMessageByContainer (1, "message-container-gallery", "message-paragraph-gallery", "Galeria Excluída com Sucesso.");
							resetGalleryForm ();
							configGalleryButtons();
						}
					}
	         );
		}
	}
	
	/**
	* Deletes the image.
	*/
	function deleteImage (imageId, galleryId) {
		var controllerValue = "GalleryController";
		var actionValue     = "deleteImage";
		 
		var result          = confirm ("Confirma exclusão?");
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		imageId:    imageId,
	        	  		galleryId:  galleryId   
			        }, function (data) {
						alert (data);
			        	var countRows = parseInt (data);
						if (countRows == 1) {							
							//refreshes the images of gallery
							loadGalleryById (galleryId);							
						}
					}
	         );
		}
	}
	
	/**
	* Updates the legend of the image.
	*/
	function updateImageLegend (imageId, galleryId, fieldId) {
		var controllerValue = "GalleryController";
		var actionValue     = "updateImageLegend";
		var legendValue     =  $("#"+fieldId).val();
				 
		var result          = confirm ("Confirma alteração da legenda?"); 
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		imageId:    imageId,
	        	  		galleryId:  galleryId,   
	        	  		legend:     legendValue
			        }, function (data) {
						var countRows = parseInt (data);
						if (countRows == 1) {							
							//refreshes the images of gallery
							loadGalleryById (galleryId);			
						}
					}
	         );
		}
	}
	
	/**
	* Updates the cover image field.
	*/
	function updateCoverImage (imageId, galleryId) {
		var controllerValue = "GalleryController";
		var actionValue     = "updateCoverImage";
		var result = confirm ("Confirma adição desta imagem nas imagens de capa?"); 
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		imageId:    imageId,
	        	  		galleryId:  galleryId 
			        }, function (data) {
						var countRows = parseInt (data);
						if (countRows == 1) {
							//refreshes the images of gallery
							loadGalleryById (galleryId);
						}
					}
	        );
		}		
	}
	
	/**
	* Removes the cover image of the image.
	*/
	function removeCoverImage (imageId, galleryId) {
		var controllerValue = "GalleryController";
		var actionValue     = "removeCoverImage";
		var result = confirm ("Confirma remoção desta imagem das imagens de capa?"); 
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller: controllerValue,
	        	  		action:     actionValue,
	        	  		imageId:    imageId,
	        	  		galleryId:  galleryId
			        }, function (data) {
						var countRows = parseInt (data);
						if (countRows == 1) {
							//refreshes the images of gallery
							loadGalleryById (galleryId);
						}
					}
	        );
		}
	}
	
	/**
	* Validates the cover image before update it.
	*/
	function validateCoverImage (imageId, galleryId) {
		var controllerValue = "GalleryController";
		var actionValue     = "findByCoverImage";		
		$.post ("../classes/controller/FrontController.php", { 
				controller: controllerValue,
				action:     actionValue,
				galleryId:  galleryId
		   		}, function (data) {						
		   			var countRows = parseInt (data);
		   			if (countRows >= 3) {
		   				scrollBodyTop();
		   				showMessageByContainer (2, "message-container-gallery", "message-paragraph-gallery", "É permitido selecionar apenas três imagens de capa.");
		   			} else {
		   				updateCoverImage (imageId, galleryId);
		   			}
		   		}
		);
	}
	
	/**
	* Enables/disables the cover image field.
	*/
	function checkCoverImage () {
		var controllerValue = "GalleryController";
		var actionValue     = "findByCoverImage";
		var galleryIdValue  = $("#galleryId").val ();
		$.post ("../classes/controller/FrontController.php", { 
				controller: controllerValue,
				action:     actionValue,
				galleryId:  galleryIdValue
		   		}, function (data) {						
		   			var countRows = parseInt (data);
					if (countRows == 3) {
						//disables all checkboxes for cover image
						disableCheckboxes ('chkCoverImage');
					} else {
						enableCheckboxes ('chkCoverImage');
					}
		   		}
		);
	}

	/**
	* Configures, show and hide the gallery buttons.
	*/
	function configGalleryButtons() {
		var galleryId = $("#galleryId").val();
		if (!isEmpty(galleryId)) {
			$("#btnUpdateGallery").val ("Atualizar Galeria");
			$("#lblUsernameGallery").show();
			$("#txtUsernameGallery").show();
			$("#container-form-fields").hide();
			$("#btnAddImages").show();			
			$("#container-uploaded-files").show();
			$("#tab-4").css("height", "auto");			
			$("#lblCreationDate").show();
			$("#txtCreationDate").show();
			$("#lblLastUpdateDate").show();
			$("#txtLastUpdateDate").show();
			$("#btnDeleteGallery").show();			
		} else {
			$("#btnUpdateGallery").val ("Adicionar Galeria");
			$("#lblUsernameGallery").hide();
			$("#txtUsernameGallery").hide();
			$("#container-form-fields").show();
			$("#btnAddImages").hide();
			$("#container-uploaded-files").hide();
			$("#tab-4").css("height", "814px");
			$("#lblCreationDate").hide();
			$("#txtCreationDate").hide();
			$("#lblLastUpdateDate").hide();
			$("#txtLastUpdateDate").hide();
			$("#btnDeleteGallery").hide();
		}
	}
	
	/**
	* Configures the update screen to show image upload forms.
	*/
	function addMoreImages () {
		$("#btnAddImages").hide();
		$("#container-uploaded-files").hide();
		$("#container-form-fields").show();
	}
	
	/**
	 * Handles the response from the server (GalleryController.php).
	 */
	function handleGalleryResponse() {
		/*
			err=-3 fileInvalidExtension
			err=-2 fieldEmptyError
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError
			sc=2   updateSuccess
			sc=3   insertSuccess
		*/
		var statusCode = getUrlVars()['sc'];
		var errorCode  = getUrlVars()['err'];			
		var existsCode = false;
		if (statusCode != null) {
			scrollBodyTop();
			if (statusCode === "2") {
				showMessageByContainer (1, "message-container-gallery", "message-paragraph-gallery", "Galeria atualizada com sucesso.");					
			} else if (statusCode === "3") {
				showMessageByContainer (1, "message-container-gallery", "message-paragraph-gallery", "Galeria adicionada com sucesso.");					
			}				
			existsCode = true;			
		} else if (errorCode != null) {
			scrollBodyTop();
			if (errorCode === "-3") {
				showMessageByContainer (3, "message-container-gallery", "message-paragraph-gallery", "Arquivo inválido. Formatos permitidos: png, jpg, jpeg e gif.");
			} else if (errorCode === "-2") {
				showMessageByContainer (2, "message-container-gallery", "message-paragraph-gallery", "Preencha o campo Legenda.");					
			} else if (errorCode === "-1") {
				showMessageByContainer (3, "message-container-gallery", "message-paragraph-gallery", "Nenhum arquivo foi selecionado para upload.");
			} else if (errorCode === "0") {
				showMessageByContainer (3, "message-container-gallery", "message-paragraph-gallery", "Erro no upload, o tamanho da imagem excedeu o limite permitido.");					
			}				
			existsCode = true;				
		}

		if (existsCode) {
			resetGalleryForm();
        	configGalleryButtons();
		}
	}
	