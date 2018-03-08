<?php
class xd {
	public function a($xd, ...$args) {
		echo $xd;
		echo '<br>';
		print_r($args);
	}
	
}

$heh = new xd();

call_user_func(array($heh, 'a'), 2137, 'heh');