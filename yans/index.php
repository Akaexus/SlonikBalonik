<?php

define('YANS_ROOT_PATH', realpath(dirname(__FILE__)).'/');
require_once(YANS_ROOT_PATH.'yansConfig.php');
require_once(YANS_ROOT_PATH.'lib/yansController.php');

$instance = yansController::run();
echo '__';
