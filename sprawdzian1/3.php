<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <title>zad3</title>
  </head>
  <body>
    <form method="post">
      <p>Podaj liste zakupów po przecinku:</p>
      <textarea name="items" cols="70" rows="10"></textarea>
      <input type="submit" name="submit">
    </form>
    <?php
      if(isset($_POST['submit'])) {
        if(isset($_POST['items']) && $_POST['items']!='') {
          $items = array_filter(array_map(trim, explode(',', $_POST['items'])), function($item) {
            return $item != '';
          });
          if(count($items)) {
            sort($items);
            echo 'Do formularza wpisales '.count($items).' produkty/ów!<br>Spis produktów w kolejności alfabetycznej to:';
            echo '<ul>';
            foreach($items as $item) {
              echo "<li>$item</li>";
            }
            echo '</ul>';
          } else {
            echo 'Nie wpisałeś wszystkich produktów!';
          }
        } else {
          echo 'Uzupełnij wszystkie pola!';
        }
      }
    ?>
  </body>
</html>
