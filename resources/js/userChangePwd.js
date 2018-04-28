
/**
 * Updates the new user password.
 * 
 */
function updateUserPwd () {
		
	if (isValidUserPwdForm ()) {
		var controllerValue = $("#controllerChangePwd").val();
		var actionValue     = $("#actionChangePwd").val();
		var newPwdValue 	= $("#txtNewPwd").val();
				
		$.post ("classes/controller/FrontController.php", {
  	  		controller: controllerValue,
  	  		action:     actionValue,
			pwd:        newPwdValue
  	  		
        }, function (data) {		 
			if (data != null) {
				if (parseInt (data) == 1) {					
					showMessageByContainer (1, "message-container-change-pwd", "message-paragraph-change-pwd", "Senha alterada com sucesso.");										
				} else if (parseInt (data) == 0) {
					showMessageByContainer (3, "message-container-change-pwd", "message-paragraph-change-pwd", "Ocorreu um erro ao atualizar a Senha.");
				}
			}
			resetUserPwdForm();        	
          }
	   );		
	}
}

/**
 * Checks if the new password is valid or not.
 * 
 * @returns {boolean} boolean containing the operation result.
 */
function isValidUserPwdForm () {
		var isValid       = true;
		var newPwd        = $("#txtNewPwd").val();
		var newPwdConfirm = $("#txtNewPwdConfirm").val();
		if (isEmpty (newPwd) 
				|| isEmpty (newPwdConfirm)) {
			isValid = false;
			showMessageByContainer (2, "message-container-change-pwd", "message-paragraph-change-pwd", "Preencha todos os campos corretamente.");			
		} else if (newPwd != newPwdConfirm) {
			isValid = false;
			showMessageByContainer (2, "message-container-change-pwd", "message-paragraph-change-pwd", "As senhas devem ser iguais.");			
		}
		return isValid;
}

/**
 * Resets the password form to default values.
*/
function resetUserPwdForm () {
   $("#txtNewPwd").val('');
   $("#txtNewPwdConfirm").val('');      
}
