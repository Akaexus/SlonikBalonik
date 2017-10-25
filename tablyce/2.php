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
      <input type="number" name="count" placeholder="count" min="1" max="100">
      <input type="number" name="min" placeholder="min" min="5" max="99">
      <input type="number" name="max" placeholder="max" min="5" max="99">
      <input type="submit">
    </form>
    <?php
      $formNames = array('count', 'min', 'max');
      $form = array();
      $allForms = true;
      foreach($formNames as $formName) {
        if(isset($_POST[$formName]) && is_numeric($_POST[$formName]) && ctype_digit($_POST[$formName])) {
          $form[$formName] = $_POST[$formName];
        } else {
          $allForms = false;
        }
      }
      if($allForms) {
        if($form['count']>0 && $form['count']<=100 && $form['min']>=5 && $form['max']<=99 && $form['min']<$form['max']) {
          $numbers = array();
          for($i = 0; $i<$form['count']; $i++) {
            $numbers[$i] = rand($form['min'], $form['max']);
          }
          echo '<h2>echo+for</h2><ul>';
          for($i = 0; $i<count($numbers); $i++) {
            echo '<li>'.$numbers[$i].'</li>';
          }
          echo '</ul>';
          echo '<h2>print_r()</h2><pre>'.print_r($numbers, 1).'</pre>';
          echo '<h2>implode()</h2>'.implode($numbers, '<br>');
        } else {
          echo 'Błąd! Wprowadź odpowiednie dane!';
        }
      }
    ?>
  </body>
</html>
