<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$qid = (int)$_POST["qid"];
$content = $_POST["content"];

//$sql = $pdo->prepare("INSERT INTO answer ( `uid`, `qid`, `content`, `date` ) VALUES ( ?, ?, ?, now())");
$sql = $pdo->prepare("INSERT INTO answer ( `uid`, `qid`, `content` ) VALUES ( ?, ?, ?)");
if ($sql->execute(array($uid, $qid, $content))) {
//    $update = $pdo->prepare("UPDATE question SET `answerCount` = `answerCount` + 1, recent = now() WHERE `id` = ?");
    $update = $pdo->prepare("UPDATE question SET `answerCount` = `answerCount` + 1 WHERE `id` = ?");
    $update->execute(array($qid));
    success_encode();
} else {
    other_encode(500, "回答失败");
}

