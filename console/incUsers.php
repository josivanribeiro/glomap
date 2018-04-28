<script type="text/javascript"><!--		

		$(document).ready(function () {			

		    renderUsersTable();
		    
		    $("#btnUpdateUser").click(function(event) {				  
		    	updateUser ();				  
	      	});

		    $("#btnDeleteUser").click(function(event) {				  
		    	deleteUser ();			  
	      	});
	      		
		});
		
--></script>

<div id="user-list-container">
	<div id="container-message-and-button">
		<div id="container-message-table">
			* Clique uma vez no item da tabela para editar ou excluir o registro.
		</div>
		<div id="container-button-table">
			<input type="button" class="button" id="btnAddUser" name="btnAddUser" onClick="javascript:changeScreen ('add-user-container','user-list-container');configUserButtons();" value="Adicionar Usuário"/>	
		</div>
	</div>
	<div id="container-table" class="container-table">							
	</div>	
	
</div>

<div id="add-user-container" style="display:none;">
	<form id="userForm" name="userForm">
		<input type="hidden" name="controllerUser" id="controllerUser" value="UserController" />
		<input type="hidden" name="actionUser" id="actionUser" value="updateUser" />
		<input type="hidden" name="userId" id="userId" value="" />
		<!-- message container -->
		<div id="message-container" class="message-container" style="display: none;">
			<p id="message-paragraph" class="error-message"></p>
		</div>		
	    <div class="container-form-field">
	       	<label id="lblUsername" name="lblUsername" for="txtUsername">Nome do usuário</label>
	       	<input id="txtUsername" name="txtUsername" type="text" maxlength="50" style="width:380px;" />								
		</div>
		<div class="container-form-field">
			<label id="lblUserType" name="lblUserType" for="selectUserType">Tipo de usuário</label>
			<select id="selectUserType" style="height:35px;">
				<option value="A">Todos os Acessos</option>
				<option value="B">Acesso a Balancetes</option>
				<option value="C">Acesso ao Console</option>			
			</select>			
		</div>
		<div class="container-form-field" style="margin-bottom:10px;">
			<label id="lblPwd" name="lblPwd" for="txtPwd">Senha</label>
			<input id="txtPwd" name="txtPwd" type="password" maxlength="15" style="width:380px;" />
		</div>
		<div class="container-form-field" style="mar380pxgin-bottom:10px;">
			<input type="checkbox" id="chkRoleAdmin" name="chkRoleAdmin" value="1"> 
			<label for="chkRoleAdmin">Administrador</label>							
		</div>
		<div class="container-form-field" style="margin-bottom:10px;">
			<input type="checkbox" id="chkStatus" name="chkStatus" value="1" checked>
			<label for="chkStatus">Ativo</label>									
		</div>
		<input type="button" class="button" id="btnBack" name="btnBack" value="Voltar" onClick="javascript:changeScreen ('user-list-container', 'add-user-container');resetUserForm ();renderUsersTable();" style="width: 80px;" />
		<input type="button" class="button" id="btnUpdateUser" name="btnUpdateUser" value="Adicionar Usuário" style="margin-left:11px;" />	
		<input type="button" class="button" id="btnDeleteUser" name="btnDeleteUser" value="Excluir Usuário" style="margin-left:11px;" />
	</form>
</div>
