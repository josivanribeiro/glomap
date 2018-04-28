<?php include 'include/lock.php';?>

<!DOCTYPE html>

<html>

	<?php include 'include/incHead.php';?>

	

	<script type="text/javascript"><!--



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

						<p class="last-update">Última atualização: 25/09/2016 20:18</p>

						<p class="paragraph">

							<b>Prestação de Contas</b><br><br>

														

							<table id="table-common" cellpadding="0" cellspacing="0" border="0">

								<tr>

									<td><b>Item</b></td>

									<td><b>Descrição</b></td>

									<td><b>Período</b></td>

									<td><b>Anexo</b> <img src="/resources/images/pdf_icon.png" style="vertical-align: middle;" /></td>

								</tr>

								<tr>

									<td>1</td>

									<td>Per Capita</td>

									<td>08/2016 a 10/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Per_Capita_Prestacao_de_conta_08_2016_a_10_2016.pdf">Per_Capita_Prestacao_de_conta_08_2016_a_10_2016.pdf</a></div></td>

								</tr>
                                
                                <tr>

									<td>2</td>

									<td>Palácio Maçônico</td>

									<td>08/2016 a 10/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Palacio_Maconico_Prestacao_de_Conta_08_2016_a_10_2016.pdf">Palacio_Maconico_Prestacao_de_Conta_08_2016_a_10_2016.pdf</a></div></td>

								</tr> 

                                <tr>

									<td>3</td>

									<td>Pecúlio Maçônico</td>

									<td>08/2016 a 10/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Peculio_Maconico_Prestacao_de_Conta_08_2016_a_10_2016.pdf">Peculio_Maconico_Prestacao_de_Conta_08_2016_a_10_2016.pdf</a></div></td>

								</tr> 

								<tr>

									<td>4</td>

									<td>Per Capita</td>

									<td>05/2016 a 07/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Per_Capita_Prestacao_de_conta_05_2016_a_07_2016.pdf">Per_Capita_Prestacao_de_conta_05_2016_a_07_2016.pdf</a></div></td>

								</tr>
                                
                                <tr>

									<td>5</td>

									<td>Palácio Maçônico</td>

									<td>05/2016 a 07/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Palacio_Maconico_Prestacao_de_Conta_05_2016_a_07_2016.pdf">Palacio_Maconico_Prestacao_de_Conta_05_2016_a_07_2016.pdf</a></div></td>

								</tr> 

                                <tr>

									<td>6</td>

									<td>Pecúlio Maçônico</td>

									<td>05/2016 a 07/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Peculio_Maconico_Prestacao_de_Conta_05_2016_a_07_2016.pdf">Peculio_Maconico_Prestacao_de_Conta_05_2016_a_07_2016.pdf</a></div></td>

								</tr> 

								<tr>

									<td>7</td>

									<td>Hospitalaria</td>

									<td>05/2016 a 07/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Hospitalaria_Prestacão_de_Conta_05_2016_a_07_2016.pdf">Hospitalaria_Prestacão_de_Conta_05_2016_a_07_2016.pdf</a></div></td>

								</tr>
								
								<tr>

									<td>8</td>

									<td>Per Capita</td>

									<td>02/2016 a 04/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Per_Capita_Prestaca_de_conta_02_2016_a_04_2016.pdf">Per_Capita_Prestaca_de_conta_02_2016_a_04_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>9</td>

									<td>Pecúlio Maçônico</td>

									<td>02/2016 a 04/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Peculio_Maconico_Prestacao_de_Conta_02_2016_a_04_2016.pdf">Peculio_Maconico_Prestacao_de_Conta_02_2016_a_04_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>10</td>

									<td>Hospitalaria</td>

									<td>03/2016 a 05/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Hospitalaria_Prestacao_de_Conta_03_2016_a_05_2016.pdf">Hospitalaria_Prestacao_de_Conta_03_2016_a_05_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>11</td>

									<td>Palácio Maçônico</td>

									<td>02/2016 a 04/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Palacio_Maconico_Prestacao_de_Conta_02_2016_a_04_2016.pdf">Palacio_Maconico_Prestacao_de_Conta_02_2016_a_04_2016.pdf</a></div></td>

								</tr>								

								<tr>

									<td>12</td>

									<td>Per Capita</td>

									<td>12/2015 a 01/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Per_Capita_Prestação_de_conta_12_2015_a_01_2016.pdf">Per_Capita_Prestação_de_conta_12_2015_a_01_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>13</td>

									<td>Pecúlio Maçônico</td>

									<td>12/2015 a 01/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Pecúlio_Maçônico_Prestação_de_Conta_12_2015_a_01_2016.pdf">Pecúlio_Maçônico_Prestação_de_Conta_12_2015_a_01_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>14</td>

									<td>Hospitalaria</td>

									<td>12/2015 a 02/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Hospitalaria_Prestação_de_Conta_12_2015_a_02_2016.pdf">Hospitalaria_Prestação_de_Conta_12_2015_a_02_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>15</td>

									<td>Palácio Maçônico</td>

									<td>12/2015 a 01/2016</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Palácio_Maçônico_Prestação_de_Conta_12_2015_a_01_2016.pdf">Palácio_Maçônico_Prestação_de_Conta_12_2015_a_01_2016.pdf</a></div></td>

								</tr>

								<tr>

									<td>16</td>

									<td>Per Capita</td>

									<td>09/2015 a 11/2015</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Per_Capita_09_2015_a_11_2015.pdf">Per_Capita_09_2015_a_11_2015.pdf</a></div></td>

								</tr>

								<tr>

									<td>17</td>

									<td>Pecúlio Maçônico</td>

									<td>09/2015 a 11/2015</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Peculio_Maconico_Prestacao_Conta_09_2015_a_11_2015.pdf">Peculio_Maconico_Prestacao_Conta_09_2015_a_11_2015.pdf</a></div></td>

								</tr>

								<tr>

									<td>18</td>

									<td>Hospitalaria</td>

									<td>09/2015 a 11/2015</td>

									<td><div id="download-container"><a href="download.php?contentType=6&filename=Hospitalaria_Prestacao_Conta_09_2015_a_11_2015.pdf">Hospitalaria_Prestacao_Conta_09_2015_a_11_2015.pdf</a></div></td>

								</tr>								

							</table>

							<br>					

						</p>

						

					</div>

					

					<?php include 'include/incFooter.php';?>

					

				</div>

			</article>

		</div>						

	</section>	

</body>

</html> 

