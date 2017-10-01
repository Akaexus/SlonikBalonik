<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>xd</title>
  </head>
  <body>
    <form method="post">
      <select name="from">
        <option value="k">Kelvin</option>
        <option value="c">Celsius</option>
        <option value="f">Fahrenheit</option>
      </select>
      <input name="temp">
      <select name="to">
        <option value="k">Kelvin</option>
        <option value="c">Celsius</option>
        <option value="f">Fahrenheit</option>
      </select>
      <input type="submit">

    </form>
    <?php
      function celsius2Fahrenheit($c) {
        return $c*9/5+32;
      }
      function fahrenheit2Celsius($f) {
        return ($f-32)*5/9;
      }
      function celsius2Kelvin($c) {
        return $c+273.15;
      }
      function kelvin2Celsius($k) {
        return $k-273.15;
      }
      function kelvin2Fahrenheit($k) {
        return celsius2Fahrenheit(kelvin2Celsius($k));
      }
      function fahrenheit2Kelvin($k) {
        return fahrenheit2Celsius(celsius2Kelvin($k));
      }
      if(isset($_POST['from'], $_POST['to'], $_POST['temp']) && is_numeric($_POST['temp'])) {
        $fcntns = array(
          'k' => array(
            'k' => function($temp) {return $temp;},
            'c' => function($temp) {return kelvin2Celsius($temp);},
            'f' => function($temp) {return kelvin2Fahrenheit($temp);}
          ),
          'c' => array(
            'c' => function($temp) {return $temp;},
            'k' => function($temp) {return celsius2Kelvin($temp);},
            'f' => function($temp) {return celsius2Fahrenheit($temp);}
          ),
          'f' => array(
            'f' => function($temp) {return $temp;},
            'c' => function($temp) {return fahrenheit2Celsius($temp);},
            'k' => function($temp) {return fahrenheit2Kelvin($temp);}
          )
        );
        if(array_key_exists($_POST['from'], $fcntns) && array_key_exists($_POST['to'], $fcntns[$_POST['from']])) {
          echo $fcntns[$_POST['from']][$_POST['to']]($_POST['temp']);
        }
      }
    ?>
  </body>
</html>
