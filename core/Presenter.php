<?php
/**
 * Presenter of the views
 *
 * This class is the one that handles the rendering of the
 * views and templates. Here we can define variables, scripts,
 * headers and anything needed to display the view.
 *
 * @category   View
 * @package    Core
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since 2015
 */
class Presenter
{
    /**
	 * This is the main template variable
	 * 
	 * This template defines the global layout to be used.
	 */
	public $layout = 'default.php';

	/**
	 * Content tpl for the specific action.
	 * 
	 * This template defines content that will be used inside of 
	 * the layout_tpl. Usually its different per controller action.
	 */
	public $content_tpl = 'errors/404.php';

    /**
     * View variables.
     * 
     * All variables defined here will be accessable by the templates.
     * with the 'assign' method we add them from the controllers.
     */
    private $vars;

    /**
     * Template Engine.
     * 
     * Engine used to render the templates.
     */
    private $engine;

    /**
     * Constructor for the class
     *
     * Initializes the object main properties and sets it
     * up for further uses
     *
     * @access public
     */
    public function __construct() {
        
        // Here we initialize the controllers properties.
        $this->vars = [];

        // Here we initialize the template engine "Twig"
        $loader = new Twig_Loader_Filesystem( APP_DIR . 'views/');
        $this->engine = new Twig_Environment($loader);

    }

    /**
     * Assigns a variable to the view
     *
     * With this method we assign variables to be used in the template.
     * Template variables should be defined per view.
     *
     * @param mixed  The variable to be assigned to the view.
     * @since 0.1
     */
    public function assign($name, $value)
    {
        //assign a variable to be used in the view
        $this->vars[$name] = $value;
    }
    

    /**
     * Registers the status of foo's universe
     *
     * Summaries for methods should use 3rd person declarative rather
     * than 2nd person imperative, beginning with a verb phrase.
     *
     * @access public
     * @since 0.1
     */
    public function render()
    {
        // Sets the content tpl for this render
        $this->vars['content_tpl'] = $this->content_tpl;

        try {
            // Includes the layout for the view
            echo $this->engine->render('layouts/' . $this->layout, $this->vars);
            
        } catch (Exception $e) {
            
            // The content is going to be the error page
            $this->vars['content_tpl'] = 'errors/404.php';
            // Includes the layout for the view
            echo $this->engine->render('layouts/' . $this->layout, $this->vars);
        }

    }
}

