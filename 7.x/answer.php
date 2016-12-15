<?php
include("connect.php");
include("token.php");

$token = addslashes($_POST["token"]);
$result = checkToken($pdo, $token);

$uid = $result["uid"];

$questionId = addslashes($_POST["questionId"]);//TODO questionId
$content = addslashes($_POST["content"]);
//$sql = "INSERT INTO answer ( `uid`, `qid`, `content`, `date` ) VALUES ('{$uid}', '{$questionId}','{$content}', now())";
$sql = "INSERT INTO answer ( `uid`, `qid`, `content` ) VALUES ( '{$uid}', '{$questionId}','{$content}')";
if ($pdo->exec($sql)) {
//    $update = "UPDATE question SET `answerCount` = `answerCount` + 1, recent = now() WHERE `id` = {$questionId}";
    $update = "UPDATE question SET `answerCount` = `answerCount` + 1 WHERE `id` = {$questionId}";
    $pdo->exec($update);
    success_encode();
} else {
    other_encode(500, $pdo->errorInfo());
}

