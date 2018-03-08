<?php

class yansRouter {
  static private $instance;
  private $routes;
  private $request;
  function __construct($request) {
    $this->request = $request;
    if(!is_array($this->routes)) {
      $this->routes = [];
    }
  }

  public static function getInstance($request) {
    if(self::$instance === null) {
      self::$instance = new yansRouter($request);
    }
    return self::$instance;
  }

  public function addRoute($route) {
    $this->routes[$route['app']] = $route['class'];
  }

  public function run() {
    $appName = array_key_exists('app', $this->request)?$this->request['app']:'/';
    if(array_key_exists($appName, $this->routes)) {
      $className = $this->routes[$appName];
    } else {
      $className = 'error404';
    }
    require_once(YANS_ROOT_PATH.'lib/apps/'.$className.'.class.php');
    $loadedApp = new $className();
    $loadedApp->execute();
  }
}
