<?php
/**
 * Core controller class
 *
 * This is the parent class for all the controllers in out app.
 * It will handle the presenting of the views to the users and
 * making the connection to our model objects.
 *
 * @category   Controllers
 * @package    Core
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since Version 0.1
 */
class Controller
{
    /**
     * Model names
     *
     * Array of strings that includes the model names that will
     * be used in the controller.
     *
     * @var array
     * @access protected
     */
    protected $models = [];

    /**
     * Presenter
     *
     * A reference to the presenter.
     *
     * @see code/Presenter.php
     * @var Presenter
     * @access protected
     */
    protected $view;

    /**
     * Request Parameters
     *
     * All the parameters that were passed to
     * the controller using the router.
     *
     * @access protected
     */
    protected $params;

    /**
     * Constructor for the class
     *
     * Initializes the object main properties and sets it
     * up for further uses
     *
     * @access public
     */
	public function __construct($params) {

        // Here we initialize the controllers properties.
        $this->params = $params;

        // Then we prepare out presenter view object
        $this->view = new Presenter();

	}

    /**
     * __get Magic Method
     *
     * With this getter the developer can access models that were already
     * defined on the model array.
     */
    public function __get($reference) {

        // We return the model if it exists
        if ( class_exists( $reference )) {
            return new $reference();
        }

        // We return the property if it is a property
        if ( property_exists( $this, $reference )) {
            return $this->$reference;
        }

        // The class is not defined
        return null;
    }

    /**
     * __call Magic Method
     *
     * Intercepts a call so we can do dynamic methods for the
     * actions inside of the controllers.
     *
     * @param string  the name of the called method
     * @param array   The arguments passed to the method.
     *
     * @throws InvalidActionException when the action is not defined.
     *
     * @since 0.1
     */
    public function callAction($method)
    {
        /*
         * Here we will check if the called method is defined.
         * If is not defined we will throw an exception to alert the developer.
         */
        if ( method_exists($this, $method) ) {

            // This is the definition of each action workflow.
            // Helper method to be called before the method is called
            $this->beforeAction();

            // Call the requested method
            $this->$method();

            // Helper method to be called after the method is called
            $this->afterAction();

            // Last part of an action. We render the template
            $this->view->render();
        }
    }

    /**
     * beforeAction method
     *
     * This method will be called before every action of the controller.
     * Is a helper method to be used as an override.
     *
     * @since 0.1
     */
    protected function beforeAction ()
    {
        # Nothing to do here
    }

    /**
     * afterAction method
     *
     * This method will be called after every action of the controller.
     * Is a helper method to be used as an override.
     *
     * @since 0.1
     */
    protected function afterAction ()
    {
        # Nothing to do here
    }

}
