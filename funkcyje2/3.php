<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabeleczky.php</title>
  </head>
  <body>
    <form>
      <input type="text" name="n" placeholder="n">
      <input type="submit">
    </form>
    <?php
      if(isset($_GET['n']) && is_numeric($_GET['n'])) {
        $n = str_split(intval($_GET['n']));
        echo array_reduce($n, function($a, $b) {return $a+$b;});
      }
    ?>
  </body>
</html>
