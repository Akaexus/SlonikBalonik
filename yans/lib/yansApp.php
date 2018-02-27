<?php

require_once(YANS_ROOT_PATH.'lib/yansRegistry.php');

abstract class yansApp {
  protected $registry;
  protected $DB;
  protected $member;

  function __construct() {
    $this->registry = yansRegistry::getInstance();
  }
}

?>
