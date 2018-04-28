
  /**
   * Renders the pagination.
  */
  function renderContentsPagination (pageNum) {
   		var controllerValue = "ContentController";
		var actionValue     = "renderPagination";
        $.post ("../classes/controller/FrontController.php", { 
        	  		controller: controllerValue,
        	  		action:     actionValue,
        	  		pageNumber: pageNum
		        }, function (data) {
					$('#container-table-contents-navigation').html (data);						
				}
         );
   }
   
	/**
	* Renders the contents as an HTML table.
	*/
   function renderContentsTable (pageNum) {
   	  var controllerValue = "ContentController";
   	  var actionValue     = "renderTable";
	  $.post ("../classes/controller/FrontController.php",
	        { 
    	  		controller: controllerValue,
    	  		action:     actionValue,
    	  		pageNumber: pageNum
	        }, function (data) {
				$('#container-table-contents').html (data);
			}
      );
    }
   
   /**
	* Renders the associated menu as a HTML select.
	*/
  function renderAssociatedMenu () {
  	  var controllerValue = "ContentController";
  	  var actionValue     = "renderAssociatedMenu";
	  $.post ("../classes/controller/FrontController.php",
	        { 
   	  		controller: controllerValue,
   	  		action:     actionValue   	  		
	        }, function (data) {
				$('#selectComponentId').html (data);
			}
     );
   }       
  
    /**
	* Sets the URL based on contentType.
	*/
   function setURL () {
	  var controllerValue  = "ContentController";
	  var actionValue      = "setURL";
	  var contentIdValue   = $("#contentId").val();
	  var contentTypeValue = $("#selectContentType").val();
	  	  
	  if (contentTypeValue != "4" && contentTypeValue != "5") {
		  $.post ("../classes/controller/FrontController.php",
			        { 
		 	  		controller:  controllerValue,
		 	  		action:      actionValue,
		 	  		id:          contentIdValue,
		 	  		contentType: contentTypeValue 
			        }, function (data) {
						$('#txtUrl').val (data);
					}
		  );
	  } else {
		  $('#txtUrl').val ('');
	  }	  
   }
   
	/**
	 * Checks if the componentId is valid or not.
	 * 
	 * @returns {boolean} boolean containing the operation result.
	 */
	function isValidComponentId () {
		var isValid = true;
		var componentId  = $("#selectComponentId").val();		
		if (componentId === "mn_Lojas_LojasJurisdicionadas") {
			isValid = false;
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "O menu associado \"Lojas Jurisdicionadas \" não pode ser associado.");
		}
		return isValid;
	}

	/**
	 * Resets the form to default values.
	*/
	function resetContentForm () {
	   $("#contentId").val('');
	   $("#selectContentType").val('');
	   $("#selectComponentId").val('');
	   $("#txtUrl").val('');
	   $("#linkUrl").text ('');
	   $("#linkUrl").attr ("href", "download.php?filename=");
	   $("#txtTitle").val('');
	   if (tinymce.get('txtContent') != null) {
		   tinymce.get('txtContent').setContent ('');
	   }	   
	   document.getElementById ("chkStatusContent").checked = true;
	}

	/**
	 * Edits or delete the content given its id.
	*/
	function editContent (contentId) {
		$("#contentId").val(contentId);
		loadContent ();
		configContentButtons();
		changeScreen ('add-content-container','content-list-container');	
	}

	/**
	* Loads a content if when its id is set.
	*/
	function loadContent () {
		var contentId = $("#contentId").val();
		if (!isEmpty(contentId)) {
			loadContentById (contentId);
		}	
	}

	/**
	* Loads a gallery by its id.
	*/
	function loadContentById (contentId) {
		var controllerValue = "ContentController";
		var actionValue     = "loadContent";
		$.post ("../classes/controller/FrontController.php", { 
			controller: controllerValue,
	    	action:     actionValue,
	    	id:         contentId
		}, function (data) {			
			var result = data;
			var valueArr = result.split("&&");
			if (valueArr != null && valueArr.length > 0) {
				var contentId        = valueArr [0];
				var username         = valueArr [1];
				var contentType      = valueArr [2];
				var componentId      = valueArr [3];
				var url              = valueArr [4];
				var title            = valueArr [5];
				var content          = valueArr [6];
				var management       = valueArr [7];
				
				var periodStartMonth = valueArr [8];
				var periodStartYear  = valueArr [9];
				var periodEndMonth   = valueArr [10];
				var periodEndYear    = valueArr [11];
							
				var creationDate     = valueArr [12];
				var lastUpdateDate   = valueArr [13];
				var status           = valueArr [14];
								
				$("#contentId").val (contentId);
				$("#txtUsernameContent").val (username);
				$("#selectContentType").val (contentType);
				$("#selectComponentId").val (componentId);
				if (contentType != "4" && contentType != "5") {
					$("#txtUrl").val (url);
				}				
				$("#txtTitle").val (title);
				tinymce.get('txtContent').setContent (content);
				$("#selectManagement").val (management);
				
				$("#selectPeriodStartMonth").val (periodStartMonth);
				$("#selectPeriodStartYear").val (periodStartYear);
				$("#selectPeriodEndMonth").val (periodEndMonth);
				$("#selectPeriodEndYear").val (periodEndYear);				
				
				$("#txtCreationDateContent").val (creationDate);
				$("#txtLastUpdateDateContent").val (lastUpdateDate);
				
				if (status == 1) {
					document.getElementById ("chkStatusContent").checked = true;
				} else {
					document.getElementById ("chkStatusContent").checked = false;
				}
				
				configContentType (contentType);
				configURL (contentType, url);				
			}
		  }
	    );
	}	
	
	/**
	* Deletes the content.
	*/
	function deleteContent () {
		var controllerValue  = "ContentController";
		var actionValue      = "deleteContent";
		var contentIdValue   = $("#contentId").val ();
		var contentTypeValue = $("#selectContentType").val();
		var componentIdValue = $("#selectComponentId").val();
		if (contentTypeValue != "4" && contentTypeValue != "5") {
			var urlValue     = $("#txtUrl").val();
		} else {
			var urlValue     = $("#linkUrl").text();
		}
		var result           = confirm ("Confirma exclusão?");
		if (result) {
			$.post ("../classes/controller/FrontController.php", { 
	        	  		controller:  controllerValue,
	        	  		action:      actionValue,
	        	  		id:          contentIdValue,
	        	  		contentType: contentTypeValue,
	        	  		componentId: componentIdValue,
	        	  		url:         urlValue 
			        }, function (data) {
						var countRows = parseInt (data);
						if (countRows == 1) {
							scrollBodyTop();
							showMessageByContainer (1, "message-container-content", "message-paragraph-content", "Conteúdo Excluído com Sucesso.");
							resetContentForm ();
							configContentButtons();
						}
					}
	         );
		}
	}
	
	/**
	* Configures, show and hide the content buttons.
	*/
	function configContentButtons() {
		var contentId = $("#contentId").val();
		if (!isEmpty(contentId)) {
			$("#btnUpdateContent").val ("Atualizar Conteúdo");
			$("#lblUsernameContent").show();
			$("#txtUsernameContent").show();
			$("#tab-3").css("height", "auto");			
			$("#lblCreationDateContent").show();
			$("#txtCreationDateContent").show();
			$("#lblLastUpdateDateContent").show();
			$("#txtLastUpdateDateContent").show();
			$("#btnDeleteContent").show();			
		} else {
			$("#btnUpdateContent").val ("Adicionar Conteúdo");
			$("#lblUsernameContent").hide();
			$("#txtUsernameContent").hide();
			$("#tab-3").css("height", "auto");
			$("#lblCreationDateContent").hide();
			$("#txtCreationDateContent").hide();
			$("#lblLastUpdateDateContent").hide();
			$("#txtLastUpdateDateContent").hide();			
			$("#btnDeleteContent").hide();
		}
	}
	
	/**
	* Configures, show and hide the content type containers.
	*/
	function configContentType (contentTypeValue) {
		var contentType = parseInt (contentTypeValue);
		if (contentType == 4) {
			$("#label-container-form-file-upload").show();
			$("#container-form-file-upload").show();
			$("#container-form-html-editor").hide();
			
			$("#container-form-select-period-start-month").hide();
			$("#container-form-select-period-start-year").hide();
			$("#container-form-select-period-end-month").hide();
			$("#container-form-select-period-end-year").hide();
									
			
		} else if (contentType == 5) {
			$("#label-container-form-file-upload").show();
			$("#container-form-file-upload").show();
			$("#container-form-html-editor").hide();
			
			$("#container-form-select-management").show();
			
			$("#container-form-select-period-start-month").hide();
			$("#container-form-select-period-start-year").hide();
			$("#container-form-select-period-end-month").hide();
			$("#container-form-select-period-end-year").hide();
			
		} else if (contentType == 6) {			
			$("#label-container-form-file-upload").show();
			$("#container-form-file-upload").show();
			$("#container-form-html-editor").hide();
			$("#container-form-select-management").hide();
						
			$("#container-form-select-period-start-month").show();
			$("#container-form-select-period-start-year").show();
			$("#container-form-select-period-end-month").show();
			$("#container-form-select-period-end-year").show();
		} else {
			$("#label-container-form-file-upload").hide();
			$("#container-form-file-upload").hide();
			$("#container-form-select-management").hide();
			$("#container-form-html-editor").show();
			
			$("#container-form-select-period-start-month").hide();
			$("#container-form-select-period-start-year").hide();
			$("#container-form-select-period-end-month").hide();
			$("#container-form-select-period-end-year").hide();
		}
	}
	
	/**
	* Configures, show and hide the URL containers.
	*/
	function configURL (contentTypeValue, urlValue) {
		var contentType = parseInt (contentTypeValue);
		if (contentType == 4 || contentType == 5 || contentType == 6) {
			$("#txtUrl").hide();
			var newUrl = $("#linkUrl").attr("href");
			newUrl += urlValue;			
			newUrl += "&contentType=" + contentType;
			$("#linkUrl").attr ("href", newUrl);
			$("#linkUrl").text (urlValue);
			$("#container-link-url").show();	
		} else {
			$("#txtUrl").show();
			$("#container-link-url").hide();
		}		
	}
	
	/**
	* Validates the form before submit it.
	*/
	function isValidContentForm () {
		var isValid 		   = true;
		var contentType        = $("#selectContentType").val();
		var componentId        = $("#selectComponentId").val();
		var fileUploadReadOnly = $("#fileUploadReadOnly").val();
		var content            = tinymce.get('txtContent').getContent();
		var url                = $("#txtUrl").val();
		var linkUrl            = $("#linkUrl").text();
		var title              = $("#txtTitle").val();
													
		if (isEmpty (contentType)
				||  isEmpty (componentId)
				|| (isEmpty (url) && isEmpty (linkUrl)) 
				||  isEmpty (title)
				|| (isEmpty(content) && isEmpty (fileUploadReadOnly))) {
			isValid = false;
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Preencha todos os campos corretamente.");				
		} else if (contentType == "1" && componentId != "mn_Institucional_PalavraGraoMestre") {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Menu associado inválido.");
			isValid = false;
		} else if (contentType == "2" && componentId != "mn_Institucional_Noticias") {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Menu associado inválido.");
			isValid = false;
		} else if (contentType == "3" && (componentId == "mn_Institucional_PalavraGraoMestre"
					|| componentId == "mn_Institucional_Noticias"
					|| componentId == "mn_Lojas_AvisosDocumentos")) {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Menu associado inválido.");
			isValid = false;
		} else if (contentType == "4" && componentId != "mn_Lojas_AvisosDocumentos") {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Menu associado inválido.");
			isValid = false;
		} else if (contentType == "5" && componentId != "mn_Paramaconicas_Balancete") {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Menu associado inválido.");
			isValid = false;
		} else if ((contentType == "4" || contentType == "5" || contentType == "6") && isEmpty(fileUploadReadOnly)) {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Selecione um arquivo pdf, png, jpg, jpeg ou gif.");
			isValid = false;
		} else if ((contentType != "4" && contentType != "5" && contentType != "6") && isEmpty(content)) {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-para	graph-content", "Preencha todos os campos corretamente.");
			isValid = false;
		} else if (contentType == "6" && componentId != "mn_Institucional_Balancetes") {
			scrollBodyTop();
			showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Menu associado inválido.");
			isValid = false;
		}		
		return isValid;
	}
	
	/**
	 * Handles the response from the server (ContentController.php).
	 */
	function handleContentResponse() {
		/*
			err=-3 fileInvalidExtension
			err=-2 fieldEmptyError
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError
			sc=2   updateSuccess
			sc=1   insertSuccess
		*/
		var statusCode = getUrlVars()['sc'];
		var errorCode  = getUrlVars()['err'];			
		var existsCode = false;
		if (statusCode != null) {
			scrollBodyTop();
			if (statusCode === "2") {
				showMessageByContainer (1, "message-container-content", "message-paragraph-content", "Conteúdo atualizado com sucesso.");					
			} else if (statusCode === "1") {
				showMessageByContainer (1, "message-container-content", "message-paragraph-content", "Conteúdo adicionado com sucesso.");					
			}				
			existsCode = true;			
		} else if (errorCode != null) {
			scrollBodyTop();
			if (errorCode === "-3") {
				showMessageByContainer (3, "message-container-content", "message-paragraph-content", "Arquivo inválido. Formatos permitidos: pdf, png, jpg, jpeg e gif.");
			} else if (errorCode === "-2") {
				showMessageByContainer (2, "message-container-content", "message-paragraph-content", "Preencha o campo Legenda.");					
			} else if (errorCode === "-1") {
				showMessageByContainer (3, "message-container-content", "message-paragraph-content", "Nenhum arquivo foi selecionado para upload.");
			} else if (errorCode === "0") {
				showMessageByContainer (3, "message-container-content", "message-paragraph-content", "Erro no upload, o tamanho da imagem excedeu o limite permitido.");					
			}				
			existsCode = true;				
		}

		if (existsCode) {
			resetContentForm();
	    	configContentButtons();
		}
	}