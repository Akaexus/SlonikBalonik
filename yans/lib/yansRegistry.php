<?php

class yansRegistry {
  private static $instance;
  public $request;

  public function __construct() {
    $this->request = $_REQUEST;
  }

  public static function getInstance() {
    if(self::$instance === null) {
      self::$instance = new yansRegistry();
    }
    return self::$instance;
  }
}
