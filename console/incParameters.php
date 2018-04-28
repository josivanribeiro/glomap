<script type="text/javascript"><!--		

		$(document).ready(function () {			

		    renderParametersTable();
		    
		    $("#btnUpdateParameter").click(function(event) {				  
		    	updateParameter ();
	      	});

		    $("#btnDeleteParameter").click(function(event) {				  
		    	deleteParameter ();
	      	});
	      		
		});
		
--></script>

<div id="parameter-list-container">
	<div id="container-message-and-button">
		<div id="container-message-table">
			* Clique uma vez no item da tabela para editar ou excluir o registro.
		</div>
		<div id="container-button-table">
			<input type="button" class="button" id="btnAddParameter" name="btnAddParameter" onClick="javascript:changeScreen ('add-parameter-container','parameter-list-container');configParameterButtons();configScreen('tab-2','height', 'auto');" value="Adicionar Parâmetro"/>	
		</div>
	</div>
	<div id="container-table-parameter" class="container-table">							
	</div>	
	
</div>

<div id="add-parameter-container" style="display:none;">
	<form id="parameterForm" name="parameterForm">
		<input type="hidden" name="controllerParameter" id="controllerParameter" value="ParameterController" />
		<input type="hidden" name="actionParameter" id="actionParameter" value="updateParameter" />
		<input type="hidden" name="parameterId" id="parameterId" value="" />
		<!-- message container -->
		<div id="message-container-parameter" class="message-container-parameter" style="display: none;">
			<p id="message-paragraph-parameter" class="error-message"></p>
		</div>		
	    <div class="container-form-field" style="margin-top:20px;">
	       	<label id="lblKey" name="lblKey" for="txtKey">Chave</label>
	       	<input id="txtKey" name="txtKey" type="text" maxlength="100" style="width:913px;" />								
		</div>
		<div class="container-form-field">
			<label id="lblValue" name="lblValue" for="txtValue">Valor (JSON)</label>
	       	<textarea id="txtValue" name="txtValue" class="code-editor" cols="70" rows="50" style="width:913px;"></textarea>
		</div>
		<input type="button" class="button" id="btnBack" name="btnBack" value="Voltar" onClick="javascript:changeScreen ('parameter-list-container', 'add-parameter-container');resetParameterForm ();renderParametersTable();configScreen('tab-2','height', '500px');" style="width: 80px;" />
		<input type="button" class="button" id="btnUpdateParameter" name="btnUpdateParameter" value="Adicionar Parâmetro" style="margin-left:11px;" onClick="javascript:configParameterButtons();" />	
		<input type="button" class="button" id="btnDeleteParameter" name="btnDeleteParameter" value="Excluir Parâmetro" style="margin-left:11px;" />
	</form>
</div>
