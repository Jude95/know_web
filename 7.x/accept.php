<?php
include("connect.php");
include("token.php");

$token = $_POST["token"];
$uid = checkToken($pdo, $token);

$aid = (int)$_POST["aid"];
$qid = (int)$_POST["qid"];

$sql = $pdo->prepare("SELECT * FROM question WHERE `id` = ? AND `uid` = ?");

if ($sql->execute(array($qid, $uid))) {
    $sql = $pdo->prepare("UPDATE answer SET `best` = TRUE WHERE `qid` = ? AND `id` = ?");
    if ($sql->execute(array($qid, $aid))) {
        success_encode();
    } else {
        other_encode(500, "采纳失败");
    }
} else {
    other_encode(404, "未找到对应回答");
}
