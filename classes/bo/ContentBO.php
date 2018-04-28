<?php 

/**
 * ContentBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ContentBO {
	
	private $contentDAO;
			
	public function __construct() {
		$this->contentDAO = new ContentDAO();		
	}
		
	public function insert (ContentVO $contentVO) {
		$contentVO  = $this->contentDAO->insert ($contentVO);
		return $contentVO;
	}
			
	public function update (ContentVO $contentVO) {
		$updatedRows = null;
		$updatedRows = $this->contentDAO->update ($contentVO);
		return $updatedRows;
	}
	
	public function delete (ContentVO $contentVO) {
		$updatedRows = null;
		$updatedRows = $this->contentDAO->delete ($contentVO);
		return $updatedRows;
	}
	
	public function find (Pagination $pagination) {
		return $this->contentDAO->find ($pagination);
	}
	
	public function findOtherContents (ContentVO $contentVO) {
		return $this->contentDAO->findOtherContents ($contentVO);
	}
	
	public function findRowCount () {
		$rowCount = null;
		$rowCount = $this->contentDAO->findRowCount ();
		return $rowCount;
	}
	
	public function findById (ContentVO $contentVO) {
		$contentVO = $this->contentDAO->findById ($contentVO);
		return $contentVO;
	}
	
	public function findLastId () {
		$contentVO = $this->contentDAO->findLastId ();
		return $contentVO;
	}
	
	public function findLastActiveId () {
		$contentVO = $this->contentDAO->findLastActiveId();
		return $contentVO;
	}
	
	public function findLastActiveIdForContentType4 () {
		$contentVO = $this->contentDAO->findLastActiveIdForContentType4();
		return $contentVO;
	}
	
	public function findLastSix () {
		return $this->contentDAO->findLastSix ();
	}
	
	public function findLastContentType4 () {
		return $this->contentDAO->findLastContentType4 ();
	}
	
	public function findLastContentType5 () {
		return $this->contentDAO->findLastContentType5 ();
	}
	
	public function findLastContentType6 () {
		return $this->contentDAO->findLastContentType6 ();
	}
	
	public function findContentType4 () {
		return $this->contentDAO->findContentType4 ();
	}
	
	public function findContentType5 () {
		return $this->contentDAO->findContentType5 ();
	}
	
	public function findContentType6 () {
		return $this->contentDAO->findContentType6 ();
	}
		
}
?>