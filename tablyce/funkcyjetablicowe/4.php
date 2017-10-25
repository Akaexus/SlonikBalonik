<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <body>
    <?php
    $y = array();
    for($i=0; $i<10; $i++) {
      $y[$i] = rand(0, 10);
    }
    sort($y);
    echo '<h2>sort()</h2><pre>'.print_r($y, 1).'</pre>';
    rsort($y);
    echo '<h2>sort()</h2><pre>'.print_r($y, 1).'</pre>';


    $x = array('jan'=>'dzban', 'huligan'=>'tulipan', 'tapczan'=>'galgan');
    asort($x);
    echo '<h2>asort()</h2><pre>'.print_r($x, 1).'</pre>';
    arsort($x);
    echo '<h2>arsort()</h2><pre>'.print_r($x, 1).'</pre>';
    ksort($x);
    echo '<h2>ksort()</h2><pre>'.print_r($x, 1).'</pre>';
    krsort($x);
    echo '<h2>krsort()</h2><pre>'.print_r($x, 1).'</pre>';
    ?>
  </body>
</html>
