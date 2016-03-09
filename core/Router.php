<?php
/**
 * Router of the application
 *
 * This class handles the routing of the app. This will
 * get the controller name, action and parameters (if any).
 *
 * @category   Core
 * @package    Router
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since 2015
 */
class Router
{
    // Request controller
    private $controller = '';
    // Request action
    private $action = '';
    // Request url parameters
    private $args = [];

    /**
     * Getter for the controller name
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Getter for the action name
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Getter for the arguments array
     */
    public function getArguments()
    {
        return $this->args;
    }

    /**
     * Get the Controller File Path
     *
     * With this method we return the full path of
     * the requested controller class file.
     *
     * @return string $controller_path The path of the controller php file
     */
    public function getControllerFilePath()
    {
        // We prepare the requested controller path
        $controller_name = ucfirst($this->controller) . 'Controller';
        $controller_path = APP_DIR . 'controllers/' . $controller_name . '.php';
        
        // return the controller file path
        return $controller_path;
    }

    /**
     * Constructor for the class
     *
     * Initializes the object main properties and sets it
     * up for further uses
     *
     * @access public
     */
	public function __construct ()
	{
        // Clean the url data to get the parameters
        $pagePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        $cleanParams = explode('/', str_replace($pagePath, '', $_SERVER['REDIRECT_URL']));

        // Controller and action. Index action is default if not defined
        $this->controller   = !empty($cleanParams[1])?$cleanParams[1]:'main';
        $this->action       = !empty($cleanParams[2])?$cleanParams[2]:'index';

        // Get the parameters of the request
        $argsLength = sizeof($cleanParams);
        for ($argsIndex = 3; $argsIndex < $argsLength; $argsIndex++) {
            $this->args[] = $cleanParams[$argsIndex];
        }
	}

	/**
	 * Route to action
	 *
	 * Redirects the request to the specfic controller and action. If the
	 * action doesn't exist it redirects to the error pages.
	 *
	 * @param array  the parameters of the url
	 * @return int   the integer of the set mode used. FALSE if foo
	 *               foo could not be set.
	 * @since 0.1
	 */
	public function route()
	{
        try {
            // We prepare the requested controller path
            $controller_name = ucfirst($this->controller) . 'Controller';
            $controller_path = $this->getControllerFilePath();

            // Validate that the controller file exist
            if ( !file_exists($controller_path) ) {
                $error =  $controller_name . '.php' . ' - Controller file doesn\'t exist.';
                throw new Exception($error);
            }

            // We include the controller
            require_once( $controller_path );

            // Instantiate the controller
            $controller = new $controller_name($this->args);

            // Validate that the method for the action is defined
            if ( !method_exists ($controller, $this->action) ) {
                throw new Exception('Action "' . $this->action . '" is not available');
            }

            // Call the action
            $controller->callAction($this->action);

        } catch( Exception $e ) {
            // Here we will capture any problem found on the routing
            $view = new Presenter();
            $view->renderError($e->getMessage());
        }

	}


}
