<?php
/**
 * Main Controller
 *
 * The main controller class. This is the initial controller
 * created in a new application.
 *
 * @category   Controller
 * @package    Main
 * @author     Enrique Perez <eaperezc@gmail.com>
 * @copyright  2015
 * @version    0.1
 * @since      Class available since 2015
 */
class MainController extends Controller
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

        // With this we can switch to an adminlike layout
        $this->view->layout = 'admin.php';

        // This changes the whole rendering to render
        // a json object with the view variables
        //$this->view->json = true;
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
     * would be http://localhost/mvc/main/index/arg0/arg1.
     *
     * @since 0.1
     */
    public function index()
    {
        // Set the content of the page
        $this->view->template = 'main/index.php';

        // Set the variables for the view
        $this->view->assign('title', 'Index Title');
        $this->view->assign('items', [
            'Item1' => [
                'name' => 'My first item',
                'date' => date('m-d-Y'),
                'status' => 'good'
            ],
            'Item2' => [
                'name' => 'My second item',
                'date' => date('m-d-Y'),
                'status' => 'good'
            ],
            'Item3' => [
                'name' => 'My third item',
                'date' => date('m-d-Y'),
                'status' => 'not so good'
            ],
            'Item4' => [
                'name' => 'My last item',
                'date' => date('m-d-Y'),
                'status' => 'meh'
            ],
        ]);

    }

    /**
     * Edit Action
     *
     * Action for this controller that handles the
     * form for editing a record.
     *
     * @since 0.1
     */
    public function edit()
    {
        // Set the content of the page
        $this->view->template = 'main/edit.php';
    }

    /**
     * View Action
     *
     * Action for this controller that handles the
     * display of a particular record.
     *
     * @since 0.1
     */
    public function view()
    {
        // Set the content of the page
        $this->view->template = 'main/view.php';
    }

}
