<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabeleczky.php</title>
    <style media="screen">
      table {
        border-collapse: collapse;
      }
      td {
        padding: 4px;
        border: 2px solid #323232;
      }
    </style>
  </head>
  <body>
    <form>
      <input type="text" name="n" placeholder="n">
      <input type="submit">
    </form>
    <?php
      if(isset($_GET['n']) && is_numeric($_GET['n']) && $_GET['n']>0) {
        $n = $_GET['n'];
        for($i = $n; $i>=0; $i--) {
          echo $i.($i?', ':'.');
        }
        echo '<table><tr>';
        for($i = 0; $i<=$n; $i++) {
          echo '<td>'.($i%2?$i:'<b>'.($i?$i:"<u>$i</u>").'</b>').'</td>';
        }
        echo '</tr></table>';
      }
    ?>
  </body>
</html>
