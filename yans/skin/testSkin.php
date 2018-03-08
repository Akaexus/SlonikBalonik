<?php
require_once(YANS_ROOT_PATH.'lib/yansSkin.php');

class testSkin extends yansSkin {
	function testRender($a, $b) {
		return 'hello';
	}
}