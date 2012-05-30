<?php

    /*
     * Params Leyend: 
     *  0: Controller
     *  1: Action
     *  3: Id
     *  @example
     *      /users/edit/1
     *      /params[0]/params[1]/params[2]
     */

    $requestRoot = str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_FILENAME']);
    
     //Paths constants
    define('ROOT_URI', str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['HTTP_HOST'].'/', $requestRoot));
    define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__).'/'));
    define('CORE_PATH', ROOT_PATH . '_core/');
    define('ASSETS_PATH', ROOT_URI . 'assets/');
    define('VIEWS_PATH', ROOT_PATH . 'view/');
    define('CONTROLLERS_PATH', ROOT_PATH . 'controller/');
    define('TEMPLATES_PATH', VIEWS_PATH . 'templates/');
    define('ERRORS_PATH', VIEWS_PATH . 'errors/');

    //Configuration constants
    define('DEBUG', false);
    
    include '_core/Router.php';
    $router = new Router();

?>