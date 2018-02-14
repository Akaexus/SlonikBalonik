<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TODO</title>
    <link rel="stylesheet" href="todo.css">
    <link rel="stylesheet" href="fontello/css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700&amp;subset=latin-ext" rel="stylesheet">
  </head>
  <body>
    <div class="box">
      <h1>TODO</h1>
      <?php
        function writeFile($filename, $json) {
          $fh = fopen($filename, 'w');
          $jsonStr =  json_encode($json, JSON_UNESCAPED_UNICODE);
          fwrite($fh, $jsonStr);
          fclose($fh);
        }
        $filename = 'todo.json';
        try {
          $todo = json_decode(file_get_contents($filename), true);
          if(is_null($todo)) {
            throw new Exception("Kaine json file!", 1);
          }
          if(isset($_POST['add'])) {
            if(isset($_POST['item']) && $_POST['item']!='') {
              array_push($todo, array('item'=> htmlentities($_POST['item']), 'done'=>false));
              writeFile($filename, $todo);
            }
          }
          if(isset($_POST['delete'])) {
            if(ctype_digit($_POST['id']) && array_key_exists($_POST['id'], $todo)) {
              unset($todo[$_POST['id']]);
              writeFile($filename, $todo);
            }
          }
          if(isset($_POST['changedonestate'])) {
            if(ctype_digit($_POST['id']) && array_key_exists($_POST['id'], $todo)) {
              $todo[$_POST['id']]['done'] = !$todo[$_POST['id']]['done'] ;
              writeFile($filename, $todo);
            }
          }
          echo '<ul>';
          foreach($todo as $index=>$items) {
            echo '<li><form method="POST">'
                    .$items['item']
                    .'<input name="id" value="'.$index.'" type="hidden">
                    <button name="changedonestate">'.($items['done']?'<i class="icon-ok"></i>':'<i class="icon-cancel"></i>').'</button>
                    <button name="delete"><i class="icon-trash-empty"></i></button>
                  </form>
                </li>';
          }
          echo '</ul>';
        } catch (Exception $e) {
          echo 'Tut mir leid, aber ich habe kaine todo file.';
        }
      ?>
      <form method="post">
        <input name="item">
        <input type="submit" name="add">
      </form>
    </div>
  </body>
</html>
