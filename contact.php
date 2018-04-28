<!DOCTYPE html>
<html>	
	<?php include 'include/incHead.php';?>
	
	<script type="text/javascript"><!--
	
 
		$(document).ready(function() {		  

			  $("#btnSend").click(function(event) {

				  var controllerValue = $("#controller").val();
				  var actionValue     = $("#action").val();

				  var nameValue       = $("#txtName").val();
				  var emailValue      = $("#txtEmail").val();
				  var subjectValue    = $("#txtSubject").val();
				  var messageValue    = $("#txtMessage").val();

				  if (isValidForm ()) {
					  $.post ("classes/controller/FrontController.php", { 
		        	  		controller: controllerValue,
		        	  		action:     actionValue,
		        	  		name:       nameValue,
		        	  		email:      emailValue,
		        	  		subject:    subjectValue,
		        	  		message:    messageValue
				        }, function (data) {				 
							if (data != null && parseInt (data) == 1) {
								showMessage (1, "Contato enviado com sucesso.");
							} else {
								showMessage (3, "Ocorreu um erro durante o envio.");
							}
				        	resetForm();	        	 
		             	}
		         	  );
		         	  						
				  }						
				  
	      	   });
	   	});

		/**
	    * Checks if the form is fulfilled or not.
	    * 
	    * @returns {boolean} boolean containing the operation result.
	    */
	   function isValidForm () {
			var isValid  = true;
			var name     = $("#txtName").val();
			var email    = $("#txtEmail").val();
			var subject  = $("#txtSubject").val();
			var message  = $("#txtMessage").val();			
			if (isEmpty (name) 
					|| isEmpty (email)
					|| !isValidEmail (email)
					|| isEmpty (subject)
					|| isEmpty (message)) {
				isValid = false;
				showMessage (2, "Preencha todos os campos corretamente.");
			}
			return isValid;
	   }

	   /**
		* Resets the form to default values.
		*/
	   function resetForm () {
		   $("#txtName").val('');
		   $("#txtEmail").val('');
		   $("#txtSubject").val('');
		   $("#txtMessage").val('');		   
	   }
 
	
	--></script>	
	
<body>	
	<?php include 'include/incHeader.php';?>
	<section id="main-page">
		<div id="page-container">
			<article id="contact">
				<div class="articles-content">					
					<div id="two-columns-container">
						<div id="two-column-container">
							<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="473" height="566" src="https://maps.google.com/maps?hl=pt&q=Grande Loja Maçônica do Amapá - GLOMAP&ie=UTF8&t=m&z=16&iwloc=B&output=embed">
								<div>
									<small>
										<a href="http://embedgooglemaps.com">
										embed google map
										</a>
									</small>
								</div>
								<div>
									<small>
										<a href="http://dronefreaks.org/">drones</a>
									</small>
								</div>
							</iframe>							
						</div>
						<div id="two-column-form-container">							
							<p style="font-size: 14px;">
								<b>GLOMAP</b>
							</p>
							<br>
							<p>
								<b>Endereço:</b> Av. Raimundo Álvares Costa, 340, Centro, CEP 68900-074, Macapá-AP.
							</p>
							<p>
								<b>Telefone:</b> (96) 3222-2752								
							</p>
							<p id="contact-email-container">
								<b>Emails:</b> <a href="mailto:glomapap@uol.com.br" target="_blank">glomapap@uol.com.br</a><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:glomap@glomap.org.br" target="_blank">glomap@glomap.org.br</a><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:contato@glomap.org.br" target="_blank">contato@glomap.org.br</a>																
							</p>							
							<p>
								<b>Horário de Expediente:</b> Segunda a Sexta, 14h às 18h.
							</p>
							<br/>
							<form id="contactForm" name="contactForm" class="contactForm">
								<input type="hidden" name="controller" id="controller" value="ContactController" />
								<input type="hidden" name="action" id="action" value="sendEmail" />
								<!-- message container -->
								<div id="message-container" class="message-container" style="display: none;">
									<p id="message-paragraph" class="error-message"></p>
								</div>		
       							<div class="container-form-field">
       								<input id="txtName" name="txtName" type="text" maxlength="50" placeholder="Nome (obrigatório)" />								
								</div>
								<div class="container-form-field">
									<input id="txtEmail" name="txtEmail" type="text" maxlength="50" placeholder="Email (obrigatório)" />
								</div>
								<div class="container-form-field">
									<input id="txtSubject" name="txtSubject" type="text" maxlength="50" placeholder="Assunto (obrigatório)" />
								</div>
								<div class="container-form-field">
									<textarea id="txtMessage" name="txtMessage" cols="30" rows="3" placeholder="Mensagem (obrigatório)"></textarea>									
								</div>								
								<input type="button" class="button" id="btnSend" name="btnSend" value="Enviar"/>								
							</form>
						</div>
					</div>
										
					<?php include 'include/incFooter.php';?>
					
				</div>
			</article>
		</div>						
	</section>	
</body>
</html> 
