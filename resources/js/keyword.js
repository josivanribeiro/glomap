
/**
 * Checks the keyword.
 */
function checkKeyword () {
		
	if (isValidKeywordForm ()) {
		var controllerValue = $("#controllerKeyword").val();
		var actionValue     = $("#actionKeyword").val();
		var keywordValue 	= $("#txtKeyword").val();
							
		$.post ("classes/controller/FrontController.php", {
  	  		controller: controllerValue,
  	  		action:     actionValue,
			keyword:    keywordValue
  	  		
        }, function (data) {		 
			if (data != null) {
				if (parseInt (data) == 1) {
					var page = "";
					if (actionValue == "checkNoticesAndDocumentsKeyword") {						
						page = "noticesAndDocuments.php";							
					} else if (actionValue == "checkBalanceSheetPmKeyword") {						
						page = "balanceSheetsPm.php";						
					}					
					redirectTo (page);					
				} else if (parseInt (data) == 0) {
					showMessageByContainer (3, "message-container-keyword", "message-paragraph-keyword", "Palavra-Chave inválida.");
				}
			}
			resetKeywordForm();
          }
	   );		
	}
}

/**
 * Checks if the keyword exists, then redirects to noticesAndDocuments page.
 */
function checkNoticesAndDocumentsKeywordExists () {
	var controllerValue = "LoginController";
	var actionValue     = "checkNoticesAndDocumentsKeywordExists";
	
	$.post ("classes/controller/FrontController.php", {
	  		controller: controllerValue,
	  		action:     actionValue	  		
    }, function (data) {    	
    	if (data != null) {
			if (parseInt (data) == 1) {
				redirectTo ('noticesAndDocuments.php');		
			} else if (parseInt (data) == 0) {
								
				var action = "checkNoticesAndDocumentsKeyword";
				$("#actionKeyword").val(action);
				
				configModal ('mask-keyword','#dialog-keyword');
			}
		}
      }
   );
}

/**
 * Checks if the keyword exists, then redirects to balanceSheetPm page.
 */
function checkBalanceSheetPmKeywordExists () {
	var controllerValue = "LoginController";
	var actionValue     = "checkBalanceSheetPmKeywordExists";
	
	$.post ("classes/controller/FrontController.php", {
	  		controller: controllerValue,
	  		action:     actionValue	  		
    }, function (data) {		 
		if (data != null) {
			if (parseInt (data) == 1) {
				redirectTo ('balanceSheetsPm.php');		
			} else if (parseInt (data) == 0) {
				
				var action = "checkBalanceSheetPmKeyword";
				$("#actionKeyword").val(action);
				
				configModal ('mask-keyword','#dialog-keyword');
			}
		}
      }
   );
}

/**
 * Checks if the keyword is valid or not.
 * 
 * @returns {boolean} boolean containing the operation result.
 */
function isValidKeywordForm () {
	var isValid = true;
	var keyword = $("#txtKeyword").val();
	if (isEmpty (keyword)) {
		isValid = false;
		showMessageByContainer (2, "message-container-keyword", "message-paragraph-keyword", "Preencha a Palavra-Chave corretamente.");			
	}
	return isValid;
}

/**
 * Resets the keyword form to default values.
*/
function resetKeywordForm () {
   $("#txtKeyword").val('');         
}
