<?php
/**
 * View definition file
 *
 * In this file I defined the class views functionality
 * @package Core
 * @subpackage View
 * @author Enrique Perez Clavier
 * @version 0.1
 */

/**
 * The class definition for the "View" Object
 *
 * This class has the functionality that the view requires
 * to add assets, rendering and some other stuff
 * @package Core
 */
class View {

    private $_template = 'default';
    
    private $_controller = '';
    private $_vars = array();

    /**
     * Initializes the view required variables
     * @param string $controller controller name
     */
    public function  __construct($controller) {
        $this->_controller = $controller;
    }

    /**
     * Sets a variable that will be used in the view
     * @param string $name
     * @param any $value 
     */
    public function addViewVar($name, $value){
        $this->_vars[$name] = $value;
    }
     
    /**
     * Sets the template used in the rendering
     * @param string $template the template name
     */
    public function setTemplate($template){
        $this->_template = $template;
    }

    /**
     * renders the requested view
     */
    public function render($action){
        $viewPath = VIEWS_PATH . $this->_controller.'/'.  $action.'.php';
        if(file_exists($viewPath)){
            foreach ($this->_vars as $name => $value){
                $$name = $value;
            }
            ob_start();                                     //This prepares the output buffer
            include($viewPath);                     //I included the view file ot store it
            $_yield = ob_get_contents();     //Use the output contents
            ob_end_clean();                           //Clean the output buffer
            
            include TEMPLATES_PATH . $this->_template . '.php';
        }
        else{
            $this->renderError('VIEW', $action);
        }
    }
    
    public function stylesheet($name){
         echo '<link rel="stylesheet" href="' . ASSETS_PATH . 'stylesheets/' . $name . '.css" type="text/css" />';
    }
    
    public function javascript($name){
         echo '<script src="' . ASSETS_PATH . 'javascripts/' . $name . '.js" type="text/javascript" />';
    }
    
    public function image($name){
         echo '<img src="' . ASSETS_PATH . 'images/' . $name . '" />';
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