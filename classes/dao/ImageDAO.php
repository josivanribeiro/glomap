<?php
/**
 * ImageDAO Data Access Object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ImageDAO extends AbstractDAO {
	
	public function __construct() {		
		parent::__construct();
	}
		
	public function insert ($galleryId, $image, $imageHeight, $imageWidth, $imageSize, $imageThumb, $imageTumbHeight, $imageThumbWidth, $imageThumbSize, $name, $legend, $coverImage) {		
		$success = false;
		$sql = "INSERT INTO IMAGE (GALLERY_ID, IMAGE, IMAGE_HEIGHT, IMAGE_WIDTH, IMAGE_SIZE, IMAGE_THUMB, IMAGE_THUMB_HEIGHT, IMAGE_THUMB_WIDTH, IMAGE_THUMB_SIZE, NAME, LEGEND, COVER_IMAGE, CREATION_DT)  
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
		$connection = parent::connect();
		try {
			$stmt = $connection->prepare ($sql);			
			$stmt->bindParam (1, $galleryId);
			$stmt->bindParam (2, $image, PDO::PARAM_LOB);
			$stmt->bindParam (3, $imageHeight);
			$stmt->bindParam (4, $imageWidth);
			$stmt->bindParam (5, $imageSize);
			$stmt->bindParam (6, $imageThumb, PDO::PARAM_LOB);
			$stmt->bindParam (7, $imageTumbHeight);
			$stmt->bindParam (8, $imageThumbWidth);
			$stmt->bindParam (9, $imageThumbSize);
			$stmt->bindParam (10, $name);
			$stmt->bindParam (11, $legend);
			$stmt->bindParam (12, $coverImage);
			$stmt->execute ();
			$success = true;
			//$rs = $connection->lastInsertId();
		} catch (Exception $e) {
			die (print_r($stmt->errorInfo(), true));			
		}
		parent::__destruct();		
		return $success;
    }
    
	public function updateLegend (ImageVO $imageVO) {
		$sql = "UPDATE IMAGE SET LEGEND='" . $imageVO->getLEGEND() . "' WHERE IMAGE_ID = " . $imageVO->getIMAGE_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }
    
    public function updateCoverImage (ImageVO $imageVO) {
		$sql = "UPDATE IMAGE SET COVER_IMAGE = 1 WHERE IMAGE_ID = " . $imageVO->getIMAGE_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }
    
	public function removeCoverImage (ImageVO $imageVO) {
		$sql = "UPDATE IMAGE SET COVER_IMAGE = 0 WHERE IMAGE_ID = " . $imageVO->getIMAGE_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }
    
	public function delete (ImageVO $imageVO) {
		$sql = "DELETE FROM IMAGE WHERE IMAGE_ID = " . $imageVO->getIMAGE_ID();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }
		
	public function findByGallery (GalleryVO $galleryVO) {
		$sql = "SELECT IMAGE_ID, GALLERY_ID, IMAGE, IMAGE_HEIGHT, IMAGE_WIDTH, IMAGE_SIZE, IMAGE_THUMB, IMAGE_THUMB_HEIGHT, IMAGE_THUMB_WIDTH, IMAGE_THUMB_SIZE, NAME, LEGEND, COVER_IMAGE, CREATION_DT FROM IMAGE WHERE GALLERY_ID = " . $galleryVO->getGALLERY_ID() . " ORDER BY IMAGE_ID";			
		return $this->selectBlobDb ($sql, 'ImageVO');
	}
	
	public function findByGalleryWithCoverImage (GalleryVO $galleryVO) {
		$sql = "SELECT IMAGE_ID, GALLERY_ID, NAME, IMAGE_THUMB FROM IMAGE WHERE GALLERY_ID = " . $galleryVO->getGALLERY_ID() . " AND COVER_IMAGE = 1";			
		$arr = $this->selectBlobDb ($sql, 'ImageVO');
		return $arr;
	}
	
	public function findById (ImageVO $imageVO) {
		$sql = "SELECT IMAGE_ID, GALLERY_ID, IMAGE, IMAGE_HEIGHT, IMAGE_WIDTH, IMAGE_SIZE, IMAGE_THUMB, IMAGE_THUMB_HEIGHT, IMAGE_THUMB_WIDTH, IMAGE_THUMB_SIZE, NAME, LEGEND, COVER_IMAGE, CREATION_DT FROM IMAGE WHERE IMAGE_ID = " . $imageVO->getIMAGE_ID();
		$arr = $this->selectBlobDb ($sql, 'ImageVO');
		$newImageVO = $arr[0];
		return $newImageVO;
	}
	
	public function findByCoverImage (ImageVO $imageVO) {
		$sql = "SELECT COUNT(*) FROM IMAGE WHERE GALLERY_ID = " . $imageVO->getGALLERY_ID() . " AND COVER_IMAGE = 1";
		$rowCount = $this->rowCount ($sql);
		return $rowCount;		
	}
    
}
?>