<?php
/**
 * ContentDAO Data Access Object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentDAO extends AbstractDAO {
	
	public function __construct() {		
		parent::__construct();		
	}
			
	public function insert (ContentVO $contentVO) {
		$sql  = "INSERT INTO CONTENT (USER_ID, CONTENT_TYPE, COMPONENT_ID, URL, TITLE, CONTENT, MANAGEMENT, PERIOD_START_MONTH, PERIOD_START_YEAR, PERIOD_END_MONTH, PERIOD_END_YEAR, CREATION_DT, STATUS, STATE) "; 
		$sql .= "VALUES (" . $contentVO->getUSER_ID() . ", "; 
		$sql .= $contentVO->getCONTENT_TYPE() . ", ";
		$sql .= "'" . $contentVO->getCOMPONENT_ID() . "', ";
		$sql .= "'" . $contentVO->getURL() . "', ";
		$sql .= "'" . $contentVO->getTITLE() . "', ";
		$sql .= "'" . $contentVO->getCONTENT() . "', ";
		$sql .= "'" . $contentVO->getMANAGEMENT() . "', ";
		$sql .= "'" . $contentVO->getPERIOD_START_MONTH() . "', ";
		$sql .= "'" . $contentVO->getPERIOD_START_YEAR() . "', ";
		$sql .= "'" . $contentVO->getPERIOD_END_MONTH() . "', ";
		$sql .= "'" . $contentVO->getPERIOD_END_YEAR() . "', ";
		$sql .= "NOW(), ";
		$sql .= $contentVO->getSTATUS() . ", ";
		$sql .= "'" . Constants::$CONTENT_STATE_ACTIVE . "')";				
		$contentId = $this->insertDb ($sql);
		$contentVO->setCONTENT_ID ($contentId);
		return $contentVO;
    }
    
	public function update (ContentVO $contentVO) {
		$sql  = "UPDATE CONTENT SET USER_ID='" . $contentVO->getUSER_ID() . "', ";
		$sql .= "CONTENT_TYPE = " . $contentVO->getCONTENT_TYPE() . ", ";
		$sql .= "COMPONENT_ID = '" . $contentVO->getCOMPONENT_ID() . "', "; 
		$sql .= "URL = '" . $contentVO->getURL() . "', ";
		$sql .= "TITLE = '" . $contentVO->getTITLE() . "', ";
		$sql .= "CONTENT = '" . $contentVO->getCONTENT() . "', ";
		$sql .= "MANAGEMENT = '" . $contentVO->getMANAGEMENT() . "', ";
		$sql .= "PERIOD_START_MONTH = '" . $contentVO->getPERIOD_START_MONTH() . "', ";
		$sql .= "PERIOD_START_YEAR = '" . $contentVO->getPERIOD_START_YEAR() . "', ";
		$sql .= "PERIOD_END_MONTH = '" . $contentVO->getPERIOD_END_MONTH() . "', ";
		$sql .= "PERIOD_END_YEAR = '" . $contentVO->getPERIOD_END_YEAR() . "', ";
		$sql .= "LAST_UPDATE_DT = NOW(), ";
		$sql .= "STATUS = " . $contentVO->getSTATUS() . " ";
		$sql .= "WHERE CONTENT_ID = " . $contentVO->getCONTENT_ID(); 
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }

	public function delete (ContentVO $contentVO) {		
		$sql  = "UPDATE CONTENT SET STATE = '" . Constants::$CONTENT_STATE_REMOVED . "' ";
		$sql .= "WHERE CONTENT_ID = " . $contentVO->getCONTENT_ID();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }
	
	public function find (Pagination $pagination) {
		$sql = "SELECT CONTENT_ID, USER_ID, CONTENT_TYPE, COMPONENT_ID, URL, TITLE, CONTENT, CREATION_DT, LAST_UPDATE_DT, STATUS FROM CONTENT WHERE STATE = 'A' ORDER BY CONTENT_ID LIMIT " . $pagination->getLIMIT();			
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findOtherContents (ContentVO $contentVO) {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE FROM CONTENT WHERE CONTENT_ID <> " . $contentVO->getCONTENT_ID() . " AND STATUS = 1 AND STATE = 'A' AND CONTENT_TYPE = " . $contentVO->getCONTENT_TYPE() . " ORDER BY CONTENT_ID DESC";			
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM CONTENT WHERE STATE = 'A'";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function findById (ContentVO $contentVO) {
		$sql = "SELECT CONTENT_ID, USER_ID, CONTENT_TYPE, COMPONENT_ID, URL, TITLE, CONTENT, MANAGEMENT, PERIOD_START_MONTH, PERIOD_START_YEAR, PERIOD_END_MONTH, PERIOD_END_YEAR, CREATION_DT, LAST_UPDATE_DT, STATUS FROM CONTENT WHERE CONTENT_ID = " . $contentVO->getCONTENT_ID();
		$arr = $this->selectDB ($sql, 'ContentVO');
		$newContent = $arr[0];
		return $newContent;
	}
	
	public function findLastId () {
		$sql = "SELECT CONTENT_ID FROM CONTENT ORDER BY CONTENT_ID DESC LIMIT 1";
		$arr = $this->selectDB ($sql, 'ContentVO');
		if ($arr != null && count($arr) > 0) {
			$newContent = $arr[0];	
		} else {
			$newContent = null;
		}		
		return $newContent;
	}
	
	public function findLastActiveId () {
		$sql = "SELECT CONTENT_ID FROM CONTENT WHERE STATE = 'A' ORDER BY CONTENT_ID DESC LIMIT 1";
		$arr = $this->selectDB ($sql, 'ContentVO');
		if ($arr != null && count($arr) > 0) {
			$newContent = $arr[0];	
		} else {
			$newContent = null;
		}		
		return $newContent;
	}
	
	public function findLastActiveIdForContentType4 () {
		$sql = "SELECT CONTENT_ID, URL FROM CONTENT WHERE STATE = 'A' AND CONTENT_TYPE = 4 ORDER BY CONTENT_ID DESC LIMIT 1";
		$arr = $this->selectDB ($sql, 'ContentVO');
		if ($arr != null && count($arr) > 0) {
			$newContent = $arr[0];	
		} else {
			$newContent = null;
		}		
		return $newContent;
	}
	
	public function findLastSix () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, CREATION_DT, LAST_UPDATE_DT FROM CONTENT WHERE CONTENT_TYPE = 2 AND STATUS = 1 AND STATE = 'A' ORDER BY LAST_UPDATE_DT DESC, CREATION_DT DESC LIMIT 6";
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findLastContentType4 () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, URL, CREATION_DT, LAST_UPDATE_DT FROM CONTENT WHERE CONTENT_TYPE = 4 AND STATUS = 1 AND STATE = 'A' ORDER BY CONTENT_ID DESC LIMIT 1";
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findLastContentType5 () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, URL, MANAGEMENT, CREATION_DT, LAST_UPDATE_DT FROM CONTENT WHERE CONTENT_TYPE = 5 AND STATUS = 1 AND STATE = 'A' ORDER BY CONTENT_ID DESC LIMIT 1";
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findLastContentType6 () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, URL, MANAGEMENT, CREATION_DT, LAST_UPDATE_DT FROM CONTENT WHERE CONTENT_TYPE = 6 AND STATUS = 1 AND STATE = 'A' ORDER BY CONTENT_ID DESC LIMIT 1";
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findContentType4 () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, URL, CREATION_DT, LAST_UPDATE_DT FROM CONTENT WHERE CONTENT_TYPE = 4 AND STATUS = 1 AND STATE = 'A' ORDER BY CONTENT_ID DESC";
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findContentType5 () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, URL, MANAGEMENT FROM CONTENT WHERE CONTENT_TYPE = 5 AND STATUS = 1 AND STATE = 'A' ORDER BY CONTENT_ID DESC";
		return $this->selectDB ($sql, 'ContentVO');
	}
	
	public function findContentType6 () {
		$sql = "SELECT CONTENT_ID, CONTENT_TYPE, TITLE, URL, MANAGEMENT, PERIOD_START_MONTH, PERIOD_START_YEAR, PERIOD_END_MONTH, PERIOD_END_YEAR FROM CONTENT WHERE CONTENT_TYPE = 6 AND STATUS = 1 AND STATE = 'A' ORDER BY CONTENT_ID DESC";
		return $this->selectDB ($sql, 'ContentVO');
	}
    
}
?>