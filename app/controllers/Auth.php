<?php
/**
 * Auth
 *
 * Controller that takes care of the login and logout
 * and any authorization page required.
 *
 * @category   Controller
 * @package    Controller
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since 2015
 */
class Auth extends Controller
{
	
	/**
     * Before every Action
     *
     * This method is called before every action of this
     * controller. Usefull for authorization for example.
     *
     * @since 0.1
     */
	public function beforeAction()
	{
        # This happens before everything...
	}

	/**
     * After every Action
     *
     * This method is called after every action of this
     * controller.
     *
     * @since 0.1
     */
	public function afterAction()
	{
        # This happens after everything...
	}

    /**
     * Login Action
     *
     * Action that shows the login form so the user can
     * access the application. 
     *
     * @since 0.1
     */
    public function login()
    {
        // Set the content of the page
        $this->view->content_tpl = 'auth/login.php';

        // Set the variables for the view
        $this->view->assign('title', 'App Login');
    }
    
}

