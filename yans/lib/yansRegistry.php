<?php
require_once(YANS_ROOT_PATH.'lib/yansTemplate.php');

class yansRegistry {
  private static $instance;
  public $skin;
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
  function loadTemplate($templateName) {
    $template = new yansTemplate($templateName);
    return $template;
  }
}
