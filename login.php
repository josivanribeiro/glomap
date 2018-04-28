<?php include 'include/checkHttps.php';?>
<!DOCTYPE html>
<html>
	<?php include 'include/incHead.php';?>
	
	<script type="text/javascript"><!--
	
 
		$(document).ready(function() {					  

			  setAction ();
			
			  $("#btnLogin").click(function(event) {

				  var controllerValue = $("#controller").val();
				  var actionValue     = $("#action").val();

				  var usernameValue   = $("#txtUsername").val();
				  var pwdValue        = $("#txtPwd").val();		  

				  if (isValidForm ()) {
					  $.post ("classes/controller/FrontController.php", { 
		        	  		controller: controllerValue,
		        	  		action:     actionValue,
		        	  		username:   usernameValue,
		        	  		pwd:        pwdValue
				        }, function (data) {	         
							if (data != null && parseInt (data) == 1) {
								var url = getUrlVars()['url'];
								redirectTo (url);								
							} else {
								showMessage (3, "Nome do usuário ou senha inválidos.");
							}
				        	resetForm();	        	 
		             	}
		         	  );
		         	  						
				  }						
				  
	      	   });
	   	});


		/**
	    * Sets the action of the LoginController to be called.
	    * 
	    */
		function setAction () {
			var from = getUrlVars()['from'];
			if (!isEmpty (from)) {
				var actionValue = null;				
				if (from === "csl") {
					actionValue = "doLogin";				
				} else if (from === "bs") {
					actionValue = "doBalanceSheetLogin";
				}
				$("#action").val (actionValue);
			}
		}

		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var username = $("#txtUsername").val();
			var pwd      = $("#txtPwd").val();						
			if (isEmpty (username) 
					|| isEmpty (pwd)) {
				isValid = false;
				showMessage (2, "Preencha todos os campos corretamente.");
			}
			return isValid;
	   }

	   /**
		* Resets the form to default values.
		*/
	   function resetForm () {
		   $("#txtUsername").val('');
		   $("#txtPwd").val('');	   		   
	   }
	
	--></script>
	
<body>	
	
		<div id="login-container">
		
			<div id="login-logo-container">
				<img src="/resources/images/glomap_logo.png" border="0"></img>
			</div>
			<div id="login-form-container">
				<form id="loginForm" name="loginForm">
					<input type="hidden" name="controller" id="controller" value="LoginController" />
					<input type="hidden" name="action" id="action" value="" />
					<!-- message container -->
					<div id="message-container" class="message-container" style="display: none;width: 330px;">
						<p id="message-paragraph" class="error-message"></p>
					</div>		
       				<div class="container-form-field">
       					<label id="lblUsername" name="lblUsername" for="txtUsername">Nome do usuário</label>
       					<input id="txtUsername" name="txtUsername" type="text" maxlength="50" class="login" style="width: 330px;" />								
					</div>
					<div class="container-form-field">
						<label id="lblPwd" name="lblPwd" for="txtPwd">Senha</label>
						<input id="txtPwd" name="txtPwd" type="password" class="login" maxlength="15" style="width: 330px;" />
					</div>																
					<input type="button" class="button-login" id="btnLogin" name="btnLogin" type="submit" value="Login" />								
				</form>
			</div>
		
		</div>						
		
</body>
</html> 
