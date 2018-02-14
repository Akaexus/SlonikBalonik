<?php
  $filename = 'todo.json';
  function writeFile($filename, $json) {
    $fh = fopen($filename, 'w');
    $jsonStr =  json_encode($json, JSON_UNESCAPED_UNICODE);
    fwrite($fh, $jsonStr);
    fclose($fh);
  }
  try {
    $todo = json_decode(file_get_contents($filename), true);
    if(is_null($todo)) {
      throw new Exception();
    }

    $actions = array(
      'add'=> function($todo) {
          if(isset($_POST['item']) && $_POST['item']!='') {
            array_push($todo, array('item'=> $_POST['item'], 'done'=>false));
            return $todo;
          }
        },
      'delete'=> function($todo) {
        if(ctype_digit($_POST['id']) && array_key_exists($_POST['id'], $todo)) {
          unset($todo[$_POST['id']]);
          return $todo;
        }
      },
      'changedonestate'=> function($todo) {
        if(ctype_digit($_POST['id']) && array_key_exists($_POST['id'], $todo)) {
          $todo[$_POST['id']]['done'] = !$todo[$_POST['id']]['done'] ;
          return $todo;
        }
      }
    );
  } catch (Exception $e) {
    echo '{"error": 1}';
  }
?>
