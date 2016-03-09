<?php

class RouterTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $_SERVER['SCRIPT_NAME']   = '/phpencil/index.php';
        $_SERVER['REDIRECT_URL']  = '/phpencil/test/action/123/456/789';
    }

    public function testExtractControllerFromPath()
    {
        $router = new Router();
        $this->assertEquals( 'test', $router->getController() );
    }

    public function testExtractActionFromPath()
    {
        $router = new Router();
        $this->assertEquals( 'action', $router->getAction() );
    }

    public function testExtractArgumentsFromPath()
    {
        $router = new Router();
        $this->assertEquals('123', $router->getArguments()[0]);
        $this->assertEquals('456', $router->getArguments()[1]);
        $this->assertEquals('789', $router->getArguments()[2]);
    }

    public function testDefaultRoutingValues()
    {
        $_SERVER['REDIRECT_URL']  = '/phpencil/';

        $router = new Router();
        $this->assertEquals('main', $router->getController());
        $this->assertEquals('index', $router->getAction());
    }

    public function testRouterControllerFilePath()
    {
        $router = new Router();

        $this->assertEquals( 
            APP_DIR . 'controllers/TestController.php', 
            $router->getControllerFilePath() 
        );
    }

}
