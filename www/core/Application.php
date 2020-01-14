<?php

namespace core;

abstract class Application
{
    protected $debug = false;
    protected $request;
    protected $response;
    protected $session;
    protected $db_manager;
    protected $router;

    public function __construct($debug = false)
    {
        $this->setDebugMode($debug);
    }

    public function setDebugMode($debug)
    {
        if ($debug) {
            $this->debug = true;
            ini_set('display_errors', 1);
            error_reporting(-1);
        } else {
            $this->debug = false;
            ini_set('display_errors', 0);
        }
    }

    public function initialize()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db_manager = new DbManager();
        $this->router = new Router($this->registerRoutes());
    }

    protected function configure()
    {
    }

    abstract public function getRootDir();

    abstract public function registerRoutes();

    public function isDebugMode()
    {
        return $this->debug;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getDbManager()
    {
        return $this->db_manager;
    }

    public function getDocumentRootDir()
    {
        return $this->getRootDir().'/html';
    }

    public function run()
    {
        $params = $this->router->resolve($this->request->getPathInfo());
        if ($params === false) {
            // TODO: handle this
            return;
        }
        $controller = $params['controller'];
        $action = $params['action'];

        $this->runAction($controller, $action, $params);
        $this->response->send();
    }

    public function runAction($controller_name, $action, $params = [])
    {
        $controller_class = 'controllers\\'.ucfirst('test').'Controller';
        if (!class_exists($controller_class)) {
            // TODO: handle this
            return;
        }

        $controller = new $controller_class($this);
        $content = $controller->run($action, $params);
        $this->response->setContent($content);
    }
}
