<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <body>
    <form method="post">
      <textarea name="items" rows="8" cols="80"></textarea>
    <input type="submit">
    </form>
    <?php
      if(isset($_POST['items']) && !empty($_POST['items'])) {
        foreach(array(' , ', ' ,', ', ') as $delimeter) {
          $_POST['items'] = str_replace($delimeter, ',', $_POST['items']);
        }
        $items = explode(',', $_POST['items']);
        echo '<pre>'.print_r($items, 1).'</pre>';
        echo count($items);

      }
    ?>
  </body>
</html>
