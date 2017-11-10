<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <title>zad1</title>
  </head>
  <body>
    <form method="get">
      <input name="n" type="number" min="1" placeholder="liczba">
      <input type="submit" name="count">
    </form>
    <?php
      if(isset($_GET['count'])) {
        if(isset($_GET['n'])) {
          if(ctype_digit($_GET['n']) && $_GET['n']!=0) {
            $n = $_GET['n'];
            if($n>0 && $n%2 && !($n%5)) {
              for($i=$n; $i>=0; $i--) {
                if(!$i) {
                  echo "$i;";
                } else {
                  echo "$i,<br>";
                }
              }
            } else {
              echo 'Liczba nie spełnia warunków zadania!';
            }
          } else {
            echo 'Musisz podać liczbe całkowitą dodatnią! Uzupełnij poprawnie pola!';
          }
        } else {
          echo 'Uzupełnij wszystkie pola!';
        }
      }
    ?>
  </body>
</html>
