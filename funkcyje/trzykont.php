<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <body>
    <pre>
    <?php
      function trzykont($n) {
        $output = '';
        for($i=1; $i<=$n; $i++) {
          $output .= '<div style="text-align: center; letter-spacing: 7px">';
          for($j= 1; $j<=$i; $j++) {
            $output.='x';
          }
          $output.='</div>';
        }
        return $output;
      }
       echo trzykont(10);
    ?>
    <meter id="kupa" value="60" min="0" max="100" style="width: 100%">chuj</meter>
    <progress value="50" max="100">0%</progress>
  </pre>
    <script type="text/javascript">
      var i = 0;
      setInterval(function() {
        document.getElementById('kupa').value = i;
        i++;
        if(i==100) {
          i=0;
        }
      }, 10);
    </script>
  </body>
</html>
