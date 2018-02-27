<!DOCTYPE>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Dodaj pytanie</title>
    </head>
    <body>
        <form method="post">
            <p>
                <input name="question" placeholder="Co lubisz jeść?"></p>
            <p>
                <input name="a" placeholder="Odpowiedz a"><input type="radio" name="correct" value="a">
            </p>
            <p>
                <input name="b" placeholder="Odpowiedz b"><input type="radio" name="correct" value="b">
            </p>
            <p>
                <input name="c" placeholder="Odpowiedz c"><input type="radio" name="correct" value="c">
            </p>
            <p>
                <input name="d" placeholder="Odpowiedz d"><input type="radio" name="correct" value="d">
            </p>
            <input type="submit" name="add">
        </form>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $fileName = 'questions.json';
            function validateForms($formNames, $glbl) {
                $forms = array();
                foreach($formNames as $formName) {
                    if(isset($glbl[$formName]) && $glbl[$formName]!='') {
                        $forms[$formName] = $glbl[$formName];
                    } else {
                        return false;
                    }
                }
                return $forms;
            }
            if(isset($_POST['add'])) {
                $forms = validateForms(array('question', 'correct'), $_POST);
                $forms['answers'] = validateForms(array('a', 'b', 'c', 'd'), $_POST);
                if($forms && preg_match('/[abcd]/', $forms['correct'])) {
                    $questions = json_decode(file_get_contents($fileName), true);
                    $questions[] = $forms;
                    $json =  json_encode($questions, JSON_UNESCAPED_UNICODE);
                    $fh = fopen($fileName, 'w');
                    fwrite($fh, $json);
                    fclose($fh);
                } else {
                    echo 'Wprowadz wszystkie pola!11';
                }
            }
        ?>
    </body>
</html>
