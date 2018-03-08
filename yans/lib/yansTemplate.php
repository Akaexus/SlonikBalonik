<?php

class yansTemplate {
	private $skin;
	private $templates;
	function __construct($skinName) {
		require(YANS_ROOT_PATH.'skin/'.$skinName.'Skin.php');
		$skinName.='Skin';
		$this->skin = new $skinName();
	}
	// php 5.6+
	function loadAndRender($templateName, ...$args) {
		echo call_user_func(array($this->skin, $templateName), ...$args);
	}

}