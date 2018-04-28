<?php
/**
 * ParameterDAO Data Access Object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ParameterDAO extends AbstractDAO {
	
	public function __construct() {
		parent::__construct();
	}
		
	public function insert (ParameterVO $parameterVO) {
		$sql = "INSERT INTO PARAMETER (`KEY`, VALUE) 
				VALUES ('" . $parameterVO->getKEY() . "', '" . $parameterVO->getVALUE() . "')";
		$parameterId = $this->insertDb ($sql);
		$parameterVO->setPARAMETER_ID ($parameterId);
		return $parameterVO;
    }   
    
	public function update (ParameterVO $parameterVO) {
		$sql = "UPDATE PARAMETER SET `KEY` = '". $parameterVO->getKEY() . "', VALUE = '" . $parameterVO->getVALUE() . "' WHERE PARAMETER_ID = " . $parameterVO->getPARAMETER_ID();
		$updatedRows = $this->queryDb ($sql);
		return $updatedRows;
    }

	public function delete (ParameterVO $parameterVO) {
		$sql = "DELETE FROM PARAMETER WHERE PARAMETER_ID = " . $parameterVO->getPARAMETER_ID();
		$rowCount = $this->queryDb ($sql);
		return $rowCount;
    }
	
    public function find () {
		$sql = "SELECT PARAMETER_ID, `KEY`, VALUE FROM PARAMETER ORDER BY PARAMETER_ID";			
		return $this->selectDB ($sql, 'ParameterVO');
	}
	
	public function findById (ParameterVO $parameterVO) {
		$sql = "SELECT PARAMETER_ID, `KEY`, VALUE FROM PARAMETER WHERE PARAMETER_ID = " . $parameterVO->getPARAMETER_ID();
		$arr = $this->selectDB ($sql, 'ParameterVO');
		$newParameter = $arr[0]; 
		return $newParameter;
	}
	
	public function findByKey (ParameterVO $parameterVO) {
		$whereClause = "WHERE `KEY` = '" . $parameterVO->getKEY() . "'";		
		if (!empty($parameterVO->getPARAMETER_ID())) {
			$whereClause .= " AND PARAMETER_ID <> " . $parameterVO->getPARAMETER_ID(); 
		}		
		$sql = "SELECT PARAMETER_ID, `KEY`, VALUE FROM PARAMETER " . $whereClause;
		$arr = $this->selectDB ($sql, 'ParameterVO');
		if (isset($arr) && count($arr) > 0) {
			$newParameter = $arr[0];	
		} else {
			$newParameter = null;
		}		 
		return $newParameter;
	}
	    
}
?>