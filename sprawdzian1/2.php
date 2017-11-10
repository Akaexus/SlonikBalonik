<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <title>zad2</title>
  </head>
  <body>
    Podaj przedział:
    <form method="post">
      <input type="number" name="start" placeholder="początek"><br>
      <input type="number" name="end" placeholder="koniec"><br>
      <input type="number" name="needle" placeholder="szukana liczba"><br>
      <input type="submit" name="search">
    </form>
    <?php
      function fetchForms($formNames, $glbl) {
        $forms = array();
        foreach($formNames as $formName) {
          if(isset($glbl[$formName]) && is_numeric($glbl[$formName])) {
            $forms[$formName] = $glbl[$formName];
          } else {
            return false;
          }
        }
        return $forms;
      }

      if(isset($_POST['search'])) {
        $forms = fetchForms(array('start', 'end', 'needle'), $_POST);
        if($forms) {
          $flag = 0;
          $output = "";
          if($forms['start']>$forms['end']) {
            $temp = $forms['start'];
            $forms['start']=$forms['end'];
            $forms['end'] = $temp;
          }
          for($i = $forms['start']; $i<=$forms['end']; $i++) {
            if($i==$forms['needle']) {
              $output.= " ~ <b>$i</b>";
              $flag = 1;
            } else {
              $output.= " ~ $i";
            }
          }
          $output.= "~~>";

          if($flag) {
            echo 'Szukana liczba znajduje się w przedziale<br>';
          }
          echo $output;
        } else {
          echo 'Uzupełnij poprawnie wszystkie pola!';
        }
      }
    ?>
  </body>
</html>
