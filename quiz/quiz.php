<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <body>
    <h1>MUDL</h1>
    <?php
      $questions = array(
        array(
          'question'=> 'Co jest muzyką życia?',
          'answers'=> array(
            'a'=> 'bębny',
            'b'=> 'cisza',
            'c'=> 'tamburyn',
            'd'=> 'puzon'
          ),
          'correct'=> 'b'
        ),
        array(
          'question'=> 'W czym jest napisany ten skrypt?',
          'answers'=> array(
            'a'=> 'jawaskript',
            'b'=> 'jawascript',
            'c'=> 'javaskript',
            'd'=> 'javascript'
          ),
          'correct'=> 'd'
        ),
        array(
          'question'=> 'Ile to 2+2',
          'answers'=> array(
            'a'=> '2',
            'b'=> '1',
            'c'=> '3',
            'd'=> '7'
          ),
          'correct'=> 'd'
        ),
        array(
          'question'=> 'Ile wazy php?',
          'answers'=> array(
            'a'=> '329',
            'b'=> '21398',
            'c'=> 'stół',
            'd'=> 'heh'
          ),
          'correct'=> 'd'
        )
      );
      $done = false;
      if(isset($_POST['submit'])) {
        $done = true;
        $correct = 0;
        foreach($questions as $index=>$question) {
            if($_POST['question-'.$index.'-answer']==$question['correct']) {
            $correct++;
          }
        }
        echo sprintf("%.2f%%", $correct/count($questions)*100);
      }
      echo '<form method="POST" id="questions">';
      foreach($questions as $index=> $question) {
        echo '<div id="question-'.$index.'" class="question">';
        echo '<h2>'.($index+1).'. '.$question['question'].'</h2>';
        echo '<ul>';
        foreach($question['answers'] as $letter=> $answer) {
          if($done && $letter==$_POST['question-'.$index.'-answer']) {
            echo "<li".($_POST['question-'.$index.'-answer']==$question['correct']?" style=\"background: green\"":" style=\"background: red\"").">
                <label for=\"question-$index-answer\">
                  <input type=\"radio\" name=\"question-$index-answer\" id=\"question-$index-answer\" checked value=\"$letter\"><strong>$letter</strong> $answer
                </label>
              </li>";
          } else {
            echo "<li>
                <label>
                  <input type=\"radio\" name=\"question-$index-answer\" id=\"question-$index-answer\" value=\"$letter\"><strong>$letter</strong> $answer
                </label>
              </li>";
          }
        }
        echo '</ul></div>';
      }
      echo '<button type="submit" name="submit">go go go power rangers</button></form>';
    ?>
    <button type="button" id="szczelajo">wyszczelaj za mnie</button>
    <script type="text/javascript">
      (function() {
        'use strict';
        let button = document.getElementById('szczelajo');
        button.addEventListener('click', function() {
          console.log('xd');
          for(let question of document.querySelectorAll('#questions > .question')) {
            let answers = Array.from(question.querySelectorAll('input'));
            answers[Math.round(Math.random()*(answers.length-1))].click()
          }
        });
      }());
    </script>
  </body>
</html>
