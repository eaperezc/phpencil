<?php
/**
 * Controller definition file
 *
 * In this file I defined the class for the parent controller
 * for the phpencil applicacion.
 * @package Core
 * @subpackage Controller
 * @author Enrique Perez Clavier
 * @version 0.1
 */

include_once dirname(__FILE__).'/View.php';
include_once dirname(__FILE__).'/Model.php';

/**
 * The class definition for the "Controller" Object
 *
 * This class has the setup for the actions to be called
 * and the request for rendering the view
 * @package Core
 */
class Controller {

    var $name = '';
    var $_view = '';
    
    var $models = array();

    /**
     * Initializes all controllers required variables
     * @param string $name controller name
     */
    public function  __construct($name) {
        $this->setName($name);
        $this->_view = new View($name);
        $this->setupModels();
    }

    /**
     *This is the function that will require all the models that 
     * the programmer wants to use in a controller 
     */
    private function setupModels(){
        foreach ($this->models as $model) {
            if(file_exists(dirname(__FILE__).'/../model/' . $model . '.php')){
                require_once dirname(__FILE__).'/../model/' . $model . '.php';
                $this->{$model} = new $model;
            }
        }
    }
    
    /**
     * sets the name for the view rendering
     * @param string $name controller name
     */
    public function setName($name){
        $this->name = $name;
    }
    
    /**
     * sets the name for the view template
     * @param string $name template name
     */
    public function useTemplate($name){
        $this->_view->setTemplate($name);
    }

    /**
     * Executes the requested action for the controller
     */
    public function executeAction($action, $id = 0) {
        if(method_exists($this, $action)){
            $this->_viewVars = array();
            $this->_view->addViewVar('_id', $id);
            $this->$action($id);
            $this->_view->render($action);
        }
        else {
            $this->renderError('ACTION', $action);
        }
    }

    /**
     * Sets a variable that will be used in the view
     * @param string $name
     * @param any $value 
     */
    public function set($name, $value){
        $this->_view->addViewVar($name, $value);
    }
    
    /**
     * Renders the error depending on the type and the
     * debug level. The error types here are:
     *   - ACTION
     *   - VIEW
     * @param string $errorType
     * @param string $action this is the name of the action
     */
    private function renderError($errorType, $action){
        if(!DEBUG){
            if(file_exists(ERRORS_PATH . '404.php'))
                include(ERRORS_PATH . '404.php');
        }
        else {
            switch ($errorType){
                case 'ACTION':
                    echo 'Action execution failed. Action --'. $action .'-- not defined.';
                break;
                case 'VIEW':
                    echo 'No view is defined for this action --> ' . $action;
                break;
            }
        }
    }

}

?>