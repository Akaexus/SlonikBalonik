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
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $questions = json_decode(file_get_contents("questions.json"), true);
        $done = array();
        $quizdone = false;
        if(isset($_POST['submit'])) {
            $quizdone = true;
            $correct = 0;
            $formNames = array();
            foreach($questions as $index=>$question) {
                $formNames[] = 'question-'.$index.'-answer';
            }

            foreach($questions as $index=>$question) {
              if(isset($_POST['question-'.$index.'-answer'])) {
                $done[$index] = true;
                if($_POST['question-'.$index.'-answer']==$question['correct']) {
                    $correct++;
                }
              } else {
                $done[$index] = false;
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
            if($quizdone && $done[$index] && $letter==$_POST['question-'.$index.'-answer']) {
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
        var button = document.getElementById('szczelajo');
        button.addEventListener('click', function() {
          console.log('xd');
          for(var question of document.querySelectorAll('#questions > .question')) {
            let answers = Array.from(question.querySelectorAll('input'));
            answers[Math.round(Math.random()*(answers.length-1))].click()
          }
        });
      }());
    </script>
  </body>
</html>
