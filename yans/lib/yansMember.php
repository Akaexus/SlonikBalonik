<?php

class yansMember {
  static function load($id) {
    $db = yansDatabase::getInstance();
    $member = $db->select([
      'select'=> '*',
      'from'=>'yans_members',
      'where'=> 'id='.$id
    ]);
    return $member[0];
  }
}

?>
