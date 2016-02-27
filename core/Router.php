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
        // Get the parameters of the URL
        $url_params = $this->getUrlParameters();

        // Redirect to the controller action
        $this->route($url_params);
	}

	/**
	 * getUrlParameters
	 *
	 * Method that gets the parameters of the request
	 *
	 * @return array parameters of the request.
	 * @since 0.1
	 */
	private function getUrlParameters ()
	{
		// Clean the url data to get the parameters
	    $pagePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
	    $cleanParams = explode('/', str_replace($pagePath, '', $_SERVER['REDIRECT_URL']));

	    // Controller and action. Index action is default if not defined
        $params = [
        	'controller' => !empty($cleanParams[1])?$cleanParams[1]:'main',
        	'action' 	 => !empty($cleanParams[2])?$cleanParams[2]:'index'
        ];

        // Get the parameters of the request
        $argsLength = sizeof($cleanParams);
        for ($argsIndex = 3; $argsIndex < $argsLength; $argsIndex++) { 
        	$params['args'][] = $cleanParams[$argsIndex];
        }

        return $params;
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
	private function route($params)
	{

        try {
            // We prepare the requested controller path
            $controller_name = ucfirst($params['controller']);
            $controller_path = APP_DIR . 'controllers/' . ucfirst($params['controller'] . '.php');

            // Validate that the controller file exist
            if ( !file_exists($controller_path) ) {

                // A controller needs to be defined (will never happen)
                if ( empty($params['controller']) ){
                    throw new Exception('No controller was defined in the request.');
                }

                $error = (ucfirst($params['controller'] . '.php') . ' - Controller file doesn\'t exist.');
                throw new Exception($error);
            }

            // We include the controller
            require_once( $controller_path );

            // Instantiate the controller
            $controller = new $controller_name( 
                isset($params['args'])? $params['args']: null 
            );

            // Validate that the method for the action is defined
            if ( !method_exists ($controller, $params['action']) ) {
                throw new Exception('Action "' . $params['action'] . '" is not available');
            }

            // Call the action
            $controller->callAction($params['action']);

        } catch( Exception $e ) {
            // Here we will capture any problem found on the routing
            $view = new Presenter();
            $view->renderError($e->getMessage());
        }
		
	}


}

