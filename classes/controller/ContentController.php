<?php

/**
 * Content Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentController {
	
	private $contentBO;
	private $userBO;
	private $parameterBO;
	private $config;
	
	public function __construct() {
		
	}
		
	/**
	 * Inserts or updates a new content.
	 * 
	 * @return void
	 */
	public function updateContent() {
		/*																																																																																																																																																																																																																																																																																																																																										
			err=-3 fileInvalidExtension
			err=-2 fieldEmptyError
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError
			sc=1   insertSuccess
			sc=2   updateSuccess			
		*/
		$page = "../../console/main.php?tab=3";
		
		$id          = $_REQUEST['contentId'];
		$loggedUser  = Utils::getLoggedUser();
		$userId      = $loggedUser->getUSER_ID();
		$contentType = $_REQUEST['selectContentType'];
		$componentId = $_REQUEST['selectComponentId'];
		$url         = $_REQUEST['txtUrl'];
		
		$url = str_replace("C:\\fakepath\\", "", $url);
		
		$title       = $_REQUEST['txtTitle'];
		$content     = str_replace ("'", "''", $_REQUEST['txtContent']) ;
		$management  = $_REQUEST['selectManagement'];
		
		$periodStartMonth = $_REQUEST['selectPeriodStartMonth'];
		$periodStartYear  = $_REQUEST['selectPeriodStartYear'];
		$periodEndMonth   = $_REQUEST['selectPeriodEndMonth'];
		$periodEndYear    = $_REQUEST['selectPeriodEndYear'];
		
		$status      = (isset($_REQUEST['chkStatusContent']) ? 1 : 0);
		
		$validateFormReturn = $this->validateForm ();
		
		if ($validateFormReturn === 1) {
			
			if (!empty($_FILES['fileUpload']['tmp_name'])) {
				$fileStream   = fopen ($_FILES['fileUpload']['tmp_name'], 'rb');
				$name         = $_FILES['fileUpload']['name'];

				$name = str_replace("C:\\fakepath\\", "", $name);
				
				$this->config = new Config();				
				
				if ($contentType == "4") {
					$filename = $this->config->__get("notices.documents.upload.folder") . $name;	
				} else if ($contentType == "5") {
					$filename = $this->config->__get("balancesheet.pm.upload.folder") . $name;
				} else if ($contentType == "6") {
					$filename = $this->config->__get("balancesheets.upload.folder") . $name;
				}			
				file_put_contents ($filename, $fileStream);
				chmod ($filename, 0777);
			}

			$contentVO = new ContentVO();
			$contentVO->setCONTENT_ID ($id);
			$contentVO->setUSER_ID ($userId);
			$contentVO->setCONTENT_TYPE ($contentType);
			$contentVO->setCOMPONENT_ID ($componentId);
			$contentVO->setURL ($url);
			$contentVO->setTITLE ($title);
			$contentVO->setCONTENT ($content);
			$contentVO->setMANAGEMENT($management);
			$contentVO->setPERIOD_START_MONTH($periodStartMonth);
			$contentVO->setPERIOD_START_YEAR($periodStartYear);
			$contentVO->setPERIOD_END_MONTH($periodEndMonth);
			$contentVO->setPERIOD_END_YEAR($periodEndYear);
			
			$contentVO->setSTATUS ($status);
			
			//saving the default notices and documents page in json
			if ($contentVO->getCONTENT_TYPE() == "4") {
				$url = "javascript:checkNoticesAndDocumentsKeywordExists();";
			
			//saving the default balanceSheetPm page in json
			} else if ($contentVO->getCONTENT_TYPE() == "5") {
				$url = "javascript:checkBalanceSheetPmKeywordExists();";
			} 
			//saving the default balanceSheetPm page in json
			else if ($contentVO->getCONTENT_TYPE() == "6") {
				$url = "balanceSheets.php";
			}
		
			$this->contentBO = new ContentBO();
			if ($id == null) {			
				$newContentVO = $this->contentBO->insert ($contentVO);
				$this->updateURLInJSON ($componentId, $url);			
				if ($newContentVO->getCONTENT_ID () > 0) {
					$page .= "&sc=1";
				}
			} else {				
				//removing the old associated file
				/*if ($contentVO->getCONTENT_TYPE() == "4") {
					$oldContentVO = $this->contentBO->findById ($contentVO);
					$this->deleteFileFromFilesystem ($oldContentVO->getURL(), "notices.documents.upload.folder");					
				} else if ($contentVO->getCONTENT_TYPE() == "5") {
					$oldContentVO = $this->contentBO->findById ($contentVO);
					$this->deleteFileFromFilesystem ($oldContentVO->getURL(), "balancesheet.pm.upload.folder");					
				}*/							
				
				$rowCount = $this->contentBO->update ($contentVO);
				$this->updateURLInJSON ($componentId, $url);
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
	 * Updates the url key in the JSON value (Parameter).
	 * 
	 * @return void
	 */
	private function updateURLInJSON ($componentId, $url) {
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$MENU_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		$menuArr = json_decode ($jsonContent, true);
		for ($i = 0; $i < count ($menuArr); $i++) {		
			if ($menuArr[$i]['id'] == $componentId) {
				$menuArr[$i]['href'] = $url;
				break;
			} else if (is_array ($menuArr[$i]['menuitem']) && count($menuArr[$i]['menuitem']) > 0 ) {				
				for ($j = 0; $j < count ($menuArr[$i]['menuitem']);$j++) {					
					if ($menuArr[$i]['menuitem'][$j]['id'] == $componentId) {
						$menuArr[$i]['menuitem'][$j]['href'] = $url;
						break 2; 
					}					
				}			
			}		
		}		
		$newJsonContent = json_encode ($menuArr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		$parameterVO->setVALUE ($newJsonContent);
		$this->parameterBO->update ($parameterVO);
	}
		
	/**
	 * Loads a content.
	 * 
	 * @return void
	 */
	public function loadContent() {
		$contentId = $_REQUEST['id'];
		$contentVO = new ContentVO();
		$contentVO->setCONTENT_ID ($contentId);				
		$this->contentBO = new ContentBO();
		$newContentVO = $this->contentBO->findById ($contentVO);

		$this->userBO = new UserBO();
		$userVO = new UserVO();
		$userVO->setUSER_ID ($newContentVO->getUSER_ID());
		$userVO = $this->userBO->findById ($userVO);
		
		echo $newContentVO->getCONTENT_ID()
			 . "&&" . $userVO->getUSERNAME ()
			 . "&&" . $newContentVO->getCONTENT_TYPE()
			 . "&&" . $newContentVO->getCOMPONENT_ID()
			 . "&&" . $newContentVO->getURL()
			 . "&&" . $newContentVO->getTITLE()
			 . "&&" . $newContentVO->getCONTENT()
			 . "&&" . $newContentVO->getMANAGEMENT()
			 . "&&" . $newContentVO->getPERIOD_START_MONTH()
			 . "&&" . $newContentVO->getPERIOD_START_YEAR()
			 . "&&" . $newContentVO->getPERIOD_END_MONTH()
			 . "&&" . $newContentVO->getPERIOD_END_YEAR()
			 . "&&" . Utils::getFormattedDatetime ($newContentVO->getCREATION_DT())
			 . "&&" . Utils::getFormattedDatetime ($newContentVO->getLAST_UPDATE_DT())
			 . "&&" . $newContentVO->getSTATUS ();
	}
	
	/**
	 * Loads a content for the content page.
	 * 
	 * @return void
	 */
	public function loadContentForPage() {
		$contentId = $_REQUEST['id'];
		$contentVO = new ContentVO();
		$contentVO->setCONTENT_ID ($contentId);				
		$this->contentBO = new ContentBO();
		$newContentVO = $this->contentBO->findById ($contentVO);
		
		$lastUpdateDate = null;
		if (empty ($newContentVO->getLAST_UPDATE_DT())) {
		 	$lastUpdateDate = Utils::getFormattedHourMinuteDatetime ($newContentVO->getCREATION_DT());
		} else {
			$lastUpdateDate = Utils::getFormattedHourMinuteDatetime ($newContentVO->getLAST_UPDATE_DT());
		}
		
		echo $newContentVO->getCONTENT_ID()
			 . "&&" . $lastUpdateDate
		     . "&&" . $newContentVO->getTITLE()
			 . "&&" . $newContentVO->getCONTENT();	 
	}
	
	/**
	 * Deletes a content.
	 * 
	 * @return void
	 */
	public function deleteContent() {
		$contentId   = $_REQUEST['id'];
		$contentType = $_REQUEST['contentType'];
		$componentId = $_REQUEST['componentId'];
		$url         = $_REQUEST['url'];
		$contentVO   = new ContentVO();
		$contentVO->setCONTENT_ID ($contentId);
		$this->contentBO = new ContentBO();
		$countRows = $this->contentBO->delete ($contentVO);
		if ($countRows > 0) {			
			if ($contentType != "4" && $contentType != "5") {
				$lastActiveURL = $this->getLastActiveURL();
			} else {
				
				if ($contentType == "4") {
					$lastActiveURL = $this->getLastActiveIdForContentType4();
					$folder = "notices.documents.upload.folder";
				} else if ($contentType == "5") {
					$lastActiveURL = "balanceSheetsPm.php";
					$folder = "balancesheet.pm.upload.folder";
				}			
				$this->deleteFileFromFilesystem ($url, $folder);
			}			
			$this->updateURLInJSON ($componentId, $lastActiveURL);
		}		
		echo $countRows;
	}
	
	/**
	 * Sets a URL.
	 * 
	 * @return void
	 */
	public function setURL () {
		$url = null;
		$contentId   = $_REQUEST['id'];
		$contentType = $_REQUEST['contentType'];		
		if (empty ($contentId)) {
			$this->contentBO = new ContentBO();
			$contentVO = $this->contentBO->findLastId();
			$contentId = (($contentVO == null) ? 1 : $contentVO->getCONTENT_ID() + 1);
		}		
		$url = "content.php?id=" . $contentId . "&type=" . $contentType;  
		echo $url;
	}	
	
	/**
	 * Finds all the contents.
	 * 
	 * @return $arr array of galleries.
	 */
	public function find () {
		$this->configPagination ();
		$this->contentBO = new ContentBO();
		$pagination = $_REQUEST['pagination'];
		$arr = $this->contentBO->find ($pagination);
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
			$this->contentBO = new ContentBO();
			$rows = $this->contentBO->findRowCount ();					
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
	 * Renders the content HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();		
		if (count($arr) == 0) {
			echo "Não foram encontrados registros.";
		} else {			
			
			echo "<table id=\"contentsTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			echo "	<thead>";
			echo "		<tr>";
			echo "			<td>Id</td>";
			echo "			<td>Nome do usuário</td>";
			echo "			<td>Tipo do conteúdo</td>";
			echo "			<td>Menu associado</td>";
			echo "			<td>Título</td>";
			echo "			<td>Data de criação</td>";
			echo "			<td>Data da última atualização</td>";
			echo "			<td>Status</td>";
			echo "		</tr>";
			echo "	</thead>";
			foreach ($arr as $key => $content) {
				echo "<tr onClick=\"javascript:editContent('" . $content->getCONTENT_ID() . "');\" onmouseover=\"changeBackgroundColor(this, '#ebf3fb');\" onmouseout=\"changeBackgroundColor(this, '#fff');\" style=\"cursor: pointer;\">";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $content->getCONTENT_ID() . "</div>";
				echo "	</td>";
				
				$this->userBO = new UserBO();
				$userVO = new UserVO();
				$userVO->setUSER_ID ($content->getUSER_ID());
				$userVO = $this->userBO->findById ($userVO);
				
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $userVO->getUSERNAME() . "</div>";
				echo "	</td>";
				
				$contentTypeId = $content->getCONTENT_TYPE();
				$contentType = null;				
				if ($contentTypeId == 1) {
					$contentType = "Palavra do Grão Mestre";	
				} else if ($contentTypeId == 2) {
					$contentType = "Notícia";
				} else if ($contentTypeId == 3) {
					$contentType = "Conteúdo Normal";
				} else if ($contentTypeId == 4) {
					$contentType = "Avisos e Documentos";
				} else if ($contentTypeId == 5) {
					$contentType = "Balancetes Paramaçônicas";
				} else if ($contentTypeId == 6) {
					$contentType = "Balancetes";
				}
				
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $contentType . "</div>";
				echo "	</td>";
								
				$this->parameterBO = new ParameterBO();
				$associatedMenu = $this->parameterBO->findMenuNameById ($content->getCOMPONENT_ID()); 
								
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $associatedMenu . "</div>";
				echo "	</td>";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $content->getTITLE() . "</div>";
				echo "	</td>";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . Utils::getFormattedDatetime ($content->getCREATION_DT()) . "</div>";
				echo "	</td>";			
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . Utils::getFormattedDatetime ($content->getLAST_UPDATE_DT()) . "</div>";         
				echo "	</td>";
				$status = ($content->getSTATUS() == "1") ? "Ativo" : "Inativo";
				echo "	<td>";
				echo "		<div id=\"container-table-item-label\">" . $status . "</div>";      
				echo "	</td>";
				echo "</tr>";				
			}
			echo "</table>";			
		}		
	}
	
	/**
	 * Renders the content HTML table navigation.
	 * 
	 * @return void
	 */
	protected function renderNavigation ($pagination) {
		echo "	<div id=\"container-button-first\" title=\"Primeiro Registro\">";
		if ($pagination->getPAGE_NUM() > 1) {
			echo "		<a href=\"javascript:renderContentsTable(1);renderContentsPagination(1);\">";
		} else {
			echo "		<a href=\"javascript:void(0);\">";
		}		
		echo "			<img id=\"img-button-first\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_first_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_first.png');\" border=\"0\" src=\"resources/images/bg_button_first.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-previous\" title=\"Registro Anterior\">";
		if ($pagination->getPAGE_NUM() > 1) {
			$previous = intval($pagination->getPAGE_NUM()-1);			
			echo "		<a href=\"javascript:renderContentsTable(" . $previous . ");renderContentsPagination(". $previous .");\">";
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
			echo "		<a href=\"javascript:renderContentsTable(" . $next . ");renderContentsPagination(". $next .");\">";
		}
		echo "			<img id=\"img-button-next\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_next_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_next.png');\" src=\"resources/images/bg_button_next.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";
		echo "	<div id=\"container-button-last\" title=\"&Uacute;ltimo Registro\">";
		if ($pagination->getPAGE_NUM() == $pagination->getLAST()) {
			echo "		<a href=\"javascript:void(0);\">";
		} else {
			echo "		<a href=\"javascript:renderContentsTable(" . $pagination->getLAST() . ");renderContentsPagination(". $pagination->getLAST() .");\">";
		}
		echo "			<img id=\"img-button-last\" onmouseover=\"javascript:changeImageSrc(this, 'bg_button_last_over.png');\" onmouseout=\"javascript:changeImageSrc(this, 'bg_button_last.png');\" src=\"resources/images/bg_button_last.png\" border=\"0\" />";
		echo "		</a>";
		echo "	</div>";		
	}
	
	/**
	 * Renders the associated menu HTML.
	 * 
	 * @return void
	 */
	public function renderAssociatedMenu() {
		$result = null;
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$MENU_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		$menuArr = json_decode ($jsonContent, true);
		$result .= "<option value=\"\"></option>";
		foreach ($menuArr as $menu) {			
			if ($this->isAllowedMenu ($menu['id'])) {				
				if ($this->isAllowedMenuFather ($menu['id'])) {					
					$result .= "<option value=" . $menu['id'] . ">". $menu['value'] ."</option>";					
				}				
				if (is_array ($menu['menuitem']) && count($menu['menuitem']) > 0) {
					$menuItemArr = $menu['menuitem'];				
					foreach ($menuItemArr as $menuItem) {					
						$result .= "<option value=" . $menuItem['id'] . ">&nbsp;&nbsp;&nbsp;&nbsp;" . $menuItem['value'] . "</option>";					
					}
				}			
			}
		}	
		echo $result;
	}

	/**
	 * Renders the JSON string of menu.
	 * 
	 * @return void
	 */
	public function getJSONMenu() {
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$MENU_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		echo $jsonContent;
	}
	
	/**
	 * Renders the JSON string of home intro.
	 * 
	 * @return void
	 */
	public function getJSONHomeIntro() {
		$this->parameterBO = new ParameterBO();
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY (Constants::$HOME_INTRO_SITE);
		$parameterVO = $this->parameterBO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		echo $jsonContent;		
	}

	/**
	 * Renders the HTML of the other contents different from the selected.
	 * 
	 * @return void
	 */
	public function renderOtherContentsForPage () {
		$result = null;
		$contentId   = $_REQUEST['contentId'];
		$contentType = $_REQUEST['contentType'];
		$contentVO = new ContentVO();
		$contentVO->setCONTENT_ID ($contentId);
		$contentVO->setCONTENT_TYPE ($contentType);
		$this->contentBO = new ContentBO();
		$contentVOArr = $this->contentBO->findOtherContents ($contentVO);		
		$result = "<ul>";
		for ($i = 0; $i < count($contentVOArr); $i++) {
			$contentVO = $contentVOArr[$i];
			$result .= "	<li><a href=\"content.php?id=" . $contentVO->getCONTENT_ID() . "&type=" . $contentVO->getCONTENT_TYPE() . "\">" . $contentVO->getTITLE() . "</a></li>";
		}
		$result .= "</ul>";		
		echo $result;
	}
	
	/**
	 * Renders the HTML of the last six contents in the home page.
	 * 
	 * @return void
	 */
	public function renderLastSixContentsForPage () {
		$result = null;
		$lastUpdateDate = null;
		$this->contentBO = new ContentBO();
		$contentVOArr = $this->contentBO->findLastSix ();		
		for ($i = 0; $i < count($contentVOArr); $i++) {
			$contentVO = $contentVOArr[$i];			
			if (empty($contentVO->getLAST_UPDATE_DT())) {
				$lastUpdateDate = Utils::getFormattedDayMonthYearDatetime ($contentVO->getCREATION_DT());	
			} else {
				$lastUpdateDate = Utils::getFormattedDayMonthYearDatetime ($contentVO->getLAST_UPDATE_DT());
			}
			$result .= "<div class=\"news-container-line\">";
			$result .=	"<a href=\"content.php?id=" . $contentVO->getCONTENT_ID() . "&type=" . $contentVO->getCONTENT_TYPE() . "\"><b>" . $lastUpdateDate . "</b> - " . $contentVO->getTITLE() . "</a>";
			$result .= "</div>";			
		}		
		echo $result;
	}
	
	/**
	 * Renders the HTML of the last content type 4 in the home page.
	 * 
	 * @return void
	 */
	public function renderLastContentType4ForPage () {
		$result = null;
		$lastUpdateDate = null;
		$this->contentBO = new ContentBO();
		$contentVOArr = $this->contentBO->findLastContentType4();
		$contentVO = $contentVOArr[0];
		if (empty($contentVO->getLAST_UPDATE_DT())) {
			$lastUpdateDate = Utils::getFormattedDayMonthYearDatetime ($contentVO->getCREATION_DT());
		} else {
			$lastUpdateDate = Utils::getFormattedDayMonthYearDatetime ($contentVO->getLAST_UPDATE_DT());
		}
		$result .= "<div class=\"notices-documents-container-line\">";
		$result .= "	<a href=\"javascript:checkNoticesAndDocumentsKeywordExists();\"><b>" . $lastUpdateDate . "</b> - " . $contentVO->getTITLE() . "</a>";
		$result .= "</div>";
		echo $result;
	}
	
	/**
	 * Renders the last update date of contents type 4 in the notices and documents page.
	 * 
	 * @return void
	 */
	public function renderLastUpdateDateType4ForPage() {
		$result = null;
		$this->contentBO = new ContentBO();
		$arr = $this->contentBO->findLastContentType4();
		if ($arr != null && count ($arr) > 0) {
			$contentVO = $arr[0];			
			if (empty ($contentVO->getLAST_UPDATE_DT())) {
				$result = Utils::getFormattedDatetime ($contentVO->getCREATION_DT());	
			} else {
				$result = Utils::getFormattedDatetime ($contentVO->getLAST_UPDATE_DT());
			}			 
		}		
		echo $result;
	}
	
	/**
	 * Renders the last update date of contents type 5 in the balanceSheetsPm page.
	 * 
	 * @return void
	 */
	public function renderLastUpdateDateType5ForPage() {
		$result = null;
		$this->contentBO = new ContentBO();
		$arr = $this->contentBO->findLastContentType5();
		if ($arr != null && count ($arr) > 0) {
			$contentVO = $arr[0];			
			if (empty ($contentVO->getLAST_UPDATE_DT())) {
				$result = Utils::getFormattedDatetime ($contentVO->getCREATION_DT());	
			} else {
				$result = Utils::getFormattedDatetime ($contentVO->getLAST_UPDATE_DT());
			}
		}		
		echo $result;
	}

	/**
	 * Renders the last update date of contents type 6 in the balanceSheets page.
	 * 
	 * @return void
	 */
	public function renderLastUpdateDateType6ForPage() {
		$result = null;
		$this->contentBO = new ContentBO();
		$arr = $this->contentBO->findLastContentType6();
		if ($arr != null && count ($arr) > 0) {
			$contentVO = $arr[0];
			if (empty ($contentVO->getLAST_UPDATE_DT())) {
				$result = Utils::getFormattedDatetime ($contentVO->getCREATION_DT());
			} else {
				$result = Utils::getFormattedDatetime ($contentVO->getLAST_UPDATE_DT());
			}
		}	
		echo $result;
	}
	
	/**
	 * Renders the contents type 4 HTML table in the notices and documents page.
	 * 
	 * @return void
	 */
	public function renderContentsType4ForPage() {
		$result = null;
		$this->contentBO = new ContentBO();
		$arr = $this->contentBO->findContentType4();		
		if (count($arr) == 0) {
			$result .= "Não foram encontrados registros.";
		} else {			
			$result = "<table id=\"table-common\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			$result .=	"	<tr>";
			$result .=	"		<td><b>Item</b></td>";
			$result .=	"		<td><b>Título</b></td>";
			$result .=	"		<td><b>Data de Criação</b></td>";
			$result .=	"		<td><b>Anexo</b> <img src=\"/resources/images/pdf_icon.png\" style=\"vertical-align: middle;\" /></td>";
			$result .=	"	</tr>";			
			$itemCount = 1;
			foreach ($arr as $key => $content) {
				$result .=	"<tr>";
				$result .=	"	<td>" . $itemCount++ . "</td>";
				$result .=	"	<td>" . $content->getTITLE() . "</td>";
				$result .=	"	<td>" . Utils::getFormattedDayMonthYearDatetime ($content->getCREATION_DT()) . "</td>";
				$result .=	"	<td><div id=\"download-container\"><a href=\"download.php?type=nd&filename=" . $content->getURL() . "&contentType=" . $content->getCONTENT_TYPE () . "\">" . $content->getURL() ."</a></div></td>";
				$result .=	"</tr>";
			}
			$result .=	"</table>";			
		}
		echo $result;
	}

	/**
	 * Renders the contents type 5 HTML table in the balance sheet pm page.
	 * 
	 * @return void
	 */
	public function renderContentsType5ForPage() {
		$result = null;
		$this->contentBO = new ContentBO();
		$arr = $this->contentBO->findContentType5();		
		if (count($arr) == 0) {
			$result .= "Não foram encontrados registros.";
		} else {			
			$result = "<table id=\"table-common\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			$result .=	"	<tr>";
			$result .=	"		<td><b>Item</b></td>";
			$result .=	"		<td><b>Título</b></td>";
			$result .=	"		<td><b>Gestão</b></td>";
			$result .=	"		<td><b>Anexo</b> <img src=\"/resources/images/pdf_icon.png\" style=\"vertical-align: middle;\" /></td>";
			$result .=	"	</tr>";
			$itemCount = 1;
			foreach ($arr as $key => $content) {
				$result .=	"<tr>";
				$result .=	"	<td>" . $itemCount++ . "</td>";
				$result .=	"	<td>" . $content->getTITLE() . "</td>";
				$result .=	"	<td>" . $content->getMANAGEMENT() . "</td>";
				$result .=	"	<td><div id=\"download-container\"><a href=\"download.php?type=nd&filename=" . $content->getURL() . "&contentType=" . $content->getCONTENT_TYPE () . "\">" . $content->getURL() ."</a></div></td>";
				$result .=	"</tr>";
			}
			$result .=	"</table>";
		}
		echo $result;
	}
	
	/**
	 * Renders the contents type 6 HTML table in the balance sheets page.
	 * 
	 * @return void
	 */
	public function renderContentsType6ForPage() {
		$result = null;
		$this->contentBO = new ContentBO();
		$arr = $this->contentBO->findContentType6();		
		if (count($arr) == 0) {
			$result .= "Não foram encontrados registros.";
		} else {			
			$result = "<table id=\"table-common\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
			$result .=	"	<tr>";
			$result .=	"		<td><b>Item</b></td>";
			$result .=	"		<td><b>Título</b></td>";
			$result .=	"		<td><b>Período</b></td>";
			$result .=	"		<td><b>Anexo</b> <img src=\"/resources/images/pdf_icon.png\" style=\"vertical-align: middle;\" /></td>";
			$result .=	"	</tr>";			
			$itemCount = 1;
			foreach ($arr as $key => $content) {
				$result .=	"<tr>";
				$result .=	"	<td>" . $itemCount++ . "</td>";
				$result .=	"	<td>" . $content->getTITLE() . "</td>";
				$result .=	"	<td>" . Utils::getFormattedPeriod ($content) . "</td>";
				$result .=	"	<td><div id=\"download-container\"><a href=\"download.php?filename=" . $content->getURL() . "&contentType=" . $content->getCONTENT_TYPE () . "\">" . $content->getURL() ."</a></div></td>";
				$result .=	"</tr>";
			}
			$result .=	"</table>";
		}
		echo $result;
	}
	
	/**
	 * Checks if the given menu is allowed.
	 * 
	 * @return void
	 */
	private function isAllowedMenu ($menuId) {
		$isAllowed = true;
		$notAllowedMenuArr = array (
			"mn_Home",
			"mn_LinksMaconicos", 
			"mn_GLOMAPWEB", 
			"mn_Webmail", 
			"mn_Contato",
			"mn_Institucional_Balancetes"
		);		
		foreach ($notAllowedMenuArr as $notAllowedMenu) {			
			if (strcmp ($notAllowedMenu, $menuId) == 0) {
				$isAllowed = false;
				break;
			}
		}
		return $isAllowed;
	}
	
	/**
	 * Checks if the given menu father is allowed.
	 * 
	 * @return void
	 */
	private function isAllowedMenuFather ($menuId) {
		$isAllowed = true;
		$notAllowedMenuFatherArr = array (
			"mn_Institucional"
		);		
		foreach ($notAllowedMenuFatherArr as $notAllowedMenuFather) {			
			if (strcmp ($notAllowedMenuFather, $menuId) == 0) {
				$isAllowed = false;
				break;
			}
		}
		return $isAllowed;
	}

	/**
	 * Gets the last active URL.
	 * 
	 * @return void
	 */
	private function getLastActiveURL () {
		$url = null;
		$contentType = $_REQUEST['contentType'];		
		$this->contentBO = new ContentBO();
		$contentVO = $this->contentBO->findLastActiveId();
		$contentId = (($contentVO == null) ? 1 : $contentVO->getCONTENT_ID());				
		$url = "content.php?id=" . $contentId . "&type=" . $contentType;  
		return $url;
	}
	
	/**
	 * Gets the last active URL for content type = 4.
	 * 
	 * @return void
	 */
	private function getLastActiveIdForContentType4 () {
		$url = null;
		$this->contentBO = new ContentBO();
		$contentVO = $this->contentBO->findLastActiveIdForContentType4();
		$url = (($contentVO == null) ? "" : $contentVO->getURL());
		return $url;
	}
	
	/**
	 * Validates the upload form.
	 */
	private function validateForm () {
		$result = 1;
		if (!empty($_FILES['fileUpload']['tmp_name'])) {											
			//validates specifically the fileUpload (really uploaded, correct extension and size)
			$result = $this->validateFileUpload ();		
		}
		return $result;		
	}
	
	/**
	 * Checks of the file upload is valid or not.
	 */
	private function validateFileUpload () {
		/*
			err=-3 fileInvalidExtension
			err=-1 fileWasNotUploadedError
			err=0  fileWithBiggerSizeError			
		*/
		$this->config = new Config();
		$result = 1;
		//check if a file was uploaded
		if (!(is_uploaded_file($_FILES['fileUpload']['tmp_name'])) && (getimagesize($_FILES['fileUpload']['tmp_name']) != false)) {
			$result = -1;
		//check the file extension
		} else if (!$this->isValidFileExtension ($_FILES['fileUpload']['name'])) {
			$result = -3;	
		//check the file is less than the maximum file size
		} else if ($_FILES['fileUpload']['size'] > $this->config->__get("file.upload.max.size") ) { 
			$result = 0;		
		}					
		return $result;
	}
	
	/**
	 * Validates the image file extension.
	 */
	private function isValidFileExtension ($filename) {
		$acceptedFormatArr = array ('pdf','gif', 'png', 'jpg', 'jpeg');
		foreach ($acceptedFormatArr as $acceptedFormat) {			
			$extension = pathinfo ($filename, PATHINFO_EXTENSION);
			if (strcasecmp ($acceptedFormat, $extension) == 0) {
	    		return true;
			}
		}	
		return false;
	}
	
	/**
	 * Deletes a file from filesystem.
	 * 
	 * @return void
	 */
	private function deleteFileFromFilesystem ($name, $folder) {
		$this->config = new Config();		
		$filenameUpload = $this->config->__get($folder) . $name;
		unlink ($filenameUpload);		
	}
	
}

?>