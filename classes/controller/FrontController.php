<?php

include '../Autoloader.php';

/**
 * Front Controller class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class FrontController {
	
	private $controller;
	private $action;
	
	public function __construct() {}
	
	public function getController () {
		return $this->controller;		
	}
	public function setController ($controller) {
		$this->controller = $controller;
    }
    
	public function getAction () {
		return $this->action;		
	}
	public function setAction ($action) {
		$this->action = $action;
    }
    
    /**
	 * Routes to the controller and correspondent action.
	 * 
	 * @return void
	 */
    public function route () {
    	$controller = null;
    	// gets the controller e action
    	$controllerName = $this->controller;
    	$actionName     = $this->action;
    	// instantiate the controller
    	$reflectionController = new ReflectionClass ($controllerName);
		$reflectionMethod = $reflectionController->getMethod ($actionName);   
		//create a new instance
		$obj = $reflectionController->newInstanceWithoutConstructor();
    	//invoking the specified action
    	$reflectionMethod->invoke ($obj, null);    	
    }
	
}
$controller = $_REQUEST['controller'];
$action     = $_REQUEST['action'];

//echo "controller: " . $controller;
//echo "action: " . $action;

//exit;

// instantiate the front controller
$frontController = new FrontController();
// setting the controller name and action
$frontController->setController ($controller);
$frontController->setAction ($action);
// routing to the correspondent controller and action
$frontController->route ();
?>