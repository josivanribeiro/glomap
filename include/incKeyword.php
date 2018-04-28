<div id="boxes-keyword">
	<div id="dialog-keyword" class="window-keyword">
		<a href="#" class="close">Fechar [X]</a><br />		
		<form id="keywordForm" name="keywordForm">
			<input type="hidden" name="controllerKeyword" id="controllerKeyword" value="LoginController" />
			<input type="hidden" name="actionKeyword" id="actionKeyword" value="checkKeyword" />
			<!-- message container -->
			<div id="message-container-keyword" class="message-container" style="width: 308px;display: none;">
				<p id="message-paragraph-keyword" class="error-message"></p>
			</div>
			<div class="container-form-field">
       			<label for="txtKeyword">Palavra-Chave</label>
       			<input id="txtKeyword" name="txtKeyword" type="password" maxlength="15" style="width: 308px;" />
			</div>
			<input type="button" class="button" id="btnKeyword" name="btnKeyword" onClick="javascript:checkKeyword();" value="Enviar"/>								
		</form>
		
	</div>
	<div id="mask-keyword"></div>
</div>