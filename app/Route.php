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
        $this->route_collection[trim($this->uri,'/')] = array('uses' => $this->action);
        $this->match();
    }

    public static function getInstance($uri,$action){
        self::$instance = new self($uri,$action);
    }

    public function get($uri,$action){
        if($_SERVER['REQUEST_METHOD'] == strtoupper(__FUNCTION__)){
            SELF::getInstance($uri,$action);
        }
    }

    public function post($uri,$action){
        if($_SERVER['REQUEST_METHOD'] == strtoupper(__FUNCTION__)){
            SELF::getInstance($uri,$action);
        }
    }

    public function match(){
        $this->path = $this->reverse_strrchr(strtolower($_SERVER['PHP_SELF']), '/');
        $this->routePath = substr_replace($_SERVER['REDIRECT_URL'], '', strpos($_SERVER['REDIRECT_URL'],$this->path), strlen($this->path));

        if (array_key_exists($this->routePath,$this->route_collection)){
            $this->data = $this->runController($this->route_collection);
            $this->jsonData();
        }
    }

    public function jsonData(){
        if(is_array($this->data)){
            echo json_encode($this->data);
        }else{
            echo $this->data; 
        }
        exit;
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

    function reverse_strrchr($haystack, $needle){
        $pos = strrpos($haystack, $needle);
        if($pos === false) {
            return $haystack;
        }
        return substr($haystack, 0, $pos + 1);
    }

}