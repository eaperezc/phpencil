<?php
/**
 * The class definition for the "UsersController" Object
 *
 * Controller action definitions for the User entity
 * @package Controllers
 */
class UsersController extends Controller {

    var $models = array('User');
    
    function index(){
        $this->set('usableVar', 'passed variable');
    }

    function edit($id = 0){
        $this->useTemplate('application');
        $user = $this->User->get($id);
        if($user)
            $this->set('msg', 'Editing ' . $user->getName());
        else
            $this->set('msg', 'Invalid arguments');
    }
    
    function delete(){
        $this->set('nombre', 'Sam');
    }
    
    function sayHi(){
        $this->set('company', 'My Company');
    }
    
}

?>