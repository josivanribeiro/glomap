<?php 

/**
 * GalleryBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class GalleryBO {
	
	private $galleryDAO;
	private $imageDAO;
		
	public function __construct() {
		$this->galleryDAO = new GalleryDAO();
		$this->imageDAO   = new ImageDAO();
	}
		
	public function insert (GalleryVO $galleryVO) {
		$galleryVO  = $this->galleryDAO->insert ($galleryVO);		
		$this->insertGalleryImages ($galleryVO);
		return $galleryVO;
	}
			
	public function update (GalleryVO $galleryVO) {
		$updatedRows = null;
		$updatedRows = $this->galleryDAO->update ($galleryVO);
		if ($updatedRows > 0) {
			$this->insertGalleryImages ($galleryVO);				
		}		
		return $updatedRows;
	}
	
	public function updateImageLegend (ImageVO $imageVO) {
		$updatedRows = null;
		$updatedRows = $this->imageDAO->updateLegend ($imageVO);
		$this->updateLastUpdateDate ($imageVO);
		return $updatedRows;
	}
	
	public function updateCoverImage (ImageVO $imageVO) {
		$updatedRows = null;
		$updatedRows = $this->imageDAO->updateCoverImage ($imageVO);
		$this->updateLastUpdateDate ($imageVO);		
		return $updatedRows;
	}

	public function removeCoverImage (ImageVO $imageVO) {
		$updatedRows = null;
		$updatedRows = $this->imageDAO->removeCoverImage ($imageVO);
		$this->updateLastUpdateDate ($imageVO);		
		return $updatedRows;
	}
	
	public function delete (GalleryVO $galleryVO) {
		$updatedRows = null;
		$updatedRows = $this->galleryDAO->delete ($galleryVO);
		return $updatedRows;
	}
	
	public function deleteImage (ImageVO $imageVO) {
		$updatedRows = null;
		$updatedRows = $this->imageDAO->delete ($imageVO);
		$this->updateLastUpdateDate ($imageVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		return $this->galleryDAO->find ($pagination);
	}
	
	public function findRowCount () {
		$rowCount = null;
		$rowCount = $this->galleryDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (GalleryVO $galleryVO) {
		$galleryVO = $this->galleryDAO->findById ($galleryVO);
		$imageVOArr = $this->imageDAO->findByGallery ($galleryVO);
		$galleryVO->setIMAGEVO_ARR ($imageVOArr);
		return $galleryVO;
	}
	
	public function findLastThree () {
		$galleryVOArr = $this->galleryDAO->findLastThree ();
		foreach ($galleryVOArr as $galleryVO) {
			$imageVOArr = $this->imageDAO->findByGalleryWithCoverImage ($galleryVO);
			$galleryVO->setIMAGEVO_ARR ($imageVOArr);		
		}
		return $galleryVOArr;
	}
	
	public function findOther (GalleryVO $galleryVO) {
		$galleryVOArr = $this->galleryDAO->findOther ($galleryVO);
		return $galleryVOArr;
	}
	
	public function findImageById (ImageVO $imageVO) {
		$imageVO = $this->imageDAO->findById ($imageVO);
		return $imageVO;
	}
	
	public function findByCoverImage (ImageVO $imageVO) {
		$rowCount = null;
		$rowCount = $this->imageDAO->findByCoverImage ($imageVO);
		return $rowCount;		
	}	

	private function insertGalleryImages (GalleryVO $galleryVO) {
		if ($galleryVO->GetGALLERY_ID() > 0) {
			foreach ($galleryVO->getIMAGEVO_ARR() as $imageVO) {
				$this->imageDAO->insert ($galleryVO->getGALLERY_ID(), $imageVO->getIMAGE(), $imageVO->getIMAGE_HEIGHT(), $imageVO->getIMAGE_WIDTH(), $imageVO->getIMAGE_SIZE(), $imageVO->getIMAGE_THUMB(), $imageVO->getIMAGE_THUMB_HEIGHT(), $imageVO->getIMAGE_THUMB_WIDTH(), $imageVO->getIMAGE_THUMB_SIZE(), $imageVO->getNAME(), $imageVO->getLEGEND(), $imageVO->getCOVER_IMAGE());								
			}
		}
	}

	private function updateLastUpdateDate (ImageVO $imageVO) {
		$galleryVO = new GalleryVO();
		$galleryVO->setGALLERY_ID ($imageVO->getGALLERY_ID());
		$this->galleryDAO->updateLastUpdateDate ($galleryVO);
	}
}
?>