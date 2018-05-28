<?php

class main extends yansApp {
  function execute() {
    $coreSkin = $this->registry->loadTemplate('core');
  	$this->skin = $this->registry->loadTemplate('frontPage');
  	$coreSkin->loadAndRender('header', 'Yet another news sytem - Yans', ['public/mdrnze/frontpage.css']);
  	$this->skin->loadAndRender('brandingExtended');
  	$this->skin->loadAndRender('frontPage');
  	$this->skin->loadAndRender('statistics');
  	$this->skin->loadAndRender('newsLink');
  	$coreSkin->loadAndRender('footer');
  }
}
