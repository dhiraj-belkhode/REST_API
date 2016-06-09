<?php
namespace App;

class Route
{
    

    /**
   * 
   * @var Singleton
   */
    private static $instance;

    public $uri;
    public $methods;
    public $action;
    public $route_collection = array();

    public function __construct($uri, $action)
    {
        $this->uri = $uri;
        $this->action = $action;
        $this->addRoute();

    }

    public function addRoute(){

        $this->route_collection[$this->uri] = array('uses' => $this->action);
        
        return $this->match();
    }

      public static function getInstance($uri,$action)
      {
        self::$instance = new self($uri,$action);
      }

    public function get($uri,$action){
        SELF::getInstance($uri,$action);
    }

    public function match(){

        if(empty($_SERVER["QUERY_STRING"])){
            $_SERVER["QUERY_STRING"] = '/';
        }
        
        if (array_key_exists($_SERVER["QUERY_STRING"],$this->route_collection)){
            return $this->runController($this->route_collection);
        }else{
            echo "Exception Route not found";           
            exit;
        }
    }

    protected function runController()
    {
        list($class, $method) = explode('@', $this->action);
        if(empty($class) && empty($method)){
            echo "class and method not define in route";
            exit;
        }

        $reflector = new \ReflectionClass('App\controllers\\'.$class);
        if ($reflector->isInstantiable()) {   
            
            $this->instanti = $reflector->newInstanceArgs();

            $meth = new \ReflectionMethod('App\controllers\\'.$class, $method);
            $arguments = array($_REQUEST);

            return $meth->invokeArgs($this->instanti, $arguments);

        } else {
            throw new Exception("Could not instantiate a class of type '" . $class_name . "'");
        }

    }

}