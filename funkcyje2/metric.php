<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>xd</title>
  </head>
  <body>
    <form method="post">
      <select name="from">
        <option value="inch">inch</option>
        <option value="cm">cm</option>
      </select>
      <input name="distance">
      <select name="to">
        <option value="cm">cm</option>
        <option value="inch">inch</option>
      </select>
      <input type="submit">

    </form>
    <?php
      function inch2cm($i) {
        return $i*2.54;
      }
      function cm2inch($cm) {
        return $cm/2.54;
      }
      if(isset($_POST['from'], $_POST['to'], $_POST['distance']) && is_numeric($_POST['distance'])) {
        $fcntns = array(
          'inch' => array(
            'inch' => function($d) {return $d;},
            'cm' => function($d) {return inch2cm($d);}
          ),
          'cm' => array(
            'cm' => function($d) {return $d;},
            'inch' => function($d) {return cm2inch($d);}
          )
        );
        if(array_key_exists($_POST['from'], $fcntns) && array_key_exists($_POST['to'], $fcntns[$_POST['from']]) && $_POST['distance']>=0) {
          echo $_POST['distance'].'<sup>['.$_POST['from'].']</sup> = '.$fcntns[$_POST['from']][$_POST['to']]($_POST['distance']).'<sup>['.$_POST['to'].']</sup>';
        }
      }
    ?>
  </body>
</html>
