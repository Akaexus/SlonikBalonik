<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>xd</title>
  </head>
  <body>
    <form method="POST">
      <input type="text" name="product">
      <input type="submit">
    </form>
    <?php
      $filename = 'produkty.txt';
      if($_POST['product']) {
        //code
      }
      echo '<ul>'.implode('', array_map(function($line) {return '<li>'.$line.'</li>';}, file($filename))).'</ul>';
    ?>
  </body>
</html>
