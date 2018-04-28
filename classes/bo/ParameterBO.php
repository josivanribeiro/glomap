<?php 

/**
 * ParameterBO business object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ParameterBO {
	
	private $parameterDAO;
			
	public function __construct() {
		$this->parameterDAO = new ParameterDAO();		
	}
		
	public function insert (ParameterVO $parameterVO) {
		$parameterVO  = $this->parameterDAO->insert ($parameterVO);		
		return $parameterVO;
	}
			
	public function update (ParameterVO $parameterVO) {
		$updatedRows = null;
		$updatedRows = $this->parameterDAO->update ($parameterVO);
		return $updatedRows;
	}
	
	public function delete (ParameterVO $parameterVO) {
		$updatedRows = null;
		$updatedRows = $this->parameterDAO->delete ($parameterVO);
		return $updatedRows;
	}
	
	public function find () {
		return $this->parameterDAO->find ();
	}
	
	public function findById (ParameterVO $parameterVO) {
		$parameterVO = $this->parameterDAO->findById ($parameterVO);
		return $parameterVO;
	}
	
	public function findByKey (ParameterVO $parameterVO) {
		$parameterVO = $this->parameterDAO->findByKey ($parameterVO);
		return $parameterVO;
	}
	
	/*public function findById () {
		$appMenuFile = '../../../config/app-menu.json';
		$jsonContent = file_get_contents ($appMenuFile);
		return $jsonContent;
	}*/
	
	public function findMenuNameById ($menuId) {
		$name = null;
		$parameterVO = new ParameterVO();
		$parameterVO->setKEY ("menu-site");
		$parameterVO = $this->parameterDAO->findByKey ($parameterVO);
		$jsonContent = $parameterVO->getVALUE();
		$menuArr = json_decode ($jsonContent, true);
		foreach ($menuArr as $menu) {			
			if (strcmp ($menu['id'], $menuId) == 0) {
				$name = $menu['value'];
				break;			
			} else if (is_array ($menu['menuitem']) && count($menu['menuitem']) > 0) {				
				$menuItemArr = $menu['menuitem'];				
				foreach ($menuItemArr as $menuItem) {
					if (strcmp ($menuItem['id'], $menuId) == 0) {
						$name = $menuItem['value'];
						break;
					}
				}								
			}								
		}
		return $name;
	}
}
?>