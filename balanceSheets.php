<?php include 'include/lock.php';?>

<!DOCTYPE html>

<html>

	<?php include 'include/incHead.php';?>

	

	<script type="text/javascript"><!--


		$(document).ready(function() {
			renderLastUpdateDateType6 ();
			renderContentsType6 ();						
		});
	

		/**
		 * Updates the new user password.
		 * 
		 */
		function updateUserPassword () {
			if (isValidUserPasswordForm ()) {
				var controllerValue = $("#controller-change-pwd").val();
				var actionValue     = $("#action-change-pwd").val();
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

	--></script>

		

<body>	

	<?php include 'include/incChangePassword.php';?>

	<?php include 'include/incHeader.php';?>

	<section id="main-page">
		<div id="page-container">
			<article id="institucional">
				<div class="articles-content">
					<div id="column-content-container">
						<p class="top-title">Balancetes</p>
						<p class="last-update">						
							<span>Última atualização: </span><span id="sLastUpdateDate"></span>						
						</p>
						<p class="paragraph">						
							<b>Prestação de Contas</b><br><br>
							<div id="container-table-contentsType6">
							
							</div>				
						</p>
					</div>
					<?php include 'include/incFooter.php';?>
				</div>

			</article>

		</div>						

	</section>	

</body>

</html> 

