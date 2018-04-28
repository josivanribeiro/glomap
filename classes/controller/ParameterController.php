<?php

/**
 * Parameter Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class ParameterController {
	
	private $parameterBO;
	
	public function __construct() {}
	
	/**
	 * Inserts or updates a new parameter.
	 * 
	 * @return void
	 */
	public function updateParameter() {
		$result    = 0;//(-2=invalidJSONError,-1=keyAlreadyExistsError,0=genericError,1=insertSuccess,2=updateSuccess)
		$id        = $_REQUEST['id'];
		$key  	   = $_REQUEST['key'];
		$value     = $_REQUEST['value'];
				
		$parameterVO = new ParameterVO();
		$parameterVO->setPARAMETER_ID ($id);
		$parameterVO->setKEY ($key);
		$parameterVO->setVALUE ($value);
		$this->parameterBO = new ParameterBO();

		$parameterVOExists = $this->parameterBO->findByKey ($parameterVO);
		
		if (!Utils::isJSON ($parameterVO->getVALUE())) {
			$result = -2;
		} else if ($parameterVOExists != null) {
			$result = -1;
		} else if ($id == null) {
			$newParameterVO = $this->parameterBO->insert ($parameterVO);			
			if ($newParameterVO->getPARAMETER_ID () > 0) {
				$result = 1;
			}			
		} else {
			$rowCount = $this->parameterBO->update ($parameterVO);
			if ($rowCount > 0) {
				$result = 2;
			}
		}
		echo $result;
	}
	
	/**
	 * Loads an parameter.
	 * 
	 * @return void
	 */
	public function loadParameter() {
		$parameterId = $_REQUEST['id'];	
		$parameterVO = new ParameterVO();
		$parameterVO->setPARAMETER_ID ($parameterId);				
		$this->parameterBO = new ParameterBO();
		$newParameterVO = $this->parameterBO->findById ($parameterVO);		
		echo $newParameterVO->getPARAMETER_ID ()
			 . "|" . $newParameterVO->getKEY ()
			 . "|" . $newParameterVO->getVALUE ();
	}
	
	/**
	 * Deletes a parameter.
	 * 
	 * @return void
	 */
	public function deleteParameter() {
		$parameterId = $_REQUEST['id'];
		$parameterVO = new ParameterVO();
		$parameterVO->setPARAMETER_ID ($parameterId);				
		$this->parameterBO = new ParameterBO();
		$countRows = $this->parameterBO->delete ($parameterVO);		
		echo $countRows;
	}
	
	/**
	 * Renders the user HTML table.
	 * 
	 * @return void
	 */
	public function renderTable() {
		$arr = $this->find();
		echo "<table id=\"parametersTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<td width=\"5%;\">Id</td>";
		echo "			<td width=\"95%;\">Key</td>";
		echo "		</tr>";
		echo "	</thead>";
		foreach ($arr as $key => $parameter) {
			echo "<tr onClick=\"javascript:editParameter('" . $parameter->getPARAMETER_ID() . "');\" onmouseover=\"changeBackgroundColor(this, '#ebf3fb');\" onmouseout=\"changeBackgroundColor(this, '#fff');\" style=\"cursor: pointer;\">";
			echo "	<td width=\"5%;\">";
			echo "		<div id=\"container-table-item-label\">" . $parameter->getPARAMETER_ID() . "</div>";
			echo "	</td>";
			echo "	<td width=\"95%;\">";
			echo "		<div id=\"container-table-item-label\">" . $parameter->getKEY() . "</div>";
			echo "	</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	/**
	 * Finds all the parameters.
	 * 
	 * @return $arr array of parameters.
	 */
	public function find () {		
		$this->parameterBO = new ParameterBO();
		$arr = $this->parameterBO->find ();
		return $arr;
	}
		
}

?>