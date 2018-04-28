<?php
/**
 * GalleryDAO Data Access Object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class GalleryDAO extends AbstractDAO {
	
	public function __construct() {		
		parent::__construct();
	}
		
	public function insert (GalleryVO $galleryVO) {
		$sql = "INSERT INTO GALLERY (USER_ID, LEGEND, DESCRIPTION, CREATION_DT, STATUS) 
				VALUES (".$galleryVO->getUSER_ID().", '".$galleryVO->getLEGEND()."', '".$galleryVO->getDESCRIPTION()."', NOW(),".$galleryVO->getSTATUS().")";
		$galleryId = $this->insertDb ($sql);
		$galleryVO->setGALLERY_ID ($galleryId);
		return $galleryVO;
    }   
    
	public function update (GalleryVO $galleryVO) {
		$sql = "UPDATE GALLERY SET USER_ID=".$galleryVO->getUSER_ID().", LEGEND='".$galleryVO->getLEGEND()."', DESCRIPTION='".$galleryVO->getDESCRIPTION()."', LAST_UPDATE_DT=NOW(), STATUS=".$galleryVO->getSTATUS()." WHERE GALLERY_ID = ".$galleryVO->getGALLERY_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }
    
	public function updateLastUpdateDate (GalleryVO $galleryVO) {
		$sql = "UPDATE GALLERY SET LAST_UPDATE_DT=NOW() WHERE GALLERY_ID = ".$galleryVO->getGALLERY_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }

	public function delete (GalleryVO $galleryVO) {
		$sql = "DELETE FROM GALLERY WHERE GALLERY_ID = ".$galleryVO->getGALLERY_ID();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }
		
	public function find (Pagination $pagination) {
		$sql = "SELECT GALLERY_ID, USER_ID, LEGEND, DESCRIPTION, CREATION_DT, LAST_UPDATE_DT, STATUS FROM GALLERY ORDER BY GALLERY_ID LIMIT " . $pagination->getLIMIT();			
		return $this->selectDB ($sql, 'GalleryVO');
	}
	
	public function findRowCount () {
		$sql = "SELECT COUNT(*) FROM GALLERY";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;
	}
	
	public function findById (GalleryVO $galleryVO) {
		$sql = "SELECT GALLERY_ID, USER_ID, LEGEND, DESCRIPTION, CREATION_DT, LAST_UPDATE_DT, STATUS FROM GALLERY WHERE GALLERY_ID = " . $galleryVO->getGALLERY_ID();
		$arr = $this->selectDB ($sql, 'GalleryVO');
		$newGalleryVO = $arr[0];
		return $newGalleryVO;
	}
	
	public function findLastThree () {
		$sql = "SELECT GALLERY_ID, LEGEND ";
		$sql .= "FROM GALLERY ";
		$sql .= "WHERE STATUS = 1 ";
		$sql .= "ORDER BY GALLERY_ID DESC LIMIT 3";
		return $this->selectDB ($sql, 'GalleryVO');
	}
	
	public function findOther (GalleryVO $galleryVO) {
		$sql = "SELECT GALLERY_ID, LEGEND ";
		$sql .= "FROM GALLERY ";
		$sql .= "WHERE GALLERY_ID <> " . $galleryVO->getGALLERY_ID() . " AND STATUS = 1 ";
		$sql .= "ORDER BY GALLERY_ID";
		return $this->selectDB ($sql, 'GalleryVO');
	}
    
}
?>