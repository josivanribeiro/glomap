<script type="text/javascript"><!--		

		$(document).ready(function () {	    		    
		    
			renderContentsTable(1);
			renderContentsPagination(1);
			renderAssociatedMenu ();			

		    $("#btnDeleteContent").click(function(event) {				  
		    	deleteContent ();			  
	      	});

			$( "#selectContentType" ).change(function() {
				configContentType ($(this).val());
			});

			$( "#selectComponentId" ).change(function() {
				setURL ();				
			});

			$( "#fileUpload" ).change(function() {
		    	  var value = $( "#fileUpload" ).val();
		    	  $("#fileUploadReadOnly").val (value);
		    	  $("#txtUrl").val (value);

		    	  var contentTypeValue = $("#selectContentType").val();

				  if (contentTypeValue == "4") {
					configURL ("4", value);
				  } else if (contentTypeValue == "5") {
					configURL ("5", value);
				  } else if (contentTypeValue == "6") {
					configURL ("6", value);
				  }
		    });			    
		    		    	
		});

		tinymce.init({
			  selector: '#txtContent',
			  file_browser_callback: function(field_name, url, type, win) {
				    win.document.getElementById(field_name).value = 'my browser value';
			  },
			  file_browser_callback_types: 'file image media',
			  file_picker_types: 'file image media',
			  height: 500,
			  theme: 'modern',
			  plugins: [
			    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			    'searchreplace wordcount visualblocks visualchars code fullscreen',
			    'insertdatetime media nonbreaking save table contextmenu directionality',
			    'emoticons template paste textcolor colorpicker textpattern imagetools'
			  ],
			  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			  toolbar2: 'print preview media | forecolor backcolor emoticons',
			  image_advtab: true,
			  templates: [
			    { title: 'Test template 1', content: 'Test 1' },
			    { title: 'Test template 2', content: 'Test 2' }
			  ],
			  content_css: [
			    '//www.tinymce.com/css/codepen.min.css'
			  ]
		});		
		
--></script>
<div id="content-list-container">
	<div id="container-message-and-button">
		<div id="container-message-table">
			* Clique uma vez no item da tabela para editar ou excluir o registro.
		</div>
		<div id="container-button-table">
			<input type="button" class="button" id="btnAddContent" name="btnAddContent" onClick="javascript:changeScreen ('add-content-container','content-list-container');configContentButtons();" value="Adicionar Conteúdo"/>	
		</div>
	</div>
	<div id="container-table-contents" class="container-table">							
	</div>
	<div id="container-table-contents-navigation" class="container-table-navigation">													
	</div>
</div>

<div id="add-content-container" style="display:none;">
	<form id="fileUploadForm" name="fileUploadForm" enctype="multipart/form-data" action="../classes/controller/FrontController.php" method="post" onSubmit="return isValidContentForm();">
		<input type="hidden" name="controller" id="controller" value="ContentController" />
		<input type="hidden" name="action" id="action" value="updateContent" />
		<input type="hidden" name="contentId" id="contentId" value="" />
		<!-- message container -->
		<div id="message-container-content" class="message-container" style="display: none;">
			<p id="message-paragraph-content" class="error-message"></p>
		</div>		
	    <div class="container-form-field">
	       	<label id="lblUsernameContent" name="lblUsernameContent" for="txtUsernameContent">Nome do usuário</label>
	       	<input id="txtUsernameContent" name="txtUsernameContent" type="text" maxlength="250" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field">
	       	<label for="selectContentType">Tipo do conteúdo</label>
	       	<select id="selectContentType" name="selectContentType" style="height:35px;">
				<option value="1">Palavra do Grão Mestre</option>
				<option value="2">Notícia</option>
				<option value="3">Conteúdo Normal</option>
				<option value="4">Avisos e Documentos</option>
				<option value="5">Balancetes Paramaçônicas</option>
				<option value="6">Balancetes</option>
			</select>
		</div>
				
		<div class="container-form-field">
	       	<label for="selectComponentId">Menu associado</label>
	       	<select id="selectComponentId" name="selectComponentId" style="height:35px;">				
			</select>
		</div>
		<div class="container-form-field">
	       	<label for="txtUrl">URL</label>
	       	<input id="txtUrl" name="txtUrl" type="text" maxlength="300" style="width: 380px;" readonly />
	       	<div id="container-link-url" style="display:none;"><a id="linkUrl" href="download.php?filename="></a></div>
		</div>
		<div class="container-form-field">
	       	<label for="txtTitle">Título</label>
	       	<input id="txtTitle" name="txtTitle" type="text" maxlength="250" style="width:910px;" />
		</div>		
		<div id="container-form-html-editor" class="container-form-field" style="width:100%;">
			<label for="txtContent">Conteúdo</label>
			<textarea id="txtContent" name="txtContent"></textarea>
		</div>
		
		<label id="label-container-form-file-upload" for="container-form-file-upload" style="display: none;">Conteúdo</label>		
		<div id="container-form-file-upload" class="container-form-upload fileUpload" style="display: none;">			
			<input type="button" class="button" id="btnfileUpload" name="btnfileUpload" value="Upload" style="width: 80px;margin-right:10px;" />
			<input id="fileUploadReadOnly" name="fileUploadReadOnly" disabled="disabled" placeholder="Selecione um arquivo pdf, png, jpg, jpeg ou gif." type="text" style="width:816px;">
			<input id="fileUpload" name="fileUpload" type="file" class="upload" />			
		</div>
		
		<div id="container-form-select-management" class="container-form-field" style="display: none;">
	       	<label for="selectManagement">Gestão</label>
	       	<select id="selectManagement" name="selectManagement" style="height:35px;">
				<option value=""></option>
				<option value="2014/2015">2014/2015</option>
				<option value="2015/2016">2015/2016</option>
				<option value="2016/2017">2016/2017</option>
				<option value="2017/2018">2017/2018</option>
				<option value="2018/2019">2018/2019</option>
				<option value="2019/2020">2019/2020</option>
			</select>
		</div>
		
		<div id="container-form-select-period-start-month" class="container-form-field" style="display: none;">
	       	<label for="selectPeriodStartMonth">Período Mês Início</label>
	       	<select id="selectPeriodStartMonth" name="selectPeriodStartMonth" style="height:35px;">
				<option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
		</div>
		
		<div id="container-form-select-period-start-year" class="container-form-field" style="display: none;">
	       	<label for="selectPeriodStartYear">Período Ano Início</label>
	       	<select id="selectPeriodStartYear" name="selectPeriodStartYear" style="height:35px;">
				<option value=""></option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select>
		</div>
		
		<div id="container-form-select-period-end-month" class="container-form-field" style="display: none;">
	       	<label for="selectPeriodEndMonth">Período Mês Fim</label>
	       	<select id="selectPeriodEndMonth" name="selectPeriodEndMonth" style="height:35px;">
				<option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
		</div>
		
		<div id="container-form-select-period-end-year" class="container-form-field" style="display: none;">
	       	<label for="selectPeriodEndYear">Período Ano Início</label>
	       	<select id="selectPeriodEndYear" name="selectPeriodEndYear" style="height:35px;">
				<option value=""></option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select>
		</div>
		
		<div class="container-form-field">
	       	<label id="lblCreationDateContent" name="lblCreationDateContent" for="txtCreationDateContent">Data de criação</label>
	       	<input id="txtCreationDateContent" name="txtCreationDateContent" type="text" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field">
	       	<label id="lblLastUpdateDateContent" name="lblLastUpdateDateContent" for="txtLastUpdateDateContent">Data da última atualização</label>
	       	<input id="txtLastUpdateDateContent" name="txtLastUpdateDateContent" type="text" style="width:380px;" readonly />								
		</div>
		<div class="container-form-field" style="margin-bottom:10px;">
			<input type="checkbox" id="chkStatusContent" name="chkStatusContent" value="1" checked>
			<label for="chkStatusContent">Ativo</label>			
		</div>
		<input type="button" class="button" id="btnBack" name="btnBack" value="Voltar" onClick="javascript:changeScreen ('content-list-container', 'add-content-container');resetContentForm ();renderContentsTable(1);renderContentsPagination(1);configScreen('tab-3', 'height', '500px');" style="width: 80px;" />
		<input type="submit" class="button" id="btnUpdateContent" name="btnUpdateContent" value="Adicionar Conteúdo" style="margin-left:11px;" />	
		<input type="button" class="button" id="btnDeleteContent" name="btnDeleteContent" value="Excluir Conteúdo" style="margin-left:11px;" />
	</form>
</div>
