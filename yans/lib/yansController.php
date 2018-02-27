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
    $this->router = yansRouter::getInstance($_REQUEST);
    $this->router->addRoute(['app'=>'nothin', 'class'=>'xd']);
    $this->router->run();
  }

  public function db() {
    return $this->db;
  }
}
