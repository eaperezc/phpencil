<?php
/**
 * User Controller
 *
 * The user controller class. This is the initial controller
 * created in a new application.
 * Note: To be able to use this controller we need to have already
 * 	 	 configured the database and the users table on it.
 * 		 @see /app/config/bootstrap.php
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
     * delete Action
     *
     * With this action we will delete the
	 * user that is passed as parameter
     *
     * @since 0.1
     */
    public function delete()
    {
		// First we make sure we have something to delete
		if (isset($_POST['user_ids'])) {

			// Prepare the ids variable
			$user_ids = $_POST['user_ids'];

			// Here we find the users on the database and delete them
			$users = User::find($user_ids);

			// When the user is only 1 we need to make sure that we
			// have an array to be able to loop through the entries
			$users = sizeof($users) > 1 ? $users:[$users];
			foreach ($users as $user) {
				$user->delete();
			}
		}

		// Reload he user list page
		$this->redirect('user', 'index');
    }

    /**
     * Create Action
     *
     * Action for this controller that handles the
     * creation of a new user record.
     *
     * @since 0.1
     */
	public function create()
	{
		// We want to prepare the model data with only
		// values that are valid on the db, for example
		// we dont want to save the repeat password field
		$user_data = User::prepareData($_POST);

        // This is how we save a new object
		$user_model = new User($user_data);

		// Save the data to the database
		$user_model->save();

		// Reload he user list page
		$this->redirect('user', 'index');
	}


}
