<?php
/**
 * Router definition file
 *
 * This class defines the routing methods that will make the
 * framework able to redirect the url to the specific controller,
 * action and id depending on the request.
 * @package Core
 * @subpackage Router
 * @author Enrique Perez Clavier
 * @version 0.1
 */

include_once dirname(__FILE__).'/Controller.php';

/**
 * The class definition for the "Router" Object
 *
 * Core class that shouldn't be modified lightly
 * @package Core
 */
class Router {

    private $_controllerName;   #used for the URI controller name
    private $_action;                   #used for the actual controller method action name
    private $_id;                          #this is the id parameter for the actions that requires them
    private $_controller;             #the controller to be called

    /**
     * Initializes the required redirectioning variables:
     * Controller, action and id
     */
    public function  __construct() {
        $request = str_replace(ROOT_PATH, "", substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1) . $_SERVER['REQUEST_URI']);  #remove the directory path we don't want
        $params = explode("/", $request);
        if($this->setupController($params) && $this->setupAction($params)){
            $this->_controller->executeAction($this->_action, $this->_id);   #Calls the requested method for the controller
        }
    }

    /**
     * Validates and Prepares the controller data
     * @param array $params the array of URI variables
     * @return bool success or failure for the validation
     */
    private function setupController($params){
        $this->_controllerName = (isset($params[0]) && !empty ($params[0]))?$params[0]:'pages';
        if(file_exists(dirname(__FILE__).'/../controller/'.$this->_controllerName.'.php')){
            include_once dirname(__FILE__).'/../controller/'.$this->_controllerName.'.php';
            $auxControllerName = $this->_controllerName . 'Controller';
            $this->_controller = new $auxControllerName($this->_controllerName, sizeof($params));  #initializes the controller object
            return true;
        }
        $this->renderError('CONTROLLER');
        return false;
    }

    /**
     * Validates and Prepares the action data
     * @param array $params the array of URI variables
     * @return bool success or failure for the validation
     */
    private function setupAction($params){
        $this->_action = (isset($params[1]) && !empty ($params[1]))?$params[1]:'index';
        if(method_exists($this->_controller, $this->_action)){
            $this->_id = (isset($params[2]) && !empty ($params[2]))?$params[2]:0;
            return true;
        }
        $this->renderError('ACTION');
        return false;
    }
    
    /**
     * Renders the error depending on the type and the
     * debug level. The error types here are:
     *   - CONTROLLER
     *   - ACTION
     * @param string $errorType
     */
    private function renderError($errorType){
        if(!DEBUG){
            if(file_exists(ERRORS_PATH . '404.php'))
                include(ERRORS_PATH . '404.php');
        }
        else {
            switch ($errorType){
                case 'CONTROLLER':
                    echo 'Controller file --' . $this->_controllerName.'.php-- is not defined.';
                break;
                case 'ACTION':
                    echo 'Action --' . $this->_action. '--  for the controller --' . $this->_controllerName.'.php--  is not defined.';
                break;
            }
        }
    }

}

?>