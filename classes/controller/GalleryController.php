<?php

/**
 * Gallery Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class GalleryController {
	
	private $galleryBO;
	private $userBO;
	private $config;
	
	public function __construct() {
		
	}
	
	/**
	 * Inserts or updates a new gallery.
	 * 
	 * @return void
	 */																																									
	public function updateGallery() {
		/*																																																																																																																																																																																																																																																																																																																																										
			err=-3 fileInvalidExtension
			err=-2 fieldEmptyError
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError
			sc=2   updateSuccess
			sc=3   insertSuccess
		*/
		$page = "../../console/main.php?tab=4";
		
		$id          = $_REQUEST['galleryId'];
		$loggedUser  = Utils::getLoggedUser();
		$userId      = $loggedUser->getUSER_ID();
		$legend      = $_REQUEST['txtLegend'];
		$description = $_REQUEST['txtDescription'];
		$status      = (isset ($_REQUEST['chkStatus']) ? 1 : 0);
		
		$validateFormReturn = $this->validateForm ($id);
		
		if ($validateFormReturn === 1) {	
						
			$imageVOArr = array();						
			for ($i = 1; $i <= 10; $i++) {
				
				if (!empty($_FILES['fileImageUpload' . $i]['tmp_name'])) {

					$imageStream = fopen ($_FILES['fileImageUpload' . $i]['tmp_name'], 'rb');
					$imageSizeArr = getimagesize ($_FILES['fileImageUpload' . $i]['tmp_name']);
					$imageWidth  = $imageSizeArr[0];
										
					if ($imageWidth > 960) {						
						$resizedImageArr = Utils::resizeImage ('fileImageUpload' . $i, 960);
						$imageStream = $resizedImageArr[0];
						$imageWidth  = $resizedImageArr[1];
						$imageHeight = $resizedImageArr[2];
						$imageSize   = $resizedImageArr[3];						
					} else {
						$imageHeight = $imageSizeArr[1];
						$imageSize   = $_FILES['fileImageUpload' . $i]["size"];	
					}
					
					$imagelegend = $_REQUEST['txtImageLegend' . $i];
					$name        = $_FILES['fileImageUpload' . $i]['name'];
					$coverImage  = (isset($_REQUEST['chkCoverImage' . $i]) ? 1 : 0) ;
																				
					$imageThumbArr    =  Utils::resizeImage ('fileImageUpload' . $i, 200);
					$imageThumbStream = $imageThumbArr[0];
					$imageThumbWidth  = $imageThumbArr[1];
					$imageThumbHeight = $imageThumbArr[2];
					$imageThumbSize   = $imageThumbArr[3];
					
					$imageVO = new ImageVO();
					$imageVO->setIMAGE ($imageStream);
					$imageVO->setIMAGE_WIDTH ($imageWidth);
					$imageVO->setIMAGE_HEIGHT ($imageHeight);
					$imageVO->setIMAGE_SIZE ($imageSize);
					$imageVO->setIMAGE_THUMB ($imageThumbStream);
					$imageVO->setIMAGE_THUMB_WIDTH ($imageThumbWidth);
					$imageVO->setIMAGE_THUMB_HEIGHT ($imageThumbHeight);
					$imageVO->setIMAGE_THUMB_SIZE ($imageThumbSize);
					$imageVO->setNAME ($name);
					$imageVO->setLEGEND ($imagelegend);
					$imageVO->setCOVER_IMAGE ($coverImage);
									
					array_push ($imageVOArr, $imageVO);
								
				}
												
			}
						
			$galleryVO  = new GalleryVO();
			$galleryVO->setGALLERY_ID  ($id);
			$galleryVO->setUSER_ID     ($userId);
			$galleryVO->setLEGEND      ($legend);
			$galleryVO->setDESCRIPTION ($description);
			$galleryVO->setIMAGEVO_ARR ($imageVOArr);
			
			$galleryVO->setSTATUS 	  ($status);
			$this->galleryBO = new galleryBO();
			
			if ($id == null) {
				$newGalleryVO = $this->galleryBO->insert ($galleryVO);			
				if ($newGalleryVO->getGALLERY_ID() > 0) {
					$page .= "&sc=3";
				}
			} else {
				$rowCount = $this->galleryBO->update ($galleryVO);
				if ($rowCount > 0) {
					$page .= "&sc=2";
				}
			}
					
		} else if ($validateFormReturn === -3) {
			$page .= "&err=-3";
		} else if ($validateFormReturn === -2) {
			$page .= "&err=-2";
		} else if ($validateFormReturn === -1) {
			$page .= "&err=-1";
		} else if ($validateFormReturn === 0) {
			$page .= "&err=0";
		}	 
				
		header ('Location: ' . $page);
	}	
	
	/**
	 * Loads a gallery.
	 * 
	 * @return void
	 */
	public function loadGallery() {
		$galleryId = $_REQUEST['id'];
		$galleryVO = new GalleryVO();
		$galleryVO->setGALLERY_ID ($galleryId);				
		$this->galleryBO = new galleryBO();
		$newGalleryVO = $this->galleryBO->findById ($galleryVO);

		$this->userBO = new UserBO();
		$userVO = new UserVO();
		$userVO->setUSER_ID ($newGalleryVO->getUSER_ID());
		$userVO = $this->userBO->findById ($userVO);

		$imageVOArr = $newGalleryVO->getIMAGEVO_ARR();
		
		$this->config = new Config();
		foreach ($imageVOArr as $imageVO) {
			$filename = $this->config->__get("file.upload.thumb.folder") . $imageVO->getNAME();
			file_put_contents ($filename, $imageVO->getIMAGE_THUMB());
			chmod ($filename, 0777);
		}
		
		echo $newGalleryVO->getGALLERY_ID()
			 . "|" . $userVO->getUSERNAME ()
			 . "|" . $newGalleryVO->getLEGEND ()
			 . "|" . $newGalleryVO->getDESCRIPTION ()
			 . "|" . $this->renderImageGallery ($imageVOArr)
			 . "|" . Utils::getFormattedDatetime ($newGalleryVO->getCREATION_DT())
			 . "|" . Utils::getFormattedDatetime ($newGalleryVO->getLAST_UPDATE_DT())
			 . "|" . $newGalleryVO->getSTATUS ();
	}
	
	/**
	 * Loads a gallery for the gallery page.
	 * 
	 * @return void
	 */
	public function loadGalleryForPage() {
		$imageNames   = null;
		$imageLegends = null;
		$galleryId    = $_REQUEST['id'];
				
		$galleryVO = new GalleryVO();
		$galleryVO->setGALLERY_ID ($galleryId);				
		$this->galleryBO = new galleryBO();
		$newGalleryVO = $this->galleryBO->findById ($galleryVO);

		$imageVOArr = $newGalleryVO->getIMAGEVO_ARR();
		
		$this->config = new Config();
		foreach ($imageVOArr as $imageVO) {
			$filenameThumb = $this->config->__get("file.upload.page.thumb.folder") . $imageVO->getNAME();
			$filename = $this->config->__get("file.upload.page.folder") . $imageVO->getNAME();						
			file_put_contents ($filenameThumb, $imageVO->getIMAGE_THUMB());
			file_put_contents ($filename, $imageVO->getIMAGE());
			chmod ($filenameThumb, 0777);
			chmod ($filename, 0777);			
			$imageNames   .= $imageVO->getNAME() . "^";
			$imageLegends .= $imageVO->getLEGEND() . "^";
		}
		
		echo $newGalleryVO->getGALLERY_ID()
			 . "|" . $newGalleryVO->getLEGEND ()
			 . "|" . Utils::getFormattedHourMinuteDatetime ($newGalleryVO->getLAST_UPDATE_DT())
			 . "|" . $newGalleryVO->getDESCRIPTION ()
			 . "|" . $imageNames
			 . "|" . $imageLegends
			 . "|" . $this->renderImageGalleryForPage ($imageVOArr);
	}
	
	/**
	 * Loads the last three galleries.
	 * 
	 * @return void
	 */
	public function loadLastThreeGalleries() {
		$result = null;
		$this->galleryBO = new galleryBO();
		$galleryVOArr = $this->galleryBO->findLastThree();					
		$this->config = new Config();		
		foreach ($galleryVOArr as $galleryVO) {			
			$imageVOArr = (array)$galleryVO->getIMAGEVO_ARR();
			
			for($i = 0; $i < count ($imageVOArr); $i++) {
				$imageVO = $imageVOArr[$i];
				
				$filename   = $this->config->__get("home.cover.folder") . $imageVO->getNAME();
				file_put_contents ($filename, $imageVO->getIMAGE_THUMB());						
				chmod ($filename, 0777);			
			
				$result .= $imageVO->getNAME();
				if (isset($imageVOArr[$i+1])) {
					$result .= "&";	
				}				
			}
									
			$result .= "|" . $galleryVO->getLEGEND ();
			$result .= "|" . $galleryVO->getGALLERY_ID();
			$result .= "#";
		}		
		echo $result;		
	}
	
	/**
	 * Loads an image.
	 * 
	 * @return void
	 */
	public function loadImage () {
		$imageId = $_REQUEST['id'];
		$imageVO = new ImageVO();
		$imageVO->setIMAGE_ID ($imageId);
		$this->galleryBO = new galleryBO();
		$newImageVO = $this->galleryBO->findImageById ($imageVO);
		$this->config = new Config();		
		$filename = $this->config->__get("file.upload.folder") . $newImageVO->getNAME();
		
		file_put_contents ($filename, $newImageVO->getIMAGE());
		chmod ($filename, 0777);
		
		$result = "<img src=\"" . $this->config->__get("file.upload.folder") . $newImageVO->getNAME() . "\" border=\"0\"\>";
		echo $result;
	}
		
	/**
	 * Deletes a gallery.
	 * 
	 * @return void
	 */
	public function deleteGallery() {
		$galleryId = $_REQUEST['id'];	
		$galleryVO = new GalleryVO();
		$galleryVO->setGALLERY_ID ($galleryId);				
		$this->galleryBO = new galleryBO();
		$countRows = $this->galleryBO->delete ($galleryVO);		
		echo $countRows;
	}
	
	/**
	 * Deletes an image.
	 * 
	 * @return void
	 */
	public function deleteImage() {
		$imageId   = $_REQUEST['imageId'];
		$galleryId = $_REQUEST['galleryId'];
		$imageVO = new ImageVO();
		$imageVO->setIMAGE_ID ($imageId);
		$imageVO->setGALLERY_ID ($galleryId);	
		
		$this->deleteImageFromFilesystem ($imageVO);
		
		$this->galleryBO = new galleryBO();
		$countRows = $this->galleryBO->deleteImage ($imageVO);		
		echo $countRows;
	}	

	/**
	 * Updates an image legend.
	 * 
	 * @return void
	 */
	public function updateImageLegend() {
		$imageId   = $_REQUEST['imageId'];
		$galleryId = $_REQUEST['galleryId'];
		$legend  = $_REQUEST['legend'];
		$imageVO = new ImageVO();
		$imageVO->setIMAGE_ID ($imageId);
		$imageVO->setGALLERY_ID ($galleryId);
		$imageVO->setLEGEND ($legend);
		$this->galleryBO = new galleryBO();
		$updatedRows = $this->galleryBO->updateImageLegend ($imageVO);		
		echo $updatedRows;
	 }
	 
	/**
	 * Updates the cover image field.
	 * 
	 * @return void
	 */
	public function updateCoverImage() {
		$imageId = $_REQUEST['imageId'];
		$galleryId = $_REQUEST['galleryId'];
		$imageVO = new ImageVO();
		$imageVO->setIMAGE_ID ($imageId);
		$imageVO->setGALLERY_ID ($galleryId);
		$this->galleryBO = new galleryBO();
		$updatedRows = $this->galleryBO->updateCoverImage ($imageVO);		
		echo $updatedRows;
	 }
	 
	/**
	 * Removes the cover image of the image.
	 * 
	 * @return void
	 */
	public function removeCoverImage() {
		$imageId = $_REQUEST['imageId'];
		$galleryId = $_REQUEST['galleryId'];
		$imageVO = new ImageVO();
		$imageVO->setIMAGE_ID ($imageId);
		$imageVO->setGALLERY_ID ($galleryId);
		$this->galleryBO = new galleryBO();
		$updatedRows = $this->galleryBO->removeCoverImage ($imageVO);		
		echo $updatedRows;
	 }
	 
	/**
	 * Checks if a gallery has an image set as cover image.
	 */
	public function findByCoverImage () {		
		$galleryId = $_REQUEST['galleryId'];
		$imageVO = new ImageVO();
		$imageVO->setGALLERY_ID ($galleryId);
		$this->galleryBO = new galleryBO();		
		$rows = $this->galleryBO->findByCoverImage ($imageVO);
		echo $rows;
	}
	 	
	/**
	 * Finds all the galleries.
	 * 
	 * @return $arr array of galleries.
	 */
	public function find () {		
		$this->configPagination ();
		$this->galleryBO = new galleryBO();
		$pagination = $_REQUEST['pagination'];
		$arr = $this->galleryBO->find ($pagination);
		return $arr;
	}
	
	/**
	 * Configures the pagination.
	 * 
	 * @return void
	 */
	public function configPagination () {
		$pageNumber = $_REQUEST['pageNumber'];
		if (!isset($_REQUEST['pagination'])) {		
			$this->galleryBO = new galleryBO();
			$rows = $this->galleryBO->findRowCount ();					
			$pageRows = 10;
			$pagination = new Pagination();
			$pagination->setROWS ($rows);
			$pagination->setPAGE_ROWS ($pageRows);			
			$_REQUEST['pagination'] = $pagination;			
		}
		$_REQUEST['pagination']->setPAGE_NUM ($pageNumber);
	}
	
	/**
	 * Renders the pagination.
	 * 
	 * @return void
	 */
	public function renderPagination () {		
		$this->configPagination ();
		$pagination = $_REQUEST['pagination'];
		if ($pagination->getROWS() > 0) {
			$this->renderNavigation ($pagination);	
		}				
	}
	
	/**
	 * Renders the user HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();		
		if (count($arr) == 0) {
			echo "Não foram encontrados registros.";
		} else {

			echo "<table id=\"galleriesTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			echo "	<thead>";
			echo "		<tr>";
			echo "			<td>Id</td>";
			echo "			<td>Nome do usuário</td>";
			echo "			<td>Legenda</td>";
			echo "			<td>Data de criação</td>";
			echo "			<td>Data da última atualização</td>";
			echo "			<td>Status</td>";
			echo "		</tr>";
			echo "	</thead>";
			foreach ($arr as $key => $gallery) {
				echo "<tr onClick=\"javascript:editGallery('" . $gallery->getGALLERY_ID() . "');\" onmouseover=\"changeBackgroundColor(this, '#ebf3fb');\" onmouseout=\"changeBackgroundColor(this, '#fff');\" style=\"cursor: pointer;\">";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $gallery->getGALLERY_ID() . "</div>";
				echo "	</td>";
				
				$this->userBO = new UserBO();
				$userVO = new UserVO();
				$userVO->setUSER_ID ($gallery->getUSER_ID());
				$userVO = $this->userBO->findById ($userVO);
				
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $userVO->getUSERNAME() . "</div>";
				echo "	</td>";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $gallery->getLEGEND() . "</div>";
				echo "	</td>";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . Utils::getFormattedDatetime ($gallery->getCREATION_DT()) . "</div>";
				echo "	</td>";			
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . Utils::getFormattedDatetime ($gallery->getLAST_UPDATE_DT()) . "</div>";         
				echo "	</td>";
				$status = ($gallery->getSTATUS() == "1") ? "Ativo" : "Inativo";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $status . "</div>";      
				echo "	</td>";
				echo "</tr>";
			}
			echo "</table>";			
		}		
	}
	
	/**
	 * Renders the user HTML table navigation.
	 * 
	 * @return void
	 */
	protected function renderNavigation ($pagination) {
		echo "	<div id=\"container-button-first\" title=\"Primeiro Registro\">";
		if ($pagination->getPAGE_NUM() > 1) {
			echo "		<a href=\"javascript:renderGalleriesTable(1);renderGalleriesPagination(1);\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";
		}		
		echo "			<img id=\"img-button-first\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_first_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_first.png');\" border=\"0\" src=\"resources/images/bg_button_first.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-previous\" title=\"Registro Anterior\">";
		if ($pagination->getPAGE_NUM() > 1) {
			$previous = intval($pagination->getPAGE_NUM()-1);			
			echo "		<a href=\"javascript:renderGalleriesTable(" . $previous . ");renderGalleriesPagination(". $previous .");\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";		
		}
		echo "			<img id=\"img-button-previous\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_previous_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_previous.png');\" src=\"resources/images/bg_button_previous.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-next\" title=\"Pr&oacute;ximo Registro\">";		
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			$next = intval($pagination->getPAGE_NUM()+1);
			echo "		<a href=\"javascript:renderGalleriesTable(" . $next . ");renderGalleriesPagination(". $next .");\">";
		}
		echo "			<img id=\"img-button-next\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_next_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_next.png');\" src=\"resources/images/bg_button_next.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-last\" title=\"&Uacute;ltimo Registro\">";
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			echo "		<a href=\"javascript:renderGalleriesTable(" . $pagination->getLAST() . ");renderGalleriesPagination(". $pagination->getLAST() .");\">";
		}
		echo "			<img id=\"img-button-last\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_last_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_last.png');\" src=\"resources/images/bg_button_last.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";		
	}
	
	/**
	 * Renders the HTML of the Images of Gallery.
	 * 
	 * @return void
	 */
	private function renderImageGallery ($imageVOArr) {
		$result = "<div class=\"container-uploaded-row\">";
		
		$counter = 0;
		for ($i = 0; $i < count($imageVOArr); $i++) {
			$imageVO = $imageVOArr[$i];
			$result .= "		<div class=\"container-uploaded-item\">";
			$result .= "			<div class=\"container-uploaded-item-icons\">";
			if ($imageVO->getCOVER_IMAGE() == "1") {
				$result .= "			<a href=\"javascript:removeCoverImage ('" . $imageVO->getIMAGE_ID() . "', '" . $imageVO->getGALLERY_ID() . "');\"><img src=\"../../console/resources/images/cover_image_icon.png\" title=\"Remover Imagem de Capa\" style=\"float: left; margin-right: 10px;\"></a>";				
			} else {
				$result .= "			<a href=\"javascript:validateCoverImage ('" . $imageVO->getIMAGE_ID() . "', '" . $imageVO->getGALLERY_ID() . "');\"><img src=\"../../console/resources/images/cover_image_disabled_icon.png\" title=\"Tornar Imagem de Capa\" style=\"float: left; margin-right: 10px;\"></a>";
			}
			$result .= "				<a href=\"javascript:showModalImage ('dialog-image');loadImageById ('" . $imageVO->getIMAGE_ID() ."');scrollBodyTop();\"\"><img src=\"../../console/resources/images/image_view_icon.png\" title=\"Visualizar Imagem Original\" style=\"margin-right: 10px;\"></a>";
			$result .= "				<a href=\"javascript:updateImageLegend ('" . $imageVO->getIMAGE_ID() . "', '" . $imageVO->getGALLERY_ID() . "','txtImageLegendEdit".$i."');\"><img src=\"../../console/resources/images/edit_legend_icon.png\" title=\"Atualizar Legenda\" style=\"margin-right: 10px;\"></a>";
			$result .= "				<a href=\"javascript:deleteImage ('" . $imageVO->getIMAGE_ID() . "', '" . $imageVO->getGALLERY_ID() . "');\"><img src=\"../../console/resources/images/image_delete_icon.png\" title=\"Excluir Imagem\"></a>";
			$result .= "			</div>";
			$result .= "			<div class=\"container-uploaded-item-image\">";			
			$result .= "				<img src=\"../../console/resources/images/upload/thumb/" . $imageVO->getNAME() . "\" border=\"0\">";
			$result .= "			</div>";
			$result .= "			<div class=\"container-uploaded-item-legend\">";
			$result .= "				<input id=\"txtImageLegendEdit".$i."\" name=\"txtImageLegendEdit".$i."\" value=\"" . $imageVO->getLEGEND() . "\" placeholder=\"Legenda\" type=\"text\" maxlength=\"250\" />";
			$result .= "			</div>";
			$result .= "		</div>";
			$counter++;
			
			if ($counter == 4) {
				$result .= "</div>";
				if (isset($imageVOArr[$i+1])) {
					$result .= "<div class=\"container-uploaded-row\">";	
				}
				$counter = 0;
			}
		}
		
		return $result;
	}
	
	/**
	 * Renders the HTML of the Images of Gallery for the gallery page.
	 * 
	 * @return void
	 */
	private function renderImageGalleryForPage ($imageVOArr) {
		$result = "<div class=\"container-uploaded-row\">";		
		$counter = 0;
		$this->config = new Config();
		for ($i = 0; $i < count($imageVOArr); $i++) {
			$imageVO = $imageVOArr[$i];
			$result .= "<div class=\"container-uploaded-item\">";
			$result .= "	<div class=\"container-uploaded-item-image\">";			
			$result .= "		<a href=\"javascript:showModalImage ('dialog-image-page');loadImageByName ('" . $imageVO->getNAME() ."');scrollBodyTop();\"><img src=\"" . $this->config->__get("file.upload.page.thumb.folder")  . $imageVO->getNAME() . "\" border=\"0\"></a>";
			$result .= "	</div>";
			$result .= "</div>";
			$counter++;
			if ($counter == 4) {
				$result .= "</div>";
				if (isset($imageVOArr[$i+1])) {
					$result .= "<div class=\"container-uploaded-row\">";
				}
				$counter = 0;
			}
		}		
		return $result;
	}
	
	/**
	 * Renders the HTML of the other galleries different from the selected.
	 * 
	 * @return void
	 */
	public function renderOtherGalleriesForPage () {
		$result = null;
		$galleryId = $_REQUEST['galleryId'];
		$galleryVO = new GalleryVO();
		$galleryVO->setGALLERY_ID ($galleryId);
		$this->galleryBO = new galleryBO();		
		$galleryVOArr = $this->galleryBO->findOther ($galleryVO);		
		$result = "<ul>";
		for ($i = 0; $i < count($galleryVOArr); $i++) {
			$galleryVO = $galleryVOArr[$i];
			$result .= "	<li><a href=\"gallery.php?id=" . $galleryVO->getGALLERY_ID() . "\">" . $galleryVO->getLEGEND() . "</a></li>";
		}
		$result .= "</ul>";		
		echo $result;
	}
		
	/**
	 * Validates the upload form.
	 */
	private function validateForm ($galleryId) {
		/*
			err=-3 fileInvalidExtension 
			err=-2 fieldEmptyError
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError
		*/		
		$result = 1;
		if (empty ($_REQUEST['txtLegend'])) {
			$result = -2;
		} else {
			//performs this validation only if the action is an insert
			if (empty ($galleryId)) {
				//checks if at least one fileUpload is filled
				$result = -1;
				for ($i = 1; $i <= 10; $i++) {
					$fileImageUploadId = "fileImageUpload" . $i;
					if (!empty($_FILES[$fileImageUploadId]['tmp_name'])) {											
						//validates specifically the fileUpload (really uploaded, correct extension and size)
						$result = $this->validateFileUpload ($fileImageUploadId);
						break;										
					}
				}
			}	
		}
		return $result;		
	}
	
	/**
	 * Checks of the file upload is valid or not.
	 */
	private function validateFileUpload ($fileUploadId) {
		/*
			err=-3 fileInvalidExtension
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError			
		*/
		$this->config = new Config();
		$result = 1;
		//check if a file was uploaded
		if (!(is_uploaded_file($_FILES[$fileUploadId]['tmp_name'])) && (getimagesize($_FILES[$fileUploadId]['tmp_name']) != false)) {
			$result = -1;
		//check the file extension
		} else if (!$this->isValidFileExtension ($_FILES[$fileUploadId]['name'])) {
			$result = -3;	
		//check the file is less than the maximum file size
		} else if ($_FILES[$fileUploadId]['size'] > $this->config->__get("file.upload.max.size") ) { 
			$result = 0;		
		}					
		return $result;
	}
	
	/**
	 * Validates the image file extension.
	 */
	private function isValidFileExtension ($filename) {
		$acceptedFormatArr = array ('gif', 'png', 'jpg', 'jpeg');
		foreach ($acceptedFormatArr as $acceptedFormat) {			
			$extension = pathinfo ($filename, PATHINFO_EXTENSION);
			if (strcasecmp ($acceptedFormat, $extension) == 0) {
	    		return true;
			}			
		}		
		return false;
	}
	
	/**
	 * Deletes an image from filesystem.
	 * 
	 * @return void
	 */
	private function deleteImageFromFilesystem (ImageVO $imageVO) {
		$this->config = new Config();		
		$this->galleryBO = new galleryBO();
		$newImageVO = $this->galleryBO->findImageById ($imageVO);
		$filenameUpload = $this->config->__get("file.upload.folder") . $newImageVO->getNAME();
		$filenameThumbUpload = $this->config->__get("file.upload.thumb.folder") . $newImageVO->getNAME();		
		unlink ($filenameUpload);
		unlink ($filenameThumbUpload);
	}
			
}

?>