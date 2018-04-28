/**
 * Renders the user's as an HTML table.
 */
function renderUsersTable () {
	var controllerValue = "UserController";
	var actionValue     = "renderTable";
	$.post ("../classes/controller/FrontController.php", { 
    	  		controller: controllerValue,
    	  		action:     actionValue
	        }, function (data) {
				$('#container-table').html (data);
			}
     );
}

/**
 * Checks if the form is fulfilled or not.
 * 
 * @returns {boolean} boolean containing the operation result.
 */
function isValidUserForm () {
		var isValid   = true;
		var username  = $("#txtUsername").val();
		var userType  = $("#selectUserType").val();
		var pwd       = $("#txtPwd").val();		
		if (isEmpty (username) 
				|| isEmpty (userType)
				|| isEmpty (pwd)) {
			isValid = false;
			showMessage (2, "Preencha todos os campos corretamente.");
		}
		return isValid;
}

/**
 * Updates or Inserts the user with the form data.
 * 
 */
function updateUser () {
	
	if (isValidUserForm ()) {		  
		  
		  var controllerValue = $("#controllerUser").val();
		  var actionValue     = $("#actionUser").val();
		  var userIdValue     =	$("#userId").val();
		  var usernameValue   = $("#txtUsername").val();
		  var userTypeValue   = $("#selectUserType").val();
		  var pwdValue        = $("#txtPwd").val();
		  var roleAdminValue  = $("#chkRoleAdmin:checked").val();
		  var statusValue     = $("#chkStatus:checked").val();
		  roleAdminValue      = (roleAdminValue != null) ? "1" : "0";
		  statusValue         = (statusValue != null) ? "1" : "0";
		  
		  $.post ("../classes/controller/FrontController.php", {
	  	  		controller: controllerValue,
	  	  		action:     actionValue,
				id:         userIdValue,
	  	  		username:   usernameValue,
	  	  		userType:   userTypeValue,
	  	  		pwd:        pwdValue,
	  	  		roleAdmin:  roleAdminValue,
	  	  		status:     statusValue
	        }, function (data) {		 
				if (data != null) {
					if (parseInt (data) == 1) {
						
						showMessage (1, "Usuário adicionado com sucesso.");
						
					} else if (parseInt (data) == 2) {

						showMessage (1, "Usuário atualizado com sucesso.");

					} else if (parseInt (data) == 0) {

						showMessage (3, "Ocorreu um erro ao adicionar ou atualizar o Usuário.");
						
					} else if (parseInt (data) == -1) {

						showMessage (3, "Já existe um Usuário com este nome, escolha outro nome do usuário.");
						
					}
				}
	        	resetUserForm();
	        	configUserButtons();
	        }
   	     );		  
	}	
}

/**
 * Updates the new user password.
 * 
 */
function updateUserPassword () {
	
	if (isValidUserPasswordForm ()) {
		var controllerValue = $("#controllerChangePwd").val();
		var actionValue     = $("#actionChangePwd").val();
		var newPwdValue 	= $("#txtNewPwd").val();
		
		$.post ("../classes/controller/FrontController.php", {
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
			resetUserPasswordForm();        	
          }
	   );		
	}
}

/**
 * Checks if the new password is valid or not.
 * 
 * @returns {boolean} boolean containing the operation result.
 */
function isValidUserPasswordForm () {
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
function resetUserPasswordForm () {
   $("#txtNewPwd").val('');
   $("#txtNewPwdConfirm").val('');      
}

/**
 * Resets the form to default values.
*/
function resetUserForm () {
   $("#userId").val('');   
   $("#txtUsername").val('');
   $("#selectUserType").val('');
   $("#txtPwd").val('');
   document.getElementById ("chkRoleAdmin").checked = false;
   document.getElementById ("chkStatus").checked = true;   
}

/**
 * Edits or delete the user given its id.
*/
function editUser (userId) {
	$("#userId").val(userId);
	loadUser ();
	configUserButtons();
	changeScreen ('add-user-container','user-list-container');	
}

/**
* Loads an user if when its id is set.
*/
function loadUser () {
	var userId = $("#userId").val();
	if (!isEmpty(userId)) {
		loadUserById (userId);
	}	
}

/**
* Loads an user by its id.
*/
function loadUserById (userId) {
	var controllerValue = "UserController";
	var actionValue     = "loadUser";
	$.post ("../classes/controller/FrontController.php", { 
		controller: controllerValue,
    	action:     actionValue,
    	id:         userId
	}, function (data) {
    	var result = data; 
		var valueArr = result.split(",");
		if (valueArr != null && valueArr.length > 0) {
			var userId    = valueArr [0];
			var username  = valueArr [1];
			var userType  = valueArr [2];
			var roleAdmin = valueArr [3];
			var status    = valueArr [4];
			$("#userId").val (userId);
			$("#txtUsername").val (username);
			$("#selectUserType").val (userType);
			if (roleAdmin == 1) {
				document.getElementById ("chkRoleAdmin").checked = true;
			} else {
				document.getElementById ("chkRoleAdmin").checked = false;
			}
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
* Deletes the user.
*/
function deleteUser () {
	var controllerValue = "UserController";
	var actionValue     = "deleteUser";
	var userIdValue     = $("#userId").val (); 
	var result          = confirm ("Confirma Exclusão?"); 
	if (result) {
		$.post ("../classes/controller/FrontController.php", { 
        	  		controller: controllerValue,
        	  		action:     actionValue,
        	  		id:         userIdValue
		        }, function (data) {
					var countRows = parseInt (data);
					if (countRows == 1) {
						showMessage (1, "Usuário Excluído com Sucesso.");
						resetUserForm ();
						configUserButtons();
					}
				}
         );
	}
}

/**
* Configures, show and hide the user buttons.
*/
function configUserButtons() {
	var userId = $("#userId").val();
	if (!isEmpty(userId)) {
		$("#btnUpdateUser").val ("Atualizar Usuário");
		$("#btnDeleteUser").show();
	} else {
		$("#btnUpdateUser").val ("Adicionar Usuário");
		$("#btnDeleteUser").hide();
	}
}