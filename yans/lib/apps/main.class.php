<?php

class main extends yansApp {
  function execute() {
  	$this->skin = $this->registry->loadTemplate('core');
  	$this->skin->loadAndRender('header');
  }
}
