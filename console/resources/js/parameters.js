/**
 * Renders the parameters as an HTML table.
 */
function renderParametersTable () {
	var controllerValue = "ParameterController";
	var actionValue     = "renderTable";
	$.post ("../classes/controller/FrontController.php", { 
    	  		controller: controllerValue,
    	  		action:     actionValue
	        }, function (data) {
				$('#container-table-parameter').html (data);
			}
     );
}

/**
 * Checks if the form is fulfilled or not.
 * 
 * @returns {boolean} boolean containing the operation result.
 */
function isValidParameterForm () {
		var isValid = true;
		var key     = $("#txtKey").val();
		var value   = $("#txtValue").val();
		if (isEmpty (key) 
				|| isEmpty (value)) {
			isValid = false;
			scrollBodyTop();
			showMessageByContainer (2, "message-container-parameter", "message-paragraph-parameter", "Preencha todos os campos corretamente.");			
		}
		return isValid;
}

/**
 * Updates or Inserts the parameter with the form data.
 * 
 */
function updateParameter () {
	
	if (isValidParameterForm ()) {		  
		  
		  var controllerValue  = $("#controllerParameter").val();
		  var actionValue      = $("#actionParameter").val();
		  var parameterIdValue = $("#parameterId").val();
		  var keyValue    	   = $("#txtKey").val();
		  var valueValue       = $("#txtValue").val();
		  		  		  		  
		  $.post ("../classes/controller/FrontController.php", {
	  	  		controller: controllerValue,
	  	  		action:     actionValue,
				id:         parameterIdValue,
	  	  		key:   		keyValue,
	  	  		value:   	valueValue
	        }, function (data) {
	        	if (data != null) {
					if (parseInt (data) == 1) {
						scrollBodyTop();
   						showMessageByContainer (1, "message-container-parameter", "message-paragraph-parameter", "Parâmetro adicionado com sucesso.");						
					} else if (parseInt (data) == 2) {
						scrollBodyTop();
   						showMessageByContainer (1, "message-container-parameter", "message-paragraph-parameter", "Parâmetro atualizado com sucesso.");
					} else if (parseInt (data) == 0) {
						scrollBodyTop();
   						showMessageByContainer (3, "message-container-parameter", "message-paragraph-parameter", "Ocorreu um erro ao adicionar ou atualizar o Parâmetro.");						
					} else if (parseInt (data) == -1) {
						scrollBodyTop();
   						showMessageByContainer (3, "message-container-parameter", "message-paragraph-parameter", "Chave já existe, escolha outra chave.");
					} else if (parseInt (data) == -2) {
						scrollBodyTop();
   						showMessageByContainer (3, "message-container-parameter", "message-paragraph-parameter", "Valor (JSON) inválido, operação cancelada.");
					}					
				}
	        	resetParameterForm();
	        	configParameterButtons();
	        }
   	     );		  
	}	
}

/**
 * Resets the form to default values.
*/
function resetParameterForm () {
   $("#parameterId").val('');   
   $("#txtKey").val('');
   $("#txtValue").val('');      
}

/**
 * Edits or delete the parameter given its id.
*/
function editParameter (parameterId) {
	loadParameterById (parameterId);
	changeScreen ('add-parameter-container','parameter-list-container');
	configParameterButtons (parameterId);
}

/**
* Loads a parameter by its id.
*/
function loadParameterById (parameterId) {
	var controllerValue = "ParameterController";
	var actionValue     = "loadParameter";
	$.post ("../classes/controller/FrontController.php", { 
		controller: controllerValue,
    	action:     actionValue,
    	id:         parameterId
	}, function (data) {
    	var result = data;
		var valueArr = result.split("|");
		if (valueArr != null && valueArr.length > 0) {
			var parameterId = valueArr [0];
			var key         = valueArr [1];
			var value       = valueArr [2];
			$("#parameterId").val (parameterId);
			$("#txtKey").val (key);
			$("#txtValue").val (value);			
		}
	  }
    );
}

/**
* Deletes the parameter.
*/
function deleteParameter () {
	var controllerValue  = "ParameterController";
	var actionValue      = "deleteParameter";
	var parameterIdValue = $("#parameterId").val (); 
	var result           = confirm ("Confirma Exclusão?"); 
	if (result) {
		$.post ("../classes/controller/FrontController.php", { 
        	  		controller: controllerValue,
        	  		action:     actionValue,
        	  		id:         parameterIdValue
		        }, function (data) {
					var countRows = parseInt (data);
					if (countRows == 1) {
						scrollBodyTop();
   						showMessageByContainer (1, "message-container-parameter", "message-paragraph-parameter", "Parâmetro Excluído com Sucesso.");
						resetParameterForm ();
						configParameterButtons();
					}
				}
         );
	}
}

/**
* Configures, show and hide the parameter buttons.
*/
function configParameterButtons (parameterId) {
	$("#tab-2").css("height", "auto");
	if (!isEmpty (parameterId)) {
		$("#btnUpdateParameter").val ("Atualizar Parâmetro");
		$("#btnDeleteParameter").show();		
	} else {
		$("#btnUpdateParameter").val ("Adicionar Parâmetro");
		$("#btnDeleteParameter").hide();		
	}
}