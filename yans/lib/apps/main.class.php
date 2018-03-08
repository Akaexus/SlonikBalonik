<?php

class main extends yansApp {
  function execute() {
  	$this->skin = $this->registry->loadTemplate('test');
  	$this->skin->loadAndRender('testRender', 5, 6);
  }
}
