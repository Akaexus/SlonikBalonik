<?php

class register extends yansApp {
  function execute() {
  	$this->registry->loadTemplate('core')->loadAndRender('header');
  	$this->skin = $this->registry->loadTemplate('register');
  	$this->skin->loadAndRender('form');
  }
}
