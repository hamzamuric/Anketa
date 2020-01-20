<?php

$answers = array();
$score = 0;

for ($i = 0; $i < 7; $i++) {
    $answer = explode(',', $_POST['p' . $i]);
    $answers[$i] = $answer[0];
    $score += (int)$answer[1];
}


for ($i = 7; $i < 9; $i++) {
    $p = $_POST['p' . $i];
    $answer = array();
    foreach ($p as $ans) {
        $ans = explode(',', $ans);
        array_push($answer, $ans[0]);
        $score += (int)$ans[1];
    }
    $answers[$i] = implode(',', $answer);
}

echo "score: $score <br/>";
var_dump($answers);
