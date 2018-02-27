<pre><?php
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
echo json_encode($questions, JSON_UNESCAPED_UNICODE);
?></pre>
