<div id="boxes">
	<div id="dialog" class="window">
		<a href="#" class="close">Fechar [X]</a><br />		
		<form id="changePasswordForm" name="changePasswordForm">
			<input type="hidden" name="controllerChangePwd" id="controllerChangePwd" value="UserController" />
			<input type="hidden" name="actionChangePwd" id="actionChangePwd" value="updateUserPassword" />
			<!-- message container -->
			<div id="message-container-change-pwd" class="message-container" style="width: 308px;display: none;">
				<p id="message-paragraph-change-pwd" class="error-message"></p>
			</div>
			<div class="container-form-field">
       			<label for="txtNewPwd">Nova Senha</label>
       			<input id="txtNewPwd" name="txtNewPwd" type="password" maxlength="15" style="width: 308px;" />								
			</div>
			<div class="container-form-field">
				<label for="txtNewPwdConfirm">Confirmação da Nova Senha</label>
				<input id="txtNewPwdConfirm" name="txtNewPwdConfirm" type="password" maxlength="15" style="width: 308px;" />
			</div>			       		
			<input type="button" class="button" id="btnChangePwd" name="btnChangePwd" onClick="javascript:updateUserPwd();" value="Alterar Senha"/>								
		</form>
		
	</div>
	<div id="mask"></div>
</div>