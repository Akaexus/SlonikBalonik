<?php


class Lang {
	protected $lang;
    public function __construct($lang) {
        $this->lang = $lang;
    }

    public function loadLang($module, $submodule='*') {
    	require_once('db.php');
    	$c = new mysqli($db['host'], $db['user'], $db['passwd'], $db['db']);
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