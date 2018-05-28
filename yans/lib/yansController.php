<?php

require(YANS_ROOT_PATH.'yansConfig.php');
require(YANS_ROOT_PATH.'lib/dbController.php');
require(YANS_ROOT_PATH.'lib/yansMember.php');
require(YANS_ROOT_PATH.'lib/yansRouter.php');
require(YANS_ROOT_PATH.'lib/yansApp.php');

class yansController {
  private static $instance;
  private $router;
  private $db;

  public static function run() {
      self::getInstance();
  }

  public static function getInstance() {
    if(self::$instance === null) {
      self::$instance = new yansController();
    }
    return self::$instance;
  }

  public function __construct() {
    global $__CONFIG;
    $this->db = yansDatabase::getInstance($__CONFIG['db']);
    $this->router = yansRouter::getInstance($_REQUEST);
    $routes = $__CONFIG['modules'];
    foreach($routes as $route) {
      $this->router->addRoute($route);
    }
    $this->router->run();
  }

  public function db() {
    return $this->db;
  }
}
