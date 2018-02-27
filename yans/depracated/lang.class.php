<?php


class Lang {
	protected $lang;
    public function __construct($lang) {
        $this->lang = $lang;
    }

    public function loadLang($module, $submodule='*') {
    	require_once('config.php');
    	$c = new mysqli($__CONFIG['db']['host'], $__CONFIG['db']['user'], $__CONFIG['db']['passwd'], $__CONFIG['db']['db']);
    	if(!mysqli_connect_errno()) {
    		$query = mysqli_query($c, 'SELECT * FROM lang WHERE module="'.$module.'"'.($submodule!='*'?' AND submodule="'.$submodule.'"':'').' AND lang="'.$this->lang.'"');
    		$translations = [];
    		while($row = $query->fetch_assoc()) {
    			$translations[$row['name']] = $row['translation'];
    		}
    		return $translations;
    	}
    }
}
