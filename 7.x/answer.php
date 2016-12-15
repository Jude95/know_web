<?php
include("connect.php");
include("token.php");

$token = addslashes($_POST["token"]);
$uid = checkToken($pdo, $token);

$qid = addslashes($_POST["qid"]);
$content = addslashes($_POST["content"]);
//$sql = "INSERT INTO answer ( `uid`, `qid`, `content`, `date` ) VALUES ($uid, $qid, '{$content}', now())";
$sql = "INSERT INTO answer ( `uid`, `qid`, `content` ) VALUES ( $uid, $qid, '{$content}')";
if ($pdo->exec($sql)) {
//    $update = "UPDATE question SET `answerCount` = `answerCount` + 1, recent = now() WHERE `id` = {$questionId}";
    $update = "UPDATE question SET `answerCount` = `answerCount` + 1 WHERE `id` = $qid";
    $pdo->exec($update);
    success_encode();
} else {
    other_encode(500, "回答失败");
}

