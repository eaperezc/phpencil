<?php
/**
 * User Controller
 *
 * The user controller class. This is the initial controller
 * created in a new application.
 *
 * @category   Controller
 * @package    User
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since 2015
 */
class UserController extends Controller
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
     * index Action
     *
     * Default action for this controller. An example call
     * would be http://localhost/phpencil/user/index/arg0/arg1.
     *
     * @since 0.1
     */
    public function index()
    {
        // Set the content of the page
        $this->view->template = 'user/index.php';

		// First we find the users on the database
		$users = User::find('all', [ 'limit' => 20 ]);

		// Here we will parse the models to be array values
		$array_users = [];
		foreach ($users as $user) {
			$array_users[] = $user->to_array();
		}

		// We send the users array to the view
		$this->view->assign('users', $array_users);
    }

    /**
     * Create Action
     *
     * Action for this controller that handles the
     * display of a particular record.
     *
     * @since 0.1
     */
	public function create() {

		// TODO: test data here, make it work with a form

        // This is how we save a new object
		$user_model = new User([
            'username'  => 'eperez',
		    'email'     => 'eperez@phpencil.com'
        ]);
		$user_model->save();
	}


}
