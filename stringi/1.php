<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stringi</title>
  </head>
  <body>
    <form method="post">
      <textarea name="ints" rows="8" cols="80"></textarea>
      <input type="submit">
    </form>
    <?php
      if(isset($_POST['ints'])) {
        $numbers = array_filter(explode(';', trim($_POST['ints'])), is_numeric);
        sort($numbers);
        if(count($numbers)) {
          echo 'Jest '.count($numbers).' elementów: '.implode(', ', $numbers);
        } else {
          echo 'Podaj prawidłowe liczby!';
        }
      }
    ?>
  </body>
</html>
