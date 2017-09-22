<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="dark.css">
  </head>
  <body>
    <form method="get">
      <input name="a" type="text" placeholder="a">
      <input name="b" type="text" placeholder="b">
      <label>
        <input type="radio" name="action" value="+" checked> Dodawanie
      </label>
      <label>
        <input type="radio" name="action" value="-"> Odejmowanie
      </label>
      <label>
        <input type="radio" name="action" value="*"> Mnożenie
      </label>
      <label>
        <input type="radio" name="action" value="/"> Dzielenie
      </label>
      <label>
        <input type="radio" name="action" value="%"> Modulo
      </label>
      <label>
        <input type="radio" name="action" value="**"> Potęguj
      </label>
      <button type="submit">Liczymy!</button>
    </form>
    <?php
    //PHP 5.6+
      function issetNotEmptyArray($array = array(), $names = array()) {
        foreach($names as $name) {
          if(!isset($array[$name])) {
            return false;
          }
        }
        return true;
      }
      function calc($a, $b, $action) {
        $actions = array(
          '+'=> function($a, $b) {return $a+$b;},
          '-'=> function($a, $b) {return $a-$b;},
          '*'=> function($a, $b) {return $a*$b;},
          '**'=> function($a, $b) {return $a**$b;},
          '/'=> function($a, $b) {
              if(!$b) {
                return 'nie dziel przez 0 motyla noga';
              }
              return $a/$b;
            },
          '%'=> function($a, $b) {
            if(!$b) {
              return 'nie dziel przez 0 motyla noga';
            } else if(!ctype_digit($b) || !ctype_digit($a)) {
              return 'chyba cos ci sie pomylilo kolego';
            }
            return $a%$b;
          }
        );
        if(array_key_exists($action, $actions)) {
          return $actions[$action]($a, $b);
        } else {
          echo 'cos chyba ci sie pomylilo';
        }
      }


      if(issetNotEmptyArray($_GET, array('a', 'b', 'action'))) {
        if(is_numeric($_GET['a']) && is_numeric($_GET['b'])) {
          echo '<div class="result">'.calc($_GET['a'], $_GET['b'], $_GET['action']).'</div>';
        }
      }
    ?>
  </body>
</html>
